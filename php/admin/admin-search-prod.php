<?php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve raw POST data
    $data = file_get_contents("php://input");

    // Decode JSON data
    $postData = json_decode($data, true);

    // Retrieve search term from decoded JSON
    $search_term = isset($postData["search_term"]) ? '%' . $postData["search_term"] . '%' : '';

    // Include database connection
    include '../conn.php'; // Assuming this file contains your database connection

    // Define database name
    $dbname = 'alp-shop';

    // Prepare the debug information
    $debug_info = [
        "received_search_term" => $search_term
    ];

    // Prepare the SQL query
    $sql = "
    SELECT 
        p.*,
        v.price AS variation_price,
        v.stock AS variation_stock
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
    WHERE 
        p.name LIKE ?
        OR p.description LIKE ?
    ORDER BY 
        p.timestamp DESC
    ";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ss", $search_term, $search_term);

    // Execute the query
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result === false) {
        $error = $conn->error;
        $response = [
            "error" => "Error retrieving data from the database: $error",
            "debug_info" => $debug_info
        ];
        echo json_encode($response);
        http_response_code(500);
        exit();
    }

    // Fetch the retrieved data
    $products = $result->fetch_all(MYSQLI_ASSOC);

    // Prepare the response
    $response = [
        "success" => true,
        "products" => $products,
        "debug_info" => $debug_info
    ];

    // Send the response
    echo json_encode($response);
    http_response_code(200);

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Exit from script
    exit();
}

// If the request method is not POST, return an error response
$response = [
    "error" => "Invalid request method. Only POST requests are allowed."
];
echo json_encode($response);
http_response_code(400);

?>
