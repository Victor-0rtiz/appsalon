<?php

namespace Controllers;

use Model\Citas;
use Model\CitaServicios;
use Model\Servicios;

class APIController
{
    public static function index()
    {
        $servicios = Servicios::all();
        echo json_encode($servicios);
    }
    public static function guardar()
    {

        $cita = new Citas($_POST);
        $respuesta = $cita->guardar();
        $id = $respuesta["id"];

        $idServicios = explode(",", $_POST["servicios"]);
        foreach ($idServicios as $idServicio) {
            $arg = ["citaId" => $id, "servicioId" => $idServicio];
            $servicio = new CitaServicios($arg);
            $servicio->guardar();
        }



        echo json_encode(["resultado" => $respuesta]);
    }
    public static function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $cita = Citas::find($id);
            $cita->eliminar();
            header("location:" . $_SERVER["HTTP_REFERER"]);
        }
    }
}
