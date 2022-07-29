<?php
   include_once('Informe_reclamacion_session.php');
   session_start();
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
    $Ord_Cmp = new Informe_reclamacion_Ord_cmp(); 
    $Ord_Cmp->Ord_cmp_init();
   
class Informe_reclamacion_Ord_cmp
{
function Ord_cmp_init()
{
  global $sc_init, $path_img, $path_btn, $tab_ger_campos, $tab_def_campos, $tab_converte, $tab_labels, $embbed, $tbar_pos, $_POST, $_GET;
   if (isset($_POST['script_case_init']))
   {
       $sc_init    = $_POST['script_case_init'];
       $path_img   = $_POST['path_img'];
       $path_btn   = $_POST['path_btn'];
       $use_alias  = (isset($_POST['use_alias']))  ? $_POST['use_alias']  : "S";
       $fsel_ok    = (isset($_POST['fsel_ok']))    ? $_POST['fsel_ok']    : "";
       $campos_sel = (isset($_POST['campos_sel'])) ? $_POST['campos_sel'] : "";
       $sel_regra  = (isset($_POST['sel_regra']))  ? $_POST['sel_regra']  : "";
       $embbed     = isset($_POST['embbed_groupby']) && 'Y' == $_POST['embbed_groupby'];
       $tbar_pos   = isset($_POST['toolbar_pos']) ? $_POST['toolbar_pos'] : '';
   }
   elseif (isset($_GET['script_case_init']))
   {
       $sc_init    = $_GET['script_case_init'];
       $path_img   = $_GET['path_img'];
       $path_btn   = $_GET['path_btn'];
       $use_alias  = (isset($_GET['use_alias']))  ? $_GET['use_alias']  : "S";
       $fsel_ok    = (isset($_GET['fsel_ok']))    ? $_GET['fsel_ok']    : "";
       $campos_sel = (isset($_GET['campos_sel'])) ? $_GET['campos_sel'] : "";
       $sel_regra  = (isset($_GET['sel_regra']))  ? $_GET['sel_regra']  : "";
       $embbed     = isset($_GET['embbed_groupby']) && 'Y' == $_GET['embbed_groupby'];
       $tbar_pos   = isset($_GET['toolbar_pos']) ? $_GET['toolbar_pos'] : '';
   }
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "es";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $this->Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       include_once($NM_arq_lang);
   }
   
