<?php
include('../datos/conex.php');
$producto = $_POST['producto'];
$select = mysqli_query($conex, "SELECT DOSIS FROM  ipsen_dosis WHERE NOMBRE_REFERENCIA='$producto' ORDER BY DOSIS ASC");
echo mysqli_error($conex);
echo "<option></option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['DOSIS'] . "\">" . utf8_encode($fila['DOSIS']) . "</option>";
}
