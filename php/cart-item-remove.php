<?php

// Include database connection
include './conn.php';

// Handle DELETE request
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Retrieve cart_id from request parameters
    $cart_id = $_GET["cart_id"];

    // Check if cart_id is provided
    if (!$cart_id) {
        http_response_code(400);
        echo json_encode(["error" => "Cart ID is required."]);
        exit();
    }

    // SQL query to delete the cart entry based on cart_id
    $deleteCartEntrySql = "
        DELETE FROM cart
        WHERE cart_id = ?
    ";

    // Prepare the SQL statement
    $stmt = $conn->prepare($deleteCartEntrySql);
    $stmt->bind_param("i", $cart_id);
    
    // Execute the statement
    $stmt->execute();

    // Check if any rows were affected
    if ($stmt->affected_rows === 0) {
        http_response_code(404);
        echo json_encode(["error" => "Cart entry not found."]);
    } else {
        http_response_code(200);
        echo json_encode(["success" => true, "message" => "Cart entry removed successfully."]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

?>
