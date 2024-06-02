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
    $size = isset($postData["size"]) ? $postData["size"] : null;
    $color = isset($postData["color"]) ? $postData["color"] : null;
    $stock = isset($postData["stock"]) ? $postData["stock"] : null;
    $price = isset($postData["price"]) ? $postData["price"] : null;
    $var_img = isset($postData["var_img"]) ? $postData["var_img"] : null;
    $productIdFk = isset($postData["product_id_fk"]) ? $postData["product_id_fk"] : null;

    // Check if all required fields are provided
    if (!$size || !$color || !$stock || !$price || !$productIdFk) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Prepare and execute INSERT query to add new variant
    $insertQuery = "
        INSERT INTO `$dbname`.variations (size, color, stock, price ,var_img=? , product_id_fk)
        VALUES (?, ?, ?, ?, ? ,?)
    ";

    $insertStatement = $conn->prepare($insertQuery);
    $insertStatement->bind_param("ssidsi", $size, $color, $stock, $price,  $var_img ,$productIdFk);
    $insertStatement->execute();

    // Get the ID of the newly inserted variant
    $newVariantId = $insertStatement->insert_id;

    echo json_encode(["success" => true, "message" => "Variant successfully added", "variant_id" => $newVariantId]);
}
