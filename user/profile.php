<?php
// Start session
session_start();

// Check if the keys exist in session
if (isset($_SESSION['userInfo'][0])) {
    // Get user information from the nested array
    $userInfo = $_SESSION['userInfo'][0];

    // Set variables for first name, last name, email, phone number, username, and image
    $firstName = isset($userInfo['first_name']) ? $userInfo['first_name'] : '';
    $lastName = isset($userInfo['last_name']) ? $userInfo['last_name'] : '';
    $email = isset($userInfo['email']) ? $userInfo['email'] : '';
    $phone_number = isset($userInfo['phone_number']) ? $userInfo['phone_number'] : '';
    $username = isset($userInfo['username']) ? $userInfo['username'] : '';
    $img = isset($userInfo['img']) ? $userInfo['img'] : 'https://www.bing.com/th?id=OIP.LEpiHvLvT0d7NLn_rC_XNwHaII&w=150&h=164&c=8&rs=1&qlt=90&o=6&dpr=1.6&pid=3.1&rm=2';
    // Set variables for sex and birthday
    $sex = isset($userInfo['sex']) ? $userInfo['sex'] : '';
    $birthday = isset($userInfo['birthday']) ? $userInfo['birthday'] : '';
} else {
    // If userInfo array or its first element doesn't exist, set default values
    $firstName = '';
    $lastName = '';
    $email = '';
    $phone_number = '';
    $username = '';
    $img = 'https://www.bing.com/th?id=OIP.LEpiHvLvT0d7NLn_rC_XNwHaII&w=150&h=164&c=8&rs=1&qlt=90&o=6&dpr=1.6&pid=3.1&rm=2';
    // Set default values for sex and birthday
    $sex = '';
    $birthday = '';
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="../js/add-products.js"></script> -->




    <style>
        #sexSelect {

            background-color: whitesmoke;
            /* border: 1px solid lightgray; */
            border: none;
            color: gray;
            border-radius: 5px;
            padding: 5px 18px;
            width: 200px;

        }
    </style>

</head>

