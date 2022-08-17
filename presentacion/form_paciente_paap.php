<?php
header("Content-Type: text/html;charset=utf-8");
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="windows-1252">
	<title>IPSEN</title>
	<link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
	<script src="css/SpryAssets/SpryAccordion.js" type="text/javascript"></script>
	<link href="css/SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/calcular_edad.js"></script>
	<script type="text/javascript" src="js/direccion.js"></script>
	<script type="text/javascript" src="js/validar_campos_pacientes.js"></script>
	<script type="text/javascript" src="js/validaciones.js"></script>
	<script type="text/javascript" src="js/validar_caracteres.js"></script>
	<script src="../presentacion/js/jquery.js"></script>
	<script language=javascript>
		function ventanaSecundaria(URL) {
			window.open(URL, "ventana1", "width=1300,height=500,Top=150,Left=50%")
		}
	</script>
	<style>
		td {
			padding: 3px;
			background-color: transparent;
		}

		.input__row {
			margin-top: 10px;
		}

		.upload {
			display: none;
		}

		.uploader {
			border: 2px solid #2797d3;
			width: 300px;
			position: relative;
			height: 30px;
			display: flex;
		}

		.uploader .input-value {
			width: 250px;
			padding: 5px;
			overflow: hidden;
			text-overflow: ellipsis;
			line-height: 25px;
			font-family: sans-serif;
			font-size: 16px;
		}

		.uploader label {
			cursor: pointer;
			margin: 0;
			width: 30px;
			height: 30px;
			position: absolute;
			right: 0;
			background: #2797d3 url('https://www.interactius.com/wp-content/uploads/2017/09/folder.png') no-repeat center;
		}
	</style>
	<script type="text/javascript">
		function trat_previo(sel) {
			if (sel.value == "Otro") {
				divC = document.getElementById("otro_tratamiento");
				divC.style.display = "";
			}
			if (sel.value != "Otro") {
				divC = document.getElementById("otro_tratamiento");
				divC.style.display = "none";
			}
		}

		function trat_previo1(sel) {
			if (sel.value == "NO ENCONTRADO") {
				divC = document.getElementById("otro_asegurador");
				divC.style.display = "";
			}
			if (sel.value != "NO ENCONTRADO") {
				divC = document.getElementById("otro_asegurador");
				divC.style.display = "none";
			}
		}

		function trat_previo2(sel) {
			if (sel.value == "NO ENCONTRADO") {
				divC = document.getElementById("otro_operador");
				divC.style.display = "";
			}
			if (sel.value != "NO ENCONTRADO") {
				divC = document.getElementById("otro_operador");
				divC.style.display = "none";
			}
		}

		function trat_previo3(sel) {
			if (sel.value == "NO ENCONTRADO") {
				divC = document.getElementById("otro_ips");
				divC.style.display = "";
			}
			if (sel.value != "NO ENCONTRADO") {
				divC = document.getElementById("otro_ips");
				divC.style.display = "none";
			}
		}

		function trat_previo4(sel) {
			if (sel.value == "NO ENCONTRADO") {
				divC = document.getElementById("otro_medico_t");
				divC.style.display = "";
			}
			if (sel.value != "NO ENCONTRADO") {
				divC = document.getElementById("otro_medico_t");
				divC.style.display = "none";
			}
		}

		function trat_previo5(sel) {
			if (sel.value == "NO ENCONTRADO") {
				divC = document.getElementById("otro_medico_p");
				divC.style.display = "";
			}
			if (sel.value != "NO ENCONTRADO") {
				divC = document.getElementById("otro_medico_p");
				divC.style.display = "none";
			}
		}

		function trat_previo6(sel) {
			if (sel.value == "NO ENCONTRADO") {
				divC = document.getElementById("otro_punto");
				divC.style.display = "";
			}
			if (sel.value != "NO ENCONTRADO") {
				divC = document.getElementById("otro_punto");
				divC.style.display = "none";
			}
		}
	</script>
	<script type="text/javascript">
		function status() {
			var REFERENCIA = $('#MEDICAMENTO').val();
			var STATUS = $('#status_paciente').val();
			$.ajax({
				url: '../presentacion/listado_producto_status_cargar.php',
				data: {
					REFERENCIA: REFERENCIA,
					STATUS: STATUS
				},
				type: 'post',
				beforeSend: function() {
					$("#status_paciente").attr('disabled', 'disabled');
				},
				success: function(data) {
					$("#status_paciente").removeAttr('disabled');
					$('#status_paciente').html(data);
				}
			})
		}

		function mostrar_ciudades() {
			var departamento = $('#departamento').val();
			$("#ciudad").html('<img src="imgagenes/cargando.gif" />');
			$.ajax({
				url: '../presentacion/ciudades.php',
				data: {
					dep: departamento,
				},
				type: 'post',
				beforeSend: function() {
					$("#ciudad").html("Procesando, espere por favor" + '<img src="img/cargando.gif" />');
				},
				success: function(data) {
					$('#ciudad').html(data);
				}
			})
		}

		function mostrar_producto() {
			var ID_PRODUCTO = $('#tipo_envio').val();
			$.ajax({
				url: '../presentacion/mostrar_nombre_producto.php',
				data: {
					ID_PRODUCTO: ID_PRODUCTO,
				},
				type: 'post',
				beforeSend: function() {
					$('#div_agregar').css('visibility', 'hidden');
				},
				success: function(data) {
					$('#nombre_producto').html(data);
					var nom = $('#nombre_producto').val();
					if (nom == 'Kit de bienvenida' || nom == '') {
						$('#div_agregar').css('visibility', 'hidden');
					} else {
						$('#div_agregar').css('visibility', 'visible');
					}
				}
			})
		}

		function agregar_producto() {
			var ID_PRODUCTO = $('#tipo_envio').val();
			var ID_PACIENTE = $('#codigo_usuario2').val();
			var NOMBRE_PRODUCTO = $('#nombre_producto').val();
			$.ajax({
				url: '../presentacion/ingresar_productos_temporal.php',
				data: {
					ID_PRODUCTO: ID_PRODUCTO,
					ID_PACIENTE: ID_PACIENTE,
					NOMBRE_PRODUCTO: NOMBRE_PRODUCTO
				},
				type: 'post',
				beforeSend: function() {
					$('#tabla_material_agregar').css('visibility', 'visible');
					$("#tabla_material_agregar").html("Procesando, espere por favor" + '<img src="imagenes/cargando.gif" />');
				},
				success: function(data) {
					$('#tabla_material_agregar').html(data);
				}
			})
		}

		function asegurador() {
			var DEPT = $('#departamento').val();
			$.ajax({
				url: '../presentacion/listado_asegurador.php',
				data: {
					DEPT: DEPT
				},
				type: 'post',
				beforeSend: function() {
					$("#asegurador").attr('disabled', 'disabled');
					$('#operador_logistico').html('');
					$("#operador_logistico").attr('disabled', 'disabled');
				},
				success: function(data) {
					$("#asegurador").removeAttr('disabled');
					$('#asegurador').html(data);
				}
			})
		}

		function operador() {
			var DEPT = $('#departamento').val();
			var asegurador = $('#asegurador').val();
			$.ajax({
				url: '../presentacion/listado_operador_logistico.php',
				data: {
					DEPT: DEPT,
					asegurador: asegurador
				},
				type: 'post',
				beforeSend: function() {
					$("#operador_logistico").attr('disabled', 'disabled');
				},
				success: function(data) {
					$("#operador_logistico").removeAttr('disabled');
					$('#operador_logistico').html(data);
				}
			})
		}
	</script>
	<script>
		$(document).ready(function() {
			$("#aplicaicones").change(function() {
				var aplicaicones = $('#aplicaicones').val();
				if (aplicaicones == "SI") {
					$("#ver_aplicaciones").css('visibility', 'visible');
				} else {
					$("#ver_aplicaciones").css('visibility', 'hidden');
				}
			});
			$("#brindo_apoyo").change(function() {
				var brindo_apoyo = $('#brindo_apoyo').val();
				if (brindo_apoyo == "SI") {
					$("#ver_apoyo").css('visibility', 'visible');
				} else {
					$("#ver_apoyo").css('visibility', 'hidden');
				}
			});
			$("input[name=evento_adverso]").change(function() {
				$("input[name=tipo_evento_adverso]").prop("checked", false);
				$('#tipo_evento_adverso').prop("checked", true);
				var evento_adverso = $('#evento_adverso:checked').val();
				if (evento_adverso == 'SI') {
					$('#envio_evento_adverso_span').css('display', 'inline');
					$('#envio_evento_adverso_div').css('display', 'inline');
				}
				if (evento_adverso != 'SI') {
					$('#envio_evento_adverso_span').css('display', 'none');
					$('#envio_evento_adverso_div').css('display', 'none');
				}
			});
			$("#medico").change(function() {
				$("#medico_nuevo").val('');
				var medico = $('#medico').val();
				if (medico == 'Otro') {
					$('#medico_nuevo').css('display', 'inline-block');
					$('#cual_medico').css('display', 'inline-block');
				}
				if (medico != 'Otro') {
					$('#medico_nuevo').css('display', 'none');
					$('#cual_medico').css('display', 'none');
				}
			});

			function producto_Ver() {
				producto_tratamiento = $("#MEDICAMENTO").val();
				$("#numero_tabletas_diarias").val('0');
				if (producto_tratamiento == 'ADEMPAS') {
					$('#span_tabletas_diarias').css('display', 'inline-block');
					$('#div_tabletas_diarias').css('display', 'inline-block');
					$('#div_apoyo').css('display', 'inline-block');
					$('#span_apoyo').css('display', 'inline-block');
					$('#div_aplicaciones').css('display', 'none');
					$('#span_aplicacion').css('display', 'none');
				}
				if (producto_tratamiento != 'ADEMPAS') {
					if (producto_tratamiento == 'Eylia 2MG VL 1x2ML CO INST') {
						$('#div_aplicaciones').css('display', 'block');
						$('#span_aplicacion').css('display', 'block');
					} else {
						$('#div_aplicaciones').css('display', 'none');
						$('#span_aplicacion').css('display', 'none');
					}
					$('#span_tabletas_diarias').css('display', 'none');
					$('#div_tabletas_diarias').css('display', 'none');
					$('#div_apoyo').css('display', 'none');
					$('#span_apoyo').css('display', 'none');
				}
			}
			producto_Ver()

			function mostrar_nebu() {
				$("#nebulizaciones").val('');
				var MEDICAMENTO = $('#MEDICAMENTO').val();
				if (MEDICAMENTO == 'VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM') {
					$('#span_nebulizaciones').css('display', 'inline-block');
					$('#div_nebulizaciones').css('display', 'inline-block');
				}
				if (MEDICAMENTO != 'VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM') {
					$('#span_nebulizaciones').css('display', 'none');
					$('#div_nebulizaciones').css('display', 'none');
				}
			}
			mostrar_nebu();
			$('#cambio').click(function() {
				$('#cambio_direccion').toggle();
				$('#DIRECCION').val('');
				$("#VIA option:eq(0)").attr("selected", "selected");
				$("#interior option:eq(0)").attr("selected", "selected");
				$("#interior2 option:eq(0)").attr("selected", "selected");
				$("#interior3 option:eq(0)").attr("selected", "selected");
				$("#TERAPIA option:eq(0)").attr("selected", "selected");
				$('#detalle_via').val('');
				$('#detalle_int').val('');
				$('#detalle_int2').val('');
				$('#detalle_int3').val('');
				$('#numero').val('');
				$('#numero2').val('');
			});
			var via = $('#VIA').val();
			var dt_via = $('#detalle_via').val();
			$('#VIA').change(function() {
				dir();
			});
			$('#detalle_via').change(function() {
				dir();
			});
			$('#numero').change(function() {
				dir();
			});
			$('#numero2').change(function() {
				dir();
			});
			$('#interior').change(function() {
				dir();
			});
			$('#detalle_int').change(function() {
				dir();
			});
			$('#interior2').change(function() {
				dir();
			});
			$('#detalle_int2').change(function() {
				dir();
			});
			$('#interior3').change(function() {
				dir();
			});
			$('#detalle_int3').change(function() {
				dir();
			});
		});

		function paap() {
			$('#paap option:first-child').attr("selected", "selected");
			$('#paap')[0].selectedIndex = 0;
			$('#sub_paap option:first-child').attr("selected", "selected");
			$('#sub_paap')[0].selectedIndex = 0;
			$('#sub_barrera option:first-child').attr("selected", "selected");
			$('#sub_barrera')[0].selectedIndex = 0;
			producto = $('#MEDICAMENTO').val();
			$("#span_sub_paap").css('display', 'none');
			$("#div_sub_paap").css('display', 'none');
			$("#div_barrera").css('display', 'none');
			$("#paap").removeProp('required');
		}
		$(document).ready(function() {
			$("#span_sub_paap").css('display', 'none');
			$("#div_sub_paap").css('display', 'none');
			$("#div_barrera").css('display', 'none');
			status();
			paap();
			$("#sub_paap").change(function() {
				$('#sub_barrera option:first-child').attr("selected", "selected");
				$('#sub_barrera')[0].selectedIndex = 0;
				var sub_paap = $('#sub_paap').val();
				if (sub_paap == "Con barrera") {
					$("#div_barrera").css('display', 'block');
				} else {
					$("#div_barrera").css('display', 'none');
				}
			});
			$("#paap").change(function() {
				$('#sub_paap option:first-child').attr("selected", "selected");
				$('#sub_paap')[0].selectedIndex = 0;
				$('#sub_barrera option:first-child').attr("selected", "selected");
				$('#sub_barrera')[0].selectedIndex = 0;
				$("#div_barrera").css('display', 'none');
				var paap = $('#paap').val();
				if (paap == "SI") {
					$("#div_sub_paap").css('display', 'block');
					$("#span_sub_paap").css('display', 'block');
				} else {
					$("#div_sub_paap").css('display', 'none');
					$("#span_sub_paap").css('display', 'none');
				}
			});
			var fecha = $('input[name=fecha_nacimiento]').val();
			if (fecha != '') {
				var edad = nacio(fecha);
				$("#edad").val(edad);
			}
			$("input[name=fecha_nacimiento]").change(function() {
				var fecha = $('input[name=fecha_nacimiento]').val();
				var edad = nacio(fecha);
				$("#edad").val(edad);
			});

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
					$('#fecha_no_reclamacion').css('display', 'none');
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
					$("#consecutivo_betaferon_span").css('display', 'none');
					$('#consecutivo_betaferon').css('display', 'none');
					$('#numero_cajas option:eq(0)').attr('selected', 'selected');
					$('#tipo_numero_cajas option:eq(0)').attr('selected', 'selected');
					$('#causa_no_reclamacion option:eq(20)').attr('selected', 'selected');
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
						$("#causa").css('display', 'none');
						$('#causa_no_reclamacion').css('display', 'none');
						$('#fecha_no_reclamacion').css('display', 'none');
						$('#numero_cajas').removeAttr('disabled');
						$('#tipo_numero_cajas').removeAttr('disabled');
						$("#fecha_reclamacion").val($('#fecha_reclamacion').prop('defaultValue'));
						$("#numero_tabletas_diarias").val('0');
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

			function BrindoEducacion() {
				var brindo_educacion = $('#brindo_educacion').val();
				if (brindo_educacion == 'SI') {
					$('#TemaSiEdu').css('display', 'block');
					$('#FechaSiEdu').css('display', 'block');
					$('#motivo_no').css('display', 'none');
				}
				if (brindo_educacion == 'NO') {
					$('#TemaSiEdu').css('display', 'none');
					$('#FechaSiEdu').css('display', 'none');
					$('#motivo_no').css('display', 'block');
				}
			}
			reclamo();
			$("#reclamo").change(function() {
				reclamo();
			});
			$("#brindo_educacion").change(function() {
				BrindoEducacion();
			});
			$("#departamento").change(function() {
				asegurador();
			});
			$("#asegurador").change(function() {
				operador();
			});
			$("#operador_logistico").change(function() {
				$("#operador_logistico_nuevo").val('');
				var operador_logistico = $('#operador_logistico').val();
				if (operador_logistico == 'Otro') {
					$('#operador_logistico_nuevo').css('display', 'inline-block');
					$('#cual_operador').css('display', 'inline-block');
				}
				if (operador_logistico != 'Otro') {
					$('#operador_logistico_nuevo').css('display', 'none');
					$('#cual_operador').css('display', 'none');
				}
			});
			$("#tipo_envio").change(function() {
				mostrar_producto();
			});
			$("#agregar_seg").click(function() {
				$('#div_material_agregar').css('display', 'block');
				$('#div_agregar').css('visibility', 'hidden');
			});
			$("input[name=logro_comunicacion]").change(function() {
				var LOGRO_COMUNICACION = $('input:radio[name=logro_comunicacion]:checked').val();
				$('#motivo_comunicacion option:eq(0)').attr('selected', 'selected');
				$('#motivo_no_comunicacion option:eq(0)').attr('selected', 'selected');
				if (LOGRO_COMUNICACION == 'SI') {
					$('#motivo_no_comunicacion').attr("disabled", "disabled");
					$('#motivo_comunicacion').removeAttr("disabled", "disabled");
				}
				if (LOGRO_COMUNICACION == 'NO') {
					$('#motivo_comunicacion').attr("disabled", "disabled");
					$('#motivo_no_comunicacion').removeAttr("disabled", "disabled");
				}
			});
			$("#agregar_seg").click(function() {
				$('#div_material_agregar').css('display', 'block');
				$('#div_agregar').css('visibility', 'hidden');
			});
			$('#causa_no_reclamacion').change(function() {
				var CAUSA_NO_RECLAMACION = $('#causa_no_reclamacion').val();
				$('#asignado').val('');
				if (CAUSA_NO_RECLAMACION == 'Cita inoportuna' || CAUSA_NO_RECLAMACION == 'Demora en la Autorizacion Cita Medica' || CAUSA_NO_RECLAMACION == 'Demora en la autorizacion de medicamento' || CAUSA_NO_RECLAMACION == 'Error en papeleria' || CAUSA_NO_RECLAMACION == 'Falta cita para examenes' || CAUSA_NO_RECLAMACION == 'Falta de cita aplicacion' || CAUSA_NO_RECLAMACION == 'Falta de cita medica' || CAUSA_NO_RECLAMACION == 'Falta de cita valoracion (Xofigo)' || CAUSA_NO_RECLAMACION == 'Falta de medicamento en el punto' || CAUSA_NO_RECLAMACION == 'No remision a entidad licenciada' || CAUSA_NO_RECLAMACION == 'Pago anticipado' || CAUSA_NO_RECLAMACION == 'Pendiente formulacion NO sistema' || CAUSA_NO_RECLAMACION == 'PSVC en Titulacion' || CAUSA_NO_RECLAMACION == 'Sin red Prestadora') {
					$('#asignado').css('display', 'block');
					$('#solicitud_cambio_proveedor_psp').css('display', 'block');
					$('#solicitud_cambio_proveedor_people').css('display', 'none');
					$('#solo_psp').css('display', 'none');
					$('#confirmar_P_select').css('display', 'none');
				} else {
					$('#asignado').css('display', 'block');
					$('#solicitud_cambio_proveedor_psp').css('display', 'none');
					$('#solicitud_cambio_proveedor_people').css('display', 'block');
					$('#solo_psp').css('display', 'block');
					$('#confirmar_P_select').css('display', 'block');
				}
			});

			$('#reclamo').change(function() {
				var RECLAMO = $('#reclamo').val();
				$('#cambio_estado_activo_solicitar').val('');
				if (RECLAMO == 'SI') {
					$('#cambio_estado_activo_solicitar').css('display', 'block');
					$('#estado_activo').css('display', 'block');
					$('#asignado').css('display', 'block');
					$('#solicitud_cambio_proveedor_people').css('display', 'block');
					$('#solicitud_cambio_proveedor_psp').css('display', 'none');
					$('#solo_psp').css('display', 'block');
					$('#confirmar_P_select').css('display', 'block');
					$('#cambio_estado_abandono_solicitar').css('display', 'none');
					$('#estado_abandono').css('display', 'none');
					$('#cambio_estado_suspendido_solicitar').css('display', 'none');
					$('#estado_suspendido').css('display', 'none');
					$('#cambio_estado_interrumpido_solicitar').css('display', 'none');
					$('#estado_interrumpido').css('display', 'none');
				} else {
					$('#cambio_estado_activo_solicitar').css('display', 'none');
					$('#estado_activo').css('display', 'none');
					$('#asignado').css('display', 'none');
					$('#solicitud_cambio_proveedor_people').css('display', 'none');
					$('#solo_psp').css('display', 'none');
				}
			});

			$('#causa_no_reclamacion').change(function() {
				var CAUSA_NO_RECLAMACION = $('#causa_no_reclamacion').val();
				$('#cambio_estado_abandono_solicitar').val('');
				if (CAUSA_NO_RECLAMACION == 'Abandono') {
					$('#cambio_estado_abandono_solicitar').css('display', 'block');
					$('#estado_abandono').css('display', 'block');
				} else {
					$('#cambio_estado_abandono_solicitar').css('display', 'none');
					$('#estado_abandono').css('display', 'none');
				}
			});

			$('#causa_no_reclamacion').change(function() {
				var CAUSA_NO_RECLAMACION = $('#causa_no_reclamacion').val();
				$('#cambio_estado_suspendido_solicitar').val('');
				if (CAUSA_NO_RECLAMACION == 'En proceso de Examenes' || CAUSA_NO_RECLAMACION == 'Falta cita para examenes' || CAUSA_NO_RECLAMACION == 'Hospitalizado' || CAUSA_NO_RECLAMACION == 'Suspendido por esquema de aplicacion' || CAUSA_NO_RECLAMACION == 'Suspendido temporalmente') {
					$('#cambio_estado_suspendido_solicitar').css('display', 'block');
					$('#estado_suspendido').css('display', 'block');
				} else {
					$('#cambio_estado_suspendido_solicitar').css('display', 'none');
					$('#estado_suspendido').css('display', 'none');
				}
			});

			$('#causa_no_reclamacion').change(function() {
				var CAUSA_NO_RECLAMACION = $('#causa_no_reclamacion').val();
				$('#cambio_estado_interrumpido_solicitar').val('');
				if (CAUSA_NO_RECLAMACION == 'Autorizacion radicada para Cita' || CAUSA_NO_RECLAMACION == 'Autorizacion radicada para Medicamento' || CAUSA_NO_RECLAMACION == 'Cita inoportuna' || CAUSA_NO_RECLAMACION == 'Demora en la Autorizacion Cita Medica' || CAUSA_NO_RECLAMACION == 'Demora en la autorizacion de medicamento' || CAUSA_NO_RECLAMACION == 'Desafiliacion Asegurador' || CAUSA_NO_RECLAMACION == 'En proceso de cita Aplicacion' || CAUSA_NO_RECLAMACION == 'En proceso de cita medica' || CAUSA_NO_RECLAMACION == 'En proceso de entrega' || CAUSA_NO_RECLAMACION == 'Error en papeleria' || CAUSA_NO_RECLAMACION == 'Falta de cita aplicacion' || CAUSA_NO_RECLAMACION == 'Falta de cita medica' || CAUSA_NO_RECLAMACION == 'Falta de cita valoracion (Xofigo)' || CAUSA_NO_RECLAMACION == 'Falta de contacto' || CAUSA_NO_RECLAMACION == 'Falta de medicamento en el punto' || CAUSA_NO_RECLAMACION == 'No remision a entidad licenciada' || CAUSA_NO_RECLAMACION == 'Pago anticipado' || CAUSA_NO_RECLAMACION == 'Pendiente formulacion NO sistema' || CAUSA_NO_RECLAMACION == 'Pendiente Radicar Formula en Farmacia' || CAUSA_NO_RECLAMACION == 'PSVC en Titulacion' || CAUSA_NO_RECLAMACION == 'Sin red Prestadora' || CAUSA_NO_RECLAMACION == 'Voluntario') {
					$('#cambio_estado_interrumpido_solicitar').css('display', 'block');
					$('#estado_interrumpido').css('display', 'block');
				} else {
					$('#cambio_estado_interrumpido_solicitar').css('display', 'none');
					$('#estado_interrumpido').css('display', 'none');
				}
			});
		});
	</script>
	<script>
		$(window).load(function() {
			$('#switch-label').click(function() {
				if ($(this).is(":checked")) {
					$("#brindo_educacion").attr('disabled', false);
					$('#TemaBrindoEdu').attr('disabled', false);
					$('#FechaEduca').attr('disabled', false);
					$('#MotivoNoEdu').attr('disabled', false);
				} else if ($(this).is(":not(:checked)")) {
					$("#brindo_educacion").attr('disabled', true);
					$('#TemaBrindoEdu').attr('disabled', true);
					$('#FechaEduca').attr('disabled', true);
					$('#MotivoNoEdu').attr('disabled', true);
				}
			});
		});
	</script>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$ID_PACIENTE = base64_decode($artid);
