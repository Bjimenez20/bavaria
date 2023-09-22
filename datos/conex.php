<?php
// $servidor = "localhost";
// $usuario = "ipsen";
// $password = "ipsen";
// $basepaciente = "ipsen_test";

$servidor = "host.docker.internal";
$usuario = "root";
$password = "root";
$basepaciente = "apppeopl_ipsen";

// $servidor = "app-peoplemarketing.ckkjycussdkq.us-east-1.rds.amazonaws.com";
// $usuario = "apppeopl_labs";
// $password = "u@U*5B7tOv3i";
// $basepaciente = "apppeopl_ipsen_test";

$conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
$conex->set_charset('utf8mb4');
mysqli_select_db($conex, $basepaciente) or die("No se Puede conectar a la base de Datos");
