<?php
header("Content-Type: text/html;charset=utf-8");
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BAVARIA</title>
    <!-- <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" /> -->
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/calcular_edad.js"></script>
    <script type="text/javascript" src="js/direccion.js"></script>
    <script type="text/javascript" src="js/validar_campos_pacientes.js"></script>
    <script type="text/javascript" src="js/validaciones.js"></script>
    <script type="text/javascript" src="js/validar_caracteres.js"></script>
    <script src="../presentacion/js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("input[name='propietario']").change(function() {

                var propietario = $("input[name='propietario']:checked").val();

                if (propietario == "NO") {

                    $("#fila_nuevo_responsable").show();

                    $("#nombres_nuevo_pro, #apellidos_nuevo_pro")
                        .prop("required", true);

                } else {

                    $("#fila_nuevo_responsable").hide();

                    $("#nombres_nuevo_pro, #apellidos_nuevo_pro")
                        .val("")
                        .prop("required", false);

                }

            });

            $("input[name='whatsApp']").change(function() {

                var opcion = $("input[name='whatsApp']:checked").val();

                if (opcion == "SI") {

                    // Copia el teléfono y no permite editarlo
                    $("#num_WhatsApp")
                        .val($("#telefono").val())
                        .prop("readonly", true)
                        .prop("required", false);

                } else if (opcion == "NO") {

                    // Limpia el campo y obliga a ingresar otro número
                    $("#num_WhatsApp")
                        .val("")
                        .prop("readonly", false)
                        .prop("required", true)
                        .focus();

                }

            });
        });
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
            $("input[name=tipo_evento_adverso]").change(function() {
                var evento_adverso_tipo = $('#tipo_evento_adverso:checked').val();
                if (evento_adverso_tipo == 'Farmacovigilancia') {
                    $('#farmacovigilancia').css('display', 'inline');
                    $('#tecnovigilancia').css('display', 'none');
                } else if (evento_adverso_tipo == 'Tecnovigilancia') {
                    $('#farmacovigilancia').css('display', 'none');
                    $('#tecnovigilancia').css('display', 'inline');
                } else {
                    $('#farmacovigilancia').css('display', 'none');
                    $('#tecnovigilancia').css('display', 'none');
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
                if (producto_tratamiento == 'Somatuline') {
                    $('#span_tabletas_diarias').css('display', 'inline-block');
                    $('#div_tabletas_diarias').css('display', 'inline-block');
                    $('#div_apoyo').css('display', 'inline-block');
                    $('#span_apoyo').css('display', 'inline-block');
                    $('#div_aplicaciones').css('display', 'none');
                    $('#span_aplicacion').css('display', 'none');
                }
                if (producto_tratamiento != 'Somatuline') {
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
        $(document).ready(function() {
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

            $('#linea_tratamiento option:eq(0)').attr('selected', 'selected');
            $('#cambio_dosis option:eq(0)').attr('selected', 'selected');
            $('#medio_contacto option:eq(0)').attr('selected', 'selected');
            $('#tipo_llamada option:eq(0)').attr('selected', 'selected');
            $('#brindo_educacion option:eq(0)').attr('selected', 'selected');
            $('#brindo_apoyo option:eq(0)').attr('selected', 'selected');
            $('#motivo_comunicacion option:eq(0)').attr('selected', 'selected');
            $('#motivo_no_comunicacion option:eq(0)').attr('selected', 'selected');
            $('#estado_farmacia option:eq(0)').attr('selected', 'selected');

            function reclamo() {
                $("#causa_no_reclamacion").attr("selected", "selected");
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
                    $('#span_aplicacion_m').css('display', 'none');
                    $('#aplicacion_m').css('display', 'none');
                    $('#span_lugar_aplicacion').css('display', 'none');
                    $('#lugar_aplicacion').css('display', 'none');
                    $('#span_fecha_aplicacion').css('display', 'none');
                    $('#fecha_aplicacion').css('display', 'none');
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
                    $("#fecha_reclamacion_span").css('display', 'none');
                    $('#fecha_reclamacion').css('display', 'none');
                    $('#span_aplicacion_m').css('display', 'none');
                    $('#aplicacion_m').css('display', 'none');
                    $('#span_lugar_aplicacion').css('display', 'none');
                    $('#lugar_aplicacion').css('display', 'none');
                    $('#span_fecha_aplicacion').css('display', 'none');
                    $('#fecha_aplicacion').css('display', 'none');
                    $("#consecutivo_betaferon_span").css('display', 'none');
                    $('#consecutivo_betaferon').css('display', 'none');
                    $('#numero_cajas option:eq(0)').attr('selected', 'selected');
                    $('#tipo_numero_cajas option:eq(0)').attr('selected', 'selected');
                    $('#causa_no_reclamacion').attr('selected', 'selected');
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
                        $('#span_aplicacion_m').css('display', 'block');
                        $('#aplicacion_m').css('display', 'block');
                        $('#span_fecha_aplicacion').css('display', 'block');
                        $('#fecha_aplicacion').css('display', 'block');
                        $('#span_lugar_aplicacion').css('display', 'block');
                        $('#lugar_aplicacion').css('display', 'block');
                        $("#causa").css('display', 'none');
                        $('#causa_no_reclamacion').css('display', 'none');
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

            function aplicaciones() {
                var aplicacion = $('#aplicacion_m').val();
                if (aplicacion != 'SI') {
                    $('#span_fecha_aplicacion').css('display', 'none');
                    $('#fecha_aplicacion').css('display', 'none');
                    $('#span_lugar_aplicacion').css('display', 'none');
                    $('#lugar_aplicacion').css('display', 'none');
                } else {
                    $('#span_fecha_aplicacion').css('display', 'block');
                    $('#fecha_aplicacion').css('display', 'block');
                    $('#span_lugar_aplicacion').css('display', 'block');
                    $('#lugar_aplicacion').css('display', 'block');
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
            $("#aplicacion_m").change(function() {
                aplicaciones();
            });
            $("#brindo_educacion").change(function() {
                BrindoEducacion();
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
                    $('#causa_no_reclamacion').css('display', 'none');
                    $("#fecha_reclamacion_span").css('display', 'block');
                    $('#fecha_reclamacion').css('display', 'block');
                    $('#cambio_estado_activo_solicitar').css('display', 'block');
                    $('#estado_activo').css('display', 'block');
                    $('#asignado').css('display', 'block');
                    $('#solicitud_cambio_proveedor_people').css('display', 'block');
                    $('#solo_psp').css('display', 'block');
                    $('#confirmar_P_select').css('display', 'block');
                    $('#cambio_estado_abandono_solicitar').css('display', 'none');
                    $('#estado_abandono').css('display', 'none');
                    $('#cambio_estado_suspendido_solicitar').css('display', 'none');
                    $('#estado_suspendido').css('display', 'none');
                    $('#cambio_estado_interrumpido_solicitar').css('display', 'none');
                    $('#estado_interrumpido').css('display', 'none');
                } else {
                    $('#causa_no_reclamacion').css('display', 'block');
                    $("#fecha_reclamacion_span").css('display', 'none');
                    $('#fecha_reclamacion').css('display', 'none');
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
            $('#causa_no_reclamacion').change(function() {
                var CAUSA_NO_RECLAMACION = $('#causa_no_reclamacion').val();
                if (CAUSA_NO_RECLAMACION == 'Demora en la entrega del medicamento' || CAUSA_NO_RECLAMACION == 'Falta de medicamento en el punto') {
                    $('#span_num_pendiente').css('display', 'block');
                    $('#num_pendiente').css('display', 'block');
                    $('#span_fecha_pendiente').css('display', 'block');
                    $('#fecha_pendiente').css('display', 'block');
                } else {
                    $('#span_num_pendiente').css('display', 'none');
                    $('#num_pendiente').css('display', 'none');
                    $('#span_fecha_pendiente').css('display', 'none');
                    $('#fecha_pendiente').css('display', 'none');
                }
            });
            $('#causa_no_reclamacion').change(function() {
                var CAUSA_NO_RECLAMACION = $('#causa_no_reclamacion').val();
                if (CAUSA_NO_RECLAMACION == 'Cita inoportuna' || CAUSA_NO_RECLAMACION == 'Demora en la Autorizacion Cita Medica' || CAUSA_NO_RECLAMACION == 'Demora en la autorizacion de medicamento' || CAUSA_NO_RECLAMACION == 'Demora en la entrega del medicamento' || CAUSA_NO_RECLAMACION == 'Error en papeleria' || CAUSA_NO_RECLAMACION == 'Falta cita para examenes' || CAUSA_NO_RECLAMACION == 'Falta de cita de aplicacion' || CAUSA_NO_RECLAMACION == 'Falta de cita medica' || CAUSA_NO_RECLAMACION == 'Falta de medicamento en el punto' || CAUSA_NO_RECLAMACION == 'Sin red Prestadora' || CAUSA_NO_RECLAMACION == 'Cita inoportuna de Aplicacion' || CAUSA_NO_RECLAMACION == 'Pendiente formulacion NO sistema') {
                    $('#span_asignado_edugestor').css('display', 'block');
                    $('#ciudad_edugestor').css('display', 'block');

                } else {
                    $('#span_asignado_edugestor').css('display', 'none');
                    $('#ciudad_edugestor').css('display', 'none');
                }
            });
            $('#ciudad_edugestor').change(function() {
                var CIUDAD_EDUGESTOR = $('#ciudad_edugestor').val();
                if (CIUDAD_EDUGESTOR == 'Pasto' || CIUDAD_EDUGESTOR == 'Ibague' || CIUDAD_EDUGESTOR == 'Barranquilla' || CIUDAD_EDUGESTOR == 'Santander') {
                    $('#span_autorizacion_edugestor').css('display', 'block');
                    $('#autorizacion_edugestor').css('display', 'block');
                } else {
                    $('#span_autorizacion_edugestor').css('display', 'none');
                    $('#autorizacion_edugestor').css('display', 'none');
                }
            });
            $('#cambio_dosis').change(function() {
                var CAMBIO_DOSIS = $('#cambio_dosis').val();
                if (CAMBIO_DOSIS == 'SI') {
                    $('#nueva_dosis').css('display', 'block');
                    $('#Dosis3').css('display', 'block');
                    $('#Dosis2').css('display', 'block');
                    $('#Dosis').css('display', 'block');
                    $('#fecha_cambio').css('display', 'block');
                    $('#fecha_cambio_dosis').css('display', 'block');
                } else {
                    $('#nueva_dosis').css('display', 'none');
                    $('#Dosis3').css('display', 'none');
                    $('#Dosis2').css('display', 'none');
                    $('#Dosis').css('display', 'none');
                    $('#fecha_cambio').css('display', 'none');
                    $('#fecha_cambio_dosis').css('display', 'none');
                }
            });
            $('#motivo_retiro').change(function() {
                var MOTIVO_RETIRO = $('#motivo_retiro').val();
                if (MOTIVO_RETIRO == 'Cambio de tratamiento') {
                    $('#span_cambio_tratamiento').css('display', 'block');
                    $('#cambio_tratamiento').css('display', 'block');
                } else {
                    $('#span_cambio_tratamiento').css('display', 'none');
                    $('#cambio_tratamiento').css('display', 'none');
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

    <style>
        .btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .bg-gradient {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
        }

        .text-white {
            color: white;
        }

        .w-25 {
            width: 25%;
        }

        .alert {
            /* margin-left: 22%; */
            width: 100%;
            text-align: center;
        }

        @media (max-width: 768px) {

            /* Define styles for smaller screens here */
            table {
                width: 100%;
            }

            th,
            td {
                display: block;
            }
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 1px;
            /* border-color: red; */
        }

        .accordion {
            --bs-accordion-active-bg: #A5B9C8;
            --bs-accordion-active-color: white;
            --bs-accordion-btn-bg: #A5B9C8;
            --bs-accordion-btn-color: white;
        }

        .asterisco {
            font-weight: 700;
            color: #F00 !important;
        }

        body,
        .accordion-item {
            background-color: transparent;
        }

        .accordion-collapse {
            border: solid #1D5C75 1px;
            border-end-start-radius: 10px;
            border-end-end-radius: 10px;
        }

        .btn-modify {
            background: #1D5C75;
        }

        .btn:hover {
            background: #1D5C75;
        }

        .readonly {
            background-color: #E5E5E5;
        }

        .readonly:focus {
            background-color: #E5E5E5;
        }

        .btn_ver {
            background-image: url(imagenes/search.png);
            background-repeat: no-repeat;
            background-size: contain;
            width: 15%;
            height: 50px;
            color: transparent;
            background-color: transparent;
            border-radius: 5px;
            border: 1px solid transparent;
        }

        .btn_ver:active {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
                inset 0px 0px 20px #EEECEC;
        }

        .btn_ver:hover {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
                inset 0px 0px 20px #EEECEC;
        }

        /* Estilo del contenedor */
        .player-container {
            /* width: 300px;
                        margin: 50px auto;*/
            padding: 10px;
            background-color: transparent;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            font-family: Arial, sans-serif;
        }


        /* Estilo del reproductor de audio */
        .player-container audio {
            width: 100%;
            outline: none;
            margin: 5px;
            border: 3px;
            border-color: #000;
        }

        /* Estilo para mensaje de error */
        .error-message {
            color: red;
            font-size: 16px;
        }
    </style>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$responsable = base64_decode($artid);
if ($privilegios != '' && $usua != '') {
?>

    <body class="body">
        <form id="seguimiento" name="seguimiento" method="post" action="../logica/actualizar_seguimiento.php" enctype="multipart/form-data" class="letra">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            GENERAL
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php
                            $sele_responsable = mysqli_query($conex, "SELECT * FROM `responsable` WHERE ID_RESPONSABLE = '" . $responsable . "'");
                            while ($fila = mysqli_fetch_array($sele_responsable)) {
                                $id_responsable = $fila['ID_RESPONSABLE'];
                                $nombres_res = $fila['NOMBRES'];
                                $apellidos_res = $fila['APELLIDOS'];
                                $tipo_identificacion = $fila['TIPO_IDENTIFICACION'];
                                $identificacion = $fila['IDENTIFICACION'];
                                $telefono = $fila['TELEFONO'];
                                $direccion = $fila['DIRECCION'];
                            }
                            ?>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Codigo responsable<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="codigo_responsable" type="text" id="codigo_responsable" max="10" readonly value="<?php echo $id_responsable; ?>" />
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Estado del Paciente<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="estado_paciente" id="estado_paciente" class="form-control">
                                        <option><?php echo $ESTADO_PACIENTE ?></option>
                                        <option value="">Seleccione...</option>
                                        <option>Nuevo Activo</option>
                                        <option>Nuevo Interrumpido</option>
                                        <option>Interumplido</option>
                                        <option>Activo</option>
                                        <option>Suspendido</option>
                                        <option>Drop out</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Nombres del responsable<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="nombres" type="text" id="nombres" max="10" readonly value="<?php echo $nombres_res; ?>" />
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Apellidos del responsable<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="apellidos" type="text" id="apellidos" max="10" readonly value="<?php echo $apellidos_res; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Tipo de identificacion<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="tipo_identificacion" type="text" id="tipo_identificacion" max="10" readonly value="<?php echo $tipo_identificacion; ?>" />
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Identificacion<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="identificacion" type="text" id="identificacion" max="10" readonly value="<?php echo $identificacion; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Telefono o Celular<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="telefono" type="text" id="telefono" max="10" readonly value="<?php echo $telefono; ?>" />
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Direccion del negocio<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="direccion" type="text" id="direccion" max="10" readonly value="<?php echo $direccion; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">¿Este número tiene WhatsApp?<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="whatsApp" id="whatsApp" style="display:none" value="" checked="checked" />
                                            <input class="form-check-input me-1" type="radio" name="whatsApp" id="whatsApp" value="SI" />SI
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="whatsApp" id="whatsApp" value="NO" />NO
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Número con WhatsApp<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="num_WhatsApp" type="text" id="num_WhatsApp" max="10">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingTwo">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            DETALLES
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">¿El negocio continúa funcionando?<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="negocio_funciona" id="negocio_funciona" style="display:none" value="" checked="checked" />
                                            <input class="form-check-input me-1" type="radio" name="negocio_funciona" id="negocio_funciona" value="SI" />SI
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="negocio_funciona" id="negocio_funciona" value="NO" />NO
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">¿Sigues siendo el propietario o administrador?<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="propietario" id="propietario" style="display:none" value="" checked="checked" />
                                            <input class="form-check-input me-1" type="radio" name="propietario" id="propietario" value="SI" />SI
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="propietario" id="propietario" value="NO" />NO
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3" id="fila_nuevo_responsable" style="display:none;">
                                <div class="col">
                                    <span class="fw-bold">Nombres del nuevo responsable<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="nombres_nuevo_pro" type="text" id="nombres_nuevo_pro" max="10">
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Apellidos del nuevo responsable<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="apellidos_nuevo_pro" type="text" id="apellidos_nuevo_pro" max="10">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">¿En que horario podenos realizar la visita?<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="horario_visita" type="time" id="horario_visita" max="10">
                                </div>
                                <div class="col">
                                    <span class="fw-bold">¿Qué día te queda más fácil recibir al asesor?<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="dia_visita" type="date" id="dia_visita" max="10">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">¿Te gustaría participar en este programa?<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="interes_programa" id="interes_programa" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="Muy interesado">Muy interesado</option>
                                        <option value="Interesado">Interesado</option>
                                        <option value="Indiferente">Indiferente</option>
                                        <option value="No interesado">No interesado</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">¿Qué podría impedir que realicemos la visita?<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="barrera" id="barrera" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="Poco tiempo">Poco tiempo</option>
                                        <option value="Desconfianza">Desconfianza</option>
                                        <option value="No uso WhatsApp">No uso WhatsApp</option>
                                        <option value="No manejo celular">No manejo celular</option>
                                        <option value="No soy el dueño">No soy el dueño</option>
                                        <option value="Ya participe">Ya participé</option>
                                        <option value="Vende a puerta cerrada">Vende a puerta cerrada</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Horario de apertura<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="hora_inicio" type="time" id="hora_inicio" max="10">
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Horario de cierre<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="hora_fin" type="time" id="hora_fin" max="10">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Que dias toma de descanso<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <textarea class="form-control" name="descanso" id="descanso" cols="30"></textarea>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Nivel de interés en el programa<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="nivel_interes" id="nivel_interes" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingThree">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            COMUNICACIONES
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php
                            $visitas = mysqli_query($conex, "SELECT * FROM `visitas` WHERE RESPONSABLE_ID = $id_responsable ORDER BY ID_VISITA DESC");
                            echo mysqli_error($conex);
                            ?>
                            <div class="table-container">
                                <table class="table">
                                    <tr style='border:1px solid gray'>
                                        <th class=AccordionPanelTab><strong>FECHA DE GESTION</strong></th>
                                        <td class=AccordionPanelTab><strong>DESCRIPCION</strong></td>
                                        <th class=AccordionPanelTab><strong>FECHA VISITA</strong></th>
                                        <th class=AccordionPanelTab><strong>BARRERA</strong></th>
                                        <th class=AccordionPanelTab><strong>NEGOCIO EN FUNCIONAMIENTO</strong></th>
                                        <td class=AccordionPanelTab><strong>INTERES EN EL PROGRAMA</strong></td>
                                        <td class=AccordionPanelTab><strong>HORARIOS DE ATENCION</strong></td>
                                    </tr>
                                    <?php
                                    while ($fila2 = mysqli_fetch_array($visitas)) {
                                    ?>
                                        <tr>
                                            <td style='border:1px solid gray'><?php echo $fila2['FECHA_REGISTRO'] ?></td>
                                            <td style='border:1px solid gray'>

                                                <textarea name="observaciones" cols="40" rows="2" readonly id="observaciones" class="letra" style="text-transform:uppercase"><?php echo $fila2['OBSERVACION']; ?></textarea>

                                            </td>
                                            <td style='border:1px solid gray'><?php echo $fila2['FECHA_VISITA'] ?></td>
                                            <td style='border:1px solid gray'><?php echo $fila2['BARRERA'] ?></td>
                                            <td style='border:1px solid gray'><?php echo $fila2['NEGOCIO_FUNCIONA'] ?></td>
                                            <td style='border:1px solid gray'><?php echo $fila2['INTERES_PROGRAMA'] ?></td>
                                            <td style='border:1px solid gray'><?php echo 'De ' . $fila2['HORA_INICIO'] . ' a ' . $fila2['HORA_FIN'] ?></td>
                                        <?php
                                    }
                                        ?>
                                        </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingFive">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                            NOTAS Y ADJUNTOS
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <textarea class="form-control" name="nota" id="nota" title="Escriba una Nota" placeholder="Escriba una Nota"></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar btn btn-modify bg-gradient text-white w-25" onClick="return validar(seguimiento,2)" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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