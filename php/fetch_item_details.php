<?php
include './conn.php';

$productId = $_GET['product_id']; // Corrected to use 'product_id'
// Check if "product_id" is set
if (isset($_GET['product_id'])) {


  // SQL query to select the product details along with the price of the first variation
  $productDetailsSql = "
    SELECT 
    p.*,
    v.*,
    i.image_url
  FROM 
    product p
  INNER JOIN 
    variations v ON p.product_id = v.product_id_fk
  LEFT JOIN product_images as i on v.img_id_fk = i.image_id  
  WHERE 
        p.product_id = ?;
    ";

  // SQL query to select product images
  $productImagesSql = "
      SELECT *
      FROM product_images
      WHERE product_id_fk = ?;
    ";

  // Execute the first query to fetch product details
  $productDetailsStmt = $conn->prepare($productDetailsSql);
  $productDetailsStmt->bind_param("i", $productId);
  $productDetailsStmt->execute();
  $productResults = $productDetailsStmt->get_result()->fetch_all(MYSQLI_ASSOC);

  // Execute the second query to fetch product images
  $productImagesStmt = $conn->prepare($productImagesSql);
  $productImagesStmt->bind_param("i", $productId);
  $productImagesStmt->execute();
  $imageResults = $productImagesStmt->get_result()->fetch_all(MYSQLI_ASSOC);

  // Combine product details and images into a single response object
  $itemDetails = [
    'productDetails' => $productResults,
    'productImages' => $imageResults
  ];

  // Send the combined data as response
  header('Content-Type: application/json');
  echo json_encode(['success' => true, 'itemDetails' => $itemDetails]);
} else {
  // Handle case where "product_id" is not provided
  echo json_encode(['success' => false, 'error' => 'Product ID not provided']);
}

// Close connection
$conn->close();
