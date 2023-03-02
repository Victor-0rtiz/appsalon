<?php 
namespace Controllers;
use MVC\Router;


class CitaController 
{
    public static function index(Router $router)
    {

        session_start();
         isAuth();
        $nombre = $_SESSION["nombre"];
        $apellido = $_SESSION["apellido"];
        $id = $_SESSION["id"];
               
        $router->render("cita/index",["nombre"=>$nombre, "apellido"=> $apellido, "id"=>$id]);    
    }    
}
