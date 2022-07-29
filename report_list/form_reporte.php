<?php


error_reporting(0);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<script src="../presentacion/js/jquery.js"></script>
	<style>
		.aviso3 {
			font-size: 130%;
			font-weight: bold;
			color: #11a9e3;
			text-transform: uppercase;
			font-family: Tahoma, Geneva, sans-serif;
			border-radius: 10px;
			/*background: #11a9e3;*/
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}
		.letra {
			font-family: Tahoma, Geneva, sans-serif;
		}
	</style>
	<script>
		$(document).ready(function() {
			$('input:radio[name=res]').change(function() {
				var res = $('input:radio[name=res]:checked').val();
				if (res == 'TODO') {
					$('#tabla').css('display', 'block');
					$('#fecha').val('');
					$('#fecha').attr('readonly', 'readonly');
					$('#fecha_fin').val('');
					$('#fecha_fin').attr('readonly', 'readonly');
					$('#btn2').css('display', 'none');
				}
				if (res == 'CONFECHA') {
					$('#btn').css('display', 'none');
					$('#fecha').val('');
					$('#fecha').removeAttr('readonly');
					$('#fecha_fin').val('');
					$('#fecha_fin').removeAttr('readonly');
					$('#btn2').css('display', 'block');
				}
			});
			$('#tabla').change(function() {
				var valor = $('#tabla').val();
				$('#btn2').css('display', 'none');
				$("input:radio[name=res]").prop('checked', false);
				$('#fecha').attr('readonly', 'readonly');
				$('#fecha_fin').attr('readonly', 'readonly');
				$('#btn_otro').css('display', 'none');
				$('#btn_conteo').css('display', 'none');
				if (valor == 'bayer_reporte') {
					$('#btn_otro').css('display', 'block');
					$('#div_fecha').css('display', 'none');
					$('#btn').css('display', 'none');
					$('#btn_conteo').css('display', 'none');
					$('#div_terapia').css('display', 'none');
					$('#btn3').css('display', 'none');
					$('#fecha').val('');
					$('#fecha_fin').val('');
					$("#terapias option:eq(0)").attr("selected", "selected");
				}
				/////////////conteo////
				if (valor == 'bayer_conteo') {
					$('#btn_conteo').css('display', 'block');
					$('#btn_otro').css('display', 'none');
					$('#div_fecha').css('display', 'none');
					$('#btn').css('display', 'none');
					$('#div_terapia').css('display', 'none');
					$('#btn3').css('display', 'none');
					$('#fecha').val('');
					$('#fecha_fin').val('');
					$("#terapias option:eq(0)").attr("selected", "selected");
				}
				////////////conteo/////
				if (valor == 'bayer_terapia') {
					$('#div_fecha').css('display', 'none');
					$('#btn').css('display', 'none');
					$('#btn3').css('display', 'block');
					$('#div_terapia').css('display', 'block');
					$('#fecha').val('');
					$('#fecha_fin').val('');
					$("#terapias option:eq(0)").attr("selected", "selected");
				}
				if (valor == 'bayer_gestiones') {
					$('#div_fecha').css('display', 'block');
					$('#btn').css('display', 'none');
					$('#div_terapia').css('display', 'none');
					$('#btn3').css('display', 'none');
					$('#fecha').val('');
					$('#fecha_fin').val('');
					$("#terapias option:eq(0)").attr("selected", "selected");
				}
				if (valor != 'bayer_gestiones' && valor != 'bayer_terapia' && valor != 'bayer_reporte' && valor != 'bayer_conteo') {
					$('#div_fecha').css('display', 'none');
					$('#btn').css('display', 'block');
					$('#div_terapia').css('display', 'none');
					$('#btn3').css('display', 'none');
					$('#fecha').val('');
					$('#fecha_fin').val('');
					$("#terapias option:eq(0)").attr("selected", "selected");
				}
				btn_otro
			});
		});
	</script>
</head>
<body>
	<form method="post" action="reporte_excel.php" style="width:50%; margin:auto auto;" class="letra">
		<p class="aviso3" style=" width:68.9%; margin:auto auto;">EXPORTAR A EXCEL.</p>
		<br />
		<br />
		<center>
			<span>Seleccione la tabla que desea descargar</span>
			<select name="tabla" id="tabla" required="required">
				<option></option>
				<option>bayer_ciudad</option>
				<option>bayer_departamento</option>
				<option>bayer_evento_adverso</option>
				<option>bayer_gestiones</option>
				<option>bayer_inventario</option>
				<option>bayer_listas</option>
				<option>bayer_movimientos</option>
				<option>bayer_paciente_movimientos</option>
				<option>bayer_pacientes</option>
				<option>bayer_referencia</option>
				<option>bayer_relacion_producto</option>
				<option>bayer_tratamiento</option>
				<option>bayer_usuario</option>
				<option>bayer_usuario_movimientos</option>
				<option>bayer_terapia</option>
				<option>bayer_historial_reclamacion</option>
				<option>bayer_reporte</option>
				<option>bayer_conteo</option>
			</select>
			<br />
			<br />
			<input type="submit" value="Descargar" id="btn" name="enviar" />
			<input type="submit" value="Descargar" id="btn_otro" name="enviar" formaction="reporte_excel2.php" style="display:none;" />
			<input type="submit" value="Descargar" id="btn_conteo" name="enviar" formaction="reporte_conteo.php" style="display:none;" />
			<br />
			<br />
		</center>
		<div style="width:60%; margin:auto auto; display:none" id="div_fecha">
			<input type="radio" name="res" id="res" value="TODO" />EXPORTAR TODAS LAS GESTIONES
			<br />
			<input type="radio" name="res" id="res" value="CONFECHA" />SELECCIONAR FECHA
			<br />
			<fieldset>
				<legend style="text-align:center; font-weight:bold;">Fecha de gestion(opcional)</legend>
				<br />
				<input type="date" name="fecha" id="fecha" readonly="readonly" />
				&nbsp;&nbsp;&nbsp;HASTA &nbsp;&nbsp;&nbsp;
				<input type="date" name="fecha_fin" id="fecha_fin" readonly="readonly" />
				<br /><br />
				<center>
					<input type="submit" value="Descargar" id="btn2" name="enviar2" style="display:none" />
				</center>
			</fieldset>
		</div>
		<div style="width:60%; margin:auto auto; display:none" id="div_terapia">
			<fieldset>
				<legend>SELECCIONAR TERAPIA A DESCARGAR</legend>
				<center>
					<select name="terapias" id="terapias" style="width:80%;">
						<option></option>
						<option>ADEMPAS</option>
						<option>BETAFERON</option>
						<option>EYLIA</option>
						<option>KOGENATE</option>
						<option>NEXAVAR</option>
						<option>VENTAVIS</option>
						<option>XARELTO</option>
						<option>XOFIGO</option>
					</select>
					<br />
					<br />
					<input type="submit" value="Descargar" id="btn3" name="enviar3" style="display:none" />
				</center>
			</fieldset>
		</div>
	</form>
</body>
</html>