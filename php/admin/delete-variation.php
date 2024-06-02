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

    // Retrieve variation ID from decoded JSON
    $variationId = isset($postData["variation_id"]) ? $postData["variation_id"] : null;

    // Check if variation ID is provided
    if (!$variationId) {
        http_response_code(400);
        echo json_encode(["error" => "Variation ID is required."]);
        exit();
    }

    // Begin transaction
    $conn->begin_transaction();

    // Delete variation
    $deleteQuery = "
        DELETE FROM `$dbname`.variations 
        WHERE variation_id=?
    ";

    $deleteStatement = $conn->prepare($deleteQuery);
    $deleteStatement->bind_param("i", $variationId);
    $deleteStatement->execute();

    // Commit transaction
    $conn->commit();

    echo json_encode(["success" => true, "message" => "Variation successfully deleted", "variation_id" => $variationId]);
}

?>
