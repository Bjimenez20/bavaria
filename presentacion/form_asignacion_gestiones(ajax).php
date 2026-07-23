<?php
require_once('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>BAVARIA</title>
	<script src="js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#btn2").click(function() {
				cambio_activo();
			});
			$("#btn").click(function() {
				cambio_inactivo();
			});
			$("#btn3").click(function() {
				alert('ok');
			});
		});

		function cambio_activo() {
			var usuario = $('#usu').val();
			$.ajax({
				url: 'cambio_estado_logeo_desc.php',
				data: {
					usuario: usuario
				},
				type: 'post',
				beforeSend: function() {
					$("#tabla").html("Procesando, espere por favor" + '<img src="imagenes/cargando.gif" />');
				},
				success: function(data) {
					$('#tabla').html(data);
				}
			})
		}

		function cambio_inactivo() {
			var usuario = $('#usu').val();
			$.ajax({
				url: 'cambio_estado_logeo_act.php',
				data: {
					usuario: usuario
				},
				type: 'post',
				beforeSend: function() {
					$("#tabla").html("Procesando, espere por favor" + '<img src="imagenes/cargando.gif" />');
				},
				success: function(data) {
					$('#tabla').html(data);
				}
			})
		}
	</script>
	<style>
		td {
			padding: 5px;
			text-transform: uppercase;
			text-align: center;
		}

		th {
			padding: 5px;
		}
	</style>
	<script>
		$(document).ready(function() {
			$('#cant').change(function() {
				var ini = $('#total_pac').val();
				var cant = $('#cant').val();
				var total = ini / cant;
				var total = Math.floor(total);
				$('#total').val(total);
			});
		});
	</script>
</head>
<?php
require('../datos/parse_str.php');
require_once("../datos/conex.php");
$hoy = date('Y-m-d');
$select_usu = mysqli_query($conex, "select USER,NOMBRES,APELLIDOS,ESTADO,PRIVILEGIOS,ESTADO_LOGIN FROM usuario WHERE ESTADO='1' AND PRIVILEGIOS='2'");
echo mysqli_error($conex);
$nreg_usu = mysqli_num_rows($select_usu);
$select_gestiones = mysqli_query($conex, "SELECT ID_GESTION FROM GESTION WHERE FECHA_PROGRAMADA_GESTION='" . $hoy . "'");
echo mysqli_error($conex);
$nreg_pac = mysqli_num_rows($select_gestiones);
?>

<body class="body" style="width:75.9%;margin-left:16%;">
	<form id="asignacion" name="asignacion" action="../logica/insertar_datos.php" method="post">
		<center>
			<span style="font-size:165%; margin-left:50px"> FECHA ACTUAL</span>
			<input type="date" value="<?php echo $hoy ?>" name="fecha_actual" id="fecha_actual" style="border:1px solid transparent; background-color:transparent; color:#000; text-align:center; font-size:200%;" readonly="readonly" />
			</div>
			<br />
			<br />
			<br />
			<br />
			<span style="font-size:165%;"> CANTIDAD DE GESTION <?php echo $nreg_pac ?></span>
			<br />
			<br />
			<br />
			<br />
		</center>
		<center>
			<table style="width:50%;; border:#000 solid 1px;" rules="all" id="tabla">
				<tr>
					<th colspan="4">
						USUARIOS DISPONIBLES
					</th>
				</tr>
				<tr>
					<th>
						USUARIO(S)
					</th>
					<th>
						NOMBRE(S) Y APELLIDO(S)
					</th>
					<th>
						ESTADO LOGIN
					</th>
				</tr>
				<tr>
					<?php
					if ($nreg_usu > 0) {
						while ($fila = (mysqli_fetch_array($select_usu))) {
					?>
				<tr>
					<td>
						<?php echo $fila['USER']; ?>
						<input type="hidden" value="<?php echo $fila['USER'] ?>" id="usu" name="usu" />
					</td>
					<td><?php echo $fila['NOMBRES'] . ' ' . $fila['APELLIDOS']; ?></td>
					<td>
						<?php
							$estado = $fila['ESTADO_LOGIN'];
							if ($estado == 'OUT') {
						?>
							<img id="btn" src="imagenes/OFF.png" style="width:100PX" />
						<?PHP
							}
							if ($estado == 'IN') {
						?>
							<img id="btn2" src="imagenes/ON.png" style="width:100PX" />
						<?PHP
							}
						?>
					</td>
				</tr>
			<?php
						}
					} else {
			?>
			<tr>
				<td colspan="1">
					SIN REGISTROS
				</td>
				<td colspan="1">
					SIN REGISTROS
				</td>
				<td colspan="1">
					SIN REGISTROS
				</td>
			</tr>
		<?php
					}
		?>
		</tr>
			</table>
			<td>
				<center>
					<input type="text" maxlength="2" readonly="readonly" id="total" name="total" style="border:1px solid transparent; background-color:transparent; color:#000; text-align:center" value="0" />
				</center>
			</td>
		</center>
	</form>
</body>

</html>