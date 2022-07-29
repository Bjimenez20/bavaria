<?php
   include_once('BAYER_GESTION_session.php');
   session_start();
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
    $Ord_Cmp = new BAYER_GESTION_Ord_cmp(); 
    $Ord_Cmp->Ord_cmp_init();
   
class BAYER_GESTION_Ord_cmp
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
   $tab_ger_campos['bayer_gestiones_id_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_id_gestion'] = "bayer_gestiones_id_gestion";
       $tab_converte["bayer_gestiones_id_gestion"]   = "bayer_gestiones_id_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_id_gestion'] = "bayer_gestiones.ID_GESTION";
       $tab_converte["bayer_gestiones.ID_GESTION"]   = "bayer_gestiones_id_gestion";
   }
   $tab_labels["bayer_gestiones_id_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_id_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_id_gestion"] : "ID GESTION";
   $tab_ger_campos['bayer_gestiones_motivo_comunicacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_motivo_comunicacion_gestion'] = "cmp_maior_30_1";
       $tab_converte["cmp_maior_30_1"]   = "bayer_gestiones_motivo_comunicacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_motivo_comunicacion_gestion'] = "bayer_gestiones.MOTIVO_COMUNICACION_GESTION";
       $tab_converte["bayer_gestiones.MOTIVO_COMUNICACION_GESTION"]   = "bayer_gestiones_motivo_comunicacion_gestion";
   }
   $tab_labels["bayer_gestiones_motivo_comunicacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_motivo_comunicacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_motivo_comunicacion_gestion"] : "MOTIVO COMUNICACION GESTION";
   $tab_ger_campos['bayer_gestiones_medio_contacto_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_medio_contacto_gestion'] = "cmp_maior_30_2";
       $tab_converte["cmp_maior_30_2"]   = "bayer_gestiones_medio_contacto_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_medio_contacto_gestion'] = "bayer_gestiones.MEDIO_CONTACTO_GESTION";
       $tab_converte["bayer_gestiones.MEDIO_CONTACTO_GESTION"]   = "bayer_gestiones_medio_contacto_gestion";
   }
   $tab_labels["bayer_gestiones_medio_contacto_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_medio_contacto_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_medio_contacto_gestion"] : "MEDIO CONTACTO GESTION";
   $tab_ger_campos['bayer_gestiones_tipo_llamada_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_tipo_llamada_gestion'] = "cmp_maior_30_3";
       $tab_converte["cmp_maior_30_3"]   = "bayer_gestiones_tipo_llamada_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_tipo_llamada_gestion'] = "bayer_gestiones.TIPO_LLAMADA_GESTION";
       $tab_converte["bayer_gestiones.TIPO_LLAMADA_GESTION"]   = "bayer_gestiones_tipo_llamada_gestion";
   }
   $tab_labels["bayer_gestiones_tipo_llamada_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_tipo_llamada_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_tipo_llamada_gestion"] : "TIPO LLAMADA GESTION";
   $tab_ger_campos['bayer_gestiones_logro_comunicacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_logro_comunicacion_gestion'] = "cmp_maior_30_4";
       $tab_converte["cmp_maior_30_4"]   = "bayer_gestiones_logro_comunicacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_logro_comunicacion_gestion'] = "bayer_gestiones.LOGRO_COMUNICACION_GESTION";
       $tab_converte["bayer_gestiones.LOGRO_COMUNICACION_GESTION"]   = "bayer_gestiones_logro_comunicacion_gestion";
   }
   $tab_labels["bayer_gestiones_logro_comunicacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_logro_comunicacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_logro_comunicacion_gestion"] : "LOGRO COMUNICACION GESTION";
   $tab_ger_campos['bayer_gestiones_motivo_no_comunicacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_motivo_no_comunicacion_gestion'] = "cmp_maior_30_5";
       $tab_converte["cmp_maior_30_5"]   = "bayer_gestiones_motivo_no_comunicacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_motivo_no_comunicacion_gestion'] = "bayer_gestiones.MOTIVO_NO_COMUNICACION_GESTION";
       $tab_converte["bayer_gestiones.MOTIVO_NO_COMUNICACION_GESTION"]   = "bayer_gestiones_motivo_no_comunicacion_gestion";
   }
   $tab_labels["bayer_gestiones_motivo_no_comunicacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_motivo_no_comunicacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_motivo_no_comunicacion_gestion"] : "MOTIVO NO COMUNICACION GESTION";
   $tab_ger_campos['bayer_gestiones_numero_intentos_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_numero_intentos_gestion'] = "cmp_maior_30_6";
       $tab_converte["cmp_maior_30_6"]   = "bayer_gestiones_numero_intentos_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_numero_intentos_gestion'] = "bayer_gestiones.NUMERO_INTENTOS_GESTION";
       $tab_converte["bayer_gestiones.NUMERO_INTENTOS_GESTION"]   = "bayer_gestiones_numero_intentos_gestion";
   }
   $tab_labels["bayer_gestiones_numero_intentos_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_numero_intentos_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_numero_intentos_gestion"] : "NUMERO INTENTOS GESTION";
   $tab_ger_campos['bayer_gestiones_esperado_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_esperado_gestion'] = "cmp_maior_30_7";
       $tab_converte["cmp_maior_30_7"]   = "bayer_gestiones_esperado_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_esperado_gestion'] = "bayer_gestiones.ESPERADO_GESTION";
       $tab_converte["bayer_gestiones.ESPERADO_GESTION"]   = "bayer_gestiones_esperado_gestion";
   }
   $tab_labels["bayer_gestiones_esperado_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_esperado_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_esperado_gestion"] : "ESPERADO GESTION";
   $tab_ger_campos['bayer_gestiones_estado_ctc_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_estado_ctc_gestion'] = "cmp_maior_30_8";
       $tab_converte["cmp_maior_30_8"]   = "bayer_gestiones_estado_ctc_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_estado_ctc_gestion'] = "bayer_gestiones.ESTADO_CTC_GESTION";
       $tab_converte["bayer_gestiones.ESTADO_CTC_GESTION"]   = "bayer_gestiones_estado_ctc_gestion";
   }
   $tab_labels["bayer_gestiones_estado_ctc_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_estado_ctc_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_estado_ctc_gestion"] : "ESTADO CTC GESTION";
   $tab_ger_campos['bayer_gestiones_estado_farmacia_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_estado_farmacia_gestion'] = "cmp_maior_30_9";
       $tab_converte["cmp_maior_30_9"]   = "bayer_gestiones_estado_farmacia_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_estado_farmacia_gestion'] = "bayer_gestiones.ESTADO_FARMACIA_GESTION";
       $tab_converte["bayer_gestiones.ESTADO_FARMACIA_GESTION"]   = "bayer_gestiones_estado_farmacia_gestion";
   }
   $tab_labels["bayer_gestiones_estado_farmacia_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_estado_farmacia_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_estado_farmacia_gestion"] : "ESTADO FARMACIA GESTION";
   $tab_ger_campos['bayer_gestiones_reclamo_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_reclamo_gestion'] = "cmp_maior_30_10";
       $tab_converte["cmp_maior_30_10"]   = "bayer_gestiones_reclamo_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_reclamo_gestion'] = "bayer_gestiones.RECLAMO_GESTION";
       $tab_converte["bayer_gestiones.RECLAMO_GESTION"]   = "bayer_gestiones_reclamo_gestion";
   }
   $tab_labels["bayer_gestiones_reclamo_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_reclamo_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_reclamo_gestion"] : "RECLAMO GESTION";
   $tab_ger_campos['bayer_gestiones_consecutivo_betaferon'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_consecutivo_betaferon'] = "cmp_maior_30_11";
       $tab_converte["cmp_maior_30_11"]   = "bayer_gestiones_consecutivo_betaferon";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_consecutivo_betaferon'] = "bayer_gestiones.CONSECUTIVO_BETAFERON";
       $tab_converte["bayer_gestiones.CONSECUTIVO_BETAFERON"]   = "bayer_gestiones_consecutivo_betaferon";
   }
   $tab_labels["bayer_gestiones_consecutivo_betaferon"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_consecutivo_betaferon"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_consecutivo_betaferon"] : "CONSECUTIVO BETAFERON";
   $tab_ger_campos['bayer_gestiones_causa_no_reclamacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_causa_no_reclamacion_gestion'] = "cmp_maior_30_12";
       $tab_converte["cmp_maior_30_12"]   = "bayer_gestiones_causa_no_reclamacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_causa_no_reclamacion_gestion'] = "bayer_gestiones.CAUSA_NO_RECLAMACION_GESTION";
       $tab_converte["bayer_gestiones.CAUSA_NO_RECLAMACION_GESTION"]   = "bayer_gestiones_causa_no_reclamacion_gestion";
   }
   $tab_labels["bayer_gestiones_causa_no_reclamacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_causa_no_reclamacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_causa_no_reclamacion_gestion"] : "CAUSA NO RECLAMACION GESTION";
   $tab_ger_campos['bayer_gestiones_dificultad_acceso_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_dificultad_acceso_gestion'] = "cmp_maior_30_13";
       $tab_converte["cmp_maior_30_13"]   = "bayer_gestiones_dificultad_acceso_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_dificultad_acceso_gestion'] = "bayer_gestiones.DIFICULTAD_ACCESO_GESTION";
       $tab_converte["bayer_gestiones.DIFICULTAD_ACCESO_GESTION"]   = "bayer_gestiones_dificultad_acceso_gestion";
   }
   $tab_labels["bayer_gestiones_dificultad_acceso_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_dificultad_acceso_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_dificultad_acceso_gestion"] : "DIFICULTAD ACCESO GESTION";
   $tab_ger_campos['bayer_gestiones_tipo_dificultad_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_tipo_dificultad_gestion'] = "cmp_maior_30_14";
       $tab_converte["cmp_maior_30_14"]   = "bayer_gestiones_tipo_dificultad_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_tipo_dificultad_gestion'] = "bayer_gestiones.TIPO_DIFICULTAD_GESTION";
       $tab_converte["bayer_gestiones.TIPO_DIFICULTAD_GESTION"]   = "bayer_gestiones_tipo_dificultad_gestion";
   }
   $tab_labels["bayer_gestiones_tipo_dificultad_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_tipo_dificultad_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_tipo_dificultad_gestion"] : "TIPO DIFICULTAD GESTION";
   $tab_ger_campos['bayer_gestiones_envios_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_envios_gestion'] = "bayer_gestiones_envios_gestion";
       $tab_converte["bayer_gestiones_envios_gestion"]   = "bayer_gestiones_envios_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_envios_gestion'] = "bayer_gestiones.ENVIOS_GESTION";
       $tab_converte["bayer_gestiones.ENVIOS_GESTION"]   = "bayer_gestiones_envios_gestion";
   }
   $tab_labels["bayer_gestiones_envios_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_envios_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_envios_gestion"] : "ENVIOS GESTION";
   $tab_ger_campos['bayer_gestiones_medicamentos_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_medicamentos_gestion'] = "cmp_maior_30_15";
       $tab_converte["cmp_maior_30_15"]   = "bayer_gestiones_medicamentos_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_medicamentos_gestion'] = "bayer_gestiones.MEDICAMENTOS_GESTION";
       $tab_converte["bayer_gestiones.MEDICAMENTOS_GESTION"]   = "bayer_gestiones_medicamentos_gestion";
   }
   $tab_labels["bayer_gestiones_medicamentos_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_medicamentos_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_medicamentos_gestion"] : "MEDICAMENTOS GESTION";
   $tab_ger_campos['bayer_gestiones_tipo_envio_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_tipo_envio_gestion'] = "cmp_maior_30_16";
       $tab_converte["cmp_maior_30_16"]   = "bayer_gestiones_tipo_envio_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_tipo_envio_gestion'] = "bayer_gestiones.TIPO_ENVIO_GESTION";
       $tab_converte["bayer_gestiones.TIPO_ENVIO_GESTION"]   = "bayer_gestiones_tipo_envio_gestion";
   }
   $tab_labels["bayer_gestiones_tipo_envio_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_tipo_envio_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_tipo_envio_gestion"] : "TIPO ENVIO GESTION";
   $tab_ger_campos['bayer_gestiones_evento_adverso_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_evento_adverso_gestion'] = "cmp_maior_30_17";
       $tab_converte["cmp_maior_30_17"]   = "bayer_gestiones_evento_adverso_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_evento_adverso_gestion'] = "bayer_gestiones.EVENTO_ADVERSO_GESTION";
       $tab_converte["bayer_gestiones.EVENTO_ADVERSO_GESTION"]   = "bayer_gestiones_evento_adverso_gestion";
   }
   $tab_labels["bayer_gestiones_evento_adverso_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_evento_adverso_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_evento_adverso_gestion"] : "EVENTO ADVERSO GESTION";
   $tab_ger_campos['bayer_gestiones_tipo_evento_adverso'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_tipo_evento_adverso'] = "cmp_maior_30_18";
       $tab_converte["cmp_maior_30_18"]   = "bayer_gestiones_tipo_evento_adverso";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_tipo_evento_adverso'] = "bayer_gestiones.TIPO_EVENTO_ADVERSO";
       $tab_converte["bayer_gestiones.TIPO_EVENTO_ADVERSO"]   = "bayer_gestiones_tipo_evento_adverso";
   }
   $tab_labels["bayer_gestiones_tipo_evento_adverso"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_tipo_evento_adverso"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_tipo_evento_adverso"] : "TIPO EVENTO ADVERSO";
   $tab_ger_campos['bayer_gestiones_genera_solicitud_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_genera_solicitud_gestion'] = "cmp_maior_30_19";
       $tab_converte["cmp_maior_30_19"]   = "bayer_gestiones_genera_solicitud_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_genera_solicitud_gestion'] = "bayer_gestiones.GENERA_SOLICITUD_GESTION";
       $tab_converte["bayer_gestiones.GENERA_SOLICITUD_GESTION"]   = "bayer_gestiones_genera_solicitud_gestion";
   }
   $tab_labels["bayer_gestiones_genera_solicitud_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_genera_solicitud_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_genera_solicitud_gestion"] : "GENERA SOLICITUD GESTION";
   $tab_ger_campos['bayer_gestiones_fecha_proxima_llamada'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_fecha_proxima_llamada'] = "cmp_maior_30_20";
       $tab_converte["cmp_maior_30_20"]   = "bayer_gestiones_fecha_proxima_llamada";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_fecha_proxima_llamada'] = "bayer_gestiones.FECHA_PROXIMA_LLAMADA";
       $tab_converte["bayer_gestiones.FECHA_PROXIMA_LLAMADA"]   = "bayer_gestiones_fecha_proxima_llamada";
   }
   $tab_labels["bayer_gestiones_fecha_proxima_llamada"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_proxima_llamada"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_proxima_llamada"] : "FECHA PROXIMA LLAMADA";
   $tab_ger_campos['bayer_gestiones_motivo_proxima_llamada'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_motivo_proxima_llamada'] = "cmp_maior_30_21";
       $tab_converte["cmp_maior_30_21"]   = "bayer_gestiones_motivo_proxima_llamada";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_motivo_proxima_llamada'] = "bayer_gestiones.MOTIVO_PROXIMA_LLAMADA";
       $tab_converte["bayer_gestiones.MOTIVO_PROXIMA_LLAMADA"]   = "bayer_gestiones_motivo_proxima_llamada";
   }
   $tab_labels["bayer_gestiones_motivo_proxima_llamada"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_motivo_proxima_llamada"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_motivo_proxima_llamada"] : "MOTIVO PROXIMA LLAMADA";
   $tab_ger_campos['bayer_gestiones_observacion_proxima_llamada'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_observacion_proxima_llamada'] = "cmp_maior_30_22";
       $tab_converte["cmp_maior_30_22"]   = "bayer_gestiones_observacion_proxima_llamada";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_observacion_proxima_llamada'] = "bayer_gestiones.OBSERVACION_PROXIMA_LLAMADA";
       $tab_converte["bayer_gestiones.OBSERVACION_PROXIMA_LLAMADA"]   = "bayer_gestiones_observacion_proxima_llamada";
   }
   $tab_labels["bayer_gestiones_observacion_proxima_llamada"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_observacion_proxima_llamada"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_observacion_proxima_llamada"] : "OBSERVACION PROXIMA LLAMADA";
   $tab_ger_campos['bayer_gestiones_fecha_reclamacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_fecha_reclamacion_gestion'] = "cmp_maior_30_23";
       $tab_converte["cmp_maior_30_23"]   = "bayer_gestiones_fecha_reclamacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_fecha_reclamacion_gestion'] = "bayer_gestiones.FECHA_RECLAMACION_GESTION";
       $tab_converte["bayer_gestiones.FECHA_RECLAMACION_GESTION"]   = "bayer_gestiones_fecha_reclamacion_gestion";
   }
   $tab_labels["bayer_gestiones_fecha_reclamacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_reclamacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_reclamacion_gestion"] : "FECHA RECLAMACION GESTION";
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
   $tab_labels["bayer_gestiones_numero_cajas"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_numero_cajas"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_numero_cajas"] : "NUMERO CAJAS";
   $tab_ger_campos['bayer_gestiones_consecutivo_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_consecutivo_gestion'] = "cmp_maior_30_24";
       $tab_converte["cmp_maior_30_24"]   = "bayer_gestiones_consecutivo_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_consecutivo_gestion'] = "bayer_gestiones.CONSECUTIVO_GESTION";
       $tab_converte["bayer_gestiones.CONSECUTIVO_GESTION"]   = "bayer_gestiones_consecutivo_gestion";
   }
   $tab_labels["bayer_gestiones_consecutivo_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_consecutivo_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_consecutivo_gestion"] : "CONSECUTIVO GESTION";
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
   $tab_labels["bayer_gestiones_autor_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_autor_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_autor_gestion"] : "AUTOR GESTION";
   $tab_ger_campos['bayer_gestiones_nota'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_nota'] = "bayer_gestiones_nota";
       $tab_converte["bayer_gestiones_nota"]   = "bayer_gestiones_nota";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_nota'] = "bayer_gestiones.NOTA";
       $tab_converte["bayer_gestiones.NOTA"]   = "bayer_gestiones_nota";
   }
   $tab_labels["bayer_gestiones_nota"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_nota"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_nota"] : "NOTA";
   $tab_ger_campos['bayer_gestiones_descripcion_comunicacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_descripcion_comunicacion_gestion'] = "cmp_maior_30_25";
       $tab_converte["cmp_maior_30_25"]   = "bayer_gestiones_descripcion_comunicacion_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_descripcion_comunicacion_gestion'] = "bayer_gestiones.DESCRIPCION_COMUNICACION_GESTION";
       $tab_converte["bayer_gestiones.DESCRIPCION_COMUNICACION_GESTION"]   = "bayer_gestiones_descripcion_comunicacion_gestion";
   }
   $tab_labels["bayer_gestiones_descripcion_comunicacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_descripcion_comunicacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_descripcion_comunicacion_gestion"] : "DESCRIPCION COMUNICACION GESTION";
   $tab_ger_campos['bayer_gestiones_fecha_programada_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_fecha_programada_gestion'] = "cmp_maior_30_26";
       $tab_converte["cmp_maior_30_26"]   = "bayer_gestiones_fecha_programada_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_fecha_programada_gestion'] = "bayer_gestiones.FECHA_PROGRAMADA_GESTION";
       $tab_converte["bayer_gestiones.FECHA_PROGRAMADA_GESTION"]   = "bayer_gestiones_fecha_programada_gestion";
   }
   $tab_labels["bayer_gestiones_fecha_programada_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_programada_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_programada_gestion"] : "FECHA PROGRAMADA GESTION";
   $tab_ger_campos['bayer_gestiones_usuario_asigando'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_usuario_asigando'] = "cmp_maior_30_27";
       $tab_converte["cmp_maior_30_27"]   = "bayer_gestiones_usuario_asigando";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_usuario_asigando'] = "bayer_gestiones.USUARIO_ASIGANDO";
       $tab_converte["bayer_gestiones.USUARIO_ASIGANDO"]   = "bayer_gestiones_usuario_asigando";
   }
   $tab_labels["bayer_gestiones_usuario_asigando"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_usuario_asigando"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_usuario_asigando"] : "USUARIO ASIGANDO";
   $tab_ger_campos['bayer_gestiones_id_paciente_fk2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_id_paciente_fk2'] = "cmp_maior_30_28";
       $tab_converte["cmp_maior_30_28"]   = "bayer_gestiones_id_paciente_fk2";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_id_paciente_fk2'] = "bayer_gestiones.ID_PACIENTE_FK2";
       $tab_converte["bayer_gestiones.ID_PACIENTE_FK2"]   = "bayer_gestiones_id_paciente_fk2";
   }
   $tab_labels["bayer_gestiones_id_paciente_fk2"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_id_paciente_fk2"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_id_paciente_fk2"] : "ID PACIENTE FK2";
   $tab_ger_campos['bayer_gestiones_fecha_comunicacion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_fecha_comunicacion'] = "cmp_maior_30_29";
       $tab_converte["cmp_maior_30_29"]   = "bayer_gestiones_fecha_comunicacion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_fecha_comunicacion'] = "bayer_gestiones.FECHA_COMUNICACION";
       $tab_converte["bayer_gestiones.FECHA_COMUNICACION"]   = "bayer_gestiones_fecha_comunicacion";
   }
   $tab_labels["bayer_gestiones_fecha_comunicacion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_comunicacion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_comunicacion"] : "FECHA COMUNICACION";
   $tab_ger_campos['bayer_gestiones_estado_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_estado_gestion'] = "bayer_gestiones_estado_gestion";
       $tab_converte["bayer_gestiones_estado_gestion"]   = "bayer_gestiones_estado_gestion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_estado_gestion'] = "bayer_gestiones.ESTADO_GESTION";
       $tab_converte["bayer_gestiones.ESTADO_GESTION"]   = "bayer_gestiones_estado_gestion";
   }
   $tab_labels["bayer_gestiones_estado_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_estado_gestion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_estado_gestion"] : "ESTADO GESTION";
   $tab_ger_campos['bayer_gestiones_codigo_argus'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_codigo_argus'] = "bayer_gestiones_codigo_argus";
       $tab_converte["bayer_gestiones_codigo_argus"]   = "bayer_gestiones_codigo_argus";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_codigo_argus'] = "bayer_gestiones.CODIGO_ARGUS";
       $tab_converte["bayer_gestiones.CODIGO_ARGUS"]   = "bayer_gestiones_codigo_argus";
   }
   $tab_labels["bayer_gestiones_codigo_argus"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_codigo_argus"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_codigo_argus"] : "CODIGO ARGUS";
   $tab_ger_campos['bayer_gestiones_autor_modificacion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_autor_modificacion'] = "cmp_maior_30_30";
       $tab_converte["cmp_maior_30_30"]   = "bayer_gestiones_autor_modificacion";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_autor_modificacion'] = "bayer_gestiones.AUTOR_MODIFICACION";
       $tab_converte["bayer_gestiones.AUTOR_MODIFICACION"]   = "bayer_gestiones_autor_modificacion";
   }
   $tab_labels["bayer_gestiones_autor_modificacion"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_autor_modificacion"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_autor_modificacion"] : "AUTOR MODIFICACION";
   $tab_ger_campos['bayer_gestiones_numero_nebulizaciones'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_numero_nebulizaciones'] = "cmp_maior_30_31";
       $tab_converte["cmp_maior_30_31"]   = "bayer_gestiones_numero_nebulizaciones";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_numero_nebulizaciones'] = "bayer_gestiones.NUMERO_NEBULIZACIONES";
       $tab_converte["bayer_gestiones.NUMERO_NEBULIZACIONES"]   = "bayer_gestiones_numero_nebulizaciones";
   }
   $tab_labels["bayer_gestiones_numero_nebulizaciones"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_numero_nebulizaciones"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_numero_nebulizaciones"] : "NUMERO NEBULIZACIONES";
   $tab_ger_campos['bayer_gestiones_fecha_subido'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_fecha_subido'] = "bayer_gestiones_fecha_subido";
       $tab_converte["bayer_gestiones_fecha_subido"]   = "bayer_gestiones_fecha_subido";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_fecha_subido'] = "bayer_gestiones.FECHA_SUBIDO";
       $tab_converte["bayer_gestiones.FECHA_SUBIDO"]   = "bayer_gestiones_fecha_subido";
   }
   $tab_labels["bayer_gestiones_fecha_subido"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_subido"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_fecha_subido"] : "FECHA SUBIDO";
   $tab_ger_campos['bayer_gestiones_numero_tabletas_diarias'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_numero_tabletas_diarias'] = "cmp_maior_30_32";
       $tab_converte["cmp_maior_30_32"]   = "bayer_gestiones_numero_tabletas_diarias";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_numero_tabletas_diarias'] = "bayer_gestiones.NUMERO_TABLETAS_DIARIAS";
       $tab_converte["bayer_gestiones.NUMERO_TABLETAS_DIARIAS"]   = "bayer_gestiones_numero_tabletas_diarias";
   }
   $tab_labels["bayer_gestiones_numero_tabletas_diarias"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_numero_tabletas_diarias"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_numero_tabletas_diarias"] : "NUMERO TABLETAS DIARIAS";
   $tab_ger_campos['bayer_gestiones_brindo_apoyo'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_brindo_apoyo'] = "bayer_gestiones_brindo_apoyo";
       $tab_converte["bayer_gestiones_brindo_apoyo"]   = "bayer_gestiones_brindo_apoyo";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_brindo_apoyo'] = "bayer_gestiones.BRINDO_APOYO";
       $tab_converte["bayer_gestiones.BRINDO_APOYO"]   = "bayer_gestiones_brindo_apoyo";
   }
   $tab_labels["bayer_gestiones_brindo_apoyo"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_brindo_apoyo"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_brindo_apoyo"] : "BRINDO APOYO";
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
   $tab_labels["bayer_gestiones_paap"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_paap"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_paap"] : "PAAP";
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
   $tab_labels["bayer_gestiones_sub_paap"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_sub_paap"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_sub_paap"] : "SUB PAAP";
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
   $tab_labels["bayer_gestiones_barrera"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_barrera"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_barrera"] : "BARRERA";
   $tab_ger_campos['bayer_gestiones_informacion_aplicaciones'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['bayer_gestiones_informacion_aplicaciones'] = "cmp_maior_30_33";
       $tab_converte["cmp_maior_30_33"]   = "bayer_gestiones_informacion_aplicaciones";
   }
   else
   {
       $tab_def_campos['bayer_gestiones_informacion_aplicaciones'] = "bayer_gestiones.INFORMACION_APLICACIONES";
       $tab_converte["bayer_gestiones.INFORMACION_APLICACIONES"]   = "bayer_gestiones_informacion_aplicaciones";
   }
   $tab_labels["bayer_gestiones_informacion_aplicaciones"]   = (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_informacion_aplicaciones"])) ? $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['labels']["bayer_gestiones_informacion_aplicaciones"] : "INFORMACION APLICACIONES";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['BAYER_GESTION']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['BAYER_GESTION']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['BAYER_GESTION']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['ordem_select'] = array();
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
   $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_converte[$campo]))
       {
           $_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['ordem_select'][$campo] = $ordem;
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
   $_SESSION['scriptcase']['charset']  = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "ISO-8859-15";
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
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc8_BlueWood/Sc8_BlueWood";
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
 <TITLE><?php echo $this->Nm_lang['lang_othr_grid_titl'] ?> - </TITLE>
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
    url: "BAYER_GESTION_order_campos.php",
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
           if (!isset($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['ordem_select'][$tab_def_campos[$NM_cada_field]]))
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
   foreach ($_SESSION['sc_session'][$sc_init]['BAYER_GESTION']['ordem_select'] as $NM_cada_field => $NM_cada_opc)
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
