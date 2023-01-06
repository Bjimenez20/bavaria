<?php
include "../logica/session.php";
include "../datos/conex.php";
include_once "../dompdf/vendor/autoload.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
ob_start();
$consulta = mysqli_query($conex, "SELECT * FROM ipsen_evento_adverso ORDER BY ID_EVENTO_ADVERSO DESC LIMIT 1");
echo mysqli_error($conex);
while ($fila1 = mysqli_fetch_array($consulta)) {
    $ID_EVENTO_ADVERSO = $fila1['ID_EVENTO_ADVERSO'];
    $FECHA_NOTIFICA = $fila1['FECHA_NOTIFICA'];
    $DEPARTAMENTO = $fila1['DEPARTAMENTO'];
    $MUNICIPIO = $fila1['MUNICIPIO'];
    $NOMBRE_INSTITUCION = $fila1['NOMBRE_INSTITUCION'];
    $CODIGO_PNF = $fila1['CODIGO_PNF'];
    $NOMBRE_REPORTANTE = $fila1['NOMBRE_REPORTANTE'];
    $PROFESION_REPORTANTE = $fila1['PROFESION_REPORTANTE'];
    $CORREO_REPORTANTE = $fila1['CORREO_REPORTANTE'];
    $FECHA_NACIMIENTO_PACIENTE = $fila1['FECHA_NACIMIENTO_PACIENTE'];
    $EDAD_PACIENTE = $fila1['EDAD_PACIENTE'];
    $TIPO_DOCUMENTO_PACIENTE = $fila1['TIPO_DOCUMENTO_PACIENTE'];
    $NUMERO_DOCUMENTO_PACIENTE = $fila1['NUMERO_DOCUMENTO_PACIENTE'];
    $INICIALES_PACIENTE = $fila1['INICIALES_PACIENTE'];
    $SEXO = $fila1['SEXO'];
    $PESO = $fila1['PESO'];
    $TALLA = $fila1['TALLA'];
    $DIAGNOSTICO_PRINCIPAL = $fila1['DIAGNOSTICO_PRINCIPAL'];
    $SCI1 = $fila1['SCI1'];
    $SCI2 = $fila1['SCI2'];
    $SCI3 = $fila1['SCI3'];
    $MEDICAMENTO1 = $fila1['MEDICAMENTO1'];
    $MEDICAMENTO2 = $fila1['MEDICAMENTO2'];
    $MEDICAMENTO3 = $fila1['MEDICAMENTO3'];
    $INDICACION1 = $fila1['INDICACION1'];
    $INDICACION2 = $fila1['INDICACION2'];
    $INDICACION3 = $fila1['INDICACION3'];
    $DOSIS1 = $fila1['DOSIS1'];
    $DOSIS2 = $fila1['DOSIS2'];
    $DOSIS3 = $fila1['DOSIS3'];
    $UNIDAD_MEDIDA1 = $fila1['UNIDAD_MEDIDA1'];
    $UNIDAD_MEDIDA2 = $fila1['UNIDAD_MEDIDA2'];
    $UNIDAD_MEDIDA3 = $fila1['UNIDAD_MEDIDA3'];
    $VIA_ADMINISTRACION1 = $fila1['VIA_ADMINISTRACION1'];
    $VIA_ADMINISTRACION2 = $fila1['VIA_ADMINISTRACION2'];
    $VIA_ADMINISTRACION2 = $fila1['VIA_ADMINISTRACION3'];
    $FRECUENCIA_ADMINISTRACION1 = $fila1['FRECUENCIA_ADMINISTRACION1'];
    $FRECUENCIA_ADMINISTRACION2 = $fila1['FRECUENCIA_ADMINISTRACION2'];
    $FRECUENCIA_ADMINISTRACION3 = $fila1['FRECUENCIA_ADMINISTRACION3'];
    $FECHA_INICIO1 = $fila1['FECHA_INICIO1'];
    $FECHA_INICIO2 = $fila1['FECHA_INICIO2'];
    $FECHA_INICIO3 = $fila1['FECHA_INICIO3'];
    $FECHA_FIN1 = $fila1['FECHA_FIN1'];
    $FECHA_FIN2 = $fila1['FECHA_FIN2'];
    $FECHA_FIN3 = $fila1['FECHA_FIN3'];
    $TITULAR_REGISTRO = $fila1['TITULAR_REGISTRO'];
    $NOMBRE_COMERCIAL = $fila1['NOMBRE_COMERCIAL'];
    $REGISTRO_SANITARIO = $fila1['REGISTRO_SANITARIO'];
    $LOTE = $fila1['LOTE'];
    $FECHA_INICIO_EVENTO = $fila1['FECHA_INICIO_EVENTO'];
    $EVENTO_ADVERSO = $fila1['EVENTO_ADVERSO'];
    $DESCRIPCION_ANALISIS_EVENTO = $fila1['DESCRIPCION_ANALISIS_EVENTO'];
    $DESENLACE_EVENTO = $fila1['DESENLACE_EVENTO'];
    $SERIEDAD = $fila1['SERIEDAD'];
    $FECHA_MUERTE = $fila1['FECHA_MUERTE'];
    $PREGUNTA1 = $fila1['PREGUNTA1'];
    $PREGUNTA2 = $fila1['PREGUNTA2'];
    $PREGUNTA3 = $fila1['PREGUNTA3'];
    $PREGUNTA4 = $fila1['PREGUNTA4'];
    $PREGUNTA5 = $fila1['PREGUNTA5'];
    $ID_PAP = $fila1['ID_PACIENTE_FK'];
    $ID_GESTION = $fila1['ID_GESTION_FK'];
    $URL_PDF = $fila1['URL_PDF'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery.js"></script>
</head>

<body style="padding: 0; margin: 0;">


    <table class="table table-bordered" cellspacing="0" cellpadding="0" style="width: 100%;" id="header">
        <tbody>
            <tr>
                <td>
                    <?php
                    $url = 'http://localhost/ipsen/presentacion/imagenes/EA.png'
                    ?>
                    <img src="<?php echo $url ?>" alt="" width="170" height="75" />
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
                                    <?php echo $FECHA_NOTIFICA ?>
                                </td>
                                <td>
                                    <?php echo $DEPARTAMENTO ?> - <?php echo $MUNICIPIO ?>
                                </td>
                                <td>
                                    <?php echo $NOMBRE_INSTITUCION ?>
                                </td>
                                <td>
                                    <?php echo $CODIGO_PNF ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight: 700; background-color: #DBDBDB;">
                                    Nombre del Reportante primario
                                </td>
                                <td style="font-weight: 700; background-color: #DBDBDB;">
                                    Profesión del reportante primario
                                </td>
                                <td style="font-weight: 700; background-color: #DBDBDB;">
                                    Correo electrónico institucional del reportante primario
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php echo $NOMBRE_REPORTANTE ?>
                                </td>
                                <td>
                                    <?php echo $PROFESION_REPORTANTE ?>
                                </td>
                                <td>
                                    <?php echo $CORREO_REPORTANTE ?>
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
                                    <?php echo $FECHA_NACIMIENTO_PACIENTE ?>
                                </td>
                                <td>
                                    <?php echo $EDAD_PACIENTE ?>
                                </td>
                                <td>
                                    <?php echo $TIPO_DOCUMENTO_PACIENTE ?> - <?php echo $NUMERO_DOCUMENTO_PACIENTE ?>
                                </td>
                                <td>
                                    <?php echo $INICIALES_PACIENTE ?>
                                </td>
                                <td>
                                    <?php echo $SEXO ?>
                                </td>
                                <td>
                                    <?php echo $PESO ?>
                                </td>
                                <td>
                                    <?php echo $TALLA ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" style="text-align: left; font-weight: 700">
                                    Diagnóstico principal y otros diagnósticos: <?php echo $DIAGNOSTICO_PRINCIPAL ?>
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
                                    <?php echo $SCI1 ?>
                                </td>
                                <td>
                                    <?php echo $MEDICAMENTO1 ?>
                                </td>
                                <td>
                                    <?php echo $INDICACION1 ?>
                                </td>
                                <td>
                                    <?php echo $DOSIS1 ?>
                                </td>
                                <td>
                                    <?php echo $UNIDAD_MEDIDA1 ?>
                                </td>
                                <td>
                                    <?php echo $VIA_ADMINISTRACION1 ?>
                                </td>
                                <td>
                                    <?php echo $FRECUENCIA_ADMINISTRACION1 ?>
                                </td>
                                <td>
                                    <?php echo $FECHA_INICIO1 ?>
                                </td>
                                <td>
                                    <?php echo $FECHA_FIN1 ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1">
                                    <?php echo $SCI2 ?>
                                </td>
                                <td>
                                    <?php echo $MEDICAMENTO2 ?>
                                </td>
                                <td>
                                    <?php echo $INDICACION2 ?>
                                </td>
                                <td>
                                    <?php echo $DOSIS2 ?>
                                </td>
                                <td>
                                    <?php echo $UNIDAD_MEDIDA2 ?>
                                </td>
                                <td>
                                    <?php echo $VIA_ADMINISTRACION2 ?>
                                </td>
                                <td>
                                    <?php echo $FRECUENCIA_ADMINISTRACION2 ?>
                                </td>
                                <td>
                                    <?php echo $FECHA_INICIO2 ?>
                                </td>
                                <td>
                                    <?php echo $FECHA_FIN2 ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1">
                                    <?php echo $SCI3 ?>
                                </td>
                                <td>
                                    <?php echo $MEDICAMENTO3 ?>
                                </td>
                                <td>
                                    <?php echo $INDICACION3 ?>
                                </td>
                                <td>
                                    <?php echo $DOSIS3 ?>
                                </td>
                                <td>
                                    <?php echo $UNIDAD_MEDIDA3 ?>
                                </td>
                                <td>
                                    <?php echo $VIA_ADMINISTRACION3 ?>
                                </td>
                                <td>
                                    <?php echo $FRECUENCIA_ADMINISTRACION3 ?>
                                </td>
                                <td>
                                    <?php echo $FECHA_INICIO3 ?>
                                </td>
                                <td>
                                    <?php echo $FECHA_FIN3 ?>
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
                                    <?php echo $TITULAR_REGISTRO ?>
                                </td>
                                <td colspan="2">
                                    <?php echo $NOMBRE_COMERCIAL ?>
                                </td>
                                <td colspan="2">
                                    <?php echo $REGISTRO_SANITARIO ?>
                                </td>
                                <td colspan="2">
                                    <?php echo $LOTE ?>
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
                                    <?php echo $FECHA_INICIO_EVENTO ?>
                                </td>
                                <td style="font-weight: 700; text-align:left;">
                                    Evento adverso: <?php echo $EVENTO_ADVERSO ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700; text-align:left;">
                                    Descripción y análisis del Evento Adverso:<br>
                                    <?php echo $DESCRIPCION_ANALISIS_EVENTO ?>
                                </td>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <?php if ($DESENLACE_EVENTO == 'Recuperado / Resuelto sin secuelas') { ?>
                                                    <td style="font-weight: 700; text-align: left">
                                                        <p style="font-weight: 700; "> Desenlace del evento (Marcar con una X)</p>
                                                        <span style="color: #ff0000;">X</span> Recuperado / Resuelto sin secuelas <br>
                                                        Recuperado / Resuelto con secuelas <br>
                                                        Recuperando / Resolviendo <br>
                                                        No recuperado / No resuelto <br>
                                                        Fatal <br>
                                                        Desconocido <br>
                                                    </td>
                                                <?php } else if ($DESENLACE_EVENTO == 'Recuperado / Resuelto con secuelas') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; "> Desenlace del evento (Marcar con una X)</p>
                                                        Recuperado / Resuelto sin secuelas <br>
                                                        <span style="color: #ff0000;">X</span> Recuperado / Resuelto con secuelas <br>
                                                        Recuperando / Resolviendo <br>
                                                        No recuperado / No resuelto <br>
                                                        Fatal <br>
                                                        Desconocido <br>
                                                    </td>
                                                <?php } else if ($DESENLACE_EVENTO == 'Recuperando / Resolviendo') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; "> Desenlace del evento (Marcar con una X)</p>
                                                        Recuperado / Resuelto sin secuelas <br>
                                                        Recuperado / Resuelto con secuelas <br>
                                                        <span style="color: #ff0000;">X</span> Recuperando / Resolviendo <br>
                                                        No recuperado / No resuelto <br>
                                                        Fatal <br>
                                                        Desconocido <br>
                                                    </td>
                                                <?php } else if ($DESENLACE_EVENTO == 'No recuperado / No resuelto') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; "> Desenlace del evento (Marcar con una X)</p>
                                                        Recuperado / Resuelto sin secuelas <br>
                                                        Recuperado / Resuelto con secuelas <br>
                                                        Recuperando / Resolviendo <br>
                                                        <span style="color: #ff0000;">X</span> No recuperado / No resuelto <br>
                                                        Fatal <br>
                                                        Desconocido <br>
                                                    </td>
                                                <?php } else if ($DESENLACE_EVENTO == 'Fatal') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; "> Desenlace del evento (Marcar con una X)</p>
                                                        Recuperado / Resuelto sin secuelas <br>
                                                        Recuperado / Resuelto con secuelas <br>
                                                        Recuperando / Resolviendo <br>
                                                        No recuperado / No resuelto <br>
                                                        <span style="color: #ff0000;">X</span> Fatal <br>
                                                        Desconocido <br>
                                                    </td>
                                                <?php } else if ($DESENLACE_EVENTO == 'Desconocido') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; "> Desenlace del evento (Marcar con una X)</p>
                                                        Recuperado / Resuelto sin secuelas <br>
                                                        Recuperado / Resuelto con secuelas <br>
                                                        Recuperando / Resolviendo <br>
                                                        No recuperado / No resuelto <br>
                                                        Fatal <br>
                                                        <span style="color: #ff0000;">X</span> Desconocido <br>
                                                    </td>
                                                <?php } else if ($DESENLACE_EVENTO == '') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; "> Desenlace del evento (Marcar con una X)</p>
                                                        Recuperado / Resuelto sin secuelas <br>
                                                        Recuperado / Resuelto con secuelas <br>
                                                        Recuperando / Resolviendo <br>
                                                        No recuperado / No resuelto <br>
                                                        Fatal <br>
                                                        Desconocido <br>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <?php if ($SERIEDAD == 'Produjo o prolongo hospitalizacion') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; ">Seriedad (Marcar con X) </p>
                                                        <span style="color: #ff0000;">X</span> Produjo o prolongó hospitalización <br>
                                                        Anomalía congénita <br>
                                                        Amenaza de vida <br>
                                                        Muerte (Fecha: _______________) <br>
                                                        Produjo discapacidad o incapacidad permanente / condición médica importante <br>
                                                        Ninguno
                                                    </td>
                                                <?php } else if ($SERIEDAD == 'Anomalia congenita') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; ">Seriedad (Marcar con X) </p>
                                                        Produjo o prolongó hospitalización <br>
                                                        <span style="color: #ff0000;">X</span> Anomalía congénita <br>
                                                        Amenaza de vida <br>
                                                        Muerte (Fecha: _______________) <br>
                                                        Produjo discapacidad o incapacidad permanente / condición médica importante <br>
                                                        Ninguno
                                                    </td>
                                                <?php } else if ($SERIEDAD == 'Amenaza de vida') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; ">Seriedad (Marcar con X) </p>
                                                        Produjo o prolongó hospitalización <br>
                                                        Anomalía congénita <br>
                                                        <span style="color: #ff0000;">X</span> Amenaza de vida <br>
                                                        Muerte (Fecha: _______________) <br>
                                                        Produjo discapacidad o incapacidad permanente / condición médica importante <br>
                                                        Ninguno
                                                    </td>
                                                <?php } else if ($SERIEDAD == 'Muerte') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; ">Seriedad (Marcar con X) </p>
                                                        Produjo o prolongó hospitalización <br>
                                                        Anomalía congénita <br>
                                                        Amenaza de vida <br>
                                                        <span style="color: #ff0000;">X</span> Muerte (Fecha: <?php echo $FECHA_MUERTE ?>) <br>
                                                        Produjo discapacidad o incapacidad permanente / condición médica importante <br>
                                                        Ninguno
                                                    </td>
                                                <?php } else if ($SERIEDAD == 'Produjo discapacidad o incapacidad permanente / condicion medica importante') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; ">Seriedad (Marcar con X) </p>
                                                        Produjo o prolongó hospitalización <br>
                                                        Anomalía congénita <br>
                                                        Amenaza de vida <br>
                                                        Muerte (Fecha: _______________) <br>
                                                        <span style="color: #ff0000;">X</span> Produjo discapacidad o incapacidad permanente / condición médica importante <br>
                                                        Ninguno
                                                    </td>
                                                <?php } else if ($SERIEDAD == 'Ninguno') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; ">Seriedad (Marcar con X) </p>
                                                        Produjo o prolongó hospitalización <br>
                                                        Anomalía congénita <br>
                                                        Amenaza de vida <br>
                                                        Muerte (Fecha: _______________) <br>
                                                        Produjo discapacidad o incapacidad permanente / condición médica importante <br>
                                                        <span style="color: #ff0000;">X</span> Ninguno
                                                    </td>
                                                <?php } else if ($SERIEDAD == '') {
                                                ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; ">Seriedad (Marcar con X) </p>
                                                        Produjo o prolongó hospitalización <br>
                                                        Anomalía congénita <br>
                                                        Amenaza de vida <br>
                                                        Muerte (Fecha: _______________) <br>
                                                        Produjo discapacidad o incapacidad permanente / condición médica importante <br>
                                                        Ninguno
                                                    </td>
                                                <?php } ?>
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
                                <?php
                                if ($PREGUNTA1  == "SI") {
                                    $PREGUNTA1 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA1 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } elseif ($PREGUNTA1 == "NO") {
                                    $PREGUNTA1 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA1 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } else {
                                    $PREGUNTA1 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA1 ?></span> <br>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left;">
                                    ¿Existen otros factores que puedan explicar el evento (medicamento, patologías, etc.)? <br>
                                </td>
                                <?php
                                if ($PREGUNTA2  == "SI") {
                                    $PREGUNTA2 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA2 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } elseif ($PREGUNTA2 == "NO") {
                                    $PREGUNTA2 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA2 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } else {
                                    $PREGUNTA2 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA2 ?></span> <br>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left;">
                                    ¿El evento desapareció al disminuir o suspender el medicamento sospechoso? <br>
                                </td>
                                <?php
                                if ($PREGUNTA3  == "SI") {
                                    $PREGUNTA3 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA3 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } elseif ($PREGUNTA3 == "NO") {
                                    $PREGUNTA3 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA3 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } else {
                                    $PREGUNTA3 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA3 ?></span> <br>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left;">
                                    ¿El paciente ya había presentado la misma reacción al medicamento sospechoso? <br>
                                </td>
                                <?php
                                if ($PREGUNTA4  == "SI") {
                                    $PREGUNTA4 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA4 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } elseif ($PREGUNTA4 == "NO") {
                                    $PREGUNTA4 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA4 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } else {
                                    $PREGUNTA4 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA4 ?></span> <br>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left;">
                                    ¿Se puede ampliar la información del paciente relacionando con el evento? <br>
                                </td>
                                <?php
                                if ($PREGUNTA5  == "SI") {
                                    $PREGUNTA5 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA5 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } elseif ($PREGUNTA5 == "NO") {
                                    $PREGUNTA5 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA5 ?></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                <?php
                                } else {
                                    $PREGUNTA5 = "X"
                                ?>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"></span> <br>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style=" font-weight:none"><?php echo $PREGUNTA5 ?></span> <br>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
<style>
    @page {
        margin: 180px 50px;
    }

    #header {
        position: fixed;
        left: 0px;
        top: -165px;
        right: 0px;
        height: 150px;
        background-color: transparent;
        text-align: center;
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

</html>
<?php
include "./pdf_evento_adverso.php";
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->render();
$output = $dompdf->output();
$CARPETA = "../EVENTO_ADVERSO/$ID_GESTION";
if (!is_dir($CARPETA)) {
    mkdir("../EVENTO_ADVERSO/$ID_GESTION", 0777);
    file_put_contents('' . $CARPETA . '/Evento_Adverso_' . $ID_PACIENTE . '.pdf', $output);
}
include("../presentacion/email/mail.php");
