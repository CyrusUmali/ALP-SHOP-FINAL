<?php
// Start session
session_start();

include './php/conn.php';

// Check if the keys exist in session
if (isset($_SESSION['userInfo'][0])) {
    // Get user information
    $userInfo = $_SESSION['userInfo'][0];

    // Ensure that 'customer_id' key exists in the user information
    if (isset($userInfo['customer_id'])) {
        // Retrieve specific fields from user info
        $customerId = $userInfo['customer_id'];

        // Fetch updated user information from the database
        $selectQuery = "SELECT * FROM customer WHERE customer_id=?";
        $selectStatement = $conn->prepare($selectQuery);
        $selectStatement->bind_param("i", $customerId);
        $selectStatement->execute();
        $result = $selectStatement->get_result();
        $updatedUserInfo = $result->fetch_assoc();

        // Update session with new user information
        $_SESSION['userInfo'][0] = $updatedUserInfo;

        // Encode user information as JSON
        $userInfoJson = json_encode($updatedUserInfo);

        // Set a cookie with the encoded user information
        setcookie('userInfo', $userInfoJson, time() + (86400 * 30), '/'); // Cookie will expire in 30 days
    } else {
        echo "Error: 'customer_id' key is missing in userInfo array.";
    }
} else {
    // Keys do not exist
    // Redirect to login page
    header("Location: login.php");
    exit; // Ensure script execution stops after redirect
}
?>





<?php


