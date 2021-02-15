<?php /** @noinspection ALL */

//*****Место для дебага*****
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
//**************************
//*****Подключение Библ*****
require_once('setting.php');
require_once('vendor/autoload.php'); //подключаем библу
use Krugozor\Database\Mysql\Mysql as Mysql;
use DigitalStar\vk_api\vk_api as vk_api;
//**************************
//***Соединение с вк и бд********
$db = Mysql::create(HOST, DB_USER, DB_PASS)->setCharset('utf8')->setDatabaseName(DB_NAME);
$Connect = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
$data = $vk->initVars($peer_id, $message_nrgs, $payload, $user_id, $type);;
$vk = new vk_api(VK_KEY, VK_VERSION);
/*$vk->sendOk();
Сей закомментированный код можно удалить. Лео. #убрать_код
if ($data->type == 'confirmation')
    exit(VK_OK);
$id = $data->object->from_id; // Узнаем ID пользователя, кто написал нам
$peer_id = $data->object->peer_id; //
$message = $data->object->text; // Само сообщение от пользователя*/
$message = mb_strtolower($message_nrgs);
/*if (isset($data->object->payload))
    $payload = json_decode($data->object->payload, True); //получаем payload
else
    $payload = null; #убрать_код */
$word_mess = str_ireplace(' ', '', $message);
$ex_mess = explode(' ', $message);
if($id == 0) exit();
$user_name = $vk->userInfo($id)['first_name'];
$user_family = $vk->userInfo($id)['last_name'];
$vk_name = $user_name . ' ' . $user_family;

/*
class User {

}
$ex_user = new User();
$ex_user->idid = $id;
$ex_user->name = $vk_name;
$ex_user->donat = 0;
$ex_user->registration = date("d/m/Y");
$text = "Ид:" . $ex_user->idid . "\nИмя:" . $ex_user->name . "\nСчёт:" . $ex_user->donat . "\nДата регистрации:" . $ex_user->registration;
$vk->sendmessage(ИД_ХАРТМАНН,"$text");



if($ex_user instanceof User){
    // Класс $ex_user = User
}*/
////////////////////
    //Окно города//
////////////////////
const BTN_BANK = [["city" => 'bank'], "Банк", "green"]; // Код кнопки
const BTN_SHOP = [["city" => 'shop'], "Магазин", "green"]; // Код кнопки
const BTN_CHAR = [["city" => 'char'], "Индивидуальная карта", "green"]; // Код кнопки
const BTN_TAVERN = [["city" => 'tavern'], "Бар", "red"]; // Код кнопки
const BTN_WORK = [["city" => 'work'], "Работа", "red"]; // Код кнопки
const BTN_PROPERTY = [["city" => 'property'], "Недвижимость", "red"]; // Код кнопки
const BTN_EXIT_TOWN = [["city" => 'exit_town'], "Выйти из города", "white"]; // Код кнопки

//окно ростовщиков//
const BTN_DEPOZIT_BANK = [["city" => 'depozit_bank'], "Пополнить счёт", "green"]; // Код кнопки
const BTN_CREDIT_BANK = [["city" => 'credit_bank'], "Снять деньги", "green"]; // Код кнопки
const BTN_INFA_BANK = [["city" => 'infa_bank'], "Информация о счёте", "blue"]; // Код кнопки
const BTN_EXIT_IN_TOWN = [["city" => 'exit_in_town'], "Центральная площадь", "white"]; // Код кнопки
const BTN_EXIT_IN_BANK = [["city" => 'exit_in_bank'], "Пожалуй позже", "red"]; // Код кнопки

//Окно таверны//
const BTN_BAR_TAVERN = [["city" => 'bar_tavern'], "Поесть", "red"]; // Код кнопки
const BTN_CASINO_TAVERN = [["city" => 'casino_tavern'], "Казино", "green"]; // Код кнопки
const BTN_HOUSE_TAVERN = [["city" => 'house_tavern'], "Войти в отель", "red"]; // Код кнопки

//Окно персонажа//
const BTN_INVENT_CHAR = [["city" => 'invent_char'], "Личные вещи", "green"]; // Код кнопки
const BTN_CHAR_CHAR = [["city" => 'char_char'], "Статус", "green"]; // Код кнопки
const BTN_CONDITION_CHAR = [["city" => 'condition_char'], "Состояние", "green"]; // Код кнопки
const BTN_STAT_CHAR = [["city" => 'stat_char'], "Статистика", "red"]; // Код кнопки



//РП Корнила


//Начало регистрации
$user = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE Ид = $id"));
//$vk->sendMessage(ИД_ХАРТМАНН, "2 !{$user['Ид']}! 1 $id 1");
if (!$user)
{ //Если нет в БД
    if ($peer_id == $id)
    {
        $user_name = $vk->userInfo($id)['first_name'];
        $user_family = $vk->userInfo($id)['last_name'];
        $vk_name = $user_name . ' ' . $user_family;
        $vk->sendmessage(ИД_ПАВЕЛ, "$vk_name попытался зарегистрироваться");
        Регистрация_в_бд($id,$vk_name);
        $vk->sendmessage(ИД_ПАВЕЛ, "$vk_name успешно зарегался. Наверное...");
        exit; //Чтобы не писать весь код в else, завершаем программу. Лео
    }
    else
        exit; //Если пользователя нет в бд и он пишет не в лс боту(фикс бесконечного "добро пожаловать" и прочего)
}
//Регистрацая новичка завершена, далее сам скрипт. Лео

if($user['Титул'] == 'Забанен')
{
    if ($peer_id == $id)
        $vk->sendMessage($id, "Ты забанен!");
    exit();
}

/////////////////////
//Конец регистрации//
/////////////////////
//Начало скрипта/////
////////////////////
//Подгрузка БД
$map = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE Название = '{$user['Локация']}'"));
$loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
$map = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE Название = '{$user['Локация']}'"));
//Банк.Лимит
$js_char = json_decode($user['Характеристики'], TRUE);
$limit['Банк'] = $js_char['Характеристики']['Уровень'] * ЛИМИТ_БАНКА + 500 * $js_char['Паспорт']['Время проживания'];
if($js_char['Паспорт']['Время проживания'] < 3)
    $limit['Банк'] = 0;
$js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
//
//Налоги
$js_tax = json_decode($loc['Налоги'],TRUE);
$js_town = json_decode($loc['Постройки'],TRUE);
$transport = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$user['Транспорт']}'"));
$user['Личная Скорость'] = 2 + $transport['Скорость'];

