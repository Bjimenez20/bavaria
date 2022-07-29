<?php
require('../datos/parse_str.php');
$tabla = $_POST['tabla'];
require('../datos/conex.php');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$tabla.xls");
//en la sigte linea colocar entre comillas el nombre del servidor mysql (generalmente, localhost) 
$servidor = $servidor;
//en la sigte linea colocar entre comillas el nombre de usuario 
$user = $usuario;
//en la sigte linea colocar entre comillas la contraseña 
$pass = $password;
//en la sigte linea colocar entre comillas e nombre de la base de datos 
$db = $basepaciente;
//en la sigte linea colocar entre comillas e nombre de la tabla
mysqli_connect($servidor, $user, $pass);
mysqli_select_db($conex, $db);
if (isset($_POST['enviar'])) {
	$qry = mysqli_query($conex, "select * from $tabla");
}
if (isset($_POST['enviar2'])) {
	$fecha = $_POST['fecha'];
	$fecha_fin = $_POST['fecha_fin'];
	$qry = mysqli_query($conex, "select * from $tabla WHERE `FECHA_COMUNICACION`>='$fecha 00:00:00' AND `FECHA_COMUNICACION`<='$fecha_fin 23:59:59'");
}
if (isset($_POST['enviar3'])) {
	$terapia = $_POST['terapias'];
	$qry = mysqli_query($conex, "SELECT T.PRODUCTO_TRATAMIENTO,CONCAT('PAP',P.ID_PACIENTE) AS 'ID_PACIENTE',CONCAT(P.NOMBRE_PACIENTE,' ',P.APELLIDO_PACIENTE) AS 'NOMBRES',P.CIUDAD_PACIENTE,
T.MEDICO_TRATAMIENTO,T.ASEGURADOR_TRATAMIENTO,T.OPERADOR_LOGISTICO_TRATAMIENTO
FROM bayer_pacientes AS P
INNER JOIN bayer_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
WHERE T.PRODUCTO_TRATAMIENTO LIKE '%" . $terapia . "%'");
}
$campos = mysqli_num_fields($qry);
echo "<table style='border:1px solid #000'><tr>";
while ($property = mysqli_fetch_field($qry)) {
	echo "<td style='border:1px medium #000'>" . $property->name;
	echo "</td>";
}
echo "</tr>";
while ($row = mysqli_fetch_array($qry)) {
	echo "<tr >";
	for ($j = 0; $j < $campos; $j++) {
		echo "<td style='border:1px medium #000'>" . $row[$j] . "</td>";
	}
	echo "</tr>";
}
echo "</table>";
