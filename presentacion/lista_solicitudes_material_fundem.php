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
	<script src="js/jquery.js"></script>
	<script src="../presentacion/js/jquery.js"></script>
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
	<script type="text/jscript">
		$(document).ready(function() {
			$('#solicitud').submit(function() {
				if (confirm('¿ESTA SEGURO(A) DE ENVIAR LA INFORMACION?')) {
					document.tuformulario.submit()
					return (true)
				} else {
					return (false);
				}
			});
		});
	</script>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
if ($privilegios != '' && $usua != '') {
?>

	<body>
		<form name="solicitud" id="solicitud" method="post" class="letra">
			<?php
			if (!isset($_POST['buscar'])) {
				$z = base64_decode($z);
			} else {
				$z = 0;
			}
			if ($z == 1) {
				$fecha_ini = base64_decode($xx);
				$fecha_fin = base64_decode($xxx);
				$TIPO_SOLICITUD = base64_decode($xxxx);
			}
			include('../logica/consultas_solicitudes_fundem.php');
			$url = "../presentacion/lista_solicitudes_material_fundem.php";
			$num_total = mysqli_num_rows($SELECT_SOLICITUDES_TOTAL);
			if ($num_total > 0) {
			?>
				<table border="0" bordercolor="#A1A1A1" width="100%" rules="cols" class="letra">
					<tr>
						<th class="botones">FECHA MOVIMIENTO</th>
						<th class="botones">SERIAL PRODUCTO</th>
						<th class="botones">NOMBRE PRODUCTO</th>
						<th class="botones">NOMBRE MEDICAMENTO</th>
						<th class="botones">CANTIDAD</th>
						<th class="botones">PAP PACIENTE</th>
						<th class="botones">DIRECCION</th>
						<th class="botones">ESTADO</th>
						<th class="botones"># GUIA</th>
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
							<td><?php echo $fila1['FECHA_MOVIMIENTO'];
								echo "\n<input type=hidden name='id$x' value='" . $fila1["ID_MOVIMIENTOS"] . "'>"; ?>
								<input type="hidden" name="<?php echo "id" . $x; ?>" value="<?php echo $fila1["ID_MOVIMIENTOS"] ?>" />
							</td>
							<td><?php echo $fila1['CODIGO_PRODUCTO'] ?></td>
							<td><?php echo $fila1['MATERIAL'] ?></td>
							<td><?php echo $fila1['NOMBRE_REFERENCIA'] ?></td>
							<td><?php echo $fila1['STOCK'] ?></td>
							<td><?php echo 'PAP' . $fila1['LUGAR_MATERIAL'];               ?>
								<input type="hidden" name="<?php echo "ID_PACIENTE" . $x; ?>" value="<?php echo $fila1["LUGAR_MATERIAL"] ?>" />
							</td>
							<td><?php echo $fila1['DIRECCION_DESTINATARIO'] ?></td>
							<td><?php echo $fila1['ESTADO_MOVIMIENTO'] ?></td>
							<td><?php echo $fila1['NO_REMICION'] ?></td>
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
									echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '&z=' . base64_encode(1) . '&xx=' . base64_encode($fecha_ini) . '&xxx=' . base64_encode($fecha_fin) . '&xxxx=' . base64_encode($TIPO_SOLICITUD) . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
								for ($i = 1; $i <= $total_paginas; $i++) {
									if ($pagina == $i)
										echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
									else
										echo '  <a href="' . $url . '?pagina=' . $i . '&z=' . base64_encode(1) . '&xx=' . base64_encode($fecha_ini) . '&xxx=' . base64_encode($fecha_fin) . '&xxxx=' . base64_encode($TIPO_SOLICITUD) . '" style="font-size:110%;">' . $i . '</a>  ';
								}
								if ($pagina != $total_paginas)
									echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '&z=' . base64_encode(1) . '&xx=' . base64_encode($fecha_ini) . '&xxx=' . base64_encode($fecha_fin) . '&xxxx=' . base64_encode($TIPO_SOLICITUD) . '"><img src="../presentacion/imagenes/der.gif" border="0"></a>';
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
						<span style="border-left-color:#fff">NO SE ENCUENTRAN REGISTROS CON ESTA INFORMACI&Oacute;N.</span>
					</p>
				<?php
			}
				?>
				</table>
		</form>
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