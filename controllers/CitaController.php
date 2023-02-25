<?php 
namespace Controllers;
use MVC\Router;


class CitaController 
{
    public static function index(Router $router)
    {

        session_start();
        $nombre = $_SESSION["nombre"];
        $apellido = $_SESSION["apellido"];
               
        $router->render("cita/index",["nombre"=>$nombre, "apellido"=> $apellido]);    
    }
}


?>