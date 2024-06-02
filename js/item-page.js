var cartDetails;  // Define cartDetails globally

// Define totalPrice globally
let realTotalPrice = 0;


document.addEventListener('DOMContentLoaded', function () {
    // Retrieve itemDetails from localStorage








    // Define variables to store the clicked combination, price, and stock
    let clickedProductName = null;
    let clickedProductId = null;
    let productImage = null;
    let clickedProductColor = null;
    let clickedProductSize = null;
    let clickedProductPrice = null;
    let clickedProductVariationId = null;
    let clickedProductImg = null;
    let clickedProductStock = null;
    let availableSize = null;
    let availableColors = null;

    let selectVariation = null;






    const quantityInput = document.getElementById('QuantityInput');
    const minusButton = document.getElementById('minusButton');
    const addButton = document.getElementById('addButton');

    minusButton.addEventListener('click', () => {
        // Decrement the value in the quantity input field by 1
        let currentValue = parseInt(quantityInput.value);
        if (!isNaN(currentValue) && currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });
    addButton.addEventListener('click', () => {
        // Increment the value in the quantity input field by 1
        let currentValue = parseInt(quantityInput.value);
        if (!isNaN(currentValue) && (clickedProductStock === null || currentValue < clickedProductStock)) {
            quantityInput.value = currentValue + 1;
        }
    });


    const countWarning = document.querySelector('.quantity .head .count');
    quantityInput.addEventListener('input', () => {
        let currentValue = parseInt(quantityInput.value);
        if (isNaN(currentValue) || currentValue < 1 || (clickedProductStock !== null && currentValue > clickedProductStock)) {
            countWarning.classList.add('show');
            if (clickedProductStock !== null && currentValue > clickedProductStock) {
                quantityInput.value = clickedProductStock; // Reset to the maximum available stock
            }
        } else {
            countWarning.classList.remove('show');
        }
    });





    const cartButton = document.getElementById('cartButton');
    cartButton.addEventListener('click', () => {



        let addToCart = true; // Variable to track if all conditions are met


        // console.log('clickedProductVariationId', clickedProductVariationId);
        // console.log('clickedProductImg', clickedProductImg);
        // console.log("clickedProductColor:", clickedProductColor);
        // console.log("clickedProductSize:", clickedProductSize);

        // Check conditions and toggle warning messages


        if (availableColors instanceof Map && availableColors.color !== 0) {
            if (clickedProductColor == null) {
                const colorWarning = document.querySelector('.variant-wrapper .head .warning-color');
                colorWarning.classList.toggle('show');
                console.log('ala color');


                addToCart = false; // Update addToCart if condition is not met
            }
        }



        if (quantityInput.value < 1 || clickedProductStock < quantityInput.value) {
            const quantityWarning = document.querySelector('.quantity .head .count');
            quantityWarning.classList.toggle('show');
            // console.log('huhu');
            addToCart = false; // Update addToCart if condition is not met
        }


        if (availableSize instanceof Map && availableSize.size !== 0) {
            if (clickedProductSize == null) {
                const sizeWarning = document.querySelector('.variant-wrapper .head .warning-size');
                sizeWarning.classList.toggle('show');
                console.log('ala size');
                console.log(availableSize);

                addToCart = false;
            }
        }

        // Log "Added To Cart" if all conditions are met
        if (addToCart) {
            console.log('Added To Cart');




            axios.post('./php/user/add-to-cart.php', {
                quantity: quantityInput.value,
                variation_id: clickedProductVariationId,
            })
                .then(response => {
                    if (response.data.success) {
                        // Display success message
                        console.log("Product Added To Cart Successfully.");

                        closeCartOverlay();



                        axios.get('./php/cart-userId.php')

                            .then(response => {
                                if (response.data.success) {
                                    cartDetails = response.data.userCart; // Set cartDetails here
                                    localStorage.setItem('userCart', JSON.stringify(cartDetails));
                                    console.log("cartdetooo",);

                                    const userCart = localStorage.getItem('userCart');



                                    renderCart(cartDetails); // Call the function to render the cart
                                } else {
                                    console.error("Error retrieving item details:", response.data.error);
                                }
                            })
                            .catch(error => {
                                console.error("Error:", error);
                            });





                    }
                    else if (response.data.noId) {

                        console.log('NO ID: ', response.data.noId);
                        document.querySelector('.overlay-login').classList.remove('hide');

                    }

                    else {
                        // Display error message
                        console.error("Error Adding To Cart:", response.data.error);

                    }
                })
                .catch(error => {
                    // Display error message
                    console.error("An error occurred while adding to cart:", error);
                });







        }




    });





    const wishButton = document.getElementById('wishButton');
    wishButton.addEventListener('click', () => {


        let addtoWish = true; // Variable to track if all conditions are met


        // console.log('clickedProductVariationId', clickedProductVariationId);
        // console.log("clickedProductColor:", clickedProductColor);
        // console.log("clickedProductSize:", clickedProductSize);

        // Check conditions and toggle warning messages


        if (availableColors instanceof Map && availableColors.color !== 0) {
            if (clickedProductColor == null) {
                const colorWarning = document.querySelector('.variant-wrapper .head .warning-color');
                colorWarning.classList.toggle('show');
                console.log('ala color');


                addtoWish = false; // Update addToCart if condition is not met
            }
        }




        if (availableSize instanceof Map && availableSize.size !== 0) {
            if (clickedProductSize == null) {
                const sizeWarning = document.querySelector('.variant-wrapper .head .warning-size');
                sizeWarning.classList.toggle('show');
                console.log('ala size');
                console.log(availableSize);

                addtoWish = false;
            }
        }



        // Log "Added To Cart" if all conditions are met
        if (addtoWish) {
            console.log('Added To Wishlist');




            const wishResponse = document.querySelector('.wishResponse');


            axios.post('./php/user/add-to-wishlist.php', {
                variation_id: clickedProductVariationId,
            })
                .then(response => {
                    if (response.data.success) {
                        // Display success message
                        console.log("Product Added To Wishlist Successfully.");

                        wishResponse.classList.add('show');
                        wishResponse.innerHTML = response.data.message;




                    }
                    else if (response.data.noId) {

                        console.log('NO ID: ', response.data.noId);
                        document.querySelector('.overlay-login').classList.remove('hide');

                    }


                    else {
                        // Display error message
                        console.error("Error Adding To Cart:", response.data.error);
                        wishResponse.classList.add('show');
                        wishResponse.innerHTML = response.data.error;
                    }
                })
                .catch(error => {
                    // Display error message
                    console.error("An error occurred while adding to cart:", error);
                });







        }








    });





    // Event listener for Buy Now button
    const buyButton = document.getElementById('buyButton');
    buyButton.addEventListener('click', () => {
        // Log the clicked product price and stock




        console.log(`Clicked Product Price: ${clickedProductPrice}`);
        console.log(`Clicked Product Stock: ${clickedProductStock}`);


        var buyItem = true;

        if (availableColors instanceof Map && availableColors.color !== 0) {
            if (clickedProductColor == null) {
                const colorWarning = document.querySelector('.variant-wrapper .head .warning-color');
                colorWarning.classList.toggle('show');
                console.log('ala color');


                buyItem = false; // Update addToCart if condition is not met
            }
        }




        if (quantityInput.value < 1 || clickedProductStock < quantityInput.value) {
            const quantityWarning = document.querySelector('.quantity .head .count');
            quantityWarning.classList.toggle('show');
            // console.log('huhu');
            buyItem = false; // Update addToCart if condition is not met
        }


        if (availableSize instanceof Map && availableSize.size !== 0) {
            if (clickedProductSize == null) {
                const sizeWarning = document.querySelector('.variant-wrapper .head .warning-size');
                sizeWarning.classList.toggle('show');
                console.log('ala size');
                console.log(availableSize);

                buyItem = false;
            }
        }



        if (buyItem) {


            axios.post('./php/user/check-auth.php', {
                // Your data to be sent in the request body
            })
                .then(response => {
                    // Check if the customer ID is not set
                    if (response.data.noId) {
                        console.log("Customer ID not set:", response.data.message);
                        document.querySelector('.overlay-login').classList.remove('hide');
                        // Handle the case where customer ID is not set
                    } else {
                        // Handle other cases or success response
                        console.log("Request successful:", response.data);


                        const userInfo = JSON.parse(localStorage.getItem('userInfo'));
                        const userId = userInfo;


                        const cartDetail =
                            [
                                {
                                    "product_id": clickedProductId,
                                    "var_img": clickedProductImg,
                                    "name": clickedProductName,
                                    "variation_id": clickedProductVariationId,
                                    "size": clickedProductSize,
                                    "color": clickedProductColor,
                                    "price": clickedProductPrice,
                                    "quantity": quantityInput.value,

                                },

                            ];

                        const combinedCartData = {
                            userId: userId,
                            realTotalPrice: (parseFloat(clickedProductPrice * quantityInput.value)).toFixed(2),
                            cartDetails: cartDetail
                        };




                        // Use Axios to send the cart data to the server-side script
                        axios.post('./php/site-scripts/save-checkout-items.php', combinedCartData)
                            .then(response => {
                                console.log('Cart data saved to session:', response.data);
                                // Redirect to the shipping details page
                                window.location.href = 'shipping-details.php';
                            })
                            .catch(error => {
                                console.error('Error saving cart data:', error);
                            });

                        // Convert the combined data object to a JSON string
                        // const combinedCartDataString = JSON.stringify(combinedCartData);

                        // Store the combined data string in sessionStorage
                        // sessionStorage.setItem('combinedCartData', combinedCartDataString);
  





                    }
                })
                .catch(error => {
                    // Handle error
                    console.error("Error:", error);
                });



        }
        else {
            console.log('dto');
        }












    });



    const itemDetails = JSON.parse(localStorage.getItem('itemDetails'));
    const productDetailsObject = itemDetails.itemDetails.productDetails.reduce((acc, product, index) => {
        acc[index] = { size: product.size, color: product.color, price: product.price, stock: product.stock };
        return acc;
    }, {});




    // Loop through each product in productDetailsObject
    for (const index in productDetailsObject) {
        if (productDetailsObject.hasOwnProperty(index)) {
            const product = productDetailsObject[index];
            // console.log(`Index: ${index}, Size: ${product.size}, Color: ${product.color} ,
            // Price: ${product.price} , Stock: ${product.stock}`);
        }
    }




    // Check if itemDetails is not empty and contains at least one item
    if (itemDetails && itemDetails.itemDetails.productDetails.length > 0) {
        // Retrieve the product name from the first item in the array
        const productName = itemDetails.itemDetails.productDetails[0].name;
        clickedProductName = productName;

        clickedProductId = itemDetails.itemDetails.productDetails[0].product_id

        // Find the span element by its class name
        const spanElement = document.querySelector('.identity-container span');
        const h2ProductName = document.querySelector('.portion-2 .product-header h2');

        // Set the text content of the span element to the product name
        spanElement.textContent = productName;
        h2ProductName.textContent = productName;



        // Retrieve the image source from the first item in the array
        const imgSrc = itemDetails.itemDetails.productDetails[0].img;

        productImage = imgSrc;

        // Find the img element by its class name
        const imgElement = document.querySelector('.showcase-img img');

        // Set the source attribute of the img element to the image source
        imgElement.src = imgSrc;



        const stockElement = document.querySelector('.portion-2 .product-body .stocks');



        const productPrice = itemDetails.itemDetails.productDetails[0].price;
        const priceElement = document.querySelector('.portion-2 .product-body .cost');

        // Create a text node containing the product price
        const priceTextNode = document.createTextNode(productPrice);

        // Append the text node to the price element
        priceElement.appendChild(priceTextNode);


        const productDesc = itemDetails.itemDetails.productDetails[0].description;
        const descElement = document.querySelector('.product-body .description');
        descElement.textContent = productDesc;


        const sizesContainer = document.querySelector('.variant-wrapper .Sizes');


        const colorsContainer = document.querySelector('.variant-wrapper .Colors');




        const colorsMap = new Map(); // Map to track encountered colors
        let highlightedColor = null;

        const sizesMap = new Map(); // Map to track encountered sizes
        let highlightedSize = null;

        itemDetails.itemDetails.productDetails.forEach(item => {
            // Retrieve color and size from each item
            const color = item.color;
            const size = item.size;

            if (color) {
                // Process color
                if (!colorsMap.has(color.trim())) {
                    colorsMap.set(color.trim(), true); // Add color to map to mark it as encountered






                    // Create a span element for the color
                    const colorSpan = document.createElement('span');
                    colorSpan.textContent = color.trim(); // Trim any whitespace around the color
                    colorSpan.style.cursor = 'pointer'; // Change cursor to pointer to indicate it's clickable
                    colorSpan.style.marginRight = '5px'; // Add some margin between colors
                    colorSpan.addEventListener('click', () => {
                        // Remove border from previously highlighted color
                        if (highlightedColor) {
                            highlightedColor.style.border = '';

                            highlightedColor.style.background = 'whitesmoke';
                            highlightedColor.style.boxShadow = '';
                            highlightedColor.style.color = 'black';

                            clickedProductColor = null;
                        }

                        // Toggle border for the clicked color
                        if (colorSpan !== highlightedColor) {

                            colorSpan.style.border = '1px solid lightgray'; // Add border when clicked
                            colorSpan.style.boxShadow = ' 3px 3px 0px  lightgray';
                            colorSpan.style.color = 'gray';
                            colorSpan.style.borderRadius = '6px'
                            colorSpan.style.background = 'white'

                            // color: black;
                            // background - color: white;


                            highlightedColor = colorSpan;

                            const colorWarning = document.querySelector('.variant-wrapper .head .warning-color');
                            colorWarning.classList.remove('show');



                            // Get the clicked color
                            const clickedColor = colorSpan.textContent.trim();
                            clickedProductColor = clickedColor;
                            // Filter sizes based on the clicked color

                            // if(size){

                            const filteredSizes = itemDetails.itemDetails.productDetails
                                .filter(item => item.color.trim() === clickedColor)
                                .map(item => item.size.trim());



                            // }else {
                            //     console.log('Size is Null --Filtered Sizes Point')
                            // }




                            // Clear sizesContainer before adding sizes
                            sizesContainer.innerHTML = '';

                            // Create a Set to keep track of added sizes
                            const addedSizes = new Set();

                            if (size !== "") {


                                // Add all sizes as spans
                                itemDetails.itemDetails.productDetails.forEach(item => {
                                    const size = item.size.trim();
                                    // Check if the size is available for the clicked color and not already added
                                    if (!addedSizes.has(size)) {
                                        const sizeSpan = document.createElement('span');
                                        sizeSpan.textContent = size;
                                        sizeSpan.style.cursor = 'pointer';
                                        sizeSpan.style.marginRight = '5px';

                                        // Check if the size is available for the clicked color
                                        if (filteredSizes.includes(size)) {
                                            sizeSpan.setAttribute('size-clickable', 'true');
                                            sizeSpan.addEventListener('click', () => {
                                                // Remove border from previously highlighted size
                                                if (highlightedSize) {
                                                    highlightedSize.style.border = '';

                                                    highlightedSize.style.border = '';

                                                    highlightedSize.style.background = 'whitesmoke';
                                                    highlightedSize.style.boxShadow = '';
                                                    highlightedSize.style.color = 'black';



                                                }
                                                // Toggle border for the clicked size
                                                if (sizeSpan !== highlightedSize) {

                                                    sizeSpan.style.border = '1px solid lightgray'; // Add border when clicked
                                                    sizeSpan.style.boxShadow = ' 3px 3px 0px  lightgray';
                                                    sizeSpan.style.color = 'gray';
                                                    sizeSpan.style.borderRadius = '6px'
                                                    sizeSpan.style.background = 'white'

                                                    highlightedSize = sizeSpan;

                                                    const colorWarning = document.querySelector('.variant-wrapper .head .warning-size');
                                                    colorWarning.classList.remove('show');



                                                    // Get the clicked size
                                                    const clickedSize = sizeSpan.textContent.trim();
                                                    clickedProductSize = clickedSize;

                                                    // Find the product matching the clicked combination
                                                    const clickedProduct = itemDetails.itemDetails.productDetails.find(product =>
                                                        product.color.trim() === clickedColor && product.size.trim() === clickedSize
                                                    );


                                                    // Update the variables storing the clicked combination, price, and stock
                                                    clickedProductPrice = clickedProduct.price;
                                                    clickedProductStock = clickedProduct.stock;
                                                    clickedProductVariationId = clickedProduct.variation_id;
                                                    clickedProductImg = clickedProduct.var_img;

                                                    if (clickedProduct.var_img && clickedProduct.var_img !== "") {
                                                        const showcaseImg = document.querySelector('.showcase-img img');
                                                        showcaseImg.src = clickedProduct.var_img;
                                                        console.log('Change: ', clickedProduct.var_img);
                                                    }




                                                    clickedProductColor = clickedColor;


                                                    // Create an <i> element for the currency symbol
                                                    const currencyIcon = document.createElement('i');
                                                    currencyIcon.classList.add('fas', 'fa-peseta-sign'); // Assuming 'fas fa-peseta-sign' is the correct Font Awesome class


                                                    const space = document.createTextNode(' ');

                                                    // Create a text node containing the clicked product price
                                                    const priceText = document.createTextNode(clickedProductPrice);

                                                    // Clear previous content of priceElement
                                                    priceElement.innerHTML = '';

                                                    // Append currency icon and price text to priceElement
                                                    priceElement.appendChild(currencyIcon);
                                                    priceElement.appendChild(space);
                                                    priceElement.appendChild(priceText);



                                                    const stocksAvailable = document.createElement('span');

                                                    // Clear previous content of priceElement
                                                    stockElement.innerHTML = 'Available: ';

                                                    // Create a text node containing the clicked product price
                                                    const stocksText = document.createTextNode(clickedProductStock);
                                                    // stockElement.appendChild(space);
                                                    stockElement.appendChild(stocksText);



                                                    console.log(`Clicked Combination: Color - ${clickedColor}, Size - ${clickedSize},
                                                    Price - ${clickedProduct.price}, Stock - ${clickedProduct.stock}
                                                    , ImageUrl - ${clickedProduct.image_url}
                                                    `);



                                                } else {
                                                    highlightedSize = null;
                                                }
                                            });
                                        } else {
                                            // Style unavailable sizes differently
                                            sizeSpan.style.color = '#999'; // Gray out non-clickable sizes
                                            sizeSpan.style.cursor = 'default'; // Change cursor for non-clickable sizes
                                            sizeSpan.setAttribute('size-clickable', 'false');
                                        }
                                        sizesContainer.appendChild(sizeSpan); // Append the span to the Sizes container
                                        addedSizes.add(size); // Add size to the Set to mark it as added
                                    }
                                });

                            } else {
                                // Handle the case where size is null
                                // Find the product matching the clicked color
                                const clickedProduct = itemDetails.itemDetails.productDetails.find(product =>
                                    product.color.trim() === clickedColor
                                );

                                // If a product with the clicked color is found
                                if (clickedProduct) {
                                    // Update the variables storing the clicked combination, price, and stock
                                    clickedProductPrice = clickedProduct.price;
                                    clickedProductStock = clickedProduct.stock;
                                    clickedProductVariationId = clickedProduct.variation_id;
                                    clickedProductImg = clickedProduct.var_img;

                                    if (clickedProduct.var_img && clickedProduct.var_img !== "") {
                                        const showcaseImg = document.querySelector('.showcase-img img');
                                        showcaseImg.src = clickedProduct.var_img;
                                        console.log('Change: ', clickedProduct.var_img);
                                    }

                                    clickedProductColor = clickedColor;

                                    // Log the clicked combination along with its price and stock
                                    console.log(`Clicked Combination: Color - ${clickedColor}, Size - ${clickedSize},
                             Price - ${clickedProduct.price}, Stock - ${clickedProduct.stock}
                             , ImageUrl - ${clickedProduct.image_url}
                             `);

                                    // Handle updating UI elements for price and stock here
                                    // For example:
                                    // Update priceElement
                                    // Update stockElement
                                } else {
                                    console.log('No product found for the selected color.');
                                }
                            }





                        } else {
                            highlightedColor = null;
                            // Clear sizesContainer when no color is selected
                            sizesContainer.innerHTML = '';
                        }
                    });
                    colorsContainer.appendChild(colorSpan); // Append the span to the Colors container
                }
            } else {
                // Hide the colors element if colors are not available
                colorsContainer.style.display = 'none';

                // You may also want to hide the label element
                const colorLabel = document.getElementById('color-element');
                colorLabel.style.display = 'none';
            }

            // Check if size is not null or undefined before processing
            if (size) {
                // Process size
                if (!sizesMap.has(size.trim())) {
                    sizesMap.set(size.trim(), true); // Add size to map to mark it as encountered

                    // Log each size to the console
                    // console.log(size.trim());

                    // Create a span element for the size
                    const sizeSpan = document.createElement('span');
                    sizeSpan.textContent = size.trim(); // Trim any whitespace around the size
                    sizeSpan.style.cursor = 'pointer'; // Change cursor to pointer to indicate it's clickable
                    sizeSpan.style.marginRight = '5px'; // Add some margin between sizes
                    sizeSpan.addEventListener('click', () => {
                        // Remove border from previously highlighted size
                        if (highlightedSize) {
                            highlightedSize.style.border = '';
                        }
                        // Toggle border for the clicked size
                        if (sizeSpan !== highlightedSize) {


                            sizeSpan.style.border = '1px solid lightgray'; // Add border when clicked
                            sizeSpan.style.boxShadow = ' 3px 3px 0px  lightgray';
                            sizeSpan.style.color = 'gray';
                            sizeSpan.style.borderRadius = '6px'
                            sizeSpan.style.background = 'white'
                            highlightedSize = sizeSpan;


                            // Get the clicked size
                            const clickedSize = sizeSpan.textContent.trim();

                            // Find the product matching the clicked combination
                            const clickedProduct = itemDetails.itemDetails.productDetails.find(product =>
                                product.color.trim() === clickedColor && product.size.trim() === clickedSize
                            );


                            // Update the variables storing the clicked combination, price, and stock
                            clickedProductPrice = clickedProduct.price;
                            clickedProductStock = clickedProduct.stock;
                            clickedProductVariationId = clickedProduct.variation_id;
                            clickedProductImg = clickedProduct.var_img;

                            if (clickedProduct.var_img && clickedProduct.var_img !== "") {
                                const showcaseImg = document.querySelector('.showcase-img img');
                                showcaseImg.src = clickedProduct.var_img;
                                console.log('Change: ', clickedProduct.var_img);
                            }


                            clickedProductColor = clickedColor;



                            // Log the clicked combination along with its price and stock
                            console.log(`Clicked Combination: Color - ${clickedColor}, Size - ${clickedSize},
                             Price - ${clickedProduct.price}, Stock - ${clickedProduct.stock}
                             , ImageUrl - ${clickedProduct.image_url}
                             `);



                        } else {
                            highlightedSize = null;
                        }
                    });
                    sizesContainer.appendChild(sizeSpan); // Append the span to the Sizes container
                }
            } else {
                // Hide the sizes element if sizes are not available
                sizesContainer.style.display = 'none';

                // You may also want to hide the label element
                const sizeLabel = document.getElementById('size-element');
                sizeLabel.style.display = 'none';
            }
        });


        availableSize = sizesMap;
        availableColors = colorsMap;



    }


    ;
    // Step 1: Retrieve item details from local storage



    const itemDetailsJSON = localStorage.getItem('itemDetails');

    if (itemDetailsJSON) {
        const itemDetails = JSON.parse(itemDetailsJSON);



        // Accessing productImages and productDetails objects
        const productImages = itemDetails.itemDetails.productImages;
        // If you also need to access productDetails, you can do so like this:
        // const productDetails = itemDetails.productDetails;

        // Step 2: Loop through each image URL and set it in the HTML
        const imgContainer = document.querySelector('.variation-img-container');

        productImages.forEach(image => {
            const imageUrl = image.image_url;

            // Step 3: Create img element for each image URL and append to container
            const imgElement = document.createElement('img');
            imgElement.src = imageUrl;
            imgElement.alt = ''; // Set alt text if necessary
            imgElement.addEventListener('click', () => {
                // Set the source attribute of the showcase img element to the clicked image
                const showcaseImg = document.querySelector('.showcase-img img');
                showcaseImg.src = imageUrl;
                // Add a border to highlight the clicked image
                imgContainer.querySelectorAll('img').forEach(img => {
                    img.style.border = 'none'; // Reset borders on all images
                });
                imgElement.style.border = '2px solid black'; // Add border to the clicked image
            });
            imgContainer.appendChild(imgElement);
        });

        // Retrieve the image source from the first item in the array
        const imgSrc = productImages[0].image_url;

        // Find the img element by its class name
        const imgElement = document.querySelector('.showcase-img img');

        // Set the source attribute of the img element to the image source
        imgElement.src = imgSrc;
    }


});



const itemDetails = JSON.parse(localStorage.getItem('itemDetails'));
const itemProductId = itemDetails.itemDetails.productDetails[0].product_id;


axios.get('./php/user/itempage-reviews.php', {
    params: {
        product_id: itemProductId
    }
})
    .then(response => {
        // Handle successful response
        console.log(response.data); // Log the data received from the server
        // You can further process the data here

        // Assuming you have fetched the review data from the server and stored it in a variable named `reviewsData`

        // Select the reviews container
        const reviewsContainer = document.querySelector('.reviews-container');

        // Check if there are any reviews available
        if (response.data.length === 0) {
            // If there are no reviews, clear the contents of the reviews container
            const noReviewsMessage = `
            <div class="no-reviews">
                Product has no reviews yet
            </div>
        `;
            // <img src="https://cdn0.iconfinder.com/data/icons/essential-vol-4/1000/rating_workflow___ratings_review_star_survey_stars_accomplishment_achievement-512.png" alt="">

            reviewsContainer.innerHTML = noReviewsMessage;
        } else {
            let totalRating = 0;

            // If there are reviews, iterate over each review in the data and generate HTML dynamically
            response.data.forEach(review => {
                // Create a div element for the user review
                const userReviewDiv = document.createElement('div');
                userReviewDiv.classList.add('user-review');

                // Generate the HTML for rating stars based on the review's rating
                let ratingStarsHtml = '';
                for (let i = 0; i < review.rating; i++) {
                    ratingStarsHtml += '<i class="fas fa-star"></i>'; // Solid star
                }
                for (let i = review.rating; i < 5; i++) {
                    ratingStarsHtml += '<i class="far fa-star"></i>'; // Regular star
                }

                // Add rating to total for calculating average
                totalRating += review.rating;

                // Create HTML content using a template literal
                userReviewDiv.innerHTML = `
                <img src="${review.img}" alt="${review.name}">
                <div class="section">
                    <span>${review.name}</span>
                    <div class="rating-score">
                        ${ratingStarsHtml}
                    </div>
                    <div class="content">
                        ${review.comment}
                    </div>
                </div>
            `;

                // Append the user review div to the reviews container
                reviewsContainer.appendChild(userReviewDiv);
            });

            // Calculate average rating
            const averageRating = totalRating / response.data.length;

            // Display average rating
            const header = document.querySelector('.header');
            const ratingScore = header.querySelector('.rating-score');
            ratingScore.innerHTML = `${averageRating.toFixed(1)} out of 5`;

            // Generate HTML for average rating stars
            let averageRatingStarsHtml = '';
            const fullStars = Math.floor(averageRating);
            const remainder = averageRating - fullStars;
            for (let i = 0; i < fullStars; i++) {
                averageRatingStarsHtml += '<i class="fas fa-star"></i>'; // Solid star
            }
            if (remainder >= 0.5) {
                averageRatingStarsHtml += '<i class="fas fa-star-half-alt"></i>'; // Half star
            }
            for (let i = 0; i < 5 - Math.ceil(averageRating); i++) {
                averageRatingStarsHtml += '<i class="far fa-star"></i>'; // Regular star
            }

            // Append average rating stars HTML
            ratingScore.innerHTML = `${averageRating.toFixed(1)} out of 5 ${averageRatingStarsHtml}`;
        }


    })
    .catch(error => {
        // Handle error
        console.error(error);
    });










const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');

const exitBtn = document.getElementById('');

function overlaySignUpPanelClick(event) {
    const container = document.getElementById('container');
    container.classList.add("right-panel-active");
}

function overlaySignInPanelClick(event) {
    const container = document.getElementById('container');
    container.classList.remove("right-panel-active");
}

// signUpButton.addEventListener('click', () => {

// });

// signInButton.addEventListener('click', () => {
//     const container = document.getElementById('container');
//     container.classList.remove("right-panel-active");
// });



function signUpClick(event) {
    event.preventDefault();

    var signUpFN = document.getElementById('signUpFN').value;
    var signUpLN = document.getElementById('signUpLN').value;
    var signUpEmail = document.getElementById('signUpEmail').value;
    var signUpPass = document.getElementById('signUpPass').value;

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
                localStorage.setItem("userInfo", JSON.stringify(response.data.userInfo));


                localStorage.setItem("authToken", authToken);

                document.querySelector('.overlay-login').classList.add('hide');
                // window.location.href = 'user-page.html';





                axios.get('./php/cart-userId.php')

                    .then(response => {
                        if (response.data.success) {
                            cartDetails = response.data.userCart; // Set cartDetails here
                            localStorage.setItem('userCart', JSON.stringify(cartDetails));


                            const userCart = localStorage.getItem('userCart');



                            renderCart(cartDetails); // Call the function to render the cart
                        } else {
                            console.error("Error retrieving item details:", response.data.error);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });











            } else {
                // Invalid email or password
                console.error("Invalid email or password:", response.data.error);
                document.getElementById('login-result').textContent = response.data.error;
            }
        })
        .catch(error => {
            // Handle any errors that occurred during the request
            console.error("Error:", error);
            document.getElementById('login-result').textContent = "An error occurred while loggin in";
        });










}


