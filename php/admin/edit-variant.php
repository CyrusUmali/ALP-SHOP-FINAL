<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

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
    $variationId = isset($postData["variation_id"]) ? $postData["variation_id"] : null;
    $size = isset($postData["size"]) ? $postData["size"] : null;
    $color = isset($postData["color"]) ? $postData["color"] : null;
    $stock = isset($postData["stock"]) ? $postData["stock"] : null;
    $price = isset($postData["price"]) ? $postData["price"] : null;
    $var_img = isset($postData["var_img"]) ? $postData["var_img"] : null;
    
    // Check if all required fields are provided
    if ($variationId === null || $size === null ||
     $color === null || $stock === null ||
      $price === null ) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }
    

    // Begin transaction
    $conn->begin_transaction();

    // Update variation details
    $updateQuery = "
    UPDATE `$dbname`.variations 
    SET size=?, color=?, stock=?, price=? ,var_img=?
    WHERE variation_id=?
";

$updateStatement = $conn->prepare($updateQuery);

// Check if the statement was prepared successfully
if (!$updateStatement) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to prepare update statement: " . $conn->error]);
    exit();
}

// Bind parameters to the prepared statement
$updateStatement->bind_param("ssidsi", $size, $color, $stock, $price, $var_img ,  $variationId );

// Execute the update statement
$updateResult = $updateStatement->execute();

// Check if the update was executed successfully
if (!$updateResult) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to execute update statement: " . $updateStatement->error]);
    exit();
}

// If everything is successful, commit the transaction
$conn->commit();

// Return success response
echo json_encode(["success" => true, "message" => "Variation successfully updated", "variation_id" => $variationId]);
}

?>
