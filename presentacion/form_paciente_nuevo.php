<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>IPSEN</title>
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
    <script src="css/SpryAssets/SpryAccordion.js" type="text/javascript"></script>
    <link href="css/SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
    <link href="css/estilo_form_paciente.css" type="text/css" />
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/direccion.js"></script>
    <script type="text/javascript" src="js/validar_campos_pacientes.js"></script>
    <script type="text/javascript" src="js/validaciones.js"></script>
    <script type="text/javascript" src="js/calcular_edad.js"></script>
    <script type="text/javascript" src="js/validar_caracteres.js"></script>
    <script language=javascript>
        function ventanaSecundaria(URL) {
            window.open(URL, "ventana1", "width=1300,height=500,Top=150,Left=50%")
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

        // function status() {
        //     var REFERENCIA = $('#producto_tratamiento').val();
        //     $.ajax({
        //         url: '../presentacion/listado_producto_status.php',
        //         data: {
        //             REFERENCIA: REFERENCIA
        //         },
        //         type: 'post',
        //         beforeSend: function() {
        //             $("#status_paciente").attr('disabled', 'disabled');
        //         },
        //         success: function(data) {
        //             $("#status_paciente").removeAttr('disabled');
        //             $('#status_paciente').html(data);
        //         }
        //     })
        // }

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

        function mostrar_dosis() {
            var reclamo = $('#reclamo').val();
            var MEDICAMENTO = $('#producto_tratamiento').val();
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
                    if (producto == 'KOGENATE FS 2000 PLAN') {
                        $('#Dosis3').css('display', 'block');
                        $('#Dosis2').css('display', 'none');
                        $('#Dosis').css('display', 'none');
                    }
                    if (producto == 'Xofigo 1x6 ml CO') {
                        $('#Dosis2').css('display', 'block');
                        $('#Dosis3').css('display', 'none');
                        $('#Dosis').css('display', 'none');
                    }
                    if (producto == 'Kovaltry') {
                        $('#Dosis2').css('display', 'block');
                        $('#Dosis3').css('display', 'none');
                        $('#Dosis').css('display', 'none');
                    }
                    if (producto == 'Jivi') {
                        $('#Dosis2').css('display', 'block');
                        $('#Dosis3').css('display', 'none');
                        $('#Dosis').css('display', 'none');
                    }
                    if (producto != 'Xofigo 1x6 ml CO' && producto != 'KOGENATE FS 2000 PLAN' && producto != 'Kovaltry' && producto != 'Jivi') {
                        $('#Dosis').removeAttr("disabled");
                        $('#Dosis2').css('display', 'none');
                        $('#Dosis3').css('display', 'none');
                        $('#Dosis').css('display', 'block');
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
            $("#departamento").change(function() {
                asegurador();
            });
            $("#asegurador").change(function() {
                operador();
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
                if (producto_tratamiento == 'VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM') {
                    $('#span_nebulizaciones').css('display', 'inline-block');
                    $('#div_nebulizaciones').css('display', 'inline-block');
                }
                if (producto_tratamiento != 'VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM') {
                    $('#span_nebulizaciones').css('display', 'none');
                    $('#div_nebulizaciones').css('display', 'none');
                }
            });
            $("#producto_tratamiento").change(function mostrar_num_lotes() {
                var producto_tratamiento = $('#producto_tratamiento').val();
                if (producto_tratamiento == 'BETAFERON CMBP X 15 VPFS (3750 MCG) MM') {
                    $('#num_lotes_dis1').css('display', 'inline-block');
                    $('#num_lotes_dis2').css('display', 'inline-block');
                    $('#num_lotes_dis').removeAttr('disabled');
                }
                if (producto_tratamiento == 'VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM') {
                    $('#num_lotes_dis1').css('display', 'inline-block');
                    $('#num_lotes_dis2').css('display', 'inline-block');
                    $('#num_lotes_dis').removeAttr('disabled');
                }
                if (producto_tratamiento != 'VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM' && producto_tratamiento != 'BETAFERON CMBP X 15 VPFS (3750 MCG) MM') {
                    $('#num_lotes_dis1').css('display', 'none');
                    $('#num_lotes_dis2').css('display', 'none');
                    $('#num_lotes_dis').attr('disabled', 'disabled');
                }
            });
            $("#producto_tratamiento").click(function mostrar_tabletas() {
                $("#numero_tabletas_diarias").val('0');
                var reclamo = $('#reclamo').val();
                var producto_tratamiento = $('#producto_tratamiento').val();
                if (reclamo == 'SI' && producto_tratamiento == 'NEXAVAR 200MGX60C(12000MG)INST' || producto_tratamiento == 'ADEMPAS') {
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
                if (producto_tratamiento != 'NEXAVAR 200MGX60C(12000MG)INST' && producto_tratamiento != 'ADEMPAS') {
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
                if (reclamo == 'SI' && producto_tratamiento == 'NEXAVAR 200MGX60C(12000MG)INST' || producto_tratamiento == 'ADEMPAS') {
                    $('#span_tabletas_diarias').css('display', 'inline-block');
                    $('#div_tabletas_diarias').css('display', 'inline-block');
                }
                if (producto_tratamiento != 'NEXAVAR 200MGX60C(12000MG)INST' && producto_tratamiento != 'ADEMPAS') {
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
            });
            $('#producto_tratamiento').change(function() {
                $('#paap option:first-child').attr("selected", "selected");
                $('#paap')[0].selectedIndex = 0;
                $('#sub_paap option:first-child').attr("selected", "selected");
                $('#sub_paap')[0].selectedIndex = 0;
                // $('#sub_barrera option:first-child').attr("selected", "selected");
                // $('#sub_barrera')[0].selectedIndex = 0;
                producto = $('#producto_tratamiento').val();
                materiales();
                clasificacion();
                if (producto == 'Eylia 2MG VL 1x2ML CO INST' || producto == 'VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM' || producto == 'ADEMPAS' || producto == 'Xofigo 1x6 ml CO' || producto == 'NUBEQA' || producto == 'STIVARGA - regorafenib') {
                    if (producto == 'Eylia 2MG VL 1x2ML CO INST') {
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
    <style>
        td {
            padding: 6px;
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
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$DIAS_ANTES = date('Y-m-d', strtotime('-31 day'));
if ($privilegios != '' && $usua != '') {
?>

    <body class="body" style="width:100%;">
        <form id="paciente_nuevo" name="paciente_nuevo" action="../logica/insertar_datos.php" method="post" enctype="multipart/form-data" class="letra">
            <div id="Accordion1" class="Accordion" tabindex="0">
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab" style="padding:5px"><strong>GENERAL</strong></div>
                    <div class="AccordionPanelContent">
                        <table width="100%" border="0">
                            <tr>
                                <td width="20%">
                                    <span>Codigo de Usuario</span>
                                </td>
                                <td width="30%">
                                    <?php
                                    $Seleccion = mysqli_query($conex, "SELECT ID_PACIENTE FROM `ipsen_pacientes` WHERE ID_PACIENTE != '' ORDER BY ID_PACIENTE DESC LIMIT 1");
                                    while ($fila = mysqli_fetch_array($Seleccion)) {
                                        $ID_PA = $fila['ID_PACIENTE'] + 1;
                                        function Zeros($numero, $largo)
                                        {
                                            $resultado = $numero;
                                            while (strlen($resultado) < $largo) {
                                                $resultado = "0" . $resultado;
                                            }
                                            return $resultado;
                                        }
                                        $ID_PACIENTE = Zeros($ID_PA, 5);
                                    }
                                    ?>
                                    <input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%;display:none" value="SI" checked="checked" />
                                    <input name="codigo_usuario" type="text" id="codigo_usuario" max="10" readonly="readonly" value="<?php echo 'PAP' . $ID_PACIENTE; ?>" />
                                    <input name="codigo_usuario2" type="hidden" id="codigo_usuario2" max="10" readonly="readonly" value="<?php echo $ID_PACIENTE; ?>" />
                                </td>
                                <td>
                                    <span>Estado del Paciente<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select name="estado_paciente" id="estado_paciente">
                                        <option>Seleccione...</option>
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                        <option>Nuevo</option>
                                        <option>Suspendido</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Asignado para</span>
                                </td>
                                <td>
                                    <input type="text" name="proveedor_psp" id="proveedor_psp" value='People Marketing' readonly>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <span>Fecha de Activacion<span class="asterisco">*</span></span>
                                </td>
                                <td width="30%">
                                    <input type="date" name="fecha_activacion" id="fecha_activacion" value="<?php echo date('Y-m-d'); ?>" readonly="readonly" />
                                </td>
                                <td>
                                    <span>Correo Electronico</span>
                                </td>
                                <td>
                                    <input type="text" name="correo" id="correo" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Nombre<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="text" name="nombre" id="nombre" onkeypress="return check(event)" />
                                </td>
                                <td>
                                    <span>Apellidos<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="text" name="apellidos" id="apellidos" onkeypress="return check(event)" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Tipo de identificacion<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select name="tipo_identificacion" id="tipo_identificacion">
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
                                    <input type="number" name="identificacion" id="identificacion" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Telefono 1<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="number" name="telefono1" id="telefono1" />
                                </td>
                                <td>
                                    <span>Telefono 2</span>
                                </td>
                                <td>
                                    <input type="number" name="telefono2" id="telefono2" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Telefono 3</span>
                                </td>
                                <td>
                                    <input type="number" name="telefono3" id="telefono3" />
                                </td>
                                <td>
                                    <span>Telefono 4</span>
                                </td>
                                <td>
                                    <input type="number" name="telefono4" id="telefono4" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Telefono 5</span>
                                </td>
                                <td>
                                    <input type="number" name="telefono5" id="telefono5" />
                                </td>
                                <td>
                                    <span>Departamento<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="departamento" id="departamento" onchange="mostrar_ciudades()" style="text-transform:capitalize">
                                        <option value="">Seleccione...</option>
                                        <?php
                                        $Seleccion = mysqli_query($conex, "SELECT nombre FROM `ipsen_departamento` WHERE nombre != '' ORDER BY nombre ASC");
                                        while ($fila = mysqli_fetch_array($Seleccion)) {
                                            $DEPARTAMENTO = $fila['nombre'];
                                            echo "<option>" . $DEPARTAMENTO . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Ciudad<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="ciudad" id="ciudad">
                                        <option value="">Seleccione...</option>
                                    </select>
                                </td>
                                <td>
                                    <span>Barrio<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="text" name="barrio" id="barrio" onkeypress="return check(event)" />
                                </td>
                            </tr>
                            <tr>
                                <td style="width:10%;">
                                    <span>Direccion<span class="asterisco">*</span></span>
                                </td>
                                <td bgcolor="#FFFFFF" colspan="3">
                                    <input type="text" name="DIRECCION" id="DIRECCION" readonly style="width:98.5%;" />
                                </td>
                            </tr>
                            <tr>
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
                                <td style="width:8%;">
                                    <span>Detalles Via:</span>
                                </td>
                                <td width="177" bgcolor="#FFFFFF">
                                    <span>
                                        <input name="detalle_via" id="detalle_via" type="text" maxlength="15" style="width:95%" />
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td width="96">
                                    <span>N&uacute;mero:</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <span>
                                        <input name="numero" id="numero" type="text" maxlength="5" style="width:45%;" />
                                        -
                                        <input name="numero2" id="numero2" type="text" maxlength="5" style="width:45%;" />
                                    </span>
                                </td>
                                <td>

                                </td>
                                <td bgcolor="#FFFFFF">

                                </td>
                            </tr>
                            <tr>
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
                                    <span>Detalles Interior:</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <span>
                                        <input name="detalle_int" id="detalle_int" type="text" maxlength="30" readonly style="width:95%" />
                                    </span>
                                </td>
                            </tr>
                            <tr>
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
                                    <span>Detalles Interior:</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <span>
                                        <input name="detalle_int2" id="detalle_int2" type="text" maxlength="30" readonly style="width:95%" />
                                    </span>
                                </td>
                            </tr>
                            <tr>
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
                                    <span>Detalles Interior:</span>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <span>
                                        <input name="detalle_int3" id="detalle_int3" type="text" maxlength="30" style="width:95%" readonly />
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab" style="padding:5px"><strong>DETALLES</strong></div>
                    <div class="AccordionPanelContent">
                        <table width="100%" border="0">
                            <tr>
                                <td width="20%">
                                    <span>Genero<span class="asterisco">*</span></span>
                                </td>
                                <td width="30%">
                                    <select type="text" name="genero" id="genero">
                                        <option value="">Seleccione...</option>
                                        <option>Hombre</option>
                                        <option>Mujer</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <span>Fecha de Nacimiento<span class="asterisco">*</span></span>
                                </td>
                                <td width="30%">
                                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" max="<?php echo date('Y-m-d'); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Edad</span>
                                </td>
                                <td>
                                    <input type="text" name="edad" id="edad" readonly="readonly" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Acudiente</span>
                                </td>
                                <td>
                                    <input type="text" name="acudiente" id="acudiente" onkeypress="return check(event)" />
                                </td>
                                <td>
                                    <span>Telefono del Acudiente</span>
                                </td>
                                <td>
                                    <input type="number" name="telefono_acudiente" id="telefono_acudiente" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab" style="padding:5px"><strong>INFORMACION DE TRATAMIENTO</strong></div>
                    <div class="AccordionPanelContent">
                        <table width="100%" border="0">
                            <tr>
                                <td>
                                    <span>Reclamo<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="reclamo" id="reclamo">
                                        <option>Seleccione...</option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </td>
                                <td>
                                    <span style=" display:none" id="causa">Causa No Reclamacion<span class="asterisco">*</span></span>
                                    <span style=" display:none" id="fecha_reclamacion_span">Fecha de Reclamacion<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="causa_no_reclamacion" id="causa_no_reclamacion" style=" display:none">
                                        <option></option>
                                        <option>Seleccione...</option>
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
                                    <input type="date" name="fecha_actual" id="fecha_actual" value="<?php echo date('Y-m-d'); ?>" readonly="readonly" hidden />
                                    <input type="date" name="fecha_reclamacion" id="fecha_reclamacion" style=" display:none" max="<?php echo date('Y-m-d'); ?>" min="<?php echo $DIAS_ANTES ?>" />
                                    <div id="fecha_no_reclamacion" style="display:none; position: relative; margin-top:10%;">
                                        <span id="">Fecha No Reclamacion<span class="asterisco">*</span></span>
                                        <input name="fecha_no_reclamacion" type="date" style="margin-top: 10px;" />
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
                                <td>
                                    <label>
                                        <span>Se brindo Educacion</span>
                                        <select name="brindo_educacion" id="brindo_educacion">
                                            <option value="">Seleccione...</option>
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </label>
                                </td>
                                <td id="TemaSiEdu" style="display: none;">
                                    <label><span>Tema</span>
                                        <select name="TemaBrindoEdu" id="TemaBrindoEdu">
                                            <option value="">Seleccione...</option>
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
                                <td id="FechaSiEdu" style="display: none;">
                                    <label>
                                        <span>Fecha Educacion</span>
                                        <input type="date" name="FechaEduca" id="FechaEduca">
                                    </label>
                                </td>
                                <td id="motivo_no" style="display: none;">
                                    <label>
                                        <span>Motivo</span>
                                        <select name="MotivoNoEdu" id="MotivoNoEdu">
                                            <option value="">Seleccione...</option>
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
                                    <span id="asterisco" style="display:block;">Numero cajas/ Unidades<span class="asterisco">*</span></span>
                                    <span id="asterisco2" style="display:none;">Numero cajas/ Unidades</span>
                                    <br />
                                    <br />
                                </td>
                                <td>
                                    <select name="numero_cajas" id="numero_cajas" style="width:30%;" required>
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
                                    <select name="tipo_numero_cajas" id="tipo_numero_cajas" style="width:60%;" required="required">
                                        <option>Seleccione...</option>
                                        <option>Ampolla(s)</option>
                                        <option>Aplicacion</option>
                                        <option>Caja(s)</option>
                                    </select>
                                    <br />
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <span>Producto<span class="asterisco">*</span></span>
                                </td>
                                <td style="width:30%;">
                                    <input type="text" name="MEDICAMENTO" id="MEDICAMENTO" style="display:none" />
                                    <select type="text" name="producto_tratamiento" id="producto_tratamiento">
                                        <option value="">Seleccione...</option>
                                        <option>CABOMETIX</option>
                                        <option>Somatuline</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <span>Dosis</span>
                                </td>
                                <td style="width:30%;">
                                    <select type="text" name="Dosis" id="Dosis" disabled="disabled">
                                        <option>Seleccione...</option>
                                    </select>
                                    <span class="aviso3" id="span_dosis"></span>
                                    <input type="text" maxlength="20" name="Dosis2" id="Dosis2" style="display:none" />
                                    <input type="text" maxlength="6" name="Dosis3" id="Dosis3" style="display:none" onKeyDown="return validarNumeros(event)" />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <span>Clasificacion Patologica<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <span style="width:30%;">
                                        <select name="clasificacion_patologica" id="clasificacion_patologica">
                                            <option>Seleccione...</option>
                                        </select>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Tratamiento Previo<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="tratamiento_previo" id="tratamiento_previo" onchange="trat_previo(this)">
                                        <option value="">Seleccione...</option>
                                        <?php
                                        $Seleccion = mysqli_query($conex, "SELECT DISTINCT TRATAMIENTO_PREVIO FROM `ipsen_listas` WHERE TRATAMIENTO_PREVIO != '' ORDER BY TRATAMIENTO_PREVIO ASC");
                                        while ($fila = mysqli_fetch_array($Seleccion)) {
                                            $TRATAMIENTO_PREVIO = $fila['TRATAMIENTO_PREVIO'];
                                            echo "<option>" . $TRATAMIENTO_PREVIO . "</option>";
                                        }
                                        ?>
                                        <option>Otro</option>
                                    </select>
                                    <div id="otro_tratamiento" style="display:none">
                                        <span>Cual?</span>
                                        <input name="tratamiento_previo_otro" id="tratamiento_previo_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
                                    </div>
                                </td>
                                <td>
                                    <span>Canal de ingreso<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="consentimiento" id="consentimiento">
                                        <option value="">Seleccione...</option>
                                        <option>Fisico</option>
                                        <option>Verbal</option>
                                        <option>Sms</option>
                                        <option>Chat Interactivo</option>
                                        <option>Correo</option>
                                        <option>Novedades</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Fecha Inicio Terapia<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="date" name="fecha_inicio_trt" id="fecha_inicio_trt" />
                                </td>
                                <td>
                                    <span>Regimen<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="regimen" id="regimen">
                                        <option value="">Seleccione...</option>
                                        <option>Contributivo</option>
                                        <option>Especial</option>
                                        <option>Particular</option>
                                        <option>Subsidiado</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Asegurador<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <?php $query =  mysqli_query($conex, "SELECT DISTINCT ASEGURADOR FROM ipsen_asegurador WHERE ESTADO = 'IN' ORDER BY ID_ASEGURADOR DESC")
                                    ?>
                                    <input list="asegura" name="asegurador" id="asegurador" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo1(this)">
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
                                    <span>Operador Logistico<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <?php
                                    $Seleccion = mysqli_query($conex, "SELECT DISTINCT OPERADOR_LOGISTICO FROM ipsen_operador_logistico WHERE ESTADO = 'IN' ORDER BY ID_OPERADOR_LOGISTICO DESC");
                                    ?>
                                    <input list="operador" name="operador_logistico" id="operador_logistico" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo2(this)">
                                    <datalist id="operador">
                                        <?php
                                        while ($fila = mysqli_fetch_array($Seleccion)) {
                                        ?>
                                            <option><?php echo $fila['OPERADOR_LOGISTICO'] ?></option>
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
                                <td id="otro_operador" style="display:none">
                                    <span>Operador logistico por habilitar<span class="asterisco">*</span></span>
                                    <input name="operador_otro" id="operador_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Fecha Ultima Reclamacion</span>
                                </td>
                                <td>
                                    <input type="date" name="fecha_ultima_reclamacion" id="fecha_ultima_reclamacion" />
                                </td>
                                <td>
                                    <span>Otros Operadores</span>
                                </td>
                                <td>
                                    <input type="text" name="otro_operadores" id="otro_operadores" style="width:98%;" onkeypress="return check(event)" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Punto De Entrega</span>
                                </td>
                                <td>
                                    <?php
                                    $Seleccion = mysqli_query($conex, "SELECT DISTINCT NOMBRE_PUNTO FROM ipsen_puntos_entrega WHERE ESTADO = 'IN' ORDER BY ID_PUNTO DESC");
                                    ?>
                                    <input list="punto" name="punto_entrega" id="punto_entrega" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo6(this)">
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
                                <td>
                                    <span>Ips que Atiende<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <?php
                                    $Seleccion = mysqli_query($conex, "SELECT DISTINCT IPS FROM ipsen_ips WHERE ESTADO = 'IN' ORDER BY ID_IPS DESC");
                                    ?>
                                    <input list="ips" name="ips_atiende" id="ips_atiende" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo3(this)">
                                    <datalist id="ips">
                                        <?php
                                        while ($fila = mysqli_fetch_array($Seleccion)) {
                                        ?>
                                            <option><?php echo $fila['IPS'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </datalist>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="otro_punto" style="display:none">
                                    <span>Punto de entrega por habilitar<span class="asterisco">*</span></span>
                                    <input name="punto_entrega_otro" id="punto_entrega_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
                                </td>
                                <td></td>
                                <td id="otro_ips" style="display:none">
                                    <span>Ips por habilitar<span class="asterisco">*</span></span>
                                    <input name="ips_otro" id="ips_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Fecha de la Proxima Llamada<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="date" name="fecha_proxima_llamada" id="fecha_proxima_llamada" min="<?php echo date('Y-m-d'); ?>" />
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
                                    <input list="medico_t" name="medico_tratante" id="medico_tratante" value="<?php echo $fila['MEDICO_TRATAMIENTO'] ?>" style="text-transform:ucwords" autocomplete="off" onkeypress="return check(event)" onchange="trat_previo4(this)">
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
                                    <input name="medico_t_otro" id="medico_t_otro" style="text-transform:ucwords" type="text" style="width:78%;" onkeypress="return check(event)" />
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
                                    <input type="date" name="fecha_prescripcion" id="fecha_prescripcion">
                                </td>
                                <td><span>Especialidad</span></td>
                                <td>
                                    <select type="text" name="especialidad" id="especialidad">
                                        <option value="">Seleccione...</option>
                                        <?php
                                        $Seleccion = mysqli_query($conex, "SELECT DISTINCT ESPECIALIDADES FROM `ipsen_listas` WHERE ESPECIALIDADES != '' ORDER BY ESPECIALIDADES ASC");
                                        while ($fila = mysqli_fetch_array($Seleccion)) {
                                            $ESPECIALIDADES = $fila['ESPECIALIDADES'];
                                            echo "<option>" . $ESPECIALIDADES . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>
                                    <span>Paramedico o Representante</span>
                                </td>
                                <td>
                                    <input type="text" name="paramedico_representante" id="paramedico_representante" onkeypress="return check(event)">
                                </td>
                                <td>
                                    <span>Zona Atencion Paramedico o Representacnte</span>
                                </td>
                                <td>
                                    <select type="text" name="zona_atencion" id="zona_atencion">
                                        <option value="">Seleccione...</option>
                                        <option>Atlantico</option>
                                        <option>Antioquia</option>
                                        <option>Bogota</option>
                                        <option>Eje cafetero</option>
                                        <option>Fundem</option>
                                        <option>Santander</option>
                                        <option>Valle</option>
                                    </select>
                                </td>
                            </tr> -->
                            <tr>
                                <!-- <td>
                                    <span>Codigo Tratamiento</span>
                                </td>
                                <td>
                                    <input type="number" name="codigo_xofigo" id="codigo_xofigo" />
                                </td> -->
                                <td>
                                    <div style="display:none" id="num_lotes_dis2" name="num_lotes_dis2"><span>Numero lotes de los dispositivos<span class="asterisco">*</span></span></div>
                                </td>
                                <td>
                                    <div style="display:none" name="num_lotes_dis1" id="num_lotes_dis1"><input type="text" name="num_lotes_dis" id="num_lotes_dis" required="required" disabled="disabled" /></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Ciudad Base Paramedico o Representante</span>
                                </td>
                                <td>
                                    <select type="text" name="ciudad_base" id="ciudad_base">
                                        <option value="">Seleccione...</option>
                                    </select>
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
                                    <div id="span_paap">
                                        <span>Paciente hace parte del PAAP<span class="asterisco">*</span></span>
                                    </div>
                                </td>
                                <td>
                                    <div id="div_paap">
                                        <select type="text" name="paap" id="paap" style="width:95%">
                                            <option value="">Seleccione...</option>
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
                                            <option value="">Seleccione...</option>
                                            <option>Con barrera</option>
                                            <option>Sin barrera</option>
                                        </select>
                                        <br />
                                        <br />
                                    </div>
                                    <!-- <div id="div_barrera">
                                        <label>Tipo Transferencia<span class="asterisco">*</span></label>
                                        <select type="text" name="sub_barrera" id="sub_barrera" style="width:95%">
                                            <option value="">Seleccione...</option>
                                            <option>Buzon</option>
                                            <option>En linea</option>
                                        </select>
                                    </div> -->
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
                                </td>
                                <td>
                                    <div style="display:none" id="div_apoyo">
                                        <select type="text" name="brindo_apoyo" id="brindo_apoyo" style="width:80%">
                                            <option value="">Seleccione...</option>
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                        <input type="button" name="ver_apoyo" id="ver_apoyo" title="Ver apoyo" style=" visibility:hidden" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_brindar_apoyo.php?xxx=<?php echo base64_encode($ID_PACIENTE) ?>&xxxx=<?php echo base64_encode('ADEMPAS') ?>')" class="btn_ver" />
                                    </div>
                                    <div style="display:none; width:100%" id="div_aplicaciones">
                                        <select type="text" name="aplicaicones" id="aplicaicones" style="width:82%">
                                            <option value="">Seleccione...</option>
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                        <input type="button" name="ver_aplicaciones" id="ver_aplicaciones" title="Ver aplicaciones" style=" visibility:hidden" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_aplicaciones_eylia.php?xxx=<?php echo base64_encode($ID_PACIENTE) ?>&xxxx=<?php echo base64_encode($fila['Eylia 2MG VL 1x2ML CO INST']) ?>')" class="btn_ver" />
                                    </div>
                                </td>
                                <td>
                                    <div style="display:none" id="span_tabletas_diarias">
                                        <span>Numero Tabletas Diarias</span>
                                        <br />
                                        <br />
                                    </div>
                                </td>
                                <td>
                                    <script>
                                        function limpiarNumero(obj) {
                                            obj.value = obj.value.replace(/\D/g, '');
                                        }
                                    </script>
                                    <div style="display:none" id="div_tabletas_diarias">
                                        <input value="0" type="text" name="numero_tabletas_diarias" id="numero_tabletas_diarias" onkeyup="limpiarNumero(this)" onchange="limpiarNumero(this)" maxlength="4" oncopy="return false" onpaste="return false" style="width:95%;" placeholder="0" />
                                        <br />
                                        <br />
                                    </div>
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
                                        <option>Seleccione...</option>
                                    </select>
                                    <br />
                                    <br />
                                </td>
                                <td>
                                    <div id="div_agregar" style="visibility:hidden">
                                        <input type="submit" name="agregar_nuevo" id="agregar_nuevo" formaction="form_productos_envio.php" formmethod="post" formtarget="registro_productos_nuevo" style="background-image:url(imagenes/agregar.png); background-repeat:no-repeat;  width:41px; height:38px; border:1px solid transparent; background-color:transparent" value="" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div id="div_material_agregar" style="width:50%; margin:auto auto; display:none">
                                        <iframe name="registro_productos_nuevo" style="width:100%; height:250px; border:1px solid #000;" scrolling="auto"></iframe>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br />
                    </div>
                </div>
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab" style="padding:5px"><strong>NOTAS Y ADJUNTOS</strong></div>
                    <div class="AccordionPanelContent">
                        <br />
                        <br />
                        <div style="width:91.4%;">
                            <textarea class="tf w-input" style="width:100%; height:100px" id="txtCurp" name="nota" maxlength="5000" onkeypress="return check(event)" placeholder="Nota" id="test"></textarea>
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
                            <?php
                            if ($privilegios != 5) {
                            ?>
                                <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(paciente_nuevo,1);this.disabled=true" />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                            <?PHP
                            }
                            ?>
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            function check(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 13 || tecla == 8 || tecla == 9 || tecla == 28 || tecla == 15 || tecla == 37 || tecla == 39) {
                    return true;
                }
                patron = /[A-Za-z0-9-., \n )(.,]/;
                tecla_final = String.fromCharCode(tecla);
                return patron.test(tecla_final);
            }
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