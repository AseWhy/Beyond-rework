<?php

//ARMY //ПОТОМ
$army = $db->query("SELECT * FROM `Enclave_army` WHERE `Командир` = ?i", $user_id['sys_id']);
switch ($payload[2])
{
    case 'main':
        $vk->sendButton($user_id, "Вы вошли в окно управления подразделением №{$army['sys_id']}.", [
            [['text', ['army', 'Информация'], "Информация", "green"], ['text', ['army', 'Провинция'], "Провинция", "green"], ['text', ['army', 'Командование'], "Командование", "green"]],
            [['text', ['army', "Статус:{$army['sys_id']}"], "Статус: {$army['sys_id']}", 'blue']],
            [['text', ['province'], "Покинуть часть", 'white']]
            ]);
        $db->query("UPDATE `Several_user` SET `menu` = ?n WHERE `sys_id` = ?i", NULL, $user_id);
        break;
    case 'infa':
        if(isset($army['sys_id']))
            $vk->reply("Информация о подразделении №{$army['sys_id']}.\nКомандир подразделения: [id$id|{$user['Имя']}]\nЛимит подразделения: {$limit['Подразделение']}\nКоличество пехотных отделений: {$army['Пехота']}.\nКоличество танковых экипажей: {$army['Танки']}\nКоличество орудийных расчётов: {$army['Орудия']}.");
        else
            $vk->reply("В вашем командовании нет подразделений.");
        break;
    case 'Статус':
        switch($payload['module'][2])
        {
            case 'Окапывание': //ARMY
                $vk->reply("
                    Армия находиться в состоянии Окапывания. В этом режиме в части вводится строгое положение. Солдаты наччинают возводить укрепления на месте дислокации и использовать\изучать преимущества местности. Это сложная работа, дающая серьезные бонусы в бою. К сожалению вам не удастся покинуть часть во время таких работ.");
                break;
            case 'Ожидание': //ARMY
                $vk->reply("
                    Армия находиться в состоянии Ожидания. В режиме ожидания армия не занята ничем серьезным и может выполнять разнообразные действия в провинции. Так же подразделение всегда готово принять бой. Еще это отличный вариант если вам требуется временно покинуть часть.");
                break;
            case 'Марш': //ARMY
                $vk->reply("
                    Армия находиться в состоянии Марша. Это позволяет быстро передвигаться по местности, но при нападении на подразделение в таком состоянии, вас ждут серьезные штрафы в бою.");
                break;
            case 'Марш | Карта': //ARMY //ПОТОМ
                //$js_map = json_decode($map['Пути'], TRUE);
                $i = 0;
                $text = "Вам доступны пути в следующие регионы:\n";
                foreach ($js_map['Путь'] as $reg => $s)
                {
                    $i++;
                    $name_reg = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE sys_id = $reg"));
                    $text .= "\n$i.{$name_reg['Название']}.\nРасстояние: $s км.\nГосударство: {$name_reg['Государство']}\nОбласть: {$name_reg['Владелец']}\n";
                }
                $text .= "\n\nДля начала пути введите команду:\nПуть [Номер провинции в списке].\nПример: Путь 2";
                //$text .= "\n\nПеремещение между локациями временно недоступно.";
                $js_map = json_decode($map['Пути'], TRUE);
                $map_picture = $map['Владелец'];
                $text .= "\n\nКарта региона:";
                $vk->sendMessage($user_id, "$text");
                $vk->sendImage($user_id, "img/map/{$map['Владелец']}.jpg");
                mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Военная часть' WHERE Ид = $id");
                break;
        }
        break;
    case '':
        break;
    case '':
        break;
    case '':
        break;
}

?>