   $tab_ger_campos = array();
   $tab_def_campos = array();
   $tab_labels     = array();
   $tab_ger_campos['bayer_pacientes_id_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_id_paciente'] = "bayer_pacientes_id_paciente";
       $tab_converte["bayer_pacientes_id_paciente"]   = "bayer_pacientes_id_paciente";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_id_paciente'] = "bayer_pacientes.ID_PACIENTE";
       $tab_converte["bayer_pacientes.ID_PACIENTE"]   = "bayer_pacientes_id_paciente";
   }
   $tab_labels["bayer_pacientes_id_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_id_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_id_paciente"] : "ID PACIENTE";
   $tab_ger_campos['bayer_gestiones_logro_comunicacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_logro_comunicacion_gestion'] = "cmp_maior_30_1";
       $tab_converte["cmp_maior_30_1"]   = "bayer_gestiones_logro_comunicacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_logro_comunicacion_gestion'] = "bayer_gestiones.LOGRO_COMUNICACION_GESTION";
       $tab_converte["bayer_gestiones.LOGRO_COMUNICACION_GESTION"]   = "bayer_gestiones_logro_comunicacion_gestion";
   }
   $tab_labels["bayer_gestiones_logro_comunicacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_logro_comunicacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_logro_comunicacion_gestion"] : "LOGRO COMUNICACION GESTION";
   $tab_ger_campos['bayer_gestiones_fecha_comunicacion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_fecha_comunicacion'] = "cmp_maior_30_2";
       $tab_converte["cmp_maior_30_2"]   = "bayer_gestiones_fecha_comunicacion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_fecha_comunicacion'] = "bayer_gestiones.FECHA_COMUNICACION";
       $tab_converte["bayer_gestiones.FECHA_COMUNICACION"]   = "bayer_gestiones_fecha_comunicacion";
   }
   $tab_labels["bayer_gestiones_fecha_comunicacion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_fecha_comunicacion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_fecha_comunicacion"] : "FECHA COMUNICACION";
   $tab_ger_campos['bayer_gestiones_autor_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_autor_gestion'] = "bayer_gestiones_autor_gestion";
       $tab_converte["bayer_gestiones_autor_gestion"]   = "bayer_gestiones_autor_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_autor_gestion'] = "bayer_gestiones.AUTOR_GESTION";
       $tab_converte["bayer_gestiones.AUTOR_GESTION"]   = "bayer_gestiones_autor_gestion";
   }
   $tab_labels["bayer_gestiones_autor_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_autor_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_autor_gestion"] : "AUTOR GESTION";
   $tab_ger_campos['bayer_pacientes_departamento_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_departamento_paciente'] = "cmp_maior_30_3";
       $tab_converte["cmp_maior_30_3"]   = "bayer_pacientes_departamento_paciente";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_departamento_paciente'] = "bayer_pacientes.DEPARTAMENTO_PACIENTE";
       $tab_converte["bayer_pacientes.DEPARTAMENTO_PACIENTE"]   = "bayer_pacientes_departamento_paciente";
   }
   $tab_labels["bayer_pacientes_departamento_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_departamento_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_departamento_paciente"] : "DEPARTAMENTO PACIENTE";
   $tab_ger_campos['bayer_pacientes_ciudad_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_ciudad_paciente'] = "cmp_maior_30_4";
       $tab_converte["cmp_maior_30_4"]   = "bayer_pacientes_ciudad_paciente";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_ciudad_paciente'] = "bayer_pacientes.CIUDAD_PACIENTE";
       $tab_converte["bayer_pacientes.CIUDAD_PACIENTE"]   = "bayer_pacientes_ciudad_paciente";
   }
   $tab_labels["bayer_pacientes_ciudad_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_ciudad_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_ciudad_paciente"] : "CIUDAD PACIENTE";
   $tab_ger_campos['bayer_pacientes_estado_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_estado_paciente'] = "cmp_maior_30_5";
       $tab_converte["cmp_maior_30_5"]   = "bayer_pacientes_estado_paciente";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_estado_paciente'] = "bayer_pacientes.ESTADO_PACIENTE";
       $tab_converte["bayer_pacientes.ESTADO_PACIENTE"]   = "bayer_pacientes_estado_paciente";
   }
   $tab_labels["bayer_pacientes_estado_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_estado_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_estado_paciente"] : "ESTADO PACIENTE";
   $tab_ger_campos['bayer_pacientes_status_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_status_paciente'] = "cmp_maior_30_6";
       $tab_converte["cmp_maior_30_6"]   = "bayer_pacientes_status_paciente";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_status_paciente'] = "bayer_pacientes.STATUS_PACIENTE";
       $tab_converte["bayer_pacientes.STATUS_PACIENTE"]   = "bayer_pacientes_status_paciente";
   }
   $tab_labels["bayer_pacientes_status_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_status_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_status_paciente"] : "STATUS PACIENTE";
   $tab_ger_campos['bayer_pacientes_fecha_activacion_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_fecha_activacion_paciente'] = "cmp_maior_30_7";
       $tab_converte["cmp_maior_30_7"]   = "bayer_pacientes_fecha_activacion_paciente";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_fecha_activacion_paciente'] = "bayer_pacientes.FECHA_ACTIVACION_PACIENTE";
       $tab_converte["bayer_pacientes.FECHA_ACTIVACION_PACIENTE"]   = "bayer_pacientes_fecha_activacion_paciente";
   }
   $tab_labels["bayer_pacientes_fecha_activacion_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_fecha_activacion_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_fecha_activacion_paciente"] : "FECHA ACTIVACION PACIENTE";
   $tab_ger_campos['bayer_pacientes_fecha_retiro_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_fecha_retiro_paciente'] = "cmp_maior_30_8";
       $tab_converte["cmp_maior_30_8"]   = "bayer_pacientes_fecha_retiro_paciente";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_fecha_retiro_paciente'] = "bayer_pacientes.FECHA_RETIRO_PACIENTE";
       $tab_converte["bayer_pacientes.FECHA_RETIRO_PACIENTE"]   = "bayer_pacientes_fecha_retiro_paciente";
   }
   $tab_labels["bayer_pacientes_fecha_retiro_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_fecha_retiro_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_fecha_retiro_paciente"] : "FECHA RETIRO PACIENTE";
   $tab_ger_campos['bayer_pacientes_motivo_retiro_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_motivo_retiro_paciente'] = "cmp_maior_30_9";
       $tab_converte["cmp_maior_30_9"]   = "bayer_pacientes_motivo_retiro_paciente";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_motivo_retiro_paciente'] = "bayer_pacientes.MOTIVO_RETIRO_PACIENTE";
       $tab_converte["bayer_pacientes.MOTIVO_RETIRO_PACIENTE"]   = "bayer_pacientes_motivo_retiro_paciente";
   }
   $tab_labels["bayer_pacientes_motivo_retiro_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_motivo_retiro_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_motivo_retiro_paciente"] : "MOTIVO RETIRO PACIENTE";
   $tab_ger_campos['bayer_tratamiento_fecha_inicio_terapia_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_fecha_inicio_terapia_tratamiento'] = "cmp_maior_30_10";
       $tab_converte["cmp_maior_30_10"]   = "bayer_tratamiento_fecha_inicio_terapia_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_fecha_inicio_terapia_tratamiento'] = "bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO"]   = "bayer_tratamiento_fecha_inicio_terapia_tratamiento";
   }
   $tab_labels["bayer_tratamiento_fecha_inicio_terapia_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_fecha_inicio_terapia_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_fecha_inicio_terapia_tratamiento"] : "FECHA INICIO TERAPIA TRATAMIENTO";
   $tab_ger_campos['bayer_pacientes_codigo_xofigo'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_codigo_xofigo'] = "bayer_pacientes_codigo_xofigo";
       $tab_converte["bayer_pacientes_codigo_xofigo"]   = "bayer_pacientes_codigo_xofigo";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_codigo_xofigo'] = "bayer_pacientes.CODIGO_XOFIGO";
       $tab_converte["bayer_pacientes.CODIGO_XOFIGO"]   = "bayer_pacientes_codigo_xofigo";
   }
   $tab_labels["bayer_pacientes_codigo_xofigo"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_codigo_xofigo"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_codigo_xofigo"] : "CODIGO XOFIGO";
   $tab_ger_campos['bayer_tratamiento_clasificacion_patologica_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_clasificacion_patologica_tratamiento'] = "cmp_maior_30_11";
       $tab_converte["cmp_maior_30_11"]   = "bayer_tratamiento_clasificacion_patologica_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_clasificacion_patologica_tratamiento'] = "bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO"]   = "bayer_tratamiento_clasificacion_patologica_tratamiento";
   }
   $tab_labels["bayer_tratamiento_clasificacion_patologica_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_clasificacion_patologica_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_clasificacion_patologica_tratamiento"] : "CLASIFICACION PATOLOGICA TRATAMIENTO";
   $tab_ger_campos['bayer_tratamiento_producto_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_producto_tratamiento'] = "cmp_maior_30_12";
       $tab_converte["cmp_maior_30_12"]   = "bayer_tratamiento_producto_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_producto_tratamiento'] = "bayer_tratamiento.PRODUCTO_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.PRODUCTO_TRATAMIENTO"]   = "bayer_tratamiento_producto_tratamiento";
   }
   $tab_labels["bayer_tratamiento_producto_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_producto_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_producto_tratamiento"] : "PRODUCTO TRATAMIENTO";
   $tab_ger_campos['bayer_tratamiento_nombre_referencia'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_nombre_referencia'] = "cmp_maior_30_13";
       $tab_converte["cmp_maior_30_13"]   = "bayer_tratamiento_nombre_referencia";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_nombre_referencia'] = "bayer_tratamiento.NOMBRE_REFERENCIA";
       $tab_converte["bayer_tratamiento.NOMBRE_REFERENCIA"]   = "bayer_tratamiento_nombre_referencia";
   }
   $tab_labels["bayer_tratamiento_nombre_referencia"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_nombre_referencia"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_nombre_referencia"] : "NOMBRE REFERENCIA";
   $tab_ger_campos['bayer_tratamiento_dosis_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_dosis_tratamiento'] = "cmp_maior_30_14";
       $tab_converte["cmp_maior_30_14"]   = "bayer_tratamiento_dosis_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_dosis_tratamiento'] = "bayer_tratamiento.DOSIS_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.DOSIS_TRATAMIENTO"]   = "bayer_tratamiento_dosis_tratamiento";
   }
   $tab_labels["bayer_tratamiento_dosis_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_dosis_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_dosis_tratamiento"] : "DOSIS TRATAMIENTO";
   $tab_ger_campos['bayer_gestiones_fecha_medicamento_hasta'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_fecha_medicamento_hasta'] = "cmp_maior_30_15";
       $tab_converte["cmp_maior_30_15"]   = "bayer_gestiones_fecha_medicamento_hasta";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_fecha_medicamento_hasta'] = "bayer_gestiones.FECHA_MEDICAMENTO_HASTA";
       $tab_converte["bayer_gestiones.FECHA_MEDICAMENTO_HASTA"]   = "bayer_gestiones_fecha_medicamento_hasta";
   }
   $tab_labels["bayer_gestiones_fecha_medicamento_hasta"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_fecha_medicamento_hasta"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_fecha_medicamento_hasta"] : "MEDICAMENTO HASTA";
   $tab_ger_campos['bayer_gestiones_numero_cajas'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_numero_cajas'] = "bayer_gestiones_numero_cajas";
       $tab_converte["bayer_gestiones_numero_cajas"]   = "bayer_gestiones_numero_cajas";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_numero_cajas'] = "bayer_gestiones.NUMERO_CAJAS";
       $tab_converte["bayer_gestiones.NUMERO_CAJAS"]   = "bayer_gestiones_numero_cajas";
   }
   $tab_labels["bayer_gestiones_numero_cajas"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_numero_cajas"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_numero_cajas"] : "NUMERO CAJAS";
   $tab_ger_campos['bayer_tratamiento_asegurador_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_asegurador_tratamiento'] = "cmp_maior_30_16";
       $tab_converte["cmp_maior_30_16"]   = "bayer_tratamiento_asegurador_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_asegurador_tratamiento'] = "bayer_tratamiento.ASEGURADOR_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.ASEGURADOR_TRATAMIENTO"]   = "bayer_tratamiento_asegurador_tratamiento";
   }
   $tab_labels["bayer_tratamiento_asegurador_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_asegurador_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_asegurador_tratamiento"] : "ASEGURADOR TRATAMIENTO";
   $tab_ger_campos['bayer_tratamiento_operador_logistico_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_operador_logistico_tratamiento'] = "cmp_maior_30_17";
       $tab_converte["cmp_maior_30_17"]   = "bayer_tratamiento_operador_logistico_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_operador_logistico_tratamiento'] = "bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO"]   = "bayer_tratamiento_operador_logistico_tratamiento";
   }
   $tab_labels["bayer_tratamiento_operador_logistico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_operador_logistico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_operador_logistico_tratamiento"] : "OPERADOR LOGISTICO TRATAMIENTO";
   $tab_ger_campos['bayer_tratamiento_punto_entrega'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_punto_entrega'] = "cmp_maior_30_18";
       $tab_converte["cmp_maior_30_18"]   = "bayer_tratamiento_punto_entrega";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_punto_entrega'] = "bayer_tratamiento.PUNTO_ENTREGA";
       $tab_converte["bayer_tratamiento.PUNTO_ENTREGA"]   = "bayer_tratamiento_punto_entrega";
   }
   $tab_labels["bayer_tratamiento_punto_entrega"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_punto_entrega"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_punto_entrega"] : "PUNTO ENTREGA";
   $tab_ger_campos['bayer_tratamiento_ips_atiende_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_ips_atiende_tratamiento'] = "cmp_maior_30_19";
       $tab_converte["cmp_maior_30_19"]   = "bayer_tratamiento_ips_atiende_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_ips_atiende_tratamiento'] = "bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO"]   = "bayer_tratamiento_ips_atiende_tratamiento";
   }
   $tab_labels["bayer_tratamiento_ips_atiende_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_ips_atiende_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_ips_atiende_tratamiento"] : "IPS";
   $tab_ger_campos['bayer_tratamiento_regimen_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_regimen_tratamiento'] = "cmp_maior_30_20";
       $tab_converte["cmp_maior_30_20"]   = "bayer_tratamiento_regimen_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_regimen_tratamiento'] = "bayer_tratamiento.REGIMEN_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.REGIMEN_TRATAMIENTO"]   = "bayer_tratamiento_regimen_tratamiento";
   }
   $tab_labels["bayer_tratamiento_regimen_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_regimen_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_regimen_tratamiento"] : "REGIMEN TRATAMIENTO";
   $tab_ger_campos['bayer_tratamiento_medico_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_medico_tratamiento'] = "cmp_maior_30_21";
       $tab_converte["cmp_maior_30_21"]   = "bayer_tratamiento_medico_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_medico_tratamiento'] = "bayer_tratamiento.MEDICO_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.MEDICO_TRATAMIENTO"]   = "bayer_tratamiento_medico_tratamiento";
   }
   $tab_labels["bayer_tratamiento_medico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_medico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_medico_tratamiento"] : "MEDICO TRATAMIENTO";
   $tab_ger_campos['bayer_tratamiento_tratamiento_previo'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_tratamiento_previo'] = "cmp_maior_30_22";
       $tab_converte["cmp_maior_30_22"]   = "bayer_tratamiento_tratamiento_previo";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_tratamiento_previo'] = "bayer_tratamiento.TRATAMIENTO_PREVIO";
       $tab_converte["bayer_tratamiento.TRATAMIENTO_PREVIO"]   = "bayer_tratamiento_tratamiento_previo";
   }
   $tab_labels["bayer_tratamiento_tratamiento_previo"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_tratamiento_previo"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_tratamiento_previo"] : "TRATAMIENTO PREVIO";
   $tab_ger_campos['bayer_gestiones_reclamo_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_reclamo_gestion'] = "cmp_maior_30_23";
       $tab_converte["cmp_maior_30_23"]   = "bayer_gestiones_reclamo_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_reclamo_gestion'] = "bayer_gestiones.RECLAMO_GESTION";
       $tab_converte["bayer_gestiones.RECLAMO_GESTION"]   = "bayer_gestiones_reclamo_gestion";
   }
   $tab_labels["bayer_gestiones_reclamo_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_reclamo_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_reclamo_gestion"] : "RECLAMO GESTION";
   $tab_ger_campos['bayer_gestiones_fecha_reclamacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_fecha_reclamacion_gestion'] = "cmp_maior_30_24";
       $tab_converte["cmp_maior_30_24"]   = "bayer_gestiones_fecha_reclamacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_fecha_reclamacion_gestion'] = "bayer_gestiones.FECHA_RECLAMACION_GESTION";
       $tab_converte["bayer_gestiones.FECHA_RECLAMACION_GESTION"]   = "bayer_gestiones_fecha_reclamacion_gestion";
   }
   $tab_labels["bayer_gestiones_fecha_reclamacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_fecha_reclamacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_fecha_reclamacion_gestion"] : "FECHA RECLAMACION GESTION";
   $tab_ger_campos['bayer_gestiones_causa_no_reclamacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_causa_no_reclamacion_gestion'] = "cmp_maior_30_25";
       $tab_converte["cmp_maior_30_25"]   = "bayer_gestiones_causa_no_reclamacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_causa_no_reclamacion_gestion'] = "bayer_gestiones.CAUSA_NO_RECLAMACION_GESTION";
       $tab_converte["bayer_gestiones.CAUSA_NO_RECLAMACION_GESTION"]   = "bayer_gestiones_causa_no_reclamacion_gestion";
   }
   $tab_labels["bayer_gestiones_causa_no_reclamacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_causa_no_reclamacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_causa_no_reclamacion_gestion"] : "CAUSA NO RECLAMACION GESTION";
   $tab_ger_campos['bayer_gestiones_descripcion_comunicacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_descripcion_comunicacion_gestion'] = "cmp_maior_30_26";
       $tab_converte["cmp_maior_30_26"]   = "bayer_gestiones_descripcion_comunicacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_descripcion_comunicacion_gestion'] = "bayer_gestiones.DESCRIPCION_COMUNICACION_GESTION";
       $tab_converte["bayer_gestiones.DESCRIPCION_COMUNICACION_GESTION"]   = "bayer_gestiones_descripcion_comunicacion_gestion";
   }
   $tab_labels["bayer_gestiones_descripcion_comunicacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_descripcion_comunicacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_descripcion_comunicacion_gestion"] : "DESCRIPCION COMUNICACION GESTION";
   $tab_ger_campos['bayer_gestiones_fecha_programada_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_fecha_programada_gestion'] = "cmp_maior_30_27";
       $tab_converte["cmp_maior_30_27"]   = "bayer_gestiones_fecha_programada_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_fecha_programada_gestion'] = "bayer_gestiones.FECHA_PROGRAMADA_GESTION";
       $tab_converte["bayer_gestiones.FECHA_PROGRAMADA_GESTION"]   = "bayer_gestiones_fecha_programada_gestion";
   }
   $tab_labels["bayer_gestiones_fecha_programada_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_fecha_programada_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_fecha_programada_gestion"] : "FECHA PROGRAMADA GESTION";
   $tab_ger_campos['bayer_pacientes_id_ultima_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_pacientes_id_ultima_gestion'] = "cmp_maior_30_28";
       $tab_converte["cmp_maior_30_28"]   = "bayer_pacientes_id_ultima_gestion";
   }
   else
   {
       $tab_def_campos['bayer_pacientes_id_ultima_gestion'] = "bayer_pacientes.ID_ULTIMA_GESTION";
       $tab_converte["bayer_pacientes.ID_ULTIMA_GESTION"]   = "bayer_pacientes_id_ultima_gestion";
   }
   $tab_labels["bayer_pacientes_id_ultima_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_id_ultima_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_pacientes_id_ultima_gestion"] : "ID ULTIMA GESTION";
   $tab_ger_campos['bayer_tratamiento_id_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_id_tratamiento'] = "cmp_maior_30_29";
       $tab_converte["cmp_maior_30_29"]   = "bayer_tratamiento_id_tratamiento";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_id_tratamiento'] = "bayer_tratamiento.ID_TRATAMIENTO";
       $tab_converte["bayer_tratamiento.ID_TRATAMIENTO"]   = "bayer_tratamiento_id_tratamiento";
   }
   $tab_labels["bayer_tratamiento_id_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_id_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_id_tratamiento"] : "ID TRATAMIENTO";
   $tab_ger_campos['bayer_tratamiento_id_paciente_fk'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_tratamiento_id_paciente_fk'] = "cmp_maior_30_30";
       $tab_converte["cmp_maior_30_30"]   = "bayer_tratamiento_id_paciente_fk";
   }
   else
   {
       $tab_def_campos['bayer_tratamiento_id_paciente_fk'] = "bayer_tratamiento.ID_PACIENTE_FK";
       $tab_converte["bayer_tratamiento.ID_PACIENTE_FK"]   = "bayer_tratamiento_id_paciente_fk";
   }
   $tab_labels["bayer_tratamiento_id_paciente_fk"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_id_paciente_fk"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_tratamiento_id_paciente_fk"] : "ID PACIENTE FK";
   $tab_ger_campos['bayer_gestiones_paap'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_paap'] = "bayer_gestiones_paap";
       $tab_converte["bayer_gestiones_paap"]   = "bayer_gestiones_paap";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_paap'] = "bayer_gestiones.PAAP";
       $tab_converte["bayer_gestiones.PAAP"]   = "bayer_gestiones_paap";
   }
   $tab_labels["bayer_gestiones_paap"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_paap"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_paap"] : "PAAP";
   $tab_ger_campos['bayer_gestiones_sub_paap'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_sub_paap'] = "bayer_gestiones_sub_paap";
       $tab_converte["bayer_gestiones_sub_paap"]   = "bayer_gestiones_sub_paap";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_sub_paap'] = "bayer_gestiones.SUB_PAAP";
       $tab_converte["bayer_gestiones.SUB_PAAP"]   = "bayer_gestiones_sub_paap";
   }
   $tab_labels["bayer_gestiones_sub_paap"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_sub_paap"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_sub_paap"] : "SUB PAAP";
   $tab_ger_campos['bayer_gestiones_barrera'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_barrera'] = "bayer_gestiones_barrera";
       $tab_converte["bayer_gestiones_barrera"]   = "bayer_gestiones_barrera";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_barrera'] = "bayer_gestiones.BARRERA";
       $tab_converte["bayer_gestiones.BARRERA"]   = "bayer_gestiones_barrera";
   }
   $tab_labels["bayer_gestiones_barrera"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_barrera"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["bayer_gestiones_barrera"] : "BARRERA";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'] = array();
   }
   
   if ($fsel_ok == "cmp")
   {
       $this->Sel_processa_out_sel($campos_sel);
   }
   else
   {
       if ($embbed)
       {
           ob_start();
           $this->Sel_processa_form();
           $Temp = ob_get_clean();
           echo NM_charset_to_utf8($Temp);
       }
       else
       {
           $this->Sel_processa_form();
       }
   }
   exit;
   
}
function Sel_processa_out_sel($campos_sel)
{
   global $tab_ger_campos, $sc_init, $tab_def_campos, $tab_converte, $embbed;
   $arr_temp = array();
   $campos_sel = explode("@?@", $campos_sel);
   $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_converte[$campo]))
       {
           $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'][$campo] = $ordem;
       }
   }
