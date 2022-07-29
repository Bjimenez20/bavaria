<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$consulta_fechas = mysqli_query($conex, "SELECT * FROM ipsen_historial_reclamacion WHERE FECHA_RECLAMACION3 LIKE '%2016-02-%'");
echo mysqli_error($conex);
echo $num_reg = mysqli_num_rows($consulta_fechas);
$a = 0;
while ($dato = mysqli_fetch_array($consulta_fechas)) {
	$ID_HISTORIAL_RECLAMACION = $dato['ID_HISTORIAL_RECLAMACION'];
	$FECHA_RECLAMACION3 = $dato['FECHA_RECLAMACION3'];
	$update = mysqli_query($conex, "UPDATE ipsen_historial_reclamacion
	SET
	RECLAMO3='',
	FECHA_RECLAMACION3='',
	MOTIVO_NO_RECLAMACION2='',
	RECLAMO2='SI',
	FECHA_RECLAMACION2='" . $FECHA_RECLAMACION3 . "'
	WHERE FECHA_RECLAMACION3 LIKE '%2016-02-%' AND ID_HISTORIAL_RECLAMACION='$ID_HISTORIAL_RECLAMACION'");
	echo mysqli_error($conex);
	if ($update)
		$a = $a + 1;
	if (!$update)
		$a = $a;
}
echo 'registros actualizados ' . $a;
