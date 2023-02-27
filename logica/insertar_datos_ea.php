<?php
require_once('session.php');
require('../datos/parse_str.php');
require_once("../datos/conex.php");
if (isset($_POST['registrar'])) {
	$FECHA_NOTIFICA = $_POST['fecha_notificacion'];
	$DEPARTAMENTO = $_POST['departamento'];
	$MUNICIPIO = $_POST['municipio'];
	$NOMBRE_INSTITUCION = $_POST['institucion_evento'];
	$CODIGO_PNF = $_POST['codigo_pnf'];
	$NOMBRE_REPORTANTE = $_POST['nombre_usuario'];
	$NOMBRE_PACIENTE_ACUDIENTE = $_POST['nombre_paciente_acudiente'];
	$CONSECUTIVO = $_POST['consecutivo'];
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
	$TITULAR_REGISTRO = $_POST['titular_registro'];
	$NOMBRE_COMERCIAL = $_POST['nombre_comercial'];
	$REGISTRO_SANITARIO = $_POST['registro_sanitario'];
	$LOTE = $_POST['lote'];
	$FECHA_INICIO_EVENTO = $_POST['fecha_ini_evento'];
	$EVENTO_ADVERSO = $_POST['evento_adverso'];
	$DESCRIPCION_ANALISIS_EVENTO = $_POST['descripcion_evento'];
	$DESENLACE_EVENTO = $_POST['desenlace_evento'];
	$SERIEDAD = $_POST['seriedad'];
	$FECHA_MUERTE = $_POST['fecha_muerte'];
	$PREGUNTA1 = $_POST['pregunta1'];
	$PREGUNTA2 = $_POST['pregunta2'];
	$PREGUNTA3 = $_POST['pregunta3'];
	$PREGUNTA4 = $_POST['pregunta4'];
	$PREGUNTA5 = $_POST['pregunta5'];
	$ID_PACIENTE = $_POST['ID_PACIENTE'];
	$ID_GESTION = $_POST['ID_GESTION'];
	$URL = "localhost/IPSEN/EVENTO_ADVERSO/$ID_GESTION/Evento_Adverso_$ID_PACIENTE.pdf";
	$insertar = mysqli_query($conex, "INSERT INTO ipsen_evento_adverso(FECHA_NOTIFICA,DEPARTAMENTO,MUNICIPIO,NOMBRE_INSTITUCION,CODIGO_PNF,NOMBRE_REPORTANTE,NOMBRE_PACIENTE_ACUDIENTE,CONSECUTIVO,PROFESION_REPORTANTE,CORREO_REPORTANTE,FECHA_NACIMIENTO_PACIENTE,EDAD_PACIENTE,TIPO_DOCUMENTO_PACIENTE,NUMERO_DOCUMENTO_PACIENTE,INICIALES_PACIENTE,SEXO,PESO,TALLA,DIAGNOSTICO_PRINCIPAL,TITULAR_REGISTRO,NOMBRE_COMERCIAL,REGISTRO_SANITARIO,LOTE,FECHA_INICIO_EVENTO,EVENTO_ADVERSO,DESCRIPCION_ANALISIS_EVENTO,DESENLACE_EVENTO,SERIEDAD,FECHA_MUERTE,PREGUNTA1,PREGUNTA2,PREGUNTA3,PREGUNTA4,PREGUNTA5,ID_PACIENTE_FK, ID_GESTION_FK, URL_PDF) VALUES ('" . $FECHA_NOTIFICA . "','" . $DEPARTAMENTO . "','" . $MUNICIPIO . "','" . $NOMBRE_INSTITUCION . "','" . $CODIGO_PNF . "','" . $NOMBRE_REPORTANTE . "','" . $NOMBRE_PACIENTE_ACUDIENTE . "','" . $CONSECUTIVO . "','" . $PROFESION_REPORTANTE . "','" . $CORREO_REPORTANTE . "','" . $FECHA_NACIMIENTO_PACIENTE . "','" . $EDAD_PACIENTE . "','" . $TIPO_DOCUMENTO_PACIENTE . "','" . $NUMERO_DOCUMENTO_PACIENTE . "','" . $INICIALES_PACIENTE . "','" . $SEXO . "','" . $PESO . "','" . $TALLA . "','" . $DIAGNOSTICO_PRINCIPAL . "','" . $TITULAR_REGISTRO . "','" . $NOMBRE_COMERCIAL . "','" . $REGISTRO_SANITARIO . "','" . $LOTE . "','" . $FECHA_INICIO_EVENTO . "','" . $EVENTO_ADVERSO . "','" . $DESCRIPCION_ANALISIS_EVENTO . "','" . $DESENLACE_EVENTO . "','" . $SERIEDAD . "','" . $FECHA_MUERTE . "','" . $PREGUNTA1 . "','" . $PREGUNTA2 . "','" . $PREGUNTA3 . "','" . $PREGUNTA4 . "','" . $PREGUNTA5 . "','" . $ID_PACIENTE . "','" . $ID_GESTION . "','" . $URL . "')");
	echo mysqli_error($conex);
	if ($insertar) {
		$sql = "SELECT MAX(ID_EVENTO_ADVERSO) AS ULTIMO_EVENTO_ADVERSO_ID FROM ipsen_evento_adverso";
		$resultado = mysqli_query($conex, $sql);
		$fila = mysqli_fetch_assoc($resultado);
		$FK_EVENTO_ADVERSO = $fila['ULTIMO_EVENTO_ADVERSO_ID'];
		foreach ($_POST['medicamento'] as $index => $medicamento) {
			$SCI = $_POST['S_C_I'][$index];
			$MEDICAMENTO = $_POST['medicamento'][$index];
			$INDICACION = $_POST['indicacion'][$index];
			$DOSIS = $_POST['dosis'][$index];
			$UNIDAD_MEDIDA = $_POST['unidad_medida'][$index];
			$VIA_ADMINISTRACION = $_POST['via_administracion'][$index];
			$FRECUENCIA_ADMINISTRACION = $_POST['frecuencia_administracion'][$index];
			$FECHA_INICIO = $_POST['fecha_inicio'][$index];
			$FECHA_FIN = $_POST['fecha_fin'][$index];
			$inter_medicamentos = mysqli_query($conex, "INSERT INTO `ipsen_informacion_tratamiento_ea`(`SCI`, `MEDICAMENTO`, `INDICACION`, `DOSIS`, `UNIDAD_MEDIDA`, `VIA_ADMINISTRACION`, `FRECUENCIA_ADMINISTRACION`, `FECHA_INICIO`, `FECHA_FIN`, `EVENTO_ADVERSO_ID`) VALUES ('" . $SCI . "','" . $MEDICAMENTO . "','" . $INDICACION . "','" . $DOSIS . "','" . $UNIDAD_MEDIDA . "','" . $VIA_ADMINISTRACION . "','" . $FRECUENCIA_ADMINISTRACION . "','" . $FECHA_INICIO . "','" . $FECHA_FIN . "','" . $FK_EVENTO_ADVERSO . "')");
			echo mysqli_error($conex);
		}
		require('../presentacion/pdf.php');
		echo 'Exito';
	} else {
		echo 'Error';
	}
}
