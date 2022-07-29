<?php
include('../logica/session.php');
require('../datos/conex.php');
if (isset($_POST['confirmar'])) {
    $codigo_gestion = $_POST['codigo_gestion'];
    $proveedor = $_POST['proveedor'];
    $sql = mysqli_query($conex, "UPDATE ipsen_gestiones SET PROVEEDOR='People Marketing' WHERE ID_PACIENTE_FK2='" . $ID_PACIENTE . "'");
    if ($sql) {
        echo ('Se realizo el cambio de proveedor');
    } else {
        echo ('No se actualizo el cambio');
    }
}
