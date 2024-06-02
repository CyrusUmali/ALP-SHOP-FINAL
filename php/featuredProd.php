<?php

// Include database connection
include './conn.php';

// Handle GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // SQL query to select the product details along with the price of the first variation
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
    LIMIT 12";

    // Execute the query
    $result = $conn->query($sql);

    // Check if query was successful
    if ($result) {
        // Fetch all rows from the result set
        $featuredProducts = [];
        while ($row = $result->fetch_assoc()) {
            $featuredProducts[] = $row;
        }
        
        // Send the retrieved data as JSON response
        http_response_code(200);
        echo json_encode(["success" => true, "featuredProducts" => $featuredProducts]);
    } else {
        // Error retrieving data from the database
        http_response_code(500);
        echo json_encode(["error" => "Internal Server Error"]);
    }

    // Close database connection
    $conn->close();
}

?>
