<?php
//include("../logica/session.php");
require('../datos/parse_str.php');
require_once("../dompdf/dompdf_config.inc.php");
require("../datos/conex.php");
$ID_EVENTO_ADVERSO = $ID_EA;
include("../logica/consulta_pdf_ea.php");
$codigoHTML = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BAVARIA</title>
    <style>
        .titulos {
            background-color: #848484;
            font-family: Tahoma, Geneva, sans-serif;
            color: #FFF;
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
    </style>
</head>
    <body>
            <center>
                <table style="width:80%; border:1px solid #000;" rules="all">
                    <tr>
                        <th class="titulos" colspan="4">
                            1. INFORMACIÓN DEL REPORTANTE
                        </th>
                    </tr>
                    <input type="text" name="ID_PACIENTE" id="ID_PACIENTE" value="<?php echo $ID_PACIENTE2 ?>" readonly="readonly" style="display:none;">
                    <tr colspan="4">
                        <th>
                            Fecha de Notificacion<span class="obli">*</span><br>
                            <span style=" font-weight:none">' . $FECHA_NOTIFICA . '</span>
                        </th>
                        <th>Origen del reporte
                            <hr>
                            Departamento - Municipio<span class="obli">*</span><br />
                            <span style=" font-weight:none">' . $DEPARTAMENTO . '</span> - <span style=" font-weight:none">' . $MUNICIPIO . '</span>
                        </th>
                        <th>
                            Nombre de la Institución donde ocurri&oacute; el evento<span class="obli">*</span><br />
                            <span style=" font-weight:none">' . $NOMBRE_INSTITUCION . '</span>
                        </th>
                        <th>
                            C&oacute;digo PNF<span class="obli">*</span><br />
                            <span style=" font-weight:none">' . $CODIGO_PNF . '</span>
                        </th>
                    </tr>
                    <tr colspan="4">
                        <th colspan="2">
                            Nombre del Reportante primario<span class="obli">*</span><br />
                            <span style=" font-weight:none">' . $NOMBRE_REPORTANTE . '</span>
                        </th>
                        <th>
                            Profesi&oacute;n del reportante primario <span class="obli">*</span>
                            <span style=" font-weight:none">' . $PROFESION_REPORTANTE . '</span>
                        </th>
                        <th>
                            Correo electr&oacute;nico institucional del reportante primario <span class="obli">*</span><br />
                            <span style=" font-weight:none">' . $CORREO_REPORTANTE . '</span>
                        </th>
                    </tr>
                    <tr>
                        <th class="titulos" colspan="4">
                            2. INFORMACIÓN DEL PACIENTE
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Fecha de nacimiento del paciente <span class="obli">*</span><br>
                            <span style=" font-weight:none">' . $FECHA_NACIMIENTO_PACIENTE . '</span>
                        </th>
                        <th>
                            Edad del paciente en el momento del EA
                            <hr>
                            Edad<span class="obli">*</span><br />
                            <span style=" font-weight:none">' . $EDAD_PACIENTE . '</span>
                        </th>
                        <th>
                            Tipo de identificación - Número de identificación del paciente<span class="obli">*</span><br>
                            <span style=" font-weight:none">' . $TIPO_DOCUMENTO_PACIENTE . '</span> - <span style=" font-weight:none">' . $NUMERO_DOCUMENTO_PACIENTE . '</span>
                        </th>
                        <th>
                            Iniciales del paciente<span class="obli">*</span><br>
                            <span style=" font-weight:none">' . $INICIALES_PACIENTE . '</span>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Sexo<span class="obli">*</span><br>
                            <span style=" font-weight:none">' . $SEXO . '</span>
                        </th>
                        <th>
                            Peso - Talla<span class="obli">*</span><br>
                            <span style=" font-weight:none">' . $PESO . '</span> - <span style=" font-weight:none">' . $TALLA . '</span>
                        </th>
                        <th colspan="2">
                            Diagnóstico principal y otros diagnósticos:<span class="obli">*</span><br>
                            <span style=" font-weight:none">' . $DIAGNOSTICO_PRINCIPAL . '</span>
                        </th>
                    </tr>
                    <tr>
                        <th class="titulos" colspan="4">
                            3. INFORMACIÓN DE LOS MEDICAMENTOS
                            <P>Registre todos los medicamentos utilizados y marque con una “S” el (los) sospechoso(s), con una “C” el (los) concomitantes y con una “I” las interacciones. </P>
                        </th>
                    </tr>
                    <tr>
                        <th>S/C/I</th>
                        <th><span style=" font-weight:none">' . $SCI1 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $SCI2 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $SCI3 . '</span> <br></th>
                    </tr>
                    <tr>
                        <th>Medicamento
                            <p>(Denominación Común Internacional o Nombre genérico)</p>
                        </th>
                        <th><span style=" font-weight:none">' . $MEDICAMENTO1 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $MEDICAMENTO2 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $MEDICAMENTO3 . '</span> <br></th>
                    </tr>
                    <tr>
                        <th>Indicación</th>
                        <th><span style=" font-weight:none">' . $INDICACION1 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $INDICACION2 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $INDICACION3 . '</span> <br></th>
                    </tr>
                    <tr>
                        <th>Dosis</th>
                        <th><span style=" font-weight:none">' . $DOSIS1 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $DOSIS2 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $DOSIS3 . '</span> <br></th>
                    </tr>
                    <tr>
                        <th>Unidad de medida</th>
                        <th><span style=" font-weight:none">' . $UNIDAD_MEDIDA1 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $UNIDAD_MEDIDA2 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $UNIDAD_MEDIDA3 . '</span> <br></th>
                    </tr>
                    <tr>
                        <th>Vía de administración</th>
                        <th><span style=" font-weight:none">' . $VIA_ADMINISTRACION1 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $VIA_ADMINISTRACION2 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $VIA_ADMINISTRACION3 . '</span> <br></th>
                    </tr>
                    <tr>
                        <th>Frecuencia de administración</th>
                        <th><span style=" font-weight:none">' . $FRECUENCIA_ADMINISTRACION1 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $FRECUENCIA_ADMINISTRACION2 . '</span> <br></th>
                        <th><span style=" font-weight:none">' . $FRECUENCIA_ADMINISTRACION3 . '</span> <br></th>
                    </tr>
                    <tr>
                        <th>
                            Fecha inicio<br />
                        </th>
                        <th>
						<span style=" font-weight:none">' . $FECHA_INICIO1 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $FECHA_INICIO2 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $FECHA_INICIO3 . '</span> <br>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Fecha de finalización<br />
                        </th>
                        <th>
						<span style=" font-weight:none">' . $FECHA_FIN1 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $FECHA_FIN2 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $FECHA_FIN3 . '</span> <br>
                        </th>
                    </tr>
                    <tr>
                        <th class="titulos" colspan="4">
                            4. INFORMACIÓN DEL EVENTO ADVERSO
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            Fecha de Inicio del Evento Adverso
							<span style=" font-weight:none">' . $FECHA_INICIO_EVENTO . '</span> <br>
                        </th>
                        <th colspan="2">
                            Evento adverso:<br>
                            <span style=" font-weight:none">' . $EVENTO_ADVERSO . '</span> <br>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            Descripción y análisis del Evento Adverso:<br>
                            <span style=" font-weight:none">' . $DESCRIPCION_ANALISIS_EVENTO . '</span> <br>
                        </th>
                        <th>
                            Desenlace del evento (Marcar con una X)<br><br>
                            <div style="text-align: left;">
							<span style=" font-weight:none">' . $DESENLACE_EVENTO . '</span> <br>
                            </div>
                        </th>
                        <th>
                            Seriedad (Marcar con X) <br><br>
                            <div style="text-align: left;">
							<span style=" font-weight:none">' . $SERIEDAD . '</span> <br>
                            </div>
                        </th>
                    </tr>
                    <tr colspan="4">
                        <th colspan="1">
                        </th>
                        <th colspan="1">
                            SI
                        </th>
                        <th colspan="1">
                            NO
                        </th>
                        <th colspan="1">
                            NO SABE
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿El evento se presentó después de administrar el medicamento? <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA1 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA1 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA1 . '</span> <br>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿Existen otros factores que puedan explicar el evento (medicamento, patologías, etc.)? <br>
                        </th>
                        <th>
                        <span style=" font-weight:none">' . $PREGUNTA2 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA2 . '</span> <br>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿El evento desapareció al disminuir o suspender el medicamento sospechoso? <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA3 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA3 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA3 . '</span> <br>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿El paciente ya había presentado la misma reacción al medicamento sospechoso? <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA4 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA4 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA4 . '</span> <br>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿Se puede ampliar la información del paciente relacionando con el evento? <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA5 . '</span> <br>
                        </th>
                        <th>
						<span style=" font-weight:none">' . $PREGUNTA5 . '</span> <br>
                        </th>
                        <th>
							<span style=" font-weight:none">' . $PREGUNTA5 . '</span> <br>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <br />
                            <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" />
                            <br />
                        </th>
                    </tr>
                </table>
            </center>
        </form>
    </body>
</html>';
$codigoHTML = utf8_encode($codigoHTML);
$dompdf = new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit", "128M");
$dompdf->render();
$output = $dompdf->output();
file_put_contents('../presentacion/PDF/Evento_Adverso_' . $ID_EVENTO_ADVERSO . '.pdf', $output);
if ($COMPANIA == "GRUPO ASEI") {
	include("../presentacion/email/mail_asei.php");
} else {
	include("../presentacion/email/mail.php");
}
