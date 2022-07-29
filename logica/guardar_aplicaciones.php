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
		/*font-family: "Trebuchet MS";
	font-family:"Gill Sans MT";
	border-radius:10px;
	background: #11a9e3;*/
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
	html {
		background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	/*form 
{
    background:url(../presentacion/imagenes/LOGIN.png) top center no-repeat;
}*/
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
	<div>
		<img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
	</div>
	<?php
require('../datos/parse_str.php');
	require('../datos/conex.php');
	mysqli_query($conex,"SET NAMES utf8");
	if (isset($_POST['registrar'])) {
		$num_ojos = $_POST['num_ojos'];
		$aplicacion = $_POST['aplicacion'];
		if ($aplicacion == 'SI') {
			$fecha_aplicacion = $_POST['fecha_aplicacion'];
			$causal = 'NO APLICA';
		} else {
			$fecha_aplicacion = "0000-00-00";
			$causal = $_POST['causal'];
		}
		$paciente = $_POST['id_paciente'];
		$producto = $_POST['producto'];
		$insert = mysqli_query($conex,"INSERT INTO bayer_aplicaciones_eylia(NUMERO_OJOS,FECHA_APLICACION,CAUSAL,ID_PACIENTE_FK,ID_USUARIO_FK)
		VALUES('$num_ojos','$fecha_aplicacion','$causal','$paciente','$id_usu')");
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
					<a href="../presentacion/form_aplicaciones_eylia.php?xxx=<?php echo base64_encode($paciente) ?>&xxxx=<?php echo base64_encode($producto) ?>" class="btn_continuar">
						<img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" />
					</a>
				</center>
			</span>
		<?php
		} else {
		?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
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