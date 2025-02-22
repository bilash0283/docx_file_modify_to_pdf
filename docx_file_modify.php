<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

// Check if form is submitted
if (isset($_POST['btn'])) {
    // Get data from POST
    $name = strtoupper($_POST['name']);
    $country = strtoupper($_POST['country']);
    $start_date = strtoupper($_POST['start_date']);
    $company = strtoupper($_POST['company']);
    $address = ucwords(strtolower($_POST['address']));
    $position = strtoupper($_POST['position']);

    
    $dateObj = DateTime::createFromFormat('d/m/Y', $start_date);
    if ($dateObj === false) {
        echo "Error: Invalid date format. Please ensure the date is in 'dd/mm/yyyy' format.";
        exit;
    }
    $formatted_date = $dateObj->format('Y-m-d');




    // Load the DOCX template
    try {
        $templateProcessor = new TemplateProcessor('template.docx');

        // Replace placeholders with actual values
        $templateProcessor->setValue('name', $name);
        $templateProcessor->setValue('country', $country);
        $templateProcessor->setValue('start_date', $start_date);
        $templateProcessor->setValue('company', $company);
        $templateProcessor->setValue('address', $address);
        $templateProcessor->setValue('position', $position);

        // Save the modified DOCX file
        $outputFile = 'output.docx';
        $templateProcessor->saveAs($outputFile);

        // Provide the download link
        echo "Document generated successfully: <a href='$outputFile' download>Download Here</a> <br> <br>";

        // Debug: Show the replacements
        echo "Docx file modify by This Update Content : - <br>";
        echo "Name: $name <br>";
        echo "Country: $country <br>";
        echo "Agreement Date: $start_date <br>";
        echo "Company Name: $company <br>";
        echo "Company Address: $address <br>";
        echo "Position: $position <br>";
        echo "Position: $formatted_date <br>";

    } catch (Exception $e) {
        echo "Error: Could not load the template or save the document. " . $e->getMessage();
    }
}
?>