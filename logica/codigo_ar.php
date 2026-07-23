<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>BAVARIA</title>
	<script src="js/jquery.js" type="text/javascript"></script>
	<style>
		.aviso3 {
			font-size: 130%;
			font-weight: bold;
			color: #11a9e3;
			text-transform: uppercase;
			font-family: Tahoma, Geneva, sans-serif;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}

		.letra {
			font-family: Tahoma, Geneva, sans-serif;
		}

		html {
			background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}

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
	<SCRIPT>
		function cerrar() {
			window.close();
		}
	</SCRIPT>
	<script type="text/javascript">
		function crear_codigo() {
			var codigo = $('#CODIGO_ARGUS').val();
			var ID = $('#ID').val();
			var id_paciente = $('#id_paciente').val();
			$("#respuesta").html('<img src="imagenes/cargando.gif" />');
			$.ajax({
				url: 'guardar_codigo.php',
				data: {
					cod: codigo,
					id: ID,
					id_paciente: id_paciente
				},
				type: 'post',
				beforeSend: function() {
					$("#respuesta").html("Procesando, espere por favor" + '<img src="imagenes/cargando.gif" />');
				},
				success: function(data) {
					$('#respuesta').html('Se a registrado el codigo correctamente ' + data);
				}
			})
		}
		$(document).ready(function() {
			$('#ok').click(function() {
				alert('ok');
				crear_codigo();
			});
		});
	</script>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$ID_GESTION = base64_decode($xx);
$paciente = base64_decode($xxp);
$dt_1DiasDespues = date('Y-m-d', strtotime('-1 day'));
?>

<body>
	<div>
		<img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
	</div>
	<br />
	<br />
	<center>
		<input name="id_paciente" id="id_paciente" type="text" max="25" style="width:80%;visibility:hidden;" value="<?php echo $paciente ?>" class="letra" />
		<br />
		<input name="ID" id="ID" type="text" max="25" style="width:80%;visibility:hidden;" value="<?php echo $ID_GESTION ?>" class="letra" />
		<br />
		<label class="letra">CODIGO ARGUS</label>
		<input name="CODIGO_ARGUS" id="CODIGO_ARGUS" type="text" maxlength="25" style="width:80%" class="letra" />
		<br />
		<br />
		<div id="respuesta" style="width:80%; margin:auto auto" class="aviso3">
			<img src="imagenes/CHULO.png" id="ok" width="115" height="118" title="Guardar Codigo" />
		</div>
	</center>
</body>

</html>