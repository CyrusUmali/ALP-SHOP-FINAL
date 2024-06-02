<?php
// Include the PHP script that establishes the database connection

include './php/conn.php';
// Query to fetch 4 random products from the database
$sql = "
SELECT 
    p.*,
    v.price AS variation_price,
    v.stock AS variation_stock
FROM 
    `$dbname`.product p
LEFT JOIN 
    (SELECT 
        product_id_fk,
        MIN(price) AS price,
        SUM(stock) AS stock
    FROM 
        `$dbname`.variations
    GROUP BY 
        product_id_fk
    ) v ON p.product_id = v.product_id_fk
ORDER BY 
    RAND()
LIMIT 4;
";

// Execute the query
$result = $conn->query($sql);
// Check for errors
if (!$result) {
    $error_message = mysqli_error($db_connection);
    echo "Error retrieving data from the database: $error_message";
    http_response_code(500);
    exit;
}

// Fetch data as associative array
$randomProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./resources/css/item-page.css">
    <link rel="stylesheet" href="./resources/css/login.css">
    <link rel="stylesheet" href="./resources/css/cart.css">
    <link rel="stylesheet" href="./alp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="..." crossorigin="anonymous">


    <script src="./js/category.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="./js/prod-search.js"></script>
    <script src="./js/user-chat.js"></script>
    <script src="./js/item-page.js"></script>
   

</head>

