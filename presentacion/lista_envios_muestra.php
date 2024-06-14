<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
	<link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
	<link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
	<script src="js/jquery.js" type="text/javascript"></script>
	<style>
		.btn_actualizar2 {
			padding-top: 2%;
			background-image: url(../presentacion/imagenes/BOTON_ACTUALIZAR.png);
			background-repeat: no-repeat;
			width: 145px;
			height: 50px;
			color: transparent;
			background-color: transparent;
			border-radius: 5px;
			border: 1px solid transparent;
		}

		.error {
			font-size: 130%;
			font-weight: bold;
			color: red;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}

		html {
			background: url(../presentacion/imagenes/background.png) no-repeat fixed center;
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
	<script type="text/javascript">
		function crear_codigo() {
			var ID_ENVIO = $('#ID_ENVIO').val();
			var ESTADO = $('#ESTADO').val();
			var FECHA_ENTREGA = $('#FECHA_ENTREGA').val();
			alert('ok2');
			$("#respuesta").html('<img src="imagenes/cargando.gif" />');
			$.ajax({
				url: 'actualizar_envio_muestra.php',
				data: {
					ID_ENVIO: ID_ENVIO,
					ESTADO: ESTADO,
					FECHA_ENTREGA: FECHA_ENTREGA
				},
				type: 'post',
				beforeSend: function() {
					$("#respuesta").html("Procesando, espere por favor" + '<img src="imagenes/cargando.gif" />');
				},
				success: function(data) {
					$('#respuesta').html('Se a Actualizado correctamente ' + data);
				}
			})
		}
	</script>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
if (isset($_POST['registrar'])) {
	$ID_ENVIO = $_POST['ID_ENVIO'];
	$ESTADO = $_POST['ESTADO'];
	$FECHA_ENTREGA = $_POST['FECHA_ENTREGA'];
	$OBSERVACION = $_POST['OBSERVACION'];
	$update = mysqli_query($conex, "UPDATE ipsen_envio_muestra
					   SET ESTADO = '" . $ESTADO . "',
					   FECHA_ENTREGA = '" . $FECHA_ENTREGA . "', OBSERVACION = '" . $OBSERVACION . "'
					   WHERE ID_ENVIO_MUESTRA='$ID_ENVIO'");
	echo "Datos Actualizados.";
	echo mysqli_error($conex);
}
?>

<body>
	<div>
		<img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
	</div>
	<?php
	$ID_PACIENTE = base64_decode($xxx);
	$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_envio_muestra WHERE PAP='$ID_PACIENTE' ORDER BY FECHA_CREACION ASC");
	echo mysqli_error($conex);
	$SELECT_SOLICITUDES = "SELECT * FROM ipsen_envio_muestra WHERE PAP='$ID_PACIENTE' ORDER BY FECHA_CREACION ASC LIMIT";
	$url = "../presentacion/lista_envios_muestra.php";
	$num_total = mysqli_num_rows($SELECT_SOLICITUDES_TOTAL);
	if ($num_total > 0) {
	?>
		<br><br><br><br><br><br><b></b><br>
		<table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
			<tr>
				<th class="botones">PAP</th>
				<th class="botones">ESTATUS PACIENTE</th>
				<th class="botones">DOSIS</th>
				<th class="botones">FECHA SALIDA</th>
				<th class="botones">FECHA ENTREGA</th>
				<th class="botones">NO LOTE</th>
				<th class="botones">FECHA VEN</th>
				<th class="botones">ESTADO</th>
				<th class="botones">USUARIO</th>
				<th class="botones">OBSERVACION</th>
				<th class="botones">ACTUALIZAR</th>
			</tr>
			<?PHP
			$TAMANO_PAGINA = 10;
			$pagina = false;
			if (isset($_GET["pagina"]))
				$pagina = $_GET["pagina"];
			if (!$pagina) {
				$inicio = 0;
				$pagina = 1;
			} else {
				$inicio = ($pagina - 1) * $TAMANO_PAGINA;
			}
			$total_paginas = ceil($num_total / $TAMANO_PAGINA);
			$consulta = "$SELECT_SOLICITUDES " . $inicio . "," . $TAMANO_PAGINA;
			$consulta_sol = mysqli_query($conex, $consulta);
			$x = 0;
			while ($fila1 = mysqli_fetch_array($consulta_sol)) {
				$x = $x + 1;
			?>
				<form name="solicitud" id="solicitud" method="post" action="../presentacion/lista_envios_muestra.php?xxx=<?php echo base64_encode($ID_PACIENTE) ?>" style="width:100%; margin-top:50px;">
					<tr align="center" style="background:#faf6f3;">
						<td><?php
							?>
							<input type="text" name="ID_ENVIO" id="ID_ENVIO" value="<?php echo $fila1["ID_ENVIO_MUESTRA"] ?>" style="display:none;" />
							<?php echo 'PAP' . $fila1['PAP']; ?>
						</td>
						<td><?php echo $fila1['ESTATUS_PACIENTE']; ?></td>
						<td><?php echo $fila1['DOSIS'] ?></td>
						<td><?php echo $fila1['FECHA_SALIDA'] ?></td>
						<td>
							<input name="FECHA_ENTREGA" type="date" id="FECHA_ENTREGA" value="<?php echo $fila1['FECHA_ENTREGA'] ?>" class="tipo1" style="height:20px" />
						</td>
						<td><?php echo $fila1['NO_LOTE'] ?></td>
						<td><?php echo $fila1['FECHA_VENCIMIENTO'] ?></td>
						<td>
							<select type="text" name="ESTADO" id="ESTADO" required="required" style="width:200px; height:25px">
								<option><?php echo $fila1['ESTADO'] ?></option>
								<option>Entrega Paciente</option>
								<option>Cancelado</option>
							</select>
						</td>
						<td><?php echo $fila1['USUARIO'] ?></td>
						<td><textarea name="OBSERVACION" cols="20%" rows="2" required="required" id="OBSERVACION"><?php echo $fila1['OBSERVACION'] ?></textarea></td>
						<td>
							<input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_actualizar2" />
						</td>
					</tr>
				</form>
			<?php
			}
			?>
			<tr bgcolor="#FFFFFF" class="titulo" align="center">
				<td colspan="3" class="botones">Se encontraron Registros <?php echo $num_total; ?></td>
				<td colspan="8" class="botones">
					<?php
					if ($total_paginas > 1) {
						if ($pagina != 1)
							echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '&xxx=' . base64_encode($ID_PACIENTE) . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
						for ($i = 1; $i <= $total_paginas; $i++) {
							if ($pagina == $i)
								echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
							else
								echo '  <a href="' . $url . '?pagina=' . $i . '&xxx=' . base64_encode($ID_PACIENTE) . '" style="font-size:110%;">' . $i . '</a>  ';
						}
						if ($pagina != $total_paginas)
							echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '&xxx=' . base64_encode($ID_PACIENTE) . '"><img src="../presentacion/imagenes/der.gif" border="0"></a>';
					}
					echo '</p>';
					?>
				</td>
			</tr>
		<?php
	} else {
		?>
			<span style="margin-top:1%;">
				<center>
					<img src="../presentacion/imagenes/advertencia2.png" style="width:70px; margin-top:1%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">
				<span style="border-left-color:#fff">NO SE ENCUENTRAR REGISTROR CON ESTA INFORMACI&Oacute;N.</span>
			</p>
		<?php
	}
		?>
		</table>
</body>

</html>