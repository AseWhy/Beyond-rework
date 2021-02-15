<?php

$LOADER = require_once 'vendor/autoload.php';

$BASE_CONF = include_once 'config/database.php';

use Krugozor\Database\Mysql\Mysql;

use function PHPSTORM_META\type;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$client = Mysql::create($BASE_CONF['host'], $BASE_CONF['user'], $BASE_CONF['pass'])->setCharset('utf8')->setDatabaseName($BASE_CONF['base']);

if(!isset($argv[1]))
    return;

switch($argv[1]) {
    case 'migrate':
        // 
        // Тут проверяю, есть ли таблица с миграциями, если нет создаю.
        // 
        if($client->query("SHOW TABLES FROM ?f like '?s'", $BASE_CONF['base'], 'migrations')->getOne() == null) {
            $client->query("CREATE TABLE `beyond_project`.`migrations` (
                `id` INT(64) NOT NULL AUTO_INCREMENT,
                `date` DATETIME(6) NOT NULL,
                `name` VARCHAR(255) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE = InnoDB");
        }

        if(!file_exists('migrations')) {
            mkdir('migrations');
        }

        //
        // Читаю папку с миграциями
        //
        $files = glob("migrations/*.php");

        foreach($files as $name) {
            $base = basename($name, '.php');

            if($client->query("SELECT * FROM `migrations` WHERE `name` = '?s'", $base)->getOne()) {
                continue;
            }

            try {
                $migration = require_once $name;
                
                if(gettype($migration) == 'object') {
                    if(!$migration($client)) {
                        throw new Error("The migration $base return failback value. Migration failed.");
                    }
                }

                $client->query("INSERT INTO `migrations` (`name`, `date`) VALUES ('?s', CURRENT_TIMESTAMP)", $base);
            } catch (Exception $e) {
                echo "Error when use migration of $base: " . $e->getMessage();
            }
        }
    break;
    // 
    // Создает миграцию для дальнейшего её использования
    // 
    case 'make:migration':
        if(!file_exists('migrations')) {
            mkdir('migrations');
        }
        
        //
        // Пояснение для миграции
        //
        $subname = isset($argv[2]) ? '_' . str_replace('/-_ /', '_', join('_', array_slice($argv, 2))) : '';

        $fp = fopen("migrations/" . date('d_m_Y_h_i_s') . $subname . '.php', "w");
        
        fwrite($fp, "<?php\n\n/*\n\tYOUR MIGRATION HERE\n*/\n\nreturn function(\$client){\n\t// Do code here...\n\n\treturn true;\n};");
        
        fclose($fp);
    break;
}