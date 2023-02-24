<?php 

namespace Model;

use Model\ActiveRecord;

class Usuario extends ActiveRecord
{
    protected static $tabla = "usuarios";
    protected static $columnasDB =["id", "nombre", "apellido", "email" ,"password", "telefono", "admin", "confirmado", "token"];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;



    public function __construct($arg=[])
    {
        $this->id= $arg["id"] ?? null;
        $this->nombre= $arg["nombre"] ?? "";
        $this->apellido= $arg["apellido"] ?? "";
        $this->email= $arg["email"] ?? "";
        $this->password= $arg["password"] ?? "";
        $this->telefono= $arg["telefono"] ?? "";
        $this->admin= $arg["admin"] ?? "0"; 
        $this->confirmado= $arg["confirmado"] ?? "0";
        $this->token= $arg["token"] ?? "";
    }
    public function validarCuentaNueva(){
        if (!$this->nombre) {
           self::$alertas["error"][]= "El nombre es obligatorio";
        }
        if (!$this->apellido) {
           self::$alertas["error"][]= "El apellido es obligatorio";
        }
        if (!$this->email) {
           self::$alertas["error"][]= "El E-mail es obligatorio";
        }
        if (!$this->password) {
           self::$alertas["error"][]= "El password es obligatorio";
        }
        if (strlen($this->password) < 6) {
           self::$alertas["error"][]= "El password debe tener almenos 6 caracteres";
        }
        return self::$alertas;
    }
    public function validarUsuario(){
        if (!$this->email) {
            self::$alertas["error"][]= "El E-mail es obligatorio";
         }
         if (!$this->password) {
            self::$alertas["error"][]= "El password es obligatorio";
         }
         return self::$alertas; 
    }
    public function validarEmail(){
        if (!$this->email) {
            self::$alertas["error"][]= "El E-mail es obligatorio";
         }
    }
    public function validarPassword(){
        if (!$this->password) {
            self::$alertas["error"][]= "El password es obligatorio";
         }
         if (strlen($this->password) < 6) {
            self::$alertas["error"][]= "El password debe tener almenos 6 caracteres";
         }
         return self::$alertas;
    }

    // funcion para verificar si existe un usuario con ese email
    public function existeUsuario(){
        $query= "SELECT * FROM ". self::$tabla ." WHERE email='". $this->email. "' LIMIT 1 ;";
        
        $resultado= self::$db->query($query);
       
        if ($resultado->num_rows) {
            self::$alertas["error"][]=" El usuario ya esta registrado";
        }
        return $resultado;
    }

    // funcion para hashear passwords
    public function hashearPassword(){
        $this->password= password_hash($this->password, PASSWORD_BCRYPT);
    }

    //crear tokens unicos 
    public function crearToken(){
        $this->token= uniqid();
    }
    //verificar contraseña 
    public function verificarPassword($pswd){
        $resultado= password_verify($pswd, $this->password);
        if(!$resultado || !$this->confirmado){
            self::$alertas["error"][]="Password incorrecto o tu cuenta no esta confirmada";
        } else{
            return true;
        }

    }



}

?>