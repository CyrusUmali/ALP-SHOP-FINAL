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
    $username = isset($postData["username"]) ? $postData["username"] : null;
    $firstName = isset($postData["first_name"]) ? $postData["first_name"] : null;
    $lastName = isset($postData["last_name"]) ? $postData["last_name"] : null;
    $phoneNumber = isset($postData["phone_number"]) ? $postData["phone_number"] : null;
    $img = isset($postData["img"]) ? $postData["img"] : null;

    // Cast sex value to integer
    $sex = isset($postData["sex"]) ? (int)$postData["sex"] : null;
    $birthday = isset($postData["birthday"]) ? $postData["birthday"] : null; // New field: Date of Birth

    // Check if all required fields are provided
    if (
        !$customerId 
    ) {
        http_response_code(400);
        echo json_encode(["error" => " customerId ais required."]);
        exit();
    }

    // Convert sex value to lowercase for consistent comparison
    $sex = strtolower($sex);

    // Map numeric sex values to sex names
    switch ($sex) {
        case 0:
            $sexName = "not specified";
            break;
        case 1:
            $sexName = "male";
            break;
        case 2:
            $sexName = "female";
            break; 
        default:
            // Default to "not specified" if the provided value is not recognized
            $sexName = "not specified";
            break;
    }


    // Begin transaction
    $conn->begin_transaction();

    // Prepare and execute SQL statement
    $updateQuery = "UPDATE customer SET username=?, first_name=?,
last_name=?, phone_number=?, img=?, sex=?, birthday=? WHERE customer_id=?";
    $updateStatement = $conn->prepare($updateQuery);
    $updateStatement->bind_param(
        "sssssssi",
        $username,
        $firstName,
        $lastName,
        $phoneNumber,
        $img,
        $sexName,
        $birthday,
        $customerId
    );

    $updateStatement->execute();

    // Check if any rows were affected
    if ($updateStatement->affected_rows > 0) {
        // Fetch updated user information
        $selectQuery = "SELECT * FROM customer WHERE customer_id=?";
        $selectStatement = $conn->prepare($selectQuery);
        $selectStatement->bind_param("i", $customerId);
        $selectStatement->execute();
        $result = $selectStatement->get_result();
        $updatedUserInfo = $result->fetch_assoc();

        // Update session with new user information
        $_SESSION['userInfo'] = $updatedUserInfo;

        // Encode user information as JSON
        $userInfoJson = json_encode($updatedUserInfo);

        // Commit transaction
        $conn->commit();

        echo json_encode(["success" => true, "message" => "User information successfully updated", "customer" => $updatedUserInfo]);
    } else {
        // Rollback transaction if no rows were affected
        $conn->rollback();
        echo json_encode(["error" => "Failed to update user information", "db_error" => $conn->error]);
    }
}
