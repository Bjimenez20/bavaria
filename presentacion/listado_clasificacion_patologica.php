<?php
include('../datos/conex.php');
$REFERENCIA = $_POST['REFERENCIA'];
$select = mysqli_query($conex,"SELECT NOMBRE_CLASIFICACION FROM bayer_clasificacion_patologica WHERE NOMBRE_REFERENCIA='" . $REFERENCIA . "' ORDER BY NOMBRE_CLASIFICACION ASC");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($select);
echo "<option value=\"\"></option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['NOMBRE_CLASIFICACION'] . "\">" . utf8_encode($fila['NOMBRE_CLASIFICACION']) . "</option>";
}
