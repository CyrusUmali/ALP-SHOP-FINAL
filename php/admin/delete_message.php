<?php
// Include database connection
include '../conn.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the raw request body
$requestBody = file_get_contents('php://input');

// Check if the request body is not empty
if (!empty($requestBody)) {
    // Decode the JSON data
    $data = json_decode($requestBody, true);

    // Check if the message_id is provided in the request data
    if (isset($data['message_id'])) {
        $message_id = $data['message_id'];

        // Prepare the SQL query to delete the message
        $sql = "DELETE FROM contactus WHERE message_id = ?";
        $stmt = $conn->prepare($sql);

        // Bind the message_id parameter
        $stmt->bind_param("i", $message_id);

        // Execute the query
        if ($stmt->execute()) {
            // Message deleted successfully
            echo json_encode(['success' => true]);
        } else {
            // Error deleting message
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    } else {
        // message_id not provided
        echo json_encode(['success' => false, 'error' => 'message_id is required']);
    }
} else {
    // Request body is empty
    echo json_encode(['success' => false, 'error' => 'Request body is empty']);
}

// Close the connection
$conn->close();
?>