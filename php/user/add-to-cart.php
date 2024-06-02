<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

// Start the session
session_start();

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if customer ID is set
    if (!isset($_SESSION['customer_id']) || !$_SESSION['customer_id']) {
       
        echo json_encode(["noId" => true, "message" => "Customer ID not set."]);
        exit();
    }

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
    $customer_id = $_SESSION['customer_id'][0];
    $quantity = isset($postData["quantity"]) ? $postData["quantity"] : null;
    $variation_id = isset($postData["variation_id"]) ? $postData["variation_id"] : null;

    // Check if all required fields are provided
    if (!$quantity || !$variation_id) {
        http_response_code(400);
        echo json_encode(["error" => "Quantity and variation ID are required."]);
        exit();
    }

    // Check if the item already exists in the cart
    $selectSql = "SELECT * FROM cart WHERE customer_id_fk = ? AND variation_id_fk = ?";
    $statement = $conn->prepare($selectSql);
    $statement->bind_param("ii", $customer_id, $variation_id); // Assuming both customer_id_fk and variation_id_fk are integers
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        // Entry already exists, update quantity
        $existingQuantity = $result->fetch_assoc()["quantity"];
        $updatedQuantity = $existingQuantity + $quantity;

        $updateSql = "UPDATE cart SET quantity = ? WHERE customer_id_fk = ? AND variation_id_fk = ?";
        $statement = $conn->prepare($updateSql);
        $statement->bind_param("iii", $updatedQuantity, $customer_id, $variation_id);
        $statement->execute();

        echo json_encode(["success" => true, "message" => "Quantity updated successfully"]);
    } else {
        // Entry doesn't exist, insert new entry
        $insertSql = "INSERT INTO cart (quantity, customer_id_fk, variation_id_fk) VALUES (?, ?, ?)";
        $statement = $conn->prepare($insertSql);
        $statement->bind_param("iii", $quantity, $customer_id, $variation_id);
        $statement->execute();

        echo json_encode(["success" => true, "message" => "Data added successfully"]);
    }
}
?>
