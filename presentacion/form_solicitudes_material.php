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
		//alert(porh);
		$(document).ready(function() {
			$('#consulta_sol').css('height', porh);
			$('#TIPO_SOLICITUD').change(function() {
				var tipo = $('#TIPO_SOLICITUD').val();
				$('#fecha_ini').val('');
				$('#fecha_fin').val('');
				if (tipo == 'ENTREGADO') {
					$('#fecha_fin').prop('required', false);
					$('#fecha_ini').prop('required', false);
					$('#fecha2').css('display', 'none');
					$('#fecha').css('display', 'none');
				}
				if (tipo != 'ENTREGADO' && tipo != '' && tipo != 'PENDIENTES') {
					$('#fecha2').css('display', 'inline-block');
					$('#fecha').css('display', 'inline-block');
					$('#fecha_fin').prop('required', true);
					$('#fecha_ini').prop('required', true);
				}
				if (tipo == 'PENDIENTES') {
					$('#fecha2').css('display', 'inline-block');
					$('#fecha').css('display', 'inline-block');
					$('#fecha_fin').prop('required', false);
					$('#fecha_ini').prop('required', false);
				}
			});
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
			font-family: avenir;
			font-size: 100%;
			font-style: normal;
			line-height: normal;
			font-weight: normal;
			font-variant: normal;
			text-align: center;
		}
		select {
			font-size: 100%;
			border-radius: 5px;
		}
	</style>
	<script type="text/jscript">
		$(document).ready(function() {});
	</script>
</head>
<?PHP
require('../datos/parse_str.php');
if ($privilegios != '' && $usua != '') {
?>
	<body>
		<section>
			<blockquote>
				<form name="miformulario" id="miformulario" method="post" action="lista_solicitudes_material.php" onkeydown="return filtro(2)" target="consulta_sol">
					<table width="85%" align="center" cellpadding="2" cellspacing="1" style="border:1px transparent solid;margin:auto auto;">
						<tr style="border:2px #0C7890 solid;">
							<th class="titulosth" colspan="2" bgcolor="#2facbc" style="padding:10px;">
								TIPO DE SOLICITUD
								<select name="TIPO_SOLICITUD" id="TIPO_SOLICITUD" class="tipo1" style="width:74%;" required="required">
									<option value="" style="color:#999">SELECCIONE</option>
									<option>DESPACHADOS</option>
									<option>ENTREGADO</option>
									<option>PENDIENTES</option>
								</select>
							</th>
							<th bgcolor="#2facbc" rowspan="2">
								<center>
									<input type="submit" name="buscar" id="buscar" value="Consultar" class="btn_buscar" title="BUSCAR" />
									<?php
									if ($privilegios == 3) {
									?>
										<input type="submit" name="exportar" id="exportar" value="Consultar" class="btn_exp" title="BUSCAR" formaction="reporte_excel_pendientes.php" />
									<?php
									}
									?>
								</center>
							</th>
						</tr>
						<tr style="border:2px #0C7890 solid;">
							<th bgcolor="#2facbc">
								<div style="display:none" id="fecha">
									FECHA INICIO
									<input name="fecha_ini" type="date" id="fecha_ini" / title="INGRESE LA FECHA INICIO" class="tipo1" style="width:57%;height:20px" required="required" />
								</div>
							</th>
							<th bgcolor="#2facbc">
								<div style="display:none" id="fecha2">
									FECHA FIN
									<input name="fecha_fin" type="date" id="fecha_fin" title="INGRESE LA FECHA FIN" class="tipo1" style="width:57%;height:20px" required="required" />
								</div>
							</th>
						</tr>
						<tr>
							<th colspan="4">
								<!--<iframe name="consulta_sol" id="consulta_sol" src="lista_solicitudes_material.php"  class="ifra2"></iframe>-->
								<iframe name="consulta_sol" id="consulta_sol" src="" class="ifra2"></iframe>
							</th>
						</tr>
					</table>
				</form>
			</blockquote>
		</section>
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