<?php

include '../conn.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['customer_id']) || !$_SESSION['customer_id']) {
        echo json_encode(["noId" => true, "message" => "Customer ID not set."]);
        exit();
    }
}
?>
