<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Documento sin titulo</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/direccion.js"></script>
    <script type="text/javascript" src="js/calcular_edad.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <script>
        $(function() {
            $("#asegurador").select2();
        });
        $(function() {
            $("#medico_tratante").select2();
        });
    </script>
    <script language=javascript>
        function ventanaSecundaria(URL) {
            window.open(URL, "ventana1", "width=1300,height=500,Top=150,Left=50%")
        }
    </script>
    <script type="text/javascript">
        function trat_previo(sel) {
            if (sel.value == "Otros") {
                divC = document.getElementById("otra_clasificacion_patologica");
                divC.style.display = "";
            }
            if (sel.value != "Otros") {
                divC = document.getElementById("otra_clasificacion_patologica");
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

        function mostrar_ciudades() {
            var departamento = $('#departamento').val();
            $("#ciudad").html('<img src="imgagenes/cargando.gif" />');
            $("#ciudad_base").html('<img src="imgagenes/cargando.gif" />');
            $.ajax({
                url: '../presentacion/ciudades.php',
                data: {
                    dep: departamento,
                },
                type: 'post',
                beforeSend: function() {
                    $('#ciudad').attr('disabled');
                    $("#ciudad").html("Procesando, espere por favor" + '<img src="img/cargando.gif" />');
                    $('#ciudad_base').attr('disabled');
                    $("#ciudad_base").html("Procesando, espere por favor" + '<img src="img/cargando.gif" />');
                },
                success: function(data) {
                    $('#ciudad').removeAttr("disabled");
                    $('#ciudad').html(data);
                    $('#ciudad_base').removeAttr("disabled");
                    $('#ciudad_base').html(data);
                }
            })
        }
    </script>
    <script type="text/javascript">
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
            var ID_ASPIRANTE = $('#codigo_usuario2').val();
            var NOMBRE_PRODUCTO = $('#nombre_producto').val();
            var NOMBRE_PACIENTE = $('#nombre').val();
            var APELLIDO_PACIENTE = $('#apellidos').val();
            var DIRECCION_PACIENTE = $('#DIRECCION').val();
            var TEL_PACIENTE = $('#telefono1').val();
            $.ajax({
                url: '../presentacion/ingresar_productos_temporal.php',
                data: {
                    ID_PRODUCTO: ID_PRODUCTO,
                    ID_ASPIRANTE: ID_ASPIRANTE,
                    NOMBRE_PRODUCTO: NOMBRE_PRODUCTO,
                    NOMBRE_PACIENTE: NOMBRE_PACIENTE,
                    APELLIDO_PACIENTE: APELLIDO_PACIENTE,
                    DIRECCION_PACIENTE: DIRECCION_PACIENTE,
                    TEL_PACIENTE: TEL_PACIENTE
                },
                type: 'post',
                beforeSend: function() {
                    $('#tabla_material_agregar').css('visibility', 'visible');
                    $("#tabla_material_agregar").html("Procesando, espere por favor" + '<img src="imagenes/cargando.gif" />');
                },
                success: function(data) {
                    $('#tabla_material_agregar').html(data);
                    $('#tabla_material_agregar').css('visibility', 'visible');
                }
            })
        }

        function materiales() {
            var REFERENCIA = $('#producto_tratamiento').val();
            $.ajax({
                url: '../presentacion/listado_producto_registrar.php',
                data: {
                    REFERENCIA: REFERENCIA
                },
                type: 'post',
                beforeSend: function() {
                    $("#tipo_envio").attr('disabled', 'disabled');
                },
                success: function(data) {
                    $("#tipo_envio").removeAttr('disabled');
                    $('#tipo_envio').html(data);
                }
            })
        }

        function status() {
            var REFERENCIA = $('#producto_tratamiento').val();
            $.ajax({
                url: '../presentacion/listado_producto_status.php',
                data: {
                    REFERENCIA: REFERENCIA
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

        function clasificacion() {
            var REFERENCIA = $('#producto_tratamiento').val();
            $.ajax({
                url: '../presentacion/listado_clasificacion_patologica.php',
                data: {
                    REFERENCIA: REFERENCIA
                },
                type: 'post',
                beforeSend: function() {
                    $("#clasificacion_patologica").attr('disabled', 'disabled');
                },
                success: function(data) {
                    $("#clasificacion_patologica").removeAttr('disabled');
                    $('#clasificacion_patologica').html(data);
                }
            })
        }

        function mostrar_dosis() {
            var reclamo = $('#reclamo').val();
            var MEDICAMENTO = $('#producto_tratamiento').val();
            if (reclamo == 'SI' && MEDICAMENTO == 'BETAFERON') {
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
            } else {
                $("#consecutivo_betaferon_span").css('display', 'none');
                $('#consecutivo_betaferon').css('display', 'none');
            }
            var producto = $('#producto_tratamiento').val();
            $.ajax({
                url: '../presentacion/dosis.php',
                data: {
                    producto: producto,
                },
                type: 'post',
                beforeSend: function() {
                    $("#span_dosis").css('display', 'block');
                    $("#span_dosis").html('<img src="imagenes/cargando.gif" />' + "  Procesando, espere por favor");
                    $('#Dosis').attr('disabled');
                    $("#Dosis").css('display', 'none');
                },
                success: function(data) {
                    $("#Dosis option:eq(0)").attr("selected", "selected");
                    $('#Dosis').val('');
                    $('#Dosis3').val('');
                    $("#span_dosis").css('display', 'none');
                    $("#Dosis").css('display', 'block');
                    $("#span_dosis").html("");
                    $('#Dosis').html(data);
                    if (producto == 'KOGENATE') {
                        $('#Dosis3').css('display', 'block');
                        $('#Dosis2').css('display', 'none');
                        $('#Dosis').css('display', 'none');
                    }
                    if (producto == 'XOFIGO') {
                        $('#Dosis2').css('display', 'block');
                        $('#Dosis3').css('display', 'none');
                        $('#Dosis').css('display', 'none');
                    }
                    if (producto == 'KOVALTRY') {
                        $('#Dosis2').css('display', 'block');
                        $('#Dosis3').css('display', 'none');
                        $('#Dosis').css('display', 'none');
                    }
                    if (producto == 'JIVI') {
                        $('#Dosis2').css('display', 'block');
                        $('#Dosis3').css('display', 'none');
                        $('#Dosis').css('display', 'none');
                    }
                    if (producto != 'XOFIGO' && producto != 'KOGENATE' && producto != 'KOVALTRY' && producto != 'JIVI') {
                        $('#Dosis').removeAttr("disabled");
                        $('#Dosis2').css('display', 'none');
                        $('#Dosis3').css('display', 'none');
                        $('#Dosis').css('display', 'block');
                    }
                }
            })
        }

        function mostrar_tipo_dispositivo() {
            var producto = $('#producto_tratamiento').val();
            $.ajax({
                url: '../presentacion/tipo_dispositivo.php',
                data: {
                    producto: producto,
                },
                type: 'post',
                bbeforeSend: function() {
                    $('#tipo_de_dispositivo').attr('disabled');
                    $("#tipo_de_dispositivo").css('display', 'none');
                    $("#fecha_vencimiento").css('display', 'none');
                },
                success: function(data) {
                    $("#tipo_de_dispositivo option:eq(0)").attr("selected", "selected");
                    $('#tipo_de_dispositivo').val('');
                    $("#tipo_de_dispositivo").css('display', 'none');
                    $("#span_tipo_de_dispositivo").css('display', 'none');
                    $("#fecha_vencimiento").css('display', 'none');
                    $("#span_fecha_vencimiento").css('display', 'none');
                    $('#tipo_de_dispositivo').html(data);
                    if (producto != 'BETAFERON' && producto != 'VENTAVIS') {
                        $('#tipo_de_dispositivo').css('disabled', 'none');
                        $('#tipo_de_dispositivo').css('display', 'none');
                        $('#tipo_dispositivo').css('display', 'none');
                        $("#fecha_vencimiento").css('display', 'none');
                        $("#span_tipo_de_dispositivo").css('display', 'none');
                        $("#span_fecha_vencimiento").css('display', 'none');
                    } else {
                        $('#tipo_de_dispositivo').removeAttr("disabled");
                        $('#tipo_de_dispositivo').css('display', 'block');
                        $('#tipo_dispositivo').css('display', 'block');
                        $("#fecha_vencimiento").css('display', 'block');
                        $("#span_tipo_de_dispositivo").css('display', 'block');
                        $("#span_fecha_vencimiento").css('display', 'block');
                    }
                    if (producto != 'NUBEQA' && producto != 'XOFIGO') {
                        $('#codigo_xofigo').css('display', 'none');
                        $('#span_codigo_xofigo').css('display', 'none');
                    } else {
                        $('#codigo_xofigo').css('display', 'block');
                        $('#span_codigo_xofigo').css('display', 'block');
                    }
                }
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            function reclamo() {
                $("#causa_no_reclamacion option:eq(0)").attr("selected", "selected");
                $("#fecha_reclamacion").val('');
                var reclamo = $('#reclamo').val();
                var MEDICAMENTO = $('#producto_tratamiento').val();
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
                    $("#fecha_reclamacion_span").css('display', 'none');
                    $('#fecha_reclamacion').css('display', 'none');
                    $("#consecutivo_betaferon_span").css('display', 'none');
                    $('#consecutivo_betaferon').css('display', 'none');
                    $('#numero_cajas option:eq(0)').attr('selected', 'selected');
                    $('#tipo_numero_cajas option:eq(0)').attr('selected', 'selected');
                    $('#causa_no_reclamacion option:eq(1)').attr('selected', 'selected');
                    $('#numero_cajas').attr('disabled', 'disabled');
                    $('#numero_cajas').removeAttr('required', 'required');
                    $('#tipo_numero_cajas').attr('disabled', 'disabled');
                    $('#tipo_numero_cajas').removeAttr('required', 'required');
                    $('#asterisco2').css('display', 'block');
                    $('#asterisco').css('display', 'none');
                }
                if (reclamo == 'SI' && MEDICAMENTO == 'BETAFERON') {
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
                    $('#tipo_numero_cajas').attr('required');
                } else {
                    if (reclamo == 'SI') {
                        $("#consecutivo_betaferon_span").css('display', 'none');
                        $('#consecutivo_betaferon').css('display', 'none');
                        $("#fecha_reclamacion_span").css('display', 'block');
                        $('#fecha_reclamacion').css('display', 'block');
                        $("#causa").css('display', 'none');
                        $('#causa_no_reclamacion').css('display', 'none');
                        $('#fecha_no_reclamacion').css('display', 'none');
                        $('#numero_cajas').removeAttr('disabled');
                        $('#numero_cajas').attr('required', 'required');
                        $('#tipo_numero_cajas').removeAttr('disabled');
                        $('#tipo_numero_cajas').attr('required', 'required');
                        $("#fecha_reclamacion").val($('#fecha_reclamacion').prop('defaultValue'));
                        $('#asterisco').css('display', 'block');
                        $('#asterisco2').css('display', 'none');
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
            $("#span_paap").css('display', 'none');
            $("#div_paap").css('display', 'none');
            $("#span_sub_paap").css('display', 'none');
            $("#div_sub_paap").css('display', 'none');
            $("#div_barrera").css('display', 'none');
            $("#aplicaicones").change(function() {
                var aplicaicones = $('#aplicaicones').val();
                if (aplicaicones == "SI") {
                    $("#ver_aplicaciones").css('visibility', 'visible');
                } else {
                    $("#ver_aplicaciones").css('visibility', 'hidden');
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
            $("#brindo_apoyo").change(function() {
                var brindo_apoyo = $('#brindo_apoyo').val();
                if (brindo_apoyo == "SI") {
                    $("#ver_apoyo").css('visibility', 'visible');
                } else {
                    $("#ver_apoyo").css('visibility', 'hidden');
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
            $("#producto_tratamiento").click(function mostrar_nebu() {
                $("#nebulizaciones").val('');
                var producto_tratamiento = $('#producto_tratamiento').val();
                if (producto_tratamiento == 'VENTAVIS') {
                    $('#span_nebulizaciones').css('display', 'inline-block');
                    $('#div_nebulizaciones').css('display', 'inline-block');
                }
                if (producto_tratamiento != 'VENTAVIS') {
                    $('#span_nebulizaciones').css('display', 'none');
                    $('#div_nebulizaciones').css('display', 'none');
                }
            });
            $("#producto_tratamiento").change(function mostrar_num_lotes() {
                var producto_tratamiento = $('#producto_tratamiento').val();
                if (producto_tratamiento == 'BETAFERON') {
                    $('#num_lotes_dis1').css('display', 'inline-block');
                    $('#num_lotes_dis2').css('display', 'inline-block');
                    $('#num_lotes_dis').removeAttr('disabled');
                }
                if (producto_tratamiento == 'VENTAVIS') {
                    $('#num_lotes_dis1').css('display', 'inline-block');
                    $('#num_lotes_dis2').css('display', 'inline-block');
                    $('#num_lotes_dis').removeAttr('disabled');
                }
                if (producto_tratamiento != 'VENTAVIS' && producto_tratamiento != 'BETAFERON') {
                    $('#num_lotes_dis1').css('display', 'none');
                    $('#num_lotes_dis2').css('display', 'none');
                    $('#num_lotes_dis').attr('disabled', 'disabled');
                }
            });
            // $("#estado_paciente").click(function ocultar_accordion() {
            //     $("#estado_paciente").val();
            //     var estado = $('#estado_paciente').val();
            //     if (estado == 'Se ingresa paciente') {
            //         $('#accordion').css('display', 'none');
            //     } else {
            //         $('#accordion').css('display', 'block');
            //     }
            // });
            $("#producto_tratamiento").click(function mostrar_tabletas() {
                $("#numero_tabletas_diarias").val('0');
                var reclamo = $('#reclamo').val();
                var producto_tratamiento = $('#producto_tratamiento').val();
                if (reclamo == 'SI' && producto_tratamiento == 'NEXAVAR' || producto_tratamiento == 'ADEMPAS') {
                    $('#span_tabletas_diarias').css('display', 'inline-block');
                    $('#div_tabletas_diarias').css('display', 'inline-block');
                    if (producto_tratamiento == "ADEMPAS") {
                        $('#div_apoyo').css('display', 'inline-block');
                        $('#span_apoyo').css('display', 'inline-block');
                    } else {
                        $('#div_apoyo').css('display', 'none');
                        $('#span_apoyo').css('display', 'none');
                    }
                }
                if (producto_tratamiento != 'NEXAVAR' && producto_tratamiento != 'ADEMPAS') {
                    $('#div_apoyo').css('display', 'none');
                    $('#span_apoyo').css('display', 'none');
                    $('#span_tabletas_diarias').css('display', 'none');
                    $('#div_tabletas_diarias').css('display', 'none');
                }
                if (reclamo == 'NO' || reclamo == '') {
                    $('#span_tabletas_diarias').css('display', 'none');
                    $('#div_tabletas_diarias').css('display', 'none');
                }
            });
            $("#reclamo").click(function mostrar_tabletas2() {
                $("#numero_tabletas_diarias").val('');
                var reclamo = $('#reclamo').val();
                var producto_tratamiento = $('#producto_tratamiento').val();
                if (reclamo == 'SI' && producto_tratamiento == 'NEXAVAR' || producto_tratamiento == 'ADEMPAS') {
                    $('#span_tabletas_diarias').css('display', 'inline-block');
                    $('#div_tabletas_diarias').css('display', 'inline-block');
                }
                if (producto_tratamiento != 'NEXAVAR' && producto_tratamiento != 'ADEMPAS') {
                    $('#span_tabletas_diarias').css('display', 'none');
                    $('#div_tabletas_diarias').css('display', 'none');
                }
                if (reclamo == 'NO' || reclamo == '') {
                    $('#span_tabletas_diarias').css('display', 'none');
                    $('#div_tabletas_diarias').css('display', 'none');
                }
            });
            $("#producto_tratamiento").change(function() {
                $('nombre_producto').val('');
                mostrar_dosis();
                mostrar_tipo_dispositivo();
                clasificacion();
            });
            $('#producto_tratamiento').change(function() {
                $('#paap option:first-child').attr("selected", "selected");
                $('#paap')[0].selectedIndex = 0;
                $('#sub_paap option:first-child').attr("selected", "selected");
                $('#sub_paap')[0].selectedIndex = 0;
                $('#sub_barrera option:first-child').attr("selected", "selected");
                $('#sub_barrera')[0].selectedIndex = 0;
                producto = $('#producto_tratamiento').val();
                materiales();
                status();
                if (producto == 'EYLIA' || producto == 'VENTAVIS' || producto == 'ADEMPAS' || producto == 'XOFIGO' || producto == 'NUBEQA' || producto == 'STIVARGA') {
                    if (producto == 'EYLIA') {
                        $('#div_aplicaciones').css('display', 'block');
                        $('#span_aplicacion').css('display', 'block');
                    } else {
                        $('#div_aplicaciones').css('display', 'none');
                        $('#span_aplicacion').css('display', 'none');
                    }
                    $("#span_paap").css('display', 'block');
                    $("#div_paap").css('display', 'block');
                } else {
                    $("#span_paap").css('display', 'none');
                    $("#div_paap").css('display', 'none');
                    $("#span_sub_paap").css('display', 'none');
                    $("#div_sub_paap").css('display', 'none');
                    $("#div_barrera").css('display', 'none');
                    $("#paap").removeProp('required');
                }
            });
            $("#tipo_envio").change(function() {
                mostrar_producto();
            });
            $("#agregar_nuevo").click(function() {
                $('#div_material_agregar').css('display', 'block');
                $('#div_agregar').css('visibility', 'hidden');
            });
        });
    </script>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$ID_ASPIRANTE = base64_decode($artid);
$ID_GESTION = base64_decode($artge);
if ($privilegios != '' && $usua != '') {
?>

    <body class="w-100">
        <form>
            <div class="col">
                <div class="accordion" id="accordionExample">
                    <?php
                    $Sel = mysqli_query($conex, "SELECT * FROM ipsen_gestiones_aspirante WHERE ID_ASPIRANTE_FK2 = '" . $ID_ASPIRANTE . "' ORDER BY ID_GESTION DESC LIMIT 1");
                    while ($con = mysqli_fetch_array($Sel)) {
                        $ID_GESTION_ULT = $con['ID_GESTION'];
                        $FECHA_NO_RECLAMACION = $con['FECHA_CITA_PROGRAMADA'];
                        $RECLAMO_GESTION = $con['RECLAMO_GESTION'];
                        $CAUSA_NO_RECLAMACION_GESTION = $con['CAUSA_NO_RECLAMACION_GESTION'];
                        $FECHA_MEDICAMENTO_HASTA = $con['FECHA_MEDICAMENTO_HASTA'];
                        $FECHA_RECLAMACIONN = $con['FECHA_RECLAMACION_GESTION'];
                        $FECHA_AUTORIZACION = $con['FECHA_AUTORIZACION'];
                        $FECHA_RECLAMACION_GESTION = $con['FECHA_RECLAMACION_GESTION'];
                        $CANAL_CONTACTO = $con['CANAL_CONTACTO'];
                    }
                    $Seleccion = mysqli_query($conex, "SELECT * FROM `ipsen_aspirantes` AS P INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE WHERE ID_ASPIRANTE = '" . $ID_ASPIRANTE . "'");
                    while ($fila = mysqli_fetch_array($Seleccion)) {
                        $ID_ASPIRANTE2 = $fila['ID_ASPIRANTE'];
                        $ID_PA = $fila['ID_ASPIRANTE'];
                        $PRODUCTO_TRATAMIENTO = $fila['PRODUCTO_TRATAMIENTO'];
                        $DOSIS = $fila['DOSIS_TRATAMIENTO'];
                        $ASEGURADOR = $fila['ASEGURADOR_TRATAMIENTO'];
                        $MEDICO_T = $fila['MEDICO_TRATAMIENTO'];
                        function Zeros($numero, $largo)
                        {
                            $resultado = $numero;
                            while (strlen($resultado) < $largo) {
                                $resultado = "0" . $resultado;
                            }
                            return $resultado;
                        }
                        $ID_ASPIRANTE = Zeros($ID_PA, 5);
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    PACIENTE
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php
                                    if ($privilegios == '1') {
                                    ?>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Numero de gestión</label>
                                                    </div>
                                                    <div class="col-10">
                                                        <input type="text" class="form-control readonly" style="display:none;" name="nombre_referencia" id="nombre_referencia" readonly="readonly" value="<?php echo $NOMBRE_REFERENCIA; ?>">
                                                        <input name="codigo_gestion" type="text" class="form-control readonly" id="codigo_gestion" max="10" readonly="readonly" value="<?php echo $ID_GESTION_ULT; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <?php
                                                    if ($privilegios == '1') {
                                                    ?>
                                                        <span></span>
                                                    <?php
                                                    }
                                                    ?>
                                                    <label for="" class="fw-bold">Codigo de Usuario</label>
                                                </div>
                                                <div class="col-10">
                                                    <input name="codigo_usuario" class="form-control readonly" type="text" id="codigo_usuario" max="10" readonly="readonly" value="<?php echo 'PAP' . $ID_ASPIRANTE; ?>">
                                                    <input name="codigo_usuario2" class="form-control readonly" type="text" id="codigo_usuario2" max="10" readonly="readonly" value="<?php echo $fila['ID_ASPIRANTE']; ?>" style="display:none">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Estado del Paciente</label>
                                                </div>
                                                <div class="col-8">
                                                    <input class="form-control readonly" name="estado_new" id="estado_new" type="text" readonly="readonly" value="<?php echo $fila['ESTADO_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Fecha de Activacion <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="date" class="form-control readonly" id="fecha_activacion" name="fecha_activacion" readonly="readonly" value="<?php echo $fila['FECHA_ACTIVACION_ASPIRANTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Correo Electronico</label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" class="form-control" name="correo" id="correo" data-title="Correo electronico" value="<?php echo $fila['CORREO_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Remitente <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" class="form-control" name="remitente" data-title="Remitente" id="remitente" value="<?php echo $fila['REMITENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Nombre</label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" class="form-control" name="nombre" id="nombre" data-title="Nombre" value="<?php echo $fila['NOMBRE_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Apellidos <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" class="form-control" name="apellidos" id="apellidos" data-title="Apellidos" value="<?php echo $fila['APELLIDO_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Tipo de identificacion</label>
                                                </div>
                                                <div class="col-8">
                                                    <select name="tipo_identificacion" id="tipo_identificacion" class="form-control" data-title="Tipo de identificacion">
                                                        <option><?php echo $fila['TIPO_IDENTIFICACION_PACIENTE'] ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <option>R.C</option>
                                                        <option>T.I</option>
                                                        <option>C.C</option>
                                                        <option>C.E</option>
                                                        <option>P.T</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Identificacion <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="identificacion" id="identificacion" class="form-control" data-title="Identificacion" value="<?php echo $fila['IDENTIFICACION_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Telefono 1</label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="telefono1" class="form-control" id="telefono1" data-title="Telefono 1" value="<?php echo $fila['TELEFONO_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Telefono 2 </label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="telefono2" class="form-control" id="telefono2" data-title="Telefono 2" value="<?php echo $fila['TELEFONO2_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Telefono 3</label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="telefono3" class="form-control" id="telefono3" data-title="Telefono 3" value="<?php echo $fila['TELEFONO3_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Telefono 4</label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="telefono4" class="form-control" id="telefono4" data-title="Telefono 4" value="<?php echo $fila['TELEFONO4_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Pais </label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="pais" id="pais" class="form-control readonly" data-title="Pais" value="COLOMBIA" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Departamento</label>
                                                </div>
                                                <div class="col-8">
                                                    <select class="form-control" name="departamento" id="departamento" data-title="Departamento" onchange="mostrar_ciudades()">
                                                        <option><?php echo $fila['DEPARTAMENTO_PACIENTE']; ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <?php
                                                        $DEPT = $fila['DEPARTAMENTO_PACIENTE'];
                                                        $Seleccionar = mysqli_query($conex, "SELECT nombre FROM `ipsen_departamento` WHERE nombre != '' AND nombre != '$DEPT' ORDER BY nombre ASC");
                                                        while ($fila3 = mysqli_fetch_array($Seleccionar)) {
                                                            $DEPARTAMENTO = $fila3['nombre'];
                                                            echo "<option>" . $DEPARTAMENTO . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Ciudad</label>
                                                </div>
                                                <div class="col-8">
                                                    <select class="form-control" name="ciudad" id="ciudad" data-title="Ciudad">
                                                        <option><?php echo $fila['CIUDAD_PACIENTE']; ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <?php
                                                        $Selecciones = mysqli_query($conex, "SELECT c.nombre FROM ipsen_ciudad AS c INNER JOIN ipsen_departamento AS d ON d.id=c.departamento_id WHERE d.nombre='$DEPT' ORDER BY c.nombre ASC");
                                                        while ($fila2 = mysqli_fetch_array($Selecciones)) {
                                                            $CIUDAD = $fila2['nombre'];
                                                            echo "<option>" . $CIUDAD . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Barrio </label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="barrio" id="barrio" class="form-control" value="<?php echo $fila['BARRIO_PACIENTE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Direccion</label>
                                                </div>
                                                <div class="col-10">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input name="direccion_act" id="direccion_act" class="form-control" value="<?php echo $fila['DIRECCION_PACIENTE']; ?>" readonly="readonly" />
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-modify" id="cambio" name="cambio">
                                                                <span class="iconify text-white" data-width="25" data-icon="material-symbols:edit-location-alt"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div id="cambio_direccion" style="display:none; border:#F00 2px solid; border-radius: 10px;" class="p-3">
                                                <div class="row-reverse">
                                                    <div class="col">
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Direccion</label>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <input type="text" name="DIRECCION" id="DIRECCION" readonly class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Via</label>
                                                                    </div>
                                                                    <div class="col-8">
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Detalle via <span class="fw-bold text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <input name="detalle_via" id="detalle_via" type="text" maxlength="30" class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Numero <span class="fw-bold text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-8">
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Interior</label>
                                                                    </div>
                                                                    <div class="col-8">
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Detalle Interior <span class="fw-bold text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <input name="detalle_int" id="detalle_int" type="text" maxlength="30" readonly class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Interior</label>
                                                                    </div>
                                                                    <div class="col-8">
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Detalle Interior <span class="fw-bold text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <input name="detalle_int2" id="detalle_int2" type="text" maxlength="30" readonly class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Interior</label>
                                                                    </div>
                                                                    <div class="col-8">
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col d-flex align-items-center">
                                                                        <label for="" class="fw-bold">Detalle Interior <span class="fw-bold text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <input name="detalle_int3" id="detalle_int3" type="text" maxlength="30" class="form-control" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTre" aria-expanded="false" aria-controls="collapseTre">
                                    DETALLES
                                </button>
                            </h2>
                            <div id="collapseTre" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Genero </label>
                                                </div>
                                                <div class="col-8">
                                                    <select type="text" name="genero" id="genero" class="form-control" data-title="Genero">
                                                        <option value="<?php echo $fila['GENERO_PACIENTE'] ?>"><?php echo $fila['GENERO_PACIENTE'] ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <option>Hombre</option>
                                                        <option>Mujer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Fecha de Nacimiento</label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" data-title="Fecha de nacimiento" max="<?php echo date('Y-m-d'); ?>" class="form-control" value="<?= $fila['FECHA_NACIMIENTO_PACIENTE'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Edad </label>
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" name="edad" id="edad" class="form-control readonly" data-title="Edad" readonly value="<?php echo $fila['EDAD_PACIENTE'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Acudiente </label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="acudiente" id="acudiente" class="form-control" data-title="Acudiente" value="<?php echo $fila['ACUDIENTE_PACIENTE'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Telefono del Acudiente</label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="number" name="telefono_acudiente" id="telefono_acudiente" data-title="Telefono de acudiente" class="form-control" value="<?php echo $fila['TELEFONO_ACUDIENTE_PACIENTE'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    GENERAL
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <?php
                                        if ($fila['ESTADO_PACIENTE'] != 'Se ingresa paciente') {
                                        ?>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Ingresa</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <select class="form-control" name="ingreso" id="ingreso" data-title="Ingresa" onchange="selectedIngreso()">
                                                            <option value="" selected disabled>Selecciona una opción</option>
                                                            <option value="SI">SI</option>
                                                            <option value="NO">NO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col" id="contentNot">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Causa no ingreso</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <select class="form-control" name="causa_no_ingreso" id="causa_no_ingreso">
                                                            <option value="" selected disabled>Selecciona una opción</option>
                                                            <option>Asignado para gestion</option>
                                                            <option>Cierre de caso sin contacto efectivo</option>
                                                            <option>Diagnostico sin programa</option>
                                                            <option>Falta de contacto</option>
                                                            <option>Finalizo tratamiento</option>
                                                            <option>Formulado con otro tratamiento</option>
                                                            <option>No acepta ingreso</option>
                                                            <option>No conoce diagnóstico</option>
                                                            <option>Datos errados</option>
                                                            <option>Numero fuera de servicio</option>
                                                            <option>Paciente fallecido</option>
                                                            <option>Repetido</option>
                                                            <option>Ya hace parte del programa</option>
                                                            <option>Sin datos de contacto</option>
                                                            <option>Volver a llamar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col" id="contentYes" style="display:none">
                                                <div class="row mb-3">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Estado</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <select class="form-control readonly" name="estado_paciente" id="estado_paciente" disabled>
                                                            <option selected>Se ingresa paciente</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Fecha de ingreso</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="date" class="form-control readonly" value="<?php echo date('Y-m-d'); ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                function selectedIngreso() {
                                                    var selected = document.getElementById('ingreso');

                                                    if (selected.value != 'SI') {
                                                        $('#contentYes').hide()
                                                        $('#contentNot').show()
                                                    } else {
                                                        $('#contentYes').show()
                                                        $('#contentNot').hide()
                                                    }

                                                }
                                            </script>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Ingresa</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <select class="form-control readonly" disabled>
                                                            <option value="SI" selected disabled>SI</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row mb-3">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Estado</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <select class="form-control readonly" disabled>
                                                            <option value="Se ingreso paciente" selected disabled>Se ingreso paciente</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Fecha de ingreso</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control readonly" readonly value="<?php echo $FECHA_RECLAMACIONN ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Producto <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <select type="text" name="producto_tratamiento_ant" id="producto_tratamiento_ant" class="form-control" disabled>
                                                        <option value="<?php echo $fila['PRODUCTO_TRATAMIENTO'] ?>"><?php echo $fila['PRODUCTO_TRATAMIENTO'] ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Dosis <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="Dosis_ant" id="Dosis_ant" class="form-control" disabled value="<?php echo $fila['DOSIS_TRATAMIENTO'] ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Clasificacion Patologica <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <span style="width:30%;">
                                                        <select name="clasificacion_patologica_ant" id="clasificacion_patologica_ant" class="form-control" disabled>
                                                            <option><?= $fila['CLASIFICACION_PATOLOGICA_TRATAMIENTO'] ?></option>
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">¿Quieres editar el medicamento? </label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="new_product" id="productoSI">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            SI
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="new_product" id="productoNO" checked>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            NO
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div id="cambio_producto" style="display:none; border:#F00 2px solid; border-radius: 10px;" class="p-3">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col d-flex align-items-center">
                                                                <label for="" class="fw-bold">Producto <span class="fw-bold text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="text" name="MEDICAMENTO" id="MEDICAMENTO" style="display:none" />
                                                                <select type="text" name="producto_tratamiento" id="producto_tratamiento" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <?php
                                                                    $select = mysqli_query($conex, "SELECT DISTINCT NOMBRE_REFERENCIA FROM ipsen_dosis ORDER BY NOMBRE_REFERENCIA ASC");
                                                                    ?>
                                                                    <?php
                                                                    while ($opcion = mysqli_fetch_array($select)) {
                                                                    ?>
                                                                        <option value="<?php echo $opcion['NOMBRE_REFERENCIA'] ?>"><?php echo $opcion['NOMBRE_REFERENCIA'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col d-flex align-items-center">
                                                                <label for="" class="fw-bold">Dosis <span class="fw-bold text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-8">
                                                                <select type="text" name="Dosis" id="Dosis" disabled="disabled" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                </select>
                                                                <span class="aviso3" id="span_dosis"></span>
                                                                <input type="text" maxlength="20" name="Dosis2" class="form-control" id="Dosis2" style="display:none" />
                                                                <input type="text" maxlength="6" name="Dosis3" class="form-control" id="Dosis3" style="display:none" onKeyDown="return validarNumeros(event)" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col-2 d-flex align-items-center">
                                                                <label for="" class="fw-bold">Clasificacion Patologica <span class="fw-bold text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-4">
                                                                <span style="width:30%;">
                                                                    <select name="clasificacion_patologica" id="clasificacion_patologica" onchange="trat_previo(this)" class="form-control">
                                                                        <option value="">Seleccione...</option>
                                                                    </select>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Medio de ingreso <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <select type="text" name="consentimiento" id="consentimiento" data-title="Medio de ingreso" class="form-control">
                                                        <option value="<?= $fila['CONSENTIMIENTO_TRATAMIENTO'] ?>" selected><?= $fila['CONSENTIMIENTO_TRATAMIENTO'] ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <option>CI</option>
                                                        <option>Verbal</option>
                                                        <option>Sms</option>
                                                        <option>Chat Interactivo</option>
                                                        <option>Correo</option>
                                                        <option>Novedades</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Regimen <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <select type="text" name="regimen" id="regimen" class="form-control" data-title="Regimen">
                                                        <option value="<?= $fila['REGIMEN_TRATAMIENTO'] ?>" selected><?= $fila['REGIMEN_TRATAMIENTO'] ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <option>Contributivo</option>
                                                        <option>Especial</option>
                                                        <option>Particular</option>
                                                        <option>Subsidiado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Canal contacto </label>
                                                </div>
                                                <div class="col-8">
                                                    <select name="canal_contacto" id="canal_contacto" class="form-control">
                                                        <option value="<?php echo $CANAL_CONTACTO ?>"><?php echo $CANAL_CONTACTO ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <option>Presencial</option>
                                                        <option>Virtual</option>
                                                        <option>Telefonico</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Especialidad </label>
                                                </div>
                                                <div class="col-8">
                                                    <select type="text" name="especialidad" id="especialidad" class="form-control" style="width: 100%" onkeypress="return check(event)">
                                                        <option value="<?php echo $fila['ESPECIALIDAD_TRATAMIENTO'] ?>"><?php echo $fila['ESPECIALIDAD_TRATAMIENTO'] ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <?php
                                                        $Seleccion = mysqli_query($conex, "SELECT DISTINCT ESPECIALIDADES FROM `ipsen_listas` WHERE ESPECIALIDADES != '' ORDER BY ESPECIALIDADES ASC");
                                                        while ($fila = mysqli_fetch_array($Seleccion)) {
                                                            $ESPECIALIDADES = $fila['ESPECIALIDADES'];
                                                            echo "<option>" . $ESPECIALIDADES . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Asegurador <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <select id="asegurador" name="asegurador" style="width: 100%" class="form-control" onkeypress="return check(event)" onchange="trat_previo1(this)">
                                                        <option value="<?php echo $ASEGURADOR ?>"><?php echo $ASEGURADOR ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <?php $query =  mysqli_query($conex, "SELECT DISTINCT ASEGURADOR FROM ipsen_asegurador WHERE ESTADO != 'OUT' ORDER BY ASEGURADOR");

                                                        while ($valores = mysqli_fetch_array($query)) {
                                                        ?>
                                                            <option><?php echo $valores['ASEGURADOR'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Medico Tratante <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <select name="medico_tratante" id="medico_tratante" style="width: 100%" class="form-control" onkeypress="return check(event)" onchange="trat_previo4(this)">
                                                        <option value="<?php echo $MEDICO_T ?>"><?php echo $MEDICO_T ?></option>
                                                        <option value="">Seleccione...</option>
                                                        <?php $query =  mysqli_query($conex, "SELECT DISTINCT MEDICO FROM ipsen_listas WHERE ESTADO = 'IN' ORDER BY MEDICO");
                                                        while ($valores = mysqli_fetch_array($query)) {
                                                        ?>
                                                            <option><?php echo $valores['MEDICO'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col" id="otro_asegurador" style="display:none">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Asegurador por habilitar <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <input name="asegurador_otro" id="asegurador_otro" onkeypress="return check(event)" type="text" class="form-control" />

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col" id="otro_medico_t" style="display:none">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <label for="" class="fw-bold">Medico Tratante por habilitar <span class="fw-bold text-danger">*</span></label>
                                                </div>
                                                <div class="col-8">
                                                    <input name="medico_t_otro" id="medico_t_otro" onkeypress="return check(event)" type="text" class="form-control" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $Seleccion1 = mysqli_query($conex, "SELECT * FROM ipsen_gestiones_aspirante WHERE ID_ASPIRANTE_FK2 = '" . $ID_ASPIRANTE . "' ORDER BY ID_GESTION DESC LIMIT 1");
                                    $num1 = mysqli_num_rows($Seleccion1);
                                    if ($num1 <= 0) {
                                    ?>
                                    <?php
                                    }
                                    ?>
                                    <input name="num1" type="text" id="num1" class="form-control" max="10" readonly="readonly" value="<?php echo $num1 ?>" style="display:none;">
                                    <?php
                                    if ($num1 > 0) {
                                        while ($consul = mysqli_fetch_array($Seleccion1)) {
                                            $DESCRIPCION_COMUNICACION_GESTION = $consul['DESCRIPCION_COMUNICACION_GESTION'];
                                            $FECHA_PROXIMA_LLAMADA = $consul['FECHA_PROXIMA_LLAMADA'];
                                            $NOTA = $consul['NOTA']
                                    ?>


                                        <?php
                                        }
                                    } else {
                                    }


                                    if ($num1 > 0) {
                                        ?>

                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Fecha Proxima Llamada <span class="fw-bold text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-10">
                                                        <input type="date" name="fecha_proxima_llamada" data-title="Fecha proxima llamada" id="fecha_proxima_llamada" class="form-control" min="<?php echo date('Y-m-d'); ?>" value="<?= $FECHA_PROXIMA_LLAMADA ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Nota <span class="fw-bold text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-10">
                                                        <textarea class="form-control" id="nota" name="nota" data-title="Nota"><?php echo $NOTA ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <label for="" class="fw-bold">Descripcion y justificacion del cambio <span class="fw-bold text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-10">
                                                        <textarea class="form-control" id="nota_new" minlength="20" data-title="Descripcion y justificacion del cambio" maxlength="5000" name="nota_new"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>


                                    <div class="col-8 my-5 mx-auto">
                                        <div class="row">
                                            <div class="col d-flex justify-content-center">
                                                <?php

                                                if ($fila['ESTADO_PACIENTE'] != 'Se ingresa paciente') {
                                                ?>
                                                    <button type="button" id="btnForm" class="btn btn-modify bg-gradient text-white w-100">
                                                        ACTUALIZAR
                                                    </button>
                                                <?php } else { ?>

                                                    <a href="../presentacion/form_paciente_seguimiento.php" class="btn btn-secondary bg-gradient w-100">
                                                        VER SEGUIMIENTO PACIENTES
                                                    </a>
                                                <?php
                                                } ?>
                                            </div>
                                            <div class="col d-flex justify-content-center">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#comunicationModal" class="btn btn-modify bg-gradient text-white w-100">
                                                    VER COMUNICACIONES
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </form>
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

<?php

include_once('./utils/modal_comunication.php');
include_once('./utils/modal_ingreso.php');

?>

<style>
    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 90vw;
        }
    }

    .accordion {
        --bs-accordion-active-bg: #0C68B0;
        --bs-accordion-active-color: white;
        --bs-accordion-btn-bg: #035da3;
        --bs-accordion-btn-color: white;
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
</style>

<script>
    const checkboxSI = document.querySelector('#productoSI');
    const checkboxNO = document.querySelector('#productoNO');

    checkboxSI.addEventListener('click', function() {
        if (this.checked) {
            $('#cambio_producto').show();
        }
    });

    checkboxNO.addEventListener('click', function() {
        if (this.checked) {
            $('#cambio_producto').hide();
            $('#producto_tratamiento').val('')
            $('#Dosis').val('')
            $('#Dosis2').val('')
            $('#Dosis3').val('')
            $('#clasificacion_patologica').val('')
        }
    });

    var ingreso = document.getElementById('ingreso');
    var estado_paciente_ant = document.getElementById('estado_new');

    ingreso.addEventListener('change', function() {
        if (ingreso.value == 'SI') {
            estado_paciente_ant.value = document.getElementById('estado_paciente').value;
        } else {

            var causa_no_ingreso = document.getElementById('causa_no_ingreso');
            estado_paciente_ant.value = causa_no_ingreso.value
            causa_no_ingreso.addEventListener('change', function() {
                estado_paciente_ant.value = this.value;
            })
        }
    })
</script>

<script>
    $('#btnForm').click(function() {
        var estado_paciente = document.getElementById("estado_new").value
        if (estado_paciente == null || estado_paciente == '') {
            Swal.fire({
                title: 'Error con el estado paciente',
                text: 'Por favor escoja una opcion',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })
        } else {
            var notaValidation = document.getElementById('nota_new');
            if (notaValidation.value.length < notaValidation.minLength) {
                Swal.fire({
                    title: 'Error con la nota',
                    text: 'Por favor tiene que ser mas de 20 caracteres',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                })
            } else {

                let validador = {
                    correo: document.getElementById('correo').value,
                    remitente: document.getElementById('remitente').value,
                    nombre: document.getElementById('nombre').value,
                    apellidos: document.getElementById('apellidos').value,
                    tipo_identificacion: document.getElementById('tipo_identificacion').value,
                    identificacion: document.getElementById('identificacion').value,
                    telefono1: document.getElementById('telefono1').value,
                    telefono2: document.getElementById('telefono2').value,
                    telefono3: document.getElementById('telefono3').value,
                    telefono4: document.getElementById('telefono4').value,
                    departamento: document.getElementById('departamento').value,
                    ciudad: document.getElementById('ciudad').value,
                    pais: document.getElementById('pais').value,
                    acudiente: document.getElementById('acudiente').value,
                    telefono_acudiente: document.getElementById('telefono_acudiente').value,
                    genero: document.getElementById('genero').value,
                    fecha_nacimiento: document.getElementById('fecha_nacimiento').value,
                    edad: document.getElementById('edad').value,
                    ingreso: document.getElementById('ingreso').value,
                    consentimiento: document.getElementById('consentimiento').value,
                    regimen: document.getElementById('regimen').value,
                    fecha_proxima_llamada: document.getElementById('fecha_proxima_llamada').value,
                    nota: document.getElementById('nota').value,
                    nota_new: document.getElementById('nota_new').value
                }

                let allFieldsFilled = true;
                let emptyFields = [];

                for (let key in validador) {
                    if (validador.hasOwnProperty(key)) {
                        let element = document.getElementById(key);
                        if (!validador[key]) {
                            allFieldsFilled = false;
                            element.classList.add('is-invalid');
                            emptyFields.push(element.getAttribute('data-title'));
                        } else {
                            element.classList.remove('is-invalid');
                            element.classList.add('is-valid');
                        }
                    }
                }

                if (allFieldsFilled) {

                    let date = {
                        codigo_usuario2: document.getElementById("codigo_usuario2").value,
                        estado_paciente: document.getElementById("estado_new").value,
                        fecha_activacion: document.getElementById("fecha_activacion").value,
                        correo: document.getElementById('correo').value,
                        remitente: document.getElementById('remitente').value,
                        nombre: document.getElementById('nombre').value,
                        apellidos: document.getElementById('apellidos').value,
                        tipo_identificacion: document.getElementById('tipo_identificacion').value,
                        identificacion: document.getElementById('identificacion').value,
                        telefono1: document.getElementById('telefono1').value,
                        telefono2: document.getElementById('telefono2').value,
                        telefono3: document.getElementById('telefono3').value,
                        telefono4: document.getElementById('telefono4').value,
                        departamento: document.getElementById('departamento').value,
                        ingreso: document.getElementById('ingreso').value,
                        ciudad: document.getElementById('ciudad').value,
                        pais: document.getElementById('pais').value,
                        barrio: document.getElementById('barrio').value,
                        DIRECCION: document.getElementById('DIRECCION').value,
                        direccion_act: document.getElementById('direccion_act').value,
                        acudiente: document.getElementById('acudiente').value,
                        telefono_acudiente: document.getElementById('telefono_acudiente').value,
                        genero: document.getElementById('genero').value,
                        fecha_nacimiento: document.getElementById('fecha_nacimiento').value,
                        edad: document.getElementById('edad').value,
                        producto_tratamiento: document.getElementById('producto_tratamiento').value,
                        producto_tratamiento_ant: document.getElementById('producto_tratamiento_ant').value,
                        Dosis_ant: document.getElementById('Dosis_ant').value,
                        clasificacion_patologica_ant: document.getElementById('clasificacion_patologica_ant').value,
                        Dosis: document.getElementById('Dosis').value,
                        Dosis2: document.getElementById('Dosis2').value,
                        Dosis3: document.getElementById('Dosis3').value,
                        clasificacion_patologica: document.getElementById('clasificacion_patologica').value,
                        consentimiento: document.getElementById('consentimiento').value,
                        regimen: document.getElementById('regimen').value,
                        canal_contacto: document.getElementById('canal_contacto').value,
                        especialidad: document.getElementById('especialidad').value,
                        asegurador: document.getElementById('asegurador').value,
                        asegurador_otro: document.getElementById('asegurador_otro').value,
                        medico_tratante: document.getElementById('medico_tratante').value,
                        medico_t_otro: document.getElementById('medico_t_otro').value,
                        fecha_proxima_llamada: document.getElementById('fecha_proxima_llamada').value,
                        nota: document.getElementById('nota').value,
                        nota_new: document.getElementById('nota_new').value
                    }

                    $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...').addClass('btn btn-primary');

                    setTimeout(function() {
                        axios.post('./../logica/aspirantes/edicion/edicion_aspirantes.php', date)
                            .then(function(response) {
                                Swal.fire({
                                        title: response.data.title,
                                        html: response.data.mensaje,
                                        icon: response.data.tipo,
                                        confirmButtonText: 'Aceptar'
                                    })
                                    .then((result) => {
                                        if (result.isConfirmed && response.data.tipo === 'success') {
                                            if (response.data.state === 'Se ingresa paciente') {
                                                $(this).prop('disabled', false).html('REGISTRAR');
                                                SendMailer()
                                                const url = `../presentacion/form_paciente.php?artid=${response.data.artid}&artge=${response.data.artge}`;
                                                const target = "info";
                                                window.open(url, target);
                                            } else {
                                                $(this).prop('disabled', false).html('REGISTRAR');
                                                window.location.reload()
                                            }
                                        }
                                    });
                            })
                            .catch(function(error) {
                                Swal.fire({
                                    title: 'Error con el servidor',
                                    text: 'Por favor consulte con el administrador',
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                })
                            });
                    }, 1000);
                } else {
                    let errorMessage = "<ul style='list-style-type: none; margin: 0; padding: 0'>";
                    emptyFields.forEach(title => {
                        errorMessage += `<li>${title}</li>`;
                    });
                    errorMessage += "</ul>";

                    Swal.fire({
                        title: 'Campos Vacíos',
                        html: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            }
        }
    })
</script>

<script>
    function SendMailer() {
        let date = {
            fecha_activacion: document.getElementById("fecha_activacion").value,
            ciudad: document.getElementById('ciudad').value,
            producto_tratamiento: document.getElementById('producto_tratamiento').value,
            Dosis: document.getElementById('Dosis').value,
            Dosis2: document.getElementById('Dosis2').value,
            Dosis3: document.getElementById('Dosis3').value,
            clasificacion_patologica: document.getElementById('clasificacion_patologica').value,
            asegurador: document.getElementById('asegurador').value,
            nota: document.getElementById('nota').value
        }

        axios.post('./../logica/aspirantes/mail/ingreso_paciente.php', date)
            .then(respuesta => {
                console.log(respuesta);
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>

</html>