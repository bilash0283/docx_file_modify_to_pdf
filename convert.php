<?php
require 'vendor/autoload.php';  // Ensure you have Composer's autoload file included

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

function convertDocxToPdf($inputDocx, $outputPdf)
{
    // Load DOCX file
    $phpWord = IOFactory::load($inputDocx);
    
    // Create a new PDF instance
    $pdf = new \TCPDF();
    
    // Add a page to the PDF
    $pdf->AddPage();
    
    // Set font for the PDF
    $pdf->SetFont('helvetica', '', 12);
    
    // Loop through the DOCX sections and write content to the PDF
    foreach ($phpWord->getSections() as $section) {
        foreach ($section->getElements() as $element) {
            if (get_class($element) === 'PhpOffice\PhpWord\Element\Text') {
                $pdf->Write(0, $element->getText() . "\n");
            } elseif (get_class($element) === 'PhpOffice\PhpWord\Element\TextRun') {
                foreach ($element->getElements() as $textElement) {
                    $pdf->Write(0, $textElement->getText() . "\n");
                }
            }
        }
    }
    
    // Output PDF to the specified location
    $pdf->Output($outputPdf, 'F');
}

// Check if a file is uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // Get the uploaded DOCX file
    $docxFile = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    
    // Ensure the file is a DOCX file
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    if (strtolower($fileExtension) != 'docx') {
        die("Please upload a valid DOCX file.");
    }

    // Specify the output PDF file name and path
    $outputPdf = 'uploads/' . pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';
    
    // Convert DOCX to PDF
    convertDocxToPdf($docxFile, $outputPdf);
    
    // Provide a link to download the converted PDF file
    echo "Conversion successful! <br>";
    echo "<a href='$outputPdf' download>Click here to download the PDF file</a>";
}
?>
