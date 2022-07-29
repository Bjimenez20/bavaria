<?php
include('../datos/conex.php');
$DEPT = $_POST['DEPT'];
$select = mysqli_query($conex, "SELECT ASEGURADOR FROM `bayer_asegurador_operador_logistico` WHERE DEPARTAMENTO='" . $DEPT . "' GROUP BY ASEGURADOR ORDER BY ASEGURADOR  ASC");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($select);
echo "<option value=\"\"></option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['ASEGURADOR'] . "\">" . utf8_encode($fila['ASEGURADOR']) . "</option>";
}
