<?php

class BAYER_EA_xml
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;

   var $arquivo;
   var $arquivo_view;
   var $tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function BAYER_EA_xml()
   {
      $this->nm_data   = new nm_data("es");
   }

   //---- 
   function monta_xml()
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
      $this->nm_data    = new nm_data("es");
      $this->arquivo      = "sc_xml";
      $this->arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->arquivo     .= "_BAYER_EA";
      $this->arquivo_view = $this->arquivo . "_view.xml";
      $this->arquivo     .= ".xml";
      $this->tit_doc      = "BAYER_EA.xml";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
      }
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['BAYER_EA']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['BAYER_EA']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['BAYER_EA']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->bayer_evento_adverso_fecha_staff = $Busca_temp['bayer_evento_adverso_fecha_staff']; 
          $tmp_pos = strpos($this->bayer_evento_adverso_fecha_staff, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_evento_adverso_fecha_staff = substr($this->bayer_evento_adverso_fecha_staff, 0, $tmp_pos);
          }
          $this->bayer_evento_adverso_id_evento_adverso = $Busca_temp['bayer_evento_adverso_id_evento_adverso']; 
          $tmp_pos = strpos($this->bayer_evento_adverso_id_evento_adverso, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_evento_adverso_id_evento_adverso = substr($this->bayer_evento_adverso_id_evento_adverso, 0, $tmp_pos);
          }
          $this->bayer_evento_adverso_id_evento_adverso_2 = $Busca_temp['bayer_evento_adverso_id_evento_adverso_input_2']; 
          $this->bayer_evento_adverso_pais = $Busca_temp['bayer_evento_adverso_pais']; 
          $tmp_pos = strpos($this->bayer_evento_adverso_pais, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_evento_adverso_pais = substr($this->bayer_evento_adverso_pais, 0, $tmp_pos);
          }
          $this->bayer_evento_adverso_tipo_reporte = $Busca_temp['bayer_evento_adverso_tipo_reporte']; 
          $tmp_pos = strpos($this->bayer_evento_adverso_tipo_reporte, "##@@");
          if ($tmp_pos !== false)
          {
              $this->bayer_evento_adverso_tipo_reporte = substr($this->bayer_evento_adverso_tipo_reporte, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['xml_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['xml_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['xml_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->arquivo_view = $this->arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT bayer_evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, bayer_evento_adverso.PAIS as bayer_evento_adverso_pais, bayer_evento_adverso.TIPO_REPORTE as cmp_maior_30_2, bayer_evento_adverso.FECHA_STAFF as cmp_maior_30_3, bayer_evento_adverso.PRODUCTO as bayer_evento_adverso_producto, bayer_evento_adverso.CIUDAD as bayer_evento_adverso_ciudad, bayer_evento_adverso.GENERO as bayer_evento_adverso_genero, bayer_evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, bayer_evento_adverso.EMBARAZO as bayer_evento_adverso_embarazo, bayer_evento_adverso.FECHA_PARTO as cmp_maior_30_5, bayer_evento_adverso.DESENLACE as bayer_evento_adverso_desenlace, bayer_evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, bayer_evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, bayer_evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, bayer_evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, bayer_evento_adverso.FAX_MEDICO as cmp_maior_30_10, bayer_evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, bayer_evento_adverso.INDICACION1 as cmp_maior_30_12, bayer_evento_adverso.FORMULACION1 as cmp_maior_30_13, bayer_evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, bayer_evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, bayer_evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, bayer_evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, bayer_evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, bayer_evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, bayer_evento_adverso.INDICACION2 as cmp_maior_30_20, bayer_evento_adverso.FORMULACION2 as cmp_maior_30_21, bayer_evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, bayer_evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, bayer_evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, bayer_evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, bayer_evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, bayer_evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, bayer_evento_adverso.INDICACION3 as cmp_maior_30_28, bayer_evento_adverso.FORMULACION3 as cmp_maior_30_29, bayer_evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, bayer_evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, bayer_evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, bayer_evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, bayer_evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, bayer_evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, bayer_evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, bayer_evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, bayer_evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, bayer_evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, bayer_evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, bayer_evento_adverso.DESENLACE1 as cmp_maior_30_41, bayer_evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, bayer_evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, bayer_evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, bayer_evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, bayer_evento_adverso.DETALLES_EA1 as cmp_maior_30_53, bayer_evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, bayer_evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, bayer_evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, bayer_evento_adverso.DESENLACE2 as cmp_maior_30_57, bayer_evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, bayer_evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, bayer_evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, bayer_evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, bayer_evento_adverso.DETALLES_EA2 as cmp_maior_30_69, bayer_evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, bayer_evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, bayer_evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, bayer_evento_adverso.DESENLACE3 as cmp_maior_30_73, bayer_evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, bayer_evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, bayer_evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, bayer_evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, bayer_evento_adverso.DETALLES_EA3 as cmp_maior_30_85, bayer_evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, bayer_evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, bayer_evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, bayer_evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, bayer_evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, bayer_evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, bayer_evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, bayer_evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, bayer_evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, bayer_evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, bayer_evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, bayer_evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, bayer_evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, bayer_evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, bayer_evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, bayer_evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT bayer_evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, bayer_evento_adverso.PAIS as bayer_evento_adverso_pais, bayer_evento_adverso.TIPO_REPORTE as cmp_maior_30_2, bayer_evento_adverso.FECHA_STAFF as cmp_maior_30_3, bayer_evento_adverso.PRODUCTO as bayer_evento_adverso_producto, bayer_evento_adverso.CIUDAD as bayer_evento_adverso_ciudad, bayer_evento_adverso.GENERO as bayer_evento_adverso_genero, bayer_evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, bayer_evento_adverso.EMBARAZO as bayer_evento_adverso_embarazo, bayer_evento_adverso.FECHA_PARTO as cmp_maior_30_5, bayer_evento_adverso.DESENLACE as bayer_evento_adverso_desenlace, bayer_evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, bayer_evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, bayer_evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, bayer_evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, bayer_evento_adverso.FAX_MEDICO as cmp_maior_30_10, bayer_evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, bayer_evento_adverso.INDICACION1 as cmp_maior_30_12, bayer_evento_adverso.FORMULACION1 as cmp_maior_30_13, bayer_evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, bayer_evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, bayer_evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, bayer_evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, bayer_evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, bayer_evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, bayer_evento_adverso.INDICACION2 as cmp_maior_30_20, bayer_evento_adverso.FORMULACION2 as cmp_maior_30_21, bayer_evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, bayer_evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, bayer_evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, bayer_evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, bayer_evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, bayer_evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, bayer_evento_adverso.INDICACION3 as cmp_maior_30_28, bayer_evento_adverso.FORMULACION3 as cmp_maior_30_29, bayer_evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, bayer_evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, bayer_evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, bayer_evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, bayer_evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, bayer_evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, bayer_evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, bayer_evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, bayer_evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, bayer_evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, bayer_evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, bayer_evento_adverso.DESENLACE1 as cmp_maior_30_41, bayer_evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, bayer_evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, bayer_evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, bayer_evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, bayer_evento_adverso.DETALLES_EA1 as cmp_maior_30_53, bayer_evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, bayer_evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, bayer_evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, bayer_evento_adverso.DESENLACE2 as cmp_maior_30_57, bayer_evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, bayer_evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, bayer_evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, bayer_evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, bayer_evento_adverso.DETALLES_EA2 as cmp_maior_30_69, bayer_evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, bayer_evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, bayer_evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, bayer_evento_adverso.DESENLACE3 as cmp_maior_30_73, bayer_evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, bayer_evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, bayer_evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, bayer_evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, bayer_evento_adverso.DETALLES_EA3 as cmp_maior_30_85, bayer_evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, bayer_evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, bayer_evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, bayer_evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, bayer_evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, bayer_evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, bayer_evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, bayer_evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, bayer_evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, bayer_evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, bayer_evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, bayer_evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, bayer_evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, bayer_evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, bayer_evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, bayer_evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT bayer_evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, bayer_evento_adverso.PAIS as bayer_evento_adverso_pais, bayer_evento_adverso.TIPO_REPORTE as cmp_maior_30_2, bayer_evento_adverso.FECHA_STAFF as cmp_maior_30_3, bayer_evento_adverso.PRODUCTO as bayer_evento_adverso_producto, bayer_evento_adverso.CIUDAD as bayer_evento_adverso_ciudad, bayer_evento_adverso.GENERO as bayer_evento_adverso_genero, bayer_evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, bayer_evento_adverso.EMBARAZO as bayer_evento_adverso_embarazo, bayer_evento_adverso.FECHA_PARTO as cmp_maior_30_5, bayer_evento_adverso.DESENLACE as bayer_evento_adverso_desenlace, bayer_evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, bayer_evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, bayer_evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, bayer_evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, bayer_evento_adverso.FAX_MEDICO as cmp_maior_30_10, bayer_evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, bayer_evento_adverso.INDICACION1 as cmp_maior_30_12, bayer_evento_adverso.FORMULACION1 as cmp_maior_30_13, bayer_evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, bayer_evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, bayer_evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, bayer_evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, bayer_evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, bayer_evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, bayer_evento_adverso.INDICACION2 as cmp_maior_30_20, bayer_evento_adverso.FORMULACION2 as cmp_maior_30_21, bayer_evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, bayer_evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, bayer_evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, bayer_evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, bayer_evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, bayer_evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, bayer_evento_adverso.INDICACION3 as cmp_maior_30_28, bayer_evento_adverso.FORMULACION3 as cmp_maior_30_29, bayer_evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, bayer_evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, bayer_evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, bayer_evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, bayer_evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, bayer_evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, bayer_evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, bayer_evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, bayer_evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, bayer_evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, bayer_evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, bayer_evento_adverso.DESENLACE1 as cmp_maior_30_41, bayer_evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, bayer_evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, bayer_evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, bayer_evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, bayer_evento_adverso.DETALLES_EA1 as cmp_maior_30_53, bayer_evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, bayer_evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, bayer_evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, bayer_evento_adverso.DESENLACE2 as cmp_maior_30_57, bayer_evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, bayer_evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, bayer_evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, bayer_evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, bayer_evento_adverso.DETALLES_EA2 as cmp_maior_30_69, bayer_evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, bayer_evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, bayer_evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, bayer_evento_adverso.DESENLACE3 as cmp_maior_30_73, bayer_evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, bayer_evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, bayer_evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, bayer_evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, bayer_evento_adverso.DETALLES_EA3 as cmp_maior_30_85, bayer_evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, bayer_evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, bayer_evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, bayer_evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, bayer_evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, bayer_evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, bayer_evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, bayer_evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, bayer_evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, bayer_evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, bayer_evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, bayer_evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, bayer_evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, bayer_evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, bayer_evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, bayer_evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT bayer_evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, bayer_evento_adverso.PAIS as bayer_evento_adverso_pais, bayer_evento_adverso.TIPO_REPORTE as cmp_maior_30_2, bayer_evento_adverso.FECHA_STAFF as cmp_maior_30_3, bayer_evento_adverso.PRODUCTO as bayer_evento_adverso_producto, bayer_evento_adverso.CIUDAD as bayer_evento_adverso_ciudad, bayer_evento_adverso.GENERO as bayer_evento_adverso_genero, bayer_evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, bayer_evento_adverso.EMBARAZO as bayer_evento_adverso_embarazo, bayer_evento_adverso.FECHA_PARTO as cmp_maior_30_5, bayer_evento_adverso.DESENLACE as bayer_evento_adverso_desenlace, bayer_evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, bayer_evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, bayer_evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, bayer_evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, bayer_evento_adverso.FAX_MEDICO as cmp_maior_30_10, bayer_evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, bayer_evento_adverso.INDICACION1 as cmp_maior_30_12, bayer_evento_adverso.FORMULACION1 as cmp_maior_30_13, bayer_evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, bayer_evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, bayer_evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, bayer_evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, bayer_evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, bayer_evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, bayer_evento_adverso.INDICACION2 as cmp_maior_30_20, bayer_evento_adverso.FORMULACION2 as cmp_maior_30_21, bayer_evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, bayer_evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, bayer_evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, bayer_evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, bayer_evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, bayer_evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, bayer_evento_adverso.INDICACION3 as cmp_maior_30_28, bayer_evento_adverso.FORMULACION3 as cmp_maior_30_29, bayer_evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, bayer_evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, bayer_evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, bayer_evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, bayer_evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, bayer_evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, bayer_evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, bayer_evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, bayer_evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, bayer_evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, bayer_evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, bayer_evento_adverso.DESENLACE1 as cmp_maior_30_41, bayer_evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, bayer_evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, bayer_evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, bayer_evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, bayer_evento_adverso.DETALLES_EA1 as cmp_maior_30_53, bayer_evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, bayer_evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, bayer_evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, bayer_evento_adverso.DESENLACE2 as cmp_maior_30_57, bayer_evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, bayer_evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, bayer_evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, bayer_evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, bayer_evento_adverso.DETALLES_EA2 as cmp_maior_30_69, bayer_evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, bayer_evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, bayer_evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, bayer_evento_adverso.DESENLACE3 as cmp_maior_30_73, bayer_evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, bayer_evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, bayer_evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, bayer_evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, bayer_evento_adverso.DETALLES_EA3 as cmp_maior_30_85, bayer_evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, bayer_evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, bayer_evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, bayer_evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, bayer_evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, bayer_evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, bayer_evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, bayer_evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, bayer_evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, bayer_evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, bayer_evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, bayer_evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, TO_DATE(TO_CHAR(bayer_evento_adverso.FECHA_EVENTO_ADVERSO, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss') as cmp_maior_30_98, bayer_evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, bayer_evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, bayer_evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT bayer_evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, bayer_evento_adverso.PAIS as bayer_evento_adverso_pais, bayer_evento_adverso.TIPO_REPORTE as cmp_maior_30_2, bayer_evento_adverso.FECHA_STAFF as cmp_maior_30_3, bayer_evento_adverso.PRODUCTO as bayer_evento_adverso_producto, bayer_evento_adverso.CIUDAD as bayer_evento_adverso_ciudad, bayer_evento_adverso.GENERO as bayer_evento_adverso_genero, bayer_evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, bayer_evento_adverso.EMBARAZO as bayer_evento_adverso_embarazo, bayer_evento_adverso.FECHA_PARTO as cmp_maior_30_5, bayer_evento_adverso.DESENLACE as bayer_evento_adverso_desenlace, bayer_evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, bayer_evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, bayer_evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, bayer_evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, bayer_evento_adverso.FAX_MEDICO as cmp_maior_30_10, bayer_evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, bayer_evento_adverso.INDICACION1 as cmp_maior_30_12, bayer_evento_adverso.FORMULACION1 as cmp_maior_30_13, bayer_evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, bayer_evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, bayer_evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, bayer_evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, bayer_evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, bayer_evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, bayer_evento_adverso.INDICACION2 as cmp_maior_30_20, bayer_evento_adverso.FORMULACION2 as cmp_maior_30_21, bayer_evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, bayer_evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, bayer_evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, bayer_evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, bayer_evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, bayer_evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, bayer_evento_adverso.INDICACION3 as cmp_maior_30_28, bayer_evento_adverso.FORMULACION3 as cmp_maior_30_29, bayer_evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, bayer_evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, bayer_evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, bayer_evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, bayer_evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, bayer_evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, bayer_evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, LOTOFILE(bayer_evento_adverso.INFORMACION_MUESTRA, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as cmp_maior_30_37, bayer_evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, bayer_evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, bayer_evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, bayer_evento_adverso.DESENLACE1 as cmp_maior_30_41, bayer_evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, bayer_evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, bayer_evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, bayer_evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, bayer_evento_adverso.DETALLES_EA1 as cmp_maior_30_53, bayer_evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, bayer_evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, bayer_evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, bayer_evento_adverso.DESENLACE2 as cmp_maior_30_57, bayer_evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, bayer_evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, bayer_evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, bayer_evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, bayer_evento_adverso.DETALLES_EA2 as cmp_maior_30_69, bayer_evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, bayer_evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, bayer_evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, bayer_evento_adverso.DESENLACE3 as cmp_maior_30_73, bayer_evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, bayer_evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, bayer_evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, bayer_evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, bayer_evento_adverso.DETALLES_EA3 as cmp_maior_30_85, LOTOFILE(bayer_evento_adverso.INFORMACION_ADICIONAL, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as cmp_maior_30_86, bayer_evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, bayer_evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, bayer_evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, bayer_evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, bayer_evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, bayer_evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, bayer_evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, bayer_evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, bayer_evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, bayer_evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, bayer_evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, bayer_evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, bayer_evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, bayer_evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, bayer_evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT bayer_evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, bayer_evento_adverso.PAIS as bayer_evento_adverso_pais, bayer_evento_adverso.TIPO_REPORTE as cmp_maior_30_2, bayer_evento_adverso.FECHA_STAFF as cmp_maior_30_3, bayer_evento_adverso.PRODUCTO as bayer_evento_adverso_producto, bayer_evento_adverso.CIUDAD as bayer_evento_adverso_ciudad, bayer_evento_adverso.GENERO as bayer_evento_adverso_genero, bayer_evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, bayer_evento_adverso.EMBARAZO as bayer_evento_adverso_embarazo, bayer_evento_adverso.FECHA_PARTO as cmp_maior_30_5, bayer_evento_adverso.DESENLACE as bayer_evento_adverso_desenlace, bayer_evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, bayer_evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, bayer_evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, bayer_evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, bayer_evento_adverso.FAX_MEDICO as cmp_maior_30_10, bayer_evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, bayer_evento_adverso.INDICACION1 as cmp_maior_30_12, bayer_evento_adverso.FORMULACION1 as cmp_maior_30_13, bayer_evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, bayer_evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, bayer_evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, bayer_evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, bayer_evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, bayer_evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, bayer_evento_adverso.INDICACION2 as cmp_maior_30_20, bayer_evento_adverso.FORMULACION2 as cmp_maior_30_21, bayer_evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, bayer_evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, bayer_evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, bayer_evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, bayer_evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, bayer_evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, bayer_evento_adverso.INDICACION3 as cmp_maior_30_28, bayer_evento_adverso.FORMULACION3 as cmp_maior_30_29, bayer_evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, bayer_evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, bayer_evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, bayer_evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, bayer_evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, bayer_evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, bayer_evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, bayer_evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, bayer_evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, bayer_evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, bayer_evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, bayer_evento_adverso.DESENLACE1 as cmp_maior_30_41, bayer_evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, bayer_evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, bayer_evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, bayer_evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, bayer_evento_adverso.DETALLES_EA1 as cmp_maior_30_53, bayer_evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, bayer_evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, bayer_evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, bayer_evento_adverso.DESENLACE2 as cmp_maior_30_57, bayer_evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, bayer_evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, bayer_evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, bayer_evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, bayer_evento_adverso.DETALLES_EA2 as cmp_maior_30_69, bayer_evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, bayer_evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, bayer_evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, bayer_evento_adverso.DESENLACE3 as cmp_maior_30_73, bayer_evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, bayer_evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, bayer_evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, bayer_evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, bayer_evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, bayer_evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, bayer_evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, bayer_evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, bayer_evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, bayer_evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, bayer_evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, bayer_evento_adverso.DETALLES_EA3 as cmp_maior_30_85, bayer_evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, bayer_evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, bayer_evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, bayer_evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, bayer_evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, bayer_evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, bayer_evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, bayer_evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, bayer_evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, bayer_evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, bayer_evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, bayer_evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, bayer_evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, bayer_evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, bayer_evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, bayer_evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      $xml_charset = $_SESSION['scriptcase']['charset'];
      $xml_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo, "w");
      fwrite($xml_f, "<?xml version=\"1.0\" encoding=\"$xml_charset\" ?>\r\n");
      fwrite($xml_f, "<root>\r\n");
      if ($this->Grava_view)
      {
          $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
          $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo_view, "w");
          fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
          fwrite($xml_v, "<root>\r\n");
      }
      while (!$rs->EOF)
      {
         $this->xml_registro = "<BAYER_EA";
         $this->bayer_evento_adverso_id_evento_adverso = $rs->fields[0] ;  
         $this->bayer_evento_adverso_id_evento_adverso = (string)$this->bayer_evento_adverso_id_evento_adverso;
         $this->bayer_evento_adverso_pais = $rs->fields[1] ;  
         $this->bayer_evento_adverso_tipo_reporte = $rs->fields[2] ;  
         $this->bayer_evento_adverso_fecha_staff = $rs->fields[3] ;  
         $this->bayer_evento_adverso_producto = $rs->fields[4] ;  
         $this->bayer_evento_adverso_ciudad = $rs->fields[5] ;  
         $this->bayer_evento_adverso_genero = $rs->fields[6] ;  
         $this->bayer_evento_adverso_fecha_nacimiento = $rs->fields[7] ;  
         $this->bayer_evento_adverso_embarazo = $rs->fields[8] ;  
         $this->bayer_evento_adverso_fecha_parto = $rs->fields[9] ;  
         $this->bayer_evento_adverso_desenlace = $rs->fields[10] ;  
         $this->bayer_evento_adverso_cuales_desenlaces = $rs->fields[11] ;  
         $this->bayer_evento_adverso_contacto_directo = $rs->fields[12] ;  
         $this->bayer_evento_adverso_nombre_medico = $rs->fields[13] ;  
         $this->bayer_evento_adverso_telefono_medico = $rs->fields[14] ;  
         $this->bayer_evento_adverso_fax_medico = $rs->fields[15] ;  
         $this->bayer_evento_adverso_email_medico = $rs->fields[16] ;  
         $this->bayer_evento_adverso_indicacion1 = $rs->fields[17] ;  
         $this->bayer_evento_adverso_formulacion1 = $rs->fields[18] ;  
         $this->bayer_evento_adverso_regimen_dosis1 = $rs->fields[19] ;  
         $this->bayer_evento_adverso_ruta_administracion1 = $rs->fields[20] ;  
         $this->bayer_evento_adverso_numero_lote1 = $rs->fields[21] ;  
         $this->bayer_evento_adverso_fecha_expiracion1 = $rs->fields[22] ;  
         $this->bayer_evento_adverso_fecha_inicio1 = $rs->fields[23] ;  
         $this->bayer_evento_adverso_tratamiento_continua1 = $rs->fields[24] ;  
         $this->bayer_evento_adverso_indicacion2 = $rs->fields[25] ;  
         $this->bayer_evento_adverso_formulacion2 = $rs->fields[26] ;  
         $this->bayer_evento_adverso_regimen_dosis2 = $rs->fields[27] ;  
         $this->bayer_evento_adverso_ruta_administracion2 = $rs->fields[28] ;  
         $this->bayer_evento_adverso_numero_lote2 = $rs->fields[29] ;  
         $this->bayer_evento_adverso_fecha_expiracion2 = $rs->fields[30] ;  
         $this->bayer_evento_adverso_fecha_inicio2 = $rs->fields[31] ;  
         $this->bayer_evento_adverso_tratamiento_continua2 = $rs->fields[32] ;  
         $this->bayer_evento_adverso_indicacion3 = $rs->fields[33] ;  
         $this->bayer_evento_adverso_formulacion3 = $rs->fields[34] ;  
         $this->bayer_evento_adverso_regimen_dosis3 = $rs->fields[35] ;  
         $this->bayer_evento_adverso_ruta_administracion3 = $rs->fields[36] ;  
         $this->bayer_evento_adverso_numero_lote3 = $rs->fields[37] ;  
         $this->bayer_evento_adverso_fecha_expiracion3 = $rs->fields[38] ;  
         $this->bayer_evento_adverso_fecha_inicio3 = $rs->fields[39] ;  
         $this->bayer_evento_adverso_tratamiento_continua3 = $rs->fields[40] ;  
         $this->bayer_evento_adverso_muestra_disponible = $rs->fields[41] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->bayer_evento_adverso_informacion_muestra = "";  
              if (is_file($rs_grid->fields[42])) 
              { 
                  $this->bayer_evento_adverso_informacion_muestra = file_get_contents($rs_grid->fields[42]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->bayer_evento_adverso_informacion_muestra = $this->Db->BlobDecode($rs->fields[42]) ;  
         } 
         else
         { 
             $this->bayer_evento_adverso_informacion_muestra = $rs->fields[42] ;  
         } 
         $this->bayer_evento_adverso_relacion_medicamento1 = $rs->fields[43] ;  
         $this->bayer_evento_adverso_relacionado_dispositivo1 = $rs->fields[44] ;  
         $this->bayer_evento_adverso_fecha_inicio_evento1 = $rs->fields[45] ;  
         $this->bayer_evento_adverso_desenlace1 = $rs->fields[46] ;  
         $this->bayer_evento_adverso_fecha_recuperacion1 = $rs->fields[47] ;  
         $this->bayer_evento_adverso_fecha_muerte1 = $rs->fields[48] ;  
         $this->bayer_evento_adverso_criterio_seriedad1 = $rs->fields[49] ;  
         $this->bayer_evento_adverso_criterio_seriedad_muerte1 = $rs->fields[50] ;  
         $this->bayer_evento_adverso_criterio_seriedad_hospitalizacion1 = $rs->fields[51] ;  
         $this->bayer_evento_adverso_criterio_seriedad_amenaza1 = $rs->fields[52] ;  
         $this->bayer_evento_adverso_criterio_seriedad_incapacidad1 = $rs->fields[53] ;  
         $this->bayer_evento_adverso_criterio_seriedad_anormalidad1 = $rs->fields[54] ;  
         $this->bayer_evento_adverso_criterio_seriedad_evento1 = $rs->fields[55] ;  
         $this->bayer_evento_adverso_criterio_seriedad_quirurgica1 = $rs->fields[56] ;  
         $this->bayer_evento_adverso_causa_muerte1 = $rs->fields[57] ;  
         $this->bayer_evento_adverso_detalles_ea1 = $rs->fields[58] ;  
         $this->bayer_evento_adverso_relacion_medicamento2 = $rs->fields[59] ;  
         $this->bayer_evento_adverso_relacionado_dispositivo2 = $rs->fields[60] ;  
         $this->bayer_evento_adverso_fecha_inicio_evento2 = $rs->fields[61] ;  
         $this->bayer_evento_adverso_desenlace2 = $rs->fields[62] ;  
         $this->bayer_evento_adverso_fecha_recuperacion2 = $rs->fields[63] ;  
         $this->bayer_evento_adverso_fecha_muerte2 = $rs->fields[64] ;  
         $this->bayer_evento_adverso_criterio_seriedad2 = $rs->fields[65] ;  
         $this->bayer_evento_adverso_criterio_seriedad_muerte2 = $rs->fields[66] ;  
         $this->bayer_evento_adverso_criterio_seriedad_hospitalizacion2 = $rs->fields[67] ;  
         $this->bayer_evento_adverso_criterio_seriedad_amenaza2 = $rs->fields[68] ;  
         $this->bayer_evento_adverso_criterio_seriedad_incapacidad2 = $rs->fields[69] ;  
         $this->bayer_evento_adverso_criterio_seriedad_anormalidad2 = $rs->fields[70] ;  
         $this->bayer_evento_adverso_criterio_seriedad_evento2 = $rs->fields[71] ;  
         $this->bayer_evento_adverso_criterio_seriedad_quirurgica2 = $rs->fields[72] ;  
         $this->bayer_evento_adverso_causa_muerte2 = $rs->fields[73] ;  
         $this->bayer_evento_adverso_detalles_ea2 = $rs->fields[74] ;  
         $this->bayer_evento_adverso_relacion_medicamento3 = $rs->fields[75] ;  
         $this->bayer_evento_adverso_relacionado_dispositivo3 = $rs->fields[76] ;  
         $this->bayer_evento_adverso_fecha_inicio_evento3 = $rs->fields[77] ;  
         $this->bayer_evento_adverso_desenlace3 = $rs->fields[78] ;  
         $this->bayer_evento_adverso_fecha_recuperacion3 = $rs->fields[79] ;  
         $this->bayer_evento_adverso_fecha_muerte3 = $rs->fields[80] ;  
         $this->bayer_evento_adverso_criterio_seriedad3 = $rs->fields[81] ;  
         $this->bayer_evento_adverso_criterio_seriedad_muerte3 = $rs->fields[82] ;  
         $this->bayer_evento_adverso_criterio_seriedad_hospitalizacion3 = $rs->fields[83] ;  
         $this->bayer_evento_adverso_criterio_seriedad_amenaza3 = $rs->fields[84] ;  
         $this->bayer_evento_adverso_criterio_seriedad_incapacidad3 = $rs->fields[85] ;  
         $this->bayer_evento_adverso_criterio_seriedad_anormalidad3 = $rs->fields[86] ;  
         $this->bayer_evento_adverso_criterio_seriedad_evento3 = $rs->fields[87] ;  
         $this->bayer_evento_adverso_criterio_seriedad_quirurgica3 = $rs->fields[88] ;  
         $this->bayer_evento_adverso_causa_muerte3 = $rs->fields[89] ;  
         $this->bayer_evento_adverso_detalles_ea3 = $rs->fields[90] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->bayer_evento_adverso_informacion_adicional = "";  
              if (is_file($rs_grid->fields[91])) 
              { 
                  $this->bayer_evento_adverso_informacion_adicional = file_get_contents($rs_grid->fields[91]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->bayer_evento_adverso_informacion_adicional = $this->Db->BlobDecode($rs->fields[91]) ;  
         } 
         else
         { 
             $this->bayer_evento_adverso_informacion_adicional = $rs->fields[91] ;  
         } 
         $this->bayer_evento_adverso_nombre_reporte = $rs->fields[92] ;  
         $this->bayer_evento_adverso_id_paciente_fk = $rs->fields[93] ;  
         $this->bayer_evento_adverso_id_paciente_fk = (string)$this->bayer_evento_adverso_id_paciente_fk;
         $this->bayer_evento_adverso_medicamento1 = $rs->fields[94] ;  
         $this->bayer_evento_adverso_medicamento2 = $rs->fields[95] ;  
         $this->bayer_evento_adverso_medicamento3 = $rs->fields[96] ;  
         $this->bayer_evento_adverso_informacion_ea1 = $rs->fields[97] ;  
         $this->bayer_evento_adverso_informacion_ea2 = $rs->fields[98] ;  
         $this->bayer_evento_adverso_informacion_ea3 = $rs->fields[99] ;  
         $this->bayer_evento_adverso_fecha_suspencion1 = $rs->fields[100] ;  
         $this->bayer_evento_adverso_fecha_suspencion2 = $rs->fields[101] ;  
         $this->bayer_evento_adverso_fecha_suspencion3 = $rs->fields[102] ;  
         $this->bayer_evento_adverso_fecha_evento_adverso = $rs->fields[103] ;  
         $this->bayer_evento_adverso_nombre_reportante_primario = $rs->fields[104] ;  
         $this->bayer_evento_adverso_telefono_reportante_primario = $rs->fields[105] ;  
         $this->bayer_evento_adverso_tipo_reportante = $rs->fields[106] ;  
         $this->bayer_evento_adverso_informacion_muestra = "";
         $this->bayer_evento_adverso_informacion_adicional = "";
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->xml_registro .= " />\r\n";
         fwrite($xml_f, $this->xml_registro);
         if ($this->Grava_view)
         {
            fwrite($xml_v, $this->xml_registro);
         }
         $rs->MoveNext();
      }
      fwrite($xml_f, "</root>");
      fclose($xml_f);
      if ($this->Grava_view)
      {
         fwrite($xml_v, "</root>");
         fclose($xml_v);
      }

      $rs->Close();
   }
   //----- bayer_evento_adverso_id_evento_adverso
   function NM_export_bayer_evento_adverso_id_evento_adverso()
   {
         nmgp_Form_Num_Val($this->bayer_evento_adverso_id_evento_adverso, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_id_evento_adverso))
         {
             $this->bayer_evento_adverso_id_evento_adverso = sc_convert_encoding($this->bayer_evento_adverso_id_evento_adverso, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_id_evento_adverso =\"" . $this->trata_dados($this->bayer_evento_adverso_id_evento_adverso) . "\"";
   }
   //----- bayer_evento_adverso_pais
   function NM_export_bayer_evento_adverso_pais()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_pais))
         {
             $this->bayer_evento_adverso_pais = sc_convert_encoding($this->bayer_evento_adverso_pais, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_pais =\"" . $this->trata_dados($this->bayer_evento_adverso_pais) . "\"";
   }
   //----- bayer_evento_adverso_tipo_reporte
   function NM_export_bayer_evento_adverso_tipo_reporte()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_tipo_reporte))
         {
             $this->bayer_evento_adverso_tipo_reporte = sc_convert_encoding($this->bayer_evento_adverso_tipo_reporte, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_tipo_reporte =\"" . $this->trata_dados($this->bayer_evento_adverso_tipo_reporte) . "\"";
   }
   //----- bayer_evento_adverso_fecha_staff
   function NM_export_bayer_evento_adverso_fecha_staff()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_staff))
         {
             $this->bayer_evento_adverso_fecha_staff = sc_convert_encoding($this->bayer_evento_adverso_fecha_staff, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_staff =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_staff) . "\"";
   }
   //----- bayer_evento_adverso_producto
   function NM_export_bayer_evento_adverso_producto()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_producto))
         {
             $this->bayer_evento_adverso_producto = sc_convert_encoding($this->bayer_evento_adverso_producto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_producto =\"" . $this->trata_dados($this->bayer_evento_adverso_producto) . "\"";
   }
   //----- bayer_evento_adverso_ciudad
   function NM_export_bayer_evento_adverso_ciudad()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_ciudad))
         {
             $this->bayer_evento_adverso_ciudad = sc_convert_encoding($this->bayer_evento_adverso_ciudad, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_ciudad =\"" . $this->trata_dados($this->bayer_evento_adverso_ciudad) . "\"";
   }
   //----- bayer_evento_adverso_genero
   function NM_export_bayer_evento_adverso_genero()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_genero))
         {
             $this->bayer_evento_adverso_genero = sc_convert_encoding($this->bayer_evento_adverso_genero, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_genero =\"" . $this->trata_dados($this->bayer_evento_adverso_genero) . "\"";
   }
   //----- bayer_evento_adverso_fecha_nacimiento
   function NM_export_bayer_evento_adverso_fecha_nacimiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_nacimiento))
         {
             $this->bayer_evento_adverso_fecha_nacimiento = sc_convert_encoding($this->bayer_evento_adverso_fecha_nacimiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_nacimiento =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_nacimiento) . "\"";
   }
   //----- bayer_evento_adverso_embarazo
   function NM_export_bayer_evento_adverso_embarazo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_embarazo))
         {
             $this->bayer_evento_adverso_embarazo = sc_convert_encoding($this->bayer_evento_adverso_embarazo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_embarazo =\"" . $this->trata_dados($this->bayer_evento_adverso_embarazo) . "\"";
   }
   //----- bayer_evento_adverso_fecha_parto
   function NM_export_bayer_evento_adverso_fecha_parto()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_parto))
         {
             $this->bayer_evento_adverso_fecha_parto = sc_convert_encoding($this->bayer_evento_adverso_fecha_parto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_parto =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_parto) . "\"";
   }
   //----- bayer_evento_adverso_desenlace
   function NM_export_bayer_evento_adverso_desenlace()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_desenlace))
         {
             $this->bayer_evento_adverso_desenlace = sc_convert_encoding($this->bayer_evento_adverso_desenlace, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_desenlace =\"" . $this->trata_dados($this->bayer_evento_adverso_desenlace) . "\"";
   }
   //----- bayer_evento_adverso_cuales_desenlaces
   function NM_export_bayer_evento_adverso_cuales_desenlaces()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_cuales_desenlaces))
         {
             $this->bayer_evento_adverso_cuales_desenlaces = sc_convert_encoding($this->bayer_evento_adverso_cuales_desenlaces, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_cuales_desenlaces =\"" . $this->trata_dados($this->bayer_evento_adverso_cuales_desenlaces) . "\"";
   }
   //----- bayer_evento_adverso_contacto_directo
   function NM_export_bayer_evento_adverso_contacto_directo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_contacto_directo))
         {
             $this->bayer_evento_adverso_contacto_directo = sc_convert_encoding($this->bayer_evento_adverso_contacto_directo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_contacto_directo =\"" . $this->trata_dados($this->bayer_evento_adverso_contacto_directo) . "\"";
   }
   //----- bayer_evento_adverso_nombre_medico
   function NM_export_bayer_evento_adverso_nombre_medico()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_nombre_medico))
         {
             $this->bayer_evento_adverso_nombre_medico = sc_convert_encoding($this->bayer_evento_adverso_nombre_medico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_nombre_medico =\"" . $this->trata_dados($this->bayer_evento_adverso_nombre_medico) . "\"";
   }
   //----- bayer_evento_adverso_telefono_medico
   function NM_export_bayer_evento_adverso_telefono_medico()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_telefono_medico))
         {
             $this->bayer_evento_adverso_telefono_medico = sc_convert_encoding($this->bayer_evento_adverso_telefono_medico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_telefono_medico =\"" . $this->trata_dados($this->bayer_evento_adverso_telefono_medico) . "\"";
   }
   //----- bayer_evento_adverso_fax_medico
   function NM_export_bayer_evento_adverso_fax_medico()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fax_medico))
         {
             $this->bayer_evento_adverso_fax_medico = sc_convert_encoding($this->bayer_evento_adverso_fax_medico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fax_medico =\"" . $this->trata_dados($this->bayer_evento_adverso_fax_medico) . "\"";
   }
   //----- bayer_evento_adverso_email_medico
   function NM_export_bayer_evento_adverso_email_medico()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_email_medico))
         {
             $this->bayer_evento_adverso_email_medico = sc_convert_encoding($this->bayer_evento_adverso_email_medico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_email_medico =\"" . $this->trata_dados($this->bayer_evento_adverso_email_medico) . "\"";
   }
   //----- bayer_evento_adverso_indicacion1
   function NM_export_bayer_evento_adverso_indicacion1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_indicacion1))
         {
             $this->bayer_evento_adverso_indicacion1 = sc_convert_encoding($this->bayer_evento_adverso_indicacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_indicacion1 =\"" . $this->trata_dados($this->bayer_evento_adverso_indicacion1) . "\"";
   }
   //----- bayer_evento_adverso_formulacion1
   function NM_export_bayer_evento_adverso_formulacion1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_formulacion1))
         {
             $this->bayer_evento_adverso_formulacion1 = sc_convert_encoding($this->bayer_evento_adverso_formulacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_formulacion1 =\"" . $this->trata_dados($this->bayer_evento_adverso_formulacion1) . "\"";
   }
   //----- bayer_evento_adverso_regimen_dosis1
   function NM_export_bayer_evento_adverso_regimen_dosis1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_regimen_dosis1))
         {
             $this->bayer_evento_adverso_regimen_dosis1 = sc_convert_encoding($this->bayer_evento_adverso_regimen_dosis1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_regimen_dosis1 =\"" . $this->trata_dados($this->bayer_evento_adverso_regimen_dosis1) . "\"";
   }
   //----- bayer_evento_adverso_ruta_administracion1
   function NM_export_bayer_evento_adverso_ruta_administracion1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_ruta_administracion1))
         {
             $this->bayer_evento_adverso_ruta_administracion1 = sc_convert_encoding($this->bayer_evento_adverso_ruta_administracion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_ruta_administracion1 =\"" . $this->trata_dados($this->bayer_evento_adverso_ruta_administracion1) . "\"";
   }
   //----- bayer_evento_adverso_numero_lote1
   function NM_export_bayer_evento_adverso_numero_lote1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_numero_lote1))
         {
             $this->bayer_evento_adverso_numero_lote1 = sc_convert_encoding($this->bayer_evento_adverso_numero_lote1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_numero_lote1 =\"" . $this->trata_dados($this->bayer_evento_adverso_numero_lote1) . "\"";
   }
   //----- bayer_evento_adverso_fecha_expiracion1
   function NM_export_bayer_evento_adverso_fecha_expiracion1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_expiracion1))
         {
             $this->bayer_evento_adverso_fecha_expiracion1 = sc_convert_encoding($this->bayer_evento_adverso_fecha_expiracion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_expiracion1 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_expiracion1) . "\"";
   }
   //----- bayer_evento_adverso_fecha_inicio1
   function NM_export_bayer_evento_adverso_fecha_inicio1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_inicio1))
         {
             $this->bayer_evento_adverso_fecha_inicio1 = sc_convert_encoding($this->bayer_evento_adverso_fecha_inicio1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_inicio1 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_inicio1) . "\"";
   }
   //----- bayer_evento_adverso_tratamiento_continua1
   function NM_export_bayer_evento_adverso_tratamiento_continua1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_tratamiento_continua1))
         {
             $this->bayer_evento_adverso_tratamiento_continua1 = sc_convert_encoding($this->bayer_evento_adverso_tratamiento_continua1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_tratamiento_continua1 =\"" . $this->trata_dados($this->bayer_evento_adverso_tratamiento_continua1) . "\"";
   }
   //----- bayer_evento_adverso_indicacion2
   function NM_export_bayer_evento_adverso_indicacion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_indicacion2))
         {
             $this->bayer_evento_adverso_indicacion2 = sc_convert_encoding($this->bayer_evento_adverso_indicacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_indicacion2 =\"" . $this->trata_dados($this->bayer_evento_adverso_indicacion2) . "\"";
   }
   //----- bayer_evento_adverso_formulacion2
   function NM_export_bayer_evento_adverso_formulacion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_formulacion2))
         {
             $this->bayer_evento_adverso_formulacion2 = sc_convert_encoding($this->bayer_evento_adverso_formulacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_formulacion2 =\"" . $this->trata_dados($this->bayer_evento_adverso_formulacion2) . "\"";
   }
   //----- bayer_evento_adverso_regimen_dosis2
   function NM_export_bayer_evento_adverso_regimen_dosis2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_regimen_dosis2))
         {
             $this->bayer_evento_adverso_regimen_dosis2 = sc_convert_encoding($this->bayer_evento_adverso_regimen_dosis2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_regimen_dosis2 =\"" . $this->trata_dados($this->bayer_evento_adverso_regimen_dosis2) . "\"";
   }
   //----- bayer_evento_adverso_ruta_administracion2
   function NM_export_bayer_evento_adverso_ruta_administracion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_ruta_administracion2))
         {
             $this->bayer_evento_adverso_ruta_administracion2 = sc_convert_encoding($this->bayer_evento_adverso_ruta_administracion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_ruta_administracion2 =\"" . $this->trata_dados($this->bayer_evento_adverso_ruta_administracion2) . "\"";
   }
   //----- bayer_evento_adverso_numero_lote2
   function NM_export_bayer_evento_adverso_numero_lote2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_numero_lote2))
         {
             $this->bayer_evento_adverso_numero_lote2 = sc_convert_encoding($this->bayer_evento_adverso_numero_lote2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_numero_lote2 =\"" . $this->trata_dados($this->bayer_evento_adverso_numero_lote2) . "\"";
   }
   //----- bayer_evento_adverso_fecha_expiracion2
   function NM_export_bayer_evento_adverso_fecha_expiracion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_expiracion2))
         {
             $this->bayer_evento_adverso_fecha_expiracion2 = sc_convert_encoding($this->bayer_evento_adverso_fecha_expiracion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_expiracion2 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_expiracion2) . "\"";
   }
   //----- bayer_evento_adverso_fecha_inicio2
   function NM_export_bayer_evento_adverso_fecha_inicio2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_inicio2))
         {
             $this->bayer_evento_adverso_fecha_inicio2 = sc_convert_encoding($this->bayer_evento_adverso_fecha_inicio2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_inicio2 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_inicio2) . "\"";
   }
   //----- bayer_evento_adverso_tratamiento_continua2
   function NM_export_bayer_evento_adverso_tratamiento_continua2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_tratamiento_continua2))
         {
             $this->bayer_evento_adverso_tratamiento_continua2 = sc_convert_encoding($this->bayer_evento_adverso_tratamiento_continua2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_tratamiento_continua2 =\"" . $this->trata_dados($this->bayer_evento_adverso_tratamiento_continua2) . "\"";
   }
   //----- bayer_evento_adverso_indicacion3
   function NM_export_bayer_evento_adverso_indicacion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_indicacion3))
         {
             $this->bayer_evento_adverso_indicacion3 = sc_convert_encoding($this->bayer_evento_adverso_indicacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_indicacion3 =\"" . $this->trata_dados($this->bayer_evento_adverso_indicacion3) . "\"";
   }
   //----- bayer_evento_adverso_formulacion3
   function NM_export_bayer_evento_adverso_formulacion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_formulacion3))
         {
             $this->bayer_evento_adverso_formulacion3 = sc_convert_encoding($this->bayer_evento_adverso_formulacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_formulacion3 =\"" . $this->trata_dados($this->bayer_evento_adverso_formulacion3) . "\"";
   }
   //----- bayer_evento_adverso_regimen_dosis3
   function NM_export_bayer_evento_adverso_regimen_dosis3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_regimen_dosis3))
         {
             $this->bayer_evento_adverso_regimen_dosis3 = sc_convert_encoding($this->bayer_evento_adverso_regimen_dosis3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_regimen_dosis3 =\"" . $this->trata_dados($this->bayer_evento_adverso_regimen_dosis3) . "\"";
   }
   //----- bayer_evento_adverso_ruta_administracion3
   function NM_export_bayer_evento_adverso_ruta_administracion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_ruta_administracion3))
         {
             $this->bayer_evento_adverso_ruta_administracion3 = sc_convert_encoding($this->bayer_evento_adverso_ruta_administracion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_ruta_administracion3 =\"" . $this->trata_dados($this->bayer_evento_adverso_ruta_administracion3) . "\"";
   }
   //----- bayer_evento_adverso_numero_lote3
   function NM_export_bayer_evento_adverso_numero_lote3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_numero_lote3))
         {
             $this->bayer_evento_adverso_numero_lote3 = sc_convert_encoding($this->bayer_evento_adverso_numero_lote3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_numero_lote3 =\"" . $this->trata_dados($this->bayer_evento_adverso_numero_lote3) . "\"";
   }
   //----- bayer_evento_adverso_fecha_expiracion3
   function NM_export_bayer_evento_adverso_fecha_expiracion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_expiracion3))
         {
             $this->bayer_evento_adverso_fecha_expiracion3 = sc_convert_encoding($this->bayer_evento_adverso_fecha_expiracion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_expiracion3 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_expiracion3) . "\"";
   }
   //----- bayer_evento_adverso_fecha_inicio3
   function NM_export_bayer_evento_adverso_fecha_inicio3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_inicio3))
         {
             $this->bayer_evento_adverso_fecha_inicio3 = sc_convert_encoding($this->bayer_evento_adverso_fecha_inicio3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_inicio3 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_inicio3) . "\"";
   }
   //----- bayer_evento_adverso_tratamiento_continua3
   function NM_export_bayer_evento_adverso_tratamiento_continua3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_tratamiento_continua3))
         {
             $this->bayer_evento_adverso_tratamiento_continua3 = sc_convert_encoding($this->bayer_evento_adverso_tratamiento_continua3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_tratamiento_continua3 =\"" . $this->trata_dados($this->bayer_evento_adverso_tratamiento_continua3) . "\"";
   }
   //----- bayer_evento_adverso_muestra_disponible
   function NM_export_bayer_evento_adverso_muestra_disponible()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_muestra_disponible))
         {
             $this->bayer_evento_adverso_muestra_disponible = sc_convert_encoding($this->bayer_evento_adverso_muestra_disponible, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_muestra_disponible =\"" . $this->trata_dados($this->bayer_evento_adverso_muestra_disponible) . "\"";
   }
   //----- bayer_evento_adverso_informacion_muestra
   function NM_export_bayer_evento_adverso_informacion_muestra()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_informacion_muestra))
         {
             $this->bayer_evento_adverso_informacion_muestra = sc_convert_encoding($this->bayer_evento_adverso_informacion_muestra, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_informacion_muestra =\"" . $this->trata_dados($this->bayer_evento_adverso_informacion_muestra) . "\"";
   }
   //----- bayer_evento_adverso_relacion_medicamento1
   function NM_export_bayer_evento_adverso_relacion_medicamento1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_relacion_medicamento1))
         {
             $this->bayer_evento_adverso_relacion_medicamento1 = sc_convert_encoding($this->bayer_evento_adverso_relacion_medicamento1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_relacion_medicamento1 =\"" . $this->trata_dados($this->bayer_evento_adverso_relacion_medicamento1) . "\"";
   }
   //----- bayer_evento_adverso_relacionado_dispositivo1
   function NM_export_bayer_evento_adverso_relacionado_dispositivo1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_relacionado_dispositivo1))
         {
             $this->bayer_evento_adverso_relacionado_dispositivo1 = sc_convert_encoding($this->bayer_evento_adverso_relacionado_dispositivo1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_relacionado_dispositivo1 =\"" . $this->trata_dados($this->bayer_evento_adverso_relacionado_dispositivo1) . "\"";
   }
   //----- bayer_evento_adverso_fecha_inicio_evento1
   function NM_export_bayer_evento_adverso_fecha_inicio_evento1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_inicio_evento1))
         {
             $this->bayer_evento_adverso_fecha_inicio_evento1 = sc_convert_encoding($this->bayer_evento_adverso_fecha_inicio_evento1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_inicio_evento1 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_inicio_evento1) . "\"";
   }
   //----- bayer_evento_adverso_desenlace1
   function NM_export_bayer_evento_adverso_desenlace1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_desenlace1))
         {
             $this->bayer_evento_adverso_desenlace1 = sc_convert_encoding($this->bayer_evento_adverso_desenlace1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_desenlace1 =\"" . $this->trata_dados($this->bayer_evento_adverso_desenlace1) . "\"";
   }
   //----- bayer_evento_adverso_fecha_recuperacion1
   function NM_export_bayer_evento_adverso_fecha_recuperacion1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_recuperacion1))
         {
             $this->bayer_evento_adverso_fecha_recuperacion1 = sc_convert_encoding($this->bayer_evento_adverso_fecha_recuperacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_recuperacion1 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_recuperacion1) . "\"";
   }
   //----- bayer_evento_adverso_fecha_muerte1
   function NM_export_bayer_evento_adverso_fecha_muerte1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_muerte1))
         {
             $this->bayer_evento_adverso_fecha_muerte1 = sc_convert_encoding($this->bayer_evento_adverso_fecha_muerte1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_muerte1 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_muerte1) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad1
   function NM_export_bayer_evento_adverso_criterio_seriedad1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad1))
         {
             $this->bayer_evento_adverso_criterio_seriedad1 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad1 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad1) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_muerte1
   function NM_export_bayer_evento_adverso_criterio_seriedad_muerte1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_muerte1))
         {
             $this->bayer_evento_adverso_criterio_seriedad_muerte1 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_muerte1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_muerte1 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_muerte1) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_hospitalizacion1
   function NM_export_bayer_evento_adverso_criterio_seriedad_hospitalizacion1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_hospitalizacion1))
         {
             $this->bayer_evento_adverso_criterio_seriedad_hospitalizacion1 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_hospitalizacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_hospitalizacion1 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_hospitalizacion1) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_amenaza1
   function NM_export_bayer_evento_adverso_criterio_seriedad_amenaza1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_amenaza1))
         {
             $this->bayer_evento_adverso_criterio_seriedad_amenaza1 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_amenaza1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_amenaza1 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_amenaza1) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_incapacidad1
   function NM_export_bayer_evento_adverso_criterio_seriedad_incapacidad1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_incapacidad1))
         {
             $this->bayer_evento_adverso_criterio_seriedad_incapacidad1 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_incapacidad1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_incapacidad1 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_incapacidad1) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_anormalidad1
   function NM_export_bayer_evento_adverso_criterio_seriedad_anormalidad1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_anormalidad1))
         {
             $this->bayer_evento_adverso_criterio_seriedad_anormalidad1 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_anormalidad1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_anormalidad1 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_anormalidad1) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_evento1
   function NM_export_bayer_evento_adverso_criterio_seriedad_evento1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_evento1))
         {
             $this->bayer_evento_adverso_criterio_seriedad_evento1 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_evento1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_evento1 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_evento1) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_quirurgica1
   function NM_export_bayer_evento_adverso_criterio_seriedad_quirurgica1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_quirurgica1))
         {
             $this->bayer_evento_adverso_criterio_seriedad_quirurgica1 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_quirurgica1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_quirurgica1 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_quirurgica1) . "\"";
   }
   //----- bayer_evento_adverso_causa_muerte1
   function NM_export_bayer_evento_adverso_causa_muerte1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_causa_muerte1))
         {
             $this->bayer_evento_adverso_causa_muerte1 = sc_convert_encoding($this->bayer_evento_adverso_causa_muerte1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_causa_muerte1 =\"" . $this->trata_dados($this->bayer_evento_adverso_causa_muerte1) . "\"";
   }
   //----- bayer_evento_adverso_detalles_ea1
   function NM_export_bayer_evento_adverso_detalles_ea1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_detalles_ea1))
         {
             $this->bayer_evento_adverso_detalles_ea1 = sc_convert_encoding($this->bayer_evento_adverso_detalles_ea1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_detalles_ea1 =\"" . $this->trata_dados($this->bayer_evento_adverso_detalles_ea1) . "\"";
   }
   //----- bayer_evento_adverso_relacion_medicamento2
   function NM_export_bayer_evento_adverso_relacion_medicamento2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_relacion_medicamento2))
         {
             $this->bayer_evento_adverso_relacion_medicamento2 = sc_convert_encoding($this->bayer_evento_adverso_relacion_medicamento2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_relacion_medicamento2 =\"" . $this->trata_dados($this->bayer_evento_adverso_relacion_medicamento2) . "\"";
   }
   //----- bayer_evento_adverso_relacionado_dispositivo2
   function NM_export_bayer_evento_adverso_relacionado_dispositivo2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_relacionado_dispositivo2))
         {
             $this->bayer_evento_adverso_relacionado_dispositivo2 = sc_convert_encoding($this->bayer_evento_adverso_relacionado_dispositivo2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_relacionado_dispositivo2 =\"" . $this->trata_dados($this->bayer_evento_adverso_relacionado_dispositivo2) . "\"";
   }
   //----- bayer_evento_adverso_fecha_inicio_evento2
   function NM_export_bayer_evento_adverso_fecha_inicio_evento2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_inicio_evento2))
         {
             $this->bayer_evento_adverso_fecha_inicio_evento2 = sc_convert_encoding($this->bayer_evento_adverso_fecha_inicio_evento2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_inicio_evento2 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_inicio_evento2) . "\"";
   }
   //----- bayer_evento_adverso_desenlace2
   function NM_export_bayer_evento_adverso_desenlace2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_desenlace2))
         {
             $this->bayer_evento_adverso_desenlace2 = sc_convert_encoding($this->bayer_evento_adverso_desenlace2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_desenlace2 =\"" . $this->trata_dados($this->bayer_evento_adverso_desenlace2) . "\"";
   }
   //----- bayer_evento_adverso_fecha_recuperacion2
   function NM_export_bayer_evento_adverso_fecha_recuperacion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_recuperacion2))
         {
             $this->bayer_evento_adverso_fecha_recuperacion2 = sc_convert_encoding($this->bayer_evento_adverso_fecha_recuperacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_recuperacion2 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_recuperacion2) . "\"";
   }
   //----- bayer_evento_adverso_fecha_muerte2
   function NM_export_bayer_evento_adverso_fecha_muerte2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_muerte2))
         {
             $this->bayer_evento_adverso_fecha_muerte2 = sc_convert_encoding($this->bayer_evento_adverso_fecha_muerte2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_muerte2 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_muerte2) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad2
   function NM_export_bayer_evento_adverso_criterio_seriedad2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad2))
         {
             $this->bayer_evento_adverso_criterio_seriedad2 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad2 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad2) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_muerte2
   function NM_export_bayer_evento_adverso_criterio_seriedad_muerte2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_muerte2))
         {
             $this->bayer_evento_adverso_criterio_seriedad_muerte2 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_muerte2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_muerte2 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_muerte2) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_hospitalizacion2
   function NM_export_bayer_evento_adverso_criterio_seriedad_hospitalizacion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_hospitalizacion2))
         {
             $this->bayer_evento_adverso_criterio_seriedad_hospitalizacion2 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_hospitalizacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_hospitalizacion2 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_hospitalizacion2) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_amenaza2
   function NM_export_bayer_evento_adverso_criterio_seriedad_amenaza2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_amenaza2))
         {
             $this->bayer_evento_adverso_criterio_seriedad_amenaza2 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_amenaza2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_amenaza2 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_amenaza2) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_incapacidad2
   function NM_export_bayer_evento_adverso_criterio_seriedad_incapacidad2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_incapacidad2))
         {
             $this->bayer_evento_adverso_criterio_seriedad_incapacidad2 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_incapacidad2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_incapacidad2 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_incapacidad2) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_anormalidad2
   function NM_export_bayer_evento_adverso_criterio_seriedad_anormalidad2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_anormalidad2))
         {
             $this->bayer_evento_adverso_criterio_seriedad_anormalidad2 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_anormalidad2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_anormalidad2 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_anormalidad2) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_evento2
   function NM_export_bayer_evento_adverso_criterio_seriedad_evento2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_evento2))
         {
             $this->bayer_evento_adverso_criterio_seriedad_evento2 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_evento2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_evento2 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_evento2) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_quirurgica2
   function NM_export_bayer_evento_adverso_criterio_seriedad_quirurgica2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_quirurgica2))
         {
             $this->bayer_evento_adverso_criterio_seriedad_quirurgica2 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_quirurgica2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_quirurgica2 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_quirurgica2) . "\"";
   }
   //----- bayer_evento_adverso_causa_muerte2
   function NM_export_bayer_evento_adverso_causa_muerte2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_causa_muerte2))
         {
             $this->bayer_evento_adverso_causa_muerte2 = sc_convert_encoding($this->bayer_evento_adverso_causa_muerte2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_causa_muerte2 =\"" . $this->trata_dados($this->bayer_evento_adverso_causa_muerte2) . "\"";
   }
   //----- bayer_evento_adverso_detalles_ea2
   function NM_export_bayer_evento_adverso_detalles_ea2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_detalles_ea2))
         {
             $this->bayer_evento_adverso_detalles_ea2 = sc_convert_encoding($this->bayer_evento_adverso_detalles_ea2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_detalles_ea2 =\"" . $this->trata_dados($this->bayer_evento_adverso_detalles_ea2) . "\"";
   }
   //----- bayer_evento_adverso_relacion_medicamento3
   function NM_export_bayer_evento_adverso_relacion_medicamento3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_relacion_medicamento3))
         {
             $this->bayer_evento_adverso_relacion_medicamento3 = sc_convert_encoding($this->bayer_evento_adverso_relacion_medicamento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_relacion_medicamento3 =\"" . $this->trata_dados($this->bayer_evento_adverso_relacion_medicamento3) . "\"";
   }
   //----- bayer_evento_adverso_relacionado_dispositivo3
   function NM_export_bayer_evento_adverso_relacionado_dispositivo3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_relacionado_dispositivo3))
         {
             $this->bayer_evento_adverso_relacionado_dispositivo3 = sc_convert_encoding($this->bayer_evento_adverso_relacionado_dispositivo3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_relacionado_dispositivo3 =\"" . $this->trata_dados($this->bayer_evento_adverso_relacionado_dispositivo3) . "\"";
   }
   //----- bayer_evento_adverso_fecha_inicio_evento3
   function NM_export_bayer_evento_adverso_fecha_inicio_evento3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_inicio_evento3))
         {
             $this->bayer_evento_adverso_fecha_inicio_evento3 = sc_convert_encoding($this->bayer_evento_adverso_fecha_inicio_evento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_inicio_evento3 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_inicio_evento3) . "\"";
   }
   //----- bayer_evento_adverso_desenlace3
   function NM_export_bayer_evento_adverso_desenlace3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_desenlace3))
         {
             $this->bayer_evento_adverso_desenlace3 = sc_convert_encoding($this->bayer_evento_adverso_desenlace3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_desenlace3 =\"" . $this->trata_dados($this->bayer_evento_adverso_desenlace3) . "\"";
   }
   //----- bayer_evento_adverso_fecha_recuperacion3
   function NM_export_bayer_evento_adverso_fecha_recuperacion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_recuperacion3))
         {
             $this->bayer_evento_adverso_fecha_recuperacion3 = sc_convert_encoding($this->bayer_evento_adverso_fecha_recuperacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_recuperacion3 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_recuperacion3) . "\"";
   }
   //----- bayer_evento_adverso_fecha_muerte3
   function NM_export_bayer_evento_adverso_fecha_muerte3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_muerte3))
         {
             $this->bayer_evento_adverso_fecha_muerte3 = sc_convert_encoding($this->bayer_evento_adverso_fecha_muerte3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_muerte3 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_muerte3) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad3
   function NM_export_bayer_evento_adverso_criterio_seriedad3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad3))
         {
             $this->bayer_evento_adverso_criterio_seriedad3 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad3 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad3) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_muerte3
   function NM_export_bayer_evento_adverso_criterio_seriedad_muerte3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_muerte3))
         {
             $this->bayer_evento_adverso_criterio_seriedad_muerte3 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_muerte3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_muerte3 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_muerte3) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_hospitalizacion3
   function NM_export_bayer_evento_adverso_criterio_seriedad_hospitalizacion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_hospitalizacion3))
         {
             $this->bayer_evento_adverso_criterio_seriedad_hospitalizacion3 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_hospitalizacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_hospitalizacion3 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_hospitalizacion3) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_amenaza3
   function NM_export_bayer_evento_adverso_criterio_seriedad_amenaza3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_amenaza3))
         {
             $this->bayer_evento_adverso_criterio_seriedad_amenaza3 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_amenaza3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_amenaza3 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_amenaza3) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_incapacidad3
   function NM_export_bayer_evento_adverso_criterio_seriedad_incapacidad3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_incapacidad3))
         {
             $this->bayer_evento_adverso_criterio_seriedad_incapacidad3 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_incapacidad3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_incapacidad3 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_incapacidad3) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_anormalidad3
   function NM_export_bayer_evento_adverso_criterio_seriedad_anormalidad3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_anormalidad3))
         {
             $this->bayer_evento_adverso_criterio_seriedad_anormalidad3 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_anormalidad3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_anormalidad3 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_anormalidad3) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_evento3
   function NM_export_bayer_evento_adverso_criterio_seriedad_evento3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_evento3))
         {
             $this->bayer_evento_adverso_criterio_seriedad_evento3 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_evento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_evento3 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_evento3) . "\"";
   }
   //----- bayer_evento_adverso_criterio_seriedad_quirurgica3
   function NM_export_bayer_evento_adverso_criterio_seriedad_quirurgica3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_criterio_seriedad_quirurgica3))
         {
             $this->bayer_evento_adverso_criterio_seriedad_quirurgica3 = sc_convert_encoding($this->bayer_evento_adverso_criterio_seriedad_quirurgica3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_criterio_seriedad_quirurgica3 =\"" . $this->trata_dados($this->bayer_evento_adverso_criterio_seriedad_quirurgica3) . "\"";
   }
   //----- bayer_evento_adverso_causa_muerte3
   function NM_export_bayer_evento_adverso_causa_muerte3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_causa_muerte3))
         {
             $this->bayer_evento_adverso_causa_muerte3 = sc_convert_encoding($this->bayer_evento_adverso_causa_muerte3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_causa_muerte3 =\"" . $this->trata_dados($this->bayer_evento_adverso_causa_muerte3) . "\"";
   }
   //----- bayer_evento_adverso_detalles_ea3
   function NM_export_bayer_evento_adverso_detalles_ea3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_detalles_ea3))
         {
             $this->bayer_evento_adverso_detalles_ea3 = sc_convert_encoding($this->bayer_evento_adverso_detalles_ea3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_detalles_ea3 =\"" . $this->trata_dados($this->bayer_evento_adverso_detalles_ea3) . "\"";
   }
   //----- bayer_evento_adverso_informacion_adicional
   function NM_export_bayer_evento_adverso_informacion_adicional()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_informacion_adicional))
         {
             $this->bayer_evento_adverso_informacion_adicional = sc_convert_encoding($this->bayer_evento_adverso_informacion_adicional, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_informacion_adicional =\"" . $this->trata_dados($this->bayer_evento_adverso_informacion_adicional) . "\"";
   }
   //----- bayer_evento_adverso_nombre_reporte
   function NM_export_bayer_evento_adverso_nombre_reporte()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_nombre_reporte))
         {
             $this->bayer_evento_adverso_nombre_reporte = sc_convert_encoding($this->bayer_evento_adverso_nombre_reporte, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_nombre_reporte =\"" . $this->trata_dados($this->bayer_evento_adverso_nombre_reporte) . "\"";
   }
   //----- bayer_evento_adverso_id_paciente_fk
   function NM_export_bayer_evento_adverso_id_paciente_fk()
   {
         nmgp_Form_Num_Val($this->bayer_evento_adverso_id_paciente_fk, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_id_paciente_fk))
         {
             $this->bayer_evento_adverso_id_paciente_fk = sc_convert_encoding($this->bayer_evento_adverso_id_paciente_fk, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_id_paciente_fk =\"" . $this->trata_dados($this->bayer_evento_adverso_id_paciente_fk) . "\"";
   }
   //----- bayer_evento_adverso_medicamento1
   function NM_export_bayer_evento_adverso_medicamento1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_medicamento1))
         {
             $this->bayer_evento_adverso_medicamento1 = sc_convert_encoding($this->bayer_evento_adverso_medicamento1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_medicamento1 =\"" . $this->trata_dados($this->bayer_evento_adverso_medicamento1) . "\"";
   }
   //----- bayer_evento_adverso_medicamento2
   function NM_export_bayer_evento_adverso_medicamento2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_medicamento2))
         {
             $this->bayer_evento_adverso_medicamento2 = sc_convert_encoding($this->bayer_evento_adverso_medicamento2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_medicamento2 =\"" . $this->trata_dados($this->bayer_evento_adverso_medicamento2) . "\"";
   }
   //----- bayer_evento_adverso_medicamento3
   function NM_export_bayer_evento_adverso_medicamento3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_medicamento3))
         {
             $this->bayer_evento_adverso_medicamento3 = sc_convert_encoding($this->bayer_evento_adverso_medicamento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_medicamento3 =\"" . $this->trata_dados($this->bayer_evento_adverso_medicamento3) . "\"";
   }
   //----- bayer_evento_adverso_informacion_ea1
   function NM_export_bayer_evento_adverso_informacion_ea1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_informacion_ea1))
         {
             $this->bayer_evento_adverso_informacion_ea1 = sc_convert_encoding($this->bayer_evento_adverso_informacion_ea1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_informacion_ea1 =\"" . $this->trata_dados($this->bayer_evento_adverso_informacion_ea1) . "\"";
   }
   //----- bayer_evento_adverso_informacion_ea2
   function NM_export_bayer_evento_adverso_informacion_ea2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_informacion_ea2))
         {
             $this->bayer_evento_adverso_informacion_ea2 = sc_convert_encoding($this->bayer_evento_adverso_informacion_ea2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_informacion_ea2 =\"" . $this->trata_dados($this->bayer_evento_adverso_informacion_ea2) . "\"";
   }
   //----- bayer_evento_adverso_informacion_ea3
   function NM_export_bayer_evento_adverso_informacion_ea3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_informacion_ea3))
         {
             $this->bayer_evento_adverso_informacion_ea3 = sc_convert_encoding($this->bayer_evento_adverso_informacion_ea3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_informacion_ea3 =\"" . $this->trata_dados($this->bayer_evento_adverso_informacion_ea3) . "\"";
   }
   //----- bayer_evento_adverso_fecha_suspencion1
   function NM_export_bayer_evento_adverso_fecha_suspencion1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_suspencion1))
         {
             $this->bayer_evento_adverso_fecha_suspencion1 = sc_convert_encoding($this->bayer_evento_adverso_fecha_suspencion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_suspencion1 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_suspencion1) . "\"";
   }
   //----- bayer_evento_adverso_fecha_suspencion2
   function NM_export_bayer_evento_adverso_fecha_suspencion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_suspencion2))
         {
             $this->bayer_evento_adverso_fecha_suspencion2 = sc_convert_encoding($this->bayer_evento_adverso_fecha_suspencion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_suspencion2 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_suspencion2) . "\"";
   }
   //----- bayer_evento_adverso_fecha_suspencion3
   function NM_export_bayer_evento_adverso_fecha_suspencion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_suspencion3))
         {
             $this->bayer_evento_adverso_fecha_suspencion3 = sc_convert_encoding($this->bayer_evento_adverso_fecha_suspencion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_suspencion3 =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_suspencion3) . "\"";
   }
   //----- bayer_evento_adverso_fecha_evento_adverso
   function NM_export_bayer_evento_adverso_fecha_evento_adverso()
   {
         if (substr($this->bayer_evento_adverso_fecha_evento_adverso, 10, 1) == "-") 
         { 
             $this->bayer_evento_adverso_fecha_evento_adverso = substr($this->bayer_evento_adverso_fecha_evento_adverso, 0, 10) . " " . substr($this->bayer_evento_adverso_fecha_evento_adverso, 11);
         } 
         if (substr($this->bayer_evento_adverso_fecha_evento_adverso, 13, 1) == ".") 
         { 
            $this->bayer_evento_adverso_fecha_evento_adverso = substr($this->bayer_evento_adverso_fecha_evento_adverso, 0, 13) . ":" . substr($this->bayer_evento_adverso_fecha_evento_adverso, 14, 2) . ":" . substr($this->bayer_evento_adverso_fecha_evento_adverso, 17);
         } 
         $this->nm_data->SetaData($this->bayer_evento_adverso_fecha_evento_adverso, "YYYY-MM-DD HH:II:SS");
         $this->bayer_evento_adverso_fecha_evento_adverso = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_fecha_evento_adverso))
         {
             $this->bayer_evento_adverso_fecha_evento_adverso = sc_convert_encoding($this->bayer_evento_adverso_fecha_evento_adverso, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_fecha_evento_adverso =\"" . $this->trata_dados($this->bayer_evento_adverso_fecha_evento_adverso) . "\"";
   }
   //----- bayer_evento_adverso_nombre_reportante_primario
   function NM_export_bayer_evento_adverso_nombre_reportante_primario()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_nombre_reportante_primario))
         {
             $this->bayer_evento_adverso_nombre_reportante_primario = sc_convert_encoding($this->bayer_evento_adverso_nombre_reportante_primario, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_nombre_reportante_primario =\"" . $this->trata_dados($this->bayer_evento_adverso_nombre_reportante_primario) . "\"";
   }
   //----- bayer_evento_adverso_telefono_reportante_primario
   function NM_export_bayer_evento_adverso_telefono_reportante_primario()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_telefono_reportante_primario))
         {
             $this->bayer_evento_adverso_telefono_reportante_primario = sc_convert_encoding($this->bayer_evento_adverso_telefono_reportante_primario, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_telefono_reportante_primario =\"" . $this->trata_dados($this->bayer_evento_adverso_telefono_reportante_primario) . "\"";
   }
   //----- bayer_evento_adverso_tipo_reportante
   function NM_export_bayer_evento_adverso_tipo_reportante()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bayer_evento_adverso_tipo_reportante))
         {
             $this->bayer_evento_adverso_tipo_reportante = sc_convert_encoding($this->bayer_evento_adverso_tipo_reportante, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " bayer_evento_adverso_tipo_reportante =\"" . $this->trata_dados($this->bayer_evento_adverso_tipo_reportante) . "\"";
   }

   //----- 
   function trata_dados($conteudo)
   {
      $str_temp =  $conteudo;
      $str_temp =  str_replace("<br />", "",  $str_temp);
      $str_temp =  str_replace("&", "&amp;",  $str_temp);
      $str_temp =  str_replace("<", "&lt;",   $str_temp);
      $str_temp =  str_replace(">", "&gt;",   $str_temp);
      $str_temp =  str_replace("'", "&apos;", $str_temp);
      $str_temp =  str_replace('"', "&quot;",  $str_temp);
      $str_temp =  str_replace('(', "_",  $str_temp);
      $str_temp =  str_replace(')', "",  $str_temp);
      return ($str_temp);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['BAYER_EA'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> -  :: XML</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">XML</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="BAYER_EA_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="BAYER_EA"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
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
