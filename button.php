 <?php

//*****Подключение Библ*****
//require_once('setting.php');
require_once('vendor/autoload.php'); //подключаем библу
use Krugozor\Database\Mysql\Mysql as Mysql;
use DigitalStar\vk_api\vk_api as vk_api;
//**************************
//***Соединение с вк и бд********
const VK_VERSION = '5.103';
const VK_KEY = '5940faaf4f4db6d1608a03672297a9da5de02d3467d715f109619ac1d98a99278d97ced11fc488d9ebea9';
const VK_OK = '629999b7';
//$db = Mysql::create(HOST, DB_USER, DB_PASS)->setCharset('utf8')->setDatabaseName(DB_NAME);
$vk = vk_api::create(VK_KEY, VK_VERSION)->setConfirm(VK_OK);
$vk->initVars($peer_id, $message, $payload, $user_id, $type, $data);
if ($user_id == 0)
    exit;


//*** ЦЕНТРАЛЬНАЯ ПЛОЩАДЬ ***//

/*$button['Центр'] = [
    [['text', 'Недвижимость | Главный', "Недвижимость", "green"],
    ['text', 'Магазин | Главный', "Магазин", "green"]],
    [['text', 'Банк | Главный', "Банк", "red"],
    ['text', 'Работа | Главный', "Работа", "red"],
    ['text', 'Бар | Главный', "Бар", "red"]],
    [['text', ['centre', 'suburb'], "+++город+++", "blue"]]];*/

$button['Центр'] = [
    [
        ['text', 'Банк', "Банк", "green"],
        ['text', 'Бизнес', "Бизнес", "green"],
        ['text', 'Магазин', "Магазин", "green"]],
    [
        ['text', 'Жильё', "Жильё", "red"],
        ['text', 'Работа', "Работа", "red"],
        ['text', 'Досуг', "Досуг", "red"]],
    [
        ['text', 'Окраины', "Окраины +++города+++", "blue"],
        ['text', 'Управление', "Управление", "blue"]]];

//*** МАГАЗИН ***//
    $button['Магазин'] = [
        [
            ['text', 'Магазин | Покупка', "Покупка", "green"],
            ['text', 'Магазин | Продажа', "Продажа", "red"]],
        [
            ['text', 'Центр', "Центр города", "white"]]];
    //
    $button['Магазин | Покупка'] = [
        [
            ['text', 'Магазин | Покупка | Меню', "Оружие", "green"],
            ['text', 'Магазин | Покупка | Меню', "Бомбы", "green"]],
        [
            ['text', 'Магазин | Покупка | Меню', "Броня", "blue"],
            ['text', 'Магазин | Покупка | Меню', "Аптечки", "blue"]],
        [
            ['text', 'Магазин | Покупка | Меню', "Транспорт", "red"],
            ['text', 'Магазин | Покупка | Меню', "Рюкзаки", "red"]],
        [
            ['text', 'Магазин', "Выйти из меню покупки", "white"]]];
    //
    $button['Магазин | Покупка | Меню'] = [
        [
            ['text', 'Магазин | Покупка | Выбор', "***выбор***", "green"]],
        [
            ['text', 'Магазин | Покупка', "Вернуться в меню покупки", "white"]]];
    //   
    $button['Магазин | Покупка | Выбор'] = [
        [
            ['text', 'Магазин | Покупка', "+++купить+++", "green"]],
        [
            ['text', 'Магазин | Покупка', "Отмена", "red"]]];
    $func['Магазин | Покупка | Выбор'] = "Подтверждение выбора";
    //
    $button['Магазин | Продажа'] = [
        [
            ['text', 'Магазин | Продажа | Меню', "Бомбы", "green"],
            ['text', 'Магазин | Продажа | Меню', "Аптечки", "blue"]],
        [
            ['text', 'Магазин | Продажа | Лут', "Лут", "red"]],
        [
            ['text', 'Магазин', "Вернуться", "white"]]];
    //
    $button['Магазин | Продажа | Меню'] = [
        [
            ['text', 'Магазин | Продажа | Выбор', "***выбор***", "green"]],
        [
            ['text', 'Магазин | Продажа', "Вернуться в меню продажи", "white"]]];
    //
    $button['Магазин | Продажа | Выбор'] = [
        [
            ['text', 'Магазин | Продажа', "+++подтвердить продажу+++", "green"]],
        [
            ['text', 'Магазин | Продажа', "Отмена", "red"]]];
    //
    $button['Магазин | Продажа | Лут'] = [
        [
            ['text', 'Магазин | Продажа | Выбор', "Продать всё", "red"]],
        [
            ['text', 'Магазин | Продажа | Выбор', "***выбор***", "green"]],
        [
            ['text', 'Магазин | Продажа', "Вернуться в меню продажи", "white"]]];
    $func['Магазин | Продажа | Лут'] = "При выборе пункта \"продать всё\" пользователю в одном сообщении будет показана стоимость каждого товара.";


