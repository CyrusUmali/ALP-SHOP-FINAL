

let typingTimer;
const doneTypingInterval = 500; // Adjust this value to set the delay

// Function to be executed after typing has stopped


function doneTyping() {
    const input = document.getElementById('prod-search-bar').value.trim(); // Trim whitespace from the input
    
    // Clear search results if input is empty
    if (input === '') {
        clearSearchResults();
        console.log('testtest');
        return;
    }

    const words = input.split(' '); // Split input into an array of words

    let word1 = words.length > 0 ? words[0] : '';
    let word2 = words.length > 1 ? words[1] : '';
    let word3 = words.length > 2 ? words[2] : '';

    // Send the search terms to the server using Axios
    axios.post('./php/product-search.php', {
        search_term_1: word1,
        search_term_2: word2,
        search_term_3: word3
    })
        .then(function (response) {
            // Handle success
            console.log(response.data);

            // Clear previous search results
            const searchResultsElement = document.querySelector('.search-results ul');
            searchResultsElement.innerHTML = '';

            // Render the product names and IDs using template literals
            response.data.AllProducts.forEach(product => {
                const productId = product.product_id;
                const productName = product.name;

                // Create HTML using template literals
                const listItemHTML = `<li data-product-id="${productId}">${productName}</li>`;

                // Append the HTML to the search results list
                searchResultsElement.insertAdjacentHTML('beforeend', listItemHTML);
            });

            // Add event listener to each list item to log product ID
            const listItems = document.querySelectorAll('.search-results ul li');
            listItems.forEach(item => {
                item.addEventListener('click', function () {
                    const productId = this.dataset.productId;
                    console.log('Product ID:', productId);


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

                });
            });
        })
        .catch(function (error) {
            // Handle error
            console.error(error);
        });
}

// Function to clear search results
function clearSearchResults() {
    const searchResultsElement = document.querySelector('.search-results ul');
    searchResultsElement.innerHTML = '';
}







function searchBarClick() {
    console.log('searchBarClick');

    
    const searchResElem = document.querySelector('.search-results');
    var overlay = document.querySelector('.categ-footer');
    overlay.classList.add('show');
    

    searchResElem.classList.add('active')

 
    



}



document.addEventListener('click', function(event) {
    const searchBar = document.getElementById('prod-search-bar');
    // Check if the clicked element is not the search bar
    if (event.target !== searchBar) {
        // Remove the "active" class from elements
        
        const searchResElem = document.querySelector('.search-results');
    

        searchResElem.classList.remove('active')

        var overlay = document.querySelector('.categ-footer');
        overlay.classList.remove('show');

  
    }
});

 // Function to handle input event
function prodSearchBarInput(event) {
    const input = event.target;
    clearTimeout(typingTimer);
    if (input.value) {
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    } else {
        // If input is empty, clear search results immediately
        clearSearchResults();
    }
}

// Add event listener for input event on search bar
// document.getElementById('prod-search-bar').addEventListener('input', prodSearchBarInput);
