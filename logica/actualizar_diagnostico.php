<style type="text/css">
	html,
	body {
		background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	/*form 
{
    background:url(../presentacion/imagenes/LOGIN.png) top center no-repeat;
}*/
	@media screen and (max-width:1000px) {
		html,
		body {
			background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
	}
</style>
<?php
require('../datos/conex.php');
if (isset($_GET['xnfgti'])) {
	$id_personaa = base64_decode($_GET['xnfgti']);
	$terapia = base64_decode($_GET['vvgg']);
	$examne1 = $_POST['examne1']; //echo $examne1;
	$examne2 = $_POST['examne2']; //echo $examne2;
	$examne3 = $_POST['examne3']; //echo $examne3;
	$examne4 = $_POST['examne4']; //echo $examne4;
	$examne5 = $_POST['examne5']; //echo $examne5;
	$examne6 = $_POST['examne6']; //echo $examne6;
	$examne7 = $_POST['examne7']; //echo $examne7;
	$cant_examenes = $_POST['cant_examenes']; //echo $cant_examenes;
	$numero_voucher = $_POST['numero_voucher']; //echo $numero_voucher;
	$centro_medic = $_POST['centro_medic']; //echo $centro_medic;
	$n_gestion = $_POST['n_gestion']; //echo $n_gestion;
	$img_archivo = $_POST['img_archivo']; //echo $img_archivo;
	$insert_apoyo_diagnostico = mysqli_query($conex,"UPDATE bayer_apoyo_diagnostico SET EXAMEN_1 = '" . $examne1 . "', EXAMEN_2 = '" . $examne2 . "', EXAMEN_3 = '" . $examne3 . "', EXAMEN_4 = '" . $examne4 . "', EXAMEN_5 = '" . $examne5 . "', EXAMEN_6 = '" . $examne6 . "', EXAMEN_7 = '" . $examne7 . "', CANTIDAD_EXAMENES = '" . $cant_examenes . "', NUMERO_VOUCHER = '" . $numero_voucher . "', CENTRO_MEDICO = '" . $centro_medic . "', ARCHIVO_IMG = '" . $img_archivo . "' WHERE ID_APOYO_DIAGNOSTICO = '" . $n_gestion . "'; ");
?>
	<span style="margin-top:5%;">
		<center>
			<img src="../presentacion/imagenes/chulo.png" width="151" height="150" style="width:100px; margin-top:100px;margin-top:5%;" />
		</center>
	</span>
	<br><br><br>
	<center>
		<p class="aviso3">HA ACTUALIZADO LA INFORMACION DEL PACIENTE CORRECTAMENTE.</p>
	</center>
<?php  } ?>