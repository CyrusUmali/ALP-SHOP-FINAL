<?php
session_start();

// Check if the keys exist in session
if (isset($_SESSION['userInfo'])) {
    // Keys exist
    // Return a response to indicate that keys exist
    echo 'keysExist';
} else {
    // Return a response to indicate that keys don't exist
    // You can also handle this case accordingly in your JavaScript
    echo 'keysDoNotExist';
}
?>
