<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./nav.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="..." crossorigin="anonymous">
    <link rel="stylesheet" href="./alp.css">
    <!-- <script src="./js/homepage-bigslider.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="./js/prod-search.js"></script>
    <script src="./js/user-chat.js"></script>
    <script src="./js/user-chat.js"></script>


    <style>
        .featured-products-container .product {

            width: 306px !important;
            opacity: 1 !important;



        }

        .featured-products-container .product .black {

            bottom: 90px !important;

        }
    </style>

    



</head>


<body class="main-container">

    <nav id="nav" class="nav-main-container"> </nav>

    <div id="menu">

    </div>








    <div class="content-container">



        <div class="big-slider">



            <i id="prevBtn" class="fas fa-angle-left" onclick="prevImage()"></i>
            <i id="nextBtn" class="fas fa-angle-right" onclick="nextImage()"></i>
        </div>



        <div class="product-category">

            <h1>Shop By Category</h1>

            <div class="category-btn">

                <button onclick="leftClickCateg(event)" class="left-click hide"> <i class="fas fa-angle-left"></i> </button>
                <button onclick="rightClickCateg(event)" class="right-click"> <i class="fas fa-angle-right"></i>
                </button>

            </div>

            <div class="category-wrapper">
                <div class="product">
                    <img src="https://plus.unsplash.com/premium_photo-1673356302067-aac3b545a362?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8dHNoaXJ0fGVufDB8fDB8fHww" alt="">
                    <button onclick="categLabelClick(1)">Shirts</button>

                </div>

                <div class="product">
                    <img src="https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059575/1711148884018_oakiwb.jpg" alt="">
                    <button onclick="categLabelClick(3)">Dresses</button>
                </div>

                <div class="product">
                    <img src="https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8cGFudHN8ZW58MHx8MHx8fDA%3D" alt="">
                    <button onclick="categLabelClick(2)">Pants & Trousers</button>
                </div>




                <div class="product">
                    <img src="https://images.unsplash.com/photo-1584184804426-5e2aa23c2937?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YWNjZXNvcmllc3xlbnwwfDF8MHx8fDA%3D" alt="">
                    <button onclick="categLabelClick(4)">Accesories</button>
                </div>


                <div class="product">
                    <img src="https://images.unsplash.com/photo-1606201900810-ed28d7f6c8d1?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGFzc29ydGVkJTIwZmFzaGlvJTIwaXRlbXN8ZW58MHwxfDB8fHww" alt="">
                    <button onclick="categLabelClick(5)">Others</button>
                </div>

            </div>

        </div>


        <script>
            const leftCatButton = document.querySelector('.category-btn .left-click');
            const rightCatButton = document.querySelector('.category-btn .right-click');


            let catCurrentIndex = 0;
            const categoryProds = document.querySelectorAll('.category-wrapper .product');

            function rightClickCateg(event) {
                console.log('rightclick');
                catCurrentIndex = (catCurrentIndex + 1) % categoryProds.length;
                const translateValue = -catCurrentIndex * (categoryProds[0].offsetWidth + 30); // 10 is the margin-right
                document.querySelector('.category-wrapper').style.transform = `translateX(${translateValue}px)`;
                console.log(catCurrentIndex);

                if (catCurrentIndex >= 1) {
                    rightCatButton.classList.add('hide');
                }

                if (catCurrentIndex >= 1) {
                    leftCatButton.classList.remove('hide');
                }

            }

            function leftClickCateg(event) {
                console.log('leftclick');
                catCurrentIndex = (catCurrentIndex - 1 + categoryProds.length) % categoryProds.length;
                const translateValue = -catCurrentIndex * (categoryProds[0].offsetWidth + 30); // 10 is the margin-right
                document.querySelector('.category-wrapper').style.transform = `translateX(${translateValue}px)`;



                if (catCurrentIndex == 0) {
                    leftCatButton.classList.add('hide');
                }

                if (featureProdCurrentIndex <= 2) {
                    rightCatButton.classList.remove('hide');
                }


            }
        </script>





        <div class="new-arrivals-banner">

            <div class="body">

                <h1 class="text-t">Fresh Finds Await</h1>

                <span class="text-p">
                    Embrace the excitement of discovery with our latest arrivals. Unveil a world of new possibilities
                    and style with every click.

                </span>

                <button onclick="categLabelClick(0)"> Explore New Arrivals</button>


            </div>


        </div>


        <div class="home-page">

            <div class="featured-products-container">


                <div class="header">
                    <p>Most Popular</p>
                    <h2>Featured Products</h2>
                </div>



                <div class="navigation">
                    <div class="left hide"> <i class="fas fa-angle-left"></i></div>
                    <div class="right "> <i class="fas fa-angle-right"></i></div>
                </div>
                <div class="product-wrapper">
                </div>

                <footer>
                    <a href="./all-products.php">

                        <button class="show-more">Show More</button></a>
                </footer>

            </div>



        </div>









    </div>



    <div id="user-chat"> </div>
    <div id="services"></div>
    <div id="site-footer"> </div>


    <!-- <div id="id-page"> </div> -->




    <script src="./js/homepage-bigslider.js"> </script>










    <script>
        function toggleSubNav(element) {
            var subNav = element.nextElementSibling;
            var angleIcon = element.querySelector('.fas');

            subNav.classList.toggle('show');
            angleIcon.classList.toggle('fa-angle-up');
            angleIcon.classList.toggle('fa-angle-down');
        }




        let lastScrollTop = 0;
        const hideClass = 'hide';
        const content = document.querySelector('.nav-main-container');

        window.addEventListener('scroll', function() {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop) {
                // Scroll Down
                content.classList.add(hideClass);
            } else {
                // Scroll Up
                content.classList.remove(hideClass);
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        });
    </script>








    <script src="./js/getFeaturedProducts.js"></script>








    <!-- product click -->
    <script>
        // Function to handle clicks on product elements
        function handleProductClick(event) {
            // Check if the clicked element or its parent has the class "product"



            const categoryElement = event.target.closest('.item-div');
            if (categoryElement) {
                const categoryLabel = categoryElement.querySelector('label').textContent;
                const categoryId = categoryElement.querySelector('label').getAttribute('category-id');

                localStorage.setItem('categoryLabel', categoryLabel);
                localStorage.setItem('categoryId', categoryId);
                window.location.href = 'all-products.html';
            }




            const productElement = event.target.closest('.featured-products-container .product');
            if (productElement) {
                // Extract product_id from data-product-id attribute
                const productId = productElement.getAttribute('product-id');
                // Redirect to item-page.html with product_id
                // window.location.href = `item-page.html?product_id=${productId}`;


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
        }




        // Add click event listener to the entire document
        document.addEventListener("click", handleProductClick);
    </script>





    <script src="./js/category.js"></script>


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


    <!-- fetcg pages -->
    <script>
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


        // Fetch the HTML content from another file
        //fetvh nav.php
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
    </script>








</body>

</html>