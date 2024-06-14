<?php
if (isset($_POST['actualizar'])) {
    require('../datos/conex.php');
    require('../datos/parse_str.php');
    $ID = $erted;

    if ($_POST['ips_habilitar'] == '') {
        $ips = 'NO DEFINIDO VOLVER A PREGUNTAR';
        $update = mysqli_query($conex, "UPDATE ipsen_ips SET IPS='" . $ips . "' WHERE ID_IPS = '" . $ID . "'");
    } else {
        $ips = $_POST['ips_habilitar'];
        $update = mysqli_query($conex, "UPDATE ipsen_ips SET IPS='" . $ips . "', ESTADO = 'IN' WHERE ID_IPS = '" . $ID . "'");
    }
    if ($update) {
?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="aviso3" style=" width:68.9%; margin:auto auto;">Se actualizo la ips <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_ips.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
        </center>
        <br />
    <?php
    } else {
    ?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/advertencia2.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="error" style=" width:68.9%; margin:auto auto;">No se actualizo la ips <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_ips.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
        </center>
        <br />
    <?php
    }
}

if (isset($_POST['eliminar'])) {
    require('../datos/conex.php');
    require('../datos/parse_str.php');
    $ID = $erted;
    $delete = mysqli_query($conex, "DELETE FROM ipsen_ips WHERE ID_IPS = '" . $ID . "'");
    if ($delete) {
    ?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="aviso3" style=" width:68.9%; margin:auto auto;">Se elimino la ips <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_ips.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
        </center>
        <br />
    <?php
    } else {
    ?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/advertencia2.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="error" style=" width:68.9%; margin:auto auto;">No se elimino la ips <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_ips.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
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
        color: red;
        text-transform: uppercase;
        background-color: transparent;
        text-align: center;
        padding: 10px;
    }
</style>