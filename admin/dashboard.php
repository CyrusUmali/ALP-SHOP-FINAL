<?php
// Start session
session_start();


// Access the total_sum_total_price session variable
$totalSumTotalPrice = isset($_SESSION['total_sum_total_price'])
    ? $_SESSION['total_sum_total_price'] : '0';

$totalCustomers = isset($_SESSION['total_completed_orders'])
    ? $_SESSION['total_completed_orders'] : 'null';

$totalStocks = isset($_SESSION['total_stocks_variation'])
    ? $_SESSION['total_stocks_variation'] : 'null';

$totalSoldProds = isset($_SESSION['total_sum_quantity'])
    ? $_SESSION['total_sum_quantity'] : 'null';




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!-- <style>
        body {
            color: #858585;
        }
    </style> -->

</head>

<body>

    <div class="section">

        <h2>Dashboard</h2>

        <div class="body">

            <div class="upper-container">

                <div class="upper-container--item">

                    <div class="title-block">

                        <b>Total Profit</b>

                        <img width="40" height="40" src="https://img.icons8.com/carbon-copy/100/economic-improvement.png" alt="economic-improvement" />

                    </div>

                    <div class="value-container">

                        <i class="fas fa-peseta-sign"> </i>
                        <span>
                            <!-- 10,000  -->
                            <?php echo $totalSumTotalPrice; ?>

                        </span>

                    </div>

                </div>


                <div class="upper-container--item">

                    <div class="title-block">

                        <b>Total No.of Customers</b>

                        <img width="40" height="40" src="https://img.icons8.com/ios/50/budget.png" alt="budget" />

                    </div>

                    <div class="value-container">

                        <span>
                            <!-- 10,000 -->
                            <?php echo $totalCustomers; ?>

                        </span>

                    </div>

                </div>

                <div class="upper-container--item">

                    <div class="title-block">

                        <b>Total Sold Products</b>


                        <img width="40" height="40" src="https://img.icons8.com/dotty/80/web-analystics.png" alt="web-analystics" />

                    </div>

                    <div class="value-container">

                        <!-- <span>10,000</span> -->

                        <?php echo $totalSoldProds; ?>
                      

                    </div>

                </div>

                <div class="upper-container--item">

                    <div class="title-block">

                        <b>Total Products Stocks</b>

                        <img width="40" height="40" src="https://img.icons8.com/dotty/80/product.png" alt="product" />

                    </div>

                    <div class="value-container">

                        <!-- <i class="fas fa-peseta-sign"> </i> -->
                        <span>
                            <!-- 10,000 -->
                            <?php echo $totalStocks; ?>

                        </span>

                    </div>

                </div>


            </div>

            <div class="tbl-container">


                <select name="" id="" class="filter">
                    <option value="1">This Month</option>
                </select>


                <table class="orders-table">
                    <thead>



                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Price</th>
                            <th>Address</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody class="orders-tbody">



                    </tbody>

                </table>





            </div>

        </div>



    </div>



    <script>
        axios.get('./php/admin/orders-per-Month.php')
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
                        <div>
                        <img src="${order.img}" alt="">
                            <span>${order.customer_name}</span>
                        </div>
                    </td>
                    <td><i class="fas fa-peseta-sign"></i> ${order.total_price}</td>
                    <td>${order.shipment_location}</td>
                    <td>${order.order_date}</td>
                  
                    <td class="delivDate"  >
                    ${order.delivery_date ? order.delivery_date
    : '<i  class="fas fa-calendar-week"></i>'}
    </td>

    

                    <td>
                        <button >${order.ord_status}</button>
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
    </script>




    <!-- <script src="./js/orders.js"></script> -->



</body>

</html>