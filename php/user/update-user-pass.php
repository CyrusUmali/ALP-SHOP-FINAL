<?php
// Include database connection
include '../conn.php'; // Assuming this file contains your database connection
// Start the session
session_start();
// Handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the raw POST data
    $data = file_get_contents("php://input");

    // Check if data is empty
    if (empty($data)) {
        http_response_code(400);
        echo json_encode(["error" => "No data received."]);
        exit();
    }

    // Decode JSON data
    $postData = json_decode($data, true);

    // Retrieve specific fields from decoded JSON
    $customerId = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'][0] : null; 
    $currentPassword = isset($postData["current_password"]) ? $postData["current_password"] : null;
    $newPassword = isset($postData["new_password"]) ? $postData["new_password"] : null;
    $confirmPassword = isset($postData["confirm_password"]) ? $postData["confirm_password"] : null;

    // Check if all required fields are provided
    if (!$customerId || !$currentPassword || !$newPassword || !$confirmPassword) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Validate if new password and confirmation match
    if ($newPassword !== $confirmPassword) {
        http_response_code(400);
        echo json_encode(["error" => "New password and confirmation password don't match."]);
        exit();
    }

    // Fetch current hashed password from the database
    $query = "SELECT password FROM customer WHERE customer_id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $customerId);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    $currentPasswordHashFromDB = $row['password'];

    // Verify if the current password matches the one in the database
    if (!password_verify($currentPassword, $currentPasswordHashFromDB)) {
        http_response_code(401);
        echo json_encode(["error" => "Current password is incorrect."]);
        exit();
    }

    // Hash the new password before updating it in the database
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the hashed password in the database
    $updateQuery = "UPDATE customer SET password = ? WHERE customer_id = ?";
    $updateStatement = $conn->prepare($updateQuery);
    $updateStatement->bind_param("si", $newPasswordHash, $customerId);
    $updateStatement->execute();

    // Check if any rows were affected
    if ($updateStatement->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Password updated successfully"]);
    } else {
        echo json_encode(["error" => "Failed to update password"]);
    }
} else {
    // Handle invalid request method
    http_response_code(405);
    echo json_encode(["error" => "Invalid request method"]);
}
?>
