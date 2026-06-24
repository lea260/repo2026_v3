<?php
// 1. Carga el autoloader que mapeaste en la raíz del proyecto
// Gracias al doble montaje de Docker, 'vendor' está al mismo nivel que este archivo.
require_once __DIR__ . '/vendor/autoload.php';

// 2. Capturamos lo que viene después de 'index.php'
// $_SERVER['PATH_INFO'] es ideal cuando no hay reescritura de URL (.htaccess)
$path = $_SERVER['PATH_INFO'] ?? '/';
$parts = explode('/', trim($path, '/'));

// 3. Definimos valores por defecto (Home / index)
$controllerName = !empty($parts[0]) ? ucfirst($parts[0]) : 'Home';
$methodName     = !empty($parts[1]) ? $parts[1] : 'index';

// 4. Construimos el nombre completo de la clase (Namespace + Nombre)
// Asumiendo que tus controladores están en la carpeta 'src/controller'
$fullClass = "App\\Controller\\" . $controllerName . "Controller";

try {
    if (class_exists($fullClass)) {
        $controller = new $fullClass();

        if (method_exists($controller, $methodName)) {
            // Llamamos al método (ej: UsuarioController->perfil())
            $controller->$methodName();
        } else {
            throw new Exception("Método '$methodName' no encontrado en $fullClass");
        }
    } else {
        throw new Exception("El controlador '$fullClass' no existe");
    }
} catch (Exception $e) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Página no encontrada</h1>";
    // Solo para desarrollo, quitar en producción:
    echo "<p>" . $e->getMessage() . "</p>";
}