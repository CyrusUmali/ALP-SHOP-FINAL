<?php

// Include database connection
include './conn.php';

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from request body
    $data = file_get_contents("php://input");
    $postData = json_decode($data, true);

    // Extract data fields
    $first_name = $postData["first_name"];
    $last_name = $postData["last_name"];
    $email = $postData["email"];
    $password = $postData["password"];

    // Check if all fields are provided
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $sql = "INSERT INTO customer (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Data added successfully
        http_response_code(200);
        echo json_encode(["success" => true, "message" => "Data added successfully"]);
    } else {
        // Error inserting data into the database
        http_response_code(500);
        echo json_encode(["error" => "Internal Server Error"]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

?>
