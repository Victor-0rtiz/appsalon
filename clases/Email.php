<?php

namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{


    public $nombre;
    public $email;
    public $token;


    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }
    public function enviarConfirmacion()
    {
        $mailer = new PHPMailer();
        $mailer->isSMTP();
        $mailer->Host = 'sandbox.smtp.mailtrap.io';
        $mailer->SMTPAuth = true;
        $mailer->Port = 2525;
        $mailer->Username = 'ba932c5898d303';
        $mailer->Password = 'f1e9b0885034e1';

        $mailer->setFrom('appsalon@correo.com');
        $mailer->addAddress('joe@example.net', 'Joe User');
        $mailer->isHTML(true); 
        $mailer->CharSet = 'UTF-8';                                 //Set email format to HTML
        $mailer->Subject = 'Hola!! Confirma tu cuenta';
        $body = "<html>";
        $body.= "<h1>Hola ". $this->nombre. "</h1>";
        $body.=" <p> Recientemente te registraste en AppSalon, para confirmar tu cuenta has click en el enlace</p> ";
        $body.= '<a href="http://localhost:3020/confirmar-cuenta?token='.$this->token.'"> Click Aquí </a>';
        $body.= "</html>";
        $mailer->Body   = $body;      
    
        $mailer->send();
    }
    public function enviarInstrucciones()
    {
        $mailer = new PHPMailer();
        $mailer->isSMTP();
        $mailer->Host = 'sandbox.smtp.mailtrap.io';
        $mailer->SMTPAuth = true;
        $mailer->Port = 2525;
        $mailer->Username = 'ba932c5898d303';
        $mailer->Password = 'f1e9b0885034e1';

        $mailer->setFrom('appsalon@correo.com');
        $mailer->addAddress('joe@example.net', 'Joe User');
        $mailer->isHTML(true); 
        $mailer->CharSet = 'UTF-8';                                 //Set email format to HTML
        $mailer->Subject = 'Hola!! Reestablece tu contraseña';
        $body = "<html>";
        $body.= "<h1>Hola ". $this->nombre. "</h1>";
        $body.=" <p> Has solicitado reestablecer tu cuenta en AppSalon, para hacerlo has click en el enlace</p> ";
        $body.= '<a href="http://localhost:3020/recuperar?token='.$this->token.'"> Click aquí para reestablecer tu password</a>';
        $body.= "</html>";
        $mailer->Body   = $body;      
    
        $mailer->send();
    }
}
