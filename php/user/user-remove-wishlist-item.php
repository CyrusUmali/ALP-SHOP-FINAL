<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

// Get the wishlist_id value from the request data
$requestData = json_decode(file_get_contents('php://input'), true);
$wishlist_id = isset($requestData['wishlist_id']) ? $requestData['wishlist_id'] : null;


// Check if product_id is provided
if ($wishlist_id === null) {
    echo json_encode(["error" => "wishlist_id ID is missing"]);
    http_response_code(400); // Bad Request
    exit();
}

// Prepare the SQL query to delete the record from the wishlist
$sql = "DELETE FROM wishlist WHERE wishlist_id = ?";

// Prepare and bind the parameters
$statement = $conn->prepare($sql);
$statement->bind_param("i", $wishlist_id);

// Execute the query
if ($statement->execute()) {
    echo json_encode(["success" => true, "message" => "Item removed from wishlist successfully"]);
    http_response_code(200);
} else {
    echo json_encode(["error" => "Error removing item from wishlist"]);
    http_response_code(500); // Internal Server Error
}

// Close the database connection
$conn->close();

?>
