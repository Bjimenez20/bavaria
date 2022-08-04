<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
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
	if (isset($_POST['gestion'])) {
		$gestion = $_POST['gestion'];
	} else {
		$gestion = '';
	}
	$codigo_gestion = $_POST['codigo_gestion'];
	$codigo_usuario2 = $_POST['codigo_usuario2'];
	$codigo_usuario = $_POST['codigo_usuario'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$ciudad = $_POST['ciudad'];
	$direccion = $_POST['direccion_act'];
	$MEDICAMENTO = $_POST['MEDICAMENTO'];
	$dosis = $_POST['Dosis'];
	$tipo_envio = $_POST['tipo_envio'];
	if (isset($_POST['registrar'])) {
		$select_temporal = mysqli_query($conex, "SELECT * FROM ipsen_temporal_producto WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
		$nreg = mysqli_num_rows($select_temporal);
		if ($nreg > 0) {
			while ($datos_temporales = (mysqli_fetch_array($select_temporal))) {
				$tipo_envio = $datos_temporales['ID_REFERENCIA_FK'];
				$verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE CANTIDAD>0 AND ID_REFERENCIA='$tipo_envio'");
				echo mysqli_error($conex);
				$cantidad = mysqli_num_rows($verificar_cantidad);
				if ($cantidad > 0) {
					$SELECT_ID_INV = mysqli_query($conex, "select ID_INVENTARIO from ipsen_inventario WHERE LUGAR_MATERIAL='BODEGA' AND ID_REFERENCIA_FK='" . $tipo_envio . "' ORDER BY ID_INVENTARIO ASC LIMIT 1");
					echo mysqli_error($conex);
					while ($fila1 = mysqli_fetch_array($SELECT_ID_INV)) {
						$ID_ULT_INV = $fila1['ID_INVENTARIO'];
					}
					$INSERT_MOVIMIENTO = mysqli_query($conex, "INSERT INTO ipsen_movimientos(TIPO_MOVIMIENTO, NO_REMICION, CANTIDAD, RESPONSABLE, DESTINATARIO, DIRECCION_DESTINATARIO, CIUDAD_ENVIO, FECHA_MOVIMIENTO, OBSERVACIONES, ESTADO_MOVIMIENTO,ID_REFERENCIA_FK) VALUES('2', '', '1', '" . $usua . "', '" . $nombre . ' ' . $apellidos . "', '" . $direccion . "', '" . $ciudad . "', CURRENT_TIMESTAMP, 'ENVIO PRODUCTO(S)', 'EN PROCESO','" . $tipo_envio . "')");
					echo mysqli_error($conex);
					$SELECT_CANTIDAD = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA = '" . $tipo_envio . "'");
					echo mysqli_error($conex);
					while ($fila1 = mysqli_fetch_array($SELECT_CANTIDAD)) {
						$CANTIDAD_I = $fila1['CANTIDAD'];
					}
					$TOTAL = $CANTIDAD_I - 1;
					$UPDATE_REFERENCIA = mysqli_query($conex, "UPDATE ipsen_referencia SET CANTIDAD='" . $TOTAL . "' WHERE ID_REFERENCIA='" . $tipo_envio . "'");
					echo mysqli_error($conex);
					$SELECT_ID_MOVIMIENTO = mysqli_query($conex, "SELECT ID_MOVIMIENTOS FROM ipsen_movimientos WHERE DESTINATARIO='" . $nombre . ' ' . $apellidos . "' AND TIPO_MOVIMIENTO='2' ORDER BY ID_MOVIMIENTOS DESC LIMIT 1");
					echo mysqli_error($conex);
					while ($fila_mov = mysqli_fetch_array($SELECT_ID_MOVIMIENTO)) {
						$ID_ULT_MOVIMIENTO = $fila_mov['ID_MOVIMIENTOS'];
					}
					$INSERT_MOVIMIENTO_PACIENTE = mysqli_query($conex, "INSERT INTO ipsen_paciente_movimientos(ID_PACIENTE_FK,ID_MOVIMIENTOS_FK,
					ESTADO_PACIENTE_MOVIMIENTO)VALUES('" . $codigo_usuario2 . "','" . $ID_ULT_MOVIMIENTO . "','EN PROCESO')");
					echo mysqli_error($conex);
					$INSERT_MOVIMIENTO_USUARIO = mysqli_query($conex, "INSERT INTO ipsen_usuario_movimientos(ID_USUARIO_FK,ID_MOVIMIENTOS_FK)VALUES('" . $id_usu . "','" . $ID_ULT_MOVIMIENTO . "')");
					echo mysqli_error($conex);
					$verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "' AND CANTIDAD<STOCK_MINIMO");
					echo mysqli_error($conex);
					$nreg_vrf = mysqli_num_rows($verificar_cantidad);
	?>
					<table style="margin:auto auto; font-size:80%;">
						<?php
						if ($nreg_vrf > 0) {
							while ($daro_ref = mysqli_fetch_array($verificar_cantidad)) {
								$MATERIAL = $daro_ref['MATERIAL'];
						?>
								<tr align="left">
									<td align="left">
										<span class="error" style="font-size:100%; text-align:left">ADVERTENCIA SE ESTA AGOTANDO EL PRODUCTO <?php echo $MATERIAL ?>
										</span>
									</td>
								</tr>
							<?php
							}
						}
					} else {
						$verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "'");
						echo mysqli_error($conex);
						while ($cantidad = mysqli_fetch_array($verificar_cantidad)) {
							$nombre_producto = $cantidad['MATERIAL'];
							?>
							<tr align="left">
								<td align="left">
									<span style="margin-top:3%;">
										<center>
											<img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
										</center>
									</span>
									<p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;color:#F00; font-weight:bold">EL PRODUCTO <span style=""><?php echo $nombre_producto ?></span> ESTA AGOTADO POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
									<br />
									<br />
									<br />
								</td>
							</tr>
					<?php
						}
					}
				}
				if ($nreg_vrf > 0) {
					?>
					<tr>
						<td align="center">
							<span class="error" style="font-size:100%; ">POR FAVOR COMUNICARSE CON EL COORDINADOR.</span>
							<span>
								<center>
									<img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
								</center>
							</span>
						</td>
					</tr>
				<?php
				}
				?>
					</table>
					<?php
					$BORRAR_PRODUCTOS_TEMPORAL = mysqli_query($conex, "DELETE  FROM ipsen_temporal_producto WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
					echo mysqli_error($conex);
				} else {
					$tipo_envio = $_POST['tipo_envio'];
					$listado_envio = mysqli_query($conex, "SELECT MATERIAL,ID_REFERENCIA FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "'");
					while ($opcion = mysqli_fetch_array($listado_envio)) {
						$nombre_producto = $opcion['MATERIAL'];
					}
					/*SI EL ENVIO ES KIT DE BIENVENIDA*/
					if ($nombre_producto == 'Kit de bienvenida') {
						$tipo_envio = $_POST['tipo_envio'];
						$verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE CANTIDAD>0 AND ID_REFERENCIA='$tipo_envio'");
						echo mysqli_error($conex);
						$cantidad_ref = mysqli_num_rows($verificar_cantidad);
						if ($cantidad_ref > 0) {
							$verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE CANTIDAD>0 AND ID_REFERENCIA='$tipo_envio'", $conex);
							echo mysqli_error($conex);
							$cantidad = mysqli_num_rows($verificar_cantidad);
							if ($cantidad > 0) {
								$SELECT_ID_INV = mysqli_query($conex, "select ID_INVENTARIO from ipsen_inventario WHERE LUGAR_MATERIAL='BODEGA' AND ID_REFERENCIA_FK='" . $tipo_envio . "' ORDER BY ID_INVENTARIO ASC LIMIT 1");
								echo mysqli_error($conex);
								while ($fila1 = mysqli_fetch_array($SELECT_ID_INV)) {
									$ID_ULT_INV = $fila1['ID_INVENTARIO'];
								}
								/*$UPDATE_INVENTARIO=mysql_query("UPDATE ipsen_inventario SET LUGAR_MATERIAL='".$codigo_usuario2."' WHERE ID_INVENTARIO='".$ID_ULT_INV."'",$conex);
						echo mysql_error($conex);*/
								$INSERT_MOVIMIENTO = mysqli_query($conex, "INSERT INTO ipsen_movimientos(TIPO_MOVIMIENTO, NO_REMICION, CANTIDAD, RESPONSABLE, DESTINATARIO, DIRECCION_DESTINATARIO, CIUDAD_ENVIO, FECHA_MOVIMIENTO, OBSERVACIONES, ESTADO_MOVIMIENTO,ID_REFERENCIA_FK) VALUES('2', '', '1', '" . $usua . "', '" . $nombre . ' ' . $apellidos . "', '" . $direccion . "', '" . $ciudad . "', CURRENT_TIMESTAMP, 'ENVIO PRODUCTO(S)', 'EN PROCESO','" . $tipo_envio . "')");
								echo mysqli_error($conex);
								$SELECT_CANTIDAD = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA = '" . $tipo_envio . "'");
								echo mysqli_error($conex);
								while ($fila1 = mysqli_fetch_array($SELECT_CANTIDAD)) {
									$CANTIDAD_I = $fila1['CANTIDAD'];
								}
								$TOTAL = $CANTIDAD_I - 1;
								$UPDATE_REFERENCIA = mysqli_query($conex, "UPDATE ipsen_referencia SET CANTIDAD='" . $TOTAL . "' WHERE ID_REFERENCIA='" . $tipo_envio . "'");
								echo mysqli_error($conex);
								$SELECT_ID_MOVIMIENTO = mysqli_query($conex, "SELECT ID_MOVIMIENTOS FROM ipsen_movimientos WHERE DESTINATARIO='" . $nombre . ' ' . $apellidos . "' AND TIPO_MOVIMIENTO='2' ORDER BY ID_MOVIMIENTOS DESC LIMIT 1");
								echo mysqli_error($conex);
								while ($fila_mov = mysqli_fetch_array($SELECT_ID_MOVIMIENTO)) {
									$ID_ULT_MOVIMIENTO = $fila_mov['ID_MOVIMIENTOS'];
								}
								$INSERT_MOVIMIENTO_PACIENTE = mysqli_query($conex, "INSERT INTO ipsen_paciente_movimientos(ID_PACIENTE_FK,ID_MOVIMIENTOS_FK,
								ESTADO_PACIENTE_MOVIMIENTO)VALUES('" . $codigo_usuario2 . "','" . $ID_ULT_MOVIMIENTO . "','EN PROCESO')");
								echo mysqli_error($conex);
								$INSERT_MOVIMIENTO_USUARIO = mysqli_query($conex, "INSERT INTO ipsen_usuario_movimientos(ID_USUARIO_FK,ID_MOVIMIENTOS_FK)VALUES('" . $id_usu . "','" . $ID_ULT_MOVIMIENTO . "')");
								echo mysqli_error($conex);
								$BORRAR_PRODUCTOS_TEMPORAL = mysqli_query($conex, "DELETE  FROM ipsen_temporal_producto WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
								echo mysqli_error($conex);
								$verificar_cantidad = mysqli_query($conex, "SELECT ID_REFERENCIA FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "' AND CANTIDAD<STOCK_MINIMO");
								echo mysqli_error($conex);
								$nreg_vrf = mysqli_num_rows($verificar_cantidad);
								if ($nreg_vrf > 0) {
					?>
									<span style="margin-top:3%;">
										<center>
											<img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
										</center>
									</span>
									<p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;">ADVERTENIA SE ESTA AGOTANDO EL PRODUCTO <span style="color:#F00; font-weight:bold"><?php echo $nombre_producto ?></span> POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
									<br />
									<br />
									<br />
								<?php
								}
							} else {
								?>
								<span style="margin-top:3%;">
									<center>
										<img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
									</center>
								</span>
								<p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;color:#F00; font-weight:bold">EL PRODUCTO <span style=""><?php echo $nombre_producto ?></span> ESTA AGOTADO POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
								<br />
								<br />
								<br />
							<?php
							}
						} else {
							$verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "'");
							echo mysqli_error($conex);
							while ($cantidad = mysqli_fetch_array($verificar_cantidad)) {
								$nombre_producto = $cantidad['MATERIAL'];
							?>
								<tr align="left">
									<td align="left">
										<span style="margin-top:3%;">
											<center>
												<img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
											</center>
										</span>
										<p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;color:#F00; font-weight:bold">EL PRODUCTO <span style=""><?php echo $nombre_producto ?></span> ESTA AGOTADO POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
										<br />
										<br />
										<br />
									</td>
								</tr>
								<?php
							}
						}
					}
				}
				if ($INSERT_MOVIMIENTO) {
					if ($UPDATE_REFERENCIA) {
						if ($INSERT_MOVIMIENTO_PACIENTE) {
							if ($INSERT_MOVIMIENTO_USUARIO) {
								if ($BORRAR_PRODUCTOS_TEMPORAL) {
								?>
									<span style="margin-top:3%;">
										<center>
											<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
										</center>
									</span>
									<p class="aviso3" style=" width:68.9%; margin:auto auto;">SE GENERO LA SOLICITUD DE ENVIO CORRECTAMENTE.</p>
									<br />
									<br />
									<center>
										<a href="../presentacion/form_paciente_seguimiento.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
									</center>
									<br />
					<?php
								}
							}
						}
					}
				} else if (!$INSERT_MOVIMIENTO || !$UPDATE_REFERENCIA || !$INSERT_MOVIMIENTO_PACIENTE || !$INSERT_MOVIMIENTO_USUARIO) {
					?>
					<span style="margin-top:5%;">
						<center>
							<img src="../presentacion/imagenes/advertencia2.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
						</center>
					</span>
					<p class="error" style=" width:68.9%; margin:auto auto;">
						LA SOLICITUD NO HA SIDO ENVIO CORRECTAMENTE.</p>
					<br />
					<br />
					<center>
						<a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
					</center>
					<br />
			<?php
				}
			}
