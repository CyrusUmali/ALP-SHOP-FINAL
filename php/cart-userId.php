<?php

// Include database connection
include './conn.php';

// Start the session
session_start();

// Handle GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve customer ID from session
    $customer_id = isset($_SESSION['customer_id'][0]) ? $_SESSION['customer_id'][0] : null;

    if (!$customer_id) {
        http_response_code(400);
        echo json_encode(["error" => "Customer ID is required in session."]);
        exit();
    }

    // SQL query to retrieve user cart details based on customer ID
    $userCartDetailsSql = "
    SELECT
        p.product_id,
        p.img,
        p.name,
        v.variation_id,
        v.size,
        v.color,
        v.price,
        v.stock,
        c.quantity,
        c.cart_id,
        v.var_img
    FROM
        `$dbname`.product p
    JOIN
        `$dbname`.variations v ON p.product_id = v.product_id_fk
    JOIN
        `$dbname`.cart c ON v.variation_id = c.variation_id_fk
    WHERE
        c.customer_id_fk = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($userCartDetailsSql);
    $stmt->bind_param("i", $customer_id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get result set
    $result = $stmt->get_result();

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Fetch all rows from the result set
        $userCart = [];
        while ($row = $result->fetch_assoc()) {
            $userCart[] = $row;
        }

        // Send the retrieved data as JSON response
        http_response_code(200);
        echo json_encode(["success" => true, "userCart" => $userCart]);
    } else {
        // No data found for the specified customer ID
        http_response_code(200);
        echo json_encode(["success" => true, "userCart" => []]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

?>
