<?php
require_once('../logica/session.php');
require_once("../datos/conex.php");

http_response_code(200);
header('Content-Type: text/plain');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$rows1 = $data['rows1'];
$rows = $data['rows'];
$date = $data['date'];

$fecha_notificacion = $date['fecha_notificacion'];
$departamento = $date['departamento'];
$municipio = $date['municipio'];
$institucion_evento = $date['institucion_evento'];
$codigo_pnf = $date['codigo_pnf'];
$nombre_usuario = $date['nombre_usuario'];
$nombre_paciente_acudiente = $date['nombre_paciente_acudiente'];
$consecutivo = $date['consecutivo'];
$profecion_usuario = $date['profecion_usuario'];
$correo_usuario = $date['correo_usuario'];
$fecha_nacimiento = $date['fecha_nacimiento'];
$edad_paciente = $date['edad_paciente'];
$tipo_documento_paciente = $date['tipo_documento_paciente'];
$documento_paciente = $date['documento_paciente'];
$iniciales_pa = $date['iniciales_pa'];
$genero = $date['genero'];
$peso = $date['peso'];
$talla = $date['talla'];
$sci = $date['sci'];
$medicamento = $date['medicamento'];
$indicacion = $date['indicacion'];
$dosis = $date['dosis'];
$unidad_medida = $date['unidad_medida'];
$via_administracion = $date['via_administracion'];
$frecuencia_administracion = $date['frecuencia_administracion'];
$fecha_inicio = $date['fecha_inicio'];
$fecha_fin = $date['fecha_fin'];
$diagnostico = $date['diagnostico'];
$titular_registro = $date['titular_registro'];
$nombre_comercial = $date['nombre_comercial'];
$registro_sanitario = $date['registro_sanitario'];
$lote = $date['lote'];
$fecha_ini_evento = $date['fecha_ini_evento'];
$evento_adverso = $date['evento_adverso'];
$descripcion_evento = $date['descripcion_evento'];
$desenlace_evento = $date['desenlace_evento'];
$seriedad = $date['seriedad'];
$fecha_muerte = $date['fecha_muerte'];
$pregunta1 = $date['pregunta1'];
$pregunta2 = $date['pregunta2'];
$pregunta3 = $date['pregunta3'];
$pregunta4 = $date['pregunta4'];
$pregunta5 = $date['pregunta5'];
$codigo_paciente = $date['codigo_paciente'];

