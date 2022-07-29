<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="img/logo.png" />
  <link rel="stylesheet" href="../css/estilos_menu.css" />
  <title>IPSEN</title>
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
  /*
if($privilegios != 2)
{
  header("location: ../index.php");	
  session_unset();
  session_destroy();
  exit();
}*/
require('../datos/parse_str.php');
  /*URL */
  //$usua = $_SESSION["usuarios"];
  $usua = strtoupper($usua);
  ?>
</head>
<body>
  <section>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
      <tr>
        <th height="77" colspan="4"><img src="../img/BOTON COORDINACION DE KITS.png" width="270" height="74" border="0" /></th>
      </tr>
      <tr>
        <th height="75" colspan="4">
          <?php
          /*if($privilegios == 1)
  {
	 require('menu_admin.php'); 
  }
if($privilegios == 2)
  {
	 require('menu_call.php'); 
  } 	*/
          ?>
        </th>
      </tr>
      <tr>
        <th width="22%" height="37" class="izq">&nbsp;</th>
        <th width="28%">&nbsp;</th>
        <th width="25%" class="izq">&nbsp;</th>
        <th width="25%" class="izq">&nbsp;</th>
      </tr>
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
      <tr>
        <th height="47" colspan="4"><img src="../img/BOTON GUARDAR.png" width="106" height="26" /></th>
      </tr>
      <tr>
        <th height="57" colspan="4" class="izq">&nbsp;</th>
      </tr>
    </table>
  </section>
  <map name="Map7" id="Map7">
    <area shape="rect" coords="-3,-1,275,78" href="#" />
  </map>
</body>
</html>