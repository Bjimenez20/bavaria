<?php
if (isset($_POST['actualizar'])) {
    require('../datos/conex.php');
    require('../datos/parse_str.php');
    $ID = $ertid;
  
    if ($_POST['operador_habilitar'] == '') {
        $operador = 'NO DEFINIDO VOLVER A PREGUNTAR';
        $update = mysqli_query($conex, "UPDATE bayer_operador_logistico SET OPERADOR_LOGISTICO='" . $operador . "' WHERE ID_OPERADOR_LOGISTICO = '" . $ID . "'");
    } else {
        $operador = $_POST['operador_habilitar'];
        $update = mysqli_query($conex, "UPDATE bayer_operador_logistico SET OPERADOR_LOGISTICO='" . $operador . "', ESTADO = 'IN' WHERE ID_OPERADOR_LOGISTICO = '" . $ID . "'");
    }
    if ($update) {
?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="aviso3" style=" width:68.9%; margin:auto auto;">Se actualizo el operador <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_operador.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
        </center>
        <br />
    <?php
    } else {
    ?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/advertencia.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="error" style=" width:68.9%; margin:auto auto;">No se actualizo el operador <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_operador.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
        </center>
        <br />
    <?php
    }
}

if (isset($_POST['eliminar'])) {
    require('../datos/conex.php');
    require('../datos/parse_str.php');
    $ID = $ertid;

    $delete = mysqli_query($conex, "DELETE FROM bayer_operador_logistico WHERE ID_OPERADOR_LOGISTICO = '" . $ID . "'");
    if ($delete) {
    ?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="aviso3" style=" width:68.9%; margin:auto auto;">Se elimino el operador <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_operador.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
        </center>
        <br />
    <?php
    } else {
    ?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/advertencia.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="error" style=" width:68.9%; margin:auto auto;">No se elimino el operador <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_operador.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
        </center>
        <br />
<?php
    }
}
?>
<style>
    .aviso3 {
        font-size: 130%;
        font-weight: bold;
        color: #11a9e3;
        text-transform: uppercase;
        background-color: transparent;
        text-align: center;
        padding: 10px;
    }

    .error {
        font-size: 130%;
        font-weight: bold;
        color: #fb8305;
        text-transform: uppercase;
        background-color: transparent;
        text-align: center;
        padding: 10px;
    }
</style>