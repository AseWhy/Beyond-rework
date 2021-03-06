<?php

/***КНОПКИ***/

$button['MAIN'] = [
    [['text', ['work', 'working'], "", "green"]],
    [['text', ['work', 'about'], "", "red"],
    ['text', ['work', 'jobs'], "Вакансии", "red"]]
    [['text', ['centre', 'main'], "Центральная площадь", "white"]]];
        
$button['OK'] = [[['text', ['work', 'main'], "", "green"]]];
$button['CANCEL'] = [[['text', ['work', 'main'], "Я передумал", "white"]]];
    
/***ОСНОВНОЙ КОД***/

$work = $db->query("SELECT * FROM `Several_work` WHERE `Название` = '?s'", $user['Работа']['Название'])->fetch_assoc();
$work['Зарплата'] = json_decode($work['Зарплата'], TRUE);
$work['Стаж'] = json_decode($work['Стаж'], TRUE);

switch ($payload[1])
{
    case 'main':
        $button['MAIN'][0][0][2] = $work['Кнопка'];
        $button['MAIN'][1][1][2] = $work['Название'];
        $vk->sendButton($user_id, $work['Старт'], $button['MAIN']);
        $db->query("UPDATE `Several_user` SET `Меню` = ?n WHERE `vk_id` = ?i", NULL, $user_id);
        break;
    case 'jobs':
        $jobs = $db->query("SELECT * FROM `Several_work` WHERE (`Местность` = '?s' OR `Местность` = ?n) AND `Название` <> '?s' ORDER BY `sys_id` ASC", $town['Тип'], NULL, 'Безработный');
        $text = "Список доступных вакансий:\n";
        for ($i = 1; $job = $jobs->fetch_assoc(); $i++)
            $text .= "\n$i. {$job['Название']}";
        $vk->sendButton($user_id, "$text\n\nВыберите номер вакансии, на которую претендуете (с повышением уровня откроются новые работы).", $button['CANCEL']);
        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'work select', $user_id);
        break;
    case 'about':
        $vk->reply("Ваша профессия: {$work['Название']}.\nЗаработок за смену: {$work['Зарплата'][$user['Работа']['Уровень']]}.\nОпытность: ". WORK_LVL[$user['Работа']['Уровень']] .".\n\n{$work['Описание']}");
        break;
    case 'working':
        if ($user['Характеристики']['Сытость'] < $work['Сытость'])
        {
            $vk->reply($work['Голод']);
            exit;
        }
        if ($user['Характеристики']['Бодрость'] < $work['Бодрость'])
        {
            $vk->reply($work['Усталость']);
            exit;
        }
        if (in_array($user['Работа']['Стаж'][$work['Название']], $work['Стаж'])) //Если значение стажа есть в массиве значений для перехода на следующий уровень работы. Лео.
        {
            $user['Работа']['Уровень'] = array_search($user['Работа']['Стаж'][$work['Название']], $work['Стаж']); //Уровень персонажа в работе - ключ того значения, наличие которого установили в if. Лео.
            $user['Навыки']['Опыт']++;
            $vk->reply("Поздравляем! Вы достигли уровня ". WORK_LVL_SKLON[$user['Работа']['Уровень']] ."в работе!\nВам также начислено очко опыта!");
            if ($user['Навыки']['Опыт'] >= $user['Навыки']['Опыт'] * 4)
            {
                $vk->reply("Поздравляем! Ваш персонаж достиг нового уровня!\nВы можете потратить очки навыков в окне персонажа.");
                $user['Навыки']['Уровень']++;
                $user['Навыки']['Опыт'] = 0;
                $user['Навыки']['Очки навыков'] += FOR_LVL_POINTS;
            }
            updateUser($user, ['Навыки', 'Работа']);
        }
        if ($user['Работа']['Уровень'] == 4)
            $text_st = "Вы достигли высшего мастерства!"; //если высший уровень работы. Лео.
        else
            $text_st = $user['Работа']['Стаж'][$work['Название']] .'/'. $work['Стаж'][$user['Работа']['Уровень'] + 1]; //прогресс уровня работы. Лео.
        $tax = $work['Зарплата'][$user['Работа']['Уровень']] / 100 * $town['Трудовой_налог']; //подсчёт налога. Лео.
        $text = $work["Процесс_". rand(1, 5)]; //рандомное описание процесса работы. Лео.
        $user['Работа']['Стаж'][$work['Название']]++;
        $user['Инвентарь']['Кошелёк'] += $work['Зарплата'][$user['Работа']['Уровень']] - $tax; //вплюс зарплата минус налог. Лео.
        $user['Инвентарь']['Кошелёк'] = round($user['Инвентарь']['Кошелёк'], 2);
        $user['Характеристики']['Бодрость'] -= $work['Бодрость'];
        $user['Характеристики']['Сытость'] -= $work['Сытость'];
        if ($tax < 0)
            $text_tax = "Сумма субсидии от города: ". abs($tax) .".";
        elseif ($tax == 0)
            $text_tax = "Трудовой налог в этом городе не взимается";
        elseif ($tax > 0)
            $text_tax = "$tax отдано в качестве налога.";
        $db->query("UPDATE `Several_towns` SET `Сбор_Труд` ?d WHERE `Название` = '?s'", $town['Cбор_Труд'] + $tax, $user['Локация']); //нологъ в казну. Лео.
        updateUser($user, ['Инвентарь', 'Характеристики', 'Работа']);
        $vk->reply("$text\nКошелёк: {$user['Инвентарь']['Кошелёк']}\nБодрость: {$user['Характеристики']['Бодрость']}/". $user['Характеристики']['Бодрость'] * 3 ."\nСытость: {$user['Характеристики']['Сытость']}/". MAX_FOOD ."\nОпытность: $text_st\n$text_tax");
        break;
    case NULL:
        if ($menu[1] != 'select')
            exit;
        $jobs = $db->query("SELECT * FROM `Several_work` WHERE (`Местность` = '?s' OR `Местность` = ?n) AND `Название` <> '?s' ORDER BY `sys_id` ASC", $town['Тип'], NULL, 'Безработный');
        for ($i = 1; $job = $jobs->fetch_assoc(); $i++)
        {
            if ($val == $i)
            {
                if (isset($job['Снаряжение']) AND !in_array($job['Снаряжение'], $user['Работы']['Квоты']))
                {
                    $vk->reply("Для работы на должности \"{$job['Название']}\" необходимо иметь снаряжение:\n{$job['Снаряжение']}");
                    exit;
                }
                $user['Работа']['Название'] = $job['Название'];
                if (!$user['Работа']['Стаж'][$job['Название']])
                    $user['Работа']['Стаж'][$job['Название']] = 0;
                updateUser($user, ['Работа']);
                $button['OK'][0][0][2] = $job['Название'] .' так '. mb_strtolower($job['Название']) .'!';
                $vk->sendButton($user_id, "Ну что же...", $button['OK']);
            }
        }
        break;
}

?>