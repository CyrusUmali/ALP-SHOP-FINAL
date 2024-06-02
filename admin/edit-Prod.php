<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



</head>

<body>




    <div class="section">


        <div onclick="testCLick(event)">
            <!-- <i class="fas fa-arrow-left"></i> -->
            <h2>Edit Product</h2>
        </div>


        <div class="add-product-body">

            <div class="field">


                <div class="container">



                    <div class="wrapper">
                        <div class="label-holder">
                            <label for="productInput">Product Name</label>
                            <span class="warning hide">Required </span>
                        </div>

                        <input type="text" id="productNameInput" required>
                    </div>


                    <div class="wrapper-2">

                        <div>

                            <div class="label-holder">
                                <label for="productCategory"> Category</label>
                                <span class="warning hide">Required </span>
                            </div>



                            <select name="" id="productCategory">

                                <option value="0">Select Category</option>
                                <option value="1">Tops</option>
                                <option value="2">Dresses</option>
                                <option value="3">Bottoms</option>
                                <option value="4">Jackets</option>
                                <option value="5">Accesories</option>
                                <option value="7">Bag</option>


                            </select>
                        </div>




                        <div>

                            <div class="label-holder">
                                <label for="priceInput"> Price</label>
                                <span class="warning hide">Required </span>
                            </div>


                            <input type="number" id="productPriceInput">
                        </div>


                    </div>



                    <div class="wrapper">

                        <label for="descInput">Product Description</label>
                        <textarea name="" id="descriptionInput" class="descInput" cols="30" rows="10"></textarea>
                    </div>


                </div>


            </div>


            <div class="field">


                <div class="media-container">

                    <h5>Media</h2>
                        <div class="add-image">
                            <span class="warning hide">Required Atleast One</span>
                            <button>Add</button>
                            <span onclick="showFileAdd(event)">Add from Url</span>


                        </div>

                        <div class="images-container">

                            <!-- <div class="img-item">

                                <img src="https://th.bing.com/th?q=Gura+Anime&w=42&h=42&c=7&rs=1&p=0&o=5&dpr=1.3&pid=1.7&mkt=en-PH&cc=PH&setlang=en&adlt=moderate&t=1" alt="">

                                <i class="fas fa-eye"></i>

                            </div> -->


                        </div>


                </div>


            </div>


            <div class="field">

                <h5 onclick="tryClick(event)">Variants</h2>

                    <!-- <div class="variant-adder">

                        <section> 
                        </section>  
                        <div class="footer">
                            <div onclick="addOption()">
                                <i class="fas fa-plus"></i> <span>Add another Option</span>
                            </div>
                        </div>



                    </div> -->


                    <div onclick="editPageAddNew(event)" class="addOption">
                        <i class="fas fa-plus"></i> <span>Add another Option</span>
                    </div>


                    <table class="variant-tbl">

                        <thead>
                            <tr>

                            <th colspan=" ">
                                    Variant
                                </th>

                                <th colspan=" ">
                                    Color
                                </th>

                                <th colspan=" ">
                                    Size
                                </th>
                                <th colspan=" ">
                                    Stock
                                </th>

                                <th>
                                    Price
                                </th>


                                <th colspan=" ">
                                    Actions
                                </th>


                            </tr>
                        </thead>

                        <tbody id="tableBody">

                        </tbody>

                    </table>





            </div>

            <div class="footer">

                <div>
                    <button onclick="SaveChanges(event)">Save Changes</button>
                </div>


            </div>






        </div>

    </div>





    <script>



    </script>

    <script src="./js/add-products.js"></script>
    <script src="./js/edit-product.js"></script>

</body>

</html>