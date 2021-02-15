<?php

/***КНОПКИ***/

$button['CENTRE'] = [
    [['text', ['property', 'entrance'], "Недвижимость", "green"],
    ['text', ['shop', 'main'], "Магазин", "green"]],
    [['text', ['bank', 'entrance'], "Банк", "red"],
    ['text', ['work', 'main'], "Работа", "red"],
    ['text', ['bar', 'entrance'], "Бар", "red"]],
    [['text', ['centre', 'suburb'], "Город", "blue"]]];

$button['SUB_MANAGE'] = [[['text', ['manage', 'main'], "Управление городом", "green"]]];
    
$button['SUBURB'] = [
    [['text', ['province', 'exit'], "Покинуть поселение", "blue"],
    ['text', ['station', 'main'], "Станция", "blue"]],
    [['text', ['centre', 'main'], "Вернуться", "red"]]];

/***ОСНОВНОЙ КОД***/

//СДЕЛАТЬ СИСТЕМУ ПО СТАТУСАМ
if ($user['Статус'] = 'Поселение' /*OR $user['Статус'] = "Бар:{$user['Локация']}"*/)
    $button['CITY']['CENTRE'][2][0][2] = "{$town['Тип']}: {$user['Локация']}";
else
{
    $loc = $db->query("SELECT * FROM `Several_towns` WHERE `Провинция` = ?i", $map['sys_id'])->fetch_assoc();
    $button['CITY']['CENTRE'][2][0][2] .= "{$loc['Тип']}: {$map['Область']}"; //ЗДЕСЬ ПОФИКСИТЬ
}
switch ($payload[1])
{
    case 'entrance':
        if ($loc['Название'] != NULL)
        {
            $vk->sendButton($user_id, "Вы вошли в поселение {$loc['Название']}.\nЧто дальше?", $button['CITY']['CENTRE']);
            $db->query("UPDATE `Several_user` SET `Респавн` = '?s', `Статус` = '?s', `Локация` = '?s' WHERE `vk_id` = ?i", $loc['Название'], 'Поселение', $loc['Название'], $user_id);
        }
        else
            $vk->reply("В этой провинции нет поселений.");
        break;
    case 'main':
        $vk->sendButton($user_id, "Вы вернулись на центральную площадь", $button['CITY']['CENTRE']);
        $db->query("UPDATE `Several_user` SET `Статус` = '?s' WHERE `vk_id` = ?i", 'Поселение', $user_id);
        break;
    case 'suburb':
        $text = "{$town['Название']}.\n\n{$town['Описание']}";
        if (!in_array('Общайся', $user['Аккаунт']['Бонус']))
            $text .= "\n\nТак же у нас есть беседа!\nСсылка: ". LINK_CENT ."\nЕсть бонус за присоединение!";
        if ($town['Владелец'] == $user_id)
            $vk->sendButton($user_id, $text, array_merge($button['CITY']['SUB_MANAGE'], $button['CITY']['SUBURB']));
        else
            $vk->sendButton($user_id, $text, $button['CITY']['SUBURB']);
        break;
    case 'exit':
        break;
}

?>