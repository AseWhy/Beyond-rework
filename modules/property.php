<?php

/***КНОПКИ***/

$button['MAIN'] = [
    [['text', ['property', 'business', 'entrance'], "Бизнес", "green"],
    ['text', ['property', 'storage', 'main'], "", "green"],
    ['text', ['property', 'home', 'main'], "", "green"]],
    [['text', ['centre', 'main'], "Центральная площадь", "white"]]];
        
$button['HOME']['MAIN'] = [
    [['text', ['property', 'home', 'relax'], "Отдохнуть", "green"]],
    [['text', ['property', 'home', 'about'], "Осмотреться", "red"],
    ['text', ['property', 'home', 'next'], "Улучшить", "blue"]],
    [['text', ['property', 'main'], "Вернуться к экрану недвижимости", "white"]]];
            
$button['HOME']['RELAX'] = [
    [['text', NULL, "Состояние", "blue"]],
    [['text', ['home', 'main'], "Вернуться", "green"]]];
            
$button['HOME']['NEXT'] = [
    [['text', ['property', 'home', 'ok'], "Улучшить жильё", "green"]],   
    [['text', ['property', 'home', 'main'], "Вернуться", "red"]]];
            
$button['BUSINESS']['MAIN'] = [
    [['text', ['property', 'business', 'list'], "Список предприятий", "green"],
    ['text', ['property', 'business', 'profit'], "Собрать прибыль", "green"]],
    [['text', ['property', 'business', 'expand'], "Расширить бизнес", "blue"],
    ['text', ['property', 'business', 'offers', 'main'], "Предложения", "blue"]],
    [['text', ['property', 'main'], "Вернуться к экрану недвижимости", "white"]]];
            
$button['BUSINESS']['BUY'] = [
    [['text', ['property', 'business', 'buy'], "Открыть бизнес №", "green"]],
    [['text', ['property', 'business', 'main'], "Возможно, позже", "red"]]];

$button['OFFERS']['MAIN'] = [
    [['text', ['property', 'business', 'offers', 'my'], "Мои предложения", "green"],
    ['text', ['property', 'business', 'offers', 'list'], "Предложения игроков", "green"]],
    [['text', ['property', 'business', 'sell', 'list'], "Продать бизнес", "blue"]],
    [['text', ['property', 'business', 'main'], "Вернуться к экрану бизнеса", "white"]]];

$button['OFFERS']['QUESTION'] = [
    [['text', ['property', 'business', 'offers', 'yes'], "Согласиться", "green"],
    ['text', ['property', 'business', 'offers', 'no'], "Отказаться", "red"]],
    [['text', ['property', 'business', 'main'], "Позже", "white"]]];

$button['OFFERS']['CANCEL'] = [
    [['text', ['property', 'business', 'offers', 'cancel'], "Отменить это предложение", "red"]],
    [['text', ['property', 'business', 'main'], "Вернуться", "white"]]];

$button['CANCEL'] = [[['text', ['property', 'business', 'main'], "Отмена", "white"]]];
$button['END'] = [[['text', ['property', 'business', 'main'], "Завершить", "white"]]];

$button['SELL']['NEXT'] = [
    [['text', ['property', 'business', 'sell'], "Подтвердить", "green"]],
    [['text', ['property', 'business', 'main'], "Отмена", "white"]]];

$button['STORAGE']['MAIN'] = [
    [['text', ['property', 'storage', 'take', 'main'], "Взять", "green"]],
    [['text', ['property', 'storage', 'put', 'main'], "Оставить", "green"]],
    [['text', ['property', 'storage', 'infa'], "Информация", "red"]],
    [['text', ['property', 'storage', 'next'], "Улучшить", "red"]],
    [['text', ['property', 'main'], "Вернуться", "white"]]];

$button['STORAGE']['NEXT'] = [
    [['text', ['property', 'storage', 'ok'], "Улучшить хранилище", "green"]],   
    [['text', ['property', 'storage', 'main'], "Вернуться", "red"]]];

$button['STORAGE']['TAKE']['MAIN'] = [
    [['text', ['property', 'storage', 'take', 'list', 'Оружие'], "Оружие", "green"],
    ['text', ['property', 'storage', 'take', 'list', 'Одежда'], "Одежда/Броня", "green"],
    ['text', ['property', 'storage', 'take', 'list', 'Транспорт'], "Транспорт", "green"]],
    [['text', ['property', 'storage', 'take', 'list', 'Рюкзак'], "Рюкзаки", "blue"],
    ['text', ['property', 'storage', 'take', 'list', 'Щиты'], "Щиты", "blue"],
    ['text', ['property', 'storage', 'take', 'list', 'Полезное'], "Полезное", "blue"]],
    [['text', ['property', 'storage', 'main'], "Вернуться", "red"]]];

$button['STORAGE']['PUT']['MAIN'] = [
    [['text', ['property', 'storage', 'put', 'list', 'Оружие'], "", "green"],
    ['text', ['property', 'storage', 'put', 'list', 'Одежда'], "", "green"],
    ['text', ['property', 'storage', 'put', 'list', 'Транспорт'], "", "green"]],
    [['text', ['property', 'storage', 'put', 'list', 'Рюкзак'], "", "blue"],
    ['text', ['property', 'storage', 'put', 'list', 'Щиты'], "Щиты", "blue"],   
    ['text', ['property', 'storage', 'put', 'list', 'Полезное'], "Полезное", "blue"]],
    [['text', ['property', 'storage', 'main'], "Вернуться", "red"]]];

$button['STORAGE']['TAKE']['BACK'] = [[['text', ['property', 'storage', 'take', 'main'], "Вернуться", "white"]]];
$button['STORAGE']['PUT']['BACK'] = [[['text', ['property', 'storage', 'put', 'main'], "Вернуться", "white"]]];

$button['STORAGE']['TAKE']['THIS'] = [
    [['text', ['property', 'storage', 'take', 'this'], "Взять ", "green"]],
    [['text', ['property', 'storage', 'take', 'main'], "Отмена", "green"]]];

