<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Documento sin titulo</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/direccion.js"></script>
    <script type="text/javascript" src="js/calcular_edad.js"></script>

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
            $("#medico_tratante").select2();
        });
        $(function() {
            $("#medico_prescriptor").select2();
        });
        $(function() {
            $("#punto_entrega").select2();
        });
        $(function() {
            $("#operador_logistico").select2();
        });
        $(function() {
            $("#ips_atiende").select2();
        });
        $(function() {
            $("#especialidad").select2();
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

        function trat_previo7(sel) {
            if (sel.value == "Otro") {
                divC = document.getElementById("otro_tratamiento");
                divC.style.display = "";
            }
            if (sel.value != "Otro") {
                divC = document.getElementById("otro_tratamiento");
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
$DIAS_ANTES = date('Y-m-d', strtotime('-31 day'));
if ($privilegios != '' && $usua != '') {
?>

    <body class="w-100">
        <div class="row-reverse my-5 px-2" id="rowSearch">
            <div class="col mb-3">
                <h5>Por favor, primero consulta si la persona existe en nuestro sistema: <span class="fw-bold text-danger">*</span></h5>
            </div>
            <div class="col">
                <form>
                    <div class="row-reverse">
                        <div class="col-6 mb-3">
                            <label for="">Numero de documento</label>
                            <input type="text" value="" name="document" id="document" placeholder="Digita el numero de documento" class="form-control">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Telefono</label>
                            <input type="text" value="" name="phone" id="phone" placeholder="Digita el telefono" class="form-control" disabled>
                        </div>
                        <div class="col">
                            <button type="button" id="searchDocument" class="btn btn-modify bg-gradient text-white">Buscar</button>
                            <button type="button" id="searchPhone" class="btn btn-modify bg-gradient text-white d-none">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(function() {
                const searchDocument = document.getElementById('searchDocument');
                const searchPhone = document.getElementById('searchPhone');

                searchDocument.addEventListener('click', function() {
                    let documentInput = document.getElementById("document");
                    let phoneInput = document.getElementById("phone");

                    let dateDocument = {
                        document: document.getElementById("document").value
                    }

                    if (documentInput.value.length > 0) {
                        documentInput.classList.add('is-valid')
                        documentInput.classList.remove('is-invalid')

                        axios.post('./../logica/aspirantes/buscador/documento.php', dateDocument)
                            .then(function(response) {
                                Swal.fire({
                                    title: response.data.title,
                                    html: response.data.mensaje,
                                    icon: response.data.tipo,
                                    confirmButtonText: 'Aceptar',
                                    position: 'top'
                                }).then((result) => {
                                    if (result.isConfirmed && response.data.validation === 'document_error') {
                                        phoneInput.disabled = false
                                        searchDocument.classList.add('d-none')
                                        searchPhone.classList.remove('d-none')

                                        searchPhone.addEventListener('click', function() {
                                            let datePhone = {
                                                phone: document.getElementById("phone").value
                                            }

                                            if (phoneInput.value.length > 0) {
                                                phoneInput.classList.add('is-valid')
                                                phoneInput.classList.remove('is-invalid')

                                                axios.post('./../logica/aspirantes/buscador/telefono.php', datePhone)
                                                    .then(function(response) {
                                                        Swal.fire({
                                                            title: response.data.title,
                                                            html: response.data.mensaje,
                                                            icon: response.data.tipo,
                                                            confirmButtonText: 'Aceptar',
                                                            position: 'top'
                                                        }).then((result) => {
                                                            if (result.isConfirmed && response.data.validation === 'phone_error') {
                                                                $('#form_principal').show()
                                                                $('#rowSearch').hide()
                                                            } else if (result.isConfirmed && response.data.tipo === 'warning') {
                                                                $('#form_principal').hide()
                                                                $('#rowSearch').show()
                                                                $('#document').val(response.data.identificacion)
                                                                Swal.fire({
                                                                    title: '¿Quieres ir a la gestión del aspirante?',
                                                                    text: "Redireccionando",
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    cancelButtonText: 'Crear con otra terapia',
                                                                    confirmButtonText: 'Si, ir a la gestión!',
                                                                    position: 'top'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        const url = `../presentacion/form_aspirante.php?artid=${response.data.artid}&artge=${response.data.artge}`;
                                                                        const target = "info";
                                                                        window.open(url, target);
                                                                    } else {
                                                                        $('#form_principal').show()
                                                                        $('#rowSearch').hide()
                                                                    }
                                                                })
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

                                            } else {
                                                phoneInput.classList.add('is-invalid')
                                                phoneInput.classList.remove('is-valid')
                                            }

                                        })

                                    } else if (result.isConfirmed && response.data.tipo === 'warning') {
                                        $('#form_principal').hide()
                                        $('#rowSearch').show()
                                        $('#phone').val(response.data.telefono)
                                        Swal.fire({
                                            title: '¿Quieres ir a la gestión del aspirante?',
                                            text: "Redireccionando",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            cancelButtonText: 'Crear con otra terapia',
                                            confirmButtonText: 'Si, ir a la gestión!',
                                            position: 'top'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                const url = `../presentacion/form_aspirante.php?artid=${response.data.artid}&artge=${response.data.artge}`;
                                                const target = "info";
                                                window.open(url, target);
                                            } else {
                                                $('#form_principal').show()
                                                $('#rowSearch').hide()
                                            }
                                        })
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
                    } else {
                        documentInput.classList.add('is-invalid')
                        documentInput.classList.remove('is-valid')
                    }
                });
            })
        </script>

        <form id="form_principal" style="display: none">
            <div class="col">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header " id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                GENERAL
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Codigo de Usuario</label>
                                            </div>
                                            <div class="col-8">
                                                <?php
                                                $Seleccion = mysqli_query($conex, "SELECT ID_ASPIRANTE FROM `ipsen_aspirantes` WHERE ID_ASPIRANTE != '' ORDER BY ID_ASPIRANTE DESC LIMIT 1");
                                                while ($fila = mysqli_fetch_array($Seleccion)) {
                                                    $ID_PA = $fila['ID_ASPIRANTE'] + 1;
                                                    function Zeros($numero, $largo)
                                                    {
                                                        $resultado = $numero;
                                                        while (strlen($resultado) < $largo) {
                                                            $resultado = "0" . $resultado;
                                                        }
                                                        return $resultado;
                                                    }
                                                    $ID_ASPIRANTE = Zeros($ID_PA, 5);
                                                }
                                                ?>
                                                <input name="codigo_usuario" class="form-control readonly" type="text" id="codigo_usuario" max="10" readonly="readonly" value="<?php echo 'PAP' . $ID_ASPIRANTE; ?>" />
                                                <input name="codigo_usuario2" class="form-control readonly" type="hidden" id="codigo_usuario2" max="10" readonly="readonly" value="<?php echo $ID_ASPIRANTE; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Estado del Paciente <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <select name="estado_paciente" id="estado_paciente" class="form-control">
                                                    <option value="" selected disabled>Seleccione...</option>
                                                    <option value="Se ingresa paciente">Se ingresa paciente</option>
                                                    <option value="Asignado para gestion">Asignado para gestion</option>
                                                    <option value="Cierre de caso sin contacto efectivo">Cierre de caso sin contacto efectivo</option>
                                                    <option value="Diagnostico sin programa">Diagnostico sin programa</option>
                                                    <option value="Falta de contacto">Falta de contacto</option>
                                                    <option value="Finalizo tratamiento">Finalizo tratamiento</option>
                                                    <option value="Formulado con otro tratamiento">Formulado con otro tratamiento</option>
                                                    <option value="No acepta ingreso">No acepta ingreso</option>
                                                    <option value="No conoce diagnostico">No conoce diagnostico</option>
                                                    <option value="Datos errados">Datos errados</option>
                                                    <option value="Numero fuera de servicio">Numero fuera de servicio</option>
                                                    <option value="Paciente fallecido">Paciente fallecido</option>
                                                    <option value="Repetido">Repetido</option>
                                                    <option value="Ya hace parte del programa">Ya hace parte del programa</option>
                                                    <option value="Sin datos de contacto">Sin datos de contacto</option>
                                                    <option value="Volver a llamar">Volver a llamar</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Fecha de Activacion <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-10">
                                                <input type="date" class="form-control readonly" name="fecha_activacion" id="fecha_activacion" value="<?php echo date('Y-m-d'); ?>" readonly="readonly" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col d-flex align-items-center">
                                        <label for="" class="fw-bold">Correo Electronico <span class="fw-bold text-danger">*</span></label>
                                    </div>
                                    <div class="col-10">
                                        <div class="row mb-4">
                                            <div class="col-5">
                                                <input type="text" name="campo" id="campo" class="form-control" />
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <span style="font-size: 20px">@</span>
                                            </div>
                                            <div class="col">
                                                <select name="" id="dominio" class="form-control">
                                                    <option value="gmail.com">gmail.com</option>
                                                    <option value="hotmail.com">hotmail.com</option>
                                                    <option value="outlook.com">outlook.com</option>
                                                    <option value="otro">otro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <input type="text" class="form-control" name="correo" id="correo" disabled data-title="Correo Electronico" />
                                            </div>
                                            <div class="col d-flex justify-content-center align-items-center">
                                                <span id="campo-habilitado" style="color: grey;">Campo deshabilitado</span>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        window.addEventListener('DOMContentLoaded', function() {
                                            var campo = document.getElementById("campo");
                                            var select = document.getElementById("dominio");
                                            var email = document.getElementById("correo");
                                            var campoHabilitado = document.getElementById("campo-habilitado");


                                            campo.addEventListener("input", actualizarCorreo);
                                            select.addEventListener("change", actualizarCorreo);

                                            function actualizarCorreo() {
                                                var valor = campo.value;
                                                var usuario = campo.value.trim().replace(/\s/g, '');
                                                var dominio = select.value;

                                                if (valor === '') {
                                                    email.value = '';
                                                    campo.disabled = false;
                                                    email.disabled = true;
                                                    campoHabilitado.style.color = 'grey';
                                                    campoHabilitado.textContent = 'Campo deshabilitado';
                                                } else if (valor.includes(' ')) {
                                                    Swal.fire({
                                                        title: 'Cuidado',
                                                        text: 'Los espacios no están permitidos en este campo.',
                                                        icon: 'info',
                                                        position: 'top'
                                                    });
                                                    campo.value = valor.replace(/\s/g, '');
                                                } else if (valor.includes('@')) {
                                                    Swal.fire({
                                                        title: 'Cuidado',
                                                        text: 'El símbolo "@" no está permitido en este campo.',
                                                        icon: 'info',
                                                        position: 'top'
                                                    });
                                                    campo.value = valor.slice(0, -1);
                                                } else {
                                                    if (dominio === 'otro') {
                                                        email.disabled = false;
                                                        campo.disabled = true;
                                                        email.value = '';
                                                        campo.value = '';
                                                        campoHabilitado.style.color = 'green';
                                                        campoHabilitado.textContent = 'Campo habilitado';
                                                    } else {
                                                        campo.disabled = false;
                                                        email.disabled = true;
                                                        var correo = usuario + "@" + dominio;
                                                        email.value = correo;
                                                        campoHabilitado.style.color = 'grey';
                                                        campoHabilitado.textContent = 'Campo deshabilitado';
                                                    }
                                                }
                                            };

                                        });
                                    </script>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Remitente <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" name="remitente" id="remitente" class="form-control" data-title="Remitente" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Nombre <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" name="nombre" id="nombre" class="form-control" data-title="Nombre" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Apellidos <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" name="apellidos" id="apellidos" class="form-control" data-title="Apellidos" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Tipo de identificacion <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <select name="tipo_identificacion" id="tipo_identificacion" class="form-control" data-title="Tipo de identificacion">
                                                    <option value="" selected disabled>Seleccione...</option>
                                                    <option value="R.C">R.C</option>
                                                    <option value="T.I">T.I</option>
                                                    <option value="C.C">C.C</option>
                                                    <option value="C.E">C.E</option>
                                                    <option value="P.T">P.T</option>
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
                                                <input type="text" name="identificacion" id="identificacion" class="form-control" data-title="Identificacion" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Telefono 1 <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <input type="number" name="telefono1" id="telefono1" class="form-control" data-title="Telefono 1" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Telefono 2</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="number" name="telefono2" id="telefono2" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Telefono 3 </label>
                                            </div>
                                            <div class="col-8">
                                                <input type="number" name="telefono3" id="telefono3" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Telefono 4 </label>
                                            </div>
                                            <div class="col-8">
                                                <input type="number" name="telefono4" id="telefono4" class="form-control" />
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
                                                <input type="text" name="pais" id="pais" class="form-control readonly" value="COLOMBIA" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Departamento <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <select type="text" name="departamento" id="departamento" class="form-control" onchange="mostrar_ciudades()" style="text-transform:capitalize" data-title="Departamento">
                                                    <option value="">Seleccione...</option>
                                                    <?php
                                                    $Seleccion = mysqli_query($conex, "SELECT DISTINCT nombre FROM `ipsen_departamento` WHERE nombre != '' ORDER BY nombre ASC");
                                                    while ($fila = mysqli_fetch_array($Seleccion)) {
                                                        $DEPARTAMENTO = $fila['nombre'];
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
                                                <label for="" class="fw-bold">Ciudad <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <select type="text" name="ciudad" id="ciudad" class="form-control" data-title="Ciudad">
                                                    <option value="">Seleccione...</option>
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
                                                <input type="text" name="barrio" id="barrio" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Direccion <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="DIRECCION" id="DIRECCION" readonly class="form-control" data-title="Direccion" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Via <span class="fw-bold text-danger">*</span></label>
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
                                                <label for="" class="fw-bold">Detalles Via <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <input name="detalle_via" id="detalle_via" type="text" maxlength="15" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">N&uacute;mero <span class="fw-bold text-danger">*</span></label>
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
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Interior </label>
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
                                                <label for="" class="fw-bold">Detalles Interior</label>
                                            </div>
                                            <div class="col-8">
                                                <input name="detalle_int" id="detalle_int" type="text" maxlength="30" readonly class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Interior </label>
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
                                                <label for="" class="fw-bold">Detalles Interior</label>
                                            </div>
                                            <div class="col-8">
                                                <input name="detalle_int2" id="detalle_int2" type="text" maxlength="30" readonly class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Interior </label>
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
                                                <label for="" class="fw-bold">Detalles Interior</label>
                                            </div>
                                            <div class="col-8">
                                                <input name="detalle_int3" id="detalle_int3" type="text" maxlength="30" readonly class="form-control" />
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
                                                <select type="text" name="genero" id="genero" class="form-control">
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
                                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" max="<?php echo date('Y-m-d'); ?>" class="form-control" data-title="Fecha de Nacimiento" />
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
                                                <input type="text" name="edad" id="edad" class="form-control readonly" readonly>
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
                                                <input type="text" name="acudiente" id="acudiente" class="form-control" data-title="Acudiente" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Telefono del Acudiente</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="number" name="telefono_acudiente" id="telefono_acudiente" class="form-control" data-title="Telefono del Acudiente" />
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
                                INFORMACION DE TRATAMIENTO
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Producto <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" name="MEDICAMENTO" id="MEDICAMENTO" style="display:none" />
                                                <select type="text" name="producto_tratamiento" id="producto_tratamiento" class="form-control" data-title="Producto">
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
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Clasificacion Patologica <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <span style="width:30%;">
                                                    <select name="clasificacion_patologica" id="clasificacion_patologica" onchange="trat_previo(this)" class="form-control" data-title="Clasificacion Patologica">
                                                        <option value="">Seleccione...</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Medio de ingreso <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <select type="text" name="consentimiento" id="consentimiento" class="form-control" data-title="Medio de ingreso">
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
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Medico Tratante <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <select name="medico_tratante" id="medico_tratante" class="form-control" style="width: 100%" onkeypress="return check(event)" onchange="trat_previo4(this)" data-title="Medico Tratante">
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
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Asegurador <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <select id="asegurador" name="asegurador" class="form-control" style="width: 100%" onkeypress="return check(event)" onchange="trat_previo1(this)" data-title="Asegurador">
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
                                </div>
                                <div class="row mb-3">
                                    <div class="col" id="otro_medico_t" style="display:none">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Medico Tratante por habilitar <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <input name="medico_t_otro" id="medico_t_otro" onkeypress="return check(event)" type="text" class="form-control" data-title="Medico Tratante por habilitar" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col" id="otro_asegurador" style="display:none">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Asegurador por habilitar <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <input name="asegurador_otro" id="asegurador_otro" onkeypress="return check(event)" type="text" class="form-control" data-title="Asegurador por habilitar" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Regimen <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <select type="text" name="regimen" id="regimen" class="form-control" data-title="Regimen">
                                                    <option value="">Seleccione...</option>
                                                    <option>Contributivo</option>
                                                    <option>Especial</option>
                                                    <option>Particular</option>
                                                    <option>Subsidiado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Canal contacto </label>
                                            </div>
                                            <div class="col-8">
                                                <select name="canal_contacto" id="canal_contacto" class="form-control">
                                                    <option>Seleccione...</option>
                                                    <option>Presencial</option>
                                                    <option>Virtual</option>
                                                    <option>Telefonico</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="" class="fw-bold">Fecha Proxima Llamada <span class="fw-bold text-danger">*</span></label>
                                            </div>
                                            <div class="col-8">
                                                <input type="date" name="fecha_proxima_llamada" id="fecha_proxima_llamada" class="form-control" min="<?php echo date('Y-m-d'); ?>" data-title="Fecha Proxima Llamada" />
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
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header " id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                NOTAS Y ADJUNTOS
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row-reverse">
                                    <div class="col mb-3">
                                        <div class="row-reverse">
                                            <div class="col d-flex align-items-center mb-3">
                                                <label for="" class="fw-bold">Nota</label>
                                            </div>
                                            <div class="col-10">
                                                <textarea class="tf w-input form-control" id="nota" name="nota" rows="5" minlength="20" maxlength="5000" onkeypress="return check(event)" placeholder="Nota" data-title="Nota"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col my-5 d-flex justify-content-center">
                                        <?php
                                        if ($privilegios != 5) {
                                        ?>
                                            <button type="button" id="btnForm" class="btn_registrar btn btn-modify bg-gradient text-white w-25">
                                                REGISTRAR
                                            </button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
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
<style>
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
    $('#btnForm').click(function() {
        var estado_paciente = document.getElementById("estado_paciente").value
        if (estado_paciente == null || estado_paciente == '') {
            Swal.fire({
                title: 'Error con el estado paciente',
                text: 'Por favor escoja una opcion',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })
        } else {
            var notaValidation = document.getElementById('nota');
            if (notaValidation.value.length < notaValidation.minLength) {
                Swal.fire({
                    title: 'Error con la nota',
                    text: 'Por favor tiene que ser mas de 20 caracteres',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                })
            } else {

                let validador = {
                    estado_paciente: document.getElementById("estado_paciente").value,
                    fecha_activacion: document.getElementById("fecha_activacion").value,
                    correo: document.getElementById('correo').value,
                    remitente: document.getElementById('remitente').value,
                    nombre: document.getElementById('nombre').value,
                    apellidos: document.getElementById('apellidos').value,
                    tipo_identificacion: document.getElementById('tipo_identificacion').value,
                    identificacion: document.getElementById('identificacion').value,
                    telefono1: document.getElementById('telefono1').value,
                    pais: document.getElementById('pais').value,
                    departamento: document.getElementById('departamento').value,
                    ciudad: document.getElementById('ciudad').value,
                    DIRECCION: document.getElementById('DIRECCION').value,
                    fecha_nacimiento: document.getElementById('fecha_nacimiento').value,
                    acudiente: document.getElementById('acudiente').value,
                    telefono_acudiente: document.getElementById('telefono_acudiente').value,
                    producto_tratamiento: document.getElementById('producto_tratamiento').value,
                    clasificacion_patologica: document.getElementById('clasificacion_patologica').value,
                    consentimiento: document.getElementById('consentimiento').value,
                    medico_tratante: document.getElementById('medico_tratante').value,
                    asegurador: document.getElementById('asegurador').value,
                    regimen: document.getElementById('regimen').value,
                    fecha_proxima_llamada: document.getElementById('fecha_proxima_llamada').value,
                    nota: document.getElementById('nota').value
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
                        estado_paciente: document.getElementById("estado_paciente").value,
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
                        pais: document.getElementById('pais').value,
                        departamento: document.getElementById('departamento').value,
                        ciudad: document.getElementById('ciudad').value,
                        barrio: document.getElementById('barrio').value,
                        DIRECCION: document.getElementById('DIRECCION').value,
                        genero: document.getElementById('genero').value,
                        fecha_nacimiento: document.getElementById('fecha_nacimiento').value,
                        edad: document.getElementById('edad').value,
                        acudiente: document.getElementById('acudiente').value,
                        telefono_acudiente: document.getElementById('telefono_acudiente').value,
                        producto_tratamiento: document.getElementById('producto_tratamiento').value,
                        Dosis: document.getElementById('Dosis').value,
                        Dosis2: document.getElementById('Dosis2').value,
                        Dosis3: document.getElementById('Dosis3').value,
                        clasificacion_patologica: document.getElementById('clasificacion_patologica').value,
                        consentimiento: document.getElementById('consentimiento').value,
                        medico_tratante: document.getElementById('medico_tratante').value,
                        medico_t_otro: document.getElementById('medico_t_otro').value,
                        asegurador: document.getElementById('asegurador').value,
                        asegurador_otro: document.getElementById('asegurador_otro').value,
                        regimen: document.getElementById('regimen').value,
                        canal_contacto: document.getElementById('canal_contacto').value,
                        fecha_proxima_llamada: document.getElementById('fecha_proxima_llamada').value,
                        especialidad: document.getElementById('especialidad').value,
                        nota: document.getElementById('nota').value
                    }

                    showLoadingAlert()
                    $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...').addClass('btn btn-primary');

                    setTimeout(function() {
                        axios.post('./../logica/aspirantes/creacion/creacion_aspirantes.php', date)
                            .then(function(response) {
                                Swal.fire({
                                        title: response.data.title,
                                        html: response.data.mensaje,
                                        icon: response.data.tipo,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        confirmButtonText: 'Aceptar'
                                    })
                                    .then((result) => {
                                        if (result.isConfirmed && response.data.tipo === 'success') {
                                            if (response.data.state === 'Se ingresa paciente') {
                                                $(this).prop('disabled', false).html('REGISTRAR');
                                                SendMailer();
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
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    confirmButtonText: 'Aceptar'
                                });
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
            nota: document.getElementById('nota').value,
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

<script>
    function showLoadingAlert() {
        Swal.fire({
            type: 'info',
            html: '<span class="iconify" data-icon="line-md:uploading-loop" data-width="150"></span><br><br><span class="sr-only fw-bold">Cargando...</span>',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false
        });
    }
</script>

<script>
    $(document).ready(function() {
        $("#identificacion").on("blur", function() {

            let data = {
                documento: document.getElementById('identificacion').value
            }

            axios.post('./../logica/aspirantes/validador/documento.php', data)
                .then(response => {
                    Swal.fire({
                        title: response.data.title,
                        html: response.data.mensaje,
                        icon: response.data.tipo,
                        allowOutsideClick: false,
                        confirmButtonText: 'Aceptar',
                        position: 'top'
                    }).then((result) => {
                        if (result.isConfirmed && response.data.tipo === 'warning') {
                            Swal.fire({
                                title: '¿Quieres ir a la gestión del aspirante?',
                                text: "Redireccionando",
                                icon: 'warning',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                allowOutsideClick: false,
                                confirmButtonText: 'Si, ir a la gestión!',
                                position: 'top'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const url = `../presentacion/form_aspirante.php?artid=${response.data.artid}&artge=${response.data.artge}`;
                                    const target = "info";
                                    window.open(url, target);
                                }
                            })
                        }
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });
        $("#telefono1").on("blur", function() {

            let data = {
                telefono: document.getElementById('telefono1').value
            }

            axios.post('./../logica/aspirantes/validador/telefono.php', data)
                .then(response => {
                    Swal.fire({
                        title: response.data.title,
                        html: response.data.mensaje,
                        icon: response.data.tipo,
                        allowOutsideClick: false,
                        confirmButtonText: 'Aceptar',
                        position: 'top'
                    }).then((result) => {
                        if (result.isConfirmed && response.data.tipo === 'warning') {
                            Swal.fire({
                                title: '¿Quieres ir a la gestión del aspirante?',
                                text: "Redireccionando",
                                icon: 'warning',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Si, ir a la gestión!',
                                position: 'top'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const url = `../presentacion/form_aspirante.php?artid=${response.data.artid}&artge=${response.data.artge}`;
                                    const target = "info";
                                    window.open(url, target);
                                }
                            })
                        }
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });
    });
</script>

</html>