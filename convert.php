<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use Mpdf\Mpdf;

function convertDocxToPdf($inputFile, $outputFile)
{
    // Load DOCX file
    $phpWord = IOFactory::load($inputFile);

    // Create an HTML writer
    $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
    ob_start();
    $htmlWriter->save('php://output');
    $htmlContent = ob_get_clean();

    // Initialize mPDF
    $mpdf = new Mpdf();

    // Write HTML to PDF
    $mpdf->WriteHTML($htmlContent);
    $mpdf->Output($outputFile, \Mpdf\Output\Destination::FILE);

    return $outputFile;
}

// Usage Example
$inputDocx = 'output.docx'; // Replace with your file path
$outputPdf = 'output.pdf';

convertDocxToPdf($inputDocx, $outputPdf);



echo "PDF successfully created: " . $outputPdf;




?>