$button['STORAGE']['PUT']['THIS'] = [
    [['text', ['property', 'storage', 'put', 'this'], "Оставить ", "green"]],
    [['text', ['property', 'storage', 'put', 'main'], "Отмена", "green"]]];

/***ОСНОВНОЙ КОД***/

if (!array_key_exists($user['Локация'], $user['Жильё']))
{
    $user['Жильё'][$user['Локация']] = $town['Жильё'];
    userUpdate($user, ['Жильё']);
}
if (!array_key_exists($user['Локация'], $user['Хранилище']))
{
    $user['Хранилище'][$user['Локация']]['Название'] = $town['Хранилище'];
    userUpdate($user, ['Хранилище']);
}
$home = $db->query("SELECT * FROM `Дома` WHERE `Название` = '?s'", $user['Жильё'][$user['Локация']])->fetch_assoc();
$storage = $db->query("SELECT * FROM `Хранилище` WHERE `Название` = '?s'",  $user['Хранилище']['Города'][$user['Локация']])->fetch_assoc();
$button['MAIN'][0][1][2] = $storage['Название'];
$button['MAIN'][0][2][2] = $home['Название'];
switch ($payload[1])
{
    case 'entrance':
        $vk->sendButton($user_id, "Добро пожаловать, {$user['Имя']}. Это экран вашей недвижимости. Здесь вы можете управлять собственными предприятиями, хранилищем и жильём.", $button['MAIN']);
        break;
    case 'main':
        $vk->sendButton($user_id, "Вы вернулись к экрану вашей недвижимости. Здесь вы можете управлять собственными предприятиями, хранилищем и жильём.", $button['MAIN']);
        break;
    case 'business':
        switch ($payload[2])
        {
            case 'entrance':
                $vk->sendButton($user_id, "Это окно бизнеса. Что вы хотите сделать?", $button['BUSINESS']['MAIN']);
                break;
            case 'main':
                $vk->sendButton($user_id, "Вы вернулись в окно бизнеса", $button['BUSINESS']['MAIN']);
                $db->query("UPDATE `Several_user` SET `Меню` = ?n, `RAM` = ?n WHERE `vk_id` = ?i", NULL, NULL, $user_id);
                break;
            case 'list':
                $user_biz = $db->query("SELECT * FROM `Several_build` WHERE `Локация` = '?s' AND `Владелец` = ?i ORDER BY `Прибыль` ASC", $user['Локация'], $user['sys_id']); // Вытягиваем весь список
                for ($i = 1; $biz = $user_biz->fetch_assoc(); $i++)
                    $text .= "$i. {$biz['Название']} [". floor($biz['Накопления']) ."/{$biz['Прибыль']}]\n";
                $vk->reply("Список вашей недвижимости:\n\n$text");
                break;
            case 'expand':
                $buy_biz = $db->query("SELECT * FROM `Several_type_build` WHERE `Тип` = '?s' AND `Местность` LIKE '?s' ORDER BY sys_id ASC", 'Бизнес', "%{$town['Местность']}%"); // Вытягиваем весь список построек.
                for ($i = 1; $biz = $buy_biz->fetch_assoc(); $i++)
                    $text .= "$i. {$biz['Название']}.\n";
                $vk->reply("$text\n\nВведите номер интересующего вас предприятия.");
                $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'property business expand', $user_id);
                break;
            case 'buy':
                $select_biz = $db->query("SELECT * FROM `Several_type_build` WHERE `Название` = '?s'", $user['RAM'])->fetch_assoc();
                if ($user['Инвентарь']['Кошелёк'] < $select_biz['Стоимость'])
                    endReply("У вас недостаточно денег.");
                $user['Инвентарь']['Кошелёк'] -= $select_biz['Стоимость'];
                $bd_biz = [
                    'Владелец' => $user['sys_id'],
                    'Имя' => $user['vk_name'],
                    'Локация' => $user['Локация'],
                    'Тип' => 'Частник',
                    'Прибыль' =>  $select_biz['Прибыль'],
                    'Накопления' => 0,
                    'Название' => $select_biz['Название'],
                    'Ресурс' => 'Валюта'];
                $db->query("INSERT INTO `Several_build` SET ?A[?i, '?s', '?s', '?s', ?i, ?d, '?s', '?s']", $db_biz);
                $db->query("UPDATE `Several_user` SET `Меню` = ?n, `RAM` = ?n WHERE `vk_id` = ?i", NULL, NULL, $user_id);
                $vk->sendButton($user_id, "Поздравляем с покупкой!", $button['BUSINESS']['MAIN']);
                updateUser($user, ['Инвентарь']);
                break;
            case 'profit':
                $income = 0;
                $user_biz = $db->query("SELECT `Накопления` FROM `Several_build` WHERE `Локация` = '?s' AND `Владелец` = ?i", $user['Локация'], $user['sys_id']);
                while ($profit_biz = $user_biz->getOne())
                    $income += $profit_biz;
                $income = round($income, 2);    
                $db->query("UPDATE `Several_build` SET `Накопления` = ?d WHERE `Локация` = '?s' AND `Владелец` = ?i", 0, $user['Локация'], $user['sys_id']);
                $tax = round($income * $town['Налоги']['Бизнес'] / 100, 2);
                $db->query("UPDATE `Several_towns` SET `Сбор_Прибыль` = ?i WHERE `Название` = '?s'", $town['Сбор_Прибыль'] + $tax, $user['Локация']);
                if ($tax < 0)
                    $text = "Сумма субсидии от города:". abs($tax);
                else
                    $text = "$tax отдано в качестве налога";
                $vk->reply("Прибыль с владений собрана.\nВсего собрано: $income.\n$text\nКошелёк: {$user['Инвентарь']['Кошелёк']}");
                updateUser($user, ['Инвентарь']);
                break;
            case 'sell':
                switch ($payload[3]) 
                {
                    case 'list':
                        $user_biz = $db->query("SELECT * FROM `Several_build` WHERE `Локация` = '?s' AND `Владелец` = ?i ORDER BY `Прибыль` ASC", $user['Локация'], $user['sys_id']); // Вытягиваем весь список
                        for ($i = 1; $biz = $user_biz->fetch_assoc(); $i++)
                            $text .= "$i. {$biz['Название']} [". floor($biz['Накопления']) ."/{$biz['Прибыль']}]\n";
                        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'property business sell list', $user_id);
                        $vk->sendButton($user_id, "Список вашей недвижимости:\n\n$text\n\nДля продажи бизнеса введите его номер. Если вы хотите продать несколько бизнесов, введите несколько номеров через пробел, пример:\n1 3 7", $button['SELL']['CANCEL']);
                        break;
                    case 'summ':
                        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'property business sell summ', $user_id);
                        $vk->sendButton($user_id, "Введите сумму, за которую хотите продать бизнес.", $button['CANCEL']);
                        break;
                    case 'person':
                        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'property business sell person', $user_id);
                        $vk->sendButton($user_id, "Введите ID игрока, которому хотите продать бизнес.", $button['CANCEL']);
                        break;
                    case 'ok':
                        $user['RAM'] = json_decode($user['RAM']);
                        $get_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $user['RAM']['person'])->fetch_assoc();
                        foreach ($user['RAM']['list'] as $value)
                        {
                            $biz = $db->query("SELECT * FROM `Several_build` WHERE `sys_id` = ?i", $value);
                            $text .= "{$biz['Название']}, прибыль - {$biz['Прибыль']}.\n"; 
                        }
                        $ram = json_encode($user['RAM']);
                        $db->query("INSERT INTO `Решения` SET `Содержание` = '?s', `Срок` = ?i, `Тип` = '?s', `Локация` = '?s', `Отправитель` = ?i, `Получатель` = ?i", $ram, 0, 'Продажа бизнеса', $user['Локация'], $user['sys_id'], $get_user['sys_id']);
                        $vk->sendMessage($get_user['vk_id'], "Игрок по имени {$get_user['vk_name']} предлагает вам купить за {$user['RAM']['SUMM']} в поселении \"{$user['Локация']}\" следующие его бизнесы:\n$text\nВы можете согласиться или отказаться во вкладке \"Предложения\" в меню бизнеса, когда будете в этом поселении.");
                        $vk->sendButton($user_id, "Завершить", $button['END']);
                        break;
                }
                break;
            case 'offers':
                switch ($payload[3])
                {
                    case 'my':
                        $list_offers = $db->query("SELECT * FROM `Решения` WHERE `Тип` = '?s' AND `Отправитель` = ?i AND `Локация` = '?s'", 'Продажа бизнеса', $user['sys_id'], $user['Локация']);
                        for ($i = 1; $offer = $list_offers->fetch_assoc(); $i++)
                        {
                            if ($i = 1 AND !$offer)
                                endReply("Вы не предлагали другим игрокам купить бизнес в этом городе.");
                            $offer['Содержание'] = json_decode($offer['Содержание']);
                            $get_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $offer['Получатель'])->fetch_assoc();
                            $text .= "\n$i. Вы предложили игроку {$get_user['vk_name']} купить следующие бизнесы за {$offer['Содержание']['summ']}:\n";
                            foreach ($offer['Содержание']['list'] as $key => $value)
                            {
                                $biz = $db-query("SELECT * FROM `Several_build` WHERE `sys_id` = ?i", $value)->fetch_assoc();
                                $text .= "{$biz['Название']}, прибыль - {$biz['Прибыль']}.\n";
                            }
                        }
                        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'property offers my', $user_id);
                        $vk->reply("Это список сделанных вами предложений в этом поселении.\n$text\nВведите номер предложения из списка, если хотите его отменить.");
                        break;
                    case 'cancel':
                        $offer = $db->query("SELECT * FROM `Решения` WHERE `sys_id` = ?i", $user['RAM'])->fetch_assoc();
                        $offer['Содержание'] = json_decode($offer['Содержание']);
                        foreach ($offer['Содержание']['list'] as $value)
                        {
                            $biz = $db->query("SELECT * FROM `Several_build` WHERE `sys_id` = ?i", $value)->fetch_assoc();
                            $text .= "{$biz['Название']}, прибыль - {$biz['Прибыль']}.\n";
                        }
                        $get_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $offer['Получатель'])->fetch_assoc();
                        $vk->sendMessage($get_user['vk_id'], "{$user['vk_name']} отменил своё предложение о продаже следующих бизнесов в поселении {$offer['Локация']}:\n$text");
                        $db->query("DELETE FROM `Решения` WHERE `sys_id` = ?i", $user['RAM']);
                        $vk->sendButton($user_id, "Вы отменили ваше предложение игроку {$get_user['vk_id']} о покупке следующих бизнесов в поселении {$offer['Локация']}:\n$text", $button['END']);
                        break;
                    case 'list':
                        $list_offers = $db->query("SELECT * FROM `Решения` WHERE `Тип` = '?s' AND `Получатель` = ?i AND `Локация` = '?s'", 'Продажа бизнеса', $user['sys_id'], $user['Локация']);
                        for ($i = 1; $offer = $list_offers->fetch_assoc(); $i++)
                        {
                            if ($i = 1 AND !$offer)
                                endReply("У вас нет предложений от других игроков в этом городе.");
                            $offer['Содержание'] = json_decode($offer['Содержание']);
                            $sell_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $offer['Отправитель'])->fetch_assoc();
                            $text .= "\n$i. Игрок {$sell_user['vk_name']} предлагает вам купить следующие бизнесы за {$offer['Содержание']['summ']}:\n";
                            foreach ($offer['Содержание']['list'] as $key => $value)
                            {
                                $biz = $db-query("SELECT * FROM `Several_build` WHERE `sys_id` = ?i", $value)->fetch_assoc();
                                $text .= "{$biz['Название']}, прибыль - {$biz['Прибыль']}.\n";
                            }
                        }
                        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'property offers list', $user_id);
                        $vk->reply("Это список предложений, поступивших вам от других игроков в этом поселении.\n$text\nВведите номер предложения из списка для согласия или отказа.");
                        break;
                    case 'yes':
                        $offer = $db->query("SELECT * FROM `Решения` WHERE `sys_id` = ?i", $user['RAM'])->fetch_assoc();
                        $offer['Содержание'] = json_decode($offer['Содержание']);
                        if ($user['Кошелёк']['Инвентарь'] < $offer['Содержание']['summ'])
                            endReply("У вас недостаточно денег.");
                        foreach ($offer['Содержание']['list'] as $value)
                        {
                            $biz = $db->query("SELECT * FROM `Several_build` WHERE `sys_id` = ?i", $value)->fetch_assoc();
                            if ($db->query("SELECT * FROM `Several_build` WHERE `Владелец` = ?i AND `Локация` = '?s' AND `Название` = '?s'", $user['sys_id']. $sell_biz['Локация'], $sell_biz['Название'])->getNumRows() != 0)
                                $text_no .= "У вас есть ". mb_strtolower($biz['Название']) ." в этом поселении.\n";
                            $text .= "{$biz['Название']}, прибыль - {$biz['Прибыль']}.\n";
                        }
                        if (!empty($text_no))
                            endReply($text_no);
                        $sell_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $offer['Отправитель'])->fetch_assoc();
                        foreach ($offer['Содержание']['list'] as $value)
                            $db->query("UPDATE `Several_build` SET `Владелец` = ?i, `Имя` = '?s' WHERE `sys_id` = ?i", $user['sys_id'], $user['vk_name'], $value);
                        $user['Инвентарь']['Кошелёк'] -= $offer['Содержание']['summ'];
                        $sell_user['Банк'] += $offer['Содержание']['summ'];
                        updateUser($user, ['Инвентарь']);
                        $db->query("UPDATE `Several_user` SET `Банк` = ?d WHERE `sys_id` = ?i", $sell_user['Банк'], $sell_user['sys_id']);
                        $vk->sendMessage($sell_user['vk_id'], "{$user['vk_name']} согласился на ваше предложение о покупке следующих бизнесов в поселении {$offer['Локация']}:\n$text\nДеньги переведены на ваш банковский счет.");
                        $vk->sendButton($user_id, "Поздравляем с покупкой!", $button['END']);
                        break;
                    case 'no':
                        $offer = $db->query("SELECT * FROM `Решения` WHERE `sys_id` = ?i", $user['RAM'])->fetch_assoc();
                        $offer['Содержание'] = json_decode($offer['Содержание']);
                        foreach ($offer['Содержание']['list'] as $value)
                        {
                            $biz = $db->query("SELECT * FROM `Several_build` WHERE `sys_id` = ?i", $value)->fetch_assoc();
                            $text .= "{$biz['Название']}, прибыль - {$biz['Прибыль']}.\n";
                        }
                        $sell_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $offer['Отправитель']);
                        $vk->sendMessage($sell_user['vk_id'], "{$user['vk_name']} отказался от вашего предложения о покупке следующих бизнесов в поселении {$offer['Локация']}:\n$text");
                        $db->query("DELETE FROM `Решения` WHERE `sys_id` = ?i", $user['RAM']);
                        $vk->sendButton($user_id, "Как будет угодно.", $button['END']);
                        break;
                }
                break;
        }
        break;
    case 'illegall':
        /*  
            Это в меню:
                case 'Расширение нелегбиза':
                    $val = floor($mess[0]);
                    if ($val > 0)
                    {
                        $i = 0;//Нумерация доступных построек
                        $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'")); //Читаем строку города
                        $sp = mysqli_query($Connect, "SELECT * FROM Several_type_build ORDER BY sys_id ASC"); // Вытягиваем весь список построек.
                        while ($res = mysqli_fetch_assoc($sp))
                        {
                            $js_t_build = json_decode($res['js_t_build'], TRUE); // Декодим требования для постройки
                            foreach ($js_t_build['ЧР'] as $value)
                            {
                                if ($value >= $town['ЧР'])
                                {
                                    //$vk->sendmessage($peer_id, "$i.Постройка прошла требования.");
                                    $i++;
                                    if ($i == $mess[0])
                                    {
                                        $tx1 = $js_t_build['Стоимость'];
                                        $tx2 = $js_t_build['Прибыль'];
                                        $tx3 = $js_t_build['Лимит'];
                                        $text = "{$js_t_build['Название']}.\n{$res['Описание']}\nСтоимость: $tx1.\nПрибыль: $tx2.\nЛимит прибыли: $tx3.";
                                        $buttons [] = [[['city' => 'Покупка нелегбиза'], "Открыть {$js_t_build['Название']}.", 'green']];
                                        $buttons [] = [[['city' => 'property'], "Возможно позже.", 'red']];
                                        $vk->sendbutton($id, "$text\n\n", $buttons);
                                        mysqli_query($Connect, "UPDATE Several_user SET RAM = '{$js_t_build['Название']}' WHERE Ид = $id");
                                    }
                                }
                            }
                        }
                    }
                    break;

            А это все кнопки:
                case 'Подполье': //PROPERTY
                    $js_prop = json_decode($user['Нелегбиз'], TRUE);
                    $vk->sendbutton($id, "Это окно подполья. Что вы хотите сделать?", [
                        [[["city" => 'Список нелегбиза'], "Нелегальные бизнесы", "green"], [["city" => 'Собрать общак'], "Собрать общак", "green"]],
                        [[["city" => 'Расширить нелегбиз'], "Развить подполье", "red"]],
                        [[["city" => 'exit_in_town'], "Вернуться в город", "white"]]
                        ]);
                    break;
                case 'Список нелегбиза': //PROPERTY
                    $user_prop = mysqli_query($Connect, "SELECT * FROM Several_build WHERE Локация = '{$user['Локация']}' AND Владелец = $id"); // Вытягиваем весь список
                    $i = 0;
                    while ($prop = mysqli_fetch_assoc($user_prop))
                    {
                        $i++;
                        $x = floor($prop['Накопления']);
                        $tx1 = $prop['Лимит'];
                        $text .= "$i.{$prop['Название']} [$x/$tx1]\n";
                    }
                    $vk->sendMessage($id, "Список вашей недвижимости:\n$text");
                    break;
                case 'Покупка нелегбиза': //PROPERTY
                    $select = mysqli_query($Connect, "SELECT * FROM Several_type_build ORDER BY sys_id ASC"); // Вытягиваем весь список
                    while ($res = mysqli_fetch_assoc($select))
                    {
                        if ($res['Название'] == $user['RAM'])
                        {
                            $js_build = json_decode($res['js_t_build'], TRUE);
                            $js_invent = json_decode($user['Инвентар��'], TRUE);
                            $user_prop = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_build WHERE Название = '{$user['RAM']}' AND Локация = '{$user['Локация']}' AND Владелец = $id")); // Вытягиваем весь список
                            if ($user_prop == NULL)
                            {
                                $price = $js_build['Стоимость'];
                                if ($js_invent['Кошелек'] >= $price)
                                {
                                    $js_invent['Кошелек'] -= $price;
                                    $db->query("INSERT INTO Several_build (Владелец,Вк_Имя,Локация,Тип,Лимит,Прибыль,Накопления,Название,Ресурс) VALUES (?i,'?s','?s','?s',?i,?i,?i,'?s','?s')",$id,$user['Вк_Имя'],$user['Локация'],'Нелегбиз',$js_build['Лимит'],$js_build['Прибыль'],0,$js_build['Название'],'Валюта');
                                    $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                                    mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent' WHERE Ид = $id");
                                    $vk->sendbutton($id, "Поздравляем с покупкой!", [
                                        [[["city" => 'Торговля'], "Вернуться к недвижимости", "green"]]
                                        ]);
                                }
                                else
                                    $vk->sendMessage($id, "У вас недостаточно денег.");
                            }
                            else
                                $vk->sendMessage($id, "У вас уже есть {$js_build['Название']} в этом поселении.");
                        }
                    }
                    break;
                case 'Расширить нелегбиз': //PROPERTY
                    $i = 0;//Нумерация доступных построек
                    $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'")); //Читаем строку города
                    $sp = mysqli_query($Connect, "SELECT * FROM Several_type_build ORDER BY sys_id ASC"); // Вытягиваем весь список построек.
                    while ($res = mysqli_fetch_assoc($sp))
                    {
                        if($res['Тип'] == 'Нелегбиз')
                        {
                            $js_t_build = json_decode($res['js_t_build'], TRUE); // Декодим требования для постройки
                            foreach ($js_t_build['ЧР'] as $value)
                            {
                                if ($value == $town['ЧР'])
                                {
                                    //$vk->sendmessage($peer_id, "$i.Постройка прошла требования.");
                                    $i++;
                                    $text .= "$i.{$js_t_build['Название']}.\n";
                                }
                            }
                        }
                    }
                    $vk->sendMessage($peer_id, "$text\nВведите номер интересующего вас предприятия.");
                    mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Расширение нелегбиза' WHERE Ид = $id");
                    break;
                case 'Собрать общак': //PROPERTY //налоги эта хуйня платить не должна
                    $js_invent = json_decode($user['Инвентарь'], TRUE);
                    $income = 0;
                    $user_prop = mysqli_query($Connect, "SELECT * FROM Several_build WHERE Локация = '{$user['Локация']}' AND Владелец = $id AND Тип = 'Нелегбиз'"); // Вытягиваем весь список
                    //Считаем общую прибыль
                    while ($prop = mysqli_fetch_assoc($user_prop))
                        $income += $prop['Накопления'];
                    mysqli_query($Connect, "UPDATE Several_build SET Накопления = 0 WHERE Локация = '{$user['Локация']}' AND Владелец = $id AND Тип = 'Нелегбиз'");
                    $js_invent['Кошелек'] += $income;
                    $tx3 = round($js_invent['Кошелек'], 2);
                    $vk->sendMessage($peer_id, "Прибыль с владений собрана.\nВсего собрано: $income.\n$tx4\nКошелек: $tx3");
                    $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent' WHERE Ид = $id");
                    break;
        */
        break;
    case 'home':
        switch ($payload[2]) 
        {
            case 'main':
                $vk->sendButton($user_id, $home['Вход'], $button['HOME']['MAIN']);
                $db->query("UPDATE `Several_user` SET `Статус` = '?s' WHERE `vk_id` = ?i", 'Поселение', $user_id);
                break;
            case 'next':
                if (empty($home['Уровень']))
                    endReply("У вас уникальное жилье.");
                $next_home = $db->query("SELECT * FROM `Дома` WHERE `Уровень` = ?i", $home['Уровень'] + 1)->fetch_assoc();
                if (empty($next_home))
                    endReply("У вашего жилья уже максимальный уровень.");
                $vk->sendButton($user_id, "Жильё следующего уровня - {$next_home['Название']}.\nСтоимость улучшения составит {$next_home['Стоимость']}.", $button['HOME']['NEXT']);
                break;
            case 'ok':
                $next_home = $db->query("SELECT * FROM `Дома` WHERE `Уровень` = ?i", $home['Уровень'] + 1)->fetch_assoc();
                if (empty($next_home))
                    endReply("У вашего жилья максимальный уровень");
                if ($user['Инвентарь']['Кошелёк'] < $next_home['Стоимость'])
                    endReply("У вас недостаточно средств.");
                $user['Инвентарь']['Кошелёк'] -= $next_home['Стоимость'];
                $user['Жильё'][$user['Локация']] = $next_home['Название'];
                $vk->sendButton($user_id, "С новосельем!", $button['HOME']['MAIN']);
                updateUser($user, ['Инвентарь', 'Жильё']);
                break;  
            case 'about';
                $vk->reply($home['Описание']);
                break;
            case 'relax':
                if ($user['Характеристики']['Бодрость'] < $user['Навыки']['Выносливость'] * 3)
                    endReply("Вы не устали.");
                $vk->sendButton($user_id, $home['Отдых'], $button['HOME']['RELAX']);
                $db->query("UPDATE `Several_user` SET `Статус` = '?s' WHERE `vk_id` = ?i", 'Отдых дома', $user_id);
                break;
        }
        break;
    case 'storage':
        switch ($payload[2])
        {
            case 'main':
                $vk->sendButton($user_id, "Это ваше хранилище. Здесь вы можете оставить ненужные вещи или забрать те, которые оставили раньше.", $button['STORAGE']['MAIN']);
                break;
            case 'infa':
                foreach ($user['Хранилище'][$user['Локация']] as $key => $value) 
                {
                    if (epmty($value))
                        continue;
                    if ($key == 'Рюкзак')
                        $text .= "\nРюкзаки:\n";
                    else
                        $text .= "\n$key:\n";
                    foreach ($value as $key_2 => $value_2)
                    {
                        if (is_numeric($key_2))
                            $text .= $key_2 + 1 .". $value_2\n";
                        else
                            $text .= "$key_2 ($value_2)\n";
                    }
                    $text .= "Вмещается: {$storage[$payload[4]]}\n";
                }
                if (empty($text))
                    $vk->reply("В вашем хранилище в этом поселении ничего нет.");
                else
                    $vk->reply("Вот содержимое вашего хранилища в этом поселении.\n$text");
                break;
            case 'next':
                if (epmty($storage['Уровень']))
                    endReply("У вас уникальное хранилище.");
                $next_strg = $db->query("SELECT * FROM `Хранилище` WHERE `Уровень` = ?i", $storage['Уровень'] + 1)->fetch_assoc();
                if (empty($next_strg))
                    endReply("У вашего хранилища уже максимальный уровень");   
                $vk->sendButton($user_id, "Хранилище следующего уровня - {$next_strg['Название']}\nСтоимость улучшения составит {$next_strg['Стоимость']}", $button['STORAGE']['NEXT']);
                break;
            case 'ok':
                $next_strg = $db->query("SELECT * FROM `Хранилище` WHERE `Уровень` = ?i", $storage['Уровень'] + 1)->fetch_assoc();
                if (empty($next_strg))
                    endReply("У вашего хранилища максимальный уровень");
                if ($user['Инвентарь']['Кошелёк'] < $next_strg['Стоимость'])
                    endReply("У вас недостаточно средств.");
                $user['Инвентарь']['Кошелёк'] -= $next_strg['Стоимость'];
                $user['Хранилище']['Города'][$user['Локация']] = $next_strg['Название'];
                $vk->sendButton($user_id, "Больше места!", $button['STORAGE']['MAIN']);
                updateUser($user, ['Инвентарь', 'Хранилище']);
                break;
            case 'take':
                switch ($payload[3])
                {
                    case 'main':
                        $db->query("UPDATE `Several_user` SET `Меню` = ?n, `RAM` = ?n WHERE `vk_id` = ?i", NULL, NULL, $user_id);
                        $vk->sendButton($user_id, "Что вы хотите забрать из хранилища?", $button['STORAGE']['TAKE']['MAIN']);
                        break;
                    case 'list':
                        if (empty($user['Хранилище'][$user['Локация']][$payload[4]]))
                        {
                            if ($payload[4] == 'Полезное' OR $payload[4] == 'Щиты' OR $payload[4] == 'Рюкзак')
                                endReply("У вас в хранилище отсутствуют $message.");
                            else
                                endReply("У вас в хранилище отсутствует $message.");
                        }
                        foreach ($user['Хранилище'][$user['Локация']][$payload[4]] as $key => $value) 
                        {
                            $i++;
                            if ($payload[4] != 'Полезное' AND $payload[4] != 'Щиты')
                                $text .= "$i. $value\n";
                            else
                                $text .= "$i. $key ($value)\n";
                        }
                        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", "property storage take {$payload[4]}", $user_id);
                        $vk->sendButton($user_id, "$text\nВведите номер нужного вам предмета.", $button['STORAGE']['TAKE']['BACK']);
                        break;
                    case 'this':
                        if ($menu[3] == 'Щиты' OR $menu[3] == 'Полезное')
                        {
                            if ($backpack[$menu[3]] >= array_sum($user['Инвентарь'][$menu[3]]))
                                endReply("У вас в инвентаре недостаточно места.");
                            $user['Инвентарь'][$menu[3]][$user['RAM']]++;
                            $user['Хранилище'][$menu[3]][$user['RAM']]--;
                            if ($user['Хранилище'][$menu[3]][$user['RAM']] == 0)
                                unset($user['Хранилище'][$menu[3]][$user['RAM']]);
                        }
                        else
                        {
                            if ($user['RAM'] == 'Рюкзак')
                            {
                                $new_backpack = $db->query("SELECT * FROM `Рюкзак` WHERE `Название` = '?s'", $user['Хранилище'][$menu[3]][$user['RAM']])->fetch_assoc();
                                foreach (['Щиты', 'Аптечки', 'Бомбы', 'Полезное', 'Лут'] as $key => $value)
                                    if (array_sum($user['Инвентарь'][$value]) > $new_backpack[$value])
                                        endReply("У вас в рюкзаке слишком много вещей. Они не влезут в тот, который вы хотите забрать.");
                            }
                            list($user['Инвентарь'][$menu[3]], $user['Хранилище'][$menu[3]][$user['RAM']]) = [$user['Хранилище'][$menu[3]][$user['RAM']], $user['Инвентарь'][$menu[3]]];
                        }
                        updateUser($user, ['Инвентарь', 'Хранилище']);    
                        $db->query("UPDATE `Several_user` SET `Меню` = ?n, `RAM` = ?n WHERE `vk_id` = ?i", NULL, NULL, $user_id);
                        $vk->sendButton($user_id, "Хотите забрать ещё что-нибудь из хранилища?", $button['STORAGE']['TAKE']['MAIN']);
                        break;
                }
                break;
            case 'put':
                switch ($payload[3])
                {
                    case 'main':
                        foreach ($button['STORAGE']['PUT']['MAIN'][0] as $key => &$value)
                            $value[2] = $user['Инвентарь'][$value[1][4]];
                        $button['STORAGE']['PUT']['MAIN'][1][0][2] = $user['Инвентарь']['Рюкзак'];
                        $db->query("UPDATE `Several_user` SET `Меню` = ?n, `RAM` = ?n WHERE `vk_id` = ?i", NULL, NULL, $user_id);
                        $vk->sendButton($user_id, "Что вы хотите оставить в хранилище?", $button['STORAGE']['PUT']['MAIN']);
                        break;
                    case 'list':
                        if ($payload[4] != 'Полезное' AND $payload[4] != 'Щиты')
                        {
                            $item = $db->query("SELECT * FROM ?f WHERE `Название` = '?s'", $payload[4], $user['Инвентарь'][$payload[4]])->fetch_assoc();
                            $button['STORAGE']['PUT']['THIS'][0][0][2] .= $item['Падеж'];
                            $button['STORAGE']['PUT']['THIS'][0][0][1][4] .= $payload[4];
                            $db->query("UPDATE `Several_user` SET `RAM` = '?s' WHERE `vk_id` = ?i", $payload[4], $user_id);
                            $vk->sendButton($user_id, "Вы хотите оставить в хранилище этот предмет?", $button['STORAGE']['PUT']['THIS']);
                        }
                        else
                        {
                            foreach ($user['Инвентарь'][$payload[4]] as $key => $value)
                                $text .= "$key ($value)\n";
                            $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", "property storage put {$payload[4]}", $user_id);
                            $vk->reply("$text\nВведите номер нужного вам предмета.");
                        }
                        break;
                    case 'this':
                        if (empty($menu) AND count($user['Хранилище'][$user['RAM']]) < $storage[$user['RAM']])
                        {
                            if ($user['RAM'] == 'Рюкзак')
                            {
                                $startpack = $db->query("SELECT * FROM `Рюкзак` WHERE `Название` = '?s'", $new_user['Рюкзак'])->fetch_assoc();
                                foreach (['Щиты', 'Аптечки', 'Бомбы', 'Полезное', 'Лут'] as $key => $value)
                                    if (array_sum($user['Инвентарь'][$value]) > $startpack[$value])
                                        endReply("У вас в рюкзаке слишком много вещей. Оставьте сначала их.");
                            }
                            $user['Хранилище'][$user['RAM']][] = $user['Инвентарь'][$user['RAM']];
                            $user['Инвентарь'][$user['RAM']] = $new_user['Инвентарь'][$user['RAM']];
                        }
                        elseif (!empty($menu) AND count($user['Хранилище'][$menu[3]]) < $storage[$menu[3]])
                        {
                            $user['Хранилище'][$menu[3]][$user['RAM']]++;
                            $user['Инвентарь'][$menu[3]][$user['RAM']]--;
                            if ($user['Инвентарь'][$menu[3]][$user['RAM']] == 0)
                                unset($user['Инвентарь'][$menu[3]][$user['RAM']]);
                        }
                        else
                            endReply("У вас в хранилище недостаточно места.");
                        updateUser($user, ['Инвентарь', 'Хранилище']);    
                        $db->query("UPDATE `Several_user` SET `Меню` = ?n, `RAM` = ?n WHERE `vk_id` = ?i", NULL, NULL, $user_id);
                        $vk->sendButton($user_id, "Хотите оставить ещё что-нибудь в хранилище?", $button['STORAGE']['PUT']['MAIN']);
                        break;
                }
                break;
        }
        break;
    case NULL:
        switch ($menu[1])
        {
            case 'business':
                switch ($menu[2])
                {
                    case 'expand':
                        $buy_biz = $db->query("SELECT * FROM `Several_type_build` WHERE `Тип` = '?s' AND `Местность` LIKE '?s' ORDER BY sys_id ASC", 'Бизнес', "%{$town['Местность']}%"); // Вытягиваем весь список построек.
                        for ($i = 1; $biz = $buy_biz->fetch_assoc(); $i++)
                        { 
                            if ($message != $i)
                                continue;
                            if ($db->query("SELECT * FROM `Several_build` WHERE `Владелец` = ?i AND `Локация` = '?s' AND `Название` = '?s'", $user['sys_id']. $user['Локация'], $biz['Название'])->getNumRows() != 0)
                                endReply("У вас уже есть". mb_strtolower($biz['Название']) ."в этом поселении");
                            $button['BUSINESS']['BUY'][0][0][2] .= $i;
                            $vk->sendButton($user_id, "{$biz['Название']}.\n{$biz['Описание']}\nСтоимость - {$biz['Стоимость']}.\nПрибыль - {$biz['Прибыль']}.", $button['BUSINESS']['BUY']);
                            $db->query("UPDATE `Several_user` SET `RAM` = '?s' WHERE `vk_id` = ?i", $biz['Название'], $user_id);
                            break;
                        }
                        break;
                    case 'sell':
                        switch ($menu[2])
                        {
                            case 'list':
                                $user['RAM'] = NULL;
                                $user_biz = $db->query("SELECT `sys_id` FROM `Several_build` WHERE `Локация` = '?s' AND `Владелец` = ?i ORDER BY `Прибыль` ASC", $user['Локация'], $user['sys_id']); // Вытягиваем весь список             
                                $list_biz = explode(" ", $message);
                                for ($i = 1; $biz = $user_biz->fetch_assoc(); $i++)
                                    if (in_array($i, $list_biz))
                                        $user['RAM']['list'][] = $biz['sys_id'];
                                if (empty($user['RAM']))
                                    endReply("Укажите корректные номера.");
                                $list_offers = $db->query("SELECT `Содержание` FROM `Решения` WHERE `Тип` = '?s' AND `Отправитель` = ?i AND `Локация` = '?s'", 'Продажа бизнеса', $user['sys_id'], $user['Локация']);
                                while ($offer = $list_offers->getOne())
                                {
                                    $offer = json_decode($offer);
                                    $result = array_intersect($offer['list'], $user['RAM']['list']);
                                    if (!empty($result)) 
                                    {
                                        foreach ($result as $value)
                                        {
                                            $biz_already = $db->query("SELECT * FROM `Several_build` WHERE `sys_id` = ?i", $value)->fetch_assoc();
                                            $text .= "{$biz_already['Название']}, прибыль - {$biz_already['Прибыль']}.\n";
                                        }
                                        endReply("Вы уже выставили на продажу следующие бизнесы:\n{$text}Вы можете отменить это в разделе \"Мои предложения\".");
                                    }
                                }
                                updateUser($user, ['RAM']);
                                $button['SELL']['NEXT'][0][0][1][] = 'summ';
                                $vk->sendButton($user_id, "Вы выбрали бизнесы под номерами ". implode(", ", $list_biz) .". Подтвердить выбор?", $button['SELL']['NEXT']);
                                break;
                            case 'summ':
                                $user['RAM'] = json_decode($user['RAM'], TRUE);
                                if ($message <= 0)
                                    endReply("Введите корректное число.");
                                $summ = round($message, 2);
                                $user['RAM']['summ'] = $summ;
                                updateUser($user, ['RAM']);
                                $button['SELL']['NEXT'][0][0][1][] = 'person';
                                $vk->sendButton($user_id, "Вы хотите продать выбранные бизнесы за $summ.", $button['SELL']['NEXT']);
                                break;
                            case 'person':
                                $user['RAM'] = json_decode($user['RAM'], TRUE);
                                $get_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $message)->fetch_assoc();
                                if (empty($get_user))
                                    endReply("Такого игрока не существует. Введите корректный ID.");
                                $user['RAM']['person'] = $message;
                                updateUser($user, ['RAM']);
                                $button['SELL']['NEXT'][0][0][1][] = 'ok';
                                $vk->sendButton($user_id, "Вы хотите продать выбранные бизнесы за {$user['RAM']['summ']} игроку по имени {$get_user['vk_name']}.", $button['SELL']['NEXT']);
                                break;
                        }
                        break;
                    case 'offers':
                        switch ($menu[2])
                        {
                            case 'list':
                                $list_offers = $db->query("SELECT * FROM `Решения` WHERE `Тип` = '?s' AND `Получатель` = ?i, `Локация` = '?s'", 'Продажа бизнеса', $user['sys_id'], $user['Локация']);
                                for ($i = 1; $offer = $list_offers->fetch_assoc(); $i++)
                                {
                                    if ($message != $i)
                                        continue;
                                    $offer['Содержание'] = json_decode($offer['Содержание']);
                                    $sell_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $offer['Отправитель']);
                                    $text = "\n$i. Игрок {$sell_user['vk_name']} предлагает вам купить следующие бизнесы за {$offer['Содержание']['summ']}:\n";
                                    foreach ($offer['Содержание']['list'] as $key => $value)
                                    {
                                        $biz = $db-query("SELECT * FROM `Several_build` WHERE `sys_id` = ?i", $value)->fetch_assoc();
                                        $text .= "{$biz['Название']}, прибыль - {$biz['Прибыль']}.\n";
                                    }
                                    $db->query("UPDATE `Several_user` SET `RAM` = ?i WHERE `vk_id` = ?i", $offer['sys_id'], $user_id);
                                    $vk->sendButton($user_id, "Вы выбрали это предложение для согласия или отказа.\n$text", $button['OFFERS']['QUESTION']);
                                    break;
                                }
                                break;
                            case 'my':
                                $list_offers = $db->query("SELECT * FROM `Решения` WHERE `Тип` = '?s' AND `Получатель` = ?i, `Локация` = '?s'", 'Продажа бизнеса', $user['sys_id'], $user['Локация']);
                                for ($i = 1; $offer = $list_offers->fetch_assoc(); $i++)
                                {
                                    if ($message != $i)
                                        continue;
                                    $offer['Содержание'] = json_decode($offer['Содержание']);
                                    $get_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $offer['Получатель']);
                                    $text .= "\n$i. Вы предложили игроку {$get_user['vk_name']} купить следующие бизнесы за {$offer['Содержание']['summ']}:\n";
                                    foreach ($offer['Содержание']['list'] as $key => $value)
                                    {
                                        $biz = $db-query("SELECT * FROM `Several_build` WHERE `sys_id` = ?i", $value)->fetch_assoc();
                                        $text .= "{$biz['Название']}, прибыль - {$biz['Прибыль']}.\n";
                                    }
                                    $db->query("UPDATE `Several_user` SET `RAM` = ?i WHERE `vk_id` = ?i", $offer['sys_id'], $user_id);
                                    $vk->sendButton($user_id, "Если хотите, можете отменить это предложение.\n$text", $button['OFFERS']['CANCEL']);
                                    break;
                                }
                                break;
                        }
                        break;
                }
                break;
            case 'storage':
                switch ($menu[2])
                {
                    case 'take':
                        foreach ($user['Хранилище'][$user['Локация']][$menu[3]] as $key => $value) 
                        {
                            $i++;
                            if ($i != $ex_mess[0])
                                continue;
                            $db->query("UPDATE `Several_user` SET `RAM` = '?s' WHERE `vk_id` = ?i", $key, $user_id);
                            if ($menu[3] != 'Полезное' AND $menu[3] != 'Щиты')
                                $item = $db->query("SELECT * FROM ?f WHERE `Название` = '?s'", $menu[3], $value)->fetch_assoc();
                            else
                                $item = $db->query("SELECT * FROM ?f WHERE `Название` = '?s'", $menu[3], $key)->fetch_assoc();
                            $button['STORAGE']['TAKE']['THIS'][0][0][2] .= $item['Падеж'];
                            $vk->sendButton($user_id, "Вы хотите забрать {$item['Падеж']}?", $button['STORAGE']['TAKE']['THIS']);
                            break;
                        }
                        break;
                    case 'put':
                        foreach ($user['Инвентарь'][$user['Локация']][$menu[3]] as $key => $value) 
                        {
                            $i++;
                            if ($i != $ex_mess[0])
                                continue;
                            $db->query("UPDATE `Several_user` SET `RAM` = '?s' WHERE `vk_id` = ?i", $key, $user_id);
                            $item = $db->query("SELECT * FROM ?f WHERE `Название` = '?s'", $menu[3], $key)->fetch_assoc();
                            $button['STORAGE']['PUT']['THIS'][0][0][2] .= $item['Падеж'];
                            $vk->sendButton($user_id, "Вы хотите оставить {$item['Падеж']}?", $button['STORAGE']['PUT']['THIS']);
                            break;
                        }
                        break;
                }
                break;
        }
}

?>