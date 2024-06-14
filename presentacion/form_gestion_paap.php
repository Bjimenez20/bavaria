<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
	<link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
</head>
<script src="../presentacion/js/jquery.js"></script>
<style>
	.error {
		font-size: 130%;
		font-weight: bold;
		color: #fb8305;
		text-transform: uppercase;
		background-color: transparent;
		text-align: center;
		padding: 10px;
	}

	html {
		background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}

	@media screen and (max-width:1000px) {
		html {
			background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
	}
</style>
<script>
	function reclamo() {
		$("#causa_no_reclamacion option:eq(21)").attr("selected", "selected");
		$("#fecha_reclamacion").val('');
		$('#numero_cajas option:eq(0)').attr('selected', 'selected');
		$('#tipo_numero_cajas option:eq(0)').attr('selected', 'selected');
		var reclamo = $('#reclamo').val();
		var MEDICAMENTO = $('#MEDICAMENTO').val();
		if (reclamo == '') {
			$("#causa").css('display', 'none');
			$('#causa_no_reclamacion').css('display', 'none');
			$("#fecha_reclamacion_span").css('display', 'none');
			$('#fecha_reclamacion').css('display', 'none');
			$("#consecutivo_betaferon_span").css('display', 'none');
			$('#consecutivo_betaferon').css('display', 'none');
			$('#numero_cajas option:eq(0)').attr('selected', 'selected');
			$('#tipo_numero_cajas option:eq(0)').attr('selected', 'selected');
			$('#numero_cajas').attr('disabled', 'disabled');
			$('#tipo_numero_cajas').attr('disabled', 'disabled');
		}
		if (reclamo == 'NO') {
			$("#causa").css('display', 'block');
			$('#causa_no_reclamacion').css('display', 'block');
			$('#fecha_no_reclamacion').css('display', 'block');
			$("#fecha_reclamacion_span").css('display', 'none');
			$('#fecha_reclamacion').css('display', 'none');
			$('#causa_no_reclamacion option:eq(21)').attr('selected', 'selected');
			$("#consecutivo_betaferon_span").css('display', 'none');
			$('#consecutivo_betaferon').css('display', 'none');
			$('#numero_cajas option:eq(0)').attr('selected', 'selected');
			$('#tipo_numero_cajas option:eq(0)').attr('selected', 'selected');
			$('#causa_no_reclamacion option:eq(1)').attr('selected', 'selected');
			$("#fecha_no_reclamacion").val($('#fecha_reclamacion').prop('defaultValue'));
			$('#numero_cajas').attr('disabled', 'disabled');
			$('#tipo_numero_cajas').attr('disabled', 'disabled');
			$('#span_tabletas_diarias').css('display', 'none');
			$('#div_tabletas_diarias').css('display', 'none');
		}
		if ((reclamo == 'NO' || reclamo == '') && MEDICAMENTO == 'Eylia 2MG VL 1x2ML CO INST') {
			$('#numero_cajas option:eq(0)').attr('selected', 'selected');
			$('#tipo_numero_cajas option:eq(0)').attr('selected', 'selected');
			$('#numero_cajas').removeAttr('disabled');
			$('#tipo_numero_cajas').removeAttr('disabled');
		}
		if (reclamo == 'SI' && MEDICAMENTO == 'BETAFERON CMBP X 15 VPFS (3750 MCG) MM') {
			$("#fecha_reclamacion").val($('#fecha_reclamacion').prop('defaultValue'));
			$("#consecutivo").val($('#consecutivo').prop('defaultValue'));
			$("#consecutivo_betaferon_span").css('display', 'block');
			$('#consecutivo_betaferon').css('display', 'block');
			$("#fecha_reclamacion_span").css('display', 'block');
			$('#fecha_reclamacion').css('display', 'block');
			$("#causa").css('display', 'none');
			$('#causa_no_reclamacion').css('display', 'none');
			$('#numero_cajas').removeAttr('disabled');
			$('#tipo_numero_cajas').removeAttr('disabled');
			$('#span_tabletas_diarias').css('display', 'none');
			$('#div_tabletas_diarias').css('display', 'none');
		} else {
			if (reclamo == 'SI') {
				$("#fecha_reclamacion_span").css('display', 'block');
				$('#fecha_reclamacion').css('display', 'block');
				$('#fecha_no_reclamacion').css('display', 'none');
				$("#causa").css('display', 'none');
				$('#causa_no_reclamacion').css('display', 'none');
				$('#numero_cajas').removeAttr('disabled');
				$('#tipo_numero_cajas').removeAttr('disabled');
				$("#fecha_reclamacion").val($('#fecha_reclamacion').prop('defaultValue'));
				$("#numero_tabletas_diarias").val('');
				var MEDICAMENTO = $('#MEDICAMENTO').val();
				if (MEDICAMENTO == 'NEXAVAR 200MGX60C(12000MG)INST' || MEDICAMENTO == 'ADEMPAS' || MEDICAMENTO == 'ADEMPAS 0.5MG 42TABL' || MEDICAMENTO == 'ADEMPAS 1.5MG 42TABL' || MEDICAMENTO == 'ADEMPAS 1MG 42TABL' || MEDICAMENTO == 'ADEMPAS 2.5MG 84TABL' || MEDICAMENTO == 'ADEMPAS 2MG 42TABL') {
					$('#span_tabletas_diarias').css('display', 'inline-block');
					$('#div_tabletas_diarias').css('display', 'inline-block');
				}
				if (MEDICAMENTO != 'NEXAVAR 200MGX60C(12000MG)INST' && MEDICAMENTO != 'ADEMPAS' && MEDICAMENTO != 'ADEMPAS 0.5MG 42TABL' && MEDICAMENTO != 'ADEMPAS 1.5MG 42TABL' && MEDICAMENTO != 'ADEMPAS 1MG 42TABL' && MEDICAMENTO != 'ADEMPAS 2.5MG 84TABL' && MEDICAMENTO != 'ADEMPAS 2MG 42TABL') {
					$('#span_tabletas_diarias').css('display', 'none');
					$('#div_tabletas_diarias').css('display', 'none');
				}
			}
		}
	}
	reclamo();
	$("#reclamo").change(function() {
		reclamo();
	});
</script>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$ID_PACIENTE = base64_decode($xxx);
$producto = base64_decode($xxxx);
$select = mysqli_query($conex, "SELECT DOSIS FROM  ipsen_dosis WHERE NOMBRE_REFERENCIA='$producto' ORDER BY DOSIS ASC");
echo mysqli_error($conex);
$selectgestion = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2 = $ID_PACIENTE");
while ($row = mysqli_fetch_array($selectgestion)) {
	$FECHA_NO_RECLAMACION = $row['FECHA_NO_RECLAMACION'];
	$RECLAMO_GESTION = $row['RECLAMO_GESTION'];
	$CAUSA_NO_RECLAMACION_GESTION = $row['CAUSA_NO_RECLAMACION_GESTION'];
}
?>

<body>
	<div>
		<img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
	</div>
	<form action="../logica/guardar_gestion_paap.php" method="post">
		<input type="hidden" value="<?php echo $ID_PACIENTE ?>" name="id_paciente" id="id_paciente" />
		<fieldset style="border:1px solid #000; border-radius:5px; margin:auto auto; width:80%;">
			<legend style="font-size:120%;">Informaci&oacute;n</legend>
			<table style="width:100%">
				<tr>
					<td>
						PAP</td>
					<td>
						<input name="codigo_cliente" type="text" id="codigo_cliente" max="10" readonly="readonly" value="<?php echo $ID_PACIENTE; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<span>Reclamo<span class="asterisco">*</span></span>
					</td>
					<td>
						<select type="text" name="reclamo" id="reclamo">
							<option><?php echo $reclamo ?></option>
							<?php
							if ($RECLAMO_GESTION == 'NO') {
							?>
								<option>SI</option>
							<?php
							}
							if ($reclamo == 'SI') {
							?>
								<option>NO</option>
							<?php
							}
							if ($reclamo == '') {
							?>
								<option>SI</option>
								<option>NO</option>
							<?php
							}
							?>
						</select>
					</td>
					<td>
						<span style=" display:none" id="causa">Causa No Reclamacion<span class="asterisco">*</span></span>
						<span style=" display:none" id="fecha_reclamacion_span">Fecha de Reclamaci&oacute;n<span class="asterisco">*</span></span>
					</td>
					<td>
						<select type="text" name="causa_no_reclamacion" id="causa_no_reclamacion" style=" display:none">
							<option></option>
							<option><?php echo $MOTIVO_NO_RECLAMACION ?></option>
							<option value="">Seleccione...</option>
							<option>A demanda</option>
							<option>Abandono</option>
							<option>Autorizacion radicada en Mipres</option>
							<option>Cita inoportuna</option>
							<option>Cobro de copagos o cuotas de recuperacion</option>
							<option>Compra de medicamento</option>
							<option>Demora en la autorizacion de medicamento</option>
							<option>Demora en la entrega</option>
							<option>Demora en la respuesta de ctc</option>
							<option>Demora en la respuesta de Mipres</option>
							<option>Desafiliacion eps</option>
							<option value="En proceso de Reformulacion">En proceso de Reformulacion</option>
							<option>En proceso de autorizacion</option>
							<option>En proceso de cita</option>
							<option>En proceso de entrega</option>
							<option>Error en papeleria</option>
							<option>Error en formulacion de CTC</option>
							<option>Error en formulacion de MIPRES</option>
							<option>Falta de cita medica</option>
							<option>Falta de contacto</option>
							<option>Falta de medicamento en el punto</option>
							<option>Falta de pago anticipado de EPS a IPS / OPL</option>
							<option>Falta de pruebas diagnosticas</option>
							<option>Hospitalizado</option>
							<option>Ilocalizable</option>
							<option>Interrumpido por examenes</option>
							<option>Negacion CTC</option>
							<option>No remision a entidad licenciada
							<option>Pendiente Agendar Cita</option>
							<option>Pendiente Subir Formula A Mipres</option>
							<option>Stock</option>
							<option>Sin red prestadora</option>
							<option>Suspendido temporalmente</option>
							<option>Titulacion</option>
							<option>Voluntario</option>
						</select>
						<input type="date" name="fecha_reclamacion" id="fecha_reclamacion" style=" display:none" max="<?php echo date('Y-m-d'); ?>" min="<?php echo $DIAS_ANTES ?>" value="<?php echo $FECHA_RECLAMACION ?>" />
						<div id="fecha_no_reclamacion" style="display:none; position: relative; margin-top:10%;">
							<span id="">Fecha Cita Programada<span class="asterisco">*</span></span>
							<input name="fecha_no_reclamacion" type="date" style="margin-top: 10px;" value="<?php echo $FECHA_NO_RECLAMACION ?>" />
						</div>
					</td>
				</tr>
				<script>
					$('#causa_no_reclamacion').on('change', function() {
						var selectValor = $(this).val();
						if (selectValor == 'En proceso de Reformulacion') {
							$('#fecha_no_reclamacion').show();
						} else {
							$('#fecha_no_reclamacion').hide();
						}
					});
				</script>
				<tr>
					<td width="16%" style="width:10%;">
						Barrera
					</td>
					<td width="34%" style="width:40%;">
						<select name="barrera" id="barrera" style="width:90%" required>
							<option value="">Seleccione...</option>
							<option>Abandono</option>
							<option>Cita inoportuna</option>
							<option>Cobro de copagos o cuotas de recuperacion</option>
							<option>Demora en la autorizacion</option>
							<option>Demora en la autorizacion de Mipres</option>
							<option>Desafiliacion de eps</option>
							<option>En proceso de autorizacion</option>
							<option>En proceso de cita</option>
							<option>En proceso de entrega</option>
							<option>Error en formulacion de CTC</option>
							<option>Error en formulacion de Mipres</option>
							<option>Falta de cita medica</option>
							<option>Falta de cita medica para aplicacion</option>
							<option>Falta de medicamento en el punto</option>
							<option>Falta de pago anticipado de eps a Ips/ Opl</option>
							<option>Falta de pruebas diagnosticas</option>
							<option>Negacion ctc</option>
							<option>No apto</option>
							<option>Remision a entidad licenciada</option>
							<option>Sin red prestadora</option>
							<option>Vencimiento de formula</option>
						</select>
					</td>
					<td width="10%" style="width:10%;">
						Fecha Proximo contacto
					</td>
					<td width="40%" style="width:40%;">
						<input type="date" name="fecha_contacto" id="fecha_contacto" style="width:90%" required />
					</td>
				</tr>
				<tr>
					<td>
						Descripcion de Comunicaci&oacute;n
						<br />
						<br />
					</td>
					<td colspan="3">
						<textarea style="width:98%; height:72.5px;" id="descripcion_comunicacion" name="descripcion_comunicacion" onKeyDown="return filtro(1)"></textarea>
						<br />
						<br />
					</td>
				</tr>
				<tr>
					<th colspan="4">
						<br />
						<input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(seguimiento,2)" />
					</th>
				</tr>
			</table>
		</fieldset>
	</form>
</body>

</html>