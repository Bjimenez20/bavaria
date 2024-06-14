<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
</head>

<body class="body" style="width:80.9%;margin-left:12%;">
    <form id="paciente_nuevo" name="paciente_nuevo" action="../logica/insertar_datos.php" method="post">
        <br />
        <center><span class="titulo">GENERAL</span></center>
        <br />
        <br />
        <div>
            <span>Codigo de Usuario</span>
        </div>
        <div class="div">
            <input type="text" name="codigo_usuario" id="codigo_usuario" max="10" />
        </div>
        <div>
            <span>Estado del Paciente<span class="asterisco">*</span></span>
        </div>
        <div class="div">
            <select type="text" name="estado_paciente" id="estado_paciente">
                <option>Seleccione...</option>
            </select>
        </div>
        <br />
        <br />
        <div>
            <span>Fecha de Activacion<span class="asterisco">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
        <div class="div">
            <input type="date" name="fecha_activacion" id="fecha_activacion" />
        </div>
        <div>
            <span>Fecha de Retiro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
        <div class="div">
            <input type="date" name="fecha_retiro" id="fecha_retiro" max="10" />
        </div>
        <br />
        <br />
        <div>
            <span>Motivo de Retiro</span>
        </div>
        <div class="div">
            <select type="text" name="motivo_retiro" id="motivo_retiro">
                <option>Seleccione...</option>
            </select>
        </div>
        <br />
        <br />
        <div>
            <span>Observaciones Motivo de Retiro</span>
            <br />
            <br />
            <br />
            <br />
            <br />
        </div>
        <div style="width:75.2%;">
            <textarea name="observacion_retiro" id="observacion_retiro" style="width:100%; height:100px"></textarea>
        </div>
        <br />
        <br />
        <div>
            <span>Nombre<span class="asterisco">*</span></span>
            <br />
            <br />
            <span>Identificacion<span class="asterisco">*</span></span>
            <br />
            <br />
            <span>Telefono 2</span>
        </div>
        <div class="div">
            <input type="text" name="nombre" id="nombre" />
            <br />
            <br />
            <input type="text" name="identificacion" id="identificacion" />
            <br />
            <br />
            <input type="text" name="telefono2" id="telefono2" />
        </div>
        <div>
            <span>Apellidos<span class="asterisco">*</span></span>
            <br />
            <br />
            <span>Telefono 1<span class="asterisco">*</span></span>
            <br />
            <br />
            <span>Telefono 3</span>
        </div>
        <div class="div">
            <input type="text" name="apellidos" id="apellidos" />
            <br />
            <br />
            <input type="text" name="telefono1" id="telefono1" />
            <br />
            <br />
            <input type="text" name="telefono3" id="telefono3" />
        </div>
        <br />
        <br />
        <div>
            <span>Correo Electronico</span>
        </div>
        <div class="div">
            <input type="text" name="correo" id="correo" />
        </div>
        <br />
        <br />
        <div>
            <span>Direccion<span class="asterisco">*</span></span>
        </div>
        <div style="width:75.2%;">
            <input name="direccion" id="direccion" style="width:100%" />
        </div>
        <br />
        <br />
        <div>
            <span>Barrio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
        <div class="div">
            <input type="text" name="barrio" id="barrio" />
        </div>
        <div>
            <span>Departamento<span class="asterisco">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
        <div class="div">
            <select type="text" name="departamento" id="departamento">
                <option>Seleccione...</option>
            </select>
        </div>
        <br />
        <br />
        <div>
            <span>Ciudad<span class="asterisco">*</span></span>
        </div>
        <div class="div">
            <select type="text" name="ciudad" id="ciudad">
                <option>Seleccione...</option>
            </select>
        </div>
        <br />
        <br />
        <br />
        <br />
        <center><span class="titulo">DETALLES</span></center>
        <br />
        <br />
        <span class="titulos">INFORMACION PERSONAL</span>
        <br />
        <div>
            <span>Genero<span class="asterisco">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
        <div class="div">
            <select type="text" name="genero" id="genero">
                <option>Seleccione...</option>
                <option>FEMENINO</option>
                <option>MASCULINO</option>
            </select>
        </div>
        <div>
            <span>Fecha de Nacimiento<span class="asterisco">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
        <div class="div">
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" />
        </div>
        <br />
        <br />
        <div>
            <span>Edad</span>
        </div>
        <div class="div">
            <input type="text" name="edad" id="edad" />
        </div>
        <br />
        <br />
        <span class="titulos">ACUDIENTE</span>
        <br />
        <div>
            <span>Acudiente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <br />
            <br />
        </div>
        <div class="div">
            <input type="text" name="acudiente" id="acudiente" />
            <br />
            <br />
        </div>
        <div>
            <span>Telefono del Acudiente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <br />
            <br />
        </div>
        <div class="div">
            <input type="text" name="telefono_acudiente" id="telefono_acudiente" />
            <br />
            <br />
        </div>
        <br />
        <br />
        <br />
        <br />
        <center><span class="titulo">INFORMACION DE TRATAMIENTO</span></center>
        <br />
        <br />
        <table width="100%;">
            <tr>
                <td class="tit">
                    <span>Producto<span class="asterisco">*</span></span>
                    <br />
                    <br />
                </td>
                <td style="width:30%;">
                    <select type="text" name="producto_tratamiento" id="producto_tratamiento">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td class="tit">
                    <span>Clasificacion Patologica</span>
                    <br />
                    <br />
                </td>
                <td style="width:30%;">
                    <select type="text" name="clasificacion_patologica" id="clasificacion_patologica">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td style="width:6.5%;">
                </td>
            </tr>
            <tr>
                <td>
                    <span>Tratamiento Previo</span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="tratamiento_previo" id="tratamiento_previo">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                    <span>Consentimiento<span class="asterisco">*</span></span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="consentimiento" id="consentimiento">
                        <option>Seleccione...</option>
                        <option>SI</option>
                        <option>NO</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Fecha Inicio Terapia</span>
                    <br />
                    <br />
                </td>
                <td>
                    <input type="date" name="fecha_inicio_trt" id="fecha_inicio_trt" />
                    <br />
                    <br />
                </td>
                <td>
                    <span>Regimen<span class="asterisco">*</span></span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="regimen" id="regimen">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Asegurador<span class="asterisco">*</span></span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="asegurador" id="asegurador">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                    <span>Operador Logistico</span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="operador_logistico" id="operador_logistico">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Fecha Ultima Reclamacion</span>
                    <br />
                    <br />
                </td>
                <td>
                    <input type="date" name="fecha_ultima_reclamacion" id="fecha_ultima_reclamacion" />
                    <br />
                    <br />
                </td>
                <td>
                    <br />
                    <br />
                </td>
                <td>
                    <br />
                    <br />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Otros Operadores</span>
                    <br />
                    <br />
                </td>
                <td colspan="4">
                    <input type="text" name="otro_operadores" id="otro_operadores" style="width:90.5%;" />
                    <br />
                    <br />
                </td>
            </tr>
            <tr>
                <td>
                    <span>Medios de Adquisicion</span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="medio_adquision" id="medio_adquision">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                    <span>Ips que Atiende</span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="ips_atiende" id="ips_atiende">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Medico</span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="medico" id="medico">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                    <span>Especialidad</span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="especialidad" id="especialidad">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Paramedico &oacute; Representante</span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="paramedico_representante" id="paramedico_representante">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                    <span>Zona Atencion Paramedico &oacute; Representacnte</span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="zona_atencion" id="zona_atencion">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Ciudad Base Paramedico &oacute; Representante</span>
                    <br />
                    <br />
                </td>
                <td>
                    <select type="text" name="ciudad_base" id="ciudad_base">
                        <option>Seleccione...</option>
                    </select>
                    <br />
                    <br />
                </td>
                <td>
                    <br />
                    <br />
                </td>
                <td>
                    <br />
                    <br />
                </td>
                <td>
                </td>
            </tr>
        </table>
        <br />
        <span class="titulos">NOTAS Y ADJUNTOS</span>
        <br />
        <br />
        <div style="width:91.4%;">
            <textarea name="nota" id="nota" style="width:100%; height:100px" title="Escriba una Nota" placeholder="Escriba una Nota"></textarea>
        </div>
        <br />
        <br />
        <center>
            <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
        </center>
    </form>
    <script type="text/javascript">
        var Accordion1 = new Spry.Widget.Accordion("Accordion1");
    </script>
</body>

</html>