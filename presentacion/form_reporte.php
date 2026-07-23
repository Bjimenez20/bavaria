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
	<iframe src="../report_list/form_reporte.php" width='100%' height='500' frameborder='0'></iframe>
</body>

</html>