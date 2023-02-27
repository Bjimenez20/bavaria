<?php
require('../datos/parse_str.php');
require_once("../datos/conex.php");
if (isset($_POST['boton'])) {
   $insert = mysqli_query($conex,"INSERT INTO `ipsen_informacion_tratamiento_ea`(`SCI`, `MEDICAMENTO`, `INDICACION`, `DOSIS`, `UNIDAD_MEDIDA`, `VIA_ADMINISTRACION`, `FRECUENCIA_ADMINISTRACION`, `FECHA_INICIO`, `FECHA_FIN`, `EVENTO_ADVERSO_ID`) VALUES ('Prueba','Prueba','Prueba','Prueba','Prueba','Prueba','Prueba','Prueba','Prueba','Prueba')");
}
