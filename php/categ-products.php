<?php

// Include database connection
include './conn.php'; // Assuming this file contains your database connection

// Check if the 'category' parameter is set
if (!isset($_GET['category'])) {
    echo json_encode(["error" => "Category parameter is missing."]);
    http_response_code(400);
    exit();
}
 
$category = intval($_GET['category']);

// SQL query to select the product details along with the price of the first variation for the given category
$sql = "
    SELECT 
        p.*,
        v.price AS variation_price,
        v.stock AS variation_stock
    FROM 
        product p
    LEFT JOIN 
        (SELECT 
             product_id_fk,
             MIN(price) AS price,
             SUM(stock) AS stock
         FROM 
             variations
         GROUP BY 
             product_id_fk
        ) v ON p.product_id = v.product_id_fk
";

// If category is not 0, add a WHERE clause to filter by category
if ($category !== 0) {
    $sql .= " WHERE p.category_fk = ?";
}

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// If category is not 0, bind the category parameter
if ($category !== 0) {
    $stmt->bind_param("i", $category);
}

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

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
echo json_encode(["success" => true, "category" => $category, "products" => $products]);
http_response_code(200);

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();

?>
