<?PHP
//session_start();
header("Content-Type: text/html;charset=utf-8");
require('../datos/parse_str.php');
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=aplicaciones.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
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

		/* html {
			background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		} */

		th {
			padding: 5px;
			font-weight: bold;
			background-color: #16a085;
			border: 1px solid #16a085;
			color: #feffff;
		}

		td {
			padding: 2px;
			border: 1px solid #d0d0d0;
			background: #ffffff;
		}

		/* @media screen and (max-width:1000px) {
			html {
				background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}
		} */
	</style>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
mysqli_query($conex, "SET NAMES utf8");
$consulta = mysqli_query($conex, "SELECT p.ID_PACIENTE,t.FECHA_INICIO_TERAPIA_TRATAMIENTO,p.FECHA_ACTIVACION_PACIENTE,t.CLASIFICACION_PATOLOGICA_TRATAMIENTO FROM ipsen_pacientes AS p
INNER JOIN ipsen_tratamiento AS t ON p.ID_PACIENTE=t.ID_PACIENTE_FK
INNER JOIN ipsen_aplicaciones_eylia AS e ON e.ID_PACIENTE_FK=p.ID_PACIENTE
GROUP BY p.ID_PACIENTE ORDER BY e.FECHA_REGISTRO ");
echo mysqli_error($conex);
$cantidad_aplicaicones = mysqli_query($conex, "SELECT COUNT(ID_PACIENTE_FK) as 'TOTAL' FROM ipsen_aplicaciones_eylia WHERE CAUSAL='NO APLICA' GROUP BY ID_PACIENTE_FK HAVING COUNT(ID_PACIENTE_FK) ORDER BY COUNT(ID_PACIENTE_FK) DESC LIMIT 1");
echo mysqli_error($conex);
while ($fila = mysqli_fetch_array($cantidad_aplicaicones)) {
	$TOTAL = $fila['TOTAL'];
}
$nreg = $TOTAL + 1;
?>

<body>
	<table rules="all" style="border:1px solid #000;">
		<tr>
			<th>ID Paciente</th>
			<th>Clasificaci&oacute;n Patol&oacute;gica</th>
			<th>Fecha Inicio Tratamiento</th>
			<th>Fecha Activaci&oacute;n</th>
			<th>Cual Ojo</th>
			<?php
			for ($i = 1; $i <= $nreg; $i++) {
			?><th>Cual Ojo </th>
				<th>Aplicaci&oacute;n # <?php echo $i ?></th>
			<?php
			}
			?>
		</tr>
		<?php
		while ($con = mysqli_fetch_array($consulta)) {
			$ID = $con['ID_PACIENTE'];
			$FECHA_INICIO = $con['FECHA_INICIO_TERAPIA_TRATAMIENTO'];
			$FECHA_ACTIVACION = $con['FECHA_ACTIVACION_PACIENTE'];
			$CLASIFICACION_PATOLOGICA = $con['CLASIFICACION_PATOLOGICA_TRATAMIENTO'];
			$cant_ojos = mysqli_query($conex, "SELECT NUMERO_OJOS FROM ipsen_aplicaciones_eylia WHERE ID_PACIENTE_FK=$ID ORDER BY FECHA_REGISTRO DESC LIMIT 1");
			while ($fil_o = mysqli_fetch_array($cant_ojos)) {
				$NUM_OJOS = $fil_o['NUMERO_OJOS'];
			}
		?>
			<tr>
				<td style="font-weight:bold; text-align:center"><?php echo $ID ?></td>
				<td style="text-align:center"><?php echo $CLASIFICACION_PATOLOGICA ?></td>
				<td style="text-align:center"><?php echo $FECHA_INICIO ?></td>
				<td style="text-align:center"><?php echo $FECHA_ACTIVACION ?></td>
				<td style="text-align:center"><?php echo $NUM_OJOS ?></td>
				<?php
				$consulta_apli = mysqli_query($conex, "SELECT NUMERO_OJOS,FECHA_APLICACION FROM  ipsen_aplicaciones_eylia WHERE ID_PACIENTE_FK=$ID AND CAUSAL='NO APLICA' ORDER BY FECHA_APLICACION ASC");
				echo mysqli_error($conex);
				$consulta_causales = mysqli_query($conex, "SELECT CAUSAL FROM  ipsen_aplicaciones_eylia WHERE ID_PACIENTE_FK=$ID AND CAUSAL!='NO APLICA' ORDER BY FECHA_REGISTRO DESC LIMIT 1");
				echo mysqli_error($conex);
				?>
				<?php
				while ($fil = mysqli_fetch_array($consulta_apli)) {
				?>
					<td style="text-align:center"><?php echo $fil['NUMERO_OJOS'] ?></td>
					<td style="text-align:center"><?php echo $fil['FECHA_APLICACION'] ?></td>
				<?php
				}
				while ($fila = mysqli_fetch_array($consulta_causales)) {
				?>
					<td style="text-align:center"><?php echo $fila['CAUSAL'] ?></td>
					<td style="text-align:center"><?php echo 'NO APLICA'; ?></td>
				<?php
				}
				?>
			</tr>
		<?php
		}
		?>
	</table>
</body>

</html>
<?php
?>