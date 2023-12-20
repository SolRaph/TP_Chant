<?php

session_start();
use Dompdf\Dompdf;
use Dompdf\Options;

require_once("includes_chant/cobdd.php");


$sql = 'SELECT * FROM `user`';
$query = $db->prepare($sql);
$query->execute();
$controleID = $query->fetch();

ob_start();
require_once("facture.php");
$html = ob_get_contents();
ob_end_clean();


require_once("includes_chant/dompdf/autoload.inc.php");

$options= new Options();
$options->set('align-items-center');

$dompdf = new Dompdf($options);

$dompdf->loadHtml("$html");
$dompdf->setPaper('A4','portrait');

$dompdf->render();
$fichier = 'facture.pdf';
$dompdf->stream($fichier);

?>