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
	if (isset($_POST['registrar'])) {
		$ASEGURADOR = $_POST['ASEGURADOR'];
		$DEPTO = $_POST['DEPTO'];
		$OPERADOR = $_POST['OPERADOR'];
		mysqli_query($conex,"SET NAMES utf8");
		$insertar = mysqli_query($conex,"INSERT INTO bayer_asegurador_operador_logistico (DEPARTAMENTO, ASEGURADOR, OPERADOR)
		VALUES ('" . $DEPTO . "', '" . $ASEGURADOR . "', '" . $OPERADOR . "')");
		echo mysqli_error($conex);
		if ($insertar) {
	?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3" style=" width:68.9%; margin:auto auto;">HA REGISTRADO EL OPERADOR LOGISTICO CORRECTAMENTE.</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/operadores_registro.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
			</center>
		<?php
		} else {
		?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia.png" style="width:50px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">
				<span style="border-left-color:#fff">ERROR AL REGISTRAR OPERADOR LOGISTICO.</span>
			</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/operadores_registro.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
			</center>
	<?php
		}
	}
	?>
</body>
</html>