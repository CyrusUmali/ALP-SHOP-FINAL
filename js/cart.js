



let cartDetails; // Define cartDetails globally

// Define totalPrice globally
let realTotalPrice = 0;
var itemDetails = JSON.parse(localStorage.getItem('userInfo'));

var UserInfo = JSON.parse(localStorage.getItem('userInfo'));
var userId = UserInfo;

axios.get('./php/cart-userId.php')

  .then(response => {
    if (response.data.success) {
      cartDetails = response.data.userCart; // Set cartDetails here
      localStorage.setItem('userCart', JSON.stringify(cartDetails));


      const userCart = localStorage.getItem('userCart');
      if (userCart === null || JSON.parse(userCart).length === 0) {
        console.log("Wow Such Emptiness");
        // Add .hide class to elements
        document.querySelector('.cart-container form').classList.add('hide');
        document.querySelector('.cart-container .cart-footer').classList.add('hide');
      } else {
        console.log(userCart);
        document.querySelector('.empty-cart-container').classList.add('hide');


      }


      renderCart(); // Call the function to render the cart
    } else {
      console.error("Error retrieving item details:", response.data.error);
      console.log("respones data err", response.data.error);
    }
  })
  .catch(error => {
    console.error("Error:", error);
    console.log(error);
  });




function renderCart() {
  realTotalPrice = calculateTotalPrice();

  // Get reference to the cart body container
  const cartBody = document.getElementsByClassName('cart-body')[0];
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
    subTotalPriceElement.textContent = calculateTotalPrice();
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

        const itemIndex = event.target.closest('.item').getAttribute('data-index');
        const item = cartDetails[itemIndex];
        const itemPriceElement = event.target.closest('.item').querySelector('.product-cost span');
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
    <div class="item" data-index="${index}">
      <div class="product-img">
        <img src="${item.var_img}" alt="${item.name}">
      </div>
      <div class="product-name">
        <div class="wrapper">
          <span>${item.name}</span>
          <span>${item.color} / ${item.size}</span>
          <div class="removeCartItem" onclick='RemoveClick(${item.cart_id}, ${index})'> 
            <i class="fas fa-x"></i>
            <span >Remove</span>
          </div>
        </div>
      </div>
      <div class="product-quantity">
        <div>
          <button>-</button>
          <input type="text" value="${item.quantity}" min="1" max="${item.stock}" readonly>
          <button>+</button>
        </div>
      </div>
      <div class="product-cost">
        <div>
          <i class="fas fa-peseta-sign"></i>
          <span>${(item.price * item.quantity).toFixed(2)}</span>
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
function RemoveClick(cartId, itemIndex) {


  axios.delete(`./php/cart-item-remove.php?cart_id=${cartId}`)
    .then(response => {
      console.log(response.data); // Success message or any other response from the server
      cartDetails.splice(itemIndex, 1);
      renderCart(); // Render the cart again after item removal
    })
    .catch(error => {
      console.error('There was a problem with the Axios request:', error);
    });
}

function goToCheckOut(event) {
  window.location.href = 'shipping-details.php';

  // Assuming userId, realTotalPrice, and cartDetails are already defined
  const combinedCartData = {
    userId: userId,
    realTotalPrice: realTotalPrice,
    cartDetails: cartDetails
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
  const combinedCartDataString = JSON.stringify(combinedCartData);

  // Store the combined data string in sessionStorage
  sessionStorage.setItem('combinedCartData', combinedCartDataString);



}


 
function checkOutClick(shipmentId) {

  // Use session data for the checkout process
  axios.post('./php/checkout.php', {  // Adjust the URL to point to the PHP script
    shipment_id_fk: shipmentId
  })
    .then(response => {
      console.log(response.data);
      // If checkout is successful, clear the cart
      if (response.data.success) {
        clearCart();
      }
    })
    .catch(error => {
      console.error('There was a problem with the Axios request:', error);
    });
}



function placeOrderClick(event) {

  event.preventDefault();


  const contactElem = document.getElementById('contactInput').value;
  const FnameInput = document.getElementById('FnameInput').value;
  const LnameInput = document.getElementById('LnameInput').value;
  const addressInp = document.getElementById('addressInp').value;
  const cityInput = document.getElementById('cityInput').value;
  const postalCodeInp = document.getElementById('postalCodeInp').value;
  const province = document.getElementById('province').value;
  // const shippingNoteInp = document.getElementById('shippingNoteInp').value;

  if (contactElem && FnameInput && LnameInput && addressInp && cityInput && postalCodeInp && province) {
      console.log("All variables have values");

      axios.post('./php/shipment.php', {
          first_name: FnameInput,
          last_name: LnameInput,
          address: addressInp,
          city: cityInput,
          province: province,
          zip_code: postalCodeInp,
          contact: contactElem,
          // shipping_note: shippingNoteInp,
      })
          .then(response => {
              if (response.data.success) {
                  const shipmentId = response.data.shipment_id;
                  console.log("Shipment data added successfully. Shipment ID:", shipmentId);
                  checkOutClick(shipmentId);

                  const popUpCont = document.querySelector('.pop-up-overlay');
                  popUpCont.classList.remove('hide');
                  const popUpElem = document.querySelector('.pop-up-sucess');
                  popUpElem.classList.remove('hide');

              } else {
                  // Display error message
                  console.error("Error adding shipment data:", response.data.error);
              }
          })
          .catch(error => {
              // Display error message
              console.error("Error:", error);
          });





  } else {
      console.log('all field req');
  }


}




// Function to clear the cart
function clearCart() {
  axios.delete('./php/clear-cart.php')
    .then(response => {
      console.log(response.data); // Success message or any other response from the server
      cartDetails = []; // Empty the cart details array
      // renderCart(); // Render the cart again after clearing
    })
    .catch(error => {
      console.error('There was a problem with the Axios request:', error);
    });
}
