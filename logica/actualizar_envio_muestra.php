<?php
include('../datos/conex.php');
echo $ID_ENVIO = $_POST['ID_ENVIO'];
echo $ESTADO = $_POST['ESTADO'];
echo $FECHA_ENTREGA = $_POST['FECHA_ENTREGA'];
$update = mysqli_query($conex,"UPDATE bayer_envio_muestra
SET ESTADO = '" . $ESTADO . "',
FECHA_ENTREGA = '" . $FECHA_ENTREGA . "'
WHERE ID_ENVIO='$ID_ENVIO'");
echo mysqli_error($conex);
/*
if($update)
{
	?>
    <br>
    <a href="../presentacion/form_paciente.php?ID_PACIENTE=<?php echo $id_paciente; ?>" target="info"><img src="imagenes/no.png" width="47" height="49" id="btn" title="cerrar" onClick="cerrar()"/></a>
	<?PHP
}*/
