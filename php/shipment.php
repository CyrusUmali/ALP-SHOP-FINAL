<?php

// Include database connection
include './conn.php';
session_start();

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from request body
    $data = file_get_contents("php://input");
    $postData = json_decode($data, true);

    // Extract data fields
    $shipment_date = date("Y-m-d"); // Assuming shipment_date is today's date
    $address = $postData["address"];
    $city = $postData["city"];
    $province = $postData["province"];
    $zip_code = $postData["zip_code"];
    $Customer_id_fk = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'][0] : null;
    $first_name = $postData["first_name"];
    $last_name = $postData["last_name"];
    $contact = $postData["contact"];

    // Check if all fields are provided
    if (empty($address) || empty($city) || empty($province) || empty($zip_code) || empty($Customer_id_fk) || empty($first_name) || empty($last_name) || empty($contact)) {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Prepare SQL statement
    $sql = "INSERT INTO shipment (shipment_date, address, city, province, zip_code, Customer_id_fk, first_name, last_name, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $shipment_date, $address, $city, $province, $zip_code, $Customer_id_fk, $first_name, $last_name, $contact);

    // Execute the statement
    if ($stmt->execute()) {
        // Data added successfully
        $shipment_id = $stmt->insert_id; // Get the ID of the inserted shipment
        http_response_code(200);
        echo json_encode(["success" => true, "message" => "Data added successfully", "shipment_id" => $shipment_id]);
    } else {
        // Error inserting data into the database
        http_response_code(500);
        echo json_encode(["error" => "Internal Server Error"]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
