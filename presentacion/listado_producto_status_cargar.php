<?php
include('../datos/conex.php');
$REFERENCIA = $_POST['REFERENCIA'];
$STATUS = $_POST['STATUS'];
if ($REFERENCIA == 'ADEMPAS' || $REFERENCIA == 'ADEMPAS 1MG 42TABL' || $REFERENCIA == 'ADEMPAS 2.5MG 84TABL' || $REFERENCIA == 'ADEMPAS 1.5MG 42TABL' || $REFERENCIA == 'ADEMPAS 0.5MG 42TABL' || $REFERENCIA == 'ADEMPAS 2MG 42TABL') {
	echo "<option value=\"" . $STATUS . "\">" . $STATUS . "</option>";
	echo "<option value=\"Mantenimiento\">" . utf8_encode('Mantenimiento') . "</option>";
	echo "<option value=\"Titulacion\">" . utf8_encode('Titulacion') . "</option>";
}
// if($REFERENCIA=='Eylia 2MG VL 1x2ML CO INST')
// {
// 	echo "<option value=\"\"></option>";
// 	echo "<option value=\"Aplicacion Programada\">".utf8_encode('Aplicacion Programada')."</option>";
// 	echo "<option value=\"Aplicacion No Programada\">".utf8_encode('Aplicacion No Programada')."</option>";
// }
if ($REFERENCIA == 'Eylia 2MG VL 1x2ML CO INST') {
	echo "<option value=\"" . $STATUS . "\">" . $STATUS . "</option>";
	echo "<option value=\"Aplicacion Programada\">" . utf8_encode('Aplicacion Programada') . "</option>";
	echo "<option value=\"Aplicacion No Programada\">" . utf8_encode('Aplicacion No Programada') . "</option>";
}
if ($REFERENCIA == 'BETAFERON CMBP X 15 VPFS (3750 MCG) MM') {
	echo "<option value=\"" . $STATUS . "\">" . $STATUS . "</option>";
	echo "<option value=\"Alto Riesgo I\">" . utf8_encode('Alto Riesgo I') . "</option>";
	echo "<option value=\"Alto Riesgo II\">" . utf8_encode('Alto Riesgo II') . "</option>";
	echo "<option value=\"Mantenimiento I\">" . utf8_encode('Mantenimiento I') . "</option>";
	echo "<option value=\"Mantenimiento II\">" . utf8_encode('Mantenimiento II') . "</option>";
	echo "<option value=\"Paciente Nuevo\">" . utf8_encode('Paciente Nuevo') . "</option>";
}
if ($REFERENCIA != 'BETAFERON CMBP X 15 VPFS (3750 MCG) MM' && $REFERENCIA != 'ADEMPAS' && $REFERENCIA != 'ADEMPAS' && $REFERENCIA != 'ADEMPAS 1MG 42TABL' && $REFERENCIA != 'ADEMPAS 2.5MG 84TABL' && $REFERENCIA != 'ADEMPAS 1.5MG 42TABL' && $REFERENCIA != 'ADEMPAS 0.5MG 42TABL' && $REFERENCIA != 'ADEMPAS 2MG 42TABL' && $REFERENCIA != 'Eylia 2MG VL 1x2ML CO INST') {
	echo "<option value=\"\"></option>";
}