// Check if the user clicked the sign-out link
if (isset($_GET['signout'])) {
    // Unset session variables 
    unset($_SESSION['userInfo']);
    unset($_SESSION['customer_id']);
    

 
    // Set cookie expiration to past to destroy it
    setcookie('userInfo', '', time() - 3600, '/'); // Set expiration to past

    // Redirect to index.php or any other desired page
    header("Location: index.php");
    exit; // Ensure script execution stops after redirect
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./alp.css">
    <link rel="stylesheet" href="./user/user.css">
    <link rel="stylesheet" href="./resources/css/admin.css">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="./js/category.js"></script>
 

</head>

<body style="overflow-y: hidden;">


    <div class="add-file-url-overlay hide">

        <div class="container">

            <header>
                <span><b>Add file from URL</b></span>
                <i class="fas fa-times" onclick="addFileXClick(event)"></i>
            </header>


            <div class="body">

                <label for="">Image </label>


                <div class="input-box">
                    <input type="text" name="" id="img-url-holder" placeholder="Http://Something">
                </div>

            </div>





            <div class="footer-container">
                <button class="cancel" onclick="addFileXClick(event)">Cancel</button>
                <button class="add" onclick="addFileCLick(event)">Add File</button>
            </div>


        </div>



    </div>



    <div class="pop-up-overlay  hide ">

        <div class="pop-up-sucess hide">

            <div class="content">

                <div class="head">
                    <i onclick="successXClick(event)" class="fas fa-xmark"></i>
                </div>

                <i class="fas fa-check"></i>

                <h2> Updated Succesfully</h2>


            </div>





        </div>

        <div class="pop-up-failed hide  ">

            <div class="content">

                <div class="head">
                    <i onclick="redXclick(event)" class="fas fa-xmark"></i>
                </div>

                <i   class="fas fa-xmark"></i>

                <h2  >  Update Failed</h2>


            </div>





        </div>

    </div>



    <section class="address-overlay hide">


        <div class="edit-address-container">



            <div class="header">


                <i class="fas fa-times" id="edit-address-x" onclick="editAddressClick()"></i>
                <h2> Address Finder</h2>



            </div>

            <main>

                <div>
                    <form class="form-fields">

                        <div>

                            <div class="form-header">

                                For quicker shipping address entry, find your area from the drop
                                down fields.<br>

                                <div>


                                    You may only enter
                                    letters on First
                                    Last Name fields and digits only on Phone
                                    field.

                                </div>

                            </div>


                            <div class="form-group">

                                <input type="text" id="ProvinceInp" placeholder="Province">
                                <input type="text" id="TownOrCityInp" placeholder="Town or City">
                                <input type="text" id="BarangayInp" placeholder="Barangay">
                                <input type="text" id="zipCodeInp" placeholder="Zip Code">
                                <input type="text" id="LandmarkInp" placeholder="House or Unit Number /Street  Name or Landmark">

                                <div>
                                    Please provide complete address to avoid cancellation.
                                </div>
                                <button type="button" onclick=" addAddress()">

                                    Use Address

                                </button>
                            </div>





                        </div>


                    </form>



            </main>






        </div>
    </section>


    <div class="recieve-confirm-container hide ">



        <div class="container">
            <i class="fas fa-xmark" onclick="recieveXClick(event)" id="recieve-confirm-X"> </i>

            <i id="recieve-confirm-icon" class="fas fa-check"></i>

            <span class="main-message">
                Are you Sure?
            </span>

            <span class="sub-message">

                Do you really want to confirm the order delivery? This process cannot be undone.

            </span>

            <div class="recieve-btn-wrapper">

                <button class="recieve" onclick="confirmRecieveCLick(event)">Recieve Order</button>

            </div>

        </div>


    </div>



    <div class="cancel-confirm-container hide">



        <div class="container">
            <i class="fas fa-xmark" onclick="cancelXClick(event)" id="cancel-confirm-X"> </i>

            <i id="cancel-confirm-icon" class="fas fa-xmark"></i>

            <span class="main-message">
                Are you Sure?
            </span>

            <span class="sub-message">

                Do you really want to cancel this Order? This process cannot be undone.

            </span>

            <div class="cancel-btn-wrapper">

                <button class="cancel" onclick="confirmCancelCLick(event)">Cancel Order</button>

            </div>

        </div>


    </div>



    <div class="order-details-container hide  ">



        <div class="container">

            <h3>
                Delivery Details:
            </h3>
            <i class="fas fa-xmark" onclick="ordDetailsXClick(event)" id="cancel-confirm-X"> </i>


            <div class="mid">

                <ul class="first-list">
                    <li>
                        <b>Customer Name: </b>
                        <p id="recipientName">One Dela Cruz</p>
                    </li>

                    <li>
                        <b>Delivery Address: </b>
                        <p id="recipientAddress">Mercury Drugstore, Alaminos, Laguna</p>
                    </li>

                    <li>
                        <b>Delivery Method:</b>
                        <p>Pick-up / Meet Up</p>
                    </li>



                    <li>
                        <b> Delivery Date: </b>
                        <p id="estDeliverDate">07-20-2024</p>
                    </li>

                    <li>
                        <b>Date Ordered: </b>
                        <p id="orderDate">07-07-24</p>
                    </li>


                </ul>

                <ul class="second-list">

                    <li>
                        <b>Order Number: </b>
                        <p id="orderId">#509269</p>
                    </li>

                    <li>
                        <b> Subtotal: </b>
                        <p id="subtotal">Php 0.00</p>
                    </li>

                    <li>
                        <b> Shipping Fee: </b>
                        <p id="ordDetShippingFee">Php 0.00</p>
                    </li>

                    <li>
                        <b> Total Cost: </b>
                        <p id="ordDetTotal">Php 0.00</p>
                    </li>

                </ul>



            </div>









        </div>








    </div>








    <!-- <nav id="nav"> </nav>

    <div id="menu"></div> -->



    <div class="admin-container">






        <aside class="side-nav">

            <h2 onclick="testclick(event)">
                <a href="./index.php"> ALP Shop</a>
            </h2>

            <div class="section-container">




                <!-- <div class="single-line-head">
                    <img src="./resources/icon/icons8-dashboard.png" alt="">
                    <label>Dashboard</label>
                </div> -->

                <ul>




                    <li class="single-line" onclick="loadPage('./user/profile.php')">
                        <i class="far fa-user-circle"></i>
                        <label>Profile</label>
                        <span></span>
                    </li>

                    <li class="single-line" onclick="loadPage('./user/address.php')">
                        <i class="far fa-map"></i> <label>Address</label>
                        <span></span>
                    </li>

                    <li class="single-line" onclick="loadPage('./user/purchases.php')">
                        <i class=" fas fa-history"></i> <label>My Purchases</label>
                        <span></span>
                    </li>

                    <li class="single-line" onclick="loadPage('./user/wishList.php')">
                        <i class=" far fa-heart"></i> <label>My Wishlist</label>
                        <span></span>
                    </li>


                    <li class="single-line" onclick="loadPage('./user/user-reviews.php')">
                        <i class=" far fa-star"></i> <label>Reviews</label>
                        <span></span>
                    </li>




                    <li class="single-line" id="signOutElem" onclick="window.location.href='?signout'">
                        <i class="fas fa-sign-out-alt"></i> <label>Sign Out</label>
                    </li>





                </ul>

                <ul class="list-2">








                </ul>



            </div>



        </aside>







        <section>

            <img onclick="menuClick(event)" class="menuBtn" width="40" height="40" src="https://img.icons8.com/cotton/64/menu.png" alt="menu" />


            <div id="manage" class="main-content"> </div>

        </section>



    </div>







    </div>





    <!-- <div id="services"></div>
    <div id="site-footer"></div> -->


















    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const singleLineElements = document.querySelectorAll('.single-line');

            singleLineElements.forEach(function(element) {
                element.addEventListener('click', function() {
                    // Remove active class from all elements
                    singleLineElements.forEach(function(el) {
                        el.classList.remove('active');
                    });

                    // Add active class to the clicked element
                    element.classList.add('active');
                });
            });
        });
    </script>








 



    <script>
        const signOutElem = document.getElementById('signOutElem');

        signOutElem.addEventListener('click', function() {
            localStorage.removeItem('authToken');
            localStorage.removeItem('userInfo');
            // window.location.href = 'index.php';
        });


        function menuClick() {


            const sideNavElem = document.querySelector('.side-nav')

            sideNavElem.classList.toggle('show');
            // console.log('sidenav click');


        }

        loadPage('./user/profile.php');


        function redXclick(){

            const popUpOverlay = document.querySelector('.pop-up-overlay');
            const popUpFailed = document.querySelector('.pop-up-failed')

            popUpOverlay.classList.add('hide')
            popUpFailed.classList.add('hide')
 
        }


        function loadPage(page) {
            // Fetching content from the specified page

            // Clear previously loaded scripts
            const head = document.head;
            const scriptElements = head.querySelectorAll('script');
            scriptElements.forEach(script => script.remove());


            fetch(page)
                .then(response => response.text())
                .then(html => {
                    // Displaying the fetched content in the designated section
                    document.getElementById('manage').innerHTML = html;

                    // Uncomment the line below if you want to use browser history
                    // history.pushState({ page: page }, " ", page);

                    // Parse the fetched HTML content to extract script tags
                    const parser = new DOMParser();
                    const parsedHTML = parser.parseFromString(html, 'text/html');
                    const scriptTags = parsedHTML.querySelectorAll('script');

                    // Execute each script tag's content or load external scripts
                    scriptTags.forEach(script => {
                        if (script.src) {
                            // If the script has a src attribute, load the external script
                            const newScript = document.createElement('script');
                            newScript.src = script.src;
                            document.head.appendChild(newScript);
                        } else {
                            // If the script doesn't have a src attribute, execute its content
                            eval(script.text);
                        }
                    });

                })
                .catch(error => console.error('Error loading page:', error));

            event.preventDefault(); // Prevent the default anchor tag behavior

            const sideNavElem = document.querySelector('.side-nav')
            sideNavElem.classList.toggle('show');
            // console.log('sidenav click');
        }
    </script>








    <!-- Import other scripts here -->

</body>

</html>