//*** РАБОТА ***//
    $button['Работа'] = [
        [
            ['text', 'Работа | Работать', "+++работать+++", "green"]],
        [
            ['text', 'Работа | Информация', "+++информация+++", "red"],
            ['text', 'Работа | Вакансии', "Вакансии", "red"]],
        [
            ['text', 'Центр', "Центр города", "white"]]];
    //
    $func['Работа | Работать'] = "Нажимая на кнопку \"Работать\", игрок получает очко опыта конкретной работы. Как и раньше, четыре уровня профессионализма. После перехода на новый проф. уровень у игрока прокачиваются некоторые навыки (зависит от конкретной работы).";
    //
    $func['Работа | Информация'] = "*описание работы* и уровни игрока на всех работах";
    //
    $button['Работа | Вакансии'] = [
        [
            ['text', 'Работа | Выбор', "***выбор***", "green"]],
        [
            ['text', 'Работа', "Я передумал", "white"]]];
    //
    $func['Работа | Вакансии'] = "Список вакансий, работать на которых позволяют навыки игрока.";
    //
    $button['Работа | Выбор'] = [
        [
            ['text', 'Работа', "*Вакансия* так *вакансия*", "green"]]];


//*** ЖИЛЬЁ ***//
    $button['Жильё'] = [
        [
            ['text', 'Жильё | Отель', "Отель", "green"],
            ['text', 'Жильё | Дом', "+++дом+++", "green"]],
        [
            ['text', 'Центр', "Центр города", "white"]]];
    //
    $button['Жильё | Отель'] = [
        [
            ['text', '_', "Состояние", "blue"]],
        [
            ['text', 'Жильё', "Покинуть отель", "green"]]];
    //
    $button['Жильё | Дом'] = [
        [
            ['text', 'Жильё | Дом | Отдохнуть', "Отдохнуть", "green"]],
        [
            ['text', 'Жильё | Дом | Осмотреться', "Осмотреться", "red"],
            ['text', 'Жильё | Дом | Улучшить', "Улучшить", "blue"]],
        [
            ['text', 'Жильё', "Выйти из дома", "white"]]];
    //
    $button['Жильё | Дом | Отдохнуть'] = [
        [
            ['text', '_', "Состояние", "blue"]],
        [
            ['text', 'Жильё | Дом', "Вернуться", "green"]]];  
    //
    $button['Жильё | Дом | Улучшить'] = [
        [
            ['text', 'Жильё | Дом', "Улучшить жильё", "green"]],   
        [
            ['text', 'Жильё | Дом', "Вернуться", "red"]]];
    //
    $func['Жильё | Дом | Осмотреться'] = "*описание текущего уровня жилья*";


