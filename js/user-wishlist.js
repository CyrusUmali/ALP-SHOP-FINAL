function viewItemPageClick(prodId) {
    console.log(prodId);

    // Make the PHP GET request with product_id as a query parameter
    fetch(`./php/fetch_item_details.php?product_id=${prodId}`)
        .then(response => response.json())
        .then(data => {
            // Store the data in localStorage
            localStorage.setItem('itemDetails', JSON.stringify(data));
            console.log('Data retrieved and stored in localStorage:', data);
            window.location.href = `item-page.php?product_id=${prodId}`;
        })
        .catch(error => console.error('Error fetching data:', error));

}

function removeItemClick(wishlist_id) {

    console.log(wishlist_id);


    // Send POST request to update-order-status.php
    axios.delete('./php/user/user-remove-wishlist-item.php',
        {
            data: {
                wishlist_id: wishlist_id
            }

        })
        .then(response => {
            // Handle success
            console.log('Item removed from cart succesfullt');
            getWishList();


            // Optionally, call any additional functions or update UI after successful update
        })
        .catch(error => {
            // Handle error
            console.error('Error updating order status:', error);
        });


}



getWishList();


function getWishList() {
    axios.get('./php/user/user-wishlist.php')
        .then(response => {
            // Check if the request was successful
            if (response.data.success) {
                const wishlist = response.data.wishlistItems;
                console.log('wishlist', response.data.wishlistItems);

                // Select the tbody element of the table
                const tbody = document.querySelector('.orders-table tbody');

                // Clear any existing rows
                tbody.innerHTML = '';

                // Generate table rows using template literals and forEach
                wishlist.forEach(item => {
                    const row = `
                    <tr>
                        <td>
                            <i class="fas fa-times" onclick="removeItemClick( ${item.wishlist_id})"></i>
                        </td>
                        <td>
                            <div>
                                <img src="${item.var_img}" alt="${item.name}">
                                <span>${item.name}</span>
                            </div>
                        </td>
                        <td>
                        <i class="fas fa-peseta-sign"></i> ${item.price}
                    </td>
                    
                        <td>
                            ${item.stock}
                        </td>
                        <td>
                            <button onclick="viewItemPageClick( ${item.product_id})">View Item Page</button>
                        </td>
                    </tr>
                `;
                    // Append the generated row to the tbody
                    tbody.innerHTML += row;
                });

            } else {
                console.error("Error retrieving data from the server:", response.data);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

