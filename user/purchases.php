<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 

    <style>

 .section{
    margin-top: 50px;
 }

 .purchase-content{
    background-color: gainsboro;
 }

 

    </style>

</head>

<body>




    <div class="section">

      <h3>My Purchases</h3>
        <!-- <div class="search-bar">

                <i class="fas fa-search"></i> <input type="text" title="orders-search" placeholder="Search by Item">

                <div>



                </div>

            </div> --> 
            
        <div class="purchase-options">
            <span class="option active" id="allOrders" onclick="userOrdersClick('*')">All Orders</span>
            <span class="option" id="pendingOrders" onclick="userOrdersClick('Pending')">Pending</span>
            <span class="option" id="completedOrders" onclick="userOrdersClick('Completed')">Completed</span>
    
            <span class="option" id="cancelOrders" onclick="userOrdersClick('Canceled')">Canceled</span>
        </div>

        <div class="orders-container" id="ordersContainer">



            <div  class="item">




                <!-- <div class="purchase-content">

                    <div class="btn">
                        <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmFnfGVufDB8fDB8fHww" alt="">

                    </div>


                    <div class="text-group">

                        <p> Crimson Satchel </p>
                        <span>Crimson-HDD02</span>
                        <span>Quantity: 2</span>

                    </div>

                    <div class="price">

                        <span>Price: <i class="fas fa-peseta-sign"></i> 399</span>
                    </div>





                </div>
                <div class="purchase-content">

                    <div class="btn">
                        <img src="https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059655/1711148884193_deckmf.jpg" alt="">

                    </div>


                    <div class="text-group">

                        <p> Midnight Temptation: Elixir of Desire </p>
                        <span>Black </span>
                        <span>Quantity :1</span>

                    </div>

                    <div class="price">
                        <span>Price: <i class="fas fa-peseta-sign"></i> 299.00</span>
                    </div>





                </div> -->

                <div class="purchase-item-footer">

                    <button type="button" class="cancel">Cancel Order</button>
                    <button type="button" class="recieve">Recieve Order</button>

                </div>


            </div>







        </div>


    </div>








 
  <script src="./js/user-purchases.js"></script>




</body>

</html>