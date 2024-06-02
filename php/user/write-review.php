<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

// Start the session
session_start();

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
    $comment = isset($postData["comment"]) ? $postData["comment"] : null;
    $order_item_id_fk = isset($postData["order_item_id_fk"]) ? $postData["order_item_id_fk"] : null;
 
    $product_id_fk = isset($postData["product_id_fk"]) ? $postData["product_id_fk"] : null;
    $rating = isset($postData["rating"]) ? $postData["rating"] : null;

    $customer_id_fk = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'][0] : null;

    // Check if all required fields are provided
    if (!$comment || !$order_item_id_fk || !$customer_id_fk || !$product_id_fk || !$rating) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Insert the review into the product_review table
    $insertSql = "INSERT INTO product_review (comment, order_item_id_fk, customer_id_fk , product_id_fk,rating) VALUES (?, ?, ? ,?,?)";
    $statement = $conn->prepare($insertSql);
    $statement->bind_param("siiii", $comment, $order_item_id_fk, $customer_id_fk, $product_id_fk, $rating);
    $statement->execute();

    // Check if the insertion was successful
    if ($statement->affected_rows > 0) {
        // Review added successfully
        echo json_encode(["success" => true, "message" => "Review added successfully"]);
    } else {
        // Failed to add review
        echo json_encode(["error" => "Failed to add review"]);
    }
}
