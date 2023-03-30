<?php
require_once('../logica/session.php');
require_once("../datos/conex.php");
http_response_code(200);
header('Content-Type: text/plain');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);


$institucion_evento = $data['institucion_evento'];
$profecion_usuario = $data['profecion_usuario'];
$peso = $data['peso'];
$talla = $data['talla'];
$sci = $data['sci'];
$medicamento = $data['medicamento'];
$indicacion = $data['indicacion'];
$dosis = $data['dosis'];
$unidad_medida = $data['unidad_medida'];
$via_administracion = $data['via_administracion'];
$frecuencia_administracion = $data['frecuencia_administracion'];
$descripcion_evento = $data['descripcion_evento'];
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

	$insertar = mysqli_query($conex, "INSERT INTO ipsen_evento_adverso(FECHA_NOTIFICA,DEPARTAMENTO,MUNICIPIO,NOMBRE_INSTITUCION,CODIGO_PNF,NOMBRE_REPORTANTE,NOMBRE_PACIENTE_ACUDIENTE,CONSECUTIVO,PROFESION_REPORTANTE,CORREO_REPORTANTE,FECHA_NACIMIENTO_PACIENTE,EDAD_PACIENTE,TIPO_DOCUMENTO_PACIENTE,NUMERO_DOCUMENTO_PACIENTE,INICIALES_PACIENTE,SEXO,PESO,TALLA,DIAGNOSTICO_PRINCIPAL,TITULAR_REGISTRO,NOMBRE_COMERCIAL,REGISTRO_SANITARIO,LOTE,FECHA_INICIO_EVENTO,EVENTO_ADVERSO,DESCRIPCION_ANALISIS_EVENTO,DESENLACE_EVENTO,SERIEDAD,FECHA_MUERTE,PREGUNTA1,PREGUNTA2,PREGUNTA3,PREGUNTA4,PREGUNTA5,ID_PACIENTE_FK) VALUES ('','','','$institucion_evento','','','','','','','','','','','','','" . $peso . "','" . $talla . "','','','','','','','','" . $descripcion_evento . "','','','','','','','','','$codigo_paciente')");
	echo mysqli_error($conex);
	if ($insertar) {
		$sql = "SELECT MAX(ID_EVENTO_ADVERSO) AS ULTIMO_EVENTO_ADVERSO_ID FROM ipsen_evento_adverso";
		$resultado = mysqli_query($conex, $sql);
		$fila = mysqli_fetch_assoc($resultado);
		$FK_EVENTO_ADVERSO = $fila['ULTIMO_EVENTO_ADVERSO_ID'];
		foreach ($data->medicamento as $index) {
			$sci = $data['sci'][$index];
			$medicamento = $data['medicamento'][$index];
			$indicacion = $data['indicacion'][$index];
			$dosis = $data['dosis'][$index];
			$unidad_medida = $data['unidad_medida'][$index];
			$via_administracion = $data['via_administracion'][$index];
			$frecuencia_administracion = $data['frecuencia_administracion'][$index];
			$inter_medicamentos = mysqli_query($conex, "INSERT INTO `ipsen_informacion_tratamiento_ea`(`SCI`, `MEDICAMENTO`, `INDICACION`, `DOSIS`, `UNIDAD_MEDIDA`, `VIA_ADMINISTRACION`, `FRECUENCIA_ADMINISTRACION`, `FECHA_INICIO`, `FECHA_FIN`, `EVENTO_ADVERSO_ID`) VALUES ('$sci','$medicamento','$indicacion','$dosis','$unidad_medida','$via_administracion','$frecuencia_administracion','','','$FK_EVENTO_ADVERSO')");
			echo mysqli_error($conex);

			if ($inter_medicamentos) {
				require('../presentacion/pdf.php');

				$titulo = 'Datos cargados';
				$icono = 'success';
				$mensaje = 'El aspirante ha sido creado';

				echo $titulo . ',' . $icono . ',' . $mensaje;
			}
		}
	}
}
