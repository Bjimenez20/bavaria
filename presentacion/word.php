<?php
include "../logica/session.php";
include "../datos/conex.php";
require '../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'));

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

$consulta_medicamento = mysqli_query($conex, "SELECT * FROM ipsen_informacion_tratamiento_ea WHERE EVENTO_ADVERSO_ID ='" . $ID_EVENTO_ADVERSO . "'");
echo mysqli_error($conex);

$formatted_birth_date = formatDate($DATE_OF_BIRTH);
$formatted_onset_date = formatDate($ONSET_DATE);
$formatted_death_date = formatDate($DATE_OF_DEATH);
$formatted_of_notification_date = formatDate($DATE_OF_NOTIFICATION);
$formatted_treatment_start_date = formatDate($TREATMENT_START_DATE);
$formatted_treatment_end_date = formatDate($TREATMENT_END_DATE);
//$formatted_event_stop_date = formatDate($EVENT_STOP_DATE);

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../plantilla/Adverse Events.docx');

try {
    $templateProcessor->cloneRow('DRUG', mysqli_num_rows($consulta_medicamento));
} catch (\PhpOffice\PhpWord\Exception\Exception $e) {
    echo 'Error al clonar fila: ' . $e->getMessage();
    exit();
}

// Iniciar el contador para los valores clonados
$counter = 1;

// Iterar sobre los resultados de la consulta
while ($fila = mysqli_fetch_array($consulta_medicamento)) {
    // Obtener valores de la fila actual
    $DRUG = $fila['DRUG'];
    $ROUTE = $fila['ROUTE'];
    $DAILY_DOSE = $fila['DAILY_DOSE'];
    $DURATION = $fila['DURATION'];
    $DATE_START = $fila['DATE_START'];
    $DATE_STOP = $fila['DATE_STOP'];
    $INDICATION = $fila['INDICATION'];
    $S_OR_C = $fila['S_OR_C'];
    $COMPANY_DRUG = $fila['COMPANY_DRUG'];

    $formatted_start_date = formatDate($DATE_START);
    $formatted_stop_date = formatDate($DATE_STOP);
    // Asignar valores con los nombres de marcadores de posición clonados
    $templateProcessor->setValue('DRUG#' . $counter, $DRUG);
    $templateProcessor->setValue('ROUTE#' . $counter, $ROUTE);
    $templateProcessor->setValue('DAILY_DOSE#' . $counter, $DAILY_DOSE);
    $templateProcessor->setValue('DURATION#' . $counter, $DURATION);
    $templateProcessor->setValue('DATE_START#' . $counter, $formatted_start_date);
    $templateProcessor->setValue('DATE_STOP#' . $counter, $formatted_stop_date);
    $templateProcessor->setValue('INDICATION#' . $counter, $INDICATION);
    $templateProcessor->setValue('S_OR_C#' . $counter, $S_OR_C);
    $templateProcessor->setValue('COMPANY_DRUG#' . $counter, $COMPANY_DRUG);

    // Incrementar el contador para el siguiente conjunto de valores
    $counter++;
}

$templateProcessor->setValue('valor1', '☐');
$templateProcessor->setValue('valor2', '☑');
$templateProcessor->setValue('valor3', '☐');
$templateProcessor->setValue('valor4', '☐');
$templateProcessor->setValue('DATE_OF_NOTIFICATION', $formatted_of_notification_date);
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
$templateProcessor->setValue('TREATMENT_START_DATE', $formatted_treatment_start_date);
$templateProcessor->setValue('TREATMENT_END_DATE', $formatted_treatment_end_date);
$templateProcessor->setValue('ANY_OTHER_INFORMATION', $ANY_OTHER_INFORMATION);
$templateProcessor->setValue('ONSET_DATE', $formatted_onset_date);
$templateProcessor->setValue('EVENT_STOP_DATE', $EVENT_STOP_DATE);
$templateProcessor->setValue('DURATION', $DURATION);
$templateProcessor->setValue('ABATED1', '☐');
$templateProcessor->setValue('ABATED2', '☐');
$templateProcessor->setValue('ABATED3', '☑');
$templateProcessor->setValue('EVENT_TERM', $EVENT_TERM);
$templateProcessor->setValue('REAPPEARED1', '☐');
$templateProcessor->setValue('REAPPEARED2', '☐');
$templateProcessor->setValue('REAPPEARED3', '☑');
$templateProcessor->setValue('PREVIOUSLY1', '☐');
$templateProcessor->setValue('PREVIOUSLY2', '☑');
$templateProcessor->setValue('PREVIOUSLY3', '☐');
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
$templateProcessor->setValue('FORAE1', '☐');
$templateProcessor->setValue('FORAE2', '☑');

