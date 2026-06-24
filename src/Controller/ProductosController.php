<?php

namespace App\Controller;

class ProductosController
{
    // $id recibirá "15", $color recibirá "azul"
    public function ver($id = null, $color = null)
    {
        echo "Viendo el producto ID: " . $id;
        echo " Color: " . $color;
    }
}
