<?PHP
//session_start();
require('../datos/parse_str.php');
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=solicitud_material.xls");
require_once("../datos/conex.php");
if (isset($_POST['exportar'])) {
	$fecha_ini = $_POST['fecha_ini'] . ' 00:00:00';
	$fecha_fin = $_POST['fecha_fin'] . ' 23:59:59';
	$TIPO_SOLICITUD = $_POST['TIPO_SOLICITUD'];
	if ($TIPO_SOLICITUD == 'PENDIENTES') {
		if ($fecha_ini != ' 00:00:00' || $fecha_fin != ' 23:59:59') {
			$consulta_paciente = mysqli_query($conex, "SELECT * FROM bayer_movimientos AS M INNER JOIN bayer_referencia AS R ON R.ID_REFERENCIA=M.ID_REFERENCIA_FK INNER JOIN bayer_paciente_movimientos AS PM ON PM.ID_MOVIMIENTOS_FK=M.ID_MOVIMIENTOS
			  INNER JOIN bayer_pacientes AS P ON P.ID_PACIENTE=PM.ID_PACIENTE_FK WHERE
			  M.FECHA_MOVIMIENTO>='" . $fecha_ini . "' AND M.FECHA_MOVIMIENTO<='" . $fecha_fin . "' AND M.ESTADO_MOVIMIENTO='EN PROCESO' ORDER BY M.FECHA_MOVIMIENTO ASC");
			echo mysqli_error($conex);
		}
		if ($fecha_ini == ' 00:00:00' || $fecha_fin == ' 23:59:59') {
			$consulta_paciente = mysqli_query($conex, "SELECT * FROM bayer_movimientos AS M INNER JOIN bayer_referencia AS R ON R.ID_REFERENCIA=M.ID_REFERENCIA_FK INNER JOIN bayer_paciente_movimientos AS PM ON PM.ID_MOVIMIENTOS_FK=M.ID_MOVIMIENTOS
			  INNER JOIN bayer_pacientes AS P ON P.ID_PACIENTE=PM.ID_PACIENTE_FK WHERE
			  M.ESTADO_MOVIMIENTO='EN PROCESO' ORDER BY M.FECHA_MOVIMIENTO ASC");
			echo mysqli_error($conex);
		}
	}
	if ($TIPO_SOLICITUD == 'ENTREGADO') {
		$consulta_paciente = mysqli_query($conex, "SELECT * FROM bayer_inventario AS I
		  INNER JOIN bayer_referencia AS R ON R.ID_REFERENCIA=I.ID_REFERENCIA_FK
		  INNER JOIN bayer_movimientos AS M ON I.ID_INVENTARIO=M.ID_INVENTARIO_FK
		  INNER JOIN bayer_pacientes AS P ON P.ID_PACIENTE=I.LUGAR_MATERIAL
		  INNER JOIN bayer_paciente_movimientos AS PM ON PM.ID_MOVIMIENTOS_FK=M.ID_MOVIMIENTOS
		  WHERE I.LUGAR_MATERIAL!='BODEGA' AND M.TIPO_MOVIMIENTO='2' AND M.ESTADO_MOVIMIENTO='ENTREGADO' ORDER BY M.FECHA_MOVIMIENTO ASC");
		echo mysqli_error($conex);
	}
	if ($TIPO_SOLICITUD == 'DESPACHADOS') {
		$consulta_paciente = mysqli_query($conex, "SELECT * FROM bayer_inventario AS I
	INNER JOIN bayer_referencia AS R ON R.ID_REFERENCIA=I.ID_REFERENCIA_FK
	INNER JOIN bayer_movimientos AS M ON I.ID_INVENTARIO=M.ID_INVENTARIO_FK
	INNER JOIN bayer_pacientes AS P ON P.ID_PACIENTE=I.LUGAR_MATERIAL
	INNER JOIN bayer_paciente_movimientos AS PM ON PM.ID_MOVIMIENTOS_FK=M.ID_MOVIMIENTOS
	WHERE I.LUGAR_MATERIAL!='BODEGA' AND M.TIPO_MOVIMIENTO='2' AND M.FECHA_MOVIMIENTO>='" . $fecha_ini . "' AND M.FECHA_MOVIMIENTO<='" . $fecha_fin . "' AND M.ESTADO_MOVIMIENTO='DESPACHADO' ORDER BY M.FECHA_MOVIMIENTO ASC");
		echo mysqli_error($conex);
	}
}
?>
<table border="1px" bordercolor="#15a9e3">
	<tr style="font-weight:bold; text-transform:uppercase; height:25; padding:3px">
		<th class="botones">NOMBRE PRODUCTO</th>
		<th class="botones">REFERENCIA</th>
		<th class="botones">CANTIDAD</th>
		<th class="botones">PAP PACIENTE</th>
		<th class="botones">TELEFONO</th>
		<th class="botones">DEPARTAMENTO</th>
		<th class="botones">CIUDAD</th>
		<th class="botones">DIRECCION</th>
		<th class="botones">PACIENTE</th>
		<th class="botones">ESTADO</th>
		<th class="botones"># SERIAL</th>
		<th class="botones"># GUIA</th>
	</tr>
	<?php
	while ($fila1 = mysqli_fetch_array($consulta_paciente)) {
	?>
		<tr align="center" style="height:25px;">
			<td><?php echo $fila1['MATERIAL'] ?></td>
			<td><?php echo $fila1['NOMBRE_REFERENCIA'] ?></td>
			<td>1</td>
			<td><?php echo 'PAP' . $fila1['ID_PACIENTE_FK']; ?></td>
			<td><?php echo $fila1['TELEFONO_PACIENTE'] ?></td>
			<td><?php echo $fila1['DEPARTAMENTO_PACIENTE'] ?></td>
			<td><?php echo $fila1['CIUDAD_PACIENTE'] ?></td>
			<td><?php echo $fila1['DIRECCION_DESTINATARIO'] ?></td>
			<td><?php echo $fila1['DESTINATARIO'] ?></td>
			<td><?php echo $fila1['ESTADO_MOVIMIENTO'] ?></td>
			<td><?php echo $fila1['NO_REMICION']; ?></td>
			<td><?php echo $fila1['NO_REMICION']; ?></td>
		</tr>
	<?php
	}
	?>
</table>