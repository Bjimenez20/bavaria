<?php
include "../logica/session.php";
include "../datos/conex.php";
include_once "../dompdf/vendor/autoload.php";

$data = json_decode(file_get_contents('php://input'));

use Dompdf\Dompdf;

$dompdf = new Dompdf();
ob_start();

$consulta = mysqli_query($conex, "SELECT * FROM ipsen_evento_adverso WHERE ID_PACIENTE_FK ='$data->codigo_paciente' ORDER BY ID_EVENTO_ADVERSO DESC LIMIT 1");
echo mysqli_error($conex);
while ($fila1 = mysqli_fetch_array($consulta)) {
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
    $ID_PACIENTE_FK = $fila1['ID_PACIENTE_FK'];
}
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
</head>

<body style="padding: 0; margin: 0;">
    <table class="table table-bordered table-sm" cellspacing="0" cellpadding="0" style="width: 98%;">
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
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
                            <?php
                            if ($SOURCE_TYPE != 'Early Access' || $SOURCE_TYPE != 'Patient Support PSP-L-0017' || $SOURCE_TYPE != 'Market Research') {
                            ?>
                                <p style="text-align: left;">
                                    Other <br>
                                    <strong>Specify:</strong> <?php echo $SOURCE_TYPE ?>
                                </p>
                            <?php
                            } else {
                            ?>
                                <p style="text-align: left;"> <?php echo $SOURCE_TYPE ?> </p>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div style="text-align: left;">
                                <strong>Date of First Notification (Day 0)</strong> <?php echo $DATE_OF_NOTIFICATION ?>
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
                            <p style="text-align: left; margin-top: -40%;">1.Patient Initials/Number</p>
                            <?php echo $PATIENT_INITIALS ?>
                        </td>
                        <td colspan="3">
                            <table style="width: 100%;">
                                <tr>
                                    <td colspan="2" style="border-radius: 0,5px; border: dotted;">
                                        <p style="text-align: left;">
                                            2. Date of Birth
                                        </p>
                                        <?php echo $DATE_OF_BIRTH ?>
                                    </td>
                                    <td colspan="1" style="border-radius: 0,5px; border: dotted;">
                                        <p style="text-align: left;">
                                            Age at time of event
                                        </p>
                                        <?php echo $AGE ?>
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
                            <td colspan="1">
                                <p style="text-align: left; margin-top: -22%;">3. Gender </p>
                                <span>Female</span>
                            </td>
                        <?php } else if ($GENDER == 'Male') { ?>
                            <td colspan="1">
                                <p style="text-align: left; margin-top: -22%;">3. Gender </p>
                                <span>Male</span>
                            </td>
                        <?php } ?>

                        <td colspan="2">
                            <p style="text-align: left; margin-top: -23%;">4. Weight</p>
                            <?php echo $WEIGHT ?> kg/lbs
                        </td>
                        <td colspan="2">
                            <p style="text-align: left; margin-top: -18%;">5. Height</p>
                            <?php echo $HEIGHT ?> cm/inch
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
                            </p>
                            <?php echo $TRADE_NAME ?>
                        </td>
                        <td colspan="3">
                            <p style="text-align: left;">
                                2. Batch No. and Expiry Date
                            </p>
                            <?php echo $EXPIRY_DATE ?>
                        </td>
                        <td colspan="3">
                            <p style="text-align: left;">
                                3. Sample Available
                            </p>
                            <?php echo $SAMPLE_AVAILABLE ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p style="text-align: left;">
                                4. Dose (specify units)
                            </p>
                            <?php echo $DOSE ?>
                        </td>
                        <td colspan="3">
                            <p style="text-align: left;">
                                5. Frequency
                            </p>
                            <?php echo $FREQUENCY ?>
                        </td>
                        <td colspan="3">
                            <p style="text-align: left;">
                                6. Route of administration
                            </p>
                            <?php echo $ROUTE_OF_ADMINISTRATION ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p style="text-align: left;">
                                7. Diagnosis/Indication
                            </p>
                            <?php echo $DIAGNOSIS ?>
                        </td>
                        <td colspan="3">
                            <p style="text-align: left;">
                                8. Treatment Start date
                            </p>
                            <?php echo $TREATMENT_START_DATE ?>
                        </td>
                        <td colspan="3">
                            <p style="text-align: left;">
                                9. Treatment End date (or mention continuing)
                            </p>
                            <?php echo $TREATMENT_END_DATE ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <p style="text-align: left;">10. Any other information:</p>
                            <?php echo $ANY_OTHER_INFORMATION ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">III) MAIN EVENT</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="text-align: left;">
                                1.a <strong>Onset</strong> Date <br>
                            </p>
                            <?php echo $ONSET_DATE ?>
                        </td>
                        <td colspan="2">
                            <p style="text-align: left;">
                                1.b Event <strong>Stop Date (if applicable) or <br> Mention Ongoing</strong>
                            </p>
                            <?php echo $EVENT_STOP_DATE ?>
                        </td>
                        <td colspan="2">
                            <p style="text-align: left;">
                                <strong>
                                    1.c Duration
                                </strong>
                            </p>
                            <?php echo $DURATION ?>
                        </td>
                        <td colspan="3">
                            <p style="text-align: left;">
                                1.d Event <strong>abated</strong> after use stopped
                            </p>
                            <?php echo $EVENT_ABATED ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <p style="margin-top: -6%; text-align: left;">
                                <strong>1.h Event term</strong> <br>
                                (full description of the event including body site and severity)
                            </p>
                            <?php echo $EVENT_TERM ?>
                        </td>
                        <td colspan="4">
                            <table class="w-100 h-100">
                                <tr>
                                    <td>
                                        <p style="text-align: left;">1.e Event <strong>reappeared</strong> after reintroduction</p>
                                        <?php echo $REAPPEARED ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="text-align: left;"> 1.f Has this drug <strong>previously</strong> been used</p>
                                        <?php echo $PREVIOUSLY ?>
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
                                                        <span style="color: #ff0000;"> Non serious event </span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Death - Date of death:
                                                    </div>
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <span>Autopsy performed</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="valor_autopsy" id="valor_autopsy">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="YES">
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="NO">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center" style="margin-left: -14%;">
                                                            <span>Cause of Death</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="cause_death" id="cause_death" class="form-control w-100 h-100">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                Life threatening <br> <br>
                                                Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                                Persistent or significant disability/Incapacity <br> <br>
                                                Congenital anomaly/birth defect <br> <br>
                                                Other Serious (Medically important event) <br> <br>
                                                “Require intervention” (only for devices)
                                            </div>
                                        <?php
                                        } else if ($SERIOUSNESS == 'Death - Date of death') {
                                        ?>
                                            <div style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Non serious event
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        <span style="color: #ff0000;"> Death - Date of death: </span> <span> <?php echo $DATE_OF_DEATH ?> </span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <span style="color: #ff0000;">Autopsy performed</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <?php echo $AUTOPSY ?>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <span style="color: #ff0000;">Cause of Death</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <?php echo $CAUSE_OF_DEATH ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                Life threatening <br> <br>
                                                Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                                Persistent or significant disability/Incapacity <br> <br>
                                                Congenital anomaly/birth defect <br> <br>
                                                Other Serious (Medically important event) <br> <br>
                                                “Require intervention” (only for devices)
                                            </div>
                                        <?php
                                        } else if ($SERIOUSNESS == 'Life threatening') {
                                        ?>
                                            <div style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Non serious event
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Death - Date of death:
                                                    </div>
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <span>Autopsy performed</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="valor_autopsy" id="valor_autopsy">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="YES">
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="NO">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center" style="margin-left: -14%;">
                                                            <span>Cause of Death</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="cause_death" id="cause_death" class="form-control w-100 h-100">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <span style="color: #ff0000;"> Life threatening </span> <br> <br>
                                                Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                                Persistent or significant disability/Incapacity <br> <br>
                                                Congenital anomaly/birth defect <br> <br>
                                                Other Serious (Medically important event) <br> <br>
                                                “Require intervention” (only for devices)
                                            </div>
                                        <?php
                                        } else if ($SERIOUSNESS == 'Inpatient hospitalisation or prolongation of existing hospitalisation') {
                                        ?>
                                            <div style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Non serious event
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Death - Date of death:
                                                    </div>
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <span>Autopsy performed</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="valor_autopsy" id="valor_autopsy">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="YES">
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="NO">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center" style="margin-left: -14%;">
                                                            <span>Cause of Death</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="cause_death" id="cause_death" class="form-control w-100 h-100">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                Life threatening <br> <br>
                                                <span style="color: #ff0000;"> Inpatient hospitalisation or prolongation of existing hospitalisation </span> <br> <br>
                                                Persistent or significant disability/Incapacity <br> <br>
                                                Congenital anomaly/birth defect <br> <br>
                                                Other Serious (Medically important event) <br> <br>
                                                “Require intervention” (only for devices)
                                            </div>
                                        <?php
                                        } else if ($SERIOUSNESS == 'Persistent or significant disability/Incapacity') {
                                        ?>
                                            <div style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Non serious event
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Death - Date of death:
                                                    </div>
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <span>Autopsy performed</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="valor_autopsy" id="valor_autopsy">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="YES">
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="NO">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center" style="margin-left: -14%;">
                                                            <span>Cause of Death</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="cause_death" id="cause_death" class="form-control w-100 h-100">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                Life threatening <br> <br>
                                                Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                                <span style="color: #ff0000;"> Persistent or significant disability/Incapacity </span> <br> <br>
                                                Congenital anomaly/birth defect <br> <br>
                                                Other Serious (Medically important event) <br> <br>
                                                “Require intervention” (only for devices)
                                            </div>
                                        <?php
                                        } else if ($SERIOUSNESS == 'Congenital anomaly/birth defect') {
                                        ?>
                                            <div style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Non serious event
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Death - Date of death:
                                                    </div>
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <span>Autopsy performed</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="valor_autopsy" id="valor_autopsy">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="YES">
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="NO">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center" style="margin-left: -14%;">
                                                            <span>Cause of Death</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="cause_death" id="cause_death" class="form-control w-100 h-100">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                Life threatening <br> <br>
                                                Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                                Persistent or significant disability/Incapacity <br> <br>
                                                <span style="color: #ff0000;"> Congenital anomaly/birth defect </span> <br> <br>
                                                Other Serious (Medically important event) <br> <br>
                                                “Require intervention” (only for devices)
                                            </div>
                                        <?php
                                        } else if ($SERIOUSNESS == 'Other Serious (Medically important event)') {
                                        ?>
                                            <div style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Non serious event
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Death - Date of death:
                                                    </div>
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <span>Autopsy performed</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="valor_autopsy" id="valor_autopsy">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="YES">
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="NO">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center" style="margin-left: -14%;">
                                                            <span>Cause of Death</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="cause_death" id="cause_death" class="form-control w-100 h-100">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                Life threatening <br> <br>
                                                Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                                Persistent or significant disability/Incapacity <br> <br>
                                                Congenital anomaly/birth defect <br> <br>
                                                <span style="color: #ff0000;"> Other Serious (Medically important event) </span> <br> <br>
                                                “Require intervention” (only for devices)
                                            </div>
                                        <?php
                                        } else if ($SERIOUSNESS == 'Require intervention (only for devices)') {
                                        ?>
                                            <div style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Non serious event
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-left">
                                                        Death - Date of death:
                                                    </div>
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <span>Autopsy performed</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="valor_autopsy" id="valor_autopsy">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="YES">
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="autopsy" id="autopsy" value="NO">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-center" style="margin-left: -14%;">
                                                            <span>Cause of Death</span>
                                                        </div>
                                                        <div class="col d-flex justify-content-center">
                                                            <input type="hidden" name="cause_death" id="cause_death" class="form-control w-100 h-100">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                Life threatening <br> <br>
                                                Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                                Persistent or significant disability/Incapacity <br> <br>
                                                Congenital anomaly/birth defect <br> <br>
                                                Other Serious (Medically important event) <br> <br>
                                                <span style="color: #ff0000;"> “Require intervention” (only for devices) </span>
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
                        <td colspan="4">
                            <div class="row">
                                <div class="col d-flex justify-content-left">
                                    <span style="text-align: left;">1.i Treatment for AE</span>
                                </div>
                                <div class="col d-flex justify-content-left">
                                    <?php echo $TREATMENT_FOR_AE ?>
                                </div>
                            </div>
                            <br>
                            <p style="text-align: left;">
                                <strong>
                                    Treatment Details:
                                </strong>
                            </p>
                            <?php echo $TREATMENT_DETAILS ?>
                        </td>
                        <td colspan="5">
                            <p style="margin-top: -3%; text-align: left;">
                                <strong>
                                    1.h Outcome
                                </strong>
                            </p>
                            <div class="row">
                                <div class="col d-flex justify-content-left">
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
                            <?php echo $LABORATORY_DATA ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <p style="text-align: left;">
                                <strong>
                                    3. Medical history including pre-existing conditions
                                </strong>
                            </p>
                            <?php echo $MEDICAL_HISTORY ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <p style="text-align: left;">
                                <strong>
                                    4. Reporter’s Causality
                                </strong>
                                <br>
                                Does the Reporter consider that the event was possibly related to the drug?
                            </p>
                            <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <?php echo $REPORTE_CAUSALITY ?>
                                </div>
                            </div>
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
                    <tr>
                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">IV) SPECIAL SITUATIONS</td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <?php
                            if ($SPECIAL_SITUATIONS != 'Pregnancy (maternal exposure or paternal exposure (including potential alteration of spermatozoids))' || $SPECIAL_SITUATIONS != 'Breastfeeding' || $SPECIAL_SITUATIONS != 'Overdose' || $SPECIAL_SITUATIONS != 'Misuse' || $SPECIAL_SITUATIONS != 'Abuse' || $SPECIAL_SITUATIONS != 'Medication Error' || $SPECIAL_SITUATIONS != 'Lack of Efficacy' || $SPECIAL_SITUATIONS != 'Occupational exposure' || $SPECIAL_SITUATIONS != 'Drug interaction' || $SPECIAL_SITUATIONS != 'Off-label Use' || $SPECIAL_SITUATIONS != 'Suspected transmission of infectious agent' || $SPECIAL_SITUATIONS != 'Unexpected beneficial event') {
                            ?>
                                <p style="text-align: left;" id="special_situations_specify_id">
                                    <strong>Specify:</strong>
                                    <?php echo $SPECIAL_SITUATIONS ?>
                                </p>
                            <?php
                            } else {
                            ?>
                                <p style="text-align: left;" id="special_situations_specify_id">
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
                                    <?php echo $DEFECT_ISSUE ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">VI) CO-SUSPECT (S) & CONCOMITANT (C) DRUGS</td>
                    </tr>
                    <tr>
                        <td colspan="1">
                            <p style="text-align: left;">
                                <strong>
                                    Drug (including dosage form)
                                </strong>
                            </p>
                        </td>
                        <td colspan="1">
                            <p style="text-align: left;">
                                <strong>
                                    Route
                                </strong>
                            </p>
                        </td>
                        <td colspan="1">
                            <p style="text-align: left;">
                                <strong>
                                    Daily dose
                                </strong>
                            </p>
                        </td>
                        <td colspan="1">
                            <p style="text-align: left;">
                                <strong>
                                    Duration
                                </strong>
                            </p>
                        </td>
                        <td colspan="2">
                            <table class="w-100 h-100">
                                <p>
                                    <strong>
                                        Date of administration
                                    </strong>
                                </p>
                                <hr>
                                <td style="border: none;">
                                    <strong>
                                        Start
                                    </strong>
                                </td>
                                <td style="border: none;">
                                    <strong>
                                        Stop
                                    </strong>
                                </td>
                            </table>
                        </td>
                        <td colspan="1">
                            <p style="text-align: left;">
                                <strong>
                                    Indication
                                </strong>
                            </p>
                        </td>
                        <td colspan="1">
                            <p style="text-align: left;">
                                <strong>
                                    S or C
                                </strong>
                            </p>
                        </td>
                        <td colspan="1">
                            <p style="text-align: left;">
                                <strong>
                                    Company drug (Y/N)
                                </strong>
                            </p>
                        </td>
                    </tr>
                    <tbody id="contenedor">
                        <tr>
                            <td colspan="1">
                                <input type="text" class="form-control w-100 h-100" name="drug[]" id="drug">
                            </td>
                            <td colspan="1">
                                <input type="text" class="form-control w-100 h-100" name="route[]" id="route">
                            </td>
                            <td colspan="1">
                                <input type="text" class="form-control w-100 h-100" name="daily_dose[]" id="daily_dose">
                            </td>
                            <td colspan="1">
                                <input type="text" class="form-control w-100 h-100" name="duration[]" id="duration">
                            </td>
                            <td colspan="2">
                                <table class="w-100 h-100">
                                    <td style="border: none;">
                                        <input type="date" class="form-control w-100 h-100" name="start[]" id="start">
                                    </td>
                                    <td style="border: none;">
                                        <input type="date" class="form-control w-100 h-100" name="stop[]" id="stop">
                                    </td>
                                </table>
                            </td>
                            <td colspan="1">
                                <input type="text" class="form-control w-100 h-100" name="indication[]" id="indication">
                            </td>
                            <td colspan="1">
                                <select class="form-control w-100 h-100" name="s_or_c[]" id="s_or_c">
                                    <option value=""></option>
                                    <option value="S">S</option>
                                    <option value="C">C</option>
                                </select>
                            </td>
                            <td colspan="1">
                                <input type="text" class="form-control w-100 h-100" name="company_drug[]" id="company_drug">
                            </td>
                        </tr>
                    </tbody>
                    <tr>
                        <td colspan="9" style="font-weight: 700;">
                            <button type="button" id="btn-agregar" class="btn btn-secondary">Generar campo</button>
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
                            <?php echo $REPORTER_NAME ?>
                        </td>
                        <td colspan="2">
                            <p style="text-align: left;">
                                <strong>
                                    1.b Phone number
                                </strong>
                            </p>
                            <?php echo $PHONE_NUMBER ?>
                        </td>
                        <td colspan="2">
                            <p style="text-align: left;">
                                <strong>
                                    1.c Address
                                </strong>
                            </p>
                            <?php echo $ADDRESS ?>
                        </td>
                        <td colspan="3">
                            <p style="text-align: left;">
                                <strong>
                                    1.d Fax Number/email address
                                </strong>
                            </p>
                            <?php echo $REPORTER_EMAIL ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <table class="w-100 h-100">
                                <tr>
                                    <td style="border: none;">
                                        <div class="row">
                                            <div class="col d-flex justify-content-left">
                                                <span style="text-align: left;">
                                                    <strong>
                                                        2. Health Care Professional
                                                    </strong>
                                                </span>
                                            </div>
                                            <div class="col d-flex justify-content-left">
                                                <?php echo $PROFESSIONAL ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none;">
                                        <hr>
                                        <p style="text-align: left;">
                                            <strong>
                                                4. Country of Reporting event:
                                            </strong>
                                        </p>
                                        COLOMBIA
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="4">
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
                        <td colspan="5">
                            <p style="text-align: left;">
                                5. As a <strong>MAH</strong>, we have an obligation to collect and report adverse events/safety information with our products to Health Authority to improve patient safety. <br>
                                Are you willing for Ipsen safety team to contact you/your doctor for further details if required?
                            </p>
                            <br>
                            <div class="row">
                                <div class="col d-flex justify-content-left">
                                    <?php echo $MAH ?>
                                </div>
                            </div>
                        </td>
                        <td colspan="4">
                            <p style="text-align: left;">
                                6. If the reporter is a patient, what is their <strong>doctor's name and address?</strong> (complete only if section 5. is ticked Yes)
                            </p>
                            <br>
                            <div class="row">
                                <div class="col d-flex justify-content-left">
                                    <?php echo $DOCTORS ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">VIII) RESEARCHER’S DETAILS</td>
                    </tr>
                    <tr>
                        <td colspan="3">
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
                        <td colspan="6">
                            <p style="text-align: left;">
                                <strong>
                                    <?php
                                    $select_user = mysqli_query($conex, "SELECT NOMBRES, APELLIDOS FROM ipsen_usuario WHERE EMAIL = '" . $COMPLETED_BY . "';");
                                    while ($fila_user = mysqli_fetch_array($select_user)) {
                                        $NOMBRES = $fila_user['NOMBRES'];
                                        $APELLIDOS = $fila_user['APELLIDOS'];
                                    }
                                    echo $NOMBRES . ' ' . $APELLIDOS;
                                    ?>

                                </strong> <br> <br>
                                <strong>
                                    PEOPLE MARKETING
                                </strong> <br> <br>
                                <strong style="text-decoration: underline; color: blue;">
                                    <?php
                                    echo $COMPLETED_BY
                                    ?>
                                </strong>
                                <br>
                                <br>
                                <br>
                                <br>
                                <strong>
                                    <?php echo $DATE_OF_NOTIFICATION ?>
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
                </table>
            </td>
        </tr>
    </table>
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

    hr {
        width: 100%;
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
    file_put_contents('' . $CARPETA . '/Evento_Adverso_' . $ID_PAP . '.pdf', $output);
}
require("../presentacion/email/mail.php");