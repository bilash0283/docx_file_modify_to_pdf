<?php
if (isset($_POST['convert'])) {
    $docxFile = "input.docx"; // Your DOCX file
    $pdfFile = "output.pdf"; // Output PDF file

    // Convert DOCX to PDF using LibreOffice
    $command = "libreoffice --headless --convert-to pdf $docxFile --outdir " . dirname($pdfFile);
    shell_exec($command);

    echo "<p>Conversion completed! <a href='$pdfFile' download>Download PDF</a></p>";
}

if (isset($_POST['send_email'])) {
    $to = "recipient@example.com"; 
    $subject = "Converted PDF File";
    $message = "Please find the attached PDF file.";
    $headers = "From: yourname@example.com"; 

    // Attachment
    $file = "output.pdf";
    $content = chunk_split(base64_encode(file_get_contents($file)));

    $separator = md5(time());
    $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$separator\"";
    $body = "--$separator\r\nContent-Type: text/plain; charset=\"utf-8\"\r\n\r\n$message\r\n";
    $body .= "--$separator\r\nContent-Type: application/pdf; name=\"" . basename($file) . "\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment\r\n\r\n$content\r\n--$separator--";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "<p>Email sent successfully!</p>";
    } else {
        echo "<p>Failed to send email.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DOCX to PDF Converter</title>
</head>
<body>
    <form method="post">
        <button type="submit" name="convert">Convert DOCX to PDF</button>
        <button type="submit" name="send_email" style="width:120px;height:40px;background-color:green;border-radius:20px;text-color:white;">Send PDF via Email</button>
    </form>
</body>
</html>
