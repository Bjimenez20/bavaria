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
	$ID = $_POST['OCUL'];
	$USURARIO = $_POST['USURARIO'];
	$NOMBRES = $_POST['NOMBRES'];
	$NUM_TEL = $_POST['NUM_TEL'];
	$CONTRASENA = $_POST['CONTRASENA'];
	$APELLIDO = $_POST['APELLIDO'];
	$PERFIL = $_POST['PERFIL'];
	if (isset($_POST['restablecer'])) {
		$CONTRASENA = md5(1234);
		$sql = mysqli_query($conex, "UPDATE usuario SET CONTRASENA='" . $CONTRASENA . "' WHERE ID_USUARIO='" . $ID . "'");
		echo mysqli_error($conex);
		if ($sql) {
	?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3" style=" width:68.9%; margin:auto auto;">LA CONTRASEÑA SE RESTABLECIO CON EXITO.</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/form_usuarios.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
			</center>
			<br />
		<?php
		}
	}
	if (isset($_POST['MODIFICAR_USU'])) {
		$CONTRASENA = md5($CONTRASENA);
		$sql = mysqli_query($conex, "UPDATE usuario SET NOMBRES='" . $NOMBRES . "',APELLIDOS='" . $APELLIDO . "', CELULAR='" . $NUM_TEL . "' WHERE ID_USUARIO='" . $ID . "';");
		echo mysqli_error($conex);
		if ($sql) {
		?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3">LOS DATOS FUERON ACTUALIZADOS CON EXITO.</p>
			<center>
				<?php
				if ($privilegios == 1) {
				?>
					<a href="../presentacion/form_usuarios.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
					<br />
				<?php
				}
				if ($privilegios != 1) {
				?>
					<a href="../presentacion/form_mi_cuenta.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
			</center>
			<br />
		<?php
				}
		?>
		</center>
	<?php
		}
		if (!$sql) {
	?>
		<span style="margin-top:5%;">
			<center>
				<img src="../presentacion/imagenes/advertencia2.png" style="width:50px; margin-top:100px;margin-top:5%;" />
			</center>
		</span>
		<p class="error" style=" width:68.9%; margin:auto auto;">
			<span style="border-left-color:#fff">ERROR VERIFIQUE LOS DATOS A ACTUALIZAR.</span>
		</p>
		<br />
		<br />
		<center>
			<a href="../presentacion/form_mi_cuenta.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
		</center>
<?php
		}
	}
?>
</body>

</html>