<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

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
        $outputFile = 'output.docx';
        $templateProcessor->saveAs($outputFile);
        
        // Provide the download link
        echo "Document generated successfully: <a href='$outputFile' download>Download Here</a>";

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
