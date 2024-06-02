<?php
// Start session
session_start();

// Check if the keys exist in session
if (isset($_SESSION['adminInfo'])) {
    // Keys exist 
    // Do nothing, user can proceed
} else {
    // Keys do not exist
    // Redirect to login page
    header("Location: logIn-Admin.php");
    exit; // Ensure script execution stops after redirect
}
?>

<?php
include './php/conn.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the start and end dates of the current month
$startOfMonth = date('Y-m-01');
// Get the end date of the current month including the entire day
$endOfMonth = date('Y-m-d 23:59:59', strtotime('last day of this month'));

// Query to get the sum of total_price and count of orders where ord_status is
//  "Completed" and delivery_date is within the current month


$orderQuery = "SELECT SUM(total_price) AS total_sum, COUNT(*)
 AS order_count, (SELECT SUM(quantity) FROM order_item WHERE
  order_id IN (SELECT order_id FROM `order` WHERE ord_status =
   'Completed' AND order_date BETWEEN '$startOfMonth' AND '$endOfMonth'))
    AS total_quantity FROM `order` WHERE ord_status = 'Completed' AND 
    order_date BETWEEN '$startOfMonth' AND '$endOfMonth'";



$orderResult = $conn->query($orderQuery);

// Query to get the total stocks under variation
$variationQuery = "SELECT SUM(stock) AS total_stock FROM variations";

$variationResult = $conn->query($variationQuery);

if ($orderResult->num_rows > 0 && $variationResult->num_rows > 0) {
    // Fetch the result of order query
    $orderData = $orderResult->fetch_assoc();
    // Fetch the result of variation query
    $variationData = $variationResult->fetch_assoc();

    // Output the results
    // echo "Total sum of total_price for completed orders delivered this month: $" . $orderData["total_sum"];
    // echo "<br>";
    // echo "Total number of completed orders this month: " . $orderData["order_count"];
    // echo "<br>";
    // echo "Total stocks under variation: " . $variationData["total_stock"];

    // Store the total sum of total_price, total number of completed orders, and total stocks in session variables
    // session_start();
    $_SESSION['total_sum_total_price'] = $orderData["total_sum"];
    $_SESSION['total_completed_orders'] = $orderData["order_count"];
    $_SESSION['total_stocks_variation'] = $variationData["total_stock"];
    $_SESSION['total_sum_quantity'] = $orderData["total_quantity"];
} else {
    echo "0 results";
}

$conn->close();
?>








<?php





