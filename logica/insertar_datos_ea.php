<?php
require_once('../logica/session.php');
require_once("../datos/conex.php");

http_response_code(200);
header('Content-Type: text/plain');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$rows = $data['rows'];
$date = $data['date'];

$codigo_paciente = $date['codigo_paciente'];
$email_user = $date['email_user'];
$source_type = $date['source_type'];
$first_notification = $date['first_notification'];
$initials = $date['initials'];
$birth = $date['birth'];
$age_time_event = $date['age_time_event'];
$gender = $date['gender'];
$weight = $date['weight'];
$height = $date['height'];
$trade_name = $date['trade_name'];
$expiry_date = $date['expiry_date'];
$sample_available = $date['sample_available'];
$dose = $date['dose'];
$frequency = $date['frequency'];
$route_administration = $date['route_administration'];
$diagnosis = $date['diagnosis'];
$treatment_start_date = $date['treatment_start_date'];
$treatment_end_date = $date['treatment_end_date'];
$any_other_information = $date['any_other_information'];
$onset_date = $date['onset_date'];
$event_stop_date = $date['event_stop_date'];
$tra_duration = $date['tra_duration'];
$event_abated = $date['event_abated'];
$event_term = $date['event_term'];
$event_reappeared = $date['event_reappeared'];
$previously_been = $date['previously_been'];
$seriousness = $date['seriousness'];
$death_date = $date['death_date'];
$autopsy = $date['autopsy'];
$cause_death = $date['cause_death'];
$treatment_for_ae = $date['treatment_for_ae'];
$treatment_details = $date['treatment_details'];
$outcome = $date['outcome'];
$laboratory = $date['laboratory'];
$medical_history = $date['medical_history'];
$reporter_causality = $date['reporter_causality'];
$patient_pregnant = $date['patient_pregnant'];
$patient_pregnant_yes = $date['patient_pregnant_yes'];
$special_situations = $date['special_situations'];
$quiality_defect = $date['quiality_defect'];
$drug = $date['drug'];
$route = $date['route'];
$daily_dose = $date['daily_dose'];
$duration = $date['duration'];
$start = $date['start'];
$stop = $date['stop'];
$indication = $date['indication'];
$s_or_c = $date['s_or_c'];
$company_drug = $date['company_drug'];
$name = $date['name'];
$phone_number = $date['phone_number'];
$address = $date['address'];
$email = $date['email'];
$health_care_professional = $date['health_care_professional'];
$reporting_event = $date['reporting_event'];
$occupation_health_authority = $date['occupation_health_authority'];
$mah = $date['mah'];
$if_patient = $date['if_patient'];

