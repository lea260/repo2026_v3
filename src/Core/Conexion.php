<?php

namespace App\Core;

use App\Config\Settings;
use PDO;
use PDOException;

// require_once __DIR__ . '/../config/config.php'; // Asegúrate de que la ruta sea correcta




class Conexion
{
    private static $instancia = null;
    // Método estático para obtener la conexión PDO
    public static function getPDOConnection(): PDO
    {
        // Incluir el puerto en el DSN
        $dsn = "mysql:host=" . Settings::DB_HOST . ";port=" . Settings::DB_PORT . ";dbname=" . Settings::DB_NAME . ";charset=" . Settings::DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            self::$instancia = new PDO($dsn, Settings::DB_USER, Settings::DB_PASSWORD, $options);
            return self::$instancia;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    public static function cerrar(): void
    {
        self::$instancia = null;
    }
}
