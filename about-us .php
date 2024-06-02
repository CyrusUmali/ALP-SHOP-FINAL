<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./resources/css/about-us (1).css">
	<title>About Us</title>

	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<link rel="stylesheet" href="./alp.css">

	<style>
		.site-footer {
			background-color: red !important;
			width: 1700px;
		}

		.row1pg p,
		.row2pg p,
		.row3pg p {
			text-align: justify;
		}

		#seamless {
			margin-left: 400px !important;
		}
	</style>

</head>





<body class="main-container">
	<nav id="nav"> </nav>


	<!-- <nav> 
	<ul>Hamburger Button</ul>
	<ul>Search</ul>
	</nav> -->


	<div class="Top">
		<h1>About Us</h1>
		<!-- <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8bGFuZHNjcGFlJTIwY2xvdGhpbmd8ZW58MHx8MHx8fDA%3D" alt="PIC"> -->
	</div>
	<p class="tagline"><span>'At the end, reality is just a support for our dreams to stand'</span> - Diarra Bousso</p>
	<div class="rows">
		<div class="row1">
			<div class="row1pic">
				<img src="./resources/about-1.jpg" alt="PIC">
			</div>
			<div class="row1pg">
				<span>Welcome to ALP.Shop</span>
				<p> &emsp; &emsp; Welcome to ALP. Shop, your go to destination for affordable and fashionable finds.
					Founded by Ms. Alejandra L. Papa a working student with a passion for a style and a
					committment to budget-friendly shopping, ALP.Shop is dedicated to providing customers
					with trendy and quality products at unbeatable prices. </p>
				<p> &emsp; &emsp; At ALP.Shop, we believe that everyone deserves to look and feel their best without
					compromising on style or breaking the bank. Our curated selection of fashion-forward
					items ensure that you can stay on trend without sacrificing your budget.</p>
			</div>
		</div>
		<div class="row2">
			<div class="row2pg">
				<span id="seamless">Seamless Shopping</span>
				<p>&emsp; &emsp;With the focus on customer satisfaatio and accessibility, ALP.Shop offers
					a seamless shopping experience both online and in-store. Our team is dedicated to
					providing exeptional service and helping you find the perfect pieces to elevate your
					wardrobe.
				</p>
			</div>
			<div class="row2pic">
				<img src="./resources/about-2.jpg" alt="PIC">
			</div>
		</div>
		<div class="row3">
			<div class="row3pg">
				<span>Latest Fashion Essentials</span>
				<p>&emsp; &emsp;Wheteher you're searching for the latest fashion essentials, statement accessories, or stylish gifts,
					ALP.Shop has you covered. Join us on our mission to make affordable fashion accessible to all, and
					discovered the joy of chic, budget-friendly shopping at ALP.Shop today.
				</p>
			</div>
			<div class="row3pic">
				<img src="./resources/about-3.jpg" alt="PIC">
			</div>
		</div>




		<!-- <div class="row4">
			<div class="row4-header">
        	<h2>Shop All Products <a href="">View all</a></h2>
		</div>
			<div class="row4pics">
			    <div class="pic-container">
			        <div id="pic5"></div>
			        <h3>Text for pic1</h3>
			    </div>
			    <div class="pic-container">
			        <div id="pic6"></div>
			        <h3>Text for pic2</h3>
			    </div>
			    <div class="pic-container">
			        <div id="pic7"></div>
			        <h3>Text for pic3</h3>
			    </div>
			    <div class="pic-container">
			        <div id="pic8"></div>
			        <h3>Text for pic4</h3>
			    </div>
			</div>
	</div> -->



 


		<!-- <div id="services"></div>
    <div id="site-footer"></div>
 -->





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