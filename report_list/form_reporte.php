<?php
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>BAVARIA</title>
	<script src="../presentacion/js/jquery.js"></script>
	<style>
		.aviso3 {
			font-size: 130%;
			font-weight: bold;
			color: #11a9e3;
			text-transform: uppercase;
			font-family: Tahoma, Geneva, sans-serif;
			border-radius: 10px;
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
				if (valor == 'ipsen_reporte') {
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
				if (valor == 'ipsen_conteo') {
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
				if (valor == 'ipsen_terapia') {
					$('#div_fecha').css('display', 'none');
					$('#btn').css('display', 'none');
					$('#btn3').css('display', 'block');
					$('#div_terapia').css('display', 'block');
					$('#fecha').val('');
					$('#fecha_fin').val('');
					$("#terapias option:eq(0)").attr("selected", "selected");
				}
				if (valor == 'ipsen_gestiones') {
					$('#div_fecha').css('display', 'block');
					$('#btn').css('display', 'none');
					$('#div_terapia').css('display', 'none');
					$('#btn3').css('display', 'none');
					$('#fecha').val('');
					$('#fecha_fin').val('');
					$("#terapias option:eq(0)").attr("selected", "selected");
				}
				if (valor != 'ipsen_gestiones' && valor != 'ipsen_terapia' && valor != 'ipsen_reporte' && valor != 'ipsen_conteo') {
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
	<form method="post" action="reporte_excel.php" style="width:100%; margin:auto auto;" class="letra">
		<p class="aviso3" style=" width:68.9%; margin:auto auto;">EXPORTAR A EXCEL.</p>
		<br />
		<br />
		<center>
			<span>Seleccione la tabla que desea descargar</span>
			<select class="form-select" name="tabla" id="tabla" required="required">
				<option>Seleccione...</option>
				<option>ipsen_ciudad</option>
				<option>ipsen_departamento</option>
				<option>ipsen_evento_adverso</option>
				<option>ipsen_gestiones</option>
				<option>ipsen_inventario</option>
				<option>ipsen_listas</option>
				<option>ipsen_movimientos</option>
				<option>ipsen_paciente_movimientos</option>
				<option>ipsen_pacientes</option>
				<option>ipsen_referencia</option>
				<option>ipsen_relacion_producto</option>
				<option>ipsen_tratamiento</option>
				<option>usuario</option>
				<option>usuario_movimientos</option>
				<option>ipsen_terapia</option>
				<option>ipsen_historial_reclamacion</option>
				<option>ipsen_reporte</option>
				<option>ipsen_conteo</option>
			</select>
			<br />
			<br />
			<input class="descargar" type="submit" value="Descargar" id="btn" name="enviar" />
			<input class="descargar" type="submit" value="Descargar" id="btn_otro" name="enviar" formaction="reporte_excel2.php" style="display:none;" />
			<input class="descargar" type="submit" value="Descargar" id="btn_conteo" name="enviar" formaction="reporte_conteo.php" style="display:none;" />
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
					<input class="descargar" type="submit" value="Descargar" id="btn2" name="enviar2" style="display:none" />
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
					<input class="descargar" type="submit" value="Descargar" id="btn3" name="enviar3" style="display:none" />
				</center>
			</fieldset>
		</div>
	</form>
	<style>
		.descargar {
			color: #fff;
			background-color: #4caf50;
			border-color: #4caf50;
			box-shadow: 0 2px 2px 0 rgb(76 175 80 / 14%), 0 3px 1px -2px rgb(76 175 80 / 20%), 0 1px 5px 0 rgb(76 175 80 / 12%);
			cursor: pointer;
		}

		.descargar {
			position: relative;
			padding: 12px 30px;
			margin: 0.3125rem 1px;
			font-size: .75rem;
			font-weight: 400;
			line-height: 1.42857;
			text-decoration: none;
			text-transform: uppercase;
			letter-spacing: 0;
			cursor: pointer;
			border: 0;
			border-radius: 0.2rem;
			outline: 0;
			transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
			will-change: box-shadow, transform;
		}

		.form-select {
			width: 15%;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: rgb(33, 37, 41);
			background-color: transparent;
			background-size: 16px 12px;
			padding: 0.375rem 2.25rem 0.375rem 0.75rem;
			background-repeat: no-repeat;
			background-position: right 0.75rem center;
			border-width: 1px;
			border-style: solid;
			border-color: #224a81;
			border-image: initial;
			border-radius: 0.25rem;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
		}

		body {
			margin: 0;
			font-family: var(--bs-font-sans-serif);
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #212529;
			background-color: transparent;
			-webkit-text-size-adjust: 100%;
			-webkit-tap-highlight-color: transparent;
		}
	</style>
</body>

</html>