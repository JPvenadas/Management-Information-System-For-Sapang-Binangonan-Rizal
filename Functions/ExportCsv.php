<?php
// define header row
$headers = array('First Name', 'Middle Name', 'Last Name', 'Name Extension', 'Birth Date', 'Purok', 'Exact Address', 'voterStatus', 'Sex', 'Marital Status', 'Occupation', 'Family Head (Yes/No)', 'Contact No', 'Number of Family members (Optional)');

// create blank csv file with headers
$filename = 'residents.csv';
$fp = fopen('residents.csv', 'w');

// check if file was created successfully
if (!$fp) {
    echo 'Unable to create file!';
    exit;
}

// set file permissions
chmod($filename, 0644);

// write headers to file
fputcsv($fp, $headers);
fclose($fp);

// set the file path and name for downloading
$file = $filename;

// prompt download window
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
header('Content-Length: ' . filesize($file));
readfile($file);
exit;
?>