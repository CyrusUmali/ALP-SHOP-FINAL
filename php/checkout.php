<?php

// Include database connection
include './conn.php'; // Assuming this file contains your database connection

// Start the session
session_start();

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve raw POST data and decode JSON
    $data = file_get_contents("php://input");
    $postData = json_decode($data, true);

    // Output the received POST data for debugging
    error_log("Received POST data: " . print_r($postData, true));

    // Retrieve cart data and user information from session
    $customer_id = isset($_SESSION['userInfo'][0]['customer_id']) ? intval($_SESSION['userInfo'][0]['customer_id']) : null;
    $totalPrice = isset($_SESSION['combinedCartData']['realTotalPrice']) ? floatval($_SESSION['combinedCartData']['realTotalPrice']) : null;
    $items = isset($_SESSION['combinedCartData']['cartDetails']) ? $_SESSION['combinedCartData']['cartDetails'] : null;
    $shipment_id_fk = isset($postData["shipment_id_fk"]) ? intval($postData["shipment_id_fk"]) : null; // This comes from the POST request
    $order_date = date("Y-m-d H:i:s"); // Current date and time
    $ord_status = 'Pending'; // Default value for ord_status

    // Validate required fields
    if (!$customer_id || !$totalPrice || !$items || !$shipment_id_fk) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Insert order into the database
    $conn->begin_transaction();

    try {
        $insertOrderSql = "INSERT INTO `order` (total_price, customer_id_fk, shipment_id_fk, order_date, ord_status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertOrderSql);
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("diiss", $totalPrice, $customer_id, $shipment_id_fk, $order_date, $ord_status);
        $stmt->execute();

        // Check if order insertion was successful
        if ($stmt->affected_rows > 0) {
            $orderId = $stmt->insert_id; // Retrieve the auto-generated order ID

            // Insert each item into `order_item` table
            $insertOrderItemSql = "INSERT INTO `order_item` (quantity, price, product_id_fk, variation_id_fk, order_id_fk) VALUES (?, ?, ?, ?, ?)";
            $itemStmt = $conn->prepare($insertOrderItemSql);
            if (!$itemStmt) {
                throw new Exception($conn->error);
            }

            foreach ($items as $item) {
                $quantity = intval($item["quantity"]);
                $price = floatval($item["price"]);
                $product_id = intval($item["product_id"]);
                $variation_id = intval($item["variation_id"]);
                $itemStmt->bind_param("iiiii", $quantity, $price, $product_id, $variation_id, $orderId);
                $itemStmt->execute();
                if ($itemStmt->affected_rows === 0) {
                    throw new Exception("Failed to insert order item: " . json_encode($item));
                }
            }

            // Commit the transaction
            $conn->commit();

            // Unset the session data after successful order placement
            unset($_SESSION['combinedCartData']);

            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Order placed successfully"]);
        } else {
            throw new Exception("Failed to insert order");
        }
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        error_log("Order placement failed: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(["error" => "Error placing order: " . $e->getMessage()]);
    } finally {
        // Close statement and connection
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($itemStmt)) {
            $itemStmt->close();
        }
        $conn->close();
    }
}
?>
