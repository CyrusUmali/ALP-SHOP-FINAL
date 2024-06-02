 


function getItems() {
    axios.post('./php/user/user-orders.php', { 
        ord_status: 'Completed' // Pass '*' to retrieve all order statuses
    })
        .then(function (response) {
            console.log(response.data);


            renderOrdersData(response.data)
        })
        .catch(function (error) {
            console.error(error);
        });

}

getItems();


function renderOrdersData(data) {
    let selectedRating = null; // Variable to store the selected rating

    const orders = data.orders;

    // Array to store grouped orders
    const groupedOrders = [];

    // Group orders by order_id
    orders.forEach(order => {
        const orderId = order.order_id;
        // Find if the order group already exists in groupedOrders
        const existingGroup = groupedOrders.find(group => group[0].order_id === orderId);
        if (existingGroup) {
            existingGroup.push(order); // Add the order to the existing group
        } else {
            groupedOrders.push([order]); // Create a new group and add the order
        }
    });

    const purchasesBody = document.getElementById('ordersContainer');
    purchasesBody.innerHTML = '';

    // Iterate over grouped orders and render
    groupedOrders.forEach(group => {
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('item');

        // Use template literals to generate HTML for each group
        itemDiv.innerHTML = group.map(order => {
            // Generate stars based on order.rating
            let starsHtml = '';
            for (let i = 0; i < 5; i++) {
                if (i < order.rating) {
                    starsHtml += `<i class="fas fa-star rated" data-itemid="${order.order_item_id}"
                     data-orderid="${order.order_id}" data-rating="${i + 1}"></i>`; // Solid star
                } else {
                    starsHtml += `<i class="far fa-star unrated" data-itemid="${order.order_item_id}" data-orderid="${order.order_id}" data-rating="${i + 1}"></i>`; // Regular star
                }
            }

            // Check if comment is null, then render textarea and stars for rating
            if (order.comment === null) {
                return `
                    <div class="reviews-content">
                        <div class="btn">
                            <img src="${order.var_img}" alt="${order.name}">
                        </div>
                        <div class="text-group">
                            <p>${order.name}</p>
                            <span>${order.size} / ${order.color}</span>
                        </div>
    
                        <div class="rating">
                            <div class="stars">
                                ${starsHtml}
                            </div>
    
                            <div class="review">
                                <textarea wrap="soft" class="review-textarea"></textarea>
                            </div>
    
                            <div class="submit">
                            
                           
                            <button onclick="submitReview(this, ${order.order_item_id},
                                ${order.product_id}, ${order.order_id})">Submit</button>

                             
                            </div>
                        </div>
                    </div>
                `;
            } else { // If comment is not null, render the comment
                return `
                    <div class="reviews-content">
                        <div class="btn">
                            <img src="${order.var_img}" alt="${order.name}">
                        </div>
                        <div class="text-group">
                            <p>${order.name}</p>
                            <span>${order.size} / ${order.color}</span>
                        </div>
    
                        <div class="rating">
                            <div class="stars">
                                ${starsHtml}
                            </div>
    
                            <div class="review">
                                ${order.comment}
                            </div>
                        </div>
                    </div>
                `;
            }
        }).join('');

        // Append itemDiv to the container
        purchasesBody.appendChild(itemDiv);
    });





    // Add event listeners for rating stars
    const stars = document.querySelectorAll('.unrated');
    stars.forEach(star => {
        star.addEventListener('click', function () {
            // Check if the item has a null comment before allowing rating
            const reviewContainer = this.closest('.rating').querySelector('.review');
            if (reviewContainer.innerText.trim() !== '') {
                // Exit the event listener if the item already has a review
                return;
            }

            // Change class from far to fas for the clicked star and previous stars
            this.classList.remove('far');
            this.classList.add('fas');
            this.classList.add('rated');

            // Change class from far to fas for previous stars
            let previousStars = this.previousElementSibling;
            while (previousStars) {
                previousStars.classList.remove('far');
                previousStars.classList.add('fas');
                previousStars.classList.add('rated');
                previousStars = previousStars.previousElementSibling;
            }

            // Remove the rated class from stars after the clicked star
            let nextStars = this.nextElementSibling;
            while (nextStars) {
                nextStars.classList.remove('fas');
                nextStars.classList.add('far');
                nextStars.classList.remove('rated');
                nextStars = nextStars.nextElementSibling;
            }

            // Store the selected rating
            const selectedRating = this.getAttribute('data-rating');
            console.log('Selected rating:', selectedRating);




            // You can implement logic here to handle the rating, like sending it to the server or updating the UI
            const orderId = this.getAttribute('data-orderid');
            const orderitemId = this.getAttribute('data-itemid');
            const rating = this.getAttribute('data-rating');
            // Store the rating in sessionStorage
            sessionStorage.setItem(`${orderId}${orderitemId}rating`, selectedRating);

            console.log(`Clicked star with order ID ${orderId}  itemID ${orderitemId} and rating ${rating}`);
            // You may want to send an AJAX request to update the rating on the server
        });
    });


}










// function submitReview(test) {

function submitReview(button, orderItemId, productId, orderId) {


    // Find the nearest ancestor with the class 'rating'
    const ratingContainer = button.closest('.rating');
    // console.log("Rating Container:", ratingContainer);

    // Find the textarea element within the rating container
    const textarea = ratingContainer.querySelector('.review-textarea');
    // console.log("Textarea:", textarea);

    const reviewText = textarea.value;

// Retrieve the selected rating from sessionStorage
const selectedRating = sessionStorage.getItem(`${orderId}${orderItemId}rating`);

console.log('Rating:', selectedRating);

    console.log('rating:', selectedRating);
    console.log('productId', productId);
    console.log('orderId', orderId);
    console.log('orderItemId', orderItemId);


        axios.post('./php/user/write-review.php', {
            comment: reviewText,
            order_item_id_fk: orderItemId, 
            product_id_fk: productId,
            rating: selectedRating
        })
            .then(res => {
                console.log("Review Result: ", res);
                getItems();
            })
            .catch(err => {
                console.error(err);
            })



}






// function reviewClick(name, size, color, img, order_item_id) {
//     // Create an object to store all the parameters
//     const itemToReview = {
//         name: name,
//         size: size,
//         color: color,
//         img: img,
//         order_item_id: order_item_id
//     };

//     // Convert the object to a JSON string
//     const itemToReviewJSON = JSON.stringify(itemToReview);

//     // Store the JSON string in sessionStorage under the key 'itemToReview'
//     sessionStorage.setItem('itemToReview', itemToReviewJSON);


//     loadPage('./user/make-reviews.php')
// }


