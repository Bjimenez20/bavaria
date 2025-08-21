<?php
include('../logica/session.php')
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="../presentacion/css/estilos_menu.css" />
   <link type="text/css" rel="stylesheet" href="../presentacion/css/estilo_form_paciente.css" />
   <title>IPSEN</title>
   <link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />

   <style>
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background: #f0f0f0;
      }

      .container {
         max-width: 400px;
         margin: 40px auto;
         background: #fff;
         border-radius: 10px;
         overflow: hidden;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }

      .header {
         background-color: #2797d3;
         color: #fff;
         text-align: center;
         padding: 15px;
         font-size: 20px;
         font-weight: bold;
         letter-spacing: 1px;
      }

      form {
         padding: 20px;
      }

      .form-row {
         margin-bottom: 20px;
      }

      .form-group span {
         display: block;
         font-size: 14px;
         font-weight: bold;
         color: #333;
         margin-bottom: 5px;
      }

      .form-group input {
         width: 90%;
         padding: 8px 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         font-size: 14px;
      }

      .footer {
         text-align: center;
         padding: 15px;
      }

      .footer button {
         background: #2797d3;
         color: #fff;
         font-weight: bold;
         font-size: 18px;
         padding: 14px 40px;
         border: none;
         border-radius: 30px;
         cursor: pointer;
         transition: 0.3s;
      }

      .footer button:hover {
         background: #fff;
         color: #2797d3;
         border: 1px solid #2797d3;
      }
   </style>
</head>

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

   if (isset($_POST['InicioR'])) {
      $CONTRASENA_NU = $_POST['Contrasena_nu'];
      $CONTRASENA_VA = $_POST['Contrasena_va'];
      date_default_timezone_set('America/Bogota');
      $CONTRASENA_VENCE = date('Y-m-d  H:i:s', strtotime('+1 month'));
      $error_encontrado = "";

      if (validar_clave($CONTRASENA_NU, $error_encontrado)) {
         if ($CONTRASENA_NU == $CONTRASENA_VA) {
            $sql = mysqli_query($conex, "UPDATE ipsen_usuario SET CONTRASENA = '" . MD5($CONTRASENA_NU) . "',  CONTRASENA_FECHA = '" . $CONTRASENA_VENCE . "' WHERE USER='" . $USUARIO . "';");

            if ($sql) {
               // ✅ Cerrar sesión completa
               session_unset();
               session_destroy();

               echo "
                  <div class='container' style='text-align:center; padding:40px;'>
                     <img src='./imagenes/CHULO.png' width='100' style='margin-bottom:20px;' />
                     <p style='font-size:16px; font-weight:bold; color:#2797d3;'>Ha modificado su contraseña con éxito.</p>
                     <p style='font-size:14px; color:#555;'>Por seguridad, debe volver a iniciar sesión.</p>
                     <button onclick=\"window.top.location.href='../../'\">Iniciar Sesión</button>
                  </div>
               ";
               exit;
            } else {
               echo "<p style='color:red; text-align:center;'>Error al actualizar: " . mysqli_error($conex) . "</p>";
            }
         } else {
            echo "<p style='color:red; text-align:center;'>Las contraseñas no coinciden</p>";
         }
      } else {
         echo "<p style='color:red; text-align:center;'>$error_encontrado</p>";
      }
   }
   ?>

   <div class="container">
      <div class="header">Cambiar Clave</div>
      <form id="inicio" method="POST">
         <div class="form-row">
            <div class="form-group">
               <span>Nueva Contraseña</span>
               <input id="Contrasena_nu" name="Contrasena_nu" type="password" required>
            </div>
         </div>

         <div class="form-row">
            <div class="form-group">
               <span>Confirmar Contraseña</span>
               <input id="Contrasena_va" name="Contrasena_va" type="password" required>
            </div>
         </div>
         <div class="footer">
            <button id="InicioR" name="InicioR" type="submit">MODIFICAR</button>
         </div>
      </form>
   </div>
</body>

</html>