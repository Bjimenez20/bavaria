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
		$MOTIVO_COMUNICACION_GESTION = trim($datos[0]);
		$EVENTO_ADVERSO_GESTION = trim($datos[1]);
		$DESCRIPCION_COMUNICACION_GESTION = trim($datos[2]);
		$ID_PACIENTE_FK2 = trim($datos[3]);
		$FECHA_COMUNICACION = trim($datos[4]);
		if ($MOTIVO_COMUNICACION_GESTION != '' && $EVENTO_ADVERSO_GESTION != '' && $DESCRIPCION_COMUNICACION_GESTION != '' && $ID_PACIENTE_FK2 != '' && $FECHA_COMUNICACION != '') {
			$insert_gestion = mysqli_query($conex, "INSERT INTO ipsen_gestiones (MOTIVO_COMUNICACION_GESTION,AUTOR_GESTION,DESCRIPCION_COMUNICACION_GESTION,ID_PACIENTE_FK2,FECHA_COMUNICACION,FECHA_SUBIDO,AUTOR_MODIFICACION)
		VALUES('$MOTIVO_COMUNICACION_GESTION','FUNDEM','$DESCRIPCION_COMUNICACION_GESTION','$ID_PACIENTE_FK2','$FECHA_COMUNICACION',CURRENT_TIMESTAMP,'$usuario')");
			$contar = $contar + 1;
		}
		if ($MOTIVO_COMUNICACION_GESTION != '' || $EVENTO_ADVERSO_GESTION != '' || $DESCRIPCION_COMUNICACION_GESTION != '' || $ID_PACIENTE_FK2 != '' || $FECHA_COMUNICACION != '') {
			$contar_error = $contar_error + 1;
		}
	}
	$i++;
}
?>
<span style="margin-top:5%;">
	<center>
		<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
	</center>
</span>
<center>
	<p style=" width:68.9%; margin:auto auto;font-size: 130%;font-weight: bold;color: #11a9e3;text-transform:uppercase;background-color:transparent;	text-align: center;	padding:10px;">SE INGRESARO <?php echo $contar . ' DE ' . $contar_error ?> GESTIONES SATISFACTORIAMENTE.</p>
	<br />
	<br />
	<a href="../presentacion/form_cargar_observacion_fundem.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
</center>
<br />
<?php
?>