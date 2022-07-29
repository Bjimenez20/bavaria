<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
</head>
<style>
	.aviso3 {
		font-size: 110%;
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
		color: #fb8305;
		text-transform: uppercase;
		background-color: transparent;
		text-align: center;
		padding: 10px;
	}
</style>

<body>
	<?PHP
	require('../datos/parse_str.php');
	require('../datos/conex.php');
	$x = base64_decode($xx);
	if (isset($valor)) {
		$ID_PAC = base64_decode($x_pac);
		$ID_MOVIMIENTO = base64_decode($x_mov);
		$sql = mysqli_query($conex, "UPDATE `ipsen_movimientos` SET
		ESTADO_MOVIMIENTO='ENTREGADO'
		WHERE ID_MOVIMIENTOS = '" . $ID_MOVIMIENTO . "';");
		echo mysqli_error($conex);
		$actualizar_movimiento_pac = mysqli_query($conex, "UPDATE `ipsen_paciente_movimientos` SET 		   
		ESTADO_PACIENTE_MOVIMIENTO='ENTREGADO'
		WHERE ID_MOVIMIENTOS_FK = '" . $ID_MOVIMIENTO . "' AND ESTADO_PACIENTE_MOVIMIENTO='EN PROCESO' AND ID_PACIENTE_FK='" . $ID_PAC . "'");
		echo mysqli_error($conex);
		if ($sql) {
			echo "<b>DATOS ACTUALIZADOS CON EXITO</b> <br />";
		}
	}
	if (isset($_POST['insertar'])) {
		for ($i = 1; $i <= $x; $i++) {
			if (isset($_POST["id" . $i])) {
				$ID_MOVIMIENTO = $_POST["id" . $i];
				$NO_GUIA = $_POST["NO_GUIA" . $i];
				$SERIAL = $_POST["SERIAL" . $i];
				$ID_PAC = $_POST["ID_PACIENTE" . $i];
				$ID_REFERENCIA = $_POST["ID_REFERENCIA" . $i];
				if ($NO_GUIA != '' && $SERIAL != '') {
					$consul = mysqli_query($conex, "SELECT * FROM ipsen_inventario WHERE CODIGO_PRODUCTO='$SERIAL' AND LUGAR_MATERIAL='BODEGA' AND ID_REFERENCIA_FK='$ID_REFERENCIA'");
					$num_total = mysqli_num_rows($consul);
					echo mysqli_error($conex);
					if ($num_total > 0) {
						while ($inve = mysqli_fetch_array($consul)) {
							$ID_INVENTARIO = $inve['ID_INVENTARIO'];
							$LUGAR_MATERIAL = $inve['LUGAR_MATERIAL'];
						}
						$update_inv = mysqli_query($conex, "UPDATE `ipsen_inventario` SET 		
						LUGAR_MATERIAL = '" . $ID_PAC . "'
						WHERE ID_INVENTARIO = '" . $ID_INVENTARIO . "';");
						echo mysqli_error($conex);
						$sql = mysqli_query($conex, "UPDATE `ipsen_movimientos` SET 		   
						NO_REMICION = '" . $NO_GUIA . "',
						ID_INVENTARIO_FK = '" . $ID_INVENTARIO . "',
						ESTADO_MOVIMIENTO='DESPACHADO'
						WHERE ID_MOVIMIENTOS = '" . $ID_MOVIMIENTO . "';");
						echo mysqli_error($conex);
						$actualizar_movimiento_pac = mysqli_query($conex, "UPDATE `ipsen_paciente_movimientos` SET 		   
						ESTADO_PACIENTE_MOVIMIENTO='DESPACHADO'
						WHERE ID_MOVIMIENTOS_FK = '" . $ID_MOVIMIENTO . "' AND ESTADO_PACIENTE_MOVIMIENTO='EN PROCESO' AND ID_PACIENTE_FK='" . $ID_PAC . "'");
						echo mysqli_error($conex);
						if ($sql) {
	?>
							<span style="margin-top:3%;">
								<center>
									<img src="../presentacion/imagenes/chulo.png" width="52" height="52" style=" margin-top:100px;margin-top:5%;" />
								</center>
							</span>
							<p class="aviso3" style=" width:68.9%; margin:auto auto; font-size:95%;">EL NUMERO DE SERIAL <span style="color:#F00; font-weight:bold"><?php echo $SERIAL ?> </span> Y EL NUMERO DE GUIA <span style="color:#F00; font-weight:bold"><?php echo $NO_GUIA ?></span> SE INGRESARON CORRECTAMENTE .</p>
							<br />
							<br />
						<?php
						} else {
						}
					} else {
						?>
						<span style="margin-top:3%;">
							<center>
								<img src="../presentacion/imagenes/advertencia.png" width="52" height="52" style=" margin-top:100px;margin-top:5%;" />
							</center>
						</span>
						<p class="error" style=" width:68.9%; margin:auto auto; font-size:95%;">EL NUMERO DE SERIAL <span style="color:#F00; font-weight:bold"><?php echo $SERIAL ?> </span> NO ESTA DISPONIBLER.</p>
						<br />
						<br />
						<br />
	<?php
					}
				}
			}
		}
	}
	?>
</body>

</html>