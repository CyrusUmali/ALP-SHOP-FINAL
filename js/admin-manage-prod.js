
// Make an Axios request to fetch data from the server


allProds(-1);

function allProds(chosenCateg, orderType) {



    axios.get('./php/all-prod.php', {
        params: {
            category: chosenCateg,
            order_type: orderType
        }
    }

    )
        .then(response => {
            // Check if the request was successful
            if (response.data.success) {
                const AllProducts = response.data.AllProducts;


                localStorage.setItem('AllProducts', JSON.stringify(AllProducts));

                // Select the container where you want to insert the products
                const container = document.querySelector('.product-wrapper');

                container.innerHTML = '';

                // Map over each product and create HTML for it
                AllProducts.forEach(product => {
                    // Create HTML for each product
                    const productHTML = `
        <div class="product"  product-id="${product.product_id}" >
        <img src="${product.img}" alt="${product.name}">
        <span class="product-name">${product.name}</span>

        <div class="details">


            <i class="fas fa-peseta-sign">${product.variation_price}</i>

            <div class="stocks">
                <label>Stocks:</label>
                <span>${product.variation_stock}</span>
            </div>

        </div>

        <div class="action">

            <button class="editBtn" onclick="editClick(event)">
                <i class="far fa-edit"></i>
                <span>Edit</span>
            </button>

            <button class="deleteBtn" onclick="showDeleteCLick(this)">
                <i class="fas fa-trash"></i>
                <span>Delete</span>
            </button>


         



    </div>
        `;





                    // Append the product HTML to the container
                    container.innerHTML += productHTML;
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

}

function changeFilter(e) {

    const orderFilter = document.getElementById('dateFilter').value;
    var ordType;

    console.log('ordefilt', orderFilter);

    switch (orderFilter) {
        case '1':
            ordType = 'DESC';
            console.log(ordType);
            break;
        case '2':
            ordType = 'ASC';
            console.log(ordType);
            break;
        default:
            console.log('Error: Invalid order filter');
            break;
    }


    const prodCatego = document.getElementById('categorySelect').value;


    allProds(prodCatego, ordType);


}






function testFiltClick(event) {

    console.log('gum');

}

function editClick(event) {
    // Get the parent element of the clicked button
    const productElement = event.target.closest('.product');

    // Check if the parent element exists
    if (productElement) {
        // Retrieve the product_id attribute of the parent element
        const productId = productElement.getAttribute('product-id');

        // Log the product_id
        console.log('Product ID:', productId);




        fetch(`./php/fetch_item_details.php?product_id=${productId}`)
            .then(response => response.json())
            .then(data => {
                // Store the data in localStorage
                localStorage.setItem('itemDetails', JSON.stringify(data));
                console.log('Data retrieved and stored in localStorage:', data);
                loadPage('./admin/edit-Prod.php')
            })
            .catch(error => console.error('Error fetching data:', error));






    } else {
        console.error('Parent product element not found');
    }
}





function showDeleteCLick(button) {
    // Get the parent element of the clicked button
    const productElement = event.target.closest('.product');

    // Check if the parent element exists
    if (productElement) {
        // Retrieve the product_id attribute of the parent element
        const productId = productElement.getAttribute('product-id');
        sessionStorage.setItem('ItemtoDeleteID', productId);

        console.log('Product ID:', productId);
    } else {
        console.error('Parent product element not found');
    }

    // Show delete confirmation container
    const deleteConfirmElem = document.querySelector('.delete-confirm-container');
    deleteConfirmElem.classList.remove('hide');
}

function deleteCLick(event) {
    const productId = sessionStorage.getItem('ItemtoDeleteID');

    // Send delete request to server
    console.log('Product del id:', productId);
    axios.delete(`./php/admin/delete-prod.php?productId=${productId}`)
        .then(response => {
            // Check if the request was successful
            if (response.data.success) {
                // Retrieve the product element using product ID
                const productElement = document.querySelector(`.product[product-id="${productId}"]`);

                // Remove the corresponding product element from the UI if found
                if (productElement) {
                    productElement.remove();
                }

                // Hide the delete confirmation container
                const deleteConfirmElem = document.querySelector('.delete-confirm-container');
                deleteConfirmElem.classList.add('hide');
            } else {
                // Handle error if the request was not successful
                console.error("Error deleting product:", response.data.error);
            }
        })
        .catch(error => {
            // Handle any errors that occurred during the request
            console.error("Error:", error);
        });
}



function productSearchInput() {

}



function doneTyping() {
    const input = document.getElementById('productSearch').value; // Trim whitespace from the input

    // Clear search results if input is empty
    if (input === '') {
        clearOrderSearch();
        console.log('testtest');
        return;
    }

    console.log('donetyping: ', input);


    axios.post('./php/admin/admin-search-prod.php', {
        search_term: input
    })
        .then(function (response) {
            // Handle success
            console.log(response.data);


            if (response.data.success) {
                const AllProducts = response.data.products;



                // Select the container where you want to insert the products
                const container = document.querySelector('.product-wrapper');

                container.innerHTML = '';

                // Map over each product and create HTML for it
                AllProducts.forEach(product => {
                    // Create HTML for each product
                    const productHTML = `
<div class="product"  product-id="${product.product_id}" >
<img src="${product.img}" alt="${product.name}">
<span class="product-name">${product.name}</span>

<div class="details">


    <i class="fas fa-peseta-sign">${product.variation_price}</i>

    <div class="stocks">
        <label>Stocks:</label>
        <span>${product.variation_stock}</span>
    </div>

</div>

<div class="action">

    <button class="editBtn" onclick="editClick(event)">
        <i class="far fa-edit"></i>
        <span>Edit</span>
    </button>

    <button class="deleteBtn" onclick="showDeleteCLick(this)">
        <i class="fas fa-trash"></i>
        <span>Delete</span>
    </button>


 



</div>
`;





                    // Append the product HTML to the container
                    container.innerHTML += productHTML;
                });
            } else {
                // Handle error if the request was not successful aha
                console.error("Error retrieving data from the server:", response.data);
            }



        })
        .catch(function (error) {
            // Handle error
            console.error(error);
        });



}

// Function to clear search results
function clearOrderSearch() {
    const container = document.querySelector('.product-wrapper');

    container.innerHTML = '';

}


// Function to handle input event
function productSearchInput(event) {
    let typingTimer;



    const doneTypingInterval = 500; // Adjust this value to set the delay

    const input = event.target;
    clearTimeout(typingTimer);
    if (input.value) {
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    } else {
        // If input is empty, clear search results immediately

    }
}