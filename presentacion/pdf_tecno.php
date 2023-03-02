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
    $NOMBRE_PACIENTE_ACUDIENTE = $fila1['NOMBRE_PACIENTE_ACUDIENTE'];
    $CONSECUTIVO = $fila1['CONSECUTIVO'];
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
    $TITULAR_REGISTRO = $fila1['TITULAR_REGISTRO'];
    $NOMBRE_COMERCIAL = $fila1['NOMBRE_COMERCIAL'];
    $REGISTRO_SANITARIO = $fila1['REGISTRO_SANITARIO'];
    $LOTE = $fila1['LOTE'];
    $FECHA_INICIO_EVENTO = $fila1['FECHA_INICIO_EVENTO'];
    $EVENTO_ADVERSO = $fila1['EVENTO_ADVERSO'];
    $DESCRIPCION_ANALISIS_EVENTO = $fila1['DESCRIPCION_ANALISIS_EVENTO'];
    $DESENLACE_EVENTO = $fila1['DESENLACE_EVENTO'];
    $SERIEDAD = $fila1['SERIEDAD'];
    $LUGAR_DISTRIBUCION = $fila1['LUGAR_DISTRIBUCION'];
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
</head>

<body style="padding: 0; margin: 0;">
    <table class="table table-bordered" cellspacing="0" cellpadding="0" style="width: 100%;" id="header">
        <tbody>
            <tr>
                <td width="20%" height="20%">
                    <img src="../dompdf/vendor/dompdf/dompdf/lib/res/logo_tecno.png">
                </td>
                <td>
                    <h1 style="color: #D4243B;">FORMATO REPORTE DE QUEJAS <br> TECNICAS - PTC</h1>
                </td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                            <tr>
                                <td colspan="2" style="color: #D4243B;">CODIGO:</td>
                                <td colspan="2">GC-FO-27</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color: #D4243B;">VERSIÓN:</td>
                                <td colspan="2">1</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color: #D4243B;">FECHA DE VIGENCIA:</td>
                                <td colspan="2">5/01/2023</td>
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
                                <td colspan="4" class="titulos" style="font-weight: 700; color:#fff;">1. INFORMACIÓN DEL REPORTANTE</td>
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
                                    ID Paciente
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
                                    <?php echo $ID_PAP ?>
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
                                    <?php echo $NOMBRE_REPORTANTE ?>
                                </td>
                                <td>
                                    <?php echo $NOMBRE_PACIENTE_ACUDIENTE ?>
                                </td>
                                <td>
                                    <?php echo $CONSECUTIVO ?>
                                </td>
                                <td>
                                    <?php echo $PROFESION_REPORTANTE ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700; background-color: #DBDBDB;" colspan="4">
                                    Correo electrónico institucional del reportante primario
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
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
                                <td colspan="9" class="titulos" style="font-weight: 700; color:#fff;">2. INFORMACIÓN DEL PACIENTE</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight: 700; background-color: #DBDBDB;">
                                    Fecha de nacimiento del paciente
                                </td>
                                <td colspan="2" style="font-weight: 700; background-color: #DBDBDB;">
                                    Edad del paciente en el momento del EA
                                    <hr>
                                    Edad – Años/Meses/ días
                                </td>
                                <td style="font-weight: 700; background-color: #DBDBDB;">
                                    Documento de identificación del paciente
                                    <hr>
                                    CC | TI | RC | NUIP | Cód. Lab | Otro | S/I
                                </td>
                                <td colspan="2" style="font-weight: 700; background-color: #DBDBDB;">
                                    Iniciales del paciente
                                </td>
                                <td colspan="2" style="font-weight: 700; background-color: #DBDBDB;">
                                    Sexo
                                    <hr>
                                    M | F | S/I
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php echo $FECHA_NACIMIENTO_PACIENTE ?>
                                </td>
                                <td colspan="2">
                                    <?php echo $EDAD_PACIENTE ?>
                                </td>
                                <td>
                                    <?php echo $TIPO_DOCUMENTO_PACIENTE ?> - <?php echo $NUMERO_DOCUMENTO_PACIENTE ?>
                                </td>
                                <td colspan="2">
                                    <?php echo $INICIALES_PACIENTE ?>
                                </td>
                                <td colspan="2">
                                    <?php echo $SEXO ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align: left; font-weight: 700">
                                    Diagnóstico principal y otros diagnósticos: <?php echo $DIAGNOSTICO_PRINCIPAL ?>
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
                                <td colspan="4" class="titulos3" style="font-weight: 700; color:#fff;">3.RECLAMOS TECNICOS DE PRODUCTO</td>
                            </tr>
                            <tr>
                                <td colspan="1" style="font-weight: 700; text-align:left;">
                                    Fecha de Inicio del Reporte: <br>
                                    <?php echo $FECHA_INICIO_EVENTO ?>
                                </td>
                                <td colspan="3" style="font-weight: 700; text-align:left;">
                                    <p>Queja técnica /Reclamos Técnicos de Producto:</p>
                                    <?php echo $EVENTO_ADVERSO ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" style="font-weight: 700; text-align:left;">
                                    Descripción y análisis del Reclamo:<br>
                                    <?php echo $DESCRIPCION_ANALISIS_EVENTO ?>
                                </td>
                                <td colspan="3">
                                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <?php if ($DESENLACE_EVENTO == 'Cuando se notifico el problema, ¿el paciente estaba utilizando el producto?') { ?>
                                                    <td style="font-weight: 700; text-align: left">
                                                        <p style="font-weight: 700; "> Información complementaria (Marcar con X)</p>
                                                        <span style="color: #ff0000;">X</span> Cuando se notificó el problema, ¿el paciente estaba utilizando el producto? <br>
                                                        Se notificó algún daño o lesión <br>
                                                    </td>
                                                <?php } else if ($DESENLACE_EVENTO == 'Se notifico algun dano o lesion') { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; "> Información complementaria (Marcar con X)</p>
                                                        Cuando se notificó el problema, ¿el paciente estaba utilizando el producto? <br>
                                                        <span style="color: #ff0000;">X</span> Se notificó algún daño o lesión <br>
                                                    </td>
                                                <?php } else { ?>
                                                    <td style="text-align: left">
                                                        <p style="font-weight: 700; "> Información complementaria (Marcar con X)</p>
                                                        Cuando se notificó el problema, ¿el paciente estaba utilizando el producto? <br>
                                                        Se notificó algún daño o lesión <br>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                            <?php if ($LUGAR_DISTRIBUCION == 'Asegurador') { ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <p style="font-weight: 700; ">Información complementaria (lugar de distribución)</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Asegurador</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Operador Logístico</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Punto de Entrega</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: center">
                                                        X
                                                    </td>
                                                    <td colspan="2" style="text-align: center">

                                                    </td>
                                                    <td colspan="2" style="text-align: center">

                                                    </td>
                                                </tr>
                                            <?php } else if ($LUGAR_DISTRIBUCION == 'Operador Logistico') { ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <p style="font-weight: 700; ">Información complementaria (lugar de distribución)</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Asegurador</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Operador Logístico</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Punto de Entrega</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: center">

                                                    </td>
                                                    <td colspan="2" style="text-align: center">
                                                        X
                                                    </td>
                                                    <td colspan="2" style="text-align: center">

                                                    </td>
                                                </tr>
                                            <?php } else if ($LUGAR_DISTRIBUCION == 'Punto de Entrega') { ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <p style="font-weight: 700; ">Información complementaria (lugar de distribución)</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Asegurador</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Operador Logístico</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Punto de Entrega</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: center">

                                                    </td>
                                                    <td colspan="2" style="text-align: center">

                                                    </td>
                                                    <td colspan="2" style="text-align: center">
                                                        X
                                                    </td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <p style="font-weight: 700; ">Información complementaria (lugar de distribución)</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Asegurador</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Operador Logístico</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Punto de Entrega</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: center">

                                                    </td>
                                                    <td colspan="2" style="text-align: center">

                                                    </td>
                                                    <td colspan="2" style="text-align: center">

                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </td>
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
        background-color: #D4243B;
        font-family: Tahoma, Geneva, sans-serif;
        color: #000;
    }

    .titulos2 {
        background-color: #D4243B;
        font-family: Tahoma, Geneva, sans-serif;
        color: #000;
    }

    .titulos3 {
        background-color: #D4243B;
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
