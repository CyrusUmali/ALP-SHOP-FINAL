<?php
// Start session
session_start();

// Check if the keys exist in session
if (isset($_SESSION['userInfo'][0])) {
    // Get user information from the nested array
    $userInfo = $_SESSION['userInfo'][0];

    // Set variables for first name, last name, email, phone number, username, and image
    $province = isset($userInfo['province']) ? $userInfo['province'] : 'Province';
    $city = isset($userInfo['City']) ? $userInfo['City'] : 'City';
    $Barangay = isset($userInfo['Barangay']) ? $userInfo['Barangay'] : 'Barangay'; 
    $Zip_Code = isset($userInfo['Zip_Code']) ? $userInfo['Zip_Code'] : 'Zip Code';
    $landmark = isset($userInfo['landmark']) ? $userInfo['landmark'] : 'Landmark';
} else {
    // If userInfo array or its first element doesn't exist, set default values
    $province = 'Province';
    $city = 'City';
    $Barangay = 'Barangay';
    $Zip_Code = 'Zip Code';
    $landmark = 'Landmark';
    
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 


    <style>
        i{
            cursor: pointer;
        }
    </style>




</head>

<body>




    <div class="section">

      
     
        <div class="address-container">
            <h3>My Address</h3>
            <!-- <div class="header">

                <b>
                    Address
                </b>
    
    
            </div> -->
        

            <main>

                <div class="info">

                 
                    <b><?= $landmark ?></b> <br>

                    <label for="">
                    <?= $Barangay ?> ,<?= $city ?>, <?= $province ?> ,<?= $Zip_Code ?>
 
                    </label>

                

                </div>

                <button onclick="editAddressClick()">
                    Edit Address
                </button>

            </main>






        </div>



       

 
   




    </div>




<script src="./js/address.js">

</script>

</body>

</html>