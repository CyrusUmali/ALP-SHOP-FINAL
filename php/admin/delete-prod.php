<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

// Retrieve the product_id from the request parameters
$productId = $_GET['productId']; // Assuming the productId is passed as a query parameter

// SQL query to delete the product
$deleteProductSql = "
    DELETE FROM `$dbname`.product
    WHERE product_id = ?
";

// Prepare and execute the query to delete the product
$statement = $conn->prepare($deleteProductSql);
$statement->bind_param("i", $productId); // Assuming product_id is an integer
$statement->execute();

// Check for errors
if ($statement->errno) {
    echo json_encode(["error" => "Error deleting product from the database: " . $statement->error]);
    http_response_code(500);
    exit();
}

// Check if any rows were affected
if ($statement->affected_rows === 0) {
    // If no rows were affected, the product with the provided productId does not exist
    echo json_encode(["error" => "Product not found"]);
    http_response_code(404);
    exit();
}

// Product successfully deleted
echo json_encode(["success" => true, "message" => "Product deleted successfully"]);
http_response_code(200);

// Close the prepared statement and database connection
$statement->close();
$conn->close();

?>
