<?php
include('../datos/conex.php');
$DEPT = $_POST['DEPT'];
$asegurador = $_POST['asegurador'];
$select = mysqli_query($conex, "SELECT DISTINCT OPERADOR_LOGISTICO FROM ipsen_operador_logistico WHERE ESTADO = 'IN' ORDER BY ID_OPERADOR_LOGISTICO DESC");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($select);
echo "<option value=\"\"></option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['OPERADOR_LOGISTICO'] . "\">" . utf8_encode($fila['OPERADOR_LOGISTICO']) . "</option>";
}