$templateProcessor->setValue('TREATMENT_DETAILS', $TREATMENT_DETAILS);
switch ($OUTCOME) {
    case 'Not recovered':
        $templateProcessor->setValue('OUT1', '☑');
        $templateProcessor->setValue('OUT2', '☐');
        $templateProcessor->setValue('OUT3', '☐');
        $templateProcessor->setValue('OUT4', '☐');
        $templateProcessor->setValue('OUT5', '☐');
        break;
    case 'Recovering':
        $templateProcessor->setValue('OUT1', '☐');
        $templateProcessor->setValue('OUT2', '☑');
        $templateProcessor->setValue('OUT3', '☐');
        $templateProcessor->setValue('OUT4', '☐');
        $templateProcessor->setValue('OUT5', '☐');
        break;
    case 'Recovered with sequelae':
        $templateProcessor->setValue('OUT1', '☐');
        $templateProcessor->setValue('OUT2', '☐');
        $templateProcessor->setValue('OUT3', '☑');
        $templateProcessor->setValue('OUT4', '☐');
        $templateProcessor->setValue('OUT5', '☐');
        break;
    case 'Recovered without sequelae':
        $templateProcessor->setValue('OUT1', '☐');
        $templateProcessor->setValue('OUT2', '☐');
        $templateProcessor->setValue('OUT3', '☐');
        $templateProcessor->setValue('OUT4', '☑');
        $templateProcessor->setValue('OUT5', '☐');
        break;
    case 'Unknown':
        $templateProcessor->setValue('OUT1', '☐');
        $templateProcessor->setValue('OUT2', '☐');
        $templateProcessor->setValue('OUT3', '☐');
        $templateProcessor->setValue('OUT4', '☐');
        $templateProcessor->setValue('OUT5', '☑');
        break;
}
$templateProcessor->setValue('LABORATORY_DATA', $LABORATORY_DATA);
$templateProcessor->setValue('MEDICAL_HISTORY', $MEDICAL_HISTORY);
switch ($REPORTE_CAUSALITY) {
    case 'YES':
        $templateProcessor->setValue('RE_CAUSALITY1', '☑');
        $templateProcessor->setValue('RE_CAUSALITY2', '☐');
        $templateProcessor->setValue('RE_CAUSALITY3', '☐');
        break;

    case 'NO':
        $templateProcessor->setValue('RE_CAUSALITY1', '☐');
        $templateProcessor->setValue('RE_CAUSALITY2', '☑');
        $templateProcessor->setValue('RE_CAUSALITY3', '☐');
        break;

    case 'Unknown':
        $templateProcessor->setValue('RE_CAUSALITY1', '☐');
        $templateProcessor->setValue('RE_CAUSALITY2', '☐');
        $templateProcessor->setValue('RE_CAUSALITY3', '☑');
        break;
}
switch ($PATIENT_PREGNANT) {
    case 'YES':
        $templateProcessor->setValue('PATIENT_PREGNANT1', '☑');
        $templateProcessor->setValue('PATIENT_PREGNANT2', '☐');
        $templateProcessor->setValue('PATIENT_PREGNANT3', '☐');
        $templateProcessor->setValue('PATIENT_PREGNANT4', '☐');
        break;

    case 'NO':
        $templateProcessor->setValue('PATIENT_PREGNANT1', '☐');
        $templateProcessor->setValue('PATIENT_PREGNANT2', '☑');
        $templateProcessor->setValue('PATIENT_PREGNANT3', '☐');
        $templateProcessor->setValue('PATIENT_PREGNANT4', '☐');
        break;

    case 'Unknown':
        $templateProcessor->setValue('PATIENT_PREGNANT1', '☐');
        $templateProcessor->setValue('PATIENT_PREGNANT2', '☐');
        $templateProcessor->setValue('PATIENT_PREGNANT3', '☑');
        $templateProcessor->setValue('PATIENT_PREGNANT4', '☐');
        break;

    case 'N/A':
        $templateProcessor->setValue('PATIENT_PREGNANT1', '☐');
        $templateProcessor->setValue('PATIENT_PREGNANT2', '☐');
        $templateProcessor->setValue('PATIENT_PREGNANT3', '☐');
        $templateProcessor->setValue('PATIENT_PREGNANT4', '☑');
        break;
}

