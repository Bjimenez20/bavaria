<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
	<link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
	<style>
		.error {
			font-size: 130%;
			font-weight: bold;
			color: #fb8305;
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
		//$ID_PACIENTE=base64_decode($xxx);
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
		//include('../logica/consultas_solicitudes.php');
		$url = "../presentacion/listado_novedades.php";
		$num_total = mysqli_num_rows($SELECT_SOLICITUDES_TOTAL);
		if ($num_total > 0) {
		?>
			<table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
				<tr>
					<!--<th class="botones">ID</th> -->
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
				//Limito la busqueda
				$TAMANO_PAGINA = 10;
				$pagina = false;
				//examino la pagina a mostrar y el inicio del registro a mostrar
				if (isset($_GET["pagina"]))
					$pagina = $_GET["pagina"];
				if (!$pagina) {
					$inicio = 0;
					$pagina = 1;
				} else {
					$inicio = ($pagina - 1) * $TAMANO_PAGINA;
				}
				//calculo el total de paginas
				$total_paginas = ceil($num_total / $TAMANO_PAGINA);
				//pongo el numero de registros total, el tamaño de pagina y la pagina que se muestra
				/*echo '<h3>Numero de articulos: '.$num_total .'</h3>';
		echo '<h3>En cada pagina se muestra '.$TAMANO_PAGINA.' articulos ordenados por fecha de forma descendente.</h3>';
		echo '<h3>Mostrando la pagina '.$pagina.' de ' .$total_paginas.' paginas.</h3>';*/
				$consulta = "$SELECT_SOLICITUDES " . $inicio . "," . $TAMANO_PAGINA;
				$consulta_sol = mysqli_query($conex, $consulta);
				$x = 0;
				while ($fila1 = mysqli_fetch_array($consulta_sol)) {
					$x = $x + 1;
				?>
					<tr align="center">
						<!--<td>               -->
						<input type="hidden" name="ID_NOVEDAD" value="<?php echo $fila1["ID"] ?>" />
						<!--</td>
                <td><?php //echo $fila1['ID']
					?></td>-->
						<td><?php echo 'PAP' . $fila1['PAP'] ?></td>
						<td><?php echo $fila1['ASUNTO'] ?></td>
						<td><?php echo $fila1['PRODUCTO'] ?></td>
						<td><?php echo $fila1['NOVEDADES'] ?></td>
						<td><?php echo $fila1['OBSERVACIONES'] ?></td>
						<td><?php echo $fila1['FECHA_REPORTE']; ?></td>
						<?php if ($fila1['FECHA_RESPUESTA'] < $hoy and $fila1['ESTADO'] != "FINALIZADO") { ?>
							<td style="background:#F30"><?php echo $fila1['FECHA_RESPUESTA'] ?></td>
						<?php } ?>
						<?php if ($fila1['FECHA_RESPUESTA'] == $hoy and $fila1['ESTADO'] != "FINALIZADO") { ?>
							<td style="background:#FC0"><?php echo $fila1['FECHA_RESPUESTA'] ?></td>
						<?php } ?>
						<?php if ($fila1['FECHA_RESPUESTA'] <= $hoy and $fila1['ESTADO'] == "FINALIZADO") { ?>
							<td><?php echo $fila1['FECHA_RESPUESTA'] ?></td>
						<?php } ?>
						<?php if ($fila1['FECHA_RESPUESTA'] > $hoy) { ?>
							<td><?php echo $fila1['FECHA_RESPUESTA'] ?></td>
						<?php } ?>
						<td><?php echo $fila1['OBSERVACION_RESPUESTA'] ?>
							<!--    <textarea name="OBSERVACION_RESPUESTA" cols="20" class="tipo1" id="OBSERVACION_RESPUESTA" style="width:auto"></textarea> -->
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
								<!-- <input type="submit" name="actualizar" id="actualizar" value="Actualizar" class="btn_buscar" title="Actualizar"/> -->
								<a href="../presentacion/novedades_actualizar.php?artid=<?php echo base64_encode($fila1['ID']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="15" height="15" /></a>
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
									//si muestro el indice de la pagina actual, no coloco enlace
									echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
								else
									//si el indice no corresponde con la pagina mostrada actualmente,co
									//coloco el enlace para ir a esa pagina
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
						<img src="../presentacion/imagenes/advertencia.png" style="width:70px; margin-top:1%;" />
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