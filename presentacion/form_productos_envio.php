<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
</head>
<?PHP
require('../datos/conex.php');
require('../datos/parse_str.php');
if (isset($_POST['agregar'])) {
	$ID_PRODUCTO = $_POST['tipo_envio'];
	$NOMBRE_PRODUCTO = $_POST['nombre_producto'];
	$ID_PACIENTE = $_POST['codigo_usuario2'];
	$insert = mysqli_query($conex, "INSERT INTO ipsen_temporal_producto(ID_REFERENCIA_FK,
		NOMBRE_MATERIAL,ID_PACIENTE_FK) VALUES ('" . $ID_PRODUCTO . "','" . $NOMBRE_PRODUCTO . "','" . $ID_PACIENTE . "')");
	echo mysqli_error($conex);
}
if (isset($_POST['agregar_seg'])) {
	$ID_PRODUCTO = $_POST['tipo_envio'];
	$NOMBRE_PRODUCTO = $_POST['nombre_producto'];
	$ID_PACIENTE = $_POST['codigo_usuario2'];
	$insert = mysqli_query($conex, "INSERT INTO ipsen_temporal_producto(ID_REFERENCIA_FK,
	NOMBRE_MATERIAL,ID_PACIENTE_FK) VALUES ('" . $ID_PRODUCTO . "','" . $NOMBRE_PRODUCTO . "','" . $ID_PACIENTE . "')");
	echo mysqli_error($conex);
}
if (isset($_POST['agregar_nuevo'])) {
	$ID_PRODUCTO = $_POST['tipo_envio'];
	$NOMBRE_PRODUCTO = $_POST['nombre_producto'];
	$ID_PACIENTE = $_POST['codigo_usuario2'];
	$insert = mysqli_query($conex, "INSERT INTO ipsen_temporal_producto(ID_REFERENCIA_FK,
	NOMBRE_MATERIAL,ID_PACIENTE_FK) VALUES ('" . $ID_PRODUCTO . "','" . $NOMBRE_PRODUCTO . "','" . $ID_PACIENTE . "')");
	echo mysqli_error($conex);
}
if (isset($xx)) {
	$id = base64_decode($id_tempora);
	$ID_PACIENTE = base64_decode($ID_P);
	$eliminar = mysqli_query($conex, "DELETE  FROM ipsen_temporal_producto WHERE ID_ipsen_TEMPORAL_PRODUCTO='$id'");
	echo mysqli_error($conex);
}
?>

<body>
	<table id="tabla_material_agregar" width="100%" style="margin:auto auto; border:1px solid #000;" rules="all">
		<tr>
			<th colspan='2'>
				PRODUCTOS PARA ENVIAR
			</th>
		</tr>
		<tr>
			<th>NOMBRE MATERIAL</th>
			<th>ELIMINAR</th>
		</tr>
		<?php
		$select = mysqli_query($conex, "SELECT * FROM ipsen_temporal_producto WHERE ID_PACIENTE_FK='" . $ID_PACIENTE . "'");
		echo mysqli_error($conex);
		$nreg = mysqli_num_rows($select);
		while ($fila = (mysqli_fetch_array($select))) {
		?>
			<tr>
				<td>
					<center>
						<?php echo $fila['NOMBRE_MATERIAL'] ?>
					</center>
				</td>
				<td>
					<center>
						<a href="form_productos_envio.php?id_tempora=<?php echo base64_encode($fila['ID_ipsen_TEMPORAL_PRODUCTO']) ?>&&xx=<?php echo base64_encode('ok') ?>&&ID_P=<?php echo base64_encode($ID_PACIENTE) ?>">
							<img src="imagenes/no.png" title="Eliminar" />
						</a>
					</center>
				</td>
			</tr>
		<?php
		}
		?>
	</table>
</body>

</html>