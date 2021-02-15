<?php

/***КНОПКИ***/

$button['MAIN'] = [
    [['text', ['shop', 'buy', 'main'], "Купить", "green"],
    ['text', ['shop', 'sell', 'main'], "Продать", "red"]],
    [['text', ['centre', 'main'], "Центральная площадь", "white"]]];
        
$button['BUY']['MAIN'] = [
    [['text', ['shop', 'buy', 'list', 'Оружие'], "Оружие", "green"],
    ['text', ['shop', 'buy', 'list', 'Одежда'], "Одежда/Броня", "green"],
    ['text', ['shop', 'buy', 'list', 'Транспорт'], "Транспорт", "green"]],
    [['text', ['shop', 'buy', 'list', 'Рюкзак'], "Рюкзаки", "blue"],
    ['text', ['shop', 'buy', 'list', 'Щиты'], "Щиты", "blue"],
    ['text', ['shop', 'buy', 'list', 'Аптечки'], "Аптечки", "blue"]],
    [['text', ['shop', 'buy', 'list', 'Бомбы'], "Бомбы", "red"],
    ['text', ['shop', 'buy', 'list', 'Квоты'], "Для работы", "red"],
    ['text', ['shop', 'buy', 'list', 'Полезное'], "Полезное", "red"]],
    [['text', ['shop', 'main'], "Выйти из меню покупки", "white"]]];

$button['BUY']['BACK'] = [[['text', ['shop', 'buy', 'main'], "Вернуться в меню покупки", "white"]]];
            
$button['BUY']['THIS'] = [
    [['text', ['shop', 'buy', 'this'], "Купить ", "green"]],
    [['text', ['shop', 'buy', 'main'], "Отмена", "red"]]];

$button['BUY']['END'] = [[['text', ['shop', 'buy', 'main'], "Забрать ", "green"]]];

$button['SELL']['MAIN'] = [
    [['text', ['shop', 'sell', 'list', 'Оружие'], "Оружие", "green"],
    ['text', ['shop', 'sell', 'list', 'Одежда'], "Одежда/Броня", "green"]],
    [['text', ['shop', 'sell', 'list', 'Транспорт'], "Транспорт", "blue"],
    ['text', ['shop', 'sell', 'list', 'Рюкзак'], "Рюкзаки", "blue"]],
    [['text', ['shop', 'sell', 'list', 'Полезное'], "Полезное", "red"],
    ['text', ['shop', 'sell', 'list', 'Лут'], "Лут", "red"]],
    [['text', ['shop', 'main'], "Выйти из меню продажи", "white"]]];

$button['SELL']['BACK'] = [[['text', ['shop', 'sell', 'main'], "Вернуться в меню продажи", "white"]]];
        
$button['SELL']['THIS'] = [
    [['text', ['shop', 'sell', 'this'], "Подтвердить продажу ", "green"]],
    [['text', ['shop', 'sell', 'main'], "Отмена", "red"]]];

$button['SELL']['ALL'] = [
    [['text', ['shop', 'sell', 'all'], "Продать всё", "red"]],
    [['text', ['shop', 'sell', 'main'], "Вернуться в меню продажи", "white"]]];

/***ТЕКСТ***/

$first_text = [
    'Оружие' => 'Хотите присмотреть оружие? Вот список подходящего вам:',
    'Одежда' => 'Хотите присмотреть одежду? Вот список подходящей вам:',
    'Транспорт' => 'Вы хотите приобрести личный транспорт? Вот что у нас есть:',
    'Рюкзак' => 'Нужен новый рюкзак? Вам подходят вот эти:',
    'Щиты' => 'Щиты крайне полезны в бою. Хотите купить? Вам подходят вот эти:',
    'Аптечки' => 'Без аптечек никуда. Взгляните:',
    'Бомбы' => 'Чертовски опасные штуки. Желаете? Вам стоит обратить внимание на эти:',
    'Квоты' => 'Работа, работа, работа...',
    'Полезное' => 'Всякая полезная всячина. Пригодится.'];

$conditions = ['Оружие' => 'Меткость', 'Одежда' => 'Сноровка', 'Рюкзак' => 'Сила'];
$effect = ['Оружие' => 'Урон', 'Одежда' => 'Защита', 'Транспорт' => 'Скорость', 'Щиты' => 'Защита', 'Аптечки' => 'Восстанавление ХП', 'Бомбы' => 'Урон', 'Полезное' => 'Эффект'];

