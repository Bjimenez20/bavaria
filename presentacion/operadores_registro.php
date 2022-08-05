<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
      background-image: url(imagenes/BOTONES_REGISTRAR.png);
      background-repeat: no-repeat;
      width: 152px;
      height: 37px;
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
      background: #A0C054;
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
  require_once("../datos/conex.php");
  $usua = strtoupper($usua);
  ?>
</head>

<body>
  <section>
    <blockquote>
      <form name="miformulario" method="post" action="../logica/insertar_operador.php">
        <table width="95%" border="0" align="center" cellpadding="2" cellspacing="1" style="margin:auto auto;">
          <tr>
            <th colspan="4">
              <strong>REGISTRO EPS / OPL</strong>
            </th>
          </tr>
          <tr>
            <td width="25%"><strong>ASEGURADOR</strong></td>
            <td width="25%" height="44" align="left"><strong>
                <input name="ASEGURADOR" type="text" id="ASEGURADOR" class="tipo1" style="height:20px" required="required" />
              </strong></td>
            <td width="15%"><strong>DEPTO </strong></td>
            <td width="35%"><strong>
                <select type="text" name="DEPTO" id="DEPTO" style="width:90%; height:25px;" required="required">
                  <option value="">Seleccione...</option>
                  <?php
                  $Selecciones = mysqli_query($conex, "SELECT nombre FROM ipsen_departamento ORDER BY nombre ASC");
                  while ($fila2 = mysqli_fetch_array($Selecciones)) {
                    $DEPARTAMENTO = $fila2['nombre'];
                    echo "<option>" . $DEPARTAMENTO . "</option>";
                  }
                  ?>
                </select>
              </strong></td>
          </tr>
          <tr>
            <td><strong>OPERADOR LOGISTICO</strong></td>
            <td width="25%" height="44" align="left"><strong>
                <input name="OPERADOR" type="text" id="OPERADOR" class="tipo1" style="height:20px" required="required" />
              </strong></td>
            <td>&nbsp;</td>
            <td>
            </td>
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
</body>

</html>