<body>




    <div class="section">


        <div class="profile-container">


            <h3 onclick="testClick(event)">Profile</h3>

            <div class="header">


                <p> Manage and Protect your Account </p>


            </div>


            <main>

                <div class="user-info-container">

                    <div class="form-container">

                        <div class="form-field">

                            <label for="UsernameInput">
                                Username







                            </label>

                            <input type="text" id="UsernameInput" value="<?= $username ?>">


                        </div>

                        <div class="form-field">

                            <label for="FnInput">
                                First Name

                            </label>
                            <!-- <input type="text" id="FnInput" onclick="FNCLICK(event)"> -->
                            <input type="text" id="FnInput" onclick="FNCLICK(event)" value="<?= $firstName ?>">



                        </div>

                        <div class="form-field">

                            <label for="LnInput">Last Name</label>
                            <!-- <input type="text" id="LnInput"> -->
                            <input type="text" id="LnInput" onclick="FNCLICK(event)" value="<?= $lastName ?>">


                        </div>

                        <div class="form-field">

                            <label for="NumberInput">Phone Number</label>

                            <input type="text" id="NumberInput" value="<?= $phone_number ?>">

                        </div>

                        <div class="form-field">

                            <label for="EmailInput">Email</label>

                            <input type="text" id="EmailInput" value="<?= $email ?>">

                        </div>

                        <div class="form-field">

                            <!-- 
               

                             <input type="radio" title="GenderInput1">
                             <input type="radio" title="GenderInput2">
                             <input type="radio" title="GenderInput3"> -->
                            <label for="GenderInput">Gender</label>
                            <select name="" id="sexSelect">
                                <option value="1" <?php if ($sex == 1) echo 'selected'; ?>>Male</option>
                                <option value="2" <?php if ($sex == 2) echo 'selected'; ?>>Female</option>
                            </select>


                            <!-- </div> -->


                        </div>

                        <div class="form-field-date">

                            <label for="GenderInput">Date of Birth</label>

                            <input class="dateInp" type="text" id="dob-day" placeholder="DD" maxlength="2" style="width: 40px;" value="<?= date('d', strtotime($birthday)); ?>">
                            <input class="dateInp" type="text" id="dob-month" placeholder="MM" maxlength="2" style="width: 40px;" value="<?= date('m', strtotime($birthday)); ?>">
                            <input class="dateInp" type="text" id="dob-year" placeholder="YYYY" maxlength="4" style="width: 60px;" value="<?= date('Y', strtotime($birthday)); ?>">



                        </div>

                        <button onclick="changePassClick(event)" class="change-password">Change Password</button>



                    </div>



                </div>

                <div class="user-photo-container">


                    <div class="container">

                        <!-- <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEABsbGxscGx4hIR4qLSgtKj04MzM4PV1CR0JHQl2NWGdYWGdYjX2Xe3N7l33gsJycsOD/2c7Z//////////////8BGxsbGxwbHiEhHiotKC0qPTgzMzg9XUJHQkdCXY1YZ1hYZ1iNfZd7c3uXfeCwnJyw4P/Zztn////////////////CABEIAKQAlgMBIgACEQEDEQH/xAAZAAEAAwEBAAAAAAAAAAAAAAAAAQIDBAX/2gAIAQEAAAAA8MAAESA0WxAAOqWteEAki/Vvt008KgJCJ6enTXHz8QSEotpTWuKBITOTp5ejfkQLBMWt28s1xhBYGNr3pW8CFgc+u18cdQhcGVL2iupBFwVxtLS1SC4M6UT1dGOQi4vHOqt0dHbnwYouvvlllmb9XZfTTg81vforjTDBfq7t7WjXHLKWVcs8zr67ze81jz5K0hbm36dLWVrHFN7BbnvtreKZ4OTa97WLct9r2jPLmpXW176Sct9LxFM+en//xAAUAQEAAAAAAAAAAAAAAAAAAAAA/9oACgICEAMQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//EACoQAAIBAgUDBAEFAAAAAAAAAAABAgMREiEwMUEQE1EEICJxkRRAYYHB/9oACAEBAAE/ANG/7GzFTf8Ap29l5ZOjb7GnHWjnI7TFCQ4SurIjSnIqennFbXLNaj2KXIpiqKxGUHuiEoLaxOSaJr5S+9SWxTuR/lEYwkiMUWp2yeZJtE9TDdP6E3DYc5kakrjrSO/Mh6mW01dFXNqyvfU8Eot7DiRTK1HDCDi90KLfkhRkxPt7b2sn4uPJvTWzX4IybRlyRjdk4XpxMS25O69kRipuTk7KNmx5tvUTaFJ7nca2FXnklJk3ndGN66SkiPbdlLFEwUEk8c5MnHl/0jZi21akeSI5SIuRNtss3LIw4ctWRsxMxF0U1ySWerJ5jVyzLMSIEIxnHCypRnT3286Sg+SVlsP2IgUyD4ZU9HTnnD4sqUKtPdZeV7owcjDGKyHIaY0X6wi2QpsjTO21sJSRdbMr+lUrypoaabT6KjUfBGg7/IwpIaXI/oZJDQkKOZTIRyzFYTXjoo59J0KVTeCP0VDw/wAifRsYxjQ4HbEsymiLQxXExSQ2YjGKRiL9GNGEwiiPKbIsi2IXS5jaHUMRisKRcv0sWEhImljZGJHIRx0chyHPM7hiuRYmJi9iG/kyLE0JmIchscio+RSORCEIXW2RyIiXG2XY2NlQR//EABQRAQAAAAAAAAAAAAAAAAAAAGD/2gAIAQIBAT8AXf/EABQRAQAAAAAAAAAAAAAAAAAAAGD/2gAIAQMBAT8AXf/Z" alt="asd"> -->

                        <img src="<?= $img ?>" alt="" id="profilePhoto">

                        <!-- blank profile src="https://i0.wp.com/sharethelife.org/wp-content/uploads/2021/01/Blank-profile-circle.png?ssl=1" -->
                        <div class="btns-container">
                            <button class="first" onclick="showFileAdd(event)">
                                Upload Picture
                            </button>

                            <button class="second" onclick="saveChangesClick(event)">
                                Save Changes
                            </button>
                        </div>

                    </div>


                </div>

            </main>

        </div>

        <form class="change-pass-container hide">

            <h3>Password Changes</h3>


            <div class="input-field">

                <input id="currentPass" type="text" title="CurrentPass" placeholder="Current Password">

                <input id="newPass" type="text" title="NewPass" placeholder="New Password">

                <input id="confirmPass" type="text" title="ConfirmPass" placeholder="Confirm Password">

            </div>

            <div class="action-wrapper">

                <button class="cancel"> Cancel</button>
                <button class="save" onclick="PasswordSaveClick(event)">Save Changes </button>

            </div>

        </form>




    </div>




</body>






<script src="./js/user-page.js"></script>


</html>