<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;

// Check if form is submitted
if (isset($_POST['btn'])) {
    // Get data from POST
    $name = $_POST['name'];
    $date = $_POST['email'];
    $amount = $_POST['phone'];

    // Load the DOCX template
    try {
        $templateProcessor = new TemplateProcessor('template.docx');
        
        // Replace placeholders with actual values
        $templateProcessor->setValue('name', $name);
        $templateProcessor->setValue('date', $date);
        $templateProcessor->setValue('amount', $amount);
        
        // Save the modified DOCX file
        $outputDocxFile = 'output.docx';
        $templateProcessor->saveAs($outputDocxFile);
        
        // Convert DOCX to PDF using TCPDF
        $pdf = new TCPDF();
        $pdf->AddPage();
        
        // Load DOCX file content
        $phpWord = IOFactory::load($outputDocxFile);
        $text = '';
        
        // Extract text from the DOCX
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) {
                    $text .= $element->getText() . "\n";
                }
            }
        }
        
        // Write the extracted text to the PDF
        $pdf->Write(0, $text);
        
        // Save the PDF to a file
        $outputPdfFile = 'output.pdf';
        $pdf->Output($outputPdfFile, 'F');
        
        // Provide the download link for PDF
        echo "Document generated successfully: <a href='$outputPdfFile' download>Download PDF Here</a>";
        
        // Debug: Show the replacements
        echo "<br>Replacements Done: <br>";
        echo "Name: $name <br>";
        echo "Date: $date <br>";
        echo "Amount: $amount <br>";
        
    } catch (Exception $e) {
        echo "Error: Could not load the template or save the document. " . $e->getMessage();
    }
}
?>
