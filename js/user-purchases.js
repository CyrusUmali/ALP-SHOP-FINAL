
// Get all option elements
var options = document.querySelectorAll('.purchase-options .option');

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





axios.post('./php/user/user-orders.php', {
    ord_status: '*' // Pass '*' to retrieve all order statuses
})
    .then(function (response) {
        console.log(response.data);


        renderOrdersData(response.data)
    })
    .catch(function (error) {
        console.error(error);
    });




function renderOrdersData(data) {
    const orders = data.orders;

    // Create an array to store grouped orders while maintaining the order
    const groupedOrders = [];

    // Iterate through orders to group them while maintaining order
    orders.forEach(order => {
        const orderId = order.order_id;
        // Find if there is already a group with the same order_id
        const existingGroupIndex = groupedOrders.findIndex(group => group[0].order_id === orderId);
        if (existingGroupIndex !== -1) {
            // Add the order to the existing group
            groupedOrders[existingGroupIndex].push(order);
        } else {
            // Create a new group and add the order
            groupedOrders.push([order]);
        }
    });

    const purchasesBody = document.getElementById('ordersContainer');
    purchasesBody.innerHTML = '';

    // Iterate over grouped orders while maintaining order and render
    groupedOrders.forEach(group => {
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('item');

        // Use template literals to generate HTML for each group
        itemDiv.innerHTML = group.map(order => `
                <div class="purchase-content">
                    <div class="btn">
                        <img src="${order.var_img}" alt="${order.name}">
                    </div>
                    <div class="text-group">
                        <p>${order.name}</p>
                        <span>${order.size} / ${order.color}</span>
                        <span>Quantity: ${order.quantity}</span>
                    </div>
                    <div class="price">
                        <span>Price: <i class="fas fa-peseta-sign"></i> ${order.price}</span>
                    </div>
                </div>
            `).join('');

        // Add purchase-item-footer
        const footerDiv = document.createElement('div');
        footerDiv.classList.add('purchase-item-footer');



        // Assuming group[0].delivery_date is the delivery date of the first order in the group
        const deliveryDate = group[0].delivery_date ? new Date(group[0].delivery_date) : null; // Convert delivery date string to Date object

        // Get today's date
        const today = new Date();

        // Check if the delivery date is not set or if it's past today's date
        const canCancelOrder = !deliveryDate || deliveryDate > today;

        // Conditionally render the buttons based on the delivery date
        let cancelOrderButton = '';
        let receiveOrderButton = '';
        if (canCancelOrder) {
            // Render the "Cancel Order" button
            cancelOrderButton = `<button type="button" class="cancel" onclick="cancelOrderClick(${group[0].order_id})">Cancel Order</button>`;
        } else {
            // Render only the "Order Received" button
            receiveOrderButton = `<button type="button" class="recieve" onclick="recieveOrderClick(${group[0].order_id})">Order Received</button>`;
        }

        // Change footer content based on ord_status
        switch (group[0].ord_status) {
            case 'Completed':
                footerDiv.innerHTML = `
                <img class=""viewDetails width="35" height="35"
                onclick="detailsClick(${group[0].order_id}, ${group[0].shipment_id_fk})"
                style=" 
                cursor: pointer;
                margin-right: 511px;
                margin-top: 10px;
            "
                src="https://img.icons8.com/pastel-glyph/64/information--v2.png" alt="information--v2"/>
   
             <span   class="recieved"   > Order Received</span>
 
        `;
                break;
            case 'Pending':
                footerDiv.innerHTML = `
                        <img class="viewDetails" width="35" height="35"
                        onclick="detailsClick(${group[0].order_id}, ${group[0].shipment_id_fk})"
                        style="cursor: pointer;
                         margin-right: 707px; 
                         margin-top: 10px;"
                        src="https://img.icons8.com/pastel-glyph/64/information--v2.png" alt="information--v2"/>
                        ${cancelOrderButton}
                        ${receiveOrderButton}
                    `;
                break;
            case 'Canceled':
                footerDiv.innerHTML = `
                <img class=""viewDetails width="35" height="35"
                onclick="detailsClick(${group[0].order_id}, ${group[0].shipment_id_fk})"
                style=" 
                cursor: pointer;
                margin-right: 511px;
                margin-top: 10px;
            "
                src="https://img.icons8.com/pastel-glyph/64/information--v2.png" alt="information--v2"/>
   
            <span class="cancelled">Order Canceled</span>
        `;
                break;
            default:
                footerDiv.innerHTML = '';
        }

        itemDiv.appendChild(footerDiv);

        // Append itemDiv to the container (assuming you have a container with id "ordersContainer")
        purchasesBody.appendChild(itemDiv);
    });
}