//*** БАНК ***//
    $button['Банк'] = [
        [
            ['text', 'Банк | Пополнить', "Пополнить счёт", "green"],
            ['text', 'Банк | Снять', "Снять деньги", "green"]],
        [
            ['text', 'Банк | Информация', "Информация", "blue"],
            ['text', 'Банк | Настройки', "Настройки", "blue"],
            ['text', 'Банк | Перевод', "Перевести", "blue"]],
        [
            ['text', 'Центр', "Центр города", "white"]]];
    //
    $button['Банк | Информация'] = [
        [
            ['text', 'Банк | Информация | Пополнение', "Пополнения счёта", "green"],
            ['text', 'Банк | Информация | Снятие', "Снятия со счёта", "green"]],
        [
            ['text', 'Банк | Информация | Принятые', "Принятые переводы", "blue"],
            ['text', 'Банк | Информация | Отправленные', "Отправленные переводы", "blue"]],
        [
            ['text', 'Банк | Информация | Переводы', "Все переводы", "red"],
            ['text', 'Банк | Информация | Все операции', "Все операции со счётом", "red"]],
        [
            ['text', 'Банк', "Вернуться в банк", "white"]]];
    //
    $button['Банк | Настройки'] = [
        [
            ['text', 'Банк | Настройки | Тип аккаунта', "Тип банковского аккаунта", "green"]],
        [
            ['text', 'Банк | Настройки | Чёрный список', "Чёрный список", "blue"],
            ['text', 'Банк | Настройки | Белый список', "Белый список", "blue"]],
        [
            ['text', 'Банк', "Вернуться", "white"]]];
    //
    $button['Банк | Настройки | Чёрный список'] = [
        [
            ['text', 'Банк | Чёрный список | Добавить', "Добавить в чёрный список", "green"]],
        [
            ['text', 'Банк | Чёрный список | Удалить', "Убрать из чёрного списка", "blue"]],
        [
            ['text', 'Банк | Настройки', "Вернуться", "white"]]];
    //
    $button['Банк | Настройки | Белый список'] = [
        [
            ['text', 'Банк | Белый список | Добавить', "Добавить в белый список", "green"]],
        [
            ['text', 'Банк | Белый список | Удалить', "Убрать из белого списка", "blue"]],
        [
            ['text', 'Банк | Настройки', "Вернуться", "white"]]];
    //
    $button['Банк | Настройки | Тип аккаунта'] = [
        [
            ['text', 'Банк | Тип аккаунта | Открытый', "Открытый", "green"]],
        [
            ['text', 'Банк | Тип аккаунта | Закрытый', "Закрытый", "blue"]],
        [
            ['text', 'Банк | Настройки', "Вернуться", "white"]]];
    //
    $button['Банк | Пополнить'] = [
        [
            ['text', 'Банк', "***пополнить***", "green"]],
        [
            ['text', 'Банк', "Завершить и вернуться в банк", "red"]]];
    //
    $button['Банк | Снять'] = [
        [
            ['text', 'Банк', "***снять***", "green"]],
        [
            ['text', 'Банк', "Завершить и вернуться в банк", "red"]]];
    //
    $button['Банк | Перевод'] = [
        [
            ['text', 'Банк | Перевод | Получатель', "***ввести сумму***", "green"]],
        [
            ['text', 'Банк', "Завершить и вернуться в банк", "red"]]];
    //
    $button['Банк | Перевод | Получатель'] = [
        [
            ['text', 'Банк', "***ввести получателя***", "green"]],
        [
            ['text', 'Банк', "Завершить и вернуться в банк", "red"]]];

