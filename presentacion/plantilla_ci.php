<?php
require '../datos/conex.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #signatureCanvas {
            border: 2px solid #000;
        }

        .titulo {
            text-align: center;
            font-size: 15px;
            margin-top: 0;
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
            margin: 2px;
            line-height: 1;
        }

        .apa-citation {
            font-family: Arial, sans-serif;
            font-size: 15px;
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

        input {
            border: none;
            outline: none;
            width: 70%;
            text-decoration: underline;
            /* Para quitar también el resaltado al enfocar el input */
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['pap']) && isset($_GET['ges']) && isset($_GET['expires']) && isset($_GET['signature'])) {
        $ID_PACIENTE = $_GET['pap'];
        $ID_GESTION_ULT = $_GET['ges'];
        $expires = $_GET['expires'];
        $received_signature = $_GET['signature'];

        $select_pap_ci = mysqli_query($conex, "SELECT * FROM ipsen_pacientes INNER JOIN ipsen_gestiones ON ID_PACIENTE = ID_PACIENTE_FK2 INNER JOIN ipsen_tratamiento ON ID_PACIENTE = ID_PACIENTE_FK WHERE ID_PACIENTE = '$ID_PACIENTE' AND CONSENTIMIENTO = 'SI'");
        while ($fila_pap_ci = mysqli_fetch_array($select_pap_ci)) {
            $ID_GES = $fila_pap_ci['ID_GESTION'];
            $ID_PAP = $fila_pap_ci['ID_PACIENTE'];
            $NOMBRE_PACIENTE = $fila_pap_ci['NOMBRE_PACIENTE'];
            $APELLIDO_PACIENTE = $fila_pap_ci['APELLIDO_PACIENTE'];
            $IDENTIFICACION_PACIENTE = $fila_pap_ci['IDENTIFICACION_PACIENTE'];
            $TELEFONO_PACIENTE = $fila_pap_ci['TELEFONO_PACIENTE'];
            $CONSENTIMIENTO = $fila_pap_ci['CONSENTIMIENTO'];
            $PRODUCTO_TRATAMIENTO = $fila_pap_ci['PRODUCTO_TRATAMIENTO'];
            $PROGRAMA_TRA = $fila_pap_ci['PROGRAMA_TRA'];
            // $ID_PAP = $fila_pap_ci['ID_PACIENTE'];
            // $ID_PAP = $fila_pap_ci['ID_PACIENTE'];
        }
        if ($CONSENTIMIENTO == 'SI') {
    ?>
            <div class="container">
                <div class="apa-citation">
                    <div class="card">
                        <div class="card-body">
                            <div class="parrafos">
                                <p class="titulo">
                                    <img src="../dompdf/vendor/dompdf/dompdf/lib/res/logo_ci.jpg">
                                    <span class="br"></span>
                                    <span class="br"></span>
                                    <span class="br"></span>
                                    <strong>
                                        PROGRAMA DE SOPORTE A PACIENTES DE LABORATORIO IPSEN COLOMBIA S.A.S. <?php echo $ID_GES ?>
                                        <span class="br"></span>
                                        <span class="br"></span>
                                        AUTORIZACIÓN TRATAMIENTO DE DATOS PERSONALES PACIENTE- MAYOR DE EDAD
                                    </strong>
                                </p>
                            </div>
                            <span class="br"></span>
                            <span class="br"></span>
                            <p class="texto">
                                Ipsen Colombia S.A.S. (“Ipsen”) maneja dentro de sus bases de datos información que usted en calidad de
                                PACIENTE nos ha proporcionado y reportado en el desarrollo de las diferentes actividades y servicios en
                                el marco del Programa de Soporte a Pacientes bajo tratamiento con el medicamento <input type="text" id="medicamento" name="medicamento" value="<?php echo $PRODUCTO_TRATAMIENTO ?>" style="width: 9%;" readonly>
                                (el “Medicamento”), del programa <input type="text" id="medicamento" name="medicamento" value="<?php echo $PROGRAMA_TRA ?>" style="width: 7%;" readonly> (el “Programa”).
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
                            <p class="texto">
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
                                Nombre y apellidos completos:
                                <input type="text" name="nombre" id="nombre" value="<?php echo $NOMBRE_PACIENTE . ' ' . $APELLIDO_PACIENTE ?>" readonly>
                            </p>
                            <span class="br"></span>
                            <p class="texto">
                                Documento de identidad:
                                <input type="text" name="documento" id="documento" value="<?php echo $IDENTIFICACION_PACIENTE ?>" readonly>
                            </p>
                            <span class="br"></span>
                            <p class="texto">
                                Teléfono:
                                <input type="text" name="telefono" id="telefono" value="<?php echo $TELEFONO_PACIENTE ?>" readonly>
                            </p>
                            <span class="br"></span>
                            <p class="texto">
                                Fecha:
                                <input type="text" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>" readonly>
                            </p>
                            <span class="br"></span>
                            <p class="texto">
                                Nombre del médico tratante:
                                <input type="text" name="nombre_medico" id="nombre_medico" value="Prueba Desarrollo" readonly>
                            </p>
                            <span class="br"></span>
                            <span class="br"></span>
                            <div class="col mb-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-primary" role="alert">
                                            <div class="alert-message">
                                                Escriba su firma en el siguiente recuadro usando el mouse, el lápiz táctil o el
                                                dedo
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="row-reverse">
                                    <div class="col d-flex justify-content-center">
                                        <canvas id="canvas" width="500" height="200" class="border border-3 border-dark rounded-5"></canvas>
                                    </div>
                                    <div class="col my-3">
                                        <div class="row">
                                            <div class="col-4 mx-auto">
                                                <button class="btn btn-danger w-100" id="clearBtn">Limpiar</button>
                                            </div>
                                            <div class="col-4 mx-auto">
                                                <button class="btn btn-primary w-100" id="saveBtn">Confirmar firma</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col my-5 d-flex justify-content-center">
                                <button type="button" class="btn btn-primary btn-lg rounded-5" id="btnSubmitCreate" disabled>REGISTRAR
                                    CONSENTIMIENTO</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var canvas = document.getElementById('canvas');
                    // Agregar el atributo willReadFrequently
                    canvas.willReadFrequently = true;
                    var context = canvas.getContext('2d');
                    var isDrawing = false;

                    canvas.addEventListener('mousedown', function(event) {
                        isDrawing = true;
                        context.beginPath();
                        context.moveTo(event.offsetX, event.offsetY);
                    });

                    canvas.addEventListener('mousemove', function(event) {
                        if (isDrawing) {
                            context.lineTo(event.offsetX, event.offsetY);
                            context.stroke();
                        }
                    });

                    canvas.addEventListener('mouseup', function() {
                        isDrawing = false;
                    });

                    document.getElementById('clearBtn').addEventListener('click', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Firma eliminada',
                            text: 'Campo sin firma'
                        })
                        context.clearRect(0, 0, canvas.width, canvas.height);
                    });

                    var signatureImage;

                    document.getElementById('saveBtn').addEventListener('click', function() {
                        // Obtener el canvas y su contexto
                        var canvas = document.getElementById('canvas');
                        var context = canvas.getContext('2d');

                        // Verificar si la firma está presente en el canvas
                        var isCanvasBlank = !context.getImageData(0, 0, canvas.width, canvas.height).data.some(channel => channel !== 0);

                        // Si el canvas está vacío, mostrar un mensaje de error y no guardar la firma
                        if (isCanvasBlank) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Por favor, escriba su firma antes de guardarla.'
                            });
                            return;
                        }

                        // Si la firma está presente, guardarla y mostrar un mensaje de éxito
                        var signatureImage = canvas.toDataURL();
                        localStorage.setItem('firma', signatureImage);

                        Swal.fire({
                            icon: 'success',
                            title: 'Firma guardada',
                            text: 'Tu firma ha sido guardada con éxito.'
                        });
                        enableConsentButton();
                    });

                    function enableConsentButton() {
                        var btnSubmitCreate = document.getElementById('btnSubmitCreate');
                        btnSubmitCreate.removeAttribute('disabled');
                    }
                });

                var btnSubmitCreate = document.getElementById('btnSubmitCreate');
                btnSubmitCreate.addEventListener('click', function() {
                    // Obtener la firma del almacenamiento local
                    var nombre = document.getElementById('nombre').value;
                    var signatureImage = localStorage.getItem('firma');

                    // Verificar si la firma está presente
                    if (!signatureImage) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Por favor, guarda tu firma antes de registrar el consentimiento'
                        });
                        return;
                    }

                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'generar_pdf.php'; // Este archivo será responsable de generar el PDF

                    // Crear input para la firma
                    var firmaInput = document.createElement('input');
                    firmaInput.type = 'hidden';
                    firmaInput.name = 'firma';
                    firmaInput.value = signatureImage;

                    // Crear input para otros valores (nombre, documento, teléfono, etc.)
                    var nombreInput = document.createElement('input');
                    nombreInput.type = 'hidden';
                    nombreInput.name = 'nombre';
                    nombreInput.value = document.getElementById('nombre').value; // Obtener el valor del campo nombre del formulario

                    var documentoInput = document.createElement('input');
                    documentoInput.type = 'hidden';
                    documentoInput.name = 'documento';
                    documentoInput.value = document.getElementById('documento').value; // Obtener el valor del campo nombre del formulario

                    var telefonoInput = document.createElement('input');
                    telefonoInput.type = 'hidden';
                    telefonoInput.name = 'telefono';
                    telefonoInput.value = document.getElementById('telefono').value; // Obtener el valor del campo nombre del formulario

                    var fechaInput = document.createElement('input');
                    fechaInput.type = 'hidden';
                    fechaInput.name = 'fecha';
                    fechaInput.value = document.getElementById('fecha').value; // Obtener el valor del campo nombre del formulario

                    var medicoInput = document.createElement('input');
                    medicoInput.type = 'hidden';
                    medicoInput.name = 'nombre_medico';
                    medicoInput.value = document.getElementById('nombre_medico').value; // Obtener el valor del campo nombre del formulario
                    // Crear más inputs para otros valores aquí...

                    // Agregar los elementos de entrada al formulario
                    form.appendChild(firmaInput);
                    form.appendChild(nombreInput);
                    form.appendChild(documentoInput);
                    form.appendChild(telefonoInput);
                    form.appendChild(fechaInput);
                    form.appendChild(medicoInput);
                    // Agregar más inputs al formulario si es necesario...

                    // Agregar el formulario al documento y enviarlo
                    document.body.appendChild(form);
                    form.submit();

                });

                function showLoadingAlert() {
                    Swal.fire({
                        type: 'info',
                        html: '<span class="iconify me-3" data-icon="line-md:uploading-loop" data-width="150" style="color: rgb(87, 24, 176)"></span><span class="fw-bold h3">Cargando...</span>',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                }
            </script>
    <?php
        } else {
            echo "Firma no válida. Acceso denegado.";
        }
    } else {
        // La firma no es válida, es posible que haya habido manipulación o un intento de ataque
        echo "Error: La firma no coincide. Acceso denegado." . $received_signature . ' = ' . $signature_to_check;
        // Puedes registrar este intento de acceso no autorizado para futuras investigaciones
    }
    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>