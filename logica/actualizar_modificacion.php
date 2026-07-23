<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>BAVARIA</title>
	<style>
		.aviso3 {
			font-size: 130%;
			font-weight: bold;
			color: #11a9e3;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}

		.error {
			font-size: 130%;
			font-weight: bold;
			color: red;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}
	</style>
</head>

<body>
	<?php
	require('../datos/parse_str.php');
	require('../datos/conex.php');
	if (isset($_POST['gestion'])) {
		$gestion = $_POST['gestion'];
	} else {
		$gestion = '';
	}
	$codigo_gestion = $_POST['codigo_gestion'];
	$codigo_usuario2 = $_POST['codigo_usuario2'];
	$estado_paciente = $_POST['estado_paciente'];
	$status_paciente = $_POST['status_paciente'];
	$fecha_activacion = $_POST['fecha_activacion'];
	$fecha_retiro = $_POST['fecha_retiro'];
	$motivo_retiro = $_POST['motivo_retiro'];
	$observacion_retiro = $_POST['observacion_retiro'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$identificacion = $_POST['identificacion'];
	$telefono1 = $_POST['telefono1'];
	$telefono2 = $_POST['telefono2'];
	$telefono3 = $_POST['telefono3'];
	$telefono4 = $_POST['telefono4'];
	$telefono5 = $_POST['telefono5'];
	$correo = $_POST['correo'];
	$ciudad = $_POST['ciudad'];
	$direccion_nueva = $_POST['DIRECCION'];
	if ($direccion_nueva != '') {
		$direccion = $direccion_nueva;
	}
	if ($direccion_nueva == '') {
		$direccion = $_POST['direccion_act'];
	}
	$barrio = $_POST['barrio'];
	$departamento = $_POST['departamento'];
	$fecha_nacimiento = $_POST['fecha_nacimiento'];
	$edad = $_POST['edad'];
	$acudiente = $_POST['acudiente'];
	$telefono_acudiente = $_POST['telefono_acudiente'];
	$clasificacion_patologica = $_POST['clasificacion_patologica'];
	$fecha_ini_terapia = $_POST['fecha_ini_terapia'];
	$fecha_proxima_llamada = $_POST['fecha_proxima_llamada'];
	$fecha_proxima_llamada_ant = $_POST['fecha_proxima_llamada_ant'];
	$id_gestion_ult = $_POST['id_gestion_ult'];
	$fecha_reclamacion = $_POST['fecha_reclamacion'];
	$fecha_ultima_reclamacion = $_POST['fecha_reclamaciones'];
	$fecha_autorizacion = $_POST['fecha_autorizacion'];
	$fecha_proxima_llamada;
	$fecha_proxima_llamada_ant;
	if ($fecha_proxima_llamada < $fecha_proxima_llamada_ant) {
		$fecha_proxima_llamada;
		$fecha_proxima_llamada;
		$id_gestion_ult;
		$sql = mysqli_query($conex, "UPDATE ipsen_gestiones SET FECHA_PROXIMA_LLAMADA='" . $fecha_proxima_llamada . "',FECHA_PROGRAMADA_GESTION='" . $fecha_proxima_llamada . "' WHERE ID_GESTION='" . $id_gestion_ult . "'");
		echo mysqli_error($conex);
	}

	if ($_POST['tratamiento_previo'] == 'Otro') {
		$tratamiento_previo = $_POST['tratamiento_previo_otro'];
	} else {
		$tratamiento_previo = $_POST['tratamiento_previo'];
	}

	$ips_atiende = $_POST['ips_atiende'];
	if ($ips_atiende == 'NO ENCONTRADO') {
		$ips_otro = $_POST['ips_otro'];
		if ($ips_otro != '') {
			$insert_ips = mysqli_query($conex, "INSERT INTO ipsen_ips (IPS,ESTADO) VALUES ('" . $ips_otro . "','OUT')");
			require('../presentacion/email/mail_habilitar_ips.php');
		}
	}

	$operador_logistico = $_POST['operador_logistico'];
	if ($operador_logistico == 'NO ENCONTRADO') {
		$operador_otro = $_POST['operador_otro'];
		if ($operador_otro != '') {
			$insert_opl = mysqli_query($conex, "INSERT INTO ipsen_operador_logistico (OPERADOR_LOGISTICO,ESTADO) VALUES ('" . $operador_otro . "','OUT')");
			require('../presentacion/email/mail_habilitar_operador.php');
		}
	}

	$asegurador = $_POST['asegurador'];
	if ($asegurador == 'NO ENCONTRADO') {
		$asegurador_otro = $_POST['asegurador_otro'];
		if ($asegurador_otro != '') {
			$insert_eps = mysqli_query($conex, "INSERT INTO ipsen_asegurador (ASEGURADOR,ESTADO) VALUES ('" . $asegurador_otro . "','OUT')");
			require('../presentacion/email/mail_habilitar_eps.php');
		}
	}

	$medico_t = $_POST['medico_tratante'];
	if ($medico_t == 'NO ENCONTRADO') {
		$medico_t_otro  = $_POST['medico_t_otro'];
		if ($medico_t_otro != '') {
			$INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_listas(MEDICO,ESTADO)VALUES('" . $medico_t_otro . "','OUT')");
			require('../presentacion/email/mail_habilitar_medico.php');
		}
	}

	$medico_p = $_POST['medico_prescriptor'];
	if ($medico_p == 'NO ENCONTRADO') {
		$medico_p_otro = $_POST['medico_p_otro'];
		if ($medico_p_otro != '') {
			$INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_listas(MEDICO,ESTADO)VALUES('" . $medico_p_otro . "','OUT')");
			require('../presentacion/email/mail_habilitar_medico_p.php');
		}
	}

	$punto_entrega = $_POST['punto_entrega'];
	if ($punto_entrega == 'NO ENCONTRADO') {
		$punto_entrega_otro = $_POST['punto_entrega_otro'];
		if ($punto_entrega_otro != ''){
			$INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_puntos_entrega(NOMBRE_PUNTO,ESTADO)VALUES('" . $punto_entrega_otro . "','OUT')");
			require('../presentacion/email/mail_habilitar_punto.php');
		}
	} 

	$fecha_prescripcion = $_POST['fecha_prescripcion'];
	$num1 = $_POST['num1'];
	if ($num1 > 0) {
		$codigo_ultima_gestion = $_POST['codigo_ultima_gestion'];
		$estado_ctc = $_POST['estado_ctc'];
		if (isset($_POST['dificultad_acceso'])) {
			$dificultad_acceso = $_POST['dificultad_acceso'];
		} else {
			$dificultad_acceso = '';
		}
		$tipo_dificultad = $_POST['tipo_dificultad'];
		if ($_POST['estado_farmacia'] == 'Otro') {
			$estado_farmacia = $_POST['estado_farmacia_nuevo'];
			$INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_listas(MEDICO)VALUES('" . $estado_farmacia . "')");
			echo mysqli_error($conex);
		} else {
			$estado_farmacia = $_POST['estado_farmacia'];
		}
		$reclamo = $_POST['reclamo'];
		if ($fecha_reclamacion == '') {
			$fecha_reclamacion = $_POST['fecha_reclamaciones'];
			$fecha_ultima_reclamacion = $_POST['fecha_reclamaciones'];
		}
		if ($reclamo == 'NO') {
			$fecha_reclamacion = '';
			$fecha_actual = date('Y-m-d');
			$fecha_rec_act = explode("-", $fecha_actual);
			$anio_act =  $fecha_rec_act[0];
			$mes_act  =  $fecha_rec_act[1];
			$dia_act  =  $fecha_rec_act[2];
			$dato = ((int)$mes_act);
			$fecha_ultima_reclamacion = $_POST['fecha_reclamaciones'];
			if (isset($_POST['causa_no_reclamacion'])) {
				$causa_no_reclamacion = $_POST['causa_no_reclamacion'];
			} else {
				$causa_no_reclamacion = '';
			}
		}
		$fecha_medicamento_hasta = $_POST['fecha_medicamento_hasta'];
		if ($reclamo == 'SI') {
			$consecutivo_betaferon = $_POST['consecutivo_betaferon'];
			$causa_no_reclamacion = '';
			$fecha_actual = date('Y-m-d');
			$fecha_reclamacion = $_POST['fecha_reclamacion'];
			$fecha_rec = explode("-", $fecha_reclamacion);
			$anio = $fecha_rec[0];
			$mes  = $fecha_rec[1];
			$dia  = $fecha_rec[2];
			$fecha_actual = date('Y-m-d');
			$fecha_rec_act = explode("-", $fecha_actual);
			$mes_act = $fecha_rec_act[1];
			$dato = ((int)$mes);
		} else {
			$consecutivo_betaferon = '';
			$fecha_reclamacion = '';
			$fecha_actual = date('Y-m-d');
			$fecha_rec_act = explode("-", $fecha_actual);
			$anio_act = $fecha_rec_act[0];
			$mes_act  = $fecha_rec_act[1];
			$dia_act  = $fecha_rec_act[2];
			$dato = ((int)$mes_act);
			$fecha_ultima_reclamacion = $_POST['fecha_reclamaciones'];
			if (isset($_POST['causa_no_reclamacion'])) {
				$causa_no_reclamacion = $_POST['causa_no_reclamacion'];
			} else {
				$causa_no_reclamacion = '';
			}
		}
		$descripcion_comunicacion = $_POST['descripcion_comunicacion'];
	} else {
		$fecha_reclamacion = $_POST['fecha_reclamaciones'];
	}
	$MEDICAMENTO = $_POST['MEDICAMENTO'];
	if ($MEDICAMENTO == 'Xofigo 1x6 ml CO') {
		$dosis = $_POST['Dosis2'];
	}
	if ($MEDICAMENTO == 'Kovaltry') {
		$dosis = $_POST['Dosis2'];
	}
	if ($MEDICAMENTO == 'Jivi') {
		$dosis = $_POST['Dosis2'];
	}
	if ($MEDICAMENTO == 'KOGENATE FS 2000 PLAN') {
		$dosis = $_POST['Dosis3'];
	}
	if ($MEDICAMENTO != 'Xofigo 1x6 ml CO' && $MEDICAMENTO != 'KOGENATE FS 2000 PLAN' && $MEDICAMENTO != 'Kovaltry' && $MEDICAMENTO != 'Jivi') {
		$dosis = $_POST['Dosis'];
	}
	if (isset($_POST['registrar'])) {
		$select_historial = mysqli_query($conex, "SELECT * FROM ipsen_historial_reclamacion WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
		echo mysqli_error($conex);
		$reg_hist = mysqli_num_rows($select_historial);
		if ($reg_hist > 0) {
			if ($reclamo == 'SI') {
				$UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE ipsen_historial_reclamacion SET  RECLAMO$dato='" . $reclamo . "',FECHA_RECLAMACION$dato='" . $fecha_reclamacion . "',MOTIVO_NO_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "' AND MES$dato='" . $mes . "'");
				echo mysqli_error($conex);
			}
			if ($reclamo == 'NO') {
				$UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE ipsen_historial_reclamacion SET  RECLAMO$dato='" . $reclamo . "',MOTIVO_NO_RECLAMACION$dato='" . $causa_no_reclamacion . "',FECHA_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "' AND MES$dato='" . $mes_act . "'");
				echo mysqli_error($conex);
			}
		} else {
			$INSERT_HISTORIAL = mysqli_query($conex, "INSERT INTO ipsen_historial_reclamacion(ID_PACIENTE_FK) VALUES('" . $codigo_usuario2 . "')");
			echo mysqli_error($conex);
			if ($reclamo == 'SI') {
				$UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE ipsen_historial_reclamacion SET  RECLAMO$dato='" . $reclamo . "',FECHA_RECLAMACION$dato='" . $fecha_reclamacion . "',MOTIVO_NO_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "' AND MES$dato='" . $mes_act . "'");
				echo mysqli_error($conex);
			}
			if ($reclamo == 'NO') {
				$UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE ipsen_historial_reclamacion SET  RECLAMO$dato='" . $reclamo . "',MOTIVO_NO_RECLAMACION$dato='" . $causa_no_reclamacion . "',FECHA_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "' AND MES$dato='" . $mes_act . "'");
				echo mysqli_error($conex);
			}
		}
		$sql = mysqli_query($conex, "UPDATE ipsen_pacientes SET ESTADO_PACIENTE='" . $estado_paciente . "', STATUS_PACIENTE='" . $status_paciente . "', FECHA_ACTIVACION_PACIENTE='" . $fecha_activacion . "', FECHA_RETIRO_PACIENTE='" . $fecha_retiro . "', MOTIVO_RETIRO_PACIENTE='" . $motivo_retiro . "', OBSERVACION_MOTIVO_RETIRO_PACIENTE='" . $observacion_retiro . "',IDENTIFICACION_PACIENTE='" . $identificacion . "', NOMBRE_PACIENTE='" . $nombre . "', APELLIDO_PACIENTE='" . $apellidos . "', TELEFONO_PACIENTE='" . $telefono1 . "', TELEFONO2_PACIENTE='" . $telefono2 . "', TELEFONO3_PACIENTE='" . $telefono3 . "',TELEFONO4_PACIENTE='" . $telefono4 . "', TELEFONO5_PACIENTE='" . $telefono5 . "', CORREO_PACIENTE='" . $correo . "', DIRECCION_PACIENTE='" . $direccion . "', BARRIO_PACIENTE='" . $barrio . "', DEPARTAMENTO_PACIENTE='" . $departamento . "',CIUDAD_PACIENTE='" . $ciudad . "',FECHA_NACIMINETO_PACIENTE='" . $fecha_nacimiento . "',EDAD_PACIENTE='" . $edad . "', ACUDIENTE_PACIENTE='" . $acudiente . "', TELEFONO_ACUDIENTE_PACIENTE='" . $telefono_acudiente . "' WHERE ID_PACIENTE='" . $codigo_usuario2 . "'");
		echo mysqli_error($conex);
		$sql = mysqli_query($conex, "UPDATE ipsen_tratamiento SET  TRATAMIENTO_PREVIO='" . $tratamiento_previo . "',CLASIFICACION_PATOLOGICA_TRATAMIENTO='" . $clasificacion_patologica . "', FECHA_INICIO_TERAPIA_TRATAMIENTO='" . $fecha_ini_terapia . "', FECHA_PRESCRIPCION='" . $fecha_prescripcion . "' ,ASEGURADOR_TRATAMIENTO='" . $asegurador . "', OPERADOR_LOGISTICO_TRATAMIENTO='" . $operador_logistico . "',FECHA_ULTIMA_RECLAMACION_TRATAMIENTO='" . $fecha_reclamacion . "',PUNTO_ENTREGA='" . $punto_entrega . "',MEDICO_TRATAMIENTO='" . $medico_t . "',MEDICO_PRESCRIPTOR='" . $medico_p . "',IPS_ATIENDE_TRATAMIENTO='" . $ips_atiende . "',DOSIS_TRATAMIENTO='" . $dosis . "' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
		echo mysqli_error($conex);
		if ($num1 > 0) {
			$sql = mysqli_query($conex, "UPDATE ipsen_gestiones SET ESTADO_CTC_GESTION='" . $estado_ctc . "',FECHA_AUTORIZACION='" . $fecha_autorizacion . "',ESTADO_FARMACIA_GESTION='" . $estado_farmacia . "',RECLAMO_GESTION='" . $reclamo . "',CONSECUTIVO_BETAFERON='" . $consecutivo_betaferon . "',CAUSA_NO_RECLAMACION_GESTION='" . $causa_no_reclamacion . "',DIFICULTAD_ACCESO_GESTION='" . $dificultad_acceso . "',TIPO_DIFICULTAD_GESTION='" . $tipo_dificultad . "',MEDICAMENTOS_GESTION='" . $MEDICAMENTO . "',FECHA_PROXIMA_LLAMADA='" . $fecha_proxima_llamada . "',FECHA_RECLAMACION_GESTION='" . $fecha_reclamacion . "',DESCRIPCION_COMUNICACION_GESTION='" . $descripcion_comunicacion . "',FECHA_PROGRAMADA_GESTION='" . $fecha_proxima_llamada . "', ID_PACIENTE_FK2='" . $codigo_usuario2 . "', AUTOR_MODIFICACION='" . $usua . "' WHERE ID_GESTION='" . $codigo_ultima_gestion . "'");
			echo mysqli_error($conex);
		}
		$descripcion_nuevo_comunicacion = $_POST['descripcion_nuevo_comunicacion'];
		$insert_gestion = mysqli_query($conex, "INSERT INTO ipsen_gestiones (MOTIVO_COMUNICACION_GESTION,ESTADO_CTC_GESTION,FECHA_AUTORIZACION,RECLAMO_GESTION,CAUSA_NO_RECLAMACION_GESTION,FECHA_PROXIMA_LLAMADA,FECHA_RECLAMACION_GESTION,FECHA_MEDICAMENTO_HASTA,AUTOR_GESTION,NOTA,DESCRIPCION_COMUNICACION_GESTION,FECHA_PROGRAMADA_GESTION,ID_PACIENTE_FK2,FECHA_COMUNICACION)VALUES('GESTION COORDINADOR', '" . $estado_ctc . "','" . $fecha_autorizacion . "','" . $reclamo . "','" . $causa_no_reclamacion . "','" . $fecha_proxima_llamada . "','" . $fecha_reclamacion . "','" . $fecha_medicamento_hasta . "','" . $usua . "','GESTION COORDINADOR','" . $descripcion_nuevo_comunicacion . "','" . $fecha_proxima_llamada . "','" . $codigo_usuario2 . "',CURRENT_TIMESTAMP)");
		if ($sql) {
	?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3" style=" width:68.9%; margin:auto auto;">SE ACTUALIZARON LOS DATOS SATISFACTORIAMENTE.</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/form_paciente_seguimiento.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
			</center>
			<br />
		<?php
		} else {
		?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia2.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">NO SE HAN ACTUALIZADO LOS DATOS.</p>
			<br />
			<br />
			<center>
				<a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
			</center>
			<br />
	<?php
		}
	}
