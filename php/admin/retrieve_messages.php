<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve raw POST data
    $data = file_get_contents("php://input");

    // Decode JSON data
    $postData = json_decode($data, true);

    // Check if customer ID is provided
    if (isset($postData['customer_id'])) {
        // Sanitize the customer ID
        $customer_id = $postData['customer_id'];

        // Include database connection
        include '../conn.php'; // Assuming this file contains your database connection

        // Prepare the SQL query to retrieve messages for the given customer ID
        $sql = "SELECT * FROM chat WHERE customer_id_fk = ? ORDER BY timestamp ASC";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bind_param("i", $customer_id);

        // Execute the query
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Fetch the retrieved data
        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }

        // Update the state of unread messages to mark them as read
        $sqlUpdate = "UPDATE chat SET is_read = 1 WHERE customer_id_fk = ? AND is_read = 0";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("i", $customer_id);
        $stmtUpdate->execute();
        $stmtUpdate->close();

        // Send the retrieved data as response
        echo json_encode(["success" => true, "messages" => $messages]);
        http_response_code(200);

        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    } else {
        // Return error message if customer ID is not provided
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Customer ID is required"]);
    }
} else {
    // Return error message if request method is not POST
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Method Not Allowed"]);
}
?>
