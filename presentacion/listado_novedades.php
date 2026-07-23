<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>BAVARIA</title>
	<link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
	<link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
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
	</style>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$hoy = date('Y-m-d');
if (isset($_POST['buscar'])) {
	$PAP = $_POST['PAP'];
	$NOVEDAD = $_POST['NOVEDAD'];
	$PRIORIDAD = $_POST['PRIORIDAD'];
	$ESTADO = $_POST['ESTADO'];
} else {
	$PAP = "";
	$NOVEDAD = "Seleccione...";
	$PRIORIDAD = "Seleccione...";
	$ESTADO = "Seleccione...";
}
?>

<body>
	<form name="solicitud" id="solicitud" method="post" action="../presentacion/novedades_correo.php?artid=<?php echo $fila1['ID']; ?>" target="info">
		<?php
		if ($PAP == "" and $NOVEDAD == "Seleccione..." and $PRIORIDAD == "Seleccione..." and $ESTADO == "Seleccione...") {
			$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades  ORDER BY FECHA_RESPUESTA ASC");
			echo mysqli_error($conex);
			$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades ORDER BY FECHA_RESPUESTA ASC LIMIT";
		}
		if ($PAP != "") {
			$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE PAP = '" . $PAP . "' ORDER BY FECHA_RESPUESTA ASC");
			echo mysqli_error($conex);
			$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE PAP = '" . $PAP . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
		}
		if ($PAP == "" and $NOVEDAD != "Seleccione..." and $PRIORIDAD == "Seleccione..." and $ESTADO == "Seleccione...") {
			$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE NOVEDADES = '" . $NOVEDAD . "' ORDER BY FECHA_RESPUESTA ASC");
			echo mysqli_error($conex);
			$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE NOVEDADES = '" . $NOVEDAD . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
		}
		if ($PAP == "" and $NOVEDAD == "Seleccione..." and $PRIORIDAD != "Seleccione..." and $ESTADO == "Seleccione...") {
			if ($PRIORIDAD == "ALTA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA < '" . $hoy . "' AND ESTADO != 'FINALIZADO' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA < '" . $hoy . "' AND ESTADO != 'FINALIZADO' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
			if ($PRIORIDAD == "MEDIA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA = '" . $hoy . "' AND ESTADO != 'FINALIZADO' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA = '" . $hoy . "' AND ESTADO != 'FINALIZADO' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
			if ($PRIORIDAD == "BAJA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA > '" . $hoy . "' AND ESTADO != 'FINALIZADO' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA > '" . $hoy . "' AND ESTADO != 'FINALIZADO' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
		}
		if ($PAP == "" and $NOVEDAD == "Seleccione..." and $PRIORIDAD == "Seleccione..." and $ESTADO != "Seleccione...") {
			$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC");
			echo mysqli_error($conex);
			$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
		}
		if ($PAP == "" and $NOVEDAD != "Seleccione..." and $PRIORIDAD != "Seleccione..." and $ESTADO == "Seleccione...") {
			if ($PRIORIDAD == "ALTA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA < '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND NOVEDADES = '" . $NOVEDAD . "' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA < '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND NOVEDADES = '" . $NOVEDAD . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
			if ($PRIORIDAD == "MEDIA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA = '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND NOVEDADES = '" . $NOVEDAD . "' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA = '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND NOVEDADES = '" . $NOVEDAD . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
			if ($PRIORIDAD == "BAJA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA > '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND NOVEDADES = '" . $NOVEDAD . "' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA > '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND NOVEDADES = '" . $NOVEDAD . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
		}
		if ($PAP == "" and $NOVEDAD != "Seleccione..." and $PRIORIDAD == "Seleccione..." and $ESTADO != "Seleccione...") {
			$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE NOVEDADES = '" . $NOVEDAD . "' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC");
			echo mysqli_error($conex);
			$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE NOVEDADES = '" . $NOVEDAD . "' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
		}
		if ($PAP == "" and $NOVEDAD == "Seleccione..." and $PRIORIDAD != "Seleccione..." and $ESTADO != "Seleccione...") {
			if ($PRIORIDAD == "ALTA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA < '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA < '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
			if ($PRIORIDAD == "MEDIA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA = '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA = '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
			if ($PRIORIDAD == "BAJA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA > '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA > '" . $hoy . "' AND ESTADO != 'FINALIZADO' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
		}
		if ($PAP == "" and $NOVEDAD != "Seleccione..." and $PRIORIDAD != "Seleccione..." and $ESTADO != "Seleccione...") {
			if ($PRIORIDAD == "ALTA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA < '" . $hoy . "' AND NOVEDADES = '" . $NOVEDAD . "' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA < '" . $hoy . "' AND NOVEDADES = '" . $NOVEDAD . "' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
			if ($PRIORIDAD == "MEDIA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA = '" . $hoy . "' AND NOVEDADES = '" . $NOVEDAD . "' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA = '" . $hoy . "' AND NOVEDADES = '" . $NOVEDAD . "' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
			if ($PRIORIDAD == "BAJA") {
				$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA > '" . $hoy . "' AND NOVEDADES = '" . $NOVEDAD . "' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC");
				echo mysqli_error($conex);
				$SELECT_SOLICITUDES = "SELECT * FROM ipsen_novedades WHERE FECHA_RESPUESTA > '" . $hoy . "' AND NOVEDADES = '" . $NOVEDAD . "' AND ESTADO = '" . $ESTADO . "' ORDER BY FECHA_RESPUESTA ASC LIMIT";
			}
		}
		$url = "../presentacion/listado_novedades.php";
		$num_total = mysqli_num_rows($SELECT_SOLICITUDES_TOTAL);
		if ($num_total > 0) {
		?>
			<table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
				<tr>
					<th class="botones">PAP</th>
					<th class="botones">ASUNTO</th>
					<th class="botones">PRODUCTO</th>
					<th class="botones">NOVEDAD</th>
					<th class="botones">OBSERVACIONES</th>
					<th class="botones">FECHA REPORTE</th>
					<th class="botones">FECHA RESPUESTA</th>
					<th class="botones">OBSERVACION RESPUESTA</th>
					<th class="botones">ESTADO</th>
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
					<tr align="center">
						<input type="hidden" name="ID_NOVEDAD" value="<?php echo $fila1["ID"] ?>" />
						<td>
							<?php echo 'PAP' . $fila1['PAP'] ?>
						</td>
						<td>
							<?php echo $fila1['ASUNTO'] ?>
						</td>
						<td>
							<?php echo $fila1['PRODUCTO'] ?>
						</td>
						<td>
							<?php echo $fila1['NOVEDADES'] ?>
						</td>
						<td>
							<?php echo $fila1['OBSERVACIONES'] ?>
						</td>
						<td>
							<?php echo $fila1['FECHA_REPORTE']; ?>
						</td>
						<?php if ($fila1['FECHA_RESPUESTA'] < $hoy and $fila1['ESTADO'] != "FINALIZADO") { ?>
							<td style="background:#F30">
								<?php echo $fila1['FECHA_RESPUESTA'] ?>
							</td>
						<?php } ?>
						<?php if ($fila1['FECHA_RESPUESTA'] == $hoy and $fila1['ESTADO'] != "FINALIZADO") { ?>
							<td style="background:#FC0">
								<?php echo $fila1['FECHA_RESPUESTA'] ?>
							</td>
						<?php } ?>
						<?php if ($fila1['FECHA_RESPUESTA'] <= $hoy and $fila1['ESTADO'] == "FINALIZADO") { ?>
							<td>
								<?php echo $fila1['FECHA_RESPUESTA'] ?>
							</td>
						<?php } ?>
						<?php if ($fila1['FECHA_RESPUESTA'] > $hoy) { ?>
							<td>
								<?php echo $fila1['FECHA_RESPUESTA'] ?>
							</td>
						<?php } ?>
						<td>
							<?php echo $fila1['OBSERVACION_RESPUESTA'] ?>
						</td>
						<?php if ($fila1['ESTADO'] == "NUEVO") { ?>
							<td style="background:#090">
							<?php }
						if ($fila1['ESTADO'] == "EN PROCESO") { ?>
							<td style="background:#F90">
							<?php }
						if ($fila1['ESTADO'] == "FINALIZADO") { ?>
							<td style="background:#CCC">
							<?php }
						echo $fila1['ESTADO'] ?>
							</td>
							<td>
								<a href="../presentacion/novedades_actualizar.php?artid=<?php echo base64_encode($fila1['ID']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="25" height="25" /></a>
							</td>
					</tr>
				<?php
				}
				?>
				<tr bgcolor="#FFFFFF" class="titulo" align="center">
					<td colspan="5" class="botones">Se encontraron Registros <?php echo $num_total; ?></td>
					<td colspan="6" class="botones">
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
					<br><br><br><br><br><br>
					<center>
						<img src="../presentacion/imagenes/advertencia2.png" style="width:70px; margin-top:1%;" />
						<br>
					</center>
				</span>
				<p class="error" style=" width:90%; margin:auto auto;">
					<span style="border-left-color:#fff">NO SE ENCUENTRAR REGISTROR CON ESTA INFORMACI&Oacute;N.</span>
				</p>
			<?php
		}
			?>
			</table>
	</form>
</body>

</html>