function exitClick(event) {
    document.querySelector('.overlay-login').classList.add('hide');
}









function renderCart(cartDetails) {
    realTotalPrice = calculateTotalPrice();
    console.log('rendercart');
    // Get reference to the cart body container
    const cartBody = document.getElementsByClassName('cart-overlay-body')[0];
    let subtotal = 0; // Define subtotal locally


    // Function to calculate total price
    function calculateTotalPrice() {
        let totalPrice = 0;
        cartDetails.forEach(item => {
            const itemTotalPrice = item.price * item.quantity;
            totalPrice += itemTotalPrice;
        });
        return totalPrice.toFixed(2);
    }

    // Function to update subtotal price
    function updateSubtotalPrice() {
        const subTotalPriceElement = document.getElementById('subTotal-price');
        const totalPrice = calculateTotalPrice();
        subTotalPriceElement.innerHTML = `<i class="fas fa-peseta-sign"></i> ${totalPrice}`;
    }


    // Add event listener for button clicks inside the cart body
    cartBody.addEventListener('click', (event) => {
        try {
            if (event.target.tagName === 'BUTTON') {
                event.preventDefault();

                const quantityInput = event.target.parentElement.querySelector('input[type="text"]');
                let currentQuantity = parseInt(quantityInput.value);
                const maxQuantity = parseInt(quantityInput.getAttribute('max'));

                if (event.target.textContent === '+' && currentQuantity < maxQuantity) {
                    currentQuantity++;
                } else if (event.target.textContent === '-' && currentQuantity > 1) {
                    currentQuantity--;
                }

                quantityInput.value = currentQuantity;

                const itemIndex = event.target.closest('.cart-item').getAttribute('data-index');
                const item = cartDetails[itemIndex];
                const itemPriceElement = event.target.closest('.cart-item').querySelector('.numbers .cost span');
                itemPriceElement.textContent = (item.price * currentQuantity).toFixed(2);

                cartDetails[itemIndex].quantity = currentQuantity;
                updateSubtotalPrice();
                localStorage.setItem('userCart', JSON.stringify(cartDetails));

                realTotalPrice = calculateTotalPrice();
            }
        } catch (error) {
            console.error('Error handling button click:', error);
        }
    });

    // Map through cart items and create HTML structure
    const cartItemsHTML = cartDetails.map((item, index) => `
    <div class="cart-item" data-index="${index}"> 

    <div class="left-part">

        <img src="${item.var_img}" alt="${item.name}">

    </div>

    <div class="right-part">

        <span class="item-name">
            ${item.name}
        </span>

        <span class="item-variation">

            ${item.color} / ${item.size}

        </span>

        <span class="remove-item" onclick='RemoveClick(${item.cart_id}, ${index} ,cartDetails)'> 
            <i class="fas fa-times"></i> Remove
        </span>

        <div class="numbers">

            <div class="quantity">

                <button class="minus">-</button>
                <input type="text" value="${item.quantity}" min="1" max="${item.stock}" readonly>
                <button class="add">+</button>

            </div>

            <div class="cost">

                <i class="fas fa-peseta-sign"></i>
                <span>${(item.price * item.quantity).toFixed(2)}</span>

            </div> 
        </div> 
    </div> 

</div>
    `).join('');

    // Set the generated HTML to the cart body container
    cartBody.innerHTML = cartItemsHTML;



    // Update subtotal price
    updateSubtotalPrice();
}

// Event handler for remove click
function RemoveClick(cartId, itemIndex, cartDetails) {


    axios.delete(`./php/cart-item-remove.php?cart_id=${cartId}`)
        .then(response => {
            console.log(response.data); // Success message or any other response from the server
            cartDetails.splice(itemIndex, 1);
            renderCart(cartDetails); // Render the cart again after item removal
        })
        .catch(error => {
            console.error('There was a problem with the Axios request:', error);
        });
}

