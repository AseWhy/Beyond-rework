<?php

//*****Подключение Библ*****
use Krugozor\Database\Mysql\Mysql as Mysql;
use DigitalStar\vk_api\vk_api as vk_api;
include_once('/var/www/www-root/data/www/www.academy.com/Enclave/setting.php');
require_once('/var/www/www-root/data/www/www.academy.com/Enclave/vendor/autoload.php'); //подключаем библу
//**************************

$db = Mysql::create(HOST, DB_USER, DB_PASS)->setCharset('utf8')->setDatabaseName(DB_NAME);
$Connect = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
$vk = new vk_api(VK_KEY, VK_VERSION);


function Модуль_Корпорации($payload_value, $user)
{
    global $Connect,$vk;
    switch ($payload_value)
    {
        case 'Корпорация':
            Орг_Окно($user);
            break;
        case 'Корпорация | Выход':
            Орг_Окно_Выход($user);
            break;
        case 'Корпорация | Информация':
            Орг_Корп_Информация($user);
            break;
        case 'Корпорация | Отчёт':
            Орг_Корп_Отчёт($user);
            break;
        case 'Корпорация | Филиал':
            if($user['Статус'] == 'Поселение')
            {
                Орг_Корп_Бизнес($user);
            }
            else
            {
                $vk->sendmessage($user['Ид'],"Филиалы можно строить только в поселениях.");
            }
            break;
        case 'Корпорация | Предприятие':
            if($user['Статус'] == 'Провинция')
            {
                Орг_Корп_Бизнес($user);
            }
            else
            {
                $vk->sendmessage($user['Ид'],"Предприятия можно строить только в провинциях.");
            }
            break;
        case 'Корпорация | Филиал\Предприятие | Открыть':
            Орг_Корп_Филиал_Открыть_Список($user);
            break;
        case 'Корпорация | Филиал\Предприятие | Информация':
            Орг_Корп_Филиал_Открыть_Список($user);
            break;
        case 'Корпорация | Филиал\Предприятие | Улучшить':
            Орг_Корп_Филиал_Улучшить($user);
            break;
        case 'Корпорация | Филиал\Предприятие | Купить':
            Орг_Корп_Филиал_Открыть_Купить($user);
            break;
    }
}







