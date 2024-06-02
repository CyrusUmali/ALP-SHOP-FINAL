<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../resources/css/order-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="..." crossorigin="anonymous">

</head>

<body>


    <div class="order-form">


        <div class="order-form-header">

            <h4>ORDER FORM</h6>
                <img src="../resources/alp-shop-logo.jpg" alt="">

        </div>

        <div class="order-details">

            <div class="customer-details">

                <h3>Customer Details: </h3>

                <div class="details-list-wrapper">

                    <ul>
                        <li>
                            <b>Customer Name: </b> <span id="recipientName">Juan Dela Cruz</span>
                        </li>

                        <li>
                            <b>Address: </b> <span id="recipientAddress">Wiltshire, UK</span>
                        </li>

                        <li>
                            <b>Contact:</b> <span id="recipientContact">jdc@gmail.com</span>
                        </li>

                        <!-- <li>
                            <b>Phone:</b> <span >090909090990</span>
                        </li> -->

                    </ul>

                    <ul>

                        <li>
                            <b>Date:</b> <span id="orderDate">07-07-2024</span>
                        </li>

                        <li>
                            <b>Order Number:</b> <span id="orderId">#509269</span>
                        </li>

                    </ul>

                </div>



            </div>


            <div class="delivery-details">

                <h3>Delivery Details: </h3>


                <div class="details-list-wrapper">


                    <ul>
                        <!-- <li>
                        <b>Delivery Address: </b> <span id="recipientAddress">Paris, France</span>
                    </li> -->

                        <li>
                            <b>Delivery Method: </b> <span>Pick-up / Meet Up</span>
                        </li>

                        <li>
                            <b>Est. Delivery Date: </b> <span id="estDeliverDate"> 07-20-24</span>
                        </li>


                    </ul>
 



                </div>

            </div>




        </div>



        <table>

            <thead>
                <tr>
                    <th>
                        Item #
                    </th>

                    <th>
                        product
                    </th>

                    <th>
                        Price
                    </th>

                    <th>
                        Quantity
                    </th>


                    <th>
                        Total
                    </th>

                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>
                        1
                    </td>

                    <td>
                        <div>
                            <img src="" alt="">
                            <label for="">Product Name</label>
                        </div>
                    </td>

                    <td>
                        P100.00
                    </td>

                    <td>
                        5
                    </td>

                    <td>
                        P500.00
                    </td>


                </tr>



                <tr>
                    <td>
                        1
                    </td>

                    <td>
                        <div>
                            <img src="" alt="">
                            <label for="">Product Name</label>
                        </div>
                    </td>

                    <td>
                        P100.00
                    </td>

                    <td>
                        5
                    </td>

                    <td>
                        P500.00
                    </td>


                </tr>





            </tbody>


        </table>



        <div class="order-form-footer">

            <div class="left-component">

                <div class="btn-wrapper">
                    <button class="btn-2" onclick="cancelClick(event)">Cancel</button>
                    <button class="btn-1" onclick="printClick(event)">Print</button>
                </div>

            </div>

            <div class="right-component">

                <div class="item-1">

                    <label>Subtotal:</label>
                    <span id="subtotal">P5,500.00</span>

                </div>

                <div class="item-1">

                    <label>Shipping <i class="far fa-question-circle" title="For Outside Alaminos / San Pablo Areas "> </i></label>
                    <span id="shippingFee"> P36.00</span>

                </div>


                <div class="item-2">

                    <label>Total </label>
                    <span id="total">P5,536.00</span>

                </div>

            </div>


        </div>



    </div>











    <script>
        // Retrieve order items from sessionStorage
        var orderItems = JSON.parse(sessionStorage.getItem('OrderItems'));
        console.log(orderItems);




        // Get the tbody element where the order items will be rendered
        var tbody = document.querySelector('tbody');

        // Map each order item to a table row and join them together
        var tableRows = orderItems.orderItems.map(function(orderItem, index) {
            return `
        <tr>
            <td>${index + 1}</td>
            <td>
                <div>
                    <img src="${orderItem.var_img}" alt="Product Image">
                    <label for="">${orderItem.name}</label>
                </div>
            </td>
            <td>P${orderItem.price}</td>
            <td>${orderItem.quantity}</td>
            <td>P${(parseFloat(orderItem.price) * orderItem.quantity).toFixed(2)}</td>
        </tr>
    `;
        });

        // Append the table rows to the tbody
        tbody.innerHTML = tableRows.join('');


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




        const recipientContactElem = document.getElementById('recipientContact');
        recipientContactElem.textContent = recipientDetails.ordersDetails[0].contact;

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











        const shippingFeeElem = document.getElementById('shippingFee');
        shippingFeeElem.textContent = 'P55.00';

        const subtotalElem = document.getElementById('subtotal');
        subtotalElem.textContent = 'P' + recipientDetails.ordersDetails[0].total_price;


        const totalFeeElem = document.getElementById('total');
        totalFeeElem.textContent = 'P' + (parseFloat(recipientDetails.ordersDetails[0].total_price) + 55).toFixed(2);




        function printClick(event) {

            window.print();

        }

        function cancelClick(event) {

            // Close the current tab
            window.close();


        }
    </script>






















</body>

</html>