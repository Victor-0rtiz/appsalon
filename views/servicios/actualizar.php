<h1 class="nombre-pagina">Actualiza el servicio</h1>
<p class="descripcion-pagina">Llena los campos con la nueva información</p>
<?php
include_once __DIR__ . "/../templates/barra.php";
include_once __DIR__ . "/../templates/alertas.php";
?>
<form  method="POST" class="formulario">
    <?php
    include_once __DIR__ . "/formulario.php";
    ?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>