?>
    <script language="javascript"> 
<?php
   if (!$embbed)
   {
?>
      self.parent.tb_remove(); 
      parent.nm_gp_submit_ajax('inicio', ''); 
<?php
   }
   else
   {
?>
      nm_gp_submit_ajax('inicio', ''); 
<?php
   }
?>
   </script>
<?php
}
   
function Sel_processa_form()
{
  global $sc_init, $path_img, $path_btn, $tab_ger_campos, $tab_def_campos, $tab_converte, $tab_labels, $embbed, $tbar_pos;
   $size = 10;
   $_SESSION['scriptcase']['charset']  = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "ISO-8859-1";
   foreach ($this->Nm_lang as $ind => $dados)
   {
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
      {
          $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
          $this->Nm_lang[$ind] = $dados;
      }
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
      {
          $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
   }
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc8_Turquoise/Sc8_Turquoise";
   include("../_lib/css/" . $str_schema_all . "_grid.php");
   $Str_btn_grid = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
   include("../_lib/buttons/" . $Str_btn_grid);
   if (!function_exists("nmButtonOutput"))
   {
       include_once("../_lib/lib/php/nm_gp_config_btn.php");
   }
   if (!$embbed)
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Informe Reclamaciones</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" /> 
</HEAD>
<BODY class="scGridPage" style="margin: 0px; overflow-x: hidden">
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>
<?php
   }
?>
<script language="javascript"> 
<?php
if ($embbed)
{
?>
  function scSubmitOrderCampos(sPos, sType) {
    $("#id_fsel_ok_sel_ord").val(sType);
    if(sType == 'cmp')
    {
       scPackSelectedOrd();
    }
   $.ajax({
    type: "POST",
    url: "Informe_reclamacion_order_campos.php",
    data: {
     script_case_init: $("#id_script_case_init_sel_ord").val(),
     script_case_session: $("#id_script_case_session_sel_ord").val(),
     path_img: $("#id_path_img_sel_ord").val(),
     path_btn: $("#id_path_btn_sel_ord").val(),
     campos_sel: $("#id_campos_sel_sel_ord").val(),
     sel_regra: $("#id_sel_regra_sel_ord").val(),
     fsel_ok: $("#id_fsel_ok_sel_ord").val(),
     embbed_groupby: 'Y'
    }
   }).success(function(data) {
    $("#sc_id_order_campos_placeholder_" + sPos).find("td").html(data);
    scBtnOrderCamposHide(sPos);
   });
  }
<?php
}
?>
 // Submeter o formularior
 //-------------------------------------
 function submit_form_Fsel_ord()
 {
     scPackSelectedOrd();
      document.Fsel_ord.submit();
 }
 function scPackSelectedOrd() {
  var fieldList, fieldName, i, selectedFields = new Array;
 fieldList = $("#sc_id_fldord_selected").sortable("toArray");
 for (i = 0; i < fieldList.length; i++) {
  fieldName  = fieldList[i].substr(14);
  selectedFields.push($("#sc_id_class_" + fieldName).val() + fieldName);
 }
 $("#id_campos_sel_sel_ord").val( selectedFields.join("@?@") );
 }
 </script>
<FORM name="Fsel_ord" method="POST">
  <INPUT type="hidden" name="script_case_init"    id="id_script_case_init_sel_ord"    value="<?php echo NM_encode_input($sc_init); ?>"> 
  <INPUT type="hidden" name="script_case_session" id="id_script_case_session_sel_ord" value="<?php echo NM_encode_input(session_id()); ?>"> 
  <INPUT type="hidden" name="path_img"            id="id_path_img_sel_ord"            value="<?php echo NM_encode_input($path_img); ?>"> 
  <INPUT type="hidden" name="path_btn"            id="id_path_btn_sel_ord"            value="<?php echo NM_encode_input($path_btn); ?>"> 
  <INPUT type="hidden" name="fsel_ok"             id="id_fsel_ok_sel_ord"             value=""> 
<?php
if ($embbed)
{
    echo "<div class='scAppDivMoldura'>";
    echo "<table id=\"main_table\" style=\"width: 100%\" cellspacing=0 cellpadding=0>";
}
elseif ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; right: 20px\">";
}
else
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; left: 20px\">";
}
?>
<?php
if (!$embbed)
{
?>
<tr>
<td>
<div class="scGridBorder">
<table width='100%' cellspacing=0 cellpadding=0>
<?php
}
?>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivHeader scAppDivHeaderText':'scGridLabelVert'; ?>">
   <?php echo $this->Nm_lang['lang_btns_sort_hint']; ?>
  </td>
 </tr>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>">
   <table class="<?php echo ($embbed)? '':'scGridTabela'; ?>" style="border-width: 0; border-collapse: collapse; width:100%;" cellspacing=0 cellpadding=0>
    <tr class="<?php echo ($embbed)? '':'scGridFieldOddVert'; ?>">
     <td style="vertical-align: top">
     <table>
   <tr><td style="vertical-align: top">
 <script language="javascript" type="text/javascript">
  $(function() {
   $(".sc_ui_litem").mouseover(function() {
    $(this).css("cursor", "all-scroll");
   });
   $("#sc_id_fldord_available").sortable({
    connectWith: ".sc_ui_fldord_selected",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var fieldName = $(ui.item[0]).find("select").attr("id");
     $("#" + fieldName).show();
     $('#f_sel_sub').css('display', 'inline-block');
    }
   }).disableSelection();
   $("#sc_id_fldord_selected").sortable({
    connectWith: ".sc_ui_fldord_available",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var fieldName = $(ui.item[0]).find("select").attr("id");
     $("#" + fieldName).hide();
     $('#f_sel_sub').css('display', 'inline-block');
    }
   });
   scUpdateListHeight();
  });
  function scUpdateListHeight() {
   $("#sc_id_fldord_available").css("min-height", "<?php echo sizeof($tab_ger_campos) * 35 ?>px");
   $("#sc_id_fldord_selected").css("min-height", "<?php echo sizeof($tab_ger_campos) * 35 ?>px");
  }
 </script>
 <style type="text/css">
  .sc_ui_sortable_ord {
   list-style-type: none;
   margin: 0;
   min-width: 225px;
  }
  .sc_ui_sortable_ord li {
   margin: 0 3px 3px 3px;
   padding: 1px 3px 1px 15px;
   min-height: 28px;
  }
  .sc_ui_sortable_ord li span {
   position: absolute;
   margin-left: -1.3em;
  }
 </style>
    <ul class="sc_ui_sort_groupby sc_ui_sortable_ord sc_ui_fldord_available scAppDivSelectFields" id="sc_id_fldord_available">
