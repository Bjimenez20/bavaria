<?php
include('../logica/session.php');
?>
<?php
require('../datos/parse_str.php');
require_once("../datos/conex.php");
?>

<body>
    <?php
    $SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_operador_logistico WHERE ESTADO = 'OUT' ORDER BY ID_OPERADOR_LOGISTICO ASC");
    echo mysqli_error($conex);
    $SELECT_USUARIO = "SELECT * FROM bayer_operador_logistico WHERE ESTADO = 'OUT' ORDER BY ID_OPERADOR_LOGISTICO ASC LIMIT";
    ?>