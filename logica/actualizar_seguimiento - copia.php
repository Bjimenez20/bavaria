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
			color: #fb8305;
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
	$codigo_usuario = $_POST['codigo_usuario'];
	$estado_paciente = $_POST['estado_paciente'];
	$status_paciente = $_POST['status_paciente'];
	$fecha_activacion = $_POST['fecha_activacion'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$identificacion = $_POST['identificacion'];
	$telefono1 = $_POST['telefono1'];
	$telefono2 = $_POST['telefono2'];
	$telefono3 = $_POST['telefono3'];
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

	if ($_POST['operador_logistico'] == 'Otro') {
		$operador_logistico = $_POST['operador_logistico_nuevo'];

		$INSERT_OPERADOR_LOGISTICO = mysqli_query($conex, "INSERT INTO ipsen_listas(OPERADOR_LOGISTICO)VALUES('" . $operador_logistico . "')");
		echo mysqli_error($conex);
	} else {
		$operador_logistico = $_POST['operador_logistico'];
	}
	$punto_entrega = $_POST['punto_entrega'];



	$motivo_comunicacion = $_POST['motivo_comunicacion'];
	$medio_contacto = $_POST['medio_contacto'];
	$tipo_llamada = $_POST['tipo_llamada'];

	if (isset($_POST['logro_comunicacion'])) {
		$logro_comunicacion = $_POST['logro_comunicacion'];
	} else {
		$logro_comunicacion = '';
	}

	$motivo_no_comunicacion = $_POST['motivo_no_comunicacion'];
	$via_recepcion = $_POST['via_recepcion'];
	$asegurador = $_POST['asegurador'];
	$ips_atiende = $_POST['ips_atiende'];
	$medico = $_POST['medico'];

	$estado_ctc = $_POST['estado_ctc'];

	if (isset($_POST['dificultad_acceso'])) {
		$dificultad_acceso = $_POST['dificultad_acceso'];
	} else {
		$dificultad_acceso = '';
	}

	$tipo_dificultad = $_POST['tipo_dificultad'];

	if (isset($_POST['envios'])) {
		$envios = $_POST['envios'];
	} else {
		$envios = '';
	}

	$MEDICAMENTO = $_POST['MEDICAMENTO'];
	if ($MEDICAMENTO == 'Xofigo 1x6 ml CO' || $MEDICAMENTO == 'KOGENATE FS 2000 PLAN') {
		$dosis = $_POST['Dosis2'];
	}
	if ($MEDICAMENTO != 'Xofigo 1x6 ml CO' && $MEDICAMENTO != 'KOGENATE FS 2000 PLAN') {
		$dosis = $_POST['Dosis'];
	}
	$tipo_envio = $_POST['tipo_envio'];

	if (isset($_POST['evento_adverso'])) {
		$evento_adverso = $_POST['evento_adverso'];
	} else {
		$evento_adverso = '';
	}

	$tipo_evento_adverso = $_POST['tipo_evento_adverso'];

	if (isset($_POST['genera_solicitud'])) {
		$genera_solicitud = $_POST['genera_solicitud'];
	} else {
		$genera_solicitud = '';
	}

	$fecha_proxima_llamada = $_POST['fecha_proxima_llamada'];
	$motivo_proxima_llamada = $_POST['motivo_proxima_llamada'];
	$observacion_proxima_llamada = $_POST['observacion_proxima_llamada'];
	$fecha_reclamacion = $_POST['fecha_reclamacion'];
	$consecutivo = $_POST['consecutivo'];
	$numero_cajas = $_POST['numero_cajas'];


	$estado_farmacia = $_POST['estado_farmacia'];
	$reclamo = $_POST['reclamo'];
	$consecutivo_betaferon = $_POST['consecutivo_betaferon'];

	if (isset($_POST['causa_no_reclamacion'])) {
		$causa_no_reclamacion = $_POST['causa_no_reclamacion'];
	} else {
		$causa_no_reclamacion = 'NO APLICA';
	}
	$autor = $_POST['autor'];
	$descripcion_comunicacion = $_POST['descripcion_comunicacion'];
	$nota = $_POST['nota'];

	if (isset($_POST['registrar'])) {
		$tipo_envio = $_POST['tipo_envio'];
		if ($tipo_envio != '') {
			$SELECT_ID_INV = mysqli_query($conex, "select ID_INVENTARIO from ipsen_inventario WHERE LUGAR_MATERIAL='BODEGA' AND ID_REFERENCIA_FK='" . $tipo_envio . "' ORDER BY ID_INVENTARIO ASC LIMIT 1");
			echo mysqli_error($conex);
			while ($fila1 = mysqli_fetch_array($SELECT_ID_INV)) {
				$ID_ULT_INV = $fila1['ID_INVENTARIO'];
			}
			$UPDATE_INVENTARIO = mysqli_query($conex, "UPDATE ipsen_inventario SET LUGAR_MATERIAL='" . $codigo_usuario2 . "' WHERE ID_INVENTARIO='" . $ID_ULT_INV . "'");
			echo mysqli_error($conex);


			$INSERT_MOVIMIENTO = mysqli_query($conex, "INSERT INTO ipsen_movimientos(TIPO_MOVIMIENTO, NO_REMICION, CANTIDAD, RESPONSABLE, DESTINATARIO, DIRECCION_DESTINATARIO, CIUDAD_ENVIO, FECHA_MOVIMIENTO, OBSERVACIONES, ESTADO_MOVIMIENTO, ID_INVENTARIO_FK) VALUES('2', '', '1', '" . $usua . "', '" . $nombre . ' ' . $apellidos . "', '" . $direccion . "', '" . $ciudad . "', CURRENT_TIMESTAMP, 'ENVIO PRODUCTO(S)', 'EN PROCESO', '" . $ID_ULT_INV . "')");
			echo mysqli_error($conex);
			$SELECT_CANTIDAD = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA = '" . $tipo_envio . "'");
			echo mysqli_error($conex);

			while ($fila1 = mysqli_fetch_array($SELECT_CANTIDAD)) {
				$CANTIDAD_I = $fila1['CANTIDAD'];
			}
			$TOTAL = $CANTIDAD_I - 1;

			$UPDATE_REFERENCIA = mysqli_query($conex, "UPDATE ipsen_referencia SET CANTIDAD='" . $TOTAL . "' WHERE ID_REFERENCIA='" . $tipo_envio . "'");
			echo mysqli_error($conex);


			$SELECT_ID_MOVIMIENTO = mysqli_query($conex, "SELECT ID_MOVIMIENTOS FROM ipsen_movimientos WHERE DESTINATARIO='" . $nombre . ' ' . $apellidos . "' AND TIPO_MOVIMIENTO='2' ORDER BY ID_MOVIMIENTOS DESC LIMIT 1");
			echo mysqli_error($conex);
			while ($fila_mov = mysqli_fetch_array($SELECT_ID_MOVIMIENTO)) {
				$ID_ULT_MOVIMIENTO = $fila_mov['ID_MOVIMIENTOS'];
			}

			$INSERT_MOVIMIENTO_PACIENTE = mysqli_query($conex, "INSERT INTO ipsen_paciente_movimientos(ID_PACIENTE_FK,ID_MOVIMIENTOS_FK,
ESTADO_PACIENTE_MOVIMIENTO)VALUES('" . $codigo_usuario2 . "','" . $ID_ULT_MOVIMIENTO . "','EN PROCESO')");
			echo mysqli_error($conex);

			$INSERT_MOVIMIENTO_USUARIO = mysqli_query($conex, "INSERT INTO usuario_movimientos(ID_USUARIO_FK,ID_MOVIMIENTOS_FK)VALUES('" . $id_usu . "','" . $ID_ULT_MOVIMIENTO . "')");
			echo mysqli_error($conex);
		}

		$sql = mysqli_query($conex, "UPDATE ipsen_gestiones 
	SET ESTADO_GESTION='GESTIONADO'
	WHERE ID_GESTION='" . $codigo_gestion . "'");
		echo mysqli_error($conex);
		if ($logro_comunicacion = 'SI') {
			$sql = mysqli_query($conex, "UPDATE ipsen_pacientes SET ESTADO_PACIENTE='" . $estado_paciente . "', STATUS_PACIENTE='" . $status_paciente . "', FECHA_ACTIVACION_PACIENTE='" . $fecha_activacion . "', FECHA_RETIRO_PACIENTE='" . $fecha_retiro . "', MOTIVO_RETIRO_PACIENTE='" . $motivo_retiro . "', OBSERVACION_MOTIVO_RETIRO_PACIENTE='" . $observacion_retiro . "', TELEFONO_PACIENTE='" . $telefono1 . "', TELEFONO2_PACIENTE='" . $telefono2 . "', TELEFONO3_PACIENTE='" . $telefono3 . "', CORREO_PACIENTE='" . $correo . "', DIRECCION_PACIENTE='" . $direccion . "', BARRIO_PACIENTE='" . $barrio . "', DEPARTAMENTO_PACIENTE='" . $departamento . "',CIUDAD_PACIENTE='" . $ciudad . "',FECHA_NACIMINETO_PACIENTE='" . $fecha_nacimiento . "',EDAD_PACIENTE='" . $edad . "' WHERE ID_PACIENTE='" . $codigo_usuario2 . "'");
			echo mysqli_error($conex);

			$sql = mysqli_query($conex, "UPDATE ipsen_tratamiento SET ASEGURADOR_TRATAMIENTO='" . $asegurador . "', OPERADOR_LOGISTICO_TRATAMIENTO='" . $operador_logistico . "',FECHA_ULTIMA_RECLAMACION_TRATAMIENTO='" . $fecha_reclamacion . "',PUNTO_ENTREGA='" . $punto_entrega . "',MEDICO_TRATAMIENTO='" . $medico . "',IPS_ATIENDE_TRATAMIENTO='" . $ips_atiende . "',DOSIS_TRATAMIENTO='" . $dosis . "' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
			echo mysqli_error($conex);
		}
		$sql = mysqli_query($conex, "INSERT INTO ipsen_gestiones (MOTIVO_COMUNICACION_GESTION,MEDIO_CONTACTO_GESTION,TIPO_LLAMADA_GESTION,LOGRO_COMUNICACION_GESTION,MOTIVO_NO_COMUNICACION_GESTION,NUMERO_INTENTOS_GESTION,ESTADO_CTC_GESTION,ESTADO_FARMACIA_GESTION,RECLAMO_GESTION,CONSECUTIVO_BETAFERON,CAUSA_NO_RECLAMACION_GESTION,DIFICULTAD_ACCESO_GESTION,TIPO_DIFICULTAD_GESTION,ENVIOS_GESTION,MEDICAMENTOS_GESTION,TIPO_ENVIO_GESTION,EVENTO_ADVERSO_GESTION,TIPO_EVENTO_ADVERSO,GENERA_SOLICITUD_GESTION,FECHA_PROXIMA_LLAMADA,MOTIVO_PROXIMA_LLAMADA,OBSERVACION_PROXIMA_LLAMADA,FECHA_RECLAMACION_GESTION,NUMERO_CAJAS,CONSECUTIVO_GESTION,AUTOR_GESTION,NOTA,DESCRIPCION_COMUNICACION_GESTION,FECHA_PROGRAMADA_GESTION,USUARIO_ASIGANDO,ID_PACIENTE_FK2,FECHA_COMUNICACION)VALUES('" . $motivo_comunicacion . "','" . $medio_contacto . "','" . $tipo_llamada . "','" . $logro_comunicacion . "','" . $motivo_no_comunicacion . "','" . $via_recepcion . "','" . $estado_ctc . "','" . $estado_farmacia . "','" . $reclamo . "','" . $consecutivo_betaferon . "','" . $causa_no_reclamacion . "','" . $dificultad_acceso . "','" . $tipo_dificultad . "','" . $envios . "','" . $MEDICAMENTO . "','" . $tipo_envio . "','" . $evento_adverso . "','" . $tipo_evento_adverso . "','" . $genera_solicitud . "','" . $fecha_proxima_llamada . "','" . $motivo_proxima_llamada . "','" . $observacion_proxima_llamada . "','" . $fecha_reclamacion . "','" . $numero_cajas . "','" . $consecutivo . "','" . $autor . "','" . $nota . "','" . $descripcion_comunicacion . "','" . $fecha_proxima_llamada . "','SIN ASIGNAR','" . $codigo_usuario2 . "',CURRENT_TIMESTAMP)");
		echo mysqli_error($conex);
		$select_gestion = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2='" . $codigo_usuario2 . "' ORDER BY ID_GESTION DESC LIMIT 1");
		while ($datos_gestion = mysqli_fetch_array($select_gestion)) {
			$ID_ULTIMA_GESTION = $datos_gestion['ID_GESTION'];
		}
		$update_codigo_gestion = mysqli_query($conex, "UPDATE ipsen_pacientes SET ID_ULTIMA_GESTION='" . $ID_ULTIMA_GESTION . "' 
WHERE ID_PACIENTE='" . $codigo_usuario2 . "'");
		echo mysqli_error($conex);

		if ($_FILES['archivo']["error"] > 0) {
		} else {
			$SELECT_GES = mysqli_query($conex, "SELECT ID_GESTION FROM ipsen_gestiones ORDER BY ID_GESTION DESC LIMIT 1");

			while ($fila2 = mysqli_fetch_array($SELECT_GES)) {
				$ID_GES = $fila2['ID_GESTION'];
			}

			$CARPETA = "../ADJUNTOS_IPSEN/$ID_GES";

			if (!is_dir($CARPETA)) {
				mkdir("../ADJUNTOS_IPSEN/$ID_GES", 0777);
			}

			move_uploaded_file($_FILES['archivo']['tmp_name'], "../ADJUNTOS_IPSEN/$ID_GES/" . $_FILES['archivo']['name']);
		}

		if ($sql) {
			if ($evento_adverso == 'SI') {
				require('../presentacion/form_evento_adverso.php');
			}
			if ($evento_adverso != 'SI') {
	?>
				<span style="margin-top:5%;">
					<center>
						<img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
					</center>
				</span>
				<p class="aviso3" style=" width:68.9%; margin:auto auto;">EL SEGUMIENTO HA SIDO INGRESADO SATISFACTORIAMENTE.</p>
				<br />
				<br />
				<center>
					<a href="../presentacion/form_paciente_seguimiento.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
				</center>
				<br />
			<?php
			}
		} else {
			?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">EL SEGUIMIENTO NO HA SIDO INGRESADO SATISFACTORIAMENTE.</p>
			<br />
			<br />
			<center>
				<a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
			</center>
			<br />
	<?php
		}
	}
