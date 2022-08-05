<?php
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
	<?PHP
	require('../datos/parse_str.php');
	require_once("../datos/conex.php");
	if (isset($_POST['registrar'])) {
		$PAP = $_POST['PAP'];
		$ESTATUS_PACIENTE = $_POST['ESTATUS_PACIENTE'];
		$DOSIS = $_POST['DOSIS'];
		$FECHA_SALIDA = $_POST['FECHA_SALIDA'];
		$NO_LOTE = $_POST['NO_LOTE'];
		$ESTADO = $_POST['ESTADO'];
		$FECHA_VENC = $_POST['FECHA_VENC'];
		$OBSERVACION = $_POST['OBSERVACION'];
		$insertar = mysqli_query($conex, "INSERT INTO ipsen_envio_muestra (PAP, ESTATUS_PACIENTE, DOSIS, FECHA_SALIDA, FECHA_ENTREGA, NO_LOTE, ESTADO, USUARIO, FECHA_VENCIMIENTO, OBSERVACION)
		VALUES ('" . $PAP . "', '" . $ESTATUS_PACIENTE . "', '" . $DOSIS . "', '" . $FECHA_SALIDA . "', '', '" . $NO_LOTE . "', '" . $ESTADO . "', '" . $usua . "', '" . $FECHA_VENC . "', '" . $OBSERVACION . "')");
		include("../presentacion/email/mail_envio_muestras.php");
		echo mysqli_error($conex);
		if ($insertar) {
	?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3" style=" width:68.9%; margin:auto auto;">HA REGISTRADO EL ENVIO CORRECTAMENTE.</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/envio_muestra_medica.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
			</center>
		<?php
		} else {
		?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia2.png" style="width:50px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">
				<span style="border-left-color:#fff">ERROR EN EL REGISTRO DE ENVIO.</span>
			</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/envio_muestra_medica.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
			</center>
	<?php
		}
	}
	?>
</body>

</html>