<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

// Define database name
$dbname = 'alp-shop';

// Start the session
session_start();


// Get the ord_status and customer_id_fk values from the request data
$requestData = json_decode(file_get_contents('php://input'), true);
$ord_status = isset($requestData['ord_status']) ? $requestData['ord_status'] : null;
$customer_id_fk = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'][0] : null;

// Prepare the SQL query with or without the WHERE clause based on ord_status value
$sql = "
SELECT o.*, oi.*, p.img, p.name, p.product_id, v.size, v.var_img, v.color , r.* 
FROM `order` AS o
JOIN `order_item` AS oi ON o.order_id = oi.order_id_fk
JOIN `product` AS p ON oi.product_id_fk = p.product_id
LEFT JOIN `product_review` as r on oi.order_item_id = r.order_item_id_fk
JOIN `variations` AS v ON oi.variation_id_fk = v.variation_id
  
";

if ($customer_id_fk !== null) {
    $sql .= " WHERE o.customer_id_fk = '$customer_id_fk'";
}

if ($ord_status !== null && $ord_status !== '*' && $ord_status !== 'all') {
    if ($customer_id_fk !== null) {
        $sql .= " AND ";
    } else {
        $sql .= " WHERE ";
    }
    $sql .= "o.ord_status = '$ord_status'";
}


// Add ORDER BY clause to sort by order_id in descending order
$sql .= " ORDER BY o.order_id DESC";

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
$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

// Send the retrieved data as response
echo json_encode(["success" => true, "orders" => $orders]);
http_response_code(200);

// Close the database connection
$conn->close();

?>
