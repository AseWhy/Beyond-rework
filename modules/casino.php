<?php 

/**КНОПКИ***/

$button['MAIN'] = [
    [['text', ['casino', 'kings', 'start'], "Короли", "green"],
    ['text', ['casino', 'figur', 'start'], "Фигурки", "green"]]
    [['text', ['bar', 'main'], "Вернуться в бар", "white"]]];
        
$button['MONEY'] = [[['text', ['casino', 'main'], "Отмена", "white"]]];
    
$button['KINGS']['START'] = [
    [['text', ['casino', 'kings', 'money'], "Начать игру", "green"]],
    [['text', ['casino', 'main'], "Вернуться", "white"]]];
            
$button['KINGS']['GAME'] = [
    [['text', ['casino', 'kings', 'toss'], "Дейрон", "green"],
    ['text', ['casino', 'kings', 'toss'], "Эфраим", "green"]],
    [['text', ['casino', 'main'], "Вернуться", "white"]]];
            
$button['FIGUR']['START'] = [
    [['text', ['casino', 'figur', 'money'], "Начать игру", "green"]],
    [['text', ['casino', 'figur', 'cost'], "Ценность фигурок", "red"]],
    [['text', ['casino', 'main'], "Вернуться", "white"]]];
            
$button['FIGUR']['FIRST'] = [[['text', ['casino', 'figur', 'toss'], "Взять фигурку", "green"]]];

$button['FIGUR']['GAME'] = [
    [['text', ['casino', 'figur', 'toss'], "Взять фигурку", "green"]],
    [['text', ['casino', 'figur', 'about'], "Описание фигурки", "red"]],
    [['text', ['casino', 'figur', 'end'], "Хватит", "blue"]]];
    
$button['FIGUR']['LOSE'] = [[['text', ['casino', 'main'], "Чёрт!", "red"]]];
$button['FIGUR']['DRAW'] = [[['text', ['casino', 'main'], "Я был так близок!", "blue"]]];
$button['FIGUR']['WIN'] = [[['text', ['casino', 'main'], "Победа!", "green"]]];

/***ОСНОВНОЙ КОД***/

