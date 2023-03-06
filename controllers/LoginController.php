<?php

namespace Controllers;

use Clases\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    //?Controlador de Login
    public static function login(Router $router)
    {
        $alertas = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $aut = new Usuario($_POST);
            $alertas = $aut->validarUsuario();
            if (empty($alertas)) {
                $usuario = Usuario::where("email", $aut->email);
                if ($usuario) {
                    if ($usuario->verificarPassword($aut->password)) {
                        session_start();
                        $_SESSION["id"] = $usuario->id;
                        $_SESSION["nombre"] = $usuario->nombre;
                        $_SESSION["apellido"] = $usuario->apellido;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["login"] = true;


                        if ($usuario->admin == 1) {
                            $_SESSION["admin"] = $usuario->admin ?? null;

                            header("location: /admin");
                        } else {
                            header("location: /cita");
                        }
                    }
                } else {
                    Usuario::setAlerta("error", "Usuario no encontrado");
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/login", ["alertas" => $alertas]);
    }

    //?Controlador de Logout
    public static function logout(Router $router)
    {

        session_start();
        $_SESSION = [];
        header("location: /");
    }

    //?Controlador de Olvide
    public static function olvide(Router $router)
    {
        $alertas = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $aut = new Usuario($_POST);
            $alertas = $aut->validarEmail();
            if (empty($alertas)) {
                $usuario = Usuario::where("email", $aut->email);
                if ($usuario && $usuario->confirmado == 1) {
                    $usuario->crearToken();
                    $usuario->guardar();
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarInstrucciones();
                    Usuario::setAlerta("exito", "Usuario encontrado, revisa tu correo");
                } else {
                    Usuario::setAlerta("error", "Usuario no encontrado o no esta confirmado");
                }
            }
            $alertas = Usuario::getAlertas();
        }
        $router->render("auth/olvide", ["alertas" => $alertas]);
    }

    //?Controlador de Recuperar
    public static function recuperar(Router $router)
    {
        $alertas = [];
        $err = false;
        $auth = new Usuario($_GET);
        $usuario = Usuario::where("token", $auth->token);

        if (empty($usuario)) {
            Usuario::setAlerta("error", "Token no valido");
            $err = true;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();
            if (empty($alertas)) {

                $usuario->password = null;

                $usuario->password = $password->password;

                $usuario->hashearPassword();

                $usuario->token = 0;
                $usuario->guardar();
                header("location: /");
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/recuperar-password", ["err" => $err, "alertas" => $alertas]);
    }

    //?Controlador de Crear
    public static function crearCuenta(Router $router)
    {
        $usuario = new Usuario;
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCuentaNueva();
            if (empty($alertas)) {
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {

                    $alertas = Usuario::getAlertas();
                } else {
                    $usuario->hashearPassword();
                    $usuario->crearToken();

                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    $email->enviarConfirmacion();
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header("location: /mensaje");
                    }
                }
            }
        }
        $router->render("auth/crear-cuenta", ["usuario" => $usuario, "alertas" => $alertas]);
    }

    //?Controlador de Mensaje
    public static function mensaje(Router $router)
    {

        $router->render("auth/mensaje", []);
    }

    //?Controlador de Confirmacion de cuenta
    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET["token"]);
        $usuario = Usuario::where("token", $token);
        if (empty($usuario)) {
            Usuario::setAlerta("error", "Usuario no valido");
        } else {
            $usuario->token = "";
            $usuario->confirmado = "1";
            $usuario->guardar();
            Usuario::setAlerta("exito", "Usuario Confirmado");
        }
        $alertas = Usuario::getAlertas();

        $router->render("auth/confirmar-cuenta", ["alertas" => $alertas]);
    }
}
