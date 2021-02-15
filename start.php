<?php /** @noinspection ALL */

//*****Место для дебага*****

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//**************************

//*****Подключение Библ*****
require_once('setting.php');
require_once('vendor/autoload.php'); //подключаем библу
use Krugozor\Database\Mysql\Mysql as Mysql;
use DigitalStar\vk_api\vk_api as vk_api;
//**************************
//***Соединение с вк и бд********
$db = Mysql::create(HOST, DB_USER, DB_PASS)->setCharset('utf8')->setDatabaseName(DB_NAME);
$vk = vk_api::create(VK_KEY, VK_VERSION)->setConfirm(VK_OK);
//$data = $vk->initVars($peer_id, $message_nrgs, $payload, $user_id, $type); // Исправил команду. Хартманн. Ты идиот, Хартманн! Шутка. Лео.
$vk->initVars($peer_id, $message_nrgs, $payload, $user_id, $type, $data);
$mess_id = $data->object->id;
$message = mb_strtolower($message_nrgs); //привести сообщение к нижнему регистру. Лео
$ex_mess = explode(' ', $message); //массив сообщения. Лео
$message = str_ireplace("\n", ' ', $message); //сообщение с пробелами вместо переносов. Лео
//$word_mess = str_ireplace(' ', '', $message); //сообщение без пробелов. Лео
if ($user_id == 0)
    exit;
