 <?php


    session_start();
    // Check if the keys exist in session
    if (isset($_SESSION['userInfo'][0])) {
        // Get user information from the nested array
        $userInfo = $_SESSION['userInfo'][0];

        // Set variables for first name, last name, email, phone number, username, and image
        $province = isset($userInfo['province']) ? $userInfo['province'] : '';
        $first_name = isset($userInfo['first_name']) ? $userInfo['first_name'] : '';
        $last_name = isset($userInfo['last_name']) ? $userInfo['last_name'] : '';

        $city = isset($userInfo['City']) ? $userInfo['City'] : '';
        $Barangay = isset($userInfo['Barangay']) ? $userInfo['Barangay'] : '';
        $Zip_Code = isset($userInfo['Zip_Code']) ? $userInfo['Zip_Code'] : '';
        $landmark = isset($userInfo['landmark']) ? $userInfo['landmark'] : '';
    } else {
        // If userInfo array or its first element doesn't exist, set default values
        $province = '';
        $city = '';
        $barangay = '';
        $Zip_Code = '';
        $landmark = '';
    }





    // Check if cart data exists in the session
    $cartItems = isset($_SESSION['combinedCartData']['cartDetails'])
        ? $_SESSION['combinedCartData']['cartDetails'] : [];




    ?>



 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>

     <link rel="stylesheet" href="./alp.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="..." crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
     <link rel="stylesheet" href="./resources/css/shipping-details.css">
     <link rel="stylesheet" href="./resources/css/contactUs.css">

     <script src="./js/cart.js"></script>

     <script src="./js/prod-search.js"></script>
     <script src="./js/user-chat.js"></script>

     <script src="./js/category.js"></script>



     <style>

/* .content-container{
    margin-bottom: 100px;
} */


.shipping-details-container{
    margin-bottom: 100px;
}


.form-footer span{
    cursor: pointer;
}

     </style>

   



 </head>

 <body class="main-container">

     <nav id="nav"> </nav>


     <div id="menu"></div>



     <div class="pop-up-overlay hide">

         <div class="pop-up-sucess hide">

             <div class="content">

                 <i class="fas fa-check"></i>
                 <h2>Order Placed</h2>
                 <label for="">Please wait while we process your order</label>
                 <button onclick="backShoppingClick(event)">Back to Shopping</button>


             </div>





         </div>

     </div>



     <div class="content-container">


         <div class="shipping-details-container">



             <form class="details-form">
                 <h1 onclick="testShip(event)">Shipping Details</h1>

                 <div class="contact-form-container">

                     <label for="contactInput">Contact</label>
                     <input type="text" maxlength="55" id="contactInput" placeholder="Enter email or phone number">

                 </div>

                 <div class="shipping-form-container">

                     <label class="main-label">Shipping Address</label>

                     <div class="form-group-1">
                         <input type="text" id="FnameInput" placeholder="First Name" maxlength="55" value="<?= $first_name ?>">

                         <input type="text" id="LnameInput" placeholder="Last Name" maxlength="55" value="<?= $last_name ?>">
                     </div>

                     <input maxlength="255" type="text" class="no-group" id="addressInp" placeholder="House Number , Street" value="<?= $landmark ?>">

                     <div class="form-group-2">
                         <input type="text" id="cityInput" placeholder="City" maxlength="55" value="<?= $city ?>">
                         <input type="text" id="postalCodeInp" placeholder="Postal Code" maxlength="20" value="<?= $Zip_Code ?>">
                         <input type="text" id="province" placeholder="Province" maxlength="55" value="<?= $province ?>">
                     </div>



                     <div class="form-group-3">

                         <input type="checkbox" id="saveCheckbox">
                         <label for="saveCheckbox">Save this information for a future fast checkout</label>

                     </div>




                 </div>

                 <div class="form-footer">

                     <span onclick="backCartClick(event)(event)">Back to Cart</span>
                     <button type="button" onclick="placeOrderClick(event)">Place Order</button>

                 </div>


             </form>






             <div class="cart-content-container">
                 <div class="items-container">
                     <?php if (!empty($cartItems)) : ?>
                         <?php foreach ($cartItems as $item) : ?>
                             <div class="item">
                                 <div class="portion-1">
                                     <img src="<?php echo htmlspecialchars($item['var_img']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                     <div class="product-details">
                                         <span class="name"><?php echo htmlspecialchars($item['name']); ?></span>
                                         <div class="wrapper">
                                             <span><?php echo htmlspecialchars($item['color']); ?> / <?php echo htmlspecialchars($item['size']); ?></span>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="portion-2">
                                     <div>
                                         <i class="fas fa-peseta-sign"></i>
                                         <span><?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                                     </div>
                                 </div>
                             </div>
                         <?php endforeach; ?>
                     <?php else : ?>
                         <p>No items in the cart.</p>
                     <?php endif; ?>
                 </div>

                 <div class="cost-calculation">
                     <div class="subtotal">
                         <label>Subtotal: </label>
                         <span id="shipping-subtotal">P <?php echo number_format(array_sum(array_map(function ($item) {
                                                            return $item['price'] * $item['quantity'];
                                                        }, $cartItems)), 2); ?></span>
                     </div>

                     <div class="shipping">
                         <label>Shipping: </label>
                         <span id="shipping-fee">P72.00</span>
                     </div>

                     <div class="total">
                         <label>Total: </label>
                         <span id="shipping-total" class="shipping-total">P <?php echo number_format(array_sum(array_map(function ($item) {
                                                                                return $item['price'] * $item['quantity'];
                                                                            }, $cartItems)) + 72.00, 2); ?></span>
                     </div>
                 </div>
             </div>












         </div>

       








     </div>

     <div>

     </div>

     <div id="services"></div>
     <div id="site-footer"></div>


     <script>
         function reviewCartClick(event) {
             window.location.href = 'cart.php';
             console.log('review cart click');
         }

         function backShoppingClick(event) {
             history.replaceState(null, null, location.href);
             window.location.href = 'index.php';

         }



         function backCartClick(){

 
            window.location.href = 'cart.php    '

         }
     </script>

     <script>



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










 </body>

 </html>