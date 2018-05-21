<?php
namespace App\Models;

use TinyMVC\core\Model;

class Productor extends Model
{
    private $nombre;
    private $apellido;
    private $dni;

    protected $rules;

    public function __construct($table, $db)
    {
        parent::__construct($table, $db);

        $this->table = 'rpa_productores';
        $this->nombre = '';
        $this->apellido = '';
        $this->dni = '';
        $this->key = 'id_productor';
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getDni()
    {
        return $this->dni;
    }
}