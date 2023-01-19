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
    <script src="js/jquery.js"></script>
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
        <form id="evento_adverso" name="evento_adverso" action="../logica/insertar_datos_ea.php" enctype="multipart/form-data" method="post" class="letra">
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
                                        <td colspan="4" class="titulos" style="font-weight: 700">1. INFORMACIÓN DEL REPORTANTE <?PHP echo $EV ?></td>
                                    </tr>
                                    <input type="text" name="ID_PACIENTE" id="ID_PACIENTE" value="<?php echo $ID_PACIENTE2 ?>" readonly="readonly" style="display: none;">
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
                                            <input type="date" name="fecha_notificacion" id="fecha_notificacion" value="<?php echo date('Y-m-d'); ?>" style="width:90%; height:100%;" readonly="readonly">
                                        </td>
                                        <td>
                                            <input type="text" name="departamento" id="departamento" value="<?php echo $DEPARTAMENTO_PACIENTE ?>" readonly="readonly"> - <input type="text" name="municipio" id="municipio" value="<?php echo $CIUDAD_PACIENTE ?>" readonly="readonly">
                                        </td>
                                        <td>
                                            <input type="text" name="institucion_evento" id="institucion_evento" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="codigo_pnf" id="codigo_pnf" style="width:90%; height:100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Nombre del Reportante primario
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Consecutivo
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Profesión del reportante primario
                                        </td>
                                        <td style="font-weight: 700; background-color: #DBDBDB;">
                                            Correo electrónico institucional del reportante primario
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo $NOMBRES . ' ' . $APELLIDOS ?>" readonly="readonly" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <!-- <input type="text" name="consecutivo" id="consecutivo" value="<?php echo $cad . ' - V' . $data['EV'] ?>" readonly="readonly" style="width:90%; height:100%;"> -->
                                            <input type="text" name="consecutivo" id="consecutivo" value="<?php echo $cad ?>" readonly="readonly" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="profecion_usuario" id="profecion_usuario" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="email" name="correo_usuario" id="correo_usuario" value="<?php echo $EMAIL ?>" readonly="readonly" style="width:90%; height:100%;">
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
                                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $FECHA_NACIMIENTO ?>" readonly="readonly" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="number" name="edad_paciente" id="edad_paciente" value="<?php echo $EDAD ?>" readonly="readonly" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="tipo_documento_paciente" id="tipo_documento_paciente" value="<?php echo $TIPO_IDENTIFICACION_PACIENTE ?>" readonly="readonly"> - <input type="text" name="documento_paciente" id="documento_paciente" value="<?php echo $IDENTIFICACION_PACIENTE ?>" readonly="readonly">
                                        </td>
                                        <td>
                                            <input type="text" name="iniciales_pa" id="iniciales_pa" value="<?php echo $result ?>" style="width:90%; height:100%;" readonly="readonly">
                                        </td>
                                        <?php if ($GENERO_PACIENTE == 'Mujer') { ?>
                                            <td>
                                                <input type="text" name="genero" id="genero" value="F" readonly="readonly" style="width:90%; height:100%;">
                                            </td>
                                        <?php } else if ($GENERO_PACIENTE == 'Hombre') { ?>
                                            <td>
                                                <input type="text" name="genero" id="genero" value="M" readonly="readonly" style="width:90%; height:100%;">
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <input type="text" name="peso" id="peso">
                                        </td>
                                        <td>
                                            <input type="text" name="talla" id="talla">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: left; font-weight: 700">
                                            Diagnóstico principal y otros diagnósticos:
                                            <input type="text" name="diagnostico" id="diagnostico" value="<?php echo $CLASIFICACION_PATOLOGICA_TRATAMIENTO ?>" readonly="readonly">
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
                                    <tr>
                                        <td colspan="1">
                                            <input type="text" name="S_C_I1" id="S_C_I1" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="medicamento1" id="medicamento1" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="indicacion1" id="indicacion1" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="dosis1" id="dosis1" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="unidad_medida1" id="unidad_medida1" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="via_administracion1" id="via_administracion1" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="frecuencia_administracion1" id="frecuencia_administracion1" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="date" name="fecha_inicio1" id="fecha_inicio1" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="date" name="fecha_fin1" id="fecha_fin1" style="width:90%; height:100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <input type="text" name="S_C_I2" id="S_C_I2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="medicamento2" id="medicamento2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="indicacion2" id="indicacion2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="dosis2" id="dosis2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="unidad_medida2" id="unidad_medida2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="via_administracion2" id="via_administracion2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="frecuencia_administracion2" id="frecuencia_administracion2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="date" name="fecha_inicio2" id="fecha_inicio2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="date" name="fecha_fin2" id="fecha_fin2" style="width:90%; height:100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <input type="text" name="S_C_I3" id="S_C_I2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="medicamento3" id="medicamento2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="indicacion3" id="indicacion2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="dosis3" id="dosis2" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="unidad_medida3" id="unidad_medida3" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="via_administracion3" id="via_administracion3" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="text" name="frecuencia_administracion3" id="frecuencia_administracion3" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="date" name="fecha_inicio3" id="fecha_inicio3" style="width:90%; height:100%;">
                                        </td>
                                        <td>
                                            <input type="date" name="fecha_fin3" id="fecha_fin2" style="width:90%; height:100%;">
                                        </td>
                                    </tr>
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
                                            <textarea name="titular_registro" id="titular_registro" cols="50" rows="5"></textarea>
                                        </td>
                                        <td colspan="2">
                                            <textarea name="nombre_comercial" id="nombre_comercial" cols="50" rows="5"></textarea>
                                        </td>
                                        <td colspan="2">
                                            <textarea name="registro_sanitario" id="registro_sanitario" cols="50" rows="5"></textarea>
                                        </td>
                                        <td colspan="2">
                                            <textarea name="lote" id="lote" cols="50" rows="5"></textarea>
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
                                            <input type="date" name="fecha_ini_evento" id="fecha_ini_evento">
                                        </td>
                                        <td style="font-weight: 700; text-align:left;">
                                            Evento adverso:
                                            <textarea name="evento_adverso" id="evento_adverso" cols="95" rows="5"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700; text-align:left;">
                                            Descripción y análisis del Evento Adverso:<br>
                                            <textarea name="descripcion_evento" id="descripcion_evento" cols="95" rows="5"></textarea>
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
                            <br />
                            <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(evento_adverso,1);this.disabled=true" />
                            <br />
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </body>
    <style>
        @page {
            margin: 180px 50px;
        }

        /* #header {
            position: fixed;
            left: 0px;
            top: -165px;
            right: 0px;
            height: 150px;
            background-color: transparent;
            text-align: center;
        } */

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
    </script>-
<?php
}
?>

</html>