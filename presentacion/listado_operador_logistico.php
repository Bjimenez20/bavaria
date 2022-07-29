<?php
include('../datos/conex.php');
$DEPT = $_POST['DEPT'];
$asegurador = $_POST['asegurador'];
$select = mysqli_query($conex, "SELECT OPERADOR FROM `bayer_asegurador_operador_logistico` WHERE DEPARTAMENTO='" . $DEPT . "' AND ASEGURADOR='" . $asegurador . "' GROUP BY OPERADOR ORDER BY OPERADOR ASC");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($select);
echo "<option value=\"\"></option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['OPERADOR'] . "\">" . utf8_encode($fila['OPERADOR']) . "</option>";
}
