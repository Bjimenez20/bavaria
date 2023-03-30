<?php
include('../logica/session.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/direccion.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/jquery.js"></script>
    <script type="text/javascript" src="js/validar_campos_evento_adverso.js"></script>
    <script>
        function trat_previo(sel) {
            if (sel.value == "Muerte") {
                divC = document.getElementById("fecha_muerte_id");
                divC.style.display = "";
            }
            if (sel.value != "Muerte") {
                divC = document.getElementById("fecha_muerte_id");
                divC.style.display = "none";
            }
        }
    </script>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
include('../logica/consulta_ea.php');
$ID_PACIENTE = base64_decode($xnfgti);
$ID_GESTION = base64_decode($artget);
if ($privilegios != '' && $usua != '') {
    $SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_usuario WHERE USER = '" . $usua . "'");
    while ($opcion = mysqli_fetch_array($SELECT_USUARIO_TOTAL)) {
        $NOMBRES = $opcion['NOMBRES'];
        $APELLIDOS = $opcion['APELLIDOS'];
        $EMAIL = $opcion['EMAIL'];
    }
    $Seleccion = mysqli_query($conex, "SELECT * FROM `ipsen_pacientes` AS P INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK = P.ID_PACIENTE WHERE ID_PACIENTE = '" . $ID_PACIENTE . "'");
    while ($fila = mysqli_fetch_array($Seleccion)) {
        $ID_PACIENTE2 = $fila['ID_PACIENTE'];
        $ID_GESTION2 = $fila['ID_GESTION'];
        $EDAD = $fila['EDAD_PACIENTE'];
        $TIPO_IDENTIFICACION_PACIENTE = $fila['TIPO_IDENTIFICACION_PACIENTE'];
        $IDENTIFICACION_PACIENTE = $fila['IDENTIFICACION_PACIENTE'];
        $FECHA_NACIMIENTO = $fila['FECHA_NACIMINETO_PACIENTE'];
        $GENERO_PACIENTE = $fila['GENERO_PACIENTE'];
        $CLASIFICACION_PATOLOGICA_TRATAMIENTO = $fila['CLASIFICACION_PATOLOGICA_TRATAMIENTO'];
        $NOMBRE_PACIENTE = $fila['NOMBRE_PACIENTE'];
        $APELLIDO_PACIENTE = $fila['APELLIDO_PACIENTE'];
        $DEPARTAMENTO_PACIENTE = $fila['DEPARTAMENTO_PACIENTE'];
        $CIUDAD_PACIENTE = $fila['CIUDAD_PACIENTE'];
    }

    $SELECT_GESTION = mysqli_query($conex, "SELECT ID_GESTION FROM ipsen_gestiones ORDER BY ID_GESTION DESC LIMIT 1");
    while ($dato = mysqli_fetch_array($SELECT_GESTION)) {
        $ID_GESTION = $dato['ID_GESTION'];
        $ID_GESTION3 = $ID_GESTION + 1;
    }

    $re = '/\b(\w)[^\s]*\s*/m';
    $str = $NOMBRE_PACIENTE . ' ' . $APELLIDO_PACIENTE;
    $subst = '$1';

    $result = preg_replace($re, $subst, $str);

    $SELECT_EV = mysqli_query($conex, "SELECT COUNT(*) AS EV FROM `ipsen_gestiones` WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE2 . "' AND EVENTO_ADVERSO_GESTION = 'SI'");
    $data = mysqlI_fetch_assoc($SELECT_EV);

    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $cad = '';
    for ($i = 0; $i < 8; $i++) {
        $cad .= substr($characters, rand(0, 61), 1);
    }
?>

    <body style="padding: 0; margin: 0;">
        <form>
            <table class="table table-bordered" cellspacing="0" cellpadding="0" style="width: 100%;" id="header">
                <tbody>
                    <tr>
                        <td>
                            <img src="../presentacion/imagenes/EA.png" alt="" width="170" height="75" />
                        </td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td colspan="2">INSPECCIÓN, VIGILANCIA Y CONTROL</td>
                                        <td colspan="2">VIGILANCIA</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="font-weight: 700">
                                            FORMATO REPORTE DE SOSPECHA DE EVENTOS ADVERSOS A
                                            MEDICAMENTOS - FOREAM
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Código: IVC-VIG-FM026</td>
                                        <td>Versión: 01</td>
                                        <td>Fecha de Emisión: 05/04/2016</td>
                                        <td>Página 1 de 3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" cellspacing="0" cellpadding="0" style="width: 100%;">
                <tbody>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="titulos" style="font-weight: 700">1. INFORMACIÓN DEL REPORTANTE</td>
                                    </tr>
                                    <input type="text" name="codigo_paciente" id="codigo_paciente" value="<?php echo $ID_PACIENTE2 ?>" readonly="readonly">
                                    <input type="text" name="ID_GESTION" id="ID_GESTION" value="<?php echo $ID_GESTION3 ?>" readonly="readonly" style="display: none;">
                                    <tr>
                                        <td colspan="1" style="font-weight: 700; background-color: #DBDBDB;">
                                            Fecha de notificación
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Origen del reporte
                                            <hr>
                                            Departamento – Municipio
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Nombre de la Institución donde ocurrió el evento
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Código PNF
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <input type="date" class="form-control w-100 h-100" name="fecha_notificacion" id="fecha_notificacion" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col d-flex justify-content-center">
                                                    <input type="text" class="form-control w-100 h-100" name="departamento" id="departamento" value="<?php echo $DEPARTAMENTO_PACIENTE ?>" readonly="readonly">
                                                </div>
                                                <div class="col-auto d-flex justify-content-center align-items-center">
                                                    <span>-</span>
                                                </div>
                                                <div class="col d-flex justify-content-center">
                                                    <input type="text" class="form-control w-100 h-100" name="municipio" id="municipio" value="<?php echo $CIUDAD_PACIENTE ?>" readonly="readonly">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control w-100 h-100" name="institucion_evento" id="institucion_evento">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control w-100 h-100" name="codigo_pnf" id="codigo_pnf">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Nombre del Reportante primario
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Nombre del Paciente o Acudiente
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Consecutivo
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Profesión del reportante primario
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control w-100 h-100" name="nombre_usuario" id="nombre_usuario" value="<?php echo $NOMBRES . ' ' . $APELLIDOS ?>" readonly="readonly">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control w-100 h-100" name="nombre_paciente_acudiente" id="nombre_paciente_acudiente" value="">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control w-100 h-100" name="consecutivo" id="consecutivo" value="<?php echo $cad ?>" readonly="readonly">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control w-100 h-100" name="profecion_usuario" id="profecion_usuario">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700; background-color: #DBDBDB;" colspan="4">
                                            Correo electrónico institucional del reportante primario
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <input type="email" class="form-control w-100 h-100" name="correo_usuario" id="correo_usuario" value="<?php echo $EMAIL ?>" readonly="readonly">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td colspan="7" class="titulos" style="font-weight: 700">2. INFORMACIÓN DEL PACIENTE</td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" style="font-weight: 700; background-color: #DBDBDB;">
                                            Fecha de nacimiento del paciente
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Edad del paciente en el momento del EA
                                            <hr>
                                            Edad – Años/Meses/ días
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Documento de identificación del paciente
                                            <hr>
                                            CC | TI | RC | NUIP | Cód. Lab | Otro | S/I
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Iniciales del paciente
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Sexo
                                            <hr>
                                            M | F | S/I
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Peso
                                            <hr>
                                            (Kg)
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Talla
                                            <hr>
                                            (cm)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <input type="date" class="form-control w-100 h-100" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $FECHA_NACIMIENTO ?>" readonly="readonly" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control w-100 h-100" name="edad_paciente" id="edad_paciente" value="<?php echo $EDAD ?>" readonly="readonly" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col d-flex justify-content-center">
                                                    <input type="text" class="form-control w-100 h-100" name="tipo_documento_paciente" id="tipo_documento_paciente" value="<?php echo $TIPO_IDENTIFICACION_PACIENTE ?>" readonly="readonly">
                                                </div>
                                                <div class="col-auto d-flex justify-content-center align-items-center">
                                                    <span>-</span>
                                                </div>
                                                <div class="col d-flex justify-content-center">
                                                    <input type="text" class="form-control w-100 h-100" name="documento_paciente" id="documento_paciente" value="<?php echo $IDENTIFICACION_PACIENTE ?>" readonly="readonly">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control w-100 h-100" name="iniciales_pa" id="iniciales_pa" value="<?php echo $result ?>" style="width:90%; height:100%;" readonly="readonly">
                                        </td>
                                        <?php if ($GENERO_PACIENTE == 'Mujer') { ?>
                                            <td>
                                                <input type="text" class="form-control w-100 h-100" name="genero" id="genero" value="F" readonly="readonly" style="width:90%; height:100%;">
                                            </td>
                                        <?php } else if ($GENERO_PACIENTE == 'Hombre') { ?>
                                            <td>
                                                <input type="text" class="form-control w-100 h-100" name="genero" id="genero" value="M" readonly="readonly" style="width:90%; height:100%;">
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <input type="text" class="form-control w-100 h-100" name="peso" id="peso">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control w-100 h-100" name="talla" id="talla">
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody id="contenedor_1">
                                    <tr>
                                        <td colspan="7" style="text-align: left; font-weight: 700">
                                            Diagnóstico principal y otros diagnósticos:
                                            <input type="text" class="form-control w-100 h-100" name="diagnostico[]" id="diagnostico[]" value="<?php echo $CLASIFICACION_PATOLOGICA_TRATAMIENTO ?>" readonly="readonly">
                                        </td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td colspan="9" style="font-weight: 700;">
                                        <button type="button" id="btn-agregar_diagnostico" class="btn btn-secondary">Generar campo</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td colspan="9" class="titulos2" style="font-weight: 700">
                                            3. INFORMACIÓN DE LOS MEDICAMENTOS <br>
                                            Registre todos los medicamentos utilizados y marque con una “S” el (los) sospechoso(s), con una “C” el (los) concomitantes y con una “I” las interacciones.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" style="font-weight: 700; background-color: #DBDBDB;">
                                            S/C/I
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Medicamento <br>
                                            (Denominación Común Internacional o Nombre genérico)
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Indicación
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Dosis
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Unidad de medida
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Vía de administración
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Frecuencia de administración
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Fecha de inicio
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Fecha de finalización
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody id="contenedor">
                                    <tr>
                                        <td><input type="text" class="form-control w-100 h-100" name="sci[]" id="sci"></td>
                                        <td><input type="text" class="form-control w-100 h-100" name="medicamento[]" id="medicamento"></td>
                                        <td><input type="text" class="form-control w-100 h-100" name="indicacion[]" id="indicacion"></td>
                                        <td><input type="text" class="form-control w-100 h-100" name="dosis[]" id="dosis"></td>
                                        <td><input type="text" class="form-control w-100 h-100" name="unidad_medida[]" id="unidad_medida"></td>
                                        <td><input type="text" class="form-control w-100 h-100" name="via_administracion[]" id="via_administracion"></td>
                                        <td><input type="text" class="form-control w-100 h-100" name="frecuencia_administracion[]" id="frecuencia_administracion"></td>
                                        <td><input type="text" class="form-control w-100 h-100" name="fecha_inicio[]" id="fecha_inicio"></td>
                                        <td><input type="text" class="form-control w-100 h-100" name="fecha_fin[]" id="fecha_fin"></td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td colspan="9" style="font-weight: 700;">
                                        <button type="button" id="btn-agregar" class="btn btn-secondary">Generar campo</button>
                                    </td>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td colspan="9" style="font-weight: 700; background-color: #DBDBDB;">
                                            Información comercial del medicamento sospechoso
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="font-weight: 700;">
                                            Titular del Registro sanitario
                                        </td>
                                        <td colspan="2" style="font-weight: 700;">
                                            Nombre Comercial
                                        </td>
                                        <td colspan="2" style="font-weight: 700;">
                                            Registro sanitario
                                        </td>
                                        <td colspan="2" style="font-weight: 700;">
                                            Lote
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <textarea name="titular_registro" id="titular_registro" class="form-control w-100 h-100" cols="50" rows="5"></textarea>
                                        </td>
                                        <td colspan="2">
                                            <textarea name="nombre_comercial" id="nombre_comercial" class="form-control w-100 h-100" cols="50" rows="5"></textarea>
                                        </td>
                                        <td colspan="2">
                                            <textarea name="registro_sanitario" id="registro_sanitario" class="form-control w-100 h-100" cols="50" rows="5"></textarea>
                                        </td>
                                        <td colspan="2">
                                            <textarea name="lote" id="lote" class="form-control w-100 h-100" cols="50" rows="5"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="titulos3" style="font-weight: 700">4. INFORMACIÓN DEL EVENTO ADVERSO</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700; text-align:left;">
                                            Fecha de Inicio del Evento Adverso: <br>
                                            <input type="date" class="form-control w-100 h-100" name="fecha_ini_evento" id="fecha_ini_evento">
                                        </td>
                                        <td style="font-weight: 700; text-align:left;">
                                            Evento adverso:
                                            <textarea name="evento_adverso" id="evento_adverso" class="form-control w-100 h-100" cols="95" rows="5"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700; text-align:left;">
                                            Descripción y análisis del Evento Adverso:<br>
                                            <textarea name="descripcion_evento" id="descripcion_evento" class="form-control w-100 h-100" cols="95" rows="5"></textarea>
                                        </td>
                                        <td>
                                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <hr>
                                                        <p style="font-weight: 700; "> Desenlace del evento (Marcar con una X)</p>
                                                        <hr>
                                                        <div style="text-align: left;">
                                                            <input type="radio" name="desenlace_evento" id="desenlace_evento" style=" width:20%; display:none" value="">
                                                            <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Recuperado / Resuelto sin secuelas"> Recuperado / Resuelto sin secuelas <br>
                                                            <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Recuperado / Resuelto con secuelas"> Recuperado / Resuelto con secuelas <br>
                                                            <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Recuperando / Resolviendo"> Recuperando / Resolviendo <br>
                                                            <input type="radio" name="desenlace_evento" id="desenlace_evento" value="No recuperado / No resuelto"> No recuperado / No resuelto <br>
                                                            <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Fatal"> Fatal <br>
                                                            <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Desconocido"> Desconocido
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <hr>
                                                        <p style="font-weight: 700; ">Seriedad (Marcar con X) </p>
                                                        <hr>
                                                        <div style="text-align: left;">
                                                            <input type="radio" name="seriedad" id="seriedad" style=" width:20%; display:none">
                                                            <input type="radio" name="seriedad" id="seriedad" value="Produjo o prolongo hospitalizacion" onchange="trat_previo(this)"> Produjo o prolongó hospitalización <br>
                                                            <input type="radio" name="seriedad" id="seriedad" value="Anomalia congenita" onchange="trat_previo(this)"> Anomalía congénita <br>
                                                            <input type="radio" name="seriedad" id="seriedad" value="Amenaza de vida" onchange="trat_previo(this)"> Amenaza de vida <br>
                                                            <input type="radio" name="seriedad" id="seriedad" value="Muerte" onchange="trat_previo(this)"> Muerte
                                                            <div id="fecha_muerte_id" style="display: none;"> Fecha Muerte:<span class="obli">*</span><input type="date" name="fecha_muerte" id="fecha_muerte"></div><br>
                                                            <input type="radio" name="seriedad" id="seriedad" value="Produjo discapacidad o incapacidad permanente / condicion medica importante" onchange="trat_previo(this)"> Produjo discapacidad o incapacidad permanente / condición médica importante <br>
                                                            <input type="radio" name="seriedad" id="seriedad" value="Ninguno" onchange="trat_previo(this)"> Ninguno <br>
                                                        </div>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td style="font-weight: 700;">Si</td>
                                        <td style="font-weight: 700;">No</td>
                                        <td style="font-weight: 700;">No sabe</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: left;">
                                            ¿El evento se presentó después de administrar el medicamento? <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta1" id="pregunta1" value="SI"> <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta1" id="pregunta1" value="NO">
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta1" id="pregunta1" value="NO SEBE">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: left;">
                                            ¿Existen otros factores que puedan explicar el evento (medicamento, patologías, etc.)? <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta2" id="pregunta2" value="SI"> <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta2" id="pregunta2" value="NO"> <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta2" id="pregunta2" value="NO SABE"> <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: left;">
                                            ¿El evento desapareció al disminuir o suspender el medicamento sospechoso? <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta3" id="pregunta3" value="SI"> <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta3" id="pregunta3" value="NO"> <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta3" id="pregunta3" value="NO SABE"> <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: left;">
                                            ¿El paciente ya había presentado la misma reacción al medicamento sospechoso? <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta4" id="pregunta4" value="SI"> <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta4" id="pregunta4" value="NO"> <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta4" id="pregunta4" value="NO SABE"> <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: left;">
                                            ¿Se puede ampliar la información del paciente relacionando con el evento? <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta5" id="pregunta5" value="SI"> <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta5" id="pregunta5" value="NO"> <br>
                                        </td>
                                        <td>
                                            <input type="radio" name="pregunta5" id="pregunta5" value="NO SABE"> <br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button type="button" onclick="btnSubmit()" class="btn_registrar">
                                REGISTRAR
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <script>
            const botonAgregar = document.querySelector('#btn-agregar');
            const tabla = document.querySelector('#contenedor');

            botonAgregar.addEventListener('click', () => {
                const nuevaFila = document.createElement('tr');
                nuevaFila.innerHTML = `<td><input type="text" class="form-control w-100 h-100" name="sci[]" id="sci" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="medicamento[]" id="medicamento" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="indicacion[]" id="indicacion" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="dosis[]" id="dosis" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="unidad_medida[]" id="unidad_medida" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="via_administracion[]" id="via_administracion" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="frecuencia_administracion[]" id="frecuencia_administracion" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="fecha_inicio[]" id="fecha_inicio" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="fecha_fin[]" id="fecha_fin" ></td>
                         <td><button class="eliminar btn btn-danger bg-gradient text-white"><span class="iconify" data-icon="tabler:trash-x-filled" data-width="25"></span></button></td>`;
                tabla.appendChild(nuevaFila);
                document.querySelectorAll('.eliminar').forEach(button => {
                    button.addEventListener('click', () => {
                        button.closest('tr').remove();
                    });
                });

            });
            const botonAgregarDiagnostico = document.querySelector('#btn-agregar_diagnostico');
            const tabla_diagnostico = document.querySelector('#contenedor_1');

            botonAgregarDiagnostico.addEventListener('click', () => {
                const nuevaFila = document.createElement('tr');
                nuevaFila.innerHTML = `<td colspan="7" style="text-align: left; font-weight: 700"><input type ="text" class="form-control w-100 h-100" name="diagnostico" id="diagnostico"></td>
                <td><button class="eliminar btn btn-danger bg-gradient text-white"><span class="iconify" data-icon="tabler:trash-x-filled" data-width="25"></span></button></td>`;
                tabla_diagnostico.appendChild(nuevaFila);
                document.querySelectorAll('.eliminar').forEach(button => {
                    button.addEventListener('click', () => {
                        button.closest('tr').remove();
                    });
                });

            });

            function btnSubmit() {

                let date = {
                    institucion_evento: document.getElementById('institucion_evento').value,
                    profecion_usuario: document.getElementById('profecion_usuario').value,
                    peso: document.getElementById('peso').value,
                    talla: document.getElementById('talla').value,
                    sci: document.getElementById('sci').value,
                    medicamento: document.getElementById('medicamento').value,
                    indicacion: document.getElementById('indicacion').value,
                    dosis: document.getElementById('dosis').value,
                    unidad_medida: document.getElementById('unidad_medida').value,
                    via_administracion: document.getElementById('via_administracion').value,
                    frecuencia_administracion: document.getElementById('frecuencia_administracion').value,
                    descripcion_evento: document.getElementById('descripcion_evento').value,
                    codigo_paciente: document.getElementById('codigo_paciente').value,
                }

                for (let key in date) {
                    if (date.hasOwnProperty(key)) {
                        const value = Number(date[key]);
                        const element = document.getElementById(key);
                        if (value === 0) {
                            element.classList.add('is-invalid');
                        } else {
                            element.classList.remove('is-invalid');
                            element.classList.add('is-valid');
                        }
                    }
                }

                axios.post('./insertar_datos_ea.php', date)
                    .then(function(response) {
                        var respuesta = response.data.split(',');
                        var titulo = respuesta[0];
                        var icono = respuesta[1];
                        var mensaje = respuesta[2];
                        console.log(date);
                        Swal.fire({
                            title: titulo,
                            html: mensaje,
                            width: '20%',
                            icon: icono,
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed && icono === 'success') {
                                btnConvertPdf()
                                setTimeout(() => {
                                    var url = "./insertar_datos_ea.php";
                                    var target = "info";
                                    window.open(url, target);
                                }, 1000);
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
            }

            function btnConvertPdf() {

                let date = {
                    fecha_notificacion: document.getElementById('fecha_notificacion').value,
                    departamento: document.getElementById('departamento').value,
                    municipio: document.getElementById('municipio').value,
                    institucion_evento: document.getElementById('institucion_evento').value,
                    codigo_pnf: document.getElementById('codigo_pnf').value,
                    nombre_usuario: document.getElementById('nombre_usuario').value,
                    nombre_paciente_acudiente: document.getElementById('nombre_paciente_acudiente').value,
                    consecutivo: document.getElementById('consecutivo').value,
                    profecion_usuario: document.getElementById('profecion_usuario').value,
                    correo_usuario: document.getElementById('correo_usuario').value,
                    fecha_nacimiento: document.getElementById('fecha_nacimiento').value,
                    edad_paciente: document.getElementById('edad_paciente').value,
                    tipo_documento_paciente: document.getElementById('tipo_documento_paciente').value,
                    documento_paciente: document.getElementById('documento_paciente').value,
                    iniciales_pa: document.getElementById('iniciales_pa').value,
                    genero: document.getElementById('genero').value,
                    peso: document.getElementById('peso').value,
                    talla: document.getElementById('talla').value,
                    diagnostico: document.getElementById('diagnostico').value,
                    sci: document.getElementById('sci').value,
                    medicamento: document.getElementById('medicamento').value,
                    indicacion: document.getElementById('indicacion').value,
                    dosis: document.getElementById('dosis').value,
                    unidad_medida: document.getElementById('unidad_medida').value,
                    via_administracion: document.getElementById('via_administracion').value,
                    frecuencia_administracion: document.getElementById('frecuencia_administracion').value,
                    descripcion_evento: document.getElementById('descripcion_evento').value,
                    codigo_paciente: document.getElementById('codigo_paciente').value,
                }

                axios.post('./pdf.php', date)
                    .then(function(response) {
                        Swal.fire({
                                title: response.data.title,
                                html: response.data.mensaje,
                                icon: response.data.tipo,
                                confirmButtonText: 'Aceptar'
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    SendMailer()
                                    window.open(url, target);
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
            }

            function SendMailer() {
                let date = {
                    institucion_evento: document.getElementById('institucion_evento').value,
                    profecion_usuario: document.getElementById('profecion_usuario').value,
                    peso: document.getElementById('peso').value,
                    talla: document.getElementById('talla').value,
                    sci: document.getElementById('sci').value,
                    medicamento: document.getElementById('medicamento').value,
                    indicacion: document.getElementById('indicacion').value,
                    dosis: document.getElementById('dosis').value,
                    unidad_medida: document.getElementById('unidad_medida').value,
                    via_administracion: document.getElementById('via_administracion').value,
                    frecuencia_administracion: document.getElementById('frecuencia_administracion').value,
                    descripcion_evento: document.getElementById('descripcion_evento').value,
                    codigo_paciente: document.getElementById('codigo_paciente').value,
                }

                axios.post('./email/mail.php', date)
                    .then(respuesta => {
                        console.log(respuesta);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        </script>
    </body>
    <style>
        @page {
            margin: 180px 50px;
        }

        #footer {
            position: fixed;
            left: 0px;
            bottom: -180px;
            right: 0px;
            height: 150px;
            background-color: transparent;
        }

        #footer .page:after {
            content: counter(page, upper-roman);
        }

        * {
            font-size: 12px !important;
        }

        .titulos {
            background-color: #CCECFF;
            font-family: Tahoma, Geneva, sans-serif;
            color: #000;
        }

        .titulos2 {
            background-color: #B6DDE8;
            font-family: Tahoma, Geneva, sans-serif;
            color: #000;
        }

        .titulos3 {
            background-color: #99CCFF;
            font-family: Tahoma, Geneva, sans-serif;
            color: #000;
        }

        .obli {
            color: #ff0000;
        }

        .texto {
            font-weight: lighter;
            text-align: justify;
        }

        th {
            width: 25%;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
        }

        input[type=text] {
            width: 40%;
            height: 17px;
        }

        input[type=date] {
            width: 50%;
        }

        .btn_registrar {
            padding-top: 2%;
            background-image: url(imagenes/BTN_CONTINUAR2.png);
            background-image: url(../presentacion/imagenes/BTN_CONTINUAR2.png);
            background-repeat: no-repeat;
            width: 152px;
            height: 37px;
            color: transparent;
            background-color: transparent;
            border-radius: 5px;
            border: 1px solid transparent;
        }

        .btn_registrar:active {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
                inset 0px 0px 20px #EEECEC;
        }

        .btn_registrar:hover {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
                inset 0px 0px 20px #EEECEC;
        }

        .letra {
            font-family: Tahoma, Geneva, sans-serif;
        }

        .table td,
        .table th {
            padding: 10px;
            text-align: center;
            color: black;
        }

        .table {
            margin-bottom: 1rem;
            margin: auto;
            background-color: transparent;
        }

        table {
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
        }
    </style>
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