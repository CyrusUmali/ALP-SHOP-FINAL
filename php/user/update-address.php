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
    $province = isset($postData["province"]) ? $postData["province"] : null;
    $townOrCity = isset($postData["townOrCity"]) ? $postData["townOrCity"] : null;
    $barangay = isset($postData["barangay"]) ? $postData["barangay"] : null;
    $zipCode = isset($postData["zipCode"]) ? $postData["zipCode"] : null;
    $landmark = isset($postData["landmark"]) ? $postData["landmark"] : null;

    // Check if all required fields are provided
    if (!$customerId || !$province || !$townOrCity || !$barangay || !$zipCode || !$landmark) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Begin transaction
    $conn->begin_transaction();

    // Prepare and execute SQL statement
    $updateQuery = "UPDATE customer SET province=?, 	City=?, Barangay=?, Zip_Code=?, landmark=? WHERE customer_id=?";
    $updateStatement = $conn->prepare($updateQuery);
    $updateStatement->bind_param(
        "sssssi",
        $province,
        $townOrCity,
        $barangay,
        $zipCode,
        $landmark,
        $customerId
    );

    $updateStatement->execute();

    // Check if any rows were affected
    if ($updateStatement->affected_rows > 0) {
        // Commit transaction
        $conn->commit();

        echo json_encode(["success" => true, "message" => "Address successfully updated"]);
    } else {
        // Rollback transaction if no rows were affected
        $conn->rollback();
        echo json_encode(["error" => "Failed to update address", "db_error" => $conn->error]);
    }
}
?>
