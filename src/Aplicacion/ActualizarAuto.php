<?php

namespace App\Aplicacion;

use App\Infraestructura\AutoRepositorio;

class ActualizarAuto
{
    private AutoRepositorio $repositorio;

    public function __construct()
    {
        $this->repositorio = new AutoRepositorio();
    }

    /**
     * Recibe los datos del formulario de edición.
     */
    public function ejecutar(int $id, string $marca, string $modelo): bool
    {
        try {
            // 1. Buscamos el auto existente en la base de datos
            $auto = $this->repositorio->buscarPorId($id);
            $auto->setMarca($marca);
            $auto->setModelo($modelo);
            if (!$auto) {
                throw new \Exception("No se encontró el auto para actualizar.");
            }

            // 2. Modificamos los datos de la entidad 
            // (Aquí podrías tener métodos en la entidad Auto como cambiarMarca, etc.)
            // Por ahora, usamos un método imaginario que actualice los campos:


            // 3. Persistimos los cambios a través del repositorio
            return $this->repositorio->actualizar($auto);
        } catch (\Exception $e) {
            error_log("Error al actualizar el auto: " . $e->getMessage());
            throw $e;
        }
    }
}
