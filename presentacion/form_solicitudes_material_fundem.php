<?php
include('../logica/session.php');
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
			$('#consulta_sol').css('height', porh);
			$('#TIPO_SOLICITUD').change(function() {
				var tipo = $('#TIPO_SOLICITUD').val();
				if (tipo == 'ENTREGADO') {
					$('#fecha_fin').prop('required', false);
					$('#fecha_ini').prop('required', false);
					$('#fecha2').css('display', 'none');
					$('#fecha').css('display', 'none');
				}
				if (tipo != 'ENTREGADO' && tipo != '') {
					$('#fecha2').css('display', 'inline-block');
					$('#fecha').css('display', 'inline-block');
					$('#fecha_fin').prop('required', true);
					$('#fecha_ini').prop('required', true);
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
			font-family: Tahoma, Geneva, sans-serif;
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
				<form name="miformulario" id="miformulario" method="post" action="lista_solicitudes_material_fundem.php" onkeydown="return filtro(2)" target="consulta_sol" class="letra">
					<table width="85%" align="center" cellpadding="2" cellspacing="1" style="border:1px transparent solid;margin:auto auto;" class="letra">
						<tr style="border:2px #0C7890 solid;">
							<th class="titulosth" colspan="2" bgcolor="#2facbc" style="padding:10px;">
								<span class="letra">TIPO DE SOLICITUD</span>
								<select name="TIPO_SOLICITUD" id="TIPO_SOLICITUD" class="tipo1" style="width:74%;" required="required">
									<option value="" style="color:#999">SELECCIONE</option>
									<option>DESPACHADOS</option>
									<option>ENTREGADO</option>
									<option>PENDIENTES</option>
								</select>
							</th>
							<th bgcolor="#2facbc">
								<center>
									<input type="submit" name="buscar" id="buscar" value="Consultar" class="btn_buscar" title="BUSCAR" />
								</center>
							</th>
						</tr>
						<th colspan="4">
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