<?php
   foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
   {
       if ($NM_cada_opc != "none")
       {
           if (!isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'][$tab_def_campos[$NM_cada_field]]))
           {
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemord_<?php echo NM_encode_input($tab_def_campos[$NM_cada_field]); ?>">
      <?php echo $tab_labels[$NM_cada_field]; ?>
      <select id="sc_id_class_<?php echo NM_encode_input($tab_def_campos[$NM_cada_field]); ?>" class="scAppDivToolbarInput" style="display: none">
       <option value="+">Asc</option>
       <option value="-">Desc</option>
      </select><br/>
     </li>
<?php
           }
       }
   }
?>
    </ul>
   </td>
   <td style="vertical-align: top">
    <ul class="sc_ui_sort_groupby sc_ui_sortable_ord sc_ui_fldord_selected scAppDivSelectFields" id="sc_id_fldord_selected">
<?php
   foreach ($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'] as $NM_cada_field => $NM_cada_opc)
   {
       if (isset($tab_converte[$NM_cada_field]))
       {
           $sAscSelected  = " selected";
           $sDescSelected = "";
           if ($NM_cada_opc == "desc")
           {
               $sAscSelected  = "";
               $sDescSelected = " selected";
           }
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemord_<?php echo $NM_cada_field; ?>">
      <?php echo $tab_labels[$tab_converte[$NM_cada_field]]; ?>
      <select id="sc_id_class_<?php echo NM_encode_input($tab_def_campos[ $tab_converte[$NM_cada_field] ]); ?>" class="scAppDivToolbarInput" onchange="$('#f_sel_sub').css('display', 'inline-block');">
       <option value="+"<?php echo $sAscSelected; ?>>Asc</option>
       <option value="-"<?php echo $sDescSelected; ?>>Desc</option>
      </select>
     </li>
<?php
       }
   }
?>
    </ul>
    <input type="hidden" name="campos_sel" id="id_campos_sel_sel_ord" value="">
   </td>
   </tr>
   </table>
   </td>
   </tr>
   </table>
  </td>
 </tr>
   <tr><td class="<?php echo ($embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>">
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bok", "document.Fsel_ord.fsel_ok.value='cmp';submit_form_Fsel_ord()", "document.Fsel_ord.fsel_ok.value='cmp';submit_form_Fsel_ord()", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bapply", "scSubmitOrderCampos('" . NM_encode_input($tbar_pos) . "', 'cmp')", "scSubmitOrderCampos('" . NM_encode_input($tbar_pos) . "', 'cmp')", "f_sel_sub", "", "", "display: none;", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp;
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bsair", "self.parent.tb_remove()", "self.parent.tb_remove()", "Bsair", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "')", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "')", "Bsair", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
   </td>
   </tr>
<?php
if (!$embbed)
{
?>
</table>
</div>
</td>
</tr>
<?php
}
?>
</table>
<?php
if ($embbed)
{
?>
    </div>
<?php
}
?>
</FORM>
<script language="javascript"> 
var bFixed = false;
function ajusta_window_Fsel_ord()
{
<?php
   if ($embbed)
   {
?>
  return false;
<?php
   }
?>
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window_Fsel_ord()", 50);
    return;
  }
  else if(!bFixed)
  {
    var oOrig = $(document.Fsel_ord.sel_orig),
        oDest = $(document.Fsel_ord.sel_dest),
        mHeight = Math.max(oOrig.height(), oDest.height()),
        mWidth = Math.max(oOrig.width() + 5, oDest.width() + 5);
    oOrig.height(mHeight);
    oOrig.width(mWidth);
    oDest.height(mHeight);
    oDest.width(mWidth + 15);
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
      self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
      setTimeout("ajusta_window_Fsel_ord()", 50);
      return;
    }
  }
  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
  self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
}
$( document ).ready(function() {
  ajusta_window_Fsel_ord();
});
</script>
<script>
    ajusta_window_Fsel_ord();
</script>
</BODY>
</HTML>
<?php
}
}
