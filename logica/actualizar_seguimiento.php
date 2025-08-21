<?php
header("Content-Type: text/html;charset=utf-8");
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <style>
        .aviso3 {
            font-size: 130%;
            font-weight: bold;
            color: #11a9e3;
            text-transform: uppercase;
            background-color: transparent;
            text-align: center;
            padding: 10px;
        }

        .error {
            font-size: 130%;
            font-weight: bold;
            color: red;
            text-transform: uppercase;
            background-color: transparent;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    require('../datos/parse_str.php');
    require('../datos/conex.php');
    mysqli_query($conex, "SET NAMES utf8");
    if (isset($_POST['gestion'])) {
        $gestion = $_POST['gestion'];
    } else {
        $gestion = '';
    }
    $nombre_referencia = $_POST['nombre_referencia'];
    $causa_no_reclamacion = $_POST['causa_no_reclamacion'];
    $codigo_gestion = $_POST['codigo_gestion'];
    $codigo_usuario2 = $_POST['codigo_usuario2'];
    $codigo_usuario = $_POST['codigo_usuario'];
    if ($causa_no_reclamacion == 'Cita inoportuna' || $causa_no_reclamacion == 'Demora en la Autorizacion Cita Medica' || $causa_no_reclamacion == 'Demora en la autorizacion de medicamento' || $causa_no_reclamacion == 'Error en papeleria' || $causa_no_reclamacion == 'Falta cita para examenes' || $causa_no_reclamacion == 'Falta de cita aplicacion' || $causa_no_reclamacion == 'Falta de cita medica' || $causa_no_reclamacion == 'Falta de cita valoracion (Xofigo)' || $causa_no_reclamacion == 'Falta de medicamento en el punto' || $causa_no_reclamacion == 'No remision a entidad licenciada' || $causa_no_reclamacion == 'Pago anticipado' || $causa_no_reclamacion == 'Pendiente formulacion NO sistema' || $causa_no_reclamacion == 'PSVC en Titulacion' || $causa_no_reclamacion == 'Sin red Prestadora') {
        $proveedor = $_POST['proveedor_psp'];
    } else {
        $proveedor = $_POST['proveedor_people'];
    }
    $reclamo = $_POST['reclamo'];
    if ($reclamo == 'SI') {
        $proveedor = $_POST['proveedor_people'];
    }
    $estado_paciente = $_POST['estado_paciente'];
    $status_paciente = $_POST['status_paciente'];
    $fecha_activacion = $_POST['fecha_activacion'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $identificacion = $_POST['identificacion'];
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $telefono1 = $_POST['telefono1'];
    $telefono2 = $_POST['telefono2'];
    $telefono3 = $_POST['telefono3'];
    $telefono4 = $_POST['telefono4'];
    $telefono5 = $_POST['telefono5'];
    $correo = $_POST['correo'];
    $ciudad = $_POST['ciudad'];
    $clasificacion_patologica = $_POST['clasificacion_patologica'];
    $consentimiento_informado = $_POST['consentimiento_informado'];
    $fecha_retiro = $_POST['fecha_retiro'];
    $motivo_retiro = $_POST['motivo_retiro'];
    $observacion_retiro = $_POST['observacion_retiro'];
    $numero_tabletas_diarias = $_POST['numero_tabletas_diarias'];
    $codigo_xofigo = $_POST['codigo_xofigo'];
    $brindo_educacion = $_POST['brindo_educacion'];
    $TemaBrindoEdu = $_POST['TemaBrindoEdu'];
    $FechaEduca = $_POST['FechaEduca'];
    $MotivoNoEdu = $_POST['MotivoNoEdu'];
    $boton_activo = $_POST['switch-button'];
    $frecuencia = $_POST['frecuencia'];
    $sel_visita_inicial = $_POST['sel_visita_inicial'];
    $programada_visita = $_POST['progra_visi_ini'];
    $respues_visi_si = $_POST['fecha_visita_ini'];
    $respues_visi_no = $_POST['span_causa_visita1'];
    $tipo_doc = $_POST['tipo_doc'];
    $tipo_doc_str = implode(",", $tipo_doc);
    $numero_pendiente = $_POST['num_pendiente'];
    $fecha_pendiente = $_POST['fecha_pendiente'];
    $asignado_edugestor = $_POST['ciudad_edugestor'];
    if ($asignado_edugestor ==  'Pasto' || $asignado_edugestor == 'Ibague' || $asignado_edugestor == 'Barranquilla' || $asignado_edugestor == 'Santander') {
        $autorizacion_edugestor = $_POST['autorizacion_edugestor'];
        $observacion_escalamiento  = 'Se envia la autorizacion al cliente';
    } else {
        $autorizacion_edugestor = 'Directo a edugestor';
        $observacion_escalamiento  = 'Se asigno directamente al edugestor de la zona';
    }
    $linea_tratamiento = $_POST['linea_tratamiento'];

    $visitarrr1 = mysqli_query($conex, "UPDATE ipsen_tratamiento SET VISI_INI_EFEC = '" . $sel_visita_inicial . "', PROGRA_VIS_EDU ='" . $programada_visita . "' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
    echo mysqli_error($conex);
    if ($brindo_educacion == 'SI') {
        $insert_edu = mysqli_query($conex, "INSERT INTO `ipsen_educacion`( USER, `ID_PACI_FK`, `SE_BRINDO_EDU`, `TEMA_SI_EDU`, `FECHA_SI_EDU`,  `FECHA_REGISTRO`) VALUES ( '" . $usua . "', '" . $codigo_usuario2 . "', '" . $brindo_educacion . "', '" . $TemaBrindoEdu . "', '" . $FechaEduca . "', NOW())");
    } elseif ($brindo_educacion == 'NO') {
        $insert_edu = mysqli_query($conex, "INSERT INTO `ipsen_educacion`( USER, `ID_PACI_FK`, `SE_BRINDO_EDU`,  `MOTIVO_NO_EDU`, `FECHA_REGISTRO`) VALUES ( '" . $usua . "', '" . $codigo_usuario2 . "', '" . $brindo_educacion . "', '" . $MotivoNoEdu . "', NOW())");
    }
    if ($_POST['progra_visi_ini'] == '') {
        $progra_visi_ini = 'N/A';
    } else {
        $progra_visi_ini = $_POST['progra_visi_ini '];
    }
    if ($_POST['fecha_formulacion'] == '' || $_POST['fecha_formulacion'] == 'N/A') {
        $fecha_formulacion = 'N/A';
    } else {
        $fecha_formulacion = $_POST['fecha_formulacion'];
    }
    $reclamo = $_POST['reclamo'];
    $ciudad_reclamacion = $_POST['ciudad_reclamacion'];
    $tratamiento_email = $_POST['MEDICAMENTO'];
    $fecha_formulacion_sql = mysqli_query($conex, "UPDATE ipsen_tratamiento SET FECHA_FORMULACION = '" . $fecha_formulacion . "', CIUDAD_RECLAMACION ='" . $ciudad_reclamacion . "'  WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
    echo mysqli_error($conex);
    $cambio_estado_paciente = $_POST['estado_paciente_ac'];
    if ($cambio_estado_paciente != 'No') {
        include("../presentacion/email/mail_estado.php");
        $INSERT_CAMBIO_ESTADO = mysqli_query($conex, "INSERT INTO ipsen_cambio_estado (FECHA_SOLICITUD, PAP, NOMBRE, ESTADO_ACTUAL, NUEVO_ESTADO, ASESOR) VALUES(CURRENT_TIMESTAMP, '" . $codigo_usuario . "', '" . $nombre . ' ' . $apellidos . "', '" . $cambio_estado_paciente . "', '" . $estado_paciente . "', '" . $usua . "')");
        echo mysqli_error($conex);
    }
    $direccion_nueva = $_POST['DIRECCION'];
    if ($direccion_nueva != '') {
        $direccion = $direccion_nueva;
    }
    if ($direccion_nueva == '') {
        $direccion = $_POST['direccion_act'];
    }
    $barrio = $_POST['barrio'];
    $departamento = $_POST['departamento'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_ini_terapia = $_POST['fecha_ini_terapia'];
    $edad = $_POST['edad'];
    $motivo_comunicacion = $_POST['motivo_comunicacion'];
    $medio_contacto = $_POST['medio_contacto'];
    $tipo_llamada = $_POST['tipo_llamada'];
    if (isset($_POST['logro_comunicacion'])) {
        $logro_comunicacion = $_POST['logro_comunicacion'];
    } else {
        $logro_comunicacion = '';
    }
    $motivo_no_comunicacion = $_POST['motivo_no_comunicacion'];
    $via_recepcion = $_POST['via_recepcion'];
    $estado_ctc = $_POST['estado_ctc'];
    $fecha_autorizacion = $_POST['fecha_autorizacion'];
    if (isset($_POST['dificultad_acceso'])) {
        $dificultad_acceso = $_POST['dificultad_acceso'];
    } else {
        $dificultad_acceso = '';
    }
    $tipo_dificultad = $_POST['tipo_dificultad'];
    if (isset($_POST['envios'])) {
        $envios = $_POST['envios'];
    } else {
        $envios = '';
    }
    if ($_POST['tratamiento_previo'] == 'Otro') {
        $tratamiento_previo = $_POST['tratamiento_previo_otro'];
    } else {
        $tratamiento_previo = $_POST['tratamiento_previo'];
    }

    $ips_atiende = $_POST['ips_atiende'];
    if ($ips_atiende == 'NO ENCONTRADO') {
        $ips_otro = $_POST['ips_otro'];
        if ($ips_otro != '') {
            $insert_ips = mysqli_query($conex, "INSERT INTO ipsen_ips (IPS,ESTADO) VALUES ('" . $ips_otro . "','OUT')");
            require('../presentacion/email/mail_habilitar_ips.php');
        }
    }

    $operador_logistico = $_POST['operador_logistico'];
    if ($operador_logistico == 'NO ENCONTRADO') {
        $operador_otro = $_POST['operador_otro'];
        if ($operador_otro != '') {
            $insert_opl = mysqli_query($conex, "INSERT INTO ipsen_operador_logistico(OPERADOR_LOGISTICO,ESTADO) VALUES('" . $operador_otro . "','OUT')");
            require('../presentacion/email/mail_habilitar_operador.php');
        }
    }

    $asegurador = $_POST['asegurador'];
    if ($asegurador == 'NO ENCONTRADO') {
        $asegurador_otro = $_POST['asegurador_otro'];
        if ($asegurador_otro != '') {
            $insert_eps = mysqli_query($conex, "INSERT INTO ipsen_asegurador(ASEGURADOR,ESTADO) VALUES('" . $asegurador_otro . "','OUT')");
            require('../presentacion/email/mail_habilitar_eps.php');
        }
    }

    $medico_t = $_POST['medico_tratante'];
    if ($medico_t == 'NO ENCONTRADO') {
        $medico_t_otro = $_POST['medico_t_otro'];
        if ($medico_t_otro != '') {
            $INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_listas(MEDICO,ESTADO)VALUES('" . $medico_t_otro . "','OUT')");
            require('../presentacion/email/mail_habilitar_medico.php');
        }
    }

    $medico_p = $_POST['medico_prescriptor'];
    if ($medico_p == 'NO ENCONTRADO') {
        $medico_p_otro = $_POST['medico_p_otro'];
        if ($medico_p_otro != '') {
            $INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_listas(MEDICO,ESTADO)VALUES('" . $medico_p_otro . "','OUT')");
            require('../presentacion/email/mail_habilitar_medico.php');
        }
    }

    $punto_entrega = $_POST['punto_entrega'];
    if ($punto_entrega == 'NO ENCONTRADO') {
        $punto_entrega_otro = $_POST['punto_entrega_otro'];
        if ($punto_entrega_otro != '') {
            $INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_puntos_entrega(NOMBRE_PUNTO,ESTADO)VALUES('" . $punto_entrega_otro . "','OUT')");
            require('../presentacion/email/mail_habilitar_punto.php');
        }
    }

    $fecha_prescripcion = $_POST['fecha_prescripcion'];
    $MEDICAMENTO = $_POST['MEDICAMENTO'];
    if ($MEDICAMENTO == 'Xofigo 1x6 ml CO' || $MEDICAMENTO == 'BETAFERON CMBP X 15 VPFS (3750 MCG) MM') {
        $codigo_xofigo_sut = substr($codigo_xofigo, 1);
        $update_codigo_betafe = mysqli_query($conex, "UPDATE ipsen_pacientes SET CODIGO_XOFIGO='" . $codigo_xofigo_sut . "' WHERE ID_PACIENTE='" . $codigo_usuario2 . "'");
        echo mysqli_error($conex);
    }
    $cambio_dosis = $_POST['cambio_dosis'];
    if ($cambio_dosis == 'SI') {
        $dosis_antigua = $_POST['dosis_actual'];
        $fecha_cambio_d = $_POST['fecha_cambio_dosis'];
        if ($MEDICAMENTO == 'Xofigo 1x6 ml CO') {
            $dosis = $_POST['Dosis2'];
        }
        if ($MEDICAMENTO == 'Kovaltry') {
            $dosis = $_POST['Dosis2'];
        }
        if ($MEDICAMENTO == 'Jivi') {
            $dosis = $_POST['Dosis2'];
        }
        if ($MEDICAMENTO == 'KOGENATE FS 2000 PLAN') {
            $dosis = $_POST['Dosis3'];
        }
        if ($MEDICAMENTO != 'Xofigo 1x6 ml CO' && $MEDICAMENTO != 'KOGENATE FS 2000 PLAN' && $MEDICAMENTO != 'Kovaltry' && $MEDICAMENTO != 'Jivi') {
            $dosis = $_POST['Dosis'];
        }
        $insert_historico_dosis = mysqli_query($conex, "INSERT INTO ipsen_historico_dosis(DOSIS_ANTIGUA,DOSIS_NUEVA,FECHA_CAMBIO,ID_PACIENTE_FK) VALUES ('" . $dosis_antigua . "','" . $dosis . "','" . $fecha_cambio_d . "','" . $codigo_usuario2 . "')");
        echo mysqli_error($conex);
    } else {
        $dosis = $_POST['dosis_actual'];
    }

    $tipo_envio = $_POST['tipo_envio'];
    $num_lotes_dis = $_POST['num_lotes_dis'];
    $evento_adverso = $_POST['evento_adverso'];
    $tipo_evento_adverso = $_POST['tipo_evento_adverso'];
    if ($evento_adverso == 'NO') {
        $tipo_evento_adverso = ' ';
    }
    if ($evento_adverso == 'SI') {
        $sql = "SELECT ID_EVENTO_ADVERSO AS ID_EVENTO_ADVERSO_ULT FROM ipsen_evento_adverso WHERE ID_PACIENTE_FK ='" . $codigo_usuario2 . "' ORDER BY ID_EVENTO_ADVERSO DESC LIMIT 1";
        $resultado = mysqli_query($conex, $sql);
        $fila = mysqli_fetch_assoc($resultado);
        $CONSECUTIVO_EA = $fila['CONSECUTIVO_EA'];
        $ID_EVENTO_ADVERSO = $fila['ID_EVENTO_ADVERSO_ULT'];
    } else {
        $CONSECUTIVO_EA = '';
        $ID_EVENTO_ADVERSO = '0';
    }
    if (isset($_POST['genera_solicitud'])) {
        $genera_solicitud = $_POST['genera_solicitud'];
    } else {
        $genera_solicitud = '';
    }
    $fecha_proxima_llamada = $_POST['fecha_proxima_llamada'];
    $motivo_proxima_llamada = $_POST['motivo_proxima_llamada'];
    $observacion_proxima_llamada = $_POST['observacion_proxima_llamada'];
    $reclamo = $_POST['reclamo'];
    $aplicacion = $_POST['aplicacion_m'];
    $fecha_aplicacion = $_POST['fecha_aplicacion'];
    $lugar_aplicacion = $_POST['lugar_aplicacion'];
    $fecha_medicamento_hasta = $_POST['fecha_medicamento_hasta'];
    $fecha_inicio_paap = $_POST['fecha_inicio_paap'];
    $fecha_fin_paap = $_POST['fecha_fin_paap'];
    $brindo_apoyo = $_POST['brindo_apoyo'];
    if ($brindo_apoyo == '') {
        $brindo_apoyo = 'N/A';
    }
    if ($_POST['paap'] == '') {
        $paap = 'N/A';
        $sub_paap = 'N/A';
        $sub_barrera = 'N/A';
    } else {
        $paap = $_POST['paap'];
        if ($paap == 'SI') {
            $sub_paap = $_POST['sub_paap'];
            if ($sub_paap == 'Con barrera') {
                $sub_barrera = $_POST['sub_barrera'];
            }
            if ($sub_paap == 'Sin barrera') {
                $sub_barrera = 'N/A';
            }
        }
        if ($paap == 'NO') {
            $sub_paap = 'N/A';
            $sub_barrera = 'N/A';
        }
    }
    if (isset($_POST['registrar'])) {
        if ($reclamo == 'SI') {
            $fecha_actual = date('Y-m-d');
            $fecha_reclamacion = $_POST['fecha_reclamacion'];
            $fecha_rec = explode("-", $fecha_reclamacion);
            $anio = $fecha_rec[0];
            $mes = $fecha_rec[1];
            $dia = $fecha_rec[2];
            $fecha_actual = date('Y-m-d');
            $fecha_rec_act = explode("-", $fecha_actual);
            $mes_act = $fecha_rec_act[1];
            $dato = ((int)$mes);
            $numero_cajas = $_POST['numero_cajas'] . ' ' . $_POST['tipo_numero_cajas'];
        }
        if ($fecha_reclamacion == '') {
            $fecha_reclamacion = $_POST['fecha_ultima_reclamacion'];
            $fecha_ultima_reclamacion = $_POST['fecha_ultima_reclamacion'];
        }
        if ($reclamo == 'NO') {
            $fecha_reclamacion = '';
            $fecha_cita_programada = $_POST['fecha_cita_programada'];
            $fecha_actual = date('Y-m-d');
            $fecha_rec_act = explode("-", $fecha_actual);
            $anio_act = $fecha_rec_act[0];
            $mes_act = $fecha_rec_act[1];
            $dia_act = $fecha_rec_act[2];
            $dato = ((int)$mes_act);
            $fecha_ultima_reclamacion = $_POST['fecha_ultima_reclamacion'];
            if (isset($_POST['causa_no_reclamacion'])) {
                $causa_no_reclamacion = $_POST['causa_no_reclamacion'];
            } else {
                $causa_no_reclamacion = '';
            }
            $numero_cajas = '0 Aplicacion';
        }
        $descripcion_comunicacion = $_POST['descripcion_comunicacion'];
        if ($genera_solicitud == 'SI') {
            include("../presentacion/email/mail_novedades.php");
        }
        if ($genera_solicitud == 'SI' and $nombre_referencia == 'ADEMPAS') {
            echo "Envio adempas";
            include("../presentacion/email/mail_novedades_adempas.php");
        }
        $consecutivo = $_POST['consecutivo'];
        $numero_nebulizaciones = $_POST['nebulizaciones'];
        if ($_POST['estado_farmacia'] == 'Otro') {
            $estado_farmacia = $_POST['estado_farmacia_nuevo'];
            $INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_listas(MEDICO,TIPO_CREACION)VALUES('" . $estado_farmacia . "',1)");
            echo mysqli_error($conex);
        } else {
            $estado_farmacia = $_POST['estado_farmacia'];
        }
        $consecutivo_betaferon = $_POST['consecutivo_betaferon'];
        $autor = $_POST['autor'];
        $nota = $_POST['nota'];
        if ($MEDICAMENTO == 'Eylia 2MG VL 1x2ML CO INST') {
            $INFORMACION_APLICACIONES = $_POST['aplicaicones'];
        } else {
            $INFORMACION_APLICACIONES = 'NO';
        }

        if ($MEDICAMENTO == 'Somatuline') {
            $programa = 'SomosTu';
        } else if ($MEDICAMENTO == 'CABOMETIX') {
            $programa = 'Cabocare';
        }
        if (isset($_POST['registrar'])) {
            $select_temporal = mysqli_query($conex, "SELECT * FROM ipsen_temporal_producto WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
            $nreg = mysqli_num_rows($select_temporal);
            if ($nreg > 0) {
                while ($datos_temporales = (mysqli_fetch_array($select_temporal))) {
                    $tipo_envio = $datos_temporales['ID_REFERENCIA_FK'];
                    $verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE CANTIDAD>0 AND ID_REFERENCIA='" . $tipo_envio . "'");
                    echo mysqli_error($conex);
                    $cantidad = mysqli_num_rows($verificar_cantidad);
                    if ($cantidad > 0) {
                        $SELECT_ID_INV = mysqli_query($conex, "SELECT ID_INVENTARIO from ipsen_inventario WHERE LUGAR_MATERIAL='BODEGA' AND ID_REFERENCIA_FK='" . $tipo_envio . "' ORDER BY ID_INVENTARIO ASC LIMIT 1");
                        echo mysqli_error($conex);
                        while ($fila1 = mysqli_fetch_array($SELECT_ID_INV)) {
                            $ID_ULT_INV = $fila1['ID_INVENTARIO'];
                        }
                        $INSERT_MOVIMIENTO = mysqli_query($conex, "INSERT INTO ipsen_movimientos(TIPO_MOVIMIENTO, NO_REMICION, CANTIDAD, RESPONSABLE, DESTINATARIO, DIRECCION_DESTINATARIO, CIUDAD_ENVIO, FECHA_MOVIMIENTO, OBSERVACIONES, ESTADO_MOVIMIENTO,ID_REFERENCIA_FK) VALUES('2', '', '1', '" . $usua . "', '" . $nombre . ' ' . $apellidos . "', '" . $direccion . "', '" . $ciudad . "', CURRENT_TIMESTAMP, 'ENVIO PRODUCTO(S)', 'EN PROCESO','" . $tipo_envio . "')");
                        echo mysqli_error($conex);
                        $SELECT_CANTIDAD = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA = '" . $tipo_envio . "'");
                        echo mysqli_error($conex);
                        while ($fila1 = mysqli_fetch_array($SELECT_CANTIDAD)) {
                            $CANTIDAD_I = $fila1['CANTIDAD'];
                        }
                        $TOTAL = $CANTIDAD_I - 1;
                        $UPDATE_REFERENCIA = mysqli_query($conex, "UPDATE ipsen_referencia SET CANTIDAD='" . $TOTAL . "' WHERE ID_REFERENCIA='" . $tipo_envio . "'");
                        echo mysqli_error($conex);
                        $SELECT_ID_MOVIMIENTO = mysqli_query($conex, "SELECT ID_MOVIMIENTOS FROM ipsen_movimientos WHERE DESTINATARIO='" . $nombre . ' ' . $apellidos . "' AND TIPO_MOVIMIENTO='2' ORDER BY ID_MOVIMIENTOS DESC LIMIT 1");
                        echo mysqli_error($conex);
                        while ($fila_mov = mysqli_fetch_array($SELECT_ID_MOVIMIENTO)) {
                            $ID_ULT_MOVIMIENTO = $fila_mov['ID_MOVIMIENTOS'];
                        }
                        $INSERT_MOVIMIENTO_PACIENTE = mysqli_query($conex, "INSERT INTO ipsen_paciente_movimientos(ID_PACIENTE_FK,ID_MOVIMIENTOS_FK,
						ESTADO_PACIENTE_MOVIMIENTO)VALUES('" . $codigo_usuario2 . "','" . $ID_ULT_MOVIMIENTO . "','EN PROCESO')");
                        echo mysqli_error($conex);
                        $INSERT_MOVIMIENTO_USUARIO = mysqli_query($conex, "INSERT INTO ipsen_usuario_movimientos(ID_USUARIO_FK,ID_MOVIMIENTOS_FK)VALUES('" . $id_usu . "','" . $ID_ULT_MOVIMIENTO . "')");
                        echo mysqli_error($conex);
                        $verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "' AND CANTIDAD<STOCK_MINIMO");
                        echo mysqli_error($conex);
                        $nreg_vrf = mysqli_num_rows($verificar_cantidad);
    ?>
                        <table style="margin:auto auto; font-size:80%;">
                            <?php
                            if ($nreg_vrf > 0) {
                                while ($daro_ref = mysqli_fetch_array($verificar_cantidad)) {
                                    $MATERIAL = $daro_ref['MATERIAL'];
                            ?>
                                    <tr align="left">
                                        <td align="left">
                                            <span class="error" style="font-size:100%; text-align:left">ADVERTENCIA SE ESTA AGOTANDO EL PRODUCTO <?php echo $MATERIAL ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                        } else {
                            $verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "'");
                            echo mysqli_error($conex);
                            while ($cantidad = mysqli_fetch_array($verificar_cantidad)) {
                                $nombre_producto = $cantidad['MATERIAL'];
                                ?>
                                <tr align="left">
                                    <td align="left">
                                        <span style="margin-top:3%;">
                                            <center>
                                                <img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
                                            </center>
                                        </span>
                                        <p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;color:#F00; font-weight:bold">EL PRODUCTO <span style=""><?php echo $nombre_producto ?></span> ESTA AGOTADO POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
                                        <br />
                                        <br />
                                        <br />
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                    }
                    if ($nreg_vrf > 0) {
                        ?>
                        <tr>
                            <td align="center">
                                <span class="error" style="font-size:100%; ">POR FAVOR COMUNICARSE CON EL COORDINADOR.</span>
                                <span>
                                    <center>
                                        <img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
                                    </center>
                                </span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                        </table>
                        <?php
                        $BORRAR_PRODUCTOS_TEMPORAL = mysqli_query($conex, "DELETE  FROM ipsen_temporal_producto WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
                        echo mysqli_error($conex);
                    } else {
                        $tipo_envio = $_POST['tipo_envio'];
                        $listado_envio = mysqli_query($conex, "SELECT MATERIAL,ID_REFERENCIA FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "'");
                        while ($opcion = mysqli_fetch_array($listado_envio)) {
                            $nombre_producto = $opcion['MATERIAL'];
                        }
                        if ($nombre_producto == 'Kit de bienvenida') {
                            $tipo_envio = $_POST['tipo_envio'];
                            $verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE CANTIDAD>0 AND ID_REFERENCIA='" . $tipo_envio . "'");
                            echo mysqli_error($conex);
                            $cantidad_ref = mysqli_num_rows($verificar_cantidad);
                            if ($cantidad_ref > 0) {
                                $verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE CANTIDAD>0 AND ID_REFERENCIA='" . $tipo_envio . "'");
                                echo mysqli_error($conex);
                                $cantidad = mysqli_num_rows($verificar_cantidad);
                                if ($cantidad > 0) {
                                    $SELECT_ID_INV = mysqli_query($conex, "SELECT ID_INVENTARIO FROM ipsen_inventario WHERE LUGAR_MATERIAL='BODEGA' AND ID_REFERENCIA_FK='" . $tipo_envio . "' ORDER BY ID_INVENTARIO ASC LIMIT 1");
                                    echo mysqli_error($conex);
                                    while ($fila1 = mysqli_fetch_array($SELECT_ID_INV)) {
                                        $ID_ULT_INV = $fila1['ID_INVENTARIO'];
                                    }
                                    $INSERT_MOVIMIENTO = mysqli_query($conex, "INSERT INTO ipsen_movimientos(TIPO_MOVIMIENTO, NO_REMICION, CANTIDAD, RESPONSABLE, DESTINATARIO, DIRECCION_DESTINATARIO, CIUDAD_ENVIO, FECHA_MOVIMIENTO, OBSERVACIONES, ESTADO_MOVIMIENTO,ID_REFERENCIA_FK) VALUES('2', '', '1', '" . $usua . "', '" . $nombre . ' ' . $apellidos . "', '" . $direccion . "', '" . $ciudad . "', CURRENT_TIMESTAMP, 'ENVIO PRODUCTO(S)', 'EN PROCESO','" . $tipo_envio . "')");
                                    echo mysqli_error($conex);
                                    $SELECT_CANTIDAD = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA = '" . $tipo_envio . "'");
                                    echo mysqli_error($conex);
                                    while ($fila1 = mysqli_fetch_array($SELECT_CANTIDAD)) {
                                        $CANTIDAD_I = $fila1['CANTIDAD'];
                                    }
                                    $TOTAL = $CANTIDAD_I - 1;
                                    $UPDATE_REFERENCIA = mysqli_query($conex, "UPDATE ipsen_referencia SET CANTIDAD='" . $TOTAL . "' WHERE ID_REFERENCIA='" . $tipo_envio . "'");
                                    echo mysqli_error($conex);
                                    $SELECT_ID_MOVIMIENTO = mysqli_query($conex, "SELECT ID_MOVIMIENTOS FROM ipsen_movimientos WHERE DESTINATARIO='" . $nombre . ' ' . $apellidos . "' AND TIPO_MOVIMIENTO='2' ORDER BY ID_MOVIMIENTOS DESC LIMIT 1");
                                    echo mysqli_error($conex);
                                    while ($fila_mov = mysqli_fetch_array($SELECT_ID_MOVIMIENTO)) {
                                        $ID_ULT_MOVIMIENTO = $fila_mov['ID_MOVIMIENTOS'];
                                    }
                                    $INSERT_MOVIMIENTO_PACIENTE = mysqli_query($conex, "INSERT INTO ipsen_paciente_movimientos(ID_PACIENTE_FK,ID_MOVIMIENTOS_FK,
									ESTADO_PACIENTE_MOVIMIENTO)VALUES('" . $codigo_usuario2 . "','" . $ID_ULT_MOVIMIENTO . "','EN PROCESO')");
                                    echo mysqli_error($conex);
                                    $INSERT_MOVIMIENTO_USUARIO = mysqli_query($conex, "INSERT INTO ipsen_usuario_movimientos(ID_USUARIO_FK,ID_MOVIMIENTOS_FK)VALUES('" . $id_usu . "','" . $ID_ULT_MOVIMIENTO . "')");
                                    echo mysqli_error($conex);
                                    $BORRAR_PRODUCTOS_TEMPORAL = mysqli_query($conex, "DELETE  FROM ipsen_temporal_producto WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
                                    echo mysqli_error($conex);
                                    $verificar_cantidad = mysqli_query($conex, "SELECT ID_REFERENCIA FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "' AND CANTIDAD<STOCK_MINIMO");
                                    echo mysqli_error($conex);
                                    $nreg_vrf = mysqli_num_rows($verificar_cantidad);
                                    if ($nreg_vrf > 0) {
                        ?>
                                        <span style="margin-top:3%;">
                                            <center>
                                                <img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
                                            </center>
                                        </span>
                                        <p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;">ADVERTENIA SE ESTA AGOTANDO EL PRODUCTO <span style="color:#F00; font-weight:bold"><?php echo $nombre_producto ?></span> POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
                                        <br />
                                        <br />
                                        <br />
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <span style="margin-top:3%;">
                                        <center>
                                            <img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
                                        </center>
                                    </span>
                                    <p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;color:#F00; font-weight:bold">EL PRODUCTO <span style=""><?php echo $nombre_producto ?></span> ESTA AGOTADO POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
                                    <br />
                                    <br />
                                    <br />
                                <?php
                                }
                            } else {
                                $verificar_cantidad = mysqli_query($conex, "SELECT * FROM ipsen_referencia WHERE ID_REFERENCIA='" . $tipo_envio . "'");
                                echo mysqli_error($conex);
                                while ($cantidad = mysqli_fetch_array($verificar_cantidad)) {
                                    $nombre_producto = $cantidad['MATERIAL'];
                                ?>
                                    <tr align="left">
                                        <td align="left">
                                            <span style="margin-top:3%;">
                                                <center>
                                                    <img src="../presentacion/imagenes/advertencia2.png" width="52" height="50" style=" margin-top:100px;margin-top:5%;" />
                                                </center>
                                            </span>
                                            <p class="error" style=" width:68.9%; margin:auto auto; font-size:80%;color:#F00; font-weight:bold">EL PRODUCTO <span style=""><?php echo $nombre_producto ?></span> ESTA AGOTADO POR FAVOR COMUNICARSE CON EL COORDINADOR.</p>
                                            <br />
                                            <br />
                                            <br />
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                        }
                    }
                    $sql = mysqli_query($conex, "UPDATE ipsen_gestiones SET ESTADO_GESTION='GESTIONADO' WHERE ID_GESTION='" . $codigo_gestion . "'");
                    echo mysqli_error($conex);
                    if ($logro_comunicacion == 'SI') {
                        $sql = mysqli_query($conex, "UPDATE ipsen_pacientes SET ESTADO_PACIENTE = '" . $estado_paciente . "',  STATUS_PACIENTE='" . $status_paciente . "', FECHA_ACTIVACION_PACIENTE='" . $fecha_activacion . "', FECHA_RETIRO_PACIENTE='" . $fecha_retiro . "', MOTIVO_RETIRO_PACIENTE='" . $motivo_retiro . "', OBSERVACION_MOTIVO_RETIRO_PACIENTE='" . $observacion_retiro . "',TIPO_IDENTIFICACION_PACIENTE='" . $tipo_identificacion . "' ,TELEFONO_PACIENTE='" . $telefono1 . "', TELEFONO2_PACIENTE='" . $telefono2 . "', TELEFONO3_PACIENTE='" . $telefono3 . "', TELEFONO4_PACIENTE='" . $telefono4 . "', TELEFONO5_PACIENTE='" . $telefono5 . "', CORREO_PACIENTE='" . $correo . "', DIRECCION_PACIENTE='" . $direccion . "', BARRIO_PACIENTE='" . $barrio . "', DEPARTAMENTO_PACIENTE='" . $departamento . "',CIUDAD_PACIENTE='" . $ciudad . "',FECHA_NACIMINETO_PACIENTE='" . $fecha_nacimiento . "',EDAD_PACIENTE='" . $edad . "', PROVEEDOR ='" . $proveedor . "', CONSENTIMIENTO ='" . $consentimiento_informado . "' WHERE ID_PACIENTE='" . $codigo_usuario2 . "'");
                        echo mysqli_error($conex);
                        $sql = mysqli_query($conex, "UPDATE ipsen_tratamiento SET FRECUENCIA_MEDICAMENTO ='" . $frecuencia . "', CLASIFICACION_PATOLOGICA_TRATAMIENTO = '" . $clasificacion_patologica . "', TRATAMIENTO_PREVIO='" . $tratamiento_previo . "', FECHA_PRESCRIPCION='" . $fecha_prescripcion . "',ASEGURADOR_TRATAMIENTO='" . $asegurador . "', OPERADOR_LOGISTICO_TRATAMIENTO='" . $operador_logistico . "',FECHA_ULTIMA_RECLAMACION_TRATAMIENTO='" . $fecha_ultima_reclamacion . "',PUNTO_ENTREGA='" . $punto_entrega . "',MEDICO_TRATAMIENTO='" . $medico_t . "',MEDICO_PRESCRIPTOR='" . $medico_p . "',IPS_ATIENDE_TRATAMIENTO='" . $ips_atiende . "',DOSIS_TRATAMIENTO='" . $dosis . "',FECHA_INICIO_TERAPIA_TRATAMIENTO='" . $fecha_ini_terapia . "',PAAP = '" . $paap . "', SUB_PAAP = '" . $sub_paap . "',BARRERA = '" . $sub_barrera . "' ,NUM_LOTES_DISPOSITIVOS = '" . $num_lotes_dis . "', PROGRAMA_TRA = '" . $programa . "',LINEA_TRATAMIENTO = '" . $linea_tratamiento . "' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
                        echo mysqli_error($conex);
                    }
                    if ($logro_comunicacion == 'NO') {
                        $sql = mysqli_query($conex, "UPDATE ipsen_pacientes SET ESTADO_PACIENTE = '" . $estado_paciente . "', TIPO_IDENTIFICACION_PACIENTE='" . $tipo_identificacion . "', PROVEEDOR ='" . $proveedor . "', CONSENTIMIENTO ='" . $consentimiento_informado . "' WHERE ID_PACIENTE='" . $codigo_usuario2 . "'");
                        echo mysqli_error($conex);
                        $sql = mysqli_query($conex, "UPDATE ipsen_tratamiento SET FRECUENCIA_MEDICAMENTO ='" . $frecuencia . "', CLASIFICACION_PATOLOGICA_TRATAMIENTO = '" . $clasificacion_patologica . "', TRATAMIENTO_PREVIO='" . $tratamiento_previo . "', FECHA_PRESCRIPCION='" . $fecha_prescripcion . "',ASEGURADOR_TRATAMIENTO='" . $asegurador . "', OPERADOR_LOGISTICO_TRATAMIENTO='" . $operador_logistico . "',FECHA_ULTIMA_RECLAMACION_TRATAMIENTO='" . $fecha_ultima_reclamacion . "',PUNTO_ENTREGA='" . $punto_entrega . "',MEDICO_TRATAMIENTO='" . $medico_t . "',MEDICO_PRESCRIPTOR='" . $medico_p . "',IPS_ATIENDE_TRATAMIENTO='" . $ips_atiende . "',DOSIS_TRATAMIENTO='" . $dosis . "',FECHA_INICIO_TERAPIA_TRATAMIENTO='" . $fecha_ini_terapia . "',PAAP = '" . $paap . "', SUB_PAAP = '" . $sub_paap . "',BARRERA = '" . $sub_barrera . "' ,NUM_LOTES_DISPOSITIVOS = '" . $num_lotes_dis . "', PROGRAMA_TRA = '" . $programa . "', LINEA_TRATAMIENTO = '" . $linea_tratamiento . "' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
                        echo mysqli_error($conex);
                    }
                    if ($reclamo == 'SI') {
                        $sql = mysqli_query($conex, "INSERT INTO ipsen_gestiones (MOTIVO_COMUNICACION_GESTION,MEDIO_CONTACTO_GESTION,TIPO_LLAMADA_GESTION,LOGRO_COMUNICACION_GESTION,MOTIVO_NO_COMUNICACION_GESTION,NUMERO_INTENTOS_GESTION,ESTADO_CTC_GESTION,FECHA_AUTORIZACION,ESTADO_FARMACIA_GESTION,RECLAMO_GESTION,APLICACION,CONSECUTIVO_BETAFERON,CAUSA_NO_RECLAMACION_GESTION,DIFICULTAD_ACCESO_GESTION,TIPO_DIFICULTAD_GESTION,ENVIOS_GESTION,MEDICAMENTOS_GESTION,TIPO_ENVIO_GESTION,EVENTO_ADVERSO_GESTION,TIPO_EVENTO_ADVERSO,GENERA_SOLICITUD_GESTION,FECHA_PROXIMA_LLAMADA,MOTIVO_PROXIMA_LLAMADA,OBSERVACION_PROXIMA_LLAMADA,FECHA_RECLAMACION_GESTION,FECHA_APLICACION,LUGAR_APLICACION,FECHA_CITA_PROGRAMADA,FECHA_MEDICAMENTO_HASTA,NUMERO_CAJAS,CONSECUTIVO_GESTION,AUTOR_GESTION,NOTA,DESCRIPCION_COMUNICACION_GESTION,FECHA_PROGRAMADA_GESTION,USUARIO_ASIGANDO,ID_PACIENTE_FK2,FECHA_COMUNICACION,CODIGO_ARGUS,NUMERO_NEBULIZACIONES,NUMERO_TABLETAS_DIARIAS,BRINDO_APOYO,PAAP,SUB_PAAP,BARRERA,INFORMACION_APLICACIONES,FECHA_INI_PAAP,FECHA_FIN_PAAP, EVENTO_ADVERSO_FK, TIPO_DOC, NUMERO_PENDIENTE, FECHA_PENDIENTE, ASIGNADO_EDUGESTOR, AUTORIZACION_EDUGESTOR, OBSERVACION_ESCALAMIENTO)VALUES('" . $motivo_comunicacion . "','" . $medio_contacto . "','" . $tipo_llamada . "','" . $logro_comunicacion . "','" . $motivo_no_comunicacion . "','" . $via_recepcion . "','" . $estado_ctc . "','" . $fecha_autorizacion . "','" . $estado_farmacia . "','" . $reclamo . "','" . $aplicacion . "','" . $consecutivo_betaferon . "','','" . $dificultad_acceso . "','" . $tipo_dificultad . "','" . $envios . "','" . $MEDICAMENTO . "','" . $tipo_envio . "','" . $evento_adverso . "','" . $tipo_evento_adverso . "','" . $genera_solicitud . "','" . $fecha_proxima_llamada . "','" . $motivo_proxima_llamada . "','" . $observacion_proxima_llamada . "','" . $fecha_reclamacion . "','" . $fecha_aplicacion . "','" . $lugar_aplicacion . "','" . $fecha_cita_programada . "','" . $fecha_medicamento_hasta . "','" . $numero_cajas . "','" . $consecutivo . "','" . $autor . "','" . $nota . "','" . $descripcion_comunicacion . "','" . $fecha_proxima_llamada . "','SIN ASIGNAR','" . $codigo_usuario2 . "',CURRENT_TIMESTAMP,'" . $CONSECUTIVO_EA . "','" . $numero_nebulizaciones . "','" . $numero_tabletas_diarias . "','" . $brindo_apoyo . "','" . $paap . "','" . $sub_paap . "','" . $sub_barrera . "','" . $INFORMACION_APLICACIONES . "', '" . $fecha_inicio_paap . "', '" . $fecha_fin_paap . "', '" . $ID_EVENTO_ADVERSO . "', '" . $tipo_doc_str . "', '" . $numero_pendiente . "', '" . $fecha_pendiente . "', '" . $asignado_edugestor . "', '" . $autorizacion_edugestor . "', '" . $observacion_escalamiento . "')");
                        echo mysqli_error($conex);
                    } else if ($reclamo == 'NO') {
                        $sql = mysqli_query($conex, "INSERT INTO ipsen_gestiones (MOTIVO_COMUNICACION_GESTION,MEDIO_CONTACTO_GESTION,TIPO_LLAMADA_GESTION,LOGRO_COMUNICACION_GESTION,MOTIVO_NO_COMUNICACION_GESTION,NUMERO_INTENTOS_GESTION,ESTADO_CTC_GESTION,FECHA_AUTORIZACION,ESTADO_FARMACIA_GESTION,RECLAMO_GESTION,APLICACION,CONSECUTIVO_BETAFERON,CAUSA_NO_RECLAMACION_GESTION,DIFICULTAD_ACCESO_GESTION,TIPO_DIFICULTAD_GESTION,ENVIOS_GESTION,MEDICAMENTOS_GESTION,TIPO_ENVIO_GESTION,EVENTO_ADVERSO_GESTION,TIPO_EVENTO_ADVERSO,GENERA_SOLICITUD_GESTION,FECHA_PROXIMA_LLAMADA,MOTIVO_PROXIMA_LLAMADA,OBSERVACION_PROXIMA_LLAMADA,FECHA_RECLAMACION_GESTION,FECHA_APLICACION,LUGAR_APLICACION,FECHA_CITA_PROGRAMADA,FECHA_MEDICAMENTO_HASTA,NUMERO_CAJAS,CONSECUTIVO_GESTION,AUTOR_GESTION,NOTA,DESCRIPCION_COMUNICACION_GESTION,FECHA_PROGRAMADA_GESTION,USUARIO_ASIGANDO,ID_PACIENTE_FK2,FECHA_COMUNICACION,CODIGO_ARGUS,NUMERO_NEBULIZACIONES,NUMERO_TABLETAS_DIARIAS,BRINDO_APOYO,PAAP,SUB_PAAP,BARRERA,INFORMACION_APLICACIONES,FECHA_INI_PAAP,FECHA_FIN_PAAP, EVENTO_ADVERSO_FK, TIPO_DOC, NUMERO_PENDIENTE, FECHA_PENDIENTE, ASIGNADO_EDUGESTOR, AUTORIZACION_EDUGESTOR, OBSERVACION_ESCALAMIENTO)VALUES('" . $motivo_comunicacion . "','" . $medio_contacto . "','" . $tipo_llamada . "','" . $logro_comunicacion . "','" . $motivo_no_comunicacion . "','" . $via_recepcion . "','" . $estado_ctc . "','" . $fecha_autorizacion . "','" . $estado_farmacia . "','" . $reclamo . "','','" . $consecutivo_betaferon . "','" . $causa_no_reclamacion . "','" . $dificultad_acceso . "','" . $tipo_dificultad . "','" . $envios . "','" . $MEDICAMENTO . "','" . $tipo_envio . "','" . $evento_adverso . "','" . $tipo_evento_adverso . "','" . $genera_solicitud . "','" . $fecha_proxima_llamada . "','" . $motivo_proxima_llamada . "','" . $observacion_proxima_llamada . "','','" . $fecha_aplicacion . "','" . $lugar_aplicacion . "','" . $fecha_cita_programada . "','" . $fecha_medicamento_hasta . "','" . $numero_cajas . "','" . $consecutivo . "','" . $autor . "','" . $nota . "','" . $descripcion_comunicacion . "','" . $fecha_proxima_llamada . "','SIN ASIGNAR','" . $codigo_usuario2 . "',CURRENT_TIMESTAMP,'" . $CONSECUTIVO_EA . "','" . $numero_nebulizaciones . "','" . $numero_tabletas_diarias . "','" . $brindo_apoyo . "','" . $paap . "','" . $sub_paap . "','" . $sub_barrera . "','" . $INFORMACION_APLICACIONES . "', '" . $fecha_inicio_paap . "', '" . $fecha_fin_paap . "', '" . $ID_EVENTO_ADVERSO . "', '" . $tipo_doc_str . "', '" . $numero_pendiente . "', '" . $fecha_pendiente . "', '" . $asignado_edugestor . "', '" . $autorizacion_edugestor . "', '" . $observacion_escalamiento . "')");
                        echo mysqli_error($conex);
                    }
                    $select_historial = mysqli_query($conex, "SELECT * FROM ipsen_historial_reclamacion WHERE ID_PACIENTE_FK = '225'");
                    echo mysqli_error($conex);
                    $reg_hist = mysqli_num_rows($select_historial);
                    if ($reg_hist > 0) {
                        if ($reclamo == 'SI') {
                            $UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE ipsen_historial_reclamacion SET MES$dato='" . $mes . "', RECLAMO$dato='" . $reclamo . "',FECHA_RECLAMACION$dato='" . $fecha_reclamacion . "',MOTIVO_NO_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
                            echo mysqli_error($conex);
                        }
                        if ($reclamo == 'NO') {
                            $UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE ipsen_historial_reclamacion SET MES$dato='" . $mes_act . "', RECLAMO$dato='" . $reclamo . "',MOTIVO_NO_RECLAMACION$dato='" . $causa_no_reclamacion . "',FECHA_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
                            echo mysqli_error($conex);
                        }
                    } else {
                        $INSERT_HISTORIAL = mysqli_query($conex, "INSERT INTO ipsen_historial_reclamacion(ID_PACIENTE_FK) VALUES('" . $codigo_usuario2 . "')");
                        echo mysqli_error($conex);
                        if ($reclamo == 'SI') {
                            $UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE ipsen_historial_reclamacion SET MES$dato='" . $mes_act . "', RECLAMO$dato='" . $reclamo . "',FECHA_RECLAMACION$dato='" . $fecha_reclamacion . "',MOTIVO_NO_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
                            echo mysqli_error($conex);
                        }
                        if ($reclamo == 'NO') {
                            $UPDATE_HISTORIAL = mysqli_query($conex, "UPDATE ipsen_historial_reclamacion SET MES$dato='" . $mes_act . "', RECLAMO$dato='" . $reclamo . "',MOTIVO_NO_RECLAMACION$dato='" . $causa_no_reclamacion . "',FECHA_RECLAMACION$dato='' WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
                            echo mysqli_error($conex);
                        }
                    }
                    if ($sub_barrera == "Correo") {
                        include("../presentacion/email/mail_apoyo_paap.php");
                    }

                    if ($causa_no_reclamacion == 'Cita inoportuna' || $causa_no_reclamacion == 'Demora en la Autorizacion Cita Medica' || $causa_no_reclamacion == 'Demora en la autorizacion de medicamento' || $causa_no_reclamacion == 'Demora en la entrega del medicamento' || $causa_no_reclamacion == 'Error en papeleria' || $causa_no_reclamacion == 'Falta cita para examenes' || $causa_no_reclamacion == 'Falta de cita de aplicacion' || $causa_no_reclamacion == 'Falta de cita medica' || $causa_no_reclamacion == 'Falta de medicamento en el punto' || $causa_no_reclamacion == 'Sin red Prestadora' || $causa_no_reclamacion == 'Cita inoportuna de Aplicacion' || $causa_no_reclamacion == 'Pendiente formulacion NO sistema') {
                        include("../presentacion/email/mail_barreras.php");
                    }
                    $select_gestion = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2='" . $codigo_usuario2 . "' ORDER BY ID_GESTION DESC LIMIT 1");
                    while ($datos_gestion = mysqli_fetch_array($select_gestion)) {
                        $ID_ULTIMA_GESTION = $datos_gestion['ID_GESTION'];
                    }
                    if ($asignado_edugestor ==  'Pasto' || $asignado_edugestor == 'Ibague' || $asignado_edugestor == 'Barranquilla' || $asignado_edugestor == 'Santander') {
                        $sql_historico_escalados = mysqli_query($conex, "INSERT INTO ipsen_observacio_escalados (ESTADO, OBSERVACION, GESTION_ID,  FECHA_REGISTRO) VALUES ('" . $autorizacion_edugestor . "', '" . $observacion_escalamiento . "', '" . $ID_ULTIMA_GESTION . "', NOW())");
                        echo mysqli_error($conex);
                    }
                    $update_codigo_gestion = mysqli_query($conex, "UPDATE ipsen_pacientes SET ID_ULTIMA_GESTION='" . $ID_ULTIMA_GESTION . "' 
					WHERE ID_PACIENTE='" . $codigo_usuario2 . "'");
                    echo mysqli_error($conex);
                    $select_id_tra_sql = mysqli_query($conex, "SELECT ID_TRATAMIENTO AS ID_TRATAMIENT FROM ipsen_tratamiento WHERE ID_PACIENTE_FK='" . $codigo_usuario2 . "'");
                    while ($datos_tratamiento = mysqli_fetch_array($select_id_tra_sql)) {
                        $idtratamientoss = $datos_tratamiento['ID_TRATAMIENT'];
                    }
                    if ($consentimiento_informado == "SI") {
                        require("../presentacion/email/mail_ci_seguimiento.php");
                    }
                    date_default_timezone_set("America/Bogota");
                    $d      = date('d');
                    $mes_nu = date('m');
                    $ano    = date('Y');
                    $ultima_fechaa2 = mysqli_query($conex, "SELECT A.ID AS id_ultimos_registro,A.CAUSAL_NO_VISITA AS CASUALIDAD, A.ID_PACIENTE_FK2, YEAR(A.FECHA_ULTIMO_REGISTRO) AS ANO, MONTH(A.FECHA_ULTIMO_REGISTRO) AS MES,DAY(A.FECHA_ULTIMO_REGISTRO) AS DIA FROM ipsen_conteo AS A WHERE ID_PACIENTE_FK2 = '" . $codigo_usuario2 . "' ORDER BY ID DESC LIMIT 1");
                    $sqlrow = mysqli_num_rows($ultima_fechaa2);
                    while ($datos_fechas = (mysqli_fetch_array($ultima_fechaa2))) {
                        $id_paciente_conteo = $datos_fechas['ID_PACIENTE_FK2'];
                        $fecha_conteo_MES = $datos_fechas['MES'];
                        $fecha_conteo_DIA = $datos_fechas['DIA'];
                        $fecha_conteo_ANO = $datos_fechas['ANO'];
                        $ID_conteo = $datos_fechas['id_ultimos_registro'];
                        $CASUALIDAD1 = $datos_fechas['CASUALIDAD'];
                    }
                    if ($sqlrow >= 1) {
                        $fecha1 = date_format(new DateTime("$d-$mes_nu-$ano"), 'd-m-Y');
                        $fecha2 = date_format(new DateTime("$fecha_conteo_ANO-$fecha_conteo_MES-$fecha_conteo_DIA"), 'd-m-Y');
                        $diff = abs((strtotime($fecha2) - strtotime($fecha1))) / 86400;
                    } elseif ($sqlrow <= 0) {
                        $fecha1 = date_format(new DateTime("$d-$mes_nu-$ano"), 'd-m-Y');
                        $fecha2 = date_format(new DateTime("$d-$mes_nu-$ano"), 'd-m-Y');
                        $diff = abs((strtotime($fecha2) - strtotime($fecha1))) / 86400;
                    }
                    $reclamo = $_POST['reclamo'];
                    if ($reclamo == 'SI') {
                        $insert_conteo = mysqli_query($conex, "INSERT INTO ipsen_conteo (ID_TRATAMIENTO, ID_PACIENTE_FK2, CAUSAL_NO_VISITA, FECHA_ULTIMO_REGISTRO, CONTEO, ESTADO)VALUES('" . $idtratamientoss . "', '" . $codigo_usuario2 . "', 'Finalizo Barrera',CURRENT_TIMESTAMP, '" . $diff . "', '0') ");
                        $update_conteo = mysqli_query($conex, "UPDATE ipsen_conteo SET CONTEO = '" . $diff . "', ESTADO = '0' WHERE ID = '" . $ID_conteo . "'");
                    }
                    if ($reclamo == 'NO') {
                        $insert_conteo = mysqli_query($conex, "INSERT INTO ipsen_conteo (ID_TRATAMIENTO, ID_PACIENTE_FK2, CAUSAL_NO_VISITA, FECHA_ULTIMO_REGISTRO, CONTEO, ESTADO)VALUES('" . $idtratamientoss . "', '" . $codigo_usuario2 . "', '" . $causa_no_reclamacion . "',CURRENT_TIMESTAMP, '" . $diff . "', '1') ");
                        $update_conteo = mysqli_query($conex, "UPDATE ipsen_conteo SET CONTEO = '" . $diff . "', ESTADO = '0'  WHERE ID = '" . $ID_conteo . "'");
                    }
                    $select_id = mysqli_query($conex, "SELECT ID_PACIENTE_FK FROM ipsen_tratamiento WHERE ID_PACIENTE_FK = '" . $codigo_usuario2 . "'");
                    while ($datos_pap = (mysqli_fetch_array($select_id))) {
                        $id_paciente = $datos_pap['ID_PACIENTE_FK'];
                    }
                    $SELECT_GES = mysqli_query($conex, "SELECT ID_GESTION FROM ipsen_gestiones ORDER BY ID_GESTION DESC LIMIT 1");
                    while ($fila2 = mysqli_fetch_array($SELECT_GES)) {
                        $ID_GES = $fila2['ID_GESTION'];
                    }

                    if ($sql) {
                        if ($evento_adverso == 'SI') {
                            if ($tipo_evento_adverso == 'Farmacovigilancia' || $tipo_evento_adverso == 'Tecnovigilancia') {
                                ?>
                                <span style="margin-top:5%;">
                                    <center>
                                        <img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
                                    </center>
                                </span>
                                <p class="aviso3" style=" width:68.9%; margin:auto auto;">EL SEGUIMIENTO HA SIDO INGRESADO SATISFACTORIAMENTE.</p>
                                <br />
                                <br />
                                <center>
                                    <a href="../presentacion/form_paciente_seguimiento.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
                                </center>
                                <br />
                                <?php
                            } else {
                                if ($tipo_evento_adverso != 'Farmacovigilancia' || $tipo_evento_adverso != 'Tecnovigilancia') {
                                ?>
                                    <span style="margin-top:5%;">
                                        <center>
                                            <img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
                                        </center>
                                    </span>
                                    <p class="aviso3" style=" width:68.9%; margin:auto auto;">EL SEGUIMIENTO HA SIDO INGRESADO SATISFACTORIAMENTE.</p>
                                    <br />
                                    <br />
                                    <center>
                                        <a href="../presentacion/form_paciente_seguimiento.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
                                    </center>
                                    <br />
                            <?php
                                }
                            }
                        } else if ($evento_adverso != 'SI') {
                            ?>
                            <span style="margin-top:5%;">
                                <center>
                                    <img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
                                </center>
                            </span>
                            <p class="aviso3" style=" width:68.9%; margin:auto auto;">EL SEGUIMIENTO HA SIDO INGRESADO SATISFACTORIAMENTE.</p>
                            <br />
                            <center>
                                <a href="../presentacion/form_paciente_seguimiento.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
                            </center>
                            <br />
                        <?php
                        }
                    } else {
                        ?>
                        <span style="margin-top:5%;">
                            <center>
                                <img src="../presentacion/imagenes/advertencia2.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
                            </center>
                        </span>
                        <p class="error" style=" width:68.9%; margin:auto auto;">EL SEGUIMIENTO NO HA SIDO INGRESADO SATISFACTORIAMENTE.</p>
                        <br />
                        <br />
                        <center>
                            <a href="javascript:history.go(-1)" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
                        </center>
                        <br />
            <?php
                    }

                    ob_start();
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);

                    // Depuración inicial
                    echo "Inicio del script<br>";
                    flush();

                    // Verificar si hay archivos y tipos de documentos
                    // if (empty($_POST['tipo_doc'])) {
                    //     die("Error: No se seleccionó ningún tipo de documento.");
                    // }

                    if (empty($_FILES['archivo'])) {
                        die("Error: No se seleccionó ningún archivo.");
                    }

                    // Definir carpetas de destino
                    $destinos = [
                        "Consentimiento Informado" => "../CI/$id_paciente",
                        "Voucher" => "../ADJUNTOS_IPSEN/$ID_GES",
                        "Evento Adverso" => "../EA/$ID_GES",
                        "Grabacion Llamada" => "../Audios/$id_paciente",
                        "Documentacion Inicial" => "../DOC_INI/$id_paciente"
                    ];

                    $success = [];
                    $errors = [];

                    foreach ($_FILES['archivo']['name'] as $tipoDoc => $archivos) {
                        if (!isset($destinos[$tipoDoc])) {
                            $errors[] = "Error: Tipo de documento no reconocido: $tipoDoc";
                            continue;
                        }

                        $directorioDestino = $destinos[$tipoDoc] . "/"; // Cambiar según lógica
                        if (!is_dir($directorioDestino)) {
                            mkdir($directorioDestino, 0777, true);
                        }

                        foreach ($archivos as $key => $nombreArchivo) {
                            $tempPath = $_FILES['archivo']['tmp_name'][$tipoDoc][$key];
                            $rutaDestino = $directorioDestino . basename($nombreArchivo);

                            if (move_uploaded_file($tempPath, $rutaDestino)) {
                                $success[] = "Archivo '$tipoDoc' - $nombreArchivo guardado en: $rutaDestino";
                            } else {
                                $errors[] = "Error al mover el archivo: $nombreArchivo";
                            }
                        }
                    }

                    // Mostrar resultados
                    foreach ($success as $msg) {
                        echo "$msg<br>";
                    }
                    foreach ($errors as $msg) {
                        echo "$msg<br>";
                    }

                    // Redirigir (asegurando que no haya salida previa)
                    ob_end_flush();
                }
            }
