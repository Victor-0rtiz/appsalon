<?php

namespace Model;
class CitaServicios extends ActiveRecord
{
    Protected static $tabla = "citaservicios";
    protected static $columnasDB = ["id", "citaId", "servicioId"];


    public $id;
    public $citaId;
    public $servicioId;

    public function __construct($arg = [])
    {
        $this->id = $arg["id"] ?? null;
        $this->citaId = $arg["citaId"] ?? "";
        $this->servicioId = $arg["servicioId"] ?? "";
    }
    
}

