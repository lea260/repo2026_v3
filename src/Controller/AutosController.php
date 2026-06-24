<?php

namespace App\Controller;

use App\Dominio\Auto;
use App\Aplicacion\ListarAutos;
use App\Aplicacion\CrearAuto;
use App\Aplicacion\ObtenerAuto;
use App\Aplicacion\ActualizarAuto;
use App\Core\View;
use Exception;

class AutosController
{
    /**
     * GET /autos
     */
    public function listar()
    {
        try {
            $casoUso = new ListarAutos();
            $autos = $casoUso->ejecutar();
            View::render('autos/listar', ['autos' => $autos]);
        } catch (Exception $e) {
            $this->mostrarError("Error al listar", $e->getMessage());
        }
    }

    /**
     * GET /autos/nuevo
     */
    public function nuevo()
    {
        View::render('autos/formulario', ['titulo' => 'Nuevo Auto']);
    }

    /**
     * POST /autos/crear
     */
    public function crear()
    {
        try {
            // Creamos el objeto aquí para validar los datos de entrada
            $auto = Auto::crear(
                $_POST['patente'],
                $_POST['marca'],
                $_POST['modelo']
            );

            $casoUso = new CrearAuto();
            if ($casoUso->ejecutar($auto)) {
                header('Location: /autos');
            }
        } catch (Exception $e) {
            $this->mostrarError("Error al crear", $e->getMessage());
        }
    }

    /**
     * GET /autos/editar/{id}
     */
    public function editar($id)
    {
        try {
            $casoUso = new ObtenerAuto();
            $auto = $casoUso->ejecutar((int)$id);

            if (!$auto) {
                throw new Exception("Auto no encontrado.");
            }

            View::render('autos/formulario', [
                'titulo' => 'Editar Auto',
                'auto' => $auto
            ]);
        } catch (Exception $e) {
            $this->mostrarError("Error al cargar", $e->getMessage());
        }
    }

    /**
     * POST /autos/actualizar
     */
    public function actualizar()
    {
        try {
            // En actualización a veces es mejor reconstruir o pasar el ID 
            // y los datos al caso de uso para que él busque y modifique.
            $casoUso = new ActualizarAuto();
            $id = (int)$_POST['id'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];



            if ($casoUso->ejecutar($id, $marca, $modelo)) {
                header('Location: /index.php/autos/listar');
                exit;
            }
        } catch (Exception $e) {
            $this->mostrarError("Error al actualizar", $e->getMessage());
        }
    }

    private function mostrarError($titulo, $mensaje)
    {
        View::render('mensaje/comun', [
            'titulo' => $titulo,
            'mensaje' => $mensaje,
        ]);
    }
}
