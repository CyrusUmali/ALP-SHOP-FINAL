<?php

// Include database connection
include './conn.php'; // Assuming this file contains your database connection

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the raw POST data
    $data = file_get_contents("php://input");

    // Check if data is empty
    if (empty($data)) {
        http_response_code(400);
        echo json_encode(["error" => "No data received."]);
        exit();
    }

    // Decode JSON data
    $postData = json_decode($data, true);

    // Retrieve specific fields from decoded JSON
    $orderId = isset($postData["order_id"]) ? $postData["order_id"] : null;
    $newOrderStatus = isset($postData["ord_status"]) ? $postData["ord_status"] : null;

    // Check if all required fields are provided
    if (!$orderId || !$newOrderStatus) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Begin transaction
    $conn->begin_transaction();

    // Update order status
    $updateQuery = "
    UPDATE `$dbname`.order 
    SET ord_status=?
    WHERE order_id=?
";

    $updateStatement = $conn->prepare($updateQuery);
    $updateStatement->bind_param("si", $newOrderStatus, $orderId);

    $updateStatement->execute();

    // Commit transaction
    $conn->commit();

    echo json_encode(["success" => true, "message" => "Order status successfully updated", "order_id" => $orderId]);
}

?>
