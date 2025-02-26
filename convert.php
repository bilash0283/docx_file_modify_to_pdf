<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use Mpdf\Mpdf;

// Function to convert DOCX to PDF
function convertDocxToPdf($docxFile, $pdfFile)
{
    // Check if DOCX file exists
    if (!file_exists($docxFile)) {
        die("File not found: $docxFile");
    }

    // Load DOCX File
    $phpWord = IOFactory::load($docxFile);

    // Save the DOCX file as HTML
    $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
    ob_start();
    $htmlWriter->save('php://output');
    $htmlContent = ob_get_clean();

    // Initialize mPDF
    $mpdf = new Mpdf();

    // Ensure UTF-8 Encoding
    $mpdf->WriteHTML('<meta charset="UTF-8">');

    // Write the converted HTML content to PDF
    $mpdf->WriteHTML($htmlContent);

    // Save the PDF
    $mpdf->Output($pdfFile, \Mpdf\Output\Destination::FILE);

    return $pdfFile;
}

// Example Usage
$inputDocx = 'output.docx'; // Your input DOCX file
$outputPdf = 'final_outpu.pdf'; // Output PDF file

// Convert and notify user
if (convertDocxToPdf($inputDocx, $outputPdf)) {
    echo "✅ PDF successfully created: <a href='$outputPdf'>Download PDF</a>";
} else {
    echo "❌ Conversion failed.";
}
?>
