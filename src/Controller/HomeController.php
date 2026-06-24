<?php
// El namespace debe empezar con el prefijo definido (App) 
// seguido del nombre de la carpeta (Controller)
namespace App\Controller;

use App\Config\Settings;
use App\Core\View;

class HomeController
{
    public function index()
    {
        // echo "¡Hola! Estás en la Home.";
        // echo "Estás en el home de " . Settings::DB_HOST;
        // echo " Versión: " . Settings::getUrlBase();
        $nombre = "juan";
        View::render('home/index', ['nombre' => $nombre]);

        //cargo la vista
        // http: //localhost:8080/index.php/productos/ver/5/verde
    }
}
