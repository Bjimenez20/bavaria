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
        $(document).ready(function() {
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

        function reclamacion() {
            var reclamo = $('#reclamo').val();
            var MEDICAMENTO = $('#MEDICAMENTO').val();
            if (reclamo == 'NO') {
                $("#causa").css('display', 'block');
                $('#causa_no_reclamacion').css('display', 'block');
                $('#fecha_no_reclamacion').css('display', 'none');
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
                    $('#fecha_no_reclamacion').css('display', 'none');
                    $("#causa").css('display', 'none');
                    $('#causa_no_reclamacion').css('display', 'none');
                }
            }
        }
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
if ($privilegios != '' && $usua != '') {
?>

    <body class="body" style="width:80.9%;margin-left:12%;">
        <form id="seguimiento" name="seguimiento" method="post" action="../logica/actualizar_modificacion.php" onkeydown="return filtro(2)" enctype="multipart/form-data" class="letra">
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
                                            <select type="text" name="estado_paciente" id="estado_paciente">
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
                                        <span>Fecha de Activacion<span class="asterisco">*</span></span>
                                    </td>
                                    <td width="30%">
                                        <input type="date" name="fecha_activacion" id="fecha_activacion" value="<?php echo $fila['FECHA_ACTIVACION_PACIENTE']; ?>" />
                                    </td>
                                    <td width="20%">
                                    </td>
                                    <td width="30%">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">
                                        <span>Fecha de Retiro</span>
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
                                            <option>Cambio de tratamiento</option>
                                            <option>Embarazo</option>
                                            <option>Evento adverso</option>
                                            <option>Falta de contacto</option>
                                            <option>Fuera del pais</option>
                                            <option>Muerte</option>
                                            <option>No interesado</option>
                                            <option>Off Label</option>
                                            <option>Orden medica</option>
                                            <option>Otro</option>
                                            <option>Progresion de la Enfermedad</option>
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
                                        <input type="text" name="nombre" id="nombre" value="<?php echo $fila['NOMBRE_PACIENTE']; ?>" />
                                    </td>
                                    <td>
                                        <span>Apellidos<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="apellidos" id="apellidos" value="<?php echo $fila['APELLIDO_PACIENTE']; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Identificacion<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="identificacion" id="identificacion" value="<?php echo $fila['IDENTIFICACION_PACIENTE']; ?>" />
                                    </td>
                                    <td>
                                        <span>Telefono 1<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="telefono1" id="telefono1" value="<?php echo $fila['TELEFONO_PACIENTE']; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Telefono 2</span>
                                    </td>
                                    <td>
                                        <input type="text" name="telefono2" id="telefono2" value="<?php echo $fila['TELEFONO2_PACIENTE']; ?>" />
                                    </td>
                                    <td>
                                        <span>Telefono 3</span>
                                    </td>
                                    <td>
                                        <input type="text" name="telefono3" id="telefono3" value="<?php echo $fila['TELEFONO3_PACIENTE']; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Correo Electronico</span>
                                    </td>
                                    <td>
                                        <input type="text" name="correo" id="correo" value="<?php echo $fila['CORREO_PACIENTE']; ?>" />
                                    </td>
                                    <td>
                                        <span>Departamento<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select type="text" name="departamento" id="departamento" onchange="mostrar_ciudades()">
                                            <option><?php echo $fila['DEPARTAMENTO_PACIENTE']; ?></option>
                                            <?php
                                            $DEPT = $fila['DEPARTAMENTO_PACIENTE'];
                                            $Seleccionar = mysqli_query($conex, "SELECT nombre FROM `ipsen_departamento` WHERE nombre != '' AND nombre != '$DEPT' ORDER BY nombre ASC ");
                                            while ($fila3 = mysqli_fetch_array($Seleccionar)) {
                                                $DEPARTAMENTO = $fila3['nombre'];
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
                                            <option><?php echo $fila['CIUDAD_PACIENTE']; ?></option>
                                            <?php
                                            $Selecciones = mysqli_query($conex, "SELECT c.nombre FROM ipsen_ciudad AS c
                                            INNER JOIN ipsen_departamento AS d ON d.id=c.departamento_id
                                            WHERE d.nombre='$DEPT' ORDER BY c.nombre ASC");
                                            while ($fila2 = mysqli_fetch_array($Selecciones)) {
                                                $CIUDAD = $fila2['nombre'];
                                                echo "<option>" . $CIUDAD . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <span>Barrio<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="barrio" id="barrio" value="<?php echo $fila['BARRIO_PACIENTE']; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Direccion<span class="asterisco">*</span></span>
                                    </td>
                                    <td colspan="3">
                                        <input name="direccion_act" id="direccion_act" style="width:93%" value="<?php echo $fila['DIRECCION_PACIENTE']; ?>" />
                                        <img src="imagenes/lapiz 100.png" id="cambio" name="cambio" title="Editar" style="width:4%; height:20px; margin-left:-10%;" align="right" />
                                    </td>
                                </tr>
                                <tr style="padding:3%;">
                                    <td colspan="4" width="90%">
                                        <div id="cambio_direccion" style="display:none; border:#F00 1px solid;">
                                            <table width="99%">
                                                <tr style="padding:3%;">
                                                    <td style="width:10%;"><span>Direccion<span class="asterisco">*</span></span></td>
                                                    <td bgcolor="#FFFFFF" colspan="3">
                                                        <input type="text" name="DIRECCION" id="DIRECCION" readonly style="width:99.8%;" />
                                                    </td>
                                                </tr>
                                                <tr style="padding:3%;">
                                                    <td><span>Via:</span></td>
                                                    <td style="width:35%"><span>
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
                                                        </span></td>
                                                    <td style="width:10%;"><span>Detalle via:</span></td>
                                                    <td width="177" bgcolor="#FFFFFF"><span>
                                                            <input name="detalle_via" id="detalle_via" type="text" maxlength="30" style="width:99%" />
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="96"><span>N&uacute;mero:</span></td>
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
                                                    <td><span>Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
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
                                                        </span></td>
                                                    <td><span>Detalle Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
                                                            <input name="detalle_int" id="detalle_int" type="text" maxlength="30" readonly style="width:99%" />
                                                        </span></td>
                                                </tr>
                                                <tr style="padding:3%;">
                                                    <td><span>Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
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
                                                        </span></td>
                                                    <td><span>Detalle Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
                                                            <input name="detalle_int2" id="detalle_int2" type="text" maxlength="30" readonly style="width:99%" />
                                                        </span></td>
                                                </tr>
                                                <tr style="padding:3%;">
                                                    <td><span>Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
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
                                                        </span></td>
                                                    <td><span>Detalle Interior:</span></td>
                                                    <td bgcolor="#FFFFFF"><span>
                                                            <input name="detalle_int3" id="detalle_int3" type="text" maxlength="30" style="width:99%" readonly />
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
                                        <span>Acudiente</span>
                                    </td>
                                    <td>
                                        <input type="text" name="acudiente" id="acudiente" value="<?php echo $fila['ACUDIENTE_PACIENTE'] ?>" />
                                    </td>
                                    <td>
                                        <span>Telefono del Acudiente</span>
                                    </td>
                                    <td>
                                        <input type="text" name="telefono_acudiente" id="telefono_acudiente" value="<?php echo $fila['TELEFONO_ACUDIENTE_PACIENTE'] ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Clasificacion Patologica<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <span style="width:30%;">
                                            <input type="text" name="clasificacion_patologica" id="clasificacion_patologica" value="<?php echo $fila['CLASIFICACION_PATOLOGICA_TRATAMIENTO'] ?>" />
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
                                    <td>
                                        <span>Fecha de la Pr&oacute;xima Llamada<span class="asterisco">*</span></span>
                                        <br />
                                        <br />
                                    </td>
                                    <?php
                                    $Sel = mysqli_query($conex, "SELECT FECHA_PROGRAMADA_GESTION, ID_GESTION FROM ipsen_gestiones
                                    WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' ORDER BY FECHA_PROGRAMADA_GESTION DESC LIMIT 1");
                                    while ($con = mysqli_fetch_array($Sel)) {
                                        $ID_GESTION_ULT = $con['ID_GESTION'];
                                    ?>
                                        <td>
                                            <input type="text" name="id_gestion_ult" id="id_gestion_ult" value="<?php echo $ID_GESTION_ULT ?>" style="display:none" />
                                            <input type="date" name="fecha_proxima_llamada_ant" id="fecha_proxima_llamada_ant" value="<?php echo $con['FECHA_PROGRAMADA_GESTION'] ?>" style="display:none" />
                                            <input type="date" name="fecha_proxima_llamada" id="fecha_proxima_llamada" value="<?php echo $con['FECHA_PROGRAMADA_GESTION'] ?>" min="<?php echo date('Y-m-d'); ?>" />
                                            <br />
                                            <br />
                                        </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="button" name="historico" id="historico" title="Historico reclamacion" style="width:100%; height:50px" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_historico_reclamacion.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')" />
                                    </td>
                                    <td colspan="2">
                                        <input type="button" name="pedidos" id="pedidos" title="Mis Pedidos" style="width:100%; height:50px" value="Mis Pedidos" onclick="javascript:ventanaSecundaria('form_productos_paciente.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')" />
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab">GENERAL</div>
                    <div class="AccordionPanelContent">
                        <br />
                        <br />
                        <table width="93.5%">
                            <tr>
                                <td>
                                    <span>Asegurador<span class="asterisco">*</span></span>
                                    <br />
                                    <br />
                                </td>
                                <td>
                                    <select type="text" name="asegurador" id="asegurador">
                                        <option><?php echo $fila['ASEGURADOR_TRATAMIENTO'] ?></option>
                                        <?php
                                        $Seleccion = mysqli_query($conex, "SELECT ASEGURADOR FROM `ipsen_asegurador_operador_logistico` WHERE DEPARTAMENTO='" . $fila['DEPARTAMENTO_PACIENTE'] . "' GROUP BY ASEGURADOR ORDER BY ASEGURADOR  ASC");
                                        while ($fil = mysqli_fetch_array($Seleccion)) {
                                            $ASEGURADOR = $fil['ASEGURADOR'];
                                            echo "<option>" . $ASEGURADOR . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <br />
                                    <br />
                                </td>
                                <td>
                                    <span>Ips que Atiende<span class="asterisco">*</span></span>
                                    <br />
                                    <br />
                                </td>
                                <td>
                                    <input type="text" name="ips_atiende" id="ips_atiende" value="<?php echo $fila['IPS_ATIENDE_TRATAMIENTO'] ?>">
                                    <br />
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <td><span>Medico<span class="asterisco">*</span></span><br />
                                    <br />
                                </td>
                                <td>
                                    <select type="text" name="medico" id="medico">
                                        <option><?php echo $fila['MEDICO_TRATAMIENTO'] ?></option>
                                        <?php
                                        $medico = $fila['MEDICO_TRATAMIENTO'];
                                        $Seleccion = mysqli_query($conex, "SELECT MEDICO FROM `ipsen_listas` WHERE MEDICO != '' AND MEDICO != '" . $medico . "' ORDER BY MEDICO ASC");
                                        while ($datos_m = mysqli_fetch_array($Seleccion)) {
                                            $MEDICO = $datos_m['MEDICO'];
                                            echo "<option>" . $MEDICO . "</option>";
                                        }
                                        ?>
                                        <?php
                                        if ($privilegios == '1') {
                                        ?>
                                            <option value="Otro">Otro</option>
                                    </select>
                                    <span id="cual_medico" style="display:none;">Cual</span>
                                    <input type="text" name="medico_nuevo" id="medico_nuevo" style="display:none; width:84%" />
                                <?php
                                        }
                                ?>
                                <br />
                                <br />
                                </td>
                                <td><span>Operador Logistico<span class="asterisco">*</span></span><br />
                                    <br />
                                </td>
                                <td>
                                    <select type="text" name="operador_logistico" id="operador_logistico">
                                        <option><?php echo $fila['OPERADOR_LOGISTICO_TRATAMIENTO'] ?></option>
                                        <?php
                                        $Seleccion = mysqli_query($conex, "SELECT OPERADOR FROM ipsen_asegurador_operador_logistico WHERE DEPARTAMENTO='" . $fila['DEPARTAMENTO_PACIENTE'] . "' AND ASEGURADOR='" . $fila['ASEGURADOR_TRATAMIENTO'] . "' GROUP BY OPERADOR ORDER BY OPERADOR  ASC");
                                        while ($filas = mysqli_fetch_array($Seleccion)) {
                                            $OPERADOR_LOGISTICO = $filas['OPERADOR'];
                                            echo "<option>" . $OPERADOR_LOGISTICO . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <span id="cual_operador" style="display:none;">Cual</span>
                                    <input type="text" name="operador_logistico_nuevo" id="operador_logistico_nuevo" style="display:none; width:84%" />
                                    <br />
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <td><span>Punto De Entrega</span><br />
                                    <br />
                                </td>
                                <td>
                                    <input type="text" name="punto_entrega" id="punto_entrega" value="<?php echo $fila['PUNTO_ENTREGA'] ?>" />
                                    <br />
                                    <br />
                                </td>
                                <?php
                                $Seleccion1 = mysqli_query($conex, "SELECT * FROM ipsen_gestiones
                                WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' ORDER BY ID_GESTION DESC LIMIT 1");
                                $num1 = mysqli_num_rows($Seleccion1);
                                if ($num1 <= 0) {
                                ?>
                                    <td><span>Fecha Ultima Reclamacion</span><br />
                                        <br />
                                    </td>
                                    <td>
                                        <input type="date" name="fecha_reclamaciones" id="fecha_reclamaciones" value="<?php echo $fila['FECHA_ULTIMA_RECLAMACION_TRATAMIENTO'] ?>" />
                                        <br />
                                        <br />
                                    </td>
                                <?php
                                }
                                ?>
                                <input name="num1" type="text" id="num1" max="10" readonly="readonly" value="<?php echo $num1 ?>" style="display:none;" />
                                <?php
                                if ($num1 > 0) {
                                    while ($consul = mysqli_fetch_array($Seleccion1)) {
                                        $DESCRIPCION_COMUNICACION_GESTION = $consul['DESCRIPCION_COMUNICACION_GESTION'];
                                ?>
                                        <td>
                                            <span>Estado CTC</span>
                                            <br />
                                            <br />
                                        </td>
                                        <td>
                                            <input name="codigo_ultima_gestion" type="text" id="codigo_ultima_gestion" max="10" readonly="readonly" value="<?php echo $consul['ID_GESTION']; ?>" style="display:none" />
                                            <select type="text" name="estado_ctc" id="estado_ctc">
                                                <option><?php echo $consul['ESTADO_CTC_GESTION'] ?></option>
                                                <option>Aprobado</option>
                                                <option>Negado</option>
                                                <option>Pendiente Radicar</option>
                                                <option>Radicado</option>
                                            </select>
                                            <br />
                                            <br />
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
                                        <option><?php echo $consul['ESTADO_FARMACIA_GESTION'] ?></option>
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
                                    <select type="text" name="dificultad_acceso" id="dificultad_acceso">
                                        <option><?php echo $consul['DIFICULTAD_ACCESO_GESTION'] ?></option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
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
                                    <textarea style="width:98%; height:72.5px;" id="tipo_dificultad" name="tipo_dificultad"><?php echo $consul['TIPO_DIFICULTAD_GESTION'] ?></textarea>
                                    <br />
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <?PHP
                                        $fecha_actual = date('Y-m-d');
                                        $fecha_rec_act = explode("-", $fecha_actual);
                                        $anio_act = $fecha_rec_act[0];
                                        $mes_act = $fecha_rec_act[1];
                                        $dia_act = $fecha_rec_act[2];
                                        $dato = ((int)$mes_act);
                                        $ID = $ID_PACIENTE;
                                        $select_historial_pri = mysqli_query($conex, "SELECT * FROM ipsen_historial_reclamacion WHERE ID_PACIENTE_FK='$ID'");
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
                                            $INSERT_HISTORIAL = mysqli_query($conex, "INSERT INTO ipsen_historial_reclamacion(ID_PACIENTE_FK) VALUES('" . $consul['ID_PACIENTE'] . "')");
                                            echo mysqli_error($conex);
                                        }
                                ?>
                                <td>
                                    <span>Reclamo<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="reclamo" id="reclamo">
                                        <option><?php echo $reclamo ?></option>
                                        <?php
                                        if ($reclamo == 'NO') {
                                        ?>
                                            <option>SI</option>
                                        <?php
                                        }
                                        if ($reclamo == 'SI') {
                                        ?>
                                            <option>NO</option>
                                        <?php
                                        }
                                        if ($reclamo == '') {
                                        ?>
                                            <option>SI</option>
                                            <option>NO</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <span id="causa" style="display:none">Causa No Reclamacion<span class="asterisco">*</span></span>
                                    <span id="fecha_reclamacion_span" style="display:none">Fecha de Reclamaci&oacute;n<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="causa_no_reclamacion" id="causa_no_reclamacion" style="display:none">
                                        <option><?php echo $MOTIVO_NO_RECLAMACION ?></option>
                                        <option value="">Seleccione...</option>
                                        <option> Autorizacion radicada para Cita </option>
                                        <option> Autorizacion radicada para Examenes </option>
                                        <option> Autorizacion radicada para Medicamento </option>
                                        <option> Demora en la Autorizacion Prescripcion </option>
                                        <option> Demora en la Autorizacion Cita Medica </option>
                                        <option> Demora en la autorizacion de medicamento </option>
                                        <option> Error en Papeleria </option>
                                        <option> Falta de medicamento en el punto </option>
                                        <option> Falta cita para examenes </option>
                                        <option> Pendiente Solicitar Cita </option>
                                        <option> Pendiente Subir Formula A Mipres </option>
                                        <option> Sin red prestadora </option>
                                        <option> Cita inoportuna </option>
                                        <option> Falta de cita Reformulacion </option>
                                        <option> Falta de cita Aplicacion </option>
                                        <option> Falta de cita Valoracion </option>
                                        <option> Pago Anticipado </option>
                                        <option value="opc1"> En proceso de Reformulacion </option>
                                        <option> En proceso de Aplicacion </option>
                                        <option> En proceso de entrega </option>
                                        <option> No remision a entidad licenciada </option>
                                        <option> Desafiliacion Al sistema de Salud </option>
                                        <option> Falta de contacto </option>
                                        <option> ILocalizable </option>
                                        <option> Suspendido temporalmente </option>
                                        <option> Titulacion </option>
                                        <option> Voluntario </option>
                                        <option> Abandono </option>
                                        <option> Stock </option>
                                        <option> Suspendido por esquema de Aplicacion </option>
                                        <option> Falta de pago anticipado de EPS a IPS / OPL </option>
                                        <option> A demanda </option>
                                        <option> Traslado de Asegurador </option>
                                        <option> Pendiente Radicar Formula en Farmacia </option>
                                    </select>
                                    <input type="date" name="fecha_reclamacion" id="fecha_reclamacion" value="<?php echo $FECHA_RECLAMACION ?>" style="display:none" />
                                    <div id="fecha_no_reclamacion" style="display:none; position: relative; margin-top:10%;">
                                        <span id="">Fecha No Reclamacion<span class="asterisco">*</span></span>
                                        <input type="date" style="margin-top: 10px;" />
                                    </div>
                                </td>
                            </tr>
                            <script>
                                $('#causa_no_reclamacion').on('change', function() {
                                    var selectValor = $(this).val();
                                    if (selectValor == 'opc1') {
                                        $('#fecha_no_reclamacion').show();
                                    } else {
                                        $('#fecha_no_reclamacion').hide();
                                    }
                                });
                            </script>
                            <tr>
                                <td>
                                    <span id="consecutivo_betaferon_span" style="display:none">Consecutivo Betaferon<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="text" name="consecutivo_betaferon" id="consecutivo_betaferon" value="<?php echo $consul['CONSECUTIVO_BETAFERON'] ?>" style="display:none" />
                                </td>
                            </tr>
                        <?php
                                    }
                                } else {
                        ?>
                        </tr>
                    <?php
                                }
                    ?>
                    <tr>
                        <td>
                            <span style="text-transform:capitalize;">Medicamento</span>
                            <br />
                            <br />
                        </td>
                        <td>
                            <input style="text-transform:capitalize;" type="text" readonly="readonly" name="MEDICAMENTO" id="MEDICAMENTO" value="<?php echo $fila['PRODUCTO_TRATAMIENTO'] ?>" />
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
                                $producto_tratamiento = $fila['PRODUCTO_TRATAMIENTO'];
                                $dosis_bd = $fila['DOSIS_TRATAMIENTO'];
                                if ($producto_tratamiento == 'ADEMPAS 1MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2.5MG 84TABL' || $producto_tratamiento == 'ADEMPAS 1.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 0.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2MG 42TABL' || $producto_tratamiento == 'ADEMPAS') {
                                    $producto_tratamiento = 'ADEMPAS';
                                }
                                if ($producto_tratamiento == 'KOGENATE FS 2000 PLAN') {
                            ?>
                                <input type="text" maxlength="6" name="Dosis3" id="Dosis3" onKeyDown="return validarNumeros(event)" value="<?php echo $fila['DOSIS_TRATAMIENTO'] ?>" />
                            <?PHP
                                }
                                if ($producto_tratamiento == 'Xofigo 1x6 ml CO') {
                            ?>
                                <input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $fila['DOSIS_TRATAMIENTO'] ?>" />
                            <?PHP
                                }
                                if ($producto_tratamiento == 'Kovaltry') {
                            ?>
                                <input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $fila['DOSIS_TRATAMIENTO'] ?>" />
                            <?PHP
                                }
                                if ($producto_tratamiento == 'Jivi') {
                            ?>
                                <input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $fila['DOSIS_TRATAMIENTO'] ?>" />
                            <?PHP
                                }
                                if ($producto_tratamiento != 'Xofigo 1x6 ml CO' && $producto_tratamiento != 'KOGENATE FS 2000 PLAN' && $producto_tratamiento != 'Kovaltry' && $producto_tratamiento != 'Jivi') {
                            ?>
                                <select name="Dosis" id="Dosis">
                                    <option><?php echo $fila['DOSIS_TRATAMIENTO'] ?></option>
                                    <?php
                                    $producto = $fila['PRODUCTO_TRATAMIENTO'];
                                    $select = mysqli_query($conex, "SELECT DOSIS FROM  ipsen_dosis WHERE NOMBRE_REFERENCIA LIKE '" . $producto_tratamiento . "%' AND DOSIS!='$dosis_bd'");
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
                        <td width="20%">
                            <span>Status del Paciente</span>
                            <br />
                            <br />
                        </td>
                        <td width="30%">
                            <select type="text" name="status_paciente" id="status_paciente">
                                <option><?php echo $fila['STATUS_PACIENTE']; ?></option>
                            </select>
                            <br />
                            <br />
                        </td>
                        <td>
                            <span style="text-transform:capitalize;">Tratamiento Previo</span>
                            <br />
                            <br />
                        </td>
                        <td>
                            <select type="text" name="tratamiento_previo" id="tratamiento_previo" onchange="trat_previo(this)">
                                <option><?php echo $tratamiento_previo = $fila['TRATAMIENTO_PREVIO'] ?></option>
                                <?php
                                $Seleccion = mysqli_query($conex, "SELECT TRATAMIENTO_PREVIO FROM `ipsen_listas` WHERE TRATAMIENTO_PREVIO != '' AND TRATAMIENTO_PREVIO!='$tratamiento_previo' ORDER BY TRATAMIENTO_PREVIO ASC");
                                while ($fila = mysqli_fetch_array($Seleccion)) {
                                    $TRATAMIENTO_PREVIO = $fila['TRATAMIENTO_PREVIO'];
                                    echo "<option>" . $TRATAMIENTO_PREVIO . "</option>";
                                }
                                ?>
                                <option selected="selected">Otro</option>
                            </select>
                            <div id="otro_tratamiento" style="display:none">
                                <span>Cual?</span>
                                <input name="tratamiento_previo_otro" id="tratamiento_previo_otro" type="text" style="width:78%;" />
                            </div>
                            <br />
                            <br />
                        </td>
                    </tr>
                    <?php
                                if ($num1 > 0) {
                    ?>
                        <tr>
                            <td>
                                <span>Descripcion de Comunicaci&oacute;n</span>
                                <br />
                                <br />
                            </td>
                            <td colspan="3">
                                <textarea style="width:98%; height:72.5px;" id="descripcion_comunicacion" name="descripcion_comunicacion"><?php echo $DESCRIPCION_COMUNICACION_GESTION ?></textarea>
                                <br />
                                <br />
                            </td>
                        </tr>
                    <?php
                                }
                    ?>
                    <tr>
                        <td>
                            <span>Crear Gesti&oacute;n</span>
                            <br />
                            <br />
                        </td>
                        <td colspan="1">
                            <select name="crear" id="crear">
                                <option value="NO"></option>
                                <option>SI</option>
                                <option>NO</option>
                            </select>
                            <br />
                            <br />
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display:none" id="nueva">
                                <span>Descripcion Nueva Comunicaci&oacute;n</span>
                                <br />
                                <br />
                            </div>
                        </td>
                        <td colspan="3">
                            <div style="display:none" id="nueva2">
                                <textarea style="width:98%; height:72.5px;" id="descripcion_nuevo_comunicacion" name="descripcion_nuevo_comunicacion"></textarea>
                                <br />
                                <br />
                            </div>
                        </td>
                    </tr>
                <?php
                            }
                ?>
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