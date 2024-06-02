<?php

// Include database connection
include './conn.php';

// Handle GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve shipment ID from request parameters
    $shipment_id = $_GET["shipment_id"];

    if (!$shipment_id) {
        http_response_code(400);
        echo json_encode(["error" => "shipment_id is required."]);
        exit();
    }

    // SQL query to retrieve order details and shipment information based on shipment ID
    $orderDetailsSql = "
    SELECT `order`.*, shipment.*
    FROM `order`
    JOIN shipment ON `order`.shipment_id_fk = shipment.shipment_id
    WHERE `order`.shipment_id_fk = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($orderDetailsSql);
    $stmt->bind_param("i", $shipment_id);

    // Execute the statement
    $stmt->execute();

    // Get result set
    $result = $stmt->get_result();

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Fetch all rows from the result set
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        // Send the retrieved data as JSON response
        http_response_code(200);
        echo json_encode(["success" => true, "ordersDetails" => $orders]);
    } else {
        // No data found for the specified shipment ID
        http_response_code(404);
        echo json_encode(["error" => "No orders found for the specified shipment ID."]);
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();

?>
