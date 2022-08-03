<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="euc-jp">

	<link rel="shortcut icon" href="img/logo.png" />
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

		.izq {
			text-align: left;
		}

		.der {
			text-align: right;
		}

		th {
			padding: 2px;
			color: #FFF;
			font-family: avenir;
			font-size: 100%;
			font-style: normal;
			line-height: normal;
			font-weight: normal;
			font-variant: normal;
			text-align: center;
			font-family: Tahoma, Geneva, sans-serif;
		}

		.tabla2 {
			padding: 2px;
			color: #000;
			background: #AEDC5A;
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
		if (isset($_POST['actualizar'])) {
			$ESTADO = $_POST['ESTADO'];
			$OBSERVACION_RESPUESTA = $_POST['OBSERVACION_RESPUESTA'];
			$FECHA_RESPUESTA = $_POST['FECHA_RESPUESTA'];
			$UPDATE_NOVEDADES = mysqli_query($conex, "UPDATE ipsen_novedades SET ESTADO = '" . $ESTADO . "', OBSERVACION_RESPUESTA = '" . $OBSERVACION_RESPUESTA . "', FECHA_RESPUESTA = '" . $FECHA_RESPUESTA . "' WHERE ID = '" . $ID_NOVEDAD . "'");
			echo mysqli_error($conex);
		}
	?>
</head>

<body>
	<section>
		<blockquote>
			<form name="miformulario" method="post" action="listado_novedades.php" onkeydown="return filtro(2)" target="consulta_inv">
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" style="margin:auto auto;">
					<tr align="center">
						<?php
						if ($privilegios == 1 || $privilegios == 2) {
						?>
							<th width="15%" align="left" class="titulosth" bgcolor="#224a81">
								<div id="movimiento1">
									PAP
									<input name="PAP" type="text" id="PAP" class="tipo1" style="height:20px">
								</div>
							</th>
							<th width="25%" height="44" align="left" bgcolor="#224a81" class="titulosth">NOVEDAD
								<select type="text" name="NOVEDAD" id="NOVEDAD" required="required" style="width:200px; height:25px">
									<option>Seleccione...</option>
									<option>Falta de medicamento en el punto</option>
									<option>Solicitud Muestra Medica</option>
									<option>Consultas medicas</option>
									<option>Apoyo en Sicologia</option>
									<option>Recoleccion de residuos</option>
									<option>Falta de cita medica</option>
									<option>demora en la autorizacion</option>
									<option>demora en la autorizacion de CTC</option>
									<option>Reentrenamiento</option>
									<option>Visita Paciente</option>
									<option>Novedades Varios</option>
								</select>
							</th>
							<th width="25%" align="left" class="titulosth" bgcolor="#224a81">
								<div id="movimiento2">
									PRIORIDAD
									<select type="text" name="PRIORIDAD" id="PRIORIDAD" required="required" style="width:200px; height:25px">
										<option>Seleccione...</option>
										<option>ALTA</option>
										<option>MEDIA</option>
										<option>BAJA</option>
									</select>
								</div>
							</th>
							<th width="26%" align="left" class="titulosth" bgcolor="#224a81">
								<div id="movimiento1">
									ESTADO
									<select name="ESTADO" id="ESTADO" required="required" style="height:25px">
										<option selected="selected">Seleccione...</option>
										<option>NUEVO</option>
										<option>EN PROCESO</option>
										<option>FINALIZADO</option>
									</select>
								</div>
							</th>
						<?php
						}
						?>
						<th width="18%" bgcolor="#224a81">
							<div id="consulta">
								<input type="submit" name="buscar" id="buscar" value="Consultar" class="btn_buscar" title="BUSCAR" />
							</div>
						</th>
					</tr>
					<tr>
						<th colspan="6">
							<iframe src="listado_novedades.php" name="consulta_inv" id="consulta_inv" class="ifra2"></iframe>
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