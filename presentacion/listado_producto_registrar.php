<?php
include('../datos/conex.php');
$REFERENCIA = $_POST['REFERENCIA'];
$select = mysqli_query($conex, "SELECT MATERIAL,ID_REFERENCIA FROM bayer_referencia WHERE NOMBRE_REFERENCIA='" . $REFERENCIA . "' AND CANTIDAD>0");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($select);
echo "<option value=\"\"></option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['ID_REFERENCIA'] . "\">" . utf8_encode($fila['MATERIAL']) . "</option>";
}
