<?php
// Include the PHP script that establishes the database connection
include '../conn.php';

// Get filter parameters from the request data
$requestData = json_decode(file_get_contents('php://input'), true);
 
$stockDataValue = isset($requestData['stockDataValue']) ? $requestData['stockDataValue'] : null;
$minPrice = isset($requestData['minPrice']) ? intval($requestData['minPrice']) : null;
$maxPrice = isset($requestData['maxPrice']) ? intval($requestData['maxPrice']) : null;
$checkedRating = isset($requestData['checkedRating']) ? $requestData['checkedRating'] : null;
$dataValue = isset($requestData['dataValue']) ? $requestData['dataValue'] : null;

// Initialize variable to store the ORDER BY clause
$orderBy = '';
$where = '1 = 1';

// Build the ORDER BY clause based on dataValue
switch ($dataValue) {
    case '1':
        // Order by newest product added based on timestamp
        $orderBy = 'ORDER BY p.timestamp DESC';
        break;
    case '2':
        // Order by oldest product added based on timestamp
        $orderBy = 'ORDER BY p.timestamp ASC';
        break;
    case '3':
        // Order by product name alphabetically (A - Z)
        $orderBy = 'ORDER BY p.name ASC';
        break;
    case '4':
        // Order by product name alphabetically (Z - A)
        $orderBy = 'ORDER BY p.name DESC';
        break;
    case '5':
        // Order by price (Low to High)
        $orderBy = 'ORDER BY v.price ASC';
        break;
    case '6':
        // Order by price (High to Low)
        $orderBy = 'ORDER BY v.price DESC';
        break;
    default:
        // No specific ordering, use default
        break;
}

// Build the WHERE clause based on stockDataValue
switch ($stockDataValue) {
    case '1':
        // Products in stock
        $where .= " AND v.stock > 0";
        break;
    case '2':
        // Products out of stock
        $where .= " AND v.stock = 0";
        break;
    default:
        // All products, no additional condition needed
        break;
}

// Build the WHERE clause based on price range
if ($minPrice !== null && $maxPrice !== null) {
    // Add condition to filter products within the specified price range
    $where .= " AND v.price BETWEEN $minPrice AND $maxPrice";
}

// Build the WHERE clause based on checkedRating
if ($checkedRating !== null && $checkedRating != 0) {
    // Calculate the range for the selected rating
    $minRating = intval($checkedRating);
    $maxRating = $minRating + 1;

    // Add condition to filter products within the specified rating range
    $where .= " AND IFNULL(pr.rating, 0) >= $minRating AND IFNULL(pr.rating, 0) < $maxRating";
}

// Build the SQL query with the generated ORDER BY and WHERE clauses
$sql = "
SELECT 
    p.*,
    v.price AS variation_price,
    v.stock AS variation_stock,
    IFNULL(AVG(pr.rating), 0) AS average_rating
FROM 
    `$dbname`.product p
LEFT JOIN 
    (SELECT 
        product_id_fk,
        MIN(price) AS price,
        SUM(stock) AS stock
    FROM 
        `$dbname`.variations
    GROUP BY 
        product_id_fk
    ) v ON p.product_id = v.product_id_fk
LEFT JOIN 
    `$dbname`.product_review pr ON p.product_id = pr.product_id_fk
WHERE $where";

// Group by product ID to ensure each product appears only once in the result set
$sql .= " GROUP BY p.product_id";

// Add the generated ORDER BY clause to the SQL query
$sql .= " $orderBy";

// Execute the query
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    $error_message = mysqli_error($conn);
    echo json_encode(["error" => "Error retrieving data from the database: $error_message"]);
    http_response_code(500);
    exit;
}

// Fetch data as associative array
$filteredProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Check if any data was fetched
if (empty($filteredProducts)) {
    // No data fetched, send appropriate response
    echo json_encode(["success" => true, "filteredProducts" => []]);
    http_response_code(200);
    exit;
}

// Send the filtered products as response
echo json_encode(["success" => true, "filteredProducts" => $filteredProducts]);
http_response_code(200);

// Close the database connection
$conn->close();
?>
