<?php
include('../logica/session.php');
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
	$codigo_usuario2 = $_POST['codigo_usuario2'];
	$fecha_ultima_recoleccion = $_POST['fecha_ultima_recoleccion'];
	$fecha_proxima_recoleccion = $_POST['fecha_proxima_recoleccion'];
	$descripcion_nuevo_comunicacion = $_POST['descripcion_nuevo_comunicacion'];
	// fecha de reclamacion,proxima llamada y causa de la llamada//
	$reclamo_gestion = $_POST['reclamo_gestion'];
	$causo_no_reclamacion = $_POST['causo_no_reclamacion'];
	$fecha_reclamacion = $_POST['fecha_reclamacion'];
	$prox_llamada = $_POST['prox_llamada'];
	$fecha_prog_gestion = $prox_llamada;
	if (isset($_POST['evento_adverso'])) {
		$evento_adverso = $_POST['evento_adverso'];
	} else {
		$evento_adverso = '';
	}
	$tipo_evento_adverso = $_POST['tipo_evento_adverso'];
	//if($crear=='SI')
	//{
	$insert_gestion = mysqli_query($conex,"INSERT INTO ipsen_gestiones (MOTIVO_COMUNICACION_GESTION,RECLAMO_GESTION,CAUSA_NO_RECLAMACION_GESTION,FECHA_PROXIMA_LLAMADA,FECHA_RECLAMACION_GESTION, AUTOR_GESTION, NOTA, DESCRIPCION_COMUNICACION_GESTION,FECHA_PROGRAMADA_GESTION, ID_PACIENTE_FK2, FECHA_COMUNICACION, FECHA_ULT_RECOLECCION, FECHA_PRO_RECOLECCION) VALUES ('GESTION ASEI', '" . $reclamo_gestion . "', '" . $causo_no_reclamacion . "','" . $prox_llamada . "','" . $fecha_reclamacion . "', '" . $usua . "', 'GESTION ASEI', '" . $descripcion_nuevo_comunicacion . "', '" . $fecha_prog_gestion . "', '" . $codigo_usuario2 . "', CURRENT_TIMESTAMP, '" . $fecha_ultima_recoleccion . "', '" . $fecha_proxima_recoleccion . "')");
	//}
	if ($insert_gestion) {
		if ($evento_adverso == 'SI') {
			if ($tipo_evento_adverso == 'Farmacovigilancia' || $tipo_evento_adverso == 'Tecnovigilancia Betaconnet/ Omrron') {
				header('Location: ../presentacion/form_paciente_seguimiento.php');
				//require('../presentacion/form_evento_adverso.php');
			} else {
				if ($tipo_evento_adverso != 'Farmacovigilancia' || $tipo_evento_adverso != 'Tecnovigilancia Betaconnet/ Omrron') {
	?>
					<span style="margin-top:5%;">
						<center>
							<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
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
			}
		} else
		if ($evento_adverso != 'SI') {
			?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
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
	}
	/*else
{*/
	?>
	<!--		<span style="margin-top:5%;">
			 <center>
			 <img src="../presentacion/imagenes/advertencia.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;"/>
			 </center>
			 </span>
			 <p class="error" style=" width:68.9%; margin:auto auto;">NO SE HAN ACTUALIZADO LOS DATOS.</p>
			 <br />
			 <br />
			  <center>
			  <a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
			  </center>
		<br/> -->
	<?php
//}