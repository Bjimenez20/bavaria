<?php
//  $servidor = "localhost";
//  $usuario = "root";
//  $password = "";
//  $basepaciente = "apppeopl_ipsen";

$servidor = "app-peoplemarketing.ckkjycussdkq.us-east-1.rds.amazonaws.com";
$usuario = "apppeopl";
$password = "ser1_pE0p1E*2018";
$basepaciente = "apppeopl_ipsen";

$conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
$conex->set_charset('utf8mb4');
mysqli_select_db($conex, $basepaciente) or die("No se Puede conectar a la base de Datos");
