<?php

class generador_de_informes_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function generador_de_informes_total($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("es");
      if (isset($_SESSION['sc_session'][$this->sc_page]['generador_de_informes']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['generador_de_informes']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->bayer_pacientes_fecha_activacion_paciente = $Busca_temp['bayer_pacientes_fecha_activacion_paciente']; 
          $tmp_pos = strpos($this->bayer_pacientes_fecha_activacion_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_pacientes_fecha_activacion_paciente = substr($this->bayer_pacientes_fecha_activacion_paciente, 0, $tmp_pos);
          }
          $this->bayer_gestiones_fecha_comunicacion = $Busca_temp['bayer_gestiones_fecha_comunicacion']; 
          $tmp_pos = strpos($this->bayer_gestiones_fecha_comunicacion, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_gestiones_fecha_comunicacion = substr($this->bayer_gestiones_fecha_comunicacion, 0, $tmp_pos);
          }
          $bayer_gestiones_fecha_comunicacion_2 = $Busca_temp['bayer_gestiones_fecha_comunicacion_input_2']; 
          $this->bayer_gestiones_fecha_comunicacion_2 = $Busca_temp['bayer_gestiones_fecha_comunicacion_input_2']; 
      } 
   }

   //---- 
   function quebra_geral()
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['contr_total_geral'] = "OK";
   } 

   //-----  bayer_pacientes_id_paciente
   function quebra_bayer_pacientes_id_paciente_sc_free_group_by($bayer_pacientes_id_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_id_paciente ;  
      $tot_bayer_pacientes_id_paciente = array() ;  
      $tot_bayer_pacientes_id_paciente[0] = $bayer_pacientes_id_paciente ; 
   }
   //-----  bayer_pacientes_estado_paciente
   function quebra_bayer_pacientes_estado_paciente_sc_free_group_by($bayer_pacientes_estado_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_estado_paciente ;  
      $tot_bayer_pacientes_estado_paciente = array() ;  
      $tot_bayer_pacientes_estado_paciente[0] = $bayer_pacientes_estado_paciente ; 
   }
   //-----  bayer_pacientes_fecha_activacion_paciente
   function quebra_bayer_pacientes_fecha_activacion_paciente_sc_free_group_by($bayer_pacientes_fecha_activacion_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_fecha_activacion_paciente ;  
      $tot_bayer_pacientes_fecha_activacion_paciente = array() ;  
      $tot_bayer_pacientes_fecha_activacion_paciente[0] = $bayer_pacientes_fecha_activacion_paciente ; 
   }
   //-----  bayer_pacientes_fecha_retiro_paciente
   function quebra_bayer_pacientes_fecha_retiro_paciente_sc_free_group_by($bayer_pacientes_fecha_retiro_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_fecha_retiro_paciente ;  
      $tot_bayer_pacientes_fecha_retiro_paciente = array() ;  
      $tot_bayer_pacientes_fecha_retiro_paciente[0] = $bayer_pacientes_fecha_retiro_paciente ; 
   }
   //-----  bayer_pacientes_motivo_retiro_paciente
   function quebra_bayer_pacientes_motivo_retiro_paciente_sc_free_group_by($bayer_pacientes_motivo_retiro_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_motivo_retiro_paciente ;  
      $tot_bayer_pacientes_motivo_retiro_paciente = array() ;  
      $tot_bayer_pacientes_motivo_retiro_paciente[0] = $bayer_pacientes_motivo_retiro_paciente ; 
   }
   //-----  bayer_pacientes_observacion_motivo_retiro_paciente
   function quebra_bayer_pacientes_observacion_motivo_retiro_paciente_sc_free_group_by($bayer_pacientes_observacion_motivo_retiro_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_observacion_motivo_retiro_paciente ;  
      $tot_bayer_pacientes_observacion_motivo_retiro_paciente = array() ;  
      $tot_bayer_pacientes_observacion_motivo_retiro_paciente[0] = $bayer_pacientes_observacion_motivo_retiro_paciente ; 
   }
   //-----  bayer_pacientes_identificacion_paciente
   function quebra_bayer_pacientes_identificacion_paciente_sc_free_group_by($bayer_pacientes_identificacion_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_identificacion_paciente ;  
      $tot_bayer_pacientes_identificacion_paciente = array() ;  
      $tot_bayer_pacientes_identificacion_paciente[0] = $bayer_pacientes_identificacion_paciente ; 
   }
   //-----  bayer_pacientes_nombre_paciente
   function quebra_bayer_pacientes_nombre_paciente_sc_free_group_by($bayer_pacientes_nombre_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_nombre_paciente ;  
      $tot_bayer_pacientes_nombre_paciente = array() ;  
      $tot_bayer_pacientes_nombre_paciente[0] = $bayer_pacientes_nombre_paciente ; 
   }
   //-----  bayer_pacientes_apellido_paciente
   function quebra_bayer_pacientes_apellido_paciente_sc_free_group_by($bayer_pacientes_apellido_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_apellido_paciente ;  
      $tot_bayer_pacientes_apellido_paciente = array() ;  
      $tot_bayer_pacientes_apellido_paciente[0] = $bayer_pacientes_apellido_paciente ; 
   }
   //-----  bayer_pacientes_telefono_paciente
   function quebra_bayer_pacientes_telefono_paciente_sc_free_group_by($bayer_pacientes_telefono_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_telefono_paciente ;  
      $tot_bayer_pacientes_telefono_paciente = array() ;  
      $tot_bayer_pacientes_telefono_paciente[0] = $bayer_pacientes_telefono_paciente ; 
   }
   //-----  bayer_pacientes_telefono2_paciente
   function quebra_bayer_pacientes_telefono2_paciente_sc_free_group_by($bayer_pacientes_telefono2_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_telefono2_paciente ;  
      $tot_bayer_pacientes_telefono2_paciente = array() ;  
      $tot_bayer_pacientes_telefono2_paciente[0] = $bayer_pacientes_telefono2_paciente ; 
   }
   //-----  bayer_pacientes_telefono3_paciente
   function quebra_bayer_pacientes_telefono3_paciente_sc_free_group_by($bayer_pacientes_telefono3_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_telefono3_paciente ;  
      $tot_bayer_pacientes_telefono3_paciente = array() ;  
      $tot_bayer_pacientes_telefono3_paciente[0] = $bayer_pacientes_telefono3_paciente ; 
   }
   //-----  bayer_pacientes_correo_paciente
   function quebra_bayer_pacientes_correo_paciente_sc_free_group_by($bayer_pacientes_correo_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_correo_paciente ;  
      $tot_bayer_pacientes_correo_paciente = array() ;  
      $tot_bayer_pacientes_correo_paciente[0] = $bayer_pacientes_correo_paciente ; 
   }
   //-----  bayer_pacientes_direccion_paciente
   function quebra_bayer_pacientes_direccion_paciente_sc_free_group_by($bayer_pacientes_direccion_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_direccion_paciente ;  
      $tot_bayer_pacientes_direccion_paciente = array() ;  
      $tot_bayer_pacientes_direccion_paciente[0] = $bayer_pacientes_direccion_paciente ; 
   }
   //-----  bayer_pacientes_barrio_paciente
   function quebra_bayer_pacientes_barrio_paciente_sc_free_group_by($bayer_pacientes_barrio_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_barrio_paciente ;  
      $tot_bayer_pacientes_barrio_paciente = array() ;  
      $tot_bayer_pacientes_barrio_paciente[0] = $bayer_pacientes_barrio_paciente ; 
   }
   //-----  bayer_pacientes_departamento_paciente
   function quebra_bayer_pacientes_departamento_paciente_sc_free_group_by($bayer_pacientes_departamento_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_departamento_paciente ;  
      $tot_bayer_pacientes_departamento_paciente = array() ;  
      $tot_bayer_pacientes_departamento_paciente[0] = $bayer_pacientes_departamento_paciente ; 
   }
   //-----  bayer_pacientes_ciudad_paciente
   function quebra_bayer_pacientes_ciudad_paciente_sc_free_group_by($bayer_pacientes_ciudad_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_ciudad_paciente ;  
      $tot_bayer_pacientes_ciudad_paciente = array() ;  
      $tot_bayer_pacientes_ciudad_paciente[0] = $bayer_pacientes_ciudad_paciente ; 
   }
   //-----  bayer_pacientes_genero_paciente
   function quebra_bayer_pacientes_genero_paciente_sc_free_group_by($bayer_pacientes_genero_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_genero_paciente ;  
      $tot_bayer_pacientes_genero_paciente = array() ;  
      $tot_bayer_pacientes_genero_paciente[0] = $bayer_pacientes_genero_paciente ; 
   }
   //-----  bayer_pacientes_fecha_nacimineto_paciente
   function quebra_bayer_pacientes_fecha_nacimineto_paciente_sc_free_group_by($bayer_pacientes_fecha_nacimineto_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_fecha_nacimineto_paciente ;  
      $tot_bayer_pacientes_fecha_nacimineto_paciente = array() ;  
      $tot_bayer_pacientes_fecha_nacimineto_paciente[0] = $bayer_pacientes_fecha_nacimineto_paciente ; 
   }
   //-----  bayer_pacientes_edad_paciente
   function quebra_bayer_pacientes_edad_paciente_sc_free_group_by($bayer_pacientes_edad_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_edad_paciente ;  
      $tot_bayer_pacientes_edad_paciente = array() ;  
      $tot_bayer_pacientes_edad_paciente[0] = $bayer_pacientes_edad_paciente ; 
   }
   //-----  bayer_pacientes_acudiente_paciente
   function quebra_bayer_pacientes_acudiente_paciente_sc_free_group_by($bayer_pacientes_acudiente_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_acudiente_paciente ;  
      $tot_bayer_pacientes_acudiente_paciente = array() ;  
      $tot_bayer_pacientes_acudiente_paciente[0] = $bayer_pacientes_acudiente_paciente ; 
   }
   //-----  bayer_pacientes_telefono_acudiente_paciente
   function quebra_bayer_pacientes_telefono_acudiente_paciente_sc_free_group_by($bayer_pacientes_telefono_acudiente_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_telefono_acudiente_paciente ;  
      $tot_bayer_pacientes_telefono_acudiente_paciente = array() ;  
      $tot_bayer_pacientes_telefono_acudiente_paciente[0] = $bayer_pacientes_telefono_acudiente_paciente ; 
   }
   //-----  bayer_pacientes_codigo_xofigo
   function quebra_bayer_pacientes_codigo_xofigo_sc_free_group_by($bayer_pacientes_codigo_xofigo, $Where_qb) 
   {
      global $tot_bayer_pacientes_codigo_xofigo ;  
      $tot_bayer_pacientes_codigo_xofigo = array() ;  
      $tot_bayer_pacientes_codigo_xofigo[0] = $bayer_pacientes_codigo_xofigo ; 
   }
   //-----  bayer_pacientes_status_paciente
   function quebra_bayer_pacientes_status_paciente_sc_free_group_by($bayer_pacientes_status_paciente, $Where_qb) 
   {
      global $tot_bayer_pacientes_status_paciente ;  
      $tot_bayer_pacientes_status_paciente = array() ;  
      $tot_bayer_pacientes_status_paciente[0] = $bayer_pacientes_status_paciente ; 
   }
   //-----  bayer_pacientes_id_ultima_gestion
   function quebra_bayer_pacientes_id_ultima_gestion_sc_free_group_by($bayer_pacientes_id_ultima_gestion, $Where_qb) 
   {
      global $tot_bayer_pacientes_id_ultima_gestion ;  
      $tot_bayer_pacientes_id_ultima_gestion = array() ;  
      $tot_bayer_pacientes_id_ultima_gestion[0] = $bayer_pacientes_id_ultima_gestion ; 
   }
   //-----  bayer_pacientes_usuario_creacion
   function quebra_bayer_pacientes_usuario_creacion_sc_free_group_by($bayer_pacientes_usuario_creacion, $Where_qb) 
   {
      global $tot_bayer_pacientes_usuario_creacion ;  
      $tot_bayer_pacientes_usuario_creacion = array() ;  
      $tot_bayer_pacientes_usuario_creacion[0] = $bayer_pacientes_usuario_creacion ; 
   }
   //-----  bayer_tratamiento_id_tratamiento
   function quebra_bayer_tratamiento_id_tratamiento_sc_free_group_by($bayer_tratamiento_id_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_id_tratamiento ;  
      $tot_bayer_tratamiento_id_tratamiento = array() ;  
      $tot_bayer_tratamiento_id_tratamiento[0] = $bayer_tratamiento_id_tratamiento ; 
   }
   //-----  bayer_tratamiento_producto_tratamiento
   function quebra_bayer_tratamiento_producto_tratamiento_sc_free_group_by($bayer_tratamiento_producto_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_producto_tratamiento ;  
      $tot_bayer_tratamiento_producto_tratamiento = array() ;  
      $tot_bayer_tratamiento_producto_tratamiento[0] = $bayer_tratamiento_producto_tratamiento ; 
   }
   //-----  bayer_tratamiento_nombre_referencia
   function quebra_bayer_tratamiento_nombre_referencia_sc_free_group_by($bayer_tratamiento_nombre_referencia, $Where_qb) 
   {
      global $tot_bayer_tratamiento_nombre_referencia ;  
      $tot_bayer_tratamiento_nombre_referencia = array() ;  
      $tot_bayer_tratamiento_nombre_referencia[0] = $bayer_tratamiento_nombre_referencia ; 
   }
   //-----  bayer_tratamiento_clasificacion_patologica_tratamiento
   function quebra_bayer_tratamiento_clasificacion_patologica_tratamiento_sc_free_group_by($bayer_tratamiento_clasificacion_patologica_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_clasificacion_patologica_tratamiento ;  
      $tot_bayer_tratamiento_clasificacion_patologica_tratamiento = array() ;  
      $tot_bayer_tratamiento_clasificacion_patologica_tratamiento[0] = $bayer_tratamiento_clasificacion_patologica_tratamiento ; 
   }
   //-----  bayer_tratamiento_tratamiento_previo
   function quebra_bayer_tratamiento_tratamiento_previo_sc_free_group_by($bayer_tratamiento_tratamiento_previo, $Where_qb) 
   {
      global $tot_bayer_tratamiento_tratamiento_previo ;  
      $tot_bayer_tratamiento_tratamiento_previo = array() ;  
      $tot_bayer_tratamiento_tratamiento_previo[0] = $bayer_tratamiento_tratamiento_previo ; 
   }
   //-----  bayer_tratamiento_consentimiento_tratamiento
   function quebra_bayer_tratamiento_consentimiento_tratamiento_sc_free_group_by($bayer_tratamiento_consentimiento_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_consentimiento_tratamiento ;  
      $tot_bayer_tratamiento_consentimiento_tratamiento = array() ;  
      $tot_bayer_tratamiento_consentimiento_tratamiento[0] = $bayer_tratamiento_consentimiento_tratamiento ; 
   }
   //-----  bayer_tratamiento_fecha_inicio_terapia_tratamiento
   function quebra_bayer_tratamiento_fecha_inicio_terapia_tratamiento_sc_free_group_by($bayer_tratamiento_fecha_inicio_terapia_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_fecha_inicio_terapia_tratamiento ;  
      $tot_bayer_tratamiento_fecha_inicio_terapia_tratamiento = array() ;  
      $tot_bayer_tratamiento_fecha_inicio_terapia_tratamiento[0] = $bayer_tratamiento_fecha_inicio_terapia_tratamiento ; 
   }
   //-----  bayer_tratamiento_regimen_tratamiento
   function quebra_bayer_tratamiento_regimen_tratamiento_sc_free_group_by($bayer_tratamiento_regimen_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_regimen_tratamiento ;  
      $tot_bayer_tratamiento_regimen_tratamiento = array() ;  
      $tot_bayer_tratamiento_regimen_tratamiento[0] = $bayer_tratamiento_regimen_tratamiento ; 
   }
   //-----  bayer_tratamiento_asegurador_tratamiento
   function quebra_bayer_tratamiento_asegurador_tratamiento_sc_free_group_by($bayer_tratamiento_asegurador_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_asegurador_tratamiento ;  
      $tot_bayer_tratamiento_asegurador_tratamiento = array() ;  
      $tot_bayer_tratamiento_asegurador_tratamiento[0] = $bayer_tratamiento_asegurador_tratamiento ; 
   }
   //-----  bayer_tratamiento_operador_logistico_tratamiento
   function quebra_bayer_tratamiento_operador_logistico_tratamiento_sc_free_group_by($bayer_tratamiento_operador_logistico_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_operador_logistico_tratamiento ;  
      $tot_bayer_tratamiento_operador_logistico_tratamiento = array() ;  
      $tot_bayer_tratamiento_operador_logistico_tratamiento[0] = $bayer_tratamiento_operador_logistico_tratamiento ; 
   }
   //-----  bayer_tratamiento_punto_entrega
   function quebra_bayer_tratamiento_punto_entrega_sc_free_group_by($bayer_tratamiento_punto_entrega, $Where_qb) 
   {
      global $tot_bayer_tratamiento_punto_entrega ;  
      $tot_bayer_tratamiento_punto_entrega = array() ;  
      $tot_bayer_tratamiento_punto_entrega[0] = $bayer_tratamiento_punto_entrega ; 
   }
   //-----  bayer_tratamiento_fecha_ultima_reclamacion_tratamiento
   function quebra_bayer_tratamiento_fecha_ultima_reclamacion_tratamiento_sc_free_group_by($bayer_tratamiento_fecha_ultima_reclamacion_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_fecha_ultima_reclamacion_tratamiento ;  
      $tot_bayer_tratamiento_fecha_ultima_reclamacion_tratamiento = array() ;  
      $tot_bayer_tratamiento_fecha_ultima_reclamacion_tratamiento[0] = $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento ; 
   }
   //-----  bayer_tratamiento_otros_operadores_tratamiento
   function quebra_bayer_tratamiento_otros_operadores_tratamiento_sc_free_group_by($bayer_tratamiento_otros_operadores_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_otros_operadores_tratamiento ;  
      $tot_bayer_tratamiento_otros_operadores_tratamiento = array() ;  
      $tot_bayer_tratamiento_otros_operadores_tratamiento[0] = $bayer_tratamiento_otros_operadores_tratamiento ; 
   }
   //-----  bayer_tratamiento_medios_adquisicion_tratamiento
   function quebra_bayer_tratamiento_medios_adquisicion_tratamiento_sc_free_group_by($bayer_tratamiento_medios_adquisicion_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_medios_adquisicion_tratamiento ;  
      $tot_bayer_tratamiento_medios_adquisicion_tratamiento = array() ;  
      $tot_bayer_tratamiento_medios_adquisicion_tratamiento[0] = $bayer_tratamiento_medios_adquisicion_tratamiento ; 
   }
   //-----  bayer_tratamiento_ips_atiende_tratamiento
   function quebra_bayer_tratamiento_ips_atiende_tratamiento_sc_free_group_by($bayer_tratamiento_ips_atiende_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_ips_atiende_tratamiento ;  
      $tot_bayer_tratamiento_ips_atiende_tratamiento = array() ;  
      $tot_bayer_tratamiento_ips_atiende_tratamiento[0] = $bayer_tratamiento_ips_atiende_tratamiento ; 
   }
   //-----  bayer_tratamiento_medico_tratamiento
   function quebra_bayer_tratamiento_medico_tratamiento_sc_free_group_by($bayer_tratamiento_medico_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_medico_tratamiento ;  
      $tot_bayer_tratamiento_medico_tratamiento = array() ;  
      $tot_bayer_tratamiento_medico_tratamiento[0] = $bayer_tratamiento_medico_tratamiento ; 
   }
   //-----  bayer_tratamiento_especialidad_tratamiento
   function quebra_bayer_tratamiento_especialidad_tratamiento_sc_free_group_by($bayer_tratamiento_especialidad_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_especialidad_tratamiento ;  
      $tot_bayer_tratamiento_especialidad_tratamiento = array() ;  
      $tot_bayer_tratamiento_especialidad_tratamiento[0] = $bayer_tratamiento_especialidad_tratamiento ; 
   }
   //-----  bayer_tratamiento_paramedico_tratamiento
   function quebra_bayer_tratamiento_paramedico_tratamiento_sc_free_group_by($bayer_tratamiento_paramedico_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_paramedico_tratamiento ;  
      $tot_bayer_tratamiento_paramedico_tratamiento = array() ;  
      $tot_bayer_tratamiento_paramedico_tratamiento[0] = $bayer_tratamiento_paramedico_tratamiento ; 
   }
   //-----  bayer_tratamiento_zona_atencion_paramedico_tratamiento
   function quebra_bayer_tratamiento_zona_atencion_paramedico_tratamiento_sc_free_group_by($bayer_tratamiento_zona_atencion_paramedico_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_zona_atencion_paramedico_tratamiento ;  
      $tot_bayer_tratamiento_zona_atencion_paramedico_tratamiento = array() ;  
      $tot_bayer_tratamiento_zona_atencion_paramedico_tratamiento[0] = $bayer_tratamiento_zona_atencion_paramedico_tratamiento ; 
   }
   //-----  bayer_tratamiento_ciudad_base_paramedico_tratamiento
   function quebra_bayer_tratamiento_ciudad_base_paramedico_tratamiento_sc_free_group_by($bayer_tratamiento_ciudad_base_paramedico_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_ciudad_base_paramedico_tratamiento ;  
      $tot_bayer_tratamiento_ciudad_base_paramedico_tratamiento = array() ;  
      $tot_bayer_tratamiento_ciudad_base_paramedico_tratamiento[0] = $bayer_tratamiento_ciudad_base_paramedico_tratamiento ; 
   }
   //-----  bayer_tratamiento_notas_adjuntos_tratamiento
   function quebra_bayer_tratamiento_notas_adjuntos_tratamiento_sc_free_group_by($bayer_tratamiento_notas_adjuntos_tratamiento, $Where_qb) 
   {
      global $tot_bayer_tratamiento_notas_adjuntos_tratamiento ;  
      $tot_bayer_tratamiento_notas_adjuntos_tratamiento = array() ;  
      $tot_bayer_tratamiento_notas_adjuntos_tratamiento[0] = $bayer_tratamiento_notas_adjuntos_tratamiento ; 
   }
   //-----  bayer_tratamiento_id_paciente_fk
   function quebra_bayer_tratamiento_id_paciente_fk_sc_free_group_by($bayer_tratamiento_id_paciente_fk, $Where_qb) 
   {
      global $tot_bayer_tratamiento_id_paciente_fk ;  
      $tot_bayer_tratamiento_id_paciente_fk = array() ;  
      $tot_bayer_tratamiento_id_paciente_fk[0] = $bayer_tratamiento_id_paciente_fk ; 
   }
   //-----  bayer_gestiones_id_gestion
   function quebra_bayer_gestiones_id_gestion_sc_free_group_by($bayer_gestiones_id_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_id_gestion ;  
      $tot_bayer_gestiones_id_gestion = array() ;  
      $tot_bayer_gestiones_id_gestion[0] = $bayer_gestiones_id_gestion ; 
   }
   //-----  bayer_gestiones_motivo_comunicacion_gestion
   function quebra_bayer_gestiones_motivo_comunicacion_gestion_sc_free_group_by($bayer_gestiones_motivo_comunicacion_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_motivo_comunicacion_gestion ;  
      $tot_bayer_gestiones_motivo_comunicacion_gestion = array() ;  
      $tot_bayer_gestiones_motivo_comunicacion_gestion[0] = $bayer_gestiones_motivo_comunicacion_gestion ; 
   }
   //-----  bayer_gestiones_medio_contacto_gestion
   function quebra_bayer_gestiones_medio_contacto_gestion_sc_free_group_by($bayer_gestiones_medio_contacto_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_medio_contacto_gestion ;  
      $tot_bayer_gestiones_medio_contacto_gestion = array() ;  
      $tot_bayer_gestiones_medio_contacto_gestion[0] = $bayer_gestiones_medio_contacto_gestion ; 
   }
   //-----  bayer_gestiones_tipo_llamada_gestion
   function quebra_bayer_gestiones_tipo_llamada_gestion_sc_free_group_by($bayer_gestiones_tipo_llamada_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_tipo_llamada_gestion ;  
      $tot_bayer_gestiones_tipo_llamada_gestion = array() ;  
      $tot_bayer_gestiones_tipo_llamada_gestion[0] = $bayer_gestiones_tipo_llamada_gestion ; 
   }
   //-----  bayer_gestiones_logro_comunicacion_gestion
   function quebra_bayer_gestiones_logro_comunicacion_gestion_sc_free_group_by($bayer_gestiones_logro_comunicacion_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_logro_comunicacion_gestion ;  
      $tot_bayer_gestiones_logro_comunicacion_gestion = array() ;  
      $tot_bayer_gestiones_logro_comunicacion_gestion[0] = $bayer_gestiones_logro_comunicacion_gestion ; 
   }
   //-----  bayer_gestiones_motivo_no_comunicacion_gestion
   function quebra_bayer_gestiones_motivo_no_comunicacion_gestion_sc_free_group_by($bayer_gestiones_motivo_no_comunicacion_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_motivo_no_comunicacion_gestion ;  
      $tot_bayer_gestiones_motivo_no_comunicacion_gestion = array() ;  
      $tot_bayer_gestiones_motivo_no_comunicacion_gestion[0] = $bayer_gestiones_motivo_no_comunicacion_gestion ; 
   }
   //-----  bayer_gestiones_numero_intentos_gestion
   function quebra_bayer_gestiones_numero_intentos_gestion_sc_free_group_by($bayer_gestiones_numero_intentos_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_numero_intentos_gestion ;  
      $tot_bayer_gestiones_numero_intentos_gestion = array() ;  
      $tot_bayer_gestiones_numero_intentos_gestion[0] = $bayer_gestiones_numero_intentos_gestion ; 
   }
   //-----  bayer_gestiones_esperado_gestion
   function quebra_bayer_gestiones_esperado_gestion_sc_free_group_by($bayer_gestiones_esperado_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_esperado_gestion ;  
      $tot_bayer_gestiones_esperado_gestion = array() ;  
      $tot_bayer_gestiones_esperado_gestion[0] = $bayer_gestiones_esperado_gestion ; 
   }
   //-----  bayer_gestiones_estado_ctc_gestion
   function quebra_bayer_gestiones_estado_ctc_gestion_sc_free_group_by($bayer_gestiones_estado_ctc_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_estado_ctc_gestion ;  
      $tot_bayer_gestiones_estado_ctc_gestion = array() ;  
      $tot_bayer_gestiones_estado_ctc_gestion[0] = $bayer_gestiones_estado_ctc_gestion ; 
   }
   //-----  bayer_gestiones_estado_farmacia_gestion
   function quebra_bayer_gestiones_estado_farmacia_gestion_sc_free_group_by($bayer_gestiones_estado_farmacia_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_estado_farmacia_gestion ;  
      $tot_bayer_gestiones_estado_farmacia_gestion = array() ;  
      $tot_bayer_gestiones_estado_farmacia_gestion[0] = $bayer_gestiones_estado_farmacia_gestion ; 
   }
   //-----  bayer_gestiones_reclamo_gestion
   function quebra_bayer_gestiones_reclamo_gestion_sc_free_group_by($bayer_gestiones_reclamo_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_reclamo_gestion ;  
      $tot_bayer_gestiones_reclamo_gestion = array() ;  
      $tot_bayer_gestiones_reclamo_gestion[0] = $bayer_gestiones_reclamo_gestion ; 
   }
   //-----  bayer_gestiones_causa_no_reclamacion_gestion
   function quebra_bayer_gestiones_causa_no_reclamacion_gestion_sc_free_group_by($bayer_gestiones_causa_no_reclamacion_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_causa_no_reclamacion_gestion ;  
      $tot_bayer_gestiones_causa_no_reclamacion_gestion = array() ;  
      $tot_bayer_gestiones_causa_no_reclamacion_gestion[0] = $bayer_gestiones_causa_no_reclamacion_gestion ; 
   }
   //-----  bayer_gestiones_dificultad_acceso_gestion
   function quebra_bayer_gestiones_dificultad_acceso_gestion_sc_free_group_by($bayer_gestiones_dificultad_acceso_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_dificultad_acceso_gestion ;  
      $tot_bayer_gestiones_dificultad_acceso_gestion = array() ;  
      $tot_bayer_gestiones_dificultad_acceso_gestion[0] = $bayer_gestiones_dificultad_acceso_gestion ; 
   }
   //-----  bayer_gestiones_tipo_dificultad_gestion
   function quebra_bayer_gestiones_tipo_dificultad_gestion_sc_free_group_by($bayer_gestiones_tipo_dificultad_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_tipo_dificultad_gestion ;  
      $tot_bayer_gestiones_tipo_dificultad_gestion = array() ;  
      $tot_bayer_gestiones_tipo_dificultad_gestion[0] = $bayer_gestiones_tipo_dificultad_gestion ; 
   }
   //-----  bayer_gestiones_envios_gestion
   function quebra_bayer_gestiones_envios_gestion_sc_free_group_by($bayer_gestiones_envios_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_envios_gestion ;  
      $tot_bayer_gestiones_envios_gestion = array() ;  
      $tot_bayer_gestiones_envios_gestion[0] = $bayer_gestiones_envios_gestion ; 
   }
   //-----  bayer_gestiones_medicamentos_gestion
   function quebra_bayer_gestiones_medicamentos_gestion_sc_free_group_by($bayer_gestiones_medicamentos_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_medicamentos_gestion ;  
      $tot_bayer_gestiones_medicamentos_gestion = array() ;  
      $tot_bayer_gestiones_medicamentos_gestion[0] = $bayer_gestiones_medicamentos_gestion ; 
   }
   //-----  bayer_gestiones_tipo_envio_gestion
   function quebra_bayer_gestiones_tipo_envio_gestion_sc_free_group_by($bayer_gestiones_tipo_envio_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_tipo_envio_gestion ;  
      $tot_bayer_gestiones_tipo_envio_gestion = array() ;  
      $tot_bayer_gestiones_tipo_envio_gestion[0] = $bayer_gestiones_tipo_envio_gestion ; 
   }
   //-----  bayer_gestiones_evento_adverso_gestion
   function quebra_bayer_gestiones_evento_adverso_gestion_sc_free_group_by($bayer_gestiones_evento_adverso_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_evento_adverso_gestion ;  
      $tot_bayer_gestiones_evento_adverso_gestion = array() ;  
      $tot_bayer_gestiones_evento_adverso_gestion[0] = $bayer_gestiones_evento_adverso_gestion ; 
   }
   //-----  bayer_gestiones_tipo_evento_adverso
   function quebra_bayer_gestiones_tipo_evento_adverso_sc_free_group_by($bayer_gestiones_tipo_evento_adverso, $Where_qb) 
   {
      global $tot_bayer_gestiones_tipo_evento_adverso ;  
      $tot_bayer_gestiones_tipo_evento_adverso = array() ;  
      $tot_bayer_gestiones_tipo_evento_adverso[0] = $bayer_gestiones_tipo_evento_adverso ; 
   }
   //-----  bayer_gestiones_genera_solicitud_gestion
   function quebra_bayer_gestiones_genera_solicitud_gestion_sc_free_group_by($bayer_gestiones_genera_solicitud_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_genera_solicitud_gestion ;  
      $tot_bayer_gestiones_genera_solicitud_gestion = array() ;  
      $tot_bayer_gestiones_genera_solicitud_gestion[0] = $bayer_gestiones_genera_solicitud_gestion ; 
   }
   //-----  bayer_gestiones_fecha_proxima_llamada
   function quebra_bayer_gestiones_fecha_proxima_llamada_sc_free_group_by($bayer_gestiones_fecha_proxima_llamada, $Where_qb) 
   {
      global $tot_bayer_gestiones_fecha_proxima_llamada ;  
      $tot_bayer_gestiones_fecha_proxima_llamada = array() ;  
      $tot_bayer_gestiones_fecha_proxima_llamada[0] = $bayer_gestiones_fecha_proxima_llamada ; 
   }
   //-----  bayer_gestiones_motivo_proxima_llamada
   function quebra_bayer_gestiones_motivo_proxima_llamada_sc_free_group_by($bayer_gestiones_motivo_proxima_llamada, $Where_qb) 
   {
      global $tot_bayer_gestiones_motivo_proxima_llamada ;  
      $tot_bayer_gestiones_motivo_proxima_llamada = array() ;  
      $tot_bayer_gestiones_motivo_proxima_llamada[0] = $bayer_gestiones_motivo_proxima_llamada ; 
   }
   //-----  bayer_gestiones_observacion_proxima_llamada
   function quebra_bayer_gestiones_observacion_proxima_llamada_sc_free_group_by($bayer_gestiones_observacion_proxima_llamada, $Where_qb) 
   {
      global $tot_bayer_gestiones_observacion_proxima_llamada ;  
      $tot_bayer_gestiones_observacion_proxima_llamada = array() ;  
      $tot_bayer_gestiones_observacion_proxima_llamada[0] = $bayer_gestiones_observacion_proxima_llamada ; 
   }
   //-----  bayer_gestiones_fecha_reclamacion_gestion
   function quebra_bayer_gestiones_fecha_reclamacion_gestion_sc_free_group_by($bayer_gestiones_fecha_reclamacion_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_fecha_reclamacion_gestion ;  
      $tot_bayer_gestiones_fecha_reclamacion_gestion = array() ;  
      $tot_bayer_gestiones_fecha_reclamacion_gestion[0] = $bayer_gestiones_fecha_reclamacion_gestion ; 
   }
   //-----  bayer_gestiones_consecutivo_gestion
   function quebra_bayer_gestiones_consecutivo_gestion_sc_free_group_by($bayer_gestiones_consecutivo_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_consecutivo_gestion ;  
      $tot_bayer_gestiones_consecutivo_gestion = array() ;  
      $tot_bayer_gestiones_consecutivo_gestion[0] = $bayer_gestiones_consecutivo_gestion ; 
   }
   //-----  bayer_gestiones_autor_gestion
   function quebra_bayer_gestiones_autor_gestion_sc_free_group_by($bayer_gestiones_autor_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_autor_gestion ;  
      $tot_bayer_gestiones_autor_gestion = array() ;  
      $tot_bayer_gestiones_autor_gestion[0] = $bayer_gestiones_autor_gestion ; 
   }
   //-----  bayer_gestiones_nota
   function quebra_bayer_gestiones_nota_sc_free_group_by($bayer_gestiones_nota, $Where_qb) 
   {
      global $tot_bayer_gestiones_nota ;  
      $tot_bayer_gestiones_nota = array() ;  
      $tot_bayer_gestiones_nota[0] = $bayer_gestiones_nota ; 
   }
   //-----  bayer_gestiones_fecha_programada_gestion
   function quebra_bayer_gestiones_fecha_programada_gestion_sc_free_group_by($bayer_gestiones_fecha_programada_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_fecha_programada_gestion ;  
      $tot_bayer_gestiones_fecha_programada_gestion = array() ;  
      $tot_bayer_gestiones_fecha_programada_gestion[0] = $bayer_gestiones_fecha_programada_gestion ; 
   }
   //-----  bayer_gestiones_usuario_asigando
   function quebra_bayer_gestiones_usuario_asigando_sc_free_group_by($bayer_gestiones_usuario_asigando, $Where_qb) 
   {
      global $tot_bayer_gestiones_usuario_asigando ;  
      $tot_bayer_gestiones_usuario_asigando = array() ;  
      $tot_bayer_gestiones_usuario_asigando[0] = $bayer_gestiones_usuario_asigando ; 
   }
   //-----  bayer_gestiones_id_paciente_fk2
   function quebra_bayer_gestiones_id_paciente_fk2_sc_free_group_by($bayer_gestiones_id_paciente_fk2, $Where_qb) 
   {
      global $tot_bayer_gestiones_id_paciente_fk2 ;  
      $tot_bayer_gestiones_id_paciente_fk2 = array() ;  
      $tot_bayer_gestiones_id_paciente_fk2[0] = $bayer_gestiones_id_paciente_fk2 ; 
   }
   //-----  bayer_gestiones_fecha_comunicacion
   function quebra_bayer_gestiones_fecha_comunicacion_sc_free_group_by($bayer_gestiones_fecha_comunicacion, $Where_qb) 
   {
      global $tot_bayer_gestiones_fecha_comunicacion , $Sc_groupby_bayer_gestiones_fecha_comunicacion;  
      $tot_bayer_gestiones_fecha_comunicacion = array() ;  
      $tot_bayer_gestiones_fecha_comunicacion[0] = $bayer_gestiones_fecha_comunicacion ; 
   }
   //-----  bayer_gestiones_estado_gestion
   function quebra_bayer_gestiones_estado_gestion_sc_free_group_by($bayer_gestiones_estado_gestion, $Where_qb) 
   {
      global $tot_bayer_gestiones_estado_gestion , $Sc_groupby_bayer_gestiones_fecha_comunicacion;  
      $tot_bayer_gestiones_estado_gestion = array() ;  
      $tot_bayer_gestiones_estado_gestion[0] = $bayer_gestiones_estado_gestion ; 
   }
   //-----  bayer_gestiones_codigo_argus
   function quebra_bayer_gestiones_codigo_argus_sc_free_group_by($bayer_gestiones_codigo_argus, $Where_qb) 
   {
      global $tot_bayer_gestiones_codigo_argus , $Sc_groupby_bayer_gestiones_fecha_comunicacion;  
      $tot_bayer_gestiones_codigo_argus = array() ;  
      $tot_bayer_gestiones_codigo_argus[0] = $bayer_gestiones_codigo_argus ; 
   }
   //-----  bayer_gestiones_numero_cajas
   function quebra_bayer_gestiones_numero_cajas_sc_free_group_by($bayer_gestiones_numero_cajas, $Where_qb) 
   {
      global $tot_bayer_gestiones_numero_cajas , $Sc_groupby_bayer_gestiones_fecha_comunicacion;  
      $tot_bayer_gestiones_numero_cajas = array() ;  
      $tot_bayer_gestiones_numero_cajas[0] = $bayer_gestiones_numero_cajas ; 
   }

   //----- 
   function resumo_sc_free_group_by($destino_resumo, &$array_total_bayer_pacientes_id_paciente, &$array_total_bayer_pacientes_estado_paciente, &$array_total_bayer_pacientes_fecha_activacion_paciente, &$array_total_bayer_pacientes_fecha_retiro_paciente, &$array_total_bayer_pacientes_motivo_retiro_paciente, &$array_total_bayer_pacientes_observacion_motivo_retiro_paciente, &$array_total_bayer_pacientes_identificacion_paciente, &$array_total_bayer_pacientes_nombre_paciente, &$array_total_bayer_pacientes_apellido_paciente, &$array_total_bayer_pacientes_telefono_paciente, &$array_total_bayer_pacientes_telefono2_paciente, &$array_total_bayer_pacientes_telefono3_paciente, &$array_total_bayer_pacientes_correo_paciente, &$array_total_bayer_pacientes_direccion_paciente, &$array_total_bayer_pacientes_barrio_paciente, &$array_total_bayer_pacientes_departamento_paciente, &$array_total_bayer_pacientes_ciudad_paciente, &$array_total_bayer_pacientes_genero_paciente, &$array_total_bayer_pacientes_fecha_nacimineto_paciente, &$array_total_bayer_pacientes_edad_paciente, &$array_total_bayer_pacientes_acudiente_paciente, &$array_total_bayer_pacientes_telefono_acudiente_paciente, &$array_total_bayer_pacientes_codigo_xofigo, &$array_total_bayer_pacientes_status_paciente, &$array_total_bayer_pacientes_id_ultima_gestion, &$array_total_bayer_pacientes_usuario_creacion, &$array_total_bayer_tratamiento_id_tratamiento, &$array_total_bayer_tratamiento_producto_tratamiento, &$array_total_bayer_tratamiento_nombre_referencia, &$array_total_bayer_tratamiento_clasificacion_patologica_tratamiento, &$array_total_bayer_tratamiento_tratamiento_previo, &$array_total_bayer_tratamiento_consentimiento_tratamiento, &$array_total_bayer_tratamiento_fecha_inicio_terapia_tratamiento, &$array_total_bayer_tratamiento_regimen_tratamiento, &$array_total_bayer_tratamiento_asegurador_tratamiento, &$array_total_bayer_tratamiento_operador_logistico_tratamiento, &$array_total_bayer_tratamiento_punto_entrega, &$array_total_bayer_tratamiento_fecha_ultima_reclamacion_tratamiento, &$array_total_bayer_tratamiento_otros_operadores_tratamiento, &$array_total_bayer_tratamiento_medios_adquisicion_tratamiento, &$array_total_bayer_tratamiento_ips_atiende_tratamiento, &$array_total_bayer_tratamiento_medico_tratamiento, &$array_total_bayer_tratamiento_especialidad_tratamiento, &$array_total_bayer_tratamiento_paramedico_tratamiento, &$array_total_bayer_tratamiento_zona_atencion_paramedico_tratamiento, &$array_total_bayer_tratamiento_ciudad_base_paramedico_tratamiento, &$array_total_bayer_tratamiento_notas_adjuntos_tratamiento, &$array_total_bayer_tratamiento_id_paciente_fk, &$array_total_bayer_gestiones_id_gestion, &$array_total_bayer_gestiones_motivo_comunicacion_gestion, &$array_total_bayer_gestiones_medio_contacto_gestion, &$array_total_bayer_gestiones_tipo_llamada_gestion, &$array_total_bayer_gestiones_logro_comunicacion_gestion, &$array_total_bayer_gestiones_motivo_no_comunicacion_gestion, &$array_total_bayer_gestiones_numero_intentos_gestion, &$array_total_bayer_gestiones_esperado_gestion, &$array_total_bayer_gestiones_estado_ctc_gestion, &$array_total_bayer_gestiones_estado_farmacia_gestion, &$array_total_bayer_gestiones_reclamo_gestion, &$array_total_bayer_gestiones_causa_no_reclamacion_gestion, &$array_total_bayer_gestiones_dificultad_acceso_gestion, &$array_total_bayer_gestiones_tipo_dificultad_gestion, &$array_total_bayer_gestiones_envios_gestion, &$array_total_bayer_gestiones_medicamentos_gestion, &$array_total_bayer_gestiones_tipo_envio_gestion, &$array_total_bayer_gestiones_evento_adverso_gestion, &$array_total_bayer_gestiones_tipo_evento_adverso, &$array_total_bayer_gestiones_genera_solicitud_gestion, &$array_total_bayer_gestiones_fecha_proxima_llamada, &$array_total_bayer_gestiones_motivo_proxima_llamada, &$array_total_bayer_gestiones_observacion_proxima_llamada, &$array_total_bayer_gestiones_fecha_reclamacion_gestion, &$array_total_bayer_gestiones_consecutivo_gestion, &$array_total_bayer_gestiones_autor_gestion, &$array_total_bayer_gestiones_nota, &$array_total_bayer_gestiones_fecha_programada_gestion, &$array_total_bayer_gestiones_usuario_asigando, &$array_total_bayer_gestiones_id_paciente_fk2, &$array_total_bayer_gestiones_fecha_comunicacion, &$array_total_bayer_gestiones_estado_gestion, &$array_total_bayer_gestiones_codigo_argus, &$array_total_bayer_gestiones_numero_cajas)
   {
      global $nada, $nm_lang;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca']))
   { 
      $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
       $this->bayer_pacientes_fecha_activacion_paciente = $Busca_temp['bayer_pacientes_fecha_activacion_paciente']; 
       $tmp_pos = strpos($this->bayer_pacientes_fecha_activacion_paciente, "##@@");
       if ($tmp_pos !== false)
       {
           $this->bayer_pacientes_fecha_activacion_paciente = substr($this->bayer_pacientes_fecha_activacion_paciente, 0, $tmp_pos);
       }
       $this->bayer_gestiones_fecha_comunicacion = $Busca_temp['bayer_gestiones_fecha_comunicacion']; 
       $tmp_pos = strpos($this->bayer_gestiones_fecha_comunicacion, "##@@");
       if ($tmp_pos !== false)
       {
           $this->bayer_gestiones_fecha_comunicacion = substr($this->bayer_gestiones_fecha_comunicacion, 0, $tmp_pos);
       }
       $this->bayer_gestiones_fecha_comunicacion_2 = $Busca_temp['bayer_gestiones_fecha_comunicacion_input_2']; 
   } 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq_filtro'];
   $temp = "";
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_sql'] as $cmp_gb => $ord)
   {
       $temp .= (empty($temp)) ? $cmp_gb . " " . $ord : ", " . $cmp_gb . " " . $ord;
   }
   $nmgp_order_by = (!empty($temp)) ? " order by " . $temp : "";
   $free_group_by = "";
   $all_sql_free  = array();
   $all_sql_free[] = "bayer_pacientes.ID_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.ESTADO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.FECHA_ACTIVACION_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.FECHA_RETIRO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.MOTIVO_RETIRO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.IDENTIFICACION_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.NOMBRE_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.APELLIDO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.TELEFONO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.TELEFONO2_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.TELEFONO3_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.CORREO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.DIRECCION_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.BARRIO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.DEPARTAMENTO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.CIUDAD_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.GENERO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.FECHA_NACIMINETO_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.EDAD_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.ACUDIENTE_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.CODIGO_XOFIGO";
   $all_sql_free[] = "bayer_pacientes.STATUS_PACIENTE";
   $all_sql_free[] = "bayer_pacientes.ID_ULTIMA_GESTION";
   $all_sql_free[] = "bayer_pacientes.USUARIO_CREACION";
   $all_sql_free[] = "bayer_tratamiento.ID_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.PRODUCTO_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.NOMBRE_REFERENCIA";
   $all_sql_free[] = "bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.TRATAMIENTO_PREVIO";
   $all_sql_free[] = "bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.REGIMEN_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.ASEGURADOR_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.PUNTO_ENTREGA";
   $all_sql_free[] = "bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.MEDICO_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.PARAMEDICO_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO";
   $all_sql_free[] = "bayer_tratamiento.ID_PACIENTE_FK";
   $all_sql_free[] = "bayer_gestiones.ID_GESTION";
   $all_sql_free[] = "bayer_gestiones.MOTIVO_COMUNICACION_GESTION";
   $all_sql_free[] = "bayer_gestiones.MEDIO_CONTACTO_GESTION";
   $all_sql_free[] = "bayer_gestiones.TIPO_LLAMADA_GESTION";
   $all_sql_free[] = "bayer_gestiones.LOGRO_COMUNICACION_GESTION";
   $all_sql_free[] = "bayer_gestiones.MOTIVO_NO_COMUNICACION_GESTION";
   $all_sql_free[] = "bayer_gestiones.NUMERO_INTENTOS_GESTION";
   $all_sql_free[] = "bayer_gestiones.ESPERADO_GESTION";
   $all_sql_free[] = "bayer_gestiones.ESTADO_CTC_GESTION";
   $all_sql_free[] = "bayer_gestiones.ESTADO_FARMACIA_GESTION";
   $all_sql_free[] = "bayer_gestiones.RECLAMO_GESTION";
   $all_sql_free[] = "bayer_gestiones.CAUSA_NO_RECLAMACION_GESTION";
   $all_sql_free[] = "bayer_gestiones.DIFICULTAD_ACCESO_GESTION";
   $all_sql_free[] = "bayer_gestiones.TIPO_DIFICULTAD_GESTION";
   $all_sql_free[] = "bayer_gestiones.ENVIOS_GESTION";
   $all_sql_free[] = "bayer_gestiones.MEDICAMENTOS_GESTION";
   $all_sql_free[] = "bayer_gestiones.TIPO_ENVIO_GESTION";
   $all_sql_free[] = "bayer_gestiones.EVENTO_ADVERSO_GESTION";
   $all_sql_free[] = "bayer_gestiones.TIPO_EVENTO_ADVERSO";
   $all_sql_free[] = "bayer_gestiones.GENERA_SOLICITUD_GESTION";
   $all_sql_free[] = "bayer_gestiones.FECHA_PROXIMA_LLAMADA";
   $all_sql_free[] = "bayer_gestiones.MOTIVO_PROXIMA_LLAMADA";
   $all_sql_free[] = "bayer_gestiones.OBSERVACION_PROXIMA_LLAMADA";
   $all_sql_free[] = "bayer_gestiones.FECHA_RECLAMACION_GESTION";
   $all_sql_free[] = "bayer_gestiones.CONSECUTIVO_GESTION";
   $all_sql_free[] = "bayer_gestiones.AUTOR_GESTION";
   $all_sql_free[] = "bayer_gestiones.NOTA";
   $all_sql_free[] = "bayer_gestiones.FECHA_PROGRAMADA_GESTION";
   $all_sql_free[] = "bayer_gestiones.USUARIO_ASIGANDO";
   $all_sql_free[] = "bayer_gestiones.ID_PACIENTE_FK2";
   $all_sql_free[] = "bayer_gestiones.FECHA_COMUNICACION";
   $all_sql_free[] = "bayer_gestiones.ESTADO_GESTION";
   $all_sql_free[] = "bayer_gestiones.CODIGO_ARGUS";
   $all_sql_free[] = "bayer_gestiones.NUMERO_CAJAS";
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_sql'] as $cmp_gb => $ord)
   {
       $free_group_by .= (empty($free_group_by)) ? $cmp_gb : ", " . $cmp_gb;
   }
   foreach ($all_sql_free as $cmp_gb)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_sql'][$cmp_gb]))
       {
           $free_group_by .= (empty($free_group_by)) ? $cmp_gb : ", " . $cmp_gb;
       }
   }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
         $comando  = "select count(*), bayer_pacientes.ID_PACIENTE, bayer_pacientes.ESTADO_PACIENTE, bayer_pacientes.FECHA_ACTIVACION_PACIENTE, bayer_pacientes.FECHA_RETIRO_PACIENTE, bayer_pacientes.MOTIVO_RETIRO_PACIENTE, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE, bayer_pacientes.IDENTIFICACION_PACIENTE, bayer_pacientes.NOMBRE_PACIENTE, bayer_pacientes.APELLIDO_PACIENTE, bayer_pacientes.TELEFONO_PACIENTE, bayer_pacientes.TELEFONO2_PACIENTE, bayer_pacientes.TELEFONO3_PACIENTE, bayer_pacientes.CORREO_PACIENTE, bayer_pacientes.DIRECCION_PACIENTE, bayer_pacientes.BARRIO_PACIENTE, bayer_pacientes.DEPARTAMENTO_PACIENTE, bayer_pacientes.CIUDAD_PACIENTE, bayer_pacientes.GENERO_PACIENTE, bayer_pacientes.FECHA_NACIMINETO_PACIENTE, bayer_pacientes.EDAD_PACIENTE, bayer_pacientes.ACUDIENTE_PACIENTE, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE, bayer_pacientes.CODIGO_XOFIGO, bayer_pacientes.STATUS_PACIENTE, bayer_pacientes.ID_ULTIMA_GESTION, bayer_pacientes.USUARIO_CREACION, bayer_tratamiento.ID_TRATAMIENTO, bayer_tratamiento.PRODUCTO_TRATAMIENTO, bayer_tratamiento.NOMBRE_REFERENCIA, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO, bayer_tratamiento.TRATAMIENTO_PREVIO, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO, bayer_tratamiento.REGIMEN_TRATAMIENTO, bayer_tratamiento.ASEGURADOR_TRATAMIENTO, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO, bayer_tratamiento.PUNTO_ENTREGA, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO, bayer_tratamiento.MEDICO_TRATAMIENTO, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO, bayer_tratamiento.PARAMEDICO_TRATAMIENTO, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO, bayer_tratamiento.ID_PACIENTE_FK, bayer_gestiones.ID_GESTION, bayer_gestiones.MOTIVO_COMUNICACION_GESTION, bayer_gestiones.MEDIO_CONTACTO_GESTION, bayer_gestiones.TIPO_LLAMADA_GESTION, bayer_gestiones.LOGRO_COMUNICACION_GESTION, bayer_gestiones.MOTIVO_NO_COMUNICACION_GESTION, bayer_gestiones.NUMERO_INTENTOS_GESTION, bayer_gestiones.ESPERADO_GESTION, bayer_gestiones.ESTADO_CTC_GESTION, bayer_gestiones.ESTADO_FARMACIA_GESTION, bayer_gestiones.RECLAMO_GESTION, bayer_gestiones.CAUSA_NO_RECLAMACION_GESTION, bayer_gestiones.DIFICULTAD_ACCESO_GESTION, bayer_gestiones.TIPO_DIFICULTAD_GESTION, bayer_gestiones.ENVIOS_GESTION, bayer_gestiones.MEDICAMENTOS_GESTION, bayer_gestiones.TIPO_ENVIO_GESTION, bayer_gestiones.EVENTO_ADVERSO_GESTION, bayer_gestiones.TIPO_EVENTO_ADVERSO, bayer_gestiones.GENERA_SOLICITUD_GESTION, bayer_gestiones.FECHA_PROXIMA_LLAMADA, bayer_gestiones.MOTIVO_PROXIMA_LLAMADA, bayer_gestiones.OBSERVACION_PROXIMA_LLAMADA, bayer_gestiones.FECHA_RECLAMACION_GESTION, bayer_gestiones.CONSECUTIVO_GESTION, bayer_gestiones.AUTOR_GESTION, bayer_gestiones.NOTA, bayer_gestiones.FECHA_PROGRAMADA_GESTION, bayer_gestiones.USUARIO_ASIGANDO, bayer_gestiones.ID_PACIENTE_FK2, str_replace (convert(char(10),bayer_gestiones.FECHA_COMUNICACION,102), '.', '-') + ' ' + convert(char(8),bayer_gestiones.FECHA_COMUNICACION,20), bayer_gestiones.ESTADO_GESTION, bayer_gestiones.CODIGO_ARGUS, bayer_gestiones.NUMERO_CAJAS from " . $this->Ini->nm_tabela . " " .  $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $comando  = "select count(*), bayer_pacientes.ID_PACIENTE, bayer_pacientes.ESTADO_PACIENTE, bayer_pacientes.FECHA_ACTIVACION_PACIENTE, bayer_pacientes.FECHA_RETIRO_PACIENTE, bayer_pacientes.MOTIVO_RETIRO_PACIENTE, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE, bayer_pacientes.IDENTIFICACION_PACIENTE, bayer_pacientes.NOMBRE_PACIENTE, bayer_pacientes.APELLIDO_PACIENTE, bayer_pacientes.TELEFONO_PACIENTE, bayer_pacientes.TELEFONO2_PACIENTE, bayer_pacientes.TELEFONO3_PACIENTE, bayer_pacientes.CORREO_PACIENTE, bayer_pacientes.DIRECCION_PACIENTE, bayer_pacientes.BARRIO_PACIENTE, bayer_pacientes.DEPARTAMENTO_PACIENTE, bayer_pacientes.CIUDAD_PACIENTE, bayer_pacientes.GENERO_PACIENTE, bayer_pacientes.FECHA_NACIMINETO_PACIENTE, bayer_pacientes.EDAD_PACIENTE, bayer_pacientes.ACUDIENTE_PACIENTE, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE, bayer_pacientes.CODIGO_XOFIGO, bayer_pacientes.STATUS_PACIENTE, bayer_pacientes.ID_ULTIMA_GESTION, bayer_pacientes.USUARIO_CREACION, bayer_tratamiento.ID_TRATAMIENTO, bayer_tratamiento.PRODUCTO_TRATAMIENTO, bayer_tratamiento.NOMBRE_REFERENCIA, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO, bayer_tratamiento.TRATAMIENTO_PREVIO, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO, bayer_tratamiento.REGIMEN_TRATAMIENTO, bayer_tratamiento.ASEGURADOR_TRATAMIENTO, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO, bayer_tratamiento.PUNTO_ENTREGA, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO, bayer_tratamiento.MEDICO_TRATAMIENTO, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO, bayer_tratamiento.PARAMEDICO_TRATAMIENTO, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO, bayer_tratamiento.ID_PACIENTE_FK, bayer_gestiones.ID_GESTION, bayer_gestiones.MOTIVO_COMUNICACION_GESTION, bayer_gestiones.MEDIO_CONTACTO_GESTION, bayer_gestiones.TIPO_LLAMADA_GESTION, bayer_gestiones.LOGRO_COMUNICACION_GESTION, bayer_gestiones.MOTIVO_NO_COMUNICACION_GESTION, bayer_gestiones.NUMERO_INTENTOS_GESTION, bayer_gestiones.ESPERADO_GESTION, bayer_gestiones.ESTADO_CTC_GESTION, bayer_gestiones.ESTADO_FARMACIA_GESTION, bayer_gestiones.RECLAMO_GESTION, bayer_gestiones.CAUSA_NO_RECLAMACION_GESTION, bayer_gestiones.DIFICULTAD_ACCESO_GESTION, bayer_gestiones.TIPO_DIFICULTAD_GESTION, bayer_gestiones.ENVIOS_GESTION, bayer_gestiones.MEDICAMENTOS_GESTION, bayer_gestiones.TIPO_ENVIO_GESTION, bayer_gestiones.EVENTO_ADVERSO_GESTION, bayer_gestiones.TIPO_EVENTO_ADVERSO, bayer_gestiones.GENERA_SOLICITUD_GESTION, bayer_gestiones.FECHA_PROXIMA_LLAMADA, bayer_gestiones.MOTIVO_PROXIMA_LLAMADA, bayer_gestiones.OBSERVACION_PROXIMA_LLAMADA, bayer_gestiones.FECHA_RECLAMACION_GESTION, bayer_gestiones.CONSECUTIVO_GESTION, bayer_gestiones.AUTOR_GESTION, bayer_gestiones.NOTA, bayer_gestiones.FECHA_PROGRAMADA_GESTION, bayer_gestiones.USUARIO_ASIGANDO, bayer_gestiones.ID_PACIENTE_FK2, convert(char(23),bayer_gestiones.FECHA_COMUNICACION,121), bayer_gestiones.ESTADO_GESTION, bayer_gestiones.CODIGO_ARGUS, bayer_gestiones.NUMERO_CAJAS from " . $this->Ini->nm_tabela . " " .  $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
         $comando  = "select count(*), bayer_pacientes.ID_PACIENTE, bayer_pacientes.ESTADO_PACIENTE, bayer_pacientes.FECHA_ACTIVACION_PACIENTE, bayer_pacientes.FECHA_RETIRO_PACIENTE, bayer_pacientes.MOTIVO_RETIRO_PACIENTE, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE, bayer_pacientes.IDENTIFICACION_PACIENTE, bayer_pacientes.NOMBRE_PACIENTE, bayer_pacientes.APELLIDO_PACIENTE, bayer_pacientes.TELEFONO_PACIENTE, bayer_pacientes.TELEFONO2_PACIENTE, bayer_pacientes.TELEFONO3_PACIENTE, bayer_pacientes.CORREO_PACIENTE, bayer_pacientes.DIRECCION_PACIENTE, bayer_pacientes.BARRIO_PACIENTE, bayer_pacientes.DEPARTAMENTO_PACIENTE, bayer_pacientes.CIUDAD_PACIENTE, bayer_pacientes.GENERO_PACIENTE, bayer_pacientes.FECHA_NACIMINETO_PACIENTE, bayer_pacientes.EDAD_PACIENTE, bayer_pacientes.ACUDIENTE_PACIENTE, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE, bayer_pacientes.CODIGO_XOFIGO, bayer_pacientes.STATUS_PACIENTE, bayer_pacientes.ID_ULTIMA_GESTION, bayer_pacientes.USUARIO_CREACION, bayer_tratamiento.ID_TRATAMIENTO, bayer_tratamiento.PRODUCTO_TRATAMIENTO, bayer_tratamiento.NOMBRE_REFERENCIA, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO, bayer_tratamiento.TRATAMIENTO_PREVIO, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO, bayer_tratamiento.REGIMEN_TRATAMIENTO, bayer_tratamiento.ASEGURADOR_TRATAMIENTO, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO, bayer_tratamiento.PUNTO_ENTREGA, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO, bayer_tratamiento.MEDICO_TRATAMIENTO, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO, bayer_tratamiento.PARAMEDICO_TRATAMIENTO, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO, bayer_tratamiento.ID_PACIENTE_FK, bayer_gestiones.ID_GESTION, bayer_gestiones.MOTIVO_COMUNICACION_GESTION, bayer_gestiones.MEDIO_CONTACTO_GESTION, bayer_gestiones.TIPO_LLAMADA_GESTION, bayer_gestiones.LOGRO_COMUNICACION_GESTION, bayer_gestiones.MOTIVO_NO_COMUNICACION_GESTION, bayer_gestiones.NUMERO_INTENTOS_GESTION, bayer_gestiones.ESPERADO_GESTION, bayer_gestiones.ESTADO_CTC_GESTION, bayer_gestiones.ESTADO_FARMACIA_GESTION, bayer_gestiones.RECLAMO_GESTION, bayer_gestiones.CAUSA_NO_RECLAMACION_GESTION, bayer_gestiones.DIFICULTAD_ACCESO_GESTION, bayer_gestiones.TIPO_DIFICULTAD_GESTION, bayer_gestiones.ENVIOS_GESTION, bayer_gestiones.MEDICAMENTOS_GESTION, bayer_gestiones.TIPO_ENVIO_GESTION, bayer_gestiones.EVENTO_ADVERSO_GESTION, bayer_gestiones.TIPO_EVENTO_ADVERSO, bayer_gestiones.GENERA_SOLICITUD_GESTION, bayer_gestiones.FECHA_PROXIMA_LLAMADA, bayer_gestiones.MOTIVO_PROXIMA_LLAMADA, bayer_gestiones.OBSERVACION_PROXIMA_LLAMADA, bayer_gestiones.FECHA_RECLAMACION_GESTION, bayer_gestiones.CONSECUTIVO_GESTION, bayer_gestiones.AUTOR_GESTION, bayer_gestiones.NOTA, bayer_gestiones.FECHA_PROGRAMADA_GESTION, bayer_gestiones.USUARIO_ASIGANDO, bayer_gestiones.ID_PACIENTE_FK2, TO_DATE(TO_CHAR(bayer_gestiones.FECHA_COMUNICACION, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), bayer_gestiones.ESTADO_GESTION, bayer_gestiones.CODIGO_ARGUS, bayer_gestiones.NUMERO_CAJAS from " . $this->Ini->nm_tabela . " " . $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
      } 
      else 
      { 
         $comando  = "select count(*), bayer_pacientes.ID_PACIENTE, bayer_pacientes.ESTADO_PACIENTE, bayer_pacientes.FECHA_ACTIVACION_PACIENTE, bayer_pacientes.FECHA_RETIRO_PACIENTE, bayer_pacientes.MOTIVO_RETIRO_PACIENTE, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE, bayer_pacientes.IDENTIFICACION_PACIENTE, bayer_pacientes.NOMBRE_PACIENTE, bayer_pacientes.APELLIDO_PACIENTE, bayer_pacientes.TELEFONO_PACIENTE, bayer_pacientes.TELEFONO2_PACIENTE, bayer_pacientes.TELEFONO3_PACIENTE, bayer_pacientes.CORREO_PACIENTE, bayer_pacientes.DIRECCION_PACIENTE, bayer_pacientes.BARRIO_PACIENTE, bayer_pacientes.DEPARTAMENTO_PACIENTE, bayer_pacientes.CIUDAD_PACIENTE, bayer_pacientes.GENERO_PACIENTE, bayer_pacientes.FECHA_NACIMINETO_PACIENTE, bayer_pacientes.EDAD_PACIENTE, bayer_pacientes.ACUDIENTE_PACIENTE, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE, bayer_pacientes.CODIGO_XOFIGO, bayer_pacientes.STATUS_PACIENTE, bayer_pacientes.ID_ULTIMA_GESTION, bayer_pacientes.USUARIO_CREACION, bayer_tratamiento.ID_TRATAMIENTO, bayer_tratamiento.PRODUCTO_TRATAMIENTO, bayer_tratamiento.NOMBRE_REFERENCIA, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO, bayer_tratamiento.TRATAMIENTO_PREVIO, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO, bayer_tratamiento.REGIMEN_TRATAMIENTO, bayer_tratamiento.ASEGURADOR_TRATAMIENTO, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO, bayer_tratamiento.PUNTO_ENTREGA, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO, bayer_tratamiento.MEDICO_TRATAMIENTO, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO, bayer_tratamiento.PARAMEDICO_TRATAMIENTO, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO, bayer_tratamiento.ID_PACIENTE_FK, bayer_gestiones.ID_GESTION, bayer_gestiones.MOTIVO_COMUNICACION_GESTION, bayer_gestiones.MEDIO_CONTACTO_GESTION, bayer_gestiones.TIPO_LLAMADA_GESTION, bayer_gestiones.LOGRO_COMUNICACION_GESTION, bayer_gestiones.MOTIVO_NO_COMUNICACION_GESTION, bayer_gestiones.NUMERO_INTENTOS_GESTION, bayer_gestiones.ESPERADO_GESTION, bayer_gestiones.ESTADO_CTC_GESTION, bayer_gestiones.ESTADO_FARMACIA_GESTION, bayer_gestiones.RECLAMO_GESTION, bayer_gestiones.CAUSA_NO_RECLAMACION_GESTION, bayer_gestiones.DIFICULTAD_ACCESO_GESTION, bayer_gestiones.TIPO_DIFICULTAD_GESTION, bayer_gestiones.ENVIOS_GESTION, bayer_gestiones.MEDICAMENTOS_GESTION, bayer_gestiones.TIPO_ENVIO_GESTION, bayer_gestiones.EVENTO_ADVERSO_GESTION, bayer_gestiones.TIPO_EVENTO_ADVERSO, bayer_gestiones.GENERA_SOLICITUD_GESTION, bayer_gestiones.FECHA_PROXIMA_LLAMADA, bayer_gestiones.MOTIVO_PROXIMA_LLAMADA, bayer_gestiones.OBSERVACION_PROXIMA_LLAMADA, bayer_gestiones.FECHA_RECLAMACION_GESTION, bayer_gestiones.CONSECUTIVO_GESTION, bayer_gestiones.AUTOR_GESTION, bayer_gestiones.NOTA, bayer_gestiones.FECHA_PROGRAMADA_GESTION, bayer_gestiones.USUARIO_ASIGANDO, bayer_gestiones.ID_PACIENTE_FK2, bayer_gestiones.FECHA_COMUNICACION, bayer_gestiones.ESTADO_GESTION, bayer_gestiones.CODIGO_ARGUS, bayer_gestiones.NUMERO_CAJAS from " . $this->Ini->nm_tabela . " " . $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
      } 
      if ($destino_resumo != "gra") 
      {
          $comando = str_replace("avg(", "sum(", $comando); 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($comando))
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit;
      }
      $array_db_total = $this->get_array($rt);
      $rt->Close();
      foreach ($array_db_total as $registro)
      {
         $bayer_pacientes_id_paciente      = $registro[1];
         $bayer_pacientes_id_paciente_orig = $registro[1];
         $conteudo = $registro[1];
         $bayer_pacientes_id_paciente = $conteudo;
         if (null === $bayer_pacientes_id_paciente)
         {
             $bayer_pacientes_id_paciente = '';
         }
         if (null === $bayer_pacientes_id_paciente_orig)
         {
             $bayer_pacientes_id_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_id_paciente = $bayer_pacientes_id_paciente;
         $bayer_pacientes_estado_paciente      = $registro[2];
         $bayer_pacientes_estado_paciente_orig = $registro[2];
         $conteudo = $registro[2];
         $bayer_pacientes_estado_paciente = $conteudo;
         if (null === $bayer_pacientes_estado_paciente)
         {
             $bayer_pacientes_estado_paciente = '';
         }
         if (null === $bayer_pacientes_estado_paciente_orig)
         {
             $bayer_pacientes_estado_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_estado_paciente = $bayer_pacientes_estado_paciente;
         $bayer_pacientes_fecha_activacion_paciente      = $registro[3];
         $bayer_pacientes_fecha_activacion_paciente_orig = $registro[3];
         $conteudo = $registro[3];
        $conteudo_x =  $conteudo;
        nm_conv_limpa_dado($conteudo_x, "");
        if (is_numeric($conteudo_x) && $conteudo_x > 0) 
        { 
            $this->nm_data->SetaData($conteudo, "");
            $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
        } 
         $bayer_pacientes_fecha_activacion_paciente = $conteudo;
         if (null === $bayer_pacientes_fecha_activacion_paciente)
         {
             $bayer_pacientes_fecha_activacion_paciente = '';
         }
         if (null === $bayer_pacientes_fecha_activacion_paciente_orig)
         {
             $bayer_pacientes_fecha_activacion_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_fecha_activacion_paciente = $bayer_pacientes_fecha_activacion_paciente;
         $bayer_pacientes_fecha_retiro_paciente      = $registro[4];
         $bayer_pacientes_fecha_retiro_paciente_orig = $registro[4];
         $conteudo = $registro[4];
        $conteudo_x =  $conteudo;
        nm_conv_limpa_dado($conteudo_x, "");
        if (is_numeric($conteudo_x) && $conteudo_x > 0) 
        { 
            $this->nm_data->SetaData($conteudo, "");
            $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
        } 
         $bayer_pacientes_fecha_retiro_paciente = $conteudo;
         if (null === $bayer_pacientes_fecha_retiro_paciente)
         {
             $bayer_pacientes_fecha_retiro_paciente = '';
         }
         if (null === $bayer_pacientes_fecha_retiro_paciente_orig)
         {
             $bayer_pacientes_fecha_retiro_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_fecha_retiro_paciente = $bayer_pacientes_fecha_retiro_paciente;
         $bayer_pacientes_motivo_retiro_paciente      = $registro[5];
         $bayer_pacientes_motivo_retiro_paciente_orig = $registro[5];
         $conteudo = $registro[5];
         $bayer_pacientes_motivo_retiro_paciente = $conteudo;
         if (null === $bayer_pacientes_motivo_retiro_paciente)
         {
             $bayer_pacientes_motivo_retiro_paciente = '';
         }
         if (null === $bayer_pacientes_motivo_retiro_paciente_orig)
         {
             $bayer_pacientes_motivo_retiro_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_motivo_retiro_paciente = $bayer_pacientes_motivo_retiro_paciente;
         $bayer_pacientes_observacion_motivo_retiro_paciente      = $registro[6];
         $bayer_pacientes_observacion_motivo_retiro_paciente_orig = $registro[6];
         $conteudo = $registro[6];
         $bayer_pacientes_observacion_motivo_retiro_paciente = $conteudo;
         if (null === $bayer_pacientes_observacion_motivo_retiro_paciente)
         {
             $bayer_pacientes_observacion_motivo_retiro_paciente = '';
         }
         if (null === $bayer_pacientes_observacion_motivo_retiro_paciente_orig)
         {
             $bayer_pacientes_observacion_motivo_retiro_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_observacion_motivo_retiro_paciente = $bayer_pacientes_observacion_motivo_retiro_paciente;
         $bayer_pacientes_identificacion_paciente      = $registro[7];
         $bayer_pacientes_identificacion_paciente_orig = $registro[7];
         $conteudo = $registro[7];
         $bayer_pacientes_identificacion_paciente = $conteudo;
         if (null === $bayer_pacientes_identificacion_paciente)
         {
             $bayer_pacientes_identificacion_paciente = '';
         }
         if (null === $bayer_pacientes_identificacion_paciente_orig)
         {
             $bayer_pacientes_identificacion_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_identificacion_paciente = $bayer_pacientes_identificacion_paciente;
         $bayer_pacientes_nombre_paciente      = $registro[8];
         $bayer_pacientes_nombre_paciente_orig = $registro[8];
         $conteudo = $registro[8];
         $bayer_pacientes_nombre_paciente = $conteudo;
         if (null === $bayer_pacientes_nombre_paciente)
         {
             $bayer_pacientes_nombre_paciente = '';
         }
         if (null === $bayer_pacientes_nombre_paciente_orig)
         {
             $bayer_pacientes_nombre_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_nombre_paciente = $bayer_pacientes_nombre_paciente;
         $bayer_pacientes_apellido_paciente      = $registro[9];
         $bayer_pacientes_apellido_paciente_orig = $registro[9];
         $conteudo = $registro[9];
         $bayer_pacientes_apellido_paciente = $conteudo;
         if (null === $bayer_pacientes_apellido_paciente)
         {
             $bayer_pacientes_apellido_paciente = '';
         }
         if (null === $bayer_pacientes_apellido_paciente_orig)
         {
             $bayer_pacientes_apellido_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_apellido_paciente = $bayer_pacientes_apellido_paciente;
         $bayer_pacientes_telefono_paciente      = $registro[10];
         $bayer_pacientes_telefono_paciente_orig = $registro[10];
         $conteudo = $registro[10];
         $bayer_pacientes_telefono_paciente = $conteudo;
         if (null === $bayer_pacientes_telefono_paciente)
         {
             $bayer_pacientes_telefono_paciente = '';
         }
         if (null === $bayer_pacientes_telefono_paciente_orig)
         {
             $bayer_pacientes_telefono_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_telefono_paciente = $bayer_pacientes_telefono_paciente;
         $bayer_pacientes_telefono2_paciente      = $registro[11];
         $bayer_pacientes_telefono2_paciente_orig = $registro[11];
         $conteudo = $registro[11];
         $bayer_pacientes_telefono2_paciente = $conteudo;
         if (null === $bayer_pacientes_telefono2_paciente)
         {
             $bayer_pacientes_telefono2_paciente = '';
         }
         if (null === $bayer_pacientes_telefono2_paciente_orig)
         {
             $bayer_pacientes_telefono2_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_telefono2_paciente = $bayer_pacientes_telefono2_paciente;
         $bayer_pacientes_telefono3_paciente      = $registro[12];
         $bayer_pacientes_telefono3_paciente_orig = $registro[12];
         $conteudo = $registro[12];
         $bayer_pacientes_telefono3_paciente = $conteudo;
         if (null === $bayer_pacientes_telefono3_paciente)
         {
             $bayer_pacientes_telefono3_paciente = '';
         }
         if (null === $bayer_pacientes_telefono3_paciente_orig)
         {
             $bayer_pacientes_telefono3_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_telefono3_paciente = $bayer_pacientes_telefono3_paciente;
         $bayer_pacientes_correo_paciente      = $registro[13];
         $bayer_pacientes_correo_paciente_orig = $registro[13];
         $conteudo = $registro[13];
         $bayer_pacientes_correo_paciente = $conteudo;
         if (null === $bayer_pacientes_correo_paciente)
         {
             $bayer_pacientes_correo_paciente = '';
         }
         if (null === $bayer_pacientes_correo_paciente_orig)
         {
             $bayer_pacientes_correo_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_correo_paciente = $bayer_pacientes_correo_paciente;
         $bayer_pacientes_direccion_paciente      = $registro[14];
         $bayer_pacientes_direccion_paciente_orig = $registro[14];
         $conteudo = $registro[14];
         $bayer_pacientes_direccion_paciente = $conteudo;
         if (null === $bayer_pacientes_direccion_paciente)
         {
             $bayer_pacientes_direccion_paciente = '';
         }
         if (null === $bayer_pacientes_direccion_paciente_orig)
         {
             $bayer_pacientes_direccion_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_direccion_paciente = $bayer_pacientes_direccion_paciente;
         $bayer_pacientes_barrio_paciente      = $registro[15];
         $bayer_pacientes_barrio_paciente_orig = $registro[15];
         $conteudo = $registro[15];
         $bayer_pacientes_barrio_paciente = $conteudo;
         if (null === $bayer_pacientes_barrio_paciente)
         {
             $bayer_pacientes_barrio_paciente = '';
         }
         if (null === $bayer_pacientes_barrio_paciente_orig)
         {
             $bayer_pacientes_barrio_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_barrio_paciente = $bayer_pacientes_barrio_paciente;
         $bayer_pacientes_departamento_paciente      = $registro[16];
         $bayer_pacientes_departamento_paciente_orig = $registro[16];
         $conteudo = $registro[16];
         $bayer_pacientes_departamento_paciente = $conteudo;
         if (null === $bayer_pacientes_departamento_paciente)
         {
             $bayer_pacientes_departamento_paciente = '';
         }
         if (null === $bayer_pacientes_departamento_paciente_orig)
         {
             $bayer_pacientes_departamento_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_departamento_paciente = $bayer_pacientes_departamento_paciente;
         $bayer_pacientes_ciudad_paciente      = $registro[17];
         $bayer_pacientes_ciudad_paciente_orig = $registro[17];
         $conteudo = $registro[17];
         $bayer_pacientes_ciudad_paciente = $conteudo;
         if (null === $bayer_pacientes_ciudad_paciente)
         {
             $bayer_pacientes_ciudad_paciente = '';
         }
         if (null === $bayer_pacientes_ciudad_paciente_orig)
         {
             $bayer_pacientes_ciudad_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_ciudad_paciente = $bayer_pacientes_ciudad_paciente;
         $bayer_pacientes_genero_paciente      = $registro[18];
         $bayer_pacientes_genero_paciente_orig = $registro[18];
         $conteudo = $registro[18];
         $bayer_pacientes_genero_paciente = $conteudo;
         if (null === $bayer_pacientes_genero_paciente)
         {
             $bayer_pacientes_genero_paciente = '';
         }
         if (null === $bayer_pacientes_genero_paciente_orig)
         {
             $bayer_pacientes_genero_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_genero_paciente = $bayer_pacientes_genero_paciente;
         $bayer_pacientes_fecha_nacimineto_paciente      = $registro[19];
         $bayer_pacientes_fecha_nacimineto_paciente_orig = $registro[19];
         $conteudo = $registro[19];
        $conteudo_x =  $conteudo;
        nm_conv_limpa_dado($conteudo_x, "");
        if (is_numeric($conteudo_x) && $conteudo_x > 0) 
        { 
            $this->nm_data->SetaData($conteudo, "");
            $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
        } 
         $bayer_pacientes_fecha_nacimineto_paciente = $conteudo;
         if (null === $bayer_pacientes_fecha_nacimineto_paciente)
         {
             $bayer_pacientes_fecha_nacimineto_paciente = '';
         }
         if (null === $bayer_pacientes_fecha_nacimineto_paciente_orig)
         {
             $bayer_pacientes_fecha_nacimineto_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_fecha_nacimineto_paciente = $bayer_pacientes_fecha_nacimineto_paciente;
         $bayer_pacientes_edad_paciente      = $registro[20];
         $bayer_pacientes_edad_paciente_orig = $registro[20];
         $conteudo = $registro[20];
        nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $bayer_pacientes_edad_paciente = $conteudo;
         if (null === $bayer_pacientes_edad_paciente)
         {
             $bayer_pacientes_edad_paciente = '';
         }
         if (null === $bayer_pacientes_edad_paciente_orig)
         {
             $bayer_pacientes_edad_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_edad_paciente = $bayer_pacientes_edad_paciente;
         $bayer_pacientes_acudiente_paciente      = $registro[21];
         $bayer_pacientes_acudiente_paciente_orig = $registro[21];
         $conteudo = $registro[21];
         $bayer_pacientes_acudiente_paciente = $conteudo;
         if (null === $bayer_pacientes_acudiente_paciente)
         {
             $bayer_pacientes_acudiente_paciente = '';
         }
         if (null === $bayer_pacientes_acudiente_paciente_orig)
         {
             $bayer_pacientes_acudiente_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_acudiente_paciente = $bayer_pacientes_acudiente_paciente;
         $bayer_pacientes_telefono_acudiente_paciente      = $registro[22];
         $bayer_pacientes_telefono_acudiente_paciente_orig = $registro[22];
         $conteudo = $registro[22];
         $bayer_pacientes_telefono_acudiente_paciente = $conteudo;
         if (null === $bayer_pacientes_telefono_acudiente_paciente)
         {
             $bayer_pacientes_telefono_acudiente_paciente = '';
         }
         if (null === $bayer_pacientes_telefono_acudiente_paciente_orig)
         {
             $bayer_pacientes_telefono_acudiente_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_telefono_acudiente_paciente = $bayer_pacientes_telefono_acudiente_paciente;
         $bayer_pacientes_codigo_xofigo      = $registro[23];
         $bayer_pacientes_codigo_xofigo_orig = $registro[23];
         $conteudo = $registro[23];
        nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $bayer_pacientes_codigo_xofigo = $conteudo;
         if (null === $bayer_pacientes_codigo_xofigo)
         {
             $bayer_pacientes_codigo_xofigo = '';
         }
         if (null === $bayer_pacientes_codigo_xofigo_orig)
         {
             $bayer_pacientes_codigo_xofigo_orig = '';
         }
         $val_grafico_bayer_pacientes_codigo_xofigo = $bayer_pacientes_codigo_xofigo;
         $bayer_pacientes_status_paciente      = $registro[24];
         $bayer_pacientes_status_paciente_orig = $registro[24];
         $conteudo = $registro[24];
         $bayer_pacientes_status_paciente = $conteudo;
         if (null === $bayer_pacientes_status_paciente)
         {
             $bayer_pacientes_status_paciente = '';
         }
         if (null === $bayer_pacientes_status_paciente_orig)
         {
             $bayer_pacientes_status_paciente_orig = '';
         }
         $val_grafico_bayer_pacientes_status_paciente = $bayer_pacientes_status_paciente;
         $bayer_pacientes_id_ultima_gestion      = $registro[25];
         $bayer_pacientes_id_ultima_gestion_orig = $registro[25];
         $conteudo = $registro[25];
        nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $bayer_pacientes_id_ultima_gestion = $conteudo;
         if (null === $bayer_pacientes_id_ultima_gestion)
         {
             $bayer_pacientes_id_ultima_gestion = '';
         }
         if (null === $bayer_pacientes_id_ultima_gestion_orig)
         {
             $bayer_pacientes_id_ultima_gestion_orig = '';
         }
         $val_grafico_bayer_pacientes_id_ultima_gestion = $bayer_pacientes_id_ultima_gestion;
         $bayer_pacientes_usuario_creacion      = $registro[26];
         $bayer_pacientes_usuario_creacion_orig = $registro[26];
         $conteudo = $registro[26];
         $bayer_pacientes_usuario_creacion = $conteudo;
         if (null === $bayer_pacientes_usuario_creacion)
         {
             $bayer_pacientes_usuario_creacion = '';
         }
         if (null === $bayer_pacientes_usuario_creacion_orig)
         {
             $bayer_pacientes_usuario_creacion_orig = '';
         }
         $val_grafico_bayer_pacientes_usuario_creacion = $bayer_pacientes_usuario_creacion;
         $bayer_tratamiento_id_tratamiento      = $registro[27];
         $bayer_tratamiento_id_tratamiento_orig = $registro[27];
         $conteudo = $registro[27];
        nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $bayer_tratamiento_id_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_id_tratamiento)
         {
             $bayer_tratamiento_id_tratamiento = '';
         }
         if (null === $bayer_tratamiento_id_tratamiento_orig)
         {
             $bayer_tratamiento_id_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_id_tratamiento = $bayer_tratamiento_id_tratamiento;
         $bayer_tratamiento_producto_tratamiento      = $registro[28];
         $bayer_tratamiento_producto_tratamiento_orig = $registro[28];
         $conteudo = $registro[28];
         $bayer_tratamiento_producto_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_producto_tratamiento)
         {
             $bayer_tratamiento_producto_tratamiento = '';
         }
         if (null === $bayer_tratamiento_producto_tratamiento_orig)
         {
             $bayer_tratamiento_producto_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_producto_tratamiento = $bayer_tratamiento_producto_tratamiento;
         $bayer_tratamiento_nombre_referencia      = $registro[29];
         $bayer_tratamiento_nombre_referencia_orig = $registro[29];
         $conteudo = $registro[29];
         $bayer_tratamiento_nombre_referencia = $conteudo;
         if (null === $bayer_tratamiento_nombre_referencia)
         {
             $bayer_tratamiento_nombre_referencia = '';
         }
         if (null === $bayer_tratamiento_nombre_referencia_orig)
         {
             $bayer_tratamiento_nombre_referencia_orig = '';
         }
         $val_grafico_bayer_tratamiento_nombre_referencia = $bayer_tratamiento_nombre_referencia;
         $bayer_tratamiento_clasificacion_patologica_tratamiento      = $registro[30];
         $bayer_tratamiento_clasificacion_patologica_tratamiento_orig = $registro[30];
         $conteudo = $registro[30];
         $bayer_tratamiento_clasificacion_patologica_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_clasificacion_patologica_tratamiento)
         {
             $bayer_tratamiento_clasificacion_patologica_tratamiento = '';
         }
         if (null === $bayer_tratamiento_clasificacion_patologica_tratamiento_orig)
         {
             $bayer_tratamiento_clasificacion_patologica_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_clasificacion_patologica_tratamiento = $bayer_tratamiento_clasificacion_patologica_tratamiento;
         $bayer_tratamiento_tratamiento_previo      = $registro[31];
         $bayer_tratamiento_tratamiento_previo_orig = $registro[31];
         $conteudo = $registro[31];
         $bayer_tratamiento_tratamiento_previo = $conteudo;
         if (null === $bayer_tratamiento_tratamiento_previo)
         {
             $bayer_tratamiento_tratamiento_previo = '';
         }
         if (null === $bayer_tratamiento_tratamiento_previo_orig)
         {
             $bayer_tratamiento_tratamiento_previo_orig = '';
         }
         $val_grafico_bayer_tratamiento_tratamiento_previo = $bayer_tratamiento_tratamiento_previo;
         $bayer_tratamiento_consentimiento_tratamiento      = $registro[32];
         $bayer_tratamiento_consentimiento_tratamiento_orig = $registro[32];
         $conteudo = $registro[32];
         $bayer_tratamiento_consentimiento_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_consentimiento_tratamiento)
         {
             $bayer_tratamiento_consentimiento_tratamiento = '';
         }
         if (null === $bayer_tratamiento_consentimiento_tratamiento_orig)
         {
             $bayer_tratamiento_consentimiento_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_consentimiento_tratamiento = $bayer_tratamiento_consentimiento_tratamiento;
         $bayer_tratamiento_fecha_inicio_terapia_tratamiento      = $registro[33];
         $bayer_tratamiento_fecha_inicio_terapia_tratamiento_orig = $registro[33];
         $conteudo = $registro[33];
        $conteudo_x =  $conteudo;
        nm_conv_limpa_dado($conteudo_x, "");
        if (is_numeric($conteudo_x) && $conteudo_x > 0) 
        { 
            $this->nm_data->SetaData($conteudo, "");
            $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
        } 
         $bayer_tratamiento_fecha_inicio_terapia_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_fecha_inicio_terapia_tratamiento)
         {
             $bayer_tratamiento_fecha_inicio_terapia_tratamiento = '';
         }
         if (null === $bayer_tratamiento_fecha_inicio_terapia_tratamiento_orig)
         {
             $bayer_tratamiento_fecha_inicio_terapia_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_fecha_inicio_terapia_tratamiento = $bayer_tratamiento_fecha_inicio_terapia_tratamiento;
         $bayer_tratamiento_regimen_tratamiento      = $registro[34];
         $bayer_tratamiento_regimen_tratamiento_orig = $registro[34];
         $conteudo = $registro[34];
         $bayer_tratamiento_regimen_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_regimen_tratamiento)
         {
             $bayer_tratamiento_regimen_tratamiento = '';
         }
         if (null === $bayer_tratamiento_regimen_tratamiento_orig)
         {
             $bayer_tratamiento_regimen_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_regimen_tratamiento = $bayer_tratamiento_regimen_tratamiento;
         $bayer_tratamiento_asegurador_tratamiento      = $registro[35];
         $bayer_tratamiento_asegurador_tratamiento_orig = $registro[35];
         $conteudo = $registro[35];
         $bayer_tratamiento_asegurador_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_asegurador_tratamiento)
         {
             $bayer_tratamiento_asegurador_tratamiento = '';
         }
         if (null === $bayer_tratamiento_asegurador_tratamiento_orig)
         {
             $bayer_tratamiento_asegurador_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_asegurador_tratamiento = $bayer_tratamiento_asegurador_tratamiento;
         $bayer_tratamiento_operador_logistico_tratamiento      = $registro[36];
         $bayer_tratamiento_operador_logistico_tratamiento_orig = $registro[36];
         $conteudo = $registro[36];
         $bayer_tratamiento_operador_logistico_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_operador_logistico_tratamiento)
         {
             $bayer_tratamiento_operador_logistico_tratamiento = '';
         }
         if (null === $bayer_tratamiento_operador_logistico_tratamiento_orig)
         {
             $bayer_tratamiento_operador_logistico_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_operador_logistico_tratamiento = $bayer_tratamiento_operador_logistico_tratamiento;
         $bayer_tratamiento_punto_entrega      = $registro[37];
         $bayer_tratamiento_punto_entrega_orig = $registro[37];
         $conteudo = $registro[37];
         $bayer_tratamiento_punto_entrega = $conteudo;
         if (null === $bayer_tratamiento_punto_entrega)
         {
             $bayer_tratamiento_punto_entrega = '';
         }
         if (null === $bayer_tratamiento_punto_entrega_orig)
         {
             $bayer_tratamiento_punto_entrega_orig = '';
         }
         $val_grafico_bayer_tratamiento_punto_entrega = $bayer_tratamiento_punto_entrega;
         $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento      = $registro[38];
         $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento_orig = $registro[38];
         $conteudo = $registro[38];
        $conteudo_x =  $conteudo;
        nm_conv_limpa_dado($conteudo_x, "");
        if (is_numeric($conteudo_x) && $conteudo_x > 0) 
        { 
            $this->nm_data->SetaData($conteudo, "");
            $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
        } 
         $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento)
         {
             $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento = '';
         }
         if (null === $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento_orig)
         {
             $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_fecha_ultima_reclamacion_tratamiento = $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento;
         $bayer_tratamiento_otros_operadores_tratamiento      = $registro[39];
         $bayer_tratamiento_otros_operadores_tratamiento_orig = $registro[39];
         $conteudo = $registro[39];
         $bayer_tratamiento_otros_operadores_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_otros_operadores_tratamiento)
         {
             $bayer_tratamiento_otros_operadores_tratamiento = '';
         }
         if (null === $bayer_tratamiento_otros_operadores_tratamiento_orig)
         {
             $bayer_tratamiento_otros_operadores_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_otros_operadores_tratamiento = $bayer_tratamiento_otros_operadores_tratamiento;
         $bayer_tratamiento_medios_adquisicion_tratamiento      = $registro[40];
         $bayer_tratamiento_medios_adquisicion_tratamiento_orig = $registro[40];
         $conteudo = $registro[40];
         $bayer_tratamiento_medios_adquisicion_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_medios_adquisicion_tratamiento)
         {
             $bayer_tratamiento_medios_adquisicion_tratamiento = '';
         }
         if (null === $bayer_tratamiento_medios_adquisicion_tratamiento_orig)
         {
             $bayer_tratamiento_medios_adquisicion_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_medios_adquisicion_tratamiento = $bayer_tratamiento_medios_adquisicion_tratamiento;
         $bayer_tratamiento_ips_atiende_tratamiento      = $registro[41];
         $bayer_tratamiento_ips_atiende_tratamiento_orig = $registro[41];
         $conteudo = $registro[41];
         $bayer_tratamiento_ips_atiende_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_ips_atiende_tratamiento)
         {
             $bayer_tratamiento_ips_atiende_tratamiento = '';
         }
         if (null === $bayer_tratamiento_ips_atiende_tratamiento_orig)
         {
             $bayer_tratamiento_ips_atiende_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_ips_atiende_tratamiento = $bayer_tratamiento_ips_atiende_tratamiento;
         $bayer_tratamiento_medico_tratamiento      = $registro[42];
         $bayer_tratamiento_medico_tratamiento_orig = $registro[42];
         $conteudo = $registro[42];
         $bayer_tratamiento_medico_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_medico_tratamiento)
         {
             $bayer_tratamiento_medico_tratamiento = '';
         }
         if (null === $bayer_tratamiento_medico_tratamiento_orig)
         {
             $bayer_tratamiento_medico_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_medico_tratamiento = $bayer_tratamiento_medico_tratamiento;
         $bayer_tratamiento_especialidad_tratamiento      = $registro[43];
         $bayer_tratamiento_especialidad_tratamiento_orig = $registro[43];
         $conteudo = $registro[43];
         $bayer_tratamiento_especialidad_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_especialidad_tratamiento)
         {
             $bayer_tratamiento_especialidad_tratamiento = '';
         }
         if (null === $bayer_tratamiento_especialidad_tratamiento_orig)
         {
             $bayer_tratamiento_especialidad_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_especialidad_tratamiento = $bayer_tratamiento_especialidad_tratamiento;
         $bayer_tratamiento_paramedico_tratamiento      = $registro[44];
         $bayer_tratamiento_paramedico_tratamiento_orig = $registro[44];
         $conteudo = $registro[44];
         $bayer_tratamiento_paramedico_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_paramedico_tratamiento)
         {
             $bayer_tratamiento_paramedico_tratamiento = '';
         }
         if (null === $bayer_tratamiento_paramedico_tratamiento_orig)
         {
             $bayer_tratamiento_paramedico_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_paramedico_tratamiento = $bayer_tratamiento_paramedico_tratamiento;
         $bayer_tratamiento_zona_atencion_paramedico_tratamiento      = $registro[45];
         $bayer_tratamiento_zona_atencion_paramedico_tratamiento_orig = $registro[45];
         $conteudo = $registro[45];
         $bayer_tratamiento_zona_atencion_paramedico_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_zona_atencion_paramedico_tratamiento)
         {
             $bayer_tratamiento_zona_atencion_paramedico_tratamiento = '';
         }
         if (null === $bayer_tratamiento_zona_atencion_paramedico_tratamiento_orig)
         {
             $bayer_tratamiento_zona_atencion_paramedico_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_zona_atencion_paramedico_tratamiento = $bayer_tratamiento_zona_atencion_paramedico_tratamiento;
         $bayer_tratamiento_ciudad_base_paramedico_tratamiento      = $registro[46];
         $bayer_tratamiento_ciudad_base_paramedico_tratamiento_orig = $registro[46];
         $conteudo = $registro[46];
         $bayer_tratamiento_ciudad_base_paramedico_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_ciudad_base_paramedico_tratamiento)
         {
             $bayer_tratamiento_ciudad_base_paramedico_tratamiento = '';
         }
         if (null === $bayer_tratamiento_ciudad_base_paramedico_tratamiento_orig)
         {
             $bayer_tratamiento_ciudad_base_paramedico_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_ciudad_base_paramedico_tratamiento = $bayer_tratamiento_ciudad_base_paramedico_tratamiento;
         $bayer_tratamiento_notas_adjuntos_tratamiento      = $registro[47];
         $bayer_tratamiento_notas_adjuntos_tratamiento_orig = $registro[47];
         $conteudo = $registro[47];
         $bayer_tratamiento_notas_adjuntos_tratamiento = $conteudo;
         if (null === $bayer_tratamiento_notas_adjuntos_tratamiento)
         {
             $bayer_tratamiento_notas_adjuntos_tratamiento = '';
         }
         if (null === $bayer_tratamiento_notas_adjuntos_tratamiento_orig)
         {
             $bayer_tratamiento_notas_adjuntos_tratamiento_orig = '';
         }
         $val_grafico_bayer_tratamiento_notas_adjuntos_tratamiento = $bayer_tratamiento_notas_adjuntos_tratamiento;
         $bayer_tratamiento_id_paciente_fk      = $registro[48];
         $bayer_tratamiento_id_paciente_fk_orig = $registro[48];
         $conteudo = $registro[48];
        nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $bayer_tratamiento_id_paciente_fk = $conteudo;
         if (null === $bayer_tratamiento_id_paciente_fk)
         {
             $bayer_tratamiento_id_paciente_fk = '';
         }
         if (null === $bayer_tratamiento_id_paciente_fk_orig)
         {
             $bayer_tratamiento_id_paciente_fk_orig = '';
         }
         $val_grafico_bayer_tratamiento_id_paciente_fk = $bayer_tratamiento_id_paciente_fk;
         $bayer_gestiones_id_gestion      = $registro[49];
         $bayer_gestiones_id_gestion_orig = $registro[49];
         $conteudo = $registro[49];
        nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $bayer_gestiones_id_gestion = $conteudo;
         if (null === $bayer_gestiones_id_gestion)
         {
             $bayer_gestiones_id_gestion = '';
         }
         if (null === $bayer_gestiones_id_gestion_orig)
         {
             $bayer_gestiones_id_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_id_gestion = $bayer_gestiones_id_gestion;
         $bayer_gestiones_motivo_comunicacion_gestion      = $registro[50];
         $bayer_gestiones_motivo_comunicacion_gestion_orig = $registro[50];
         $conteudo = $registro[50];
         $bayer_gestiones_motivo_comunicacion_gestion = $conteudo;
         if (null === $bayer_gestiones_motivo_comunicacion_gestion)
         {
             $bayer_gestiones_motivo_comunicacion_gestion = '';
         }
         if (null === $bayer_gestiones_motivo_comunicacion_gestion_orig)
         {
             $bayer_gestiones_motivo_comunicacion_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_motivo_comunicacion_gestion = $bayer_gestiones_motivo_comunicacion_gestion;
         $bayer_gestiones_medio_contacto_gestion      = $registro[51];
         $bayer_gestiones_medio_contacto_gestion_orig = $registro[51];
         $conteudo = $registro[51];
         $bayer_gestiones_medio_contacto_gestion = $conteudo;
         if (null === $bayer_gestiones_medio_contacto_gestion)
         {
             $bayer_gestiones_medio_contacto_gestion = '';
         }
         if (null === $bayer_gestiones_medio_contacto_gestion_orig)
         {
             $bayer_gestiones_medio_contacto_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_medio_contacto_gestion = $bayer_gestiones_medio_contacto_gestion;
         $bayer_gestiones_tipo_llamada_gestion      = $registro[52];
         $bayer_gestiones_tipo_llamada_gestion_orig = $registro[52];
         $conteudo = $registro[52];
         $bayer_gestiones_tipo_llamada_gestion = $conteudo;
         if (null === $bayer_gestiones_tipo_llamada_gestion)
         {
             $bayer_gestiones_tipo_llamada_gestion = '';
         }
         if (null === $bayer_gestiones_tipo_llamada_gestion_orig)
         {
             $bayer_gestiones_tipo_llamada_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_tipo_llamada_gestion = $bayer_gestiones_tipo_llamada_gestion;
         $bayer_gestiones_logro_comunicacion_gestion      = $registro[53];
         $bayer_gestiones_logro_comunicacion_gestion_orig = $registro[53];
         $conteudo = $registro[53];
         $bayer_gestiones_logro_comunicacion_gestion = $conteudo;
         if (null === $bayer_gestiones_logro_comunicacion_gestion)
         {
             $bayer_gestiones_logro_comunicacion_gestion = '';
         }
         if (null === $bayer_gestiones_logro_comunicacion_gestion_orig)
         {
             $bayer_gestiones_logro_comunicacion_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_logro_comunicacion_gestion = $bayer_gestiones_logro_comunicacion_gestion;
         $bayer_gestiones_motivo_no_comunicacion_gestion      = $registro[54];
         $bayer_gestiones_motivo_no_comunicacion_gestion_orig = $registro[54];
         $conteudo = $registro[54];
         $bayer_gestiones_motivo_no_comunicacion_gestion = $conteudo;
         if (null === $bayer_gestiones_motivo_no_comunicacion_gestion)
         {
             $bayer_gestiones_motivo_no_comunicacion_gestion = '';
         }
         if (null === $bayer_gestiones_motivo_no_comunicacion_gestion_orig)
         {
             $bayer_gestiones_motivo_no_comunicacion_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_motivo_no_comunicacion_gestion = $bayer_gestiones_motivo_no_comunicacion_gestion;
         $bayer_gestiones_numero_intentos_gestion      = $registro[55];
         $bayer_gestiones_numero_intentos_gestion_orig = $registro[55];
         $conteudo = $registro[55];
         $bayer_gestiones_numero_intentos_gestion = $conteudo;
         if (null === $bayer_gestiones_numero_intentos_gestion)
         {
             $bayer_gestiones_numero_intentos_gestion = '';
         }
         if (null === $bayer_gestiones_numero_intentos_gestion_orig)
         {
             $bayer_gestiones_numero_intentos_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_numero_intentos_gestion = $bayer_gestiones_numero_intentos_gestion;
         $bayer_gestiones_esperado_gestion      = $registro[56];
         $bayer_gestiones_esperado_gestion_orig = $registro[56];
         $conteudo = $registro[56];
         $bayer_gestiones_esperado_gestion = $conteudo;
         if (null === $bayer_gestiones_esperado_gestion)
         {
             $bayer_gestiones_esperado_gestion = '';
         }
         if (null === $bayer_gestiones_esperado_gestion_orig)
         {
             $bayer_gestiones_esperado_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_esperado_gestion = $bayer_gestiones_esperado_gestion;
         $bayer_gestiones_estado_ctc_gestion      = $registro[57];
         $bayer_gestiones_estado_ctc_gestion_orig = $registro[57];
         $conteudo = $registro[57];
         $bayer_gestiones_estado_ctc_gestion = $conteudo;
         if (null === $bayer_gestiones_estado_ctc_gestion)
         {
             $bayer_gestiones_estado_ctc_gestion = '';
         }
         if (null === $bayer_gestiones_estado_ctc_gestion_orig)
         {
             $bayer_gestiones_estado_ctc_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_estado_ctc_gestion = $bayer_gestiones_estado_ctc_gestion;
         $bayer_gestiones_estado_farmacia_gestion      = $registro[58];
         $bayer_gestiones_estado_farmacia_gestion_orig = $registro[58];
         $conteudo = $registro[58];
         $bayer_gestiones_estado_farmacia_gestion = $conteudo;
         if (null === $bayer_gestiones_estado_farmacia_gestion)
         {
             $bayer_gestiones_estado_farmacia_gestion = '';
         }
         if (null === $bayer_gestiones_estado_farmacia_gestion_orig)
         {
             $bayer_gestiones_estado_farmacia_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_estado_farmacia_gestion = $bayer_gestiones_estado_farmacia_gestion;
         $bayer_gestiones_reclamo_gestion      = $registro[59];
         $bayer_gestiones_reclamo_gestion_orig = $registro[59];
         $conteudo = $registro[59];
         $bayer_gestiones_reclamo_gestion = $conteudo;
         if (null === $bayer_gestiones_reclamo_gestion)
         {
             $bayer_gestiones_reclamo_gestion = '';
         }
         if (null === $bayer_gestiones_reclamo_gestion_orig)
         {
             $bayer_gestiones_reclamo_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_reclamo_gestion = $bayer_gestiones_reclamo_gestion;
         $bayer_gestiones_causa_no_reclamacion_gestion      = $registro[60];
         $bayer_gestiones_causa_no_reclamacion_gestion_orig = $registro[60];
         $conteudo = $registro[60];
         $bayer_gestiones_causa_no_reclamacion_gestion = $conteudo;
         if (null === $bayer_gestiones_causa_no_reclamacion_gestion)
         {
             $bayer_gestiones_causa_no_reclamacion_gestion = '';
         }
         if (null === $bayer_gestiones_causa_no_reclamacion_gestion_orig)
         {
             $bayer_gestiones_causa_no_reclamacion_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_causa_no_reclamacion_gestion = $bayer_gestiones_causa_no_reclamacion_gestion;
         $bayer_gestiones_dificultad_acceso_gestion      = $registro[61];
         $bayer_gestiones_dificultad_acceso_gestion_orig = $registro[61];
         $conteudo = $registro[61];
         $bayer_gestiones_dificultad_acceso_gestion = $conteudo;
         if (null === $bayer_gestiones_dificultad_acceso_gestion)
         {
             $bayer_gestiones_dificultad_acceso_gestion = '';
         }
         if (null === $bayer_gestiones_dificultad_acceso_gestion_orig)
         {
             $bayer_gestiones_dificultad_acceso_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_dificultad_acceso_gestion = $bayer_gestiones_dificultad_acceso_gestion;
         $bayer_gestiones_tipo_dificultad_gestion      = $registro[62];
         $bayer_gestiones_tipo_dificultad_gestion_orig = $registro[62];
         $conteudo = $registro[62];
         $bayer_gestiones_tipo_dificultad_gestion = $conteudo;
         if (null === $bayer_gestiones_tipo_dificultad_gestion)
         {
             $bayer_gestiones_tipo_dificultad_gestion = '';
         }
         if (null === $bayer_gestiones_tipo_dificultad_gestion_orig)
         {
             $bayer_gestiones_tipo_dificultad_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_tipo_dificultad_gestion = $bayer_gestiones_tipo_dificultad_gestion;
         $bayer_gestiones_envios_gestion      = $registro[63];
         $bayer_gestiones_envios_gestion_orig = $registro[63];
         $conteudo = $registro[63];
         $bayer_gestiones_envios_gestion = $conteudo;
         if (null === $bayer_gestiones_envios_gestion)
         {
             $bayer_gestiones_envios_gestion = '';
         }
         if (null === $bayer_gestiones_envios_gestion_orig)
         {
             $bayer_gestiones_envios_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_envios_gestion = $bayer_gestiones_envios_gestion;
         $bayer_gestiones_medicamentos_gestion      = $registro[64];
         $bayer_gestiones_medicamentos_gestion_orig = $registro[64];
         $conteudo = $registro[64];
         $bayer_gestiones_medicamentos_gestion = $conteudo;
         if (null === $bayer_gestiones_medicamentos_gestion)
         {
             $bayer_gestiones_medicamentos_gestion = '';
         }
         if (null === $bayer_gestiones_medicamentos_gestion_orig)
         {
             $bayer_gestiones_medicamentos_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_medicamentos_gestion = $bayer_gestiones_medicamentos_gestion;
         $bayer_gestiones_tipo_envio_gestion      = $registro[65];
         $bayer_gestiones_tipo_envio_gestion_orig = $registro[65];
         $conteudo = $registro[65];
         $bayer_gestiones_tipo_envio_gestion = $conteudo;
         if (null === $bayer_gestiones_tipo_envio_gestion)
         {
             $bayer_gestiones_tipo_envio_gestion = '';
         }
         if (null === $bayer_gestiones_tipo_envio_gestion_orig)
         {
             $bayer_gestiones_tipo_envio_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_tipo_envio_gestion = $bayer_gestiones_tipo_envio_gestion;
         $bayer_gestiones_evento_adverso_gestion      = $registro[66];
         $bayer_gestiones_evento_adverso_gestion_orig = $registro[66];
         $conteudo = $registro[66];
         $bayer_gestiones_evento_adverso_gestion = $conteudo;
         if (null === $bayer_gestiones_evento_adverso_gestion)
         {
             $bayer_gestiones_evento_adverso_gestion = '';
         }
         if (null === $bayer_gestiones_evento_adverso_gestion_orig)
         {
             $bayer_gestiones_evento_adverso_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_evento_adverso_gestion = $bayer_gestiones_evento_adverso_gestion;
         $bayer_gestiones_tipo_evento_adverso      = $registro[67];
         $bayer_gestiones_tipo_evento_adverso_orig = $registro[67];
         $conteudo = $registro[67];
         $bayer_gestiones_tipo_evento_adverso = $conteudo;
         if (null === $bayer_gestiones_tipo_evento_adverso)
         {
             $bayer_gestiones_tipo_evento_adverso = '';
         }
         if (null === $bayer_gestiones_tipo_evento_adverso_orig)
         {
             $bayer_gestiones_tipo_evento_adverso_orig = '';
         }
         $val_grafico_bayer_gestiones_tipo_evento_adverso = $bayer_gestiones_tipo_evento_adverso;
         $bayer_gestiones_genera_solicitud_gestion      = $registro[68];
         $bayer_gestiones_genera_solicitud_gestion_orig = $registro[68];
         $conteudo = $registro[68];
         $bayer_gestiones_genera_solicitud_gestion = $conteudo;
         if (null === $bayer_gestiones_genera_solicitud_gestion)
         {
             $bayer_gestiones_genera_solicitud_gestion = '';
         }
         if (null === $bayer_gestiones_genera_solicitud_gestion_orig)
         {
             $bayer_gestiones_genera_solicitud_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_genera_solicitud_gestion = $bayer_gestiones_genera_solicitud_gestion;
         $bayer_gestiones_fecha_proxima_llamada      = $registro[69];
         $bayer_gestiones_fecha_proxima_llamada_orig = $registro[69];
         $conteudo = $registro[69];
        $conteudo_x =  $conteudo;
        nm_conv_limpa_dado($conteudo_x, "");
        if (is_numeric($conteudo_x) && $conteudo_x > 0) 
        { 
            $this->nm_data->SetaData($conteudo, "");
            $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
        } 
         $bayer_gestiones_fecha_proxima_llamada = $conteudo;
         if (null === $bayer_gestiones_fecha_proxima_llamada)
         {
             $bayer_gestiones_fecha_proxima_llamada = '';
         }
         if (null === $bayer_gestiones_fecha_proxima_llamada_orig)
         {
             $bayer_gestiones_fecha_proxima_llamada_orig = '';
         }
         $val_grafico_bayer_gestiones_fecha_proxima_llamada = $bayer_gestiones_fecha_proxima_llamada;
         $bayer_gestiones_motivo_proxima_llamada      = $registro[70];
         $bayer_gestiones_motivo_proxima_llamada_orig = $registro[70];
         $conteudo = $registro[70];
         $bayer_gestiones_motivo_proxima_llamada = $conteudo;
         if (null === $bayer_gestiones_motivo_proxima_llamada)
         {
             $bayer_gestiones_motivo_proxima_llamada = '';
         }
         if (null === $bayer_gestiones_motivo_proxima_llamada_orig)
         {
             $bayer_gestiones_motivo_proxima_llamada_orig = '';
         }
         $val_grafico_bayer_gestiones_motivo_proxima_llamada = $bayer_gestiones_motivo_proxima_llamada;
         $bayer_gestiones_observacion_proxima_llamada      = $registro[71];
         $bayer_gestiones_observacion_proxima_llamada_orig = $registro[71];
         $conteudo = $registro[71];
         $bayer_gestiones_observacion_proxima_llamada = $conteudo;
         if (null === $bayer_gestiones_observacion_proxima_llamada)
         {
             $bayer_gestiones_observacion_proxima_llamada = '';
         }
         if (null === $bayer_gestiones_observacion_proxima_llamada_orig)
         {
             $bayer_gestiones_observacion_proxima_llamada_orig = '';
         }
         $val_grafico_bayer_gestiones_observacion_proxima_llamada = $bayer_gestiones_observacion_proxima_llamada;
         $bayer_gestiones_fecha_reclamacion_gestion      = $registro[72];
         $bayer_gestiones_fecha_reclamacion_gestion_orig = $registro[72];
         $conteudo = $registro[72];
        $conteudo_x =  $conteudo;
        nm_conv_limpa_dado($conteudo_x, "");
        if (is_numeric($conteudo_x) && $conteudo_x > 0) 
        { 
            $this->nm_data->SetaData($conteudo, "");
            $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
        } 
         $bayer_gestiones_fecha_reclamacion_gestion = $conteudo;
         if (null === $bayer_gestiones_fecha_reclamacion_gestion)
         {
             $bayer_gestiones_fecha_reclamacion_gestion = '';
         }
         if (null === $bayer_gestiones_fecha_reclamacion_gestion_orig)
         {
             $bayer_gestiones_fecha_reclamacion_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_fecha_reclamacion_gestion = $bayer_gestiones_fecha_reclamacion_gestion;
         $bayer_gestiones_consecutivo_gestion      = $registro[73];
         $bayer_gestiones_consecutivo_gestion_orig = $registro[73];
         $conteudo = $registro[73];
         $bayer_gestiones_consecutivo_gestion = $conteudo;
         if (null === $bayer_gestiones_consecutivo_gestion)
         {
             $bayer_gestiones_consecutivo_gestion = '';
         }
         if (null === $bayer_gestiones_consecutivo_gestion_orig)
         {
             $bayer_gestiones_consecutivo_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_consecutivo_gestion = $bayer_gestiones_consecutivo_gestion;
         $bayer_gestiones_autor_gestion      = $registro[74];
         $bayer_gestiones_autor_gestion_orig = $registro[74];
         $conteudo = $registro[74];
         $bayer_gestiones_autor_gestion = $conteudo;
         if (null === $bayer_gestiones_autor_gestion)
         {
             $bayer_gestiones_autor_gestion = '';
         }
         if (null === $bayer_gestiones_autor_gestion_orig)
         {
             $bayer_gestiones_autor_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_autor_gestion = $bayer_gestiones_autor_gestion;
         $bayer_gestiones_nota      = $registro[75];
         $bayer_gestiones_nota_orig = $registro[75];
         $conteudo = $registro[75];
         $bayer_gestiones_nota = $conteudo;
         if (null === $bayer_gestiones_nota)
         {
             $bayer_gestiones_nota = '';
         }
         if (null === $bayer_gestiones_nota_orig)
         {
             $bayer_gestiones_nota_orig = '';
         }
         $val_grafico_bayer_gestiones_nota = $bayer_gestiones_nota;
         $bayer_gestiones_fecha_programada_gestion      = $registro[76];
         $bayer_gestiones_fecha_programada_gestion_orig = $registro[76];
         $conteudo = $registro[76];
        $conteudo_x =  $conteudo;
        nm_conv_limpa_dado($conteudo_x, "");
        if (is_numeric($conteudo_x) && $conteudo_x > 0) 
        { 
            $this->nm_data->SetaData($conteudo, "");
            $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
        } 
         $bayer_gestiones_fecha_programada_gestion = $conteudo;
         if (null === $bayer_gestiones_fecha_programada_gestion)
         {
             $bayer_gestiones_fecha_programada_gestion = '';
         }
         if (null === $bayer_gestiones_fecha_programada_gestion_orig)
         {
             $bayer_gestiones_fecha_programada_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_fecha_programada_gestion = $bayer_gestiones_fecha_programada_gestion;
         $bayer_gestiones_usuario_asigando      = $registro[77];
         $bayer_gestiones_usuario_asigando_orig = $registro[77];
         $conteudo = $registro[77];
         $bayer_gestiones_usuario_asigando = $conteudo;
         if (null === $bayer_gestiones_usuario_asigando)
         {
             $bayer_gestiones_usuario_asigando = '';
         }
         if (null === $bayer_gestiones_usuario_asigando_orig)
         {
             $bayer_gestiones_usuario_asigando_orig = '';
         }
         $val_grafico_bayer_gestiones_usuario_asigando = $bayer_gestiones_usuario_asigando;
         $bayer_gestiones_id_paciente_fk2      = $registro[78];
         $bayer_gestiones_id_paciente_fk2_orig = $registro[78];
         $conteudo = $registro[78];
        nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $bayer_gestiones_id_paciente_fk2 = $conteudo;
         if (null === $bayer_gestiones_id_paciente_fk2)
         {
             $bayer_gestiones_id_paciente_fk2 = '';
         }
         if (null === $bayer_gestiones_id_paciente_fk2_orig)
         {
             $bayer_gestiones_id_paciente_fk2_orig = '';
         }
         $val_grafico_bayer_gestiones_id_paciente_fk2 = $bayer_gestiones_id_paciente_fk2;
         $registro[79] = substr($registro[79], 0, 10);
         $bayer_gestiones_fecha_comunicacion      = $registro[79];
         $bayer_gestiones_fecha_comunicacion_orig = $registro[79];
         $conteudo = $registro[79];
        if (substr($conteudo, 10, 1) == "-") 
        { 
            $conteudo = substr($conteudo, 0, 10) . " " . substr($conteudo, 11);
        } 
        if (substr($conteudo, 13, 1) == ".") 
        { 
           $conteudo = substr($conteudo, 0, 13) . ":" . substr($conteudo, 14, 2) . ":" . substr($conteudo, 17);
        } 
        $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
        $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa"));
         $bayer_gestiones_fecha_comunicacion = $conteudo;
         if (null === $bayer_gestiones_fecha_comunicacion)
         {
             $bayer_gestiones_fecha_comunicacion = '';
         }
         if (null === $bayer_gestiones_fecha_comunicacion_orig)
         {
             $bayer_gestiones_fecha_comunicacion_orig = '';
         }
         $val_grafico_bayer_gestiones_fecha_comunicacion = $bayer_gestiones_fecha_comunicacion;
         $bayer_gestiones_estado_gestion      = $registro[80];
         $bayer_gestiones_estado_gestion_orig = $registro[80];
         $conteudo = $registro[80];
         $bayer_gestiones_estado_gestion = $conteudo;
         if (null === $bayer_gestiones_estado_gestion)
         {
             $bayer_gestiones_estado_gestion = '';
         }
         if (null === $bayer_gestiones_estado_gestion_orig)
         {
             $bayer_gestiones_estado_gestion_orig = '';
         }
         $val_grafico_bayer_gestiones_estado_gestion = $bayer_gestiones_estado_gestion;
         $bayer_gestiones_codigo_argus      = $registro[81];
         $bayer_gestiones_codigo_argus_orig = $registro[81];
         $conteudo = $registro[81];
         $bayer_gestiones_codigo_argus = $conteudo;
         if (null === $bayer_gestiones_codigo_argus)
         {
             $bayer_gestiones_codigo_argus = '';
         }
         if (null === $bayer_gestiones_codigo_argus_orig)
         {
             $bayer_gestiones_codigo_argus_orig = '';
         }
         $val_grafico_bayer_gestiones_codigo_argus = $bayer_gestiones_codigo_argus;
         $bayer_gestiones_numero_cajas      = $registro[82];
         $bayer_gestiones_numero_cajas_orig = $registro[82];
         $conteudo = $registro[82];
         $bayer_gestiones_numero_cajas = $conteudo;
         if (null === $bayer_gestiones_numero_cajas)
         {
             $bayer_gestiones_numero_cajas = '';
         }
         if (null === $bayer_gestiones_numero_cajas_orig)
         {
             $bayer_gestiones_numero_cajas_orig = '';
         }
         $val_grafico_bayer_gestiones_numero_cajas = $bayer_gestiones_numero_cajas;
         $bayer_pacientes_fecha_activacion_paciente_orig        = NM_encode_input($bayer_pacientes_fecha_activacion_paciente_orig);
         $val_grafico_bayer_pacientes_fecha_activacion_paciente = NM_encode_input($val_grafico_bayer_pacientes_fecha_activacion_paciente);
         $bayer_pacientes_fecha_retiro_paciente_orig        = NM_encode_input($bayer_pacientes_fecha_retiro_paciente_orig);
         $val_grafico_bayer_pacientes_fecha_retiro_paciente = NM_encode_input($val_grafico_bayer_pacientes_fecha_retiro_paciente);
         $bayer_pacientes_fecha_nacimineto_paciente_orig        = NM_encode_input($bayer_pacientes_fecha_nacimineto_paciente_orig);
         $val_grafico_bayer_pacientes_fecha_nacimineto_paciente = NM_encode_input($val_grafico_bayer_pacientes_fecha_nacimineto_paciente);
         $bayer_pacientes_edad_paciente_orig        = NM_encode_input($bayer_pacientes_edad_paciente_orig);
         $val_grafico_bayer_pacientes_edad_paciente = NM_encode_input($val_grafico_bayer_pacientes_edad_paciente);
         $bayer_pacientes_codigo_xofigo_orig        = NM_encode_input($bayer_pacientes_codigo_xofigo_orig);
         $val_grafico_bayer_pacientes_codigo_xofigo = NM_encode_input($val_grafico_bayer_pacientes_codigo_xofigo);
         $bayer_pacientes_id_ultima_gestion_orig        = NM_encode_input($bayer_pacientes_id_ultima_gestion_orig);
         $val_grafico_bayer_pacientes_id_ultima_gestion = NM_encode_input($val_grafico_bayer_pacientes_id_ultima_gestion);
         $bayer_tratamiento_id_tratamiento_orig        = NM_encode_input($bayer_tratamiento_id_tratamiento_orig);
         $val_grafico_bayer_tratamiento_id_tratamiento = NM_encode_input($val_grafico_bayer_tratamiento_id_tratamiento);
         $bayer_tratamiento_fecha_inicio_terapia_tratamiento_orig        = NM_encode_input($bayer_tratamiento_fecha_inicio_terapia_tratamiento_orig);
         $val_grafico_bayer_tratamiento_fecha_inicio_terapia_tratamiento = NM_encode_input($val_grafico_bayer_tratamiento_fecha_inicio_terapia_tratamiento);
         $bayer_tratamiento_fecha_ultima_reclamacion_tratamiento_orig        = NM_encode_input($bayer_tratamiento_fecha_ultima_reclamacion_tratamiento_orig);
         $val_grafico_bayer_tratamiento_fecha_ultima_reclamacion_tratamiento = NM_encode_input($val_grafico_bayer_tratamiento_fecha_ultima_reclamacion_tratamiento);
         $bayer_tratamiento_id_paciente_fk_orig        = NM_encode_input($bayer_tratamiento_id_paciente_fk_orig);
         $val_grafico_bayer_tratamiento_id_paciente_fk = NM_encode_input($val_grafico_bayer_tratamiento_id_paciente_fk);
         $bayer_gestiones_id_gestion_orig        = NM_encode_input($bayer_gestiones_id_gestion_orig);
         $val_grafico_bayer_gestiones_id_gestion = NM_encode_input($val_grafico_bayer_gestiones_id_gestion);
         $bayer_gestiones_fecha_proxima_llamada_orig        = NM_encode_input($bayer_gestiones_fecha_proxima_llamada_orig);
         $val_grafico_bayer_gestiones_fecha_proxima_llamada = NM_encode_input($val_grafico_bayer_gestiones_fecha_proxima_llamada);
         $bayer_gestiones_fecha_reclamacion_gestion_orig        = NM_encode_input($bayer_gestiones_fecha_reclamacion_gestion_orig);
         $val_grafico_bayer_gestiones_fecha_reclamacion_gestion = NM_encode_input($val_grafico_bayer_gestiones_fecha_reclamacion_gestion);
         $bayer_gestiones_fecha_programada_gestion_orig        = NM_encode_input($bayer_gestiones_fecha_programada_gestion_orig);
         $val_grafico_bayer_gestiones_fecha_programada_gestion = NM_encode_input($val_grafico_bayer_gestiones_fecha_programada_gestion);
         $bayer_gestiones_id_paciente_fk2_orig        = NM_encode_input($bayer_gestiones_id_paciente_fk2_orig);
         $val_grafico_bayer_gestiones_id_paciente_fk2 = NM_encode_input($val_grafico_bayer_gestiones_id_paciente_fk2);
         $bayer_gestiones_fecha_comunicacion_orig        = NM_encode_input($bayer_gestiones_fecha_comunicacion_orig);
         $val_grafico_bayer_gestiones_fecha_comunicacion = NM_encode_input($val_grafico_bayer_gestiones_fecha_comunicacion);
         $contr_arr = "";
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
         {
             $temp       = $cmp_gb . "_orig";
             $contr_arr .= "['" . $$temp . "']";
             $arr_name   = "array_total_" . $cmp_gb . $contr_arr;
            eval ('
             if (!isset($' . $arr_name . '))
             {
                 $' . $arr_name . '[0] = ' . $registro[0] . ';
                 $' . $arr_name . '[1] = $val_grafico_' . $cmp_gb . ';
                 $' . $arr_name . '[2] = "' . $$temp . '";
             }
             else
             {
                 $' . $arr_name . '[0] += ' . $registro[0] . ';
             }
            ');
         }
      }
   }
   //-----
   function get_array($rs)
   {
       if ('ado_mssql' != $this->Ini->nm_tpbanco)
       {
           return $rs->GetArray();
       }

       $array_db_total = array();
       while (!$rs->EOF)
       {
           $arr_row = array();
           foreach ($rs->fields as $k => $v)
           {
               $arr_row[$k] = $v . '';
           }
           $array_db_total[] = $arr_row;
           $rs->MoveNext();
       }
       return $array_db_total;
   }
   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT")
       {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT")
       {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       nm_conv_form_data($dt_out, $form_in, $form_out);
       return $dt_out;
   }

   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
}

?>
