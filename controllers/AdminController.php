<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $fechaVerificada = explode("-", $fecha);
        if (!checkdate($fechaVerificada[1], $fechaVerificada[2], $fechaVerificada[0])) {
            header("location: /404");
        }
        session_start();

        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citaservicios ";
        $consulta .= " ON citaservicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citaservicios.servicioId ";
       $consulta .= " WHERE fecha =  '{$fecha}' ";
        $citas = AdminCita::SQL($consulta);
        
        
        $router->render("admin/index", ["nombre" => $_SESSION["nombre"], "apellido" => $_SESSION["apellido"], "citas"=>$citas, "fecha"=>$fecha]);
    }
}
