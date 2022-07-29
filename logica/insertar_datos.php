<?php
header("Content-Type: text/html;charset=utf-8");
require_once('session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
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

		.btn_continuar {
			padding-top: 7px;
			width: 152px;
			height: 37px;
			color: transparent;
			background-color: transparent;
			border-radius: 5px;
			border: 1px solid transparent;
		}

		.btn_continuar:active {
			box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
			box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
				inset 0px 0px 20px #EEECEC;
		}

		.btn_continuar:hover {
			box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
			box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
				inset 0px 0px 20px #EEECEC;
		}
	</style>
</head>

<body>
	<?PHP
    require('../datos/parse_str.php');
	require_once("../datos/conex.php");
	mysqli_query($conex, "SET NAMES utf8");
	if (isset($_POST['registrar'])) {
		$identificacion = $_POST['identificacion'];
		$tipo_identificacion = $_POST['tipo_identificacion'];
		$numero_registros = mysqli_query($conex, "SELECT * FROM bayer_pacientes WHERE IDENTIFICACION_PACIENTE='$identificacion'");
		echo mysqli_error($conex);
		$coincidencias = mysqli_num_rows($numero_registros);
		$reclamo = $_POST['reclamo'];
		$consecutivo_betaferon = $_POST['consecutivo_betaferon'];
		$codigo_xofigo = $_POST['codigo_xofigo'];
		$num_lotes_dis = $_POST['num_lotes_dis'];
		$codigo_usuario2 = $_POST['codigo_usuario2'];
		$causa_no_reclamacion = $_POST['causa_no_reclamacion'];
		$fecha_no_reclamacion = $_POST['fecha_no_reclamacion'];
		if ($reclamo == 'SI') {
			$fecha_actual = date('Y-m-d');
			$fecha_reclamacion = $_POST['fecha_reclamacion'];
			$fecha_rec = explode("-", $fecha_reclamacion);
			$anio = $fecha_rec[0];
			$mes = $fecha_rec[1];
			$dia = $fecha_rec[2];
			$fecha_actual = date('Y-m-d');
			$fecha_rec_act = explode("-", $fecha_actual);
			$mes_act = $fecha_rec_act[1];
			$dato = ((int)$mes);
			$numero_cajas = $_POST['numero_cajas'] . ' ' . $_POST['tipo_numero_cajas'];
		}
		if ($fecha_reclamacion == '') {
			$fecha_reclamacion = '';
			$fecha_ultima_reclamacion = '';
		}
		if ($reclamo == 'NO') {
			$fecha_reclamacion = '';
			$fecha_no_reclamacion = $_POST['fecha_no_reclamacion'];
			$fecha_actual = date('Y-m-d');
			$fecha_rec_act = explode("-", $fecha_actual);
			$anio_act = $fecha_rec_act[0];
			$mes_act = $fecha_rec_act[1];
			$dia_act = $fecha_rec_act[2];
			$dato = ((int)$mes_act);
			$fecha_ultima_reclamacion = '';
			if (isset($_POST['causa_no_reclamacion'])) {
				$causa_no_reclamacion = $_POST['causa_no_reclamacion'];
			} else {
				$causa_no_reclamacion = '';
			}
			$numero_cajas = '0 Aplicacion';
		}
		$select_historial = mysqli_query($conex, "SELECT * FROM bayer_historial_reclamacion WHERE ID_PACIENTE_FK='$codigo_usuario2'");
		echo mysqli_error($conex);
		$reg_hist = mysqli_num_rows($select_historial);
		if ($reg_hist > 0) {
			if ($reclamo == 'SI') {
				$UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE bayer_historial_reclamacion SET  RECLAMO$dato='" . $reclamo . "',FECHA_RECLAMACION$dato='" . $fecha_reclamacion . "',MOTIVO_NO_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "' AND MES$dato='" . $mes . "'");
				echo mysqli_error($conex);
			}
			if ($reclamo == 'NO') {
				$UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE bayer_historial_reclamacion SET  RECLAMO$dato='" . $reclamo . "',MOTIVO_NO_RECLAMACION$dato='" . $causa_no_reclamacion . "',FECHA_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "' AND MES$dato='" . $mes . "'");
				echo mysqli_error($conex);
			}
		} else {
			$INSERT_HISTORIAL = mysqli_query($conex, "INSERT INTO bayer_historial_reclamacion(ID_PACIENTE_FK) VALUES('" . $codigo_usuario2 . "')");
			echo mysqli_error($conex);
			if ($reclamo == 'SI') {
				$UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE bayer_historial_reclamacion SET  RECLAMO$dato='" . $reclamo . "',FECHA_RECLAMACION$dato='" . $fecha_reclamacion . "',MOTIVO_NO_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "' AND MES$dato='" . $mes . "'");
				echo mysqli_error($conex);
			}
			if ($reclamo == 'NO') {
				$UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE bayer_historial_reclamacion SET  RECLAMO$dato='" . $reclamo . "',MOTIVO_NO_RECLAMACION$dato='" . $causa_no_reclamacion . "',FECHA_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "' AND MES$dato='" . $mes_act . "'");
				echo mysqli_error($conex);
			}
		}
		$status_paciente = $_POST['status_paciente'];
		$fecha_activacion = $_POST['fecha_activacion'];
		$nombre = $_POST['nombre'];
		$telefono2 = $_POST['telefono2'];
		$apellidos = $_POST['apellidos'];
		$telefono1 = $_POST['telefono1'];
		$telefono3 = $_POST['telefono3'];
		$telefono4 = $_POST['telefono4'];
		$telefono5 = $_POST['telefono5'];
		$proveedor = $_POST['proveedor_psp'];
		$correo = $_POST['correo'];
		$direccion = $_POST['DIRECCION'];
		$barrio = $_POST['barrio'];
		$departamento = $_POST['departamento'];
		$ciudad = $_POST['ciudad'];
		$genero = $_POST['genero'];
		$fecha_nacimiento = $_POST['fecha_nacimiento'];
		$edad = $_POST['edad'];
		$acudiente = $_POST['acudiente'];
		$telefono_acudiente = $_POST['telefono_acudiente'];
		$producto_tratamiento = $_POST['producto_tratamiento'];
		if ($producto_tratamiento == 'Xofigo 1x6 ml CO') {
			$dosis = $_POST['Dosis2'];
		}
		if ($producto_tratamiento == 'Kovaltry') {
			$dosis = $_POST['Dosis2'];
		}
		if ($producto_tratamiento == 'Jivi') {
			$dosis = $_POST['Dosis2'];
		}
		if ($producto_tratamiento == 'KOGENATE FS 2000 PLAN') {
			$dosis = $_POST['Dosis3'];
		}
		if ($producto_tratamiento != 'Xofigo 1x6 ml CO' && $producto_tratamiento != 'KOGENATE FS 2000 PLAN' && $producto_tratamiento != 'Kovaltry' && $producto_tratamiento != 'Jivi') {
			$dosis = $_POST['Dosis'];
		}
		if ($_POST['tratamiento_previo'] == 'Otro') {
			$tratamiento_previo = $_POST['tratamiento_previo_otro'];
		} else {
			$tratamiento_previo = $_POST['tratamiento_previo'];
		}
		if ($_POST['ips_atiende'] == 'NO ENCONTRADO') {
			$ips_atiende  = $_POST['ips_otro'];
			$insert_ips = mysqli_query($conex, "INSERT INTO bayer_ips (`IPS`,`ESTADO`) VALUES ('" . $ips_atiende . "','OUT')");
			require('../presentacion/email/mail_habilitar_ips.php');
		} else {
			$ips_atiende  = $_POST['ips_atiende'];
		}
		if ($_POST['operador_logistico'] == 'NO ENCONTRADO') {
			$operador_logistico = $_POST['operador_otro'];
			$insert_opl = mysqli_query($conex, "INSERT INTO bayer_operador_logistico (`OPERADOR_LOGISTICO`,`ESTADO`) VALUES ('" . $operador_logistico . "','OUT')");
			require('../presentacion/email/mail_habilitar_operador.php');
		} else {
			$operador_logistico = $_POST['operador_logistico'];
		}
		if ($_POST['asegurador'] == 'NO ENCONTRADO') {
			$asegurador = $_POST['asegurador_otro'];
			$insert_eps = mysqli_query($conex, "INSERT INTO bayer_asegurador (`ASEGURADOR`,`ESTADO`) VALUES ('" . $asegurador . "','OUT')");
			require('../presentacion/email/mail_habilitar_eps.php');
		} else {
			$asegurador = $_POST['asegurador'];
		}
		if ($_POST['medico_tratante'] == 'NO ENCONTRADO') {
			$medico_t  = $_POST['medico_t_otro'];
			$INSERT_MEDICO = mysqli_query($conex, "INSERT INTO bayer_listas(MEDICO,ESTADO)VALUES('" . $medico_t . "','OUT')");
			require('../presentacion/email/mail_habilitar_medico.php');
		} else {
			$medico_t  = $_POST['medico_tratante'];
		}
		if ($_POST['medico_prescriptor'] == 'NO ENCONTRADO') {
			$medico_p  = $_POST['medico_p_otro'];
			$INSERT_MEDICO = mysqli_query($conex, "INSERT INTO bayer_listas(MEDICO,ESTADO)VALUES('" . $medico_p . "','OUT')");
			require('../presentacion/email/mail_habilitar_medico_p.php');
		} else {
			$medico_p  = $_POST['medico_prescriptor'];
		}
		if ($_POST['punto_entrega'] == 'NO ENCONTRADO') {
			$punto_entrega  = $_POST['punto_entrega_otro'];
			$INSERT_MEDICO = mysqli_query($conex, "INSERT INTO bayer_puntos_entrega(NOMBRE_PUNTO,ESTADO)VALUES('" . $punto_entrega . "','OUT')");
			require('../presentacion/email/mail_habilitar_punto.php');
		} else {
			$punto_entrega  = $_POST['punto_entrega'];
		}
		$fecha_prescripcion = $_POST['fecha_prescripcion'];
		$especialidad = $_POST['especialidad'];
		$paramedico_representante = $_POST['paramedico_representante'];
		$zona_atencion = $_POST['zona_atencion'];
		$ciudad_base = $_POST['ciudad_base'];
		if ($producto_tratamiento == 'VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM') {
			$numero_nebulizaciones = $_POST['nebulizaciones'];
		}
		if ($producto_tratamiento != 'VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM') {
			$numero_nebulizaciones = '';
		}
		$nota = $_POST['nota'];
		$clasificacion_patologica = $_POST['clasificacion_patologica'];
		$consentimiento = $_POST['consentimiento'];
		$regimen = $_POST['regimen'];
		$fecha_inicio_trt = $_POST['fecha_inicio_trt'];
		$fecha_ultima_reclamacion = $_POST['fecha_ultima_reclamacion'];
		$otro_operadores = $_POST['otro_operadores'];
		$medio_adquision = $_POST['medio_adquision'];
		$brindo_apoyo = $_POST['brindo_apoyo'];
		if ($_POST['paap'] == '') {
			$paap = 'N/A';
			$sub_paap = 'N/A';
			$sub_barrera = 'N/A';
		} else {
			$paap = $_POST['paap'];
			if ($paap == 'SI') {
				$sub_paap = $_POST['sub_paap'];
				if ($sub_paap == 'Con barrera') {
					$sub_barrera = $_POST['sub_barrera'];
				}
				if ($sub_paap == 'Sin barrera') {
					$sub_barrera = 'N/A';
				}
			}
			if ($paap == 'NO') {
				$sub_paap = 'N/A';
				$sub_barrera = 'N/A';
			}
		}
		if ($producto_tratamiento == 'Eylia 2MG VL 1x2ML CO INST')
			$INFORMACION_APLICACIONES = $_POST['aplicaicones'];
		else $INFORMACION_APLICACIONES = 'NO';
		$fecha_proxima_llamada = $_POST['fecha_proxima_llamada'];
		$numero_tabletas_diarias = $_POST['numero_tabletas_diarias'];
		if ($producto_tratamiento == 'Xofigo 1x6 ml CO' || $producto_tratamiento == 'NUBEQA' || $producto_tratamiento == 'STIVARGA - regorafenib') {
			$CODIGO_XOFIGO = $codigo_xofigo;
		} else if ($producto_tratamiento == 'BETAFERON CMBP X 15 VPFS (3750 MCG) MM') {
			$CODIGO_XOFIGO = $codigo_xofigo;
		} else {
			$CODIGO_XOFIGO = 0;
		}
		// if ($causa_no_reclamacion == 'En proceso de Examenes' || $causa_no_reclamacion == 'Falta cita para examenes' || $causa_no_reclamacion == 'Hospitalizado' || $causa_no_reclamacion == 'Suspendido por esquema de aplicacion' || $causa_no_reclamacion == 'Suspendido temporalmente') {
		// 	$estado_paciente = $_POST['estado_suspendido'];
		// }
		// if ($causa_no_reclamacion == 'Autorizacion radicada para Cita' || $causa_no_reclamacion == 'Autorizacion radicada para Medicamento' || $causa_no_reclamacion == 'Cita inoportuna' || $causa_no_reclamacion == 'Demora en la Autorizacion Cita Medica' || $causa_no_reclamacion == 'Demora en la autorizacion de medicamento' || $causa_no_reclamacion == 'Desafiliacion Asegurador' || $causa_no_reclamacion == 'En proceso de cita Aplicacion' || $causa_no_reclamacion == 'En proceso de cita medica' || $causa_no_reclamacion == 'En proceso de entrega' || $causa_no_reclamacion == 'Error en papeleria' || $causa_no_reclamacion == 'Falta de cita aplicacion' || $causa_no_reclamacion == 'Falta de cita medica' || $causa_no_reclamacion == 'Falta de cita valoracion (Xofigo)' || $causa_no_reclamacion == 'Falta de contacto' || $causa_no_reclamacion == 'Falta de medicamento en el punto' || $causa_no_reclamacion == 'No remision a entidad licenciada' || $causa_no_reclamacion == 'Pago anticipado' || $causa_no_reclamacion == 'Pendiente formulacion NO sistema' || $causa_no_reclamacion == 'Pendiente Radicar Formula en Farmacia' || $causa_no_reclamacion == 'PSVC en Titulacion' || $causa_no_reclamacion == 'Sin red Prestadora' || $causa_no_reclamacion == 'Voluntario') {
		// 	$estado_paciente = $_POST['estado_interrumpido'];
		// }
		// if ($causa_no_reclamacion == 'Abandono') {
		// 	$estado_paciente = $_POST['estado_abandono'];
		// }
		// $reclamo = $_POST['reclamo'];
		// if ($reclamo == 'SI') {
		// 	$estado_paciente = $_POST['estado_activo'];
		// }
		$estado_paciente = $_POST['estado_paciente'];
		$insertar = mysqli_query($conex, "INSERT INTO bayer_pacientes(CODIGO_XOFIGO,ESTADO_PACIENTE,STATUS_PACIENTE,FECHA_ACTIVACION_PACIENTE,TIPO_IDENTIFICACION_PACIENTE,IDENTIFICACION_PACIENTE,NOMBRE_PACIENTE,
		APELLIDO_PACIENTE,TELEFONO_PACIENTE,TELEFONO2_PACIENTE,TELEFONO3_PACIENTE,TELEFONO4_PACIENTE,TELEFONO5_PACIENTE,CORREO_PACIENTE,DIRECCION_PACIENTE,BARRIO_PACIENTE,DEPARTAMENTO_PACIENTE,CIUDAD_PACIENTE,GENERO_PACIENTE,FECHA_NACIMINETO_PACIENTE,EDAD_PACIENTE,ACUDIENTE_PACIENTE,TELEFONO_ACUDIENTE_PACIENTE,USUARIO_CREACION,PROVEEDOR)
		VALUES ('" . $CODIGO_XOFIGO . "','" . $estado_paciente . "','" . $status_paciente . "','" . $fecha_activacion . "','" . $tipo_identificacion . "','" . $identificacion . "','" . $nombre . "','" . $apellidos . "','" . $telefono1 . "','" . $telefono2 . "','" . $telefono3 . "','" . $telefono4 . "','" . $telefono5 . "','" . $correo . "','" . $direccion . "','" . $barrio . "','" . $departamento . "','" . $ciudad . "','" . $genero . "','" . $fecha_nacimiento . "','" . $edad . "','" . $acudiente . "','" . $telefono_acudiente . "','" . $usua . "','PSP Solutions')");
		echo mysqli_error($conex);
		if ($insertar) {
			$select_paciente = mysqli_query($conex, "SELECT ID_PACIENTE FROM bayer_pacientes ORDER BY ID_PACIENTE DESC LIMIT 1");
			while ($dato = mysqli_fetch_array($select_paciente)) {
				$ID_PACIENTE = $dato['ID_PACIENTE'];
			}
			$brindo_educacion = $_POST['brindo_educacion'];
			$TemaBrindoEdu = $_POST['TemaBrindoEdu'];
			$FechaEduca = $_POST['FechaEduca'];
			$MotivoNoEdu = $_POST['MotivoNoEdu'];
			if ($brindo_educacion == 'SI') {
				$insert_edu = mysqli_query($conex, "INSERT INTO `bayer_educacion`( USER, `ID_PACI_FK`, `SE_BRINDO_EDU`, `TEMA_SI_EDU`, `FECHA_SI_EDU`,  `FECHA_REGISTRO`) VALUES ( '$usua', '$ID_PACIENTE', '$brindo_educacion', '$TemaBrindoEdu', '$FechaEduca', NOW())");
			} elseif ($brindo_educacion == 'NO') {
				$insert_edu = mysqli_query($conex, "INSERT INTO `bayer_educacion`( USER, `ID_PACI_FK`, `SE_BRINDO_EDU`,  `MOTIVO_NO_EDU`, `FECHA_REGISTRO`) VALUES ( '$usua', '$ID_PACIENTE', '$brindo_educacion', '$MotivoNoEdu', NOW())");
			}
			$select_historial = mysqli_query($conex, "SELECT * FROM bayer_historial_reclamacion WHERE ID_PACIENTE_FK='$ID_PACIENTE'");
			echo mysqli_error($conex);
			$reg_hist = mysqli_num_rows($select_historial);
			if ($reg_hist == 0) {
				if ($fecha_ultima_reclamacion == '') {
					$INSERT_HISTORIAL = mysqli_query($conex, "INSERT INTO bayer_historial_reclamacion(ID_PACIENTE_FK) VALUES('" . $ID_PACIENTE . "')");
					echo mysqli_error($conex);
				}
				if ($fecha_ultima_reclamacion != '') {
					$fecha_actual = date('Y-m-d');
					$fecha_rec_act = explode("-", $fecha_actual);
					$anio_act = $fecha_rec_act[0];
					$mes_act = $fecha_rec_act[1];
					$dia_act = $fecha_rec_act[2];
					$dato = ((int)$mes_act);
					$INSERT_HISTORIAL = mysqli_query($conex, "INSERT INTO bayer_historial_reclamacion(ID_PACIENTE_FK,RECLAMO$dato,FECHA_RECLAMACION$dato) VALUES('" . $ID_PACIENTE . "','SI','" . $fecha_ultima_reclamacion . "')");
					echo mysqli_error($conex);
				}
			}
			$insert_trt = mysqli_query($conex, "INSERT INTO bayer_tratamiento(PRODUCTO_TRATAMIENTO,NOMBRE_REFERENCIA,DOSIS_TRATAMIENTO,CLASIFICACION_PATOLOGICA_TRATAMIENTO,TRATAMIENTO_PREVIO,CONSENTIMIENTO_TRATAMIENTO,FECHA_INICIO_TERAPIA_TRATAMIENTO,FECHA_PRESCRIPCION,REGIMEN_TRATAMIENTO,ASEGURADOR_TRATAMIENTO,OPERADOR_LOGISTICO_TRATAMIENTO, PUNTO_ENTREGA, FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,OTROS_OPERADORES_TRATAMIENTO,MEDIOS_ADQUISICION_TRATAMIENTO,IPS_ATIENDE_TRATAMIENTO,MEDICO_TRATAMIENTO,MEDICO_PRESCRIPTOR,ESPECIALIDAD_TRATAMIENTO,PARAMEDICO_TRATAMIENTO,ZONA_ATENCION_PARAMEDICO_TRATAMIENTO,CIUDAD_BASE_PARAMEDICO_TRATAMIENTO,NOTAS_ADJUNTOS_TRATAMIENTO,ID_PACIENTE_FK,NUM_LOTES_DISPOSITIVOS)
			VALUES ('" . $producto_tratamiento . "','" . $producto_tratamiento . "','" . $dosis . "','" . $clasificacion_patologica . "','" . $tratamiento_previo . "','" . $consentimiento . "','" . $fecha_inicio_trt . "','" . $fecha_prescripcion . "','" . $regimen . "','" . $asegurador . "','" . $operador_logistico . "', '" . $punto_entrega . "','" . $fecha_ultima_reclamacion . "','" . $otro_operadores . "','" . $medio_adquision . "','" . $ips_atiende . "','" . $medico_t . "','" . $medico_p . "','" . $especialidad . "','" . $paramedico_representante . "','" . $zona_atencion . "','" . $ciudad_base . "','" . $nota . "','" . $ID_PACIENTE . "', '" . $num_lotes_dis . "')");
			echo mysqli_error($conex);

			if ($insert_trt) {
				if ($reclamo == 'SI') {
					$insert_gestion = mysqli_query($conex, "INSERT INTO bayer_gestiones (MOTIVO_COMUNICACION_GESTION,LOGRO_COMUNICACION_GESTION,RECLAMO_GESTION,CONSECUTIVO_BETAFERON,CAUSA_NO_RECLAMACION_GESTION,FECHA_PROXIMA_LLAMADA,FECHA_RECLAMACION_GESTION,FECHA_CITA_PROGRAMADA,AUTOR_GESTION,NOTA,DESCRIPCION_COMUNICACION_GESTION,FECHA_PROGRAMADA_GESTION,ID_PACIENTE_FK2,FECHA_COMUNICACION,NUMERO_NEBULIZACIONES,NUMERO_TABLETAS_DIARIAS,NUMERO_CAJAS,BRINDO_APOYO,PAAP,SUB_PAAP,BARRERA,INFORMACION_APLICACIONES)VALUES('Ingreso','SI','" . $reclamo . "','" . $consecutivo_betaferon . "','','" . $fecha_proxima_llamada . "','" . $fecha_reclamacion . "','" . $fecha_no_reclamacion . "','" . $usua . "','" . $nota . "','" . $nota . "','" . $fecha_proxima_llamada . "','" . $ID_PACIENTE . "',CURRENT_TIMESTAMP,'" . $numero_nebulizaciones . "','" . $numero_tabletas_diarias . "','" . $numero_cajas . "','" . $brindo_apoyo . "','" . $paap . "','" . $sub_paap . "','" . $sub_barrera . "','" . $INFORMACION_APLICACIONES . "')");
					echo mysqli_error($conex);
				} else if ($reclamo == 'NO') {
					$insert_gestion = mysqli_query($conex, "INSERT INTO bayer_gestiones (MOTIVO_COMUNICACION_GESTION,LOGRO_COMUNICACION_GESTION,RECLAMO_GESTION,CONSECUTIVO_BETAFERON,CAUSA_NO_RECLAMACION_GESTION,FECHA_PROXIMA_LLAMADA,FECHA_RECLAMACION_GESTION,FECHA_CITA_PROGRAMADA,AUTOR_GESTION,NOTA,DESCRIPCION_COMUNICACION_GESTION,FECHA_PROGRAMADA_GESTION,ID_PACIENTE_FK2,FECHA_COMUNICACION,NUMERO_NEBULIZACIONES,NUMERO_TABLETAS_DIARIAS,NUMERO_CAJAS,BRINDO_APOYO,PAAP,SUB_PAAP,BARRERA,INFORMACION_APLICACIONES)VALUES('Ingreso','SI','" . $reclamo . "','" . $consecutivo_betaferon . "','" . $causa_no_reclamacion . "','" . $fecha_proxima_llamada . "','','" . $fecha_no_reclamacion . "','" . $usua . "','" . $nota . "','" . $nota . "','" . $fecha_proxima_llamada . "','" . $ID_PACIENTE . "',CURRENT_TIMESTAMP,'" . $numero_nebulizaciones . "','" . $numero_tabletas_diarias . "','" . $numero_cajas . "','" . $brindo_apoyo . "','" . $paap . "','" . $sub_paap . "','" . $sub_barrera . "','" . $INFORMACION_APLICACIONES . "')");
					echo mysqli_error($conex);
				}
				$ID_PACIENTE;
				$select_gestion = mysqli_query($conex, "SELECT * FROM bayer_gestiones WHERE ID_PACIENTE_FK2='" . $ID_PACIENTE . "' ORDER BY ID_GESTION DESC LIMIT 1");
				while ($datos_gestion = mysqli_fetch_array($select_gestion)) {
					$ID_ULTIMA_GESTION = $datos_gestion['ID_GESTION'];
				}
				$update_codigo_gestion = mysqli_query($conex, "UPDATE bayer_pacientes SET ID_ULTIMA_GESTION='" . $ID_ULTIMA_GESTION . "'WHERE ID_PACIENTE='" . $ID_PACIENTE . "'");
				echo mysqli_error($conex);
				if ($_FILES['archivo']["error"] > 0) {
				} else {
					$SELECT_GES = mysqli_query($conex, "SELECT ID_GESTION FROM bayer_gestiones ORDER BY ID_GESTION DESC LIMIT 1");
					while ($fila2 = mysqli_fetch_array($SELECT_GES)) {
						$ID_GES = $fila2['ID_GESTION'];
					}
					$CARPETA = "../ADJUNTOS_BAYER/$ID_GES";
					if (!is_dir($CARPETA)) {
						mkdir("../ADJUNTOS_BAYER/$ID_GES", 0777);
					}
					move_uploaded_file($_FILES['archivo']['tmp_name'], "../ADJUNTOS_BAYER/$ID_GES/" . $_FILES['archivo']['name']);
				}
				if ($insert_gestion || $insert_trt || $insertar) {
					include("../presentacion/email/mail_paciente_nuevo.php");
	?>
					<span style="margin-top:5%;">
						<center>
							<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
						</center>
					</span>
					<p class="aviso3" style=" width:68.9%; margin:auto auto;">HA REGISTRADO AL PACIENTE CORRECTAMENTE.</p>
					<br />
					<br />
					<center>
						<a href="../presentacion/form_paciente_nuevo.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
					</center>
				<?php
				} else {  ?>
					<span style="margin-top:5%;">
						<center>
							<img src="../presentacion/imagenes/advertencia.png" style="width:50px; margin-top:100px;margin-top:5%;" />
						</center>
					</span>
					<p class="error" style=" width:68.9%; margin:auto auto;">
						<span style="border-left-color:#fff">ERROR EN GESTION.</span>
					</p>
					<br />
					<br />
					<center>
						<a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
					</center>
				<?php
				}
			} else { ?>
				<span style="margin-top:5%;">
					<center>
						<img src="../presentacion/imagenes/advertencia.png" style="width:50px; margin-top:100px;margin-top:5%;" />
					</center>
				</span>
				<p class="error" style=" width:68.9%; margin:auto auto;">
					<span style="border-left-color:#fff">ERROR EN INFORMACION ACERCA DEL TRATAMIENTO.</span>
				</p>
				<br />
				<br />
				<center>
					<a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
				</center>
			<?php
			}
		} else { ?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia.png" style="width:50px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">
				<span style="border-left-color:#fff">ERROR. VERIFIQUE LOS DATOS REGISTRADOS.</span>
			</p>
			<br />
			<br />
			<center>
				<a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
			</center>
			<?php
		}
		$codigo_usuario2 = $ID_PACIENTE;
		$select_temporal = mysqli_query($conex, "SELECT * FROM bayer_temporal_producto WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
		$nreg = mysqli_num_rows($select_temporal);
		if ($nreg > 0) {
			while ($datos_temporales = (mysqli_fetch_array($select_temporal))) {
				$tipo_envio = $datos_temporales['ID_REFERENCIA_FK'];
				$verificar_cantidad = mysqli_query($conex, "SELECT * FROM bayer_referencia WHERE CANTIDAD>0 AND ID_REFERENCIA='$tipo_envio'");
				echo mysqli_error($conex);
				$cantidad = mysqli_num_rows($verificar_cantidad);
				if ($cantidad > 0) {
					$SELECT_ID_INV = mysqli_query($conex, "select ID_INVENTARIO from bayer_inventario WHERE LUGAR_MATERIAL='BODEGA' AND ID_REFERENCIA_FK='" . $tipo_envio . "' ORDER BY ID_INVENTARIO ASC LIMIT 1");
					echo mysqli_error($conex);
					while ($fila1 = mysqli_fetch_array($SELECT_ID_INV)) {
						$ID_ULT_INV = $fila1['ID_INVENTARIO'];
					}
					$INSERT_MOVIMIENTO = mysqli_query($conex, "INSERT INTO bayer_movimientos(TIPO_MOVIMIENTO, NO_REMICION, CANTIDAD, RESPONSABLE, DESTINATARIO, DIRECCION_DESTINATARIO, CIUDAD_ENVIO, FECHA_MOVIMIENTO, OBSERVACIONES, ESTADO_MOVIMIENTO,ID_REFERENCIA_FK) VALUES('2', '', '1', '" . $usua . "', '" . $nombre . ' ' . $apellidos . "', '" . $direccion . "', '" . $ciudad . "', CURRENT_TIMESTAMP, 'ENVIO PRODUCTO(S)', 'EN PROCESO','" . $tipo_envio . "')");
					echo mysqli_error($conex);
					$SELECT_CANTIDAD = mysqli_query($conex, "SELECT * FROM bayer_referencia WHERE ID_REFERENCIA = '" . $tipo_envio . "'");
					echo mysqli_error($conex);
					while ($fila1 = mysqli_fetch_array($SELECT_CANTIDAD)) {
						$CANTIDAD_I = $fila1['CANTIDAD'];
					}
					$TOTAL = $CANTIDAD_I - 1;
					$UPDATE_REFERENCIA = mysqli_query($conex, "UPDATE bayer_referencia SET CANTIDAD='" . $TOTAL . "' WHERE ID_REFERENCIA='" . $tipo_envio . "'");
					echo mysqli_error($conex);
					$SELECT_ID_MOVIMIENTO = mysqli_query($conex, "SELECT ID_MOVIMIENTOS FROM bayer_movimientos WHERE DESTINATARIO='" . $nombre . ' ' . $apellidos . "' AND TIPO_MOVIMIENTO='2' ORDER BY ID_MOVIMIENTOS DESC LIMIT 1");
					echo mysqli_error($conex);
					while ($fila_mov = mysqli_fetch_array($SELECT_ID_MOVIMIENTO)) {
						$ID_ULT_MOVIMIENTO = $fila_mov['ID_MOVIMIENTOS'];
					}
					$INSERT_MOVIMIENTO_PACIENTE = mysqli_query($conex, "INSERT INTO bayer_paciente_movimientos(ID_PACIENTE_FK,ID_MOVIMIENTOS_FK,ESTADO_PACIENTE_MOVIMIENTO)VALUES('" . $codigo_usuario2 . "','" . $ID_ULT_MOVIMIENTO . "','EN PROCESO')");
					echo mysqli_error($conex);
					$INSERT_MOVIMIENTO_USUARIO = mysqli_query($conex, "INSERT INTO bayer_usuario_movimientos(ID_USUARIO_FK,ID_MOVIMIENTOS_FK)VALUES('" . $id_usu . "','" . $ID_ULT_MOVIMIENTO . "')");
					echo mysqli_error($conex);
					$verificar_cantidad = mysqli_query($conex, "SELECT * FROM bayer_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "' AND CANTIDAD<STOCK_MINIMO");
					echo mysqli_error($conex);
					$nreg_vrf = mysqli_num_rows($verificar_cantidad);
			?>
					<table style="margin:auto auto; font-size:80%;">
						<?php
						if ($nreg_vrf > 0) {
							while ($daro_ref = mysqli_fetch_array($verificar_cantidad)) {
								$MATERIAL = $daro_ref['MATERIAL'];
						?>
								<tr align="left">
									<td align="left">
										<span class="error" style="font-size:100%; text-align:left">ADVERTENCIA SE ESTA AGOTANDO EL PRODUCTO <?php echo $MATERIAL ?>
										</span>
									</td>
								</tr>
							<?php }
						}
					} else {
						$verificar_cantidad = mysqli_query($conex, "SELECT * FROM bayer_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "'");
						echo mysqli_error($conex);
						while ($cantidad = mysqli_fetch_array($verificar_cantidad)) {
							$nombre_producto = $cantidad['MATERIAL'];
							?>
							<tr align="left">
								<td align="left">
									<span style="margin-top:3%;">
										<center>
											<img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
										</center>
									</span>
									<p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;color:#F00; font-weight:bold">EL PRODUCTO <span style=""><?php echo $nombre_producto ?></span> ESTA AGOTADO POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
									<br />
									<br />
									<br />
								</td>
							</tr>
					<?php }
					}
				}
				if ($nreg_vrf > 0) {
					?>
					<tr>
						<td align="center">
							<span class="error" style="font-size:100%; ">POR FAVOR COMUNICARSE CON EL COORDINADOR.</span>
							<span>
								<center>
									<img src="../presentacion/imagenes/advertencia.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
								</center>
							</span>
						</td>
					</tr>
				<?php }
				?>
					</table>
					<?php
					$BORRAR_PRODUCTOS_TEMPORAL = mysqli_query($conex, "DELETE  FROM bayer_temporal_producto WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
					echo mysqli_error($conex);
				} else {
					$tipo_envio = $_POST['tipo_envio'];
					if ($tipo_envio == 'Kit de bienvenida') {
						$listado_envio = mysqli_query($conex, "SELECT MATERIAL,ID_REFERENCIA FROM bayer_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "'");
						while ($opcion = mysqli_fetch_array($listado_envio)) {
							$nombre_producto = $opcion['MATERIAL'];
						}
						/*SI EL ENVIO ES KIT DE BIENVENIDA*/
						if ($nombre_producto == 'Kit de bienvenida') {
							$tipo_envio = $_POST['tipo_envio'];
							$verificar_cantidad = mysqli_query($conex, "SELECT * FROM bayer_referencia WHERE CANTIDAD>0 AND ID_REFERENCIA='$tipo_envio'");
							echo mysqli_error($conex);
							$cantidad_ref = mysqli_num_rows($verificar_cantidad);
							if ($cantidad_ref > 0) {
								$verificar_cantidad = mysqli_query($conex, "SELECT * FROM bayer_referencia WHERE CANTIDAD>0 AND ID_REFERENCIA='$tipo_envio'");
								echo mysqli_error($conex);
								$cantidad = mysqli_num_rows($verificar_cantidad);
								if ($cantidad > 0) {
									$SELECT_ID_INV = mysqli_query($conex, "SELECT ID_INVENTARIO from bayer_inventario WHERE LUGAR_MATERIAL='BODEGA' AND ID_REFERENCIA_FK='" . $tipo_envio . "' ORDER BY ID_INVENTARIO ASC LIMIT 1");
									echo mysqli_error($conex);
									while ($fila1 = mysqli_fetch_array($SELECT_ID_INV)) {
										$ID_ULT_INV = $fila1['ID_INVENTARIO'];
									}
									$INSERT_MOVIMIENTO = mysqli_query($conex, "INSERT INTO bayer_movimientos(TIPO_MOVIMIENTO, NO_REMICION, CANTIDAD, RESPONSABLE, DESTINATARIO, DIRECCION_DESTINATARIO, CIUDAD_ENVIO, FECHA_MOVIMIENTO, OBSERVACIONES, ESTADO_MOVIMIENTO,ID_REFERENCIA_FK) VALUES('2', '', '1', '" . $usua . "', '" . $nombre . ' ' . $apellidos . "', '" . $direccion . "', '" . $ciudad . "', CURRENT_TIMESTAMP, 'ENVIO PRODUCTO(S)', 'EN PROCESO','" . $tipo_envio . "')");
									echo mysqli_error($conex);
									$SELECT_CANTIDAD = mysqli_query($conex, "SELECT * FROM bayer_referencia WHERE ID_REFERENCIA = '" . $tipo_envio . "'");
									echo mysqli_error($conex);
									while ($fila1 = mysqli_fetch_array($SELECT_CANTIDAD)) {
										$CANTIDAD_I = $fila1['CANTIDAD'];
									}
									$TOTAL = $CANTIDAD_I - 1;
									$UPDATE_REFERENCIA = mysqli_query($conex, "UPDATE bayer_referencia SET CANTIDAD='" . $TOTAL . "' WHERE ID_REFERENCIA='" . $tipo_envio . "'");
									echo mysqli_error($conex);
									$SELECT_ID_MOVIMIENTO = mysqli_query($conex, "SELECT ID_MOVIMIENTOS FROM bayer_movimientos WHERE DESTINATARIO='" . $nombre . ' ' . $apellidos . "' AND TIPO_MOVIMIENTO='2' ORDER BY ID_MOVIMIENTOS DESC LIMIT 1");
									echo mysqli_error($conex);
									while ($fila_mov = mysqli_fetch_array($SELECT_ID_MOVIMIENTO)) {
										$ID_ULT_MOVIMIENTO = $fila_mov['ID_MOVIMIENTOS'];
									}
									$INSERT_MOVIMIENTO_PACIENTE = mysqli_query($conex, "INSERT INTO bayer_paciente_movimientos(ID_PACIENTE_FK,ID_MOVIMIENTOS_FK,ESTADO_PACIENTE_MOVIMIENTO)VALUES('" . $codigo_usuario2 . "','" . $ID_ULT_MOVIMIENTO . "','EN PROCESO')");
									echo mysqli_error($conex);
									$INSERT_MOVIMIENTO_USUARIO = mysqli_query($conex, "INSERT INTO bayer_usuario_movimientos(ID_USUARIO_FK,ID_MOVIMIENTOS_FK)VALUES('" . $id_usu . "','" . $ID_ULT_MOVIMIENTO . "')");
									echo mysqli_error($conex);
									$BORRAR_PRODUCTOS_TEMPORAL = mysqli_query($conex, "DELETE  FROM bayer_temporal_producto WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
									echo mysqli_error($conex);
									$verificar_cantidad = mysqli_query($conex, "SELECT ID_REFERENCIA FROM bayer_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "' AND CANTIDAD<STOCK_MINIMO");
									echo mysqli_error($conex);
									$nreg_vrf = mysqli_num_rows($verificar_cantidad);
									if ($nreg_vrf > 0) {
					?>
										<span style="margin-top:3%;">
											<center>
												<img src="../presentacion/imagenes/advertencia.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
											</center>
										</span>
										<p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;">ADVERTENCIA SE ESTA AGOTANDO EL PRODUCTO <span style="color:#F00; font-weight:bold"><?php echo $nombre_producto ?></span> POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
										<br />
										<br />
										<br />
									<?php
									}
								} else {
									?>
									<span style="margin-top:3%;">
										<center>
											<img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
										</center>
									</span>
									<p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;color:#F00; font-weight:bold">EL PRODUCTO <span style=""><?php echo $nombre_producto ?></span> ESTA AGOTADO POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
									<br />
									<br />
									<br />
								<?php
								}
							} else {
								$verificar_cantidad = mysqli_query($conex, "SELECT * FROM bayer_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "'");
								echo mysqli_error($conex);
								while ($cantidad = mysqli_fetch_array($verificar_cantidad)) {
									$nombre_producto = $cantidad['MATERIAL'];
								?>
									<tr align="left">
										<td align="left">
											<span style="margin-top:3%;">
												<center>
													<img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
												</center>
											</span>
											<p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;color:#F00; font-weight:bold">EL PRODUCTO <span style=""><?php echo $nombre_producto ?></span> ESTA AGOTADO POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
											<br />
											<br />
											<br />
										</td>
									</tr>
						<?php
								}
							}
						}
					}
				}
				if ($tipo_envio == 'Kit de bienvenida' || $nreg > 0) {
					if (!$INSERT_MOVIMIENTO || !$UPDATE_REFERENCIA || !$INSERT_MOVIMIENTO_PACIENTE || !$INSERT_MOVIMIENTO_USUARIO) { ?>
						<span style="margin-top:5%;">
							<center>
								<img src="../presentacion/imagenes/advertencia.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
							</center>
						</span>
						<p class="error" style=" width:68.9%; margin:auto auto;">
							LA SOLICITUD NO HA SIDO ENVIADA CORRECTAMENTE.</p>
						<br />
						<br />
						<center>
							<a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
						</center>
						<br />
			<?php
					}
				}
			}
			?>
</body>

</html>