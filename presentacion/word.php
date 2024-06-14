<?php
include "../logica/session.php";
include "../datos/conex.php";
require '../vendor/autoload.php';

function formatDate($dateString)
{
    $date = new DateTime($dateString);
    return $date->format('d-m-Y'); // Convertir a DD-MM-AAAA
}

$consulta = mysqli_query($conex, "SELECT * FROM ipsen_evento_adverso WHERE ID_PACIENTE_FK ='4' ORDER BY ID_EVENTO_ADVERSO DESC LIMIT 1");
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
    $ID_PACIENTE_FK = $fila1['ID_PACIENTE_FK'];
}

$formatted_birth_date = formatDate($DATE_OF_BIRTH);
$formatted_onset_date = formatDate($ONSET_DATE);
$formatted_death_date = formatDate($DATE_OF_DEATH);

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../plantilla/Adverse Events.docx');

switch ($SOURCE_TYPE) {
    case 'Early Access':
        $templateProcessor->setValue('valor1', '☑');
        $templateProcessor->setValue('valor2', '☐');
        $templateProcessor->setValue('valor3', '☐');
        $templateProcessor->setValue('valor4', '☐');
        break;

    case 'Patient Support':
        $templateProcessor->setValue('valor1', '☐');
        $templateProcessor->setValue('valor2', '☑');
        $templateProcessor->setValue('valor3', '☐');
        $templateProcessor->setValue('valor4', '☐');
        break;

    case 'Market Research':
        $templateProcessor->setValue('valor1', '☐');
        $templateProcessor->setValue('valor2', '☐');
        $templateProcessor->setValue('valor3', '☑');
        $templateProcessor->setValue('valor4', '☐');
        break;

    default:
        $templateProcessor->setValue('valor1', '☐');
        $templateProcessor->setValue('valor2', '☐');
        $templateProcessor->setValue('valor3', '☐');
        $templateProcessor->setValue('valor4', '☑');
        break;
}
$templateProcessor->setValue('DATE_OF_NOTIFICATION', $DATE_OF_NOTIFICATION);
$templateProcessor->setValue('PATIENT_INITIALS', $PATIENT_INITIALS);
$templateProcessor->setValue('DATE_OF_BIRTH', $formatted_birth_date);
$templateProcessor->setValue('AGE', $AGE);
if ($GENDER == 'Male') {
    $templateProcessor->setValue('GENDER_MALE', '☑');
    $templateProcessor->setValue('GENDER_FEMALE', '☐');
} else {
    $templateProcessor->setValue('GENDER_MALE', '☐');
    $templateProcessor->setValue('GENDER_FEMALE', '☑');
}
$templateProcessor->setValue('WEIGHT', $WEIGHT);
$templateProcessor->setValue('HEIGHT', $HEIGHT);
$templateProcessor->setValue('TRADE_NAME', $TRADE_NAME);
$templateProcessor->setValue('EXPIRY_DATE', $EXPIRY_DATE);
if ($SAMPLE_AVAILABLE == 'YES') {
    $templateProcessor->setValue('SAMPLE_YES', '☑');
    $templateProcessor->setValue('SAMPLE_NO', '☐');
} else {
    $templateProcessor->setValue('SAMPLE_YES', '☐');
    $templateProcessor->setValue('SAMPLE_NO', '☑');
}
$templateProcessor->setValue('DOSE', $DOSE);
$templateProcessor->setValue('FREQUENCY', $FREQUENCY);
$templateProcessor->setValue('ROUTE_OF_ADMINISTRATION', $ROUTE_OF_ADMINISTRATION);
$templateProcessor->setValue('DIAGNOSIS', $DIAGNOSIS);
$templateProcessor->setValue('TREATMENT_START_DATE', $TREATMENT_START_DATE);
$templateProcessor->setValue('TREATMENT_END_DATE', $TREATMENT_END_DATE);
$templateProcessor->setValue('ANY_OTHER_INFORMATION', $ANY_OTHER_INFORMATION);



