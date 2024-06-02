<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./alp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="..." crossorigin="anonymous">
        <script src="./js/prod-search.js"></script>
        <script src="./js/user-chat.js"></script>

    <script src="./js/category.js"></script>
</head>

<body class="main-container">

    <nav id="nav"> </nav>



    <div class="content-container">



        <div class="section-container">
            <h1>Frequently Asked Questions</h1>




            <br><br>

            <span>1. How to order?</span>
            <div class="section-body">

                <p>You can chat or message me directly at my Social Media Account:</p>

                <p>Facebook: Alejandra Laguerta Papa <br>Gmail: alejandrapapa797@gmail.com</p>



            </div>



            <br><br>

            <span>2. Where can I pick-up my order(s)?</span>
            <div class="section-body">

                <p>
                    For Alaminos, Laguna customer, we do have our meeting place at Mercury Drug Store Alaminos,
                    Laguna. <br> For San Pablo City customer, we do have our meeting place at San Pablo City Shopping
                    Mall,
                    San Pablo City, Laguna. <br> For customers outside Alaminos, Laguna and San Pablo City, Laguna your
                    order(s) will be deliver through Flash Express, an additional shipping fee will be added to your
                    purchase(s).
                </p>

            </div>





            <span>3. How to Pay My Order(s)?</span>
            <div class="section-body">

                <p>
                    For Alaminos, Laguna and San Pablo City, Laguna customers who will pay via cash we do have meet-up
                    places where you can pay and pick-up your order(s). <br> For customers outside Alaminos, Laguna and
                    San
                    Pablo City, Laguna you can contact me through our Facebook page 
                    <a href="https://www.facebook.com/profile.php?id=100063693235245">ALP.Shop</a>  or through my personal
                    Facebook account  <a href="https://www.facebook.com/alejandra.papa.12">Alejandra Laguerta Papa</a> we will send our Gcash Account Number where you can pay
                    your order(s) and shipping fee online. (Note: Payment First Policy before getting your order(s). You
                    have to send a proof of payment/receipt)
                </p>

            </div>


            <span>4. How to return/refund wrong order(s)/damaged product(s)?</span>
            <div class="section-body">

                <p>
                    In order to initiate the refund process for damaged product(s), please provide clear photographic or
                    video evidence showcasing the damaged item(s) along with the original receipt upon opening the
                    parcel. This documentation is crucial for me to efficiently assess the extent of the damage and
                    expedite your refund request. Kindly ensure that the image or video captures the nature and extent
                    of the damage clearly. Please note that failure to provide this required documentation may result in
                    the cancellation of the refund request.
                </p>

            </div>




        </div>


    </div>


       
    <div id="user-chat"> </div>
    <div id="services"></div>
    <div id="site-footer"></div>




    <!-- Fetch Pages -->
    <script>



        <!-- product click -->

        // Function to handle clicks on product elements
        function handleProductClick(event) {
            // Check if the clicked element or its parent has the class "product"

            const categoryElement = event.target.closest('.item-div');
            if (categoryElement) {
                const categoryLabel = categoryElement.querySelector('label').textContent;
                localStorage.setItem('categoryLabel', categoryLabel);
                window.location.href = 'all-products.html';
            }




        }




        // Add click event listener to the entire document
        document.addEventListener("click", handleProductClick);



        function toggleSubNav(element) {
            var subNav = element.nextElementSibling;
            var angleIcon = element.querySelector('.fas');

            subNav.classList.toggle('show');
            angleIcon.classList.toggle('fa-angle-up');
            angleIcon.classList.toggle('fa-angle-down');
        }

        function categHover() {


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

</body>

</html>