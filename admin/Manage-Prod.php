<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        .filter select {
            all: unset; 
            height: 100%;
            width: 100%;
            padding: 0px 15px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;    z-index: 10;
        }

       
        

    </style>
</head>

<body>

    <div class="section">

        <h2>Manage Products</h2>

        <div class="body">

            <div class="manage-control-container">



                <div class="search">
                    <input type="text" title="manageSearchBar"
                    oninput=(productSearchInput(event))
                    id="productSearch" 
                    placeholder="Search">
                </div>


                <div class="control">

                    <div class="category">


                        <select title="Category" id="categorySelect"  onchange="changeFilter(this)">
                            <option value="-1">Category</option>

                            <option value="1">Shirts</option>
                            <option value="2">Pants & Trousers</option>
                            <option value="3">Dresses</option>


                            <option value="4">Accesories </option>
                            <option value="5">Others </option>
                        </select> 

                        <i class="fas fa-angle-down"></i>

                    </div>

                    <div class="filter"  >

                        <select name="" id='dateFilter'  onchange="changeFilter(this)">
                            <option value="1">Last Added</option>
                            <option value="2">Newly Added</option>
                        </select>

                        <img src="./resources/icon/icons8-sort-80.png" alt="">
                    </div>

                </div>




            </div>



            <div class="inventory-product">



                <div class="product-wrapper">


                    <!-- <div class="product">
                        <img src="" alt="">
                        <span class="product-name ">Product Name lorem</span>

                        <div class="details ">


                            <i class="fas fa-peseta-sign">300.00</i>

                            <div class="stocks">
                                <label>Stocks:</label>
                                <span>500</span>
                            </div>

                        </div>

                        <div class="action " >

                            <button class="editBtn">
                                <i class="far fa-edit"></i>
                                <span>Edit</span>
                            </button>

                            <button class="deleteBtn">
                                <i class="fas fa-trash"></i>
                                <span>Delete</span>
                            </button>


                        </div>


                        <div class="delete-confirm-container hide">

                            <i class="far fa-times-circle"></i>

                            <span class="main-message">
                                Are you Sure?
                            </span>

                            <span class="sub-message">

                                Do you really want to delete this item? This process cannot be undone.

                            </span>

                            <div class="delete-btn-wrapper">

                                <button class="cancel">Cancel</button> <button class="delete">Delete</button>

                            </div>


                        </div>


                    </div> -->





                </div>


                <!-- 
                <table class="product-table">

                    <thead>
                        <tr>
                            <th>
                                Product Name
                            </th>

                            <th> Price </th>

                            <th>Stock </th>

                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr> 
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
                                10
                            </td>

                            <td>
                                <button>
                                    Edit
                                </button>

                                <button>Delete</button>
                            </td>



                        </tr>



                    </tbody>


                </table> -->



            </div>




            <!-- <div class="page-control">

                <div>Previous</div>
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <div>Next</div>

            </div> -->

        </div>

    </div>



    <script src="./js/admin-manage-prod.js"></script>

</body>

</html>