<?php
include "../logica/session.php";
include "../datos/conex.php";
include_once "../dompdf/vendor/autoload.php";

$data = json_decode(file_get_contents('php://input'));

use Dompdf\Dompdf;

$dompdf = new Dompdf();
ob_start();

function formatDate($dateString)
{
    // Array de nombres de meses en español
    $meses = array(
        1 => "enero",
        2 => "febrero",
        3 => "marzo",
        4 => "abril",
        5 => "mayo",
        6 => "junio",
        7 => "julio",
        8 => "agosto",
        9 => "septiembre",
        10 => "octubre",
        11 => "noviembre",
        12 => "diciembre"
    );

    $date = new DateTime($dateString);
    $numeroMes = $date->format('n'); // Obtener número del mes (1 a 12)
    $nombreMes = $meses[$numeroMes]; // Obtener nombre del mes en español

    return $date->format('d') . '-' . $nombreMes . '-' . $date->format('Y');
}

$consulta = mysqli_query($conex, "SELECT * FROM ipsen_evento_adverso WHERE ID_PACIENTE_FK ='$data->codigo_paciente' ORDER BY ID_EVENTO_ADVERSO DESC LIMIT 1");
echo mysqli_error($conex);
while ($fila1 = mysqli_fetch_array($consulta)) {
    $ID_EVENTO_ADVERSO = $fila1['ID_EVENTO_ADVERSO'];
    $SOURCE_TYPE = $fila1['SOURCE_TYPE'];
    $DATE_OF_NOTIFICATION = $fila1['DATE_OF_NOTIFICATION'];
    $PATIENT_INITIALS = $fila1['PATIENT_INITIALS'];
    $DATE_OF_BIRTH = $fila1['DATE_OF_BIRTH'];
    $AGE = $fila1['AGE'];
    $GENDER = $fila1['GENDER'];
    $WEIGHT = $fila1['WEIGHT'];
    $HEIGHT = $fila1['HEIGHT'];
    $TRADE_NAME = $fila1['TRADE_NAME'];
    $EXPIRY_DATE = $fila1['EXPIRY_DATE'];
    $SAMPLE_AVAILABLE = $fila1['SAMPLE_AVAILABLE'];
    $DOSE = $fila1['DOSE'];
    $FREQUENCY = $fila1['FREQUENCY'];
    $ROUTE_OF_ADMINISTRATION = $fila1['ROUTE_OF_ADMINISTRATION'];
    $DIAGNOSIS = $fila1['DIAGNOSIS'];
    $TREATMENT_START_DATE = $fila1['TREATMENT_START_DATE'];
    $TREATMENT_END_DATE = $fila1['TREATMENT_END_DATE'];
    $ANY_OTHER_INFORMATION = $fila1['ANY_OTHER_INFORMATION'];
    $ONSET_DATE = $fila1['ONSET_DATE'];
    $EVENT_STOP_DATE = $fila1['EVENT_STOP_DATE'];
    $DURATION = $fila1['DURATION'];
    $EVENT_ABATED = $fila1['EVENT_ABATED'];
    $EVENT_TERM = $fila1['EVENT_TERM'];
    $REAPPEARED = $fila1['REAPPEARED'];
    $PREVIOUSLY = $fila1['PREVIOUSLY'];
    $SERIOUSNESS = $fila1['SERIOUSNESS'];
    $DATE_OF_DEATH = $fila1['DATE_OF_DEATH'];
    $AUTOPSY = $fila1['AUTOPSY'];
    $CAUSE_OF_DEATH = $fila1['CAUSE_OF_DEATH'];
    $TREATMENT_FOR_AE = $fila1['TREATMENT_FOR_AE'];
    $TREATMENT_DETAILS = $fila1['TREATMENT_DETAILS'];
    $OUTCOME = $fila1['OUTCOME'];
    $LABORATORY_DATA = $fila1['LABORATORY_DATA'];
    $MEDICAL_HISTORY = $fila1['MEDICAL_HISTORY'];
    $REPORTE_CAUSALITY = $fila1['REPORTE_CAUSALITY'];
    $PATIENT_PREGNANT = $fila1['PATIENT_PREGNANT'];
    $PATIENT_PREGNANT_YES = $fila1['PATIENT_PREGNANT_YES'];
    $SPECIAL_SITUATIONS = $fila1['SPECIAL_SITUATIONS'];
    $DEFECT_ISSUE = $fila1['DEFECT_ISSUE'];
    $REPORTER_NAME = $fila1['REPORTER_NAME'];
    $PHONE_NUMBER = $fila1['PHONE_NUMBER'];
    $ADDRESS = $fila1['ADDRESS'];
    $REPORTER_EMAIL = $fila1['REPORTER_EMAIL'];
    $PROFESSIONAL = $fila1['PROFESSIONAL'];
    $OCCUPATION = $fila1['OCCUPATION'];
    $COUNTRY = $fila1['COUNTRY'];
    $MAH = $fila1['MAH'];
    $DOCTORS = $fila1['DOCTORS'];
    $COMPLETED_BY = $fila1['COMPLETED_BY'];
    $EMAIL_USER = $fila1['EMAIL_USER'];
    $ID_PACIENTE_FK = $fila1['ID_PACIENTE_FK'];
}

