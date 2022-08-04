<?PHP
$servidor = "localhost";
$usuario = "root";
$password = "";
$basepaciente = "ipsen";

$conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
mysqli_select_db($conex, $basepaciente) or die("No se Puede conectar a la base de Datos");
