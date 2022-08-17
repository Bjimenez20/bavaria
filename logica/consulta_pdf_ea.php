<?php
require('../datos/parse_str.php');
require_once("../datos/conex.php");
$ID_EVENTO_ADVERSOS = $ID_EVENTO_ADVERSO;
$hoy = date('Y-m-d');
$consulta = mysqli_query($conex, "SELECT * FROM ipsen_evento_adverso WHERE ID_EVENTO_ADVERSO='" . $ID_EVENTO_ADVERSOS . "'");
echo mysqli_error($conex);
while ($fila1 = mysqli_fetch_array($consulta)) {
	$FECHA_NOTIFICA = $_POST['fecha_notificacion'];
	$DEPARTAMENTO = $_POST['departamento'];
	$MUNICIPIO = $_POST['municipio'];
	$NOMBRE_INSTITUCION = $_POST['institucion_evento'];
	$CODIGO_PNF = $_POST['codigo_pnf'];
	$NOMBRE_REPORTANTE = $_POST['nombre_usuario'];
	$PROFESION_REPORTANTE = $_POST['profecion_usuario'];
	$CORREO_REPORTANTE = $_POST['correo_usuario'];
	$FECHA_NACIMIENTO_PACIENTE = $_POST['fecha_nacimiento'];
	$EDAD_PACIENTE = $_POST['edad_paciente'];
	$TIPO_DOCUMENTO_PACIENTE = $_POST['tipo_documento_paciente'];
	$NUMERO_DOCUMENTO_PACIENTE = $_POST['documento_paciente'];
	$INICIALES_PACIENTE = $_POST['iniciales_pa'];
	$SEXO = $_POST['genero'];
	$PESO = $_POST['peso'];
	$TALLA = $_POST['talla'];
	$DIAGNOSTICO_PRINCIPAL = $_POST['diagnostico'];
	$SCI1 = $_POST['S_C_I1'];
	$MEDICAMENTO1 = $_POST['medicamento1'];
	$INDICACION1 = $_POST['indicacion1'];
	$DOSIS1 = $_POST['dosis1'];
	$UNIDAD_MEDIDA1 = $_POST['unidad_medida1'];
	$VIA_ADMINISTRACION1 = $_POST['via_administracion1'];
	$FRECUENCIA_ADMINISTRACION1 = $_POST['frecuencia_administracion1'];
	$FECHA_INICIO1 = $_POST['fecha_inicio1'];
	$FECHA_FIN1 = $_POST['fecha_fin1'];
	$SCI2 = $_POST['S_C_I2'];
	$MEDICAMENTO2 = $_POST['medicamento2'];
	$INDICACION2 = $_POST['indicacion2'];
	$DOSIS2 = $_POST['dosis2'];
	$UNIDAD_MEDIDA2 = $_POST['unidad_medida2'];
	$VIA_ADMINISTRACION2 = $_POST['via_administracion2'];
	$FRECUENCIA_ADMINISTRACION2 = $_POST['frecuencia_administracion2'];
	$FECHA_INICIO2 = $_POST['fecha_inicio2'];
	$FECHA_FIN2 = $_POST['fecha_fin2'];
	$SCI3 = $_POST['S_C_I3'];
	$MEDICAMENTO3 = $_POST['medicamento3'];
	$INDICACION3 = $_POST['indicacion3'];
	$DOSIS3 = $_POST['dosis3'];
	$UNIDAD_MEDIDA3 = $_POST['unidad_medida3'];
	$VIA_ADMINISTRACION3 = $_POST['via_administracion3'];
	$FRECUENCIA_ADMINISTRACION3 = $_POST['frecuencia_administracion3'];
	$FECHA_INICIO3 = $_POST['fecha_inicio3'];
	$FECHA_FIN3 = $_POST['fecha_fin3'];
	$FECHA_INICIO_EVENTO = $_POST['fecha_ini_evento'];
	$EVENTO_ADVERSO = $_POST['evento_adverso'];
	$DESCRIPCION_ANALISIS_EVENTO = $_POST['descripcion_evento'];
	$DESENLACE_EVENTO = $_POST['desenlace_evento'];
	$SERIEDAD = $_POST['seriedad'];
	$PREGUNTA1 = $_POST['pregunta1'];
	$PREGUNTA2 = $_POST['pregunta2'];
	$PREGUNTA3 = $_POST['pregunta3'];
	$PREGUNTA4 = $_POST['pregunta4'];
	$PREGUNTA5 = $_POST['pregunta5'];
	$PREGUNTA6 = $_POST['pregunta6'];
	$PREGUNTA7 = $_POST['pregunta7'];
	$PREGUNTA8 = $_POST['pregunta8'];
	$PREGUNTA9 = $_POST['pregunta9'];
	$PREGUNTA10 = $_POST['pregunta10'];
	$PREGUNTA11 = $_POST['pregunta11'];
	$PREGUNTA12 = $_POST['pregunta12'];
	$PREGUNTA13 = $_POST['pregunta13'];
	$PREGUNTA14 = $_POST['pregunta14'];
	$PREGUNTA15 = $_POST['pregunta15'];
	$ID_PACIENTE = $_POST['ID_PACIENTE'];
}

// $nombre = $NOMBRE_REPORTANTE;
// function iniciales($nombre)
// {
// 	$notocar = array('del', 'de');
// 	$trozos = explode(' ', $nombre);
// 	$iniciales = '';
// 	for ($i = 0; $i < count($trozos); $i++) {
// 		if (in_array($trozos[$i], $notocar)) $iniciales .= $trozos[$i] . " ";
// 		else $iniciales .= substr($trozos[$i], 0, 1) . ". ";
// 	}
// 	return $iniciales;
// }
