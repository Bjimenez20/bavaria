<?php
require_once('../logica/session.php');
require_once("../datos/conex.php");

http_response_code(200);
header('Content-Type: text/plain');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$fecha_notificacion = $data['fecha_notificacion'];
$departamento = $data['departamento'];
$municipio = $data['municipio'];
$institucion_evento = $data['institucion_evento'];
$codigo_pnf = $data['codigo_pnf'];
$nombre_usuario = $data['nombre_usuario'];
$nombre_paciente_acudiente = $data['nombre_paciente_acudiente'];
$consecutivo = $data['consecutivo'];
$profecion_usuario = $data['profecion_usuario'];
$correo_usuario = $data['correo_usuario'];
$fecha_nacimiento = $data['fecha_nacimiento'];
$edad_paciente = $data['edad_paciente'];
$tipo_documento_paciente = $data['tipo_documento_paciente'];
$documento_paciente = $data['documento_paciente'];
$iniciales_pa = $data['iniciales_pa'];
$genero = $data['genero'];
$peso = $data['peso'];
$talla = $data['talla'];
$sci = $data['sci'];
$medicamento = $data['medicamento'];
$indicacion = $data['indicacion'];
$dosis = $data['dosis'];
$unidad_medida = $data['unidad_medida'];
$via_administracion = $data['via_administracion'];
$frecuencia_administracion = $data['frecuencia_administracion'];
$fecha_inicio = $data['fecha_inicio'];
$fecha_fin = $data['fecha_fin'];
$diagnostico = $data['diagnostico'];
$titular_registro = $data['titular_registro'];
$nombre_comercial = $data['nombre_comercial'];
$registro_sanitario = $data['registro_sanitario'];
$lote = $data['lote'];
$fecha_ini_evento = $data['fecha_ini_evento'];
$evento_adverso = $data['evento_adverso'];
$descripcion_evento = $data['descripcion_evento'];
$desenlace_evento = $data['desenlace_evento'];
$seriedad = $data['seriedad'];
$fecha_muerte = $data['fecha_muerte'];
$pregunta1 = $data['pregunta1'];
$pregunta2 = $data['pregunta2'];
$pregunta3 = $data['pregunta3'];
$pregunta4 = $data['pregunta4'];
$pregunta5 = $data['pregunta5'];
$codigo_paciente = $data['codigo_paciente'];

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
	$insertar = mysqli_query($conex, "INSERT INTO ipsen_evento_adverso(FECHA_NOTIFICA,DEPARTAMENTO,MUNICIPIO,NOMBRE_INSTITUCION,CODIGO_PNF,NOMBRE_REPORTANTE,NOMBRE_PACIENTE_ACUDIENTE,CONSECUTIVO,PROFESION_REPORTANTE,CORREO_REPORTANTE,FECHA_NACIMIENTO_PACIENTE,EDAD_PACIENTE,TIPO_DOCUMENTO_PACIENTE,NUMERO_DOCUMENTO_PACIENTE,INICIALES_PACIENTE,SEXO,PESO,TALLA,DIAGNOSTICO_PRINCIPAL,TITULAR_REGISTRO,NOMBRE_COMERCIAL,REGISTRO_SANITARIO,LOTE,FECHA_INICIO_EVENTO,EVENTO_ADVERSO,DESCRIPCION_ANALISIS_EVENTO,DESENLACE_EVENTO,SERIEDAD,FECHA_MUERTE,PREGUNTA1,PREGUNTA2,PREGUNTA3,PREGUNTA4,PREGUNTA5,ID_PACIENTE_FK) VALUES ('$fecha_notificacion','$departamento','$municipio','$institucion_evento','$codigo_pnf','$nombre_usuario','$nombre_paciente_acudiente','$consecutivo','$profecion_usuario','$correo_usuario','$fecha_nacimiento','$edad_paciente','$tipo_documento_paciente','$documento_paciente','$iniciales_pa','$genero','$peso','$talla','$diagnostico','$titular_registro','$nombre_comercial','$registro_sanitario','$lote','$fecha_ini_evento','$evento_adverso','$descripcion_evento','$desenlace_evento','$seriedad','$fecha_muerte','$pregunta1','$pregunta2','$pregunta3','$pregunta4','$pregunta5','$codigo_paciente')");
	if ($insertar) {
		$sql = "SELECT MAX(ID_EVENTO_ADVERSO) AS ULTIMO_EVENTO_ADVERSO_ID FROM ipsen_evento_adverso";
		$resultado = mysqli_query($conex, $sql);
		$fila = mysqli_fetch_assoc($resultado);
		$FK_EVENTO_ADVERSO = $fila['ULTIMO_EVENTO_ADVERSO_ID'];

		// Check if medicamento is an array before using foreach
		if (is_array($data['medicamento'])) {
			foreach ($data['medicamento'] as $index => $medicamento) {
				$sc = $sci[$index];
				$medi = $medicamento[$index];
				$ind = $indicacion[$index];
				$dos = $dosis[$index];
				$um = $unidad_medida[$index];
				$va = $via_administracion[$index];
				$fa = $frecuencia_administracion[$index];
				$fi = $fecha_inicio[$index];
				$ff = $fecha_fin[$index];

				$inter_medicamentos = mysqli_query($conex, "INSERT INTO `ipsen_informacion_tratamiento_ea`(`SCI`, `MEDICAMENTO`, `INDICACION`, `DOSIS`, `UNIDAD_MEDIDA`, `VIA_ADMINISTRACION`, `FRECUENCIA_ADMINISTRACION`, `FECHA_INICIO`, `FECHA_FIN`, `EVENTO_ADVERSO_ID`) VALUES ('$sc','$medi','$ind','$dos','$um','$va','$fa','$fi','$ff','$FK_EVENTO_ADVERSO')");

				if ($inter_medicamentos) {
					$titulo = 'Datos cargados';
					$icono = 'success';
					$mensaje = 'El evento ha sido creado';

					echo $titulo . ',' . $icono . ',' . $mensaje;
				}
			}
		}
	}
}
