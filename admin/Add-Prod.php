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
            <h2>Add a Product</h2>
        </div>


        <div class="add-product-body">

            <div class="field">


                <div class="container">



                    <div class="wrapper">
                        <div class="label-holder">
                            <label for="productInput">Product Name</label>

                        </div>

                        <input type="text" id="productNameInput" required>
                        <span class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>
                    </div>


                    <div class="wrapper-2">

                        <div>

                            <div class="label-holder">
                                <label for="productCategory"> Category</label>

                            </div>



                            <select name="" id="productCategory">

                                <option value="0">Category</option>

                                <option value="1">Shirts</option>
                                <option value="2">Pants & Trousers</option>
                                <option value="3">Dresses</option>


                                <option value="4">Accesories </option>
                                <option value="5">Others </option>

                            </select>
                            <span class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>
                        </div>




                        <div>

                            <div class="label-holder">
                                <label for="priceInput"> Price</label>

                            </div>


                            <input type="number" id="productPriceInput">
                            <span class="warning hide"> <i class="fas fa-exclamation"></i>Required </span>
                        </div>


                    </div>



                    <div class="wrapper">

                        <label for="descInput">Product Description</label>
                        <textarea name="" id="descriptionInput" class="descInput" maxlength="1400" cols="30" rows="10"></textarea>
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


                        </div>


                </div>


            </div>


            <div class="field">

                <h5 onclick="tryClick(event)" class="variant">Variants</h2>

                    <!-- <div class="variant-adder">

                        <section> 
                        </section>  
                        <div class="footer">
                            <div onclick="addOption()">
                                <i class="fas fa-plus"></i> <span>Add another Option</span>
                            </div>
                        </div>



                    </div> -->


                    <div id="addOption" class="variant-2">
                        <i class="fas fa-plus"></i> <span>Add another Option</span>
                    </div>


                    <table class="variant-tbl">

                        <thead>
                            <tr>
                                <th colspan=" ">
                                    <input type="checkbox" title="inputCheckBox">
                                </th>

                                <th>
                                    Variant
                                </th>


                                <th colspan=" ">
                                    Color
                                </th>

                                <th colspan=" ">
                                    Size
                                </th>

                             

                                <th>
                                    Price
                                </th>

                                <th colspan=" ">
                                    Stock
                                </th>

                            </tr>
                        </thead>

                        <tbody id="tableBody">
                            <tr>
                            </tr>
                        </tbody>

                    </table>





            </div>

            <div class="footer">

                <div>
                    <button onclick="SaveData(event)">Save</button>
                </div>

            </div>






        </div>

    </div>






    <script>
        document.getElementById('addOption').addEventListener('click', function() {
            var tbody = document.getElementById('tableBody');
            var newRow = document.createElement('tr');

            newRow.innerHTML = `
            <td>
                <button onclick="deleteRow(this)"><i class="fas fa-trash"></i></button>
            </td>

            <td class="variant-image-container">
                <div> 
                          <img src="default.png" class="image" onclick="addvariantImgCLick(this)" >
                            <i class="far fa-image"></i> 
                      </div>
            </td>
         
            <td>
                <input type="text">
            </td>
            <td>
                <input type="text">
            </td>
            <td>
                <input type="number" title="StockInput">
            </td>
            <td>
                <input type="number" title="StockInput">
            </td>
           
        `;




            tbody.appendChild(newRow);
        });
    </script>

    <script>



    </script>

    <script src="./js/add-products.js"></script>
</body>

</html>