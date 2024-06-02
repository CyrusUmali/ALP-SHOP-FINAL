<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve raw POST data
    $data = file_get_contents("php://input");

    // Decode JSON data
    $postData = json_decode($data, true);

    // Include database connection
    include '../conn.php'; // Assuming this file contains your database connection

    // Prepare the SQL query with a parameterized statement
    $sql = "SELECT DISTINCT m.customer_id_fk, c.*
            FROM customer AS c
            JOIN (
                SELECT customer_id_fk, MAX(timestamp) AS max_timestamp
                FROM chat
                GROUP BY customer_id_fk
            ) AS m
            ON m.customer_id_fk = c.customer_id
            ORDER BY m.max_timestamp DESC"; 

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Execute the query
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Fetch the retrieved data
    $customer = [];
    while ($row = $result->fetch_assoc()) {
        $customer[] = $row;
    }

    // Send the retrieved data as response
    echo json_encode(["success" => true, "AllCustomer" => $customer]);
    http_response_code(200);

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
