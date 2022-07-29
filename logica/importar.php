<?php
require('../datos/conex.php');
$usuario = $_POST['usuario'];
//obtenemos el archivo .csv
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$archivotmp = $_FILES['archivo']['tmp_name'];
//cargamos el archivo
$lineas = file($archivotmp);
//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
$i = 0;
//Recorremos el bucle para leer línea por línea
$contar = 0;
$contar_error = 0;
foreach ($lineas as $linea_num => $linea)
//abrimos bucle
{
	/*si es diferente a 0 significa que no se encuentra en la primera línea 
	(con los títulos de las columnas) y por lo tanto puede leerla*/
	if ($i != 0)
	//abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
	{
		/* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
	leyendo hasta que encuentre un ; */
		$datos = explode(";", $linea);
		//Almacenamos los datos que vamos leyendo en una variable
		$MOTIVO_COMUNICACION_GESTION = trim($datos[0]);
		$EVENTO_ADVERSO_GESTION = trim($datos[1]);
		$DESCRIPCION_COMUNICACION_GESTION = trim($datos[2]);
		$ID_PACIENTE_FK2 = trim($datos[3]);
		$FECHA_COMUNICACION = trim($datos[4]);
		/*$AUTOR_MODIFICACION = trim($datos[5]);*/
		//guardamos en base de datos la línea leida
		/*mysql_query("INSERT INTO datos(nombre,edad,profesion) VALUES('$nombre,'$edad ','$profesion ')");*/
		if ($MOTIVO_COMUNICACION_GESTION != '' && $EVENTO_ADVERSO_GESTION != '' && $DESCRIPCION_COMUNICACION_GESTION != '' && $ID_PACIENTE_FK2 != '' && $FECHA_COMUNICACION != '') {
			$insert_gestion = mysqli_query($conex,"INSERT INTO bayer_gestiones (MOTIVO_COMUNICACION_GESTION,AUTOR_GESTION,DESCRIPCION_COMUNICACION_GESTION,ID_PACIENTE_FK2,FECHA_COMUNICACION,FECHA_SUBIDO,AUTOR_MODIFICACION)
		VALUES('$MOTIVO_COMUNICACION_GESTION','FUNDEM','$DESCRIPCION_COMUNICACION_GESTION','$ID_PACIENTE_FK2','$FECHA_COMUNICACION',CURRENT_TIMESTAMP,'$usuario')");
			$contar = $contar + 1;
		}
		if ($MOTIVO_COMUNICACION_GESTION != '' || $EVENTO_ADVERSO_GESTION != '' || $DESCRIPCION_COMUNICACION_GESTION != '' || $ID_PACIENTE_FK2 != '' || $FECHA_COMUNICACION != '') {
			$contar_error = $contar_error + 1;
		}
		//cerramos condición
	}
	/*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
	$i++;
	//cerramos bucle
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