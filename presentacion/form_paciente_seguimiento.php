<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
	<link rel="stylesheet" href="css/estilos_menu.css" />
	<title>BAVARIA</title>
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
			font-family: Tahoma, Geneva, sans-serif;
			padding: 2px;
			color: #FFF;
			font-size: 100%;
			font-style: normal;
			line-height: normal;
			font-weight: normal;
			font-variant: normal;
			text-align: center;
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
				if (confirm('�Estas seguro de cerrar sesion?')) {
					window.location = "../index.php";
				} else {}
			});
		});
	</script>
	<?php
	if ($privilegios != '' && $usua != '') {
		require('../datos/parse_str.php');
		$usua = strtoupper($usua);
	?>
</head>

<body>
	<section>
		<blockquote>
			<form name="miformulario" method="post" action="listado_pacientes.php" onkeydown="return filtro(2)" target="consulta_inv" class="letra">

				<?php
				if ($privilegios == 4) {
				?>
					<table width="20%" border="0" align="left" cellpadding="2" cellspacing="1" style="margin:auto auto;" class="letra">
						<tr align="left">
							<th width="15%" align="left" class="titulosth" bgcolor="#1D5C75">
								<div id="movimiento1">
									PAP
									<input name="PAP" type="text" id="PAP" placeholder="Buscar por PAP" class="tipo1" style="height:20px">
								</div>
							</th>
							<th width="5%" bgcolor="#1D5C75">
								<div id="consulta">
									<input type="submit" name="buscar" id="buscar" value="Consultar" class="btn_buscar" title="BUSCAR" />
								</div>
							</th>
						</tr>
					</table>
				<?php
				}
				?>
				<?php
				if ($privilegios == 1 || $privilegios == 2 || $privilegios == 3) {
				?>
					<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" style="margin:auto auto;" class="letra">
						<tr align="center">
							<th width="10%" align="left" class="titulosth" bgcolor="#1D5C75">
								<div id="movimiento1">
									PAP
									<input name="PAP" type="text" id="PAP" class="tipo1" style="height:20px">
								</div>
							</th>
							<th width="20%" height="44" align="left" bgcolor="#1D5C75" class="titulosth">NOMBRE
								<input name="nombre" type="text" id="nombre" class="tipo1" style="height:20px" />
							</th>
							<th width="15%" align="left" class="titulosth" bgcolor="#1D5C75">
								<div id="movimiento2">
									DOCUMENTO
									<input name="documento" type="text" id="documento" class="tipo1" style="height:20px" />
								</div>
							</th>
							<th width="15%" align="left" class="titulosth" bgcolor="#1D5C75">
								<div id="movimiento1">
									TELEFONO
									<input name="telefono" type="text" id="telefono" class="tipo1" style="height:20px">
								</div>
							</th>
							<th width="5%" bgcolor="#1D5C75">
								<div id="consulta">
									<input type="submit" name="buscar" id="buscar" value="Consultar" class="btn_buscar" title="BUSCAR" />
								</div>
							</th>
						<?php
					}
						?>
						</tr>
						<tr>
							<th colspan="5">
								<iframe src="listado_pacientes.php" name="consulta_inv" id="consulta_inv" class="ifra2"></iframe>
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