/***ОСНОВНОЙ КОД***/

switch ($payload[1])
{
    case 'main':
        $vk->sendButton($user_id, "Это рынок поселения {$user['Локация']}. Желаете приобрести или продать что-нибудь?", $button['MAIN']);
        break;
    case 'buy':
        switch ($payload[2]) 
        {
            case 'main':
                $vk->sendButton($user_id, "Здесь вы можете купить всё, что захотите (если денег хватит).", $button['BUY']['MAIN']);
                $db->query("UPDATE `Several_user` SET `Меню` = ?n WHERE `vk_id` = ?i", NULL, $user_id);
                break;
            case 'list':
                $list = $db->query("SELECT * FROM ?f WHERE `Название` <> '?s' AND `Уникальное` IS NULL AND `Уровень` <= ?i ORDER BY `Стоимость`", $payload[3], $new_user['Инвентарь'][$payload[3]], $user['Навыки']['Уровень']);
                for ($i = 1; $item = $list->fetch_assoc(); $i++)
                    $text .= "\n$i. {$item['Название']}.";
                $vk->sendButton($user_id, $first_text[$payload[3]] . $text, $button['BUY']['BACK']);
                $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", "shop buy {$payload[3]}", $user_id);
                break;
            case 'this':
                $item = $db->query("SELECT * FROM ?f WHERE `Название` = '?s'", $menu[2], $user['RAM'])->fetch_assoc();
                if ($user['Инвентарь']['Кошелёк'] < $item['Стоимость'])
                    endReply("У вас недостаточно денег.");
                switch($menu[2])
                {
                    case 'Рюкзак':
                        foreach (['Щиты', 'Аптечки', 'Бомбы', 'Полезное', 'Лут'] as $key => $value)
                        {
                            if (array_sum($user['Инвентарь'][$value]) > $item[$value])
                                endReply("У вас в рюкзаке слишком много вещей. Они не влезут в новый рюкзак.");
                        }
                    case 'Оружие':
                    case 'Одежда':
                        if ($user['Навыки'][$conditions[$menu[2]]] < $item[$conditions[$menu[2]]])
                            endReply("Ваша {$conditions[$menu[2]]} слишком мала для покупки данного снаряжения");
                    case 'Транспорт':
                        if ($user['Инвентарь'][$menu[2]] != $new_user['Инвентарь'][$menu[2]])
                            endReply("У вас с собой уже есть". mb_strtolower($menu[2]) .". Нужно отнести в хранилище или продать.");
                        if (in_array($item['Название'], $user['Склад'][$menu[2]]))
                            endReply("У вас в хранилище уже есть такой предмет.");
                        if ($user['Инвентарь'][$menu[2]] == $item['Название'])
                            endReply("У вас уже есть этот предмет.");
                        $user['Инвентарь'][$menu[2]] = $item['Название'];
                        break;
                    case 'Квоты':
                        if (in_array($item['Название'], $user['Работа']['Квоты']))
                            endReply("У вас уже есть этот предмет.");
                        $user['Работа']['Квоты'][] = $item['Название'];
                        updateUser($user, ['Работа']);
                        break;
                    default:
                        if (array_sum($user['Инвентарь'][$menu[2]]) >= $backpack[$menu[2]])
                            endReply("В вашем рюкзаке нет свободных слотов для этого.");
                        $user['Инвентарь'][$menu[2]][$item['Название']]++;
                        break;
                }
                $user['Инвентарь']['Кошелёк'] -= $item['Стоимость'];
                updateUser($user, ['Инвентарь']);
                $button['BUY']['END'][0][0][2] .= $item['Падеж'];
                $vk->sendButton($user_id, "Поздравляем с покупкой!", $button['BUY']['END']);
                break;
        }
        break;
    case 'sell':
        switch ($payload[2]) 
        {
            case 'main':
                $vk->sendButton($user_id, "Если вам больше не нужны какие-то ваши вещи.", $button['BUY']['MAIN']);
                $db->query("UPDATE `Several_user` SET `Меню` = ?n WHERE `vk_id` = ?i", NULL, $user_id);
                break;
            case 'weapon':
                break;
            case 'clothes':
                break;
            case 'transport':
                break;
            case 'backpack':
                break;
            case 'items':
                break;
            case 'bag_slots':
                break;
        }
        break;
    case NULL:
        switch ($menu[1]) 
        {
            case 'buy':
                $list = $db->query("SELECT * FROM ?f WHERE `Название` <> '?s' AND `Уникальное` IS NULL AND `Уровень` <= ?i ORDER BY `Стоимость`", $menu[2], $new_user['Инвентарь'][$menu[2]], $user['Навыки']['Уровень']);
                for ($i = 1; $item = $list->fetch_assoc(); $i++)
                {
                    if ($i != $message)
                        continue;
                    $text = $item['Название'] . ".\n" . $item['Описание'];
                    switch ($menu[2])
                    {
                        case 'Рюкзак':
                            $text .= "\nНеобходимая {$conditions[$menu[2]]} - {$item[$conditions[$menu[2]]]}";
                            $text .= "\nКоличество слотов:";
                            foreach (['Щиты', 'Аптечки', 'Бомбы', 'Полезное', 'Лут'] as $key => $value)
                                $text .= "\n\t$value - {$item[$value]}";
                            break;
                        case 'Оружие':
                        case 'Одежда':
                            $text .= "\nНеобходимая {$conditions[$menu[2]]} - {$item[$conditions[$menu[2]]]}";
                            $text .= "\n{$effect[$menu[2]]} - {$item[$effect[$menu[2]]]}";
                            break;
                        case 'Квоты':
                            $text .= "\nОткрывает работу под названием {$item[$effect[$menu[2]]]}";
                            break;
                        default:
                            $text .= "\n{$effect[$menu[2]]} - {$item[$effect[$menu[2]]]}";
                            break;
                    }
                    $text .= "\nСтоимость - {$item['Стоимость']}";
                    $button['BUY']['THIS'][0][0][2] .= $item['Падеж'];
                    $vk->sendButton($user_id, $text, $button['BUY']['THIS']);
                    $vk->sendImage($user_id, "img/{$menu[2]}/{$item['Название']}.jpg");
                    $db->query("UPDATE `Several_user` SET `RAM` = '?s' WHERE `vk_id` = ?i", $item['Название'], $user_id);
                    break;
                }
                break;
            case 'sell':
                break;
        }

}
    /*
    case 'Продать старье': //SHOP
        if ($user['Статус'] == 'Поселение')
        {
            $js_invent = json_decode($user['Инвентарь'], TRUE);
            $vk->sendbutton($id, "Что вы хотите продать?", [
                [[['city' => 'Своё оружие'], "{$js_invent['Оружие']}", 'green'], [['city' => 'Свои одеяния'], "{$js_invent['Одежда']}", 'green'], [['city' => 'Своё снаряжение'], "Своё снаряжение", 'green']],
                [[['city' => 'Содержимое сумки'], "Содержимое сумки", 'red']],
                [[["city" => 'shop'], "Вернуться в лавку", "white"]]
                ]);
            mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Город' WHERE Ид = $id");
            break;
        }
        else
        {
            $vk->sendMessage($id, "Внимание!\nЭта кнопка не соответствует вашему статусу.\nВы попали в баг.\nВведите команду \"Клавиатура\"\nЗачастую эта команда решает проблему.\n\nРепорт автоматически отправился разработчику. Приносим извинения за неудобство.");
            $vk->sendmessage(VK_LOG_TECH, "[id$id|{$user['Вк_Имя']}] нажал кнопку которая не соответствует его статусу.БАГ.");
            exit();
        }
    case 'Своё оружие': //SHOP
        if ($user['Статус'] == 'Поселение')
        {
            $js_invent = json_decode($user['Инвентарь'], TRUE);
            if ($js_invent['Оружие'] != 'Безоружен')
            {
                $invent = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Оружие']}'"));
                $js_invent['Оружие'] = 'Безоружен';
                $tx2 = $invent['Стоимость'];
                $x = $tx2 * 0.5;
                $js_invent['Кошелек'] += $x;
                $vk->sendbutton($id, "Вы продали отлично, вы продали своё оружие за $x.", [
                    [[["city" => 'shop'], "Вернуться в лавку", "green"]]
                    ]);
                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent', Меню = 'Город' WHERE Ид = $id");
            }
            else
                $vk->sendbutton($id, "У вас нет оружия!", [
                    [[["city" => 'Продать старье'], "Вернуться к продаже", "green"]]
                    ]);
            break;
        }
        else
        {
            $vk->sendMessage($id, "Внимание!\nЭта кнопка не соответствует вашему статусу.\nВы попали в баг.\nВведите команду \"Клавиатура\"\nЗачастую эта команда решает проблему.\n\nРепорт автоматически отправился разработчику. Приносим извинения за неудобство.");
            $vk->sendmessage(VK_LOG_TECH, "[id$id|{$user['Вк_Имя']}] нажал кнопку которая не соответствует его статусу.БАГ.");
            exit();
        }
    case 'Свои одеяния': //SHOP
        if ($user['Статус'] == 'Поселение')
        {
            $js_invent = json_decode($user['Инвентарь'], TRUE);
            if ($js_invent['Одежда'] != 'Без одежды')
            {
                $invent = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Одежда']}'"));
                $js_invent['Одежда'] = 'Без одежды';
                $tx2 = $invent['Стоимость'];
                $x = $tx2 * 0.5;
                $js_invent['Кошелек'] += $x;
                $vk->sendbutton($id, "Вы продали отлично, вы продали своё одеяние за $x.", [
                    [[["city" => 'Продать старье'], "Вернуться к продаже", "green"]]
                    ]);
                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent', Меню = 'Город' WHERE Ид = $id");
            }
            else
                $vk->sendbutton($id, "У вас нет одежды!", [
                    [[["city" => 'Продать старье'], "Вернуться к продаже", "green"]]
                    ]);
            break;
        }
        else
        {
            $vk->sendMessage($id, "Внимание!\nЭта кнопка не соответствует вашему статусу.\nВы попали в баг.\nВведите команду \"Клавиатура\"\nЗачастую эта команда решает проблему.\n\nРепорт автоматически отправился разработчику. Приносим извинения за неудобство.");
            $vk->sendmessage(VK_LOG_TECH, "[id$id|{$user['Вк_Имя']}] нажал кнопку которая не соответствует его статусу.БАГ.");
            exit();
        }
    case 'Своё снаряжение': //SHOP
        $js_invent = json_decode($user['Инвентарь'], TRUE);
        $text = '';
        foreach ($js_invent['Слоты'] as $slot => $value)
        {
            $text .= "\n$slot: $value";
        }
        $vk->sendbutton($id, "Какой предмет вы хотите продать?\n$text\n\nУкажите номер слота цифрой.[от 1 до 4]", [
            [[["city" => 'Продать старье'], "Вернуться к продаже", "green"]]
            ]);
        mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Продажа снаряжения' WHERE Ид = $id");
        break;
    case 'Продать все из сумки': //SHOP
        $js_invent = json_decode($user['Инвентарь'], TRUE);
        $valueents = count($js_invent['Сумка']) - 1; //сколько предметов в сумке
        if ($valueents > 0)
        { //Проверка, что сумка не пуста
            $i = 0;
            while ($i < $valueents)
            {
                $i++;
                $invent = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Сумка'][$i]}'"));
                $price_item = $invent['Стоимость'];
                //$x = $price_item;
                $x = round($price_item * 0.5, 2); //округление
                unset($js_invent['Сумка'][$i]); //Удалить предмет из сумки(удаление элемента массива)
                $js_invent['Сумка'][0]++; //В сумке стало на 1 место больше
                $total_profit += $x;
            }
            $js_invent['Кошелек'] += $total_profit;
            $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent',Меню = 'Город' WHERE Ид = $id");
            $vk->sendMessage($id, "\nОтлично, вы продали все! \n Итоговая выгода: $total_profit банов");
        }
        else
            $vk->sendmessage($id, "Так у вас нечего продавать. Проваливайте!");
        break;
    case 'Содержимое сумки': //SHOP
        $js_invent = json_decode($user['Инвентарь'], TRUE);
        $text = '';
        $i = 0;
        foreach ($js_invent['Сумка'] as $slot => $value)
        {
            if ($i != 0 AND $value != NULL)
                $text .= "\n$slot.$value";
            $i++;
        }
        $vk->sendbutton($id, "Какой предмет вы хотите продать?\n$text\n\nУкажите номер слота цифрой.", [
            [[["city" => 'Продать все из сумки'], "Продать все", "red"]],
            [[["city" => 'Продать старье'], "Вернуться к продаже", "green"]]
            ]);
        mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Содержимое сумки' WHERE Ид = $id");
        break;*/

?>