if ($peer_id == ИД_ЦЕНТМОД)
{
    $js_bonus = json_decode($user['Бонус'], TRUE);
    if ($js_bonus['Общайся'] == NULL)
    {
        $js_bonus['Общайся'] = 'Получен';
        $js_invent = json_decode($user['Инвентарь'], TRUE);
        $js_invent['Кошелек'] += 2500;
        $vk->sendMessage($id, "Вы получили бонус за присоединение к беседе!\nПроверьте ваш кошелек!");
        $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        $js_bonus = json_encode($js_bonus, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent', Бонус = '$js_bonus' WHERE Ид = $id");
        if ($id > 0)
        {
            $vk->sendMessage(ИД_ЦЕНТМОД, "Добро пожаловать!");
            $vk->sendmessage(VK_LOG_TECH, "[id$id|{$user['Вк_Имя']}] получил бонус \"Общайся\".");
        }
        elseif ($id == -187917485)
        {
            $r = rand(0, 6);
            $lol = array("Что ты делаешь в этой беседе, дружище?", "Неужели они смогли тебя повязать?", "В тебе обнаружена ересь.", "За скидывание порно в особо крупном размере, ты приговариваешься к компиляции рукожопными программистами.", "Хуёбрый, ШУЕ!", "Вечер в хату попаданец", "[id93002658|Дядя Админ], у вас тут бот малолетний, а ему вопросы всякие взрослые задают.");
            $vk->sendMessage(ИД_ЦЕНТМОД, "Ересьдетектор, день добрый.\n$lol[$r]");
        }
        else
        {
            $r = rand(0, 11);
            $lol = array("Это что за покемон? Зачем тут этот бот?", "Товарищи админы, добавьте его в мою базу данных или я буду заебывать этот чат постоянными напоминаниями этим сообщением...", "Вечер в хату попаданец", "Welcome to the club baddu", "ПЧОЛЫ\nПЧОЛЫ\n...\nМолчит, тупенький какой-то бот.", "Ты пишешь сюда сообщения, но делаешь это без уважения.", "Ты тупой кусок кода. А я... А я просто кусок кода.. Хотя кого я обманываю. Просто кусок", "Админы! Вы нашли мне замену? Неблагодарные твари!", "Тут какой-то бот написал, выкиньте его заборт", "Только не вздумайте давать этому недоразумению админку.", "КАПИТАН, ЭТОГО ПИДОРА В ХИМКАХ ВИДАЛ, ДЕРЕВЯННЫМИ ЧЛЕНАМИ ТОРГУЕТ", "Ты как из дурки сбежал?");
            $vk->sendMessage(ИД_ЦЕНТМОД, "$lol[$r]");
        }
    }
}

if (!$payload['city'])
{
    switch (count($mess))
    {
        case '1':
            if (is_numeric($mess[0]))
            {
                switch ($user['Меню'])
                {
                    case 'Филиал/Предприятие':
                        Орг_Корп_Филиал_Открыть_Выбор($id, $message);
                        break;
                    case 'Достижения':
                        $js_bonus = json_decode($user['Бонус'], TRUE);
                        $i = 0;
                        foreach ($js_bonus as $achievement => $value)
                        {
                            $i++;
                            if ($i == $message)
                            {
                                $vk->sendmessage($peer_id, "{$achiev["$achievement"]}");
                                mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
                            }
                        }
                        break;
                    case 'Взять из казны':
                        $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
                        $val = floor($message);
                        if ($message > 0)
                        {
                            if ($town['Казна'] >= $val)
                            {
                                $js_invent = json_decode($user['Инвентарь'], TRUE);
                                $js_invent['Кошелек'] += $val;
                                mysqli_query($Connect, "UPDATE Several_towns SET Казна = Казна - $val WHERE Название = '{$user['Локация']}'");
                                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                                mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent' WHERE Ид = $id");
                                $vk->sendmessage($id, "Вы изъяли из казны деньги в пользу вашего кошелька.");
                            }
                            else
                                $vk->sendmessage($id, "В казне города недостаточно денег.");
                        }
                        else
                            $vk->sendmessage($id, "Введите корректную сумму.");
                        //$vk->sendmessage($id, "На данный момент брать деньги из казны не предоставляется возможным...");
                        $vk->sendmessage($id, "Выберите дальнейшие действия.");
                        mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
                        break;
                    case 'Положить в казну':
                        $val = floor($message);
                        if ($message > 0)
                        {
                            $js_invent = json_decode($user['Инвентарь'], TRUE);
                            if ($js_invent['Кошелек'] >= $val)
                            {
                                mysqli_query($Connect, "UPDATE Several_towns SET Казна = Казна + $val WHERE Название = '{$user['Локация']}'");
                                $js_invent['Кошелек'] -= $val;
                                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                                mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent' WHERE Ид = $id");
                                $vk->sendmessage($id, "Вы пополнили казну города из личных средств.");
                            }
                            else
                                $vk->sendMessage($id, "В вашем кошельке недостаточно места.");
                        }
                        else
                            $vk->sendmessage($id, "Введите корректную сумму.");
                        $vk->sendmessage($id, "Выберите дальнейшие действия.");
                        mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
                        break;
                    case 'Положить в часть':
                        $val = floor($message);
                        if ($message > 0)
                        {
                            $js_invent = json_decode($user['Инвентарь'], TRUE);
                            if ($js_invent['Кошелек'] >= $val)
                            {
                                mysqli_query($Connect, "UPDATE Enclave_army SET Снабжение = Снабжение + $val WHERE Командир = {$user['Ид']}");
                                $js_invent['Кошелек'] -= $val;
                                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                                mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent' WHERE Ид = $id");
                                $vk->sendmessage($id, "Вы пополнили снабжение части.");
                            }
                            else
                                $vk->sendMessage($id, "В вашем кошельке нет такой суммы.");
                        }
                        else
                            $vk->sendmessage($id, "Введите корректную сумму.");
                        mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
                        break;
                    case 'Стартовая локация':
                        $z = mysqli_query($Connect, "SELECT * FROM Several_towns order by sys_id asc");
                        while ($res = mysqli_fetch_assoc($z))
                        {
                            $i++;
                            if ($mess[0] == $i)
                            {
                                mysqli_query($Connect, "UPDATE Several_user SET RAM = '{$res['Название']}' WHERE Ид = $id");
                                $vk->sendbutton($id, $res['Описание'], [
                                    [[["city" => 'Регистрация | Подтверждение'], "Подтвердить", "green"]]
                                    ]);
                            }
                        }
                        break;
                    case 'Содержимое сумки':
                        $js_invent = json_decode($user['Инвентарь'], TRUE);
                        if ($mess[0] > 0)
                        {
                            $invent = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Сумка'][$mess[0]]}'"));
                            if ($js_invent['Сумка'][$mess[0]] != NULL AND $js_invent['Сумка'][$mess[0]] != 'Пусто')
                            {
                                $tx2 = $invent['Стоимость'];
                                $x = round($tx2 * 0.5, 2);
                                $js_invent['Кошелек'] += $x;
                                $vk->sendbutton($id, "Отлично. Вы продали {$js_invent['Сумка'][$mess[0]]} за $x.", [
                                    [['city' => 'shop'], "Забрать деньги", 'green']
                                    ]);
                                $js_invent['Сумка'][$mess[0]] = NULL;
                                $js_invent['Сумка'][0]++;
                                $i = 0;
                                foreach ($js_invent['Сумка'] as $index => $item)
                                {
                                    if ($js_invent['Сумка'][$i] == NULL)
                                    {
                                        $z = $i;
                                        break;
                                    }
                                    else
                                        $i++;
                                }
                                $i = 0;
                                foreach ($js_invent['Сумка'] as $index => $item)
                                {
                                    $i++;
                                    if ($i >= $z)
                                    {
                                        $z++;
                                        $js_invent['Сумка'][$i] = $js_invent['Сумка'][$z];
                                    }
                                }
                                $z--;
                                unset($js_invent['Сумка'][$z]);
                                $z--;
                                unset($js_invent['Сумка'][$z]);
                                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                                mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent',Меню = 'Город' WHERE Ид = $id");
                            }
                            else
                                $vk->sendmessage($id, "Этот слот пуст.");
                        }
                        else
                            $vk->sendmessage($id, "Укажите номер слота инвентаря.");
                        break;
                    case 'Продажа снаряжения':
                        $js_invent = json_decode($user['Инвентарь'], TRUE);
                        if ($mess[0] > 0 AND $mess[0] < 5)
                        {
                            $invent = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Слоты']["Слот $mess[0]"]}'"));
                            if ($js_invent['Слоты']["Слот $mess[0]"] != 'Пусто')
                            {
                                $tx2 = $invent['Стоимость'];
                                $x = $tx2 * 0.5;
                                $js_invent['Кошелек'] += $x;
                                $vk->sendbutton($id, "Отлично. Вы продали {$js_invent['Слоты']["Слот $mess[0]"]} за $x.", [
                                    [['city' => 'shop'], "Забрать {$invent['Название']}", 'green']
                                    ]);
                                $js_invent['Слоты']["Слот $mess[0]"] = 'Пусто';
                                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                                mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent',Меню = 'Город' WHERE Ид = $id");
                            }
                            else
                                $vk->sendmessage($id, "Этот слот пуст.");
                        }
                        else
                            $vk->sendmessage($id, "Укажите номер слота инвентаря.");
                        break;
                    case 'Налог: Трудовой налог':
                        if($mess[0] <= 100 AND $mess[0] >= -100)
                        {
                            $js_tax['Трудовой налог'] = $mess[0];
                            $js_tax = json_encode($js_tax, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                            mysqli_query($Connect, "UPDATE Several_towns SET Налоги = '$js_tax' WHERE Название = '{$user['Локация']}'");
                            $vk->sendmessage($id,"Налог успешно изменен.");
                        }
                        else
                            $vk->sendmessage($id,"Налог должен быть в диапазоне от -100 до 100.");
                        break;
                    case 'Налог: Бизнес':
                        if($mess[0] <= 100 AND $mess[0] >= -100)
                        {
                            $js_tax['Бизнес'] = $mess[0];
                            $js_tax = json_encode($js_tax, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                            mysqli_query($Connect, "UPDATE Several_towns SET Налоги = '$js_tax' WHERE Название = '{$user['Локация']}'");
                            $vk->sendmessage($id,"Налог успешно изменен.");
                        }
                        else
                            $vk->sendmessage($id,"Налог должен быть в диапазоне от -100 до 100.");
                        break;
                    case 'Выбор провинции':
                        $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
                        $z = mysqli_query($Connect, "SELECT * FROM Several_map WHERE Владелец = '{$user['Локация']}'");
                        $tx1 = ЛИМИТ_ПРОВ_КОМРАЙ;
                        $tx2 = ЛИМИТ_ПРОВ_УКРЕП;
                        $tx3 = ЛИМИТ_ОБЛ_ПВО;
                        while ($loc = mysqli_fetch_assoc($z)) // Лимиты области.
                            $tx33 -= $loc['ПВО'];
                        $i = 0;
                        $z = mysqli_query($Connect, "SELECT * FROM Several_map WHERE Владелец = '{$user['Локация']}'");
                        while ($loc = mysqli_fetch_assoc($z))
                        {
                            $i++;
                            if($i == $mess[0])
                            {
                                switch ($loc['Местность'])
                                {
                                    case 'Равнины':
                                        $income += ДОХОД_РАВНИНЫ / Длина_года_в_днях + $loc['Комм_Районы'] * ПРИБЫЛЬ_КОММ_РАЙОНОВ;
                                        break;
                                    case 'Луга':
                                        $income += ДОХОД_ЛУГА / Длина_года_в_днях + $loc['Комм_Районы'] * ПРИБЫЛЬ_КОММ_РАЙОНОВ;
                                        break;
                                    case 'Холмы':
                                        $income += ДОХОД_ХОЛМЫ / Длина_года_в_днях + $loc['Комм_Районы'] * ПРИБЫЛЬ_КОММ_РАЙОНОВ;
                                        break;
                                    case 'Лес':
                                        $income += ДОХОД_ЛЕС / Длина_года_в_днях + $loc['Комм_Районы'] * ПРИБЫЛЬ_КОММ_РАЙОНОВ;
                                        break;
                                    case 'Горы':
                                        $income += ДОХОД_ГОРЫ / Длина_года_в_днях + $loc['Комм_Районы'] * ПРИБЫЛЬ_КОММ_РАЙОНОВ;
                                        break;
                                    case 'Высокогорье':
                                        $income += ДОХОД_ВЫСОКОГОРЬЕ / Длина_года_в_днях + $loc['Комм_Районы'] * ПРИБЫЛЬ_КОММ_РАЙОНОВ;
                                        break;
                                    case 'Побережье':
                                        $income += ДОХОД_ПОБЕРЕЖЬЕ / Длина_года_в_днях + $loc['Комм_Районы'] * ПРИБЫЛЬ_КОММ_РАЙОНОВ;
                                        break;
                                    case 'Ад':
                                        $income += ДОХОД_АД / Длина_года_в_днях + $loc['Комм_Районы'] * ПРИБЫЛЬ_КОММ_РАЙОНОВ;
                                        break;
                                }
                                $uncome = $loc['ПВО'] * СОДЕРЖАНИЕ_ПВО + $loc['Укрепления'] * СОДЕРЖАНИЕ_УКРЕПЛЕНИЙ;
                                $vk->sendbutton($id, "Вы зашли в окно управления провинцией.\nНазвание: {$loc['Название']}.\nКомм.Районы: [{$loc['Комм_Районы']}/$tx1]\nУкрепления: [{$loc['Укрепления']}/$tx2]\nОбщий доход: $income\nОбщий расход: $uncome", [
                                    [/*[["city" => 'Город | Экономика | Строительство | ПВО'], "ПВО", "green"],*/[["Город" => 'Город | Экономика | Строительство | Укрепление'], "Укрепления", "green"]], //\nПВО: [$tx33/$tx3]
                                    [[["Город" => 'Город | Экономика | Строительство | Комм.Район'], "Комм.Район", "blue"]],
                                    [[["Город" => 'Город | Экономика'], "Вернуться", "white"]]
                                    ]);
                                mysqli_query($Connect, "UPDATE Several_user SET RAM = '{$loc['Название']}' WHERE Ид = '{$user['Ид']}'");
                            }
                        }
                        mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Выбор провинции' WHERE Ид = '{$user['Ид']}'");
                        break;
                    case 'Передача командования':
                        $user_pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[0]"));
                        $army_pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE Командир = {$user_pol['Ид']}"));
                        $army = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE Командир = {$user['Ид']}"));
                        if($user_pol['Вк_Имя'] == NULL)
                        {
                            $vk->sendmessage($id,"Такого игрока не существует.");
                            exit();
                        }
                        if($army_pol['sys_id'] != NULL)
                        {
                            $vk->sendmessage($id,"У этого игрока уже есть подразделение в командовании.");
                            exit();
                        }
                        if($user_pol['Локация'] != $army['Локация'])
                        {
                            $vk->sendmessage($id,"Игрок должен быть в одной локации с армией, для передачи командования.");
                            exit();
                        }
                        mysqli_query($Connect, "UPDATE Enclave_army SET Командир = {$user_pol['Ид']}, Имя = {$user_pol['Вк_Имя']} WHERE Командир = {$user['Ид']}");
                        mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
                        $vk->sendmessage($id,"Вы передали командование подразделением №{$army['sys_id']}.\nНовый командир: [id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}].");
                        $vk->sendmessage($user_pol['Ид'],"Вам передали командование подразделением №{$army['sys_id']}.\nСтарый командир: [id{$user['Ид']}|{$user['Вк_Имя']}].");
                        $vk->sendmessage(VK_LOG_TECH,"[id{$user['Ид']}|{$user['Вк_Имя']}] передал(а) командование подразделением №{$army['sys_id']}.\nНовый командир: [id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}].");
                        /////
                        $map = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE Название = '{$user['Локация']}'"));
                        if(isset($map))
                        {
                            if ($map['Температура'] < 0)
                                $tx1 = '-';
                            if ($map['Температура'] >= 0)
                                $tx1 = '+';
                            $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Провинция = {$map['sys_id']}"));
                            if ($loc['Название'] != NULL)
                                $tx2 = "Войти в {$loc['Название']}";
                            else $tx2 = "Искать поселение";
                            $vk->sendbutton($user['Ид'], "Вы покинули {$user['Локация']}.\n\nИнформация о провинции:\nГосударство-владелец: {$map['Государство']}.\nНазвание: {$map['Название']}.\nТип местности: {$map['Местность']}.\nТемпература: $tx1{$map['Температура']}\nРадиация: {$map['Радиация']} рад/час", [
                                [[["city" => 'Провинция | Бродить'], "Побродить по территории", "green"]],
                                [[["city" => 'Провинция | Карта'], "Карта", "red"], [["city" => 'Провинция | Информация'], "Осмотреться", "red"]],
                                [[["city" => 'Провинция | Город'], "$tx2", "blue"]]
                                ]);
                            mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Провинция' WHERE Ид = $id");
                        }
                        else
                        {
                            $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
                            $vk->sendbutton($user['Ид'], "Вы вернулись на Центральную площадь", [
                                [[["city" => 'bank'], "Банк", "green"], [["city" => 'shop'], "Магазин", "green"]],
                                [[["city" => 'property'],"Недвижимость","red"],[["city" => 'work'],"Работа","red"],[["city" => 'tavern'],"Бар","red"]],
                                [[["city" => 'town'], "{$loc['Тип']}: {$user['Локация']}","blue"]]
                                ]);
                            mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Поселение' WHERE Ид = $id");
                        }
                        /////
                        break;
                    case 'Образец':
                        # code...
                        break;
                }  // Числовые
            }
            else
            {
                switch ($mess[0])
                {
                    case 'подтвердить':
                        switch ($user['Меню'])
                        {
                        case 'Расформирование части':
                            $army = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE Командир = {$user['Ид']}"));
                            mysqli_query($Connect, "DELETE FROM Enclave_army WHERE Командир = {$user['Ид']}");
                            $vk->sendmessage($id,"Вы расформировали подразделение №{$army['sys_id']}.");
                            $vk->sendmessage(VK_LOG_TECH,"[id{$user['Ид']}|{$user['Вк_Имя']}] расформировал подразделение №{$army['sys_id']}.");
                            /////
                            $map = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE Название = '{$user['Локация']}'"));
                            if(isset($map))
                            {
                                if ($map['Температура'] < 0)
                                    $tx1 = '-';
                                if ($map['Температура'] >= 0)
                                    $tx1 = '+';
                                $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Провинция = {$map['sys_id']}"));
                                if ($loc['Название'] != NULL)
                                    $tx2 = "Войти в {$loc['Название']}";
                                else
                                    $tx2 = "Искать поселение";
                                $vk->sendbutton($user['Ид'], "Вы покинули {$user['Локация']}.\n\nИнформация о провинции:\nГосударство-владелец: {$map['Государство']}.\nНазвание: {$map['Название']}.\nТип местности: {$map['Местность']}.\nТемпература: $tx1{$map['Температура']}\nРадиация: {$map['Радиация']} рад/час", [
                                    [[["city" => 'Провинция | Бродить'], "Побродить по территории", "green"]],
                                    [[["city" => 'Провинция | Карта'], "Карта", "red"], [["city" => 'Провинция | Информация'], "Осмотреться", "red"]],
                                    [[["city" => 'Провинция | Город'], "$tx2", "blue"]]
                                    ]);
                                mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Провинция' WHERE Ид = $id");
                            }
                            else
                            {
                                $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
                                $vk->sendbutton($user['Ид'], "Вы вернулись на Центральную площадь", [
                                    [[["city" => 'bank'], "Банк", "green"], [["city" => 'shop'], "Магазин", "green"]],
                                    [[["city" => 'property'],"Недвижимость","red"],[["city" => 'work'],"Работа","red"],[["city" => 'tavern'],"Бар","red"]],
                                    [[["city" => 'town'], "{$loc['Тип']}: {$user['Локация']}","blue"]]
                                    ]);
                                mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Поселение' WHERE Ид = $id");
                            }
                            /////
                            break;
                        }
                        break;
                    case 'состояние':
                        $js_char = json_decode($user['Характеристики'], TRUE);
                        $val = $js_char['Навыки']['Выносливость'] * 5;
                        $val2 = $js_char['Навыки']['Выносливость'] * 3;
                        $val3 = 4 * $js_char['Характеристики']['Уровень'];
                        $val4 = $js_char['Навыки']['Выносливость'] * 2;
                        $val5 = round($js_char['Характеристики']['Радиация'], 2);
                        $val6 = round($js_char['Характеристики']['Хп'], 2);
                        $text = "ХП[$val6/$val]:РД[$val5/$val4]СТ[{$js_char['Характеристики']['Сытость']}/100]:БД[{$js_char['Характеристики']['Бодрость']}/$val2]";
                        $vk->sendmessage($peer_id, "$text");
                        break;
                    case 'чат':
                        $vk->sendmessage($peer_id, "1.Сказать [текст] - отправляет сообщение всем присутствующим\n2.Осмотреться - выдает список всех сидящих в баре.");
                        break;
                    case 'кости':
                        $rand = rand(4,24);
                        $vk->sendmessage($peer_id, "Вам выпало: $rand!");
                        break;
                    case 'достижения':
                        $js_bonus = json_decode($user['Бонус'], TRUE);
                        $i = 0;
                        $text .= "\nДостижения:";
                        foreach ($js_bonus as $achievement => $value)
                        {
                            $i++;
                            $text .= "\n$i.$achievement";
                        }
                        $vk->sendmessage($peer_id, "$text");
                        mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Достижения' WHERE Ид = $id");
                        break;
                    case 'персонаж':
                        $js_char = json_decode($user['Характеристики'], TRUE);
                        $val3 = 4 * $js_char['Характеристики']['Уровень'];
                        $text .= "\nХарактеристики персонажа:\nУровень персонажа: {$js_char['Характеристики']['Уровень']}\nОпыт [{$js_char['Характеристики']['Опыт']}/$val3]\nНавыки:";
                        foreach ($js_char['Навыки'] as $atribute => $value)
                            $text .= "\n$atribute: $value";
                        $text .= "\n\nОчки навыков: {$js_char['Характеристики']['Очки навыков']}\nДля повышения навыков используйте команду: \n[*навык* *число очков*].\nПример: Меткость 4 - повысит показатель меткости на 4.";
                        $vk->sendmessage($peer_id, "$text");
                        mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Персонаж' WHERE Ид = $id");
                        break;
                    case 'инвентарь':
                        if ($user['Локация'] != 'Путешествие')
                        {
                            $js_invent = json_decode($user['Инвентарь'], TRUE);
                            $text = '';
                            foreach ($js_invent['Сумка'] as $key => $value)
                            {
                                if ($key != 0)
                                    $text .= "$key.$value\n";
                            }
                            $js_invent['Кошелек'] = round($js_invent['Кошелек'], 2);
                            $vk->sendmessage($peer_id, "Инвентарь персонажа:\nКошелек: [{$js_invent['Кошелек']}]\n*\nОдежда:{$js_invent['Одежда']}\nОружие: {$js_invent['Оружие']}\nТранспорт: {$user['Транспорт']}.\n*\nСнаряжение:\nСлот 1: {$js_invent['Слоты']['Слот 1']}\nСлот 2: {$js_invent['Слоты']['Слот 2']}\nСлот 3: {$js_invent['Слоты']['Слот 3']}\nСлот 4: {$js_invent['Слоты']['Слот 4']}\nСумки:\n$text Свободного места в сумках: {$js_invent['Сумка'][0]}.");
                        }
                        else
                            $vk->sendMessage($id, "Во время путешествия эта функция недоступна.");
                        break;
                    case 'помощь':
                        $vk->sendmessage($peer_id, "
                            Выберите интересующий вас раздел:\n1.Помощь игр - команды игрока.\n2.Помощь прав - команды правителей.\n3.Помощь губер - команды губернаторов\n4.Помощь адм - команды администрации.\n\nПример: если ввести Помощь игр - выйдет список команд, которыми может воспользоваться любой игрок.");
                        break;
                    case 'гайд':
                        $vk->sendMessage($peer_id, "[id$id|{$user['Вк_Имя']}], этот гайд был написан специально для тебя");
                        $vk->sendMessage($peer_id, СТАРТ_ГАЙД);
                        break;
                    case 'паспорт':
                        $js_char = json_decode($user['Характеристики'], TRUE);
                        $vk->sendmessage($peer_id, "[ID_CARD:{$user['sys_id']}]\nПрозвище: {$user['Вк_Имя']}\nГражданство: {$user['Подданство']}.\nПоложение: {$user['Титул']}.\nПрописка: {$user['Прописка']}.\nСтаж проживания: {$js_char['Паспорт']['Время проживания']} сол.\n");
                        break;
                    case 'виза':
                        $js_visa = json_decode($user['Виза'], TRUE);
                        $i = 0;
                        foreach ($js_visa as $key => $value)
                        {
                            $i++;
                            $text .= "$i.$key: $value\n";
                        }
                        $vk->sendmessage($peer_id, "[ID_CARD:{$user['sys_id']}]\nПрозвище: {$user['Вк_Имя']}\nСписок виз:\n$text");
                        break;
                    case 'клавиатура':
                        if ($user['Локация'] != 'Путешествие')
                            Панель_Клавиатуры($user);
                        else
                            $vk->sendmessage($id, "Во время путешествия команда \"Клавиатура\" недоступна.");
                        break;
                    case 'патруль':
                        if($user['Статус'] == 'Тюрьма')
                        {
                            $vk->sendmessage($id,"Вы в тюрьме. Это действие вам недоступно.");
                            exit();
                        }
                        if($user['Статус'] == 'Поселение')
                        {
                            $js_invent = json_decode($user['Инвентарь'],TRUE);
                            if($js_invent['Кошелек'] >= СТ_ПАТРУЛЬ )
                            {
                                $js_invent['Кошелек'] -= СТ_ПАТРУЛЬ;
                                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                                $js_char = json_decode($user['Характеристики'],TRUE);
                                if ($js_char['Характеристики']['Уровень'] >= 10 )
                                {
                                    if ($js_char['Паспорт']['Время проживания'] >= 15)
                                    {
                                        if ($user['Подданство'] == $loc['Государство'])
                                        {
                                            $z = mysqli_query($Connect, "SELECT * FROM Several_travel WHERE Тип_События = 'Патруль'");
                                            while ($x = mysqli_fetch_assoc($z))
                                            {
                                                $js_ev = json_decode($x['Информация'],TRUE);
                                                if($js_ev['Командир Ид'] == $id)
                                                    $i = 1;
                                            }
                                            if ($i != 1)
                                            {
                                                //Создание события
                                                $js_event['Город'] = $user['Локация'];
                                                $js_event['Командир Ид'] = $user['Ид'];
                                                $js_event['Командир Имя'] = $user['Вк_Имя'];
                                                $time = time();
                                                $time_finish = $time + 24 * 3600;
                                                $js_event = json_encode($js_event, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                                                $db->query("INSERT INTO Several_travel (Информация,Время_События,Тип_События) VALUES ('?s',?i,'?s')", $js_event,$time_finish,'Патруль');
                                                //
                                                mysqli_query($Connect, "UPDATE Several_towns SET Порядок = Порядок + 1 WHERE Название = '{$user['Локация']}'");
                                                mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '{$js_invent}' WHERE Ид = '{$user['Ид']}'");
                                                $vk->sendmessage(VK_LOG_TECH,"Патруль.\nИгрок: [id$id|{$user['Вк_Имя']}].\nЛокация: {$user['Локация']}.");
                                                $vk->sendmessage($id,"Вы заступили в патруль города {$user['Локация']}.\nПатруль продлится 24 часа.");
                                            }
                                            else
                                                $vk->sendmessage($id,"Вы уже заступили в патруль в городе {$js_ev['Город']}.");
                                        }
                                        else
                                            $vk->sendmessage($id,"Для патруля необходимо быть подданым государства-владельца.");
                                    }
                                    else
                                        $vk->sendmessage($id,"Для патруля необходимо иметь минимум 15+ стаж проживания.");
                                }
                                else
                                    $vk->sendmessage($id,"Для патруля необходимо иметь минимум 10-ый уровень.");
                            }
                            else
                                $vk->sendmessage($id,"Патруль стоит 2.000.\nУ вас недостаточно средств.");
                        }
                        break;
                }
                    /*if ($mess[0] == 'подтвердить')
                    {
                    }
                     if ($mess[0] == 'Состояние' OR $mess[0] == 'состояние')
                    {
                    }
                    if ($mess[0] == 'Чат' or $mess[0] == 'чат')
                    if ($mess[0] == 'Кости')
                    {
                    }
                    if ($mess[0] == 'Достижения' OR $mess[0] == 'достижения')
                    {
                    }
                    if ($mess[0] == 'Персонаж' OR $mess[0] == 'персонаж')
                    {
                    }
                    if ($mess[0] == 'Инвентарь' OR $mess[0] == 'инвентарь')
                    {
                    }
                    if ($mess[0] == 'Помощь' or $mess[0] == 'помощь')
                    if ($mess[0] == 'Гайд' OR $mess[0] == 'гайд')
                    {
                    }
                    if ($mess[0] == 'Паспорт' or $mess[0] == 'паспорт')
                    {
                    }
                    if ($mess[0] == 'Виза' or $mess[0] == 'виза')
                    {
                    }
                    if ($mess[0] == 'Клавиатура' or $mess[0] == 'клавиатура')
                    {
                        // // // // // // // // // // // // //
                        // // // // // // // // // // // // // // Текстовые
                    }*/
            }
            /*if ($mess[0] == 'Патруль' or $mess[0] == 'патруль')
            {

            }*/
            break; // В одно слово
        case '2':
            if ($user['Меню'] == 'Персонаж')
            {
                if ($peer_id != $id)
                    exit;
                mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
                $pr = 0;
                $js_char = json_decode($user['Характеристики'], TRUE);
                foreach ($js_char['Навыки'] as $atribute => $value)
                {
                    if ($mess[0] == $atribute)
                    { //тут проблема
                        $pr = 1;
                        if (is_numeric($mess[1]))
                        {
                            $val = floor($mess[1]);
                            if ($val > 0)
                            {
                                $js_char = json_decode($user['Характеристики'], TRUE);
                                if ($js_char['Характеристики']['Очки навыков'] >= $val)
                                {
                                    $js_char['Характеристики']['Очки навыков'] -= $val;
                                    $js_char['Навыки']["$mess[0]"] += $val;
                                    $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                                    $vk->sendmessage($peer_id, "Вы повысили показатель \"$mess[0]\" на $mess[1] ед.");
                                    mysqli_query($Connect, "UPDATE Several_user SET Характеристики = '$js_char' WHERE Ид = $id");
                                }
                                else
                                    $vk->sendmessage($peer_id, "У вас нет столько очков, повышайте уровень чтобы получить их!");
                            }
                            else
                                $vk->sendmessage($peer_id, "У вас нет очков навыков, повышайте уровень чтобы получить их!");
                        }
                        else
                            $vk->sendmessage($peer_id, "Введите число, на которое надо увеличить характеристику.");
                    }
                }
                if ($pr == 0)
                	$vk->sendMessage($id, "Такого навыка не существует.");
                $vk->sendMessage($id, "Вы вышли из меню редактирования навыков.\nДля повторного входа введите слово: Персонаж.");

                //mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Город' WHERE Ид = $id");,
                break;
            }
            //
            if ($mess[0] . $mess[1] == 'Картамира')
                $vk->sendmessage($peer_id, КАРТА_ПОЛИТИЧЕСКАЯ);
            if ($mess[0] . $mess[1] == 'Списокграждан' AND $peer_id == $id)
            {
                if ($user['Титул'] == 'Правитель' OR $id == ИД_ХАРТМАНН OR $id == ИД_ПАВЕЛ)
                {
                    $i = 0;
                    $z = mysqli_query($Connect, "SELECT * FROM Several_user order by Вк_Имя asc");
                    while ($res = mysqli_fetch_assoc($z))
                    {
                        if ($res['Подданство'] == $user['Подданство'])
                        {
                            $i++;
                            $ii["{$res['Прописка']}"]++;
                            $text["{$res['Прописка']}"] .= "{$ii["{$res['Прописка']}"]}.{$res['Вк_Имя']}[{$res['sys_id']}] - {$res['Титул']}\n";
                        }
                    }
                    foreach ($text as $key => $value)
                        $tx .= "Граждане города $key [{$ii["$key"]}]:\n $value\n";
                    $vk->sendMessage($id, "$tx\nВсего жителей: $i");
                }
                else
                    $vk->sendMessage($id, "Вы не являетесь правителем");
            }
            if ($mess[0] . $mess[1] == 'Списокжителей' AND $peer_id == $id)
            {
                $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Прописка']}'"));
                if ($user['Титул'] == 'Правитель' OR $id == ИД_ХАРТМАНН OR $id == ИД_ПАВЕЛ)
                {
                    $i = 0;
                    $z = mysqli_query($Connect, "SELECT * FROM Several_user order by Вк_Имя asc");
                    while ($res = mysqli_fetch_assoc($z))
                    {
                        if ($res['Подданство'] == $user['Подданство'])
                        {
                            $i++;
                            $ii["{$res['Прописка']}"]++;
                            $text["{$res['Прописка']}"] .= "{$ii["{$res['Прописка']}"]}.{$res['Вк_Имя']}[{$res['sys_id']}] - {$res['Титул']}\n";
                        }
                    }
                    foreach ($text as $key => $value)
                        $tx .= "Граждане города $key [{$ii["$key"]}]:\n $value\n";
                    $vk->sendMessage($id, "$tx\nВсего жителей: $i");
                }
                else
                    $vk->sendMessage($id, "Вы не являетесь правителем");
            }
            if ($mess[0] . $mess[1] == 'Списокбизнесов')
            {
                if ($loc['Владелец'] == $id OR $id == ИД_ХАРТМАНН OR $id == ИД_ПАВЕЛ)
                {
                    if ($user['Статус'] == 'Поселение')
                    {
                        $text = "";
                        $i = 0    ;
                        $i_sum = 0;
                        $z = mysqli_query($Connect, "SELECT * FROM Several_build order by Вк_Имя asc, Прибыль asc");
                        while ($res = mysqli_fetch_assoc($z))
                        {
                            if ($res['Локация'] == $user['Локация'])
                            {
                                if ($where_space != $res['Вк_Имя'] OR $i == 0)
                                {
                                    $user_other = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE Вк_Имя = '{$res['Вк_Имя']}'"));
                                    $text .= "\n\nВладелец: {$res['Вк_Имя']}[{$user_other['sys_id']}]:\n";
                                    $where_space = $res['Вк_Имя'];
                                    $i = 0;
                                }
                                $i++;
                                $i_sum++;
                                $text .= "$i.Бизнес: {$res['Название']}\n";
                                if($i_sum == 40)
                                {
                                    $vk->sendMessage($id, "$text");
                                    $text = '';
                                }
                            }
                        }
                        if ($i == 0)
                            $text = "К сожалению, в вашем городе бизнесов нет.";
                        $vk->sendMessage($id, "$text\nВсего бизнесов: $i_sum");
                    }
                    else
                        $vk->sendMessage($id, "Чтобы зайти в окно города, необходимо быть на центр.площади.");
                }
                else
                    $vk->sendMessage($id, "Вы не владелец этого города.");
            }
            if ($mess[0] . $mess[1] == 'Окногорода' AND $peer_id == $id)
            {
                if($user['Статус'] == 'Тюрьма')
                {
                    $vk->sendmessage($id,"Вы в тюрьме. Это действие вам недоступно.");
                    exit();
                }
                if ($loc['Владелец'] == $id OR $id == ИД_ХАРТМАНН OR $id == ИД_ПАВЕЛ)
                {
                    if ($user['Статус'] == 'Поселение')
                        $vk->sendbutton($id, "Вы вошли в окно управления городом {$loc['Название']}.", [
                            [[["Город" => 'Город | Армия'], "Армия", "green"], [["Город" => 'Город | Экономика'], "Экономика", "green"]],
                            [[['city' => 'exit_in_town'], "Закрыть окно города", 'white']]]);
                    else
                        $vk->sendMessage($id, "Чтобы зайти в окно города, необходимо быть на центр.площади.");
                }
                else
                    $vk->sendMessage($id, "Вы не владелец этого города.");
            }
            if ($mess[0] . $mess[1] == 'Окноармии' AND $peer_id == $id)
            {
                $army = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE Командир = $id"));
                if(isset($army))
                {
                    if($army['Локация'] == $user['Локация'])
                    {
                        $vk->sendbutton($id, "Вы вошли в окно управления подразделением №{$army['sys_id']}.", [
                            [[["city" => 'Армия | Информация'], "Информация", "green"], [["city" => 'Армия | Провинция'], "Провинция", "green"],[["city" => 'Армия | Командование'], "Командование", "green"]],
                            [[['city' => 'Армия | Статус:Ожидание'], "Статус: Ожидание", 'red']],
                            [[['city' => 'Закрыть окно'], "Покинуть часть", 'white']]
                            ]);
                        mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Военная часть' WHERE Ид = $id");
                    }
                    else
                        $vk->sendmessage($id,"Ваше подразделение в {$army['Локация']}.\nДля открытия окна вернитесь туда.");
                }
                else
                    $vk->sendmessage($id,"Под вашим управлением нет подразделений.");
            }
            if ($mess[0] . $mess[1] == 'Окнокорпорации')
            {
                if($user['Статус'] == 'Тюрьма')
                {
                    $vk->sendmessage($id,"Вы в тюрьме. Это действие вам недоступно.");
                    exit();
                }
                Орг_Окно($user);
            }
            if ($mess[0] == 'Путь')
            {
                $map = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE Название = '{$user['Локация']}'"));
                switch ($user['Статус'])
                {
                case 'Карта':
                    //Расчёт Ареста//
                    $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$map['Владелец']}'"));
                    $js_visa = json_decode($user['Виза'],TRUE);
                    if($js_visa["{$map['Государство']}"] == 'Получена')
                        $chance = -10000;
                    if($js_visa["{$map['Государство']}"] == 'Розыск')
                        $chance += 10;
                    if($js_visa["{$map['Государство']}"] == NULL OR $js_visa["{$map['Государство']}"] == 'Нет')
                        $chance += 5;
                    $chance += $town['Порядок'] * 5;
                    $rand = rand(0,100);
                    if($chance >= $rand)
                    { // Происходит арест
                        mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Конец_Срока = 5, Статус = 'Тюрьма', Локация = '{$town['Название']}' WHERE Ид = {$user['Ид']}");
                        $vk->sendMessage($town['Владелец'], "[id{$user['Ид']}|{$user['Вк_Имя']}][{$user['sys_id']}] был арестован в одной из ваших провинций.");
                        $vk->sendbutton($user['Ид'], "Путешествуя вы наткнулись на патруль.\nВас заключили под арест и отправили в {$town['Название']}!", [
                            [[["city" => 'Тюрьма'], "Вы в тюрьме!", "red"]]
                            ]);
                            $vk->sendMessage(VK_LOG_TECH, "[id{$user['Ид']}|{$user['Вк_Имя']}][{$user['sys_id']}] был арестован во время путешествия.[{$town['Название']}]");
                            exit();
                    }
                    //Конец Расчета Ареста
                    $js_map = json_decode($map['Пути'], TRUE);
                    $i = 0;
                    foreach ($js_map['Путь'] as $reg => $s)
                    {
                        $i++;
                        if ($mess[1] == $i)
                        {
                            $speed = $user['Личная Скорость'];
                            $time = ($s * 1000) / $speed;
                            $time_min = floor($time / 60);
                            $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE sys_id = $reg"));
                            $vk->sendbutton($id, "Вы отправились в {$loc['Название']}.\nПуть займет около $time_min минут.\nДорога полна опасностей, будем надеяться что вы окажетесь сильнее.\n", [
                                [[["city" => 'Путешествие | Время'], "Путешествие", "blue"]]
                                ]);
                            $travel_finish = time() + $time; // Расчитываем время прибытия. Текущее время + 60(Расстояние\Скорость);
                            $js_event['Игрок'] = $id;
                            $js_event['Место прибытия'] = $loc['Название'];
                            $event = 'Путешествие';
                            $js_event = json_encode($js_event, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                            $db->query("INSERT INTO Several_travel (Информация,Время_События,Тип_События) VALUES ('?s',?i,'?s')",$js_event,$travel_finish,$event);
                            mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Путешествие' WHERE Ид = $id");
                        }
                    }
                    break;
                case 'Военная часть':
                    $js_map = json_decode($map['Пути'], TRUE);
                    $i = 0;
                    foreach ($js_map['Путь'] as $reg => $s)
                    {
                        $i++;
                        if ($mess[1] == $i)
                        {
                            $speed = 16.6;
                            $time = ($s * 1000) / $speed;
                            $time_min = floor($time / 60);
                            $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE sys_id = $reg"));
                            $army = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE Командир = $id"));
                            $vk->sendbutton($id, "Вместе с подразделением вы отправились в {$loc['Название']}.\nПуть займет около $time_min минут.\n", [
                                [[["city" => 'Путешествие | Время'], "Марш", "blue"]]
                                ]);
                            $travel_finish = time() + $time; // Расчитываем время прибытия. Текущее время + 60(Расстояние\Скорость);
                            $js_event['Игрок'] = $id;
                            $js_event['Подразделение'] = $army['sys_id'];
                            $js_event['Место прибытия'] = $loc['Название'];
                            $event = 'Марш';
                            $js_event = json_encode($js_event, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                            $db->query("INSERT INTO Several_travel (Информация,Время_События,Тип_События) VALUES ('?s',?i,'?s')",$js_event,$travel_finish,$event);
                            mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Путешествие' WHERE Ид = $id");
                            mysqli_query($Connect, "UPDATE Enclave_army SET Окапывание = 0 WHERE Командир = $id");
                        }
                    }
                    break;
                }
            }
            if ($mess[0] == 'Освободить')
            {
                if($user['Статус'] == 'Тюрьма')
                {
                    $vk->sendmessage($id,"Вы в тюрьме. Это действие вам недоступно.");
                    exit();
                }
                if ($loc['Владелец'] == $id OR $id == ИД_ХАРТМАНН OR $id == ИД_ПАВЕЛ)
                {
                    $ban_user = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[1]")); // Юзер которого баним.
                    if($ban_user['Статус'] == 'Тюрьма')
                    {
                        if($ban_user['Локация'] == $user['Локация'])
                        {
                            mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Конец_Срока = 0, Тюрьма_Авторитет = 0, Тюрьма_Смена = 0, Тюрьма_Срок = 0, Статус = 'Поселение' WHERE Ид = {$ban_user['Ид']}");
                            $vk->sendMessage($user['Ид'], "[id{$ban_user['Ид']}|{$ban_user['Вк_Имя']}][{$ban_user['sys_id']}] был освобожден.");
                            $ban_user['Статус'] = 'Поселение';
                            $vk->sendMessage($ban_user['Ид'], "[id{$user['Ид']}|{$user['Вк_Имя']}][{$user['sys_id']}] приказал освободить вас! Вы свободны!");
                            Панель_Клавиатуры($ban_user);
                            $vk->sendMessage(VK_LOG_TECH, "[id{$ban_user['Ид']}|{$ban_user['Вк_Имя']}][{$ban_user['sys_id']}] был освобожден.");
                        }
                        else
                            $vk->sendMessage($id, "Этот человек не в вашей тюрьме.");
                    }
                    else
                    $vk->sendMessage($id, "Этот человек не тюрьме.");
                }
                else
                    $vk->sendMessage($id, "Вы не владелец этого города.");
            }
            if ($mess[0] == 'Одобрить')
            {
                $event = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Решения WHERE sys_id = {$mess[1]}"));
                switch ($event['Тип'])
                {
                case 'Запрос прописки':
                    $js_event = json_decode($event['Содержание'],TRUE);
                    $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$js_event['ФМС']}'"));
                    if($user['Ид'] != $town['Владелец'])
                    {
                        $vk->sendmessage($user['Ид'],"Только управитель города может принимать решение по заявке о прописке.");
                        exit();
                    }
                    if($js_event['Имигрант_подданство'] != $town['Государство'])
                    {
                        $js_visa["{$town['Государство']}"] = 'Получена';
                        $js_visa = json_encode($js_visa, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                        mysqli_query($Connect, "UPDATE Several_user SET Виза = '$js_visa' WHERE Ид = {$js_event['Имигрант_ид']}");
                    }
                    mysqli_query($Connect, "UPDATE Several_user SET Титул = 'Гражданин', Прописка = '{$town['Название']}', Подданство = '{$town['Государство']}' WHERE Ид = {$js_event['Имигрант_ид']}");
                    mysqli_query($Connect, "DELETE FROM Решения WHERE sys_id = {$mess[1]}");
                    $vk->sendmessage($user['Ид'],"Вы одобрили получение прописки в вашем городе для [id{$js_event['Имигрант_ид']}|{$js_event['Имигрант_имя']}].");
                    $vk->sendmessage(VK_LOG_TECH,"[id{$js_event['Имигрант_ид']}|{$js_event['Имигрант_имя']}] получил прописку в городе {$town['Название']}.");
                    $vk->sendmessage($js_event['Имигрант_ид'],"Вашу заявку на получение прописки в городе {$town['Название']} одобрили. Не забудьте обновить визы!");
                    break;
                }
            }
            if ($mess[0] == 'Отклонить')
            {
                $event = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Решения WHERE sys_id = $mess[1]"));
                switch ($event['Тип'])
                {
                case 'Запрос прописки':
                    $js_event = json_decode($event['Содержание'],TRUE);
                    $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$js_event['ФМС']}'"));
                    if($user['Ид'] != $town['Владелец'])
                    {
                        $vk->sendmessage($user['Ид'],"Только управитель города может принимать решение по заявке о прописке.");
                        exit();
                    }
                    mysqli_query($Connect, "DELETE FROM Решения WHERE sys_id = {$mess[1]}");
                    $vk->sendmessage($user['Ид'],"Вы отклонили получение прописки в вашем городе для [id{$js_event['Имигрант_ид']}|{$js_event['Имигрант_имя']}].");
                    $vk->sendmessage($js_event['Имигрант_ид'],"Вашу заявку на получение прописки в городе {$town['Название']} отклонили. Вы можете попробовать подать её вновь.");
                    break;
                }
            }                //
            if ($message == 'Помощь губер' or $message == 'помощь губер')
                $vk->sendmessage($peer_id, "
                    1.Окно города - позволяет зайти в окно управления городом, в котором на данный момент находится губернатор.\n2.Список бизнесов - команда позволяет губернатору быть в курсе, кто владеет в его городе бизнесом, какого он рода и прибыли. Важно. Нужно находиться в городе, в котором назначен губернатором.");
            if ($message == 'Помощь адм' or $message == 'помощь адм')
                $vk->sendmessage($peer_id, "
                    1.Выдать валюту [Сумма] [Ид] - выдает деньги.\n2.Короновать [Ид] - выдает положение правителя.\n3.Тп [Ид] [Название поселения] - телепортирует игрока в выбранную локацию.\n4./Снаряжение [Вк_Имя] - выдает список оружия и брони игрока\n5.[ДАННЫЕ УДАЛЕНЫ]\n{$user['Вк_Имя']}, у Вас нет прав видеть весь список...");
            if ($message == 'Помощь прав' or $message == 'помощь прав')
                $vk->sendmessage($peer_id, "
                    1.Соц.Статус [Ид] [Титул] - меняет подданому положение на выбранный титул. Может быть любой на выбор правителя, в том числе состоять из нескольких слов. Максимальная длина титула: 32 символа с учетом пробелов. Важно! Правителю не стоит менять самому себе положение.\n2.Назначить [Ид] [Город] - назначает человека губернатором выбранного города.\n3.Список граждан - команда выводит список всех подданых государства Правителя.");
            if ($message == 'Помощь игр' or $message == 'помощь игр')
                $vk->sendmessage($peer_id, "
                    1.Карта мира - присылает ссылку на политическую карту мира.\n2.Передать [Сумма] [ID_CARD] - передача денег.\n3.Паспорт - показывает информацию о статусе.\n4.Состояние - показывает состояние персонажа.\n5.Инвентарь - показывает личные вещи персонажа.\n6.Персонаж - показывает информацию о характеристиках персонажа.\n7.Клавиатура - команда дебага. Показывает кнопки в случае их пропажи.\n8.Сменить подданство - меняет подданство на подданство гос-тва в котором находится игрок.\n9.Достижения - показывает список достижений игрока. Если после этого ввести номер имеющегося достижения, можно будет увидеть его краткое описание.");
            if ($mess[0] . $mess[1] == 'Запроситьпрописку')
            {
                if($user['Статус'] != 'Поселение')
                {
                    $vk->sendMessage($peer_id, "Для смены места прописки необходимо находится в поселении.");
                    exit();
                }
                $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
                if($town['Название'] == $user['Прописка'] AND $user['Подданство'] == $town['Государство'])
                {
                    $vk->sendMessage($peer_id, "Вы уже имеете здесь прописку.");
                    exit();
                }
                $z = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Решения WHERE Инициатор = {$user['Ид']} AND Тип = 'Запрос прописки'"));
                if(isset($z))
                {
                    $vk->sendMessage($peer_id, "Вы уже отправили запрос на получение прописки. Ожидайте.");
                    exit();
                }
                //Создание решения
                $js_event['Имигрант_ид'] = $user['Ид'];
                $js_event['Имигрант_имя'] = $user['Вк_Имя'];
                $js_event['Имигрант_подданство'] = $user['Подданство'];
                $js_event['ФМС'] = $town['Название'];
                $time = time();
                $time_finish = $time + 24 * 3600;
                $js_event = json_encode($js_event, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                $db->query("INSERT INTO Решения (Содержание,Срок,Тип,Инициатор) VALUES ('?s',?i,'?s',?i)", $js_event,$time_finish,'Запрос прописки',$user['Ид']);
                //
                $z = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Решения ORDER BY sys_id DESC"));
                $x = $z['sys_id'];
                $vk->sendMessage($peer_id, "Вы отправили запрос на получение прописки. [id{$town['Владелец']}|{$town['Вк_Имя']}] вскоре его рассмотрит.Номер вашей заявки - $x.");
                $vk->sendMessage($town['Владелец'], "[Заявка №$x]\n[id{$user['Ид']}|{$user['Вк_Имя']}] отправил вам запрос на получение прописки в городе {$town['Название']}.\n\nВведите \"Одобрить $x\" или \"Отклонить $x\".");
            }
            break; // В два слова// В два слова
        case '3':
            if ($mess[0].$mess[1] == 'Выдатьвизу')
            {
                if ($user['Титул'] == 'Правитель')
                {
                    $user_pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[2]")); // Юзер которого баним.
                    $js_visa = json_decode($user_pol['Виза'],TRUE);
                    if($js_visa["{$user['Подданство']}"] != 'Получена')
                    {
                        $vk->sendMessage($user_pol['Ид'], "Вам выдали визу в государстве {$user['Подданство']}!\nТеперь вы можете без страха передвигаться по их территориям!");
                        $vk->sendMessage(VK_LOG_TECH, "[id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}][{$user_pol['sys_id']}] получил визу в государстве {$user['Подданство']}.");
                        $js_visa["{$user['Подданство']}"] = 'Получена';
                        $js_visa = json_encode($js_visa, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                        mysqli_query($Connect, "UPDATE Several_user SET Виза = '$js_visa' WHERE Ид = {$user_pol['Ид']}");
                        $vk->sendMessage($user['Ид'], "Вы выдали визу [id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}][{$user_pol['sys_id']}].\nТеперь он может спокойно путешествовать по вашим землям.");
                    }
                    else
                        $vk->sendMessage($id, "Этот человек уже имеет визу в {$user['Подданство']}.");
                }
                else
                    $vk->sendMessage($id, "Только правитель может выдавать визу.");
            }
            if ($mess[0].$mess[1] == 'Забратьвизу')
            {
                if ($user['Титул'] == 'Правитель')
                {
                    $user_pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[2]")); // Юзер которого баним.
                    $js_visa = json_decode($user_pol['Виза'],TRUE);
                    if($js_visa["{$user['Подданство']}"] != 'Нет')
                    {
                        $js_visa["{$user['Подданство']}"] = 'Нет';
                        $js_visa = json_encode($js_visa, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                        mysqli_query($Connect, "UPDATE Several_user SET Виза = '$js_visa' WHERE Ид = {$user_pol['Ид']}");
                        $vk->sendMessage($user['Ид'], "Вы забрали визу у [id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}][{$user_pol['sys_id']}].\nТеперь он не может спокойно путешествовать по вашим землям.");
                        $vk->sendMessage($user_pol['Ид'], "У вас забрали визу в государстве {$user['Подданство']}!\nТеперь вас могут арестовать на их территории!");
                        $vk->sendMessage(VK_LOG_TECH, "[id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}][{$user_pol['sys_id']}] лишился визы в государстве {$user['Подданство']}.");
                    }
                    else
                        $vk->sendMessage($id, "У этого человека итак нет визы в {$user['Подданство']}.");
                }
                else
                    $vk->sendMessage($id, "Только правитель может забирать визу.");
            }
            if ($mess[0].$mess[1] == 'Обьявитьрозыск')
            {
                if ($user['Титул'] == 'Правитель')
                {
                    $user_pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[2]")); // Юзер которого баним.
                    $js_visa = json_decode($user_pol['Виза'],TRUE);
                    if($js_visa["{$user['Подданство']}"] != 'Розыск')
                    {
                        $js_visa["{$user['Подданство']}"] = 'Розыск';
                        $js_visa = json_encode($js_visa, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                        mysqli_query($Connect, "UPDATE Several_user SET Виза = '$js_visa' WHERE Ид = {$user_pol['Ид']}");
                        $vk->sendMessage($user['Ид'], "Вы обьявили в розыск [id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}][{$user_pol['sys_id']}].\nОн будет найден!.");
                        $vk->sendMessage($user_pol['Ид'], "Вас обьявили в розыск в государстве {$user['Подданство']}!\nТеперь вас попытаются арестовать на их территории!");
                        $vk->sendMessage(VK_LOG_TECH, "[id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}][{$user_pol['sys_id']}] обьявлен в розыск в государстве {$user['Подданство']}.");
                    }
                    else
                        $vk->sendMessage($id, "Этот человек уже розыскивается в {$user['Подданство']}.");
                }
                else
                    $vk->sendMessage($id, "Только правитель может обьявить в розыск.");
            }
            if ($mess[0].$mess[1] == 'Прекратитьрозыск')
            {
                if ($user['Титул'] == 'Правитель')
                {
                    $user_pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[2]")); // Юзер которого баним.
                    $js_visa = json_decode($user_pol['Виза'],TRUE);
                    if($js_visa["{$user['Подданство']}"] != 'Нет')
                    {
                        $js_visa["{$user['Подданство']}"] = 'Нет';
                        $js_visa = json_encode($js_visa, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                        mysqli_query($Connect, "UPDATE Several_user SET Виза = '$js_visa' WHERE Ид = {$user_pol['Ид']}");
                        $vk->sendMessage($user['Ид'], "Вы прекратили розыск [id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}][{$user_pol['sys_id']}].");
                        $vk->sendMessage($user_pol['Ид'], "Вас прекратили розыскивать в государстве {$user['Подданство']}!");
                        $vk->sendMessage(VK_LOG_TECH, "[id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}][{$user_pol['sys_id']}] больше не розыскивается в государстве {$user['Подданство']}.");
                    }
                    else
                        $vk->sendMessage($id, "Этот человек не в розыске.");
                }
                else
                    $vk->sendMessage($id, "Только правитель может прекратить розыск.");
            }
            if ($mess[0] == 'Арест')
            {
                if($user['Статус'] == 'Тюрьма')
                {
                    $vk->sendmessage($id,"Вы в тюрьме. Это действие вам недоступно.");
                    exit();
                }
                if ($loc['Владелец'] == $id OR $id == ИД_ХАРТМАНН OR $id == ИД_ПАВЕЛ)
                {
                    $ban_user = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[1]")); // Юзер которого баним.
                    if($ban_user['Статус'] != 'Тюрьма')
                    {
                        if($ban_user['Локация'] == $user['Локация'])
                        {
                            mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Конец_Срока = $mess[2],Статус = 'Тюрьма' WHERE Ид = {$ban_user['Ид']}");
                            $vk->sendMessage($user['Ид'], "[id{$ban_user['Ид']}|{$ban_user['Вк_Имя']}][{$ban_user['sys_id']}] был арестован на $mess[2] суток.");
                            $vk->sendbutton($ban_user['Ид'], "Вы были арестованы!", [
                                [[["city" => 'Тюрьма'], "Вы в тюрьме!", "red"]]
                                ]);
                            $vk->sendMessage(VK_LOG_TECH, "[id{$ban_user['Ид']}|{$ban_user['Вк_Имя']}][{$ban_user['sys_id']}] был арестован на $mess[2] суток.");
                        }
                        else
                            $vk->sendMessage($id, "Этот человек не в вашем городе.");
                    }
                    else
                        $vk->sendMessage($id, "Этот человек уже в тюрьме.");
                }
                else
                    $vk->sendMessage($id, "Вы не владелец этого города.");
            }
            break; // В три слова
        case '4':
            # code...
            break; // В четыре слова
        case '5':
            # code...
            break; // В пять слов Текстовые команды
    }
    // Безразмерные команды
    if ($mess[0] . $mess[1] == 'Создатькорпорацию')
    {
        if($user['Статус'] == 'Тюрьма')
        {
            $vk->sendmessage($id,"Вы в тюрьме. Это действие вам недоступно.");
            exit();
        }
        $tx = '';
        foreach ($mess as $key => $value)
        {
            if ($key == 2)
                $tx .= "$value";
            elseif ($key > 2)
                $tx .= " $value";
        }
        Орг_Создание($user, $tx);
    }
    if ($mess[0] == 'Сказать' or $mess[0] == 'сказать')
    {
        if (count($mess) > 1)
        {
            $z = "Бар:{$user['Локация']}";
            if ($user['Меню'] == "$z")
            {
                $text = "[id$id|{$user['Вк_Имя']}] сказал: ";
                foreach ($mess as $key => $value)
                {
                    if ($key != 0)
                        $text .= "$value ";
                }
                $select = mysqli_query($Connect, "SELECT * FROM Several_user WHERE Меню = '$z'");
                while ($bar_user = mysqli_fetch_assoc($select))
                {
                    $vk->sendMessage($bar_user['Ид'], "$text");
                }
            }
        }
    }
    if ($mess[0] == 'Назначить')
    {
        if($user['Статус'] == 'Тюрьма')
        {
            $vk->sendmessage($id,"Вы в тюрьме. Это действие вам недоступно.");
            exit();
        }
        if ($user['Титул'] == 'Правитель')
        {
            $pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[1]"));
            if ($pol['Подданство'] == $user['Подданство'] OR $id == ИД_ХАРТМАНН OR $id == ИД_ПАВЕЛ)
            {
                $pol_country = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '$mess[2]'"));
                if ($user['Подданство'] == $pol_country['Государство'] OR $id == ИД_ХАРТМАНН OR $id == ИД_ПАВЕЛ)
                {
                    $vk->sendmessage($pol_country['Владелец'], "Вас сняли с должности Губернатор {$pol_country['Название']}");
                    mysqli_query($Connect, "UPDATE Several_towns SET Вк_Имя = '{$pol['Вк_Имя']}',Владелец = {$pol['Ид']} WHERE Название = '$mess[2]'");
                    $vk->sendMessage($pol['Ид'], "Вас назначили губернатором города под названием {$pol_country['Название']}.");
                    $vk->sendMessage($peer_id, " [id{$pol['Ид']}|{$pol['Вк_Имя']}] успешно назначен губернатором.");
                    $vk->sendMessage(VK_LOG_TECH, "[id{$pol['Ид']}|{$pol['Вк_Имя']}] назначен {$user['Вк_Имя']} губернатором {$pol_country['Название']}.");
                }
                else
                    $vk->sendmessage($peer_id, "Давать должность губернатора можно только в городах вашего государства.");
            }
            else
                $vk->sendMessage($peer_id, "Давать в управление города можно только своим подданым.");
        }
    }
    if ($mess[0] == 'Соц.Статус' OR $mess[0] == 'Соц.статус' OR $mess[0] == 'соц.статус')
    {
        $pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[1]"));
        $pol_town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$pol['Прописка']}'"));
        if ($pol_town['Владелец'] == $user['Ид'])
        {
            foreach ($mess as $key => $value)
            {
                if($key > 1)
                {
                    if($key == 2)
                        $tx = "$value";
                    else
                        $tx .= " $value";
                }
            }
            if($tx == 'Правитель')
            {
                $vk->sendMessage($peer_id, "Нельзя выдавать титут Правителя");
                exit();
            }
            if($tx == 'Древний Хартманн')
            {
                $vk->sendMessage($peer_id, "Пошел нахуй");
                exit();
            }
            mysqli_query($Connect, "UPDATE Several_user SET Титул = '$tx' WHERE Ид = {$pol['Ид']}");
            $vk->sendMessage($peer_id, " [id{$pol['Ид']}|{$pol['Вк_Имя']}] получил новый социальный статус \"$tx\".");
            $vk->sendMessage($pol['Ид'], "Ваше Соц.положение изменилось, теперь вы $tx!");
            $vk->sendMessage(VK_LOG_TECH, "[id{$pol['Ид']}|{$pol['Вк_Имя']}] получил новый социальный статус \"$tx\"");
        }
        else
            $vk->sendMessage($peer_id, "Менять положение можно только правителю города и только у своих горожан.");
        ////////////////////////////////////////
    }
}
/// Кейсы кнопок города ///
if (isset($payload['city']))
{
    switch ($payload['city'])
    {
        case 'Закрыть окно':
            $map = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE Название = '{$user['Локация']}'"));
            if(isset($map))
            {
                if ($map['Температура'] < 0)
                    $tx1 = '-';
                if ($map['Температура'] >= 0)
                    $tx1 = '+';
                $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Провинция = {$map['sys_id']}"));
                if ($loc['Название'] != NULL)
                    $tx2 = "Войти в {$loc['Название']}";
                else
                    $tx2 = "Искать поселение";
                $vk->sendbutton($id, "Вы покинули {$user['Локация']}.\n\nИнформация о провинции:\nГосударство-владелец: {$map['Государство']}.\nНазвание: {$map['Название']}.\nТип местности: {$map['Местность']}.\nТемпература: $tx1{$map['Температура']}\nРадиация: {$map['Радиация']} рад/час", [
                    [[["city" => 'Провинция | Бродить'], "Побродить по территории", "green"]],
                    [[["city" => 'Провинция | Карта'], "Карта", "red"], [["city" => 'Провинция | Информация'], "Осмотреться", "red"]],
                    [[["city" => 'Провинция | Город'], "$tx2", "blue"]]
                    ]);
                mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Провинция' WHERE Ид = $id");
            }
            else
            {
                $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
                $vk->sendbutton($id, "Вы вернулись на Центральную площадь", [
                    [BTN_BANK, BTN_SHOP],
                    [BTN_PROPERTY, BTN_WORK, BTN_TAVERN],
                    [[["city" => 'town'], "{$loc['Тип']}: {$user['Локация']}", "blue"]]
                    ]);
                mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Поселение' WHERE Ид = $id");
            }
            break;
        //
        case 'Тюрьма':
            $vk->sendbutton($id, "Вы находитесь в тюрьме {$loc['Название']}.\nЧто дальше?", [
                [[['city' => 'Тюрьма | Работа'], "Исправительные работы", 'blue']],
                [[['city' => 'Тюрьма | Камера'], "Камера", 'blue'],[['city' => 'Тюрьма | Столовая'], "Столовая", 'blue']],
                [[['city' => 'Тюрьма | Информация'], "Информация", 'white']]
                ]);
            mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
            break;
        case 'Тюрьма | Информация':
            $auth = 'Опущенный';
            if($user['Тюрьма_Авторитет'] >= -25)
                $auth = 'Шестерка';
            if($user['Тюрьма_Авторитет'] >= -10)
                $auth = 'Бегунок';
            if($user['Тюрьма_Авторитет'] >= 0)
                $auth = 'Незаметная тень';
            if($user['Тюрьма_Авторитет'] >= 10)
                $auth = 'Нормальный мужик';
            if($user['Тюрьма_Авторитет'] >= 20)
                $auth = 'Свояк';
            if($user['Тюрьма_Авторитет'] >= 50)
                $auth = 'Блатной';
            if($user['Тюрьма_Авторитет'] >= 75)
                $auth = 'Смотрящий';
            if($user['Тюрьма_Авторитет'] >= 100)
                $auth = 'Пахан';
            $vk->sendmessage($id,"Вы находитесь в тюрьме города {$user['Локация']}.\nСрок заключения: {$user['Тюрьма_Срок']}.\nДо конца срока: {$user['Тюрьма_Конец_Срока']}.\nСмен отработано за весь срок: {$user['Тюрьма_Смена']}.\nВаше положение: $auth.");

            mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
            break;
        case 'Тюрьма | Работа':
            $vk->sendbutton($id, "Вы пришли на исправительные работы.\nЗдесь можно подзаработать деньжат, а так же выслужится перед начальником.\nМожно увидеть как опущеные работают, а паханы сидят и играют в кости.\nЧто будете делать вы?", [
                [[['city' => 'Тюрьма | Работа | Смена'], "Отработать смену", 'blue']],
                [[['city' => 'Тюрьма | Работа | Кости'], "Сыграть кости", 'blue']],
                [[['city' => 'Тюрьма'], "Тюрьма", 'white']]
                ]);
            break;
        case 'Тюрьма | Работа | Кости':
            if($user['Тюрьма_Авторитет'] >= 50)
                $vk->sendbutton($id, "Вы подошли к блатным для того чтобы поиграть, они кивнули вам в знак того что вы можете присоединиться. Сколько будете ставить?", [
                    [[['city' => 'Тюрьма | Работа | Кости | 25'], "[25]Начнем с малого!", 'blue'],[['city' => 'Тюрьма | Работа | Кости | 500'], "[500]Играем по крупному!", 'blue']],
                    [[['city' => 'Тюрьма'], "Хватит на сегодня", 'white']]
                    ]);
            else
                $vk->sendmessage($id,"Вы направились в сторону блатных ребят, но вас остановил заключенный смотрящий за порядком.\n\"Эй, лох! Тут играют только нормальные типы, иди драй толчки!\"\nСудя по всему сегодня вам не поиграть.");
            break;
        case 'Тюрьма | Работа | Кости | 25':
            $js_invent = json_decode($user['Инвентарь'],TRUE);
            $js_char = json_decode($user['Характеристики'],TRUE);
            $rand_pl = rand(4,24);
            $rand = rand(4,24);
            if($rand_pl > $rand)
            {
                $js_invent['Кошелек'] += 25;
                $js_char['Характеристики']['Бодрость'] -= 1;
                $js_char['Характеристики']['Сытость'] -= 1;
                $vk->sendmessage($id,"Вы выкинули $rand_pl!\nВаш противник же набрал лишь $rand очков!\nВы забрали 25 монет себе. К сожалению победа на такой мелкой ставке не подняла вам авторитета.");
                $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent', Характеристики = '$js_char' WHERE Ид = '{$user['Ид']}'");
            }
            if($rand_pl == $rand)
                $vk->sendmessage($id,"У вас выпало $rand_pl!\nК сожалению у противника выпало ровно столько же. Ничья!");
            if($rand_pl < $rand)
            {
                if($js_invent['Кошелек'] >= 25)
                {
                    $js_invent['Кошелек'] -= 25;
                    $js_char['Характеристики']['Бодрость'] -= 1;
                    $js_char['Характеристики']['Сытость'] -= 1;
                    $vk->sendmessage($id,"Вы выкинули $rand_pl!\nВаш противник же набрал лишь $rand очков!\nВы проиграли 25 монет. Поражение по мелкой ставке не повлияло на ваш авторитет.");
                    $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent', Характеристики = '$js_char' WHERE Ид = '{$user['Ид']}'");
                }
                else
                {
                    $js_invent['Кошелек'] = 0;
                    $js_char['Характеристики']['Хп'] -= 15;
                    $js_char['Характеристики']['Бодрость'] -= 3;
                    $js_char['Характеристики']['Сытость'] -= 2;
                    $vk->sendmessage($id,"Вы выкинули $rand_pl!\nВаш противник же набрал $rand очков!\nВы проиграли партию. Заглянув в карман, вы начали понимать что у вас нет денег чтобы оплатить ставку! Блатным это не понравилось и вас знатно избили, забрав все деньги что нашли.");
                    $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Авторитет = Тюрьма_Авторитет - 5, Инвентарь = '$js_invent', Характеристики = '$js_char' WHERE Ид = '{$user['Ид']}'");
                }
            }
            break;
        case 'Тюрьма | Работа | Кости | 500':
            $js_invent = json_decode($user['Инвентарь'],TRUE);
            $js_char = json_decode($user['Характеристики'],TRUE);
            $rand_pl = rand(4,24);
            $rand = rand(4,24);
            if($rand_pl > $rand)
            {
                $js_invent['Кошелек'] += 500;
                $js_char['Характеристики']['Бодрость'] -= 1;
                $js_char['Характеристики']['Сытость'] -= 1;
                $vk->sendmessage($id,"Вы выкинули $rand_pl!\nВаш противник же набрал лишь $rand очков!\nВы забрали 500 монет себе. Победа на такой ставке прибавила вам авторитета!");
                $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Авторитет = Тюрьма_Авторитет + 1, Инвентарь = '$js_invent', Характеристики = '$js_char' WHERE Ид = '{$user['Ид']}'");
            }
            if($rand_pl == $rand)
                $vk->sendmessage($id,"У вас выпало $rand_pl!\nК сожалению у противника выпало ровно столько же. Ничья!");
            if($rand_pl < $rand)
            {
                if($js_invent['Кошелек'] >= 500)
                {
                    $js_invent['Кошелек'] -= 500;
                    $js_char['Характеристики']['Бодрость'] -= 1;
                    $js_char['Характеристики']['Сытость'] -= 1;
                    $vk->sendmessage($id,"Вы выкинули $rand_pl!\nВаш противник же набрал лишь $rand очков!\nВы проиграли 500 монет. Поражение по мелкой ставке не сильно повлияло на ваш авторитет.");
                    $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Авторитет = Тюрьма_Авторитет - 1, Инвентарь = '$js_invent', Характеристики = '$js_char' WHERE Ид = '{$user['Ид']}'");
                }
                else
                {
                    $js_invent['Кошелек'] = 0;
                    $js_char['Характеристики']['Хп'] -= 15;
                    $js_char['Характеристики']['Бодрость'] -= 3;
                    $js_char['Характеристики']['Сытость'] -= 2;
                    $vk->sendmessage($id,"Вы выкинули $rand_pl!\nВаш противник же набрал $rand очков!\nВы проиграли партию. Заглянув в карман, вы начали понимать что у вас нет денег чтобы оплатить ставку! Блатным это не понравилось и вас знатно избили, забрав все деньги что нашли.");
                    $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Авторитет = Тюрьма_Авторитет - 5, Инвентарь = '$js_invent', Характеристики = '$js_char' WHERE Ид = '{$user['Ид']}'");
                }
            }
            break;
        case 'Тюрьма | Работа | Смена':
            $js_char = json_decode($user['Характеристики'],TRUE);
            $js_invent = json_decode($user['Инвентарь'],TRUE);
            if($user['Тюрьма_Авторитет'] <= 0)
                $chance += 2;
            if($user['Тюрьма_Авторитет'] <= 5)
                $chance += 2;
            if($user['Тюрьма_Авторитет'] <= 10)
                $chance += 2;
            if($user['Тюрьма_Авторитет'] <= 15)
                $chance += 2;
            if($user['Тюрьма_Авторитет'] <= 20)
                $chance += 2;
            $rand = rand(0,100);
            if($chance >= $rand AND $js_invent['Кошелек'] > 0)
            {
                $uncome = rand(0,10);
                if($js_invent['Кошелек'] < $uncome)
                    $uncome = $js_invent['Кошелек'];
                $js_invent['Кошелек'] -= $uncome;
                $js_char['Характеристики']['Хп'] -= 5;
                $js_char['Характеристики']['Бодрость'] -= 1;
                $js_char['Характеристики']['Сытость'] -= 1;
                $vk->sendmessage($id,"Вы шли на смену, но по пути вас остановили блатные и отжали у вас $uncome монет!\nТак же они всыпали вам для профилактики!\nКошелек: {$js_invent['Кошелек']}\nЗдоровье: {$js_char['Характеристики']['Хп']}");
                $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Авторитет = Тюрьма_Авторитет - 1, Инвентарь = '$js_invent', Характеристики = '$js_char' WHERE Ид = '{$user['Ид']}'");
                exit();
            }
            if($js_char['Характеристики']['Бодрость'] >= 1)
            {
                if($js_char['Характеристики']['Сытость'] >= 1)
                {
                $js_invent['Кошелек'] += 5;
                $js_char['Характеристики']['Бодрость'] -= 1;
                $js_char['Характеристики']['Сытость'] -= 1;
                $js_char['Характеристики']['Бодрость'] -= 1;
                $js_char['Характеристики']['Сытость'] -= 1;
                $vk->sendmessage($id,"Вы отработали смену получив немного денег.\nКошелек: {$js_invent['Кошелек']}\nВсего отработано смен: {$user['Тюрьма_Смена']}\nБодрость: {$js_char['Характеристики']['Бодрость']}\nСытость: {$js_char['Характеристики']['Сытость']}");
                $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Смена = Тюрьма_Смена + 1, Тюрьма_Авторитет = Тюрьма_Авторитет - 1, Инвентарь = '$js_invent', Характеристики = '$js_char' WHERE Ид = '{$user['Ид']}'");
                mysqli_query($Connect, "UPDATE Several_towns SET Сбор_Тюрьма = Сбор_Тюрьма + 50 WHERE Название = '{$user['Локация']}'");
                }
                else
                    $vk->sendmessage($id,"Вы слишком голодны чтобы работать!");
            }
            else
                $vk->sendmessage($id,"Вы слишком устали чтобы работать!");
            break;
        case 'Тюрьма | Камера':
            $vk->sendbutton($id, "Вы зашли в свою камеру, что вы хотите сделать?", [
                [[['city' => 'Тюрьма | Камера | Отдохнуть'], "Отдохнуть", 'blue']],
                [[['city' => 'Тюрьма | Камера | Поболтать'], "Поболтать с сокамерниками", 'blue'],[['city' => 'Тюрьма | Камера | Наперстки'], "Наперстки!", 'blue']],
                [[['city' => 'Тюрьма'], "Тюрьма", 'white']]
                ]);
                break;
        //
        case 'Армия':
            $army = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE Командир = $id"));
            switch ($army['Статус'])
            {
                case 'Ожидание':
                    $vk->sendbutton($id, "Вы вошли в окно управления подразделением №{$army['sys_id']}.", [
                        [[["city" => 'Армия | Информация'], "Информация", "green"], [["city" => 'Армия | Провинция'], "Провинция", "green"],[["city" => 'Армия | Командование'], "Командование", "green"]],
                        [[['city' => 'Армия | Статус:Ожидание'], "Статус: Ожидание", 'blue']],
                        [[['city' => 'Закрыть окно'], "Покинуть часть", 'white']]
                        ]);
                    break;
                case 'Марш':
                    $vk->sendbutton($id, "Вы вошли в окно управления подразделением №{$army['sys_id']}.", [
                        [[["city" => 'Армия | Информация'], "Информация", "green"], [["city" => 'Армия | Провинция'], "Провинция", "green"],[["city" => 'Армия | Командование'], "Командование", "green"]],
                        [[['city' => 'Армия | Статус:Марш'], "Статус: Марш", 'blue']],
                        [[['city' => 'Армия | Статус:Марш | Карта'], "Отправиться в путь", 'white']]
                        ]);
                    break;
                case 'Окапывание':
                    $vk->sendbutton($id, "Вы вошли в окно управления подразделением №{$army['sys_id']}.", [
                        [[["city" => 'Армия | Информация'], "Информация", "green"], [["city" => 'Армия | Провинция'], "Провинция", "green"],[["city" => 'Армия | Командование'], "Командование", "green"]],
                        [[['city' => 'Армия | Статус:Окапывание'], "Статус: Окапывание", 'blue']],
                        [[['city' => 'Армия | Статус:Окапывание | Информация'], "Состояние укреплений", 'white']]
                        ]);
                    break;
                case 'Заморожен':
                    $vk->sendbutton($id, "Подразделение №{$army['sys_id']} осталось без снабжения.\nНеобходимо вложить средства в фонд подразделения, для нормального функционирования.", [
                        [[["city" => 'Армия | Информация'], "Информация", "green"], [["city" => 'Армия | Провинция'], "Провинция", "green"],[["city" => 'Армия | Командование'], "Командование", "green"]],
                        [[['city' => 'Армия | Статус:Марш'], "Статус: Марш", 'blue']],
                        [[['city' => 'Армия | Статус:Марш | Карта'], "Отправиться в путь", 'white']]
                        ]);
                    break;
                case 'фыв':
                    break;
            }
            mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
            break;
        case 'Армия | Информация':
            $army = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE Командир = $id"));
            if($army['sys_id'] != NULL)
                $vk->sendMessage($id, "Информация о подразделении №{$army['sys_id']}.\nКомандир подразделения: [id$id|{$user['Вк_Имя']}]\nЛимит подразделения: {$limit['Подразделение']}\nКоличество пехотных отделений: {$army['Пехота']}.\nКоличество танковых экипажей: {$army['Танки']}\nКоличество орудийных расчётов: {$army['Орудия']}.");
            else
                $vk->sendMessage($id, "В вашем командовании нет подразделений.");
            break;
        case 'Армия | Статус:Окапывание':
            $vk->sendmessage($id,"Армия находиться в состоянии Окапывания.В этом режиме в части вводится строгое положение. Солдаты наччинают возводить укрепления на месте дислокации и использовать\изучать преимущества местности. Это сложная работа, дающая серьезные бонусы в бою. К сожалению вам не удастся покинуть часть во время таких работ.");
            break;
        case 'Армия | Статус:Ожидание':
            $vk->sendmessage($id,"Армия находиться в состоянии Ожидания.В режиме ожидания армия не занята ничем серьезным и может выполнять разнообразные действия в провинции. Так же подразделение всегда готово принять бой. Еще это отличный вариант если вам требуется временно покинуть часть.");
            break;
        case 'Армия | Статус:Марш':
            $vk->sendmessage($id,"Армия находиться в состоянии Марша. Это позволяет быстро передвигаться по местности, но при нападении на подразделение в таком состоянии, вас ждут серьезные штрафы в бою.");
            break;
        case 'Армия | Статус:Марш | Карта':
            $js_map = json_decode($map['Пути'], TRUE);
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
            $vk->sendMessage($peer_id, "$text");
            switch ($map['Владелец'])
            {
                case 'Хирциг':
                    $vk->sendimage($id, "img/map/map_herzig.jpg");
                    break;
                case 'Арсенополис':
                    $vk->sendimage($id, "img/map/map_arsenopolis.jpg");
                    break;
                case 'Волоберг':
                    $vk->sendimage($id, "img/map/map_voloberg.jpg");
                    break;
                case 'Военград':
                    $vk->sendimage($id, "img/map/map_voengrad.jpg");
                    break;
                case 'Хартмарк':
                    $vk->sendimage($id, "img/map/map_hartmark.jpg");
                    break;
                case 'Нью-Солсбери':
                    $vk->sendimage($id, "img/map/map_salisbury.jpg");
                    break;
                case 'Санкт-Иактбург':
                    $vk->sendimage($id, "img/map/map_iaactburg.jpg");
                    break;
                case 'Майорбург':
                    $vk->sendimage($id, "img/map/map_majorburg.jpg");
                    break;
                case 'Нью-Наварро':
                    $vk->sendimage($id, "img/map/map_navarro.jpg");
                    break;
                case 'Павловград':
                    $vk->sendimage($id, "img/map/map_pavlograd.jpg");
                    break;
                case 'Головашингтон':
                    $vk->sendimage($id, "img/map/map_golovashington.jpg");
                    break;
                case 'Новоордынск':
                    $vk->sendimage($id, "img/map/map_novoordinsk.jpg");
                    break;
            }
            mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Военная часть' WHERE Ид = $id");
            break;
        case 'Армия | Командование':
            $vk->sendbutton($id, "Вы зашли в штаб части. Что вы хотите сделать?", [
                [[["city" => 'Армия | Командование | Расформировать'], "Расформировать", "green"], [["city" => 'Армия | Командование | Тактики'], "Статус", "green"],[["city" => 'Армия | Командование | Передать Юнитов'], "Подкрепления", "green"]],
                [[['city' => 'Армия | Командование | Передать Командование'], "Передать командование", 'blue'],[['city' => 'Армия | Командование | Снабжение'], "Снабжение", 'blue']],
                [[['city' => 'Армия'], "Покинуть штаб", 'white']]
                ]);
            mysqli_query($Connect, "UPDATE Several_user SET Меню = '0' WHERE Ид = $id");
            break;
        case 'Армия | Командование | Передать Командование':
            $vk->sendbutton($id, "Введите ID-карту нового командира подразделения.", [
                [[['city' => 'Армия | Командование'], "Назад", 'white']]
                ]);
            mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Передача командования' WHERE Ид = $id");
            break;
        case 'Армия | Командование | Расформировать':
            $army = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE ��омандир = {$user['Ид']}"));
            $vk->sendbutton($id, "Вы хотите полностью распустить подразделение №{$army['sys_id']} со всеми её солдатами. Вы уверены?\n\nДля подтверждения команду введите \"ПОДТВЕРДИТЬ\"", [
                [[['city' => 'Армия | Командование'], "Назад", 'white']]
                ]);
            mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Расформирование части' WHERE Ид = $id");
            break;
        case 'Армия | Командование | Тактики':
            $vk->sendbutton($id, "Здесь вы можете изменить статус подразделения.\nВыберите нужный.", [
                [[["city" => 'Армия | Командование | Тактики | Ожидание'], "Ожидание", "green"], [["city" => 'Армия | Командование | Тактики | Окапывание'], "Окапывание", "green"]],
                [[['city' => 'Армия | Командование | Тактики | Марш'], "Марш", 'blue']],
                [[['city' => 'Армия'], "Покинуть штаб", 'white']]
                ]);
            break;
        case 'Армия | Командование | Передать Юнитов':
            # code...
            break;
        case 'Армия | Командование | Снабжение':
            $army = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE Командир = $id"));
            $uncome = $army['Танки'] * СОД_ЭКИПАЖ + $army['Пехота'] * СОД_ПЕХОТА + $army['Орудия'] * СОД_РАСЧЕТ;
            $vk->sendbutton($id, "Вы зашли в отдел снабжения части.\nОбщий расход на содержание: $uncome.\nТекщий фонд снабжения: {$army['Снабжение']}.", [
                [[["city" => 'Армия | Командование | Снабжение | Пополнить'], "Поставить снабжение", "blue"]],
                [[['city' => 'Армия'],"Покинуть штаб", 'white']]
                ]);
            break;
        case 'Армия | Командование | Снабжение | Пополнить':
            $vk->sendMessage($id, "Введите сумму, которую вы хотите вложить в снабжение части.");
            mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Положить в часть' WHERE Ид = $id");
            break;
        case 'Армия | Командование | Тактики | Ожидание':
            $vk->sendmessage($id,"Армия находиться в состоянии Ожидания.В режиме ожидания армия не занята ничем серьезным и может выполнять разнообразные действия в провинции. Так же подразделение всегда готово принять бой. Еще это отличный вариант если вам требуется временно покинуть часть.");
            mysqli_query($Connect, "UPDATE Enclave_army SET Статус = 'Ожидание' WHERE Командир = $id");
            break;
        case 'Армия | Командование | Тактики | Марш':
            $vk->sendmessage($id,"Армия находиться в состоянии Марша. Это позволяет быстро передвигаться по местности, но при нападении на подразделение в таком состоянии, вас ждут серьезные штрафы в бою.");
            mysqli_query($Connect, "UPDATE Enclave_army SET Статус = 'Марш' WHERE Командир = $id");
            break;
        case 'Армия | Командование | Тактики | Окапывание':
            $vk->sendmessage($id,"Армия находиться в состоянии Окапывания.В этом режиме в части вводится строгое положение. Солдаты начинают возводить укрепления на месте дислокации и использовать\изучать преимущества местности. Это сложная работа, дающая серьезные бонусы в бою. К сожалению вам не удастся покинуть часть во время таких работ.");
            mysqli_query($Connect, "UPDATE Enclave_army SET Статус = 'Окапывание' WHERE Командир = $id");
            break;
        case 'Регистрация | Гайд':
            $vk->sendmessage($id, СТАРТ_ГАЙД);
            break;
        case 'Регистрация | Лор':
            $vk->sendmessage($id, СТАРТ_ЛОР);
            break;
        case 'Регистрация | Карта':
            $z = mysqli_query($Connect, "SELECT * FROM Several_towns order by sys_id asc");
            $text = "Это список городов. Вы можете выбрать один из них, в скобках указаны державы контролирующие город.\nВажно! Введите и отправьте номер интересующего вас города и только потом, жмите Подтвердить.\n\n";
            while ($res = mysqli_fetch_assoc($z))
            {
                if($res['Тип'] == 'Город')
                {
                    $i++;
                    $text .= "$i.{$res['Название']} [{$res['Государство']}]\n";
                }
            }
            $text .= "\nДля выбора стартового города.\nВведите номер города.";
            $vk->sendbutton($id, $text, [
                [[["city" => 'Регистрация | Подтверждение'], "Подтвердить", "red"]]
                ]);
            mysqli_query($Connect, "UPDATE Several_user SET Меню = 'Стартовая локация' WHERE Ид = $id");
            break;
        case 'Регистрация | Подтверждение':
            $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['RAM']}'"));
            $js_visa = json_decode($user['Виза'],TRUE);
            $js_visa["{$town['Государство']}"] = 'Получена';
            $js_visa = json_encode($js_visa, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            mysqli_query($Connect, "UPDATE Several_user SET Прописка = '{$town['Название']}', Виза = '$js_visa', Подданство = '{$town['Государство']}', Локация = '{$user['RAM']}', Статус = 'Поселение', Меню = '0' WHERE Ид = $id");
            $vk->sendbutton($id, "Поздравляем!\nВы успешно зарегистрировались. Для ознакомления с командами введите команду «Помощь».\nЖелаем вам успехов!\n\nВы находитесь на центральной площади {$user['RAM']}.\nВыберите дальнейшие действия.", [
                [BTN_BANK, BTN_SHOP],
                [BTN_PROPERTY, BTN_WORK, BTN_TAVERN],
                [[["city" => 'town'], "Город : {$user['RAM']}", "blue"]]
                ]);
            $vk->sendmessage(VK_LOG_TECH,"[id$id|{$user['Вк_Имя']}] выбрал {$user['RAM']} стартовым городом.");
            break;
        case 'Образец':
            # code...
            break;
        case 'Образец':
            # code...
            break;
        case 'Продать старье':
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
        case 'Своё оружие':
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
        case 'Свои одеяния':
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
        case 'Своё снаряжение':
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
        case 'Продать все из сумки':
        	$js_invent = json_decode($user['Инвентарь'], TRUE);
        	$elements = count($js_invent['Сумка']) - 1; //сколько предметов в сумке
        	if ($elements > 0)
            { //Проверка, что сумка не пуста
            	$i = 0;
            	while ($i < $elements)
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
        case 'Содержимое сумки':
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
            break;
        case 'town':
            $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$user['Локация']}'"));
            $text = "{$town['Описание']}";
            $js_bonus = json_decode($user['Бонус'], TRUE);
            if ($js_bonus['Общайся'] != "Получен")
                $tx2 = "\n\nТак же у нас есть беседа!\nСсылка: https://vk.me/join/AJQ1d9TvFBbY3w5zi9Dnbm1T\nЕсть бонус за присоединение!";
            if ($town['Владелец'] == $id)
            {
                $vk->sendbutton($id, "$text $tx2", [
                    [[["Город" => 'Город'], "Управление городом", "green"]],
                    [[["city" => 'Провинция'], "Покинуть поселение", "blue"]],
                    [[["city" => 'exit_in_town'], "Вернуться", "red"]]
                    ]);
            }
            else
            {
                $vk->sendbutton($id, "$text $tx2", [
                    [[["city" => 'Провинция'], "Покинуть поселение", "blue"]],
                    [[["city" => 'exit_in_town'], "Вернуться", "red"]]
                    ]);
            }
            break;
        case 'Провинция':
            if($user['Статус'] == 'Поселение')
            {
                $map = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE sys_id = '{$loc['Провинция']}'"));
                if ($map['Температура'] < 0)
                    $tx1 = '-';
                if ($map['Температура'] >= 0)
                    $tx1 = '+';
                $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Провинция = {$map['sys_id']}"));
                if ($loc['Название'] != NULL)
                    $tx2 = "Войти в {$loc['Название']}";
                else
                    $tx2 = "Искать поселение";
                $army = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Enclave_army WHERE Командир = $id"));
                if($army['Локация'] == $map['Название'])
                    $vk->sendbutton($id, "Вы покинули {$user['Локация']}.\n\nИнформация о провинции:\nГосударство-владелец: {$map['Государство']}.\nНазвание: {$map['Название']}.\nТип местности: {$map['Местность']}.\nТемпература: $tx1{$map['Температура']}\nРадиация: {$map['Радиация']} рад/час", [
                        [[["city" => 'Провинция | Бродить'], "Побродить по территории", "green"]],
                        [[["city" => 'Армия'], "Подразделение №{$army['sys_id']}", "red"]],
                        [[["city" => 'Провинция | Карта'], "Карта", "red"], [["city" => 'Провинция | Информация'], "Осмотреться", "red"]],
                        [[["city" => 'Провинция | Город'], "$tx2", "blue"]]
                        ]);
                else
                    $vk->sendbutton($id, "Вы покинули {$user['Локация']}.\n\nИнформация о провинции:\nГосударство-владелец: {$map['Государство']}.\nНазвание: {$map['Название']}.\nТип местности: {$map['Местность']}.\nТемпература: $tx1{$map['Температура']}\nРадиация: {$map['Радиация']} рад/час", [
                        [[["city" => 'Провинция | Бродить'], "Побродить по территории", "green"]],
                        [[["city" => 'Провинция | Карта'], "Карта", "red"], [["city" => 'Провинция | Информация'], "Осмотреться", "red"]],
                        [[["city" => 'Провинция | Город'], "$tx2", "blue"]]
                        ]);
                mysqli_query($Connect, "UPDATE Several_user SET Респавн = '{$user['Локация']}',Статус = 'Провинция',Локация = '{$map['Название']}' WHERE Ид = $id");
            }
            else
                $vk->sendmessage($id,"Сист.Сообщ.");
            break;
        case 'Провинция | Карта':
            $js_map = json_decode($map['Пути'], TRUE);
            $map_picture = $map['Владелец'];
            $vk->sendMessage($id, "Карта региона:");
            switch ($map['Владелец'])
            {
                case 'Хирциг':
                    $vk->sendimage($id, "img/map/map_herzig.jpg");
                    break;
                case 'Арсенополис':
                    $vk->sendimage($id, "img/map/map_arsenopolis.jpg");
                    break;
                case 'Волоберг':
                    $vk->sendimage($id, "img/map/map_voloberg.jpg");
                    break;
                case 'Военград':
                    $vk->sendimage($id, "img/map/map_voengrad.jpg");
                    break;
                case 'Хартмарк':
                    $vk->sendimage($id, "img/map/map_hartmark.jpg");
                    break;
                case 'Нью-Солсбери':
                	$vk->sendimage($id, "img/map/map_salisbury.jpg");
                    break;
                case 'Санкт-Иактбург':
                    $vk->sendimage($id, "img/map/map_iaactburg.jpg");
                    break;
                case 'Майорбург':
                    $vk->sendimage($id, "img/map/map_majorburg.jpg");
                    break;
                case 'Нью-Наварро':
                    $vk->sendimage($id, "img/map/map_navarro.jpg");
                    break;
                case 'Павловград':
                    $vk->sendimage($id, "img/map/map_pavlograd.jpg");
                    break;
                case 'Головашингтон':
                    $vk->sendimage($id, "img/map/map_golovashington.jpg");
                    break;
                case 'Новоордынск':
                    $vk->sendimage($id, "img/map/map_novoordinsk.jpg");
                    break;
            }
            $i = 0;
            $text = "Вам доступны пути в следующие регионы:\n";
            foreach ($js_map['Путь'] as $reg => $s)
            {
                $i++;
                $name_reg = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE sys_id = $reg"));
                $text .= "\n$i.{$name_reg['Название']}.\nРасстояние: $s км.\nГосударство: {$name_reg['Государство']}\nОбласть: {$name_reg['Владелец']}\n";
            }
            $text .= "\n\nДля начала пути введите команду:\nПуть [Номер провинции в списке].";
            mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE sys_id = $reg"));
            //$text .= "\n\nПеремещение между локациями временно недоступно.";
            $vk->sendMessage($peer_id, "$text");
            mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Карта' WHERE Ид = $id");
            break;
		case 'Направления': //хуйня для поезда
            $js_map = json_decode($map['Направления'], TRUE);
            $map_picture = $map['Владелец'];
            $vk->sendMessage($id, "Карта региона:");
            $i = 0;
            $text = "Вам доступны пути в следующие регионы:\n";
            foreach ($js_map['Путь'] as $reg => $s)
            {
                $i++;
                $name_reg = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE sys_id = $reg"));
                $text .= "\n$i.{$name_reg['Название']}.\nРасстояние: $s км.\nГосударство: {$name_reg['Государство']}\nОбласть: {$name_reg['Владелец']}\n";
            }
            $text .= "\n\nДля начала пути введите команду:\nПоезд [Номер провинции в списке].";
            mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_map WHERE sys_id = $reg"));
            //$text .= "\n\nПеремещение между локациями временно недоступно.";
            $vk->sendMessage($peer_id, "$text");
            mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Карта' WHERE Ид = $id");
            break;
        case 'Провинция | Сбежать':
            //$vk->sendmessage($id, "ОНИ ПОВСЮДУ!!! СБЕЖАТЬ НЕВОЗМОЖНО!  [id484969210|КОТ], [id445807039|АРГО], [id348072989|АЛЬБЕРТ] СПАСИТЕ!!!");
            $js_invent = json_decode($user['Инвентарь'], TRUE);
            $js_char = json_decode($user['Характеристики'], TRUE);
            $q = round(0.25 * 5 * $js_char['Навыки']['Выносливость']-rand(1,20) / 2, 2);
            $js_char['Характеристики']['Хп'] -= $q;

            if ($js_char['Характеристики']['Хп'] <= 0)
            {
                Смерть($user);
                break;
            }
            else
            {

                $val = $js_char['Навыки']['Выносливость'] * 5;
                $val2 = $js_char['Навыки']['Выносливость'] * 3;
                $val3 = 4 * $js_char['Характеристики']['Уровень'];
                $val4 = $js_char['Навыки']['Выносливость'] * 2;
                $val5 = round($js_char['Характеристики']['Радиация'], 2);
                $val6 = round($js_char['Характеристики']['Хп'], 2);
                $text = "ХП[$val6/$val]:РД[$val5/$val4]СТ[{$js_char['Характеристики']['Сытость']}/100]:БД[{$js_char['Характеристики']['Бодрость']}/$val2]";
                $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Провинция = {$map['sys_id']}"));
                if ($loc['Название'] != NULL)
                    $tx2 = "Войти в {$loc['Название']}";
                else
                    $tx2 = "Искать поселение";
                $vk->sendbutton($id, "Вы избежали боя, получив значительные повреждения. Вам нужно вернуться в город и подлечиться!\n$text", [
                    [[["city" => 'Провинция | Бродить'], "Побродить по территории", "green"]],
                    [[["city" => 'Провинция | Карта'], "Карта", "red"], [["city" => 'Провинция | Информация'], "Осмотреться", "red"]],
                    [[["city" => 'Провинция | Город'], "$tx2", "blue"]]
                    ]);
                $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Провинция', Характеристики = '$js_char' WHERE Ид = $id");
                break;
            }
        case 'Провинция | Начать Бой':
            $js_mob = json_decode($null['null'], TRUE);
            $mob = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_mob WHERE Название = '{$user['RAM']}'"));
            $text = "Вы вступили в бой с {$mob['Название']}!\nУ противника {$mob['Здоровье']} ед. здоровья!";
            Картинка_моба($id,$mob);//Присылает картинку моба, если такова имеется
            $vk->sendbutton($id, "$text", [
                [[["city" => 'Провинция | Бой | Атака | Голова'], "Целиться в голову!", "green"]],
                [[["city" => 'Провинция | Бой | Атака | Конечности'], "Атаковать по конечностям!", "blue"], [["city" => 'Провинция | Бой | Атака | Корпус'], "Ударить в корпус!", "blue"]]
                ]);
            $js_mob['Название'] = $mob['Название'];
            $js_mob['Здоровье'] = $mob['Здоровье'];
            $js_mob['Здоровье_Макс'] = $mob['Здоровье'];
            $js_mob['Урон'] = $mob['Урон'];
            $js_mob['Броня'] = $mob['Броня'];
            $js_mob['Крит'] = $mob['Крит'];
            $js_mob['Опыт'] = $mob['Опыт'];
            $js_mob = json_encode($js_mob, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            mysqli_query($Connect, "UPDATE Several_user SET RAM = '$js_mob', Статус = 'Бой' WHERE Ид = $id");
            break;
        case 'Провинция | Бой | Атака | Голова':
            if($user['Статус'] == 'Бой')
            {
                $js_mob = json_decode($user['RAM'], TRUE);
                $js_char = json_decode($user['Характеристики'], TRUE);
                $js_invent = json_decode($user['Инвентарь'], TRUE);
                $weapon = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Оружие']}'"));
                $armor = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Одежда']}'"));
                $val = $js_char['Навыки']['Выносливость'] * 5;
                //Расчёт урона игрока
                $rand_crit = rand(0, 100);
                $r_mod = rand(-5, 5);
                if ($rand_crit <= $js_char['Навыки']['Меткость'])
                {
                    //Сцен.Крита
                    $d_player = floor($weapon['Урон'] * ($r_mod * 0.1 + 1) * КРИТ - $js_mob['Броня']);
                    if ($d_player < 1)
                        $d_player = 1;
                    $text = "Критическое попадание в голову!\n Пуля прошила череп на вылет нанеся $d_player урона!\n\n";
                }
                else
                {
                    //Сцен. обычной атаки.
                    $d_player = floor($weapon['Урон'] * ($r_mod * 0.1 + 1) - $js_mob['Броня']);
                    if ($d_player < 1)
                        $d_player = 1;
                    $text = "Прицелившись в голову, вы сделали выстрел! Пуля прошла по касательной, нанеся $d_player урона!\n\n";
                }
                //

                //Расчёт здоровья
                $js_mob['Здоровье'] -= $d_player;
                //Сцен.Победы
                if ($js_mob['Здоровье'] <= 0)
                    Победа_над_мобом($user,$text);
                else
                    $text .= "\nЗдоровье противника [{$js_mob['Здоровье']}/{$js_mob['Здоровье_Макс']}] ед. здоровья.\n";
                    $js_mob = json_encode($js_mob, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    mysqli_query($Connect, "UPDATE Several_user SET RAM = '$js_mob' WHERE Ид = '{$user['Ид']}'");
                    Урон_моба($user,$text);
            }
            break;
        case 'Провинция | Бой | Атака | Конечности':
            if($user['Статус'] == 'Бой')
            {
                $js_mob = json_decode($user['RAM'], TRUE);
                $js_char = json_decode($user['Характеристики'], TRUE);
                $js_invent = json_decode($user['Инвентарь'], TRUE);
                $weapon = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Оружие']}'"));
                $armor = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Одежда']}'"));
                $val = $js_char['Навыки']['Выносливость'] * 5;
                //Расчёт урона игрока
                $rand_crit = rand(0, 100);
                $r_mod = rand(-5, 5);
                if ($rand_crit <= $js_char['Навыки']['Меткость'])
                {
                    //Сцен.Крита
                    $d_player = floor($weapon['Урон'] * ($r_mod * 0.1 + 1) * КРИТ - $js_mob['Броня']);
                    if ($d_player < 1)
                        $d_player = 1;
                    $text = "Критическое попадание!\n Пуля прошила противника на вылет, нанеся $d_player урона!\n\n";
                }
                else
                {
                    //Сцен. обычной атаки.
                    $d_player = floor($weapon['Урон'] * ($r_mod * 0.1 + 1) - $js_mob['Броня']);
                    if ($d_player < 1)
                        $d_player = 1;
                    $text = "Прицелившись по конечностям, вы сделали выстрел! Пуля прошла по касательной, нанеся $d_player урона!\n\n";
                }
                //
                //Расчёт здоровья
                $js_mob['Здоровье'] -= $d_player;
                //Сцен.Победы
                if ($js_mob['Здоровье'] <= 0)
                    Победа_над_мобом($user,$text);
                else
                {
                    $text .= "\nЗдоровье противника [{$js_mob['Здоровье']}/{$js_mob['Здоровье_Макс']}] ед. здоровья.\n";
                    $js_mob = json_encode($js_mob, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    mysqli_query($Connect, "UPDATE Several_user SET RAM = '$js_mob' WHERE Ид = $id");
                    Урон_моба($user,$text);
                }
            }
            break;
        case 'Провинция | Бой | Атака | Корпус':
            if($user['Статус'] == 'Бой')
            {
                $js_mob = json_decode($user['RAM'], TRUE);
                $js_char = json_decode($user['Характеристики'], TRUE);
                $js_invent = json_decode($user['Инвентарь'], TRUE);
                $weapon = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Оружие']}'"));
                $armor = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Одежда']}'"));
                $val = $js_char['Навыки']['Выносливость'] * 5;
                //Расчёт урона игрока
                $rand_crit = rand(0, 100);
                $r_mod = rand(-5, 5);
                if ($rand_crit <= $js_char['Навыки']['Меткость'])
                {
                    //Сцен.Крита
                    $d_player = floor($weapon['Урон'] * ($r_mod * 0.1 + 1) * КРИТ - $js_mob['Броня']);
                    if ($d_player < 1)
                        $d_player = 1;
                    $text = "Критическое попадание в корпус!\n Пуля вошла в тушу противника нанеся $d_player урона!\n\n";
                }
                else
                {
                    //Сцен. обычной атаки.
                    $d_player = floor($weapon['Урон'] * ($r_mod * 0.1 + 1) - $js_mob['Броня']);
                    if ($d_player < 1)
                        $d_player = 1;
                    $text = "Прицелившись в корпус, вы сделали выстрел! Пуля прошла по касательной, нанеся $d_player урона!\n\n";
                }
                //

                //Расчёт здоровья
                $js_mob['Здоровье'] -= $d_player;

                //Сцен.Победы
                if ($js_mob['Здоровье'] <= 0)
                    Победа_над_мобом($user,$text);
                else
                {
                    $text .= "\nЗдоровье противника [{$js_mob['Здоровье']}/{$js_mob['Здоровье_Макс']}] ед. здоровья.\n";
                    $js_mob = json_encode($js_mob, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    mysqli_query($Connect, "UPDATE Several_user SET RAM = '$js_mob' WHERE Ид = '{$user['Ид']}'");
                    Урон_моба($user,$text);
                }
            }
            break;
        case 'Провинция | Бродить':
            $js_char = json_decode($user['Характеристики'], TRUE);
            $js_invent = json_decode($user['Инвентарь'], TRUE);
            $js_char['Характеристики']['Бодрость']--;
            $js_char['Характеристики']['Сытость'] -= 2;
            //Расчёт радиации
            $armor = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_invent WHERE Название = '{$js_invent['Одежда']}'"));
            if ((($map['Радиация'] - $armor['Рад_защ']) * 1 / 6) >= 0)
                $js_char['Характеристики']['Радиация'] += ($map['Радиация'] - $armor['Рад_защ']) * 1 / 6;
            //
            // Урон от факторов
            if ($js_char['Характеристики']['Радиация'] >= ($js_char['Навыки']['Выносливость'] * 2))
            {
                $js_char['Характеристики']['Хп'] -= $js_char['Характеристики']['Радиация'] - ($js_char['Навыки']['Выносливость'] * 2);
                $vk->sendMessage($id, "Внимание!\nВаш уровень радиации слишком высок!\nВы теряете здоровье!");
            }
            if ($js_char['Характеристики']['Сытость'] < 0)
            {
                $js_char['Характеристики']['Хп'] -= УРОН_СЫТ;
                $js_char['Характеристики']['Сытость'] = 0;
                $vk->sendMessage($id, "Внимание!\nВы слишком голодны!\nВы теряете здоровье!");
            }
            if ($js_char['Характеристики']['Бодрость'] < 0)
            {
                $js_char['Характеристики']['Хп'] -= УРОН_БОД;
                $js_char['Характеристики']['Бодрость'] = 0;
                $vk->sendMessage($id, "Внимание!\nВы слишком сильно изнурены!\nВы теряете здоровье!");
            }
            if ($js_char['Характеристики']['Хп'] <= 0)
                Смерть($user);
            //
            $val = $js_char['Навыки']['Выносливость'] * 5;
            $val2 = $js_char['Навыки']['Выносливость'] * 3;
            $val3 = 4 * $js_char['Характеристики']['Уровень'];
            $val4 = $js_char['Навыки']['Выносливость'] * 2;
            $val5 = round($js_char['Характеристики']['Радиация'], 2);
            $val6 = round($js_char['Характеристики']['Хп'], 2);
            $text = "ХП[$val6/$val]:РД[$val5/$val4]СТ[{$js_char['Характеристики']['Сытость']}/100]:БД[{$js_char['Характеристики']['Бодрость']}/$val2]";
            $rand = rand(0, 100);
            //Сценарий находки лута
            if ($rand <= 20)
            {
                $js_lut = json_decode($map['Лут'], TRUE);
                $i = -1;
                foreach ($js_lut['Лут'] as $value)
                    $i++;
                $rand_lut = rand(0, $i);
                //
                $i = 0;
                if ($js_invent['Сумка'][0] > 0)
                {
                    foreach ($js_invent['Сумка'] as $key => $value)
                    {
                        $i++;
                        if ($js_invent['Сумка'][$i] == NULL)
                        {
                            $js_invent['Сумка'][$i] = "{$js_lut['Лут'][$rand_lut]}";
                            $js_invent['Сумка'][0]--;
                            if ($js_invent['Сумка'][0] == 0)
                                $text .= "\nПосмотрев на сумку, вы удовлетворенно кхмыкнули. Она была под завязку полна - пора возвращаться в город.\n";
                            break;
                        }
                    }
                    $vk->sendMessage($id, "Обойдя {$map['Местность']}, вы нашли {$js_lut['Лут'][$rand_lut]}!\nПоздравляем!\n$text");
                }
                else
                    $vk->sendMessage($id, "Обойдя {$map['Местность']}, вы нашли {$js_lut['Лут'][$rand_lut]}!\nК сожалению у вас в сумке не нашлось места и пришлось отказаться от этой вещицы..\n$text");

            }
            //Сценарий моба
            if ($rand <= 45 AND $rand > 20)
            {
                $js_mob = json_decode($map['Мобы'], TRUE);
                $i = -1;
                foreach ($js_mob['Мобы'] as $value)
                    $i++;
                $rand_mob = rand(0, $i);
                $js_char = json_decode($user['Характеристики'], TRUE);
                $q = round(0.25 * 5 * $js_char['Навыки']['Выносливость']-rand(1,20) / 2, 2);
                if ($map['Название'] == 'Бездна [Смертельно ОПАСНО]')
                {
                	$mob = "{$js_mob['Мобы'][$rand_mob]}";
                	Бой_в_Бездне($user,$mob);
                }
                else
                {
                	$vk->sendbutton($id, "Когда вы бродили и осматривали {$map['Местность']}, вас заметили!\nЭто {$js_mob['Мобы'][$rand_mob]}!\nВы быстро поняли, что дело идет к битве!\n$text", [
                	[[["city" => 'Провинция | Начать Бой'], "Вступить в бой!", "blue"]],
                	[[["city" => 'Провинция | Сбежать'], "Сбежать[-$q ХП]", "red"]]
                	]);
                }
                mysqli_query($Connect, "UPDATE Several_user SET RAM = '{$js_mob['Мобы'][$rand_mob]}', Статус = 'Начало боя' WHERE Ид = $id");
            }
            //Сценарий Крышек
            if ($rand <= 55 AND $rand > 45)
            {
                $rand = rand(0, 30);
                $rand = $rand;
                $rand = round($rand, 2);
                $js_invent['Кошелек'] += $rand;
                $js_invent['Кошелек'] = round($js_invent['Кошелек'], 2);
                $vk->sendMessage($id, "Обойдя {$map['Местность']}, вы нашли немного денег, а именно $rand!\n[{$js_invent['Кошелек']}]\n$text");
            }
            //Сценарий Нихуя
            if ($rand > 55)
                $vk->sendMessage($id, "Сценарий: произошло целое ничего\n$text");

            $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            $js_char = json_encode($js_char, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            mysqli_query($Connect, "UPDATE Several_user SET Инвентарь = '$js_invent', Характеристики = '$js_char' WHERE Ид = $id");
            break;
        case 'Провинция | Город':
            //Шанс ареста//
            $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$map['Владелец']}'"));
                    /*$js_visa = json_decode($user['Виза'],TRUE);

                    if($js_visa["{$map['Государство']}"] == 'Получена')
                        $chance = -10000;
                    if($js_visa["{$map['Государство']}"] == 'Розыск')
                        $chance += 25;
                    if($js_visa["{$map['Государство']}"] == NULL OR $js_visa["{$map['Государство']}"] == 'Нет')
                        $chance += 15;
                    $chance += $town['Порядок'] * 10;
                    $rand = rand(0,100);
                    if($chance >= $rand){ // Происходит арест
                        mysqli_query($Connect, "UPDATE Several_user SET Тюрьма_Конец_Срока = 5, Статус = 'Тюрьма', Локация = '{$town['Название']}' WHERE Ид = {$user['Ид']}");
                        $vk->sendMessage($town['Владелец'], "[id{$user['Ид']}|{$user['Вк_Имя']}][{$user['sys_id']}] был арестован на входе в {$town['Название']}.");
                        $vk->sendbutton($user['Ид'], "На входе в город вы наткнулись на патруль.\nВас заключили под арест!", [
                            [[["city" => 'Тюрьма'], "Вы в тюрьме!", "red"]]
                        ]);
                        $vk->sendMessage(VK_LOG_TECH, "[id{$user['Ид']}|{$user['Вк_Имя']}][{$user['sys_id']}] был арестован при входе в {$town['Название']}.");
                        exit();
                    }*/
                    //Конец шанса//
            $loc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Провинция = {$map['sys_id']}"));
            if ($loc['Название'] != NULL)
            {
                $vk->sendbutton($id, "Вы вошли в поселение {$loc['Название']}.\nЧто дальше?", [
                    [BTN_BANK, BTN_SHOP],
                    [BTN_PROPERTY, BTN_WORK, BTN_TAVERN],
                    [[["city" => 'town'], "{$loc['Тип']}: {$loc['Название']}", "blue"]]
                    ]);
                mysqli_query($Connect, "UPDATE Several_user SET Респавн = '{$loc['Название']}',Статус = 'Поселение', Локация = '{$loc['Название']}' WHERE Ид = $id");
            }
            else
                $vk->sendMessage($id, "В этой провинции нет поселений.");
            break;
        case 'Провинция | Информация':
            $vk->sendMessage($id, "Информация о провинции:\nГосударство-владелец: {$map['Государство']}.\nНазвание: {$map['Название']}.\nТип местности: {$map['Местность']}.\nТемпература: $tx1{$map['Температура']}\n");
            break;
        case 'Путешествие | Время':
            $z = mysqli_query($Connect, "SELECT * FROM Several_travel order by sys_id asc");
            while ($event = mysqli_fetch_assoc($z))
            {
                $js_event = json_decode($event['Информация'],TRUE);
                if($js_event['Игрок'] == $id AND $event['Тип_События'] == 'Путешествие')
                {
                    $time = time();
                    $time_min = floor(($event['Время_События'] - $time) / 60);
                    $vk->sendMessage($peer_id, "Пункт назначения: {$js_event['Место прибытия']}.\nДо прибытия осталось около $time_min мин. пути.");
                }
                if($js_event['Игрок'] == $id AND $event['Тип_События'] == 'Марш')
                {
                    $time = time();
                    $time_min = floor(($event['Время_События'] - $time) / 60);
                    $vk->sendMessage($peer_id, "Пункт назначения: {$js_event['Место прибытия']}.\nДо прибытия осталось около $time_min мин. пути.");
                }
            }
            break;
        case 'condition_char':
            $js_char = json_decode($user['Характеристики'], TRUE);
            $val = $js_char['Навыки']['Выносливость'] * 5;
            $val2 = $js_char['Навыки']['Выносливость'] * 3;
            $val3 = 4 * $js_char['Характеристики']['Уровень'];
            $val4 = $js_char['Навыки']['Выносливость'] * 2;
            $val5 = round($js_char['Характеристики']['Радиация'], 2);
            $val6 = round($js_char['Характеристики']['Хп'], 2);
            $text = "ХП[$val6/$val]:РД[$val5/$val4]СТ[{$js_char['Характеристики']['Сытость']}/100]:БД[{$js_char['Характеристики']['Бодрость']}/$val2]";
            if ($user['Статус'] != 'Отдых в Баре' AND $user['Статус'] != 'Отдых дома')
            {
                $text .= "\nХарактеристики персонажа:\nУровень персонажа: {$js_char['Характеристики']['Уровень']}\nОпыт [{$js_char['Характеристики']['Опыт']}/$val3]\nНавыки:";
                foreach ($js_char['Навыки'] as $atribute => $value)
                    $text .= "\n$atribute: $value";
                $text .= "\n\nОчки навыков: {$js_char['Характеристики']['Очки навыков']}\nДля повышения навыков используйте команду: \n[*навык* *число очков*].";
            }
            $vk->sendmessage($id, "$text");
            break;
        case 'exit_in_town':
            $vk->sendbutton($id, "Вы вернулись на Центральную площадь", [
                [BTN_BANK, BTN_SHOP],
                [BTN_PROPERTY, BTN_WORK, BTN_TAVERN],
                [[["city" => 'town'], "{$loc['Тип']}: {$user['Локация']}", "blue"]]
                ]);
            if ($loc != NULL)
                mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Поселение' WHERE Ид = $id");
            if ($map != NULL)
                mysqli_query($Connect, "UPDATE Several_user SET Статус = 'Провинция' WHERE Ид = $id");
            break;
    }
}
foreach ($payload as $key => $value)
{
    $payload_key = $key; // Казино
    $payload_value = $value; // Казино \ Монетка
    //if($id == ИД_ХАРТМАНН)
    //    $vk->sendmessage(ИД_ХАРТМАНН,"Ключ кнопки:$payload_key\nИмя кнопки:$payload_value\n");
}
switch($payload_key)
{
    case 'Казино':
        Модуль_Казино($payload_value, $user);
        break;
    case 'Город':
        Модуль_Город($payload_value, $user);
        break;
    case 'Корпорации':
        Модуль_Корпорации($payload_value, $user);
        break;
}
//Реальный конец скрипта. Ниже, все команды будут выполняться только в лс группы, проверено.
/////Системные команды
if ($id == ИД_ХАРТМАНН OR $id == ИД_ПАВЕЛ OR $id == ИД_ИАКТ)
{ // Проверяем админку
    switch ($mess[0])
    {
        case 'Статус':
            mysqli_query($Connect, "UPDATE Several_user SET Статус = '{$mess[2]}' WHERE sys_id = '{$mess[1]}'");
            $vk->sendmessage($id, "Статус изменен");
            break;
        //То же самое для остального.
    }
    if (!$payload['city'])
    {
        if ($mess[0] == 'Информация' OR $mess[0] == 'информация')
        { //просто введи слово Информация и все будет понятно
            Информация_об_игроке($user,$message);
            $vk->sendmessage($id, "Конец");
        }
        if ($mess[0] == 'Убить')
        {
            if ($mess[1] == 0) //Чтобы нашу Лису не задело :)
                exit();
            $user_other = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = '$mess[1]'"));
            Смерть($user_other);
            $vk->sendmessage($peer_id, "[id{$user_other['Ид']}|{$user_other['Вк_Имя']}] убит высшими силами!");
            $vk->sendmessage(VK_LOG_TECH, "[id{$user_other['Ид']}|{$user_other['Вк_Имя']}] убит командой \"Убить [Ид]\"\nАдминистратор: [id{$user['Ид']}|{$user['Вк_Имя']}]");
        }
        if ($mess[0] == 'Дуэль')
        {
            $user_other = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = '$mess[1]'"));
            Вызов_дуэль($user,$user_other); //находится в function_duel
            $vk->sendmessage($peer_id, "Test_2");
        }
    }
    if ($mess[0] == '/Снаряжение')
    {
        $mess = explode(" ", $message);
        $str_vk_name = $mess[1] . " " . $mess[2];
        $user_other = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE Вк_Имя = '$str_vk_name'"));
        $js_invent_user_other = json_decode($user_other['Инвентарь'], TRUE);
        $vk->sendmessage($peer_id, "Снаряжение [id$id|{$user_other['Вк_Имя']}]:\nОдежда:{$js_invent_user_other['Одежда']}\n*\nОружие:{$js_invent_user_other['Оружие']}");
    }
    if ($mess[0].$mess[1] == 'Выдатьвалюту')
    {
        $user_pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[3]"));
        Выдать_Валюту($user,$user_pol,$mess[2]); // Передаём юзеров и сумму выдачи
    }
    if ($mess[0] . $mess[1] == 'Снятьбан')
    {
        $ban_user = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[2]")); // Юзер которого баним.
        Снять_Бан($user,$ban_user); // Передаем данные о юзерах.
    }
    if ($mess[0] . $mess[1] == 'Выдатьбан')
    {
        $ban_user = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[2]")); // Юзер которого баним.
        Выдать_Бан($user,$ban_user); // Передаем данные о юзерах.
    }
    if ($mess[0] == 'Тп')
    {
        Телепорт($user,$mess[2],$mess[1]); // Передаем данные о юзерах.
        $vk->sendmessage($peer_id, "Телепортация успешно завершена.");
    }
    if ($message == 'ИдКф')
        $vk->sendmessage($id, "Ид кф = $peer_id");
    if ($mess[0].$mess[1] == 'Создатьпровинцию')
    {
        $name_reg = "Провинция №$mess[2]";
        $tx = explode("!",$message);
        $puty = explode(",",$tx[3]);
        foreach ($puty as $value)
        {
            $js_mark['Путь']["$value"] = rand(7,20);
            $text .= ", $value:{$js_mark['Путь']["$value"]}";
        }
        $js_mark = json_encode($js_mark, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        $vk->sendmessage($id, "Название: $name_reg\nДоступные пути: $text\nМестность: $mess[3]\nГосударство: $tx[1]\nОбласть: $tx[2]\n");
        $db->query("INSERT INTO Several_map (sys_id,Название,Местность,Государство,Владелец,Пути) VALUES (?i,'?s','?s','?s','?s','?s')", $mess[2],$name_reg,$mess[3],$tx[1],$tx[2],$js_mark);
        $vk->sendmessage($id, "Провинция №$mess[2] успешно создана.");
    }
    if ($mess[0] == 'Короновать')
    {
        $pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[1]"));
        mysqli_query($Connect, "UPDATE Several_user SET Титул = 'Правитель' WHERE sys_id = $mess[1]");
        $vk->sendMessage($peer_id, " [id{$pol['Ид']}|{$pol['Вк_Имя']}] назначен правителем {$pol['Подданство']}.");
        $vk->sendMessage($pol['Ид'], "Вас назначили правителем. Теперь вы правитель страны {$pol['Подданство']}, поздравляем!");
        $vk->sendMessage(VK_LOG_TECH, "[id{$pol['Ид']}|{$pol['Вк_Имя']}][{$pol['sys_id']}] назначен правителем в {$pol['Подданство']}.\n[Администратор:[id$id|{$user['Вк_Имя']}]]");
    }
    if ($mess[0] == 'Письмо')
    {
        if(is_numeric($mess[1]))
        {
            $text = "Вам пришло письмо:\n";
            $user_pol = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_user WHERE sys_id = $mess[1]"));
        }
        else
        {
            switch ($mess[1])
            {
                case 'Долг':
                    $user_pol['Вк_Имя'] = 'Революция долг';
                    $user_pol['Ид'] = 2000000081;
                    break;
                case 'Орден':
                    $user_pol['Вк_Имя'] = 'Орден';
                    $user_pol['Ид'] = 2000000098;
                    break;
                case 'Триумвират':
                    $user_pol['Вк_Имя'] = 'Триумвират Ордена';
                    $user_pol['Ид'] = 2000000095;
                    break;
                case 'Правители':
                   $user_pol['Вк_Имя'] = 'Местечковые царьки';
                    $user_pol['Ид'] = 2000000068;
                    break;
                case 'Бар':
                    $user_pol['Вк_Имя'] = 'Бар';
                    $user_pol['Ид'] = 2000000067;
                    break;
            }
        }
        foreach ($mess as $key => $value)
        {
            if ($key != 0 AND $key != 1)
                $text .= "$value ";
        }
        $vk->sendMessage($peer_id, "Письмо отправлено. [id{$user_pol['Ид']}|{$user_pol['Вк_Имя']}] получит его в ближайшее время.");
        $vk->sendMessage($user_pol['Ид'], "$text");
    }
    if ($mess[0].$mess[1] == 'Переименоватьгород')
    {
        $text = explode("город ",$message);
        $name = explode(" в",$text[1]);
        $name = $name[0];
        $new_name = explode("в ",$text[1]);
        $new_name = $new_name[1];
        mysqli_query($Connect, "UPDATE Several_build SET Локация = '$new_name' WHERE Локация = '$name'"); // Перенос бизов
        mysqli_query($Connect, "UPDATE Several_map SET Владелец = '$new_name' WHERE Владелец = '$name'");
        mysqli_query($Connect, "UPDATE Several_towns SET Название = '$new_name' WHERE Название = '$name'");
        mysqli_query($Connect, "UPDATE Several_user SET Локация = '$new_name' WHERE Локация = '$name'");
        $vk->sendmessage(VK_LOG_TECH,"Город $name отныне переименован в $new_name!");
    }
    /* Переименовать город Новоордынск в Новая Гавань
    if($message == 'Обнова 4545') { //Заполнение провинций информацией
        $vk->sendmessage($id, "Понеслось");
        $z = mysqli_query($Connect, "SELECT * FROM Several_map WHERE 1");
        while ($update_mob_lut = mysqli_fetch_assoc($z)) {
            $js_mob = json_decode($update_mob_lut['Мобы'], TRUE);
            $js_mob['Мобы'][0] = "Собака";
            $js_mob['Мобы'][1] = "Бандит";
            $js_mob['Мобы'][2] = "Мутапес";
            $js_mob['Мобы'][3] = "Ананасер";
            $js_mob['Мобы'][4] = "Слон-переросток";
            $js_mob = json_encode($js_mob, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            mysqli_query($Connect, "UPDATE Several_map SET Мобы = '$js_mob' WHERE sys_id = '{$update_mob_lut['sys_id']}'");
            }
        $vk->sendmessage($id, "Обнова выпущена. Заполнено все кроме лута.");
        }
    if($message == 'Обнова 1907') {
        $vk->sendmessage($id, "Понеслось");
        $z = mysqli_query($Connect, "SELECT * FROM Several_map WHERE 1");
        while ($res = mysqli_fetch_assoc($z)) {
            $tx = $res['Владелец'];
            $tx1 = "Отсутствует";
            if ($res['Владелец'] == 'Хартмарк' OR $res['Владелец'] == 'Головашингтон' OR $res['Владелец'] == 'Нью-Солсбери') {
                $tx1 = "Королевство Хартмарк";
            } elseif ($res['Владелец'] == 'Павловград' OR $res['Владелец'] == 'Нью-Наварро' OR $res['Владелец'] == 'Майорбург' OR $res['Владелец'] == 'Военград') {
                $tx1 = "Военград";
            } elseif ($res['Владелец'] == 'Волоберг' OR $res['Владелец'] == 'Арсенополис') {
                $tx1 = "Демократическая Республика";
            } elseif ($res['Владелец'] == 'Санкт-Иактбург') {
                $tx1 = "Санкт-Иактбург";
            } elseif ($res['Владелец'] == 'Новоордынск') {
                $tx1 = "Корпорация «Орбиталь»";
            }
            mysqli_query($Connect, "UPDATE Several_map SET Государство = '$tx1' WHERE Владелец = '$tx'");
            $vk->sendmessage($id, "{$res['Название']}.\nГосударство: {$res['Государство']}.");
            }
        $vk->sendmessage($id, "Готово");


        }
    if($message == 'Обнова 7532'){
        $vk->sendmessage(ИД_ХАРТМАНН,"Обнова началась.");
        $z = mysqli_query($Connect, "SELECT * FROM Several_user WHERE 1");
        while ($res = mysqli_fetch_assoc($z)) {
            if($res['Картинки'] != '7532'){
                $js_invent = json_decode($res['Инвентарь'],TRUE);
                $js_invent['Кошелек'] = $js_invent['Кошелек'] * 20;
                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

                $js_prop = json_decode($res['Бизнес'],TRUE);
                $js_prop["{$user['Локация']}"]["Хранилище"]['Банк']['По факту'] = $js_prop["{$user['Локация']}"]["Хранилище"]['Банк']['По факту'] * 20;
                $js_prop = json_encode($js_prop, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

                $js_bank = json_decode($res['Ростовщики'], TRUE);
                foreach ($js_bank["Депозит"] as $town => $value){
                    $js_bank["Депозит"]["$town"] = $value * 20;
                }
                $js_bank = json_encode($js_bank,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                mysqli_query($Connect, "UPDATE Several_user SET Картинки = '7532', Ростовщики = '$js_bank', Бизнес = '$js_prop', Инвентарь = '$js_invent' WHERE Ид = {$res['Ид']}");
                $vk->sendmessage(ИД_ХАРТМАНН,"{$res['Вк_Имя']} обновлен.");
            }
        }
        }
    if($message == 'Обнова 0010'){
        $vk->sendmessage(ИД_ХАРТМАНН,"Обнова началась.");
        $z = mysqli_query($Connect, "SELECT * FROM Several_user WHERE 1");
        while ($res = mysqli_fetch_assoc($z)) {
            if($res['Картинки'] != '0010'){
                if($id == ИД_ХАРТМАНН){
                $bank = 0;
                $js_bank = json_decode($res['Ростовщики'], TRUE);
                foreach ($js_bank["Депозит"] as $town => $value){
                    $bank += $js_bank["Депозит"]["$town"];
                }
                $js_bank = json_encode($js_bank,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

                mysqli_query($Connect, "UPDATE Several_user SET Картинки = '0010', Ростовщики = '$bank' WHERE Ид = {$res['Ид']}");
                $vk->sendmessage(VK_LOG_TECH,"{$res['Вк_Имя']} обновлен.");
                }
            }
        }
        }
    if($message == 'Обнова 0011'){
        $vk->sendmessage(ИД_ХАРТМАНН,"Обнова началась.");
        $z = mysqli_query($Connect, "SELECT * FROM Several_user WHERE 1");
        while ($res = mysqli_fetch_assoc($z)) {
            if($res['Картинки'] != '0011'){
                $js_char = json_decode($res['Характеристики'],TRUE);
                mysqli_query($Connect, "UPDATE Several_user SET Картинки = '0011', Подданство = '{$js_char['Паспорт']['Гражданство']}' WHERE Ид = {$res['Ид']}");
                $vk->sendmessage(VK_LOG_TECH,"{$res['Вк_Имя']} обновлен.");

            }
        }
        }
    if($message == 'Обнова 0012'){
        $vk->sendmessage(ИД_ХАРТМАНН,"Обнова началась.");
        $z = mysqli_query($Connect, "SELECT * FROM Several_user WHERE 1");
        while ($res = mysqli_fetch_assoc($z)) {
            if($res['Картинки'] != '0012'){
                $town = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT * FROM Several_towns WHERE Название = '{$res['Локация']}'"));
                mysqli_query($Connect, "UPDATE Several_user SET Картинки = '0012',Титул = 'Подданый', Подданство = '{$town['Государство']}' WHERE Ид = {$res['Ид']}");
                $vk->sendmessage(VK_LOG_TECH,"{$res['Вк_Имя']} обновлен. Новое подданство {$town['Государство']}");

            }
        }
        }
    if($message == 'Обнова 0013'){
        $vk->sendmessage($peer_id,"Обнова началась.");
        $z = mysqli_query($Connect, "SELECT * FROM Several_user WHERE 1");
        while ($res = mysqli_fetch_assoc($z)) {
            if($res['Картинки'] != '0013'){

                $js_prop = json_decode($res['Бизнес'],TRUE);
                $js_invent = json_decode($res['Инвентарь'],TRUE);
                $js_invent['Кошелек'] += $js_prop["{$res['Локация']}"]["Хранилище"]['Банк']['По факту'] * 20;
                $js_prop = json_encode($js_prop, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                $js_invent = json_encode($js_invent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

                mysqli_query($Connect, "UPDATE Several_user SET Картинки = '0013', Бизнес = '$js_prop', Инвентарь = '$js_invent' WHERE Ид = {$res['Ид']}");
                $vk->sendmessage(VK_LOG_TECH,"{$res['Вк_Имя']} обновлен.");
                }
            }
        }
    if($message == 'Обнова 0014'){
        $vk->sendmessage($peer_id,"Обнова началась.");
        $z = mysqli_query($Connect, "SELECT * FROM Several_user WHERE 1");
        while ($res = mysqli_fetch_assoc($z)) {
            if($res['Картинки'] != '0014'){

                $js_visa = json_decode($res['Виза'],TRUE);
                $js_visa["{$res['Подданство']}"] = 'Получена';
                $js_visa = json_encode($js_visa, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

                mysqli_query($Connect, "UPDATE Several_user SET Картинки = '0014', Виза = '$js_visa' WHERE Ид = {$res['Ид']}");
                $vk->sendmessage(VK_LOG_TECH,"{$res['Вк_Имя']} обновлен.\nВиза: {$res['Подданство']}.");
                }
            }
        }
    */
}

/*
if (isset($payload['location']))  // если payload существует
    $loc = $payload['location'];
else
    $loc = 'Альферия';
foreach ($map[$loc] as $name => $len)
    //array_push($buttons, [['location' => $name], "$name ($len минут)", 'blue']);
    $buttons [] = [[['location' => $name], "$name ($len минут)", 'green']];

$vk->sendButton($id,'Выберите путь:',$buttons);
*/
