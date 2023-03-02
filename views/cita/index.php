<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige los servicios que deseas acontinuación</p>
<?php 
include_once __DIR__. "/../templates/barra.php"; 

?>
<div class="app">
    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>
    <div class="seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios acontinuación</p>
        <div id="servicios" class="listado-servicios"></div>

    </div>
    <div class="seccion" id="paso-2">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca tus datos y la fecha de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" value="<?php echo $nombre ." ".$apellido ; ?>" disabled> 
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora">
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>" >
        </form>

    </div>
    <div class="seccion contenido-resumen" id="paso-3">
        <h2>Resumen</h2>
        <p>Verifica que la informacion sea correcta</p>
        

    </div>
    <div class="paginacion">
        <button id="anterior" class="boton">&laquo;Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>
<?php 
$script= " 
<link href='https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css' rel='stylesheet'>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js'></script>
<script src='build/js/app.js'></script>";

?>