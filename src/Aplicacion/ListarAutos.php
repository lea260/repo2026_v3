<?php

namespace App\Aplicacion;

use App\Infraestructura\AutoRepositorio;


class ListarAutos
{
    private AutoRepositorio $repository;

    public function __construct()
    {
        // Instanciamos directamente aquí para simplificar la llamada
        $this->repository = new AutoRepositorio();
    }

    public function ejecutar(): array
    {
        // Pedimos los datos al repositorio y los devolvemos
        $autos = $this->repository->listar();
        return $autos;
    }
}