if (
	empty($institucion_evento) ||
	empty($profecion_usuario) ||
	empty($peso) ||
	empty($talla) ||
	empty($sci) ||
	empty($medicamento) ||
	empty($indicacion) ||
	empty($dosis) ||
	empty($unidad_medida) ||
	empty($via_administracion) ||
	empty($frecuencia_administracion) ||
	empty($fecha_inicio) ||
	empty($fecha_fin) ||
	empty($fecha_ini_evento) ||
	empty($evento_adverso) ||
	empty($descripcion_evento)
) {
	$campos_vacios = array();

	if (empty($institucion_evento)) {
		array_push($campos_vacios, 'Nombre de la Institución donde ocurrió el evento');
	}
	if (empty($profecion_usuario)) {
		array_push($campos_vacios, 'Profesión del reportante primario');
	}
	if (empty($peso)) {
		array_push($campos_vacios, 'Peso(Kg)');
	}
	if (empty($talla)) {
		array_push($campos_vacios, 'Talla(cm)');
	}
	if (empty($sci)) {
		array_push($campos_vacios, 'S/C/I');
	}
	if (empty($medicamento)) {
		array_push($campos_vacios, 'Medicamento (Denominación Común Internacional o Nombre genérico)');
	}
	if (empty($indicacion)) {
		array_push($campos_vacios, 'Indicación');
	}
	if (empty($dosis)) {
		array_push($campos_vacios, 'Dosis');
	}
	if (empty($unidad_medida)) {
		array_push($campos_vacios, 'Unidad de medida');
	}
	if (empty($via_administracion)) {
		array_push($campos_vacios, 'Vía de administración');
	}
	if (empty($frecuencia_administracion)) {
		array_push($campos_vacios, 'Frecuencia de administración');
	}
	if (empty($fecha_inicio)) {
		array_push($campos_vacios, 'Fecha de inicio');
	}
	if (empty($fecha_fin)) {
		array_push($campos_vacios, 'Fecha de finalización');
	}
	if (empty($fecha_ini_evento)) {
		array_push($campos_vacios, 'Fecha de Inicio del Evento Adverso');
	}
	if (empty($evento_adverso)) {
		array_push($campos_vacios, 'Evento adverso');
	}
	if (empty($descripcion_evento)) {
		array_push($campos_vacios, 'Descripción y análisis del Evento Adverso');
	}

	if (count($campos_vacios) > 0) {

		$titulo = 'Error de validación';
		$icono = 'error';
		$mensaje = 'Por favor completa los siguientes campos:';
		$lista = '<ul class="my-3">';
		foreach ($campos_vacios as $campo) {
			$lista .= '<li class="text-start">' . $campo . '</li>';
		}
		$lista .= '</ul>';
		$mensaje .= $lista;

		echo $titulo . ',' . $icono . ',' . $mensaje;
	}
} else {
	$insertar = mysqli_query($conex, "INSERT INTO ipsen_evento_adverso (FECHA_NOTIFICA, DEPARTAMENTO, MUNICIPIO, NOMBRE_INSTITUCION, CODIGO_PNF, NOMBRE_REPORTANTE, NOMBRE_PACIENTE_ACUDIENTE, CONSECUTIVO, PROFESION_REPORTANTE, CORREO_REPORTANTE, FECHA_NACIMIENTO_PACIENTE, EDAD_PACIENTE, TIPO_DOCUMENTO_PACIENTE, NUMERO_DOCUMENTO_PACIENTE, INICIALES_PACIENTE, SEXO, PESO, TALLA, TITULAR_REGISTRO, NOMBRE_COMERCIAL, REGISTRO_SANITARIO, LOTE, FECHA_INICIO_EVENTO, EVENTO_ADVERSO, DESCRIPCION_ANALISIS_EVENTO, DESENLACE_EVENTO, SERIEDAD, LUGAR_DISTRIBUCION, FECHA_MUERTE, PREGUNTA1, PREGUNTA2, PREGUNTA3, PREGUNTA4, PREGUNTA5, ID_PACIENTE_FK) VALUES ('$fecha_notificacion','$departamento','$municipio','$institucion_evento','$codigo_pnf','$nombre_usuario','$nombre_paciente_acudiente','$consecutivo','$profecion_usuario','$correo_usuario','$fecha_nacimiento','$edad_paciente','$tipo_documento_paciente','$documento_paciente','$iniciales_pa','$genero','$peso','$talla','$titular_registro','$nombre_comercial','$registro_sanitario','$lote','$fecha_ini_evento','$evento_adverso','$descripcion_evento','$desenlace_evento','$seriedad','','$fecha_muerte','$pregunta1','$pregunta2','$pregunta3','$pregunta4','$pregunta5','$codigo_paciente')");
	if ($insertar) {
		$sql = "SELECT MAX(ID_EVENTO_ADVERSO) AS ULTIMO_EVENTO_ADVERSO_ID FROM ipsen_evento_adverso";
		$resultado = mysqli_query($conex, $sql);
		$fila = mysqli_fetch_assoc($resultado);
		$FK_EVENTO_ADVERSO = $fila['ULTIMO_EVENTO_ADVERSO_ID'];

		foreach ($rows as $row) {

			$sc = $row['sci'];
			$medi = $row['medicamento'];
			$ind = $row['indicacion'];
			$dos = $row['dosis'];
			$um = $row['unidad_medida'];
			$va = $row['via_administracion'];
			$fa = $row['frecuencia_administracion'];
			$fi = $row['fecha_inicio'];
			$ff = $row['fecha_fin'];


			$inter_medicamentos = mysqli_query($conex, "INSERT INTO ipsen_informacion_tratamiento_ea (SCI, MEDICAMENTO, INDICACION, DOSIS, UNIDAD_MEDIDA, VIA_ADMINISTRACION, FRECUENCIA_ADMINISTRACION, FECHA_INICIO, FECHA_FIN, EVENTO_ADVERSO_ID) VALUES ('$sc','$medi','$ind','$dos','$um','$va','$fa','$fi','$ff','$FK_EVENTO_ADVERSO')");
		}

		foreach ($rows1 as $row1) {
			$dg = $row1['diagnostico'];
			$inser_diagnostico = mysqli_query($conex, "INSERT INTO `ipsen_diagnosticos_ea`(`DIAGNOSTICO`, `EVENTO_ADVERSO_ID`) VALUES ('$dg','$FK_EVENTO_ADVERSO')");
		}


		if ($inter_medicamentos && $inser_diagnostico) {
			$titulo = 'Datos cargados';
			$icono = 'success';
			$mensaje = 'El evento ha sido creado';

			echo $titulo . ',' . $icono . ',' . $mensaje;
		}
	}
}
