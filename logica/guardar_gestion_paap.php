<?php
header("Content-Type: text/html;charset=utf-8");
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
</head>
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

	html {
		background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}

	@media screen and (max-width:1000px) {
		html {
			background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
	}
</style>

<body>
	<?php
	require('../datos/parse_str.php');
	require('../datos/conex.php');
	mysqli_query($conex, "SET NAMES utf8");
	if (isset($_POST['registrar'])) {
		$fecha_contacto = $_POST['fecha_contacto'];
		$barrera = $_POST['barrera'];
		$descripcion_comunicacion = $_POST['descripcion_comunicacion'];
		$codigo_cliente = $_POST['codigo_cliente'];
		$insert = mysqli_query($conex, "INSERT INTO ipsen_gestion_paap(FECHA_PROXIMO_CONTACTO, BARRERA, DESCRIPCION, ID_PACIENTE_FK, ID_USER_FK)	VALUES ('$fecha_contacto','$barrera','$descripcion_comunicacion','$codigo_cliente','$id_usu')");
		$sql = mysqli_query($conex, "INSERT INTO ipsen_gestiones (MOTIVO_COMUNICACION_GESTION, AUTOR_GESTION, DESCRIPCION_COMUNICACION_GESTION,  FECHA_PROGRAMADA_GESTION, FECHA_COMUNICACION, ID_PACIENTE_FK2)VALUES('GESTION PAAP','" . $usua . "','" . $descripcion_comunicacion . "','" . $fecha_contacto . "',CURRENT_TIMESTAMP, '$codigo_cliente')");
		echo mysqli_error($conex);
		echo mysqli_error($conex);
		if ($insert) {
	?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
					<p class="aviso3" style=" width:68.9%; margin:auto auto;">
						Se ha registrado correctamente.</p>
					<br />
					<br />
				</center>
			</span>
		<?php
		} else {
		?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia2.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
					<p class="error" style=" width:68.9%; margin:auto auto;">
						No se ha registrado correctamente la informacion
					</p>
					<br />
					<br />
					<a href="javascript:history.go(-1)" target="info" class="btn_continuar">
						<img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" />
					</a>
				</center>
			</span>
	<?php
		}
	}
	?>
</body>

</html>