switch ($payload[1])
{
    case 'main':
        $vk->sendButton($user_id, "Вы пришли в казино.\nВ какую игру вы желаете сыграть?", $button['MAIN']);
        $db->query("UPDATE `Several_user` SET `RAM` = ?n WHERE `vk_id` = ?i", NULL, $user_id);
        break;
    case 'kings':
        switch($payload[2])
        {
            case 'start':
                $vk->sendButton($user_id, "Правила игры в монетку:\n1. Вы загадываете сторону, которая окажется видна после падения монетки.\n2. Ставите мешок монет на стол.\n3. Ведущий подкидывает монетку с изображением Древних Королей.\n4. Если вы угадали, ваш мешочек удваивается.", $button['KINGS']['START']);
                break;
            case 'money':
                $vk->sendButton($user_id, "Введите сумму на которую хотите сыграть.", $button['MONEY']);
                $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'casino kings', $user_id);
                break;
            case 'toss':
                $rand = rand(1, 100);
                if ($user['RAM'] > $user['Инвентарь']['Кошелёк'])
                    endReply("У вас кончились деньги на ставку!");
                if ($rand >= 51)
                {
                    $user['Инвентарь']['Кошелёк'] += $user['RAM']['Ставка'];
                    $vk->sendButton($user_id, "Отлично! Ваш Король улыбается вам! Вы выиграли {$user['RAM']['Ставка']}!\nУ вас в кошельке {$user['Инвентарь']['Кошелёк']} монет!", $button['KINGS']['GAME']);
                }
                else
                {
                    $user['Инвентарь']['Кошелёк'] -= $user['RAM']['Ставка'];
                    $vk->sendButton($user_id, "Ваш Король отвернулся от вас... Вы проиграли {$user['RAM']['Ставка']}.\nУ вас в кошельке осталось {$user['Инвентарь']['Кошелёк']} монет.", $button['KINGS']['GAME']);
                }
                updateUser($user, ['Инвентарь']);
                break;
        }
        break;
    case 'figur':
        switch($payload[2])
        {
            case 'start':
                $vk->sendButton($user_id, "Правила игры в Фигурки:\n1. Ваша задача набрать больше очков, чем противник.\n2. В случае набора более 30 очков, вы проигрываете.\n3. Разные фигурки дают разное количество очков.\n4. Фигурки могут попадаться несколько раз.", $button['FIGUR']['START']);
                break;
            case 'cost':
                foreach ($js_21 as $value)
                    $text .= "Фигурка \"{$value['Название']}\" = {$value['Очки']} очков";
                $vk->reply($text);
                break;
            case 'money':
                $vk->sendButton($user_id, "Сколько монет вы хотите поставить на эту игру?", $button['MONEY']);
                $db->query("UPDATE `Several_user` SET `Меню` = '?s' WHERE `vk_id` = ?i", 'casino figurs', $user_id);
                break;
            case 'toss':
                $rand = rand(0, 23);
                $user['RAM'] = json_decode($user['RAM'], TRUE);
                $user['RAM']['Очки'] += $js_21[$rand]['Очки'];
                if ($js_21[$rand]['Очки'] == 1)
                    $text = 'очко';
                elseif ($js_21[$rand]['Очки'] > 1 AND $js_21[$rand]['Очки'] < 5)
                    $text = 'очка';
                else
                    $text = 'очков';
                if (substr($user['RAM']['Очки'], -1) == 1 AND $user['RAM']['Очки'] != 11)
                    $text_2 = 'очко';
                elseif (substr($user['RAM']['Очки'], -1) > 1 AND substr($user['RAM']['Очки'], -1) < 5 AND substr($user['RAM']['Очки'], 0, 1) != 1)
                    $text_2 = 'очка';
                else
                    $text_2 = 'очков';
                $user['RAM']['Фигурка'] = $js_21[$rand]['Название'];
                updateUser($user, ['RAM']);
                if ($user['RAM']['Очки'] <= 30)
                    $vk->sendButton($user_id, "Вы вытягиваете фигурку.. И это \"{$js_21[$rand]['Название']}\"!\nЭта фигурка приносит вам {$js_21[$rand]['Очки']} $text!\nТеперь в сумме у вас {$user['RAM']['Очки']} $text_2, возьмёте еще один?", $button['FIGUR']['GAME']);
                else
                    $vk->sendButton($user_id, "Вы вытягиваете фигурку.. И это \"{$js_21[$rand]['Название']}\"!\nЭта фигурка приносит вам {$js_21[$rand]['Очки']} $text!\nТеперь в сумме у вас {$user['RAM']['Очки']} $text_2.\n\nВы набрали больше 30-ти очков! \"{$user['RAM']['Фигурка']}\" оказалась лишним камнем... Вы проиграли свои {$user['RAM']['Ставка']}!", $button['FIGUR']['LOSE']);
                break;
            case 'end':
                $user['RAM'] = json_decode($user['RAM'], TRUE);
                $points_user = $user['RAM']['Очки'];
                $carma = (int) ($user['Аккаунт']['Карма'] / 10);
                $points_enemy = rand((23 + $carma), 30);
                $rand_draw = rand(1, 19); //При выигрыше есть 10.5% шанс, что будет ничья.
                if ($points_user > $points_enemy AND $rand_draw < 3)
                    $points_enemy = $points_user;
                if ($user['Имя'] == 'Аргокон Эстейл' AND $points_user > $points_enemy AND $rand_draw < 7) //вынес за день 5кк
                    $points_enemy = $points_user;
                if ($points_user > $points_enemy)
                {
                    if (abs($user['Аккаунт']['Карма']) < 49)
                        $user['Аккаунт']['Карма'] += 1;
                    $user['Инвентарь']['Кошелек'] += $user['RAM']['Ставка'] * 2;
                    $vk->sendButton($user_id, "Вы набрали $points_user очков, а ваш противник $points_enemy! Это победа! Вы выиграли ". $user['RAM']['Ставка'] * 2 ."!", $button['FIGUR']['WIN']);
                }
                elseif ($points_user < $points_enemy)
                {
                    if (abs($user['Аккаунт']['Карма']) < 49 AND $points_user > 23)
                        $user['Аккаунт']['Карма'] -= 1;
                    $vk->sendButton($user_id, "Вы набрали $points_user очков, а ваш противник $points_enemy! Это поражение... Вы проиграли свои {$user['RAM']['Ставка']}!", $button['FIGUR']['LOSE']);
                }
                elseif ($points_user == $points_enemy)
                {
                    $user['Инвентарь']['Кошелек'] += $user['RAM']['Ставка'];
                    $vk->sendButton($user['Ид'], "Вы набрали $points_user очков.. Ваш противник набрал столько же! Это ничья. Вам вернули ваши {$user['RAM']['Ставка']}.", $button['FIGUR']['DRAW']);
                }
                updateUser($user, ['Инвентарь', 'Аккаунт']);
                break;
            case 'about':
                $user['RAM'] = json_decode($user['RAM'], TRUE);
                $key = array_search($user['RAM']['Фигурка'], array_column($js_21, 'Название'));
                $vk->reply("{$user['RAM']['Фигурка']}\n{$js_21[$key]['Название']}");
                break;
        }
        break;
    case NULL:
        $val = round($message, 2);
        if ($val < 0)
            endReply("Хорошая попытка, но это так не работает.");
        elseif ($val > 25000)
            endReply("Максимальная сумма для игры: 25 000");
        if ($val > $user['Инвентарь']['Кошелёк'])
            endReply("Эй эй! У вас нет столько денег! Сходите, возьмите займ и возвращайтесь, вам ведь хочется отыграться?");
        switch ($menu[1]) 
        {
            case 'kings':
                $db->query("UPDATE `Several_user` SET `Меню` = ?n, `RAM` = ?d WHERE `vk_id` = ?i", NULL, $val, $user_id);
                $vk->sendButton($user_id, "Отлично! Вы поставили $val на кон!\nТеперь выберите своего Короля!", $button['KINGS']['GAME']);
                break;
            case 'figur':
                $user['Инвентарь']['Кошелёк'] -= $val;
                $user['RAM'] = NULL;
                $user['RAM']['Очки'] = 0;
                $user['RAM']['Ставка'] = $val;
                updateUser($user, ['Инвентарь', 'RAM']);
                $db->query("UPDATE `Several_user` SET `Меню` = ?n WHERE `vk_id` = ?i", NULL, $user_id);
                $vk->sendButton($user_id, "Отлично! Вы поставили $val на кон!\nТеперь тяните фигурку!", $button['FIGUR']['FIRST']);
                break;
        }
        break;
}

?>