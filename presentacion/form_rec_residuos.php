<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/estilos_residuos.css" />
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
	?>
</head>
<body>
	<section>
		<form name="miformulario" method="post" action="../logica/consutas_pacientes.php" onkeydown="return filtro(2)" target="consulta_inv" class="letra">
			<table width="90%" border="0" align="center" cellpadding="2" cellspacing="1">
				<tr>
					<th width="25%" align="left" class="titulosth" bgcolor="#2FACBC">
						<span style="color:#FFF">NOMBRE</span>
						<input name="nombre" type="text" id="nombre" />
					</th>
					<th width="35%" align="left" class="titulosth" bgcolor="#2FACBC">
						<span style="color:#FFF">DOCUMENTO</span>
						<input name="documento" type="text" id="documento" />
					</th>
					<th width="30%" align="left" class="titulosth" bgcolor="#2FACBC">
						<span style="color:#FFF">TELEFONO</span>
						<input name="telefono" type="text" id="telefono" />
					</th>
					<th width="10%" bgcolor="#2FACBC">
						<input type="submit" name="buscar" id="buscar" value="Consultar" class="btn_buscar" title="BUSCAR" />
						<input type="submit" name="descargar" id="descargar" value="Exportar" class="btn_exp" title="DESCARGAR" />
					</th>
				</tr>
				<tr>
					<th colspan="6">
						<iframe class="ifra" name="consulta_inv" id="consulta_inv"></iframe>
					</th>
				</tr>
			</table>
		</form>
	</section>
</body>
</html>