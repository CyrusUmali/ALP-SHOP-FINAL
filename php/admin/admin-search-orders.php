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
        o.order_id,
        o.total_price,
        o.shipment_id_fk,
        DATE_FORMAT(o.order_date, '%Y-%m-%d') AS order_date,
        DATE_FORMAT(o.delivery_date, '%Y-%m-%d') AS delivery_date,
        c.img ,
        o.ord_status,
        CONCAT(c.first_name, ', ', c.last_name) AS customer_name,
        CONCAT(s.city, ', ', s.province) AS shipment_location 
    FROM 
        `$dbname`.`order` AS o
    JOIN 
        `$dbname`.`customer` AS c ON o.customer_id_fk = c.customer_id
    JOIN 
        `$dbname`.`shipment` AS s ON o.shipment_id_fk = s.shipment_id
    WHERE 
        c.first_name LIKE ?
        OR c.last_name LIKE ?
        OR o.order_id = ?
    ORDER BY 
        order_date DESC
    ";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sss", $search_term, $search_term, $search_term);

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
    $orders = $result->fetch_all(MYSQLI_ASSOC);

    // Prepare the response
    $response = [
        "success" => true,
        "orders" => $orders,
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
