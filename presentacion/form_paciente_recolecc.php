<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
    <script src="css/SpryAssets/SpryAccordion.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/validaciones.js"></script>
    <link href="css/SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/calcular_edad.js"></script>
    <script type="text/javascript" src="js/direccion.js"></script>
    </script>
    <script src="../presentacion/js/jquery.js"></script>
    <script type="text/javascript" src="js/validar_campos_modificacion.js"></script>
    <script language=javascript>
        function ventanaSecundaria(URL) {
            window.open(URL, "ventana1", "width=1300,height=500,Top=150,Left=50%");
        }
    </script>
    <style>
        td {
            padding: 3px;
            background-color: transparent;
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
    </script>
    <script>
        /*DIRECCION*/
        $(document).ready(function() {
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
            status();
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
        /**/
        function reclamacion() {
            var reclamo = $('#reclamo').val();
            var MEDICAMENTO = $('#MEDICAMENTO').val();
            if (reclamo == 'NO') {
                $("#causa").css('display', 'block');
                $('#causa_no_reclamacion').css('display', 'block');
                $("#fecha_reclamacion_span").css('display', 'none');
                $('#fecha_reclamacion').css('display', 'none');
                $("#consecutivo_betaferon_span").css('display', 'none');
                $('#consecutivo_betaferon').css('display', 'none');
            }
            if (reclamo == 'SI' && MEDICAMENTO == 'BETAFERON CMBP X 15 VPFS (3750 MCG) MM') {
                $("#consecutivo_betaferon_span").css('display', 'block');
                $('#consecutivo_betaferon').css('display', 'block');
                $("#fecha_reclamacion_span").css('display', 'block');
                $('#fecha_reclamacion').css('display', 'block');
                $("#causa").css('display', 'none');
                $('#causa_no_reclamacion').css('display', 'none');
            } else {
                if (reclamo == 'SI') {
                    $("#fecha_reclamacion_span").css('display', 'block');
                    $('#fecha_reclamacion').css('display', 'block');
                    $("#causa").css('display', 'none');
                    $('#causa_no_reclamacion').css('display', 'none');
                }
            }
        }
        /*FIN DIRECCIOn*/
        $(document).ready(function() {
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
            /*funcion reclamacion*/
            reclamacion();
            $("#reclamo").change(function() {
                $("#causa_no_reclamacion").val($('#causa_no_reclamacion').prop('defaultValue'));
                $("#causa_no_reclamacion option:eq(0)").attr("selected", "selected");
                $("#fecha_reclamacion").val($('#fecha_reclamacion').prop('defaultValue'));
                $("#consecutivo_betaferon").val($('#consecutivo_betaferon').prop('defaultValue'));
                reclamacion();
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
            $('#crear').change(function() {
                var crear = $('#crear').val();
                $('#descripcion_nuevo_comunicacion').val('');
                if (crear == 'SI') {
                    $('#nueva').css('display', 'block');
                    $('#nueva2').css('display', 'block');
                }
                if (crear == 'NO') {
                    $('#nueva').css('display', 'none');
                    $('#nueva2').css('display', 'none');
                }
                if (crear == '') {
                    $('#nueva').css('display', 'none');
                    $('#nueva2').css('display', 'none');
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
//include('../logica/consulta_paciente.php');
if ($privilegios != '' && $usua != '') {
?>
    <body class="body" style="width:80.9%;margin-left:12%;">
        <form id="seguimiento" name="seguimiento" method="post" action="../logica/actualizar_recoleccion.php" onkeydown="return filtro(2)" enctype="multipart/form-data" class="letra">
            <div id="Accordion1" class="Accordion" tabindex="0" style="height:100%;">
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab">PACIENTE</div>
                    <div class="AccordionPanelContent">
                        <table width="100%" border="0">
                            <?php
                            $Seleccion2 = mysqli_query($conex,"SELECT * FROM bayer_gestiones WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' LIMIT 1");
                            while ($fila2 = mysqli_fetch_array($Seleccion2)) {
                                $reclamo_gestion = $fila2['RECLAMO_GESTION'];
                                $causo_no_reclamacion = $fila2['CAUSA_NO_RECLAMACION_GESTION'];
                                $fecha_reclamacion = $fila2['FECHA_RECLAMACION_GESTION'];
                                $prox_llamada = $fila2['FECHA_PROXIMA_LLAMADA'];
                            }
                            ?>
                            <input type="hidden" id="reclamo_gestion" name="reclamo_gestion" value="<?php echo $reclamo_gestion; ?>">
                            <input type="hidden" id="causo_no_reclamacion" name="causo_no_reclamacion" value="<?php echo $causo_no_reclamacion; ?>">
                            <input type="hidden" id="fecha_reclamacion" name="fecha_reclamacion" value="<?php echo $fecha_reclamacion; ?>">
                            <input type="hidden" id="prox_llamada" name="prox_llamada" value="<?php echo $prox_llamada; ?>">
                            <?php
                            $Seleccion = mysqli_query($conex,"SELECT * FROM `bayer_pacientes` AS P
		INNER JOIN bayer_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
		WHERE ID_PACIENTE = '" . $ID_PACIENTE . "'");
                            while ($fila = mysqli_fetch_array($Seleccion)) {
                                $ID_PACIENTE2 = $fila['ID_PACIENTE'];
                                $ID_PA = $fila['ID_PACIENTE'];
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
                                            <select type="text" name="estado_paciente" id="estado_paciente" readonly="readonly">
                                                <option><?php echo $fila['ESTADO_PACIENTE']; ?></option>
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
                                    <td width="20%">
                                    </td>
                                    <td width="30%">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">
                                        <span>Fecha de Retiro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </td>
                                    <td width="30%">
                                        <input type="date" name="fecha_retiro" id="fecha_retiro" max="10" value="<?php echo $fila['FECHA_RETIRO_PACIENTE']; ?>" readonly="readonly" />
                                    </td>
                                    <td width="20%">
                                        <span>Motivo de Retiro</span>
                                    </td>
                                    <td>
                                        <select type="text" name="motivo_retiro" id="motivo_retiro" readonly="readonly">
                                            <option><?php echo $fila['MOTIVO_RETIRO_PACIENTE']; ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Observaciones Motivo de Retiro</span>
                                    </td>
                                    <td colspan="3">
                                        <textarea name="observacion_retiro" readonly="readonly" id="observacion_retiro" style="width:98%; height:100px"><?php echo $fila['OBSERVACION_MOTIVO_RETIRO_PACIENTE']; ?></textarea>
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
                                        <span>Identificacion<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="identificacion" id="identificacion" value="<?php echo $fila['IDENTIFICACION_PACIENTE']; ?>" readonly="readonly" />
                                    </td>
                                    <td>
                                        <span>Telefono 1<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="telefono1" id="telefono1" value="<?php echo $fila['TELEFONO_PACIENTE']; ?>" readonly="readonly" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Telefono 2</span>
                                    </td>
                                    <td>
                                        <input type="text" name="telefono2" id="telefono2" value="<?php echo $fila['TELEFONO2_PACIENTE']; ?>" readonly="readonly" />
                                    </td>
                                    <td>
                                        <span>Telefono 3</span>
                                    </td>
                                    <td>
                                        <input type="text" name="telefono3" id="telefono3" value="<?php echo $fila['TELEFONO3_PACIENTE']; ?>" readonly="readonly" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Correo Electronico</span>
                                    </td>
                                    <td>
                                        <input type="text" name="correo" id="correo" value="<?php echo $fila['CORREO_PACIENTE']; ?>" readonly="readonly" />
                                    </td>
                                    <td>
                                        <span>Departamento<span class="asterisco">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </td>
                                    <td>
                                        <select type="text" name="departamento" id="departamento" onchange="mostrar_ciudades()" readonly="readonly">
                                            <option><?php echo $fila['DEPARTAMENTO_PACIENTE']; ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Ciudad<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select type="text" name="ciudad" id="ciudad" readonly="readonly">
                                            <option><?php echo $fila['CIUDAD_PACIENTE']; ?></option>
                                        </select>
                                    </td>
                                    <td>
                                        <span>Barrio<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="barrio" id="barrio" value="<?php echo $fila['BARRIO_PACIENTE']; ?>" readonly="readonly" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Direccion<span class="asterisco">*</span></span>
                                    </td>
                                    <td colspan="3">
                                        <input name="direccion_act" id="direccion_act" style="width:93%" value="<?php echo $fila['DIRECCION_PACIENTE']; ?>" readonly="readonly" />
                                        <!-- <img src="imagenes/lapiz 100.png"
id="cambio" name="cambio" title="Editar" style="width:4%; height:20px; margin-left:-10%;" align="right"/>-->
                                    </td>
                                </tr>
                                <tr style="padding:3%;">
                                    <td colspan="4" width="90%">
                                        <div id="cambio_direccion" style="display:none; border:#F00 1px solid;">
                                            <table width="99%">
                                                <tr style="padding:3%;">
                                                    <td style="width:10%;"><span>Direccion<span class="asterisco">*</span></span></td>
                                                    <td bgcolor="#FFFFFF" colspan="3">
                                                        <input type="text" name="DIRECCION" id="DIRECCION" readonly style="width:99.8%;" readonly="readonly" />
                                                    </td>
                                                </tr>
                                                <tr style="padding:3%;">
                                                    <td><span>Via:</span></td>
                                                    <td style="width:35%"><span>
                                                            <select id="VIA" name="VIA" style="width:96%" readonly="readonly">
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
                                                        </span></td>
                                                    <td style="width:10%;"><span>Detalle via:</span></td>
                                                    <td width="177" bgcolor="#FFFFFF"><span>
                                                            <input name="detalle_via" id="detalle_via" type="text" maxlength="30" style="width:99%" readonly="readonly" />
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="96"><span>N&uacute;mero:</span></td>
                                                    <td bgcolor="#FFFFFF">
                                                        <span>
                                                            <input name="numero" id="numero" type="text" maxlength="5" style=" width:45%" readonly="readonly" />
                                                            -
                                                            <input name="numero2" id="numero2" type="text" maxlength="5" style=" width:45%" readonly="readonly" />
                                                        </span>
                                                    </td>
                                                    <td></td>
                                                    <td bgcolor="#FFFFFF"></td>
                                                </tr>
                                                <tr style="padding:3%;">
                                                    <td><span>Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
                                                            <select id="interior" name="interior" style="width:96%" readonly="readonly">
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
                                                        </span></td>
                                                    <td><span>Detalle Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
                                                            <input name="detalle_int" id="detalle_int" type="text" maxlength="30" readonly="readonly" style="width:99%" />
                                                        </span></td>
                                                </tr>
                                                <tr style="padding:3%;">
                                                    <td><span>Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
                                                            <select id="interior2" name="interior2" style="width:96%" readonly="readonly">
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
                                                        </span></td>
                                                    <td><span>Detalle Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
                                                            <input name="detalle_int2" id="detalle_int2" type="text" maxlength="30" readonly="readonly" style="width:99%" />
                                                        </span></td>
                                                </tr>
                                                <tr style="padding:3%;">
                                                    <td><span>Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
                                                            <select id="interior3" name="interior3" style="width:96%" readonly="readonly">
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
                                                        </span></td>
                                                    <td><span>Detalle Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
                                                            <input name="detalle_int3" id="detalle_int3" type="text" maxlength="30" style="width:99%" readonly="readonly" />
                                                        </span></td>
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
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $fila['FECHA_NACIMINETO_PACIENTE']; ?>" readonly="readonly" />
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
                                        <input type="text" name="acudiente" id="acudiente" value="<?php echo $fila['ACUDIENTE_PACIENTE'] ?>" readonly="readonly" />
                                    </td>
                                    <td>
                                        <span>Telefono del Acudiente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </td>
                                    <td>
                                        <input type="text" name="telefono_acudiente" id="telefono_acudiente" value="<?php echo $fila['TELEFONO_ACUDIENTE_PACIENTE'] ?>" readonly="readonly" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Clasificacion Patologica<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <span style="width:30%;">
                                            <input type="text" name="clasificacion_patologica" id="clasificacion_patologica" value="<?php echo $fila['CLASIFICACION_PATOLOGICA_TRATAMIENTO'] ?>" readonly="readonly" />
                                        </span>
                                    </td>
                                    <td>
                                        <span>Fecha Inicio Terapia<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="date" name="fecha_ini_terapia" id="fecha_ini_terapia" value="<?php echo $fila['FECHA_INICIO_TERAPIA_TRATAMIENTO'] ?>" readonly="readonly" />
                                    </td>
                                </tr>
                        </table>
                    <?php
                            }
                    ?>
                    </div>
                </div>
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab">GESTION</div>
                    <div class="AccordionPanelContent">
                        <br />
                        <br />
                        <table width="100%" border="0">
                            <tr>
                                <td>
                                    <span>Evento Adverso<span class="asterisco">*</span></span>
                                    <br />
                                    <br />
                                </td>
                                <td>
                                    <input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%; display:none" value="" checked="checked" />
                                    <input name="evento_adverso" type="radio" id="evento_adverso" style=" width:20%;" value="SI" />SI
                                    <input name="evento_adverso" type="radio" id="evento_adverso" style=" width:20%;" value="NO" checked="checked" />NO
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
                                        <input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Tecnovigilancia Betaconnet/ Omrron" />Tecnovigilancia Betaconnet/ Omrron
                                        <br />
                                        <input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Tecnovigilancia I-neb" />Tecnovigilancia I-neb
                                    </div>
                                    <br />
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <td width="23%">
                                    <span>Ultima Recoleccion</span>
                                    <br />
                                    <br />
                                </td>
                                <td width="29%">
                                    <input type="date" name="fecha_ultima_recoleccion" id="fecha_recoleccion" max="10" value="<?php echo $fila['FECHA_RETIRO_PACIENTE']; ?>" />
                                </td>
                                <td width="18%"><span>Proxima Recoleccion</span></td>
                                <td width="30%">
                                    <input type="date" name="fecha_proxima_recoleccion" id="fecha_proxima_recoleccion" max="10" value="<?php echo $fila['FECHA_RETIRO_PACIENTE']; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="nueva">
                                        <span>Descripcion Nueva Comunicaci&oacute;n</span>
                                        <br />
                                        <br />
                                    </div>
                                </td>
                                <td colspan="3">
                                    <div id="nueva2">
                                        <textarea style="width:98%; height:72.5px;" id="descripcion_nuevo_comunicacion" name="descripcion_nuevo_comunicacion"></textarea>
                                        <br />
                                        <br />
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br />
                        <br />
                        <center>
                            <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_actualizar" onClick="return validar(seguimiento,1)" />
                        </center>
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