<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
  <link rel="stylesheet" href="css/estilos_menu.css" />
  <title>BAVARIA</title>
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
  require('../datos/conex.php');
  $usua = strtoupper($usua);
  $select = mysqli_query($conex, "SELECT DOSIS FROM  ipsen_dosis WHERE NOMBRE_REFERENCIA='ADEMPAS' ORDER BY DOSIS ASC");
  echo mysqli_error($conex);
  ?>
</head>

<body>
  <section>
    <blockquote>
      <form name="miformulario" method="post" action="../logica/insertar_envio_muestra.php">
        <table width="95%" border="0" align="center" cellpadding="2" cellspacing="1" style="margin:auto auto;">
          <tr>
            <th colspan="4">
              <strong>ENVIO MUESTRA MEDICA</strong>
            </th>
          </tr>
          <tr>
            <td width="16%"><strong>PAP</strong></td>
            <td width="34%" height="44" align="left"><strong>
                <input name="PAP" type="number" id="PAP" class="tipo1" style="height:20px" required="required" />
              </strong></td>
            <td><strong>ESTATUS PACIENTE </strong></td>
            <td width="31%"><strong>
                <select type="text" name="ESTATUS_PACIENTE" id="ESTATUS_PACIENTE" required="required" style="width:200px; height:25px">
                  <option>Seleccione...</option>
                  <option>Mantenimiento</option>
                  <option>Titulacion</option>
                </select>
              </strong></td>
          </tr>
          <tr>
            <td><strong>DOSIS</strong></td>
            <td width="34%" height="44" align="left"><strong>
                <select type="text" name="DOSIS" id="DOSIS" required="required" style="width:200px; height:25px">
                  <option value="">Seleccione...</option>
                  <?php
                  while ($fila = (mysqli_fetch_array($select))) {
                  ?>
                    <option value="<?php echo $fila['DOSIS'] ?>"><?php echo $fila['DOSIS'] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </strong></td>
            <td><strong>FECHA SALIDA</strong></td>
            <td><span class="titulosth"><strong>
                  <input name="FECHA_SALIDA" type="date" id="FECHA_SALIDA" class="tipo1" style="height:20px" required="required" />
                </strong></span></td>
          </tr>
          <tr>
            <td><strong>No LOTE</strong></td>
            <td height="44" class="titulosth"><strong>
                <input name="NO_LOTE" type="text" id="NO_LOTE" class="tipo1" style="height:20px" required="required" />
              </strong></td>
            <td width="19%"><strong>ESTADO</strong></td>
            <td><strong>
                <select type="text" name="ESTADO" id="ESTADO" required="required" style="width:200px; height:25px">
                  <option>Seleccione...</option>
                  <option>Entrega Medico</option>
                  <option>Entrega Paciente</option>
                  <option>Entrega Bayer</option>
                  <option>Cancelado</option>
                </select>
              </strong></td>
          </tr>
          <tr>
            <td>
              <p><strong>FECHA VENCIMIENTO</strong></p>
            </td>
            <td height="44" class="titulosth"><strong>
                <input name="FECHA_VENC" type="date" id="FECHA_VENC" class="tipo1" style="height:20px" required="required" />
              </strong></td>
            <td width="19%"><strong>OBSERVACION</strong></td>
            <td><strong>
                <textarea name="OBSERVACION" cols="70%" rows="3" required="required" id="OBSERVACION"></textarea>
              </strong></td>
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