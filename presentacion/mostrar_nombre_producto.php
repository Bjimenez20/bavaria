<?php
include('../datos/conex.php');
$ID_PRODUCTO = $_POST['ID_PRODUCTO'];
$select = mysqli_query($conex, "SELECT MATERIAL,ID_REFERENCIA FROM ipsen_referencia WHERE ID_REFERENCIA='" . $ID_PRODUCTO . "'");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($select);
if ($nreg > 0) {
	while ($fila = (mysqli_fetch_array($select))) {
		echo "<option value=\"" . $fila['MATERIAL'] . "\">" . utf8_encode($fila['MATERIAL']) . "</option>";
	}
} else {
	echo "<option value=\"\">" . "</option>";
}
