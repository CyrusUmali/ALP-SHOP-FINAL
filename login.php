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
    <!-- <script src="./js/auth-check.js"></script> -->
    <script src="./js/category.js"></script>
    <script src="./js/prod-search.js"></script>
    <script src="./js/user-chat.js"></script>



</head>

<body class="main-container">

    <nav id="nav"> </nav>


    <div id="menu"></div>



    <div class="content-container">



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
                    <h1>Sign in</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your account</span>
                    <input type="email" id="logInEmailInput" placeholder="Email" />
                    <input type="password" id="logInPassInput" placeholder="Password" />

                    <div class="actions-wrapper">
                        <!-- <a href="#">Forgot your password?</a> -->

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
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <div id="user-chat"> </div>
    <div id="services"></div>
    <div id="site-footer"></div>



    <script>
        // Get the checkbox element
        var rememberCheckbox = document.getElementById('rememberCheckbox');

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



        // // Retrieve email and password from cookies
        // var emailCookie = getCookie('email');
        // var passwordCookie = getCookie('password');


        // Populate email and password fields
        // if (emailCookie && passwordCookie) {
        //     document.getElementById('logInEmailInput').value = emailCookie;
        //     document.getElementById('logInPassInput').value = passwordCookie;

        //     // Set the checkbox to be checked
        //     rememberCheckbox.checked = true;
        //     console.log('Cookieiies!D');


        // } else {
        //     console.log('gutom ako wala cookie');
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




        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });



        function signUpClick(event) {
            event.preventDefault();

            var signUpFN = document.getElementById('signUpFN').value;
            var signUpLN = document.getElementById('signUpLN').value;
            var signUpEmail = document.getElementById('signUpEmail').value;
            var signUpPass = document.getElementById('signUpPass').value;
            var signUpConfirmPass = document.getElementById('signUpConfirmPass').value;



            if (signUpPass !== signUpConfirmPass) {
                document.getElementById('result').textContent = "Passwords do not match";
                return;
            }

            axios.post('./php/signup.php', {
                    first_name: signUpFN,
                    last_name: signUpLN,
                    email: signUpEmail,
                    password: signUpPass
                })
                .then(response => {
                    if (response.data.success) {
                        // Display success message
                        document.getElementById('result').textContent = "Signed Up Successfully";
                        document.getElementById('result').style.color = '#28a745';
                        console.log("User registered successfully.");
                    } else {
                        // Display error message

                        document.getElementById('result').textContent = response.data.error;
                        console.error("Error registering user:", response.data.error);
                    }
                })
                .catch(error => {
                    // Display error message

                    document.getElementById('result').textContent = "An error occurred while signing up";
                    console.error("Error:", error);
                });
        }


        function logInClick(event) {
            // Assume authToken is the authentication token you want to store
            const authToken = "SignedIn";

            event.preventDefault();
            var logInEmailInput = document.getElementById('logInEmailInput').value;
            var logInPassInput = document.getElementById('logInPassInput').value;
            var rememberCheckbox = document.getElementById('rememberCheckbox');
            var checkBoxVal = rememberCheckbox.checked;


            axios.post('./php/login.php', {
                    email: logInEmailInput,
                    password: logInPassInput,
                    checkBoxVal: checkBoxVal
                })
                .then(response => {
                    if (response.data.success) {
                        // User authenticated successfully
                        console.log("User authenticated successfully.");
                        document.getElementById('login-result').textContent = "Signed In Successfully";
                        // Add the authentication token to session storage

                        // Store user information in localStorage
                        localStorage.setItem("userInfo", JSON.stringify(response.data.userInfo[0].customer_id));
                        localStorage.setItem("authToken", authToken);

                        window.location.href = 'user-page.php';
                    } else {
                        // Invalid email or password
                        console.error("Invalid email or password:", response.data.error);
                        document.getElementById('login-result').textContent = response.data.error;
                    }
                })
                .catch(error => {
                    // Handle any errors that occurred during the request
                    console.error("Error:", error);
                    document.getElementById('login-result').textContent = "An error occurred while logging in";
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