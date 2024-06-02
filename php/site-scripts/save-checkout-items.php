<?php
session_start();

// Get the JSON input from the POST request
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Save the cart data to the PHP session
$_SESSION['combinedCartData'] = $data;

// Respond with a success message
echo json_encode(['status' => 'success', 'message' => 'Cart data saved to session']);
?>
