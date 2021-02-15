<?php 
//*****Подключение Библ*****
/*use Krugozor\Database\Mysql\Mysql as Mysql;
use DigitalStar\vk_api\vk_api as vk_api;
include_once('/var/www/www-root/data/www/www.academy.com/perimeter_83/v2.0/setting.php');
require_once('/var/www/www-root/data/www/www.academy.com/perimeter_83/v2.0/vendor/autoload.php'); //подключаем библу
//**************************

$db = Mysql::create(HOST, DB_USER, DB_PASS)->setCharset('utf8')->setDatabaseName(DB_NAME);
$vk = new vk_api(VK_KEY, VK_VERSION);


function Start_Module($payload_value, $user){
    global $vk,$db; */

switch ($payload[1])
{
    case 'Лор':
        $vk->sendButton($user['vk_id'], "*лор*", [[['text', ['registration', 'Гайд'], "Прочитать гайд", "green"]]]);
        break;
    case 'Гайд':
        $vk->sendButton($user['vk_id'], "*гайд*", [[['text', ["registration",'Окончание'], "Закончить регистрацию", "green"]]]);
        break;
    case 'Окончание':
        $vk->sendButton($user['vk_id'], "Отлично! Вы зарегистрированы!\nТеперь Вам необходимо создать своего персонажа и можете приступать к игре. Будьте внимательны при выборе, ведь от этого многое зависит!\n\nУдачи!", [
            [['text', ['user', 'Персонаж'], "Создать персонажа", "green"]],
            [['text', ['user', 'Информация'], "Информация", "blue"],['text', ['user', 'Достижения'], "Достижения", "blue"]],
            [['text', ['user', 'Помощь'], "Помощь", "red"]]]);
        break;
}