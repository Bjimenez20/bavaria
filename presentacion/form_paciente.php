<?php
header("Content-Type: text/html;charset=utf-8");
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
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
    <script>
        $(function() {
            $("#asegurador").select2();
        });
        $(function() {
            $("#operador_logistico").select2();
        });
        $(function() {
            $("#punto_entrega").select2();
        });
        $(function() {
            $("#ips_atiende").select2();
        });
        $(function() {
            $("#medico_prescriptor").select2();
        });
        $(function() {
            $("#medico_tratante").select2();
        });
    </script>
    <script language=javascript>
        function ventanaSecundaria(URL) {
            window.open(URL, "ventana1", "width=1650,height=500,Top=150,Left=50%")
        }
    </script>
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
            $("#ciudad_reclamacion").html('<img src="imgagenes/cargando.gif" />');
            $.ajax({
                url: '../presentacion/ciudades.php',
                data: {
                    dep: departamento,
                },
                type: 'post',
                beforeSend: function() {
                    $("#ciudad").html("Procesando, espere por favor" + '<img src="img/cargando.gif" />');
                    $("#ciudad_reclamacion").html("Procesando, espere por favor" + '<img src="img/cargando.gif" />');
                },
                success: function(data) {
                    $('#ciudad').html(data);
                    $('#ciudad_reclamacion').html(data);
                }
            })
        }

        function mostrar_consentimiento() {
            var ID_PACIENTE = $('#codigo_usuario2').val();
            var ID_GESTION_ULT = $('#codigo_gestion').val();
            var consentimiento = $('#consentimiento').val();
            $("#url_consentimiento").html('<img src="imgagenes/cargando.gif" />');
            $("#span_consentimiento").html('<img src="imgagenes/cargando.gif" />');
            $.ajax({
                url: '../presentacion/consentimiento.php',
                data: {
                    ID_PACIENTE: ID_PACIENTE,
                    ID_GESTION_ULT: ID_GESTION_ULT,
                },
                type: 'post',
                beforeSend: function() {
                    $("#url_consentimiento").html("Procesando, espere por favor" +
                        '<img src="img/cargando.gif" />');
                    $("#span_consentimiento").html("Procesando, espere por favor" +
                        '<img src="img/cargando.gif" />');
                    $("#url_consentimiento").css('display', 'none');
                    $('#span_consentimiento').css('display', 'none');
                },
                success: function(data) {
                    $('#url_consentimiento').html(data);
                    $('#span_consentimiento').html(data);
                    if (consentimiento == 'NO' || consentimiento == '' || consentimiento == 'Seleccione...') {
                        $("#url_consentimiento").css('display', 'none');
                        $("#url_span_consentimiento").css('display', 'none');
                        $('#span_consentimiento').css('display', 'none');
                    } else {
                        $("#url_consentimiento").css('display', 'block');
                        $("#url_span_consentimiento").css('display', 'block');
                        $('#span_consentimiento').css('display', 'block');
                    }
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

    <body class="body">
        <form id="seguimiento" name="seguimiento" method="post" action="../logica/actualizar_seguimiento.php" enctype="multipart/form-data" class="letra">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            LINEA DE TIEMPO PACIENTE
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php
                            $Seleccion_consentimiento = mysqli_query($conex, "SELECT * FROM `ipsen_pacientes` WHERE ID_PACIENTE = '" . $ID_PACIENTE . "'");
                            while ($fila = mysqli_fetch_array($Seleccion_consentimiento)) {
                                $CONSENTIMIENTO = $fila['CONSENTIMIENTO'];
                            }
                            $sel_ges = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' ORDER BY ID_GESTION DESC LIMIT 1");
                            while ($con_ges = mysqli_fetch_array($sel_ges)) {
                                $ID_GESTION_ULT = $con_ges['ID_GESTION'];
                                $FECHA_NO_RECLAMACION = $con_ges['FECHA_CITA_PROGRAMADA'];
                                $RECLAMO_GESTION = $con_ges['RECLAMO_GESTION'];
                                $CAUSA_NO_RECLAMACION_GESTION = $con_ges['CAUSA_NO_RECLAMACION_GESTION'];
                                $FECHA_MEDICAMENTO_HASTA = $con_ges['FECHA_MEDICAMENTO_HASTA'];
                                $FECHA_RECLAMACIONN = $con_ges['FECHA_RECLAMACION_GESTION'];
                                $FECHA_AUTORIZACION = $con_ges['FECHA_AUTORIZACION'];
                            }
                            $Seleccion_pa_tra = mysqli_query($conex, "SELECT * FROM `ipsen_pacientes` AS P
							INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
							WHERE ID_PACIENTE = '" . $ID_PACIENTE . "'");
                            while ($fila_pa_tra = mysqli_fetch_array($Seleccion_pa_tra)) {
                                $ID_PACIENTE2 = $fila_pa_tra['ID_PACIENTE'];
                                $ID_PA = $fila_pa_tra['ID_PACIENTE'];
                                $ID_PA_TRA = $fila_pa_tra['ID_PACIENTE_FK'];
                                $ESTADO_PACIENTE = $fila_pa_tra['ESTADO_PACIENTE'];
                                $FECHA_ACTIVACION_PACIENTE = $fila_pa_tra['FECHA_ACTIVACION_PACIENTE'];
                                $PROVEEDOR = $fila_pa_tra['PROVEEDOR'];
                                $NOMBRE_REFERENCIA = $fila_pa_tra['NOMBRE_REFERENCIA'];
                                $producto_tratamiento = $fila_pa_tra['PRODUCTO_TRATAMIENTO'];
                                $STATUS_PACIENTE = $fila_pa_tra['STATUS_PACIENTE'];
                                $PROVEEDOR = $fila_pa_tra['PROVEEDOR'];
                                $PRODUCTO_TRATAMIENTO = $fila_pa_tra['PRODUCTO_TRATAMIENTO'];
                                $DOSIS = $fila_pa_tra['DOSIS_TRATAMIENTO'];
                                $TRATAMIENTO_PREVIOS = $fila_pa_tra['TRATAMIENTO_PREVIO'];
                                $FRECUENCIA_MEDICAMENTO = $fila_pa_tra['FRECUENCIA_MEDICAMENTO'];
                                $VISI_INI_EFEC = $fila_pa_tra['VISI_INI_EFEC'];
                            }
                            $select_edu_linea = mysqli_query($conex, "SELECT * FROM `ipsen_educacion` WHERE ID_PACI_FK = '" . $ID_PACIENTE . "' ORDER BY ID_EDU DESC LIMIT 1");
                            while ($fila_edu = mysqli_fetch_array($select_edu_linea)) {
                                $TEMA_SI_EDU = $fila_edu['TEMA_SI_EDU'];
                                $FECHA_SI_EDU = $fila_edu['FECHA_SI_EDU'];
                            }
                            if ($CONSENTIMIENTO == 'SI') {
                            ?>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="alert alert-danger" role="alert">
                                            El paciente requiere ser re consentido, por favor copie el link del consentimiento para remitir al
                                            paciente <a href="#" onclick="mostrar_consentimiento()">Ver link</a>
                                            <tr>
                                                <td>
                                                    <span id="url_span_consentimiento" style="display: none;">Url Consentimiento <span class="asterisco">*</span></span>
                                                </td>
                                                <td colspan="3">
                                                    <span id="span_consentimiento" style="display: none;"></span>
                                                </td>
                                            </tr>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Codigo de Usuario <span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="codigo_usuario" type="text" id="codigo_usuario" max="10" readonly value="<?php echo 'PAP' . $ID_PACIENTE; ?>" />
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Estado del Paciente<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="estado_paciente" id="estado_paciente" class="form-control">
                                        <option><?php echo $ESTADO_PACIENTE ?></option>
                                        <option value="">Seleccione...</option>
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                        <option>Nuevo</option>
                                        <option>Suspendido</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <span class="fw-bold">Fecha de Activacion<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="date" name="fecha_activacion" id="fecha_activacion" value="<?php echo $FECHA_ACTIVACION_PACIENTE ?>" readonly>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Asignado para</span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" value="<?php echo $PROVEEDOR ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <span class="fw-bold">Consentimiento Informado</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $gestion_ci = mysqli_query($conex, "SELECT `ipsen_gestiones`.*, (SELECT CONCAT(ID, '/', NOMBRE_PACIENTE, '_', ID_PACIENTE_FK) FROM `ipsen_informacion_ci` WHERE `ipsen_informacion_ci`.`ID_GESTION_FK` = `ipsen_gestiones`.`ID_GESTION` AND EXISTS( SELECT * FROM `ipsen_pacientes` WHERE `ipsen_informacion_ci`.`ID_PACIENTE_FK` = `ipsen_pacientes`.`ID_PACIENTE`) LIMIT 1) AS file_pdf FROM `ipsen_gestiones` WHERE ID_PACIENTE_FK2 =$ID_PACIENTE2 ORDER BY FECHA_COMUNICACION DESC LIMIT 1");
                                        while ($fila_ci = mysqli_fetch_array($gestion_ci)) {
                                            $url = "http://localhost:8000/PDF_CI/{$fila_ci["file_pdf"]}.pdf";
                                            if ($fila_ci["file_pdf"] != '') {
                                        ?>
                                                <a class="highslide" onclick="javascript:ventanaSecundaria('<?php echo $url ?>')">
                                                    <img src="../presentacion/imagenes/pdf.png" alt="" title="Click to enlarge" height="100" width="100" style="margin-left: 15%;">
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="border border-danger" style="width: 60%; height: 50%;">
                                                    <p style="text-align: center;">Sin Consentimiento Informado</p>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <span class="fw-bold">Grabación llamada inicial</span>
                                        </div>
                                    </div>
                                    <div class="player-container">
                                        <?php
                                        // Directorio donde están los archivos MP3
                                        $directorio = '../Audios/' . $ID_PA_TRA . '/';
                                        if (file_exists($directorio)) {
                                            // Obtener lista de archivos MP3 en el directorio
                                            $archivos = glob($directorio . "*.mp3");
                                            foreach ($archivos as $archivo) {
                                                $nombreArchivo = basename($archivo);
                                                // Comprobar si el archivo existe
                                                if (file_exists($archivo)) {
                                        ?>
                                                    <audio id="audioPlayer" controls>
                                                        <source src="<?php echo $archivo ?>" type="audio/mpeg">
                                                        Tu navegador no soporta el elemento de audio.
                                                    </audio>
                                                <?php
                                                } else {
                                                ?>
                                                    <p class="error-message">El archivo MP3 no se encuentra disponible.</p>
                                            <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <p class="error-message">No cuenta con grabación de llamada inicial.</p>
                                        <?php
                                        }
                                        ?>

                                        <script>
                                            const audioPlayer = document.getElementById('audioPlayer');
                                            // Puedes añadir controles adicionales con JavaScript
                                            // audioPlayer.play(); // Reproducción automática
                                        </script>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <?php
                                            if ($RECLAMO_GESTION == 'SI') {
                                            ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="fw-bold">Fecha de ultima Reclamación</span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="date" class="form-control" value="<?php echo $FECHA_RECLAMACIONN ?>" readonly>
                                                    </div>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="fw-bold">Causa No Reclamación <span class="asterisco">*</span></span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" value="<?php echo $CAUSA_NO_RECLAMACION_GESTION ?>" readonly>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <h5>
                                        <span class="fw-bold">Educación Mes Actual</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">Tema</span>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" value="<?php echo $TEMA_SI_EDU ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">Fecha Educación</span>
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control" value="<?php echo $FECHA_SI_EDU ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingTwo">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            PACIENTE
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php
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
                                $FRECUENCIA_MEDICAMENTO = $fila['FRECUENCIA_MEDICAMENTO'];
                                $VISI_INI_EFEC = $fila['VISI_INI_EFEC'];
                                $PROGRA_VIS_EDU = $fila['PROGRA_VIS_EDU'];
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
                                <input type="text" style="display:none;" name="nombre_referencia" id="nombre_referencia" value="<?php echo $NOMBRE_REFERENCIA; ?>" readonly />
                                <input name="codigo_usuario2" type="text" id="codigo_usuario2" max="10" readonly value="<?php echo $fila['ID_PACIENTE']; ?>" style="display:none" />
                                <!-- <tr>
                                    <td width="20%">
                                        <span>Codigo de Usuario</span>
                                        <?php
                                        if ($fila['PRODUCTO_TRATAMIENTO'] == 'Xofigo 1x6 ml CO') {
                                        ?>
                                            <span>Codigo Xofigo</span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td width="30%">
                                        <?php
                                        if ($usua == 'bjimenez') {
                                        ?>
                                            <input name="codigo_gestion" type="text" id="codigo_gestion" max="10" readonly value="<?php echo $ID_GESTION_ULT; ?>" />
                                        <?php
                                        }
                                        ?>
                                        <input name="codigo_usuario" type="text" id="codigo_usuario" max="10" readonly value="<?php echo 'PAP' . $ID_PACIENTE; ?>" />
                                        <?php
                                        if ($fila['PRODUCTO_TRATAMIENTO'] == 'Xofigo 1x6 ml CO') {
                                        ?>
                                            <input name="codigo_xofigo" type="text" id="codigo_xofigo" max="10" readonly value="<?php echo 'X' . $fila['CODIGO_XOFIGO']; ?>" />
                                        <?php
                                        }
                                        ?>
                                        <input name="codigo_usuario2" type="text" id="codigo_usuario2" max="10" readonly value="<?php echo $fila['ID_PACIENTE']; ?>" style="display:none" />
                                    </td>
                                    <td width="20%">
                                        <span>Estado del Paciente<span class="asterisco">*</span></span>
                                    </td>
                                    <td width="30%">
                                        <select type="text" name="estado_paciente" id="estado_paciente">
                                            <option><?php echo $fila['ESTADO_PACIENTE']; ?></option>
                                            <option value="">Seleccione...</option>
                                            <option>Activo</option>
                                            <option>Inactivo</option>
                                            <option>Nuevo</option>
                                            <option>Suspendido</option>
                                        </select>
                                    </td>
                                </tr> -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Fecha de Retiro <span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="date" name="fecha_retiro" id="fecha_retiro" max="10" value="<?php echo $fila['FECHA_RETIRO_PACIENTE']; ?>">
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Motivo de Retiro <span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <select type="text" name="motivo_retiro" id="motivo_retiro" class="form-control">
                                            <option><?php echo $fila['MOTIVO_RETIRO_PACIENTE']; ?></option>
                                            <option value="">Seleccione...</option>
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
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Observaciones Motivo de Retiro <span class="asterisco">*</span></span>
                                        <textarea class="form-control" name="observacion_retiro" id="observacion_retiro" style="width:98%; height:100px"><?php echo $fila['OBSERVACION_MOTIVO_RETIRO_PACIENTE']; ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Nombre<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $fila['NOMBRE_PACIENTE']; ?>" readonly />
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Apellidos<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="text" name="apellidos" id="apellidos" value="<?php echo $fila['APELLIDO_PACIENTE']; ?>" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Tipo de identificacion<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <select name="tipo_identificacion" id="tipo_identificacion" class="form-control">
                                            <option><?php echo $fila['TIPO_IDENTIFICACION_PACIENTE'] ?></option>
                                            <option value="">Seleccione...</option>
                                            <option>R.C</option>
                                            <option>T.I</option>
                                            <option>C.C</option>
                                            <option>C.E</option>
                                            <option>P.T</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Identificacion<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="text" name="identificacion" id="identificacion" value="<?php echo $fila['IDENTIFICACION_PACIENTE']; ?>" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Telefono 1<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="number" name="telefono1" id="telefono1" value="<?php echo $fila['TELEFONO_PACIENTE']; ?>" />
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Telefono 2</span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="number" name="telefono2" id="telefono2" value="<?php echo $fila['TELEFONO2_PACIENTE']; ?>" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Telefono 3</span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="number" name="telefono3" id="telefono3" value="<?php echo $fila['TELEFONO3_PACIENTE']; ?>" />
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Telefono 4</span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="number" name="telefono4" id="telefono4" value="<?php echo $fila['TELEFONO4_PACIENTE']; ?>" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Telefono 5</span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="number" name="telefono5" id="telefono5" value="<?php echo $fila['TELEFONO5_PACIENTE']; ?>" />
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Correo Electronico</span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="text" name="correo" id="correo" value="<?php echo $fila['CORREO_PACIENTE']; ?>" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Departamento<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <select type="text" name="departamento" id="departamento" onchange="mostrar_ciudades()" class="form-control">
                                            <option><?php echo $fila['DEPARTAMENTO_PACIENTE']; ?></option>
                                            <option value="">Seleccione...</option>
                                            <?php
                                            $DEPT = $fila['DEPARTAMENTO_PACIENTE'];
                                            $Seleccionar = mysqli_query($conex, "SELECT nombre FROM `ipsen_departamento` WHERE nombre != '' AND nombre != '" . $DEPT . "' ORDER BY nombre ASC");
                                            while ($fila3 = mysqli_fetch_array($Seleccionar)) {
                                                $DEPARTAMENTO = $fila3['nombre'];
                                                echo "<option>" . $DEPARTAMENTO . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Ciudad<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <select type="text" name="ciudad" id="ciudad" class="form-control">
                                            <option><?php echo $fila['CIUDAD_PACIENTE']; ?></option>
                                            <option value="">Seleccione...</option>
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
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Barrio<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="text" name="barrio" id="barrio" value="<?php echo $fila['BARRIO_PACIENTE']; ?>" onkeypress="return check(event)" />
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Direccion<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" name="direccion_act" id="direccion_act" style="width:93%" value="<?php echo $fila['DIRECCION_PACIENTE']; ?>" readonly />
                                        <img src="imagenes/lapiz 100.png" id="cambio" name="cambio" title="Editar" style="width:4%; height:20px; margin-left:-10%;" align="right" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div id="cambio_direccion" style="display:none; border:#F00 1px solid;">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <span class="fw-bold">Direccion<span class="asterisco">*</span></span>
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" name="DIRECCION" id="DIRECCION" readonly class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <span class="fw-bold">Via:</span>
                                                </div>
                                                <div class="col">
                                                    <span>
                                                        <select id="VIA" name="VIA" class="form-control">
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
                                                </div>
                                                <div class="col">
                                                    <span class="fw-bold">Detalle via:</span>
                                                </div>
                                                <div class="col">
                                                    <span>
                                                        <input name="detalle_via" id="detalle_via" type="text" maxlength="30" class="form-control" />
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <span class="fw-bold">Numero:</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input name="numero" id="numero" type="text" maxlength="5" class="form-control" />
                                                        </div>
                                                        <div class="col">
                                                            <input name="numero2" id="numero2" type="text" maxlength="5" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <span class="fw-bold">Interior:</span>
                                                </div>
                                                <div class="col">
                                                    <span>
                                                        <select id="interior" name="interior" class="form-control">
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
                                                </div>
                                                <div class="col">
                                                    <span class="fw-bold">Detalle Interior:</span>
                                                </div>
                                                <div class="col">
                                                    <span>
                                                        <input name="detalle_int" id="detalle_int" type="text" maxlength="30" readonly class="form-control" />
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <span class="fw-bold">Interior:</span>
                                                </div>
                                                <div class="col">
                                                    <span>
                                                        <select id="interior2" name="interior2" class="form-control">
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
                                                </div>
                                                <div class="col">
                                                    <span class="fw-bold">Detalle Interior:</span>
                                                </div>
                                                <div class="col">
                                                    <span>
                                                        <input name="detalle_int2" id="detalle_int2" type="text" maxlength="30" readonly class="form-control" />
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <span class="fw-bold">Interior:</span>
                                                </div>
                                                <div class="col">
                                                    <span>
                                                        <select id="interior3" name="interior3" class="form-control">
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
                                                </div>
                                                <div class="col">
                                                    <span class="fw-bold">Detalle Interior:</span>
                                                </div>
                                                <div class="col">
                                                    <span>
                                                        <input name="detalle_int3" id="detalle_int3" type="text" maxlength="30" class="form-control" readonly />
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col" width="20%">
                                        <span class="fw-bold">Fecha de Nacimiento<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col" width="30%">
                                        <input class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $fila['FECHA_NACIMINETO_PACIENTE']; ?>" />
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Edad <span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="text" name="edad" id="edad" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Acudiente</span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="text" name="acudiente" id="acudiente" readonly value="<?php echo $fila['ACUDIENTE_PACIENTE'] ?>" />
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Telefono del Acudiente</span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="text" name="telefono_acudiente1" id="telefono_acudiente1" value="<?php echo $fila['TELEFONO_ACUDIENTE_PACIENTE'] ?>" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Clasificacion Patologica<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <span style="width:30%;">
                                            <input class="form-control" type="text" name="clasificacion_patologicas" id="clasificacion_patologicas" value="<?php echo $fila['CLASIFICACION_PATOLOGICA_TRATAMIENTO'] ?>" readonly>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold">Fecha Inicio Terapia<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="date" name="fecha_ini_terapia" id="fecha_ini_terapia" value="<?php echo $fila['FECHA_INICIO_TERAPIA_TRATAMIENTO'] ?>" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col" colspan="1">
                                        <input class="btn btn-modify w-100 text-white" type="button" name="historico" id="historico" title="Historico reclamacion" style="width:100%; height:50px" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_historico_reclamacion.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')" />
                                    </div>
                                    <div class="col" colspan="1">
                                        <input class="btn btn-modify w-100 text-white" type="button" name="pedidos" id="pedidos" title="Mis Pedidos" style="width:100%; height:50px" value="Mis Pedidos" onclick="javascript:ventanaSecundaria('form_productos_paciente.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')" />
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingThree">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            GENERAL
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
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
                                        $FECHA_RECLAMACION = $inf['FECHA_RECLAMACION'];
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
                            <?php
                                date_default_timezone_set("America/Bogota");
                                $d      = date('d');
                                $mes_nu = date('m');
                                $ano    = date('Y');
                                $ultima_causal1 = "";
                                $ultima_causal2 = "";
                                $ultima_fechaa2 = mysqli_query($conex, "SELECT A.CAUSAL_NO_VISITA AS BARRERA, DATE (A.FECHA_ULTIMO_REGISTRO) AS CONSULT, A.ID_PACIENTE_FK2, YEAR(A.FECHA_ULTIMO_REGISTRO) AS ANO, MONTH(A.FECHA_ULTIMO_REGISTRO) AS MES,DAY(A.FECHA_ULTIMO_REGISTRO) AS DIA FROM ipsen_conteo AS A WHERE ID_PACIENTE_FK2 ='" . $ID_PACIENTE2 . "' ORDER BY ID DESC LIMIT 1");
                                echo mysqli_error($conex);
                                $sqlrow = mysqli_num_rows($ultima_fechaa2);
                                while ($datos_fechas = (mysqli_fetch_array($ultima_fechaa2))) {
                                    $id_paciente_conteo = $datos_fechas['ID_PACIENTE_FK2'];
                                    $fecha_conteo_ANO = $datos_fechas['ANO'];
                                    $fecha_conteo_MES = $datos_fechas['MES'];
                                    $fecha_conteo_DIA = $datos_fechas['DIA'];
                                    $FECHA_CONSULT = $datos_fechas['CONSULT'];
                                    $ultima_causal = $datos_fechas['BARRERA'];
                                    $ultima_causal2 = "1";
                                }
                                if ($sqlrow >= 1) {
                                    $fecha1 = new DateTime("$ano-$mes_nu-$d");
                                    $fecha2 = new DateTime("$fecha_conteo_ANO-$fecha_conteo_MES-$fecha_conteo_DIA");
                                    $diff = $fecha1->diff($fecha2);
                                } elseif ($sqlrow <= 0) {
                                    $fecha1 = new DateTime("$ano-$mes_nu-$d");
                                    $fecha2 = new DateTime("$ano-$mes_nu-$d");
                                    $diff = $fecha1->diff($fecha2);
                                }
                            ?>
                            <tr>
                                <?php $formt = date('Y-m-d');
                                if ($resultadoso == 'Falta de Contacto' || $resultadoso == 'Paciente sin Acudiente' || $resultadoso == 'Direccion Errada' || $resultadoso == 'Paciente sin tiempo para atender Visita' || $resultadoso == 'Desconfianza') {
                                    $resultadoso2 = $resultadoso;
                                } else {
                                    $resultadoso;
                                    $resultadoso2 = "";
                                }
                                ?>
                            </tr>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Programacion visita de educacion</span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="date" id="progra_visi_ini" name="progra_visi_ini" value="<?php echo $PROGRA_VIS_EDU ?>">
                                </div>
                                <div class="col">
                                    <span class="fw-bold" id="span_causa_visita" style="display: none;">Causa No visitas<span class="asterisco">*</span></span>
                                    <span class="fw-bold" id="span_fecha_visita" style="display: none;">Fecha Visita Inicial<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select id="span_causa_visita1" style="display: none;" name="span_causa_visita1" class="form-control">
                                        <option value="<?php echo $resultadoso2; ?>"><?php echo $resultadoso2; ?></option>
                                        <option value="">Seleccione...</option>
                                        <option value="Falta de Contacto">Falta de Contacto</option>
                                        <option value="Paciente sin Acudiente">Paciente sin Acudiente</option>
                                        <option value="Direccion Errada">Direccion Errada</option>
                                        <option value="Paciente sin tiempo para atender Visita">Paciente sin tiempo para atender Visita</option>
                                        <option value="Desconfianza">Desconfianza</option>
                                    </select>
                                    <input class="form-control" style="display: none;" type="date" id="fecha_visita_ini" name="fecha_visita_ini" value="<?php echo $resultadoso; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">Visita inicial efectiva</span>
                                        </div>
                                        <div class="col">
                                            <select id="sel_visita_inicial" name="sel_visita_inicial" class="form-control">
                                                <?php
                                                if ($VISI_INI_EFEC != '') {
                                                ?>
                                                    <option value="<?php echo $VISI_INI_EFEC ?>"><?php echo $VISI_INI_EFEC ?></option>
                                                <?php
                                                }
                                                ?>
                                                <option value="">Seleccione...</option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                                <option value="PENDIENTE">PENDIENTE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $Sel = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' AND ID_GESTION = '" . $ID_GESTION_ULT . "' ORDER BY ID_GESTION DESC LIMIT 1");
                                while ($con = mysqli_fetch_array($Sel)) {
                                    $RECLAMOS = $con['RECLAMO_GESTION'];
                                    $CAUSA_NO_RECLAMACION_GESTIONES = $con['CAUSA_NO_RECLAMACION_GESTION'];
                                    $FECHA_RECLAMACION_GESTION = $con['FECHA_RECLAMACION_GESTION'];
                                    $FECHA_NO_RECLAMACION = $con['FECHA_CITA_PROGRAMADA'];
                                    $APLICACION = $con['APLICACION'];
                                    $FECHA_APLICACION = $con['FECHA_APLICACION'];
                                    $LUGAR_APLICACION = $con['LUGAR_APLICACION'];
                            ?>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span class="fw-bold">Reclamo<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <select type="text" name="reclamo" id="reclamo" class="form-control">
                                            <option><?php echo $RECLAMO_GESTION ?></option>
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold" id="causa" style="display:none">Causa No Reclamacion<span class="asterisco">*</span></span>
                                        <span class="fw-bold" id="fecha_reclamacion_span" style="display:none">Fecha de Reclamacion<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <select type="text" name="causa_no_reclamacion" id="causa_no_reclamacion" style="display:none" class="form-control">
                                            <option><?php echo $CAUSA_NO_RECLAMACION_GESTION ?></option>
                                            <option value="">Seleccione...</option>
                                            <option>Cita inoportuna</option>
                                            <option>Demora en la Autorizacion Cita Medica</option>
                                            <option>Demora en la autorizacion de medicamento</option>
                                            <option>Sin red Prestadora</option>
                                            <option>Inactivo</option>
                                            <option>Autorizacion radicada para Cita</option>
                                            <option>Autorizacion radicada para Medicamento</option>
                                            <option>En proceso de cita medica</option>
                                            <option>En proceso de entrega</option>
                                            <option>Falta cita para examenes</option>
                                            <option>Falta de cita medica</option>
                                            <option>Falta de contacto</option>
                                            <option>Falta de cita de aplicacion</option>
                                            <option>Pendiente Radicar Formula en Farmacia</option>
                                            <option>Desafiliacion Asegurador</option>
                                            <option>En proceso de Examenes</option>
                                            <option>Error en papeleria</option>
                                            <option>Falta de medicamento en el punto</option>
                                            <option>Hospitalizado</option>
                                            <option>Pendiente formulacion NO sistema</option>
                                            <option>Suspendido temporalmente</option>
                                            <option>Voluntario</option>
                                            <option>No Codificacion</option>
                                            <option>Cita inoportuna de Aplicacion</option>
                                            <option>Demora en la entrega del medicamento</option>
                                            <option>No acepta Servicios PSP</option>
                                            <option>Problemas de Translado del Paciente</option>
                                            <option>Suspendido por Cambio de tratamiento</option>
                                        </select>
                                        <input class="form-control" type="date" name="fecha_reclamacion" id="fecha_reclamacion" value="<?php echo $FECHA_RECLAMACION_GESTION ?>" style="display:none" />
                                    </div>
                                </div>
                                <div class="row bm-3">
                                    <div class="col">
                                        <span class="fw-bold" id="span_aplicacion_m" style="display: none;">Aplicación<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <select name="aplicacion_m" id="aplicacion_m" style="display: none;" class="form-control">
                                            <option><?php echo $APLICACION ?></option>
                                            <option value="">Seleccione...</option>
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold" id="span_fecha_aplicacion" style="display: none;">Fecha de la aplicación<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="date" name="fecha_aplicacion" id="fecha_aplicacion" value="<?php echo $FECHA_APLICACION ?>" style="display: none;">
                                    </div>
                                </div>
                                <div class="row bm-3">
                                    <div class="col">
                                        <span class="fw-bold" id="span_lugar_aplicacion" style="display: none;">Lugar de aplicación<span class="asterisco">*</span></span>
                                    </div>
                                    <div class="col">
                                        <select name="lugar_aplicacion" id="lugar_aplicacion" style="display: none;" class="form-control">
                                            <option><?php echo $LUGAR_APLICACION ?></option>
                                            <option value="">Seleccione...</option>
                                            <option value="IPS">IPS</option>
                                            <option value="DOMICILIO">DOMICILIO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col">
                                                <span class="fw-bold">Fecha Cita Programada<span class="asterisco">*</span></span>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="date" value="<?php echo $FECHA_NO_RECLAMACION ?>" name="fecha_cita_programada" id="fecha_cita_programada">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row mb-3">
                                <div class="col">
                                    <div id="asignado" style="display:none">
                                        <span>Asignado para</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div id="solicitud_cambio_proveedor_people" style="display:none">
                                        <input class="form-control" type="text" name="proveedor_people" id="proveedor_people" value='People Marketing' readonly>
                                    </div>
                                    <div id="solicitud_cambio_proveedor_psp" style="display:none">
                                        <input class="form-control" type="text" name="proveedor_psp" id="proveedor_psp" value='People Marketing' readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">Se brindo Educacion</span>
                                        </div>
                                        <div class="col">
                                            <select name="brindo_educacion" id="brindo_educacion" class="form-control">
                                                <?php $select_edu = mysqli_query($conex, "SELECT * FROM `bayer_educacion` WHERE `ID_PACI_FK` = '$ID_PACIENTE2' ORDER BY `FECHA_REGISTRO` DESC LIMIT 1");
                                                while ($dato = mysqli_fetch_array($select_edu)) {
                                                    $brindo_edu = $dato['SE_BRINDO_EDU'];
                                                    $temaBrindo = $dato['TEMA_SI_EDU'];
                                                    $fecha_brindo = $dato['FECHA_SI_EDU'];
                                                    $motivoNo = $dato['MOTIVO_NO_EDU'];
                                                }
                                                if ($brindo_edu == 'SI') {
                                                    echo '<option>' . $brindo_edu . '</option>' . '<option>NO</option>';
                                                } elseif ($brindo_edu == 'NO') {
                                                    echo '<option>' . $brindo_edu . '</option>' . '<option>SI</option>';
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div id="TemaSiEdu" <?php if ($brindo_edu == 'SI') {
                                                            echo 'style="display: block;"';
                                                        } elseif ($brindo_edu == 'NO') {
                                                            echo 'style="display: none;"';
                                                        } else {
                                                            echo 'style="display: none;"';
                                                        } ?>>
                                        <div class="row">
                                            <div class="col">
                                                <span class="fw-bold">Tema</span>
                                            </div>
                                            <div class="col">
                                                <select name="TemaBrindoEdu" id="TemaBrindoEdu" class="form-control">
                                                    <?php if ($brindo_edu == 'NO') {
                                                        echo '<option value="">Seleccione...</option>';
                                                    } elseif ($brindo_edu == 'SI') {
                                                        echo '<option>' . $temaBrindo . '</option>';
                                                    } else {
                                                        echo '<option value="">Seleccione...</option>';
                                                    } ?>
                                                    <option value="">Seleccione...</option>
                                                    <option>Concientizacion de la enfermedad</option>
                                                    <option>Mitos y realidades</option>
                                                    <option>Autocuidado</option>
                                                    <option>Higiene del sueño</option>
                                                    <option>Manejo del tiempo libre</option>
                                                    <option>Estrategias para mejorar la memoria</option>
                                                    <option>La actividad fisica</option>
                                                    <option>Tips para una comunicacion asertiva</option>
                                                    <option>El descanso</option>
                                                    <option>Receta saludable</option>
                                                    <option>Manejo emocional</option>
                                                    <option>Autoestima</option>
                                                    <option>Cuidando al cuidador</option>
                                                    <option>11 Recomendaciones para afrontar una emergencia</option>
                                                    <option>Alimentacion consciente</option>
                                                    <option>Inteligencia financiera</option>
                                                    <option>Inteligencia emocional</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="FechaSiEdu" <?php if ($brindo_edu == 'SI') {
                                                                echo 'style="display: block;"';
                                                            } elseif ($brindo_edu == 'NO') {
                                                                echo 'style="display: none;"';
                                                            } else {
                                                                echo 'style="display: none;"';
                                                            } ?>>
                                        <div class="row">
                                            <div class="col">
                                                <span class="fw-bold">Fecha Educacion</span>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="date" name="FechaEduca" id="FechaEduca" value="<?php echo $fecha_brindo; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="motivo_no" <?php if ($brindo_edu == 'NO') {
                                                            echo 'style="display: block;"';
                                                        } elseif ($brindo_edu == 'SI') {
                                                            echo 'style="display: none;"';
                                                        } else {
                                                            echo 'style="display: none;"';
                                                        } ?>>
                                        <div class="row">
                                            <div class="col">
                                                <span class="fw-bold">Motivo</span>
                                            </div>
                                            <div class="col">
                                                <select class="form-control" name="MotivoNoEdu" id="MotivoNoEdu">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <span style=" display:none" id="consecutivo_betaferon_span">Consecutivo Betaferon<span class="asterisco">*</span></span>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="consecutivo_betaferon" id="consecutivo_betaferon" style=" display:none" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div style="display:none" id="span_apoyo">
                                        <span class="fw-bold">Se brindo apoyo<span class="asterisco">*</span></span>
                                    </div>
                                    <div style="display:none" id="span_aplicacion">
                                        <span class="fw-bold">Agregar informacion aplicaciones<span class="asterisco">*</span></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="display:none; width:100%" id="div_apoyo">
                                        <select type="text" name="brindo_apoyo" id="brindo_apoyo" class="form-control">
                                            <option value="">Seleccione...</option>
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                        <input type="button" name="ver_apoyo" id="ver_apoyo" title="Ver apoyo" style=" visibility:hidden" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_brindar_apoyo.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>&xxxx=<?php echo base64_encode($fila['PRODUCTO_TRATAMIENTO']) ?>')" class="btn_ver" />
                                    </div>
                                    <div style="display:none; width:100%" id="div_aplicaciones">
                                        <select type="text" name="aplicaicones" id="aplicaicones" class="form-control">
                                            <option value="">Seleccione...</option>
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                        <input type="button" name="ver_aplicaciones" id="ver_aplicaciones" title="Ver aplicaciones" style=" visibility:hidden" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_aplicaciones_eylia.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>&xxxx=<?php echo base64_encode($fila['PRODUCTO_TRATAMIENTO']) ?>')" class="btn_ver" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="display:none" id="span_tabletas_diarias">
                                        <span class="fw-bold">Numero Tabletas Diarias</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="display:none; width:100%;" id="div_tabletas_diarias">
                                        <input class="form-control" value="0" type="text" name="numero_tabletas_diarias" id="numero_tabletas_diarias" placeholder="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">Medicamento Hasta<span class="asterisco">*</span></span>
                                        </div>
                                        <div class="col">
                                            <input class="form-control" type="date" name="fecha_medicamento_hasta" id="fecha_medicamento_hasta" value="<?php echo $FECHA_MEDICAMENTO_HASTA; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Se Logro la Comunicacion<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="logro_comunicacion" id="logro_comunicacion" style="display:none" value="" checked="checked" />
                                            <input class="form-check-input me-1" type="radio" name="logro_comunicacion" id="logro_comunicacion" value="SI" />SI
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="logro_comunicacion" id="logro_comunicacion" value="NO" />NO
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Motivo de Comunicacion<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="motivo_comunicacion" id="motivo_comunicacion" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option>Apoyo Emocional</option>
                                        <option>Educacion Mes Actual</option>
                                        <option>Educacion Patologica</option>
                                        <option>Educacion sistema de Salud</option>
                                        <option>Egreso</option>
                                        <option>Gestion Barreras</option>
                                        <option>Grupo de Apoyo</option>
                                        <option>Ingreso</option>
                                        <option>Reclamo</option>
                                        <option>Titulacion</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Medio de Contacto<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="medio_contacto" id="medio_contacto" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option>Electronico</option>
                                        <option>Telefonico</option>
                                        <option>Visita</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Tipo de Llamada<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="tipo_llamada" id="tipo_llamada" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option>Entrada</option>
                                        <option>Salida</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Motivo de No Comunicacion</span>
                                </div>
                                <div class="col">
                                    <select type="text" name="motivo_no_comunicacion" id="motivo_no_comunicacion" class="form-control">
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
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Numero de Intentos<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="number" name="via_recepcion" id="via_recepcion">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Asegurador<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select id="asegurador" name="asegurador" style="width:95%;" onchange="trat_previo1(this)" class="form-control">
                                        <option value="<?php echo $fila['ASEGURADOR_TRATAMIENTO'] ?>"><?php echo $fila['ASEGURADOR_TRATAMIENTO'] ?></option>
                                        <?php $query =  mysqli_query($conex, "SELECT DISTINCT ASEGURADOR FROM ipsen_asegurador WHERE ESTADO != 'OUT' ORDER BY ASEGURADOR ASC");
                                        while ($valores = mysqli_fetch_array($query)) {
                                        ?>
                                            <option><?php echo $valores['ASEGURADOR'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Ips que Atiende<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select name="ips_atiende" id="ips_atiende" style="width:95%;" onchange="trat_previo3(this)" class="form-control">
                                        <option value="<?php echo $fila['IPS_ATIENDE_TRATAMIENTO'] ?>"><?php echo $fila['IPS_ATIENDE_TRATAMIENTO'] ?></option>
                                        <?php $query =  mysqli_query($conex, "SELECT DISTINCT IPS FROM ipsen_ips WHERE ESTADO != 'OUT' ORDER BY IPS ASC");
                                        while ($valores = mysqli_fetch_array($query)) {
                                        ?>
                                            <option><?php echo $valores['IPS'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col" id="otro_asegurador" style="display:none">
                                    <span class="fw-bold">Asegurador por habilitar<span class="asterisco">*</span></span>
                                    <input name="asegurador_otro" id="asegurador_otro" type="text" class="form-control" />
                                </div>
                                <div class="col" id="otro_ips" style="display:none">
                                    <span class="fw-bold">Ips por habilitar<span class="asterisco">*</span></span>
                                    <input name="ips_otro" id="ips_otro" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Medico Tratante<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select name="medico_tratante" id="medico_tratante" style="width:95%;" onchange="trat_previo4(this)" class="form-control">
                                        <option value="<?php echo $fila['MEDICO_TRATAMIENTO'] ?>"><?php echo $fila['MEDICO_TRATAMIENTO'] ?></option>
                                        <?php $query =  mysqli_query($conex, "SELECT DISTINCT MEDICO FROM ipsen_listas WHERE ESTADO != 'OUT' ORDER BY MEDICO ASC");
                                        while ($valores = mysqli_fetch_array($query)) {
                                        ?>
                                            <option><?php echo $valores['MEDICO'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Medico Prescriptor<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select name="medico_prescriptor" id="medico_prescriptor" style="width:95%;" onchange="trat_previo5(this)" class="form-control">
                                        <option value="<?php echo $fila['MEDICO_PRESCRIPTOR'] ?>"><?php echo $fila['MEDICO_PRESCRIPTOR'] ?></option>
                                        <option value="">Seleccione...</option>
                                        <?php $query =  mysqli_query($conex, "SELECT DISTINCT MEDICO FROM ipsen_listas WHERE ESTADO != 'OUT' ORDER BY MEDICO ASC");
                                        while ($valores = mysqli_fetch_array($query)) {
                                        ?>
                                            <option><?php echo $valores['MEDICO'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col" id="otro_medico_t" style="display:none">
                                    <span class="fw-bold">Medico Tratante por habilitar<span class="asterisco">*</span></span>
                                    <input name="medico_t_otro" id="medico_t_otro" type="text" class="form-control" />
                                </div>
                                <div class="col" id="otro_medico_p" style="display:none">
                                    <span class="fw-bold">Medico Prescriptor por habilitar<span class="asterisco">*</span></span>
                                    <input name="medico_p_otro" id="medico_p_otro" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Fecha Prescripcion<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="date" name="fecha_prescripcion" id="fecha_prescripcion" value="<?php echo $fila['FECHA_PRESCRIPCION'] ?>">
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Operador Logistico<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select id="operador_logistico" name="operador_logistico" style="width:95%;" onchange="trat_previo2(this)" class="form-control">
                                        <option value="<?php echo $fila['OPERADOR_LOGISTICO_TRATAMIENTO'] ?>"><?php echo $fila['OPERADOR_LOGISTICO_TRATAMIENTO'] ?></option>
                                        <?php $query =  mysqli_query($conex, "SELECT DISTINCT OPERADOR_LOGISTICO FROM ipsen_operador_logistico WHERE ESTADO != 'OUT' ORDER BY OPERADOR_LOGISTICO ASC");
                                        while ($valores = mysqli_fetch_array($query)) {
                                        ?>
                                            <option><?php echo $valores['OPERADOR_LOGISTICO'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6" id="otro_operador" style="display:none">
                                    <span class="fw-bold">Operador logistico por habilitar<span class="asterisco">*</span></span>
                                    <input name="operador_otro" id="operador_otro" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Ciudad de Entrega</span><span class="asterisco">*</span>
                                </div>
                                <div class="col">
                                    <select type="text" name="ciudad_reclamacion" id="ciudad_reclamacion" class="form-control">
                                        <option><?php echo $fila['CIUDAD_RECLAMACION']; ?></option>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        $Seleccion = mysqli_query($conex, "SELECT DISTINCT nombre FROM ipsen_ciudad ");
                                        while ($fila_ciudad = mysqli_fetch_array($Seleccion)) {
                                        ?>
                                            <option><?php echo $fila_ciudad['nombre'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Punto De Entrega</span>
                                </div>
                                <div class="col">
                                    <select name="punto_entrega" id="punto_entrega" style="width:95%;" onchange="trat_previo6(this)" class="form-control">
                                        <option value="<?php echo $fila['PUNTO_ENTREGA'] ?>"><?php echo $fila['PUNTO_ENTREGA'] ?></option>
                                        <?php $query =  mysqli_query($conex, "SELECT DISTINCT NOMBRE_PUNTO FROM ipsen_puntos_entrega WHERE ESTADO != 'OUT' ORDER BY NOMBRE_PUNTO ASC");
                                        while ($valores = mysqli_fetch_array($query)) {
                                        ?>
                                            <option><?php echo $valores['NOMBRE_PUNTO'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6" id="otro_punto" style="display:none">
                                    <span class="fw-bold">Punto de entrega por habilitar<span class="asterisco">*</span></span>
                                    <input name="punto_entrega_otro" id="punto_entrega_otro" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Numero de Autorizacion<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="estado_ctc" id="estado_ctc" class="form-control">
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
                                        <option>2Da Entrega de 12 Autorizadas</option>
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
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Fecha de Autorizacion<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="fecha_autorizacion" id="fecha_autorizacion" type="date" style="margin-top: 10px;" value="<?php echo $FECHA_AUTORIZACION ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Estado Farmacia</span>
                                </div>
                                <div class="col">
                                    <select type="text" name="estado_farmacia" id="estado_farmacia" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option>Aprobado</option>
                                        <option>Pendiente Radicar</option>
                                        <option>Radicado</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Dificultad en el Acceso</span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="dificultad_acceso" id="dificultad_acceso" value="SI" />SI
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="dificultad_acceso" id="dificultad_acceso" value="NO" />NO
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Tipo de Dificultad</span>
                                    <textarea class="form-control" style="width:98%; height:72.5px;" id="tipo_dificultad" name="tipo_dificultad"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Autor</span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" name="autor" id="autor" readonly value="<?php echo $usua ?>">
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Genera Solicitud<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="genera_solicitud" id="genera_solicitud" style="display:none" value="" checked="checked" />
                                            <input class="form-check-input me-1" type="radio" name="genera_solicitud" id="genera_solicitud" value="SI" />SI
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="genera_solicitud" id="genera_solicitud" value="NO" />NO
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Evento Adverso<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="evento_adverso" id="evento_adverso" style="display:none" value="" checked="checked" />
                                            <input class="form-check-input me-1" type="radio" name="evento_adverso" id="evento_adverso" value="SI" />SI
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="evento_adverso" id="evento_adverso" value="NO" />NO
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="fw-bold" id="envio_evento_adverso_span" style="display:none">Tipo de Evento<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col" id="envio_evento_adverso_div" style="display:none">
                                            <div class="col">
                                                <input class="form-check-input me-1" type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style="display:none" value="" checked="checked" />
                                                <input class="form-check-input me-1" type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" value="Farmacovigilancia" />Farmacovigilancia
                                            </div>
                                            <div class="col">
                                                <input class="form-check-input me-1" type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" value="Tecnovigilancia" />Tecnovigilancia
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col" id="farmacovigilancia" style="display:none">
                                        <input type="button" name="tipo_evento_adverso2" id="tipo_evento_adverso2" style="background-image:url(imagenes/agregar.png); background-repeat:no-repeat;  width:41px; height:38px; border:1px solid transparent; background-color:transparent" onclick="javascript:ventanaSecundaria('new_form_evento_adverso.php?xnfgti=<?php echo base64_encode($ID_PACIENTE) ?>>&artget=<?php echo base64_encode($ID_GESTION); ?>')" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Fecha de la Proxima Llamada<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="date" name="fecha_proxima_llamada" id="fecha_proxima_llamada" min="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Motivo de Proxima Llamada<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <select type="text" name="motivo_proxima_llamada" id="motivo_proxima_llamada" class="form-control">
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
                                        <option>Reclamo</option>
                                        <option>Seguimiento</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Observaciones Proxima Llamada</span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" name="observacion_proxima_llamada" id="observacion_proxima_llamada" onkeypress="return check(event)" />
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Consecutivo</span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" name="consecutivo" id="consecutivo" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Numero cajas/ Unidades</span>
                                </div>
                                <div class="col">
                                    <select name="numero_cajas" id="numero_cajas" class="form-control">
                                        <option value="">Seleccione...</option>
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
                                    <select name="tipo_numero_cajas" id="tipo_numero_cajas" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option>Ampolla(s)</option>
                                        <option>Aplicacion</option>
                                        <option>Caja(s)</option>
                                        <option>Inyeccion pre llenada</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <div style="display:none" id="span_nebulizaciones">
                                        <span class="fw-bold">Numero Nebulizaciones</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="display:none" id="div_nebulizaciones">
                                        <input class="form-control" type="text" name="nebulizaciones" id="nebulizaciones" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">Tratamiento Previo</span>
                                        </div>
                                        <div class="col">
                                            <select type="text" name="tratamiento_previo" id="tratamiento_previo" onchange="trat_previo(this)" class="form-control">
                                                <option><?php echo $TRATAMIENTO_PREVIOS ?></option>
                                                <option value="">Seleccione...</option>
                                                <?php
                                                $Seleccion = mysqli_query($conex, "SELECT DISTINCT TRATAMIENTO_PREVIO FROM `ipsen_listas` WHERE TRATAMIENTO_PREVIO != '' AND TRATAMIENTO_PREVIO!='" . $tratamiento_previo . "' ORDER BY TRATAMIENTO_PREVIO ASC");
                                                while ($fila_trt = mysqli_fetch_array($Seleccion)) {
                                                    $TRATAMIENTO_PREVIO = $fila_trt['TRATAMIENTO_PREVIO'];
                                                    echo "<option>" . $TRATAMIENTO_PREVIO . "</option>";
                                                }
                                                ?>
                                                <option>Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" id="otro_tratamiento" style="display:none">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">Cual?</span>
                                        </div>
                                        <div class="col">
                                            <input class="form-control" name="tratamiento_previo_otro" id="tratamiento_previo_otro" type="text" onkeypress="return check(event)" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Medicamento</span>
                                </div>
                                <div class="col">
                                    <input class="form-control" style="text-transform:capitalize;" type="text" readonly name="MEDICAMENTO" id="MEDICAMENTO" value="<?php echo $PRODUCTO_TRATAMIENTO ?>" />
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Dosis Tratamiento<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" style="text-transform:capitalize;" type="text" name="dosis_actual" id="dosis_actual" value="<?php echo $DOSIS ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">Cambiar dosis<span class="asterisco">*</span></span>
                                        </div>
                                        <div class="col">
                                            <select name="cambio_dosis" id="cambio_dosis" class="form-control" class="form-control">
                                                <option value="">Seleccione...</option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold" style="display:none;" id="nueva_dosis">Nueva dosis tratamiento<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <?php
                                    $dosis_bd = $fila['DOSIS_TRATAMIENTO'];
                                    if ($producto_tratamiento == 'ADEMPAS 1MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2.5MG 84TABL' || $producto_tratamiento == 'ADEMPAS 1.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 0.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2MG 42TABL' || $producto_tratamiento == 'ADEMPAS') {
                                        $producto_tratamiento = 'ADEMPAS';
                                    }
                                    if ($producto_tratamiento == 'KOGENATE FS 2000 PLAN') {
                                    ?>
                                        <input class="form-control" type="text" maxlength="6" name="Dosis3" id="Dosis3" onKeyDown="return validarNumeros(event)" style="display:none;">
                                    <?PHP
                                    }
                                    if ($producto_tratamiento == 'Xofigo 1x6 ml CO') {
                                    ?>
                                        <input class="form-control" style="text-transform:capitalize; display:none;" type="text" name="Dosis2" id="Dosis2">
                                    <?PHP
                                    }
                                    if ($producto_tratamiento == 'Kovaltry') {
                                    ?>
                                        <input class="form-control" style="text-transform:capitalize; display:none;" type="text" name="Dosis2" id="Dosis2">
                                    <?PHP
                                    }
                                    if ($producto_tratamiento == 'Jivi') {
                                    ?>
                                        <input class="form-control" style="text-transform:capitalize; display:none;" type="text" name="Dosis2" id="Dosis2">
                                    <?php
                                    }
                                    if ($producto_tratamiento != 'Xofigo 1x6 ml CO' && $producto_tratamiento != 'KOGENATE FS 2000 PLAN' && $producto_tratamiento != 'Kovaltry' && $producto_tratamiento != 'Jivi') {
                                    ?>
                                        <select name="Dosis" id="Dosis" style="display:none;" class="form-control">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            $producto = $fila['PRODUCTO_TRATAMIENTO'];
                                            $select = mysqli_query($conex, "SELECT DOSIS FROM ipsen_dosis WHERE NOMBRE_REFERENCIA LIKE '" . $producto_tratamiento . "%' AND DOSIS!='" . $dosis_bd . "'");
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
                                </div>
                                <div class="col">
                                    <span class="fw-bold" id="fecha_cambio" style="display:none;">Fecha cambio de dosis<span class="asterisco">*</span></span>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="date" name="fecha_cambio_dosis" id="fecha_cambio_dosis" style="display:none;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">Frecuencia de administración del medicamento<span class="asterisco">*</span></span>
                                        </div>
                                        <div class="col">
                                            <select name="frecuencia" id="frecuencia" class="form-control">
                                                <option value="<?php echo $FRECUENCIA_MEDICAMENTO ?>"><?php echo $FRECUENCIA_MEDICAMENTO ?></option>
                                                <option value="">Seleccione...</option>
                                                <option value="1 TABLETA CADA 12 HORAS">1 TABLETA CADA 12 HORAS</option>
                                                <option value="1 TABLETA CADA 24 HORAS">1 TABLETA CADA 24 HORAS</option>
                                                <option value="2 TABLETAS CADA 24 HORAS">2 TABLETAS CADA 24 HORAS</option>
                                                <option value="CADA 15 DIAS">CADA 15 DIAS</option>
                                                <option value="CADA 20 DIAS">CADA 20 DIAS</option>
                                                <option value="CADA 21 DIAS">CADA 21 DIAS</option>
                                                <option value="CADA 24 DIAS">CADA 24 DIAS</option>
                                                <option value="CADA 28 DIAS">CADA 28 DIAS</option>
                                                <option value="CADA 30 DIAS">CADA 30 DIAS</option>
                                                <option value="CADA 30 DIAS">CADA 40 DIAS</option>
                                                <option value="CADA 42 DIAS">CADA 42 DIAS</option>
                                                <option value="CADA 45 DIAS">CADA 45 DIAS</option>
                                                <option value="CADA 60 DIAS">CADA 60 DIAS</option>
                                                <option value="CADA 90 DIAS">CADA 90 DIAS</option>
                                                <option value="POR CONFIRMAR">POR CONFIRMAR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="fw-bold">Envios</span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="envios" id="envios" value="SI" />SI
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input me-1" type="radio" name="envios" id="envios" value="NO" />NO
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">Tipo de Envio</span>
                                </div>
                                <div class="col">
                                    <select name="tipo_envio" id="tipo_envio" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php
                                        while ($opcion = mysqli_fetch_array($listado_envio)) {
                                        ?>
                                            <option value="<?php echo $opcion['ID_REFERENCIA'] ?>"><?php echo $opcion['MATERIAL'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <select name="nombre_producto" id="nombre_producto" style="display:none" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div id="div_agregar" style="visibility:hidden">
                                    <input type="submit" name="agregar_seg" id="agregar_seg" formaction="form_productos_envio.php" formtarget="registro_productos_form" style="background-image:url(imagenes/agregar.png); background-repeat:no-repeat;  width:41px; height:38px; border:1px solid transparent; background-color:transparent" value="" />
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        <div class="row mb-3">
                            <div class="col" id="div_material_agregar" style="width:50%; margin:auto auto; display:none">
                                <iframe name="registro_productos_form" style="width:100%; height:250px; border:1px solid #000;" scrolling="auto"></iframe>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <span class="fw-bold">Descripcion de Comunicacion<span class="asterisco">*</span></span>
                                <textarea class="form-control" id="descripcion_comunicacion" name="descripcion_comunicacion"></textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingFour">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            COMUNICACIONES
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?PHP
                            $gestion = mysqli_query($conex, "SELECT `ipsen_gestiones`.*, (SELECT CONCAT(ID, '/', NOMBRE_PACIENTE, '_', ID_PACIENTE_FK) FROM `ipsen_informacion_ci` WHERE `ipsen_informacion_ci`.`ID_GESTION_FK` = `ipsen_gestiones`.`ID_GESTION` AND EXISTS( SELECT * FROM `ipsen_pacientes` WHERE `ipsen_informacion_ci`.`ID_PACIENTE_FK` = `ipsen_pacientes`.`ID_PACIENTE`) LIMIT 1) AS file_pdf FROM `ipsen_gestiones` WHERE ID_PACIENTE_FK2 =$ID_PACIENTE2 ORDER BY FECHA_COMUNICACION DESC");
                            echo mysqli_error($conex);
                            ?>
                            <div class="table-container">
                                <table class="table">
                                    <tr style='border:1px solid gray'>
                                        <th class=AccordionPanelTab><strong>FECHA DE GESTION</strong></th>
                                        <th class=AccordionPanelTab><strong>DESCRIPCION</strong></th>
                                        <th class=AccordionPanelTab><strong>FECHA PROXIMO CONTACTO</strong></th>
                                        <th class=AccordionPanelTab><strong>AUTOR</strong></th>
                                        <th class=AccordionPanelTab><strong>MOTIVO COMUNICACION GESTION</strong></th>
                                        <td class=AccordionPanelTab><strong>CODIGO EA</strong></td>
                                        <td class=AccordionPanelTab><strong>ARCHIVO ADJUNTO</strong></td>
                                        <td class=AccordionPanelTab><strong>CONSENTIMIENTO INFORMADO</strong></td>
                                    </tr>
                                    <?php
                                    $numges = 1;
                                    while ($fila2 = mysqli_fetch_array($gestion)) {
                                        echo "<tr>";
                                        echo "<td style='border:1px solid gray'>" . $fila2['FECHA_COMUNICACION'] . "</td>";
                                        echo "<td style='border:1px solid gray'>";
                                    ?>
                                        <textarea name="observaciones" cols="60" rows="2" readonly id="observaciones" class="letra" style="text-transform:uppercase"><?php echo $fila2['DESCRIPCION_COMUNICACION_GESTION']; ?></textarea>
                                        <?PHP
                                        echo "</td>";
                                        echo "<td style='border:1px solid gray'>" . $fila2['FECHA_PROGRAMADA_GESTION'] . "</td>";
                                        echo "<td style='border:1px solid gray'>" . $fila2['AUTOR_GESTION'] . "</td>";
                                        echo "<td style='border:1px solid gray'>" . $fila2['MOTIVO_COMUNICACION_GESTION'] . "</td>";
                                        if ($privilegios == '1') {
                                            $evento = $fila2['EVENTO_ADVERSO_GESTION'];
                                            if ($evento == 'SI' || $evento == 'Si') {
                                        ?>
                                                <td style='border:1px solid gray'>
                                                    <input name="CODIGO_ARGUS" id="CODIGO_ARGUS" type="text" maxlength="25" style="width:80%" value="<?php echo $fila2['CODIGO_ARGUS']; ?>" readonly />
                                                    <a class="btn_gestiones" href="javascript:ventanaSecundaria('../presentacion/codigo_ar.php?xx=<?php echo base64_encode($fila2['ID_GESTION']) ?>&xxp=<?php echo base64_encode($ID_PACIENTE) ?>')"><img src="imagenes/CHULO.png" width="17%" height="25px" title="Agregar Codigo" align="right" /> </a>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td style='border:1px solid gray'>
                                                </td>
                                            <?php
                                            }
                                        } else if ($privilegios == '2') {
                                            $evento = $fila2['EVENTO_ADVERSO_GESTION'];
                                            if ($evento == 'SI' || $evento == 'Si') {
                                            ?>
                                                <td style='border:1px solid gray'>
                                                    <input name="CODIGO_ARGUS" id="CODIGO_ARGUS" type="text" maxlength="25" style="width:80%" value="<?php echo $fila2['CODIGO_ARGUS']; ?>" readonly />
                                                    <a class="btn_gestiones" href="javascript:ventanaSecundaria('../presentacion/codigo_ar.php?xx=<?php echo base64_encode($fila2['ID_GESTION']) ?>&xxp=<?php echo base64_encode($ID_PACIENTE) ?>')"><img src="imagenes/CHULO.png" width="17%" height="25px" title="Agregar Codigo" align="right" /> </a>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td style='border:1px solid gray'>
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
                                                    <td style='border:1px solid gray'>
                                                        <a class="highslide" onclick="javascript:ventanaSecundaria('<?php echo $enlace ?>')">
                                                            <img src="../presentacion/imagenes/archivo.png" alt="" title="Click to enlarge" height="100" width="100">
                                                        </a>
                                                    </td>
                                            <?php
                                                }
                                            }
                                            closedir($directorio);
                                        } else {
                                            ?>
                                            <td style='border:1px solid gray'>
                                            </td>
                                        <?php
                                        }
                                        $url = "https://pspipsen.com/PDF_CI/{$fila2["file_pdf"]}.pdf";
                                        if ($fila2["file_pdf"] != '') {
                                        ?>
                                            <td style='border:1px solid gray'>
                                                <a class="highslide" onclick="javascript:ventanaSecundaria('<?php echo $url ?>')">
                                                    <img src="../presentacion/imagenes/pdf.png" alt="" title="Click to enlarge" height="100" width="100">
                                                </a>
                                            </td>
                                        <?php
                                        } else {
                                        ?>
                                            <td style='border:1px solid gray'>
                                            </td>
                                    <?php
                                        }
                                        echo "</tr>";
                                        $numges = $numges + 1;
                                    }
                                    ?>
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
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <span class="fw-bold">¿El paciente requiere ser re consentido?<span class="asterisco">*</span></span>
                                        </div>
                                        <div class="col">
                                            <select name="consentimiento_informado" id="consentimiento_informado" class="form-control">
                                                <option value=""></option>
                                                <option value="">Seleccione...</option>
                                                <option value="SI">Si, enviar el link al paciente</option>
                                                <option value="NO">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <textarea class="form-control" name="nota" id="nota" title="Escriba una Nota" placeholder="Escriba una Nota"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="custom-input-file col-md-6 col-sm-6 col-xs-6">
                                        <input type="file" name="archivo" id="archivo" class="form-control" accept="application/pdf" onchange="validateFileType()">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <span>Tipo de documento</span>
                                    <ul>
                                        <li><input type="radio" name="tipo_doc" id="tipo_doc" style="width: 2%;" value="Consentimiento Informado">Consentimiento Informado</li>
                                        <li><input type="radio" name="tipo_doc" id="tipo_doc" style="width: 2%;" value="Voucher">Voucher</li>
                                        <li><input type="radio" name="tipo_doc" id="tipo_doc" style="width: 2%;" value="Acta de entrega Dispositivos">Acta de entrega Dispositivos</li>
                                        <li><input type="radio" name="tipo_doc" id="tipo_doc" style="width: 2%;" value="Grabacion Llamada">Grabacion Llamada</li>
                                    </ul>
                                </div>
                            </div>
                            <script>
                                function validateFileType() {
                                    var fileInput = document.getElementById('archivo');
                                    var filePath = fileInput.value;
                                    var allowedExtensions = /(\.pdf)$/i;
                                    if (!allowedExtensions.exec(filePath)) {
                                        alert('Solo se aceptan archivos PDF.');
                                        fileInput.value = '';
                                        return false;
                                    }

                                    if (fileInput != '') {
                                        alert('Por favor seleccione el tipo de documento adjunto');
                                    }
                                }
                            </script>
                            <?php
                            if ($privilegios != 5) {
                            ?>
                                <div class="d-flex justify-content-center">
                                    <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar btn btn-modify bg-gradient text-white w-25" onClick="return validar(seguimiento,2)" />
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
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
                        --bs-accordion-active-bg: #0C68B0;
                        --bs-accordion-active-color: white;
                        --bs-accordion-btn-bg: #035da3;
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
                        border: solid #0C68B0 1px;
                        border-end-start-radius: 10px;
                        border-end-end-radius: 10px;
                    }

                    .btn-modify {
                        background: #0C68B0;
                    }

                    .btn:hover {
                        background: #0C68B0;
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
            </div>
            </div>
        </form>
        <script>
            var CONSENTIMIENTO_INFORMADO = $("#consentimiento_informado").val();
            if (CONSENTIMIENTO_INFORMADO == 'Seleccione...' || CONSENTIMIENTO_INFORMADO == '') {
                alert('Confirme si el paciente requiere ser re consentido');
                $('#consentimiento_informado').focus();
                return false;
            }
        </script>
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