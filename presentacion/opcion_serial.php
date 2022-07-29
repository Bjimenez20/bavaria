<?php
include('../datos/conex.php');
$REFERENCIA = $_POST['producto'];
$select = mysqli_query($conex, "SELECT OPCION_SERIAL FROM bayer_referencia
WHERE ID_REFERENCIA='" . $REFERENCIA . "'");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($select);
/*echo "<option value=\"\"></option>";*/
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['OPCION_SERIAL'] . "\">" . utf8_encode($fila['OPCION_SERIAL']) . "</option>";
}
