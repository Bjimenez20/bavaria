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

        $(document).ready(function() {
            $('input[id="desenlace_evento"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_desenlace_evento').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="seriedad"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_seriedad').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="pregunta1"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_pregunta1').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="pregunta2"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_pregunta2').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="pregunta3"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_pregunta3').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="pregunta4"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_pregunta4').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="pregunta5"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_pregunta5').val(inputValue);
            });
        });
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
            <table class="table table-bordered table-sm" cellspacing="0" cellpadding="0" style="width: 100%;">
                <tbody>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="titulo5" style="font-weight: 700">
                                            <span style="color:#0B4055;">Associated Procedure / Instruction Ref:</span>
                                        </td>
                                        <td colspan="4" class="titulo5" style="font-weight: 700">
                                            <span style="color:#0B4055;">132663-SOP</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="titulo5" style="font-weight: 700">
                                            <span style="color:#0B4055; font-size: 20px">Form Reference and Version</span>
                                        </td>
                                        <td colspan="4" class="titulo5" style="font-weight: 700">
                                            <span style="color:#0B4055;">132665-FOR V7.0</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="titulos2">
                                            <img src="../presentacion/imagenes/logo_evento.jpg" style="float: left;">
                                            <span style="margin-top: 10%;">
                                                <strong>Adverse Events and Special Situations Reporting Form for PDCS</strong> <br>
                                                Please complete as many details as possible and <strong>forward it to IPSEN contact immediately/within 24 hours/agreed timelines</strong> of becoming aware AE/PC/Safety Information
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <p style="text-align: left;">
                                                <strong>
                                                    SOURCE TYPE:
                                                </strong>
                                            </p>
                                            <div class="row">
                                                <div class="col d-flex justify-content-left w-100 h-100">
                                                    <input type="radio" name="source_type" id="source_type" value="Early Access"> Early Access
                                                    <input type="radio" name="source_type" id="source_type" value="Patient Support PSP-L-0017"> Patient Support PSP-L-0017
                                                    <input type="radio" name="source_type" id="source_type" value="Market Research"> Market Research
                                                    <input type="radio" name="source_type" id="source_type" value="Other"> Other
                                                </div>
                                            </div>
                                            <p style="text-align: left;">Specify:</p>
                                            <input type="text" id="other_source_type" name="other_source_type" class="form-control w-80 h-100">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div style="text-align: left;">
                                                <strong>Date of First Notification (Day 0)</strong> <input type="date" name="first_notification" id="first_notification" class="form-control w-100 h-100">
                                            </div>
                                            <p style="text-align: left;">(date first aware of the adverse event/safety information by a company employee/contractor)</p>
                                        </td>
                                        <td colspan="4">
                                            <div style="text-align: left;">
                                                <strong>STUDY/PROGRAMME NUMBER (UNIQUE ID):</strong>PSP-L-0017
                                            </div>
                                            <p style="text-align: left;">(Must be completed for all Solicited reports)</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">I) PATIENT Details (Identifier)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <span style="text-align: left;">1.Patient Initials/Number</span>
                                        </td>
                                        <td colspan="2">
                                            <span style="text-align: left;">2. Date of Birth:
                                                (DD/MMM/YYYY) </span>
                                        </td>
                                        <td colspan="1">
                                            <span style="text-align: left;">Age at time of event:</span>
                                        </td>
                                        <td colspan="1">
                                            <span style="text-align: left;">3. Gender </span>
                                        </td>
                                        <td colspan="2">
                                            <span style="text-align: left;">4. Weight:</span>
                                        </td>
                                        <td colspan="2">
                                            <span style="text-align: left;">5. Height:</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <input type="number" id="number" name="number" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="2">
                                            <input type="date" id="birth" name="birth" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="1">
                                            <input type="text" id="age_time_event" name="age_time_event" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="1">
                                            <input type="radio" name="gender" id="gender" value="Male"> Male
                                            <input type="radio" name="gender" id="gender" value="Female"> Female
                                        </td>
                                        <td colspan="2">
                                            <input type="text" name="weight" id="weight" class="form-control w-100 h-100">
                                            <input type="radio" name="weight_type" id="weight_type" value="kg"> kg
                                            <input type="radio" name="weight_type" id="weight_type" value="lbs"> lbs
                                        </td>
                                        <td colspan="2">
                                            <input type="text" name="height" id="height" class="form-control w-100 h-100">
                                            <input type="radio" name="height_type" id="height_type" value="cm"> cm
                                            <input type="radio" name="height_type" id="height_type" value="inch"> inch
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <p style="text-align: left;">* Neonate = from day of birth plus 27 days, Infant = from 1 month (28 days) to 23 months, Child = from 2 years to 11 years, Adolescent = from 12 years to less than 18 years, Adult = from 18 years to 64 years, Elderly = from 65 years)</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">II) SUSPECTED MEDICINAL PRODUCT</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">1.Trade Name (INN/Generic Name)</td>
                                        <td colspan="3">2. Batch No. and Expiry Date</td>
                                        <td colspan="3">3. Sample Available</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <input type="text" name="trade_name" id="trade_name" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="3">
                                            <input type="date" name="batch_no_date" id="batch_no_date" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="3">
                                            <input type="radio" name="sample_available" id="sample_available" value="YES"> Yes
                                            <input type="radio" name="sample_available" id="sample_available" value="NO"> No
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">4. Dose (specify units)</td>
                                        <td colspan="3">5. Frequency </td>
                                        <td colspan="3">6. Route of administration </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <input type="text" name="dose" id="dose" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="3">
                                            <input type="text" name="frequency" id="frequency" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="3">
                                            <input type="text" name="route_administration" id="route_administration" class="form-control w-100 h-100">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">7. Diagnosis/Indication</td>
                                        <td colspan="3">8. Treatment Start date </td>
                                        <td colspan="3">9. Treatment End date (or mention continuing)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <input type="text" name="diagnosis" id="diagnosis" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="3">
                                            <input type="date" name="treatment_start_date" id="treatment_start_date" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="3">
                                            <input type="date" name="treatment_end_date" id="treatment_end_date" class="form-control w-100 h-100">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <p style="text-align: left;">10. Any other information:</p>
                                            <textarea name="any_other_information" id="any_other_information" class="form-control w-100 h-100" cols="90" rows="5"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">III) MAIN EVENT</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p style="text-align: left;">
                                                1.a <strong>Onset</strong> Date <br>
                                                (DD/MMM/YYYY)
                                            </p>
                                        </td>
                                        <td colspan="2">
                                            <p style="text-align: left;">
                                                1.b Event <strong>Stop Date (if applicable) or <br> Mention Ongoing</strong>
                                            </p>
                                        </td>
                                        <td colspan="2">
                                            <p style="text-align: left;">
                                                <strong>
                                                    1.c Duration
                                                </strong>
                                            </p>
                                        </td>
                                        <td colspan="3">
                                            <p style="text-align: left;">
                                                1.d Event <strong>abated</strong> after use stopped
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="date" name="onset_date" id="onset_date" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="2">
                                            <input type="date" name="event_stop_date" id="event_stop_date" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="2">
                                            <input type="text" name="duration" id="duration" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="3">
                                            <input type="radio" name="event_abated" id="event_abated" value="NO"> No
                                            <input type="radio" name="event_abated" id="event_abated" value="YES"> Yes
                                            <input type="radio" name="event_abated" id="event_abated" value="N/A"> N/A
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <p style="text-align: left;">
                                                <strong>1.h Event term</strong> <br>
                                                (full description of the event including body site and severity)
                                            </p>
                                            <textarea name="event_term" id="event_term" class="form-control w-100 h-100" cols="90" rows="5"></textarea>
                                        </td>
                                        <td colspan="3">
                                            <table class="w-100 h-100">
                                                <tr>
                                                    <td>
                                                        <p style="text-align: left;">1.e Event <strong>reappeared</strong> after reintroduction</p>
                                                        <input type="radio" name="event_reappeared" id="event_reappeared" value="NO"> No
                                                        <input type="radio" name="event_reappeared" id="event_reappeared" value="YES"> Yes
                                                        <input type="radio" name="event_reappeared" id="event_reappeared" value="N/A"> N/A
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="text-align: left;"> 1.f Has this drug <strong>previously</strong> been used</p>
                                                        <input type="radio" name="previously_been" id="previously_been" value="NO"> No
                                                        <input type="radio" name="previously_been" id="previously_been" value="YES"> Yes
                                                        <input type="radio" name="previously_been" id="previously_been" value="N/A"> N/A
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="text-align: left;">
                                                            <strong>
                                                                1.g Seriousness of the event per Reporter
                                                            </strong>
                                                        </p>
                                                        <div style="text-align: left;">
                                                            <input type="radio" name="seriousness" id="seriousness" value="Non serious event"> Non serious event <br>
                                                            <input type="radio" name="seriousness" id="seriousness" value="Death - Date of death"> Death - Date of death: <input type="date" name="death_date" id="death_date"> <br>
                                                            <div style="text-align: right;">
                                                                Autopsy performed <input type="radio" name="autopsy" id="autopsy">YES <input type="radio" name="autopsy" id="autopsy">NO <br>
                                                                Cause of Death <input type="text" name="cause_death" id="cause_death">
                                                            </div>
                                                            <input type="radio" name="seriousness" id="seriousness" value="Life threatening"> Life threatening <br>
                                                            Inpatient hospitalisation or prolongation of existing hospitalisation <br>
                                                            <input type="radio" name="seriousness" id="seriousness" value="Persistent or significant disability/Incapacity"> Persistent or significant disability/Incapacity <br>
                                                            <input type="radio" name="seriousness" id="seriousness" value="Congenital anomaly/birth defect"> Congenital anomaly/birth defect <br>
                                                            <input type="radio" name="seriousness" id="seriousness" value="Other Serious (Medically important event)"> Other Serious (Medically important event) <br>
                                                            <input type="radio" name="seriousness" id="seriousness" value="Require intervention (only for devices)"> “Require intervention” (only for devices)
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <p style="text-align: left;">1.i Treatment for AE
                                                <input type="radio" name="treatment_for_ae" id="treatment_for_ae" value="YES"> Yes
                                                <input type="radio" name="treatment_for_ae" id="treatment_for_ae" value="NO"> No
                                            </p>
                                            <p style="text-align: left;">
                                                <strong>
                                                    Treatment Details:
                                                </strong>
                                            </p>
                                            <textarea name="treatment_details" id="treatment_details" class="form-control w-100 h-100" cols="90" rows="5"></textarea>
                                        </td>
                                        <td colspan="5">
                                            <p style="text-align: left;">
                                                <strong>
                                                    1.h Outcome
                                                </strong>
                                            </p>
                                            <input type="radio" name="outcome" id="outcome" value="Not recovered"> Not recovered
                                            <input type="radio" name="outcome" id="outcome" value="Recovering"> Recovering
                                            <input type="radio" name="outcome" id="outcome" value="Recovered with sequelae"> Recovered with sequelae
                                            <input type="radio" name="outcome" id="outcome" value="Recovered without sequelae"> Recovered without sequelae
                                            <input type="radio" name="outcome" id="outcome" value="Unknown"> Unknown
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <p style="text-align: left;">
                                                <strong>
                                                    2. Relevant tests/Laboratory data, including dates (please attach if possible)
                                                </strong>
                                            </p>
                                            <textarea name="laboratory" id="laboratory" class="form-control w-100 h-100" cols="90" rows="5"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <p style="text-align: left;">
                                                <strong>
                                                    3. Medical history including pre-existing conditions
                                                </strong>
                                            </p>
                                            <textarea name="medical_history" id="medical_history" class="form-control w-100 h-100" cols="90" rows="5"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <p style="text-align: left;">
                                                <strong>
                                                    4. Reporter’s Causality
                                                </strong>
                                            </p> <br>
                                            <p style="text-align: left;">
                                                Does the Reporter consider that the event was possibly related to the drug?
                                                <input type="radio" name="reporter_causality" value="YES"> Yes
                                                <input type="radio" name="reporter_causality" value="NO"> No
                                                <input type="radio" name="reporter_causality" value="Unknown"> Unknown
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <p style="text-align: left;">
                                                <strong>
                                                    5. Was the patient pregnant?
                                                </strong>
                                            </p>
                                            <input type="radio" name="reporter_causality" value="YES"> Yes
                                            <input type="radio" name="reporter_causality" value="NO"> No
                                            <input type="radio" name="reporter_causality" value="Unknown"> Unknown
                                            <input type="radio" name="reporter_causality" value="N/A"> N/A <br>
                                            <p style="text-align: left;">If yes, gestation period: <input type="text" name="reporter_causality_yes" id="reporter_causality_yes" class="form-control w-30 h-30"> weeks</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">IV) SPECIAL SITUATIONS</td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <input type="radio" name="special_situations" id="special_situations" value="Pregnancy (maternal exposure or paternal exposure (including potential alteration of spermatozoids))"> Pregnancy (maternal exposure or paternal exposure (including potential alteration of spermatozoids))
                                            <input type="radio" name="special_situations" id="special_situations" value="Breastfeeding"> Breastfeeding
                                            <input type="radio" name="special_situations" id="special_situations" value="Overdose"> Overdose
                                            <input type="radio" name="special_situations" id="special_situations" value="Misuse"> Misuse
                                            <input type="radio" name="special_situations" id="special_situations" value="Abuse"> Abuse
                                            <input type="radio" name="special_situations" id="special_situations" value="Medication Error"> Medication Error
                                            <input type="radio" name="special_situations" id="special_situations" value="Lack of Efficacy"> Lack of Efficacy
                                            <input type="radio" name="special_situations" id="special_situations" value="Occupational exposure"> Occupational exposure
                                            <input type="radio" name="special_situations" id="special_situations" value="Drug interaction"> Drug interaction
                                            <input type="radio" name="special_situations" id="special_situations" value="Off-label Use"> Off-label Use
                                            <input type="radio" name="special_situations" id="special_situations" value="Suspected transmission of infectious agent"> Suspected transmission of infectious agent
                                            <input type="radio" name="special_situations" id="special_situations" value="Unexpected beneficial event"> Unexpected beneficial event
                                            <input type="radio" name="special_situations" id="special_situations" value="Other"> Other
                                            Specify: <input type="text" name="special_situations_specify" id="special_situations_specify" class="form-control w-100 h-100">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">V) QUALITY DEFECT ISSUE / SUSPECTED FALSIFIED/COUNTERFEIT MEDICINAL PRODUCT</td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <input type="radio" name="quiality_defect" id="quiality_defect" value="Event related to a quality defect issue"> Event related to a quality defect issue
                                            <input type="radio" name="quiality_defect" id="quiality_defect" value="Event related to a suspected falsified/counterfeit medicinal product"> Event related to a suspected falsified/counterfeit medicinal product
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">VI) CO-SUSPECT (S) & CONCOMITANT (C) DRUGS</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="text-align: left;">
                                                <strong>
                                                    Drug (including dosage form)
                                                </strong>
                                            </p>
                                        </td>
                                        <td>
                                            <p style="text-align: left;">
                                                <strong>
                                                    Route
                                                </strong>
                                            </p>
                                        </td>
                                        <td>
                                            <p style="text-align: left;">
                                                <strong>
                                                    Daily dose
                                                </strong>
                                            </p>
                                        </td>
                                        <td>
                                            <p style="text-align: left;">
                                                <strong>
                                                    Duration
                                                </strong>
                                            </p>
                                        </td>
                                        <td>
                                            <table class="w-100 h-100">
                                                <p>
                                                    <strong>
                                                        Date of administration
                                                    </strong>
                                                </p>
                                                <td class="w-50 h-50">
                                                    <strong>
                                                        Start
                                                    </strong>
                                                </td>
                                                <td class="w-50 h-50">
                                                    <strong>
                                                        Stop
                                                    </strong>
                                                </td>
                                            </table>
                                        </td>
                                        <td>
                                            <p style="text-align: left;">
                                                <strong>
                                                    Indication
                                                </strong>
                                            </p>
                                        </td>
                                        <td>
                                            <p style="text-align: left;">
                                                <strong>
                                                    S or C
                                                </strong>
                                            </p>
                                        </td>
                                        <td>
                                            <p style="text-align: left;">
                                                <strong>
                                                    Company drug (Y/N)
                                                </strong>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="drug" id="drug" class="form-control w-100 h-100">
                                        </td>
                                        <td>
                                            <input type="text" name="route" id="route" class="form-control w-100 h-100">
                                        </td>
                                        <td>
                                            <input type="text" name="daily_dose" id="daily_dose" class="form-control w-100 h-100">
                                        </td>
                                        <td>
                                            <input type="text" name="duration" id="duration" class="form-control w-100 h-100">
                                        </td>
                                        <td>
                                            <table class="w-100 h-100">
                                                <td class="w-50 h-50">
                                                    <input type="date" name="start" id="start" class="form-control w-100 h-100">
                                                </td>
                                                <td class="w-50 h-50">
                                                    <input type="date" name="stop" id="stop" class="form-control w-100 h-100">
                                                </td>
                                            </table>
                                        </td>
                                        <td>
                                            <input type="text" name="indication" id="indication" class="form-control w-100 h-100">
                                        </td>
                                        <td>
                                            <select name="s_or_c" id="s_or_c" class="form-control w-100 h-100">
                                                <option>Seleccione...</option>
                                                <option value="S">S</option>
                                                <option value="C">C</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="company_drug" id="company drug" class="form-control w-100 h-100">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">VII) REPORTER</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p style="text-align: left;">
                                                <strong>
                                                    1.a Name
                                                </strong>
                                            </p>
                                        </td>
                                        <td colspan="2">
                                            <p style="text-align: left;">
                                                <strong>
                                                    1.b Phone number
                                                </strong>
                                            </p>
                                        </td>
                                        <td colspan="2">
                                            <p style="text-align: left;">
                                                <strong>
                                                    1.c Address
                                                </strong>
                                            </p>
                                        </td>
                                        <td colspan="3">
                                            <p style="text-align: left;">
                                                <strong>
                                                    1.d Fax Number/email address
                                                </strong>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="name" id="name" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="2">
                                            <input type="text" name="phone_number" id="phone_number" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="2">
                                            <input type="text" name="address" id="address" class="form-control w-100 h-100">
                                        </td>
                                        <td colspan="3">
                                            <input type="email" name="email" id="email" class="form-control w-100 h-100">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <table class="w-100 h-100">
                                                <tr>
                                                    <td>
                                                        <p style="text-align: left;">
                                                            <strong>
                                                                2. Health Care Professional
                                                            </strong>
                                                        </p>
                                                        <input type="radio" name="health_care_professional" value="YES"> Yes
                                                        <input type="radio" name="health_care_professional" value="NO"> No
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="text-align: left;">
                                                            <strong>
                                                                4. Country of Reporting event:
                                                            </strong>
                                                        </p>
                                                        <textarea name="reporting_event" id="reporting_event" class="form-control w-100 h-100" cols="90" rows="5"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td colspan="4">
                                            <p style="text-align: left; margin-top: -5%;">
                                                <strong>
                                                    3. Profession/Occupation or Health Authority:
                                                </strong>
                                            </p>
                                            <div style="text-align: left;">
                                                <input type="radio" name="occupation_health_authority" value="Doctor"> Doctor <br>
                                                <input type="radio" name="occupation_health_authority" value="Nurse"> Nurse <br>
                                                <input type="radio" name="occupation_health_authority" value="Pharmacist"> Pharmacist <br>
                                                <input type="radio" name="occupation_health_authority" value="Dentist"> Dentist <br>
                                                <input type="radio" name="occupation_health_authority" value="Patient"> Patient <br>
                                                <input type="radio" name="occupation_health_authority" value="Health Authority"> Health Authority <br>
                                                <input type="radio" name="occupation_health_authority" value="Other"> Other <br>
                                                <strong>Specify:</strong> <input type="occupation_health_authority_specify">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <p style="text-align: left;">
                                                5. As a <strong>MAH</strong>, we have an obligation to collect and report adverse events/safety information with our products to Health Authority to improve patient safety. <br>
                                                Are you willing for Ipsen safety team to contact you/your doctor for further details if required?
                                            </p>
                                            <input type="radio" name="mah" id="mah" value="YES"> Yes
                                            <input type="radio" name="mah" id="mah" value="NO"> No
                                        </td>
                                        <td colspan="4">
                                            <p style="text-align: left;">
                                                6. If the reporter is a patient, what is their <strong>doctor's name and address?</strong> (complete only if section 5. is ticked Yes)
                                            </p>
                                            <textarea name="if_patient" id="if_patient" class="form-control w-100 h-100" cols="90" rows="5"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">VIII) RESEARCHER’S DETAILS</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <p style="text-align: left;">
                                                Completed By: <br>
                                                Company Name and Address: <br>
                                                Email address: <br>
                                                Telephone No: <br>
                                                Fax No: <br>
                                                <strong>
                                                    Date of form Completed:
                                                </strong>
                                            </p>
                                        </td>
                                        <td colspan="6">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            Complete form in black ink and in English when reporting dates, spell out the first three letters of the month; Indicate estimated dates with an asterisk (*). <br>
                                            If dates are not available, please give estimates of exposure/lag time in the description of the event. <br>
                                            This form must be completed for each individual patient.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <button type="button" id="boton" onclick="btnSubmit()" class="btn_registrar">
                                                REGISTRAR
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                nuevaFila.innerHTML = `<td><input type="text" class="form-control w-100 h-100" name="sci[]" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="medicamento[]"" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="indicacion[]"></td>
                         <td><input type="text" class="form-control w-100 h-100" name="dosis[]"></td>
                         <td><input type="text" class="form-control w-100 h-100" name="unidad_medida[]"></td>
                         <td><input type="text" class="form-control w-100 h-100" name="via_administracion[]"></td>
                         <td><input type="text" class="form-control w-100 h-100" name="frecuencia_administracion[]" ></td>
                         <td><input type="text" class="form-control w-100 h-100" name="fecha_inicio[]"></td>
                         <td><input type="text" class="form-control w-100 h-100" name="fecha_fin[]"></td>
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
                nuevaFila.innerHTML = `<td colspan="9" style="text-align: left; font-weight: 700"><input type ="text" class="form-control w-100 h-100" name="diagnostico[]"></td>
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
                    fecha_inicio: document.getElementById('fecha_inicio').value,
                    fecha_fin: document.getElementById('fecha_fin').value,
                    titular_registro: document.getElementById('titular_registro').value,
                    nombre_comercial: document.getElementById('nombre_comercial').value,
                    registro_sanitario: document.getElementById('registro_sanitario').value,
                    lote: document.getElementById('lote').value,
                    fecha_ini_evento: document.getElementById('fecha_ini_evento').value,
                    evento_adverso: document.getElementById('evento_adverso').value,
                    descripcion_evento: document.getElementById('descripcion_evento').value,
                    desenlace_evento: document.getElementById('valor_desenlace_evento').value,
                    seriedad: document.getElementById('valor_seriedad').value,
                    fecha_muerte: document.getElementById('fecha_muerte').value,
                    pregunta1: document.getElementById('valor_pregunta1').value,
                    pregunta2: document.getElementById('valor_pregunta2').value,
                    pregunta3: document.getElementById('valor_pregunta3').value,
                    pregunta4: document.getElementById('valor_pregunta4').value,
                    pregunta5: document.getElementById('valor_pregunta5').value,
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

                let rows1 = [];

                const fila = document.querySelectorAll('#contenedor_1 tr');
                fila.forEach(fila => {
                    let row1 = {
                        diagnostico: fila.querySelector('input[name="diagnostico[]"]').value,
                    }
                    rows1.push(row1);
                });

                let rows = [];

                const filas = document.querySelectorAll('#contenedor tr');
                filas.forEach(fila => {
                    let row = {
                        sci: fila.querySelector('input[name="sci[]"]').value,
                        medicamento: fila.querySelector('input[name="medicamento[]"]').value,
                        indicacion: fila.querySelector('input[name="indicacion[]"]').value,
                        dosis: fila.querySelector('input[name="dosis[]"]').value,
                        unidad_medida: fila.querySelector('input[name="unidad_medida[]"]').value,
                        via_administracion: fila.querySelector('input[name="via_administracion[]"]').value,
                        frecuencia_administracion: fila.querySelector('input[name="frecuencia_administracion[]"]').value,
                        fecha_inicio: fila.querySelector('input[name="fecha_inicio[]"]').value,
                        fecha_fin: fila.querySelector('input[name="fecha_fin[]"]').value,
                    }
                    rows.push(row);
                });

                axios.post('../logica/insertar_datos_ea.php', {
                        rows1: rows1,
                        rows: rows,
                        date: date

                    }).then(function(response) {
                        var respuesta = response.data.split(',');
                        var titulo = respuesta[0];
                        var icono = respuesta[1];
                        var mensaje = respuesta[2];
                        Swal.fire({
                            title: titulo,
                            html: mensaje,
                            width: '20%',
                            icon: icono,
                            showCancelButton: false,
                            focusConfirm: false,
                            allowOutsideClick: false,
                            confirmButtonText: "Aceptar"
                        }).then((result) => {
                            if (result.isConfirmed && icono === 'success') {
                                Bloquear()
                                window.close();
                                window.location.reload();
                                btnConvertPdf()
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
                    codigo_paciente: document.getElementById('codigo_paciente').value,
                }

                axios.post('./pdf.php', date)
                    .then(function(response) {
                        Swal.fire({
                                title: 'success',
                                html: 'Por favor espere unos minutos, se esta creadndo el pdf para el envio del correo',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    SendMailer()
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

            function Bloquear() {
                document.getElementById("boton").disabled = true;
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
            background-color: #BFBFBF;
            font-family: Tahoma, Geneva, sans-serif;
            color: #000;
        }

        .titulos2 {
            background-color: #4BACC6;
            font-family: Tahoma, Geneva, sans-serif;
            color: #000;
        }

        .titulos3 {
            background-color: #99CCFF;
            font-family: Tahoma, Geneva, sans-serif;
            color: #000;
        }

        .titulo5 {
            background-color: #FFF;
            font-family: Tahoma, Geneva, sans-serif;
            color: #0B4055;
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

        /* .btn_registrar {
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
        } */

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