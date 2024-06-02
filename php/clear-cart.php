<?php

// Include database connection
include './conn.php';

// Start the session
session_start();

// Handle DELETE request
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    // Retrieve user ID from route parameters
    $userId = isset($_SESSION['customer_id'][0]) ? $_SESSION['customer_id'][0] : null;

 
    // Check if userId is provided
    if (!$userId) {
        http_response_code(400);
        echo json_encode(["error" => "User ID is required."]);
        exit();
    }

    // SQL query to delete all cart entries for the user
    $deleteCartEntriesSql = "DELETE FROM cart WHERE customer_id_fk = ?";
    
    // Prepare and execute the SQL query
    $statement = $conn->prepare($deleteCartEntriesSql);
    $statement->bind_param("i", $userId); // Bind parameters
    $statement->execute();

    // Check if any rows were affected
    $affectedRows = $statement->affected_rows;
    if ($affectedRows === 0) {
        http_response_code(404);
        echo json_encode(["error" => "No cart entries found for the user."]);
        exit();
    }

    // Send success response
    http_response_code(200);
    echo json_encode(["success" => true, "message" => "Cart cleared successfully."]);
    exit();
}
?>
