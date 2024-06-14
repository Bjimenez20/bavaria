<div class="modal fade" id="ingresoModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar datos e ingresar paciente</h1>
            </div>
            <div class="modal-body overflow-auto">
                <form>
                    <div class="card card-body mb-3">
                        <div class="row mb-3">
                            <div class="col">
                                <p class="text-secondary fw-bold">PACIENTE</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="row-reverse">
                                    <div class="col">
                                        <label for="" class="fw-bold mb-3">Asignado para <span class="fw-bold text-danger">*</span></label>
                                        <input type="text" value="PSP Solutions" name="" id="" class="form-control readonly" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="row-reverse">
                                    <div class="col">
                                        <label for="" class="fw-bold mb-3">Barrio <span class="fw-bold text-danger">*</span></label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row-reverse">
                                    <div class="col">
                                        <label for="" class="fw-bold mb-3">Telefono 5 <span class="fw-bold text-danger">*</span></label>
                                        <input type="number" name="" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="row-reverse">
                                    <div class="col">
                                        <label for="" class="fw-bold mb-3">Genero <span class="fw-bold text-danger">*</span></label>
                                        <select name="" id="" class="form-control">
                                            <option value="">Seleccione un genero</option>
                                            <option value="">Masculino</option>
                                            <option value="">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row-reverse">
                                    <div class="col">
                                        <label for="" class="fw-bold mb-3">Edad <span class="fw-bold text-danger">*</span></label>
                                        <input type="number" name="" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="row-reverse">
                                    <div class="col">
                                        <label for="" class="fw-bold mb-3">Fecha Inicio Terapia <span class="fw-bold text-danger">*</span></label>
                                        <input type="date" name="" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body mb-3">
                        <div class="row-reverse mb-3">
                            <div class="col">
                                <p class="text-secondary fw-bold">GENERAL</p>
                            </div>
                            <div class="col">
                                <table width="100%">
                                    <?php
                                    $fecha_actual = date('Y-m-d');
                                    $fecha_rec_act = explode("-", $fecha_actual);
                                    $anio_act = $fecha_rec_act[0];
                                    $mes_act = $fecha_rec_act[1];
                                    $dia_act = $fecha_rec_act[2];
                                    $dato = ((int)$mes_act);
                                    $ID = $fila['ID_PACIENTE'];
                                    $select_historial_pri = mysqli_query($conex, "SELECT * FROM ipsen_historial_reclamacion WHERE ID_PACIENTE_FK='$ID'");
                                    echo mysqli_error($conex);
                                    $reg_hist = mysqli_num_rows($select_historial_pri);
                                    if ($reg_hist > 0) {
                                        $select_historial = mysqli_query($conex, "SELECT MES$dato as 'MES',RECLAMO$dato as 'RECLAMO',FECHA_RECLAMACION$dato as 'FECHA_RECLAMACION',MOTIVO_NO_RECLAMACION$dato as 'MOTIVO_NO_RECLAMACION' FROM ipsen_historial_reclamacion WHERE ID_PACIENTE_FK='" . $ID . "' AND MES$dato='" . $mes_act . "'");
                                        echo mysqli_error($conex);
                                        while ($inf = mysqli_fetch_array($select_historial)) {
                                            $reclamo = $inf['RECLAMO'];
                                            $MES = $inf['MES'];
                                            $MOTIVO_NO_RECLAMACION = $inf['MOTIVO_NO_RECLAMACION'];
                                            $FECHA_RECLAMACION = $inf['FECHA_RECLAMACION'];
                                        }
                                    } else {
                                        $INSERT_HISTORIAL = mysqli_query($conex, "INSERT INTO ipsen_historial_reclamacion(ID_PACIENTE_FK) VALUES('" . $fila['ID_PACIENTE'] . "')");
                                        echo mysqli_error($conex);
                                    }
                                    $Sel = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' ORDER BY ID_GESTION DESC LIMIT 1");
                                    while ($con = mysqli_fetch_array($Sel)) {
                                        $ID_GESTION_ULT = $con['ID_GESTION'];
                                        $FECHA_NO_RECLAMACION = $con['FECHA_CITA_PROGRAMADA'];
                                        $RECLAMO_GESTION = $con['RECLAMO_GESTION'];
                                        $CAUSA_NO_RECLAMACION_GESTION = $con['CAUSA_NO_RECLAMACION_GESTION'];
                                        $FECHA_MEDICAMENTO_HASTA = $con['FECHA_MEDICAMENTO_HASTA'];
                                        $FECHA_RECLAMACIONN = $con['FECHA_RECLAMACION_GESTION'];
                                        $FECHA_AUTORIZACION = $con['FECHA_AUTORIZACION'];
                                    }
                                    ?>
                                    <?php
                                    date_default_timezone_set("America/Bogota");
                                    $d      = date('d');
                                    $mes_nu = date('m');
                                    $ano    = date('Y');
                                    $ultima_causal1 = "";
                                    $ultima_causal2 = "";
                                    $ultima_fechaa2 = mysqli_query($conex, "SELECT A.CAUSAL_NO_VISITA AS BARRERA, DATE (A.FECHA_ULTIMO_REGISTRO) AS CONSULT, A.ID_PACIENTE_FK2, YEAR(A.FECHA_ULTIMO_REGISTRO) AS ANO, MONTH(A.FECHA_ULTIMO_REGISTRO) AS MES,DAY(A.FECHA_ULTIMO_REGISTRO) AS DIA FROM ipsen_conteo AS A WHERE ID_PACIENTE_FK2 ='" . $ID_PACIENTE2 . "' ORDER BY ID DESC LIMIT 1");
                                    echo mysqli_error($conex);
                                    $sqlrow = mysqli_num_rows($ultima_fechaa2);
                                    while ($datos_fechas = (mysqli_fetch_array($ultima_fechaa2))) {
                                        $id_paciente_conteo = $datos_fechas['ID_PACIENTE_FK2'];
                                        $fecha_conteo_ANO = $datos_fechas['ANO'];
                                        $fecha_conteo_MES = $datos_fechas['MES'];
                                        $fecha_conteo_DIA = $datos_fechas['DIA'];
                                        $FECHA_CONSULT = $datos_fechas['CONSULT'];
                                        $ultima_causal = $datos_fechas['BARRERA'];
                                        $ultima_causal2 = "1";
                                    }
                                    if ($sqlrow >= 1) {
                                        $fecha1 = new DateTime("$ano-$mes_nu-$d");
                                        $fecha2 = new DateTime("$fecha_conteo_ANO-$fecha_conteo_MES-$fecha_conteo_DIA");
                                        $diff = $fecha1->diff($fecha2);
                                    } elseif ($sqlrow <= 0) {
                                        $fecha1 = new DateTime("$ano-$mes_nu-$d");
                                        $fecha2 = new DateTime("$ano-$mes_nu-$d");
                                        $diff = $fecha1->diff($fecha2);
                                    }
                                    ?>
                                    <tr>
                                        <?php if ($privilegios == '1' || $privilegios == '4') { ?>
                                            <?php $formt = date('Y-m-d');
                                            if ($resultadoso == 'Falta de Contacto' || $resultadoso == 'Paciente sin Acudiente' || $resultadoso == 'Direccion Errada' || $resultadoso == 'Paciente sin tiempo para atender Visita' || $resultadoso == 'Desconfianza') {
                                                $resultadoso2 = $resultadoso;
                                            } else {
                                                $resultadoso;
                                                $resultadoso2 = "";
                                            }
                                            ?>
                                    </tr>
                                    <tr>
                                        <td><span>Programacion visita inicial</span><input type="hidden" name="medicamentojair" id="medicamentojair" value="<?php echo $producto_tratamiento; ?>" /><br><br></td>
                                        <td><input type="date" id="progra_visi_ini" name="progra_visi_ini" value="<?php echo $Fecha_privilegio; ?>" /> <br><br></td>
                                        <td><span id="span_causa_visita" style="display: none;">Causa No visitas<span class="asterisco">*</span></span>
                                            <span id="span_fecha_visita" style="display: none;">Fecha Visita Inicial<span class="asterisco">*</span></span>
                                        </td>
                                        <td><select id="span_causa_visita1" style="display: none;" name="span_causa_visita1">
                                                <option value="<?php echo $resultadoso2; ?>"><?php echo $resultadoso2; ?></option>
                                                <option value="">Seleccione...</option>
                                                <option value="Falta de Contacto">Falta de Contacto</option>
                                                <option value="Paciente sin Acudiente">Paciente sin Acudiente</option>
                                                <option value="Direccion Errada">Direccion Errada</option>
                                                <option value="Paciente sin tiempo para atender Visita">Paciente sin tiempo para atender Visita</option>
                                                <option value="Desconfianza">Desconfianza</option>
                                            </select>
                                            <input style="display: none;" type="date" id="fecha_visita_ini" name="fecha_visita_ini" value="<?php echo $resultadoso; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>Visita inicial efectiva<span class="asterisco">*</span></span>
                                        </td>
                                        <td>
                                            <select id="sel_visita_inicial" name="sel_visita_inicial">
                                                <option value="<?php echo $visita_privilegio ?>"><?php echo $visita_privilegio; ?></option>
                                                <?php
                                                if ($visita_privilegio == 'NO') {    ?>
                                                    <option value="SI">SI</option>
                                                <?php    }
                                                if ($visita_privilegio == 'SI') {     ?>
                                                    <option value="NO">NO</option>
                                                <?php     }
                                                if ($reclamo == '' || $visita_privilegio == 'N/A') {    ?>
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php  }
                                        if ($privilegios == '2') { ?>
                                    <?php $formt = date('Y-m-d');
                                            if ($resultadoso == 'Falta de Contacto' || $resultadoso == 'Paciente sin Acudiente' || $resultadoso == 'Direccion Errada' || $resultadoso == 'Paciente sin tiempo para atender Visita' || $resultadoso == 'Desconfianza') {
                                                $resultadoso2 = $resultadoso;
                                            } else {
                                                $resultadoso;
                                                $resultadoso2 = "";
                                            }
                                    ?>
                                    <tr>
                                        <td>
                                            <span>Programacion visita inicial</span><input type="hidden" name="medicamentojair" id="medicamentojair" value="<?php echo $producto_tratamiento; ?>" /><br><br>
                                        </td>
                                        <td>
                                            <input type="date" id="progra_visi_ini" name="progra_visi_ini" value="<?php echo $Fecha_privilegio; ?>" disabled /> <br><br>
                                        </td>
                                        <td>
                                            <span id="span_causa_visita" style="display: none;">Causa No visitas</span>
                                            <span id="span_fecha_visita" style="display: none;">Fecha Visita Inicial</span>
                                        </td>
                                        <td>
                                            <select id="span_causa_visita1" style="display: none;" name="span_causa_visita1" disabled>
                                                <option value="<?php echo $resultadoso2; ?>"><?php echo $resultadoso2; ?></option>
                                                <option value="">Seleccione...</option>
                                                <option value="Falta de Contacto">Falta de Contacto</option>
                                                <option value="Paciente sin Acudiente">Paciente sin Acudiente</option>
                                                <option value="Direccion Errada">Direccion Errada</option>
                                                <option value="Paciente sin tiempo para atender Visita">Paciente sin tiempo para atender Visita</option>
                                                <option value="Desconfianza">Desconfianza</option>
                                            </select>
                                            <input style="display: none;" type="date" id="fecha_visita_ini" name="fecha_visita_ini" value="<?php echo $resultadoso; ?>" disabled />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>Visita inicial efectiva</span>
                                        </td>
                                        <td>
                                            <select id="sel_visita_inicial" name="sel_visita_inicial" disabled>
                                                <option value="<?php echo $visita_privilegio; ?>"><?php echo $visita_privilegio; ?></option>
                                                <?php
                                                if ($visita_privilegio == 'NO') {    ?>
                                                    <option value="SI">SI</option>
                                                <?php    }
                                                if ($visita_privilegio == 'SI') {     ?>
                                                    <option value="NO">NO</option>
                                                <?php     }
                                                if ($reclamo == '' || $visita_privilegio == 'N/A') {    ?>
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <?php if ($producto_tratamiento != 'XOFIGO') {
                                    echo '';
                                } else {   ?>
                                    <tr>
                                        <td>
                                            <span>Fecha de Formulacion<span class="asterisco">*</span></span>
                                        </td>
                                        <td>
                                            <?php if ($privilegios == "1") { ?>
                                                <input id="fecha_formulacion" name="fecha_formulacion" type="date" value="<?php echo $fecha_formulacionv; ?>" required="required" />
                                            <?php } else {
                                                if ($fecha_formulacionv == '') {
                                                    echo 'N/A';
                                                } else {
                                                    echo "<p style='border:1px solid; background-color:#FFFFFF; border-color:#aaaaaa;'>" . $fecha_formulacionv . "</p>";
                                                }
                                            } ?>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                                <?php
                                $Sel = mysqli_query($conex, "SELECT * FROM ipsen_gestiones WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE . "' AND ID_GESTION = '" . $ID_GESTION_ULT . "' ORDER BY ID_GESTION DESC LIMIT 1");
                                while ($con = mysqli_fetch_array($Sel)) {
                                    $RECLAMOS = $con['RECLAMO_GESTION'];
                                    $CAUSA_NO_RECLAMACION_GESTIONES = $con['CAUSA_NO_RECLAMACION_GESTION'];
                                    $CANAL_CONTACTO = $con['CANAL_CONTACTO'];
                                    $TIPO_VISITA = $con['TIPO_VISITA'];
                                ?>
                                    <tr>
                                        <td>
                                            <span>Reclamo<span class="asterisco">*</span></span>
                                        </td>
                                        <td>
                                            <select type="text" name="reclamo" id="reclamo">
                                                <option><?php echo $RECLAMOS ?></option>
                                                <option>Seleccione...</option>
                                                <?php
                                                if ($RECLAMOS == 'NO' || $RECLAMOS == 'SI' || $RECLAMOS == 'N/A' || $RECLAMOS == '') {
                                                ?>
                                                    <option>SI</option>
                                                    <option>NO</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <span style=" display:none" id="causa">Causa No Reclamacion<span class="asterisco">*</span></span>
                                            <span style=" display:none" id="fecha_reclamacion_span">Fecha de Reclamacion<span class="asterisco">*</span></span>
                                        </td>
                                        <td>
                                            <select name="causa_no_reclamacion" id="causa_no_reclamacion" style=" display:none">
                                                <option><?php echo $CAUSA_NO_RECLAMACION_GESTIONES ?></option>
                                                <option>Seleccione...</option>
                                                <option>Abandono</option>
                                                <option>Autorizacion radicada para Cita</option>
                                                <option>Autorizacion radicada para Medicamento</option>
                                                <option>Cita inoportuna</option>
                                                <option>Demora en la Autorizacion Cita Medica</option>
                                                <option>Demora en la autorizacion de medicamento</option>
                                                <option>Desafiliacion Asegurador</option>
                                                <option>En proceso de cita Aplicacion</option>
                                                <option>En proceso de cita medica</option>
                                                <option>En proceso de entrega</option>
                                                <option>En proceso de Examenes</option>
                                                <option>Error en papeleria</option>
                                                <option>Falta cita para examenes</option>
                                                <option>Falta de cita aplicacion</option>
                                                <option>Falta de cita medica</option>
                                                <option>Falta de cita valoracion (Xofigo)</option>
                                                <option>Falta de contacto</option>
                                                <option>Falta de medicamento en el punto</option>
                                                <option>Hospitalizado</option>
                                                <option>No remision a entidad licenciada</option>
                                                <option>Pago anticipado</option>
                                                <option>Pendiente formulacion NO sistema</option>
                                                <option>Pendiente Radicar Formula en Farmacia</option>
                                                <option>PSVC en Titulacion</option>
                                                <option>Sin red Prestadora</option>
                                                <option>Suspendido por esquema de aplicacion</option>
                                                <option>Suspendido entrega de otro laboratorio</option>
                                                <option>Suspendido temporalmente</option>
                                                <option>Voluntario</option>
                                            </select>
                                            <input type="date" name="fecha_reclamacion" id="fecha_reclamacion" style=" display:none" max="<?php echo date('Y-m-d'); ?>" min="<?php echo $DIAS_ANTES ?>" value="<?php echo $FECHA_RECLAMACIONN ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>Fecha Cita Programada<span class="asterisco">*</span></span>
                                        </td>
                                        <td>
                                            <input type="date" value="<?php echo $FECHA_NO_RECLAMACION ?>" name="fecha_cita_programada" id="fecha_cita_programada">
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td>
                                        <div id="asignado" style="display:none">
                                            <span>Asignado para</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="solicitud_cambio_proveedor_people" style="display:none">
                                            <input type="text" name="proveedor_people" id="proveedor_people" value='People Marketing' readonly>
                                        </div>
                                        <div id="solicitud_cambio_proveedor_psp" style="display:none">
                                            <input type="text" name="proveedor_psp" id="proveedor_psp" value='PSP Solutions' readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="cambio_estado_activo_solicitar" style="display:none;">Solicitar cambio de estado Paciente</span>
                                        <span id="cambio_estado_abandono_solicitar" style="display:none;">Solicitar cambio de estado Paciente</span>
                                        <span id="cambio_estado_suspendido_solicitar" style="display:none;">Solicitar cambio de estado Paciente</span>
                                        <span id="cambio_estado_interrumpido_solicitar" style="display:none;">Solicitar cambio de estado Paciente</span>
                                    </td>
                                    <td>
                                        <input type="text" name="estado_activo" id="estado_activo" style="display:none;" value="Activo" readonly>
                                        <input type="text" name="estado_abandono" id="estado_abandono" style="display:none;" value="Abandono" readonly>
                                        <input type="text" name="estado_suspendido" id="estado_suspendido" style="display:none;" value="Suspendido" readonly>
                                        <input type="text" name="estado_interrumpido" id="estado_interrumpido" style="display:none;" value="Interrumpido" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">
                                        <div id="fecha_retiro_span" style="display:none">
                                            <span>Fecha de Retiro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        </div>
                                    </td>
                                    <td width="30%">
                                        <input type="date" name="fecha_retiro" id="fecha_retiro" max="10" value="<?php echo $fila['FECHA_RETIRO_PACIENTE']; ?>" style="display:none">
                                    </td>
                                    <td width="20%">
                                        <div id="motivo_retiro_span" style="display:none">
                                            <span>Motivo de Retiro</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select type="text" name="motivo_retiro" id="motivo_retiro" style="display:none">
                                            <option><?php echo $fila['MOTIVO_RETIRO_PACIENTE']; ?></option>
                                            <option>Seleccione...</option>
                                            <option>Cambio de tratamiento</option>
                                            <option>Embarazo</option>
                                            <option>Evento adverso</option>
                                            <option>Falta de contacto</option>
                                            <option>Fuera del pais</option>
                                            <option>Muerte</option>
                                            <option>No interesado</option>
                                            <option>Off label</option>
                                            <option>Orden medica</option>
                                            <option>Otro</option>
                                            <option>Progresion de da enfermedad</option>
                                            <option>Terminacion del tratamiento</option>
                                            <option>Voluntario</option>
                                            <option>NO APLICA</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="observacion_retiro_span" style="display:none">
                                            <span>Observaciones Motivo de Retiro</span>
                                        </div>
                                    </td>
                                    <td colspan="3">
                                        <textarea name="observacion_retiro" id="observacion_retiro" style="width:98%; height:100px; display:none"><?php echo $fila['OBSERVACION_MOTIVO_RETIRO_PACIENTE']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <span>Active para cambio </span>
                                            <div class="switch-button">
                                                <input type="checkbox" name="switch-button" id="switch-label" class="switch-button__checkbox">
                                                <label for="switch-label" class="switch-button__label"></label>
                                            </div>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <span>Se brindo Educacion</span>
                                            <select name="brindo_educacion" id="brindo_educacion" disabled>
                                                <?php $select_edu = mysqli_query($conex, "SELECT * FROM `ipsen_educacion` WHERE `ID_PACI_FK` = '$ID_PACIENTE2' ORDER BY `FECHA_REGISTRO` DESC LIMIT 1");
                                                while ($dato = mysqli_fetch_array($select_edu)) {
                                                    $brindo_edu = $dato['SE_BRINDO_EDU'];
                                                    $temaBrindo = $dato['TEMA_SI_EDU'];
                                                    $fecha_brindo = $dato['FECHA_SI_EDU'];
                                                    $motivoNo = $dato['MOTIVO_NO_EDU'];
                                                }
                                                if ($brindo_edu == 'SI') {
                                                    echo  '<option>' . $brindo_edu . '</option>' . '<option>NO</option>';
                                                } elseif ($brindo_edu == 'NO') {
                                                    echo  '<option>' . $brindo_edu . '</option>' . '<option>SI</option>';
                                                } else {
                                                    $brindo_edu = 'NULL';
                                                    $temaBrindo = 'NULL';
                                                    $fecha_brindo = 'NULL';
                                                    $motivoNo = 'NULL';
                                                    echo '<option value="">Seleccione...</option>
                                                      <option>SI</option>
                                                      <option>NO</option>';
                                                } ?>
                                            </select>
                                        </label>
                                    </td>
                                    <td id="TemaSiEdu" <?php if ($brindo_edu == 'SI') {
                                                            echo 'style="display: block;"';
                                                        } elseif ($brindo_edu == 'NO') {
                                                            echo 'style="display: none;"';
                                                        } else {
                                                            echo 'style="display: none;"';
                                                        } ?>>
                                        <label>
                                            <span>Tema</span>
                                            <select name="TemaBrindoEdu" id="TemaBrindoEdu" disabled>
                                                <?php if ($brindo_edu == 'NO') {
                                                    echo '<option value="">Seleccione...</option>';
                                                } elseif ($brindo_edu == 'SI') {
                                                    echo '<option>' . $temaBrindo . '</option>';
                                                } else {
                                                    echo '<option value="">Seleccione...</option>';
                                                } ?>
                                                <option>GM1 Nutricion</option>
                                                <option>GM2 Auto Cuidado</option>
                                                <option>GM3 Afrontamiento Enfermedades Cronicas</option>
                                                <option>GM4 Derechos y deberes en la salud de los pacientes</option>
                                                <option>GM5 Actitud positiva frente a la enfermedad</option>
                                                <option>GM6 Inteligencia emocional</option>
                                                <option>GM7 Barreras mentales</option>
                                                <option>GM8 Te cuido, me cuido</option>
                                                <option>GM9 Resiliencia</option>
                                                <option>GM10 Apoyo familiar a pacientes con enfermedad cronica</option>
                                                <option>GM11 Regulacion emocional</option>
                                                <option>GM12 Programacion neurolinguistica</option>
                                                <option>GM13</option>
                                                <option>GM14</option>
                                                <option>GM15</option>
                                            </select>
                                        </label>
                                    </td>
                                    <td id="FechaSiEdu" <?php if ($brindo_edu == 'SI') {
                                                            echo 'style="display: block;"';
                                                        } elseif ($brindo_edu == 'NO') {
                                                            echo 'style="display: none;"';
                                                        } else {
                                                            echo 'style="display: none;"';
                                                        } ?>>
                                        <label>
                                            <span>Fecha Educacion</span>
                                            <input type="date" name="FechaEduca" id="FechaEduca" value="<?php echo  $fecha_brindo; ?>" disabled>
                                        </label>
                                    </td>
                                    <td id="motivo_no" <?php if ($brindo_edu == 'NO') {
                                                            echo 'style="display: block;"';
                                                        } elseif ($brindo_edu == 'SI') {
                                                            echo 'style="display: none;"';
                                                        } else {
                                                            echo 'style="display: none;"';
                                                        } ?>>
                                        <label>
                                            <span>Motivo</span>
                                            <select name="MotivoNoEdu" id="MotivoNoEdu" disabled>
                                                <?php if ($brindo_edu == 'SI') {
                                                    echo '<option value="">Seleccione...</option>';
                                                } elseif ($brindo_edu == 'NO') {
                                                    echo '<option>' . $motivoNo . '</option>';
                                                } else {
                                                    echo '<option value="">Seleccione...</option>';
                                                } ?>
                                                <option>No permite brindar informacion</option>
                                                <option>Solicita que sea de forma presencial</option>
                                                <option>No acepta visita</option>
                                                <option>Solicita envio por Email</option>
                                                <option>No Interesada</option>
                                            </select>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style=" display:none" id="consecutivo_betaferon_span">Consecutivo Betaferon<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="consecutivo_betaferon" id="consecutivo_betaferon" style=" display:none" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="display:none" id="span_apoyo">
                                            <span>Se brindo apoyo<span class="asterisco">*</span></span>
                                        </div>
                                        <div style="display:none" id="span_aplicacion">
                                            <span>Agregar informacion aplicaciones<span class="asterisco">*</span></span>
                                        </div>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <div style="display:none; width:100%" id="div_apoyo">
                                            <select type="text" name="brindo_apoyo" id="brindo_apoyo" style="width:82%">
                                                <option value="">Seleccione...</option>
                                                <option>SI</option>
                                                <option>NO</option>
                                            </select>
                                            <input type="button" name="ver_apoyo" id="ver_apoyo" title="Ver apoyo" style=" visibility:hidden" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_brindar_apoyo.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>&xxxx=<?php echo base64_encode($fila['PRODUCTO_TRATAMIENTO']) ?>')" class="btn_ver" />
                                        </div>
                                        <div style="display:none; width:100%" id="div_aplicaciones">
                                            <select type="text" name="aplicaicones" id="aplicaicones" style="width:82%">
                                                <option value="">Seleccione...</option>
                                                <option>SI</option>
                                                <option>NO</option>
                                            </select>
                                            <input type="button" name="ver_aplicaciones" id="ver_aplicaciones" title="Ver aplicaciones" style=" visibility:hidden" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_aplicaciones_eylia.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>&xxxx=<?php echo base64_encode($fila['PRODUCTO_TRATAMIENTO']) ?>')" class="btn_ver" />
                                        </div>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <div style="display:none" id="span_tabletas_diarias">
                                            <span>Numero Tabletas Diarias</span>
                                        </div>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <div style="display:none; width:100%;" id="div_tabletas_diarias">
                                            <input value="0" type="text" name="numero_tabletas_diarias" id="numero_tabletas_diarias" style="width:95%;" placeholder="0" />
                                        </div>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Medicamento Hasta<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="date" name="fecha_medicamento_hasta" id="fecha_medicamento_hasta" value="<?php echo $FECHA_MEDICAMENTO_HASTA; ?>" />
                                        <br>
                                        <br>
                                    </td>
                                    <td class="tit"><br>
                                        <br>
                                    </td>
                                    <td style="width:30%;"><br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Se Logro la Comunicacion<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%; display:none" value="" checked="checked" />
                                        <input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%;" value="SI" />SI
                                        <input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%;" value="NO" />NO
                                        <br>
                                        <br>
                                    </td>
                                    <td class="tit">
                                        <span>Motivo de Comunicacion<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td style="width:30%;">
                                        <select type="text" name="motivo_comunicacion" id="motivo_comunicacion">
                                            <option value="">Seleccione...</option>
                                            <option>Apoyo Emocional</option>
                                            <option>Educacion Mes Actual</option>
                                            <option>Educacion Patologica</option>
                                            <option>Educacion sistema de Salud</option>
                                            <option>Egreso</option>
                                            <option>Gestion Barreras</option>
                                            <option>Grupo de Apoyo</option>
                                            <option>Ingreso</option>
                                            <option>Reclamo / Bayer a tu casa</option>
                                            <option>Titulacion</option>
                                        </select>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tit">
                                        <span>Medio de Contacto<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td style="width:30%;">
                                        <select type="text" name="medio_contacto" id="medio_contacto">
                                            <option value="">Seleccione...</option>
                                            <option>Electronico</option>
                                            <option>Telefonico</option>
                                            <option>Visita</option>
                                        </select>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <span>Tipo de Llamada<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <select type="text" name="tipo_llamada" id="tipo_llamada">
                                            <option value="">Seleccione...</option>
                                            <option>Entrada</option>
                                            <option>Salida</option>
                                        </select>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Motivo de No Comunicacion</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <select type="text" name="motivo_no_comunicacion" id="motivo_no_comunicacion">
                                            <option value="">Seleccione...</option>
                                            <option>Apagado</option>
                                            <option>No Esta</option>
                                            <option>No Contesta</option>
                                            <option>No Vive Ahi</option>
                                            <option>Numero Equivocado</option>
                                            <option>Telefono Ocupado</option>
                                            <option>Telefono Fuera de Servicio</option>
                                            <option>Otro</option>
                                        </select>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <span>Numero de Intentos<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="text" name="via_recepcion" id="via_recepcion" />
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Canal contacto<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select name="canal_contacto" id="canal_contacto">
                                            <option><?php echo $CANAL_CONTACTO ?></option>
                                            <option>Seleccione...</option>
                                            <option>Presencial</option>
                                            <option>Virtual</option>
                                            <option>Telefonico</option>
                                        </select>
                                    </td>
                                    <td>
                                        <span>Tipo de visita<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select name="tipo_visita" id="tipo_visita">
                                            <option><?php echo $TIPO_VISITA ?></option>
                                            <option>Seleccione...</option>
                                            <option>Educacion</option>
                                            <option>Induccion</option>
                                            <option>Barrera</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Asegurador<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select id="asegurador" name="asegurador" style="width:95%;" onchange="trat_previo1(this)">
                                            <option value="<?php echo $fila['ASEGURADOR_TRATAMIENTO'] ?>"><?php echo $fila['ASEGURADOR_TRATAMIENTO'] ?></option>
                                            <?php $query =  mysqli_query($conex, "SELECT DISTINCT ASEGURADOR FROM ipsen_asegurador WHERE ESTADO = 'IN' ORDER BY ID_ASEGURADOR DESC");
                                            while ($valores = mysqli_fetch_array($query)) {
                                            ?>
                                                <option><?php echo $valores['ASEGURADOR'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    </td>
                                    <td>
                                        <span>Ips que Atiende<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select name="ips_atiende" id="ips_atiende" style="width:95%;" onchange="trat_previo3(this)">
                                            <option value="<?php echo $fila['IPS_ATIENDE_TRATAMIENTO'] ?>"><?php echo $fila['IPS_ATIENDE_TRATAMIENTO'] ?></option>
                                            <?php $query =  mysqli_query($conex, "SELECT DISTINCT IPS FROM ipsen_ips WHERE ESTADO = 'IN' ORDER BY ID_IPS DESC");
                                            while ($valores = mysqli_fetch_array($query)) {
                                            ?>
                                                <option><?php echo $valores['IPS'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td id="otro_asegurador" style="display:none">
                                        <span>Asegurador por habilitar<span class="asterisco">*</span></span>
                                        <input name="asegurador_otro" id="asegurador_otro" type="text" style="width:78%;" />
                                    </td>
                                    <td></td>
                                    <td id="otro_ips" style="display:none">
                                        <span>Ips por habilitar<span class="asterisco">*</span></span>
                                        <input name="ips_otro" id="ips_otro" type="text" style="width:78%;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Medico Tratante<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select name="medico_tratante" id="medico_tratante" style="width:95%;" onchange="trat_previo4(this)">
                                            <option value="<?php echo $fila['MEDICO_TRATAMIENTO'] ?>"><?php echo $fila['MEDICO_TRATAMIENTO'] ?></option>
                                            <?php $query =  mysqli_query($conex, "SELECT DISTINCT MEDICO FROM ipsen_listas WHERE ESTADO = 'IN' ORDER BY ID_LISTA DESC");
                                            while ($valores = mysqli_fetch_array($query)) {
                                            ?>
                                                <option><?php echo $valores['MEDICO'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <span>Medico Prescriptor<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select name="medico_prescriptor" id="medico_prescriptor" style="width:95%;" onchange="trat_previo5(this)">
                                            <option value="<?php echo $fila['MEDICO_PRESCRIPTOR'] ?>"><?php echo $fila['MEDICO_PRESCRIPTOR'] ?></option>
                                            <option>Seleccione...</option>
                                            <?php $query =  mysqli_query($conex, "SELECT DISTINCT MEDICO FROM ipsen_listas WHERE ESTADO = 'IN' ORDER BY ID_LISTA DESC");
                                            while ($valores = mysqli_fetch_array($query)) {
                                            ?>
                                                <option><?php echo $valores['MEDICO'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td id="otro_medico_t" style="display:none">
                                        <span>Medico Tratante por habilitar<span class="asterisco">*</span></span>
                                        <input name="medico_t_otro" id="medico_t_otro" type="text" style="width:78%;" />
                                    </td>
                                    <td></td>
                                    <td id="otro_medico_p" style="display:none">
                                        <span>Medico Prescriptor por habilitar<span class="asterisco">*</span></span>
                                        <input name="medico_p_otro" id="medico_p_otro" type="text" style="width:78%;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Fecha Prescripcion<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="date" name="fecha_prescripcion" id="fecha_prescripcion" value="<?php echo $fila['FECHA_PRESCRIPCION'] ?>">
                                    </td>
                                    <td>
                                        <span>Operador Logistico<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select id="operador_logistico" name="operador_logistico" style="width:95%;" onchange="trat_previo2(this)">
                                            <option value="<?php echo $fila['OPERADOR_LOGISTICO_TRATAMIENTO'] ?>"><?php echo $fila['OPERADOR_LOGISTICO_TRATAMIENTO'] ?></option>
                                            <?php $query =  mysqli_query($conex, "SELECT DISTINCT OPERADOR_LOGISTICO FROM ipsen_operador_logistico WHERE ESTADO = 'IN' ORDER BY ID_OPERADOR_LOGISTICO DESC");
                                            while ($valores = mysqli_fetch_array($query)) {
                                            ?>
                                                <option><?php echo $valores['OPERADOR_LOGISTICO'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td id="otro_operador" style="display:none">
                                        <span>Operador logistico por habilitar<span class="asterisco">*</span></span>
                                        <input name="operador_otro" id="operador_otro" type="text" style="width:78%;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Ciudad de Entrega</span><span class="asterisco">*</span><br>
                                        <br>
                                    </td>
                                    <td>
                                        <select type="text" name="ciudad_reclamacion" id="ciudad_reclamacion">
                                            <option><?php echo $fila['CIUDAD_RECLAMACION']; ?></option>
                                            <option>Seleccione...</option>
                                            <?php
                                            $Selecciones = mysqli_query($conex, "SELECT nombre FROM ipsen_ciudad");
                                            while ($fila2 = mysqli_fetch_array($Selecciones)) {
                                                $CIUDAD = $fila2['nombre'];
                                                echo "<option>" . $CIUDAD . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <span>Punto De Entrega</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <select name="punto_entrega" id="punto_entrega" style="width:95%;" onchange="trat_previo6(this)">
                                            <option value="<?php echo $fila['PUNTO_ENTREGA'] ?>"><?php echo $fila['PUNTO_ENTREGA'] ?></option>
                                            <?php $query =  mysqli_query($conex, "SELECT DISTINCT NOMBRE_PUNTO FROM ipsen_puntos_entrega WHERE ESTADO = 'IN' ORDER BY ID_PUNTO DESC");
                                            while ($valores = mysqli_fetch_array($query)) {
                                            ?>
                                                <option><?php echo $valores['NOMBRE_PUNTO'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td id="otro_punto" style="display:none">
                                        <span>Punto de entrega por habilitar<span class="asterisco">*</span></span>
                                        <input name="punto_entrega_otro" id="punto_entrega_otro" type="text" style="width:78%;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Numero de Autorizacion<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <select type="text" name="estado_ctc" id="estado_ctc">
                                            <option value="">Seleccione...</option>
                                            <option>Pendiente Por Aprobacion</option>
                                            <option>1Ra Entrega De 1 Autorizada</option>
                                            <option>1Ra Entrega De 2 Autorizadas</option>
                                            <option>2Da Entrega De 2 Autorizadas</option>
                                            <option>1Ra Entrega De 3 Autorizadas</option>
                                            <option>2Da Entrega De 3 Autorizadas</option>
                                            <option>3Ra Entrega De 3 Autorizadas</option>
                                            <option>1Ra Entrega De 4 Autorizadas</option>
                                            <option>2Da Entrega De 4 Autorizadas</option>
                                            <option>3Ra Entrega De 4 Autorizadas</option>
                                            <option>4Ta Entrega De 4 Autorizadas</option>
                                            <option>1Ra Entrega De 5 Autorizadas</option>
                                            <option>2Da Entrega De 5 Autorizadas</option>
                                            <option>3Ra Entrega De 5 Autorizadas</option>
                                            <option>4Ta Entrega De 5 Autorizadas</option>
                                            <option>5Ta Entrega De 5 Autorizadas</option>
                                            <option>1Ra Entrega De 6 Autorizadas</option>
                                            <option>2Da Entrega De 6 Autorizadas</option>
                                            <option>3Ra Entrega De 6 Autorizadas</option>
                                            <option>4Ta Entrega De 6 Autorizadas</option>
                                            <option>5Ta Entrega De 6 Autorizadas</option>
                                            <option>6Ta Entrega De 6 Autorizadas</option>
                                            <option>1Ra Entrega De 12 Autorizadas</option>
                                            <option>2Da Entrega De 12 Autorizadas</option>
                                            <option>3Ra Entrega De 12 Autorizadas</option>
                                            <option>4Ta Entrega De 12 Autorizadas</option>
                                            <option>5Ta Entrega De 12 Autorizadas</option>
                                            <option>6Ta Entrega De 12 Autorizadas</option>
                                            <option>7Ma Entrega De 12 Autorizadas</option>
                                            <option>8va Entrega De 12 Autorizadas</option>
                                            <option>9Na Entrega De 12 Autorizadas</option>
                                            <option>10Ma Entrega De 12 Autorizadas</option>
                                            <option>11Ava Entrega De 12 Autorizadas</option>
                                            <option>12Ava Entrega De 12 Autorizadas</option>
                                            <option>Pendiente Confirmar</option>
                                            <option>Paciente No Proporciona Informacion</option>
                                        </select>
                                    </td>
                                    <td>
                                        <span>Fecha de Autorizacion<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input name="fecha_autorizacion" id="fecha_autorizacion" type="date" style="margin-top: 10px;" value="<?php echo $FECHA_AUTORIZACION ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Estado Farmacia</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <select type="text" name="estado_farmacia" id="estado_farmacia">
                                            <option value="">Seleccione...</option>
                                            <option>Aprobado</option>
                                            <option>Pendiente Radicar</option>
                                            <option>Radicado</option>
                                        </select>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <span>Dificultad en el Acceso</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="radio" name="dificultad_acceso" id="dificultad_acceso" style=" width:20%;" value="SI" />SI
                                        <input type="radio" name="dificultad_acceso" id="dificultad_acceso" style=" width:20%;" value="NO" />NO
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tipo de Dificultad</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td colspan="3">
                                        <textarea style="width:98%; height:72.5px;" id="tipo_dificultad" name="tipo_dificultad"></textarea>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Autor</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="text" name="autor" id="autor" readonly="readonly" value="<?php echo $nombre . ' ' . $apellido ?>" />
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <span>Genera Solicitud<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="radio" name="genera_solicitud" id="genera_solicitud" style=" width:20%; display:none" value="" checked="checked" />
                                        <input type="radio" name="genera_solicitud" id="genera_solicitud" style=" width:20%;" value="SI" />SI
                                        <input type="radio" name="genera_solicitud" id="genera_solicitud" style=" width:20%;" value="NO" />NO
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Evento Adverso<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%; display:none" value="" checked="checked" />
                                        <input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%;" value="SI" />SI
                                        <input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%;" value="NO" />NO
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <span id="envio_evento_adverso_span" style="display:none">Tipo de Evento<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <div id="envio_evento_adverso_div" style="display:none">
                                            <input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%; display:none" value="" checked="checked" />
                                            <input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Farmacovigilancia" />Farmacovigilancia
                                            <br>
                                            <input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Tecnovigilancia Betaconnet/ Omrron" />Tecnovigilancia Betaconnet/ Omrron
                                            <br>
                                            <input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Tecnovigilancia I-neb" />Tecnovigilancia I-neb
                                        </div>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Fecha de la Proxima Llamada<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="date" name="fecha_proxima_llamada" id="fecha_proxima_llamada" min="<?php echo date('Y-m-d'); ?>" />
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <span>Motivo de Proxima Llamada<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <select type="text" name="motivo_proxima_llamada" id="motivo_proxima_llamada">
                                            <option value="">Seleccione...</option>
                                            <option>Actualizacion de Datos</option>
                                            <option>Campanas</option>
                                            <option>Cumpleanos</option>
                                            <option>Egreso</option>
                                            <option>Encuestas</option>
                                            <option>Ingreso</option>
                                            <option>Reclamacion</option>
                                            <option>Remision de Caso</option>
                                            <option>Respuesta de Caso</option>
                                            <option>Reclamo / Bayer a tu casa</option>
                                            <option>Seguimiento</option>
                                        </select>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Observaciones Proxima Llamada</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="text" name="observacion_proxima_llamada" id="observacion_proxima_llamada" />
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <span>Consecutivo</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="text" name="consecutivo" id="consecutivo" />
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="span_paap">
                                            <span>Paciente hace parte del PAAP<span class="asterisco">*</span></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="div_paap">
                                            <select type="text" name="paap" id="paap" style="width:95%">
                                                <option><?php echo $PAAP ?></option>
                                                <option>SI</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="span_sub_paap">
                                            <span>Requiere Apoyo del PAAP<span class="asterisco">*</span></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="div_sub_paap">
                                            <select type="text" name="sub_paap" id="sub_paap" style="width:95%">
                                                <?php if ($SUB_PAAP == "") { ?>
                                                    <option value="">Seleccione...</option>
                                                    <option>Con barrera</option>
                                                    <option>Sin barrera</option>
                                                <?php } else { ?>
                                                    <option><?php echo $SUB_PAAP; ?></option>
                                                    <option>Con barrera</option>
                                                    <option>Sin barrera</option>
                                                <?php } ?>
                                            </select>
                                            <br>
                                            <br>
                                        </div>
                                        <div id="div_barrera">
                                            <label>Tipo Transferencia<span class="asterisco">*</span></label>
                                            <select type="text" name="sub_barrera" id="sub_barrera" style="width:95%">
                                                <?php if ($BARRERAPAAP == "") { ?>
                                                    <option value="">Seleccione...</option>
                                                    <option value="Correo">Correo</option>
                                                <?php } else { ?>
                                                    <option><?php echo $BARRERAPAAP; ?></option>
                                                    <option value="Correo">Correo</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <?php
                                    ?>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Numero cajas/ Unidades</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <select name="numero_cajas" id="numero_cajas" style="width:30%;">
                                            <option>Seleccione...</option>
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                            <option>13</option>
                                            <option>14</option>
                                            <option>15</option>
                                            <option>16</option>
                                            <option>17</option>
                                            <option>18</option>
                                            <option>19</option>
                                            <option>20</option>
                                            <option>21</option>
                                            <option>22</option>
                                            <option>23</option>
                                            <option>24</option>
                                            <option>25</option>
                                            <option>26</option>
                                            <option>27</option>
                                            <option>28</option>
                                            <option>29</option>
                                            <option>30</option>
                                            <option>31</option>
                                            <option>32</option>
                                            <option>33</option>
                                            <option>34</option>
                                            <option>35</option>
                                            <option>36</option>
                                            <option>37</option>
                                            <option>38</option>
                                            <option>39</option>
                                            <option>40</option>
                                            <option>41</option>
                                            <option>42</option>
                                            <option>43</option>
                                            <option>44</option>
                                            <option>45</option>
                                            <option>46</option>
                                            <option>47</option>
                                            <option>48</option>
                                            <option>49</option>
                                            <option>50</option>
                                        </select>
                                        <select name="tipo_numero_cajas" id="tipo_numero_cajas" style="width:60%;">
                                            <option>Seleccione...</option>
                                            <option>Ampolla(s)</option>
                                            <option>Aplicacion</option>
                                            <option>Caja(s)</option>
                                        </select>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <div style="display:none" id="span_nebulizaciones">
                                            <span>Numero Nebulizaciones</span>
                                            <br>
                                            <br>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display:none" id="div_nebulizaciones">
                                            <input type="text" name="nebulizaciones" id="nebulizaciones" />
                                            <br>
                                            <br>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="text-transform:capitalize;">Tratamiento Previo</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <select type="text" name="tratamiento_previo" id="tratamiento_previo" onchange="trat_previo(this)">
                                            <option><?php echo $TRATAMIENTO_PREVIOS ?></option>
                                            <option>Seleccione...</option>
                                            <?php
                                            $Seleccion = mysqli_query($conex, "SELECT DISTINCT TRATAMIENTO_PREVIO FROM `ipsen_listas` WHERE TRATAMIENTO_PREVIO != '' AND TRATAMIENTO_PREVIO!='$tratamiento_previo' ORDER BY TRATAMIENTO_PREVIO ASC");
                                            while ($fila_trt = mysqli_fetch_array($Seleccion)) {
                                                $TRATAMIENTO_PREVIO = $fila_trt['TRATAMIENTO_PREVIO'];
                                                echo "<option>" . $TRATAMIENTO_PREVIO . "</option>";
                                            }
                                            ?>
                                            <option>Otro</option>
                                        </select>
                                        <div id="otro_tratamiento" style="display:none">
                                            <span>Cual?</span>
                                            <input name="tratamiento_previo_otro" id="tratamiento_previo_otro" type="text" style="width:78%;" />
                                        </div>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="text-transform:capitalize;">Medicamento</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input style="text-transform:capitalize;" type="text" readonly="readonly" name="MEDICAMENTO" id="MEDICAMENTO" value="<?php echo $PRODUCTO_TRATAMIENTO ?>" />
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <span style="text-transform:capitalize;">Dosis Tratamiento<span class="asterisco">*</span></span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <?php
                                        $dosis_bd = $fila['DOSIS_TRATAMIENTO'];
                                        if ($producto_tratamiento == 'ADEMPAS 1MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2.5MG 84TABL' || $producto_tratamiento == 'ADEMPAS 1.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 0.5MG 42TABL' || $producto_tratamiento == 'ADEMPAS 2MG 42TABL' || $producto_tratamiento == 'ADEMPAS') {
                                            $producto_tratamiento = 'ADEMPAS';
                                        }
                                        if ($producto_tratamiento == 'KOGENATE') {
                                        ?>
                                            <input type="text" maxlength="6" name="Dosis" id="Dosis3" onKeyDown="return validarNumeros(event)" value="<?php echo $DOSIS ?>" />
                                        <?php
                                        }
                                        if ($producto_tratamiento == 'XOFIGO') {
                                        ?>
                                            <input style="text-transform:capitalize;" type="text" name="Dosis" id="Dosis2" value="<?php echo $DOSIS ?>" />
                                        <?php
                                        }
                                        if ($producto_tratamiento == 'KOVALTRY') {
                                        ?>
                                            <input style="text-transform:capitalize;" type="text" name="Dosis" id="Dosis2" value="<?php echo $DOSIS ?>" />
                                        <?php
                                        }
                                        if ($producto_tratamiento == 'JIVI') {
                                        ?>
                                            <input style="text-transform:capitalize;" type="text" name="Dosis" id="Dosis2" value="<?php echo $DOSIS ?>" />
                                        <?php
                                        }
                                        if ($producto_tratamiento != 'XOFIGO' && $producto_tratamiento != 'KOGENATE' && $producto_tratamiento != 'KOVALTRY' && $producto_tratamiento != 'JIVI') {
                                        ?>
                                            <select name="Dosis" id="Dosis">
                                                <option><?php echo $DOSIS ?></option>
                                                <option>Seleccione...</option>
                                                <?php
                                                $producto = $fila['PRODUCTO_TRATAMIENTO'];
                                                $select = mysqli_query($conex, "SELECT DOSIS FROM  ipsen_dosis WHERE NOMBRE_REFERENCIA LIKE '" . $producto_tratamiento . "%' AND DOSIS!='$dosis_bd'");
                                                echo mysqli_error($conex);
                                                while ($filass = (mysqli_fetch_array($select))) {
                                                ?>
                                                    <option value="<?php echo $filass['DOSIS'] ?>"><?php echo $filass['DOSIS'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        <?php
                                        }
                                        ?>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span id="span_fecha_entrega" style="display: none;">Fecha de entrega<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="date" name="fecha_entrega" id="fecha_entrega" value="<?php echo $FECHA_ENTREGA ?>" style="display: none;">
                                    </td>
                                    <td>
                                        <span style="display: none;" id="span_fecha_vencimiento">Fecha de vencimiento<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" value="<?php echo $FECHA_VENCIMIENTO ?>" style="display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span id="span_numero_sn" style="display: none;">Numero SN del producto<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" id="numero_sn" name="numero_sn" value="<?php echo $NUMERO_SN ?>" style="display: none;">
                                    </td>
                                    <td>
                                        <span id="span_fecha_primer_uso" style="display: none;">Fecha de primer uso<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="date" id="fecha_primer_uso" name="fecha_primer_uso" value="<?php echo $FECHA_PRIMER_USO ?>" style="display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="display: none;" id="span_tipo_de_dispositivo">Tipo de dispositivo<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="tipo_de_dispositivo" id="tipo_de_dispositivo" style="display: none;" value="<?php echo $TIPO_DE_DISPOSITIVO ?>">
                                    </td>
                                    <td>
                                        <span id="span_motivo_cambio" style="display: none;">Motivo del cambio<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input type="text" name="motivo_cambio" id="motivo_cambio" style="display: none;" value="<?php echo $MOTIVO_CAMBIO ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="display:none" id="num_lotes_dis2" name="num_lotes_dis2">
                                            <span>Numero lotes de los dispositivos<span class="asterisco">*</span></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display:none" name="num_lotes_dis1" id="num_lotes_dis1">
                                            <input type="text" name="num_lotes_dis" id="num_lotes_dis" value="<?php echo $NUM_LOTES_DISPOSITIVOS ?>">
                                            <img src="imagenes/lapiz 100.png" id="cambio_betaferon" name="cambio_betaferon" title="Editar" style="width:4%; height:20px; margin-left:-10%;" align="right" />
                                        </div>
                                    </td>
                                </tr>
                                <tr style="padding:3%;">
                                    <td colspan="4" width="90%">
                                        <div id="cambio_betaferon_campos" style="display:none; border:#F00 1px solid;">
                                            <table width="99%">
                                                <tr>
                                                    <td>
                                                        <span id="span_fecha_entrega">Fecha de entrega<span class="asterisco">*</span></span>
                                                    </td>
                                                    <td>
                                                        <input type="date" name="fecha_entrega" id="fecha_entrega_1">
                                                    </td>
                                                    <td>
                                                        <span id="span_fecha_vencimiento">Fecha de vencimiento<span class="asterisco">*</span></span>
                                                    </td>
                                                    <td>
                                                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento_1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span id="span_numero_sn">Numero SN del producto<span class="asterisco">*</span></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="numero_sn_1" name="numero_sn">
                                                    </td>
                                                    <td>
                                                        <span id="span_fecha_primer_uso">Fecha de primer uso<span class="asterisco">*</span></span>
                                                    </td>
                                                    <td>
                                                        <input type="date" id="fecha_primer_uso_1" name="fecha_primer_uso">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span id="span_tipo_de_dispositivo">Tipo de dispositivo<span class="asterisco">*</span></span>
                                                    </td>
                                                    <td>
                                                        <select name="tipo_de_dispositivo" id="tipo_de_dispositivo_1">
                                                            <option>Seleccione...</option>
                                                            <?php
                                                            $producto = $fila['PRODUCTO_TRATAMIENTO'];
                                                            $select = mysqli_query($conex, "SELECT TIPO_DE_DISPOSITIVO FROM  ipsen_tipo_dispositivo WHERE PRODUCTO LIKE '" . $producto_tratamiento . "%' ");
                                                            echo mysqli_error($conex);
                                                            while ($filass = (mysqli_fetch_array($select))) {
                                                            ?>
                                                                <option value="<?php echo $filass['TIPO_DE_DISPOSITIVO'] ?>"><?php echo $filass['TIPO_DE_DISPOSITIVO'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <span id="span_motivo_cambio">Motivo del cambio<span class="asterisco">*</span></span>
                                                    </td>
                                                    <td>
                                                        <select name="motivo_cambio" id="motivo_cambio_1">
                                                            <option>Seleccione...</option>
                                                            <option>Paciente nuevo</option>
                                                            <option value="Dano del dispositivo">Daño del dispositivo</option>
                                                            <option>Vencimiento del dispositivo</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span>Numero lotes de los dispositivos<span class="asterisco">*</span></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="num_lotes_dis" id="num_lotes_dis_1">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="display: none;" id="span_fecha_radicacion">Fecha de radicacion EPS<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <input style="display: none;" type="date" name="fecha_radicacion" id="fecha_radicacion" value="<?php echo $FECHA_RADICACION_EPS ?>">
                                    </td>
                                    <td>
                                        <span style="display: none;" id="span_tratamientos_adicionales">Tratamientos adicionales<span class="asterisco">*</span></span>
                                    </td>
                                    <td>
                                        <select name="tratamientos_adicionales" id="tratamientos_adicionales" style="display: none;">
                                            <option><?php echo $TRATAMIENTOS_ADICIONALES ?></option>
                                            <option>Seleccione...</option>
                                            <option>Leuprolide</option>
                                            <option>Gocerelina</option>
                                            <option>Bicalutamida</option>
                                            <option>Abiraterona</option>
                                            <option>Doxitazel</option>
                                            <option>NA</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">
                                        <span>Status del Paciente</span>
                                    </td>
                                    <td width="30%">
                                        <select type="text" name="status_paciente" id="status_paciente">
                                            <option><?php echo $STATUS_PACIENTE ?></option>
                                            <option>Seleccione...</option>
                                        </select>
                                    </td>
                                    <td>
                                        <span>Envios</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <input type="radio" name="envios" id="envios" style=" width:20%;" value="SI" />SI
                                        <input type="radio" name="envios" id="envios" style=" width:20%;" value="NO" />NO
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tipo de Envio</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <select name="tipo_envio" id="tipo_envio">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            while ($opcion = mysqli_fetch_array($listado_envio)) {
                                            ?>
                                                <option value="<?php echo $opcion['referencia'] ?>"><?php echo $opcion['referencia'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <select name="nombre_producto" id="nombre_producto" style="display:none">
                                        </select>
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        <div id="div_agregar" style="visibility:hidden">
                                            <input type="submit" name="agregar_seg" id="agregar_seg" formaction="form_productos_envio.php" formtarget="registro_productos_form" style="background-image:url(imagenes/agregar.png); background-repeat:no-repeat;  width:41px; height:38px; border:1px solid transparent; background-color:transparent" value="" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div id="div_material_agregar" style="width:50%; margin:auto auto; display:none">
                                            <iframe name="registro_productos_form" style="width:100%; height:250px; border:1px solid #000;" scrolling="auto"></iframe>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Descripcion de Comunicacion</span>
                                        <br>
                                        <br>
                                    </td>
                                    <td colspan="3">
                                        <textarea style="width:98%; height:72.5px;" id="descripcion_comunicacion" name="descripcion_comunicacion" onKeyDown="return filtro(1)"></textarea>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                </table>
                                <br>
                                <br>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col my-5 d-flex justify-content-center">
                            <button type="button" onclick="btnSubmitNoIngreso()" class="btn btn-modify bg-gradient text-white w-25">
                                REGISTRAR
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>