<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve raw POST data
    $data = file_get_contents("php://input");

    // Decode JSON data
    $postData = json_decode($data, true);

    // Retrieve search terms from decoded JSON
    $search_term_1 = $postData["search_term_1"] ?? '';
    $search_term_2 = $postData["search_term_2"] ?? '';
    $search_term_3 = $postData["search_term_3"] ?? '';

    // Include database connection
    include './conn.php'; // Assuming this file contains your database connection

    // Base SQL query to select the product details along with the price of the first variation
    $sql = "
        SELECT 
            p.*,
            v.price AS variation_price,
            v.stock AS variation_stock
        FROM 
            product p
        LEFT JOIN 
            (SELECT 
                product_id_fk,
                MIN(price) AS price,
                SUM(stock) AS stock
            FROM 
                variations
            GROUP BY 
                product_id_fk
            ) v ON p.product_id = v.product_id_fk
    ";

    // Construct the WHERE clause based on the search terms
    $whereClause = [];
    $params = [];
    $types = '';

    if (!empty($search_term_1)) {
        $whereClause[] = "(p.name LIKE ? OR p.description LIKE ?)";
        $params[] = "%$search_term_1%";
        $params[] = "%$search_term_1%";
        $types .= 'ss';
    }
    if (!empty($search_term_2)) {
        $whereClause[] = "(p.name LIKE ? OR p.description LIKE ?)";
        $params[] = "%$search_term_2%";
        $params[] = "%$search_term_2%";
        $types .= 'ss';
    }
    if (!empty($search_term_3)) {
        $whereClause[] = "(p.name LIKE ? OR p.description LIKE ?)";
        $params[] = "%$search_term_3%";
        $params[] = "%$search_term_3%";
        $types .= 'ss';
    }

    // Add the WHERE clause if search terms are provided
    if (!empty($whereClause)) {
        $sql .= " WHERE " . implode(" OR ", $whereClause);
    }

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to prepare the statement: " . $conn->error]);
        exit();
    }

    // Bind parameters if there are any
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    // Execute the statement
    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(["error" => "Error executing the query: " . $stmt->error]);
        exit();
    }

    // Get the result
    $result = $stmt->get_result();

    // Fetch the retrieved data
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Send the retrieved data as response
    echo json_encode(["success" => true, "AllProducts" => $products]);
    http_response_code(200);

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}

?>