if ($PATIENT_PREGNANT == 'YES') {
    $templateProcessor->setValue('PATIENT_PREGNANT_YES', $PATIENT_PREGNANT_YES);
} else {
    $templateProcessor->setValue('PATIENT_PREGNANT_YES', '_________________');
}

switch ($SPECIAL_SITUATIONS) {
    case 'Pregnancy (maternal exposure or paternal exposure (including potential alteration of spermatozoids))':
        $templateProcessor->setValue('1', '☑');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Breastfeeding':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☑');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Overdose':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☑');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Misuse':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☑');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Abuse':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☑');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Medication Error':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☑');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Lack of Efficacy':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☑');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Occupational exposure':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☑');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Drug interaction':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☑');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Off-label Use':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☑');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Suspected transmission of infectious agent':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☑');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Unexpected beneficial event':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☑');
        $templateProcessor->setValue('13', '☐');
        break;

    case 'Other':
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☑');
        break;

    default:
        $templateProcessor->setValue('1', '☐');
        $templateProcessor->setValue('2', '☐');
        $templateProcessor->setValue('3', '☐');
        $templateProcessor->setValue('4', '☐');
        $templateProcessor->setValue('5', '☐');
        $templateProcessor->setValue('6', '☐');
        $templateProcessor->setValue('7', '☐');
        $templateProcessor->setValue('8', '☐');
        $templateProcessor->setValue('9', '☐');
        $templateProcessor->setValue('10', '☐');
        $templateProcessor->setValue('11', '☐');
        $templateProcessor->setValue('12', '☐');
        $templateProcessor->setValue('13', '☐');
}
if ($DEFECT_ISSUE == 'Event related to a quality defect issue') {
    $templateProcessor->setValue('DEFECT_ISSUE1', '☑');
    $templateProcessor->setValue('DEFECT_ISSUE2', '☐');
} else {
    $templateProcessor->setValue('DEFECT_ISSUE1', '☐');
    $templateProcessor->setValue('DEFECT_ISSUE2', '☑');
}
$templateProcessor->setValue('REPORTER_NAME', $REPORTER_NAME);
$templateProcessor->setValue('PHONE_NUMBER', $PHONE_NUMBER);
$templateProcessor->setValue('ADDRESS', $ADDRESS);
$templateProcessor->setValue('REPORTER_EMAIL', $REPORTER_EMAIL);
$templateProcessor->setValue('PROFESSIONAL1', '☐');
$templateProcessor->setValue('PROFESSIONAL2', '☑');

