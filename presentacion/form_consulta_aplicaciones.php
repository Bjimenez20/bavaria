<?php
header("Content-Type: text/html;charset=utf-8");
include('../logica/session.php');
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
		html {
			background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
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
		/*form 
{
    background:url(../presentacion/imagenes/LOGIN.png) top center no-repeat;
}*/
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
mysqli_query($conex,"SET NAMES utf8");
if (isset($xxx))
	$ID_PACIENTE = base64_decode($xxx);
$consulta = mysqli_query($conex,"SELECT p.ID_PACIENTE,t.FECHA_INICIO_TERAPIA_TRATAMIENTO,p.FECHA_ACTIVACION_PACIENTE,e.NUMERO_OJOS FROM bayer_pacientes AS p
INNER JOIN bayer_tratamiento AS t ON p.ID_PACIENTE=t.ID_PACIENTE_FK
INNER JOIN bayer_aplicaciones_eylia AS e ON e.ID_PACIENTE_FK=p.ID_PACIENTE
WHERE p.ID_PACIENTE=$ID_PACIENTE ORDER BY e.FECHA_REGISTRO DESC LIMIT 1");
echo mysqli_error($conex);
while ($con = mysqli_fetch_array($consulta)) {
	$ID = $con['ID_PACIENTE'];
	$FECHA_INICIO = $con['FECHA_INICIO_TERAPIA_TRATAMIENTO'];
	$FECHA_ACTIVACION = $con['FECHA_ACTIVACION_PACIENTE'];
	$NUM_OJOS = $con['NUMERO_OJOS'];
}
$consulta_apli = mysqli_query($conex,"SELECT NUMERO_OJOS, FECHA_APLICACION FROM  bayer_aplicaciones_eylia WHERE ID_PACIENTE_FK=$ID_PACIENTE AND CAUSAL='NO APLICA' ORDER BY FECHA_APLICACION ASC");
echo mysqli_error($conex);
$consulta_causales = mysqli_query($conex,"SELECT CAUSAL FROM  bayer_aplicaciones_eylia WHERE ID_PACIENTE_FK=$ID_PACIENTE AND CAUSAL!='NO APLICA' ORDER BY FECHA_REGISTRO DESC LIMIT 1");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($consulta_apli) + 1;
?>
<body>
	<table rules="all" style="border:1px solid #000;">
		<tr>
			<th>ID Paciente</th>
			<th>Fecha Inicio Tratamiento</th>
			<th>Fecha Activaci&oacute;n</th>
			<?php
			for ($i = 1; $i <= $nreg; $i++) {
			?>
				<th>Cual Ojo # <?php echo $i ?></th>
				<th>Aplicaci&oacute;n # <?php echo $i ?></th>
			<?php
			}
			?>
		</tr>
		<tr>
			<td style="font-weight:bold; text-align:center"><?php echo $ID ?></td>
			<td style="text-align:center"><?php echo $FECHA_INICIO ?></td>
			<td style="text-align:center"><?php echo $FECHA_ACTIVACION ?></td>
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
			<?php
			}
			?>
		</tr>
	</table>
</body>
</html>