<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

// Start the session
session_start();

// Get the customer_id_fk value from the session
$customer_id_fk = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'][0] : null;


// If customer ID is not present, return empty response
if ($customer_id_fk === null) {
    http_response_code(200); // Or any other appropriate response code
    echo json_encode(["success" => true, "wishlistItems" => [], "message" => "Customer ID not found in session."]);
    exit();
}

// Prepare the SQL query to fetch data from the wishlist table
$sql = "
SELECT w.*, v.*, p.*
FROM wishlist AS w
JOIN variations AS v ON w.variation_id_fk = v.variation_id
JOIN product AS p ON v.product_id_fk = p.product_id
WHERE w.customer_id_fk = $customer_id_fk
";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    $error = $conn->error;
    echo json_encode(["error" => "Error retrieving data from the database: $error"]);
    http_response_code(500);
    exit();
}

// Fetch the retrieved data
$wishlistItems = [];
while ($row = $result->fetch_assoc()) {
    $wishlistItems[] = $row;
}

// If wishlist is empty, return appropriate response
if (empty($wishlistItems)) {
    http_response_code(200);
    echo json_encode(["success" => true, "wishlistItems" => [], "message" => "Wishlist is empty for this customer."]);
    exit();
}

// Send the retrieved data as response
echo json_encode(["success" => true, "wishlistItems" => $wishlistItems]);
http_response_code(200);

// Close the database connection
$conn->close();

?>
