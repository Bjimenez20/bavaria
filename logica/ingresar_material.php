<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>BAVARIA</title>
	<link href="../PRESENTACION/css/saisenestilo.css" type="text/css" rel="stylesheet" />
	<style>
		.aviso3 {
			font-size: 130%;
			font-weight: bold;
			color: #11a9e3;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}

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

<body>
	<?php
	require('../datos/parse_str.php');
	require('../datos/conex.php');
	$INSER_SERIAL;
	$NO_REMISION = $_POST['NO_REMISION'];
	$REFERENCIA = $_POST['REFERENCIA'];
	$PRODUCTO = $_POST['producto'];
	$CANTIDAD = $_POST['CANTIDAD'];
	$TIPO_ENTRADA = $_POST['TIPO_ENTRADA'];
	if ($TIPO_ENTRADA == 'DEVOLUCION') {
		$ESTADO = $_POST['ESTADO_DEV'];
	}
	if ($TIPO_ENTRADA == 'REMISION') {
		$ESTADO = $_POST['ESTADO_REM'];
	}
	if ($INSER_SERIAL == 'SI') {
		$dato_cantidad = 0;
		for ($i = 1; $i <= $CANTIDAD; $i++) {
			$CODIGO_PRODUCTO = $_POST['serial' . $i];
			$INSERT_MATERIAL = mysqli_query($conex, "INSERT INTO ipsen_inventario(CODIGO_PRODUCTO, PROVEEDOR, NO_REMICION_PROVE, STOCK, ESTADO, ID_REFERENCIA_FK)VALUES('" . $CODIGO_PRODUCTO . "','BAYER','" . $NO_REMISION . "','1','" . $ESTADO . "','" . $PRODUCTO . "')");
			echo mysqli_error($conex);
			if ($INSERT_MATERIAL > 0) {
				$SELECT_ID_INV = mysqli_query($conex, "SELECT ID_INVENTARIO from ipsen_inventario ORDER BY ID_INVENTARIO DESC LIMIT 1");
				while ($fila1 = mysqli_fetch_array($SELECT_ID_INV)) {
					$ID_ULT_INV = $fila1['ID_INVENTARIO'];
				}
				$INSERT_INVENTARIO = mysqli_query($conex, "INSERT INTO ipsen_movimientos(TIPO_MOVIMIENTO, NO_REMICION, CANTIDAD, RESPONSABLE, DESTINATARIO, DIRECCION_DESTINATARIO, CIUDAD_ENVIO, FECHA_MOVIMIENTO, OBSERVACIONES, ESTADO_MOVIMIENTO, ID_INVENTARIO_FK) VALUES('1', '" . $NO_REMISION . "', '1', '" . $usua . "', 'People Marketing', 'Cll 129 # 51 - 38', 'Bogota', CURRENT_TIMESTAMP, 'Ingreso de Productos', 'ENTREGADO', '" . $ID_ULT_INV . "')");
				$dato_cantidad = $dato_cantidad + mysqli_affected_rows($conex);
			}
		}
		echo mysqli_error($conex);
		if ($INSERT_MATERIAL > 0) {
			$dato_cantidad;
			$SELECT_CANTIDAD = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA = '" . $PRODUCTO . "'");
			echo mysqli_error($conex);
			while ($fila1 = mysqli_fetch_array($SELECT_CANTIDAD)) {
				$CANTIDAD_I = $fila1['CANTIDAD'];
			}
			$TOTAL = $CANTIDAD_I + $dato_cantidad;
			$UPDATE_REFERENCIA = mysqli_query($conex, "UPDATE ipsen_referencia SET CANTIDAD='" . $TOTAL . "' WHERE ID_REFERENCIA='" . $PRODUCTO . "'");
			echo mysqli_error($conex);
		}
	} else {
		if ($INSER_SERIAL == 'NO') {
			for ($i = 1; $i <= $CANTIDAD; $i++) {
				$SELECT_ID = mysqli_query($conex, "SELECT ID_INVENTARIO from ipsen_inventario ORDER BY ID_INVENTARIO DESC LIMIT 1");
				while ($fila1 = mysqli_fetch_array($SELECT_ID)) {
					$ID_ULT = $fila1['ID_INVENTARIO'];
				}
				$NUM_ID = $ID_ULT + 1;
				$INSERT_MATERIAL = mysqli_query($conex, "INSERT INTO ipsen_inventario(CODIGO_PRODUCTO, PROVEEDOR, NO_REMICION_PROVE, STOCK, ESTADO, ID_REFERENCIA_FK)VALUES('" . $NUM_ID . "','MERCK','" . $NO_REMISION . "','1','" . $ESTADO . "','" . $PRODUCTO . "')");
				echo mysqli_error($conex);
				$SELECT_CANTIDAD = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA = '" . $PRODUCTO . "'");
				echo mysqli_error($conex);
				while ($fila1 = mysqli_fetch_array($SELECT_CANTIDAD)) {
					$CANTIDAD_I = $fila1['CANTIDAD'];
				}
				$INSERT_INVENTARIO = mysqli_query($conex, "INSERT INTO ipsen_movimientos(TIPO_MOVIMIENTO, NO_REMICION, CANTIDAD, RESPONSABLE, DESTINATARIO, DIRECCION_DESTINATARIO, CIUDAD_ENVIO, FECHA_MOVIMIENTO, OBSERVACIONES, ESTADO_MOVIMIENTO, ID_INVENTARIO_FK) VALUES('1', '" . $NO_REMISION . "', '1', '" . $usua . "', 'People Marketing', 'Cll 129 # 51 - 38', 'Bogota', CURRENT_TIMESTAMP, 'Ingreso de Productos', 'ENTREGADO', '" . $NUM_ID . "')");
				echo mysqli_error($conex);
				$TOTAL = $CANTIDAD_I + 1;
				$UPDATE_REFERENCIA = mysqli_query($conex, "UPDATE ipsen_referencia SET CANTIDAD='" . $TOTAL . "' WHERE ID_REFERENCIA='" . $PRODUCTO . "'");
				echo mysqli_error($conex);
			}
		}
	}
	if ($INSERT_MATERIAL != 0 && $UPDATE_REFERENCIA != 0) {
	?>
		<span style="margin-top:5%;">
			<center>
				<img src="../presentacion/imagenes/CHULO.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
			</center>
		</span>
		<p class="aviso3" style=" width:68.9%; margin:auto auto;">HA REGISTRADO AL PRODUCTO CORRECTAMENTE.</p>
		<br />
		<br />
		<center>
			<a href="../presentacion/form_registro_material.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR.png" style="width:152px; height:37px" /></a>
		</center>
	<?php
	} else {
		echo mysqli_error($conex);
	?>
		<span style="margin-top:5%;">
			<center>
				<img src="../presentacion/imagenes/advertencia2.png" style="width:50px; margin-top:100px;margin-top:5%;" />
			</center>
		</span>
		<p class="error" style=" width:68.9%; margin:auto auto;">
			<span style="border-left-color:#fff">EL PRODUCTO NO HA SIDO REGISTRADO CORRECTAMENTE.</span>
		</p>
		<br />
		<br />
		<center>
			<a href="../presentacion/form_registro_material.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
		</center>
	<?php
	}
	?>
</body>

</html>