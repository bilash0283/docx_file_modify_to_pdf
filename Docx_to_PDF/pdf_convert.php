<?php 
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;

$phpWord = IOFactory::load('input.docx');

$htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
ob_start();
$htmlWriter->save('php://output');
$html = ob_get_clean();

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
file_put_contents('output.pdf', $dompdf->output());

echo "PDF Created Successfully!";





?>