<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

// Load the DOCX template
$templateProcessor = new TemplateProcessor('template.docx');

// Debug: Check if template loads properly
if (!$templateProcessor) {
    die("Error: Could not load template.");
}

// Define dynamic variables
$name = "BILASH KUMAR MONDOL";
$date = date('d-M-Y');
$amount = "1000 USD";

// Replace placeholders with actual values
$templateProcessor->setValue('name', $name);
$templateProcessor->setValue('date', $date);
$templateProcessor->setValue('amount', $amount);

// Save the modified DOCX file
$outputFile = 'output.docx';
$templateProcessor->saveAs($outputFile);

echo "Document generated successfully: <a href='$outputFile'>Download Here</a>";

// Debug: Show replacements
echo "<br>Replacements Done: <br>";
echo "Name: $name <br>";
echo "Date: $date <br>";
echo "Amount: $amount <br>";










?>
