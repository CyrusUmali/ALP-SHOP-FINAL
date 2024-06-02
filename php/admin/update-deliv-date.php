<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

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
    $deliveryDate = isset($postData["delivery_date"]) ? $postData["delivery_date"] : null;

    // Check if all required fields are provided
    if (!$orderId || !$deliveryDate) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Format delivery date for MySQL
    $formattedDeliveryDate = date('Y-m-d H:i:s', strtotime($deliveryDate));

    // Begin transaction
    $conn->begin_transaction();

    // Update delivery date
    $updateQuery = "
        UPDATE `$dbname`.`order` 
        SET delivery_date=?
        WHERE order_id=?
    ";

    $updateStatement = $conn->prepare($updateQuery);
    $updateStatement->bind_param("si", $formattedDeliveryDate, $orderId);

    $updateStatement->execute();

    // Commit transaction
    $conn->commit();

    echo json_encode(["success" => true, "message" => "Delivery date updated successfully", "order_id" => $orderId]);
}

?>
