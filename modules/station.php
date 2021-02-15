<?php

$button['MAIN'] = [[['text', ['centre', 'suburb'], "Покинуть станцию", "white"]]];

$button['START'] = [
    [['text', ['station', 'start'], "Поехать в", "green"],
    ['text', ['centre', 'suburb'], "Покинуть станцию", "white"]]];

switch ($payload[1])
{
    case 'main':
        $vk->reply("В разработке");
        break;
    default:
        break;
}

?>