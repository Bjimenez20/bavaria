<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="../presentacion/css/estilos_menu.css" />
   <link type="text/css" rel="stylesheet" href="../presentacion/css/estilo_form_paciente.css" />
   <title>IPSEN</title>
</head>
<style type="text/css">
   @import url("GothamRnd_book/stylesheet.css");

   .centro {
      text-align: center;
   }

   form {
      background: url('../presentacion/imagenes/fondo_nueva_cl.png') top left no-repeat;
   }

   .fuente {
      font-family: Tahoma, Geneva, sans-serif;
   }

   .error {
      font-family: Tahoma, Geneva, sans-serif;
      color: #C30;
   }

   html {
      background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
   }
</style>

<body>
   <?php
   $USUARIO = $_SESSION["usuarios"];
   require('../datos/conex.php');
   function validar_clave($clave, &$error_clave)
   {
      if (strlen($clave) < 8) {
         $error_clave = "<span class=error>La clave debe tener al menos 8 caracteres</span>";
         return false;
      }
      if (strlen($clave) > 16) {
         $error_clave = "<span class=error>La clave no puede tener más de 16 caracteres</span>";
         return false;
      }
      if (!preg_match('`[a-z]`', $clave)) {
         $error_clave = "<span class=error>La clave debe tener al menos una letra minúscula</span>";
         return false;
      }
      if (!preg_match('`[A-Z]`', $clave)) {
         $error_clave = "<span class=error>La clave debe tener al menos una letra mayúscula</span>";
         return false;
      }
      if (!preg_match('`[0-9]`', $clave)) {
         $error_clave = "<span class=error>La clave debe tener al menos un caracter numérico</span>";
         return false;
      }
      $error_clave = "";
      return true;
   }
   ?>
   <center>
      <table width="906" border="0" cellspacing="1" cellpadding="2">
         <tr>
            <th width="275" height="50" scope="row">&nbsp;</th>
            <td width="333">&nbsp;</td>
            <td width="282">&nbsp;</td>
         </tr>
         <tr>
            <th height="268" scope="row">&nbsp;</th>
            <td>
               <form id="inicio" action="../presentacion/form_restablecer_clave.php" method="POST" style="width:100%;" target="info" class="letra">
                  <section style="width:100%; height:100%; padding:0;  text-align:center">
                     <br />
                     <br />
                     <br />
                     <br />
                     <span class="fuente">Contrase&ntilde;a actual &nbsp;&nbsp;</span>
                     <input id="Contrasena_ac" name="Contrasena_ac" type="password" required="required" title="ESCRIBA UNA CONTRASEÑA CORRECTA" />
                     <br />
                     <br />
                     <span class="fuente">Nueva Contrase&ntilde;a &nbsp;&nbsp;</span>
                     <input id="Contrasena_nu" name="Contrasena_nu" type="password" required="required" title="ESCRIBA UNA CONTRASEÑA CORRECTA" />
                     <br />
                     <br />
                     <span class="fuente">Reperir Contrase&ntilde;a </span>
                     <input id="Contrasena_va" name="Contrasena_va" type="password" required="required" title="ESCRIBA UNA CONTRASEÑA CORRECTA" />
                     <br />
                     <br />
                     <?php
                     if (isset($_POST['InicioR'])) {
                        $CONTRASENA_AC = $_POST['Contrasena_ac'];
                        $CONTRASENA_NU = $_POST['Contrasena_nu'];
                        $CONTRASENA_VA = $_POST['Contrasena_va'];
                        $CONTRASENA_VENCE = date('Y-m-d  H:i:s', strtotime('+1 month'));
                        $error_encontrado = "";
                        if (validar_clave($_POST["Contrasena_nu"], $error_encontrado)) {
                           if ($CONTRASENA_NU == $CONTRASENA_VA) {
                              echo "<span class=fuente>CONTRASE&Ntilde;A V&Aacute;LIDA</span>";
                              $sql = mysqli_query($conex, "UPDATE ipsen_usuario SET 
                              CONTRASENA = '" . MD5($CONTRASENA_NU) . "',
                              CONTRASENA_FECHA = '" . $CONTRASENA_VENCE . "'
                              WHERE USER='" . $USUARIO . "';");
                              echo mysqli_error($conex);
                              header("Location: ../");
                              session_unset();
                              session_destroy();
                              exit();
                           } else {
                              echo "<span class=error>Las contrase&ntilde;as no coinciden</span>";
                           }
                        } else {
                           echo "<span class=error>CONTRASE&Ntilde;A NO V&Aacute;LIDA </span>" . $error_encontrado;
                        }
                     }
                     ?>
                     <br />
                     <center>
                        <input id="InicioR" name="InicioR" type="submit" value="INICIAR SESION" class="btn_continuar" />
                        <br />
                        <br />
                     </center>
                  </section>
               </form>
            </td>
            <td>&nbsp;</td>
         </tr>
         <tr>
            <th scope="row">&nbsp;</th>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
      </table>
   </center>
</body>

</html>