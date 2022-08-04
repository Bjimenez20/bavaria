<?php
if (isset($_POST['actualizar'])) {
    require('../datos/conex.php');
    require('../datos/parse_str.php');
    $ID = $erted;

    if ($_POST['medico_habilitar'] == '') {
        $medico = 'NO DEFINIDO VOLVER A PREGUNTAR';
        $update = mysqli_query($conex, "UPDATE ipsen_listas SET MEDICO='" . $medico . "' WHERE ID_LISTA = '" . $ID . "'");
    } else {
        $medico = $_POST['operador_habilitar'];
        $update = mysqli_query($conex, "UPDATE ipsen_listas SET MEDICO='" . $medico . "', ESTADO = 'IN' WHERE ID_LISTA = '" . $ID . "'");
    }
    if ($update) {
?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="aviso3" style=" width:68.9%; margin:auto auto;">Se actualizo el medico <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_medicos.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
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
        <p class="error" style=" width:68.9%; margin:auto auto;">No se actualizo el medico <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_medicos.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
        </center>
        <br />
    <?php
    }
}

if (isset($_POST['eliminar'])) {
    require('../datos/conex.php');
    require('../datos/parse_str.php');
    $ID = $erted;
    $delete = mysqli_query($conex, "DELETE FROM ipsen_listas WHERE ID_LISTA = '" . $ID . "'");
    if ($delete) {
    ?>
        <span style="margin-top:5%;">
            <center>
                <img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
            </center>
        </span>
        <p class="aviso3" style=" width:68.9%; margin:auto auto;">Se elimino el medico <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_medicos.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
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
        <p class="error" style=" width:68.9%; margin:auto auto;">No se elimino el medico <?php echo $ID ?></p>
        <br />
        <br />
        <center>
            <a href="form_listado_medicos.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
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