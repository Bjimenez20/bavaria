<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/direccion.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    if (isset($_POST['actualizar'])) {
        require('../datos/conex.php');
        require('../datos/parse_str.php');
        $ID = $erted;
        $valor = $_POST['medico_habilitar'];

        $sql = "SELECT * FROM ipsen_listas WHERE MEDICO = '$valor' AND ESTADO ='IN'";
        $resultado = mysqli_query($conex, $sql);

        // Verificar si el valor existe en la tabla
        if (mysqli_num_rows($resultado) > 0) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>';
            echo '<script>
                    Swal.fire({
                      title: "Error",
                      text: "El valor ya existe en la base de datos",
                      icon: "error",
                      confirmButtonText: "Aceptar"
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "./form_listado_medicos.php";
                      }
                    });
                  </script>';
            $delete = mysqli_query($conex, "DELETE FROM ipsen_listas WHERE ID_LISTA = '" . $ID . "'");
        } else {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>';
            echo '<script>
                    Swal.fire({
                      title: "Datos Registrados",
                      text: "Se registro el medico exitosamente",
                      icon: "success",
                      confirmButtonText: "Aceptar"
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "./form_listado_medicos.php";
                      }
                    });
                  </script>';
            $update = "UPDATE `ipsen_listas` SET `ESTADO`='IN' WHERE ID_LISTA = '" . $ID . "'";
            mysqli_query($conex, $update);
        }
    }
    ?>
    <style>
        body {
            background-color: transparent;
        }

        .aviso3 {
            font-size: 130%;
            font-weight: bold;
            color: #11a9e3;
            text-transform: uppercase;
            background-color: transparent;
            text-align: center;
            padding: 10px;
        }

        .error {
            font-size: 130%;
            font-weight: bold;
            color: red;
            text-transform: uppercase;
            background-color: transparent;
            text-align: center;
            padding: 10px;
        }
    </style>
</body>

</html>