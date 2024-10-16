<?php
if (isset($_POST['ip'])) {
    $userIP = $_POST['ip'];

    // Log the IP address to ipLog.txt
    $ipLogEntry = "IP Address: $userIP - " . date('Y-m-d H:i:s') . "\n";
    file_put_contents("ipLog.txt", $ipLogEntry, FILE_APPEND);
}
?>
