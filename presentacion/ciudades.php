<?php
include('../datos/conex.php');
header('Content-Type: text/html; charset=UTF-8');
$dep = $_POST['dep'];
$select = mysqli_query($conex, "SELECT c.nombre FROM ciudad AS c
INNER JOIN departamento AS d ON d.id=c.departamento_id
WHERE d.nombre='$dep' ORDER BY c.nombre ASC");
echo mysqli_error($conex);
echo "<option></option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['nombre'] . "\">" . utf8_encode($fila['nombre']) . "</option>";
}
