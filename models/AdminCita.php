<?php 

namespace Model;
class AdminCita extends ActiveRecord
{
    protected static $tabla= "citaservicio";
    protected static $ColumnasDB= ["id", "hora", "cliente", "email", "telefono", "servicio", "precio"];


    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($arg=[])
    {
        $this->id= $arg["id"];
        $this->hora= $arg["hora"];
        $this->cliente= $arg["cliente"];
        $this->email= $arg["email"];
        $this->telefono= $arg["telefono"];
        $this->servicio= $arg["servicio"];
        $this->precio= $arg["precio"];
    }
    
}

?>