//*** БИЗНЕС ***//
    //
    $button['Бизнес'] = [
        [
            ['text', 'Бизнес | Список', "Список предприятий", "green"],
            ['text', 'Бизнес | Прибыль', "Собрать прибыль", "green"]],
        [
            ['text', 'Бизнес | Расширить | Выбор', "Расширить бизнес", "blue"],
            ['text', 'Бизнес | Предложения', "Предложения", "blue"]],
        [
            ['text', 'Центр', "Центр города", "white"]]];
    //
    $button['Бизнес | Расширить | Выбор'] = [
        [
            ['text', 'Бизнес | Расширить | Купить', "***выбор***", "green"]],
        [
            ['text', 'Бизнес', "Вернуться", "white"]]];
    //
    $button['Бизнес | Расширить | Купить'] = [
        [
            ['text', 'Бизнес', "Открыть бизнес №", "green"]],
        [
            ['text', 'Бизнес | Расширить | Выбор', "Возможно, позже", "red"]]];
    //
    $button['Бизнес | Предложения'] = [
        [
            ['text', 'Бизнес | Предложения | Мои', "Мои предложения", "green"],
            ['text', 'Бизнес | Предложения | Пришедшие', "Предложения игроков", "green"]],
        [
            ['text', 'Бизнес | Продать', "Продать бизнес", "blue"]],
        [
            ['text', 'Бизнес', "Вернуться к экрану бизнеса", "white"]]];
    //
    $button['Бизнес | Предложения | Мои'] = [
        [
            ['text', 'Бизнес | Предложения | Мои | Выбор', "***выбор***", "green"]],
        [
            ['text', 'Бизнес | Предложения', "Вернуться", "white"]]];
    //
    $button['Бизнес | Предложения | Мои | Выбор'] = [
        [
            ['text', 'Бизнес | Предложения', "Отменить это предложение", "red"]],
        [
            ['text', 'Бизнес | Предложения', "Вернуться", "white"]]];
    //
    $button['Бизнес | Предложения | Пришедшие'] = [
        [
            ['text', 'Бизнес | Предложения | Пришедшие | Выбор', "***выбор***", "green"]],
        [
            ['text', 'Бизнес | Предложения', "Вернуться", "white"]]];
    //
    $button['Бизнес | Предложения | Пришедшие | Выбор'] = [
        [
            ['text', 'Бизнес | Предложения', "Согласиться", "green"],
            ['text', 'Бизнес | Предложения', "Отказаться", "red"]],
        [
            ['text', 'Бизнес | Предложения', "Позже", "white"]]];
    //
    $button['Бизнес | Продать'] = [
        [
            ['text', 'Бизнес | Продать | Сумма', "***выбрать бизнесы***", "green"]],
        [
            ['text', 'Бизнес | Предложения', "Отмена", "white"]]];
    //
    $button['Бизнес | Продать | Сумма'] = [
        [
            ['text', 'Бизнес | Продать | Персона', "***указать сумму***", "green"]],
        [
            ['text', 'Бизнес | Предложения', "Отмена", "white"]]];
    //
    $button['Бизнес | Продать | Персона'] = [
        [
            ['text', 'Бизнес | Продать | Подтвердить', "***указать получателя***", "green"]],
        [
            ['text', 'Бизнес | Предложения', "Отмена", "white"]]];
    //
    $button['Бизнес | Продать | Подтвердить'] = [
        [
            ['text', 'Бизнес | Предложения', "Подтвердить", "green"]],
        [
            ['text', 'Бизнес | Предложения', "Отмена", "white"]]];
    //
    $func['Бизнес | Список'] = "*список предприятий*";
    $func['Бизнес | Прибыль'] = "*сумма полученной прибыли минус налоги*";

