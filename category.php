<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="./js/prod-search.js"></script>
    <script src="./js/user-chat.js"></script>


    <style>
        .featured-products-container .product-wrapper {
            display: flex;
            justify-content: center;
            padding-right: unset !important;
            flex-direction: row;
            width: 100% !important;
            flex-wrap: wrap !important;
            gap: 30px;
            row-gap: 50px !important;
            margin-bottom: 80px;
            margin-top: 30px !important;


        }


        .featured-products-container .product .black {

            bottom: 87px !important;

        }
    </style>










    <link rel="stylesheet" href="./alp.css">
</head>

<body class="main-container">

    <nav id="nav"> </nav>

    <div id="menu"></div>




    <div class="filter-overlay hide">

        <div class="filter-overlay-main show">

            <div class="filter-overlay-header">

                <h2>Filter</h2> <i onclick="filterXCLICK(event)" class="fas fa-times"></i>

            </div>


            <ul class="filter-method-list">



                <!-- <li class="filter-list-item">

                     <div class="main">
                         <span> Categories </span> <i class="fas fa-angle-down"></i>
                     </div>

                     <ul class="filter-sub-list">
                         <li>Shirts</li>
                         <li>Shirts</li>
                         <li>Shirts</li>
                         <li>Shirts</li>
                         <li>Shirts</li>
                     </ul>

                 </li> -->

                <li class="filter-list-item">


                    <div class="main">
                        <span> Price Range </span> <i class="fas fa-angle-down"></i>
                    </div>


                    <ul class="filter-sub-list">

                        <div>
                            <label for="min-price">Min Price:</label>
                            <input type="number" id="min-price" name="min-price" min="0" step="10" value="0">


                        </div>
                        <div>
                            <label for="max-price">Max Price:</label>
                            <input type="number" id="max-price" name="max-price" min="0" step="10" value="2000">

                        </div>
                    </ul>

                    <script>
                        // Update selected price range when the input values change
                        document.getElementById('min-price').addEventListener('input', updatePriceRange);
                        document.getElementById('max-price').addEventListener('input', updatePriceRange);

                        // Function to update the selected price range
                        function updatePriceRange() {
                            var minPrice = document.getElementById('min-price').value;
                            var maxPrice = document.getElementById('max-price').value;
                        }

                        // Initial call to update the selected price range when the page loads
                        updatePriceRange();
                    </script>




                </li>




                <li class="filter-list-item">

                    <div class="main">
                        <span> Sort By </span> <i class="fas fa-angle-down"></i>
                    </div>

                    <ul class="filter-sub-list">
                        <li data-value="1" class="active">Old - New</li>
                        <li data-value="2">New - Old</li>
                        <li data-value="3">A - Z</li>
                        <li data-value="4">Z - A</li>
                        <li data-value="5">Price L - H</li>
                        <li data-value="6">Price H - L</li>
                    </ul>




                </li>

                <li class="filter-list-item">


                    <div class="main">
                        <span> Availability </span> <i class="fas fa-angle-down"></i>
                    </div>

                    <ul class="filter-stock-list">
                        <li data-value="1" class="active">In Stock</li>
                        <li data-value="2">Out of Stock</li>


                    </ul>





                </li>


                <li class="filter-list-item">


                    <div class="main">
                        <span> Rating </span> <i class="fas fa-angle-down"></i>
                    </div>

                    <ul class="filter-ratings-list">
                        <li>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <input type="radio" name="rating-filter" prod-rating=5 id="rating-5">
                        </li>


                        <li>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>

                            </div>
                            <input type="radio" name="rating-filter" prod-rating=4 id="rating-4">
                        </li>


                        <li>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <input type="radio" name="rating-filter" prod-rating=3 id="rating-3">
                        </li>

                        <li>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>

                            </div>
                            <input type="radio" name="rating-filter" prod-rating=2 id="rating-2">
                        </li>


                        <li>
                            <div class="stars">
                                <i class="fas fa-star"></i>

                            </div>
                            <input type="radio" name="rating-filter" prod-rating=1 id="rating-1">
                        </li>

                        <li>
                            <div class="stars">
                                <i class="fas fa-minus"></i>

                            </div>
                            <input type="radio" name="rating-filter" prod-rating=0 id="rating-0" checked>
                        </li>


                    </ul>




                </li>





            </ul>




            <div class="filter-overlay-footer">

                <button onclick="applyFilterClick(event)">Apply Now</button>

            </div>

        </div>

    </div>



    <div class="content-container">

        <div class="home-page">



            <div class="featured-products-container">


                <h1 class="all-products-header" id="Category-Holder">Category</h1>

                <div class="control-container">

                    <div class="filter" onclick="filterClick(event)">
                        <!-- <i class="fas fa-filter"></i> -->

                        <img width="24" height="24" src="https://img.icons8.com/ios/50/sorting-options--v1.png" alt="sorting-options--v1" />


                        <span>Filter</span>
                    </div>

                    <!-- <div class="category">


                         <select title="Category" id="categorySelect">
                             <option value="0">Category</option>

                             <option value="1">Shirts</option>
                             <option value="2">Pants & Trousers</option>
                             <option value="3">Dresses</option>


                             <option value="4">Accesories </option>
                             <option value="5">Others </option>




                         </select>


                         <i class="fas fa-angle-down" id="category-down"></i>

                     </div> -->

                </div>

                <div class="product-wrapper">




                </div>



            </div>


            <!-- <div class="page-control">

                 <ul>
                     <li><a href="">1</a></li>
                     <li><a href="">2</a></li>
                     <li><a href="">3</a></li>
                     <li><a href="">...</a></li>
                     <li><a href="">10</a></li>
                     <li><a href=""><i class="fas fa-angle-right"></i></a></li>
                 </ul>

             </div> -->


        </div>
    </div>


    <div id="user-chat"> </div>
    <div id="services"></div>
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
                window.location.href = 'all-products.php';
            }



            const productElement = event.target.closest('.product');
            if (productElement) {
                // Extract product_id from data-product-id attribute
                const productId = productElement.getAttribute('product-id');
                console.log('productID', productId);
                // Redirect to item-page.html with product_id


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


    <script>
        // Check if the category key exists in session storage

        // Retrieve the category from session storage
        var category = localStorage.getItem('categoryId');
        console.log('categoryId', category);

        axios.get('./php/categ-products.php', {
                params: {
                    category: category
                }
            }).then(response => {
                // Handle the response from the server
                console.log(response.data);
                // Check if the request was successful
                if (response.data.success) {


                    const AllProducts = response.data.products;


                    localStorage.setItem('AllProducts', JSON.stringify(AllProducts));
                    const productsContainer = document.querySelector('.product-wrapper'); // Assuming you have a container element with id "products-container"


                    // Iterate over each product and generate HTML dynamically
                    AllProducts.forEach(product => {
                        const productHTML = `
        <div class="product" product-id="${product.product_id}"
        onmouseleave="hideBlack(event)"
        onmouseenter="showBlack(event)">
            <img src="${product.img}" alt="${product.name}"> 
            <span class="black">Quick View</span>
            <div class="desc">
                <p>${product.name}</p>
                <span class="cost"><i class="fas fa-peseta-sign"></i> ${product.variation_price}</span>
            </div>
        </div>
    `;
                        // Append the HTML to the products container
                        productsContainer.innerHTML += productHTML;


                        handleScroll();


                    });
                } else {
                    // Handle error if the request was not successful aha
                    console.error("Error retrieving data from the server:", response.data);
                }
            })
            .catch(error => {
                // Handle any errors that occurred during the request
                console.error("Error:", error);
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



    <script>
        // Get all list items
        const listItems = document.querySelectorAll('.filter-sub-list li');

        // Add click event listener to each list item
        listItems.forEach(item => {
            item.addEventListener('click', () => {
                // Remove active class from all list items
                listItems.forEach(li => {
                    li.classList.remove('active');
                });

                // Add active class to the clicked item
                item.classList.add('active');


            });
        });

        const stockItems = document.querySelectorAll('.filter-stock-list li');

        // Add click event listener to each list item
        stockItems.forEach(Sitem => {
            Sitem.addEventListener('click', () => {
                // Remove active class from all list items
                stockItems.forEach(li => {
                    li.classList.remove('active');
                });

                // Add active class to the clicked item
                Sitem.classList.add('active');


            });
        });
    </script>



    <script src="./js/category.js"></script>









    <script>
        function showBlack(event) {

            const product = event.currentTarget; // Get the element being hovered over
            const quickView = product.querySelector('.black');
            quickView.classList.add('show');
        }

        function hideBlack(event) {

            const product = event.currentTarget; // Get the element being hovered over
            const quickView = product.querySelector('.black');
            quickView.classList.remove('show');

        }





        const filterOverlayElement = document.querySelector('.filter-overlay.hide');
        const filterMainElement = document.querySelector('.filter-overlay-main');

        function filterClick(event) {



            filterOverlayElement.classList.remove('hide');

            // Remove the 'show' class from the main content immediately


            // Delay hiding the overlay
            setTimeout(function() {
                // Hide the overlay after a delay
                filterMainElement.classList.add('show');
            }, 200); // Adjust the delay time (in milliseconds) as needed




        }

        function filterXCLICK(event) {

            // Remove the 'show' class from the main content immediately
            filterMainElement.classList.remove('show');

            // Delay hiding the overlay
            setTimeout(function() {
                // Hide the overlay after a delay
                filterOverlayElement.classList.add('hide');
            }, 200); // Adjust the delay time (in milliseconds) as needed

        }

        function applyFilterClick(event) {
            const activeLi = document.querySelector('.filter-sub-list li.active');
            const dataValue = activeLi.getAttribute('data-value');

            const activeStock = document.querySelector('.filter-stock-list li.active');
            const stockDataValue = activeStock.getAttribute('data-value');

            console.log('data-value of Sort li:', dataValue);
            console.log('data-value of Stock li:', stockDataValue);

            const minPrice = document.getElementById('min-price');
            console.log('minPrice: ', minPrice.value);

            const maxPrice = document.getElementById('max-price');
            console.log('minPrice: ', maxPrice.value);

            const ratingRadios = document.querySelectorAll('.filter-ratings-list input[type="radio"]');
            let checkedRating = null;
            ratingRadios.forEach(radio => {
                if (radio.checked) {
                    checkedRating = radio.getAttribute('prod-rating');
                }
            });
            console.log('Checked rating:', checkedRating);




            // Make Axios request
            axios.post('./php/site-scripts/filter-prod.php', {
                    dataValue: dataValue,
                    stockDataValue: stockDataValue,
                    maxPrice: maxPrice.value,
                    minPrice: minPrice.value,
                    checkedRating: checkedRating
                })
                .then(response => {
                    // Handle response if needed
                    console.log('Response:', response.data);




                    if (response.data.success) {


                        const AllProducts = response.data.filteredProducts;


                        localStorage.setItem('AllProducts', JSON.stringify(AllProducts));
                        const productsContainer = document.querySelector('.product-wrapper'); // Assuming you have a container element with id "products-container"

                        productsContainer.innerHTML = '';

                        // Iterate over each product and generate HTML dynamically
                        AllProducts.forEach(product => {
                            const productHTML = `
                     <div class="product" product-id="${product.product_id}"
                          onmouseleave="hideBlack(event)"
                          onmouseenter="showBlack(event)">
                          <img src="${product.img}" alt="${product.name}"> 
                           <span class="black">Quick View</span>
                          <div class="desc">
                         <p>${product.name}</p>
                              <span class="cost"><i class="fas fa-peseta-sign"></i> ${product.variation_price}</span>
</div>
</div>
`;




                            // Append the HTML to the products container
                            productsContainer.innerHTML += productHTML;


                            var categoryElement = document.getElementById('Category-Holder');
                            categoryElement.textContent = "Filter Results";
                            handleScroll();

                        });
                    } else {
                        // Handle error if the request was not successful aha
                        console.error("Error retrieving data from the server:", response.data);
                    }

                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                });





            filterXCLICK();
        }





        // Function to check if a certain portion of an element is in the viewport
        function isPartiallyInViewport(element, threshold) {
            var rect = element.getBoundingClientRect();
            var height = window.innerHeight || document.documentElement.clientHeight;
            return rect.bottom >= 0 && rect.top <= height * threshold;
        }

        // Function to handle scroll event
        function handleScroll() {
            var products = document.querySelectorAll('.product');
            products.forEach(function(product) {
                if (isPartiallyInViewport(product, 0.9)) {
                    product.classList.add('show'); // Add the class to trigger the transition
                }
            });
        }






        document.addEventListener('DOMContentLoaded', function() {




            // Get all filter-list-item main
            var filterItemHead = document.querySelectorAll('.filter-list-item .main');

            // Attach click event listeners to each sub-nav header
            filterItemHead.forEach(function(header) {
                header.addEventListener('click', function() {


                    // Toggle 'show' class for the sibling ul element
                    var subNav = this.nextElementSibling;
                    if (subNav && subNav.classList.contains('filter-sub-list')) {
                        subNav.classList.toggle('show');
                    }

                    var stockSubNav = this.nextElementSibling;
                    if (stockSubNav && stockSubNav.classList.contains('filter-stock-list')) {
                        stockSubNav.classList.toggle('show');
                    }


                    // Rotate the angle-down icon
                    var icon = this.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('rotate');
                    }

                });
            });










            // Initial check on page load
            handleScroll();

            // Listen for scroll events
            window.addEventListener('scroll', handleScroll);


        });
    </script>


</body>

</html>