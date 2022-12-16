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
    <script type="text/javascript" src="../presentacion/js/validar_campos_modificacion.js"></script>
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
                url: 'listado_producto_status_cargar.php',
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
        /**/
        function reclamacion() {
            var reclamo = $('#reclamo').val();
            var MEDICAMENTO = $('#MEDICAMENTO').val();
            if (reclamo == 'NO') {
                $("#causa").css('display', 'block');
                $('#causa_no_reclamacion').css('display', 'block');
                $('#fecha_no_reclamacion').css('display', 'block');
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
            $("#estado_farmacia").change(function() {
                $("#estado_farmacia_nuevo").val('');
                var estado_farmacia = $('#estado_farmacia').val();
                if (estado_farmacia == 'Otro') {
                    $('#estado_farmacia_nuevo').css('display', 'inline-block');
                    $('#cual_medico_ultimo').css('display', 'inline-block');
                }
                if (estado_farmacia != 'Otro') {
                    $('#estado_farmacia_nuevo').css('display', 'none');
                    $('#cual_medico_ultimo').css('display', 'none');
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
                $("#causa_no_reclamacion option:eq(19)").attr("selected", "selected");
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

    <body class="body" style="width:100%;">
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
                                $Dosis = $fila['DOSIS_TRATAMIENTO'];
                                $STATUS_PACIENTE = $fila['STATUS_PACIENTE'];
                                $REFERENCIA = $fila['PRODUCTO_TRATAMIENTO'];
                                $producto_tratamiento = $fila['PRODUCTO_TRATAMIENTO'];
                                $dosis_bd = $fila['DOSIS_TRATAMIENTO'];
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
                                            <span>Codigo Tratamiento</span>
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
                                            <option>Secuenciacion</option>
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
                                        <input type="text" name="nombre" id="nombre" value="<?php echo $fila['NOMBRE_PACIENTE']; ?>" onkeypress="return check(event)" />
                                    </td>
                                    <td>
                                        <span>Apellidos<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="apellidos" id="apellidos" value="<?php echo $fila['APELLIDO_PACIENTE']; ?>" onkeypress="return check(event)" />
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
                                        <input type="number" name="identificacion" id="identificacion" value="<?php echo $fila['IDENTIFICACION_PACIENTE']; ?>" />
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
                                                        <span>N&uacute;mero:</span>
                                                    </td>
                                                    <td bgcolor="#FFFFFF">
                                                        <span>
                                                            <input name="numero" id="numero" type="text" maxlength="5" style=" width:45%" />
                                                            -
                                                            <input name="numero2" id="numero2" type="text" maxlength="5" style=" width:45%" />
                                                        </span>
                                                    </td>
                                                    <td></td>
                                                    <td bgcolor="#FFFFFF">
                                                    </td>
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
                                        <span>Acudiente</span>
                                    </td>
                                    <td>
                                        <input type="text" name="acudiente" id="acudiente" value="<?php echo $fila['ACUDIENTE_PACIENTE'] ?>" onkeypress="return check(event)" />
                                    </td>
                                    <td>
                                        <span>Telefono del Acudiente</span>
                                    </td>
                                    <td>
                                        <input type="number" name="telefono_acudiente" id="telefono_acudiente" value="<?php echo $fila['TELEFONO_ACUDIENTE_PACIENTE'] ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Clasificacion Patologica<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <span style="width:30%;">
                                            <input type="text" name="clasificacion_patologica" id="clasificacion_patologica" value="<?php echo $fila['CLASIFICACION_PATOLOGICA_TRATAMIENTO'] ?>" onkeypress="return check(event)" />
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
                                        <span>Fecha de la Proxima Llamada<span class="asterisco">*</span></span>
                                    </td>
                                    <?php
                                    $Sel = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' ORDER BY ID_GESTION DESC LIMIT 1");
                                    while ($con = mysqli_fetch_array($Sel)) {
                                        $ID_GESTION_ULT = $con['ID_GESTION'];
                                        $FECHA_NO_RECLAMACION = $con['FECHA_CITA_PROGRAMADA'];
                                        $FECHA_RECLAMACION_GESTION = $con['FECHA_RECLAMACION_GESTION'];
                                        $RECLAMO_GESTION = $con['RECLAMO_GESTION'];
                                        $CAUSA_NO_RECLAMACION_GESTION = $con['CAUSA_NO_RECLAMACION_GESTION'];
                                    ?>
                                        <td>
                                            <input type="text" name="id_gestion_ult" id="id_gestion_ult" value="<?php echo $ID_GESTION_ULT ?>" style="display:none" />
                                            <input type="date" name="fecha_proxima_llamada_ant" id="fecha_proxima_llamada_ant" value="<?php echo $con['FECHA_PROGRAMADA_GESTION'] ?>" style="display:none" />
                                            <input type="date" name="fecha_proxima_llamada" id="fecha_proxima_llamada" value="<?php echo $con['FECHA_PROGRAMADA_GESTION'] ?>" min="<?php echo date('Y-m-d'); ?>">
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
                        <table width="100%">
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

                                <td><span>Operador Logistico<span class="asterisco">*</span></span>
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
                                    <span>Punto De Entrega</span>
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
                                <?php
                                $Seleccion1 = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' ORDER BY ID_GESTION DESC LIMIT 1");
                                $num1 = mysqli_num_rows($Seleccion1);
                                if ($num1 <= 0) {
                                ?>
                                    <td>
                                        <span>Fecha Ultima Reclamacion</span>
                                    </td>
                                    <td>
                                        <input type="date" name="fecha_reclamaciones" id="fecha_reclamaciones" value="<?php echo $fila['FECHA_ULTIMA_RECLAMACION_TRATAMIENTO'] ?>" />
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
                                        </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="otro_punto" style="display:none">
                                    <span>Punto de entrega por habilitar<span class="asterisco">*</span></span>
                                    <input name="punto_entrega_otro" id="punto_entrega_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Medico ultima formula</span>
                                </td>
                                <td>
                                    <select type="text" name="estado_farmacia" id="estado_farmacia">
                                        <option><?php echo $consul['ESTADO_FARMACIA_GESTION'] ?></option>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        $Seleccion = mysqli_query($conex, "SELECT MEDICO FROM `ipsen_listas` WHERE MEDICO != '' ORDER BY MEDICO ASC");
                                        while ($fila = mysqli_fetch_array($Seleccion)) {
                                            $MEDICO = $fila['MEDICO'];
                                            echo "<option>" . $MEDICO . "</option>";
                                        }
                                        ?>
                                        <?php
                                        if ($privilegios == '1') {
                                        ?>
                                            <option value="Otro">Otro</option>
                                    </select>
                                    <span id="cual_medico_ultimo" style="display:none;">Cual</span>
                                    <input type="text" name="estado_farmacia_nuevo" id="estado_farmacia_nuevo" style="display:none; width:84%" onkeypress="return check(event)" />
                                <?php
                                        }
                                ?>
                                </td>
                                <td>
                                    <span>Dificultad en el Acceso</span>
                                </td>
                                <td>
                                    <select type="text" name="dificultad_acceso" id="dificultad_acceso">
                                        <option><?php echo $consul['DIFICULTAD_ACCESO_GESTION'] ?></option>
                                        <option>SI</option>
                                        <option>NO</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Tipo de Dificultad</span>
                                </td>
                                <td colspan="3">
                                    <textarea style="width:98%; height:72.5px;" id="tipo_dificultad" name="tipo_dificultad"><?php echo $consul['TIPO_DIFICULTAD_GESTION'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <?PHP
                                        $fecha_actual = date('Y-m-d');
                                        $fecha_rec_act = explode("-", $fecha_actual);
                                        $anio_act = $fecha_rec_act[0];
                                        $mes_act  = $fecha_rec_act[1];
                                        $dia_act  = $fecha_rec_act[2];
                                        $dato = ((int)$mes_act);
                                        $ID = $ID_PACIENTE;
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
                                            $INSERT_HISTORIAL = mysqli_query($conex, "INSERT INTO ipsen_historial_reclamacion(ID_PACIENTE_FK) VALUES('" . $consul['ID_PACIENTE'] . "')");
                                            echo mysqli_error($conex);
                                        }
                                ?>
                                <td>
                                    <span>Reclamo<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="reclamo" id="reclamo">
                                        <option><?php echo $RECLAMO_GESTION ?></option>
                                        <?php
                                        if ($RECLAMO_GESTION == 'NO' || $RECLAMO_GESTION == 'SI') {    ?>
                                            <option>SI</option>
                                            <option>NO</option>
                                        <?php    } else {     ?>
                                            <option>SI</option>
                                            <option>NO</option>
                                        <?php     }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <span id="causa" style="display:none">Causa No Reclamacion<span class="asterisco">*</span></span>
                                    <span id="fecha_reclamacion_span" style="display:none">Fecha de Reclamacion<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select type="text" name="causa_no_reclamacion" id="causa_no_reclamacion" style="display:none">
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
                                    <input type="date" name="fecha_reclamacion" id="fecha_reclamacion" value="<?php echo $FECHA_RECLAMACION_GESTION ?>" style="display:none" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Fecha Cita Programada<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="date" value="<?php echo $FECHA_NO_RECLAMACION ?>" name="fecha_cita_programada" id="fecha_cita_programada">
                                </td>
                            </tr>
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
                        </td>
                        <td>
                            <input style="text-transform:capitalize;" type="text" readonly="readonly" name="MEDICAMENTO" id="MEDICAMENTO" value="<?php echo $REFERENCIA ?>" />
                        </td>
                        <td>
                            <span style="text-transform:capitalize;">Dosis Tratamiento<span class="asterisco">*</span></span>
                        </td>
                        <td>
                            <?php
                                if ($producto_tratamiento == 'ADEMPAS 1MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2.5MG 84TABL' || $producto_tratamiento == 'ADEMPAS 1.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 0.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2MG 42TABL' || $producto_tratamiento == 'ADEMPAS') {
                                    $producto_tratamiento = 'ADEMPAS';
                                }
                                if ($producto_tratamiento == 'KOGENATE FS 2000 PLAN') {
                            ?>
                                <input type="text" maxlength="6" name="Dosis3" id="Dosis3" onKeyDown="return validarNumeros(event)" value="<?php echo $Dosis ?>" />
                            <?PHP
                                }
                                if ($producto_tratamiento == 'Xofigo 1x6 ml CO') {
                            ?>
                                <input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $Dosis ?>" />
                            <?PHP
                                }
                                if ($producto_tratamiento == 'Kovaltry') {
                            ?>
                                <input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $Dosis ?>" />
                            <?PHP
                                }
                                if ($producto_tratamiento == 'Jivi') {
                            ?>
                                <input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $Dosis ?>" />
                            <?PHP
                                }
                                if ($producto_tratamiento != 'Xofigo 1x6 ml CO' && $producto_tratamiento != 'KOGENATE FS 2000 PLAN' && $producto_tratamiento != 'Kovaltry' && $producto_tratamiento != 'Jivi') {
                            ?>
                                <select name="Dosis" id="Dosis">
                                    <option><?php echo $Dosis ?></option>
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
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">
                            <span>Status del Paciente</span>
                        </td>
                        <td width="30%">
                            <select type="text" name="status_paciente" id="status_paciente">
                                <option><?php echo $STATUS_PACIENTE ?></option>
                                <option>Mantenimiento</option>
                                <option>Titulacion</option>
                            </select>
                        </td>
                        <td>
                            <span style="text-transform:capitalize;">Tratamiento Previo</span>
                        </td>
                        <td>
                            <select type="text" name="tratamiento_previo" id="tratamiento_previo" onchange="trat_previo(this)">
                                <option><?php echo $tratamiento_previo = $fila['TRATAMIENTO_PREVIO'] ?></option>
                                <?php
                                $Seleccion = mysqli_query($conex, "SELECT DISTINCT TRATAMIENTO_PREVIO FROM `ipsen_listas` WHERE TRATAMIENTO_PREVIO != '' AND TRATAMIENTO_PREVIO!='" . $tratamiento_previo . "' ORDER BY TRATAMIENTO_PREVIO ASC");
                                while ($fila = mysqli_fetch_array($Seleccion)) {
                                    $TRATAMIENTO_PREVIO = $fila['TRATAMIENTO_PREVIO'];
                                    echo "<option>" . $TRATAMIENTO_PREVIO . "</option>";
                                }
                                ?>
                                <option selected="selected">Otro</option>
                            </select>
                            <div id="otro_tratamiento" style="display:none">
                                <span>Cual?</span>
                                <input name="tratamiento_previo_otro" id="tratamiento_previo_otro" type="text" style="width:78%;" onkeypress="return check(event)" />
                            </div>
                        </td>
                    </tr>
                    <?php
                                if ($num1 > 0) {
                    ?>
                        <tr>
                            <td>
                                <span>Descripcion de Comunicacion</span>
                            </td>
                            <td colspan="3">
                                <textarea style="width:98%; height:72.5px;" id="descripcion_comunicacion" name="descripcion_comunicacion"><?php echo $DESCRIPCION_COMUNICACION_GESTION ?></textarea>
                            </td>
                        </tr>
                    <?php
                                }
                    ?>
                    <tr>
                        <td>
                            <span>Descripcion y justificacion del cambio<span class="asterisco">*</span></span>
                        </td>
                        <td colspan="3">
                            <textarea class="tf w-input" id="txtCurp" style="width:98%; height:72.5px;" minlength="20" id="descripcion_nuevo_comunicacion" name="descripcion_nuevo_comunicacion" maxlength="5000" onkeypress="return check(event)" placeholder="Nota" required></textarea>
                        </td>
                    </tr>
                <?php } ?>
                        </table>
                        <center>
                            <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_actualizar">
                        </center>
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