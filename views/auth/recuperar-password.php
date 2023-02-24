<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo Password en el siguiente formulario</p>
<?php 

include_once __DIR__."/../templates/alertas.php";
if ($err) return;# code...

?>
<form method="POST" class="formulario">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu nuevo Password">
    </div>
    <input type="submit" class="boton" value="Guardar Password">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Inicia sesión</a>
</div>