$formatted_birth_date = formatDate($DATE_OF_BIRTH);
$formatted_onset_date = formatDate($ONSET_DATE);
$formatted_death_date = formatDate($DATE_OF_DEATH);
$formatted_of_notification_date = formatDate($DATE_OF_NOTIFICATION);
$formatted_treatment_start_date = formatDate($TREATMENT_START_DATE);
$formatted_treatment_end_date = formatDate($TREATMENT_END_DATE);
$formatted_event_stop_date = formatDate($EVENT_STOP_DATE);
$formatted_start_date = formatDate($DATE_START);
$formatted_stop_date = formatDate($DATE_STOP);
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
    <table class="table table-bordered table-sm" cellspacing="0" cellpadding="0" style="width: 98%;">
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
                                <td colspan="9" class="titulos2" width="40%">
                                    <div style="text-align: left;">
                                        <img src="../dompdf/vendor/dompdf/dompdf/lib/res/logo_evento.jpg">
                                    </div>
                                    <span style="margin-top: 10%;">
                                        <strong>Adverse Events and Special Situations Reporting Form for PDCS</strong> <br>
                                        Please complete as many details as possible and <strong>forward it to IPSEN contact immediately/within 24 hours/agreed timelines</strong> of becoming aware AE/PC/Safety Information
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered table-sm" cellspacing="0" cellpadding="0" style="width: 98%;">
        <tbody>
            <tr>
                <td colspan="9">
                    <p style="text-align: left;">
                        <strong>
                            SOURCE TYPE:
                        </strong>
                    </p>
                    <?php
                    if ($SOURCE_TYPE == 'Early Access' || $SOURCE_TYPE == 'Patient Support PSP-L-0017' || $SOURCE_TYPE == 'Market Research') {
                    ?>
                        <p style="text-align: left;">
                            <?php echo $SOURCE_TYPE ?>
                        </p>
                    <?php
                    } else {
                    ?>
                        <p style="text-align: left;">
                            Other <br>
                            <strong>Specify:</strong> <?php echo $SOURCE_TYPE ?>
                        </p>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div style="text-align: left;">
                        <strong>Date of First Notification (Day 0)</strong> <?php echo $formatted_of_notification_date ?>
                    </div>
                    <p style="text-align: left;">(date first aware of the adverse event/safety information by a company employee/contractor)</p>
                </td>
                <td colspan="5">
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
                <td colspan="1" style="vertical-align: top;">
                    <p style="text-align: left;">1.Patient Initials/Number
                        <br> <br>
                        <?php echo $PATIENT_INITIALS ?>
                    </p>

                </td>
                <td colspan="3">
                    <table style="width: 100%;">
                        <tr>
                            <td colspan="2" style="border-radius: 0,5px; border: dotted;">
                                <p style="text-align: left;">
                                    2. Date of Birth
                                    <br> <br>
                                    <?php echo $formatted_birth_date ?>
                                </p>
                            </td>
                            <td colspan="1" style="border-radius: 0,5px; border: dotted;">
                                <p style="text-align: left;">
                                    Age at time of event
                                    <br> <br>
                                    <?php echo $AGE ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: none;">
                                <p style="text-align: left;">
                                    Age Group* (Specify: Neonate, Infant, Child, Adolescent, <br> Adult, Elderly): ADULTO
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>

                <?php if ($GENDER == 'Female') { ?>
                    <td colspan="1" style="vertical-align: top;">
                        <p style="text-align: left;">3. Gender
                            <br> <br>
                            <span>Female</span>
                        </p>
                    </td>
                <?php } else if ($GENDER == 'Male') { ?>
                    <td colspan="1" style="vertical-align: top;">
                        <p style="text-align: left;">3. Gender
                            <br> <br>
                            <span>Male</span>
                        </p>
                    </td>
                <?php } ?>

                <td colspan="2" style="vertical-align: top;">
                    <p style="text-align: left;">4. Weight
                        <br> <br>
                        <?php echo $WEIGHT ?> kg/lbs
                    </p>
                </td>
                <td colspan="2" style="vertical-align: top;">
                    <p style="text-align: left;">5. Height
                        <br> <br>
                        <?php echo $HEIGHT ?> cm/inch
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <p style="font-family: 'Times New Roman', Times, serif; text-align: left; font-style:oblique;">* Neonate = from day of birth plus 27 days, Infant = from 1 month (28 days) to 23 months, Child = from 2 years to 11 years, Adolescent = from 12 years to less than 18 years, <br> Adult = from 18 years to 64 years, Elderly = from 65 years)</p>
                </td>
            </tr>
            <tr>
                <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">II) SUSPECTED MEDICINAL PRODUCT</td>
            </tr>
            <tr>
                <td colspan="3">
                    <p style="text-align: left;">
                        1.Trade Name (INN/Generic Name)
                        <br> <br>
                        <?php echo $TRADE_NAME ?>
                    </p>

                </td>
                <td colspan="3">
                    <p style="text-align: left;">
                        2. Batch No. and Expiry Date
                        <br> <br>
                        <?php echo $EXPIRY_DATE ?>
                    </p>
                </td>
                <td colspan="3">
                    <p style="text-align: left;">
                        3. Sample Available
                        <br> <br>
                        <?php echo $SAMPLE_AVAILABLE ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p style="text-align: left;">
                        4. Dose (specify units)
                        <br> <br>
                        <?php echo $DOSE ?>
                    </p>
                </td>
                <td colspan="3">
                    <p style="text-align: left;">
                        5. Frequency
                        <br> <br>
                        <?php echo $FREQUENCY ?>
                    </p>
                </td>
                <td colspan="3">
                    <p style="text-align: left;">
                        6. Route of administration
                        <br> <br>
                        <?php echo $ROUTE_OF_ADMINISTRATION ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p style="text-align: left;">
                        7. Diagnosis/Indication
                        <br> <br>
                        <?php echo $DIAGNOSIS ?>
                    </p>
                </td>
                <td colspan="3">
                    <p style="text-align: left;">
                        8. Treatment Start date
                        <br> <br>
                        <?php echo $formatted_treatment_start_date ?>
                    </p>
                </td>
                <td colspan="3">
                    <p style="text-align: left;">
                        9. Treatment End date (or mention continuing)
                        <br> <br>
                        <?php echo $formatted_treatment_end_date ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <p style="text-align: left;"><strong>10. Any other information:</strong> <?php echo $ANY_OTHER_INFORMATION ?> </p>
                </td>
            </tr>
            <tr>
                <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">III) MAIN EVENT</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered table-sm" cellspacing="0" cellpadding="0" style="width: 98%;">
        <tbody>
            <tr>
                <td colspan="1" style="vertical-align: top; width:25%;">
                    <p style="text-align: left;">
                        1.a <strong>Onset</strong> Date
                        <br> <br>
                        <?php echo $formatted_onset_date ?>
                    </p>
                </td>
                <td colspan="1" style="vertical-align: top; width:25%;">
                    <p style="text-align: left;">
                        1.b Event <strong>Stop Date (if applicable) or Mention Ongoing</strong>
                        <br> <br>
                        <?php echo $formatted_event_stop_date ?>
                    </p>
                </td>
                <td colspan="1" style="vertical-align: top; width:25%;">
                    <p style="text-align: left;">
                        <strong>1.c Duration</strong>
                        <br> <br>
                        <?php echo $DURATION ?>
                    </p>
                </td>
                <td colspan="6" style="vertical-align: top; width:25%;">
                    <p style="text-align: left;">
                        1.d Event <strong>abated</strong> after use stopped
                        <br> <br>
                        <?php echo $EVENT_ABATED ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="vertical-align: top; width: 60%;">
                    <p style="text-align: left;">
                        <strong>1.h Event term</strong> <br>
                        (full description of the event including body site and severity)
                    </p>
                    <div style="text-align: left;">
                        <?php echo $EVENT_TERM ?>
                    </div>
                </td>
                <td colspan="7">
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                            <td>
                                <p style="text-align: left;">1.e Event <strong>reappeared</strong> after reintroduction
                                    <br> <br>
                                    <?php echo $REAPPEARED ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="text-align: left;"> 1.f Has this drug <strong>previously</strong> been used
                                    <br> <br>
                                    <?php echo $PREVIOUSLY ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="text-align: left;">
                                    <strong>
                                        1.g Seriousness of the event per Reporter
                                    </strong>
                                </p>
                                <?php
                                if ($SERIOUSNESS == 'Non serious event') {
                                ?>
                                    <div style="text-align: left;">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <!-- <span style="color: #ff0000;"> Non serious event </span> -->
                                                <input type="radio" checked> Non serious event
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <input type="radio"> Death - Date of death:
                                            </div>
                                        </div>
                                        <br>
                                        <style>
                                            .rows {
                                                display: flex;
                                                justify-content: center;
                                            }
                                        </style>
                                        <div style="text-align: center;">
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -13%;">
                                                    <span>Autopsy performed</span>
                                                    <?php
                                                    if ($AUTOPSY == 'YES') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else if ($AUTOPSY == 'NO') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -14%;">
                                                    <span>Cause of Death: <?php echo $formatted_death_date ?></span>
                                                </div>
                                                <div class="rows" style="text-align: left; width: 50%; margin-left: 1%;">

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="radio"> Life threatening <br> <br>
                                        <input type="radio"> Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                        <input type="radio"> Persistent or significant disability/Incapacity <br> <br>
                                        <input type="radio"> Congenital anomaly/birth defect <br> <br>
                                        <input type="radio"> Other Serious (Medically important event) <br> <br>
                                        <input type="radio"> “Require intervention” (only for devices)
                                    </div>
                                <?php
                                } else if ($SERIOUSNESS == 'Death - Date of death') {
                                ?>
                                    <div style="text-align: left;">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <!-- <span style="color: #ff0000;"> Non serious event </span> -->
                                                <input type="radio"> Non serious event
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <input type="radio" checked> Death - Date of death:
                                            </div>
                                        </div>
                                        <br>
                                        <style>
                                            .rows {
                                                display: flex;
                                                justify-content: center;
                                            }
                                        </style>
                                        <div style="text-align: center;">
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -13%;">
                                                    <span>Autopsy performed</span>
                                                    <?php
                                                    if ($AUTOPSY == 'YES') {
                                                    ?>
                                                        <input type="radio" checked> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else if ($AUTOPSY == 'NO') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio" checked> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -14%;">
                                                    <span>Cause of Death:</span>
                                                    <?php echo $CAUSE_OF_DEATH ?>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="radio"> Life threatening <br> <br>
                                        <input type="radio"> Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                        <input type="radio"> Persistent or significant disability/Incapacity <br> <br>
                                        <input type="radio"> Congenital anomaly/birth defect <br> <br>
                                        <input type="radio"> Other Serious (Medically important event) <br> <br>
                                        <input type="radio"> “Require intervention” (only for devices)
                                    </div>
                                <?php
                                } else if ($SERIOUSNESS == 'Life threatening') {
                                ?>
                                    <div style="text-align: left;">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <!-- <span style="color: #ff0000;"> Non serious event </span> -->
                                                <input type="radio"> Non serious event
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <input type="radio"> Death - Date of death:
                                            </div>
                                        </div>
                                        <br>
                                        <style>
                                            .rows {
                                                display: flex;
                                                justify-content: center;
                                            }
                                        </style>
                                        <div style="text-align: center;">
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -13%;">
                                                    <span>Autopsy performed</span>
                                                    <?php
                                                    if ($AUTOPSY == 'YES') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else if ($AUTOPSY == 'NO') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -14%;">
                                                    <span>Cause of Death:</span>
                                                </div>
                                                <div class="rows" style="text-align: left; width: 50%; margin-left: 1%;">

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="radio" checked> Life threatening <br> <br>
                                        <input type="radio"> Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                        <input type="radio"> Persistent or significant disability/Incapacity <br> <br>
                                        <input type="radio"> Congenital anomaly/birth defect <br> <br>
                                        <input type="radio"> Other Serious (Medically important event) <br> <br>
                                        <input type="radio"> “Require intervention” (only for devices)
                                    </div>
                                <?php
                                } else if ($SERIOUSNESS == 'Inpatient hospitalisation or prolongation of existing hospitalisation') {
                                ?>
                                    <div style="text-align: left;">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <!-- <span style="color: #ff0000;"> Non serious event </span> -->
                                                <input type="radio"> Non serious event
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <input type="radio"> Death - Date of death:
                                            </div>
                                        </div>
                                        <br>
                                        <style>
                                            .rows {
                                                display: flex;
                                                justify-content: center;
                                            }
                                        </style>
                                        <div style="text-align: center;">
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -13%;">
                                                    <span>Autopsy performed</span>
                                                    <?php
                                                    if ($AUTOPSY == 'YES') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else if ($AUTOPSY == 'NO') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -14%;">
                                                    <span>Cause of Death:</span>
                                                </div>
                                                <div class="rows" style="text-align: left; width: 50%; margin-left: 1%;">

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="radio"> Life threatening <br> <br>
                                        <input type="radio" checked> Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                        <input type="radio"> Persistent or significant disability/Incapacity <br> <br>
                                        <input type="radio"> Congenital anomaly/birth defect <br> <br>
                                        <input type="radio"> Other Serious (Medically important event) <br> <br>
                                        <input type="radio"> “Require intervention” (only for devices)
                                    </div>
                                <?php
                                } else if ($SERIOUSNESS == 'Persistent or significant disability/Incapacity') {
                                ?>
                                    <div style="text-align: left;">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <!-- <span style="color: #ff0000;"> Non serious event </span> -->
                                                <input type="radio"> Non serious event
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <input type="radio"> Death - Date of death:
                                            </div>
                                        </div>
                                        <br>
                                        <style>
                                            .rows {
                                                display: flex;
                                                justify-content: center;
                                            }
                                        </style>
                                        <div style="text-align: center;">
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -13%;">
                                                    <span>Autopsy performed</span>
                                                    <?php
                                                    if ($AUTOPSY == 'YES') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else if ($AUTOPSY == 'NO') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -14%;">
                                                    <span>Cause of Death:</span>
                                                </div>
                                                <div class="rows" style="text-align: left; width: 50%; margin-left: 1%;">

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="radio"> Life threatening <br> <br>
                                        <input type="radio"> Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                        <input type="radio" checked> Persistent or significant disability/Incapacity <br> <br>
                                        <input type="radio"> Congenital anomaly/birth defect <br> <br>
                                        <input type="radio"> Other Serious (Medically important event) <br> <br>
                                        <input type="radio"> “Require intervention” (only for devices)
                                    </div>
                                <?php
                                } else if ($SERIOUSNESS == 'Congenital anomaly/birth defect') {
                                ?>
                                    <div style="text-align: left;">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <!-- <span style="color: #ff0000;"> Non serious event </span> -->
                                                <input type="radio"> Non serious event
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <input type="radio"> Death - Date of death:
                                            </div>
                                        </div>
                                        <br>
                                        <style>
                                            .rows {
                                                display: flex;
                                                justify-content: center;
                                            }
                                        </style>
                                        <div style="text-align: center;">
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -13%;">
                                                    <span>Autopsy performed</span>
                                                    <?php
                                                    if ($AUTOPSY == 'YES') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else if ($AUTOPSY == 'NO') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -14%;">
                                                    <span>Cause of Death:</span>
                                                </div>
                                                <div class="rows" style="text-align: left; width: 50%; margin-left: 1%;">

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="radio"> Life threatening <br> <br>
                                        <input type="radio"> Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                        <input type="radio"> Persistent or significant disability/Incapacity <br> <br>
                                        <input type="radio" checked> Congenital anomaly/birth defect <br> <br>
                                        <input type="radio"> Other Serious (Medically important event) <br> <br>
                                        <input type="radio"> “Require intervention” (only for devices)
                                    </div>
                                <?php
                                } else if ($SERIOUSNESS == 'Other Serious (Medically important event)') {
                                ?>
                                    <div style="text-align: left;">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <!-- <span style="color: #ff0000;"> Non serious event </span> -->
                                                <input type="radio"> Non serious event
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <input type="radio"> Death - Date of death:
                                            </div>
                                        </div>
                                        <br>
                                        <style>
                                            .rows {
                                                display: flex;
                                                justify-content: center;
                                            }
                                        </style>
                                        <div style="text-align: center;">
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -13%;">
                                                    <span>Autopsy performed</span>
                                                    <?php
                                                    if ($AUTOPSY == 'YES') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else if ($AUTOPSY == 'NO') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -14%;">
                                                    <span>Cause of Death:</span>
                                                </div>
                                                <div class="rows" style="text-align: left; width: 50%; margin-left: 1%;">

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="radio"> Life threatening <br> <br>
                                        <input type="radio"> Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                        <input type="radio"> Persistent or significant disability/Incapacity <br> <br>
                                        <input type="radio"> Congenital anomaly/birth defect <br> <br>
                                        <input type="radio" checked> Other Serious (Medically important event) <br> <br>
                                        <input type="radio"> “Require intervention” (only for devices)
                                    </div>
                                <?php
                                } else if ($SERIOUSNESS == 'Require intervention (only for devices)') {
                                ?>
                                    <div style="text-align: left;">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <!-- <span style="color: #ff0000;"> Non serious event </span> -->
                                                <input type="radio"> Non serious event
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-left">
                                                <input type="radio"> Death - Date of death:
                                            </div>
                                        </div>
                                        <br>
                                        <style>
                                            .rows {
                                                display: flex;
                                                justify-content: center;
                                            }
                                        </style>
                                        <div style="text-align: center;">
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -13%;">
                                                    <span>Autopsy performed</span>
                                                    <?php
                                                    if ($AUTOPSY == 'YES') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else if ($AUTOPSY == 'NO') {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio"> Yes
                                                        <input type="radio"> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="rows">
                                                <div class="rows" style="margin-left: -14%;">
                                                    <span>Cause of Death:</span>
                                                </div>
                                                <div class="rows" style="text-align: left; width: 50%; margin-left: 1%;">

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="radio"> Life threatening <br> <br>
                                        <input type="radio"> Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                        <input type="radio"> Persistent or significant disability/Incapacity <br> <br>
                                        <input type="radio"> Congenital anomaly/birth defect <br> <br>
                                        <input type="radio"> Other Serious (Medically important event) <br> <br>
                                        <input type="radio" checked> “Require intervention” (only for devices)
                                    </div>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="vertical-align: top; width: 60%;">
                    <div style="text-align: left;">
                        <strong style="text-align: left;">1.i Treatment for AE</strong> <?php echo $TREATMENT_FOR_AE ?>
                    </div>
                    <br>
                    <p style="text-align: left;">
                        <strong> Treatment Details: </strong>
                        <?php echo $TREATMENT_DETAILS ?>
                    </p>
                </td>
                <td colspan="6" style="vertical-align: top;">
                    <p style="text-align: left;">
                        <strong>
                            1.h Outcome
                        </strong>
                    </p>
                    <div class="row">
                        <div class="col d-flex justify-content-left" style="text-align: left;">
                            <?php echo $OUTCOME ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <p style="text-align: left;">
                        <strong>
                            2. Relevant tests/Laboratory data, including dates (please attach if possible)
                        </strong>
                    </p>
                    <p style="text-align: left;"> <?php echo $LABORATORY_DATA ?> </p>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <p style="text-align: left;">
                        <strong>
                            3. Medical history including pre-existing conditions
                        </strong>
                    </p>
                    <p style="text-align: left;"> <?php echo $MEDICAL_HISTORY ?> </p>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <p style="text-align: left;">
                        <strong>
                            4. Reporter’s Causality
                        </strong>
                        <br>
                        Does the Reporter consider that the event was possibly related to the drug? <?php echo $REPORTE_CAUSALITY ?>
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
                    <?php
                    if ($PATIENT_PREGNANT != 'Yes') {
                    ?>
                        <p style="text-align: left;" id="patient_pregnant_yes_id">
                            <?php echo $PATIENT_PREGNANT ?> <br>
                            <strong>If yes, gestation period:</strong> <?php echo $PATIENT_PREGNANT_YES ?> <strong>weeks</strong>
                        </p>
                    <?php
                    } else {
                    ?>
                        <div class="col d-flex justify-content-left">
                            <?php echo $PATIENT_PREGNANT ?>
                        </div>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered table-sm" cellspacing="0" cellpadding="0" style="width: 98%;">
        <tbody>
            <tr>
                <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">IV) SPECIAL SITUATIONS</td>
            </tr>
            <tr>
                <td colspan="9">
                    <?php
                    if ($SPECIAL_SITUATIONS == 'Pregnancy (maternal exposure or paternal exposure (including potential alteration of spermatozoids))' || $SPECIAL_SITUATIONS == 'Breastfeeding' || $SPECIAL_SITUATIONS == 'Overdose' || $SPECIAL_SITUATIONS == 'Misuse' || $SPECIAL_SITUATIONS == 'Abuse' || $SPECIAL_SITUATIONS == 'Medication Error' || $SPECIAL_SITUATIONS == 'Lack of Efficacy' || $SPECIAL_SITUATIONS == 'Occupational exposure' || $SPECIAL_SITUATIONS == 'Drug interaction' || $SPECIAL_SITUATIONS == 'Off-label Use' || $SPECIAL_SITUATIONS == 'Suspected transmission of infectious agent' || $SPECIAL_SITUATIONS == 'Unexpected beneficial event') {
                    ?>
                        <p style="text-align: left;" id="special_situations_specify_id">
                            <?php echo $SPECIAL_SITUATIONS ?>
                        </p>
                    <?php
                    } else {
                    ?>
                        <p style="text-align: left;" id="special_situations_specify_id">
                            Other <br>
                            <strong>Specify:</strong>
                            <?php echo $SPECIAL_SITUATIONS ?>
                        </p>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">V) QUALITY DEFECT ISSUE / SUSPECTED FALSIFIED/COUNTERFEIT MEDICINAL PRODUCT</td>
            </tr>
            <tr>
                <td colspan="9">
                    <div class="row">
                        <div class="col d-flex justify-content-left">
                            <P style="text-align: left;"> <?php echo $DEFECT_ISSUE ?> </P>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">VI) CO-SUSPECT (S) & CONCOMITANT (C) DRUGS</td>
            </tr>
            <tr>
                <td>
                    <p style="text-align: left;">
                        <strong>
                            Drug
                            <br>
                            (including dosage form)
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
                    <strong>
                        Date of
                        <br>
                        administration Start
                    </strong>
                </td>
                <td>
                    <strong>
                        Date of
                        <br>
                        administration Stop
                    </strong>
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
            <?php
            $consulta_medicamento = mysqli_query($conex, "SELECT * FROM ipsen_informacion_tratamiento_ea WHERE EVENTO_ADVERSO_ID ='" . $ID_EVENTO_ADVERSO . "'");
            echo mysqli_error($conex);
            while ($fila = mysqli_fetch_array($consulta_medicamento)) {
                $DRUG = $fila['DRUG'];
                $ROUTE = $fila['ROUTE'];
                $DAILY_DOSE = $fila['DAILY_DOSE'];
                $DURATION = $fila['DURATION'];
                $DATE_START = $fila['DATE_START'];
                $DATE_STOP = $fila['DATE_STOP'];
                $INDICATION = $fila['INDICATION'];
                $S_OR_C = $fila['S_OR_C'];
                $COMPANY_DRUG = $fila['COMPANY_DRUG'];
            ?>
                <tr>
                    <td>
                        <p style="text-align: left;"> <?php echo $DRUG ?> </p>
                    </td>
                    <td>
                        <p style="text-align: left;"> <?php echo $ROUTE ?> </p>
                    </td>
                    <td>
                        <p style="text-align: left;"> <?php echo $DAILY_DOSE ?> </p>
                    </td>
                    <td>
                        <p style="text-align: left;"> <?php echo $DURATION ?> </p>
                    </td>
                    <td>
                        <p style="text-align: left;"> <?php echo $formatted_start_date ?> </p>
                    </td>
                    <td>
                        <p style="text-align: left;"> <?php echo $formatted_stop_date ?> </p>
                    </td>
                    <td>
                        <p style="text-align: left;"> <?php echo $INDICATION ?> </p>
                    </td>
                    <td>
                        <p style="text-align: left;"> <?php echo $S_OR_C ?> </p>
                    </td>
                    <td>
                        <p style="text-align: left;"> <?php echo $COMPANY_DRUG ?> </p>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">VII) REPORTER</td>
            </tr>
            <tr>
                <td colspan="1">
                    <p style="text-align: left;">
                        <strong>
                            1.a Name
                        </strong>
                        <br> <br>
                        <?php echo $REPORTER_NAME ?>
                    </p>
                </td>
                <td colspan="2">
                    <p style="text-align: left;">
                        <strong>
                            1.b Phone number
                        </strong>
                        <br> <br>
                        <?php echo $PHONE_NUMBER ?>
                    </p>
                </td>
                <td colspan="2">
                    <p style="text-align: left;">
                        <strong>
                            1.c Address
                        </strong>
                        <br> <br>
                        <?php echo $ADDRESS ?>
                    </p>
                </td>
                <td colspan="4">
                    <p style="text-align: left;">
                        <strong>
                            1.d Fax Number/email address
                        </strong>
                        <br> <br>
                        <?php echo $REPORTER_EMAIL ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table class="w-100 h-100">
                        <tr>
                            <td style="border: none; vertical-align: top;">
                                <div style="text-align: left;">
                                    <strong> 2. Health Care Professional </strong> <?php echo $PROFESSIONAL ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none; vertical-align: top;">
                                <p style="text-align: left;">
                                    <strong> 4. Country of Reporting event: </strong> COLOMBIA
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="6" style="vertical-align: top;">
                    <p style="text-align: left;">
                        <strong>
                            3. Profession/Occupation or Health Authority:
                        </strong>
                    </p>
                    <?php
                    if ($OCCUPATION != 'Doctor' && $OCCUPATION != 'Nurse' && $OCCUPATION != 'Pharmacist' && $OCCUPATION != 'Dentist' && $OCCUPATION != 'Patient' && $OCCUPATION != 'Health Authority') {
                    ?>
                        <div style="text-align:left;">
                            Other <br>
                            <strong>
                                Specify:
                            </strong>
                            <?php echo $OCCUPATION ?>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div style="text-align:left;">
                            <?php echo $OCCUPATION ?>
                        </div>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="vertical-align: top;">
                    <p style="text-align: left;">
                        5. As a <strong>MAH</strong>, we have an obligation to collect and report adverse events/safety information with our products to Health Authority to improve patient safety. <br>
                        Are you willing for Ipsen safety team to contact you/your doctor for further details if required?
                        <br> <br>
                        <?php echo $MAH ?>
                    </p>
                </td>
                <td colspan="6" style="vertical-align: top; width: 55%;">
                    <p style="text-align: left;">
                        6. If the reporter is a patient, what is their <strong>doctor's name and address?</strong> (complete only if section 5. is ticked Yes)
                        <br> <br>
                        <?php echo $DOCTORS ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">VIII) RESEARCHER’S DETAILS</td>
            </tr>
            <tr>
                <td colspan="1">
                    <p style="text-align: left;">
                        Completed By: <br> <br>
                        Company Name and Address: <br> <br>
                        Email address: <br>
                        Telephone No: <br>
                        Fax No: <br> <br>
                        <strong>
                            Date of form Completed:
                        </strong>
                    </p>
                </td>
                <td colspan="8">
                    <p style="text-align: left;">
                        <strong>
                            <?php echo $COMPLETED_BY ?>
                        </strong> <br> <br>
                        <strong>
                            PEOPLE MARKETING
                        </strong> <br> <br>
                        <strong style="text-decoration: underline; color: blue;">
                            <?php echo $EMAIL_USER ?>
                        </strong>
                        <br>
                        <br>
                        <br>
                        <br>
                        <strong>
                            <?php echo $formatted_of_notification_date ?>
                        </strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <p style="font-family: 'Times New Roman', Times, serif; text-align: center; font-style:oblique;">
                        Complete form in black ink and in English when reporting dates, spell out the first three letters of the month; Indicate estimated dates with an asterisk (*). <br>
                        If dates are not available, please give estimates of exposure/lag time in the description of the event. <br>
                        This form must be completed for each individual patient.
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</body>
<style>
    @page {
        margin-top: 15px;
        margin-left: 1px;
        margin-right: 1px;
    }

    hr {
        width: 100%;
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

</html>
<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);
$customPaper = array(0, 0, 999, 999);
$dompdf->setPaper($customPaper);
$dompdf->render();
$output = $dompdf->output();
$CARPETA = "../EVENTO_ADVERSO/$ID_EVENTO_ADVERSO";
if (!is_dir($CARPETA)) {
    mkdir("../EVENTO_ADVERSO/$ID_EVENTO_ADVERSO", 0777);
    file_put_contents('' . $CARPETA . '/Evento_Adverso_' . $ID_PACIENTE_FK . '.pdf', $output);
}
