<?php
require('../datos/parse_str.php');
require_once("../datos/conex.php");
$ID_PACIENTE;
$consulta = mysqli_query($conex, "SELECT R.ID_REFERENCIA,T.NOMBRE_REFERENCIA  FROM bayer_pacientes AS P
INNER JOIN bayer_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
INNER JOIN bayer_referencia AS R ON R.NOMBRE_REFERENCIA=T.NOMBRE_REFERENCIA
WHERE P.ID_PACIENTE='" . $ID_PACIENTE . "'");
echo mysqli_error($conex);
while ($dato = mysqli_fetch_array($consulta)) {
	$MEDICAMENTO = $dato['NOMBRE_REFERENCIA'];
	$ID_PRODUCTO = $dato['ID_REFERENCIA'];
}
$listado_envio = mysqli_query($conex, "SELECT MATERIAL,ID_REFERENCIA FROM bayer_referencia WHERE NOMBRE_REFERENCIA='" . $MEDICAMENTO . "' AND CANTIDAD!=0");
