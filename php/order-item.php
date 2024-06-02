<?php

// Include database connection
include './conn.php';

// Handle GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve customer ID from request parameters
    $order_id = $_GET["order_id"];

    if (!$order_id) {
        http_response_code(400);
        echo json_encode(["error" => "order_id is required."]);
        exit();
    }

    // SQL query to retrieve order item details based on order ID
    $orderItemsDetailsSql = "
   
    
    SELECT order_item.*, product.img , product.name , v.var_img
    FROM order_item 
    JOIN product ON order_item.product_id_fk = product.product_id
    join variations as v on order_item.variation_id_fk = v.variation_id
WHERE order_id_fk = ? 
    
    ";



    // Prepare the SQL statement
    $stmt = $conn->prepare($orderItemsDetailsSql);
    $stmt->bind_param("i", $order_id);

    // Execute the statement
    $stmt->execute();

    // Get result set
    $result = $stmt->get_result();

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Fetch all rows from the result set
        $orderItems = [];
        while ($row = $result->fetch_assoc()) {
            $orderItems[] = $row;
        }

        // Send the retrieved data as JSON response
        http_response_code(200);
        echo json_encode(["success" => true, "orderItems" => $orderItems]);
    } else {
        // No data found for the specified order ID
        http_response_code(404);
        echo json_encode(["error" => "No order items found for the specified order ID."]);
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
