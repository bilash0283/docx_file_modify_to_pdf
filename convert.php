<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use Mpdf\Mpdf;

// Function to convert DOCX to PDF
function convertDocxToPdf($inputFile, $outputFile)
{
    // Check if DOCX file exists
    if (!file_exists($inputFile)) {
        die("Error: File not found - " . $inputFile);
    }

    // Load DOCX file using PHPWord
    $phpWord = IOFactory::load($inputFile);

    // Initialize mPDF
    $mpdf = new Mpdf();
    
    // Create an HTML Writer for the DOCX file
    $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
    
    // Capture the HTML output of the DOCX file
    ob_start();
    $htmlWriter->save('php://output');
    $htmlContent = ob_get_clean();
    
    // Write HTML content to the PDF
    $mpdf->WriteHTML('<meta charset="UTF-8">');  // Set UTF-8 encoding
    $mpdf->WriteHTML($htmlContent);

    // Save the output as a PDF
    $mpdf->Output($outputFile, \Mpdf\Output\Destination::FILE);
}

// Usage example
$inputDocx = 'output.docx';  // Path to your DOCX file
$outputPdf = 'fainal_output.pdf';  // Path to output PDF file

// Convert DOCX to PDF
convertDocxToPdf($inputDocx, $outputPdf);

echo "PDF generated successfully: <a href='$outputPdf'>Download PDF</a>";
?>
