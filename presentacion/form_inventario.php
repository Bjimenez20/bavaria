<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
			padding: 5px;
			color: #FFF;
			font-family: Tahoma, Geneva, sans-serif;
			font-size: 100%;
			font-style: normal;
			line-height: normal;
			font-weight: normal;
			font-variant: normal;
			text-align: center;
		}
	</style>
	<script type="text/jscript">
		$(document).ready(function() {
			$('#TIPO_CON').change(function() {
				$('#fecha_fin').val('');
				$('#fecha_ini').val('');
				$('#lugar').val('');
				$('#serial_producto').val('');
				$("#TIPO option:eq(0)").attr("selected", "selected");
				$("#lugar option:eq(0)").attr("selected", "selected");
				var tipo_con = $('#TIPO_CON').val();
				if (tipo_con == 'MOVIMIENTO') {
					$('#movimiento').css('display', 'block');
					$('#movimiento1').css('display', 'block');
					$('#movimiento2').css('display', 'block');
					$('#inventario1').css('display', 'none');
					$('#inventario2').css('display', 'none');
					$('#fecha_fin').val('');
					$('#fecha_ini').val('');
					$("#lugar option:eq(0)").attr("selected", "selected");
					$('#serial_producto').val('');
				}
				if (tipo_con == 'DETALLE INVENTARIO') {
					$('#movimiento').css('display', 'none');
					$('#movimiento1').css('display', 'none');
					$('#movimiento2').css('display', 'none');
					$('#inventario1').css('display', 'block');
					$('#inventario2').css('display', 'block');
					$('#fecha_fin').val('');
					$('#fecha_ini').val('');
					$("#lugar option:eq(0)").attr("selected", "selected");
					$('#serial_producto').val('');
				}
				if (tipo_con != 'MOVIMIENTO' && tipo_con != 'DETALLE INVENTARIO') {
					$('#movimiento').css('display', 'none');
					$('#movimiento1').css('display', 'none');
					$('#movimiento2').css('display', 'none');
					$('#inventario1').css('display', 'none');
					$('#inventario2').css('display', 'none');
					$('#fecha_fin').val('');
					$('#fecha_ini').val('');
					$("#lugar option:eq(0)").attr("selected", "selected");
					$('#serial_producto').val('');
					$("#TIPO option:eq(0)").attr("selected", "selected");
				}
				if (tipo_con != '') {
					$('#consulta').css('display', 'block');
				}
			});
		});
	</script>
</head>
<?PHP
require('../datos/parse_str.php');
?>

<body>
	<section>
		<blockquote>
			<form name="miformulario" method="post" action="../logica/consutas_inventario.php" onkeydown="return filtro(2)" target="consulta_inv" class="letra">
				<table width="100%" align="center" cellpadding="2" cellspacing="1" style="border:1px transparent solid;margin:auto auto;">
					<tr style="border:2px #0C7890 solid;">
						<th class="titulosth" colspan="2" bgcolor="#224a81">
							TIPO DE INFORME
							<select name="TIPO_CON" id="TIPO_CON" class="tipo1" style="width:80%;">
								<option value="" style="color:#999">SELECCIONE</option>
								<option>MOVIMIENTO</option>
								<option>DETALLE INVENTARIO</option>
								<option>INVENTARIO</option>
							</select>
						</th>
						<th bgcolor="#224a81">
							<div id="consulta" style="display:none">
								<input type="submit" name="buscar" id="buscar" value="Consultar" class="btn_buscar" title="BUSCAR" />
								<input type="submit" name="descargar" id="descargar" value="Exportar" class="btn_exp" title="DESCARGAR" />
							</div>
						</th>
					</tr>
					<tr align="left" style="border:2px #0C7890 solid">
						<th class="titulosth" bgcolor="#224a81">
							<div style="display:none" id="movimiento">
								TIPO DE ENTRADA
								<select name="TIPO" id="TIPO" class="tipo1" style="height:20px">
									<option value="TODAS" style="color:#999">TODAS</option>
									<option>ENTRADA</option>
									<option>SALIDA</option>
								</select>
							</div>
							<div style="display:none" id="inventario1">
								BUSCAR EN
								<select name="LUGAR" id="LUGAR" class="tipo1" style="width:60%;height:20px">
									<option style="color:#999">TODOS</option>
									<option value="BODEGA">BODEGA</option>
									<option value="PACIENTE">PACIENTE</option>
								</select>
							</div>
						</th>
						<th bgcolor="#224a81">
							<div style="display:none" id="movimiento1">
								FECHA INICIO
								<input name="fecha_ini" type="date" id="fecha_ini" title="INGRESE LA FECHA INICIO" class="tipo1" style="width:55%;height:20px" />
							</div>
							<div style="display:none" id="inventario2">
								SERIAL PRODUCTO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input name="serial_producto" type="text" id="serial_producto" title="INGRESE NUMERO DE SERIAL" class="tipo1" maxlength="16" style="width:55%;height:20px" />
							</div>
						</th>
						<th bgcolor="#224a81">
							<div style="display:none" id="movimiento2">
								FECHA FIN
								<input name="fecha_fin" type="date" id="fecha_fin" title="INGRESE LA FECHA FIN" class="tipo1" style="width:55%;height:20px" />
							</div>
						</th>
					</tr>
					<tr>
						<th colspan="4">
							<iframe name="consulta_inv" id="consulta_inv" class="ifra2"></iframe>
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

</html>