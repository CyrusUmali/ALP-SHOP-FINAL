<?php
// Include file containing your database connection
include './conn.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve raw POST data
    $data = file_get_contents("php://input");

    // Decode JSON data
    $postData = json_decode($data, true);

    // Retrieve form data from decoded JSON
    $name = $postData["name"] ?? '';
    $email = $postData["email"] ?? '';
    $phone = $postData["phone"] ?? '';
    $message = $postData["message"] ?? '';

    // Validate form data
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

 

    // Get current date and time
    $date = date("Y-m-d H:i:s");

    // SQL query to insert data into the database
    $sql = "INSERT INTO contactus (name, email, phone, date, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["error" => "Database error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("sssss", $name, $email, $phone, $date, $message);

    if ($stmt->execute()) {
        // Message sent successfully
        http_response_code(200);
        echo json_encode(["success" => true, "message" => "Message sent successfully"]);
    } else {
        // Error sending message
        http_response_code(500); 
        echo json_encode(["error" => "Error sending message"]);
    }

    // Close prepared statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
