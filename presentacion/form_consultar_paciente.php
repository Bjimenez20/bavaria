<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
</head>
<body class="body" style="width:75.9%; margin-left:16%;">
    <br />
    <center><span class="titulo">LLAMADA DE TELEFONO</span></center>
    <br />
    <br />
    <div>
        <span>Consecutivo Llamada</span>
    </div>
    <div class="div">
        <input type="text" name="consecutivo_llamada" id="consecutivo_llamada" max="10" />
    </div>
    <div>
        <span>Autor</span>
    </div>
    <div class="div">
        <input type="text" name="autor" id="autor" />
    </div>
    <br />
    <br />
    <div>
        <span>Nombre Cliente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </div>
    <input type="text" name="nombre_cliente" id="nombre_cliente" style="width:79.8%;" />
    <br />
    <br />
    <div>
        <span>Usuario Anonimo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </div>
    <div class="div">
        <input type="text" name="usuario_anonimo" id="usuario_anonimo" max="10" />
    </div>
    <div>
        <span>Telefono Contacto</span>
    </div>
    <div class="div">
        <input type="text" name="telefono_contacto" id="telefono_contacto" />
    </div>
    <br />
    <br />
    <div>
        <span>Direcci&oacute;n</span>
    </div>
    <input type="text" name="direccion" id="direccion" style="width:79.8%;" />
    <br />
    <br />
    <!--LADO IZQUIERDO -->
    <table width="97.5%">
        <tr>
            <td class="tit">
                <span>Departamento</span>
                <br />
                <br />
            </td>
            <td style="width:35%;">
                <select type="text" name="departamento" id="departamento">
                    <option>Seleccione...</option>
                </select>
                <br />
                <br />
            </td>
            <td class="tit">
                <span>Ciudad</span>
                <br />
                <br />
            </td>
            <td style="width:35%;">
                <select type="text" name="ciudad" id="ciudad">
                    <option>Seleccione...</option>
                </select>
                <br />
                <br />
            </td>
        </tr>
        <tr>
            <td>
                <span>Tipo Usuario</span>
                <br />
                <br />
            </td>
            <td>
                <select type="text" name="tipo_usuario" id="tipo_usuario">
                    <option>Seleccione...</option>
                </select>
                <br />
                <br />
            </td>
            <td>
                <span>Producto<span class="asterisco">*</span></span>
                <br />
                <br />
            </td>
            <td>
                <select type="text" name="producto" id="producto">
                    <option>Seleccione...</option>
                </select>
                <br />
                <br />
            </td>
        </tr>
        <tr>
            <td>
                <span>Linea Producto<span class="asterisco">*</span></span>
                <br />
                <br />
            </td>
            <td>
                <input type="text" name="linea_producto" id="linea_producto" />
                <br />
                <br />
            </td>
            <td>
                <span>Via Recepcion<span class="asterisco">*</span></span>
                <br />
                <br />
            </td>
            <td>
                <input type="text" name="via_recepcion" id="via_recepcion" />
                <br />
                <br />
            </td>
        </tr>
        <tr>
            <td>
                <span>Motivo Comunicacion<span class="asterisco">*</span></span>
                <br />
                <br />
            </td>
            <td>
                <input type="text" name="motivo_comunicacion" id="motivo_comunicacion" />
                <br />
                <br />
            </td>
            <td>
                <span>Fecha Programada</span>
                <br />
                <br />
            </td>
            <td>
                <input type="date" name="fecha_programacion" id="fecha_programacion" />
                <br />
                <br />
            </td>
        </tr>
        <tr>
            <td>
                <span>Genera Solicitud<span class="asterisco">*</span></span>
                <br />
                <br />
            </td>
            <td>
                <input type="radio" name="solicitud" id="solicitud" style=" width:20%;" value="SI" />SI
                <input type="radio" name="solicitud" id="solicitud" style=" width:20%;" value="NO" />NO
                <br />
                <br />
            </td>
            <td>
                <span>Pregunta</span>
                <br />
                <br />
            </td>
            <td>
                <select type="text" name="pregunta" id="pregunta">
                    <option>Seleccione...</option>
                </select>
                <br />
                <br />
            </td>
        </tr>
    </table>
    <div style="width:48.8%;">
        <center><span class="titulos">Descripcion de la comunicacion</span></center>
        <br />
        <textarea style="width:91%; height:72.5px;" id="descripcion" name="descripcion"></textarea>
        <br />
        <br />
    </div>
    <div style="width:48.8%;">
        <center><span class="titulos">Seguimiento y cierre a la solicitud</span></center>
        <br />
        <textarea style="width:90.5%; height:72.5px;" id="seguimiento" name="seguimiento"></textarea>
        <br />
        <br />
    </div>
    <center><span class="titulo">COMUNICACION CON PACIENTES</span></center>
    <br />
    <span class="titulos">COMUNICACIONES</span>
    <table width="94%" border="1">
        <tr>
            <td align="left"><span style="margin-right:20px"><input type="checkbox" name="comunicacion_pacientes" id="comunicacion_pacientes" style="width:100%;" /></span></td>
            <td align="center"><span class="titulos">Fecha de Inico</span></td>
            <td align="center"><span class="titulos">Descripcion</span></td>
            <td align="center"><span class="titulos">Propietario</span></td>
            <td align="center"><span class="titulos">Estado de la Actividad</span></td>
        </tr>
        <tr>
            <td align="left"><span style="margin-right:20px"><input type="checkbox" name="comunicacion_pacientes" id="comunicacion_pacientes" style="width:100%;" /></span></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</body>
</html>