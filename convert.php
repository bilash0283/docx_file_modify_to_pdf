<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;

// Load DOCX file
$phpWord = IOFactory::load('output.docx');

// Convert DOCX to HTML
$htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
ob_start();
$htmlWriter->save('php://output');
$html = ob_get_clean();

// Convert HTML to PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output PDF to the browser with "Save As" option
$pdfFileName = 'output.pdf';
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
echo $dompdf->output();

// JavaScript to auto-redirect after download
echo "<script>
    setTimeout(function() {
        window.location.href = 'docx_file_modify.php'; // Change to your previous page
    }, 3000); // Redirect after 3 seconds
</script>";

exit;
?>
