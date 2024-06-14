<?php
include('../datos/conex.php');
date_default_timezone_set("America/Bogota");
$select_conteo = mysqli_query($conex, "SELECT A.ID AS ID, A.CAUSAL_NO_VISITA AS CASUALIDAD, A.ID_PACIENTE_FK2, YEAR(A.FECHA_ULTIMO_REGISTRO) AS ANIO, MONTH(A.FECHA_ULTIMO_REGISTRO) AS MES,DAY(A.FECHA_ULTIMO_REGISTRO) AS DIA,  CONTEO,ESTADO FROM ipsen_conteo AS A  WHERE  ESTADO = '1'");
$row_select_conteo = mysqli_num_rows($select_conteo);
while ($sel_con = (mysqli_fetch_array($select_conteo))) {
	$fecha_conteo_MES = $sel_con['MES'];
	$fecha_conteo_DIA = $sel_con['DIA'];
	$fecha_conteo_AÑO = $sel_con['ANIO'];
	$id_conteo = $sel_con['ID'];
?>
	<form enctype="multipart/form-data" method="post">
		<table>
			<tr>
				<td><?php echo $sel_con['ID'];  ?> <input type="hidden" name="id[]" id="id" value="<?php echo $sel_con['ID'];  ?>" /></td>
				<td><?php echo $sel_con['DIA']; ?> <input type="hidden" name="dia[]" id="dia" value="<?php echo $sel_con['DIA']; ?>" /></td>
				<td><?php echo $sel_con['MES']; ?> <input type="hidden" name="mes[]" id="mes" value="<?php echo $sel_con['MES']; ?>" /></td>
				<td><?php echo $sel_con['ANIO']; ?> <input type="hidden" name="anio[]" id="anio" value="<?php echo $sel_con['ANIO']; ?>" /></td>
			</tr>
		</table>
	<?php
} ?><button type="submit" id="enviar" name="enviar">Enviar</button>
	</form>
	<?php
	if (isset($_POST['enviar'])) {
		$d = date('d');
		$mes_nu = date('m');
		$año    = date('Y');
		$fecha1 = new DateTime("$año-$mes_nu-$d");
		$id_cont = $_POST['id'];
		$fecha_dia = $_POST['dia'];
		$fecha_mes = $_POST['mes'];
		$fecha_anio = $_POST['anio'];
		if ($row_select_conteo > 0) {
			for ($i = 0; $i < count($id_cont); $i++) {
				$id_contv = $id_cont[$i];
				$fecha_aniov = $fecha_anio[$i];
				$fecha_mesv  = $fecha_mes[$i];
				$fecha_diav = $fecha_dia[$i];
				$fecha2 = new DateTime("$fecha_aniov-$fecha_mesv-$fecha_diav");
				$diff = $fecha1->diff($fecha2);
				$actualiza_conteo = mysqli_query($conex, "UPDATE ipsen_conteo SET CONTEO = '" . $diff->days . "' WHERE  ESTADO = '1' AND ID ='" . $id_contv . "' ");
			}
		}
	}
	?>