function Орг_Создание ($user,$new_name)
{
	global $Connect,$vk,$db;
	$js_invent = json_decode($user['Инвентарь'],TRUE);
	$js_char = json_decode($user['Характеристики'],TRUE);
    if($user['Корпорация'] != 'Нет')
    {
        $vk->sendmessage($user['Ид'],"Вы уже состоите в корпорации.");
        exit();
    }
    if($new_name == '')
    {
        $vk->reply("Вы не ввели название корпорации.");
        exit();
    }
	if($js_char['Характеристики']['Уровень'] < УРОВЕНЬ_СОЗДАНИЯ_КОРПОРАЦИИ)
    {
        $vk->sendmessage($user['Ид'],"Ваш уровень не подходит для создания корпорации.");
        exit();
    }
	if($js_invent['Кошелек'] < ЦЕН_СОЗ_КОРП)
    {
        $tx = ЦЕН_СОЗ_КОРП;
        $vk->sendmessage($user['Ид'],"У вас недостаточно денег для создания корпорации.\n[$tx банов]");
        exit();
    }
	$vk->sendmessage($user['Ид'],"Вы создали новую корпорацию $new_name!");
    $vk->sendMessage(VK_LOG_TECH, "[id{$user['Ид']}|{$user['Вк_Имя']}] основал корпорацию $new_name.");
	$js_invent['Кошелек'] -= ЦЕН_СОЗ_КОРП;
    $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    //mysqli_query($Connect, "INSERT INTO Several_org VALUES ('','$new_name',{$user['Ид']},'{$user['Вк_Имя']}',0,'Без специализации',1,1,0)");
    $db->query("INSERT INTO Several_org (Название,Лидер_Ид,Лидер_Имя) VALUES ('?s',?i,'?s')", $new_name, $user['Ид'], $user['Вк_Имя']);
    mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent', Корпорация = '$new_name' WHERE Ид = {$user['Ид']}");
}
function Орг_Окно($user)
{
	global $Connect,$vk;
	if($user['Корпорация'] != 'Нет')
    {
    	$vk->sendbutton($user['Ид'], "Вы вошли в окно корпорации {$user['Корпорация']}.", [
            [[["Корпорации" => 'Корпорация | Филиал'], "Филиал", "red"],[["Корпорации" => 'Корпорация | Отчёт'], "Собрать отчёт", "green"],[["Корпорации" => 'Корпорация | Предприятие'], "Промышленность", "red"]],
    	    [[["Корпорации" => 'Корпорация | Информация'], "Информация", "blue"]],
    	    [[['city' => 'exit_in_town'], "Вернуться", 'white']]
            ]);
	mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = {$user['Ид']}");
	}
    else
    {
        $vk->sendMessage($user['Ид'],"Вы не состоите в корпорации.");
    }
}
function Орг_Корп_Филиал($user)
{
	global $Connect,$vk;
        $vk->sendbutton($user['Ид'], "Управление", [
            [[["Корпорации" => 'Корпорация | Филиал\Предприятие | Открыть'], "Открыть филиал", "green"],[["Корпорации" => 'Корпорация | Филиал\Предприятие | Информация'], "Информация", "green"]],
            [[["Корпорации" => 'Корпорация | Филиал\Предприятие | Улучшить'], "Список филиалов корпорации", "blue"]],
            [[["Корпорации" => 'Корпорация'], "Вернуться", "white"]]
            ]);
}
function Орг_Корп_Информация($user)
{
	global $Connect,$vk;
    $org = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_org WHERE Название = '{$user['Корпорация']}'"));
		$vk->sendMessage($user['Ид'],"
			Название: {$org['Название']}.
			Уровень: {$org['Уровень']}.
			Тип: {$org['Тип']}.
			Фонд: {$org['Фонд']}.
			Управляющий: [id{$org['Лидер_Ид']}|{$org['Лидер_Имя']}].
			Участников: {$org['Участники']}.
			Предприятий: {$org['Предприятия']}.
			");
}
function Орг_Корп_Бизнес($user)
{
	global $Connect,$vk;
        $vk->sendbutton($user['Ид'], "Управление", [
            [[["Корпорации" => 'Корпорация | Филиал\Предприятие | Открыть'], "Открыть филиал", "green"],[["Корпорации" => 'Корпорация | Филиал\Предприятие | Информация'], "Информация", "green"]],
            [[["Корпорации" => 'Корпорация | Филиал\Предприятие | Улучшить'], "Список филиалов корпорации", "blue"]],
            [[["Корпорации" => 'Корпорация'], "Вернуться", "white"]]
            ]);
}
function Орг_Корп_Филиал_Открыть_Список($user)
{
	global $Connect,$vk;
    $org = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_org WHERE Название = '{$user['Корпорация']}'"));
    $t_build = mysqli_query($Connect, "SELECT * FROM Several_type_build order by sys_id asc");
    $i = 0;
    while ($res = mysqli_fetch_assoc($t_build))
    {
    	$js_t_build = json_decode($res['js_t_build'],TRUE);
   		if($user['Статус'] == 'Провинция')
        {
   			if($org['Уровень'] >= $res['Уровень'] AND $res['Тип'] == 'Предприятие')
            {
                $tx1 = "Вы можете открыть следующие предприятия:\n";
                $tx2 = "";
   				$loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE Название = '{$user['Локация']}'"));
   				foreach ($js_t_build['Местность'] as $value)
                {
    				if($loc['Местность'] == $value)
                    {
						$i++;
						$tx2 .= "$i.{$res['Название']}.\n";
    				}
    			}
   			}
   		}
   		if($user['Статус'] == 'Поселение')
        {
   			if($org['Уровень'] >= $res['Уровень'] AND $res['Тип'] == 'Филиал')
            {
                $tx1 = "Вы можете открыть следующие филиалы:\n";
    			$loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
    			foreach ($js_t_build['Местность'] as $value)
                {
    				if($loc['Местность'] == $value)
                    {
						$i++;
						$tx2 .= "$i.{$res['Название']}.\n";
    				}
    			}
    		}
   		}
   		mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Филиал/Предприятие' WHERE Ид = {$user['Ид']}");
   	}
   	$text = $tx1.$tx2;
    $vk->sendmessage($user['Ид'],"$text");
}
function Орг_Корп_Филиал_Улучшить($user)
{
	global $Connect,$vk;
	if($user['Корпорация'] != 'Нет')
    {
        $vk->sendMessage($user['Ид'],"Позже.");
	}
    else
    {
        $vk->sendMessage($user['Ид'],"Вы не состоите в корпорации.");
    }
}
function Орг_Корп_Отчёт($user)
{
	global $Connect,$vk;
    //$org = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_org WHERE Название = '{$user['Корпорация']}'"));
	if($user['Корпорация'] != 'Нет')
    {
		$vk->sendMessage($user['Ид'],"Позже.");
	}
    else
    {
        $vk->sendMessage($user['Ид'],"Вы не состоите в корпорации.");
    }
}
function Орг_Корп_Филиал_Открыть_Выбор($user,$num)
{
	global $Connect,$vk;
    $org = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_org WHERE Название = '{$user['Корпорация']}'"));
    $t_build = mysqli_query($Connect, "SELECT * FROM Several_type_build order by sys_id asc");
    $i = 0;
    while ($res = mysqli_fetch_assoc($t_build))
    {
    	$js_t_build = json_decode($res['js_t_build'],TRUE);
   		if($user['Статус'] == 'Провинция')
        {
   			if($org['Уровень'] >= $res['Уровень'] AND $res['Тип'] == 'Предприятие')
            {
   				$loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE Название = '{$user['Локация']}'"));
   				foreach ($js_t_build['Местность'] as $value)
                {
    				if($loc['Местность'] == $value)
                    {
						$i++;
						if($i == $num)
                        {
   							mysqli_query($Connect, "UPDATE Several_user SET RAM = '{$res['Название']}' WHERE Ид = {$user['Ид']}");
   							$vk->sendbutton($user['Ид'], "{$res['Описание']}\nСтоимость: {$js_t_build['Стоимость']}\nПрибыль: {$js_t_build['Прибыль']}\n", [
                                [[['Корпорации' => 'Корпорация | Филиал\Предприятие | Купить'], "Открыть {$res['Название']}.", 'green']],
                                [[['Корпорации' => 'Корпорация | Филиал\Предприятие | Открыть'], "Не сейчас", 'red']]
                                ]);
						}
    				}
    			}
   			}
   		}
   		if($user['Статус'] == 'Поселение')
        {
   			if($org['Уровень'] >= $res['Уровень'] AND $res['Тип'] == 'Филиал')
            {
    			$loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
    			foreach ($js_t_build['Местность'] as $value)
                {
    				if($loc['Местность'] == $value)
                    {
						$i++;
						if($i == $num)
                        {
   							mysqli_query($Connect, "UPDATE Several_user SET RAM = '{$res['Название']}' WHERE Ид = {$user['Ид']}");
   							$vk->sendbutton($user['Ид'], "{$res['Описание']}\nСтоимость: {$js_t_build['Стоимость']}\nПрибыль: {$js_t_build['Прибыль']}\n", [
                            	[[['Корпорации' => 'Корпорация | Филиал\Предприятие | Купить'], "Открыть {$res['Название']}.", 'green']],
                            	[[['Корпорации' => 'Корпорация'], "Не сейчас", 'red']]
                                ]);
						}
    				}
    			}
    		}
   		}
   		mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Филиал/Предприятие' WHERE Ид = {$user['Ид']}");
   	}
}


?>