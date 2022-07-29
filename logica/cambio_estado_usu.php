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
	</style>
</head>

<body>
	<?php
	require('../datos/parse_str.php');
	require_once("../datos/conex.php");
	$OK;
	$ID = base64_decode($ID); //ID_USUARIO
	$select_usu = mysqli_query($conex, "SELECT CONCAT(NOMBRES,' ',APELLIDOS) AS 'NOMBRE_COMPLETO',ID_USUARIO from ipsen_usuario WHERE ID_USUARIO='" . $ID . "'");
	echo mysqli_error($conex);
	while ($datos_pa = mysqli_fetch_array($select_usu)) {
		$NOM = $datos_pa['NOMBRE_COMPLETO'];
		$ID = $datos_pa['ID_USUARIO'];
	}
	if ($OK == '1') {
		$sql = mysqli_query($conex, "UPDATE ipsen_usuario SET ESTADO=0 WHERE ID_USUARIO='" . $ID . "' AND  (ESTADO='1' or ESTADO='');");
		echo mysqli_error($conex);
		if ($sql) {
	?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3" style=" width:68.9%; margin:auto auto;">El usuario <?php echo $NOM ?> con el Id. <?php echo $ID ?> fue desactivado.</p>
			<br />
			<br />
			<center>
				<a style="font-weight:bold; font-size:100%; color:#4DB8F2;" href="../presentacion/listado_usuario.php?NAME=<?php echo $usua; ?>" target="usuarios"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" title="CONTINUAR" class="btn" /></a>
			</center>
		<?php
		}
	}
	if ($OK == '2') {
		$sql = mysqli_query($conex, "UPDATE ipsen_usuario SET ESTADO=1 WHERE ID_USUARIO='" . $ID . "' AND  (ESTADO='0' or ESTADO='');");
		echo mysqli_error($conex);
		if ($sql) {
		?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3">El usuario <?php echo $NOM ?> con el Id. <?php echo $ID ?> fue activado.</p>
			<center>
				<a style="font-weight:bold; font-size:100%; color:#4DB8F2;" href="../presentacion/listado_usuario.php?NAME=<?php echo $usua; ?>" target="usuarios"> <img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" title="CONTINUAR" class="btn" /></a>
			</center>
		<?php
		}
	}
	if ($OK == '3') {
		$CONTRASENA = md5(1234);
		$sql = mysqli_query($conex, "UPDATE ipsen_usuario SET CONTRASENA='" . $CONTRASENA . "' WHERE ID_USUARIO='" . $ID . "'");
		echo mysqli_error($conex);
		if ($sql) {
		?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3">La contrseña del usuario <?php echo $NOM ?> con el Id. <?php echo $ID ?> fue restablecida.</p>
			<center>
				<a style="font-weight:bold; font-size:100%; color:#4DB8F2;" href="../presentacion/listado_usuario.php?NAME=<?php echo $usua; ?>" target="usuarios"> <img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" title="CONTINUAR" class="btn" /></a>
			</center>
	<?php
		}
	}
	?>
</body>

</html>