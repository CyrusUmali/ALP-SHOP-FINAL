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


        <div class="empty-cart-container">


            <div class="section-1">
                <img src="./resources/empty-cart.webp" alt="">
                <h3>YOUR CART IS EMPTY</h3>
                <span>sign in to view your cart and start shopping</span>


            </div>

            <div class="section-2">
                <button class="btn-1" onclick="signInClick(event)">SIGN IN / REGISTER</button>
                <button class="btn-2" onclick="shopNowClick(event)">SHOP NOW</button>
            </div>

        </div>


        



    </div>

    <div id="user-chat"> </div>
    <div id="services"></div>
    <div id="site-footer"></div>







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
        function toggleSubNav(element) {
            var subNav = element.nextElementSibling;
            var angleIcon = element.querySelector('.fas');

            subNav.classList.toggle('show');
            angleIcon.classList.toggle('fa-angle-up');
            angleIcon.classList.toggle('fa-angle-down');
        }



        function shopNowClick(event) {
            window.location.href = 'all-products.php ';
        }

        function signInClick(event) {
            window.location.href = 'login.php';
        }
    </script>

    <!-- <script src="./js/cart.js"></script> -->
</body>

</html>