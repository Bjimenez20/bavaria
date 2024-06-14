<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
	<link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
	<link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
	<style>
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
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
?>

<body>
	<div>
		<img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
	</div>
	<form name="solicitud" id="solicitud" method="post" style="width:100%; margin-top:50px;">
		<?php
		$ID_PACIENTE = base64_decode($xxx);
		$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_movimientos AS M
		INNER JOIN ipsen_referencia AS R ON R.ID_REFERENCIA=M.ID_REFERENCIA_FK
		INNER JOIN ipsen_paciente_movimientos AS PM ON PM.ID_MOVIMIENTOS_FK=M.ID_MOVIMIENTOS
		INNER JOIN ipsen_pacientes AS P ON P.ID_PACIENTE=PM.ID_PACIENTE_FK
		WHERE M.TIPO_MOVIMIENTO='2' AND PM.ID_PACIENTE_FK='$ID_PACIENTE' ORDER BY M.FECHA_MOVIMIENTO ASC");
		echo mysqli_error($conex);
		$SELECT_SOLICITUDES = "SELECT * FROM ipsen_movimientos AS M
		INNER JOIN ipsen_referencia AS R ON R.ID_REFERENCIA=M.ID_REFERENCIA_FK
		INNER JOIN ipsen_paciente_movimientos AS PM ON PM.ID_MOVIMIENTOS_FK=M.ID_MOVIMIENTOS
		INNER JOIN ipsen_pacientes AS P ON P.ID_PACIENTE=PM.ID_PACIENTE_FK
		WHERE M.TIPO_MOVIMIENTO='2' AND PM.ID_PACIENTE_FK='$ID_PACIENTE' ORDER BY M.FECHA_MOVIMIENTO ASC LIMIT";
		$url = "../presentacion/form_productos_paciente.php";
		$num_total = mysqli_num_rows($SELECT_SOLICITUDES_TOTAL);
		if ($num_total > 0) {
		?>
			<br><br><br><br><br><br><b></b><br>
			<table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
				<tr>
					<th class="botones"># De Guia</th>
					<th class="botones">SERIAL PRODUCTO</th>
					<th class="botones">NOMBRE PRODUCTO</th>
					<th class="botones">NOMBRE MEDICAMENTO</th>
					<th class="botones">CANTIDAD</th>
					<th class="botones">PAP PACIENTE</th>
					<th class="botones">DIRECCION</th>
					<th class="botones">DESTINATARIO</th>
					<th class="botones">FECHA MOVIMIENTO</th>
					<th class="botones">ESTADO</th>
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
					<tr align="center">
						<td><?php
							echo "\n<input type=hidden name='id$x' value='" . $fila1["ID_MOVIMIENTOS"] . "'>"; ?>
							<input type="hidden" name="<?php echo "id" . $x; ?>" value="<?php echo $fila1["ID_MOVIMIENTOS"] ?>" />
							<?php echo $fila1['NO_REMICION'] ?>
						</td>
						<td>
							<?php
							$ver = $fila1['ID_INVENTARIO_FK'];
							$selec = mysqli_query($conex, "SELECT * FROM ipsen_inventario WHERE ID_INVENTARIO='$ver'");
							while ($dat = mysqli_fetch_array($selec)) {
								echo $serial = $dat['CODIGO_PRODUCTO'];
							}
							?>
						</td>
						<td><?php echo $fila1['MATERIAL'] ?></td>
						<td><?php echo $fila1['NOMBRE_REFERENCIA'] ?></td>
						<td>
							1
						</td>
						<td><?php echo 'PAP' . $fila1['ID_PACIENTE'];               ?>
							<input type="hidden" name="<?php echo "ID_PACIENTE" . $x; ?>" value="<?php echo $fila1["ID_PACIENTE"] ?>" />
						</td>
						<td><?php echo $fila1['DIRECCION_DESTINATARIO'] ?></td>
						<td><?php echo $fila1['DESTINATARIO'] ?></td>
						<td><?php echo $fila1['FECHA_MOVIMIENTO'] ?></td>
						<td><?php echo $fila1['ESTADO_MOVIMIENTO'] ?></td>
					</tr>
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
	</form>
</body>

</html>