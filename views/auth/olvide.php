<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu dirección E-mail acontinuación</p>

<?php 

include_once __DIR__."/../templates/alertas.php";
?>
<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Tu E-mail</label>
        <input type="email" name="email" id="email" placeholder="Tu E-mail aquí">


    </div>
    <input type="submit" value="Enviar instrucciónes" class="boton">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Ingresa sesion aquí</a>
    <a href="/crear-cuenta">¿No tienes una cuenta? Registrate aquí</a>
</div>