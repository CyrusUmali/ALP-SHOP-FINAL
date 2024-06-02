<?php

// Include database connection
include '../conn.php';
// Start session
session_start();


// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve raw POST data
    $data = file_get_contents("php://input");

    // Decode JSON data
    $postData = json_decode($data, true);

    // Retrieve email and password from decoded JSON
    $email = $postData["email"];
    $password = $postData["password"];



    // Validate email and password
    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(["error" => "Email and password are required."]);
        exit();
    }

    // Prepare SQL statement
    $sql = "SELECT * FROM admin WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows === 0) {
        http_response_code(401);
        echo json_encode(["error" => "Invalid email or password."]);
        exit();
    }

    // Fetch user information
    $adminInfo = [];
    while ($row = $result->fetch_assoc()) {
        $adminInfo[] = $row;
    }

    // User authenticated successfully
    http_response_code(200);

    // Set session variables
    $_SESSION['adminInfo'] = $adminInfo;






    echo json_encode(["success" => true, "adminInfo" => $adminInfo, "message" => "Admin authenticated successfully"]);

    // Close database connection
    $stmt->close();
}

// Close database connection
$conn->close();
