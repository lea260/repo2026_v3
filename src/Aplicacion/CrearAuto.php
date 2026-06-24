<?php

namespace App\Aplicacion;

use App\Dominio\Auto;
use App\Infraestructura\AutoRepositorio;

class CrearAuto
{
    private AutoRepositorio $repositorio;

    public function __construct()
    {
        $this->repositorio = new AutoRepositorio();
    }

    /**
     * Recibe la entidad Auto ya validada desde el controlador.
     */
    public function ejecutar(Auto $auto): bool
    {
        try {
            return $this->repositorio->guardar($auto);
        } catch (\Exception $e) {
            error_log("Error al persistir el auto: " . $e->getMessage());
            throw $e;
        }
    }
}
