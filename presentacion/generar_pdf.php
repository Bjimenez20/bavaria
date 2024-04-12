<?php
require '../datos/conex.php';

$firmaBase64 = $_POST['firma'];
$medicamento = $_POST['medicamento'];
$programa = $_POST['programa'];
$nombre = $_POST['nombre'];
$documento = $_POST['documento'];
$telefono = $_POST['telefono'];
$fecha = $_POST['fecha'];
$nombre_medico = $_POST['nombre_medico'];
$pap = $_POST['pap'];

$insert_pap_ci = mysqli_query($conex, "INSERT INTO `ipsen_informacion_ci` (`NOMBRE_PACIENTE`, `PAP`, `FECHA_FIRMA`) VALUES ('$nombre', '$pap', '$fecha');");

// Decodifica la firma base64 si es necesario
$firma = base64_decode($firmaBase64);

// Cargar el HTML de la plantilla desde un archivo
$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .page-break-before {
            page-break-before: always;
        }

        .titulo {
            text-align: center;
            font-size: 13px;
            margin-top: -5;
        }

        .contenido {
            line-height: 1;
            margin: auto;
            /* background-color: red; */
            /* border-radius: 5px;
            border: 5px solid blue; */
            /* Definir el estilo, el ancho y el color del borde */
        }

        .texto {
            margin-bottom: 5%;
        }

        li {
            list-style-type: none;
            /* Eliminar los puntos de la lista */
        }

        .br:before {
            content: "\A";
            /* Inserta un salto de línea */
            white-space: pre;
            /* Asegura que el salto de línea se muestre correctamente */
        }

        .parrafos {
            margin: 20px;
            line-height: 1;
        }

        .apa-citation {
            font-family: Arial, sans-serif;
            font-size: 12.6px;
            line-height: 1;
            margin: 60px;
        }

        .apa-citation p {
            margin: 0;
        }

        .apa-citation strong {
            font-style: arial;
        }

        .apa-citation em {
            font-weight: bold;
        }

        .apa-citation:before {
            display: block;
            width: 100%;
            height: 1px;
            background-color: #000;
            margin: 15px 0;
        }

        /* Estilos del encabezado */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            color: black;
            text-align: center;
            /* padding: 10px 0; */
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            color: black;
            /* padding: 10px 0; */
            font-size: 12px;
        }

        .page-break {
            page-break-after: always;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Style the table header */
        th {
            /* background-color: #f2f2f2; */
            border: 1px solid #dddddd;
            /* padding: 8px;
            text-align: left; */
        }

        /* Style the table rows */
        /* tr:nth-child(even) {
            background-color: #f9f9f9;
        } */

        /* Style the table cells */
        td {
            border: 1px solid #dddddd;
            /* padding: 8px; */
        }
    </style>
</head>

<body>
    <header>
        <p class="titulo">
            <img src="../dompdf/vendor/dompdf/dompdf/lib/res/logo_ci.jpg">
        </p>
    </header>
    <div class="apa-citation" style="margin-top: 43px;">
        <div class="contenido">
            <div class="parrafos">
                <p class="titulo">
                    <strong>
                        PROGRAMA DE SOPORTE A PACIENTES DE LABORATORIO IPSEN COLOMBIA S.A.S.
                        <span class="br"></span>
                        <span class="br"></span>
                        AUTORIZACIÓN TRATAMIENTO DE DATOS PERSONALES PACIENTE- MAYOR DE EDAD
                    </strong>
                </p>
            </div>
            <p class="texto">
                Ipsen Colombia S.A.S. (“Ipsen”) maneja dentro de sus bases de datos información que usted en calidad de
                PACIENTE nos ha proporcionado y reportado en el desarrollo de las diferentes actividades y servicios en
                el marco del Programa de Soporte a Pacientes bajo tratamiento con el medicamento ' . $medicamento . '
                (el “Medicamento”), del programa ' . $programa . ' (el “Programa”).
            </p>
            <span class="br"></span>
            <p class="texto">
                “Información Personal” o “Datos Personales” se refiere a toda la información que proporcione como parte
                de su participación en el Programa o para la prestación de las actividades y servicios en el Programa,
                incluyendo datos personales y datos personales sensibles (incluidos los datos que suministre como parte
                de los cuestionarios médicos de evaluación, tales como el nombre, género, edad, fecha de nacimiento,
                dirección, domicilio, número de teléfono o celular, así como cualquier otro dato médico, de
                farmacovigilancia, acontecimiento adverso o reacción inesperada en relación con su tratamiento).
            </p>
            <span class="br"></span>
            <p class="texto">
                Esta información será tratada por Ipsen y por las compañías del Grupo Ipsen (Ipsen S.A., Ipsen Pharma
                S.A.S.); y por los proveedores de servicios que Ipsen designe, para el manejo del Programa, quienes
                actuarán en calidad de responsables y/o encargados, según corresponda, conforme a la Política de
                Tratamiento de Datos Personales, disponible en: [tratamientoinformacion.colombia@ipsen.com]. La
                Información Personal que suministre será utilizada con los siguientes fines:
            </p>
            <span class="br"></span>
            <p class="texto">
                <li>a. Ser contactado por el call center del Programa. </li>
                <li>b. Ser invitado a los eventos de educación del Programa.</li>
                <li>c. Ser informado de los cambios que puedan presentarse durante el Programa.</li>
                <li>d. Intercambiar información sobre su enfermedad y el progreso del tratamiento con su Médico tratante, el
                    asegurador o la red prestadora de salud a la que esté afiliado (o la entidad que haga sus veces) o con
                    personas vinculadas a estos, siempre dentro del contexto del desarrollo del Programa. </li>
                <li>e. Recibir llamadas telefónicas, correos electrónicos, mensajes de texto, ser contactado en persona, o por
                    cualquier otro medio determinado por Ipsen para la fijación de citas, realización de invitaciones a actividades
                    educativas, brindar información general sobre el uso correcto del Medicamento. </li>
                <li>f. Ser contactado para completar encuestas de satisfacción de los servicios del Programa.</li>
                <li>g. Ser contactado por el departamento de farmacovigilancia de Ipsen, en caso de reportes de evento
                    adversos para ampliar información y/o hacer seguimiento. </li>
                <li>h. Ser contactado para recibir la información sobre los beneficios del Programa, incluyendo, pero sin
                    limitarse a material y actividades educativas, exámenes de seguimiento, seguimiento, acompañamiento y
                    gestión a la adherencia del tratamiento entre otros. </li>
                <li>i. Fines administrativos, estadísticos y de servicio al paciente. </li>
                <li>j. Enviarle invitaciones para participar en testimoniales de pacientes.</li>
                <li>k. Desarrollar todas las actividades y servicios incluidos en el Programa.</li>
                <li>l. Asegurar la continuidad del Programa.</li>
            </p>
            <span class="br"></span>
            <p class="texto">
                Para el cumplimiento de los fines mencionados, Ipsen puede necesitar comunicar, transmitir y/o transferir
                su Información Personal incluso con terceros ubicados en países que no proporcionen niveles adecuados
                de protección, y particularmente a las siguientes partes interesadas: (i) los proveedores de servicios dentro
                del marco del Programa, (ii) su Médico tratante, (iii) sus Educadores, (iv) las autoridades sanitarias, (v) la
                red prestadora de servicios o quien haga sus veces, (vi) las compañías del Grupo Ipsen, (vii) el proveedor
                de servicios a quien Ipsen designe para el manejo del Programa.
            </p>
            <span class="br"></span>
            <p class="texto">
                En este sentido, al aceptar este documento, usted autoriza expresamente que su Información Personal
                pueda ser transmitida y/o trasferida por Ipsen o por el proveedor de servicios a quien Ipsen designe para el
                manejo del Programa en calidad de responsable o encargado (según corresponda) a las compañías del
                Grupo Ipsen.
            </p>
            <span class="br"></span>
            <p class="texto">
                Usted expresamente reconoce y acepta que las empresas del Grupo Ipsen identificadas en
                esta autorización pueden ser modificadas o se pueden incluir nuevas compañías vinculadas y afiliadas de
                Ipsen. Asimismo, usted expresamente reconoce y acepta que Ipsen podrá transmitir, transferir y compartir
                sus Datos Personales con compañías vinculadas y afiliadas de Ipsen, a nivel nacional e internacional, e
                incluso ubicadas en países que no proporcionen niveles adecuados de protección.
            </p>
            <span class="br"></span>
            <p class="texto">
                Una vez finalizado el Programa o si decide retirarse del mismo, sus Datos Personales se eliminarán tan
                pronto como sea razonablemente posible, por lo que estos no se conservarán más del tiempo necesario, a
                menos que sea necesario seguir conservándolos para cumplir con cualquier requisito bajo la legislación
                aplicable.
            </p>
            <span class="br"></span>
            <span class="br"></span>
            <span class="br"></span>
            <p class="texto" style="margin-top: 4%;">
                Usted no está obligado a autorizar el tratamiento de sus Datos Personales sensibles como aquellos
                relacionados a su salud. Usted declara y expresa que es consciente de sus derechos a conocer, actualizar,
                suprimir y rectificar sus Datos Personales, solicitar prueba de la autorización otorgada, ser informado sobre
                el uso que se da a sus datos personales, presentar quejas ante las autoridades competentes y revocar la
                presente autorización.
            </p>
            <span class="br"></span>
            <p class="texto">
                Ipsen y las demás partes mencionadas anteriormente podrán dar usos secundarios a sus Datos Personales.
                Para estos efectos su Información Personal podrá ser anonimizada y posteriormente agregada. Esto
                significa que toda la información que pueda conducir a su identificación personal será eliminada de las
                respectivas bases de datos. La información que permanezca en la base de datos será anonimizada y
                agregada y, en consecuencia, no dará ningún detalle sobre usted y no permitirá saber quién es usted, ni
                contactarlo. Dicha información (es decir, la información sin identidad y sin que pueda conducir a su
                identificación) se compartirá con las autoridades sanitarias y las empresas del Grupo Ipsen en las
                condiciones mencionadas anteriormente.
            </p>
            <span class="br"></span>
            <p class="texto">
                Para cualquier consulta, actualización, rectificación, y/o supresión relativa al tratamiento de sus Datos
                Personales, puede ponerse en contacto con cada respectivo responsable y/o encargado a las respectivas
                direcciones electrónicas señaladas a continuación:
            </p>
            <span class="br"></span>
            <p class="texto">
            <table style="width: 100%;">
                <tr>
                    <th>
                        Entidad
                    </th>
                    <th>
                        Entidad
                    </th>
                    <th>
                        Correo electrónico
                    </th>
                    <th>
                        Política o Aviso de privacidad
                    </th>
                </tr>
                <tr>
                    <td>
                        Ipsen Colombia S.A.S.
                    </td>
                    <td>
                        NIT 901543555 - 4
                    </td>
                    <td>
                        tratamientoinformacion.colombia@ipsen.com
                    </td>
                    <td>
                        https://www.ipsen.com/brazil/privacidade-de-dados-colombia/
                    </td>
                </tr>
                <tr>
                    <td>
                        Ipsen Colombia S.A.
                    </td>
                    <td>

                        419 838 529
                    </td>
                    <td>
                        dataprivacy@ipsen.com
                    </td>
                    <td>
                        https://www.ipsen.com/globalprivacy-policy/
                    </td>
                </tr>
                <tr>
                    <td>
                        Ipsen Pharma S.A.
                    </td>
                    <td>
                        308 197 185
                    </td>
                    <td>
                        dataprivacy@ipsen.com
                    </td>
                    <td>
                        https://www.ipsen.com/globalprivacy-policy/
                    </td>
                </tr>
            </table>
            </p>
            <span class="br"></span>
            <p class="texto">
                Usted entiende que recibirá por parte de Ipsen una guía en la ruta administrativa, la asesoría y la asistencia
                necesaria sobre el proceso a realizar para acceder al Medicamento en el marco del Programa. Usted
                declara que conoce las implicaciones que se derivan de la presente autorización sobre el manejo de sus
                datos por parte de Ipsen, por las compañías del Grupo Ipsen (Ipsen S.A., Ipsen Pharma S.A.S.); y por los
                proveedores de servicios que Ipsen designe en el marco del Programa, con lo cual se busca poder ejercer
                intermediación en su nombre por mecanismos virtuales o presenciales ante los diferentes actores del
                sistema de salud colombiano (EPS- IPS- Operador logístico) para la gestión de barreras administrativas
                para lograr el acceso al Medicamento.
            </p>
            <span class="br"></span>
            <p class="texto">
                Comprende que el servicio prestado, no incentiva, gestiona, recomienda, realiza o financia acciones legales
                que busquen forzar el acceso al medicamento.
            </p>
            <span class="br"></span>
            <p class="texto">
                <strong>
                    FIRMA DEL PACIENTE
                </strong>
            </p>
            <span class="br"></span>
            <p class="texto">
                Yo, identificado como se señala debajo de mi firma, otorgo mi consentimiento para el tratamiento de mis
                Datos Personales conforme a lo establecido en esta autorización, y declaro que la información que
                suministro es veraz, completa, exacta, actualizada, comprobable y comprensible:
            </p>
            <span class="br"></span>
            <p class="texto">
            Firma:
                <!-- Lugar para la firma -->
                <img src="' . $firmaBase64 . '" alt="Firma del paciente" style="width: 35%;">
            </p>
            <span class="br"></span>
            <p class="texto">
                Nombre y apellidos completos: ' . $nombre . '
            </p>
            <span class="br"></span>
            <p class="texto">
                Documento de identidad: ' . $documento . '
            </p>
            <span class="br"></span>
            <p class="texto">
                Teléfono: ' . $telefono . '
            </p>
            <span class="br"></span>
            <p class="texto">
                Fecha: ' . $fecha . '
            </p>
            <span class="br"></span>
            <p class="texto">
                Nombre del médico tratante: ' . $nombre_medico . '
            </p>
        </div>
    </div>
    <footer>
        Formatos - Programa de soporte a pacientes IPSEN Colombia S.A.S. Material de uso exclusivo del PSP
        <span class="br"></span>
        Código: CBZ-CO-000079; Fecha de vencimiento: 12/19/2024
    </footer>
</body>

</html>';

// Busca el marcador de posición para la firma en la plantilla HTML
// Supongamos que tienes un marcador de posición en tu plantilla HTML como {{firma}}
// Reemplaza este marcador de posición con la firma
$html = str_replace('{{firma}}', '<img src="data:image/png;base64,' . base64_encode($firma) . '">', $html);

// Crear una instancia de Dompdf
include_once "../dompdf/vendor/autoload.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// Renderiza el HTML en PDF
$dompdf->render();

// Salida del PDF
// $dompdf->stream("'$nombre'_'$pap'.pdf");
$output = $dompdf->output();
file_put_contents('../EVENTO_ADVERSO/' . $pap . '.pdf', $output);
$update_pap_ci = mysqli_query($conex, "UPDATE ipsen_pacientes SET `CONSENTIMIENTO` = 'NO' WHERE `ID_PACIENTE` = '$pap'");
include '../presentacion/email/mail_envio_ci_pap.php';
