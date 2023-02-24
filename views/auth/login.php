<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>
<?php
include_once __DIR__. "/../templates/alertas.php"; 
?>
<form action="/" method="POST" class="formulario">
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu Email" id="email" name="email">

    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Tu Password">
    </div>

    <input type="submit" value="Ingresar" class="boton">
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún sin cuenta? Ingresa aquí</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>