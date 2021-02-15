<?php

/***КНОПКИ***/

$button['Банк'] = [
    [['text', ['bank', 'Пополнить'], "Пополнить счёт", "green"],
    ['text', ['bank', 'Снять'], "Снять деньги", "green"]],
    [['text', ['bank', 'Информация', 'main'], "Информация", "blue"],
    ['text', ['bank', 'Настройки'], "Настройки", "blue"],
    ['text', ['bank', 'Перевод'], "Перевести", "blue"]],
    [['text', ['centre', 'main'], "Центральная площадь", "white"]]];
    
$button['Банк | Информация'] = [
    [['text', ['bank', 'infa', 'Пополнение'], "Пополнения счёта", "green"],
    ['text', ['bank', 'infa', 'Снятие'], "Снятия со счёта", "green"]],
    [['text', ['bank', 'infa', 'Получатель', 'Отправитель', 'принятые'], "Принятые переводы", "blue"],
    ['text', ['bank', 'infa', 'Отправитель', 'Получатель', 'отправленные'], "Отправленные переводы", "blue"]],
    [['text', ['bank', 'infa', 'transfers'], "Все переводы", "red"],
    ['text', ['bank', 'infa', 'banking'], "Все операции со счётом", "red"]],
    [['text', ['bank', 'main'], "Вернуться в банк", "white"]]];

$button['Банк | Настройки'] = [
    [['text', ['bank', 'type'], "Тип банковского аккаунта", "green"]],
    [['text', ['bank', 'list', 'black'], "Чёрный список", "blue"],
    ['text', ['bank', 'list', 'white'], "Белый список", "blue"]],
    [['text', ['bank', 'main'], "Вернуться в банк", "white"]]];

$button['Банк | Настройки | Чёрный список'] = [
    [['text', ['bank', 'add', 'black'], "Добавить в чёрный список", "green"]],
    [['text', ['bank', 'delete', 'black'], "Убрать из чёрного списка", "blue"]]];

$button['Банк | Настройки | Белый список'] = [
    [['text', ['bank', 'add', 'white'], "Добавить в белый список", "green"]],
    [['text', ['bank', 'delete', 'white'], "Убрать из белого списка", "blue"]]];

$button['Банк | Настройки | Тип аккаунта'] = [
    [['text', ['bank', 'open'], "Открытый", "green"]],
    [['text', ['bank', 'close'], "Закрытый", "blue"]]];

$button['Банк | Завершить'] = [[['text', ['bank', 'Основной'], "Завершить и вернуться в банк", "red"]]];

/***ОСНОВНОЙ КОД***/

$limit = $user['Навыки']['Уровень'] * LIMIT_BANK * $user['Паспорт']['Время проживания'];
if ($user['Паспорт']['Время проживания'] < 3)
    $limit = 0;
$user['Банк'] = round($user['Банк'], 2);
$bank = abs($user['Банк']);

