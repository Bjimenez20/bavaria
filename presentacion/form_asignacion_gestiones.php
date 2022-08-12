<?php
require_once('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link href="css/estilo_asignacion.css" type="text/javascript" rel="stylesheet" />
	<script src="js/jquery.js" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			$('#cant').change(function() {
				var ini = $('#total_pac').val();
				var cant = $('#cant').val();
				var total = ini / cant;
				var total = Math.floor(total);
				$('#total').val(total);
			});
		});
	</script>
</head>
<?php
require('../datos/parse_str.php');
require_once("../datos/conex.php");
$hoy = date('Y-m-d');
if ($privilegios != '' && $usua != '') {
	if (isset($ok)) {
		$usuario = base64_decode($usu);
		$ok = base64_decode($ok);
		if ($ok == 'act') {
			$actualizar = mysqli_query($conex, "UPDATE ipsen_usuario SET
			ESTADO_LOGIN='IN'
			WHERE USER='" . $usuario . "'
			AND ESTADO_LOGIN='OUT'");
			echo mysqli_error($conex);
		}
		if ($ok == 'des') {
			$actualizar = mysqli_query($conex, "UPDATE ipsen_usuario SET
			ESTADO_LOGIN='OUT'
			WHERE USER='" . $usuario . "'
			AND ESTADO_LOGIN='IN'");
			echo mysqli_error($conex);
		}
		if ($ok == 'restablecer') {
			$actualizar_gestiones = mysqli_query($conex, "UPDATE ipsen_gestiones SET
			USUARIO_ASIGANDO='SIN ASIGNAR',
			ESTADO_GESTION=''
			WHERE
			FECHA_PROGRAMADA_GESTION='" . $hoy . "'
			AND ESTADO_GESTION='ASIGNADO'");
			mysqli_affected_rows($conex);
			echo mysqli_error($conex);
		}
		if ($ok == 'asignar') {
			$actualizar = mysqli_query($conex, "UPDATE ipsen_usuario SET
			ESTADO_LOGIN='OUT'
			WHERE USER='" . $usuario . "'
			AND ESTADO_LOGIN='IN'");
			echo mysqli_error($conex);
			$select_terapias_up = mysqli_query($conex, "SELECT * FROM(SELECT * FROM ipsen_gestiones ORDER BY FECHA_PROGRAMADA_GESTION DESC)ipsen_gestiones 
			INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=ipsen_gestiones.ID_PACIENTE_FK2
			WHERE (PRODUCTO_TRATAMIENTO LIKE '%ADEMPAS %' OR PRODUCTO_TRATAMIENTO LIKE '%XOFIGO %')
			GROUP BY ipsen_gestiones.ID_PACIENTE_FK2");
			echo mysqli_error($conex);
			while ($dato_gest = mysqli_fetch_array($select_terapias_up)) {
				$FECHA_PROGRAMADA_GESTION = $dato_gest['FECHA_PROGRAMADA_GESTION'];
				$USUARIO_ASIGANDO = $dato_gest['USUARIO_ASIGANDO'];
				if ($FECHA_PROGRAMADA_GESTION == $hoy && $USUARIO_ASIGANDO == 'SIN ASIGNAR') {
					$ID_GESTION = $dato_gest['ID_GESTION'];
					$actualizar_gestiones = mysqli_query($conex, "UPDATE ipsen_gestiones SET USUARIO_ASIGANDO='" . $usuario . "', ESTADO_GESTION='ASIGNADO' WHERE USUARIO_ASIGANDO='SIN ASIGNAR' AND FECHA_PROGRAMADA_GESTION='" . $hoy . "' AND ID_GESTION=$ID_GESTION");
					mysqli_affected_rows($conex);
					echo mysqli_error($conex);
				}
			}
		}
	}
	$hoy = date('Y-m-d');
	$Ayer = date('Y-m-d', strtotime('-1 day'));
	$Antes_Ayer =  date('Y-m-d', strtotime('-2 day'));
	$Antes_Ayer3 = date('Y-m-d', strtotime('-3 day'));
	$Antes_Ayer4 = date('Y-m-d', strtotime('-4 day'));
	$Antes_Ayer5 = date('Y-m-d', strtotime('-5 day'));
	$Antes_Ayer6 = date('Y-m-d', strtotime('-6 day'));
	$Antes_Ayer7 = date('Y-m-d', strtotime('-7 day'));
	$select_gestiones_ayer = mysqli_query($conex, "SELECT ID_GESTION FROM ipsen_gestiones WHERE (FECHA_PROGRAMADA_GESTION='" . $Ayer . "' OR FECHA_PROGRAMADA_GESTION='" . $Antes_Ayer . "' OR FECHA_PROGRAMADA_GESTION='" . $Antes_Ayer3 . "' OR FECHA_PROGRAMADA_GESTION='" . $Antes_Ayer4 . "' OR FECHA_PROGRAMADA_GESTION='" . $Antes_Ayer5 . "' OR FECHA_PROGRAMADA_GESTION='" . $Antes_Ayer6 . "' OR FECHA_PROGRAMADA_GESTION='" . $Antes_Ayer7 . "') AND (ESTADO_GESTION='' OR ESTADO_GESTION='ASIGNADO')");
	echo mysqli_error($conex);
	while ($fila = (mysqli_fetch_array($select_gestiones_ayer))) {
		$id_gestion_ayer = $fila['ID_GESTION'];
		$update = mysqli_query($conex, "UPDATE ipsen_gestiones 
		SET FECHA_PROGRAMADA_GESTION='" . $hoy . "',
		USUARIO_ASIGANDO='SIN ASIGNAR',
		ESTADO_GESTION=''
		WHERE ID_GESTION='$id_gestion_ayer'");
		echo mysqli_error($conex);
	}
	$select_gestiones = mysqli_query($conex, "SELECT * FROM(SELECT * FROM ipsen_gestiones ORDER BY FECHA_PROGRAMADA_GESTION DESC)ipsen_gestiones GROUP BY ID_PACIENTE_FK2");
	echo mysqli_error($conex);
	$total_gestiones = 0;
	$total_gestiones_trp = 0;
	$total_gestiones_trt = 0;
	while ($dato = mysqli_fetch_array($select_gestiones)) {
		$FECHA_PROGRAMADA_GESTION = $dato['FECHA_PROGRAMADA_GESTION'];
		$USUARIO_ASIGANDO = $dato['USUARIO_ASIGANDO'];
		$ID_PACIENTE_FK2 = $dato['ID_PACIENTE_FK2'];
		if ($FECHA_PROGRAMADA_GESTION == $hoy && $USUARIO_ASIGANDO == 'SIN ASIGNAR') {
			$ID_GESTION = $dato['ID_GESTION'];
			$total_gestiones = $total_gestiones + 1;
		}
	}
	$select_terapias2 = mysqli_query($conex, "SELECT * FROM(SELECT * FROM ipsen_gestiones ORDER BY FECHA_PROGRAMADA_GESTION DESC)ipsen_gestiones 
	INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=ipsen_gestiones.ID_PACIENTE_FK2
	WHERE (PRODUCTO_TRATAMIENTO LIKE '%ADEMPAS %' OR PRODUCTO_TRATAMIENTO LIKE '%XOFIGO %')
	GROUP BY ipsen_gestiones.ID_PACIENTE_FK2");
	echo mysqli_error($conex);
	while ($dato_gest = mysqli_fetch_array($select_terapias2)) {
		$FECHA_PROGRAMADA_GESTION = $dato_gest['FECHA_PROGRAMADA_GESTION'];
		$USUARIO_ASIGANDO = $dato_gest['USUARIO_ASIGANDO'];
		$ID_PACIENTE_FK2 = $dato_gest['ID_PACIENTE_FK2'];
		if ($FECHA_PROGRAMADA_GESTION == $hoy && $USUARIO_ASIGANDO == 'SIN ASIGNAR') {
			$ID_GESTION = $dato_gest['ID_GESTION'];
			$total_gestiones_trt = $total_gestiones_trt + 1;
		}
	}
	$nreg_terapias = $total_gestiones_trt;
	$nreg_pac = $total_gestiones;
	$select_usu = mysqli_query($conex, "SELECT ID_USUARIO,USER,NOMBRES,APELLIDOS,ESTADO,PRIVILEGIOS,ESTADO_LOGIN FROM ipsen_usuario WHERE ESTADO='1' AND PRIVILEGIOS='2' AND ID_USUARIO<>'69' AND ID_USUARIO<>'83'");
	echo mysqli_error($conex);
	$nreg_usu = mysqli_num_rows($select_usu);
?>

	<body class="body" style="width:95%;">
		<form id="asignacion" name="asignacion" action="../logica/insertar_datos.php" method="post" class="letra">
			<?php
			$borrar_temp = mysqli_query($conex, "TRUNCATE TABLE ipsen_temporal_gestiones");
			?>
			<center>
				<span style="font-size:140%; margin-left:50px"> FECHA ACTUAL</span>
				<input type="date" value="<?php echo $hoy ?>" name="fecha_actual" id="fecha_actual" style="border:1px solid transparent; background-color:transparent; color:#000; text-align:center; font-size:180%;" readonly="readonly" />
				</div>
				<br />
				<br />
				<?php
				if ($nreg_pac > 0) {
				?>
					<span style="font-size:140%;"> TOTAL GESTION DEL DIA <?php echo $nreg_pac ?>.</span>
					<br />
				<?php
				}
				if ($nreg_terapias > 0) {
				?>
					<br />
				<?php
				}
				if ($nreg_pac == 0 && $nreg_terapias <= 0) {
				?>
					<span style="font-size:140%;"> NO HAY GESTIONES PARA ASIGNAR.</span>
				<?php
				}
				?>
				<br />
				<br />
				<br />
				<br />
			</center>
			<center>
				<table style="width:100%;; border:#fff" rules="rows" id="tabla">
					<tr>
						<th colspan="5" style="color:#FFF" bgcolor="#224a81">
							USUARIOS DISPONIBLES
						</th>
					</tr>
					<tr>
						<td bgcolor="#224a81" style="color: #fff;" style="color: #fff;">
							USUARIO(S)
						</td>
						<td bgcolor="#224a81" style="color: #fff;">
							NOMBRE(S) Y APELLIDO(S)
						</td>
						<td bgcolor="#224a81" style="color: #fff;">
							ESTADO LOGIN
						</td>
						<?php
						if ($nreg_terapias > 0) {
						?>
							<td bgcolor="#224a81" style="color: #fff;">
								ASIGNAR PACIENTES ADEMPAS Y XOFIJO
							</td>
						<?php
						}
						?>
						<?php
						if ($nreg_pac <= 0) {
						?>
							<td bgcolor="#224a81" style="color: #fff;">
								# ASIGNADAS
							</td>
							<td bgcolor="#224a81" style="color: #fff;">
								# GESTIONADAS
							</td>
						<?php
						}
						?>
					</tr>
					<tr>
						<?php
						if ($nreg_usu > 0) {
							while ($fila = (mysqli_fetch_array($select_usu))) {
						?>
					<tr>
						<td>
							<?php echo $fila['USER']; ?>
							<input type="hidden" value="<?php echo $fila['USER'] ?>" id="usu" name="usu" />
						</td>
						<td><?php echo $fila['NOMBRES'] . ' ' . $fila['APELLIDOS']; ?></td>
						<td>
							<?php
								$estado = $fila['ESTADO_LOGIN'];
								if ($estado == 'OUT') {
							?>
								<a href="form_asignacion_gestiones.php?usu=<?php echo base64_encode($fila['USER']) ?>&ok=<?php echo base64_encode('act') ?>" target="info" id="btn" name="btn">
									<img src="imagenes/OFF.png" style="width:55PX" />
								</a>
							<?php
								}
								if ($estado == 'IN') {
							?>
								<a href="form_asignacion_gestiones.php?usu=<?php echo base64_encode($fila['USER']) ?>&ok=<?php echo base64_encode('des') ?>" target="info" id="btn" name="btn">
									<img id="btn2" src="imagenes/ON.png" style="width:55PX" />
								</a>
							<?php
								}
							?>
						</td>
						<?php
								if ($nreg_terapias > 0) {
						?>
							<td>
								<a href="form_asignacion_gestiones.php?usu=<?php echo base64_encode($fila['USER']) ?>&ok=<?php echo base64_encode('asignar') ?>" target="info" id="btn" name="btn">
									<img src="imagenes/CHULO.png" width="32" height="43" id="btn2" />
								</a>
							</td>
						<?php
								}
						?>
						<?php
								if ($nreg_pac <= 0) {
						?>
							<td>
								<?php
									$select_gestiones = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE FECHA_PROGRAMADA_GESTION='$hoy' AND USUARIO_ASIGANDO='" . $fila['USER'] . "'");
									echo mysqli_error($conex);
									echo $nreg_gestiones = mysqli_num_rows($select_gestiones);
								?>
							</td>
							<td>
								<?php
									$select_gestionados = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE FECHA_PROGRAMADA_GESTION='$hoy' AND USUARIO_ASIGANDO='" . $fila['USER'] . "' AND ESTADO_GESTION='GESTIONADO'");
									echo mysqli_error($conex);
									echo $nreg_gestionado = mysqli_num_rows($select_gestionados);
								?>
							</td>
						<?php
								}
						?>
					</tr>
				<?php
							}
						} else {
				?>
				<tr>
					<td colspan="1">
						SIN REGISTROS
					</td>
					<td colspan="1">
						SIN REGISTROS
					</td>
					<td colspan="1">
						SIN REGISTROS
					</td>
					<?php
							if ($nreg_terapias <= 0) {
					?>
						<td>
							NO DISPONIBLE
						</td>
					<?php
							}
					?>
					<?php
							if ($nreg_pac <= 0) {
					?>
						<td>
							SIN REGISTROS
						</td>
						<td>
							SIN REGISTROS
						</td>
					<?php
							}
					?>
				</tr>
			<?php
						}
			?>
				</table>

				<?php
				if ($nreg_pac > 0) {
				?>
					<center>
						<table width="100%">
							<tr>
								<td style="background-color:#224a81;text-align:center">
									<a href="form_cantidad_gestion.php" target="info" class="btn_continuar">
										<img src="imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" />
									</a>
								</td>
							</tr>
						</table>
					</center>
				<?php
				}
				if ($nreg_pac <= 0) {
				?>
					<center>
						<table width="100%">
							<tr>
								<td style="background-color:#224a81;text-align:center">
									&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="form_asignacion_gestiones.php?usu=<?php echo base64_encode($fila['USER']) ?>&ok=<?php echo base64_encode('restablecer') ?>" target="info" class="btn_continuar">
										<img src="imagenes/BTN_RESTABLECER.png" style="width:152px; height:37px" />
									</a>
								</td>
							</tr>
						</table>
					</center>
				<?php
				}
				?>
			</center>
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