$templateProcessor->setValue('ONSET_DATE', $formatted_onset_date);
$templateProcessor->setValue('EVENT_STOP_DATE', $EVENT_STOP_DATE);
$templateProcessor->setValue('DURATION', $DURATION);
switch ($EVENT_ABATED) {
    case 'NO':
        $templateProcessor->setValue('ABATED1', '☑');
        $templateProcessor->setValue('ABATED2', '☐');
        $templateProcessor->setValue('ABATED3', '☐');
        break;

    case 'YES':
        $templateProcessor->setValue('ABATED1', '☐');
        $templateProcessor->setValue('ABATED2', '☑');
        $templateProcessor->setValue('ABATED3', '☐');
        break;

    default:
        $templateProcessor->setValue('ABATED1', '☐');
        $templateProcessor->setValue('ABATED2', '☐');
        $templateProcessor->setValue('ABATED4', '☑');
        break;
}
$templateProcessor->setValue('EVENT_TERM', $EVENT_TERM);
switch ($REAPPEARED) {
    case 'NO':
        $templateProcessor->setValue('REAPPEARED1', '☑');
        $templateProcessor->setValue('REAPPEARED2', '☐');
        $templateProcessor->setValue('REAPPEARED3', '☐');
        break;

    case 'YES':
        $templateProcessor->setValue('REAPPEARED1', '☐');
        $templateProcessor->setValue('REAPPEARED2', '☑');
        $templateProcessor->setValue('REAPPEARED3', '☐');
        break;

    default:
        $templateProcessor->setValue('REAPPEARED1', '☐');
        $templateProcessor->setValue('REAPPEARED2', '☐');
        $templateProcessor->setValue('REAPPEARED4', '☑');
        break;
}
switch ($PREVIOUSLY) {
    case 'NO':
        $templateProcessor->setValue('PREVIOUSLY1', '☑');
        $templateProcessor->setValue('PREVIOUSLY2', '☐');
        $templateProcessor->setValue('PREVIOUSLY3', '☐');
        break;

    case 'YES':
        $templateProcessor->setValue('PREVIOUSLY1', '☐');
        $templateProcessor->setValue('PREVIOUSLY2', '☑');
        $templateProcessor->setValue('PREVIOUSLY3', '☐');
        break;

    default:
        $templateProcessor->setValue('PREVIOUSLY1', '☐');
        $templateProcessor->setValue('PREVIOUSLY2', '☐');
        $templateProcessor->setValue('PREVIOUSLY4', '☑');
        break;
}
switch ($SERIOUSNESS) {
    case 'Non serious event':
        $templateProcessor->setValue('SERIOUSNESS1', '☑');
        $templateProcessor->setValue('SERIOUSNESS2', '☐');
        $templateProcessor->setValue('SERIOUSNESS3', '☐');
        $templateProcessor->setValue('SERIOUSNESS4', '☐');
        $templateProcessor->setValue('SERIOUSNESS5', '☐');
        $templateProcessor->setValue('SERIOUSNESS6', '☐');
        $templateProcessor->setValue('SERIOUSNESS7', '☐');
        $templateProcessor->setValue('SERIOUSNESS8', '☐');
        break;
    case 'Death - Date of death':
        $templateProcessor->setValue('SERIOUSNESS1', '☐');
        $templateProcessor->setValue('SERIOUSNESS2', '☑');
        $templateProcessor->setValue('SERIOUSNESS3', '☐');
        $templateProcessor->setValue('SERIOUSNESS4', '☐');
        $templateProcessor->setValue('SERIOUSNESS5', '☐');
        $templateProcessor->setValue('SERIOUSNESS6', '☐');
        $templateProcessor->setValue('SERIOUSNESS7', '☐');
        $templateProcessor->setValue('SERIOUSNESS8', '☐');
        $templateProcessor->setValue('DATE_OF_DEATH', $formatted_death_date);
        if ($AUTOPSY == 'YES') {
            $templateProcessor->setValue('AUTYES', '☑');
            $templateProcessor->setValue('AUTNO', '☐');
        } else {
            $templateProcessor->setValue('AUTYES', '☐');
            $templateProcessor->setValue('AUTNO', '☑');
        }
        break;
    case 'Life threatening':
        $templateProcessor->setValue('SERIOUSNESS1', '☐');
        $templateProcessor->setValue('SERIOUSNESS2', '☐');
        $templateProcessor->setValue('SERIOUSNESS3', '☑');
        $templateProcessor->setValue('SERIOUSNESS4', '☐');
        $templateProcessor->setValue('SERIOUSNESS5', '☐');
        $templateProcessor->setValue('SERIOUSNESS6', '☐');
        $templateProcessor->setValue('SERIOUSNESS7', '☐');
        $templateProcessor->setValue('SERIOUSNESS8', '☐');
        break;
    case 'Inpatient hospitalisation or prolongation of existing hospitalisation':
        $templateProcessor->setValue('SERIOUSNESS1', '☐');
        $templateProcessor->setValue('SERIOUSNESS2', '☐');
        $templateProcessor->setValue('SERIOUSNESS3', '☐');
        $templateProcessor->setValue('SERIOUSNESS4', '☑');
        $templateProcessor->setValue('SERIOUSNESS5', '☐');
        $templateProcessor->setValue('SERIOUSNESS6', '☐');
        $templateProcessor->setValue('SERIOUSNESS7', '☐');
        $templateProcessor->setValue('SERIOUSNESS8', '☐');
        break;
    case 'Persistent or significant disability/Incapacity':
        $templateProcessor->setValue('SERIOUSNESS1', '☐');
        $templateProcessor->setValue('SERIOUSNESS2', '☐');
        $templateProcessor->setValue('SERIOUSNESS3', '☐');
        $templateProcessor->setValue('SERIOUSNESS4', '☐');
        $templateProcessor->setValue('SERIOUSNESS5', '☑');
        $templateProcessor->setValue('SERIOUSNESS6', '☐');
        $templateProcessor->setValue('SERIOUSNESS7', '☐');
        $templateProcessor->setValue('SERIOUSNESS8', '☐');
        break;
    case 'Congenital anomaly/birth defect':
        $templateProcessor->setValue('SERIOUSNESS1', '☐');
        $templateProcessor->setValue('SERIOUSNESS2', '☐');
        $templateProcessor->setValue('SERIOUSNESS3', '☐');
        $templateProcessor->setValue('SERIOUSNESS4', '☐');
        $templateProcessor->setValue('SERIOUSNESS5', '☐');
        $templateProcessor->setValue('SERIOUSNESS6', '☑');
        $templateProcessor->setValue('SERIOUSNESS7', '☐');
        $templateProcessor->setValue('SERIOUSNESS8', '☐');
        break;
    case 'Other Serious (Medically important event)':
        $templateProcessor->setValue('SERIOUSNESS1', '☐');
        $templateProcessor->setValue('SERIOUSNESS2', '☐');
        $templateProcessor->setValue('SERIOUSNESS3', '☐');
        $templateProcessor->setValue('SERIOUSNESS4', '☐');
        $templateProcessor->setValue('SERIOUSNESS5', '☐');
        $templateProcessor->setValue('SERIOUSNESS6', '☐');
        $templateProcessor->setValue('SERIOUSNESS7', '☑');
        $templateProcessor->setValue('SERIOUSNESS8', '☐');
        break;
    case '“Require intervention” (only for devices)':
        $templateProcessor->setValue('SERIOUSNESS1', '☐');
        $templateProcessor->setValue('SERIOUSNESS2', '☐');
        $templateProcessor->setValue('SERIOUSNESS3', '☐');
        $templateProcessor->setValue('SERIOUSNESS4', '☐');
        $templateProcessor->setValue('SERIOUSNESS5', '☐');
        $templateProcessor->setValue('SERIOUSNESS6', '☐');
        $templateProcessor->setValue('SERIOUSNESS7', '☐');
        $templateProcessor->setValue('SERIOUSNESS8', '☑');
        break;
}
$templateProcessor->setValue('DATE_OF_DEATH', '');
if ($AUTOPSY == 'YES') {
    $templateProcessor->setValue('AUTYES', '☐');
    $templateProcessor->setValue('AUTNO', '☐');
} else {
    $templateProcessor->setValue('AUTYES', '☐');
    $templateProcessor->setValue('AUTNO', '☐');
}
$templateProcessor->setValue('CAUSE_OF_DEATH', $CAUSE_OF_DEATH);
if ($AUTOPSY == 'TREATMENT_FOR_AE') {
    $templateProcessor->setValue('FORAE1', '☑');
    $templateProcessor->setValue('FORAE2', '☐');
} else {
    $templateProcessor->setValue('FORAE1', '☐');
    $templateProcessor->setValue('FORAE2', '☑');
}
$templateProcessor->setValue('OUTCOME', $OUTCOME);
$templateProcessor->setValue('LABORATORY_DATA', $LABORATORY_DATA);
$templateProcessor->setValue('MEDICAL_HISTORY', $MEDICAL_HISTORY);
$templateProcessor->setValue('REPORTE_CAUSALITY', $REPORTE_CAUSALITY);
$templateProcessor->setValue('PATIENT_PREGNANT', $PATIENT_PREGNANT);
$templateProcessor->setValue('PATIENT_PREGNANT_YES', $PATIENT_PREGNANT_YES);
$templateProcessor->setValue('SPECIAL_SITUATIONS', $SPECIAL_SITUATIONS);
$templateProcessor->setValue('DEFECT_ISSUE', $DEFECT_ISSUE);
$templateProcessor->setValue('REPORTER_NAME', $REPORTER_NAME);
$templateProcessor->setValue('PHONE_NUMBER', $PHONE_NUMBER);
$templateProcessor->setValue('ADDRESS', $ADDRESS);
$templateProcessor->setValue('REPORTER_EMAIL', $REPORTER_EMAIL);
$templateProcessor->setValue('PROFESSIONAL', $PROFESSIONAL);
$templateProcessor->setValue('OCCUPATION', $OCCUPATION);
$templateProcessor->setValue('COUNTRY', $COUNTRY);
$templateProcessor->setValue('MAH', $MAH);
$templateProcessor->setValue('DOCTORS', $DOCTORS);
$templateProcessor->setValue('COMPLETED_BY', $COMPLETED_BY);
$templateProcessor->setValue('ID_PACIENTE_FK', $ID_PACIENTE_FK);

// Define la ruta donde quieres guardar el archivo
$savePath = 'doc/' . $PATIENT_INITIALS . '_' . $ID_PACIENTE_FK . '.docx';

// Guarda el archivo en la ruta especificada
$templateProcessor->saveAs($savePath);

echo "El archivo se ha guardado en: " . $savePath;