$user_inf = $vk->userInfo($user_id);
$vk_name = $user_inf['first_name'] . ' ' . $user_inf['last_name'];
//**************************
function decodeUser($userDecode)
{
    global $new_user;
    foreach ($new_user as $key => $value)
        $userDecode[$key] = json_decode($userDecode[$key], TRUE);
    return $userDecode;
}
function updateUser($userUpdate, $mass_keys)
{
    global $db;
    foreach ($mass_keys as $value)
    {
        $userUpdate[$value] = json_encode($userUpdate[$value], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        $db->query("UPDATE `Пользователи` SET ?f = '?s' WHERE `sys_id` = ?i", $value, $userUpdate[$value], $userUpdate['sys_id']);
    }
}
function endReply($str)
{
    global $vk, $user_id;
    $vk->sendMessage($user_id, $str);
    exit;
}
//**************************
//Начало регистрации
$user = $db->query("SELECT * FROM `Пользователи` WHERE `vk_id` = ?i", $user_id)->fetch_assoc();
/*foreach ($payload as $key_p => $value_p){
}*/
if (!$user)
{ //Если нет в БД //СДЕЛАЙ КНОПКИ КНОПКИ КНОПКИ
    /*
    { //ФУНКЦИЮ В ОТДЕЛЬНЫЙ ФАЙЛ
        $vk->sendMessage(VK_LOG_TECH, "$vk_name попытался зарегистрироваться"); // #В_ОТДЕЛЬНЫЙ_ФАЙЛ
        foreach($new_user as $key => $value)
            $js_new[$key] = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); //new_user из файла настроек, все стартовые параметры пользователя, кодируется в json. Лео
        $js_new = array_merge(['name' => $vk_name], $new_user); //массив для БД. Лео
        $db->query("INSERT INTO `Пользователи` SET ?As", $new_user);
        $db->query("UPDATE `Пользователи` SET `vk_id` = ?i WHERE `name` = '?s'", $user_id, $vk_name);
        $vk->sendMessage(VK_LOG_TECH, "[id$user_id|$vk_name] зарегистрировался.");
        $vk->sendButton($user_id, "
            Добро пожаловать!
            Мы приветствуем вас в боте от команды разработчиков Дома Хартманн!
            Перед продолжением регистрации, настоятельно рекомендуем вам прочесть гайд.
            Так же, для большего погружения в нашу РП-вселенную вам дана возможность ознакомится с нашим лором.\n
            Нажмите одну из кнопок для продолжения.", [
            [$vk->buttonText("Прочитать гайд", "green", ["city" => 'Регистрация | Гайд'])],
            [$vk->buttonText("Ознакомиться с Лором", "blue", ["city" => 'Регистрация | Лор'])],
            [$vk->buttonText("Продолжить регистрацию", "red", ["city" => 'Регистрация | Карта'])]
            ]);
        $vk->sendMessage(VK_LOG_TECH, "$vk_name успешно зарегался. Наверное..."); // #В_ОТДЕЛЬНЫЙ_ФАЙЛ
        exit(); //Чтобы не писать весь код в else, завершаем программу. Лео
    }*/
    if ($peer_id == $user_id AND $user_id > 0)
    {
        $db->query("INSERT INTO `Пользователи` (`vk_id`, `vk_name`) VALUES (?i, '?s')", $user_id, $vk_name);
        //$db->query("INSERT INTO `Пользователи` SET ?As", $new_user);
        $vk->sendButton($user_id,
                "\nДобро пожаловать!".
                "\nМы приветствуем вас в боте от команды Парадоксии.".
                "\nНастоятельно рекомендуем вам прочесть гайд перед продолжением регистрации.".
                "\nТакже, для большего погружения в нашу РП-вселенную вам дана возможность ознакомится с нашим лором.\n".
                "\nНажмите одну из кнопок для продолжения.", [[['text', ['registration', 'Лор'], "Ознакомиться с лором", "green"]]]);

    }
    elseif ($user_id < 0)
    {
        if ($user_id == -187917485)
            $vk->reply("Ересьдетектор, день добрый.\n". $lol_eres[array_rand($lol_eres)]);
        else    
            $vk->reply($lol_bot[array_rand($lol_bot)]);
    }
    exit; //Если пользователя нет в бд и он пишет не в лс боту(фикс бесконечного "добро пожаловать" и прочего)
}
//Регистрацая новичка завершена, далее сам скрипт. Лео
$user = decodeUser($user);
$menu = explode(' ', $user['Меню']);

if ($user['Бан'] == TRUE AND $peer_id == $user_id)
    endReply("Ты забанен!");

/////////////////////
//Конец регистрации//
/////////////////////
//Начало скрипта/////
////////////////////
//Подгрузка БД
/*НЕДОДЕЛАНО
$map = $db->query("SELECT * FROM `Several_map` WHERE `Название` = '?s'", $user['Локация'])->fetch_assoc();
if (in_array($user['Статус'], CITY_STATUS))
{
    $town = $db->query("SELECT * FROM `Several_towns` WHERE `Название` = '?s'", $user['values']['Локация'])->fetch_assoc();
}
else
{

}*/
//$map['Путь'] = json_decode($map['Путь'], TRUE);
//Банк.Лимит
//
/*
$town['Постройки'] = json_decode($town['Постройки'], TRUE);
$transport = $db->query("SELECT * FROM `Several_invent` WHERE `Название` = '?s'", $user['Инвентарь']['Транспорт'])->fetch_assoc();
$user['Скорость'] = 2 + $transport['Скорость'];
$backpack = $db->query("SELECT * FROM `Рюкзаки` WHERE `Название` = '?s'", $user['Инвентарь']['Рюкзак'])->fetch_assoc();
*/
if ($peer_id == ID_CENTMOD)
{
    if ($user_id > 0)
    {
        if (!in_array('Общайся', $user['Достижения']))
        {//ФУНКЦИЮ В ОТДЕЛЬНЫЙ ФАЙЛ ПО ВЫДАЧЕ БОНУСА
            $user['Достижения'][] = 'Общайся';
            $vk->sendMessage($user_id, "Вы получили бонус за присоединение к беседе!");
            $vk->sendMessage(ID_CENTMOD, "Добро пожаловать!");
            $vk->sendMessage(VK_LOG_TECH, "[id{$user['vk_id']}|{$user['vk_name']}] получил бонус \"Общайся\".");
        }
    }
    elseif ($user_id == -187917485)
        $vk->sendMessage(ID_CENTMOD, "Ересьдетектор, день добрый.\n". $lol_eres[array_rand($lol_eres)]);
    else
        $vk->sendMessage(ID_CENTMOD, $lol_bot[array_rand($lol_bot)]);
}

if (isset($payload) AND $peer_id == $user_id)
{ //ЕСЛИ ЕСТЬ PAYLOAD
    /*if ($payload[0] == 'city' and $user['Статус'] != 'Поселение')
    {//ЕСЛИ БАГ
        $vk->reply("Внимание!\nЭта кнопка не соответствует вашему статусу.\nВы попали в баг.\nВведите команду \"Клавиатура\"\nЗачастую эта команда решает проблему.\n\nРепорт автоматически отправился разработчику. Приносим извинения за неудобство.");
        $vk->sendMessage(VK_LOG_TECH, "[id$user_id|{$vk_name}] нажал кнопку которая не соответствует его статусу. БАГ!");
        exit;
    }*/
    /*if ($payload[0] != 'bar' AND $payload[0] != 'casino')
        $db->query("UPDATE `Пользователи` SET `Меню` = ?n WHERE `vk_id` = ?i", NULL, $user_id);*/
    //$vk->reply("Запросили модуль кнопок: modules/{$payload[0]}.php.\nПередали значение кнопки: $payload[1]\nID инициатора функции: {$user['vk_id']}");
    include("modules/{$payload[0]}.php");
    //Start_Module($value_p, $user);
    exit;
}

if (is_numeric($ex_mess[0]))
    include("modules/{$menu[0]}.php");
else
{
    foreach ($command as $key_c => $value_c)
    {
        if (in_array($ex_mess[0], $value_c))
        {
            include("modules/{$key_c}.php");
            break;
        }
    }
}

/*ИНВЕНТАРЬ
Инвентарь персонажа:
Кошелёк: 100
Оружие: Наган
Одежда: Куртка замшевая
Транспорт: Тележка
Рюкзак: Чемодан

Щиты:
1. Деревянный (1)
2. Железный (1)

Аптечки:
1. Бинт (3)
2. Мазь (1)
3. Волшебное зелье (2)
4. Кровь христианских младенцев (1)

Бомбы:
1. Маленькая граната (4)
2. Большая граната (1)
3. Мегаподрывалка (2)

Полезные предметы:
1. СТАЛИН-3000 (1)
2. Одноразовая палатка (2)
3. Кинокамера заграничная (3)

Сумка:
1. Потрепанный флаг Анклава (2)
2. Портсигар отечественный (3)
3. Ржавая лопата (1)
4. Зажигалка для соседней усадьбы (5)*/

?>