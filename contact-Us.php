<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./alp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="..." crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <link rel="stylesheet" href="./resources/css/contactUs.css">

    <script src="./js/prod-search.js"></script>
    <script src="./js/user-chat.js"></script>

    <script src="../js/category.js"></script>





</head>

<body class="main-container">

    <nav id="nav"> </nav>


    <div id="menu"></div>


    <div class="pop-up-overlay hide ">

        <div class="pop-up-sucess hide  ">

            <div class="content">

                <i class="fas fa-check"></i>

                <h2>Thank you!</h2>
                <label for="">Your message has been Sent</label>
                <button onclick="successOkClick(event)">Ok</button>

            </div>





        </div>






        <div class="pop-up-failed hide   ">

            <div class="content">

                <i class="fas fa-xmark"></i>

                <h2>Error!</h2>
                <label for="">Failed to Deliver Message</label>
                <button onclick="failedOkClick(event)">Try Again</button>

            </div>





        </div>

    </div>




    <div class="content-container">




        <div class="contact-us-container">


            <h1>Contact Us</h1>



            <div class="info-portion">

                <div class="upper-block">

                    <div class="head">

                        <i class="fas fa-phone"></i> <span class="label">Call to Us</span>



                    </div>

                    <div class="text-body">

                        <p>We are available 24/7, 7 days a week.</p>
                        <span>Phone:090909090909</span>

                    </div>

                </div>



                <div class="lower-block">

                    <div class="head">

                        <i class="far fa-envelope"></i> <span class="label">Write To Us</span>


                    </div>

                    <div class="text-body">

                        <p>Fill out our form and we will contact you within 24 hours.</p>
                        <span>Email: alejandrapapa797@gmail.com
                        </span>

                    </div>

                </div>


            </div>







            <form class="form-portion">




                <div class="upper-wrapper">

                    <input type="text" title="Name" id="Name" placeholder="Your Name" maxlength="250" required>
                    <input type="email" title="Email" id="Email" placeholder="Your Email" maxlength="250" required>
                    <input type="number" title="Phone" id="Phone" placeholder="Phone Number" maxlength="250" required>


                </div>

                <div class="message-wrapper">

                    <textarea required maxlength="250" id="Message" cols="30" rows="10" placeholder="Your Message"></textarea>

                </div>

                <div class="lower-wrapper">

                    <button type="" onclick="submitMessageClick(event)">Send Message</button>

                </div>



            </form>




        </div>

        <!-- <div class="visit-page-container">

            <span>
                STAY UPTO DATE ABOUT OUR LATEST OFFERS
            </span>

            <img src="./resources/alp-shop-logo.jpg" alt="">

            <button onclick="visitFbclick(event)">
                Visit Our Facebook Page
            </button>

        </div> -->





    </div>

    <div>

    </div>
    <div id="user-chat"> </div>
    <div id="services"></div>
    <div id="site-footer"></div>


    <script>


    </script>

    <script>
        function visitFbclick() {
            window.location.href = 'https://www.facebook.com/profile.php?id=100063693235245';
        }

        // console.log("Name :", Name);
        // console.log("Email :", Email);
        // console.log("Phone :", Phone);
        // console.log("Message :", Message);


        const popupOverlay = document.querySelector('.pop-up-overlay');
        const successPopup = document.querySelector('.pop-up-sucess');
        const failedPopup = document.querySelector('.pop-up-failed');
   

        function successOkClick(event) {
            successPopup.classList.add('hide'); 
            popupOverlay.classList.add('hide');
           

        }

        function failedOkClick(event){
            failedPopup.classList.add('hide');
            popupOverlay.classList.add('hide'); 
           
        }

        function submitMessageClick(event) {


            event.preventDefault();


            var Name = document.getElementById('Name').value;
            var Email = document.getElementById('Email').value;
            var Phone = document.getElementById('Phone').value;
            var Message = document.getElementById('Message').value;




            axios.post('./php/contactForm.php', {
                    name: Name,
                    email: Email,
                    phone: Phone,
                    message: Message
                })
                .then(response => {
                    console.log(response.data)
                    if (response.data.success) {
                        // User authenticated successfully
                        // console.log("User authenticated successfully.");
                        console.log('message sent succesfully')

                        popupOverlay.classList.remove('hide');
                        successPopup.classList.remove('hide');
                        failedPopup.classList.add('hide');





                    } else {
                        // Invalid email or password
                        console.error("Invalid:", response.data.error);
                        popupOverlay.classList.remove('hide');
                        failedPopup.classList.remove('hide');
                        successPopup.classList.add('hide');
                        
                        // document.getElementById('login-result').textContent = response.data.error;
                    }
                })
                .catch(error => {
                    // Handle any errors that occurred during the request
                    console.error("Error:", error);

                    popupOverlay.classList.remove('hide');
                        failedPopup.classList.remove('hide');
                });


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
    </script>

</body>

</html>