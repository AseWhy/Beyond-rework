<?php

$button['Гайд'] = [[['text', ['reg', 'Гайд'], "Ознакомиться с гайдом", "green"]]];
$button['Карта'] = [[['text', ['reg', 'Карта'], "Выбрать город", "green"]]];

switch ($payload[1])
{
    case 'Лор':
        $vk->sendButton($user_id, "*лор*", $button['Гайд']);
        break;
    case 'Гайд':
        $vk->sendButton($user_id, "*гайд*", $button['Карта']);
        break;
    case 'Карта':
        $db->query("SELECT * FROM `Страны`");
        break;
    case 'ok':
        break;
}

?>