//*** ДОСУГ ***//
    $button['Досуг'] = [
        [
            ['text', 'Досуг | Казино', "Казино", "red"],
            ['text', 'Досуг | Рестораны', "Рестораны", "green"]],
        [
            ['text', 'Досуг | Тренировки', "Тренировки", "blue"]],
        [
            ['text', 'Центр', "Центр города", "white"]]];

    //*** КАЗИНО ***//
        $button['Досуг | Казино'] = [
            [
                ['text', 'Досуг | Казино | Короли | Старт', "Короли", "green"],
                ['text', 'Досуг | Казино | Фигурки | Старт', "Фигурки", "green"]],
            [
                ['text', 'Досуг | Казино | Кости | Старт', " Кости", "blue"]],
            [
                ['text', 'Досуг', "Покинуть казино", "white"]]];

        //***КОРОЛИ***//
        $button['Досуг | Казино | Короли | Старт'] = [
            [
                ['text', 'Досуг | Казино | Короли | Игра', "***ставка***", "green"]],
            [
                ['text', 'Досуг | Казино', "Вернуться", "white"]]];
        $func['Досуг | Казино | Короли | Старт'] = "Игра в Королей заключается в следующем: вы ставите мешочек монет на кон и выбираете одного из Древних Королей - Дейрона или Эфраима. ".
            "После этого ведущий подбрасывает монетку с их изображениями. Если выпал указанный вами король, ваш мешочек удваивается!\n\nВведите сумму ставки для начала игры.";
        //
        $button['Досуг | Казино | Короли | Игра'] = [
            [
                ['text', 'Досуг | Казино | Короли | Бросок', "Дейрон", "green"],
                ['text', 'Досуг | Казино | Короли | Бросок', "Эфраим", "green"]],
            [
                ['text', 'Досуг | Казино', "Вернуться", "white"]]];
        $func['Досуг | Казино | Короли | Бросок'] = "Вероятность успеха - 50%.";

        //***ФИГУРКИ***//
        $button['Досуг | Казино | Фигурки | Старт'] = [
            [
                ['text', 'Досуг | Казино | Фигурки | Ставка', "Начать игру", "green"]],
            [
                ['text', 'Досуг | Казино | Фигурки | Ценность', "Ценность фигурок", "red"]],
            [
                ['text', 'Досуг | Казино', "Вернуться", "white"]]];
        //
        $button['Досуг | Казино | Фигурки | Ставка'] = [
            [
                ['text', 'Досуг | Казино | Фигурки | Первый', "***ставка***", "green"]],
            [
                ['text', 'Досуг | Казино', "Отмена", "white"]]];
        //
        $button['Досуг | Казино | Фигурки | Первый'] = [
            [
                ['text', 'Досуг | Казино | Фигурки | Игра', "Взять фигурку", "green"]]];
        //
        $button['Досуг | Казино | Фигурки | Игра'] = [
            [
                ['text', 'Досуг | Казино | Фигурки | Взять', "Взять фигурку", "green"]],
            [
                ['text', 'Досуг | Казино | Фигурки | Описание', "Описание фигурки", "red"]],
            [
                ['text', 'Досуг | Казино | Фигурки | Финал', "Хватит", "blue"]]];    
        $button['Досуг | Казино | Фигурки | Финал'] = [
            [
                ['text', 'Досуг | Казино', "---Чёрт!---", "red"]],
            [
                ['text', 'Досуг | Казино', "---Я был так близок!---", "blue"]],
            [
                ['text', 'Досуг | Казино', "---Победа!---", "green"]]];
        //***КОСТИ***//
        $button['Досуг | Казино | Кости | Старт'] = [
            [
                ['text', 'Досуг | Казино | Кости | Финал', "Чёт", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "Разная чётность", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "Нечёт", "green"]],
            [
                ['text', 'Досуг | Казино | Кости | Ставка | Разность', "Разность", "red"],
                ['text', 'Досуг | Казино | Кости | Ставка | Комбинация', "Комбинация", "red"]],
            [
                ['text', 'Досуг | Казино', "Вернуться", "white"]]];
        //
        $func['Досуг | Казино | Кости | Старт'] = "Коэффициенты выигрыша:\nобычный - 1,0\nредкий - 1,3\nэпичный - 1,7\nневероятный - 2,0\n\nЧёт (редкий) - оба числа чётные.\nРазная чётность (обычный) - одно чётное, другое нечётное.\nНечёт (редкий) - оба числа нечётные\nРазность (разные коэффициенты) - разница между выпавшими числами (например, для чисел 2 и 5 она равна 3)\nКомбинация (невероятный) - указание конкретной комбинации.";
        //
        $button['Досуг | Казино | Кости | Ставка | Разность'] = [
            [
                ['text', 'Досуг | Казино | Кости | Финал', "0", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "1", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "2", "green"]],
            [
                ['text', 'Досуг | Казино | Кости | Финал', "3", "red"],
                ['text', 'Досуг | Казино | Кости | Финал', "4", "red"],
                ['text', 'Досуг | Казино | Кости | Финал', "5", "red"]],
            [
                ['text', 'Досуг | Казино', "Вернуться", "white"]]];
        //
        $func['Досуг | Казино | Кости | Ставка | Разность'] = "Коэффициенты выигрыша:\n0 и 1 - редкий\n2, 3 и 4 - эпичный\n5 - невероятный";
        //
        $button['Досуг | Казино | Кости | Ставка | Комбинация'] = [
            [
                ['text', 'Досуг | Казино | Кости | Финал', "1-1", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "1-2", "blue"],
                ['text', 'Досуг | Казино | Кости | Финал', "1-3", "red"]],
            [
                ['text', 'Досуг | Казино | Кости | Финал', "1-4", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "1-5", "blue"],
                ['text', 'Досуг | Казино | Кости | Финал', "1-6", "red"]],
            [
                ['text', 'Досуг | Казино | Кости | Финал', "2-2", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "2-3", "blue"],
                ['text', 'Досуг | Казино | Кости | Финал', "2-4", "red"]],
            [
                ['text', 'Досуг | Казино | Кости | Финал', "2-5", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "2-6", "blue"],
                ['text', 'Досуг | Казино | Кости | Финал', "3-3", "red"]],
            [
                ['text', 'Досуг | Казино | Кости | Финал', "3-4", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "3-5", "blue"],
                ['text', 'Досуг | Казино | Кости | Финал', "3-6", "red"]],
            [
                ['text', 'Досуг | Казино | Кости | Финал', "4-4", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "4-5", "blue"],
                ['text', 'Досуг | Казино | Кости | Финал', "4-6", "red"]],
            [
                ['text', 'Досуг | Казино | Кости | Финал', "5-5", "green"],
                ['text', 'Досуг | Казино | Кости | Финал', "5-6", "blue"],
                ['text', 'Досуг | Казино | Кости | Финал', "6-6", "red"]],
            [
                ['text', 'Досуг | Казино', "Вернуться", "white"]]];
        //
        $button['Досуг | Казино | Кости | Финал'] = [
            [
                ['text', 'Досуг | Казино', "---Чёрт!---", "red"]],
            [
                ['text', 'Досуг | Казино', "---Победа!---", "green"]]];

    //*** РЕСТОРАНЫ ***//
        $button['Досуг | Рестораны'] = [
            [
                ['text', 'Досуг | Рестораны | Бар', "Бар", "blue"],
                ['text', 'Досуг | Рестораны | VIP', "VIP-ресторан", "red"]],
            [
                ['text', 'Досуг', "Вернуться", "white"]]];
        //
        $button['Досуг | Рестораны | Бар'] = [
            [
                ['text', 'Досуг | Рестораны | Бар | Поесть', "Поесть", "green"],
                ['text', 'Досуг | Рестораны | Бар | Осмотреться', "Осмотреться", "blue"]],
            [
                ['text', 'Досуг | Рестораны | Бар | Выпить', "Выпить", "red"]],
            [
                ['text', 'Досуг | Рестораны', "Вернуться", "white"]]];
        //
        $func['Досуг | Рестораны | VIP'] = "Полностью наесться. Доступно только с донатом.";

    //*** ТРЕНИРОВКИ ***//
        $button['Досуг | Тренировки'] = [
            [
                ['text', 'Досуг | Тренировки | Вперёд', "Шахматы на время", "blue"],
                ['text', 'Досуг | Тренировки | Вперёд', "Лёгкая атлетика", "blue"]],
            [
                ['text', 'Досуг | Тренировки | Вперёд', "Курсы охоты", "red"],
                ['text', 'Досуг | Тренировки | Вперёд', "Биатлон", "red"]],
            [
                ['text', 'Досуг', "Вернуться", "white"]]];
        //
        $button['Досуг | Тренировки | Вперёд'] = [
            [
                ['text', 'Досуг | Тренировки | Вперёд', "Тренироваться", "blue"]],
            [
                ['text', 'Досуг | Тренировки', "Вернуться", "white"]]];
        //
        $func['Досуг | Тренировки'] = "Шахматы на время прокачивают интеллект и сноровку.\nЛёгкая атлетика прокачивает силу и выносливость.\nКурсы охоты прокачивают меткость, силу и интеллект.\nБиатлон прокачивает меткость, сноровку и выносливость.";
    
    
