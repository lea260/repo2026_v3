<?php
require_once __DIR__ . '/vendor/autoload.php';

// 1. Obtenemos únicamente el PATH de la URI enviada por Apache
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 2. Quitamos barras sobrantes al inicio/final y fragmentamos por '/'
$path = trim($requestUri, '/');
$parts = !empty($path) ? explode('/', $path) : [];

// 3. Extraemos Controlador y Método
$controllerName = !empty($parts[0]) ? ucfirst($parts[0]) : 'Home';
$methodName     = !empty($parts[1]) ? $parts[1] : 'index';

// 4. Parámetros restantes
$params = array_slice($parts, 2);

// 5. Instanciación y llamada
$fullClass = "App\\Controller\\" . $controllerName . "Controller";

try {
    if (class_exists($fullClass)) {
        $controller = new $fullClass();

        if (method_exists($controller, $methodName)) {
            call_user_func_array([$controller, $methodName], $params);
        } else {
            throw new Exception("El método '$methodName' no fue encontrado en '$fullClass'.");
        }
    } else {
        throw new Exception("El controlador '$fullClass' no existe.");
    }
} catch (Exception $e) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Página no encontrada</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
}
