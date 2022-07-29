<?php 


require_once('AttachMailer.php');


$fecha= date("Y-m-d");





$body = "


Buen dia,


<br />


<br />


Ingreso al Programa


<br>


<br>


Terapia: ".$producto_tratamiento."


<br>


<br>


Codigo del Paciente: PAP".$ID_PACIENTE."


<br>


<br>


Ciudad: ".$ciudad."


<br>


<br>


Eps: ".$asegurador."


<br>


<br>


Ips Que Atiende: ".$ips_atiende."


<br>


<br>


Dosis: ".$dosis."


<br>


<br>


Indicacion: ".$clasificacion_patologica."


<br>


<br>


Fecha de ingreso al Programa: ".$fecha_activacion."


<br>


<br>


observacion: ".$nota."


<br>


<br>


Cualquier inquietud con gusto sera atendida.


<br />


<br />


Correo enviado de manera automatica.


<br>


<br>";


$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "andrea.arango@bayer.com, andreanathalie.bulla@bayer.com, coordinacion.bayer@pspsolutions-co.com, coordinacion@encontactopeoplemarketing.com, bjimenez@app-peoplemarketing.com, soporte@peoplecontact.cc", "BAYER PACIENTE NUEVO - ". $producto_tratamiento ." - PAP".$ID_PACIENTE."",$body);


$mailer->send() ? "Enviado": "Problema al enviar";


?>