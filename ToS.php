<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./alp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="..." crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="./js/prod-search.js"></script>
    <script src="./js/user-chat.js"></script>
    <script src="./js/category.js"></script>
</head>

<body class="main-container">

    <nav id="nav"> </nav>



    <div class="content-container">



        <div class="section-container">
            <h1>Terms of service</h1>

            <h5 class="section-header">OVERVIEW</h5>

            <div class="section-body">

                This website is operated by ArBeCa Team. ArBeCa Team offers this website,
                including all information, tools and services available from this site to you,
                the user, conditioned upon your acceptance of all terms, conditions, policies
                and notices stated here. <br> <br>

                By visiting our site and/ or purchasing something from us, you engage in our “Service” and agree to be
                bound by the following terms and conditions (“Terms of Service”, “Terms”), including those additional
                terms and conditions and policies referenced herein and/or available by hyperlink. These Terms of
                Service apply to all users of the site, including without limitation users who are browsers, vendors,
                customers, merchants, and/ or contributors of content. <br> <br>

                Please read these Terms of Service carefully before accessing or using our website. By accessing or
                using any part of the site, you agree to be bound by these Terms of Service. If you do not agree to all
                the terms and conditions of this agreement, then you may not access the website or use any services. If
                these Terms of Service are considered an offer, acceptance is expressly limited to these Terms of
                Service. <br><br>

                Any new features or tools which are added to the current store shall also be subject to the Terms of
                Service. You can review the most current version of the Terms of Service at any time on this page. We
                reserve the right to update, change or replace any part of these Terms of Service by posting updates
                and/or changes to our website. It is your responsibility to check this page periodically for changes.
                Your continued use of or access to the website following the posting of any changes constitutes
                acceptance of those changes. <br>

            </div>


            <h5>SECTION 1 - ONLINE STORE TERMS</h5>
            <div class="section-body">

                By agreeing to these Terms of Service, you represent that you are at least the age of majority in your
                state or province of residence, or that you are the age of majority in your state or province of
                residence and you have given us your consent to allow any of your minor dependents to use this site.
                <br><br>

                You may not use our products for any illegal or unauthorized purpose nor may you, in the use of the
                Service, violate any laws in your jurisdiction (including but not limited to copyright laws).
                <br><br>

                You must not transmit any worms or viruses or any code of a destructive nature. <br> A breach or
                violation
                of any of the Terms will result in an immediate termination of your Services.

            </div>

            <h5> SECTION 2 - GENERAL CONDITIONS</h5>
            <div class="section-body">

                We reserve the right to refuse service to anyone for any reason at any time. <br>
                You understand that your
                content (not including credit card information), may be transferred unencrypted and involve (a)
                transmissions over various networks; and (b) changes to conform and adapt to technical requirements of
                connecting networks or devices.

            </div>



            <h5> SECTION 3 - ACCURACY, COMPLETENESS AND TIMELINESS OF INFORMATION</h5>
            <div class="section-body">
                We are not responsible if information made available on this site is not accurate, complete or current.
                The material on this site is provided for general information only and should not be relied upon or used
                as the sole basis for making decisions without consulting primary, more accurate, more complete or more
                timely sources of information. Any reliance on the material on this site is at your own risk.
            </div>


            <h5>SECTION 4 - MODIFICATIONS TO THE SERVICE AND PRICES</h5>
            <div class="section-body">
                Prices for our products are subject to change without notice. We reserve the right at any time to modify
                or discontinue the Service (or any part or content thereof) without notice at any time.
            </div>

            <h5>SECTION 5 - PERSONAL INFORMATION</h5>
            <div class="section-body">
                Your submission of personal information through the store is governed by our Privacy Policy.
            </div>

            <h5>SECTION 6 - ERRORS, INACCURACIES AND OMISSIONS</h5>
            <div class="section-body">
                Occasionally there may be information on our site or in the Service that contains typographical errors,
                inaccuracies or omissions that may relate to product descriptions, pricing, promotions, offers, product
                shipping charges, transit times and availability. We reserve the right to correct any errors,
                inaccuracies or omissions, and to change or update information or cancel orders if any information in
                the Service or on any related website is inaccurate at any time without prior notice (including after
                you have submitted your order).

                We undertake no obligation to update, amend or clarify information in the Service or on any related
                website, including without limitation, pricing information, except as required by law. No specified
                update or refresh date applied in the Service or on any related website, should be taken to indicate
                that all information in the Service or on any related website has been modified or updated.
            </div>

            <h5>SECTION 7 - SEVERABILITY</h5>
            <div class="section-body">
                In the event that any provision of these Terms of Service is determined to be unlawful, void or
                unenforceable, such provision shall nonetheless be enforceable to the fullest extent permitted by
                applicable law, and the unenforceable portion shall be deemed to be severed from these Terms of Service,
                such determination shall not affect the validity and enforceability of any other remaining provisions.
            </div>


            <h5>SECTION 8 - CHANGES TO TERMS OF SERVICE</h5>
            <div class="section-body">
                You can review the most current version of the Terms of Service at any time at this page.We reserve the
                right, at our sole discretion, to update, change or replace any part of these Terms of Service by
                posting updates and changes to our website. It is your responsibility to check our website periodically
                for changes. Your continued use of or access to our website or the Service following the posting of any
                changes to these Terms of Service constitutes acceptance of those changes.
            </div>

        </div>


    </div>


    <nav id="services"> </nav>
    <div id="user-chat"> </div>

    <div id="site-footer"></div>


    <!-- product click -->
    <script>
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
    </script>



    <!-- Fetch Pages -->
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

</body>

</html>