$ID_GESTION = base64_decode($artge);
include('../logica/consulta_paciente.php');
$DIAS_ANTES = date('Y-m-d', strtotime('-31 day'));
if ($privilegios != '' && $usua != '') {
?>

	<body class="body" style="width:100%">
		<form id="seguimiento" name="seguimiento" method="post" action="../logica/actualizar_seguimiento.php" onkeydown="return filtro(2)" enctype="multipart/form-data" class="letra">
			<div id="Accordion1" class="Accordion" tabindex="0" style="height:100%;">
				<div class="AccordionPanel">
					<div class="AccordionPanelTab">PACIENTE</div>
					<div class="AccordionPanelContent">
						<table width="100%" border="0">
							<?php
							$Seleccion = mysqli_query($conex, "SELECT * FROM `ipsen_pacientes` AS P
							INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
							WHERE ID_PACIENTE = '" . $ID_PACIENTE . "'");
							while ($fila = mysqli_fetch_array($Seleccion)) {
								$ID_PACIENTE2 = $fila['ID_PACIENTE'];
								$ID_PA = $fila['ID_PACIENTE'];
								$NOMBRE_REFERENCIA = $fila['NOMBRE_REFERENCIA'];
								$producto_tratamiento = $fila['PRODUCTO_TRATAMIENTO'];
								$STATUS_PACIENTE = $fila['STATUS_PACIENTE'];
								$PROVEEDOR = $fila['PROVEEDOR'];
								$PRODUCTO_TRATAMIENTO = $fila['PRODUCTO_TRATAMIENTO'];
								$DOSIS = $fila['DOSIS_TRATAMIENTO'];
								$TRATAMIENTO_PREVIOS = $fila['TRATAMIENTO_PREVIO'];
								function Zeros($numero, $largo)
								{
									$resultado = $numero;
									while (strlen($resultado) < $largo) {
										$resultado = "0" . $resultado;
									}
									return $resultado;
								}
								$ID_PACIENTE = Zeros($ID_PA, 5);
							?>
								<input type="text" style="display:none;" name="nombre_referencia" id="nombre_referencia" value="<?php echo $NOMBRE_REFERENCIA; ?>" readonly="readonly" />
								<tr>
									<td width="20%">
										<span>Codigo de Usuario</span>
										<?php
										if ($fila['PRODUCTO_TRATAMIENTO'] == 'Xofigo 1x6 ml CO') {
										?>
											<br />
											<span>Codigo Xofigo</span>
										<?php
										}
										?>
									</td>
									<td width="30%">
										<input name="codigo_gestion" type="text" id="codigo_gestion" max="10" readonly="readonly" value="<?php echo $ID_GESTION; ?>" style="display:none" />
										<input name="codigo_usuario" type="text" id="codigo_usuario" max="10" readonly="readonly" value="<?php echo 'PAP' . $ID_PACIENTE; ?>" />
										<?php
										if ($fila['PRODUCTO_TRATAMIENTO'] == 'Xofigo 1x6 ml CO') {
										?>
											<br />
											<input name="codigo_xofigo" type="text" id="codigo_xofigo" max="10" readonly="readonly" value="<?php echo 'X' . $fila['CODIGO_XOFIGO']; ?>" />
										<?php
										}
										?>
										<input name="codigo_usuario2" type="text" id="codigo_usuario2" max="10" readonly="readonly" value="<?php echo $fila['ID_PACIENTE']; ?>" style="display:none" />
									</td>
									<td width="20%">
										<span>Estado del Paciente<span class="asterisco">*</span></span>
									</td>
									<td width="30%">
										<?php
										if ($privilegios == 1) {
										?>
											<select type="text" name="estado_paciente" id="estado_paciente">
												<option><?php echo $fila['ESTADO_PACIENTE']; ?></option>
												<option>Seleccione...</option>
												<option>Abandono</option>
												<option>Activo</option>
												<option>En servicio</option>
												<option>Fase 2</option>
												<option>Interrumpido</option>
												<option>Proceso</option>
												<option>Suspendido</option>
											</select>
										<?php
										} else {
										?>
											<input name="estado_paciente" type="text" id="estado_paciente" readonly="readonly" value="<?php echo $fila['ESTADO_PACIENTE']; ?>" />
										<?php
										}
										?>
									</td>
								</tr>
								<tr>
									<td width="20%">
										<span>Fecha de Activacion<span class="asterisco">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									</td>
									<td width="30%">
										<input type="date" name="fecha_activacion" id="fecha_activacion" value="<?php echo $fila['FECHA_ACTIVACION_PACIENTE']; ?>" readonly="readonly" />
									</td>
									<td>
										<span>Asignado para</span>
									</td>
									<td>
										<input type="text" value="<?php echo $fila['PROVEEDOR'] ?>" readonly>
									</td>
								</tr>
								<tr>
									<td width="20%">
										<span>Fecha de Retiro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									</td>
									<td width="30%">
										<input type="date" name="fecha_retiro" id="fecha_retiro" max="10" value="<?php echo $fila['FECHA_RETIRO_PACIENTE']; ?>" />
									</td>
									<td width="20%">
										<span>Motivo de Retiro</span>
									</td>
									<td>
										<select type="text" name="motivo_retiro" id="motivo_retiro">
											<option><?php echo $fila['MOTIVO_RETIRO_PACIENTE']; ?></option>
											<option>Seleccione...</option>
											<option>Cambio de tratamiento</option>
											<option>Embarazo</option>
											<option>Evento adverso</option>
											<option>Falta de contacto</option>
											<option>Fuera del pais</option>
											<option>Muerte</option>
											<option>No interesado</option>
											<option>Off label</option>
											<option>Orden medica</option>
											<option>Otro</option>
											<option>Progresion de da enfermedad</option>
											<option>Terminacion del tratamiento</option>
											<option>Voluntario</option>
											<option value="">NO APLICA</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<span>Observaciones Motivo de Retiro</span>
									</td>
									<td colspan="3">
										<textarea name="observacion_retiro" id="observacion_retiro" style="width:98%; height:100px"><?php echo $fila['OBSERVACION_MOTIVO_RETIRO_PACIENTE']; ?></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<span>Nombre<span class="asterisco">*</span></span>
									</td>
									<td>
										<input type="text" name="nombre" id="nombre" value="<?php echo $fila['NOMBRE_PACIENTE']; ?>" readonly="readonly" />
									</td>
									<td>
										<span>Apellidos<span class="asterisco">*</span></span>
									</td>
									<td>
										<input type="text" name="apellidos" id="apellidos" value="<?php echo $fila['APELLIDO_PACIENTE']; ?>" readonly="readonly" />
									</td>
								</tr>
								<tr>
									<td>
										<span>Tipo de identificacion<span class="asterisco">*</span></span>
									</td>
									<td>
										<select name="tipo_identificacion" id="tipo_identificacion">
											<option><?php echo $fila['TIPO_IDENTIFICACION_PACIENTE'] ?></option>
											<option>Seleccione...</option>
											<option>R.C</option>
											<option>T.I</option>
											<option>C.C</option>
											<option>C.E</option>
											<option>P.T</option>
										</select>
									</td>
									<td>
										<span>Identificacion<span class="asterisco">*</span></span>
									</td>
									<td>
										<input type="text" name="identificacion" id="identificacion" value="<?php echo $fila['IDENTIFICACION_PACIENTE']; ?>" readonly="readonly" />
									</td>
								</tr>
								<tr>
									<td>
										<span>Telefono 1<span class="asterisco">*</span></span>
									</td>
									<td>
										<input type="number" name="telefono1" id="telefono1" value="<?php echo $fila['TELEFONO_PACIENTE']; ?>" />
									</td>
									<td>
										<span>Telefono 2</span>
									</td>
									<td>
										<input type="number" name="telefono2" id="telefono2" value="<?php echo $fila['TELEFONO2_PACIENTE']; ?>" />
									</td>
								</tr>
								<tr>
									<td>
										<span>Telefono 3</span>
									</td>
									<td>
										<input type="number" name="telefono3" id="telefono3" value="<?php echo $fila['TELEFONO3_PACIENTE']; ?>" />
									</td>
									<td>
										<span>Telefono 4</span>
									</td>
									<td>
										<input type="number" name="telefono4" id="telefono4" value="<?php echo $fila['TELEFONO4_PACIENTE']; ?>" />
									</td>
								</tr>
								<tr>
									<td>
										<span>Telefono 5</span>
									</td>
									<td>
										<input type="number" name="telefono5" id="telefono5" value="<?php echo $fila['TELEFONO5_PACIENTE']; ?>" />
									</td>
									<td>
										<span>Correo Electronico</span>
									</td>
									<td>
										<input type="text" name="correo" id="correo" value="<?php echo $fila['CORREO_PACIENTE']; ?>" />
									</td>
								</tr>
								<tr>
									<td>
										<span>Departamento<span class="asterisco">*</span></span>
									</td>
									<td>
										<select type="text" name="departamento" id="departamento" onchange="mostrar_ciudades()">
											<option><?php echo $fila['DEPARTAMENTO_PACIENTE']; ?></option>
											<option>Seleccione...</option>
											<?php
											$DEPT = $fila['DEPARTAMENTO_PACIENTE'];
											$Seleccionar = mysqli_query($conex, "SELECT nombre FROM `ipsen_departamento` WHERE nombre != '' AND nombre != '" . $DEPT . "' ORDER BY nombre ASC");
											while ($fila3 = mysqli_fetch_array($Seleccionar)) {
												$DEPARTAMENTO = $fila3['nombre'];
												echo "<option>" . $DEPARTAMENTO . "</option>";
											}
											?>
										</select>
									</td>
									<td>
										<span>Ciudad<span class="asterisco">*</span></span>
									</td>
									<td>
										<select type="text" name="ciudad" id="ciudad">
											<option><?php echo $fila['CIUDAD_PACIENTE']; ?></option>
											<option>Seleccione...</option>
											<?php
											$Selecciones = mysqli_query($conex, "SELECT c.nombre FROM ipsen_ciudad AS c
                                            INNER JOIN ipsen_departamento AS d ON d.id=c.departamento_id
                                            WHERE d.nombre='" . $DEPT . "' ORDER BY c.nombre ASC");
											while ($fila2 = mysqli_fetch_array($Selecciones)) {
												$CIUDAD = $fila2['nombre'];
												echo "<option>" . $CIUDAD . "</option>";
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<span>Barrio<span class="asterisco">*</span></span>
									</td>
									<td>
										<input type="text" name="barrio" id="barrio" value="<?php echo $fila['BARRIO_PACIENTE']; ?>" onkeypress="return check(event)" />
									</td>
									<td>
										<span>Direccion<span class="asterisco">*</span></span>
									</td>
									<td colspan="3">
										<input name="direccion_act" id="direccion_act" style="width:93%" value="<?php echo $fila['DIRECCION_PACIENTE']; ?>" readonly="readonly" />
										<img src="imagenes/lapiz 100.png" id="cambio" name="cambio" title="Editar" style="width:4%; height:20px; margin-left:-10%;" align="right" />
									</td>
								</tr>
								<tr style="padding:3%;">
									<td colspan="4" width="90%">
										<div id="cambio_direccion" style="display:none; border:#F00 1px solid;">
											<table width="99%">
												<tr style="padding:3%;">
													<td style="width:10%;">
														<span>Direccion<span class="asterisco">*</span></span>
													</td>
													<td bgcolor="#FFFFFF" colspan="3">
														<input type="text" name="DIRECCION" id="DIRECCION" readonly style="width:99.8%;" />
													</td>
												</tr>
												<tr style="padding:3%;">
													<td>
														<span>Via:</span>
													</td>
													<td style="width:35%">
														<span>
															<select id="VIA" name="VIA" style="width:96%">
																<option value="">Seleccione...</option>
																<option>ANILLO VIAL</option>
																<option>AUTOPISTA</option>
																<option>AVENIDA</option>
																<option>BOULEVAR</option>
																<option>CALLE</option>
																<option>CALLEJON</option>
																<option>CARRERA</option>
																<option>CIRCUNVALAR</option>
																<option>CONDOMINIO</option>
																<option>DIAGONAL</option>
																<option>KILOMETRO</option>
																<option>LOTE</option>
																<option>SALIDA</option>
																<option>SECTOR</option>
																<option>TRANSVERSAL</option>
																<option>VEREDA</option>
																<option>VIA</option>
															</select>
														</span>
													</td>
													<td style="width:10%;">
														<span>Detalle via:</span>
													</td>
													<td width="177" bgcolor="#FFFFFF">
														<span>
															<input name="detalle_via" id="detalle_via" type="text" maxlength="30" style="width:99%" />
														</span>
													</td>
												</tr>
												<tr>
													<td width="96">
														<span>Numero:</span>
													</td>
													<td bgcolor="#FFFFFF">
														<span>
															<input name="numero" id="numero" type="text" maxlength="5" style=" width:45%" />
															-
															<input name="numero2" id="numero2" type="text" maxlength="5" style=" width:45%" />
														</span>
													</td>
													<td></td>
													<td bgcolor="#FFFFFF"></td>
												</tr>
												<tr style="padding:3%;">
													<td>
														<span>Interior:</span>
													</td>
													<td bgcolor="#FFFFFF">
														<span>
															<select id="interior" name="interior" style="width:96%">
																<option value="">Seleccione...</option>
																<option>APARTAMENTO</option>
																<option>BARRIO</option>
																<option>BLOQUE</option>
																<option>CASA</option>
																<option>CIUDADELA</option>
																<option>CONJUNTO</option>
																<option>CONJUNTO RESIDENCIAL</option>
																<option>EDIFICIO</option>
																<option>ENTRADA</option>
																<option>ETAPA</option>
																<option>INTERIOR</option>
																<option>MANZANA</option>
																<option>NORTE</option>
																<option>OFICINA</option>
																<option>OCCIDENTE</option>
																<option>ORIENTE</option>
																<option>PENTHOUSE</option>
																<option>PISO</option>
																<option>PORTERIA</option>
																<option>SOTANO</option>
																<option>SUR</option>
																<option>TORRE</option>
															</select>
														</span>
													</td>
													<td>
														<span>Detalle Interior:</span>
													</td>
													<td bgcolor="#FFFFFF">
														<span>
															<input name="detalle_int" id="detalle_int" type="text" maxlength="30" readonly style="width:99%" />
														</span>
													</td>
												</tr>
												<tr style="padding:3%;">
													<td>
														<span>Interior:</span>
													</td>
													<td bgcolor="#FFFFFF">
														<span>
															<select id="interior2" name="interior2" style="width:96%">
																<option value="">Seleccione...</option>
																<option>APARTAMENTO</option>
																<option>BARRIO</option>
																<option>BLOQUE</option>
																<option>CASA</option>
																<option>CIUDADELA</option>
																<option>CONJUNTO</option>
																<option>CONJUNTO RESIDENCIAL</option>
																<option>EDIFICIO</option>
																<option>ENTRADA</option>
																<option>ETAPA</option>
																<option>INTERIOR</option>
																<option>MANZANA</option>
																<option>NORTE</option>
																<option>OFICINA</option>
																<option>OCCIDENTE</option>
																<option>ORIENTE</option>
																<option>PENTHOUSE</option>
																<option>PISO</option>
																<option>PORTERIA</option>
																<option>SOTANO</option>
																<option>SUR</option>
																<option>TORRE</option>
															</select>
														</span>
													</td>
													<td>
														<span>Detalle Interior:</span>
													</td>
													<td bgcolor="#FFFFFF">
														<span>
															<input name="detalle_int2" id="detalle_int2" type="text" maxlength="30" readonly style="width:99%" />
														</span>
													</td>
												</tr>
												<tr style="padding:3%;">
													<td>
														<span>Interior:</span>
													</td>
													<td bgcolor="#FFFFFF">
														<span>
															<select id="interior3" name="interior3" style="width:96%">
																<option value="">Seleccione...</option>
																<option>APARTAMENTO</option>
																<option>BARRIO</option>
																<option>BLOQUE</option>
																<option>CASA</option>
																<option>CIUDADELA</option>
																<option>CONJUNTO</option>
																<option>CONJUNTO RESIDENCIAL</option>
																<option>EDIFICIO</option>
																<option>ENTRADA</option>
																<option>ETAPA</option>
																<option>INTERIOR</option>
																<option>MANZANA</option>
																<option>NORTE</option>
																<option>OFICINA</option>
																<option>OCCIDENTE</option>
																<option>ORIENTE</option>
																<option>PENTHOUSE</option>
																<option>PISO</option>
																<option>PORTERIA</option>
																<option>SOTANO</option>
																<option>SUR</option>
																<option>TORRE</option>
															</select>
														</span>
													</td>
													<td>
														<span>Detalle Interior:</span>
													</td>
													<td bgcolor="#FFFFFF">
														<span>
															<input name="detalle_int3" id="detalle_int3" type="text" maxlength="30" style="width:99%" readonly />
														</span>
													</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
								<tr>
									<td width="20%">
										<span>Fecha de Nacimiento<span class="asterisco">*</span></span>
									</td>
									<td width="30%">
										<input type="date" name="fecha_nacimiento" id="fecha_nacimiento" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $fila['FECHA_NACIMINETO_PACIENTE']; ?>" />
									</td>
									<td>
										<span>Edad</span>
									</td>
									<td>
										<input type="text" name="edad" id="edad" readonly="readonly" />
									</td>
								</tr>
								<tr>
									<td>
										<span>Acudiente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									</td>
									<td>
										<input type="text" name="acudiente" id="acudiente" readonly="readonly" value="<?php echo $fila['ACUDIENTE_PACIENTE'] ?>" />
									</td>
									<td>
										<span>Telefono del Acudiente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									</td>
									<td>
										<input type="text" name="telefono_acudiente1" id="telefono_acudiente1" value="<?php echo $fila['TELEFONO_ACUDIENTE_PACIENTE'] ?>" readonly="readonly" />
									</td>
								</tr>
								<tr>
									<td>
										<span>Clasificacion Patologica<span class="asterisco">*</span></span>
									</td>
									<td>
										<span style="width:30%;">
											<input type="text" name="clasificacion_patologicas" id="clasificacion_patologicas" value="<?php echo $fila['CLASIFICACION_PATOLOGICA_TRATAMIENTO'] ?>" readonly="readonly">
										</span>
									</td>
									<td>
										<span>Fecha Inicio Terapia<span class="asterisco">*</span></span>
									</td>
									<td>
										<input type="date" name="fecha_ini_terapia" id="fecha_ini_terapia" value="<?php echo $fila['FECHA_INICIO_TERAPIA_TRATAMIENTO'] ?>" />
									</td>
								</tr>
								<tr>
									<td colspan="1">
										<input type="button" name="historico" id="historico" title="Historico reclamacion" style="width:100%; height:50px" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_historico_reclamacion.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')" />
									</td>
									<?php if ($producto_tratamiento == "ADEMPAS") {  ?>
										<td>
											<input type="button" name="pedidos" id="pedidos" title="Mis Pedidos" style="width:100%; height:50px" value="Mis Pedidos" onclick="javascript:ventanaSecundaria('form_productos_paciente.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')" />
										</td>
										<td>
											<input type="button" name="pedidos" id="pedidos" title="Muestras Medicas" style="width:100%; height:50px" value="Muestras Medicas" onclick="javascript:ventanaSecundaria('lista_envios_muestra.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')" />
										</td>
									<?php } else { ?>
										<td colspan="1">
											<input type="button" name="pedidos" id="pedidos" title="Mis Pedidos" style="width:100%; height:50px" value="Mis Pedidos" onclick="javascript:ventanaSecundaria('form_productos_paciente.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')" />
										</td>
									<?php } ?>
								</tr>
						</table>
					</div>
				</div>
				<div class="AccordionPanel">
					<div class="AccordionPanelTab">GENERAL</div>
					<div class="AccordionPanelContent">
						<br />
						<table width="100%">
							<?php
								$fecha_actual = date('Y-m-d');
								$fecha_rec_act = explode("-", $fecha_actual);
								$anio_act = $fecha_rec_act[0];
								$mes_act = $fecha_rec_act[1];
								$dia_act = $fecha_rec_act[2];
								$dato = ((int)$mes_act);
								$ID = $fila['ID_PACIENTE'];
								$select_historial_pri = mysqli_query($conex, "SELECT * FROM ipsen_historial_reclamacion WHERE ID_PACIENTE_FK='" . $ID . "'");
								echo mysqli_error($conex);
								$reg_hist = mysqli_num_rows($select_historial_pri);
								if ($reg_hist > 0) {
									$select_historial = mysqli_query($conex, "SELECT MES$dato as 'MES',RECLAMO$dato as 'RECLAMO',FECHA_RECLAMACION$dato as 'FECHA_RECLAMACION',MOTIVO_NO_RECLAMACION$dato as 'MOTIVO_NO_RECLAMACION' FROM ipsen_historial_reclamacion WHERE ID_PACIENTE_FK='" . $ID . "' AND MES$dato='" . $mes_act . "'");
									echo mysqli_error($conex);
									while ($inf = mysqli_fetch_array($select_historial)) {
										$reclamo = $inf['RECLAMO'];
										$MES = $inf['MES'];
										$MOTIVO_NO_RECLAMACION = $inf['MOTIVO_NO_RECLAMACION'];
										$FECHA_RECLAMACION = $con['FECHA_RECLAMACION'];
									}
								} else {
									$INSERT_HISTORIAL = mysqli_query($conex, "INSERT INTO ipsen_historial_reclamacion(ID_PACIENTE_FK) VALUES('" . $fila['ID_PACIENTE'] . "')");
									echo mysqli_error($conex);
								}
								$Sel = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' ORDER BY ID_GESTION DESC LIMIT 1");
								while ($con = mysqli_fetch_array($Sel)) {
									$ID_GESTION_ULT = $con['ID_GESTION'];
									$FECHA_NO_RECLAMACION = $con['FECHA_CITA_PROGRAMADA'];
									$RECLAMO_GESTION = $con['RECLAMO_GESTION'];
									$CAUSA_NO_RECLAMACION_GESTION = $con['CAUSA_NO_RECLAMACION_GESTION'];
									$FECHA_MEDICAMENTO_HASTA = $con['FECHA_MEDICAMENTO_HASTA'];
									$FECHA_RECLAMACIONN = $con['FECHA_RECLAMACION_GESTION'];
									$FECHA_AUTORIZACION = $con['FECHA_AUTORIZACION'];
								}
							?>
							<tr>
								<td>
									<span>Reclamo<span class="asterisco">*</span></span>
								</td>
								<td>
									<select type="text" name="reclamo" id="reclamo">
										<option><?php echo $RECLAMO_GESTION ?></option>
										<option>Seleccione...</option>
										<?php
										if ($RECLAMO_GESTION == 'NO' || $RECLAMO_GESTION == 'SI' || $RECLAMO_GESTION == '') {
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
									<span style=" display:none" id="fecha_reclamacion_span">Fecha de Reclamacion<span class="asterisco">*</span></span>
								</td>
								<td>
									<select type="text" name="causa_no_reclamacion" id="causa_no_reclamacion" style=" display:none">
										<option><?php echo $MOTIVO_NO_RECLAMACION ?></option>
										<option value="">Seleccione...</option>
										<option>Abandono</option>
										<option>Autorizacion radicada para Cita</option>
										<option>Autorizacion radicada para Medicamento</option>
										<option>Cita inoportuna</option>
										<option>Demora en la Autorizacion Cita Medica</option>
										<option>Demora en la autorizacion de medicamento</option>
										<option>Desafiliacion Asegurador</option>
										<option>En proceso de cita Aplicacion</option>
										<option>En proceso de cita medica</option>
										<option>En proceso de entrega</option>
										<option>En proceso de Examenes</option>
										<option>Error en papeleria</option>
										<option>Falta cita para examenes</option>
										<option>Falta de cita aplicacion</option>
										<option>Falta de cita medica</option>
										<option>Falta de cita valoracion (Xofigo)</option>
										<option>Falta de contacto</option>
										<option>Falta de medicamento en el punto</option>
										<option>Hospitalizado</option>
										<option>No remision a entidad licenciada</option>
										<option>Pago anticipado</option>
										<option>Pendiente formulacion NO sistema</option>
										<option>Pendiente Radicar Formula en Farmacia</option>
										<option>PSVC en Titulacion</option>
										<option>Sin red Prestadora</option>
										<option>Suspendido por esquema de aplicacion</option>
										<option>Suspendido temporalmente</option>
										<option>Voluntario</option>
									</select>
									<input type="date" name="fecha_reclamacion" id="fecha_reclamacion" style=" display:none" max="<?php echo date('Y-m-d'); ?>" min="<?php echo $DIAS_ANTES ?>" value="<?php echo $FECHA_RECLAMACIONN ?>" />
								</td>
							<tr>
								<td>
									<span id="">Fecha Cita Programada<span class="asterisco">*</span></span>
								</td>
								<td>
									<input type="date" value="<?php echo $FECHA_NO_RECLAMACION ?>" name="fecha_cita_programada" id="fecha_cita_programada">
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
								<td>
									<div id="asignado" style="display:none">
										<span>Asignado para</span>
									</div>
								</td>
								<td>
									<div id="solicitud_cambio_proveedor_people" style="display:none">
										<input type="text" name="proveedor_people" id="proveedor_people" value='People Marketing' readonly>
									</div>
									<div id="solicitud_cambio_proveedor_psp" style="display:none">
										<input type="text" name="proveedor_psp" id="proveedor_psp" value='People Marketing' readonly>
									</div>
								</td>
								<td>
									<span id="cambio_estado_activo_solicitar" style="display:none;">Solicitar cambio de estado Paciente</span>
									<span id="cambio_estado_abandono_solicitar" style="display:none;">Solicitar cambio de estado Paciente</span>
									<span id="cambio_estado_suspendido_solicitar" style="display:none;">Solicitar cambio de estado Paciente</span>
									<span id="cambio_estado_interrumpido_solicitar" style="display:none;">Solicitar cambio de estado Paciente</span>
								</td>
								<td>
									<input type="text" name="estado_activo" id="estado_activo" style="display:none;" value="Activo" readonly>
									<input type="text" name="estado_abandono" id="estado_abandono" style="display:none;" value="Abandono" readonly>
									<input type="text" name="estado_suspendido" id="estado_suspendido" style="display:none;" value="Suspendido" readonly>
									<input type="text" name="estado_interrumpido" id="estado_interrumpido" style="display:none;" value="Interrumpido" readonly>
								</td>
							</tr>
							<tr>
								<td>
									<label>
										<span>Active para cambio </span>
										<div class="switch-button">
											<input type="checkbox" name="switch-button" id="switch-label" class="switch-button__checkbox">
											<label for="switch-label" class="switch-button__label"></label>
										</div>
									</label>
								</td>
								<td>
									<label>
										<span>Se brindo Educacion</span>
										<select name="brindo_educacion" id="brindo_educacion" disabled>
											<option>Seleccione...</option>
											<?php $select_edu = mysqli_query($conex, "SELECT * FROM `ipsen_educacion` WHERE `ID_PACI_FK` = '" . $ID_PACIENTE2 . "' ORDER BY `FECHA_REGISTRO` DESC LIMIT 1");
											while ($dato = mysqli_fetch_array($select_edu)) {
												$brindo_edu = $dato['SE_BRINDO_EDU'];
												$temaBrindo = $dato['TEMA_SI_EDU'];
												$fecha_brindo = $dato['FECHA_SI_EDU'];
												$motivoNo = $dato['MOTIVO_NO_EDU'];
											}
											if ($brindo_edu == 'SI') {
												echo  '<option>' . $brindo_edu . '</option>' . '<option>NO</option>';
											} elseif ($brindo_edu == 'NO') {
												echo  '<option>' . $brindo_edu . '</option>' . '<option>SI</option>';
											} else {
												$brindo_edu = 'NULL';
												$temaBrindo = 'NULL';
												$fecha_brindo = 'NULL';
												$motivoNo = 'NULL';
												echo '<option value="">Seleccione...</option>
													  <option>SI</option>
													  <option>NO</option>';
											} ?>
										</select>
									</label>
								</td>
								<td id="TemaSiEdu" <?php if ($brindo_edu == 'SI') {
														echo 'style="display: block;"';
													} elseif ($brindo_edu == 'NO') {
														echo 'style="display: none;"';
													} else {
														echo 'style="display: none;"';
													} ?>>
									<label>
										<span>Tema</span>
										<select name="TemaBrindoEdu" id="TemaBrindoEdu" disabled>
											<?php if ($brindo_edu == 'NO') {
												echo '<option value="">Seleccione...</option>';
											} elseif ($brindo_edu == 'SI') {
												echo '<option>' . $temaBrindo . '</option>';
											} else {
												echo '<option value="">Seleccione...</option>';
											} ?>
											<option>GM1 Nutricion</option>
											<option>GM2 Auto Cuidado</option>
											<option>GM3 Afrontamiento Enfermedades Cronicas</option>
											<option>GM4 Derechos y deberes en la salud de los pacientes</option>
											<option>GM5 Actitud positiva frente a la enfermedad</option>
											<option>GM6 Inteligencia emocional</option>
											<option>GM7 Barreras mentales</option>
											<option>GM8 Te cuido, me cuido</option>
											<option>GM9 Resiliencia</option>
											<option>GM10 Apoyo familiar a pacientes con enfermedad cronica</option>
											<option>GM11 Regulacion emocional</option>
											<option>GM12 Programacion neurolinguistica</option>
											<option>GM13</option>
											<option>GM14</option>
											<option>GM15</option>
										</select>
									</label>
								</td>
								<td id="FechaSiEdu" <?php if ($brindo_edu == 'SI') {
														echo 'style="display: block;"';
													} elseif ($brindo_edu == 'NO') {
														echo 'style="display: none;"';
													} else {
														echo 'style="display: none;"';
													} ?>>
									<label>
										<span>Fecha Educacion</span>
										<input type="date" name="FechaEduca" id="FechaEduca" value="<?php echo  $fecha_brindo; ?>" disabled>
									</label>
								</td>
								<td id="motivo_no" <?php if ($brindo_edu == 'NO') {
														echo 'style="display: block;"';
													} elseif ($brindo_edu == 'SI') {
														echo 'style="display: none;"';
													} else {
														echo 'style="display: none;"';
													} ?>>
									<label>
										<span>Motivo</span>
										<select name="MotivoNoEdu" id="MotivoNoEdu" disabled>
											<option>Seleccione...</option>
											<?php if ($brindo_edu == 'SI') {
												echo '<option value="">Seleccione...</option>';
											} elseif ($brindo_edu == 'NO') {
												echo '<option>' . $motivoNo . '</option>';
											} else {
												echo '<option value="">Seleccione...</option>';
											} ?>
											<option>No permite brindar informacion</option>
											<option>Solicita que sea de forma presencial</option>
											<option>No acepta visita</option>
											<option>Solicita envio por Email</option>
											<option>No Interesada</option>
										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>
									<span style=" display:none" id="consecutivo_betaferon_span">Consecutivo Betaferon<span class="asterisco">*</span></span>
								</td>
								<td>
									<input type="text" name="consecutivo_betaferon" id="consecutivo_betaferon" style=" display:none" />
								</td>
							</tr>
							<tr>
								<td>
									<div style="display:none" id="span_apoyo">
										<span>Se brindo apoyo<span class="asterisco">*</span></span>
									</div>
									<div style="display:none" id="span_aplicacion">
										<span>Agregar informacion aplicaciones<span class="asterisco">*</span></span>
									</div>
									<br />
									<br />
								</td>
								<td>
									<div style="display:none; width:100%" id="div_apoyo">
										<select type="text" name="brindo_apoyo" id="brindo_apoyo" style="width:82%">
											<option value="">Seleccione...</option>
											<option>SI</option>
											<option>NO</option>
										</select>
										<input type="button" name="ver_apoyo" id="ver_apoyo" title="Ver apoyo" style=" visibility:hidden" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_brindar_apoyo.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>&xxxx=<?php echo base64_encode($fila['PRODUCTO_TRATAMIENTO']) ?>')" class="btn_ver" />
									</div>
									<div style="display:none; width:100%" id="div_aplicaciones">
										<select type="text" name="aplicaicones" id="aplicaicones" style="width:82%">
											<option value="">Seleccione...</option>
											<option>SI</option>
											<option>NO</option>
										</select>
										<input type="button" name="ver_aplicaciones" id="ver_aplicaciones" title="Ver aplicaciones" style=" visibility:hidden" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_aplicaciones_eylia.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>&xxxx=<?php echo base64_encode($fila['PRODUCTO_TRATAMIENTO']) ?>')" class="btn_ver" />
									</div>
									<br />
									<br />
								</td>
								<td>
									<div style="display:none" id="span_tabletas_diarias">
										<span>Numero Tabletas Diarias</span>
									</div>
									<br />
									<br />
								</td>
								<td>
									<div style="display:none; width:100%;" id="div_tabletas_diarias">
										<input value="0" type="text" name="numero_tabletas_diarias" id="numero_tabletas_diarias" style="width:95%;" placeholder="0" />
									</div>
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Medicamento Hasta<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<input type="date" name="fecha_medicamento_hasta" id="fecha_medicamento_hasta" value="<?php echo $FECHA_MEDICAMENTO_HASTA; ?>" />
									<br />
									<br />
								</td>
								<td class="tit"><br />
									<br />
								</td>
								<td style="width:30%;"><br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Se Logro la Comunicacion<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%; display:none" value="" checked="checked" />
									<input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%;" value="SI" />SI
									<input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%;" value="NO" />NO
									<br />
									<br />
								</td>
								<td class="tit">
									<span>Motivo de Comunicacion<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td style="width:30%;">
									<select type="text" name="motivo_comunicacion" id="motivo_comunicacion">
										<option value="">Seleccione...</option>
										<option>Apoyo Emocional</option>
										<option>Educacion Mes Actual</option>
										<option>Educacion Patologica</option>
										<option>Educacion sistema de Salud</option>
										<option>Egreso</option>
										<option>Gestion Barreras</option>
										<option>Grupo de Apoyo</option>
										<option>Ingreso</option>
										<option>Reclamo / Bayer a tu casa</option>
										<option>Titulacion</option>
									</select>
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td class="tit">
									<span>Medio de Contacto<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td style="width:30%;">
									<select type="text" name="medio_contacto" id="medio_contacto">
										<option value="">Seleccione...</option>
										<option>Electronico</option>
										<option>Telefonico</option>
										<option>Visita</option>
									</select>
									<br />
									<br />
								</td>
								<td>
									<span>Tipo de Llamada<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<select type="text" name="tipo_llamada" id="tipo_llamada">
										<option value="">Seleccione...</option>
										<option>Entrada</option>
										<option>Salida</option>
									</select>
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Motivo de No Comunicacion</span>
									<br />
									<br />
								</td>
								<td>
									<select type="text" name="motivo_no_comunicacion" id="motivo_no_comunicacion">
										<option value="">Seleccione...</option>
										<option>Apagado</option>
										<option>No Esta</option>
										<option>No Contesta</option>
										<option>No Vive Ahi</option>
										<option>Numero Equivocado</option>
										<option>Telefono Ocupado</option>
										<option>Telefono Fuera de Servicio</option>
										<option>Otro</option>
									</select>
									<br />
									<br />
								</td>
								<td>
									<span>Numero de Intentos<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<input type="number" name="via_recepcion" id="via_recepcion" />
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Asegurador<span class="asterisco">*</span></span>
								</td>
								<td>
									<?php $query =  mysqli_query($conex, "SELECT DISTINCT ASEGURADOR FROM ipsen_asegurador WHERE ESTADO = 'IN' ORDER BY ID_ASEGURADOR DESC")
									?>
									<input list="asegura" name="asegurador" id="asegurador" value="<?php echo $fila['ASEGURADOR_TRATAMIENTO'] ?>" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo1(this)">
									<datalist id="asegura">
										<?php
										while ($valores = mysqli_fetch_array($query)) {
										?>
											<option><?php echo $valores['ASEGURADOR'] ?></option>
										<?php
										}
										?>
									</datalist>
								</td>
								<td>
									<span>Ips que Atiende<span class="asterisco">*</span></span>
								</td>
								<td>
									<?php
									$Seleccion = mysqli_query($conex, "SELECT DISTINCT IPS FROM ipsen_ips WHERE ESTADO = 'IN' ORDER BY ID_IPS DESC");
									?>
									<input list="ips" name="ips_atiende" id="ips_atiende" value="<?php echo $fila['IPS_ATIENDE_TRATAMIENTO'] ?>" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo3(this)">
									<datalist id="ips">
										<?php
										while ($fila_ips = mysqli_fetch_array($Seleccion)) {
										?>
											<option><?php echo $fila_ips['IPS'] ?></option>
										<?php
										}
										?>
									</datalist>
								</td>
							</tr>
							<tr>
								<td></td>
								<td id="otro_asegurador" style="display:none">
									<span>Asegurador por habilitar<span class="asterisco">*</span></span>
									<input name="asegurador_otro" id="asegurador_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
								</td>
								<td></td>
								<td id="otro_ips" style="display:none">
									<span>Ips por habilitar<span class="asterisco">*</span></span>
									<input name="ips_otro" id="ips_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
								</td>
							</tr>
							<tr>
								<td>
									<span>Medico Tratante<span class="asterisco">*</span></span>
								</td>
								<td>
									<?php
									$Seleccion = mysqli_query($conex, "SELECT DISTINCT MEDICO FROM ipsen_listas WHERE ESTADO = 'IN' ORDER BY ID_LISTA DESC ");
									?>
									<input list="medico_t" name="medico_tratante" id="medico_tratante" value="<?php echo $fila['MEDICO_TRATAMIENTO'] ?>" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo4(this)">
									<datalist id="medico_t">
										<?php
										while ($fila_operador = mysqli_fetch_array($Seleccion)) {
										?>
											<option><?php echo $fila_operador['MEDICO'] ?></option>
										<?php
										}
										?>
									</datalist>
								</td>
								<td>
									<span>Medico Prescriptor<span class="asterisco">*</span></span>
								</td>
								<td>
									<?php
									$Seleccion = mysqli_query($conex, "SELECT DISTINCT MEDICO FROM ipsen_listas WHERE ESTADO = 'IN' ORDER BY ID_LISTA DESC ");
									?>
									<input list="medico_p" name="medico_prescriptor" id="medico_prescriptor" value="<?php echo $fila['MEDICO_PRESCRIPTOR'] ?>" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo5(this)">
									<datalist id="medico_p">
										<?php
										while ($fila_operador = mysqli_fetch_array($Seleccion)) {
										?>
											<option><?php echo $fila_operador['MEDICO'] ?></option>
										<?php
										}
										?>
									</datalist>
								</td>
							</tr>
							<tr>
								<td></td>
								<td id="otro_medico_t" style="display:none">
									<span>Medico Tratante por habilitar<span class="asterisco">*</span></span>
									<input name="medico_t_otro" id="medico_t_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
								</td>
								<td></td>
								<td id="otro_medico_p" style="display:none">
									<span>Medico Prescriptor por habilitar<span class="asterisco">*</span></span>
									<input name="medico_p_otro" id="medico_p_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
								</td>
							</tr>
							<tr>
								<td>
									<span>Fecha Prescripcion<span class="asterisco">*</span></span>
								</td>
								<td>
									<input type="date" name="fecha_prescripcion" id="fecha_prescripcion" value="<?php echo $fila['FECHA_PRESCRIPCION'] ?>">
								</td>
								<td>
									<span>Operador Logistico<span class="asterisco">*</span></span>
								</td>
								<td>
									<?php
									$Seleccion = mysqli_query($conex, "SELECT DISTINCT OPERADOR_LOGISTICO FROM ipsen_operador_logistico WHERE ESTADO = 'IN' ORDER BY ID_OPERADOR_LOGISTICO DESC ");
									?>
									<input list="operador" name="operador_logistico" id="operador_logistico" value="<?php echo $fila['OPERADOR_LOGISTICO_TRATAMIENTO'] ?>" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo2(this)">
									<datalist id="operador">
										<?php
										while ($fila_operador = mysqli_fetch_array($Seleccion)) {
										?>
											<option><?php echo $fila_operador['OPERADOR_LOGISTICO'] ?></option>
										<?php
										}
										?>
									</datalist>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td id="otro_operador" style="display:none">
									<span>Operador logistico por habilitar<span class="asterisco">*</span></span>
									<input name="operador_otro" id="operador_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
								</td>
							</tr>
							<tr>
								<td>
									<span>Ciudad de Entrega</span><span class="asterisco">*</span><br />
									<br />
								</td>
								<td>
									<select type="text" name="ciudad_reclamacion" id="ciudad_reclamacion">
										<option><?php echo $fila['CIUDAD_RECLAMACION']; ?></option>
										<?php
										$Seleccion = mysqli_query($conex, "SELECT DISTINCT nombre FROM `ipsen_ciudad` WHERE nombre != '' ORDER BY nombre ASC");
										while ($filare = mysqli_fetch_array($Seleccion)) {
											$CIUDAD_RECLAMACION = $filare['nombre'];
											echo "<option>" . $CIUDAD_RECLAMACION . "</option>";
										}
										?>
									</select><br /><br />
								</td>
								<td>
									<span>Punto De Entrega</span>
									<br /><br />
								</td>
								<td>
									<?php
									$Seleccion = mysqli_query($conex, "SELECT DISTINCT NOMBRE_PUNTO FROM ipsen_puntos_entrega WHERE ESTADO = 'IN' ORDER BY ID_PUNTO DESC");
									?>
									<input list="punto" name="punto_entrega" id="punto_entrega" value="<?php echo $fila['PUNTO_ENTREGA'] ?>" autocomplete=" off" onkeypress="return check(event)" onchange="trat_previo6(this)">
									<datalist id="punto">
										<?php
										while ($fila = mysqli_fetch_array($Seleccion)) {
										?>
											<option><?php echo $fila['NOMBRE_PUNTO'] ?></option>
										<?php
										}
										?>
									</datalist>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td id="otro_punto" style="display:none">
									<span>Punto de entrega por habilitar<span class="asterisco">*</span></span>
									<input name="punto_entrega_otro" id="punto_entrega_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
								</td>
							</tr>
							<td>
								<span>Numero de Autorizacion</span>
								<br />
								<br />
							</td>
							<td>
								<select type="text" name="estado_ctc" id="estado_ctc">
									<option value="">Seleccione...</option>
									<option>Pendiente Por Aprobacion</option>
									<option>1Ra Entrega De 1 Autorizada</option>
									<option>1Ra Entrega De 2 Autorizadas</option>
									<option>2Da Entrega De 2 Autorizadas</option>
									<option>1Ra Entrega De 3 Autorizadas</option>
									<option>2Da Entrega De 3 Autorizadas</option>
									<option>3Ra Entrega De 3 Autorizadas</option>
									<option>1Ra Entrega De 4 Autorizadas</option>
									<option>2Da Entrega De 4 Autorizadas</option>
									<option>3Ra Entrega De 4 Autorizadas</option>
									<option>4Ta Entrega De 4 Autorizadas</option>
									<option>1Ra Entrega De 5 Autorizadas</option>
									<option>2Da Entrega De 5 Autorizadas</option>
									<option>3Ra Entrega De 5 Autorizadas</option>
									<option>4Ta Entrega De 5 Autorizadas</option>
									<option>5Ta Entrega De 5 Autorizadas</option>
									<option>1Ra Entrega De 6 Autorizadas</option>
									<option>2Da Entrega De 6 Autorizadas</option>
									<option>3Ra Entrega De 6 Autorizadas</option>
									<option>4Ta Entrega De 6 Autorizadas</option>
									<option>5Ta Entrega De 6 Autorizadas</option>
									<option>6Ta Entrega De 6 Autorizadas</option>
									<option>1Ra Entrega De 12 Autorizadas</option>
									<option>3Ra Entrega De 12 Autorizadas</option>
									<option>4Ta Entrega De 12 Autorizadas</option>
									<option>5Ta Entrega De 12 Autorizadas</option>
									<option>6Ta Entrega De 12 Autorizadas</option>
									<option>7Ma Entrega De 12 Autorizadas</option>
									<option>8va Entrega De 12 Autorizadas</option>
									<option>9Na Entrega De 12 Autorizadas</option>
									<option>10Ma Entrega De 12 Autorizadas</option>
									<option>11Ava Entrega De 12 Autorizadas</option>
									<option>12Ava Entrega De 12 Autorizadas</option>
									<option>Pendiente Confirmar</option>
									<option>Paciente No Proporciona Informacion</option>
								</select>
							</td>
							<td>
								<span>Fecha de Autorizacion<span class="asterisco">*</span></span>
							</td>
							<td>
								<input name="fecha_autorizacion" type="date" style="margin-top: 10px;" value="<?php echo $FECHA_AUTORIZACION ?>" />
							</td>
							</tr>
							<tr>
								<td>
									<span>Estado Farmacia</span>
									<br />
									<br />
								</td>
								<td>
									<select type="text" name="estado_farmacia" id="estado_farmacia">
										<option value="">Seleccione...</option>
										<option>Aprobado</option>
										<option>Pendiente Radicar</option>
										<option>Radicado</option>
									</select>
									<br />
									<br />
								</td>
								<td>
									<span>Dificultad en el Acceso</span>
									<br />
									<br />
								</td>
								<td>
									<input type="radio" name="dificultad_acceso" id="dificultad_acceso" style=" width:20%;" value="SI" />SI
									<input type="radio" name="dificultad_acceso" id="dificultad_acceso" style=" width:20%;" value="NO" />NO
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Tipo de Dificultad</span>
									<br />
									<br />
								</td>
								<td colspan="3">
									<textarea style="width:98%; height:72.5px;" id="tipo_dificultad" name="tipo_dificultad"></textarea>
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Autor</span>
									<br />
									<br />
								</td>
								<td>
									<input type="text" name="autor" id="autor" readonly="readonly" value="<?php echo $usua ?>" />
									<br />
									<br />
								</td>
								<td>
									<span>Genera Solicitud<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<input type="radio" name="genera_solicitud" id="genera_solicitud" style=" width:20%; display:none" value="" checked="checked" />
									<input type="radio" name="genera_solicitud" id="genera_solicitud" style=" width:20%;" value="SI" />SI
									<input type="radio" name="genera_solicitud" id="genera_solicitud" style=" width:20%;" value="NO" />NO
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Evento Adverso<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%; display:none" value="" checked="checked" />
									<input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%;" value="SI" />SI
									<input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%;" value="NO" />NO
									<br />
									<br />
								</td>
								<td>
									<span id="envio_evento_adverso_span" style="display:none">Tipo de Evento<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<div id="envio_evento_adverso_div" style="display:none">
										<input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%; display:none" value="" checked="checked" />
										<input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Farmacovigilancia" />Farmacovigilancia
										<br />
										<input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Tecnovigilancia I-neb" />Tecnovigilancia I-neb
									</div>
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Fecha de la Proxima Llamada<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<input type="date" name="fecha_proxima_llamada" id="fecha_proxima_llamada" min="<?php echo date('Y-m-d'); ?>" />
									<br />
									<br />
								</td>
								<td>
									<span>Motivo de Proxima Llamada<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<select type="text" name="motivo_proxima_llamada" id="motivo_proxima_llamada">
										<option value="">Seleccione...</option>
										<option>Actualizacion de Datos</option>
										<option>Campanas</option>
										<option>Cumpleanos</option>
										<option>Egreso</option>
										<option>Encuestas</option>
										<option>Ingreso</option>
										<option>Reclamacion</option>
										<option>Remision de Caso</option>
										<option>Respuesta de Caso</option>
										<option>Seguimiento</option>
									</select>
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Observaciones Proxima Llamada</span>
									<br />
									<br />
								</td>
								<td>
									<input type="text" name="observacion_proxima_llamada" id="observacion_proxima_llamada" onkeypress="return check(event)" />
									<br />
									<br />
								</td>
								<td>
									<span>Consecutivo</span>
									<br />
									<br />
								</td>
								<td>
									<input type="text" name="consecutivo" id="consecutivo" />
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<div id="span_paap">
										<span>Paciente hace parte del PAAP<span class="asterisco">*</span></span>
									</div>
								</td>
								<td>
									<div id="div_paap">
										<select type="text" name="paap" id="paap" style="width:95%">
											<option><?php echo $PAAP ?></option>
											<option>SI</option>
											<option>NO</option>
										</select>
									</div>
								</td>
								<td>
									<div id="span_sub_paap">
										<span>Requiere Apoyo del PAAP<span class="asterisco">*</span></span>
									</div>
								</td>
								<td>
									<div id="div_sub_paap">
										<select type="text" name="sub_paap" id="sub_paap" style="width:95%">
											<?php if ($SUB_PAAP == "") { ?>
												<option value="">Seleccione...</option>
												<option>Con barrera</option>
												<option>Sin barrera</option>
											<?php } else { ?>
												<option><?php echo $SUB_PAAP; ?></option>
												<option>Con barrera</option>
												<option>Sin barrera</option>
											<?php } ?>
										</select>
										<br />
										<br />
									</div>
									<!-- <div id="div_barrera">
										<label>Tipo Transferencia<span class="asterisco">*</span></label>
										<select type="text" name="sub_barrera" id="sub_barrera" style="width:95%">
											<?php if ($BARRERAPAAP == "") { ?>
												<option value="">Seleccione...</option>
												<option value="Correo">Correo</option>
											<?php } else { ?>
												<option><?php echo $BARRERAPAAP; ?></option>
												<option value="Correo">Correo</option>
											<?php } ?>
										</select>
									</div> -->
								</td>
								<?php
								?>
							</tr>
							<tr>
								<td>
									<span>Numero cajas/ Unidades</span>
									<br />
									<br />
								</td>
								<td>
									<select name="numero_cajas" id="numero_cajas" style="width:30%;">
										<option>Seleccione...</option>
										<option>0</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
										<option>13</option>
										<option>14</option>
										<option>15</option>
										<option>16</option>
										<option>17</option>
										<option>18</option>
										<option>19</option>
										<option>20</option>
										<option>21</option>
										<option>22</option>
										<option>23</option>
										<option>24</option>
										<option>25</option>
										<option>26</option>
										<option>27</option>
										<option>28</option>
										<option>29</option>
										<option>30</option>
										<option>31</option>
										<option>32</option>
										<option>33</option>
										<option>34</option>
										<option>35</option>
										<option>36</option>
										<option>37</option>
										<option>38</option>
										<option>39</option>
										<option>40</option>
										<option>41</option>
										<option>42</option>
										<option>43</option>
										<option>44</option>
										<option>45</option>
										<option>46</option>
										<option>47</option>
										<option>48</option>
										<option>49</option>
										<option>50</option>
									</select>
									<select name="tipo_numero_cajas" id="tipo_numero_cajas" style="width:60%;">
										<option>Seleccione...</option>
										<option>Ampolla(s)</option>
										<option>Aplicacion</option>
										<option>Caja(s)</option>
									</select>
									<br />
									<br />
								</td>
								<td>
									<div style="display:none" id="span_nebulizaciones">
										<span>Numero Nebulizaciones</span>
										<br />
										<br />
									</div>
								</td>
								<td>
									<div style="display:none" id="div_nebulizaciones">
										<input type="text" name="nebulizaciones" id="nebulizaciones" />
										<br />
										<br />
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span style="text-transform:capitalize;">Tratamiento Previo</span>
									<br />
									<br />
								</td>
								<td>
									<select type="text" name="tratamiento_previo" id="tratamiento_previo" onchange="trat_previo(this)">
										<option><?php echo $TRATAMIENTO_PREVIOS ?></option>
										<option>Seleccione...</option>
										<?php
										$Seleccion = mysqli_query($conex, "SELECT DISTINCT TRATAMIENTO_PREVIO FROM `ipsen_listas` WHERE TRATAMIENTO_PREVIO != '' AND TRATAMIENTO_PREVIO!='" . $tratamiento_previo . "' ORDER BY TRATAMIENTO_PREVIO ASC");
										while ($fila_trt = mysqli_fetch_array($Seleccion)) {
											$TRATAMIENTO_PREVIO = $fila_trt['TRATAMIENTO_PREVIO'];
											echo "<option>" . $TRATAMIENTO_PREVIO . "</option>";
										}
										?>
										<option>Otro</option>
									</select>
									<div id="otro_tratamiento" style="display:none">
										<span>Cual?</span>
										<input name="tratamiento_previo_otro" id="tratamiento_previo_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
									</div>
									<br />
									<br />
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<span style="text-transform:capitalize;">Medicamento</span>
									<br />
									<br />
								</td>
								<td>
									<input style="text-transform:capitalize;" type="text" readonly="readonly" name="MEDICAMENTO" id="MEDICAMENTO" value="<?php echo $PRODUCTO_TRATAMIENTO ?>" />
									<br />
									<br />
								</td>
								<td>
									<span style="text-transform:capitalize;">Dosis Tratamiento<span class="asterisco">*</span></span>
									<br />
									<br />
								</td>
								<td>
									<?php
									$dosis_bd = $fila['DOSIS_TRATAMIENTO'];
									if ($producto_tratamiento == 'ADEMPAS 1MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2.5MG 84TABL' || $producto_tratamiento == 'ADEMPAS 1.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 0.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2MG 42TABL' || $producto_tratamiento == 'ADEMPAS') {
										$producto_tratamiento = 'ADEMPAS';
									}
									if ($producto_tratamiento == 'KOGENATE FS 2000 PLAN') {
									?>
										<input type="text" maxlength="6" name="Dosis3" id="Dosis3" onKeyDown="return validarNumeros(event)" value="<?php echo $DOSIS ?>" />
									<?PHP
									}
									if ($producto_tratamiento == 'Xofigo 1x6 ml CO') {
									?>
										<input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $DOSIS ?>" />
									<?PHP
									}
									if ($producto_tratamiento == 'Kovaltry') {
									?>
										<input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $DOSIS ?>" />
									<?PHP
									}
									if ($producto_tratamiento == 'Jivi') {
									?>
										<input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $DOSIS ?>" />
									<?php
									}
									if ($producto_tratamiento != 'Xofigo 1x6 ml CO' && $producto_tratamiento != 'KOGENATE FS 2000 PLAN' && $producto_tratamiento != 'Kovaltry' && $producto_tratamiento != 'Jivi') {
									?>
										<select name="Dosis" id="Dosis">
											<option><?php echo $DOSIS ?></option>
											<option>Seleccione...</option>
											<?php
											$producto = $fila['PRODUCTO_TRATAMIENTO'];
											$select = mysqli_query($conex, "SELECT DOSIS FROM  ipsen_dosis WHERE NOMBRE_REFERENCIA LIKE '" . $producto_tratamiento . "%' AND DOSIS!='" . $dosis_bd . "'");
											echo mysqli_error($conex);
											while ($filass = (mysqli_fetch_array($select))) {
											?>
												<option value="<?php echo $filass['DOSIS'] ?>"><?php echo $filass['DOSIS'] ?></option>
											<?php
											}
											?>
										</select>
									<?php
									}
									?>
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<!-- <td width="20%">
									<span>Status del Paciente</span>
								</td>
								<td width="30%">
									<select type="text" name="status_paciente" id="status_paciente">
										<option><?php echo $STATUS_PACIENTE ?></option>
										<option>Seleccione...</option>
									</select>
								</td> -->
								<td>
									<span>Envios</span>
									<br />
									<br />
								</td>
								<td>
									<input type="radio" name="envios" id="envios" style=" width:20%;" value="SI" />SI
									<input type="radio" name="envios" id="envios" style=" width:20%;" value="NO" />NO
									<br />
									<br />
								</td>
							</tr>
							<tr>
								<td>
									<span>Tipo de Envio</span>
									<br />
									<br />
								</td>
								<td>
									<select name="tipo_envio" id="tipo_envio">
										<option value="">Seleccione...</option>
										<?php
										while ($opcion = mysqli_fetch_array($listado_envio)) {
										?>
											<option value="<?php echo $opcion['ID_REFERENCIA'] ?>"><?php echo $opcion['MATERIAL'] ?></option>
										<?php
										}
										?>
									</select>
									<select name="nombre_producto" id="nombre_producto" style="display:none">
										}<option>Seleccione...</option>
									</select>
									<br />
									<br />
								</td>
								<td>
									<div id="div_agregar" style="visibility:hidden">
										<input type="submit" name="agregar_seg" id="agregar_seg" formaction="form_productos_envio.php" formtarget="registro_productos_form" style="background-image:url(imagenes/agregar.png); background-repeat:no-repeat;  width:41px; height:38px; border:1px solid transparent; background-color:transparent" value="" />
									</div>
								</td>
							<?php
							}
							?>
							</tr>
							<tr>
								<td colspan="4">
									<div id="div_material_agregar" style="width:50%; margin:auto auto; display:none">
										<iframe name="registro_productos_form" style="width:100%; height:250px; border:1px solid #000;" scrolling="auto"></iframe>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span>Descripcion de Comunicacion</span>
									<br />
									<br />
								</td>
								<td colspan="3">
									<textarea style="width:98%; height:72.5px;" id="descripcion_comunicacion" name="descripcion_comunicacion" onKeyDown="return filtro(1)"></textarea>
									<br />
									<br />
								</td>
							</tr>
						</table>
						<br />
						<br />
					</div>
				</div>
				<div class="AccordionPanel">
					<div class="AccordionPanelTab" style="padding:5px">COMUNICACIONES</div>
					<div class="AccordionPanelContent">
						<?PHP
						$gestion = mysqli_query($conex, "SELECT * FROM `ipsen_gestiones` WHERE `ID_PACIENTE_FK2` = '" . $ID_PACIENTE2 . "' ORDER BY `FECHA_COMUNICACION` DESC");
						echo mysqli_error($conex);
						echo "<table width=100% border=1 rules=all  align=left class=Estilo2 >";
						echo "<tr style='border:1px solid #fff'>";
						echo "<th class=AccordionPanelTab><strong>FECHA DE GESTION</strong></th>";
						echo "<th class=AccordionPanelTab><strong>DESCRIPCION</strong></th>";
						echo "<th class=AccordionPanelTab><strong>FECHA PROXIMO CONTACTO</strong></th>";
						echo "<th class=AccordionPanelTab><strong>AUTOR</strong></th>";
						echo "<th class=AccordionPanelTab><strong>MOTIVO COMUNICACION GESTION</strong></th>";
						echo "<td class=AccordionPanelTab><strong>FECHA ULTI RECOLECCION</strong></td>";
						echo "<td class=AccordionPanelTab><strong>FECHA PROX RECOLECCION</strong></td>";
						echo "<td class=AccordionPanelTab><strong>FECHA_INI PAAP</strong></td>";
						echo "<td class=AccordionPanelTab><strong>FECHA_FIN PAAP</strong></td>";
						echo "<td class=AccordionPanelTab><strong>CODIGO ARGUS</strong></td>";
						echo "<td class=AccordionPanelTab><strong>ARCHIVO ADJUNTO</strong></td>";
						echo "</tr>";
						$numges = 1;
						while ($fila2 = mysqli_fetch_array($gestion)) {
							echo "<tr>";
							echo "<td>" . $fila2['FECHA_COMUNICACION'] . "</td>";
							echo "<td>";
						?>
							<textarea name="observaciones" cols="60" rows="2" readonly="readonly" id="observaciones" class="letra" style="text-transform:uppercase"><?php echo $fila2['DESCRIPCION_COMUNICACION_GESTION']; ?></textarea>
							<?php
							echo "</td>";
							echo "<td>" . $fila2['FECHA_PROGRAMADA_GESTION'] . "</td>";
							echo "<td>" . $fila2['AUTOR_GESTION'] . "</td>";
							echo "<td>" . $fila2['MOTIVO_COMUNICACION_GESTION'] . "</td>";
							echo "<td>" . $fila2['FECHA_ULT_RECOLECCION'] . "</td>";
							echo "<td>" . $fila2['FECHA_PRO_RECOLECCION'] . "</td>";
							echo "<td>" . $fila2['FECHA_INI_PAAP'] . "</td>";
							echo "<td>" . $fila2['FECHA_FIN_PAAP'] . "</td>";
							if ($privilegios == '1') {
								$evento = $fila2['EVENTO_ADVERSO_GESTION'];
								if ($evento == 'SI' || $evento == 'Si') {
							?>
									<td>
										<input name="CODIGO_ARGUS" id="CODIGO_ARGUS" type="text" maxlength="25" style="width:80%" value="<?php echo $fila2['CODIGO_ARGUS']; ?>" readonly="readonly" />
										<a class="btn_gestiones" href="javascript:ventanaSecundaria('../presentacion/codigo_ar.php?xx=<?php echo base64_encode($fila2['ID_GESTION']) ?>&xxp=<?php echo base64_encode($ID_PACIENTE) ?>')"><img src="imagenes/CHULO.png" width="17%" height="25px" title="Agregar Codigo" align="right" /> </a>
									</td>
								<?php
								} else {
								?>
									<td>
									</td>
								<?php
								}
							} else if ($privilegios == '2') {
								$evento = $fila2['EVENTO_ADVERSO_GESTION'];
								if ($evento == 'SI' || $evento == 'Si') {
								?>
									<td>
									<td>
										<input name="CODIGO_ARGUS" id="CODIGO_ARGUS" type="text" maxlength="25" style="width:80%" value="<?php echo $fila2['CODIGO_ARGUS']; ?>" readonly="readonly" />
										<a class="btn_gestiones" href="javascript:ventanaSecundaria('../presentacion/codigo_ar.php?xx=<?php echo base64_encode($fila2['ID_GESTION']) ?>&xxp=<?php echo base64_encode($ID_PACIENTE) ?>')"><img src="imagenes/CHULO.png" width="17%" height="25px" title="Agregar Codigo" align="right" /> </a>
									</td>
									</td>
								<?php
								} else {
								?>
									<td>
									</td>
									<?php
								}
							}
							$ID_GES = $fila2['ID_GESTION'];
							$dir = "../ADJUNTOS_IPSEN/$ID_GES";
							if (file_exists($dir)) {
								$directorio = opendir($dir);
								while ($archivo = readdir($directorio)) {
									if ($archivo == '.' or $archivo == '..') {
									} else {
										$enlace = $dir . "/" . $archivo;
									?>
										<td>
											<a class="highslide" onclick="return hs.expand(this)">
												<img src="<?php echo $enlace; ?>" alt="" title="Click to enlarge" height="100" width="100" onclick="javascript:this.width=500;this.height=500" ondblclick="javascript:this.width=100;this.height=100" /></a>
											<a href="<?php echo $enlace; ?>">ver</a>
											<br />
											<br />
										</td>
								<?php
									}
								}
								closedir($directorio);
							} else {
								?>
								<td>
								</td>
						<?php
							}
							echo "</tr>";
							$numges = $numges + 1;
						}
						echo "</table>";
						echo "<br />";
						?>
					</div>
				</div>
				<div class="AccordionPanel">
					<div class="AccordionPanelTab">NOTAS Y ADJUNTOS</div>
					<div class="AccordionPanelContent">
						<br />
						<br />
						<div style="width:91.4%;">
							<textarea name="nota" id="nota" style="width:100%; height:100px" title="Escriba una Nota" placeholder="Escriba una Nota"></textarea>
						</div>
						<br />
						<br />
						<span>Seleccione archivo...</span>
						<div class="input__row uploader">
							<div id="inputval" class="input-value"></div>
							<label for="archivo"></label>
							<input type="file" class="upload" name="archivo" id="archivo" class="aceptar">
						</div>
						<script>
							$('#archivo').on('change', function() {
								$('#inputval').text($(this).val());
							});
						</script>
						<center>
							<?PHP
							if ($privilegios != 5) {
							?>
								<input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(seguimiento,2)" />
							<?php
							}
							?>
							<br />
							<br />
							<br />
							<br />
							<br />
							<br />
					</div>
				</div>
			</div>
		</form>
		<script type="text/javascript">
			var Accordion1 = new Spry.Widget.Accordion("Accordion1");
		</script>
	</body>
<?php
} else {
?>
	<script type="text/javascript">
		window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
	</script>
<?php
}
?>

</html>