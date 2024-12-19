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
        function habilitar1(sel) {
            if (sel.value == "Other") {
                divC = document.getElementById("other_source_type_id");
                divC.style.display = "";
            }
            if (sel.value != "Other") {
                divC = document.getElementById("other_source_type_id");
                divC.style.display = "none";
            }
        }

        function habilitar2(sel) {
            if (sel.value == "YES") {
                divC = document.getElementById("patient_pregnant_yes_id");
                divC.style.display = "";
            }
            if (sel.value != "YES") {
                divC = document.getElementById("patient_pregnant_yes_id");
                divC.style.display = "none";
            }
        }

        function habilitar3(sel) {
            if (sel.value == "Other") {
                divC = document.getElementById("special_situations_specify_id");
                divC.style.display = "";
            }
            if (sel.value != "Other") {
                divC = document.getElementById("special_situations_specify_id");
                divC.style.display = "none";
            }
        }

        function habilitar4(sel) {
            if (sel.value == "Other") {
                divC = document.getElementById("occupation_health_authority_specify_id");
                divC.style.display = "";
            }
            if (sel.value != "Other") {
                divC = document.getElementById("occupation_health_authority_specify_id");
                divC.style.display = "none";
            }
        }

        function habilitar5(sel) {
            if (sel.value == "Other") {
                divC = document.getElementById("occupation_health_authority_specify_id");
                divC.style.display = "";
            }
            if (sel.value != "Other") {
                divC = document.getElementById("occupation_health_authority_specify_id");
                divC.style.display = "none";
            }
        }

        $(document).ready(function() {
            $('input[id="source_type"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_source_type').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="other_source_type"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_source_type').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="sample_available"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_sample_available').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="event_abated"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_event_abated').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="event_reappeared"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_event_reappeared').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="previously_been"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_previously_been').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="seriousness"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_seriousness').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="autopsy"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_autopsy').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="treatment_for_ae"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_treatment_for_ae').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="outcome"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_outcome').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="reporter_causality"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_reporter_causality').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="patient_pregnant"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_patient_pregnant').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="special_situations"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_special_situations').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="special_situations_specify"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_special_situations').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="quiality_defect"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_quiality_defect').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="health_care_professional"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_health_care_professional').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="occupation_health_authority"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_occupation_health_authority').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="occupation_health_authority_specify"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_occupation_health_authority').val(inputValue);
            });
        });

        $(document).ready(function() {
            $('input[id="mah"]').change(function() {
                var inputValue = $(this).val();
                $('#valor_mah').val(inputValue);
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
        $TELEFONO_PACIENTE = $fila['TELEFONO_PACIENTE'];
        $APELLIDO_PACIENTE = $fila['APELLIDO_PACIENTE'];
        $CORREO_PACIENTE = $fila['CORREO_PACIENTE'];
        $DEPARTAMENTO_PACIENTE = $fila['DEPARTAMENTO_PACIENTE'];
        $DIRECCION_PACIENTE = $fila['DIRECCION_PACIENTE'];
        $CIUDAD_PACIENTE = $fila['CIUDAD_PACIENTE'];
        $DOSIS = $fila['DOSIS_TRATAMIENTO'];
        $FRECUENCIA_TRATAMIENTO = $fila['FRECUENCIA_MEDICAMENTO'];
        $FECHA_INICO_TRATAMIENTO = $fila['FECHA_INICIO_TERAPIA_TRATAMIENTO'];
        $PRODUCTO_TRATAMIENTO = $fila['PRODUCTO_TRATAMIENTO'];
        $MEDICO_TRATAMIENTO = $fila['MEDICO_TRATAMIENTO'];
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
    date_default_timezone_set('America/Bogota');
    $fecha_actual = date('Y-m-d');
?>

    <body style="padding: 0; margin: 0;">
        <form>
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
                                    <input type="hidden" name="codigo_paciente" id="codigo_paciente" value="<?php echo $ID_PACIENTE ?>">
                                    <input type="hidden" name="email_user" id="email_user" value="<?php echo $EMAIL ?>">
                                    <input type="hidden" name="name_user" id="name_user" value="<?php echo $NOMBRES . ' ' . $APELLIDOS ?>">
                                    <p style="text-align: left;">
                                        <strong>
                                            SOURCE TYPE:
                                        </strong>
                                    </p>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <!-- <input type="hidden" name="valor_source_type" id="valor_source_type"> -->
                                            <input type="radio" name="source_type" id="source_type" value="Early Access" onchange="habilitar1(this)"> Early Access
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="source_type" id="source_type" value="Patient Support PSP-L-0017" checked onchange="habilitar1(this)"> Patient Support PSP-L-0017
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="source_type" id="source_type" value="Market Research" onchange="habilitar1(this)"> Market Research
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="source_type" id="source_type" value="Other" onchange="habilitar1(this)"> Other
                                        </div>
                                    </div>
                                    <br>
                                    <div style="display: none;" id="other_source_type_id">
                                        <p style="text-align: left;">
                                            <strong>Specify:</strong>
                                            <input type="text" id="other_source_type" name="other_source_type" class="form-control w-80 h-100">
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <div style="text-align: left;">
                                        <strong>Date of First Notification (Day 0)</strong> <input type="date" name="first_notification" id="first_notification" value="<?php echo $fecha_actual ?>" class="form-control w-100 h-100" disabled>
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
                                <td colspan="1" style="vertical-align: top;">
                                    <p style="text-align: left;">1.Patient Initials/Number</p>
                                    <input type="text" id="initials" name="initials" value="<?php echo $result ?>" class="form-control w-100 h-100" disabled>
                                </td>
                                <td colspan="3">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td colspan="2" style="border-radius: 0,5px; border: dotted;">
                                                <p style="text-align: left;">
                                                    2. Date of Birth
                                                </p>
                                                <input type="date" id="birth" name="birth" value="<?php echo $FECHA_NACIMIENTO ?>" class="form-control w-100 h-100" disabled>
                                            </td>
                                            <td colspan="1" style="border-radius: 0,5px; border: dotted;">
                                                <p style="text-align: left;">
                                                    Age at time of event
                                                </p>
                                                <input type="text" id="age_time_event" name="age_time_event" value="<?php echo $EDAD ?>" class="form-control w-100 h-100" disabled>
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

                                <?php if ($GENERO_PACIENTE == 'Mujer') { ?>
                                    <td colspan="1" style="vertical-align: top;">
                                        <p style="text-align: left;">3. Gender </p>
                                        <input type="text" class="form-control w-100 h-100" name="gender" id="gender" value="Female" style="width:90%; height:100%;" disabled>
                                    </td>
                                <?php } else if ($GENERO_PACIENTE == 'Hombre') { ?>
                                    <td colspan="1" style="vertical-align: top;">
                                        <p style="text-align: left;">3. Gender </p>
                                        <input type="text" class="form-control w-100 h-100" name="gender" id="gender" value="Male" style="width:90%; height:100%;" disabled>
                                    </td>
                                <?php } ?>

                                <td colspan="2" style="vertical-align: top;">
                                    <p style="text-align: left;">4. Weight</p>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="text" name="weight" id="weight" class="form-control w-100 h-100">
                                            <input type="text" class="form-control w-10 h-100" value="kg" disabled style="text-align: center;">
                                        </div>
                                    </div>
                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    <p style="text-align: left;">5. Height</p>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="text" name="height" id="height" class="form-control w-100 h-100">
                                            <input type="text" class="form-control w-10 h-100" value="cm" disabled style="text-align: center;">
                                        </div>
                                    </div>
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
                                    <?php
                                    if ($PRODUCTO_TRATAMIENTO == 'Somatuline') {
                                    ?>
                                        <input type="text" name="trade_name" id="trade_name" class="form-control w-100 h-100" value="<?php echo $PRODUCTO_TRATAMIENTO ?> (LANREOTIDE)" disabled>
                                    <?php
                                    } else {
                                    ?>
                                        <input type="text" name="trade_name" id="trade_name" class="form-control w-100 h-100" value="<?php echo $PRODUCTO_TRATAMIENTO ?> (CABOZANTINIB)" disabled>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td colspan="3">
                                    <p style="text-align: left;">
                                        2. Batch No. and Expiry Date
                                    </p>
                                    <input type="text" name="expiry_date" id="expiry_date" class="form-control w-100 h-100">
                                </td>
                                <td colspan="3">
                                    <p style="text-align: left;">
                                        3. Sample Available
                                    </p>
                                    <div class="row">
                                        <div class="col d-flex justify-content-center">
                                            <input type="hidden" name="valor_sample_available" id="valor_sample_available">
                                            <input type="radio" name="sample_available" id="sample_available" value="YES"> Yes
                                        </div>
                                        <div class="col d-flex justify-content-center">
                                            <input type="radio" name="sample_available" id="sample_available" value="NO"> No
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p style="text-align: left;">
                                        4. Dose (specify units)
                                    </p>
                                    <input type="text" name="dose" id="dose" class="form-control w-100 h-100" value="<?php echo $DOSIS ?>" disabled>
                                </td>
                                <td colspan="3">
                                    <p style="text-align: left;">
                                        5. Frequency
                                    </p>
                                    <input type="text" name="frequency" id="frequency" class="form-control w-100 h-100" value="<?php echo $FRECUENCIA_TRATAMIENTO ?>" disabled>
                                </td>
                                <td colspan="3">
                                    <p style="text-align: left;">
                                        6. Route of administration
                                    </p>
                                    <input type="text" name="route_administration" id="route_administration" class="form-control w-100 h-100">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p style="text-align: left;">
                                        7. Diagnosis/Indication
                                    </p>
                                    <input type="text" name="diagnosis" id="diagnosis" class="form-control w-100 h-100" value="<?php echo $CLASIFICACION_PATOLOGICA_TRATAMIENTO ?>" disabled>
                                </td>
                                <td colspan="3">
                                    <p style="text-align: left;">
                                        8. Treatment Start date
                                    </p>
                                    <input type="date" name="treatment_start_date" id="treatment_start_date" class="form-control w-100 h-100" value="<?php echo $FECHA_INICO_TRATAMIENTO ?>" disabled>
                                </td>
                                <td colspan="3">
                                    <p style="text-align: left;">
                                        9. Treatment End date (or mention continuing)
                                    </p>
                                    <input type="text" name="treatment_end_date" id="treatment_end_date" class="form-control w-100 h-100">
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
                                <td colspan="2" style="vertical-align: top;">
                                    <p style="text-align: left;">
                                        1.a <strong>Onset</strong> Date <br>
                                    </p>
                                    <input type="date" name="onset_date" id="onset_date" class="form-control w-100 h-100">
                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    <p style="text-align: left;">
                                        1.b Event <strong>Stop Date (if applicable) or <br> Mention Ongoing</strong>
                                    </p>
                                    <input type="text" name="event_stop_date" id="event_stop_date" class="form-control w-100 h-100">
                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    <p style="text-align: left;">
                                        <strong>
                                            1.c Duration
                                        </strong>
                                    </p>
                                    <input type="text" name="tra_duration" id="tra_duration" class="form-control w-100 h-100">
                                </td>
                                <td colspan="3" style="vertical-align: top;">
                                    <p style="text-align: left;">
                                        1.d Event <strong>abated</strong> after use stopped
                                    </p>
                                    <div class="row">
                                        <div class="col d-flex justify-content-center">
                                            <!-- <input type="hidden" name="valor_event_abated" id="valor_event_abated"> -->
                                            <input type="radio" name="event_abated" id="event_abated" value="NO"> No
                                        </div>
                                        <div class="col d-flex justify-content-center">
                                            <input type="radio" name="event_abated" id="event_abated" value="YES"> Yes
                                        </div>
                                        <div class="col d-flex justify-content-center">
                                            <input type="radio" name="event_abated" id="event_abated" value="N/A" checked> N/A
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="vertical-align: top;">
                                    <p style="text-align: left;">
                                        <strong>1.h Event term</strong> <br>
                                        (full description of the event including body site and severity)
                                    </p>
                                    <textarea name="event_term" id="event_term" class="form-control w-100 h-100" cols="100" rows="20"></textarea>
                                </td>
                                <td colspan="4">
                                    <table class="w-100 h-100">
                                        <tr>
                                            <td>
                                                <p style="text-align: left;">1.e Event <strong>reappeared</strong> after reintroduction</p>
                                                <div class="row">
                                                    <div class="col d-flex justify-content-center">
                                                        <!-- <input type="hidden" name="valor_event_reappeared" id="valor_event_reappeared"> -->
                                                        <input type="radio" name="event_reappeared" id="event_reappeared" value="NO"> No
                                                    </div>
                                                    <div class="col d-flex justify-content-center">
                                                        <input type="radio" name="event_reappeared" id="event_reappeared" value="YES"> Yes
                                                    </div>
                                                    <div class="col d-flex justify-content-center">
                                                        <input type="radio" name="event_reappeared" id="event_reappeared" value="N/A" checked> N/A
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="text-align: left;"> 1.f Has this drug <strong>previously</strong> been used</p>

                                                <div class="row">
                                                    <div class="col d-flex justify-content-center">
                                                        <!-- <input type="hidden" name="valor_previously_been" id="valor_previously_been"> -->
                                                        <input type="radio" name="previously_been" id="previously_been" value="NO"> No
                                                    </div>
                                                    <div class="col d-flex justify-content-center">
                                                        <input type="radio" name="previously_been" id="previously_been" value="YES" checked> Yes
                                                    </div>
                                                    <div class="col d-flex justify-content-center">
                                                        <input type="radio" name="previously_been" id="previously_been" value="N/A"> N/A
                                                    </div>
                                                </div>
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
                                                    <div class="row">
                                                        <div class="col-auto d-flex justify-content-left">
                                                            <input type="hidden" name="valor_seriousness" id="valor_seriousness">
                                                            <input type="radio" name="seriousness" id="seriousness" value="Non serious event"> Non serious event
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-auto d-flex justify-content-left">
                                                            <input type="radio" name="seriousness" id="seriousness" value="Death - Date of death"> Death - Date of death:
                                                        </div>
                                                        <div class="col d-flex justify-content-left">
                                                            <input type="date" name="death_date" id="death_date" class="form-control w-100">
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
                                                                <input type="radio" name="autopsy" id="autopsy" value="YES">Yes
                                                            </div>
                                                            <div class="col d-flex justify-content-center">
                                                                <input type="radio" name="autopsy" id="autopsy" value="NO">No
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col d-flex justify-content-center" style="margin-left: -14%;">
                                                                <span>Cause of Death</span>
                                                            </div>
                                                            <div class="col d-flex justify-content-center">
                                                                <input type="text" name="cause_death" id="cause_death" class="form-control w-100 h-100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="radio" name="seriousness" id="seriousness" value="Life threatening"> Life threatening <br> <br>
                                                    <input type="radio" name="seriousness" id="seriousness" value="Inpatient hospitalisation or prolongation of existing hospitalisation"> Inpatient hospitalisation or prolongation of existing hospitalisation <br> <br>
                                                    <input type="radio" name="seriousness" id="seriousness" value="Persistent or significant disability/Incapacity"> Persistent or significant disability/Incapacity <br> <br>
                                                    <input type="radio" name="seriousness" id="seriousness" value="Congenital anomaly/birth defect"> Congenital anomaly/birth defect <br> <br>
                                                    <input type="radio" name="seriousness" id="seriousness" value="Other Serious (Medically important event)"> Other Serious (Medically important event) <br> <br>
                                                    <input type="radio" name="seriousness" id="seriousness" value="Require intervention (only for devices)"> “Require intervention” (only for devices)
                                                </div>
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
                                            <!-- <input type="hidden" name="valor_treatment_for_ae" id="valor_treatment_for_ae"> -->
                                            <input type="radio" name="treatment_for_ae" id="treatment_for_ae" value="YES"> Yes
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="treatment_for_ae" id="treatment_for_ae" value="NO" checked> No
                                        </div>
                                    </div>
                                    <br>
                                    <p style="text-align: left;">
                                        <strong>
                                            Treatment Details:
                                        </strong>
                                    </p>
                                    <textarea name="treatment_details" id="treatment_details" class="form-control w-100 h-100" cols="90" rows="5"></textarea>
                                </td>
                                <td colspan="5" style="vertical-align: top;">
                                    <p style="text-align: left;">
                                        <strong>
                                            1.h Outcome
                                        </strong>
                                    </p>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="hidden" name="valor_outcome" id="valor_outcome">
                                            <input type="radio" name="outcome" id="outcome" value="Not recovered"> Not recovered
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="outcome" id="outcome" value="Recovering"> Recovering
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="outcome" id="outcome" value="Recovered with sequelae"> Recovered with sequelae
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="outcome" id="outcome" value="Recovered without sequelae"> Recovered without sequelae
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="outcome" id="outcome" value="Unknown"> Unknown
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
                                        <br>
                                        Does the Reporter consider that the event was possibly related to the drug?
                                    </p>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="hidden" name="valor_reporter_causality" id="valor_reporter_causality">
                                            <input type="radio" name="reporter_causality" id="reporter_causality" value="YES"> Yes
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="reporter_causality" id="reporter_causality" value="NO"> No
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="reporter_causality" id="reporter_causality" value="Unknown"> Unknown
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
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="hidden" name="valor_patient_pregnant" id="valor_patient_pregnant">
                                            <input type="radio" name="patient_pregnant" id="patient_pregnant" value="YES" onchange="habilitar2(this)"> Yes
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="patient_pregnant" id="patient_pregnant" value="NO" onchange="habilitar2(this)"> No
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="patient_pregnant" id="patient_pregnant" value="Unknown" onchange="habilitar2(this)"> Unknown
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="patient_pregnant" id="patient_pregnant" value="N/A" onchange="habilitar2(this)"> N/A <br>
                                        </div>
                                    </div>
                                    <br>
                                    <p style="display: none; text-align: left;" id="patient_pregnant_yes_id">If yes, gestation period:
                                        <input type="text" name="patient_pregnant_yes" id="patient_pregnant_yes" class="form-control w-30 h-100"> weeks
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">IV) SPECIAL SITUATIONS</td>
                            </tr>
                            <tr>
                                <td colspan="9">
                                    <div class="row">
                                        <input type="hidden" name="valor_special_situations" id="valor_special_situations">
                                        <div class="col-6 d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Pregnancy (maternal exposure or paternal exposure (including potential alteration of spermatozoids))" onchange="habilitar3(this)"> Pregnancy (maternal exposure or paternal exposure (including potential alteration of spermatozoids))
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Breastfeeding" onchange="habilitar3(this)"> Breastfeeding
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Overdose" onchange="habilitar3(this)"> Overdose
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Misuse" onchange="habilitar3(this)"> Misuse
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Abuse" onchange="habilitar3(this)"> Abuse
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Medication Error" onchange="habilitar3(this)"> Medication Error
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Lack of Efficacy" onchange="habilitar3(this)"> Lack of Efficacy
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Occupational exposure" onchange="habilitar3(this)"> Occupational exposure
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Drug interaction" onchange="habilitar3(this)"> Drug interaction
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Off-label Use" onchange="habilitar3(this)"> Off-label Use
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Suspected transmission of infectious agent" onchange="habilitar3(this)"> Suspected transmission of infectious agent
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Unexpected beneficial event" onchange="habilitar3(this)"> Unexpected beneficial event
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="special_situations" id="special_situations" value="Other" onchange="habilitar3(this)"> Other
                                        </div>
                                    </div>
                                    <br>
                                    <p style="display: none; text-align: left;" id="special_situations_specify_id">
                                        <strong>Specify:</strong>
                                        <input type="text" name="special_situations_specify" id="special_situations_specify" class="form-control w-50 h-100">
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9" class="titulos" style="font-weight: 700; text-align: left;">V) QUALITY DEFECT ISSUE / SUSPECTED FALSIFIED/COUNTERFEIT MEDICINAL PRODUCT</td>
                            </tr>
                            <tr>
                                <td colspan="9">
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="hidden" name="valor_quiality_defect" id="valor_quiality_defect">
                                            <input type="radio" name="quiality_defect" id="quiality_defect" value="Event related to a quality defect issue"> Event related to a quality defect issue
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="quiality_defect" id="quiality_defect" value="Event related to a suspected falsified/counterfeit medicinal product"> Event related to a suspected falsified/counterfeit medicinal product
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
                                    <td colspan="2" style="border: none; padding: 0;">
                                        <div style="display: flex; gap: 5px; padding: 5px">
                                            <div style="flex: 1;">
                                                <input type="text" class="form-control w-100 h-100" name="start[]" id="start">
                                            </div>
                                            <div style="flex: 1;">
                                                <input type="text" class="form-control w-100 h-100" name="stop[]" id="stop">
                                            </div>
                                        </div>
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
                                    <input type="text" name="name" id="name" class="form-control w-100 h-100">
                                </td>
                                <td colspan="2">
                                    <p style="text-align: left;">
                                        <strong>
                                            1.b Phone number
                                        </strong>
                                    </p>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control w-100 h-100" value="<?php echo $TELEFONO_PACIENTE ?>" disabled>
                                </td>
                                <td colspan="2">
                                    <p style="text-align: left;">
                                        <strong>
                                            1.c Address
                                        </strong>
                                    </p>
                                    <input type="text" name="address" id="address" class="form-control w-100 h-100">
                                </td>
                                <td colspan="3">
                                    <p style="text-align: left;">
                                        <strong>
                                            1.d Fax Number/email address
                                        </strong>
                                    </p>
                                    <input type="email" name="email" id="email" class="form-control w-100 h-100" value="<?php echo $CORREO_PACIENTE ?>" disabled>
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
                                                        <!-- <input type="hidden" name="valor_health_care_professional" id="valor_health_care_professional"> -->
                                                        <input type="radio" name="health_care_professional" id="health_care_professional" value="YES"> Yes
                                                    </div>
                                                    <div class="col d-flex justify-content-left">
                                                        <input type="radio" name="health_care_professional" id="health_care_professional" value="NO" checked> No
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
                                                <input type="text" name="reporting_event" id="reporting_event" class="form-control w-100 h-100" value="COLOMBIA" disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td colspan="4" style="vertical-align: top;">
                                    <p style="text-align: left;">
                                        <strong>
                                            3. Profession/Occupation or Health Authority:
                                        </strong>
                                    </p>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="hidden" name="valor_occupation_health_authority" id="valor_occupation_health_authority">
                                            <input type="radio" name="occupation_health_authority" id="occupation_health_authority" value="Doctor" onchange="habilitar4(this)"> Doctor
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="occupation_health_authority" id="occupation_health_authority" value="Nurse" onchange="habilitar4(this)"> Nurse
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="occupation_health_authority" id="occupation_health_authority" value="Pharmacist" onchange="habilitar4(this)"> Pharmacist
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="occupation_health_authority" id="occupation_health_authority" value="Dentist" onchange="habilitar4(this)"> Dentist
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="occupation_health_authority" id="occupation_health_authority" value="Patient" onchange="habilitar4(this)"> Patient
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="occupation_health_authority" id="occupation_health_authority" value="Health Authority" onchange="habilitar4(this)"> Health Authority
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="occupation_health_authority" id="occupation_health_authority" value="Other" onchange="habilitar4(this)"> Other
                                        </div>
                                    </div>
                                    <br>
                                    <div style="display: none; text-align:left;" id="occupation_health_authority_specify_id">
                                        <strong>
                                            Specify:
                                        </strong>
                                        <input type="text" name="occupation_health_authority_specify" id="occupation_health_authority_specify" class="form-control w-100 h-100">
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="vertical-align: top;">
                                    <p style="text-align: left;">
                                        5. As a <strong>MAH</strong>, we have an obligation to collect and report adverse events/safety information with our products to Health Authority to improve patient safety. <br>
                                        Are you willing for Ipsen safety team to contact you/your doctor for further details if required?
                                    </p>
                                    <br>
                                    <div class="row">
                                        <div class="col d-flex justify-content-left">
                                            <input type="hidden" name="valor_mah" id="valor_mah">
                                            <input type="radio" name="mah" id="mah" value="YES"> Yes
                                        </div>
                                        <div class="col d-flex justify-content-left">
                                            <input type="radio" name="mah" id="mah" value="NO"> No
                                        </div>
                                    </div>
                                </td>
                                <td colspan="4" style="vertical-align: top;">
                                    <p style="text-align: left;">
                                        6. If the reporter is a patient, what is their <strong>doctor's name and address?</strong> (complete only if section 5. is ticked Yes)
                                    </p>
                                    <!-- <textarea name="if_patient" id="if_patient" class="form-control w-100 h-100" cols="90" rows="5"></textarea> -->
                                    <input type="text" name="if_patient" id="if_patient" class="form-control w-100 h-100" value="<?php echo $MEDICO_TRATAMIENTO ?>">
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
                                            echo $NOMBRES . ' ' . $APELLIDOS
                                            ?>
                                        </strong> <br> <br>
                                        <strong>
                                            PEOPLE MARKETING
                                        </strong> <br> <br>
                                        <strong style="text-decoration: underline; color: blue;">
                                            <?php echo $EMAIL ?>
                                        </strong>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <strong>
                                            <?php
                                            echo $fecha_actual;
                                            ?>
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
                            <tr>
                                <td colspan="9">
                                    <button type="button" id="boton" onclick="btnSubmit()" class="btn_registrar">
                                        REGISTRAR
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
        <script>
            const botonAgregar = document.querySelector('#btn-agregar');
            const tabla = document.querySelector('#contenedor');

            botonAgregar.addEventListener('click', () => {
                const nuevaFila = document.createElement('tr');
                nuevaFila.innerHTML = `
                <td colspan="1"><input type="text" class="form-control w-100 h-100" class="form-control w-100 h-100" name="drug[]"></td>
                <td colspan="1"><input type="text" class="form-control w-100 h-100" class="form-control w-100 h-100" name="route[]"></td>
                <td colspan="1"><input type="text" class="form-control w-100 h-100" name="daily_dose[]"></td>
                <td colspan="1"><input type="text" class="form-control w-100 h-100" name="duration[]"></td>
                <td colspan="2" style="border: none; padding: 0;">
                    <div style="display: flex; gap: 5px; padding: 5px">
                        <div style="flex: 1;">
                            <input type="text" class="form-control w-100 h-100" name="start[]">
                        </div>
                        <div style="flex: 1;">
                            <input type="text" class="form-control w-100 h-100" name="stop[]">
                        </div>
                    </div>
                </td>
                <td colspan="1"><input type="text" class="form-control w-100 h-100" name="indication[]"></td>
                <td colspan="1">
                    <select class="form-control w-100 h-100" name="s_or_c[]">
                        <option></option>
                        <option value="S">S</option>
                        <option value="C">C</option>
                    </select>
                </td>
                <td colspan="1"><input type="text" class="form-control w-100 h-100" name="company_drug[]"></td>
                <td><button class="eliminar btn btn-danger bg-gradient text-white"><span class="iconify" data-icon="tabler:trash-x-filled" data-width="25"></span></button></td>`;
                tabla.appendChild(nuevaFila);
                document.querySelectorAll('.eliminar').forEach(button => {
                    button.addEventListener('click', () => {
                        button.closest('tr').remove();
                    });
                });
            });

            function btnSubmit() {

                let date = {
                    codigo_paciente: document.getElementById('codigo_paciente').value,
                    email_user: document.getElementById('email_user').value,
                    name_user: document.getElementById('name_user').value,
                    // source_type: document.getElementById('valor_source_type').value,
                    first_notification: document.getElementById('first_notification').value,
                    initials: document.getElementById('initials').value,
                    birth: document.getElementById('birth').value,
                    age_time_event: document.getElementById('age_time_event').value,
                    gender: document.getElementById('gender').value,
                    weight: document.getElementById('weight').value,
                    height: document.getElementById('height').value,
                    trade_name: document.getElementById('trade_name').value,
                    expiry_date: document.getElementById('expiry_date').value,
                    sample_available: document.getElementById('valor_sample_available').value,
                    dose: document.getElementById('dose').value,
                    frequency: document.getElementById('frequency').value,
                    route_administration: document.getElementById('route_administration').value,
                    diagnosis: document.getElementById('diagnosis').value,
                    treatment_start_date: document.getElementById('treatment_start_date').value,
                    treatment_end_date: document.getElementById('treatment_end_date').value,
                    any_other_information: document.getElementById('any_other_information').value,
                    onset_date: document.getElementById('onset_date').value,
                    event_stop_date: document.getElementById('event_stop_date').value,
                    tra_duration: document.getElementById('tra_duration').value,
                    // event_abated: document.getElementById('valor_event_abated').value,
                    event_term: document.getElementById('event_term').value,
                    // event_reappeared: document.getElementById('valor_event_reappeared').value,
                    // previously_been: document.getElementById('valor_previously_been').value,
                    seriousness: document.getElementById('valor_seriousness').value,
                    death_date: document.getElementById('death_date').value,
                    autopsy: document.getElementById('valor_autopsy').value,
                    cause_death: document.getElementById('cause_death').value,
                    // treatment_for_ae: document.getElementById('valor_treatment_for_ae').value,
                    treatment_details: document.getElementById('treatment_details').value,
                    outcome: document.getElementById('valor_outcome').value,
                    laboratory: document.getElementById('laboratory').value,
                    medical_history: document.getElementById('medical_history').value,
                    reporter_causality: document.getElementById('valor_reporter_causality').value,
                    patient_pregnant: document.getElementById('valor_patient_pregnant').value,
                    patient_pregnant_yes: document.getElementById('patient_pregnant_yes').value,
                    // special_situations: document.getElementById('valor_special_situations').value,
                    quiality_defect: document.getElementById('valor_quiality_defect').value,
                    drug: document.getElementById('drug').value,
                    route: document.getElementById('route').value,
                    daily_dose: document.getElementById('daily_dose').value,
                    duration: document.getElementById('duration').value,
                    start: document.getElementById('start').value,
                    stop: document.getElementById('stop').value,
                    indication: document.getElementById('indication').value,
                    s_or_c: document.getElementById('s_or_c').value,
                    company_drug: document.getElementById('company_drug').value,
                    name: document.getElementById('name').value,
                    phone_number: document.getElementById('phone_number').value,
                    address: document.getElementById('address').value,
                    email: document.getElementById('email').value,
                    // health_care_professional: document.getElementById('valor_health_care_professional').value,
                    reporting_event: document.getElementById('reporting_event').value,
                    occupation_health_authority: document.getElementById('valor_occupation_health_authority').value,
                    mah: document.getElementById('valor_mah').value,
                    if_patient: document.getElementById('if_patient').value,
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

                let rows = [];

                const filas = document.querySelectorAll('#contenedor tr');
                filas.forEach(fila => {
                    let row = {
                        drug: fila.querySelector('input[name="drug[]"]').value,
                        route: fila.querySelector('input[name="route[]"]').value,
                        daily_dose: fila.querySelector('input[name="daily_dose[]"]').value,
                        duration: fila.querySelector('input[name="duration[]"]').value,
                        start: fila.querySelector('input[name="start[]"]').value,
                        stop: fila.querySelector('input[name="stop[]"]').value,
                        indication: fila.querySelector('input[name="indication[]"]').value,
                        s_or_c: fila.querySelector('select[name="s_or_c[]"]').value,
                        company_drug: fila.querySelector('input[name="company_drug[]"]').value,
                    }
                    rows.push(row);
                });

                axios.post('../logica/insertar_datos_ea.php', {
                        rows: rows,
                        date: date

                    }).then(function(response) {
                        var respuesta = response.data.split(',');
                        var titulo = respuesta[0];
                        var icono = respuesta[1];
                        var mensaje = respuesta[2];
                        console.log(respuesta);
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

                axios.post('./pdf_new.php', date)
                    .then(function(response) {
                        console.log(response);
                        Swal.fire({
                                title: 'success',
                                html: 'El pdf fue creado',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    Bloquear()
                                    btnConvertWord()
                                }
                            });
                    })
                    .catch(function(error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Por favor consulte con el administrador',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        })
                    });
            }

            function btnConvertWord() {

                let date = {
                    codigo_paciente: document.getElementById('codigo_paciente').value,
                }

                axios.post('./word.php', date)
                    .then(function(response) {
                        console.log(response);
                        Swal.fire({
                                title: 'success',
                                html: 'El word fue creado',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.close();
                                    window.location.reload();
                                }
                            });
                    })
                    .catch(function(error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Por favor consulte con el administrador',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        })
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