switch ($OCCUPATION) {
    case 'Doctor':
        $templateProcessor->setValue('OCU1', '☑');
        $templateProcessor->setValue('OCU2', '☐');
        $templateProcessor->setValue('OCU3', '☐');
        $templateProcessor->setValue('OCU4', '☐');
        $templateProcessor->setValue('OCU5', '☐');
        $templateProcessor->setValue('OCU6', '☐');
        $templateProcessor->setValue('OCU7', '☐');
        break;

    case 'Nurse':
        $templateProcessor->setValue('OCU1', '☐');
        $templateProcessor->setValue('OCU2', '☑');
        $templateProcessor->setValue('OCU3', '☐');
        $templateProcessor->setValue('OCU4', '☐');
        $templateProcessor->setValue('OCU5', '☐');
        $templateProcessor->setValue('OCU6', '☐');
        $templateProcessor->setValue('OCU7', '☐');
        break;

    case 'Pharmacist':
        $templateProcessor->setValue('OCU1', '☐');
        $templateProcessor->setValue('OCU2', '☐');
        $templateProcessor->setValue('OCU3', '☑');
        $templateProcessor->setValue('OCU4', '☐');
        $templateProcessor->setValue('OCU5', '☐');
        $templateProcessor->setValue('OCU6', '☐');
        $templateProcessor->setValue('OCU7', '☐');
        break;

    case 'Dentist':
        $templateProcessor->setValue('OCU1', '☐');
        $templateProcessor->setValue('OCU2', '☐');
        $templateProcessor->setValue('OCU3', '☐');
        $templateProcessor->setValue('OCU4', '☑');
        $templateProcessor->setValue('OCU5', '☐');
        $templateProcessor->setValue('OCU6', '☐');
        $templateProcessor->setValue('OCU7', '☐');
        break;

    case 'Patient':
        $templateProcessor->setValue('OCU1', '☐');
        $templateProcessor->setValue('OCU2', '☐');
        $templateProcessor->setValue('OCU3', '☐');
        $templateProcessor->setValue('OCU4', '☐');
        $templateProcessor->setValue('OCU5', '☑');
        $templateProcessor->setValue('OCU6', '☐');
        $templateProcessor->setValue('OCU7', '☐');
        break;

    case 'Health Authority':
        $templateProcessor->setValue('OCU1', '☐');
        $templateProcessor->setValue('OCU2', '☐');
        $templateProcessor->setValue('OCU3', '☐');
        $templateProcessor->setValue('OCU4', '☐');
        $templateProcessor->setValue('OCU5', '☐');
        $templateProcessor->setValue('OCU6', '☑');
        $templateProcessor->setValue('OCU7', '☐');
        break;

    case 'Other':
        $templateProcessor->setValue('OCU1', '☐');
        $templateProcessor->setValue('OCU2', '☐');
        $templateProcessor->setValue('OCU3', '☐');
        $templateProcessor->setValue('OCU4', '☐');
        $templateProcessor->setValue('OCU5', '☐');
        $templateProcessor->setValue('OCU6', '☐');
        $templateProcessor->setValue('OCU7', '☑');
        break;
}
$templateProcessor->setValue('COUNTRY', $COUNTRY);
if ($MAH == 'YES') {
    $templateProcessor->setValue('MAH1', '☑');
    $templateProcessor->setValue('MAH2', '☐');
} else {
    $templateProcessor->setValue('MAH1', '☐');
    $templateProcessor->setValue('MAH2', '☑');
}
$templateProcessor->setValue('DOCTORS', $DOCTORS);
$templateProcessor->setValue('COMPLETED_BY', $COMPLETED_BY);
$templateProcessor->setValue('COMPANY', 'PEOPLE MARKETING');
$templateProcessor->setValue('EMAIL_ADDRESS', $EMAIL_USER);
$templateProcessor->setValue('DATA_OF_FORM_COMPLETED', $formatted_of_notification_date);
$templateProcessor->setValue('ID_PACIENTE_FK', $ID_PACIENTE_FK);

// Define la ruta donde quieres guardar el archivo
$savePath = '../EVENTO_ADVERSO/' . $ID_EVENTO_ADVERSO . '/Evento_Adverso_' . $ID_PACIENTE_FK . '.docx';

// Guarda el archivo en la ruta especificada
$templateProcessor->saveAs($savePath);
chmod($savePath, 0755);

// echo "El archivo se ha guardado en: " . $savePath;

require("../presentacion/email/mail.php");
