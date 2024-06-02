<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

// Define database name
$dbname = 'alp-shop';

// Get the start and end dates of the current month
$startOfMonth = date('Y-m-01');
$endOfMonth = date('Y-m-t 23:59:59');

// Prepare the SQL query with WHERE clause to filter orders within the current month
$sql = "
    SELECT 
        o.order_id,
        o.total_price,
        o.shipment_id_fk,
        c.img ,
        DATE_FORMAT(o.order_date, '%Y-%m-%d') AS order_date,
        DATE_FORMAT(o.delivery_date, '%Y-%m-%d') AS delivery_date,
        o.ord_status,
        CONCAT(c.first_name, ', ', c.last_name) AS customer_name,
        CONCAT(s.city, ', ', s.province) AS shipment_location
    FROM 
        `$dbname`.`order` AS o
    JOIN 
        `$dbname`.`customer` AS c ON o.customer_id_fk = c.customer_id
    JOIN 
        `$dbname`.`shipment` AS s ON o.shipment_id_fk = s.shipment_id
    WHERE 
        o.order_date >= '$startOfMonth' AND o.order_date <= '$endOfMonth'
        ORDER BY order_date DESC
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
