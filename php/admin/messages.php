<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

 

// SQL query to select the product details along with the price of the first variation
$sql = "
    SELECT 
        *
        
    FROM 
    `$dbname`.contactus
    
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
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Send the retrieved data as response
echo json_encode(["success" => true, "AllMessages" => $products]);
http_response_code(200);

// Close the database connection
$conn->close();

?>
