







function OrderIdClick(orderId, shipmentId) {

  sessionStorage.setItem('orderId', orderId);


  axios.get(`./php/order-item.php?order_id=${orderId}`)
    .then(response => {
      console.log(response.data);

      sessionStorage.setItem('orderIdClick', JSON.stringify(response.data));
      if (response.data.success) {

        sessionStorage.setItem('OrderItems', JSON.stringify(response.data));






        axios.get(`./php/order-form-details.php?shipment_id=${shipmentId}`)
          .then(response => {
            console.log(response.data);

            sessionStorage.setItem('orderIdClick2', JSON.stringify(response.data));
            if (response.data.success) {


              sessionStorage.setItem('OrderUserDetails', JSON.stringify(response.data));
              window.open('./admin/order-form.php', '_blank');
            }
          })
          .catch(error => {
            console.error('There was a problem with the Axios request:', error);
          });




      }
    })
    .catch(error => {
      console.error('There was a problem with the Axios request:', error);
    });







}




function orderStatusClick(ord_status, order_id, shipment_id_fk) {

  const orderStatusOverlay = document.querySelector('.orderStatus-overlay');
  orderStatusOverlay.classList.remove('hide');

  sessionStorage.setItem('orderId-orderStatusClick', order_id);
  sessionStorage.setItem('shipment_id_fk-orderStatusClick', shipment_id_fk);


  const currentOrderStatusElem = document.getElementById('currentOrderStatus');

  switch (ord_status) {

    case 'Pending':
      currentOrderStatusElem.classList.add('pending');
      currentOrderStatusElem.classList.remove('completed', 'cancel');
      break;
    case 'Completed':
      currentOrderStatusElem.classList.add('completed');
      currentOrderStatusElem.classList.remove('pending', 'cancel'); // Remove other classes
      break;
    case 'Canceled':
      currentOrderStatusElem.classList.add('cancel');
      currentOrderStatusElem.classList.remove('pending', 'completed'); // Remove other classes
      break;
    default:
      break;


  }




  currentOrderStatusElem.textContent = ord_status;





  console.log('ord_status: ', ord_status);

  console.log('orderstatusclick');
}



function viewOrderFormClick(event) {
  console.log('viewOrderFormClick');


  var orderId = sessionStorage.getItem('orderId-orderStatusClick');
  var shipmentId = sessionStorage.getItem('shipment_id_fk-orderStatusClick');

  OrderIdClick(orderId, shipmentId)

  // window.location.href = './admin/order-form.php' ;
  window.open('./admin/order-form.php', '_blank');

}

function updateStatusClick(event) {
  console.log('updateStatusClick');

  // Retrieve orderId from sessionStorage
  var orderId = sessionStorage.getItem('orderId-orderStatusClick');

  // Retrieve selected option text from dropdown menu
  var newOrderStatus = document.getElementById('newOrderStatus');
  var new_order_status = newOrderStatus.options[newOrderStatus.selectedIndex].textContent;

  // Construct requestData object
  var requestData = {
    order_id: orderId,
    ord_status: new_order_status
  };

  // Send POST request to update-order-status.php
  axios.post('./php/update-order-status.php', requestData)
    .then(response => {
      // Handle success
      console.log('Order status successfully updated');
      const orderStatusOverlay = document.querySelector('.orderStatus-overlay');
      orderStatusOverlay.classList.add('hide');

      removeActiveClass();

      switch (new_order_status) {
        case 'Completed':
          completedOrdersElem.classList.add('active');
          allOrdersClick("Completed");

          break;
        case 'Canceled':
          cancelOrdersElem.classList.add('active');
          allOrdersClick("Canceled");
          break;
        case 'Pending':
          pendingOrdersElem.classList.add('active');
          allOrdersClick("Pending");
          break;
        default:
          allOrdersElem.classList.add('active');
          allOrdersClick();
          break;



      }


      // Optionally, call any additional functions or update UI after successful update
    })
    .catch(error => {
      // Handle error
      console.error('Error updating order status:', error);
    });
}


var allOrdersElem = document.getElementById('allOrders');
var pendingOrdersElem = document.getElementById('pendingOrders');
var cancelOrdersElem = document.getElementById('cancelOrders');
var completedOrdersElem = document.getElementById('completedOrders');






// Get all option elements
var options = document.querySelectorAll('.orders-options .option');

// Function to remove active class from all options
function removeActiveClass() {
  options.forEach(option => {
    option.classList.remove('active');
  });
}

// Function to handle click event for each option
function handleClick() {
  // Remove active class from all options
  removeActiveClass();

  // Add active class to clicked option
  this.classList.add('active');
}

// Add click event listener to each option
options.forEach(option => {
  option.addEventListener('click', handleClick);
});



function FiltClick() {
  console.log('FiltClick');


}


function changeFilter(e) {

  const orderFilter = document.getElementById('orderFilter').value;
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


  const ordStatus = sessionStorage.getItem('ordFilterStatus');

  allOrdersClick(ordStatus, ordType)


}



