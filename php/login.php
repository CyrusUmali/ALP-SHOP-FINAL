<?php

// Include database connection
include './conn.php';
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
    $checkBoxVal = $postData["checkBoxVal"];

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



    // Validate email and password
    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(["error" => "Email and password are required."]);
        exit();
    }



    // Prepare SQL statement
    $sql = "SELECT * FROM customer WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows === 0) {
        http_response_code(401);
        echo json_encode(["error" => "Invalid email or password."]);
        exit();
    }

    // Fetch user information
    $userInfo = [];
    while ($row = $result->fetch_assoc()) {
        $userInfo[] = $row;
    }


    // Extract hashed password from the retrieved user information
    $hashedPasswordFromDB = $userInfo[0]['password'];

    // Verify the provided password against the hashed password
    if (!password_verify($password, $hashedPasswordFromDB)) {
        http_response_code(401);
        echo json_encode(["error" => "Invalid email or password."]);
        exit();
    }

    // Extract and store customer_id separately
    $customerIds = array_column($userInfo, 'customer_id');

    // User authenticated successfully
    http_response_code(200);

    // Set session variables
    $_SESSION['userInfo'] = $userInfo;
    $_SESSION['customer_id'] = $customerIds;



    // Set cookies if checkbox is checked
    if ($checkBoxVal) {

        // Set email and password in cookies
        setcookie('email', $email, time() + (86400 * 30), "/"); // Cookie lasts for 30 days
        // setcookie('password', $hashedPassword, time() + (86400 * 30), "/"); // Cookie lasts for 30 days
    }


    echo json_encode(["success" => true, "userInfo" => $userInfo, "message" => "User authenticated successfully"]);

    // Close database connection
    $stmt->close();
}

// Close database connection
$conn->close();