//*** ОКРАИНЫ ГОРОДА ***//
    $button['Окраины'] = [
        [
            ['text', 'Окраины | Выбор', "Ж/Д станция", "green"]],
        [
            ['text', 'Окраины | Выбор', "Речной порт", "blue"],
            ['text', 'Окраины | Выбор', "Морской порт", "blue"]],
        [
            ['text', 'Провинция', "Выйти из города", "white"],
            ['text', 'Центр', "Вернуться в центр", "white"]]];
    //
    $button['Окраины | Выбор'] = [
        [
            ['text', 'Окраины | Подтверждение', "***выбор города***", "green"]],
        [
            ['text', 'Центр', "Вернуться", "white"]]];
    //
    $button['Окраины | Подтверждение'] = [
        [
            ['text', 'Окраины', "***подтвердить***", "green"]],
        [
            ['text', 'Центр', "Отмена", "white"]]];

//*** ПРОВИНЦИЯ ***//
    $button['Провинция'] = [
        [
            ['text', 'Провиция | Побродить', "Побродить по территории", "green"]],
        [
            ['text', 'Провиция | Армия', "Подразделение №***", "green"]],
        [
            ['text', 'Провинция | Карта', "Карта", "red"],
            ['text', 'Провинция | Осмотреться', "Оссмотреться", "red"]],
        [
            ['text', 'Окраины', "Искать поселение", "blue"]]];
    //
    /*$button['Провинция | Карта'] = [
        [
            ['text', 'Окраины | Подтверждение', "***выбор города***", "green"]],
        [
            ['text', 'Центр', "Вернуться", "white"]]];
    //
    $button['Окраины | Подтверждение'] = [
        [
            ['text', 'Окраины', "***подтвердить***", "green"]],
        [
            ['text', 'Центр', "Отмена", "white"]]];*/

