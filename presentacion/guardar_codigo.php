<?php
include('../datos/conex.php');
$CODIGO = $_POST['cod'];
$ID = $_POST['id'];
$id_paciente = $_POST['id_paciente'];
$update = mysqli_query($conex, "UPDATE ipsen_gestiones
					   SET CODIGO_ARGUS='" . $CODIGO . "'
					   WHERE ID_GESTION='$ID'");
echo mysqli_error($conex);
if ($update) {
?>
	<br>
	<a href="../presentacion/form_paciente.php?artid=<?php echo base64_encode($id_paciente); ?>" target="info"><img src="imagenes/no.png" width="47" height="49" id="btn" title="cerrar" onClick="cerrar()" /></a>
<?PHP
}
?>