<body class="main-container">

    <nav id="nav"> </nav>

    <div id="menu"></div>



    <div class="overlay-login hide">




        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="#">
                    <h1>Create Account</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <!-- <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a> -->
                    </div>
                    <span>or use your email for registration</span>
                    <input type="text" placeholder="First Name" id="signUpFN" required />
                    <input type="text" placeholder="Last Name" id="signUpLN" required />
                    <input type="email" placeholder="Email" id="signUpEmail" required />
                    <input type="password" placeholder="Password" id="signUpPass" required />
                    <input type="password" placeholder="Confirm Password" id="signUpConfirmPass" required />
                    <button onclick="signUpClick(event)">Sign Up</button>
                    <span id="result"> </span>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="#">
                    <i class="fas fa-arrow-left" onclick="exitClick(event)" id="signInExitBtn"></i>
                    <h1>Sign in</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your account</span>
                    <input type="email" id="logInEmailInput" placeholder="Email" />
                    <input type="password" id="logInPassInput" placeholder="Password" />


                    <!-- <a href="#">Forgot your password?</a> -->

                    <div class="actions-wrapper">
                        <a href="#">Forgot your password?</a>

                        <div>
                            <input type="checkbox" id="rememberCheckbox"> <span>Remember Me?</span>
                        </div>

                    </div>



                    <button onclick="logInClick(event)">Sign In</button>
                    <span id="login-result"> </span>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn" onclick="overlaySignInPanelClick(event)">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp" onclick="overlaySignUpPanelClick(event)">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div class="cart-overlay hide">

        <div class="cart-overlay-main">

            <div class="cart-overlay-header">

                <span>Cart</span> <i class="fas fa-times" onclick="closeCartOverlay(event)"></i>

            </div>

            <div class="cart-overlay-body">

                <!-- <div class="cart-item">

                    <div class="left-part">

                        <img src="" alt="">

                    </div>

                    <div class="right-part">

                        <span class="item-name">
                            YowaiMo Shindeiru YowaiMo Shindeiru YowaiMo Shindeiru YowaiMo Shindeiru
                        </span>

                        <span class="item-variation">

                            Nah I'd Win

                        </span>

                        <span class="remove-item">
                            <i class="fas fa-times"></i> Remove
                        </span>

                        <div class="numbers">

                            <div class="quantity">

                                <button class="minus">-</button>
                                <input type="text">
                                <button class="add">+</button>

                            </div>

                            <div class="cost">

                                <span>
                                    P 398.99
                                </span>

                            </div>

                        </div>



                    </div>


                </div> -->





            </div>

            <div class="cart-overlay-footer">

                <div class="subtotal">

                    <span class="label">Subtotal</span>
                    <span class="cost" id="subTotal-price">P 2981.00</span>


                </div>

                <button onclick="reviewCartClick(event)">
                    Review Cart
                </button>

            </div>

        </div>

    </div>


    <div class="content-container" >

        <div class="item-page-container">

            <div class="portion-1">

                <div class="identity-container">
                    <a href="./index.php"> Home &nbsp;</a>
                    <a href="./all-products.php">/All Products &nbsp;</a>

                    / <span>Name of Product</span>

                </div>

                <div style="display: flex; flex-direction: row-reverse;  justify-content: space-evenly;">

                    <div class="showcase-img">

                        <img src="" alt="">

                    </div>

                    <div class="variation-img-container">



                    </div>

                </div>



            </div>

            <div class="portion-2">

                <div class="product-header">
                    <h2>
                        <!--  name -->
                        Look At The Bright Side Of Life Graphic Tee
                    </h2>
                </div>

                <div class="product-body">

                    <div class="cost">
                        <!-- price -->
                        <i class="fas fa-peseta-sign"></i>
                    </div>

                    <div class="variant-wrapper">




                        <div class="head">
                            <p id="color-element">Colors</p>
                            <span class="warning-color">Please select an Option</span>
                        </div>
                        <div class="Colors">
                            <!-- iterate  the colors-->
                            <!-- <span>Off White</span> -->

                        </div>

                    </div>

                    <div class="variant-wrapper">



                        <div class="head">
                            <p id="size-element">Size</p>
                            <span class="warning-size">Please select an Option</span>
                        </div>
                        <div class="Sizes">
                            <!-- <span>Extra Small</span>
                            <span> Small</span>
                            <span> Medium</span>
                            <span> Large</span>
                            <span>Extra Large</span> -->
                        </div>

                    </div>

                    <div class="quantity">

                        <div class="head">
                            <p>Quantity</p>
                            <span class="count">Quantity must be between 1 and available stock. </span>
                        </div>
                        <div class="input-group">
                            <button id="minusButton">-</button>
                            <input type="number" id="QuantityInput" value="1">
                            <button id="addButton">+</button>

                        </div>



                    </div>

                    <div class="stocks">
                        Available
                    </div>


                    <div class="action">


                        <button class="buy" id="buyButton">Buy Now</button>



                        <button class="cart" id="cartButton">Add to Cart</button>




                        <button class="wish" id="wishButton"><i class="fas fa-heart"></i></button>

                        <span class="wishResponse"></span>

                    </div>

                    <div class="description">

                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia fugit
                        placeat molestias nemo quisquam magni consequatur tenetur explicabo doloribus
                        eum excepturi quod debitis delectus voluptate consectetur, neque quae dicta
                        eligendi?

                    </div>

                </div>




            </div>



        </div>




        <div class="reviews-container">

            <div class="header">
                <h2>
                    Reviews
                </h2>
                <div class="rating-score">
                    4.6 out of 5 <i class="far fa-star"></i> <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i><i class="far fa-star"></i>
                </div>



            </div>

            <!-- <div class="user-review">

                <img src="./resources/kazuyaguy.png" alt="">

                <div class="section">
                    <span>Ravenino</span>

                    <div class="rating-score">
                        <i class="far fa-star"></i> <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i><i class="far fa-star"></i>

                    </div>

                    <div class="content">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero iste quas tenetur cum et
                        velit repellat obcaecati quia sed dicta, doloremque culpa nostrum harum eaque veniam quam
                        suscipit tempora eligendi.
                    </div>

                </div>

            </div>

            <div class="user-review">

                <img src="./resources/kazuyaguy.png" alt="">

                <div class="section">
                    <span>Ravenino</span>

                    <div class="rating-score">
                        <i class="far fa-star"></i> <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i><i class="far fa-star"></i>

                    </div>

                    <div class="content">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero iste quas tenetur cum et
                        velit repellat obcaecati quia sed dicta, doloremque culpa nostrum harum eaque veniam quam
                        suscipit tempora eligendi.
                    </div>

                </div>

            </div> -->

        </div>



 


        <div class="product-recommendations">
            <header>
                <h1>You may also Like</h1>
                <a href="./all-products.php">View All</a>
            </header>
            <div class="product-wrapper">
                <?php foreach ($randomProducts as $product) : ?>
                    <div class="product" product-id="<?php echo $product['product_id']; ?>">
                        <img src="<?php echo $product['img']; ?>" alt="">
                        <div>
                            <p><?php echo $product['name']; ?></p>
                            <span><?php echo 'P' . number_format($product['variation_price'], 2); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


    </div>



    <div id="user-chat"> </div>
    <div id="services"></div>
    <div id="site-footer"></div>







    <script>
        // Get the checkbox element
        // var rememberCheckbox = document.getElementById('rememberCheckbox');

        // // Add an event listener for the 'change' event
        // rememberCheckbox.addEventListener('change', function(event) {
        //     // Check if the checkbox is checked
        //     if (event.target.checked) {
        //         console.log('Checkbox is checked');
        //     } else {
        //         console.log('Checkbox is not checked');
        //         // Clear the email and password cookies
        //         clearCookie('email');
        //         clearCookie('password');
        //         document.getElementById('logInEmailInput').value = '';
        //         document.getElementById('logInPassInput').value = '';


        //     }
        // });

        // Function to clear a cookie by name
        // function clearCookie(name) {
        //     document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        // }



        // Retrieve email and password from cookies
        // var emailCookie = getCookie('email');
        // var passwordCookie = getCookie('password');


        // // Populate email and password fields
        // if (emailCookie && passwordCookie) {
        //     document.getElementById('logInEmailInput').value = emailCookie;
        //     document.getElementById('logInPassInput').value = passwordCookie;

        //     // Set the checkbox to be checked
        //     rememberCheckbox.checked = true;


        // } else {
        //     console.log('gutom ako wala yung cookies');
        // }

        // Define the getCookie function
        // function getCookie(name) {
        //     var cookieValue = null;
        //     if (document.cookie && document.cookie !== '') {
        //         var cookies = document.cookie.split(';');
        //         for (var i = 0; i < cookies.length; i++) {
        //             var cookie = cookies[i].trim();
        //             // Check if the cookie name matches
        //             if (cookie.substring(0, name.length + 1) === (name + '=')) {
        //                 cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
        //                 break;
        //             }
        //         }
        //     }
        //     return cookieValue;
        // }
    </script>







    <!-- product click -->
    <script>
        // Function to handle clicks on product elements
        function handleProductClick(event) {
            // Check if the clicked element or its parent has the class "product"



            const productElement = event.target.closest('.product-recommendations .product');
            if (productElement) {
                // Extract product_id from data-product-id attribute
                const productId = productElement.getAttribute('product-id');
                // Redirect to item-page.html with product_id
                // window.location.href = `item-page.html?product_id=${productId}`;


                // Make the PHP GET request with product_id as a query parameter
                fetch(`./php/fetch_item_details.php?product_id=${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Store the data in localStorage
                        localStorage.setItem('itemDetails', JSON.stringify(data));
                        console.log('Data retrieved and stored in localStorage:', data);
                        window.location.href = `item-page.php?product_id=${productId}`;
                    })
                    .catch(error => console.error('Error fetching data:', error));


            }
        }




        // Add click event listener to the entire document
        document.addEventListener("click", handleProductClick);
    </script>




    <script>
        function reviewCartClick(event) {
            console.log('reviewcartclick');
            window.location.href = 'cart.php';
        }


        function closeCartOverlay(event) {

            const cartOverlayElement = document.querySelector('.cart-overlay');

            cartOverlayElement.classList.toggle('hide');

        }
    </script>




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


    <script src="./js/category.js"></script>

    <script>
        function toggleSubNav(element) {
            var subNav = element.nextElementSibling;
            var angleIcon = element.querySelector('.fas');

            subNav.classList.toggle('show');
            angleIcon.classList.toggle('fa-angle-up');
            angleIcon.classList.toggle('fa-angle-down');
        }



        function categClick() {


            // Selecting the element by class name
            var dropDown = document.querySelector('.drop-down-categories');
            var overlay = document.querySelector('.categ-footer');


            if (dropDown) {
                // Toggling the "show" class
                dropDown.classList.toggle('show');
                overlay.classList.toggle('show');
            } else {
                console.error("Element with class 'drop-down-categories' not found.");
            }




        }


        function hideDropDown() {
            // Selecting the element by class name
            var dropDown = document.querySelector('.drop-down-categories');
            var overlay = document.querySelector('.categ-footer');
            if (dropDown) {
                // Removing the "show" class
                dropDown.classList.remove('show');
                overlay.classList.remove('show');
            } else {
                console.error("Element with class 'drop-down-categories' not found.");
            }
        }
    </script>

</body>

</html>