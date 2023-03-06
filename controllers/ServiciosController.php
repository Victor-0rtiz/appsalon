<?php

namespace Controllers;

use Model\Servicios;
use MVC\Router;

class ServiciosController
{
    public static function index(Router $router)
    {
        session_start();
        isAdm();
        $servicios = Servicios::all();
        $router->render("servicios/index", ["nombre" => $_SESSION["nombre"], "servicios" => $servicios]);
    }
    public static function crear(Router $router)
    {
        session_start();
        isAdm();
        $servicio = new Servicios;
        $alertas = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if (empty($alertas)) {

                $servicio->guardar();

                header("location: /servicios");
            }
        }
        $alertas = Servicios::getAlertas();
        $router->render("servicios/crear", ["nombre" => $_SESSION["nombre"], "alertas" => $alertas, "servico" => $servicio]);
    }
    public static function actualizar(Router $router)
    {
        session_start();
        isAdm();
        if (!is_numeric($_GET["id"])) return;


        $servicio = Servicios::find($_GET["id"]);
        $alertas = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if (empty($alertas)) {

                $servicio->guardar();
                header("location: /servicios");
            }
        }
        $alertas = Servicios::getAlertas();
        $router->render("servicios/actualizar", ["nombre" => $_SESSION["nombre"], "alertas" => $alertas, "servicio" => $servicio]);
    }
    public static function eliminar()
    {
        session_start();
        isAdm();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servicio = Servicios::find($_POST["id"]);
            $servicio->eliminar();
            header("location: /servicios");
        }
    }
}