allOrdersClick('*');
function allOrdersClick(ordStatus, type) {

  sessionStorage.setItem('ordFilterStatus', ordStatus);

  axios.get('./php/all-orders.php', {
    params: {
      ord_status: ordStatus,
      order_type: type
    }
  })
    .then(response => {
      // Check if the request was successful
      if (response.data.success) {
        const orders = response.data.orders;
        console.log('orders', response.data.orders);

        const tbody = document.querySelector('.orders-tbody');
        tbody.innerHTML = '';

        orders.forEach(order => {
          const tr = document.createElement('tr');

          // Add order details to the row
          tr.innerHTML = ` 
                    <td><span  class="orderIdElem"
                        onclick="OrderIdClick(${order.order_id}, ${order.shipment_id_fk})"
                    > #${order.order_id}</span></td>
                    <td>
                        <div>   <img src="${order.img}" alt="">
                            <span>${order.customer_name}</span>
                        </div>
                    </td>
                    <td><i class="fas fa-peseta-sign"></i> ${order.total_price}</td>
                    <td>${order.shipment_location}</td>
                    <td>${order.order_date}</td>

                    <td class="delivDate" onclick="deliveryDateClick(${order.order_id})">
                    ${order.delivery_date ? order.delivery_date
              : '<i  class="fas fa-calendar-week"></i>'}
    </td>


                    
                    <td>
                        <button onclick="orderStatusClick('${order.ord_status}',
                            ${order.order_id} ,${order.shipment_id_fk})">${order.ord_status}</button>
                    </td>`;

          // Apply classes based on ord_status
          switch (order.ord_status) {
            case 'Pending':
              tr.querySelector('button').classList.add('pending');
              break;
            case 'Completed':
              tr.querySelector('button').classList.add('completed');
              break;
            case 'Canceled':
              tr.querySelector('button').classList.add('cancel');
              break;
            default:
              break;
          }

          tbody.appendChild(tr);
        });
      } else {
        console.error("Error retrieving data from the server:", response.data);
      }
    })
    .catch(error => {
      console.error("Error:", error);
    });



}









function updateDateClick(event) {
  const date = document.getElementById('minMaxExample').value;
  const orderId = sessionStorage.getItem('orderId-deliveryDateClick');

  // Split the date string into day, month, and year
  const parts = date.split('/');
  const year = parts[2];
  const month = parts[1].padStart(2, '0'); // Ensure two-digit month format
  const day = parts[0].padStart(2, '0');   // Ensure two-digit day format

  // Format the date string in MySQL format
  const mysqlDate = `${year}-${month}-${day} 00:00:00`;

  // Construct requestData object
  const requestData = {
    order_id: orderId,
    delivery_date: mysqlDate
  };

  // Send POST request to update-deliv-date.php
  axios.post('./php/admin/update-deliv-date.php', requestData)
    .then(response => {
      // Handle success
      console.log('Delivery date successfully updated');

      allOrdersClick();


      removeActiveClass();
      allOrdersElem.classList.add('active');

      const deliveryDateOverlay = document.querySelector('.deliveryDate-overlay');
      deliveryDateOverlay.classList.add('hide');

      // Optionally, call any additional functions or update UI after successful update
    })
    .catch(error => {
      // Handle error
      console.error('Error updating delivery date:', error);
    });



}




function deliveryDateClick(orderId) {


  const deliveryDateOverlay = document.querySelector('.deliveryDate-overlay');
  deliveryDateOverlay.classList.remove('hide');

  sessionStorage.setItem('orderId-deliveryDateClick', orderId);


  console.log('orderid', orderId);

}



function deliveryDateXClick() {

  const deliveryDateOverlay = document.querySelector('.deliveryDate-overlay');
  deliveryDateOverlay.classList.add('hide');

}












function doneTyping() {
  const input = document.getElementById('orderSearch').value; // Trim whitespace from the input

  // Clear search results if input is empty
  if (input === '') {
    clearOrderSearch();
    console.log('testtest');
    return;
  }

  console.log('donetyping: ', input);


  axios.post('./php/admin/admin-search-orders.php', {
    search_term: input
  })
    .then(function (response) {
      // Handle success
      console.log(response.data);



      // Assuming this part of the code is within your Axios request handler
      if (response.data.success) {
        const orders = response.data.orders;
        const tbody = document.querySelector('.orders-tbody');
        tbody.innerHTML = '';

        if (orders.length > 0) {
          orders.forEach(order => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td><span class="orderIdElem" onclick="OrderIdClick(${order.order_id}, ${order.shipment_id_fk})">#${order.order_id}</span></td>
              <td>
                  <div>
                      <img src="${order.img}" alt="">
                      <span>${order.customer_name}</span>
                  </div>
              </td>
              <td><i class="fas fa-peseta-sign"></i> ${order.total_price}</td>
              <td>${order.shipment_location}</td>
              <td>${order.order_date}</td>
              <td class="delivDate" onclick="deliveryDateClick(${order.order_id})">
                  ${order.delivery_date ? order.delivery_date : '<i class="fas fa-calendar-week"></i>'}
              </td>
              <td>
                  <button onclick="orderStatusClick('${order.ord_status}', ${order.order_id}, ${order.shipment_id_fk})">${order.ord_status}</button>
              </td>`;
            switch (order.ord_status) {
              case 'Pending':
                tr.querySelector('button').classList.add('pending');
                break;
              case 'Completed':
                tr.querySelector('button').classList.add('completed');
                break;
              case 'Canceled':
                tr.querySelector('button').classList.add('cancel');
                break;
              default:
                break;
            }
            tbody.appendChild(tr);
          });
        } else {
          // If no orders found
          const tr = document.createElement('tr');
          tr.innerHTML = `<td colspan="7">No orders found.</td>`;
          tbody.appendChild(tr);
        }
      } else {
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
  const orderTbody = document.querySelector('.orders-tbody');

  orderTbody.innerHTML = '';
}


// Function to handle input event
function orderSearchInput(event) {
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
