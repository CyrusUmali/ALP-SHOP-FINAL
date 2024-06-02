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
    $productId = isset($postData["product_id"]) ? $postData["product_id"] : null;
    $name = isset($postData["name"]) ? $postData["name"] : null;
    $description = isset($postData["description"]) ? $postData["description"] : null;
    $category_fk = isset($postData["category_fk"]) ? $postData["category_fk"] : null;
    $previousImages = isset($postData["previousImg"]) ? $postData["previousImg"] : [];
    $newImages = isset($postData["newImg"]) ? $postData["newImg"] : [];

    // Check if all required fields are provided
    if (!$productId || !$name || !$description || !$category_fk) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Begin transaction
    $conn->begin_transaction();

    // Update product details
    $updateQuery = "
        UPDATE `$dbname`.product 
        SET name=?, description=?, category_fk=?
        WHERE product_id=?
    ";
    $updateStatement = $conn->prepare($updateQuery);
    $updateStatement->bind_param("ssii", $name, $description, $category_fk, $productId);
    $updateStatement->execute();

    // Fetch existing images for the product
    $fetchQuery = "SELECT image_id, image_url FROM `$dbname`.product_images WHERE product_id_fk=?";
    $fetchStatement = $conn->prepare($fetchQuery);
    $fetchStatement->bind_param("i", $productId);
    $fetchStatement->execute();
    $result = $fetchStatement->get_result();
    $existingImages = $result->fetch_all(MYSQLI_ASSOC);

    // Delete images not included in the previousImages array
    foreach ($existingImages as $existingImage) {
        $imageId = $existingImage["image_id"];
        $imageUrl = $existingImage["image_url"];
        $found = false;
        foreach ($previousImages as $previousImage) {
            if ($previousImage["image_url"] === $imageUrl) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            // Delete the image from the database
            $deleteQuery = "DELETE FROM `$dbname`.product_images WHERE image_id=?";
            $deleteStatement = $conn->prepare($deleteQuery);
            $deleteStatement->bind_param("i", $imageId);
            $deleteStatement->execute();
        }
    }

// Insert new images
foreach ($newImages as $imageUrl) {
    $imageExists = false;
    // Check if the image URL exists in the previousImg array
    foreach ($previousImages as $previousImage) {
        if ($previousImage["image_url"] === $imageUrl) {
            $imageExists = true;
            break;
        }
    }

    if (!$imageExists) {
        // Image does not exist in previous images, insert it
        $productImageQuery = "
            INSERT INTO `$dbname`.product_images (image_url, product_id_fk)
            VALUES (?, ?)
        ";
        $productImageStatement = $conn->prepare($productImageQuery);
        $productImageStatement->bind_param("si", $imageUrl, $productId);
        $productImageStatement->execute();
    }
}



    // Commit transaction
    $conn->commit();

    echo json_encode(["success" => true, "message" => "Product successfully updated", "product_id" => $productId]);
}

?>
