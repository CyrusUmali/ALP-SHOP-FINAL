<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <style>
        .section {
            margin-top: 80px;
        }

        .section .body {

            padding-bottom: 30px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 24px -1px,
                rgba(0, 0, 0, 0.3) 0px 1px 3px -1px !important;

        }

        .wishlist-header {
            margin-left: auto;
            margin-top: 30px;

            font-size: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .wishlist-header i {

            margin-top: 20px;

        }

        .wishlist-header span {

            margin-bottom: 20px;

        }

        td button {
            background-color: black !important;
            color: white !important;
            padding: 5px 17px !important;
        }

        .orders-table i{
            cursor: pointer;
        }
    </style>

</head>

<body>

    <div class="section">



        <div class="body">




            <div class="wishlist-header">

                <i class="far fa-heart"></i>
                <span> My Wishlist</span>

            </div>



            <table class="orders-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Stock Status</th>
                        <th></th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <i class="fas fa-times"></i>
                        </td>

                        <td>
                            <div>
                                <img src="https://images.unsplash.com/photo-1604176354204-9268737828e4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8amVhbnN8ZW58MHx8MHx8fDA%3D" alt="">
                                <span>Product Name</span>
                            </div>

                        </td>
                        <td>
                            P300.00
                        </td>


                        <td>
                            In Stock
                        </td>

                        <td>
                            <button>Add to Cart</button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <i class="fas fa-times"></i>
                        </td>

                        <td>
                            <div>
                                <img src="https://images.unsplash.com/photo-1604176354204-9268737828e4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8amVhbnN8ZW58MHx8MHx8fDA%3D" alt="">
                                <span>Product Name</span>
                            </div>

                        </td>
                        <td>
                            P300.00
                        </td>


                        <td>
                            In Stock
                        </td>

                        <td>
                            <button>Add to Cart</button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <i class="fas fa-times"></i>
                        </td>

                        <td>
                            <div>
                                <img src="https://images.unsplash.com/photo-1604176354204-9268737828e4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8amVhbnN8ZW58MHx8MHx8fDA%3D" alt="">
                                <span>Product Name</span>
                            </div>

                        </td>
                        <td>
                            P300.00
                        </td>


                        <td>
                            In Stock
                        </td>

                        <td>
                            <button>Add to Cart</button>
                        </td>
                    </tr>


                </tbody>

            </table>







        </div>

    </div>











   







    <script src="./js/user-wishlist.js"></script>


</body>

</html>