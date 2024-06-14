<?php
include('../datos/conex.php');
echo $ID_ENVIO = $_POST['ID_ENVIO'];
echo $ESTADO = $_POST['ESTADO'];
echo $FECHA_ENTREGA = $_POST['FECHA_ENTREGA'];
$update = mysqli_query($conex, "UPDATE ipsen_envio_muestra
SET ESTADO = '" . $ESTADO . "',
FECHA_ENTREGA = '" . $FECHA_ENTREGA . "'
WHERE ID_ENVIO='$ID_ENVIO'");
echo mysqli_error($conex);
