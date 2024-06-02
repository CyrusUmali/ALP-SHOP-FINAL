<?php
// Start session
session_start();

// Check if the keys exist in session
if (isset($_SESSION['userInfo'])) {
    // Keys exist
    // Do nothing, user can proceed
} else {
    // Keys do not exist
    // Redirect to login page
    header("Location: empty-cart.php");
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
    <link rel="stylesheet" href="./resources/css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="..." crossorigin="anonymous">
    <script src="./js/category.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="./js/prod-search.js"></script>
    <script src="./js/user-chat.js"></script>


</head>

<body class="main-container">

    <nav id="nav"> </nav>

    <div id="menu"></div>



    <div class="content-container">

        <div class="cart-container">

            <h2>Cart</h2>


            <div class="empty-cart-container">


                <div class="section-1">
                    <img src="./resources/empty-cart.webp" alt="">



                </div>

                <div class="section-2">
                    <h3>YOUR CART IS EMPTY</h3>
                    <span>Start Shopping to Fill it Up!!</span>
                    <button class="btn-2" onclick="shopNowClick(event)">SHOP NOW</button>
                </div>

            </div>

            <form action="">

                <div class="cart-header">
                    <span>QUANTITY</span>
                    <span>TOTAL</span>
                </div>

                <div class="cart-body">








                </div>


            </form>

            <div class="cart-footer">




                <div class="section">

                    <div class="cart-cost-analysis">

                        <span>SubTotal</span>
                        <div>
                            <i class="fas fa-peseta-sign"></i>
                            <span id="subTotal-price"> </span>
                        </div>



                    </div>

                    <!-- <div class="payment-method">

                        <label><b> Payment Method </b></label>

                        <div class="wrapper">

                            <div class="item">
                                <div>
                                    <img src='./resources/cod.png' alt="asd">
                                    <label for="codInp">Cash On Delivery</label>
                                </div>

                                <input id="codInp" type="radio">
                            </div>

                            <div class="item">
                                <div>
                                    <img src="./resources/gcash.png" alt="">
                                    <label for="gcashInp">Gcash</label>
                                </div>

                                <input type="radio" id="gcashInp">
                            </div>

                            <div class="item">

                                <div>
                                    <img src="./resources/paymaya.png" alt="">
                                    <label for="paymayaInp">Paymaya</label>
                                </div>

                                <input type="radio" id="paymayaInp">
                            </div>


                        </div>

                    </div>

                    <div class="address">

                        <i class="fas fa-location-dot"></i>
                        <span>Address:</span>

                        <select title="address">
                            <option value="">Please Select Your Location</option>
                        </select>

                    </div> -->

                    <button type="button" onclick="goToCheckOut(event)">Checkout</button>

                </div>

            </div>


        </div>





    </div>

    <div id="services"></div>
    <div id="site-footer"></div>
    <div id="user-chat"> </div>




    <script>
        function menuClick() {
            //Show MENU 
            var mainContainer = document.querySelector('.content-container');
            if (mainContainer.classList.contains('show-menu')) {
                mainContainer.classList.remove('show-menu');
            } else {
                mainContainer.classList.add('show-menu');
            }


            var menuContainer = document.querySelector('.menu-container');
            if (menuContainer.classList.contains('show')) {
                menuContainer.classList.remove('show');
            } else {
                menuContainer.classList.add('show');
            }
        }
    </script>


    <script>
        fetch('./site-footer.php')
            .then(response => {
                return response.text(); // Extract the HTML content as text
            })
            .then(data => {
                // Insert the HTML content into the target element
                document.getElementById('site-footer').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });

        fetch('./service.php')
            .then(response => {
                return response.text(); // Extract the HTML content as text
            })
            .then(data => {
                // Insert the HTML content into the target element
                document.getElementById('services').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });



        fetch('./nav.php')
            .then(response => {
                return response.text(); // Extract the HTML content as text
            })
            .then(data => {
                // Insert the HTML content into the target element
                document.getElementById('nav').innerHTML = data;

                axios.post('./php/user/check-auth.php', {
                        // Your data to be sent in the request body
                    })
                    .then(response => {
                        // Check if the customer ID is not set
                        if (response.data.noId) {
                            console.log("Customer ID not set:", response.data.message);
                            // Handle the case where customer ID is not set
                        } else {
                            // Handle other cases or success response
                            console.log("Request successful:", response.data);

                            retrievmessageNotif();



                        }
                    })
                    .catch(error => {
                        // Handle error
                        console.error("Error:", error);
                    });
            })
            .catch(error => {
                console.error('Error:', error);
            });

        fetch('./user-chat.php')
            .then(response => {
                return response.text(); // Extract the HTML content as text
            })
            .then(data => {
                // Insert the HTML content into the target element
                document.getElementById('user-chat').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });

        fetch('./menu.php')
            .then(response => {
                return response.text(); // Extract the HTML content as text
            })
            .then(data => {
                // Insert the HTML content into the target element
                document.getElementById('menu').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>


    <script>
        function shopNowClick(event) {
            window.location.href = 'all-products.php ';
        }
    </script>

    <script src="./js/cart.js"></script>
</body>

</html>