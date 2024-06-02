<?php

// Include database connection
include './conn.php'; // Assuming this file contains your database connection

// Define database name
$dbname = 'alp-shop';

// Define a constant to represent the "all" option
define('ALL_CATEGORIES', -1); // You can use any value that doesn't conflict with your actual category IDs

// Get the category value from the request data
$category = isset($_GET['category']) ? $_GET['category'] : null;

// Get the order_type value from the request data
$order_type = isset($_GET['order_type']) ? $_GET['order_type'] : 'DESC'; // Default to DESC


// Check if the category is "all"
if ($category == ALL_CATEGORIES) {
    // If "all" is selected, don't filter by category
    $whereClause = ""; // No WHERE clause needed
} else {
    // If a specific category is selected, filter by that category
    $category = intval($category); // Convert to integer if it's not already
    $whereClause = " WHERE p.category_fk = $category"; // WHERE clause for specific category
}

// SQL query to select the product details along with the price of the first variation
$sql = "
    SELECT 
        p.*,
        v.price AS variation_price,
        v.stock AS variation_stock
    FROM 
        `$dbname`.product p
    LEFT JOIN 
        (SELECT 
             product_id_fk,
             MIN(price) AS price,
             SUM(stock) AS stock
         FROM 
             `$dbname`.variations
         GROUP BY 
             product_id_fk
        ) v ON p.product_id = v.product_id_fk
" . $whereClause; // Append WHERE clause to SQL query



// Order products by timestamp from the product table
$sql .= " ORDER BY p.timestamp $order_type"; // Replace 'timestamp_column' with the actual timestamp column name

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
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Send the retrieved data as response
echo json_encode(["success" => true, "AllProducts" => $products]);
http_response_code(200);

// Close the database connection
$conn->close();
