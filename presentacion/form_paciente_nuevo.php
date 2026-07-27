<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Bavaria</title>
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
    <script src="css/SpryAssets/SpryAccordion.js" type="text/javascript"></script>
    <link href="css/SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
    <link href="css/estilo_form_paciente.css" type="text/css" />
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/direccion.js"></script>
    <!-- <script type="text/javascript" src="js/validar_campos_pacientes.js"></script> -->
    <script type="text/javascript" src="js/validaciones.js"></script>
    <script type="text/javascript" src="js/calcular_edad.js"></script>
    <script type="text/javascript" src="js/validar_caracteres.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        body {
            background: #eee;
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 15px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 28px;
            font-size: 14px;
        }

        .select2-search--dropdown {
            display: block;
            padding: 4px;
        }

        .select2-container--default .select2-results>.select2-results__options {
            max-height: 200px;
            overflow-y: auto;
            font-size: 14px;
        }

        .select2-search--dropdown .select2-search__field {
            padding: 4px;
            width: 100%;
            box-sizing: border-box;
            font-size: 14px;
        }

        select,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: 13px;
            line-height: inherit;
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: 13px;
            line-height: inherit;
        }

        .signupdiv {
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 1px 2px 3px #ccc;
            padding: 10px;
            margin-top: 100px;
        }

        .form-group {
            margin-bottom: 10px;
        }

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

    <script>
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

    <script>
        $(document).ready(function() {
            $('#cambio').click(function() {
                $('#cambio_direccion').toggle();
                $('#direccion').val('');
                $("#VIA option:eq(0)").attr("selected", "selected");
                $("#interior option:eq(0)").attr("selected", "selected");
                $('#detalle_via').val('');
                $('#detalle_int').val('');
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

            // Si cambia el teléfono y la opción es SI, actualiza el WhatsApp
            $("#telefono").on("keyup change", function() {

                if ($("input[name='whatsApp']:checked").val() == "SI") {
                    $("#num_WhatsApp").val($(this).val());
                }

            });

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

        });
    </script>

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
                                    <span>Codigo de la Visita</span>
                                </td>
                                <td width="30%">
                                    <?php
                                    $Seleccion = mysqli_query($conex, "SELECT ID FROM `responsable` WHERE ID != '' ORDER BY ID DESC LIMIT 1");
                                    while ($fila = mysqli_fetch_array($Seleccion)) {
                                        $id = $fila['ID_PACIENTE'] + 1;
                                        function Zeros($numero, $largo)
                                        {
                                            $resultado = $numero;
                                            while (strlen($resultado) < $largo) {
                                                $resultado = "0" . $resultado;
                                            }
                                            return $resultado;
                                        }
                                        $responsable_id = Zeros($id, 5);
                                    }
                                    ?>
                                    <input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%;display:none" value="SI" checked="checked" />
                                    <input name="codigo_usuario" type="text" id="codigo_usuario" max="10" readonly="readonly" value="<?php echo $responsable_id; ?>" />
                                    <input name="codigo_usuario2" type="hidden" id="codigo_usuario2" max="10" readonly="readonly" value="<?php echo $responsable_id; ?>" />
                                </td>
                                <td>
                                    <span>Estado de la visita<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <select name="estado_paciente" id="estado_paciente">
                                        <option value="">Seleccione...</option>
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                        <option>Nuevo</option>
                                        <option>Suspendido</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Nombres del responsable<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="text" name="nombres" id="nombres" onkeypress="return check(event)" />
                                </td>
                                <td>
                                    <span>Apellidos del responsable<span class="asterisco">*</span></span>
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
                                        <option value="">Seleccione...</option>
                                        <option>C.C</option>
                                        <option>C.E</option>
                                        <option>P.T</option>
                                        <option>T.I</option>
                                        <option>R.C</option>
                                    </select>
                                </td>
                                <td>
                                    <span>Identificacion<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="number" name="identificacion" id="identificacion">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Telefono<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="text" name="telefono" id="telefono">
                                </td>
                                <td>
                                    <span>¿Este número tiene WhatsApp?</span>
                                </td>
                                <td>
                                    <input type="radio" name="whatsApp" value="" checked style="display:none">

                                    <input type="radio" name="whatsApp" id="whatsapp_si" value="SI">
                                    <label for="whatsapp_si">SI</label>

                                    <input type="radio" name="whatsApp" id="whatsapp_no" value="NO">
                                    <label for="whatsapp_no">NO</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Número con WhatsApp</span>
                                </td>
                                <td>
                                    <input type="text" name="num_WhatsApp" id="num_WhatsApp">
                                </td>
                                <td style="width:10%;">
                                    <span>Direccion del negocio<span class="asterisco">*</span></span>
                                </td>
                                <td bgcolor="#FFFFFF" colspan="3">
                                    <input type="text" name="direccion" id="direccion" readonly style="width:98.5%;">
                                </td>
                            </tr>
                            <tr>
                                <td><span>Departamento<span class="asterisco">*</span></span></td>
                                <td>
                                    <select type="text" name="departamento" id="departamento" onchange="mostrar_ciudades()" style="text-transform:capitalize; width:98%;">
                                        <option><?php echo $departamento ?></option>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        $Seleccion = mysqli_query($conex, "SELECT nombre FROM `departamento` WHERE nombre != '' ORDER BY nombre ASC");
                                        while ($fila = mysqli_fetch_array($Seleccion)) {
                                            $DEPARTAMENTO = $fila['nombre'];
                                            echo "<option>" . $DEPARTAMENTO . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><span>Ciudad<span class="asterisco">*</span></span></td>
                                <td>
                                    <select type="text" name="ciudad" id="ciudad" style="width:98.5%;">
                                        <option><?php echo $ciudad ?></option>
                                        <option value="">Seleccione...</option>
                                    </select>
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
                        </table>
                    </div>
                </div>
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab" style="padding:5px"><strong>DETALLES</strong></div>
                    <div class="AccordionPanelContent">
                        <table width="100%" border="0">
                            <tr>
                                <td width="20%">
                                    <span>¿El negocio continúa funcionando?<span class="asterisco">*</span></span>
                                </td>
                                <td width="30%">
                                    <input type="radio" name="negocio_funciona" style=" width:20%; display:none" value="" checked="checked" />
                                    <input type="radio" name="negocio_funciona" id="negocio_funciona_si" style=" width:20%;" value="SI" />SI
                                    <input type="radio" name="negocio_funciona" id="negocio_funciona_no" style=" width:20%;" value="NO" />NO
                                </td>
                                <td width="20%">
                                    <span>¿Sigues siendo el propietario o administrador?<span class="asterisco">*</span></span>
                                </td>
                                <td width="30%">
                                    <input type="radio" name="propietario" style=" width:20%; display:none" value="" checked="checked" />
                                    <input type="radio" name="propietario" id="propietario_si" style=" width:20%;" value="SI" />SI
                                    <input type="radio" name="propietario" id="propietario_no" style=" width:20%;" value="NO" />NO
                                </td>
                            </tr>
                            <tr id="fila_nuevo_responsable" style="display:none;">
                                <td>
                                    <span>Nombre del nuevo responsable<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="text" name="nombres_nuevo_pro" id="nombres_nuevo_pro">
                                </td>

                                <td>
                                    <span>Apellidos del nuevo responsable<span class="asterisco">*</span></span>
                                </td>
                                <td>
                                    <input type="text" name="apellidos_nuevo_pro" id="apellidos_nuevo_pro">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>¿En que horario podenos realizar la visita?</span>
                                </td>
                                <td>
                                    <input type="time" name="horario_visita" id="horario_visita">
                                </td>
                                <td>
                                    <span>¿Qué día te queda más fácil recibir al asesor?</span>
                                </td>
                                <td>
                                    <input type="date" name="dia_visita" id="dia_visita">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab" style="padding:5px"><strong>INFORMACION DE LA VISITA</strong></div>
                    <div class="AccordionPanelContent">
                        <table width="100%" border="0">
                            <tr>
                                <td width="20%">
                                    <span>¿Te gustaría participar en este programa?</span>
                                </td>
                                <td width="30%">
                                    <select name="interes_programa" id="interes_programa">
                                        <option value="">Seleccione...</option>
                                        <option value="Muy interesado">Muy interesado</option>
                                        <option value="Interesado">Interesado</option>
                                        <option value="Indiferente">Indiferente</option>
                                        <option value="No interesado">No interesado</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <span>¿Qué podría impedir que realicemos la visita?</span>
                                </td>
                                <td width="30%">
                                    <select name="barrera" id="barrera">
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
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <span>Horario de apertura</span>
                                </td>
                                <td width="30%">
                                    <input type="time" name="hora_inicio" id="hora_inicio">
                                </td>
                                <td width="20%">
                                    <span>Horario de cierre</span>
                                </td>
                                <td width="30%">
                                    <input type="time" name="hora_fin" id="hora_fin">
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <span>Que dias toma de descanso</span>
                                </td>
                                <td width="30%">
                                    <textarea name="descanso" id="descanso"></textarea>
                                </td>
                                <td width="20%">
                                    <span>Nivel de interés en el programa</span>
                                </td>
                                <td width="30%">
                                    <select name="nivel_interes" id="nivel_interes">
                                        <option value="">Seleccione...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <br />
                    </div>
                </div>
                <div class="AccordionPanel">
                    <div class="AccordionPanelTab" style="padding:5px"><strong>NOTAS U OBSERVACIONES</strong></div>
                    <div class="AccordionPanelContent">
                        <table width="100%" border="0">
                            <tr>
                                <td style="padding-top:15px;">
                                    <textarea
                                        class="tf w-input"
                                        style="width:100%; height:100px;"
                                        id="nota"
                                        name="nota"
                                        maxlength="5000"
                                        onkeypress="return check(event)"
                                        placeholder="Nota"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top:15px; text-align:center;">
                                    <input
                                        id="registrar"
                                        name="registrar"
                                        type="submit"
                                        value="REGISTRAR"
                                        class="btn_registrar"
                                        onclick="return validar(paciente_nuevo,1); this.disabled=true;" />
                                </td>
                            </tr>
                        </table>
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