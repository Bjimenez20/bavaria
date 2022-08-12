<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
	<link rel="stylesheet" href="css/estilos_menu.css" />
	<title>IPSEN</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="js/jquery.js"></script>
	<script src="../presentacion/js/jquery.js"></script>
	<script>
		var height = window.innerHeight - 2;
		var porh = (height * 80 / 100);
		$(document).ready(function() {
			$('#consulta_inv').css('height', porh);
		});
	</script>
	<style>
		@import url("../../bayer/webfonts/avenir/stylesheet.css");

		.btn_registrar {
			padding-top: 2%;
			background-image: url(imagenes/BOTON_ACTUALIZAR.png);
			background-repeat: no-repeat;
			width: 152px;
			height: 50px;
			color: transparent;
			background-color: transparent;
			border-radius: 5px;
			border: 1px solid transparent;
		}

		.izq {
			text-align: left;
		}

		.der {
			text-align: right;
		}

		th {
			padding: 7px;
			color: #FFF;
			background: #2797d3;
			font-family: avenir;
			font-size: 100%;
			font-style: normal;
			line-height: normal;
			font-weight: normal;
			font-variant: normal;
			text-align: center;
		}

		td {
			padding: 2px;
			color: #000;
			font-family: avenir;
			font-size: 100%;
			font-style: normal;
			line-height: normal;
			font-weight: normal;
			font-variant: normal;
			text-align: left;
		}
	</style>
	<script>
		$(document).ready(function() {
			$('#ver1').click(function() {
				$("#con").fadeIn();
			});
			$('#close').click(function() {
				$("#con").fadeOut();
			});
			$("#salir").click(function() {
				if (confirm('¿Estas seguro de cerrar sesion?')) {
					window.location = "../index.php";
				} else {}
			});
		});
	</script>
	<?php
	require('../datos/parse_str.php');
	require_once("../datos/conex.php");
	if ($privilegios != '' && $usua != '') {
		$usua = strtoupper($usua);
		$ID_NOVEDAD = base64_decode($artid);
		$novedad = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE ID = '" . $ID_NOVEDAD . "'");
		echo mysqli_error($conex);
		while ($fila1 = mysqli_fetch_array($novedad)) {
			$PAP = $fila1['PAP'];
			$ASUNTO = $fila1['ASUNTO'];
			$PRODUCTO = $fila1['PRODUCTO'];
			$NOVEDAD = $fila1['NOVEDADES'];
			$OBSERVACION = $fila1['OBSERVACIONES'];
			$FECHA_REPORTE = $fila1['FECHA_REPORTE'];
			$FECHA_RESPUESTA = $fila1['FECHA_RESPUESTA'];
			$ESTADO = $fila1['ESTADO'];
			$OBSERVACION_RESPUESTA = $fila1['OBSERVACION_RESPUESTA'];
		}
	?>
</head>

<body>
	<section>
		<blockquote>
			<form name="miformulario" method="post" action="../presentacion/novedades_correo.php?ID_NOVEDAD=<?php echo $ID_NOVEDAD; ?>">
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="tabla2" style="margin:auto auto;">
					<tr>
						<th colspan="4">
							<strong>ACTUALIZAR NOVEDADES</strong>
						</th>
					</tr>
					<tr>
						<td width="16%"><strong>PAP</strong></td>
						<td width="34%" height="44" align="left"><strong>
								<input name="PAP" type="text" class="tipo1" id="PAP" style="height:20px" value="<?php echo $PAP; ?>" readonly="readonly" />
							</strong></td>
						<td><strong>ASUNTO </strong></td>
						<td width="35%"><strong>
								<input name="ASUNTO" type="text" class="tipo1" id="ASUNTO" style="height:20px" value="<?php echo $ASUNTO; ?>" readonly="readonly" />
							</strong></td>
					</tr>
					<tr>
						<td><strong>PRODUCTO</strong></td>
						<td width="34%" height="44" align="left"><strong>
								<input name="PRODUCTO" type="text" class="tipo1" id="PRODUCTO" style="height:20px" value="<?php echo $PRODUCTO; ?>" readonly="readonly" />
							</strong></td>
						<td><strong>NOVEDAD</strong></td>
						<td><strong>
								<input name="NOVEDAD" type="text" class="tipo1" id="NOVEDAD" style="height:20px" value="<?php echo $NOVEDAD; ?>" readonly="readonly" />
							</strong></td>
					</tr>
					<tr>
						<td><strong>FECHA REPORTE</strong></td>
						<td height="44" class="titulosth"><strong>
								<input name="FECHA_REPORTE" type="text" class="tipo1" id="FECHA_REPORTE" style="height:20px" value="<?php echo $FECHA_REPORTE; ?>" readonly="readonly" />
							</strong></td>
						<td width="15%"><strong>OBSERVACIONES </strong></td>
						<td><span class="titulosth"><strong>
									<textarea name="OBSERVACION" cols="30" readonly="readonly" class="tipo1" id="OBSERVACION" style="width:auto"><?php echo $OBSERVACION; ?></textarea>
								</strong></span></td>
					</tr>
					<tr>
						<td><strong>FECHA RESPUESTA</strong></td>
						<td height="44" class="titulosth"><strong><span>
									<input name="FECHA_RESPUESTA" type="date" id="FECHA_RESPUESTA" class="tipo1" style="height:20px" />
								</span></strong></td>
						<td width="15%"><strong>OBS RESPUESTA</strong></td>
						<td><textarea name="OBSERVACION_RESPUESTA" cols="30" class="tipo1" id="OBSERVACION_RESPUESTA" style="width:auto"><?php echo $OBSERVACION_RESPUESTA; ?></textarea></td>
					</tr>
					<tr>
						<td><span class="botones"><strong>ESTADO</strong></span></td>
						<td height="44" class="titulosth"><span style="background:#CCC">
								<select name="ESTADO" id="ESTADO" required="required" style="height:25px">
									<?php if ($ESTADO == "NUEVO") { ?>
										<option selected="selected">NUEVO</option>
										<option>EN PROCESO</option>
										<option>FINALIZADO</option>
									<?php }
									if ($ESTADO == "EN PROCESO") { ?>
										<option selected="selected">EN PROCESO</option>
										<option>NUEVO</option>
										<option>FINALIZADO</option>
									<?php }
									if ($ESTADO == "FINALIZADO") { ?>
										<option selected="selected">FINALIZADO</option>
										<option>NUEVO</option>
										<option>EN PROCESO</option>
									<?php } ?>
								</select>
							</span></td>
						<td width="15%">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<th colspan="4">
							<input id="actualizar" name="actualizar" type="submit" value="ACTUALIZAR" class="btn_registrar" onClick="return validar(paciente_nuevo,1)" />
						</th>
					</tr>
				</table>
			</form>
		</blockquote>
	</section>
	<map name="Map7" id="Map7">
		<area shape="rect" coords="-3,-1,275,78" href="#" />
	</map>
</body>
<?php
	} else {
?>
	<script type="text/javascript">
		window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
	</script>
<?php
	}
?>

</html>