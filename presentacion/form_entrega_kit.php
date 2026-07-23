<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
  <link rel="stylesheet" href="../css/estilos_menu.css" />
  <title>BAVARIA</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <style>
    .izq {
      text-align: left;
    }

    .der {
      text-align: right;
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
    <br><br><br><br>
    <div style="width:100%; background-color:#2797d3; height:80%"></div>
    <table width="100%">
      <tr>
        <td style="background-color:#2797d3;text-align:center">
          <span style="color:#FFF;  font-size: 25px;">ENTREGA KIT</span>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
      <tr>
        <th height="50" class="izq">NOMBRE DE USUARIO</th>
        <th colspan="2" class="izq"><input name="Nombre2" type="text" required="required" id="Nombre15" size="50" /></th>
        <th class="izq">&nbsp;</th>
      </tr>
      <tr>
        <th height="50" class="izq">NO DOCUMENTO</th>
        <th class="izq"><input id="Nombre14" name="Nombre2" type="text" required="required" /></th>
        <th class="izq">DEPARTAMENTO</th>
        <th class="izq"><input id="Nombre14" name="Nombre2" type="text" required="required" /></th>
      </tr>
      <tr>
        <th height="50" class="izq">TELEFONO</th>
        <th class="izq"><input id="Nombre13" name="Nombre2" type="text" required="required" /></th>
        <th class="izq">CIUDAD</th>
        <th class="izq"><input id="Nombre13" name="Nombre2" type="text" required="required" /></th>
      </tr>
      <tr>
        <th height="50" class="izq">CORREO</th>
        <th class="izq"><input id="Nombre12" name="Nombre2" type="text" required="required" /></th>
        <th class="izq">MEDIO DE CONTACTO</th>
        <th class="izq"><input id="Nombre12" name="Nombre2" type="text" required="required" /></th>
      </tr>
      <tr>
        <th height="50" class="izq">DIRECCION</th>
        <th class="izq"><input id="Nombre11" name="Nombre2" type="text" required="required" /></th>
        <th class="izq">SE LOGRO LA COMUNICACION</th>
        <th class="izq"><input id="Nombre11" name="Nombre2" type="text" required="required" /></th>
      </tr>
      <tr>
        <th height="50" class="izq">TIPO DE LLAMADA</th>
        <th class="izq"><input id="Nombre9" name="Nombre2" type="text" required="required" /></th>
        <th class="izq">FECHA DE LA PROXIMA LLAMADA</th>
        <th class="izq"><input id="Nombre10" name="Nombre2" type="text" required="required" /></th>
      </tr>
      <tr>
        <th height="63" class="izq">OBSERVACIONES</th>
        <th height="63" colspan="2" class="izq"><textarea name="Nombre2" cols="70" rows="3" required="required" id="Nombre10"></textarea></th>
        <th height="63" class="izq"></th>
      </tr>
    </table>
  </section>
  <table width="100%">
    <tr>
      <td style="background-color:#2797d3;text-align:center">
        <img src="../presentacion/imagenes/BOTONES_REGISTRAR.PNG" width="120" />
      </td>
    </tr>
  </table>
  <tr>
    <th height="57" colspan="4" class="izq">&nbsp;</th>
  </tr>
  <map name="Map7" id="Map7">
    <area shape="rect" coords="-3,-1,275,78" href="#" />
  </map>
</body>

</html>