//*** *** ***//



//*** *** ***//



//*** *** ***//



//*** *** ***//



//*** ПРОСТЫЕ КОММАНДЫ ***//
    $command['Состояние'] = "Ваше текущее состояние:\nЗдоровье - 100/100\nСытость - 75/100\nБодрость - 60/80";
    $command['Персонаж'] = "Ваш текущий уровень - 10\nОпыт - 22/44\n\nНавыки:\nВыносливость - 10\nСила - 12\nСноровка - 11\nМеткость - 12\nИнтеллект - 10\n\nДоступные очки навыков - 4";
    $command['Инвентарь'] = "Кошелёк - 1917.0711\n\nОружие: АК-74\nОдежда: Бронежилет Л-17\nТранспорт: Mercedes-Maybach S-Класс\nРюкзак: Большой походный\n\nБомбы:\n1. Небольшая граната (4)\n2. Мегаподрывалка (1)\nСвободных слотов для аптечек - 6\n\nАптечки:\n1. Зелёнка (5)\n2. Целебное зелье (2)\nСвободных слотов для аптечек - 4\n\nЛут:\n1. Жетон (12)\n2. Амулет (2)\n3. Шестерёнка (7)\nСвободных слотов для лута - 9";
    $command['Помощь'] = "Список рабочих демонстрационных команд:\nСостояние\nПерсонаж\nИнвентарь";

//*** *** ***//



//*** *** ***//


if (isset($payload))
{
    if (isset($button[$payload]) AND isset($func[$payload]))
        $vk->sendButton($user_id, $func[$payload], $button[$payload]);
    elseif (isset($button[$payload]) AND empty($func[$payload]))
        $vk->sendButton($user_id, $payload, $button[$payload]);
    elseif (empty($button[$payload]) AND isset($func[$payload]))
        $vk->reply($func[$payload]);
    else
        $vk->reply("В разработке");
}
else
{
    if (isset($button[$message]))
        $vk->sendButton($user_id, "Высылаю кнопки", $button["$message"]);
    elseif (isset($command[$message]))
        $vk->reply($command[$message]);
    elseif (isset($message))
        $vk->sendButton($user_id, 'Добро пожаловать', $button['Центр']);
    else
        exit;
}

/*
1. 1-1, нечёт 1, разница 0 (1)
2. 1-2, разные 1, разница 1 (1)
3. 1-3, нечёт 2, разница 2 (1)
4. 1-4, разные 2, разница 3 (1)
5. 1-5, нечёт 3, разница 4 (1)
6. 1-6, разные 3, разница 5 (1)
7. 2-2, чёт 1, разница 0 (2)
8. 2-3, разные 4, разница 1 (2)
9. 2-4, чёт 2, разница 2 (2)
10. 2-5, разные 5, разница 3 (2)
11. 2-6, чёт 3, разница 4 (2)
12. 3-3, нечёт 4, разница 0 (3)
13. 3-4, разные 6, разница 1 (3)
14. 3-5, нечёт 5, разница 2 (3)
15. 3-6, разные 7, разница 3 (3)
16. 4-4, чёт 4, разница 0 (4)
17. 4-5, разные 8, разница 1 (4)
18. 4-6, чёт 5, разница 2 (4)
19. 5-5, нечёт 6, разница 0 (5)
20. 5-6, разные 9, разница 1 (5)
21. 6-6, чёт 6, разница 0 (6)

Комбинации:
1. Оба числа чётные/нечётные. Вероятность - 6/21.
2. Числа разные по чётности. 9/21.
3. Разница между числам:
    разница/случаев
    0/6
    1/5
    2/4
    3/3
    4/2
    5/1
4. 

*/

?>