<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="euc-jp">

  <link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
  <link rel="stylesheet" href="css/estilos_menu.css" />
  <title>IPSEN</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <script src="js/jquery.js"></script>
  <script src="../presentacion/js/jquery.js"></script>
  <script>
    var height = window.innerHeight - 2;
    var porh = (height * 80 / 100);
    $(document).ready(function() {
      $('#consulta_inv').css('height', porh);
    });
  </script>
  <style>
    @import url("../../bayer/webfonts/avenir/stylesheet.css");

    .btn_registrar {
      padding-top: 2%;
      background-image: url(imagenes/BOTON_AGREGAR.png);
      background-repeat: no-repeat;
      width: 152px;
      height: 50px;
      color: transparent;
      background-color: transparent;
      border-radius: 5px;
      border: 1px solid transparent;
    }

    .izq {
      text-align: left;
    }

    .der {
      text-align: right;
    }

    th {
      padding: 7px;
      color: #FFF;
      background: #224a81;
      font-family: avenir;
      font-size: 100%;
      font-style: normal;
      line-height: normal;
      font-weight: normal;
      font-variant: normal;
      text-align: center;
      font-family: Tahoma, Geneva, sans-serif;
    }

    td {
      padding: 2px;
      color: #000;
      font-family: avenir;
      font-size: 100%;
      font-style: normal;
      line-height: normal;
      font-weight: normal;
      font-variant: normal;
      text-align: left;
      font-family: Tahoma, Geneva, sans-serif;
    }
  </style>
  <script>
    $(document).ready(function() {
      $('#ver1').click(function() {
        $("#con").fadeIn();
      });
      $('#close').click(function() {
        $("#con").fadeOut();
      });
      $("#salir").click(function() {
        if (confirm('¿Estas seguro de cerrar sesion?')) {
          window.location = "../index.php";
        } else {}
      });
    });
  </script>
  <?php
  require('../datos/parse_str.php');
  $usua = strtoupper($usua);
  ?>
</head>

<body>
  <section>
    <blockquote>
      <form name="miformulario" method="post" action="../logica/insertar_novedad.php">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" style="margin:auto auto;">
          <tr>
            <th colspan="4">
              <strong>REGISTRO NOVEDADES</strong>
            </th>
          </tr>
          <tr>
            <td width="16%"><strong>PAP</strong></td>
            <td width="34%" height="44" align="left"><strong>
                <input name="PAP" type="number" id="PAP" class="tipo1" style="height:20px" />
              </strong></td>
            <td><strong>ASUNTO </strong></td>
            <td width="35%"><strong>
                <input name="ASUNTO" type="text" id="ASUNTO" class="tipo1" style="height:20px" />
              </strong></td>
          </tr>
          <tr>
            <td><strong>PRODUCTO</strong></td>
            <td width="34%" height="44" align="left"><strong>
                <input name="PRODUCTO" type="text" id="PRODUCTO" class="tipo1" style="height:20px" />
              </strong></td>
            <td><strong>NOVEDAD</strong></td>
            <td><strong>
                <select type="text" name="NOVEDAD" id="NOVEDAD" required="required" style="width:200px; height:25px">
                  <option>Seleccione...</option>
                  <option>Falta de medicamento en el punto</option>
                  <option>Solicitud Muestra Medica</option>
                  <option>Consultas medicas</option>
                  <option>Apoyo en Sicologia</option>
                  <option>Recoleccion de residuos</option>
                  <option>Falta de cita medica</option>
                  <option>demora en la autorizacion</option>
                  <option>demora en la autorizacion de CTC</option>
                  <option>Reentrenamiento</option>
                  <option>Visita Paciente</option>
                  <option>Novedades Varios</option>
                </select>
              </strong></td>
          </tr>
          <tr>
            <td><strong>FECHA REPORTE</strong></td>
            <td height="44" class="titulosth"><strong>
                <input name="FECHA_REPORTE" type="date" id="FECHA_REPORTE" class="tipo1" style="height:20px" />
              </strong></td>
            <td width="15%"><strong>OBSERVACIONES </strong></td>
            <td><span class="titulosth"><strong>
                  <textarea name="OBSERVACION" cols="30" class="tipo1" id="OBSERVACION" style="width:auto"></textarea>
                </strong></span></td>
          </tr>
          <tr>
            <td><strong>FECHA RESPUESTA</strong></td>
            <td height="44" class="titulosth"><strong><span>
                  <input name="FECHA_RESPUESTA" type="date" id="FECHA_RESPUESTA" class="tipo1" style="height:20px" />
                </span></strong></td>
            <td width="15%">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th colspan="4">
              <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(paciente_nuevo,1)" />
            </th>
          </tr>
        </table>
      </form>
    </blockquote>
  </section>
  <map name="Map7" id="Map7">
    <area shape="rect" coords="-3,-1,275,78" href="#" />
  </map>
</body>

</html>