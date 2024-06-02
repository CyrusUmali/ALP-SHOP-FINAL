<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve raw POST data
    $data = file_get_contents("php://input");

    // Decode JSON data
    $postData = json_decode($data, true);

    // Retrieve search terms from decoded JSON
    $name_search = isset($postData["name_search"]) ? '%' . $postData["name_search"] . '%' : '';

    // Include database connection
    include '../conn.php'; // Assuming this file contains your database connection

    // Prepare the SQL query with a parameterized statement
    $sql = "SELECT * FROM customer WHERE first_name LIKE ? OR last_name LIKE ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("ss", $name_search, $name_search);

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