function detailsClick(orderId, shipment_id) {





    axios.get(`./php/order-form-details.php?shipment_id=${shipment_id}`)
        .then(response => {
            console.log(response.data);

            sessionStorage.setItem('orderIdClick2', JSON.stringify(response.data));
            if (response.data.success) {

                sessionStorage.setItem('OrderUserDetails', JSON.stringify(response.data));




                var recipientDetails = JSON.parse(sessionStorage.getItem('OrderUserDetails'));
                console.log(recipientDetails);


                // console.log(recipientDetails[0].address);

                console.log(recipientDetails.ordersDetails[0].address);

                const orderIdElem = document.getElementById('orderId');
                orderIdElem.textContent = '#' + recipientDetails.ordersDetails[0].order_id;


                const orderDateElem = document.getElementById('orderDate');

                const orderDateStr = recipientDetails.ordersDetails[0].order_date; // Assuming order_date is a string representing the date

                // Create a new Date object from the order date string
                const orderDate = new Date(orderDateStr);

                // Extract the date components
                const year = orderDate.getFullYear();
                const month = String(orderDate.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so add 1
                const day = String(orderDate.getDate()).padStart(2, '0');

                // Format the date without the time
                const formattedOrderDate = `${year}-${month}-${day}`;

                // Set the formatted date to the orderDateElem
                orderDateElem.textContent = formattedOrderDate;




                // const recipientContactElem = document.getElementById('recipientContact');
                // recipientContactElem.textContent = recipientDetails.ordersDetails[0].contact;

                const recipientNameElem = document.getElementById('recipientName');
                recipientNameElem.textContent = recipientDetails.ordersDetails[0].first_name +
                    ' , ' + recipientDetails.ordersDetails[0].last_name;

                const recipientAddressElem = document.getElementById('recipientAddress');
                recipientAddressElem.textContent = recipientDetails.ordersDetails[0].city +
                    ' , ' + recipientDetails.ordersDetails[0].province;



                const estDeliverDateElem = document.getElementById('estDeliverDate');

                const delivDateStr = recipientDetails.ordersDetails[0].delivery_date; // Assuming order_date is a string representing the date

                // Create a new Date object from the order date string
                const delivDate = new Date(delivDateStr);

                // Extract the date components
                const dyear = delivDate.getFullYear();
                const dmonth = String(delivDate.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so add 1
                const dday = String(delivDate.getDate()).padStart(2, '0');

                // Format the date without the time
                const formattedDelivDate = `${dyear}-${dmonth}-${dday}`;

                // Set the formatted date to the orderDateElem
                estDeliverDateElem.textContent = formattedDelivDate;







                const shippingFeeElem = document.getElementById('ordDetShippingFee');
                shippingFeeElem.textContent = 'P55.00';

                const subtotalElem = document.getElementById('subtotal');
                subtotalElem.textContent = 'P' + recipientDetails.ordersDetails[0].total_price;


                const totalFeeElem = document.getElementById('ordDetTotal');
                totalFeeElem.textContent = 'P' + (parseFloat(recipientDetails.ordersDetails[0].total_price) + 55).toFixed(2);



                const ordDetailsElem = document.querySelector('.order-details-container');
                ordDetailsElem.classList.remove('hide');




            }
        })
        .catch(error => {
            console.error('There was a problem with the Axios request:', error);
        });

























}

function ordDetailsXClick(event) {

    const ordDetailsElem = document.querySelector('.order-details-container');
    ordDetailsElem.classList.add('hide');

}



function recieveOrderClick(orderId) {

    const recievePopUp = document.querySelector('.recieve-confirm-container');
    recievePopUp.classList.remove('hide');


    sessionStorage.setItem('orderIdToRecieve', orderId);

}


function cancelOrderClick(orderId) {
    const cancelPopUp = document.querySelector('.cancel-confirm-container');
    cancelPopUp.classList.remove('hide');

    sessionStorage.setItem('orderIdToCancel', orderId);

}


function cancelXClick(event) {



    const cancelPopUp = document.querySelector('.cancel-confirm-container');
    cancelPopUp.classList.add('hide');


}

function recieveXClick(event) {



    const recievePopUp = document.querySelector('.recieve-confirm-container');
    recievePopUp.classList.add('hide');


}



var allOrdersElem = document.getElementById('allOrders');
var pendingOrdersElem = document.getElementById('pendingOrders');
var cancelOrdersElem = document.getElementById('cancelOrders');
var completedOrdersElem = document.getElementById('completedOrders');


function userOrdersClick(option) {
    console.log(option);





    axios.post('./php/user/user-orders.php', {
        ord_status: option // Pass '*' to retrieve all order statuses
    })
        .then(function (response) {
            console.log(response.data);


            renderOrdersData(response.data)


            removeActiveClass();

            switch (option) {
                case 'Completed':
                    completedOrdersElem.classList.add('active');
                  

                    break;
                case 'Canceled':
                    cancelOrdersElem.classList.add('active');
                    
                    break;
                case 'Pending':
                    pendingOrdersElem.classList.add('active');
                     
                    break;
                default:
                    allOrdersElem.classList.add('active');
                  
                    break;



            }




        })
        .catch(function (error) {
            console.error(error);
        });




}







function confirmCancelCLick(event) {

    var order_id = sessionStorage.getItem('orderIdToCancel');


    // Send POST request to update-order-status.php
    axios.post('./php/update-order-status.php', {
        order_id: order_id,
        ord_status: 'Canceled'
    })
        .then(response => {
            // Handle success
            console.log('Order status successfully updated');


            userOrdersClick('Canceled');

            const cancelPopUp = document.querySelector('.cancel-confirm-container');
            cancelPopUp.classList.add('hide');



            // Optionally, call any additional functions or update UI after successful update
        })
        .catch(error => {
            // Handle error
            console.error('Error updating order status:', error);
        });

}

function confirmRecieveCLick(event) {

    var order_id = sessionStorage.getItem('orderIdToRecieve');


    // Send POST request to update-order-status.php
    axios.post('./php/update-order-status.php', {
        order_id: order_id,
        ord_status: 'Completed'
    })
        .then(response => {
            // Handle success
            console.log('Order status successfully updated');


            userOrdersClick('Completed');

            const recievePopUp = document.querySelector('.recieve-confirm-container');
            recievePopUp.classList.add('hide');




            // Optionally, call any additional functions or update UI after successful update
        })
        .catch(error => {
            // Handle error
            console.error('Error updating order status:', error);
        });

}







