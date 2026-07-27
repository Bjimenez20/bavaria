<?php
header("Content-Type: text/html;charset=utf-8");
require_once('session.php');
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
	<?php
	require_once("../datos/conex.php");
	mysqli_query($conex, "SET NAMES utf8");
	if (isset($_POST['registrar'])) {
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$tipo_identificacion = $_POST['tipo_identificacion'];
		$identificacion = $_POST['identificacion'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$departamento = $_POST['departamento'];
		$ciudad = $_POST['ciudad'];
		$whatsApp = $_POST['whatsApp'];
		$num_WhatsApp = $_POST['num_WhatsApp'];
		$negocio_funciona = $_POST['negocio_funciona'];
		$propietario = $_POST['propietario'];
		$nombres_nuevo_pro = $_POST['nombres_nuevo_pro'];
		$apellidos_nuevo_pro = $_POST['apellidos_nuevo_pro'];
		$horario_visita = $_POST['horario_visita'];
		$dia_visita = $_POST['dia_visita'];
		$interes_programa = $_POST['interes_programa'];
		$barrera = $_POST['barrera'];
		$hora_inicio = $_POST['hora_inicio'];
		$hora_fin = $_POST['hora_fin'];
		$descanso = $_POST['descanso'];
		$nivel_interes = $_POST['nivel_interes'];
		$nota = $_POST['nota'];
		$numero_registros = mysqli_query($conex, "SELECT * FROM responsable WHERE IDENTIFICACION ='" . $identificacion . "'");
		echo mysqli_error($conex);
		$coincidencias = mysqli_num_rows($numero_registros);
		$fecha = date('Y-m-d');
		$insertar_responsable = mysqli_query($conex, "INSERT INTO responsable (`NOMBRES`, `APELLIDOS`, `TIPO_IDENTIFICACION`, `IDENTIFICACION`, `TELEFONO`, `DIRECCION`, `DEPARTAMENTO`,`CIUDAD`)
		VALUES ('" . $nombres . "', '" . $apellidos . "', '" . $tipo_identificacion . "', '" . $identificacion . "', '" . $telefono . "', '" . $direccion . "', '" . $departamento . "', '" . $ciudad . "')");

		if (!$insertar_responsable) {
			die("Error al registrar responsable: " . mysqli_error($conex));
		}

		$responsable_id = mysqli_insert_id($conex);

		$insert_visita = mysqli_query($conex, "INSERT INTO visitas (`WHATSAPP`, `NUMERO_WHATSAPP`, `NEGOCIO_FUNCIONA`, `HORA_VISITA`, `FECHA_VISITA`, `INTERES_PROGRAMA`, `BARRERA`, `HORA_INICIO`, `HORA_FIN`, `DESCANSO`, `NIVEL_INTERES_PROGRAMA`, `OBSERVACION`, `FECHA_REGISTRO`, `RESPONSABLE_ID`) VALUES ('" . $whatsApp . "', '" . $num_WhatsApp . "', '" . $negocio_funciona . "', '" . $horario_visita . "', '" . $dia_visita . "', '" . $interes_programa . "', '" . $barrera . "', '" . $hora_inicio . "', '" . $hora_fin . "', '" . $descanso . "', '" . $nivel_interes . "', '" . $nota . "', '" . $fecha . "', '" . $responsable_id . "')");

		if (!$insert_visita) {
			die("Error al registrar visita: " . mysqli_error($conex));
		}

		if ($propietario == 'NO') {
			$update_responsable = mysqli_query($conex, "UPDATE `responsable` SET `NOMBRES` = '$nombres_nuevo_pro', `APELLIDOS` = '$apellidos_nuevo_pro' WHERE `ID` = ' $responsable_id '");

			if (!$update_responsable) {
				die("Error al actualizar el responsable: " . mysqli_error($conex));
			}
		}

		if ($insertar_responsable || $insert_visita) {
	?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3" style=" width:68.9%; margin:auto auto;">HA REGISTRADO LA VISITA CORRECTAMENTE.</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/form_paciente_nuevo.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
			</center>

		<?php
		} else { ?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia2.png" style="width:50px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">
				<span style="border-left-color:#fff">ERROR VERIFIQUE LOS DATOS REGISTRADOS.</span>
			</p>
			<br />
			<br />
			<center>
				<a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
			</center>
	<?php
		}
	}
	?>

</body>

</html>