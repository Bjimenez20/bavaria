<?php

class lis_pacientes_csv
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;

   var $arquivo;
   var $tit_doc;
   var $delim_dados;
   var $delim_line;
   var $delim_col;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function lis_pacientes_csv()
   {
      $this->nm_data   = new nm_data("es");
   }

   //---- 
   function monta_csv()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
     global $nm_lang;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->arquivo     = "sc_csv";
      $this->arquivo    .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->arquivo    .= "_lis_pacientes";
      $this->arquivo    .= ".csv";
      $this->tit_doc    = "lis_pacientes.csv";
      $this->delim_dados = "\"";
      $this->delim_col   = ";";
      $this->delim_line  = "\r\n";
   }

   //----- 
   function grava_arquivo()
   {
     global $nm_lang;
      global
             $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['lis_pacientes']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['lis_pacientes']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['lis_pacientes']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->bayer_pacientes_id_paciente = $Busca_temp['bayer_pacientes_id_paciente']; 
          $tmp_pos = strpos($this->bayer_pacientes_id_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_pacientes_id_paciente = substr($this->bayer_pacientes_id_paciente, 0, $tmp_pos);
          }
          $this->bayer_pacientes_id_paciente_2 = $Busca_temp['bayer_pacientes_id_paciente_input_2']; 
          $this->bayer_pacientes_estado_paciente = $Busca_temp['bayer_pacientes_estado_paciente']; 
          $tmp_pos = strpos($this->bayer_pacientes_estado_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_pacientes_estado_paciente = substr($this->bayer_pacientes_estado_paciente, 0, $tmp_pos);
          }
          $this->bayer_pacientes_fecha_activacion_paciente = $Busca_temp['bayer_pacientes_fecha_activacion_paciente']; 
          $tmp_pos = strpos($this->bayer_pacientes_fecha_activacion_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_pacientes_fecha_activacion_paciente = substr($this->bayer_pacientes_fecha_activacion_paciente, 0, $tmp_pos);
          }
          $this->bayer_pacientes_fecha_retiro_paciente = $Busca_temp['bayer_pacientes_fecha_retiro_paciente']; 
          $tmp_pos = strpos($this->bayer_pacientes_fecha_retiro_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_pacientes_fecha_retiro_paciente = substr($this->bayer_pacientes_fecha_retiro_paciente, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['csv_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['csv_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['csv_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['csv_name']);
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT bayer_pacientes.ID_PACIENTE as bayer_pacientes_id_paciente, bayer_pacientes.ESTADO_PACIENTE as cmp_maior_30_1, bayer_pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, bayer_pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, bayer_pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, bayer_pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, bayer_pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, bayer_pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, bayer_pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, bayer_pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, bayer_pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, bayer_pacientes.CORREO_PACIENTE as cmp_maior_30_12, bayer_pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, bayer_pacientes.BARRIO_PACIENTE as cmp_maior_30_14, bayer_pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, bayer_pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, bayer_pacientes.GENERO_PACIENTE as cmp_maior_30_17, bayer_pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, bayer_pacientes.EDAD_PACIENTE as bayer_pacientes_edad_paciente, bayer_pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, bayer_pacientes.CODIGO_XOFIGO as bayer_pacientes_codigo_xofigo, bayer_pacientes.STATUS_PACIENTE as cmp_maior_30_21, bayer_pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, bayer_pacientes.USUARIO_CREACION as cmp_maior_30_23, bayer_tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, bayer_tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, bayer_tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, bayer_tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, bayer_tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, bayer_tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, bayer_tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, bayer_tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, bayer_tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT bayer_pacientes.ID_PACIENTE as bayer_pacientes_id_paciente, bayer_pacientes.ESTADO_PACIENTE as cmp_maior_30_1, bayer_pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, bayer_pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, bayer_pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, bayer_pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, bayer_pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, bayer_pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, bayer_pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, bayer_pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, bayer_pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, bayer_pacientes.CORREO_PACIENTE as cmp_maior_30_12, bayer_pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, bayer_pacientes.BARRIO_PACIENTE as cmp_maior_30_14, bayer_pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, bayer_pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, bayer_pacientes.GENERO_PACIENTE as cmp_maior_30_17, bayer_pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, bayer_pacientes.EDAD_PACIENTE as bayer_pacientes_edad_paciente, bayer_pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, bayer_pacientes.CODIGO_XOFIGO as bayer_pacientes_codigo_xofigo, bayer_pacientes.STATUS_PACIENTE as cmp_maior_30_21, bayer_pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, bayer_pacientes.USUARIO_CREACION as cmp_maior_30_23, bayer_tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, bayer_tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, bayer_tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, bayer_tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, bayer_tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, bayer_tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, bayer_tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, bayer_tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, bayer_tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT bayer_pacientes.ID_PACIENTE as bayer_pacientes_id_paciente, bayer_pacientes.ESTADO_PACIENTE as cmp_maior_30_1, bayer_pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, bayer_pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, bayer_pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, bayer_pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, bayer_pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, bayer_pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, bayer_pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, bayer_pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, bayer_pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, bayer_pacientes.CORREO_PACIENTE as cmp_maior_30_12, bayer_pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, bayer_pacientes.BARRIO_PACIENTE as cmp_maior_30_14, bayer_pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, bayer_pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, bayer_pacientes.GENERO_PACIENTE as cmp_maior_30_17, bayer_pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, bayer_pacientes.EDAD_PACIENTE as bayer_pacientes_edad_paciente, bayer_pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, bayer_pacientes.CODIGO_XOFIGO as bayer_pacientes_codigo_xofigo, bayer_pacientes.STATUS_PACIENTE as cmp_maior_30_21, bayer_pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, bayer_pacientes.USUARIO_CREACION as cmp_maior_30_23, bayer_tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, bayer_tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, bayer_tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, bayer_tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, bayer_tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, bayer_tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, bayer_tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, bayer_tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, bayer_tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT bayer_pacientes.ID_PACIENTE as bayer_pacientes_id_paciente, bayer_pacientes.ESTADO_PACIENTE as cmp_maior_30_1, bayer_pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, bayer_pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, bayer_pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, bayer_pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, bayer_pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, bayer_pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, bayer_pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, bayer_pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, bayer_pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, bayer_pacientes.CORREO_PACIENTE as cmp_maior_30_12, bayer_pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, bayer_pacientes.BARRIO_PACIENTE as cmp_maior_30_14, bayer_pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, bayer_pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, bayer_pacientes.GENERO_PACIENTE as cmp_maior_30_17, bayer_pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, bayer_pacientes.EDAD_PACIENTE as bayer_pacientes_edad_paciente, bayer_pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, bayer_pacientes.CODIGO_XOFIGO as bayer_pacientes_codigo_xofigo, bayer_pacientes.STATUS_PACIENTE as cmp_maior_30_21, bayer_pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, bayer_pacientes.USUARIO_CREACION as cmp_maior_30_23, bayer_tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, bayer_tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, bayer_tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, bayer_tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, bayer_tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, bayer_tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, bayer_tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, bayer_tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, bayer_tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT bayer_pacientes.ID_PACIENTE as bayer_pacientes_id_paciente, bayer_pacientes.ESTADO_PACIENTE as cmp_maior_30_1, bayer_pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, bayer_pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, bayer_pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, bayer_pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, bayer_pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, bayer_pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, bayer_pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, bayer_pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, bayer_pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, bayer_pacientes.CORREO_PACIENTE as cmp_maior_30_12, bayer_pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, bayer_pacientes.BARRIO_PACIENTE as cmp_maior_30_14, bayer_pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, bayer_pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, bayer_pacientes.GENERO_PACIENTE as cmp_maior_30_17, bayer_pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, bayer_pacientes.EDAD_PACIENTE as bayer_pacientes_edad_paciente, bayer_pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, bayer_pacientes.CODIGO_XOFIGO as bayer_pacientes_codigo_xofigo, bayer_pacientes.STATUS_PACIENTE as cmp_maior_30_21, bayer_pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, bayer_pacientes.USUARIO_CREACION as cmp_maior_30_23, bayer_tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, bayer_tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, bayer_tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, bayer_tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, bayer_tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, bayer_tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, bayer_tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, bayer_tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, bayer_tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT bayer_pacientes.ID_PACIENTE as bayer_pacientes_id_paciente, bayer_pacientes.ESTADO_PACIENTE as cmp_maior_30_1, bayer_pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, bayer_pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, bayer_pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, bayer_pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, bayer_pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, bayer_pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, bayer_pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, bayer_pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, bayer_pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, bayer_pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, bayer_pacientes.CORREO_PACIENTE as cmp_maior_30_12, bayer_pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, bayer_pacientes.BARRIO_PACIENTE as cmp_maior_30_14, bayer_pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, bayer_pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, bayer_pacientes.GENERO_PACIENTE as cmp_maior_30_17, bayer_pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, bayer_pacientes.EDAD_PACIENTE as bayer_pacientes_edad_paciente, bayer_pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, bayer_pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, bayer_pacientes.CODIGO_XOFIGO as bayer_pacientes_codigo_xofigo, bayer_pacientes.STATUS_PACIENTE as cmp_maior_30_21, bayer_pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, bayer_pacientes.USUARIO_CREACION as cmp_maior_30_23, bayer_tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, bayer_tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, bayer_tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, bayer_tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, bayer_tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, bayer_tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, bayer_tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, bayer_tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, bayer_tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, bayer_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, bayer_tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, bayer_tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, bayer_tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, bayer_tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, bayer_tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, bayer_tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, bayer_tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, bayer_tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, bayer_tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, bayer_tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, bayer_tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      $csv_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo, "w");
      while (!$rs->EOF)
      {
         $this->csv_registro = "";
         $this->NM_prim_col  = 0;
         $this->bayer_pacientes_id_paciente = $rs->fields[0] ;  
         $this->bayer_pacientes_id_paciente = (string)$this->bayer_pacientes_id_paciente;
         $this->bayer_pacientes_estado_paciente = $rs->fields[1] ;  
         $this->bayer_pacientes_fecha_activacion_paciente = $rs->fields[2] ;  
         $this->bayer_pacientes_fecha_retiro_paciente = $rs->fields[3] ;  
         $this->bayer_pacientes_motivo_retiro_paciente = $rs->fields[4] ;  
         $this->bayer_pacientes_observacion_motivo_retiro_paciente = $rs->fields[5] ;  
         $this->bayer_pacientes_identificacion_paciente = $rs->fields[6] ;  
         $this->bayer_pacientes_nombre_paciente = $rs->fields[7] ;  
         $this->bayer_pacientes_apellido_paciente = $rs->fields[8] ;  
         $this->bayer_pacientes_telefono_paciente = $rs->fields[9] ;  
         $this->bayer_pacientes_telefono2_paciente = $rs->fields[10] ;  
         $this->bayer_pacientes_telefono3_paciente = $rs->fields[11] ;  
         $this->bayer_pacientes_correo_paciente = $rs->fields[12] ;  
         $this->bayer_pacientes_direccion_paciente = $rs->fields[13] ;  
         $this->bayer_pacientes_barrio_paciente = $rs->fields[14] ;  
         $this->bayer_pacientes_departamento_paciente = $rs->fields[15] ;  
         $this->bayer_pacientes_ciudad_paciente = $rs->fields[16] ;  
         $this->bayer_pacientes_genero_paciente = $rs->fields[17] ;  
         $this->bayer_pacientes_fecha_nacimineto_paciente = $rs->fields[18] ;  
         $this->bayer_pacientes_edad_paciente = $rs->fields[19] ;  
         $this->bayer_pacientes_edad_paciente = (string)$this->bayer_pacientes_edad_paciente;
         $this->bayer_pacientes_acudiente_paciente = $rs->fields[20] ;  
         $this->bayer_pacientes_telefono_acudiente_paciente = $rs->fields[21] ;  
         $this->bayer_pacientes_codigo_xofigo = $rs->fields[22] ;  
         $this->bayer_pacientes_codigo_xofigo = (string)$this->bayer_pacientes_codigo_xofigo;
         $this->bayer_pacientes_status_paciente = $rs->fields[23] ;  
         $this->bayer_pacientes_id_ultima_gestion = $rs->fields[24] ;  
         $this->bayer_pacientes_id_ultima_gestion = (string)$this->bayer_pacientes_id_ultima_gestion;
         $this->bayer_pacientes_usuario_creacion = $rs->fields[25] ;  
         $this->bayer_tratamiento_id_tratamiento = $rs->fields[26] ;  
         $this->bayer_tratamiento_id_tratamiento = (string)$this->bayer_tratamiento_id_tratamiento;
         $this->bayer_tratamiento_producto_tratamiento = $rs->fields[27] ;  
         $this->bayer_tratamiento_nombre_referencia = $rs->fields[28] ;  
         $this->bayer_tratamiento_clasificacion_patologica_tratamiento = $rs->fields[29] ;  
         $this->bayer_tratamiento_tratamiento_previo = $rs->fields[30] ;  
         $this->bayer_tratamiento_consentimiento_tratamiento = $rs->fields[31] ;  
         $this->bayer_tratamiento_fecha_inicio_terapia_tratamiento = $rs->fields[32] ;  
         $this->bayer_tratamiento_regimen_tratamiento = $rs->fields[33] ;  
         $this->bayer_tratamiento_asegurador_tratamiento = $rs->fields[34] ;  
         $this->bayer_tratamiento_operador_logistico_tratamiento = $rs->fields[35] ;  
         $this->bayer_tratamiento_punto_entrega = $rs->fields[36] ;  
         $this->bayer_tratamiento_fecha_ultima_reclamacion_tratamiento = $rs->fields[37] ;  
         $this->bayer_tratamiento_otros_operadores_tratamiento = $rs->fields[38] ;  
         $this->bayer_tratamiento_medios_adquisicion_tratamiento = $rs->fields[39] ;  
         $this->bayer_tratamiento_ips_atiende_tratamiento = $rs->fields[40] ;  
         $this->bayer_tratamiento_medico_tratamiento = $rs->fields[41] ;  
         $this->bayer_tratamiento_especialidad_tratamiento = $rs->fields[42] ;  
         $this->bayer_tratamiento_paramedico_tratamiento = $rs->fields[43] ;  
         $this->bayer_tratamiento_zona_atencion_paramedico_tratamiento = $rs->fields[44] ;  
         $this->bayer_tratamiento_ciudad_base_paramedico_tratamiento = $rs->fields[45] ;  
         $this->bayer_tratamiento_notas_adjuntos_tratamiento = $rs->fields[46] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->csv_registro .= $this->delim_line;
         fwrite($csv_f, $this->csv_registro);
         $rs->MoveNext();
      }
      fclose($csv_f);

      $rs->Close();
   }
   //----- bayer_pacientes_id_paciente
   function NM_export_bayer_pacientes_id_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_id_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_estado_paciente
   function NM_export_bayer_pacientes_estado_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_estado_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_fecha_activacion_paciente
   function NM_export_bayer_pacientes_fecha_activacion_paciente()
   {
         $conteudo_x =  $this->bayer_pacientes_fecha_activacion_paciente;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->bayer_pacientes_fecha_activacion_paciente, "");
             $this->bayer_pacientes_fecha_activacion_paciente = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_fecha_activacion_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_fecha_retiro_paciente
   function NM_export_bayer_pacientes_fecha_retiro_paciente()
   {
         $conteudo_x =  $this->bayer_pacientes_fecha_retiro_paciente;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->bayer_pacientes_fecha_retiro_paciente, "");
             $this->bayer_pacientes_fecha_retiro_paciente = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_fecha_retiro_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_motivo_retiro_paciente
   function NM_export_bayer_pacientes_motivo_retiro_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_motivo_retiro_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_observacion_motivo_retiro_paciente
   function NM_export_bayer_pacientes_observacion_motivo_retiro_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_observacion_motivo_retiro_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_identificacion_paciente
   function NM_export_bayer_pacientes_identificacion_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_identificacion_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_nombre_paciente
   function NM_export_bayer_pacientes_nombre_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_nombre_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_apellido_paciente
   function NM_export_bayer_pacientes_apellido_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_apellido_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_telefono_paciente
   function NM_export_bayer_pacientes_telefono_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_telefono_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_telefono2_paciente
   function NM_export_bayer_pacientes_telefono2_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_telefono2_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_telefono3_paciente
   function NM_export_bayer_pacientes_telefono3_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_telefono3_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_correo_paciente
   function NM_export_bayer_pacientes_correo_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_correo_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_direccion_paciente
   function NM_export_bayer_pacientes_direccion_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_direccion_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_barrio_paciente
   function NM_export_bayer_pacientes_barrio_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_barrio_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_departamento_paciente
   function NM_export_bayer_pacientes_departamento_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_departamento_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_ciudad_paciente
   function NM_export_bayer_pacientes_ciudad_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_ciudad_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_genero_paciente
   function NM_export_bayer_pacientes_genero_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_genero_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_fecha_nacimineto_paciente
   function NM_export_bayer_pacientes_fecha_nacimineto_paciente()
   {
         $conteudo_x =  $this->bayer_pacientes_fecha_nacimineto_paciente;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->bayer_pacientes_fecha_nacimineto_paciente, "");
             $this->bayer_pacientes_fecha_nacimineto_paciente = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_fecha_nacimineto_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_edad_paciente
   function NM_export_bayer_pacientes_edad_paciente()
   {
         nmgp_Form_Num_Val($this->bayer_pacientes_edad_paciente, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_edad_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_acudiente_paciente
   function NM_export_bayer_pacientes_acudiente_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_acudiente_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_telefono_acudiente_paciente
   function NM_export_bayer_pacientes_telefono_acudiente_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_telefono_acudiente_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_codigo_xofigo
   function NM_export_bayer_pacientes_codigo_xofigo()
   {
         nmgp_Form_Num_Val($this->bayer_pacientes_codigo_xofigo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_codigo_xofigo);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_status_paciente
   function NM_export_bayer_pacientes_status_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_status_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_id_ultima_gestion
   function NM_export_bayer_pacientes_id_ultima_gestion()
   {
         nmgp_Form_Num_Val($this->bayer_pacientes_id_ultima_gestion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_id_ultima_gestion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_pacientes_usuario_creacion
   function NM_export_bayer_pacientes_usuario_creacion()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_pacientes_usuario_creacion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_id_tratamiento
   function NM_export_bayer_tratamiento_id_tratamiento()
   {
         nmgp_Form_Num_Val($this->bayer_tratamiento_id_tratamiento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_id_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_producto_tratamiento
   function NM_export_bayer_tratamiento_producto_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_producto_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_nombre_referencia
   function NM_export_bayer_tratamiento_nombre_referencia()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_nombre_referencia);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_clasificacion_patologica_tratamiento
   function NM_export_bayer_tratamiento_clasificacion_patologica_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_clasificacion_patologica_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_tratamiento_previo
   function NM_export_bayer_tratamiento_tratamiento_previo()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_tratamiento_previo);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_consentimiento_tratamiento
   function NM_export_bayer_tratamiento_consentimiento_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_consentimiento_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_fecha_inicio_terapia_tratamiento
   function NM_export_bayer_tratamiento_fecha_inicio_terapia_tratamiento()
   {
         $conteudo_x =  $this->bayer_tratamiento_fecha_inicio_terapia_tratamiento;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->bayer_tratamiento_fecha_inicio_terapia_tratamiento, "");
             $this->bayer_tratamiento_fecha_inicio_terapia_tratamiento = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_fecha_inicio_terapia_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_regimen_tratamiento
   function NM_export_bayer_tratamiento_regimen_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_regimen_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_asegurador_tratamiento
   function NM_export_bayer_tratamiento_asegurador_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_asegurador_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_operador_logistico_tratamiento
   function NM_export_bayer_tratamiento_operador_logistico_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_operador_logistico_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_punto_entrega
   function NM_export_bayer_tratamiento_punto_entrega()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_punto_entrega);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_fecha_ultima_reclamacion_tratamiento
   function NM_export_bayer_tratamiento_fecha_ultima_reclamacion_tratamiento()
   {
         $conteudo_x =  $this->bayer_tratamiento_fecha_ultima_reclamacion_tratamiento;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->bayer_tratamiento_fecha_ultima_reclamacion_tratamiento, "");
             $this->bayer_tratamiento_fecha_ultima_reclamacion_tratamiento = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_fecha_ultima_reclamacion_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_otros_operadores_tratamiento
   function NM_export_bayer_tratamiento_otros_operadores_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_otros_operadores_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_medios_adquisicion_tratamiento
   function NM_export_bayer_tratamiento_medios_adquisicion_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_medios_adquisicion_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_ips_atiende_tratamiento
   function NM_export_bayer_tratamiento_ips_atiende_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_ips_atiende_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_medico_tratamiento
   function NM_export_bayer_tratamiento_medico_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_medico_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_especialidad_tratamiento
   function NM_export_bayer_tratamiento_especialidad_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_especialidad_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_paramedico_tratamiento
   function NM_export_bayer_tratamiento_paramedico_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_paramedico_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_zona_atencion_paramedico_tratamiento
   function NM_export_bayer_tratamiento_zona_atencion_paramedico_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_zona_atencion_paramedico_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_ciudad_base_paramedico_tratamiento
   function NM_export_bayer_tratamiento_ciudad_base_paramedico_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_ciudad_base_paramedico_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- bayer_tratamiento_notas_adjuntos_tratamiento
   function NM_export_bayer_tratamiento_notas_adjuntos_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->bayer_tratamiento_notas_adjuntos_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
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
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Listado Pacientes :: CSV</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">CSV</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="lis_pacientes_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="lis_pacientes"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
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