switch ($payload[1])
{ 
    case 'Основной':
        $vk->sendButton($user_id, "Вы в банке.\nЧего вы хотите?", $button['Банк']);
        $db->query("UPDATE `Several_user` SET `Меню` = ?n WHERE `vk_id` = ?i", NULL, $user_id);
        break;
    case 'Войти':
        $vk->sendButton($user_id, "Подходя к банку, вы видите, как вас встречают с широкой улыбкой!\nЧего вы хотите?", $button['Банк']);
        break;
    case 'Пополнить':
        if ($user['Банк'] > 0)
            $vk->sendButton($user_id, "Вы хотите снять часть вклада со счёта.\nКошелёк: [{$user['Инвентарь']['Кошелёк']}]\nНа счету: $bank\nКредитный лимит: $limit\nВведите сумму, которую хотите снять.", $button['Банк | Завершить']);
        elseif ($user['Банк'] == 0)
            $vk->sendButton($user_id, "Вы хотите взять кредит. Процентная ставка составляет ". PERCENT[$user['Аккаунт']['Тип']]['credit'] ."% в год.\nКошелёк: [{$user['Инвентарь']['Кошелёк']}]\nКредитный лимит: $limit\n\nВведите сумму, которую хотите взять.", $button['Банк | Завершить']);
        elseif ($user['Банк'] < 0) 
            $vk->sendButton($user_id, "Вы хотите увеличить кредит.\nКошелёк: [{$user['Инвентарь']['Кошелёк']}]\nДолг: $bank\nКредитный лимит: $limit\nВведите сумму, которую желаете взять.", $button['Банк | Завершить']);
        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'bank credit', $user_id);
        break;
    case 'Снять':
        if ($user['Банк'] > 0)
            $vk->sendButton($user_id, "Вы хотите пополнить счёт, отлично! Процентная ставка составляет ". PERCENT[$user['Аккаунт']['Тип']]['depozit'] ."% в год.\nКошелёк: [{$user['Инвентарь']['Кошелёк']}]\nВклад: $bank\nВведите сумму, которую хотите вложить.", $button['Банк | Завершить']);
        elseif ($user['Банк'] == 0)
            $vk->sendButton($user_id, "Вы хотите открыть счёт, отлично! Процентная ставка составляет ". PERCENT[$user['Аккаунт']['Тип']]['depozit'] ."% в год.\nКошелёк: [{$user['Инвентарь']['Кошелёк']}]\n\nВведите сумму которую хотите вложить.", $button['Банк | Завершить']);
        elseif ($user['Банк'] < 0)
            $vk->sendButton($user_id, "Вы хотите погасить долг, отлично!\nКошелёк: [{$user['Инвентарь']['Кошелёк']}]\nДолг: $bank\nВведите сумму, которую желаете вернуть.", $button['Банк | Завершить']);
        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'bank depozit', $user_id);
        break;
    case 'list':
        if (!empty($user['Аккаунт'][$payload[2]]))
        {
            foreach ($user['Аккаунт'][$payload[2]] as $key => $value)
            {
                $wb_user = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $value)->fetch_assoc();
                $text .= $key + 1 .". {[id{$wb_user['vk_id']}|{$wb_user['vk_name']}] [{$wb_user['sys_id']}]";
            }
        }
        else
            $text = "Ваш $message пуст.";
        $vk->sendButton($user_id, $text, $button[mb_strtoupper($payload[2])], TRUE);
        break;
    case 'add':
    case 'delete':
        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", "bank {$payload[1]} {$payload[2]}", $user_id);
        $vk->reply("Введите ID пользователя.");
        break;
    case 'type':
        $vk->sendButton($user_id, "Открытый тип счёта: отправлять вам переводы могут все, кто не находится у вас в черном списке.\n\nЗакрытый аккаунт: отправлять вам переводы могут только те, кто находится у Вас в белом списке.", $button['TYPE'], TRUE);
        break;
    case 'open':
    case 'close':
        $user['Аккаунт']['Счёт'] = $message;
        updateUser($user, ['Аккаунт']);
        $vk->reply("Теперь у вас $message тип счёта.");
        break;
    case 'settings':
        $vk->sendButton($user_id, "Здесь можно изменить: тип счёта, белый список, чёрный список.\n\nТекущий тип счёта: {$user['Аккаунт']['Счёт']}", $button['SETTINGS']);
        break;
    case 'infa:':
        switch ($payload[2])
        {
            case 'main':
                if ($user['Банк'] > 0)
                    $text = "Ваш вклад составляет $bank с учетом процентов.\nВаш процент по вкладу составляет ". PERCENT[$user['Аккаунт']['Тип']]['depozit'] ."% в год.\nЕжечасный доход от депозита: ". round($bank * (PERCENT[$user['Аккаунт']['Тип']]['depozit']/100/YEAR_DAYS/24), 2) .".";
                elseif ($user['Банк'] == 0)
                    $text = "В этом банке у вас нет взятых или выданых займов.\nКредитный лимит: $limit";
                elseif ($user['Банк'] < 0)
                    $text = "Ваш долг составляет $bank с учетом процентов.\nВзымаемый процент по долгу составляет ". PERCENT[$user['Аккаунт']['Тип']]['credit'] ."% в год.\nЕжечасный рост кредита: ". round($bank * (PERCENT[$user['Аккаунт']['Тип']]['credit']/100/YEAR_DAYS/24), 2) .".";
                $vk->sendButton($user_id, "$text\nВ меню информации вам доступны списки ваших банковских операций, совершённых на этой неделе. За информацией об операциях, совершённых ранее, обращайтесь к администрации паблика.");
                break;
            case 'Пополнение':
            case 'Снятие':
                $list_trans = $db->query("SELECT * FROM `Транзакции` WHERE `Тип` = '?s' AND `Отправитель` = ?i", $payload[2], $user['sys_id']);
                for ($i = 1; $trans = $list_trans->fetch_assoc(); $i++)
                    $text .= date('d.m.Y в H:i:s', $trans['Время']) ."\nСумма - {$trans['Сумма']}.\n\n";
                $vk->reply("Вот ваши $message, совершённые на этой неделе:\n\n$text");
                break;
            case 'Получатель':
            case 'Отправитель':
                $list_trans = $db->query("SELECT * FROM `Транзакции` WHERE `Тип` = '?s' AND ?f = ?i", 'Перевод', $payload[2], $user['sys_id']);
                for ($i = 1; $trans = $list_trans->fetch_assoc(); $i++)
                {
                    $user_other = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $trans[$payload[3]])->fetch_assoc();
                    $text .= date('d.m.Y в H:i:s', $trans['Время']) ."\nСумма - {$trans['Сумма']}.\n{$payload[3]} - [id{$user_other['vk_id']}|{$user_other['vk_name']}] [{$user_other['sys_id']}].\n\n";
                }
                $vk->reply("Вот переводы, {$payload[4]} вами на этой неделе:\n\n$text");
                break;
            case 'transfers':
                $list_trans = $db->query("SELECT * FROM `Транзакции` WHERE `Тип` = '?s' AND (`Получатель` = ?i OR `Отправитель` = ?i)", 'Перевод', $user['sys_id'], $user['sys_id']);
                for ($i = 1; $trans = $list_trans->fetch_assoc(); $i++)
                {
                    $user_pol = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $trans['Отправитель'])->fetch_assoc();
                    $user_otp = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $trans['Получатель'])->fetch_assoc();
                    $text .= date('d.m.Y в H:i:s', $trans['Время']) ."\nСумма - {$trans['Сумма']}.\nОтправитель - [id{$user_otp['vk_id']}|{$user_otp['vk_name']}] [{$user_otp['sys_id']}].\nПолучатель - [id{$user_pol['vk_id']}|{$user_pol['vk_name']}] [{$user_pol['sys_id']}].\n\n";
                }
                $vk->reply("Вот ваши переводы этой недели:\n\n$text");
                break;
            case 'banking':
                $list_trans = $db->query("SELECT * FROM `Транзакции` WHERE `Отправитель` = ?i AND (`Тип` = '?s' OR `Тип` = '?s')", $user['sys_id'], 'Пополнение', 'Снятие');
                for ($i = 1; $trans = $list_trans->fetch_assoc(); $i++)
                    $text .= date('d.m.Y в H:i:s', $trans['Время']) ."\nСумма - {$trans['Сумма']}.\nТип - {$trans['Тип']}\n\n";
                $vk->reply("Вот ваши операции со счётом, совершённые на этой неделе:\n\n$text");
                break;
        }
        break;
    case 'transfer':
        $vk->sendButton($user_id, "Вы хотите передать часть своих денег другому игроку, отлично!\nКошелёк: [{$user['Инвентарь']['Кошелёк']}]\nВведите сумму, которую хотите передать, а в следующем сообщении введите id игрока, которому хотите передать.", $button['END']);
        $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'bank transfer sum', $user_id);
        break;
    case NULL:
        $val = round($message,  2);
        if ($val <= 0 AND $menu[2] != 'id')
            endReply("Введите корректное число.");
        switch ($menu[1])
        {
            case 'depozit':
                if ($val > $user['Инвентарь']['Кошелёк'])
                    endReply("У вас недостаточно денег");
                $user['Инвентарь']['Кошелёк'] -= $val;
                $user['Банк'] += $val;
                $trans = ['Тип' => 'Пополнение', 'Время' => time(), 'Сумма' => $val, 'Локация' => $user['Локация'], 'Отправитель' => $user['sys_id'], 'Получатель' => $user['sys_id']];
                $db->query("INSERT INTO `Транзакции` SET ?A['?s', ?i, ?d, '?s', ?i, ?i]", $trans);
                $db->query("UPDATE `Several_user` SET `Банк` = ?d WHERE `vk_id` = ?i", $user['Банк'], $user_id);
                updateUser($user, ['Инвентарь']);
                if ($user['Банк'] > 0)   
                    $vk->reply("Вы увеличили свой вклад на $val!\nКошелёк: {$user['Инвентарь']['Кошелёк']}.\nВклад: $bank.\n\nМожете ввести сумму ещё раз или покинуть меню.");
                elseif ($user['Банк'] == 0)
                    $vk->reply("Вы выплатили свой долг.\nКошелёк: {$user['Инвентарь']['Кошелёк']}.\n\nМожете ввести сумму ещё раз или покинуть меню.");
                elseif ($user['Банк'] < 0)
                    $vk->reply("Вы погасили часть долга банку!\nКошелёк: {$user['Инвентарь']['Кошелёк']}.\nДолг: $bank.\n\nМожете ввести сумму ещё раз или покинуть меню.");
                break;
            case 'credit':
                if ($val > ($limit + $user['Банк']))
                {
                    if ($user['Банк'] < 0)
                        endReply("Вы не можете увеличить свой кредит на такую сумму.\nВаш кредитный лимит составляет $limit.\nТекущий долг: $bank.");
                    else
                        endReply("Вы не можете снять такую сумму со счёта.\nВаш кредитный лимит составляет $limit.\nСостояние вашего счёта: $bank.");
                }
                $user['Банк'] -= $val;
                $user['Инвентарь']['Кошелёк'] += $val;
                $trans = ['Тип' => 'Снятие', 'Время' => time(), 'Сумма' => $val, 'Локация' => $user['Локация'], 'Отправитель' => $user['sys_id'], 'Получатель' => $user['sys_id']];
                $db->query("INSERT INTO `Транзакции` SET ?A['?s', ?i, ?d, '?s', ?i, ?i]", $trans);
                $db->query("UPDATE `Several_user` SET `Банк` = ?d WHERE `vk_id` = ?i", $user['Банк'], $user_id);
                updateUser($user, ['Инвентарь']);
                if ($user['Банк'] > 0)
                    $vk->reply("Вы уменьшили свой вклад на $val!\nКошелёк: {$user['Инвентарь']['Кошелёк']}.\nВклад: $bank.\n\nМожете ввести сумму ещё раз или покинуть меню.");
                elseif ($user['Банк'] == 0)
                    $vk->reply("Вы сняли свой вклад со счёта.\nКошелёк: {$user['Инвентарь']['Кошелёк']}.\nКредитный лимит: $limit.\nВведите сумму, которую хотите снять.");
                elseif ($user['Банк'] < 0)
                    $vk->reply("Вы увеличили свой долг на $val (под 10% годовых)!\nКошелёк: {$user['Инвентарь']['Кошелёк']}.\nДолг: $bank.\nКредитный лимит: $limit\n\nМожете ввести сумму ещё раз или покинуть меню.");
                break;
            case 'transfer':
                if ($menu[2] == 'sum')
                {
                    $last = $db->query("SELECT * FROM `Переводы` WHERE `Отправитель` = ?i ORDER BY `Время` DESC")->fetch_assoc();
                    if ($user['Инвентарь']['Кошелёк'] < $val)
                        endReply("У вас нет с собой столько денег.");
                    $db->query("UPDATE `Several_user` SET `Меню` = '?s', `RAM` = ?d WHERE `vk_id` = ?i", 'bank transfer id', $val, $user_id);
                }
                elseif ($menu[2] == 'id')
                {
                    if (!is_numeric($user['RAM']) OR $user['RAM'] <= 0)
                    {
                        $vk->sendMessage(ID_HELP_CODER, "В банке баг с переводом. \nОшибочная сумма: {$user['RAM']}.\nОтправитель: [id{$user['vk_id']}|{$user['vk_name']}] [{$user['sys_id']}].");
                        endReply("Произошёл баг с некорректной суммой перевода. Администрации отправлен репорт.");
                    }
                    $user_pol = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $val)->fetch_assoc();
                    if (empty($user_pol))
                        endReply("Такого игрока не существует.");
                    if ($user_pol['sys_id'] == $user['sys_id'])
                        endReply("Нельзя переводить деньги самому себе.");
                    $user_pol = decodeUser($user_pol);
                    if ((!in_array($val, $user_pol['Аккаунт']['white']) AND $user_pol['Аккаунт']['Счёт'] = 'закрытый') OR (in_array($val, $user_pol['Аккаунт']['black']) AND $user_pol['Аккаунт']['Счёт'] = 'открытый'))
                        endReply("Вы не можете переводить деньги этому пользователю.");
                    $user['Инвентарь']['Кошелёк'] -= $val;
                    $user_pol['Банк'] += $user['RAM'];
                    updateUser($user, ['Инвентарь']);
                    $db->query("UPDATE `Several_user` SET `Банк` ?d, `Меню` = ?n WHERE `vk_id` = ?i", $user_pol['Банк'], NULL, $user_id);
                    $vk->sendButton($user_id, "Вы отправили {$user['RAM']}.\nПолучатель: [id{$user_pol['vk_id']}|{$user_pol['vk_name']}] [{$user_pol['sys_id']}].", $button['MAIN']);
                    $vk->sendMessage($user_pol['Ид'], "Вам пришло {$user['RAM']} на счёт. Можель:ете забрать эти деньги в банке.\nОтправитель: [id{$user['vk_id']}|{$user['vk_name']}] [{$user['sys_id']}].");
                    $vk->sendMessage(VK_LOG_TECH, "Перевод.\nСумма: {$user['RAM']}.\nПолучат [id{$user_pol['vk_id']}|{$user_pol['vk_name']}] [{$user_pol['sys_id']}].\nОтправитель: [id{$user['vk_id']}|{$user['vk_name']}] [{$user['sys_id']}].");
                }
                break;
            case 'add':
                $user_add = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $val)->fetch_assoc();
                if (empty($user_add))
                    endReply("Такого игрока не существует.");
                if ($user_add['sys_id'] == $user['sys_id'])
                    endReply("Нельзя $message самого себя.");
                $user['Аккаунт'][$menu[2]][] = $user_add['sys_id'];
                updateUser($user, ['Аккаунт']);
                $vk->reply("Вы добавили пользователя [id{$user_add['vk_id']}|{$user_add['vk_name']}] [{$user_add['sys_id']}] в {$ex_mess[2]} список.");
                break;
            case 'delete':
                $num = array_search($val, $user['Аккаунт'][$menu[2]]);
                if (empty($num))
                    endReply("Нельзя $message того, кого в нём нет.");
                $user_del = $db->query("SELECT * FROM `Several_user` WHERE `sys_id` = ?i", $val)->fetch_assoc();
                unset($user['Аккаунт'][$menu[2]][$num]);
                updateUser($user, ['Аккаунт']);
                $vk->reply("Вы убрали пользователя [id{$user_del['vk_id']}|{$user_del['vk_name']}] [{$user_del['sys_id']}] из {$ex_mess[2]} списка.");
                break;
        }
        break;
}

?>