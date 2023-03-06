<h1 class="nombre-pagina">Panel de Administración</h1>
<?php
include_once __DIR__ . "/../templates/barra.php";

?>

<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha;?>">
        </div>
    </form>

</div>
<?php if ( count($citas)==0) {?>
    <h2>No hay citas en esta fecha</h2>
<?php }?>
<div class="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
        foreach ($citas as $key => $cita) {
            if ($idCita !== $cita->id) {
                $total = 0;
        ?>
                <li>
                    <p>Id: <span><?php echo $cita->id ?> </span></p>
                    <p>Hora: <span><?php echo $cita->hora ?> </span></p>
                    <p>Cliente: <span><?php echo $cita->cliente ?> </span></p>
                    <p>Email: <span><?php echo $cita->email ?> </span></p>
                    <p>Telefono: <span><?php echo $cita->telefono ?> </span></p>
                    <h3>Servicios</h3>
                <?php
               
               $idCita= $cita->id;
            }
            $total+= $cita->precio;
                ?>
                <p class="servicio"><?php echo $cita->servicio.": $". $cita->precio; ?></p>
                
            <?php
            $idActual = $cita->id;
            $idSiguiente = $citas[$key + 1]->id ?? 0;
            if(esUltimo($idActual, $idSiguiente)) {
                ?>
                <p>Total: <span>$<?php echo $total;?></span></p>
                <?php
            }

        }
            ?>
    </ul>

</div>
<?php
$script= "<script src='build/js/buscador.js'></script>";;
?>