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
			color: #fb8305;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}
	</style>
</head>
<body>
	<?PHP
require('../datos/parse_str.php');
	require('../datos/conex.php');
	$hoy = date('Y-m-d');
	$totalcant = 0;
	$id = $_POST['id'];
	$cant_gestiones = $_POST['gestiones'];
	for ($i = 1; $i <= $id; $i++) {
		$cantidad = $_POST['cant' . $i];
		$totalcant = $totalcant + $cantidad;
		$result = $cant_gestiones - $totalcant;
	}
	if ($result == 0) {
		for ($k = 1; $k <= $id; $k++) {
			$aaa = 0;
			$cantidad = $_POST['cant' . $k];
			$nom_usu = $_POST['usu' . $k];
			$select_ID_GESTIONES = mysqli_query($conex,"SELECT ID_GESTION_FK FROM ipsen_temporal_gestiones LIMIT $cantidad");
			echo mysqli_error($conex);
			$nreg_usu = mysqli_num_rows($select_ID_GESTIONES);
			while ($dato = mysqli_fetch_array($select_ID_GESTIONES)) {
				$ID_GESTION = $dato['ID_GESTION_FK'];
				$actualizar = mysqli_query($conex,"UPDATE ipsen_gestiones SET
				USUARIO_ASIGANDO='" . $nom_usu . "',
				ESTADO_GESTION='ASIGNADO'
				WHERE ID_GESTION='$ID_GESTION'");
				echo mysqli_error($conex);
				$borra = mysqli_query($conex,"DELETE FROM ipsen_temporal_gestiones WHERE ID_GESTION_FK=$ID_GESTION");
				echo mysqli_error($conex);
			}
			$aaa . "<br />";
		}
		$borrar_temp = mysqli_query($conex,"TRUNCATE TABLE ipsen_temporal_gestiones");
		if ($actualizar) {
	?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3" style=" width:68.9%; margin:auto auto;">SE ASIGNARON LAS GESTIONES CORRECTAMENTE.</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/form_asignacion_gestiones.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR.png" style="width:152px; height:37px" /></a>
			</center>
		<?php
		}
	} else if ($result > 0 || $result < 0) {
		?>
		<span style="margin-top:5%;">
			<center>
				<img src="../presentacion/imagenes/advertencia.png" style="width:50px; margin-top:100px;margin-top:5%;" />
			</center>
		</span>
		<p class="error" style=" width:68.9%; margin:auto auto;">
			<span style="border-left-color:#fff">ERROR EN LAS CANTIDADES ASIGNADAS.</span>
		</p>
		<br />
		<br />
		<center>
			<a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
		</center>
	<?php
	}
	?>
</body>
</html>