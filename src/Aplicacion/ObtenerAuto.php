<?php

namespace App\Aplicacion;

use App\Dominio\Auto;
use App\Infraestructura\AutoRepositorio;

class ObtenerAuto
{
    private AutoRepositorio $repositorio;

    public function __construct()
    {
        $this->repositorio = new AutoRepositorio();
    }

    public function ejecutar(int $id): ?Auto
    {
        try {
            return $this->repositorio->buscarPorId($id);
        } catch (\Exception $e) {
            error_log("Error al obtener el auto: " . $e->getMessage());
            return null;
        }
    }
}
