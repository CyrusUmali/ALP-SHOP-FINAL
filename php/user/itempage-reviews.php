<?php

// Include database connection
include '../conn.php'; // Assuming this file contains your database connection

// Check if product_id is provided in the request
if (isset($_GET['product_id'])) {
    // Get the product ID from the request
    $product_id = $_GET['product_id'];

    // Prepare SQL query with a WHERE clause to filter by product ID
    $sql = "
        SELECT CONCAT(c.first_name, ' ', c.last_name) AS name, c.img, r.comment ,r.rating
        FROM customer AS c
        JOIN product_review AS r ON c.customer_id = r.customer_id_fk
        JOIN product AS p ON r.product_id_fk = p.product_id
        WHERE p.product_id = ?
    ";

    // Prepare the statement
    $statement = $conn->prepare($sql);

    // Bind the product ID parameter
    $statement->bind_param("i", $product_id);

    // Execute the statement
    $statement->execute();

    // Get the result
    $result = $statement->get_result();

    // Check if the query was successful
    if ($result) {
        // Fetch associative array of the result
        $data = $result->fetch_all(MYSQLI_ASSOC);

        // Return the data as JSON
        echo json_encode($data);
    } else {
        // Query failed
        echo json_encode(["error" => "Failed to retrieve data"]);
    }

    // Close the statement
    $statement->close();
} else {
    // Product ID not provided in the request
    echo json_encode(["error" => "Product ID not provided"]);
}

// Close the connection
$conn->close();

?>
