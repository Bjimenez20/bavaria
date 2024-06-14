<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="../presentacion/css/estilos_menu.css" />
   <link type="text/css" rel="stylesheet" href="../presentacion/css/estilo_form_paciente.css" />
   <title>Documento sin título</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style type="text/css">
   @import url("GothamRnd_book/stylesheet.css");

   .centro {
      text-align: center;
   }

   body {
      background: url('../layouts/img/background.png');
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
   }

   .fuente {
      font-family: Tahoma, Geneva, sans-serif;
   }

   .error {
      font-family: GothamRnd-book;
      color: #C30;
   }

   .aviso3 {
      font-size: 130%;
      font-weight: bold;
      color: #11a9e3;
      text-transform: uppercase;
      font-family: Tahoma, Geneva, sans-serif;
      background-color: transparent;
      text-align: center;
      padding: 10px;
   }

   .error {
      font-size: 130%;
      font-weight: bold;
      color: #E30613;
      text-transform: uppercase;
      background-color: transparent;
      text-align: center;
      padding: 10px;
   }
</style>

<body>
   <?php
   $USUARIO = $_SESSION["usuarios"];
   require('../datos/conex.php');
   function validar_clave($clave, &$error_clave)
   {
      if (strlen($clave) < 8) {
         $error_clave = "La clave debe tener al menos 8 caracteres";
         return false;
      }
      if (strlen($clave) > 16) {
         $error_clave = "La clave no puede tener más de 16 caracteres";
         return false;
      }
      if (!preg_match('`[a-z]`', $clave)) {
         $error_clave = "La clave debe tener al menos una letra minúscula";
         return false;
      }
      if (!preg_match('`[A-Z]`', $clave)) {
         $error_clave = "La clave debe tener al menos una letra mayúscula";
         return false;
      }
      if (!preg_match('`[0-9]`', $clave)) {
         $error_clave = "La clave debe tener al menos un caracter numérico";
         return false;
      }
      $error_clave = "";
      return true;
   }
   ?>
   <div class="row m-0">
      <div class="col-md-6 col-lg-5 col-sm-10 col-xs-10 mx-auto m-5">
         <form id="inicio" action="../presentacion/form_restablecer_clave.php" method="POST" style="width:100%;">
            <div class="row-reverse my-5">
               <div class="col d-flex justify-content-center align-items-center mb-3">
                  <img src="../presentacion/layouts/img/3.png" alt="" class="w-50">
               </div>
               <div class="col-10 mx-auto mb-4">
                  <div class="input-group mb-4">
                     <input id="Contrasena_ac" name="Contrasena_ac" type="password" required="required" class="form-control" placeholder="Contraseña actual">
                  </div>
               </div>
               <div class="col-10 mx-auto mb-4">
                  <div class="input-group mb-4">
                     <input id="Contrasena_nu" name="Contrasena_nu" type="password" required="required" class="form-control" placeholder="Contraseña nueva">
                  </div>
               </div>
               <div class="col-10 mx-auto mb-4">
                  <div class="input-group mb-4">
                     <input id="Contrasena_va" name="Contrasena_va" type="password" required="required" class="form-control" placeholder="Confirmar contraseña">
                  </div>
               </div>
            </div>
            <center>
               <input id="InicioR" name="InicioR" type="submit" value="INICIAR SESION" class="btn_continuar" />
            </center>
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
                     echo '<script type="text/javascript">';
                     echo ' alert("Las contraseñas no coinciden")';  //not showing an alert box.
                     echo '</script>';
                  }
               } else {
                  echo '<script type="text/javascript">';
                  echo " alert('$error_encontrado')";  //not showing an alert box.
                  echo '</script>';
               }
            }
            ?>
         </form>
      </div>
   </div>
</body>

</html>