<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./alp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="..." crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
         <script src="./js/prod-search.js"></script>
 <script src="./js/user-chat.js"></script>
    <script src="./js/Components/loadNav.js"></script>
    <script src="./js/Components/loadServices.js"></script>
    <script src="./js/category.js"></script>
</head>

<body class="main-container">

    <nav id="nav"> </nav>



    <div class="content-container">



        <div class="section-container">
            <h1>Privacy Policy</h1>



            <div class="section-body">

                The ArBeCa Team, through this Personal Data Protection Policy (“Policy”),  is committed to protect and
                respect your personal data privacy in compliance with the Philippine Data Privacy Act of 2012 (“the
                DPA”). <br><br>

                Please read and review this Personal Data Protection Policy (“Policy”), which will inform you on the
                collection, use, processing, storage, and/or disclosure of your Personal Data. We trust that it will
                assist you in making an informed decision whether to provide us with any of your Personal Data.

            </div>

            <br><br>

            <span>1. DEFINITION OF TERMS </span>
            <div class="section-body">

                <p>For the purposes of understanding the Policy, capitalized terms used in this Policy shall have the
                    following meanings:</p>

                <ul> <br>
                    <li>“Applicable Laws” means the Philippine Data Privacy Act of 2012 and its
                        <br> subsequent related
                        legislations and regulations, as may be amended from time to time.
                    </li> <br><br>

                    <li>
                        “Personal Data” or “Personal Information”means any Information, whether true or not, which is
                        (a) about an individual who can be identified (i) from that data, or (ii) from that data and
                        other information to which we have or are likely to have access and would include data in our
                        records as may be updated from time to time; or (b) defined as “personal data”, “personal
                        information”, or “sensitive personal information” under Philippine Data Protection Law.
                    </li>

                </ul>


            </div>



            <br><br>

            <span>2. PERSONAL INFORMATION THAT ARE COLLECTED  </span>
            <div class="section-body">

                <p>
                    During our relationship with you, we may collect Personal Data from you. The Personal Data we may
                    collect from you include but not limited to the following:
                </p>

                <ol>

                    <li> Name </li>
                    <li>Contact details (including the mobile number, mailing and delivery addresses, and email address)
                    </li>
                    <li>Gender</li>
                    <li>Birthday</li>
                    <li> Network and device data (including your IP address and device or advertising identifiers)</li>
                    <li>Shopping or browsing behaviors</li>
                    <li>Information needed for payments/refunds of transactions (such as but not limited to bank account
                        number/s and other payment options)</li>
                    <li>Any other personally identifiable information which you have provided us in any forms you may
                        have submitted to us, or in the course of any other forms of interaction between you and us, for
                        the purpose of and in relation to your purchase of any product/s.</li>

                </ol>

                <p>
                    Please ensure that all Personal Data submitted to us is complete, accurate, true and correct.
                    Failure to do so may result in our inability to provide you with the products and services you have
                    requested.
                </p>


            </div>





        </div>


    </div>


    <nav id="services"> </nav>

 
    <div id="user-chat"> </div>
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

</body>

</html>