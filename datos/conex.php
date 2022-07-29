 <?PHP


// $servidor="app-peoplemarketing.com"; 
// $usuario="apppeopl_bayer"; 
// $password="[h6Ws0^cND]1"; 
// $basepaciente="apppeopl_bayer";

$servidor="localhost"; 
$usuario="root"; 
$password=""; 
$basepaciente="apppeopl_bayer";

//$servidor = "app-peoplemarketing.ckkjycussdkq.us-east-1.rds.amazonaws.com";
//$usuario = "apppeopl";
//$password = "ser1_pE0p1E*2018";
//$basepaciente = "apppeopl_bayer";
$conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
mysqli_select_db($conex,$basepaciente) or die("No se Puede conectar a la base de Datos");	
	//$tildes = mysql_query("SET NAMES 'utf8'");  //Para que se muestren las tildes correctamente
 // $conex = mysql_connect("localhost","wwwpeop_people","Msg4QKKMR52T")or die("no se pudo conectar");
   //        mysql_select_db("wwwpeop_peoplemarketing",$conex)or die("no se puede conectar a la base de datos"); 
//  $conex = mysql_connect("127.0.0.1","root","")or die("no se pudo conectar");
  //         mysql_select_db("base_saizen",$conex)or die("no se puede conectar a la base de datos");		    


//phpinfo()

/* AMAZON SSL
$user = "apppeopl";
$pass =  "ser1_pE0p1E*2018";
$ca_cert = "us-east-1-bundle.pem";
$rds_host = "app-peoplemarketing.ckkjycussdkq.us-east-1.rds.amazonaws.com";
$baseinvent="apppeopl_bayer";
$conex = mysqli_init();
if (!$conex) {
    die('mysqli_init failed');
}
$conex->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
$conex->ssl_set(NULL, NULL, "/home/apppeopl/superlikers.panel.app-peoplemarketing.com/bayer/datos/$ca_cert", NULL, NULL);
$conex->real_connect($rds_host, $user, $pass, $baseinvent);
*/

?>