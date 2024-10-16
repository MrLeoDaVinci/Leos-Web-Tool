<?php
// Check if the file index is set in the query string
$fileIndex = isset($_GET['index']) ? intval($_GET['index']) : 1;

// Set the content type and headers to trigger a download for each file
header('Content-Type: text/plain');

// Set the filename
$filename = 'testing_' . $fileIndex . '.mp4'; // Corrected filename concatenation
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Read the contents of the source file
$sourceFile = 'hello.txt'; // Adjust the filename as needed
$fileContents = file_get_contents($sourceFile);

// Output the file contents for download
echo $fileContents;
?>

