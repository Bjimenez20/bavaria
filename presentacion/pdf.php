<?php
include "../logica/session.php";
include "../datos/conex.php";
include_once "../dompdf/vendor/autoload.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
ob_start();
echo mysqli_error($conex);
include("../logica/consulta_pdf_ea.php");
include "./pdf_evento_adverso.php";
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->render();
$output = $dompdf->output();
file_put_contents('../presentacion/PDF/Evento_Adverso_' . $ID_EVENTO_ADVERSO . '.pdf', $output);
include("../presentacion/email/mail.php");
