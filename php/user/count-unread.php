<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if customer ID is available in the session
    if (isset($_SESSION['customer_id'][0])) {
        // Retrieve the customer ID from the session
        $customer_id = $_SESSION['customer_id'][0];

        // Prepare the SQL query to count unread messages for the given customer ID
        $sql = "SELECT COUNT(*) AS unreadCount FROM chat WHERE customer_id_fk = ? AND is_read = 0";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bind_param("i", $customer_id);

        // Execute the query
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Fetch the retrieved data
        $row = $result->fetch_assoc();
        $unreadCount = $row['unreadCount'];

        // Send the count of unread messages as response
        echo json_encode(["success" => true, "unreadCount" => $unreadCount]);
        http_response_code(200);

        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    } else {
        // Return error message if customer ID is not available in the session
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Customer ID not found in session"]);
    }
} else {
    // Return error message if request method is not POST
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Method Not Allowed"]);
}

?>
