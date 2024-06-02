<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve raw POST data
    $data = file_get_contents("php://input");

    // Decode JSON data
    $postData = json_decode($data, true);

    // Include database connection
    include '../conn.php'; // Assuming this file contains your database connection

    
// Start the session
session_start();

    // Extract data from POST request
    $customer_id_fk = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'][0] : null;
    $message = isset($postData["message"]) ? $postData["message"] : '';
    $sentByAdmin = isset($postData["sentByAdmin"]) ? $postData["sentByAdmin"] : 0;

    // Check if all required fields are provided
    if ($customer_id_fk && $message) {
        // Prepare the SQL query with a parameterized statement
        $sql = "INSERT INTO chat (customer_id_fk, message, sentByAdmin, timestamp) VALUES (?, ?, ?, NOW())";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("isi", $customer_id_fk, $message, $sentByAdmin);

        // Execute the query
        if ($stmt->execute()) {
            // If the query was successful, retrieve the inserted message
            $insertedMessageId = $stmt->insert_id;
            $insertedMessage = [];

            // Retrieve the inserted message from the database
            $selectSql = "SELECT * FROM chat WHERE message_id = ?";
            $selectStmt = $conn->prepare($selectSql);
            $selectStmt->bind_param("i", $insertedMessageId);
            $selectStmt->execute();
            $result = $selectStmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $insertedMessage = $row;
            }

            // Return success response with the inserted message
            echo json_encode(["success" => true, "message" => $insertedMessage]);
            http_response_code(200);
        } else {
            // If the query failed, return error response
            echo json_encode(["success" => false, "error" => "Failed to send message."]);
            http_response_code(500);
        }

        // Close the statements
        $stmt->close();
        $selectStmt->close();
    } else {
        // If any required fields are missing, return error response
        echo json_encode(["success" => false, "error" => "Missing required fields."]);
        http_response_code(400);
    }

    // Close the database connection
    $conn->close();
}

?>
