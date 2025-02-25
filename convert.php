<?php
require 'vendor/autoload.php';

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

// Example usage
$inputDocx = 'example.docx'; // Path to input DOCX file
$outputPdf = 'output.pdf';    // Path to save output PDF file

convertDocxToPdf($inputDocx, $outputPdf);
echo "Conversion completed successfully!";
?>
