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
    $name = isset($postData["name"]) ? $postData["name"] : null;
    $description = isset($postData["description"]) ? $postData["description"] : null;
    $category_fk = isset($postData["category_fk"]) ? $postData["category_fk"] : null;
    $img = isset($postData["img"]) ? $postData["img"] : null;
    $variations = isset($postData["variations"]) ? $postData["variations"] : null;

    // Check if all required fields are provided
    if (!$name || !$description || !$category_fk || !$img || !$variations) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Begin transaction
    $conn->begin_transaction();

    // Extract the first image URL from the img array
    $mainImageUrl = !empty($img) ? $img[0] : null;

    // Insert into `$dbname`.product table
    $productQuery = "
        INSERT INTO `$dbname`.product (name, description, category_fk, img)
        VALUES (?, ?, ?, ?)
    ";
    $productStatement = $conn->prepare($productQuery);
    $productStatement->bind_param("ssis", $name, $description, $category_fk, $mainImageUrl);
    $productStatement->execute();
    $productId = $productStatement->insert_id;

    // Insert main product images into `$dbname`.product_images table
    foreach ($img as $imageUrl) {
        $productImageQuery = "
            INSERT INTO `$dbname`.product_images (image_url, product_id_fk)
            VALUES (?, ?)
        ";
        $productImageStatement = $conn->prepare($productImageQuery);
        $productImageStatement->bind_param("si", $imageUrl, $productId);
        $productImageStatement->execute();
    }

    // Insert variations into `$dbname`.variations table
    foreach ($variations as $variation) {
        $size = $variation["size"];
        $color = $variation["color"];
        $stock = $variation["stock"];
        $price = $variation["price"];
        $varImg = $variation["varImg"];
        
        $variationQuery = "
            INSERT INTO `$dbname`.variations (size, color, stock, price, var_img ,   product_id_fk)
            VALUES (?, ?, ?, ?, ?, ?)
        ";
        $variationStatement = $conn->prepare($variationQuery);
        $variationStatement->bind_param("ssidsi", $size, $color, $stock, $price,  $varImg , $productId );
        $variationStatement->execute();
    }

    // Commit transaction
    $conn->commit();
    echo json_encode(["success" => true, "message" => "Product successfully added", "product_id" => $productId]);
}

?>
