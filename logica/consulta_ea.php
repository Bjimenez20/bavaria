<?php
require('../datos/parse_str.php');
require_once("../datos/conex.php");
$ID_PACIENTE;
$hoy = date('Y-m-d');
$consulta = mysqli_query($conex, "SELECT * FROM usuario WHERE USER = '" . $usua . "'");
echo mysqli_error($conex);
while ($dato = mysqli_fetch_array($consulta)) {
	$PRIVILEGIOS = $dato['PRIVILEGIOS'];
}
$consulta = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
WHERE P.ID_PACIENTE='" . $ID_PACIENTE . "'");
echo mysqli_error($conex);
while ($dato = mysqli_fetch_array($consulta)) {
	$ID_PACIENTE = $dato['ID_PACIENTE'];
	$IDENTIFICACION_PACIENTE = $dato['IDENTIFICACION_PACIENTE'];
	$CIUDAD_PACIENTE = $dato['CIUDAD_PACIENTE'];
	$GENERO_PACIENTE = $dato['GENERO_PACIENTE'];
	$FECHA_NACIMINETO_PACIENTE = $dato['FECHA_NACIMINETO_PACIENTE'];
	$TELEFONO_PACIENTE = $dato['TELEFONO_PACIENTE'];
	$NOMBRE_PACIENTE = $dato['NOMBRE_PACIENTE'];
	$APELLIDO_PACIENTE = $dato['APELLIDO_PACIENTE'];
	$DIRECCION_PACIENTE = $dato['DIRECCION_PACIENTE'];
	$CORREO_PACIENTE = $dato['CORREO_PACIENTE'];
	$MEDICO_TRATAMIENTO = $dato['MEDICO_TRATAMIENTO'];
	$PRODUCTO_TRATAMIENTO = $dato['PRODUCTO_TRATAMIENTO'];
}
$nombre = $NOMBRE_PACIENTE . ' ' . $APELLIDO_PACIENTE;
function iniciales($nombre)
{
	$notocar = array('del', 'de');
	$trozos = explode(' ', $nombre);
	$iniciales = '';
	for ($i = 0; $i < count($trozos); $i++) {
		if (in_array($trozos[$i], $notocar)) $iniciales .= $trozos[$i] . " ";
		else $iniciales .= substr($trozos[$i], 0, 1) . ". ";
	}
	return $iniciales;
}
