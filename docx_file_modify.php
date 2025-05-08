<?php
// vendor file the autoloader file load link
require 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

// Check if form is submitted
if (isset($_POST['btn'])) {
    // Get data from POST
    $name = strtoupper($_POST['name']);
    $country = strtoupper($_POST['country']);
    $company = strtoupper($_POST['company']);
    $address = ucwords(strtolower($_POST['address']));
    $position = strtoupper($_POST['position']);
    $first_date = date("d F Y");

    $date = new DateTime($first_date);
    $date->modify("+2 years"); 
    $endDate = $date->format("d F Y");

    // Load the DOCX template
    try {
        $templateProcessor = new TemplateProcessor('template.docx');

        // Replace placeholders with actual values
        $templateProcessor->setValue('name', $name);
        $templateProcessor->setValue('country', $country);
        $templateProcessor->setValue('start_date', $first_date);
        $templateProcessor->setValue('company', $company);
        $templateProcessor->setValue('address', $address);
        $templateProcessor->setValue('position', $position);
        $templateProcessor->setValue('endDate', $endDate);

        // Save the modified DOCX file
        $outputFile = 'output.docx';
        $templateProcessor->saveAs($outputFile);

        // Provide the download link
        echo "Document generated successfully: <a href='$outputFile' download>Download Here</a> <br> <br>";

        // Debug: Show the replacements
        echo "DEMO DETAILS SHOW FOR CONFIRM YOUR DETAILS <br><br>";
        echo "Docx file modify by This Update Content : - <br>";
        echo "Name: $name <br>";
        echo "Country: $country <br>";
        echo "Agreement Date: $first_date <br>";
        echo "Company Name: $company <br>";
        echo "Company Address: $address <br>";
        echo "Position: $position <br>";
        echo "Expaire Date: $endDate <br>";

    } catch (Exception $e) {
        echo "Error: Could not load the template or save the document. " . $e->getMessage();
    }
}

?>


<a href="convert.php" style="width:12px;height:40px;background-color:green;text-color:white;border-radius:20px;">PDF file convert</a>



