<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
</head>
<?PHP
require('../datos/parse_str.php');
require('../datos/conex.php');
$consulta_PACIENTES;
$hoy = date('Y-m-d');
if ($privilegios != '' && $usua != '') {
	if (!isset($_POST['buscar'])) {
		if ($privilegios == 1 || $privilegios == 3) {
			$consulta_ref = mysqli_query($conex, "SELECT * FROM responsable AS R  INNER JOIN visitas AS V WHERE V.RESPONSABLE_ID = R.ID ORDER BY R.ID");
			echo mysqli_error($conex);
			$consulta_PACIENTES = "SELECT * FROM responsable AS R  INNER JOIN visitas AS V WHERE V.RESPONSABLE_ID = R.ID ORDER BY R.ID LIMIT";
		}
	}
	if (isset($_POST['buscar'])) {
		$privilegios;
		if ($privilegios == 1 || $privilegios == 2 || $privilegios == 3) {
			$NOMBRE = $_POST['nombre'];
			$DOCUMENTO = $_POST['documento'];
			$TELEFONO = $_POST['telefono'];
			$PAP = $_POST['PAP'];
		}
		if ($NOMBRE == '' and $DOCUMENTO == '' and $TELEFONO == '' and $PAP == '') {
			if ($privilegios == 1 || $privilegios == 3) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM responsable AS R INNER JOIN visitas AS V WHERE V.RESPONSABLE_ID = R.ID ORDER BY R.ID");
				echo mysqli_error($conex);
				$consulta_PACIENTES = "SELECT * FROM responsable AS R INNER JOIN visitas AS V WHERE V.RESPONSABLE_ID = R.ID ORDER BY R.ID LIMIT";
			}
			if ($privilegios == 2) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM responsable AS R INNER JOIN visitas AS V WHERE V.RESPONSABLE_ID = R.ID ORDER BY R.ID");
				echo mysqli_error($conex);
				$consulta_PACIENTES = "SELECT * FROM responsable AS R INNER JOIN visitas AS V WHERE V.RESPONSABLE_ID = R.ID ORDER BY R.ID LIMIT";
			}
		}
	}
?>

	<body>
		<?php
		$url = "../presentacion/listado_pacientes.php";
		if ($privilegios == 1 || $privilegios == 2 || $privilegios == 4 || $privilegios == 3) {
			$num_total_registros = mysqli_num_rows($consulta_ref);
		}
		if ($num_total_registros > 0) {
		?>
			<table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
				<tr>
					<th width="9%" class="botones">Codigo visita</th>
					<th width="9%" class="botones">Nombres</th>
					<th width="9%" class="botones">Telefono</th>
					<th width="9%" class="botones">WhatsApp</th>
					<th width="9%" class="botones">Direccion</th>
					<!-- <th width="9%" class="botones">EDITAR</th> -->
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
				$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
				$consulta = "$consulta_PACIENTES " . $inicio . "," . $TAMANO_PAGINA;
				$consulta_ref = mysqli_query($conex, $consulta);
				while ($fila1 = mysqli_fetch_array($consulta_ref)) {
				?>
					<tr align="center">
						<td><?php echo $fila1['ID'] ?></td>
						<td><?php echo $fila1['NOMBRES'] . ' ' . $fila1['APELLIDOS'] ?></td>
						<td><?php echo $fila1['TELEFONO'] ?></td>
						<td><?php echo $fila1['WHATSAPP'] ?></td>
						<td><?php echo $fila1['DIRECCION'] ?></td>
						<!-- <td>
							<a href="../presentacion/form_paciente.php?artid=<?php echo base64_encode($fila1['ID_PACIENTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="25" height="25" /></a>
						</td> -->
					</tr>
				<?php
				}
				?>
				<style>
					.modal-body .form-control {
						padding-top: 6px;
						padding-bottom: 6px;
					}
				</style>
				<tr bgcolor="#FFFFFF" class="titulo" align="center">
					<td colspan="3" class="botones">Se encontraron Registros <?php echo $num_total_registros; ?></td>
					<td colspan="8" class="botones">
						<?php
						if ($total_paginas > 1) {
							if ($pagina != 1)
								echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
							for ($i = 1; $i <= $total_paginas; $i++) {
								if ($pagina == $i)
									echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
								else
									echo '  <a href="' . $url . '?pagina=' . $i . '" style="font-size:110%;">' . $i . '</a>  ';
							}
							if ($pagina != $total_paginas)
								echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '"><img src="../presentacion/imagenes/der.gif" border="0"></a>';
						}
						echo '</p>';
						?></td>
				</tr>
			</table>
		<?php
		} else {
		?>
			<span style="margin-top:1%;">
				<br><br><br><br><br><br>
				<center>
					<img src="../presentacion/imagenes/advertencia2.png" style="width:70px; margin-top:1%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">
				<span style="border-left-color:#fff">NO SE ENCONTRARON REGISTROS CON ESTA INFORMACI&Oacute;N.</span>
			</p>
		<?php
		}
		?>
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