<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./alp.css">
    <link rel="stylesheet" href="./resources/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="..." crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../js/category.js"></script>

    <script src="./js/prod-search.js"></script>
    <script src="./js/user-chat.js"></script>

</head>

<body class="main-container">

    <nav id="nav"> </nav>


    <div id="menu"></div>



    <div class="content-container">



        <div class="container" id="container">

            <div class="form-container sign-in-container">
                <form action="#">
                    <h1>Sign in</h1>


                    <input type="text" id="logInEmailInput" placeholder="Email" />
                    <input type="password" id="logInPassInput" placeholder="Password" />

                    <span class="warning">Wrong Credentials!</span>
                    <!-- <a href="#">Forgot your password?</a> -->
                    <button onclick="signInClick(event)">Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">

                    <div class="overlay-panel overlay-right">
                        <h1>Welcome Admin!</h1>
                        <p>Enter the correct User and Password to add and manage products</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="mobile-admin-login">

            <h1>Welcome Admin</h1>
            <label>

            Enter the correct User and Password to add and manage products

            </label>


            <input type="text" id="mobLogInEmailInput" placeholder="Email" />
            <input type="password" id="moblogInPassInput" placeholder="Password" />

            <span class="mobWarning">Wrong Credentials!</span>
            <!-- <a href="#">Forgot your password?</a> -->
            <button onclick="mobSignInClick(event)">Sign In</button>

        </div>




    </div>
    <div id="user-chat"> </div>
    <div id="services"></div>
    <div id="site-footer"></div>


    <script>
    function mobSignInClick(event) {
            // Assume authToken is the authentication token you want to store
            const authToken = "SignedIn";

            event.preventDefault();

            const warning = document.querySelector('.mobWarning');
            const email = document.getElementById('mobLogInEmailInput').value;
            const password = document.getElementById('moblogInPassInput').value;


            axios.post('./php/admin/admin-signin.php', {
                    email: email,
                    password: password,
                })
                .then(response => {
                    if (response.data.success) {
                        // User authenticated successfully
                        console.log("Admin authenticated successfully.");



                        window.location.href = 'admin-page.php';
                    } else {
                        // Invalid email or password


                        console.error("Invalid email or password:", response.data.error);
                        warning.classList.add('show');
                       
                    }
                })
                .catch(error => {
                    // Handle any errors that occurred during the request
                    console.error("Error:", error);
                    warning.classList.add('show');
                });
        }


        function signInClick(event) {
            // Assume authToken is the authentication token you want to store
            const authToken = "SignedIn";

            event.preventDefault();

            const warning = document.querySelector('.warning');
            const email = document.getElementById('logInEmailInput').value;
            const password = document.getElementById('logInPassInput').value;


            axios.post('./php/admin/admin-signin.php', {
                    email: email,
                    password: password,
                })
                .then(response => {
                    if (response.data.success) {
                        // User authenticated successfully
                        console.log("Admin authenticated successfully.");



                        window.location.href = 'admin-page.php';
                    } else {
                        // Invalid email or password


                        console.error("Invalid email or password:", response.data.error);
                        warning.classList.add('show');
                    }
                })
                .catch(error => {
                    // Handle any errors that occurred during the request
                    console.error("Error:", error);
                });
        }
    </script>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
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

</body>

</html>