// Check if the user clicked the sign-out link
if (isset($_GET['signout'])) {
    // Unset session variables 
    unset($_SESSION['adminInfo']);



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
    <!-- <link rel="stylesheet" href="./alp.css"> -->
    <link rel="stylesheet" href="./resources/css/admin.css">
    <link rel="stylesheet" href="./resources/css/date-picker.css">


    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include air-datepicker library -->
    <link href="https://cdn.jsdelivr.net/npm/air-datepicker/dist/css/datepicker.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/air-datepicker/dist/js/i18n/datepicker.en.js"></script>




    <script>
        var mindate = new Date();
        mindate.setDate(mindate.getDate() - 8);
        var maxdate = new Date();
        maxdate.setDate(maxdate.getDate() - 1);
        $('#minMaxExample').datepicker({
            language: 'en',
            range: true,
            minDate: mindate,
            maxDate: maxdate,
            multipleDates: true,
            multipleDatesSeparator: " - "
        })
    </script>


    <script src="./js/add-products.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



    <script src="./js/category.js"></script>


    <style>
        .section .body {
            padding: 50px;
        }

        .pop-up-overlay .pop-up-sucess .content .head i {
            right: -154px;
        }
    </style>


</head>

<body style="overflow-y: hidden;">

    </div>


    <div class="delete-confirm-container hide">

        <div class="container hide">

            <i class="far fa-times-circle"></i>

            <span class="main-message">
                Are you Sure?
            </span>

            <span class="sub-message">

                Do you really want to delete this item? This process cannot be undone.

            </span>

            <div class="delete-btn-wrapper">

                <button class="cancel" onclick="cancelCLick(this)">Cancel</button>
                <button class="delete" onclick="deleteCLick(event)">Delete</button>

            </div>

        </div>


    </div>






    <div class="add-file-url-overlay hide">

        <div class="container">

            <header>
                <span><b>Add file from URL</b></span>
                <i class="fas fa-times" onclick="addFileXClick(event)"></i>
            </header>


            <div class="body">

                <label for="">Image </label>


                <div class="input-box">
                    <input type="text" name="" id="img-url-holder" placeholder="Http://Something"    >
                </div>

            </div>





            <div class="footer-container">
                <button class="cancel" onclick="addFileXClick(event)">Cancel</button>
                <button class="add" onclick="addFileCLick(event)">Add File</button>
            </div>


        </div>



    </div>


    <div class="pop-up-overlay hide ">

        <div class="pop-up-sucess hide">

            <div class="content">

                <div class="head">
                    <i onclick="successXClick(event)" class="fas fa-xmark"></i>
                </div>

                <i class="fas fa-check"></i>

                <h2 class="added hide"> Product Added Succesfully</h2>
                <h2 class="updated hide"> Product Updated Succesfully</h2>

                <label for="">View item page?</label>
                <button onclick="viewItemPageClick(event)">Ok</button>

            </div>





        </div>

    </div>

    <div class="variant-overlay hide  ">

        <div class="container">

            <i id="variantXClick" onclick="variantXClick(event)" class="fas fa-x"></i>





            <form>



                <div class="form-field">

                    <div>
                        <label for="addVarColorInput">Color</label>
                        <input type="text" id="addVarColorInput">
                    </div>

                    <span class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>

                </div>


                <div class="form-field">

                    <div>
                        <label for="addVarSizeInput">Size</label>
                        <input type="text" id="addVarSizeInput">

                    </div>

                    <span class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>

                </div>

                <div class="form-field">

                    <div>
                        <label for="addVarPriceInput">Price</label>
                        <input type="number" id="addVarPriceInput">
                    </div>


                    <span class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>

                </div>

                <div class="form-field">

                    <div>
                        <label for="addVarStockInput">Stock</label>
                        <input type="number" id="addVarStockInput">
                    </div>


                    <span class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>
                </div>


                <div class="form-field">

                    <div>

                        <img src="" alt="" id="addVarImg">

                        <input type="text" id="addVarImgInp" onchange="addVarImgChange(event)">
                    </div>


                    <span class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>
                </div>



                <button onclick="variantOverlaySaveClick(event)">Save</button>


            </form>







        </div>

    </div>

    <div class="add-variant-overlay hide ">

        <div class="container">

            <i id="add-variantXClick" onclick="addVariantXClick(event)" class="fas fa-x"></i>



            <form>

                <div class="form-field">

                    <div>
                        <label for="XaddVarColorInput">Color</label>
                        <input type="text" id="XaddVarColorInput">
                    </div>

                    <span id="XaddVarColorWarning" class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>

                </div>


                <div class="form-field">

                    <div>
                        <label for="XaddVarSizeInput">Size</label>
                        <input type="text" id="XaddVarSizeInput">

                    </div>

                    <span id="XaddVarSizeWarning" class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>

                </div>

                <div class="form-field">

                    <div>
                        <label for="XaddVarPriceInput">Price</label>
                        <input type="number" id="XaddVarPriceInput">
                    </div>


                    <span id="XaddVarPriceWarning" class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>

                </div>

                <div class="form-field">

                    <div>
                        <label for="XaddVarStockInput">Stock</label>
                        <input type="number" id="XaddVarStockInput">
                    </div>


                    <span id="XaddVarStockWarning" class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>
                </div>

                <div class="form-field">

                    <div>

                        <img src="default.png" alt="varImg" id="XaddVarImg">

                        <input type="text" id="XaddVarImgInp" onchange="XaddVarImgChange(event)">
                    </div>


                    <span class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>
                </div>

                <button onclick="addVariantOverlaySaveClick(event)">Save</button>


            </form>




        </div>

    </div>





    <div class="view-img-overlay hide">

        <div class="container">

            <i id="viewImageXClick" onclick="viewImageXClick(event)" class="fas fa-x"></i>


            <div class="left-portion">

                <div class="main-img">

                    <img class="mainImg" src="https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151538/338177150_599322062129928_712208375833660244_n_rz30ni.jpg" alt="">

                </div>

            </div>

            <div class="right-portion">

                <div class="action">



                    <i id="deleteImage" onclick="deleteImageClick(event)" class="fas fa-trash"></i>

                    <!-- <div class="replace">
                        <input type="link" name="" id="newImageLink">
                        <button  onclick="replaceImageClick(event)">Replace Image Link</button>
                    </div> -->

                </div>

            </div>

        </div>

    </div>







    <div class="deliveryDate-overlay hide   ">

        <div class="container">

            <i id="deliveryDateX" onclick="deliveryDateXClick(event)" class="fas fa-x"></i>

            <div class="top">

                <img width="100" height="100" src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/external-date-business-flaticons-lineal-color-flat-icons.png" alt="external-date-business-flaticons-lineal-color-flat-icons" />

                <h3>
                    Update Confirmation
                </h3>

            </div>

            <div class="mid">




                <input type="text" class="datepicker-here form-control" id="minMaxExample" data-date-format="dd/mm/yyyy" data-language='en' placeholder="DD/MM/YY">


                <label for="">
                    Are you sure you want to update the delivery date for this order?
                </label>



            </div>






            <div class="bot">




                <div class="action-container">




                    <button onclick="updateDateClick(event)">
                        Update Delivery Date
                    </button>

                </div>


            </div>





        </div>

    </div>



    <div class="orderStatus-overlay hide  ">

        <div class="container">

            <i id="orderStatusX" onclick="orderStatusXClick(event)" class="fas fa-x"></i>

            <div class="top">


                <img height="100px" width="100px" src="https://cdn1.iconfinder.com/data/icons/e-commerce-and-shopping-10/64/e-commerce_shopping_order_completed-1024.png
            " alt="">
                <h3>
                    Update Confirmation
                </h3>

            </div>

            <div class="mid">

                <label for="">
                    Are you sure you want to update the status of this order?
                </label>

                <div class="orderStatus">

                    <b>Current Status :</b>
                    <span id="currentOrderStatus">Current Status</span>

                </div>

                <div class="newStatus">
                    <b>New Status :</b>
                    <select id="newOrderStatus">
                        <option value="0">Pending</option>
                        <option value="1">Completed</option>
                        <option value="2">Canceled</option>
                        <option value="3" selected>Select an Option </option>
                    </select>
                </div>


            </div>

            <div class="bot">


                <label for="">

                    Please note that once the status is updated, <br>
                    it cannot be changed. This action is irreversible.

                </label>

                <div class="action-container">

                    <button onclick="viewOrderFormClick(event)">
                        View Order Form
                    </button>


                    <button onclick="updateStatusClick(event)">
                        Update Status
                    </button>

                </div>


            </div>





        </div>

    </div>




    <!-- <nav id="nav"> </nav>

    <div id="menu"></div> -->



    <div class="admin-container">


        <aside class="side-nav">

            <h2 onclick="testclick(event)">

                <a href="./index.php">ALP SHOP</a>

            </h2>

            <div class="section-container">




                <ul>

                    <li class="single-line" onclick="loadPage('./admin/dashboard.php')">
                        <img src="./resources/icon/icons8-dashboard.png" alt="">
                        <label>Dashboard</label>
                    </li>

                    <li class="with-sub-nav">
                        <div class="sub-nav-header">
                            <img src="./resources/icon/icon-8-bag.png" alt="">
                            <label> <b>Products</b> </label>
                            <i class="fas fa-angle-down" style="  text-align: center;"></i>
                        </div>

                        <ul class="sub-nav">
                            <li onclick="loadPage('./admin/Add-Prod.php')" class="item">
                                <div>
                                    <span></span>
                                    <label for=""> Add Product</label>
                                    <span></span>
                                </div>
                            </li>

                            <!-- <li onclick="loadPage('./admin/edit-Prod.html')" class="item">
                                <div>
                                    <span></span>
                                    <label for=""> edit Product</label>
                                    <span></span>
                                </div>
                            </li> -->

                            <li onclick="loadPage('./admin/Manage-Prod.php')" class="item">
                                <div>
                                    <span></span>
                                    <label for=""> Manage Product</label>

                                </div>
                            </li>

                        </ul>

                    </li>

                    <li class="single-line" onclick="loadPage('./admin/orders.php')">
                        <img src="./resources/icon/icons8-list-view-50.png" alt="">
                        <label for="">Orders</label>
                        <span></span>
                    </li>

                    <li class="single-line" onclick="loadPage('./admin/admin-messages.php')">
                        <img src="https://img.icons8.com/pastel-glyph/64/secured-letter--v1.png"  alt=""> 
                        <label for="">Mails</label>
                        <span></span>
                    </li>

                    <li class="single-line" onclick="loadPage('./admin/chat.php')">
                        <img src="./resources/icon/icons8-message-50.png" alt="">
                        <label for="">Chat</label>
                        <span></span>
                    </li>





                    <!-- <li class="with-sub-nav">
                        <div class="sub-nav-header">
                            <img src="./resources/icon/icons8-setting-50.png" alt="">
                            <label for=""> <b>Settings</b> </label>
                            <i class="fas fa-angle-down" style="  text-align: center;"></i>
                        </div>

                        <ul class="sub-nav">
                            <li onclick="loadPage('./admin/Add-Prod.php')" class="item">
                                <div>
                                    <span></span>
                                    <label for=""> Profile Settings</label>
                                    <span></span>
                                </div>
                            </li>

                            <li onclick="loadPage('./admin/Manage-Prod.php')" class="item">
                                <div>
                                    <span></span>
                                    <label for="">Payment Method</label>

                                </div>
                            </li>

                        </ul>

                    </li> -->



                    <li class="single-line" id="signOut" onclick="window.location.href='?signout'">
                        <img src="./resources/icon/icons8-exit-50.png" alt="">
                        <label for="">Log out</label>
                        <span></span>
                    </li>
                </ul>



            </div>



        </aside>

        <section>

            <img onclick="menuClick(event)" class="menuBtn" width="40" height="40" src="https://img.icons8.com/cotton/64/menu.png" alt="menu" />


            <div id="manage" class="main-content">

            </div>

        </section>














    </div>




    <script>
        function cancelCLick(button) {


            deleteConfirmElem = document.querySelector('.delete-confirm-container');

            deleteConfirmElem.classList.add('hide');
        }


        const popupOverlay = document.querySelector('.pop-up-overlay');
        const successPopup = document.querySelector('.pop-up-sucess');
        const updatedPopup = document.querySelector('.pop-up-sucess .content .updated');
        const addedPopup = document.querySelector('.pop-up-sucess .content .added');


        function viewImageXClick(event) {
            const viewImageElem = document.querySelector('.view-img-overlay');
            viewImageElem.classList.add('hide');
        }

        function successXClick(event) {


            popupOverlay.classList.add('hide');
            successPopup.classList.add('hide');

        }

        function viewItemPageClick(event) {
            popupOverlay.classList.add('hide');
            successPopup.classList.add('hide');

            var productId = sessionStorage.getItem('EditProduct-Id');

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


        const signOutElem = document.getElementById('signOut');

        signOutElem.addEventListener('click', function() {
            window.location.href = 'index.php';
        });




        function logoutClick(event) {



        }


        function menuClick() {


            const sideNavElem = document.querySelector('.side-nav')

            sideNavElem.classList.toggle('show');
            console.log('sidenav click');


        }


        document.addEventListener('DOMContentLoaded', function() {



            // Get all single-line items
            var singleLineItems = document.querySelectorAll('.single-line');

            // Attach click event listeners to each single-line item

            // Attach click event listeners to each single-line item
            singleLineItems.forEach(function(item) {
                item.addEventListener('click', function() {


                    singleLineItems.forEach(function(item) {
                        item.classList.remove('active');
                    });


                    // Remove 'active' class from all sub-nav headers

                    var subNavHeaders = document.querySelectorAll('.sub-nav-header');
                    subNavHeaders.forEach(function(header) {
                        header.classList.remove('active');
                    });

                    // Remove 'show' class from all sub-nav elements
                    var subNavs = document.querySelectorAll('.sub-nav');
                    subNavs.forEach(function(subNav) {
                        subNav.classList.remove('show');
                    });

                    item.classList.add('active');

                    // Remove 'active' class from all sub-nav items
                    var subNavItems = document.querySelectorAll('.sub-nav .item');
                    subNavItems.forEach(function(subNavItem) {
                        subNavItem.classList.remove('active');
                    });



                });
            });





            // Get all sub-nav headers
            var subNavHeaders = document.querySelectorAll('.sub-nav-header');

            // Attach click event listeners to each sub-nav header
            subNavHeaders.forEach(function(header) {
                header.addEventListener('click', function() {

                    singleLineItems.forEach(function(item) {
                        item.classList.remove('active');
                    });

                    // Remove 'active' class from all sub-nav headers
                    subNavHeaders.forEach(function(header) {
                        header.classList.remove('active');
                    });


                    // Add 'active' class to the clicked sub-nav header
                    this.classList.add('active');

                    // Toggle 'show' class for the sibling ul element
                    var subNav = this.nextElementSibling;
                    if (subNav && subNav.classList.contains('sub-nav')) {
                        subNav.classList.toggle('show');
                    }
                });
            });

            // Get all sub-nav items
            var subNavItems = document.querySelectorAll('.sub-nav .item');

            // Attach click event listeners to each sub-nav item
            subNavItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    // Remove 'active' class from all sub-nav items
                    subNavItems.forEach(function(item) {
                        item.classList.remove('active');
                    });

                    // Add 'active' class to the clicked sub-nav item
                    this.classList.add('active');
                    var sideNavElem = document.querySelector('.side-nav')
                    sideNavElem.classList.remove('show');
                });
            });
        });
    </script>

    <script>
        loadPage('./admin/dashboard.php');

        function loadPage(page) {

            // Clear previously loaded scripts
            const head = document.head;
            const scriptElements = head.querySelectorAll('script');
            scriptElements.forEach(script => script.remove());


            // Fetching content from the specified page
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

            // event.preventDefault(); 
            // Prevent the default anchor tag behavior
        }
    </script>

    <!-- <script>
        fetch('./nav.php')
            .then(response => {
                return response.text(); // Extract the HTML content as text
            })
            .then(data => {
                // Insert the HTML content into the target element
                document.getElementById('nav').innerHTML = data;
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
    </script> -->














    <script>
        function orderStatusXClick(event) {


            const orderStatusOverlay = document.querySelector('.orderStatus-overlay');
            orderStatusOverlay.classList.add('hide');


            console.log('orderstatusclick');
        }




        // Function to update select style based on selected option
        function updateSelectStyle() {
            var selectElement = document.getElementById('newOrderStatus');

            var selectedOption = selectElement.options[selectElement.selectedIndex].value;

            selectElement.className = ''; // Remove all existing classes

            switch (selectedOption) {
                case '0':
                    selectElement.classList.add('pending');
                    selectElement.classList.remove('completed', 'cancel'); // Remove other classes
                    break;
                case '1':
                    selectElement.classList.add('completed');
                    selectElement.classList.remove('pending', 'cancel'); // Remove other classes
                    break;
                case '2':
                    selectElement.classList.add('cancel');
                    selectElement.classList.remove('pending', 'completed'); // Remove other classes
                    break;
                default:
                    break;
            }
        }

        // Apply styles based on selected option when the page loads
        updateSelectStyle();

        // Event listener to update styles when the selected option changes
        document.getElementById('newOrderStatus').addEventListener('change', updateSelectStyle);
    </script>



</body>

</html>