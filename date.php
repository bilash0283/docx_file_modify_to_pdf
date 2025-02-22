<?php
// Set the static date
$date = '22/02/2025';

// Convert the static date into a DateTime object
$dateObj = DateTime::createFromFormat('d/m/Y', $date);

// Subtract 2 years from the date
$dateObj->modify('-2 years');

// Get the updated date
$updatedDate = $dateObj->format('d/m/Y');

echo "Date 2 years before: " . $updatedDate;
?>
