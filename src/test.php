<?php
require_once __DIR__ . '/vendor/autoload.php';

if (class_exists('App\Controller\HomeController')) {
    echo "¡ÉXITO! La clase existe y el autoloader la ve.";
} else {
    echo "ERROR: El autoloader sigue sin encontrar App\Controller\HomeController.";
    echo "Buscando en: " . __DIR__ . "/Controller/HomeController.php";
}
