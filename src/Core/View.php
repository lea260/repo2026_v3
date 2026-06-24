<?php

namespace App\Core;

class View
{
    public static function render($view, $params = [])
    {
        // 1. Convertimos las llaves del array en variables ($nombre, $id, etc.)
        extract($params);

        // 2. Definimos la ruta FÍSICA al archivo de la vista
        // Ajusta 'src/View/' según donde guardes tus .php de interfaz
        $filePath = __DIR__ . "/../Vista/" . $view . ".php";

        if (file_exists($filePath)) {
            require $filePath;
        } else {
            die("Error: La vista '{$view}' no existe en {$filePath}");
        }
    }
}
