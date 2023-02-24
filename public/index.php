<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\CitaController;
use Controllers\LoginController;
use MVC\Router;

$router = new Router();
//Inicio-sesion-index
$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);

//Olvidar-password
$router->get("/olvide", [LoginController::class, "olvide"]);
$router->post("/olvide", [LoginController::class, "olvide"]);

//crear-cuenta
$router->get("/crear-cuenta", [LoginController::class, "crearCuenta"]);
$router->post("/crear-cuenta", [LoginController::class, "crearCuenta"]);


//recuperacion-cuenta
$router->get("/recuperar", [LoginController::class, "recuperar"]);
$router->post("/recuperar", [LoginController::class, "recuperar"]);

//confirmar-cuenta
$router->get("/confirmar-cuenta", [LoginController::class, "confirmar"]);
$router->get("/mensaje", [LoginController::class, "mensaje"]);


//?Seccion Privada

$router->get("/cita", [CitaController::class, "index"]);
$router->post("/cita", [CitaController::class, "index"]);

//! API

$router->get("/api/servicios", [APIController::class, "index"]);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
