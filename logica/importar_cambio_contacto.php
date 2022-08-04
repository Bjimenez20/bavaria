<?php
require('../datos/conex.php');
$usuario = $_POST['usuario'];
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$archivotmp = $_FILES['archivo']['tmp_name'];
$lineas = file($archivotmp);
$i = 0;
$contar = 0;
$contar_error = 0;
foreach ($lineas as $linea_num => $linea) {
	if ($i != 0) {
		$datos = explode(";", $linea);
		$ID_PACIENTE_FK2 = trim($datos[0]);
		$FECHA_COMUNICACION = trim($datos[1]);
		$hoy = date('Y-m-d');
		if ($ID_PACIENTE_FK2 != '' && $FECHA_COMUNICACION != '') {
			$fecha = explode("/", $FECHA_COMUNICACION);
			$mes = $fecha[0];
			if ($mes == $FECHA_COMUNICACION) {
				$select = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2='$ID_PACIENTE_FK2' ORDER BY FECHA_PROGRAMADA_GESTION DESC,ID_GESTION DESC LIMIT 1");
				echo mysqli_error($conex);
				while ($dato = mysqli_fetch_array($select)) {
					$ID_GESTION = $dato['ID_GESTION'];
					$FECHA_PROGRAMADA_GESTION = $dato['FECHA_PROGRAMADA_GESTION'];
					if ($FECHA_COMUNICACION > $FECHA_PROGRAMADA_GESTION) {
						if ($FECHA_COMUNICACION > $hoy) {
							$UPDATE = mysqli_query($conex, "UPDATE ipsen_gestiones
							SET
							FECHA_PROXIMA_LLAMADA='$FECHA_COMUNICACION',
							FECHA_PROGRAMADA_GESTION='$FECHA_COMUNICACION',
							AUTOR_MODIFICACION='$usuario'
							WHERE ID_PACIENTE_FK2='$ID_PACIENTE_FK2' AND ID_GESTION='$ID_GESTION'");
							if ($UPDATE) {
								$contar = $contar + 1;
							}
							if (!$UPDATE) {
								$contar_error = $contar_error + 1;
							}
						} else {
							$contar_error = $contar_error + 1;
						}
					} else {
						$contar_error = $contar_error + 1;
					}
				}
			} else {
				$contar_error = $contar_error + 1;
			}
			$total = $contar_error + $contar;
		}
	}
	$i++;
}
if ($contar == $total) {
?>
	<span style="margin-top:5%;">
		<center>
			<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
		</center>
	</span>
	<center>
		<p style=" width:68.9%; margin:auto auto;font-size: 130%;font-weight: bold;color: #11a9e3;text-transform:uppercase;background-color:transparent;	text-align: center;	padding:10px;">SE ACTUALIZO LA FECHA DE CONTATO A <?php echo $contar . ' DE ' . $total ?> PACIENTE(S) SOLICITADO(S).</p>
		<br />
		<br />
	<?php
} else {
	?>
		<span style="margin-top:5%;">
			<center>
				<img src="../presentacion/imagenes/advertencia2.png" width="107" height="98" style="width:100px; margin-top:100px;margin-top:5%;" />
			</center>
		</span>
		<center>
			<p style=" width:68.9%; margin:auto auto;font-size: 130%;font-weight: bold;color: #fb8305;text-transform:uppercase;background-color:transparent;text-align: center;padding:10px;">SOLO SE ACTUALIZO LA FECHA DE CONTATO A <span style="color:#F00;"><?php echo $contar . ' DE ' . $total ?></span> PACIENTE(S) SOLICITADO(S).</p>
			<br />
			<br />
		<?php
	}
		?>
		<a href="../presentacion/form_cambio_contacto_fundem.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
		</center>
		<br />
		<?php
		?>