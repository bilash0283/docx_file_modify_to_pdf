<?php
if (isset($_POST['convert'])) {
    if (!empty($_FILES['docx_file']['name'])) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $docxFile = $uploadDir . basename($_FILES["docx_file"]["name"]);
        move_uploaded_file($_FILES["docx_file"]["tmp_name"], $docxFile);

        // Set the custom filename
        $customFileName = !empty($_POST['custom_filename']) ? $_POST['custom_filename'] . ".pdf" : "converted.pdf";
        $pdfFile = $uploadDir . $customFileName;

        // Convert DOCX to PDF using LibreOffice
        $command = "libreoffice --headless --convert-to pdf $docxFile --outdir " . $uploadDir;
        shell_exec($command);

        echo "<p class='success'>Conversion completed! <a href='$pdfFile' download>Download PDF</a></p>";
    } else {
        echo "<p class='error'>Please upload a DOCX file.</p>";
    }
}

if (isset($_POST['send_email'])) {
    $to = "recipient@example.com"; // Change this to the recipient's email
    $subject = "Converted PDF File";
    $message = "Please find the attached PDF file.";
    $headers = "From: yourname@example.com"; // Change this to your email

    // Attachment
    $file = "uploads/converted.pdf"; // Assuming the file was converted
    if (file_exists($file)) {
        $content = chunk_split(base64_encode(file_get_contents($file)));
        $separator = md5(time());
        $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$separator\"";
        $body = "--$separator\r\nContent-Type: text/plain; charset=\"utf-8\"\r\n\r\n$message\r\n";
        $body .= "--$separator\r\nContent-Type: application/pdf; name=\"" . basename($file) . "\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment\r\n\r\n$content\r\n--$separator--";

        if (mail($to, $subject, $body, $headers)) {
            echo "<p class='success'>Email sent successfully!</p>";
        } else {
            echo "<p class='error'>Failed to send email.</p>";
        }
    } else {
        echo "<p class='error'>No converted PDF found. Convert the file first.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DOCX to PDF Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        input, button {
            margin: 10px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #0056b3;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>DOCX to PDF Converter</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="docx_file" accept=".docx" required>
            <input type="text" name="custom_filename" placeholder="Enter PDF name (optional)">
            <button type="submit" name="convert">Convert & Download PDF</button>
            <button type="submit" name="send_email">Send PDF via Email</button>
        </form>
    </div>
</body>
</html>
