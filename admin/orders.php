    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <style>
            .filter {
                cursor: pointer;

            }

            .filter select {
                 all: unset;
                 width: 100%;
                 padding: 0px 15px;

            }
        </style>

    </head>

    <body>

        <div class="section">

            <h2>Order List</h2>

            <div class="body">

                <div class="orders-control-container">



                    <div class="search">
                        <input type="text" id="orderSearch" 
                        title="manageSearchBar" placeholder="Search"
                        oninput=(orderSearchInput(event))
                        >
                    </div>


                    <div class="control">

                        <!-- <div class="category">


                            <select title="Category" id="categorySelect">
                                <option value="">Category</option>
                            </select>


                            <i class="fas fa-angle-down"></i>

                        </div> -->

                        <div class="filter" onclick="FiltClick(event)">

                            <!-- <span ></span> -->
                            <select name="" id="orderFilter" onchange="changeFilter(this)">

                                <option value="1">Newest to Oldest</option>
                                <option value="2">Oldest to Newest</option>

                            </select>
                            <img src="./resources/icon/icons8-sort-80.png" alt="">
                        </div>

                    </div>




                </div>



                <div class="orders-options">
                    <span class="option active" id="allOrders" onclick="allOrdersClick('*')">All Orders</span>
                    <span class="option" id="completedOrders" onclick="allOrdersClick('Completed')">Completed</span>
                    <span class="option" id="pendingOrders" onclick="allOrdersClick('Pending')">Pending</span>
                    <span class="option" id="cancelOrders" onclick="allOrdersClick('Canceled')">Canceled</span>
                </div>



                <table class="orders-table">
                    <thead>
                        <tr>
                            <!-- <th>#</th> -->
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
                        <!-- <tr>
                            <td>
                                1
                            </td>
                            <td>
                                <a href="./admin/order-form.php">#0001</a>
                            </td>
                            <td>
                                <div>
                                    <img src="https://images.unsplash.com/photo-1604176354204-9268737828e4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8amVhbnN8ZW58MHx8MHx8fDA%3D" alt="">
                                    <span>User Name</span>
                                </div>

                            </td>
                            <td>
                                P300.00
                            </td>

                            <td>
                                Alaminos, Laguna
                            </td>

                            <td>
                                12/12/2024
                            </td>

                            <td>
                                <select id="orderStatus">
                                    <option value="0">Pending</option>
                                    <option value="1">Completed</option>
                                    <option value="2">Cancel</option>
                                </select>


                            </td>
                        </tr> -->



                    </tbody>

                </table>







            </div>

        </div>









        <script src="./js/orders.js"></script>


    </body>

    </html>