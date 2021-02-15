<?php

require_once('vendor/autoload.php');
use Krugozor\Database\Mysql\Mysql as Mysql;

//$db->query("INSERT INTO `Провинции` SET ?A['?s', '?s', '?s', '?s', ?i, '?s', '?s']", $str);

function findCentroid($dx, $dy)
{
    $a = 0;
    $x = 0;
    $y = 0;
    $f = NULL;
    $l = count($dx) - 1;
    echo $l;
    for ($i = 0, $j = $l - 1; $i < $l; $j = $i++) {
        $f = ($dx[$i] - $dx[0]) * ($dy[$j] - $dy[0]) - ($dx[$j] - $dx[0]) * ($dy[$i] - $dy[0]);
        
        $a += $f;

        $x += ($dx[$i] + $dx[$j] - 2 * $dx[0]) * $f;
        $y += ($dy[$i] + $dy[$j] - 2 * $dy[0]) * $f;
    }

    $f = $a * 3;

    return [($x / $f + $dx[0]), ($y / $f + $dy[0])];
}

$db = Mysql::create('localhost', 'u0kleonido_republic3', 'ifjCdGTNmx')
           ->setCharset('utf8')
           ->setDatabaseName('u0kleonido_republic3');
$file = 'bot_map_test1.geojson';
$datatest = file_get_contents($file);
$data = json_decode($datatest, TRUE);

$biomes = [
    '0' => 'Океан',
    '5' => 'Тропический лес',
    '6' => 'Лес',
    '7' => 'Тропический лес',
    '8' => 'Тропический лес',
    '12' => 'Болото'];

$provinces = [
    '27' => 'Хартмарк',
    '28' => 'Санкт-Иактбург',
    '29' => 'Новый Ордынск',
    '30' => 'Дистопия',
    '31' => 'Осетинск',
    '32' => 'Сталинград'];

$states = [
    '17' => 'Республика Парадоксия',
    '18' => 'Александрийская Империя',
    '19' => 'Корпорация Орбиталь'];

foreach ($data['features'] as $key => &$elem)
{
    $arr_prov = NULL;
    foreach ($elem['geometry']['coordinates'][0] as $key_2 => &$elem_2)
    {
        
        echo var_dump($elem_2[0])."<br>";
        //$elem_2[0] = round($elem2[0], 1);
        $arr_prov[0][] = $elem_2[0] * 2 * 5;
        //$elem_2[1] = round($elem2[1], 1);
        $arr_prov[1][] = $elem_2[1] * 2 * 5;
    }   
    echo var_dump($arr_prov[0]);
    echo "<br>";
    if ($elem['properties']['biome'] != 0)
    {
        $str = [
            'sys_id' => (int) $elem['properties']['id'],
            'Название' => "Провинция №{$elem['properties']['id']}",
            'Местность' => $biomes[$elem['properties']['biome']],
            'Город' => $provinces[$elem['properties']['province']],
            'Государство' => $states[$elem['properties']['state']],
            'Пути' => json_encode($elem['properties']['neighbors'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK),
            'Высота' => (int) $elem['properties']['height'],
            'Геометрия' => json_encode($elem['geometry']['coordinates'][0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK),
            'Центр' => json_encode(findCentroid($arr_prov[0], $arr_prov[1]), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK)];
        var_dump($str);
        $db->query("INSERT INTO `Провинции` SET ?A[?i, '?s', '?s', '?s', '?s', '?s', ?i, '?s', '?s']", $str);
    }
}
echo "ha-ha ok";
//$dataok = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
//file_put_contents($file, $dataok);
/*$db = Mysql::create('localhost', 'u0kleonido_rpbot', 'aMSxduAhy7')
           ->setCharset('utf8')
           ->setDatabaseName('u0kleonido_rpbot');

$db->query('
    CREATE TABLE IF NOT EXISTS userstwo(
        id int unsigned not null primary key auto_increment,
        name varchar(255),
        family varchar(255),
        age tinyint
        )
    ');
foreach($data->list as $elem)
   $db->query("INSERT INTO `userstwo` VALUES (?n, '?s', '?s', ?i)", null, $elem->family, $elem->name, $elem->age);
$abc = $db->query("SELECT age FROM `userstwo` WHERE `name` = '?s'", 'Hartmann');
echo 'Ok<br>';
echo var_dump($abc->fetch_assoc());*/

?>