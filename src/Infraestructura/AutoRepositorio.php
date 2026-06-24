<?php

namespace App\Infraestructura;

use App\Dominio\Auto;
use App\Core\Conexion;
use PDO;
use PDOException;

class AutoRepositorio
{
    private ?PDO $pdo;

    public function __construct()
    {
        // Obtenemos la conexión una sola vez
        $this->pdo = Conexion::getPDOConnection();
    }

    /**
     * Obtiene todos los autos de la base de datos.
     * @return Auto[]
     */
    public function listar(): array
    {
        $sql = "SELECT id, patente, marca, modelo, estado, version FROM auto";

        try {
            $stmt = $this->pdo->query($sql);
            $autos = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Usamos un método de reconstrucción que no sea 
                // tan estricto como el 'crear' de los formularios.
                $autos[] = Auto::desdeArreglo($row);
            }

            return $autos;
        } catch (PDOException $e) {
            error_log("Error al listar autos: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Guarda un auto nuevo o actualiza uno existente (Persistencia).
     */
    public function guardar(Auto $auto): bool
    {
        try {
            if ($auto->getId() === null || $auto->getId() === 0) {
                return $this->insertar($auto);
            }
            return $this->actualizar($auto);
        } catch (PDOException $e) {
            error_log("Error al guardar auto: " . $e->getMessage());
            return false;
        }
    }

    private function insertar(Auto $auto): bool
    {
        $sql = "INSERT INTO auto (patente, marca, modelo, estado, version) 
                VALUES (:patente, :marca, :modelo, :estado, :version)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':patente' => $auto->getPatente(),
            ':marca'   => $auto->getMarca(),
            ':modelo'  => $auto->getModelo(),
            ':estado'  => $auto->getEstado(),
            ':version' => $auto->getVersion()
        ]);
    }

    public function actualizar(Auto $auto): bool
    {
        // Implementación de Optimistic Locking usando la columna 'version'
        $sql = "UPDATE auto SET 
                    patente = :patente, 
                    marca = :marca, 
                    modelo = :modelo, 
                    estado = :estado, 
                    version = version + 1
                WHERE id = :id AND version = :version_actual";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id'             => $auto->getId(),
            ':patente'        => $auto->getPatente(),
            ':marca'          => $auto->getMarca(),
            ':modelo'         => $auto->getModelo(),
            ':estado'         => $auto->getEstado(),
            ':version_actual' => $auto->getVersion()
        ]);
    }

    public function buscarPorId(int $id): ?Auto
    {
        $sql = "SELECT * FROM auto WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? Auto::desdeArreglo($row) : null;
    }
}
