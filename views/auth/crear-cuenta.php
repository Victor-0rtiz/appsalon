<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear tu cuenta </p>
<?php
include_once __DIR__. "/../templates/alertas.php"; 
?>
<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Tu Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo s($usuario->nombre); ?>" placeholder=" Tu Nombre">
    </div>
    <div class="campo">
        <label for="apellido">Tu Apellido</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo s( $usuario->apellido); ?>" placeholder=" Tu Apellido">
    </div>
    <div class="campo">
        <label for="telefono">Tu Telefono</label>
        <input type="fel" id="telefono" name="telefono" value="<?php echo s( $usuario->telefono); ?>" placeholder=" Tu Telefono">
    </div>
    <div class="campo">
        <label for="email">Tu E-mail</label>
        <input type="email" id="email" name="email" value="<?php echo s( $usuario->email); ?>" placeholder=" Tu E-mail">
    </div>
    <div class="campo">
        <label for="password">Tu Password</label>
        <input type="password" id="password" name="password"  placeholder=" Tu Password">
    </div>
    <input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Ingresa sesion aquí</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>