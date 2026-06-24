<?php

namespace App\Config;
// $a1 = dirname(__DIR__);
// define('BASE_PATH', dirname(__DIR__)); // apunta a src/
// define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
// define('BASE_URL', 'http://localhost:8080/');
// define('BASE_PATH', dirname(__DIR__)); // apunta a src/
// define('BASE_URL', 'http://localhost:8080/');
// config.php

class Settings
{

    const URL_PREFIX = '/';
    // const URL_BASE = URL_BASE_PATH . 'index.php?r=';
    const DB_HOST =  'db';
    const DB_PORT = '3306';  // Puerto estándar de MySQL, cambia según necesidades
    const DB_NAME = 'concesionaria';
    const DB_USER = 'root';
    const DB_PASSWORD = 'root';
    const DB_CHARSET = 'utf8mb4';

    public static function getUrlBase()
    {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        return 'http://' . $host . self::URL_PREFIX . 'index.php/';
    }
}
