<?php

namespace App\Dominio;

use App\Core\Conexion;
use PDOException;

class Auto implements \JsonSerializable
{
    //constructor property promotion
    public function __construct(
        private string $patente,
        private string $marca,
        private string $modelo,
        private string $estado = 'disponible',
        private int $version = 0,
        private ?int $id = 0
    ) {}

    /**
     * Factory Method para crear una instancia nueva de Auto.
     * Útil para cuando recibes datos de un formulario o request.
     */
    public static function crear(
        string $patente,
        string $marca,
        string $modelo,
    ): self {
        $instancia = new self(
            patente: $patente,
            marca: $marca,
            modelo: $modelo,
            estado: "disponible",
            version: 0,    // Un auto nuevo empieza en versión 0
            id: null       // El ID suele ser nulo hasta que se persiste en la DB
        );
        $instancia->validar();
        return $instancia;
    }




    public function reservar(): void
    {
        if ($this->estado !== 'disponible') {
            throw new \Exception("El auto no está disponible.");
        }
        $this->estado = 'reservado';
        $this->version++;
    }

    public function validar(): void
    {
        // Validar patente: 3 letras + 3 dígitos
        if (!preg_match('/^[A-Z]{3}[0-9]{4}$/', $this->patente)) {
            throw new \Exception("Formato de patente inválido. Debe tener 3 letras seguidas de 3 números. Ej: ABC123");
        }

        // Validar estado
        $estadosValidos = ['disponible', 'reservado', 'vendido'];
        if (!in_array($this->estado, $estadosValidos, true)) {
            throw new \Exception("Estado inválido. Debe ser: disponible, reservado o vendido.");
        }
    }

    public function vender(): void
    {
        if ($this->estado === 'reservado') {
            throw new \Exception("El auto está reservado.");
        }
        $this->estado = 'vendido';
        $this->version++;
    }

    public static function desdeArreglo(array $row): Auto
    {
        return new Auto(
            patente: $row['patente'],
            marca: $row['marca'],
            modelo: $row['modelo'],
            estado: $row['estado'],
            version: $row['version'] ?? 0,
            id: $row['id']
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'patente' => $this->patente,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'estado' => $this->estado,
            'version' => $this->version,
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getPatente(): string
    {
        return $this->patente;
    }
    public function getModelo(): string
    {
        return $this->modelo;
    }
    public function getMarca(): string
    {
        return $this->marca;
    }
    public function getEstado(): string
    {
        return $this->estado;
    }
    public function getVersion(): int
    {
        return $this->version;
    }

    public function setModelo(string $modelo)
    {
        $this->modelo = $modelo;
    }
    public function setMarca(string $marca)
    {
        $this->marca = $marca; 
    }
}
