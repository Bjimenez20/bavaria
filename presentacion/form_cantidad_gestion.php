<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link href="css/estilo_asignacion.css" type="text/javascript" rel="stylesheet" />
</head>
<?PHP
require('../datos/parse_str.php');
require_once("../datos/conex.php");
$hoy = date('Y-m-d');
$select_usu = mysqli_query($conex, "select USER,NOMBRES,APELLIDOS,ESTADO,PRIVILEGIOS,ESTADO_LOGIN FROM ipsen_usuario WHERE ESTADO='1' AND PRIVILEGIOS='2' AND ESTADO_LOGIN='IN'");
echo mysqli_error($conex);
$nreg_usu = mysqli_num_rows($select_usu);
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
		$insertar_tempo = mysqli_query($conex, "INSERT INTO ipsen_temporal_gestiones(ID_GESTION_FK) VALUES ('" . $ID_GESTION . "')");
		echo mysqli_error($conex);
	}
}
$nreg_pac = $total_gestiones;
$VALOR = floor($nreg_pac / $nreg_usu);
if ($privilegios != '' && $usua != '') {
?>

	<body>
		<form method="post" name="cantidad" id="cantidad" action="../logica/asignar_gestiones.php" class="letra">
			<center>
				<br />
				<span style="font-size:140%;"> TOTAL GESTION DEL DIA <?php echo $nreg_pac ?></span>
				<br />
				<br />
				<?PHP
				$faltantes = ($nreg_pac - ($VALOR * $nreg_usu));
				if ($faltantes > 0) {
				?>
					<span style="font-size:140%; color:#F00"> CANTIDAD DE GESTIONES POR ASIGNAR <?php echo $faltantes ?></span>
					<br />
					<br />
					<br />
					<br />
				<?php
				}
				?>
			</center>
			<center>
				<table style="width:50%;; border:#fff" rules="rows" id="tabla">
					<tr>
						<th colspan="3" style="color:#FFF" bgcolor="#92c14a">
							USUARIOS
						</th>
					</tr>
					<tr>
						<th bgcolor="#92c14a">
							NOMBRE(S) DE USUARIO(S)
						</th>
						<th bgcolor="#92c14a">
							NOMBRE(S) DE ASESOR(ES)
						</th>
						<th bgcolor="#92c14a">
							CANTIDAD GESTIONES
						</th>
					</tr>
					<tr>
						<?php
						if ($nreg_usu > 0) {
							$i = 0;
							while ($fila = (mysqli_fetch_array($select_usu))) {
								$i = $i + 1;
						?>
								<td>
									<input type="text" value="<?php echo $fila['USER'] ?>" id="<?php echo 'usu' . $i ?>" name="<?php echo 'usu' . $i ?>" style="border:1px solid transparent; background-color:transparent;" readonly="readonly" />
								</td>
								<td>
									<?php echo $fila['NOMBRES'] . ' ' . $fila['APELLIDOS']; ?>
								</td>
								<td>
									<input type="text" value="<?php echo $VALOR ?>" id="<?php echo 'cant' . $i ?>" name="<?php echo 'cant' . $i ?>" maxlength="3" style="width:45%;" />
								</td>
								<?PHP
								?>
					</tr>
			<?PHP
							}
						}
			?>
			<input type="hidden" value="<?php echo $i ?>" id="id" name="id" />
			<input type="hidden" value="<?php echo $nreg_pac ?>" id="gestiones" name="gestiones" />
				</table>
			</center>
			<center>
				<br />
				<br />
				<input type="submit" class="btn_continuar" style="background-image:url(imagenes/BTN_CONTINUAR2.png)" value="" onclick="return validar(cantidad)" />
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
<script>
	function validar(tuformulario) {
		if (confirm('¿Estas seguro de enviar la información?')) {
			document.tuformulario.submit()
		} else {
			return false;
		}
	}
</script>