if (
	empty($source_type) ||
	empty($weight) ||
	empty($height) ||
	empty($trade_name) ||
	empty($expiry_date) ||
	empty($sample_available) ||
	empty($route_administration) ||
	empty($treatment_end_date) ||
	empty($any_other_information) ||
	empty($onset_date) ||
	empty($event_stop_date) ||
	empty($tra_duration) ||
	empty($event_abated) ||
	empty($event_reappeared) ||
	empty($previously_been) ||
	empty($seriousness) ||
	empty($event_term) ||
	// todo: revisar estod datos
	//empty($death_date) ||
	// empty($autopsy) ||
	// empty($cause_death) ||
	empty($treatment_for_ae) ||
	empty($treatment_details) ||
	empty($outcome) ||
	empty($laboratory) ||
	empty($medical_history) ||
	empty($reporter_causality) ||
	empty($patient_pregnant) ||
	//todo: revisar datos
	//empty($patient_pregnant_yes) ||
	empty($special_situations) ||
	empty($quiality_defect) ||
	empty($drug) ||
	empty($route) ||
	empty($daily_dose) ||
	empty($tra_duration) ||
	empty($start) ||
	empty($stop) ||
	empty($indication) ||
	empty($s_or_c) ||
	empty($company_drug) ||
	empty($name) ||
	empty($health_care_professional) ||
	empty($occupation_health_authority) ||
	empty($mah) ||
	empty($if_patient)
) {
	$campos_vacios = array();

	if (empty($source_type)) {
		array_push($campos_vacios, 'Source type');
	}
	if (empty($weight)) {
		array_push($campos_vacios, 'Weight');
	}
	if (empty($height)) {
		array_push($campos_vacios, 'Height');
	}
	if (empty($trade_name)) {
		array_push($campos_vacios, 'Trade Name (INN/Generic Name)');
	}
	if (empty($expiry_date)) {
		array_push($campos_vacios, 'Batch No. and Expiry Date');
	}
	if (empty($sample_available)) {
		array_push($campos_vacios, 'Sample Available');
	}
	if (empty($route_administration)) {
		array_push($campos_vacios, 'Route of administration');
	}
	if (empty($treatment_end_date)) {
		array_push($campos_vacios, 'Treatment End date (or mention continuing)');
	}
	if (empty($any_other_information)) {
		array_push($campos_vacios, 'Any other information');
	}
	if (empty($onset_date)) {
		array_push($campos_vacios, 'Onset Date');
	}
	if (empty($event_stop_date)) {
		array_push($campos_vacios, 'Event Stop Date (if applicable) or Mention Ongoing');
	}
	if (empty($duration)) {
		array_push($campos_vacios, 'Duration');
	}
	if (empty($event_abated)) {
		array_push($campos_vacios, 'Event abated after use stopped');
	}
	if (empty($event_reappeared)) {
		array_push($campos_vacios, 'Event reappeared after reintroduction');
	}
	if (empty($previously_been)) {
		array_push($campos_vacios, 'Has this drug previously been used');
	}
	if (empty($seriousness)) {
		array_push($campos_vacios, 'Seriousness of the event per Reporter');
	}
	if (empty($event_term)) {
		array_push($campos_vacios, 'Event term');
	}
	if (empty($treatment_for_ae)) {
		array_push($campos_vacios, 'Treatment for AE');
	}
	if (empty($treatment_details)) {
		array_push($campos_vacios, 'Treatment Details');
	}
	if (empty($outcome)) {
		array_push($campos_vacios, 'Outcome');
	}
	if (empty($laboratory)) {
		array_push($campos_vacios, 'Relevant tests/Laboratory data including dates (please attach if possible)');
	}
	if (empty($medical_history)) {
		array_push($campos_vacios, 'Medical history including pre-existing conditions');
	}
	if (empty($reporter_causality)) {
		array_push($campos_vacios, 'Reporter’s causality');
	}
	if (empty($patient_pregnant)) {
		array_push($campos_vacios, 'Was the patient pregnant?');
	}
	if (empty($special_situations)) {
		array_push($campos_vacios, 'Special situations');
	}
	if (empty($quiality_defect)) {
		array_push($campos_vacios, 'Quality defect issue / suspected falsified/counterfeit medicinal product');
	}
	if (empty($drug)) {
		array_push($campos_vacios, 'Drug (including dosage form)');
	}
	if (empty($route)) {
		array_push($campos_vacios, 'Route');
	}
	if (empty($daily_dose)) {
		array_push($campos_vacios, 'Daily dose');
	}
	if (empty($tra_duration)) {
		array_push($campos_vacios, 'Duration');
	}
	if (empty($start)) {
		array_push($campos_vacios, 'Date of administration Start');
	}
	if (empty($stop)) {
		array_push($campos_vacios, 'Date of administration Stop');
	}
	if (empty($indication)) {
		array_push($campos_vacios, 'Indication');
	}
	if (empty($s_or_c)) {
		array_push($campos_vacios, 'S or C');
	}
	if (empty($company_drug)) {
		array_push($campos_vacios, 'Company drug (Y/N)');
	}
	if (empty($name)) {
		array_push($campos_vacios, 'Name');
	}
	if (empty($health_care_professional)) {
		array_push($campos_vacios, 'Health Care Professional');
	}
	if (empty($occupation_health_authority)) {
		array_push($campos_vacios, 'Profession/Occupation or Health Authority');
	}
	if (empty($mah)) {
		array_push($campos_vacios, 'Mah');
	}
	if (empty($if_patient)) {
		array_push($campos_vacios, 'Doctors name and address');
	}

	if (count($campos_vacios) > 0) {

		$titulo = 'Error de validación';
		$icono = 'error';
		$mensaje = 'Por favor completa los siguientes campos:';
		$lista = '<ul class="my-3">';
		foreach ($campos_vacios as $campo) {
			$lista .= '<li class="text-start">' . $campo . '</li>';
		}
		$lista .= '</ul>';
		$mensaje .= $lista;

		echo $titulo . ',' . $icono . ',' . $mensaje;
	}
} else {
	$insertar = mysqli_query($conex, "INSERT INTO `ipsen_evento_adverso`(`SOURCE_TYPE`, `DATE_OF_NOTIFICATION`, `PATIENT_INITIALS`, `DATE_OF_BIRTH`, `AGE`, `GENDER`, `WEIGHT`, `HEIGHT`, `TRADE_NAME`, `EXPIRY_DATE`, `SAMPLE_AVAILABLE`, `DOSE`, `FREQUENCY`, `ROUTE_OF_ADMINISTRATION`, `DIAGNOSIS`, `TREATMENT_START_DATE`, `TREATMENT_END_DATE`, `ANY_OTHER_INFORMATION`, `ONSET_DATE`, `EVENT_STOP_DATE`, `DURATION`, `EVENT_ABATED`, `EVENT_TERM`, `REAPPEARED`, `PREVIOUSLY`, `SERIOUSNESS`, `DATE_OF_DEATH`, `AUTOPSY`, `CAUSE_OF_DEATH`, `TREATMENT_FOR_AE`, `TREATMENT_DETAILS`, `OUTCOME`, `LABORATORY_DATA`, `MEDICAL_HISTORY`, `REPORTE_CAUSALITY`, `PATIENT_PREGNANT`, `PATIENT_PREGNANT_YES`, `SPECIAL_SITUATIONS`, `DEFECT_ISSUE`, `REPORTER_NAME`, `PHONE_NUMBER`, `ADDRESS`, `REPORTER_EMAIL`, `PROFESSIONAL`, `OCCUPATION`, `COUNTRY`, `MAH`, `DOCTORS`, `COMPLETED_BY`, `ID_PACIENTE_FK`) VALUES ('$source_type','$first_notification','$initials','$birth','$age_time_event','$gender','$weight','$height','$trade_name','$expiry_date','$sample_available','$dose','$frequency','$route_administration','$diagnosis','$treatment_start_date','$treatment_end_date','$any_other_information','$onset_date','$event_stop_date','$tra_duration','$event_abated','$event_term','$event_reappeared','$previously_been','$seriousness','$death_date','$autopsy','$cause_death','$treatment_for_ae','$treatment_details','$outcome','$laboratory','$medical_history','$reporter_causality','$patient_pregnant','$patient_pregnant_yes','$special_situations','$quiality_defect','$name','$phone_number','$address','$email','$health_care_professional','$occupation_health_authority','COLOMBIA','$mah','$if_patient','$email_user','$codigo_paciente')");
	if ($insertar) {
		$sql = "SELECT MAX(ID_EVENTO_ADVERSO) AS ULTIMO_EVENTO_ADVERSO_ID FROM ipsen_evento_adverso";
		$resultado = mysqli_query($conex, $sql);
		$fila = mysqli_fetch_assoc($resultado);
		$FK_EVENTO_ADVERSO = $fila['ULTIMO_EVENTO_ADVERSO_ID'];

		foreach ($rows as $row) {

			$du = $row['drug'];
			$rue = $row['route'];
			$da_do = $row['daily_dose'];
			$dur = $row['duration'];
			$sta = $row['start'];
			$sto = $row['stop'];
			$indi = $row['indication'];
			$sc = $row['s_or_c'];
			$co_du = $row['company_drug'];

			$inter_medicamentos = mysqli_query($conex, "INSERT INTO `ipsen_informacion_tratamiento_ea`(`DRUG`, `ROUTE`, `DAILY_DOSE`, `DURATION`, `DATE_START`, `DATE_STOP`, `INDICATION`, `S_OR_C`, `COMPANY_DRUG`, `EVENTO_ADVERSO_ID`) VALUES ('$du','$rue','$da_do','$dur','$sta','$sto','$indi','$sc','$co_du','$FK_EVENTO_ADVERSO')");
		}

		if ($inter_medicamentos) {
			$titulo = 'Datos cargados';
			$icono = 'success';
			$mensaje = 'El evento ha sido creado';

			echo $titulo . ',' . $icono . ',' . $mensaje;
		}
	}
}
