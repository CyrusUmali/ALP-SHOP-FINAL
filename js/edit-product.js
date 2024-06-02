

var NameInput = document.getElementById('productNameInput');
var CategoryInp = document.getElementById('productCategory');
var priceInp = document.getElementById('productPriceInput');
var description = document.getElementById('descriptionInput');

var UrlELem = document.getElementById('img-url-holder');
var UrlArr = [];
var imagesContainer = document.querySelector('.media-container .images-container');


var itemDetails = JSON.parse(localStorage.getItem('itemDetails'));

var product_id = itemDetails.itemDetails.productDetails[0].product_id;
var productName = itemDetails.itemDetails.productDetails[0].name;
var productCategory = itemDetails.itemDetails.productDetails[0].category_fk;
var productPrice = itemDetails.itemDetails.productDetails[0].price;
var productdesc = itemDetails.itemDetails.productDetails[0].description;
var productImg = itemDetails.itemDetails.productDetails[0].img;

NameInput.value = productName;
CategoryInp.value = productCategory;
priceInp.value = productPrice;
description.value = productdesc;



// Assuming itemDetails.itemDetails.productDetails is an array
var productDetails = itemDetails.itemDetails.productImages;
// console.log(productDetails);
// console.log(UrlArr);

// Define a function to create and append image elements
function createAndAppendImage(imageUrl, index) {
    // Create a new img element
    var imgElement = document.createElement('img');
    // Set the src attribute
    imgElement.src = imageUrl;

    // Create a new div for the image item
    var imgItemDiv = document.createElement('div');
    imgItemDiv.className = 'img-item';

    // Create a new i element for the eye icon
    var eyeIcon = document.createElement('i');
    eyeIcon.className = 'fas fa-eye';

    // Append the img element and the eye icon to the image item div
    imgItemDiv.appendChild(imgElement);
    imgItemDiv.appendChild(eyeIcon);

    // Append the image item div to the images container
    imagesContainer.appendChild(imgItemDiv);

    // Add the src attribute to the UrlArr
    UrlArr.push(imageUrl);

    // Attach event listener to the image element
    imgElement.addEventListener('click', function (event) {




        // console.log('Image source:', event.target.src);
        // console.log('Index: ', index);

        sessionStorage.setItem('ViewImageSrc', event.target.src);
        sessionStorage.setItem('ViewImageIndex', index);

        const viewImageElem = document.querySelector('.view-img-overlay');
        viewImageElem.classList.remove('hide');

        const mainImgElem = document.querySelector('.main-img .mainImg');
        mainImgElem.src = event.target.src;

    });

}



// Loop through productDetails array
for (var i = 0; i < productDetails.length; i++) {
    var productImg = productDetails[i].image_url;

    // Call the function to create and append image elements
    createAndAppendImage(productImg, i); // Pass the index as an argument

}


function deleteImageClick(event) {
    // Retrieve image source and index from sessionStorage
    var deleteImgSrc = sessionStorage.getItem('ViewImageSrc');
    var deleteIndexSrc = parseInt(sessionStorage.getItem('ViewImageIndex')); // Parse to integer

    // Remove image URL from UrlArr
    UrlArr.splice(deleteIndexSrc, 1);

    // Remove image from productDetails
    productDetails.splice(deleteIndexSrc, 1);

    // Remove corresponding HTML element from the DOM
    var imgItemDivs = document.querySelectorAll('.img-item');
    var deleteImgDiv = imgItemDivs[deleteIndexSrc];
    deleteImgDiv.parentNode.removeChild(deleteImgDiv);


    // Loop through remaining images and update their indices
    for (var i = deleteIndexSrc; i < imgItemDivs.length; i++) {
        imgItemDivs[i].querySelector('img').setAttribute('data-index', i);
    }
    viewImageXClick();
}

// function replaceImageClick(event) {
//     // Retrieve image source and index from sessionStorage
//     var replaceImgSrc = sessionStorage.getItem('ViewImageSrc');
//     var replaceIndexSrc = parseInt(sessionStorage.getItem('ViewImageIndex')); // Parse to integer

//     // Retrieve the new image URL
//     var newImageUrl = document.getElementById('newImageLink').value;

//     // Replace image URL in UrlArr
//     UrlArr[replaceIndexSrc] = newImageUrl;

//     // Replace image in productDetails (if needed)
//     // Assuming productDetails is an array of objects with 'image_url' property
//     // productDetails[replaceIndexSrc].image_url = newImageUrl;

//     // Replace corresponding HTML element's src attribute in the DOM
//     var imgItemDivs = document.querySelectorAll('.img-item');
//     var replaceImgDiv = imgItemDivs[replaceIndexSrc].querySelector('img');
//     replaceImgDiv.src = newImageUrl;

//     const mainImgElem = document.querySelector('.main-img .mainImg');
//     mainImgElem.src = newImageUrl;
// }




function prevClick(event) {

    console.log('prevclick', itemDetails.itemDetails.productDetails);

}



function newClick(event) {
    console.log('newclikc');
}


function SaveChanges() {



    console.log("product_id:", product_id)
    console.log("Name :", NameInput.value);
    console.log('category: ', CategoryInp.value);
    console.log('Price', parseInt(priceInp.value));
    console.log('DESC', description.value);
    console.log('save changes');



    var requestData = {
        product_id: product_id,
        name: NameInput.value,
        description: description.value,
        category_fk: CategoryInp.value,
        previousImg: productDetails,
        newImg: UrlArr


    };


    axios.post('./php/admin/edit-item.php', requestData)
        .then(response => {
            console.log('Product successfully edited:', response.data);
            const productId = response.data.product_id;
            sessionStorage.setItem('EditProduct-Id', productId);
            popupOverlay.classList.remove('hide');
            successPopup.classList.remove('hide');
            updatedPopup.classList.remove('hide');

            // loadPage('./admin/edit-Prod.html')

        })
        .catch(error => {
            console.error('Error adding product:', error);
        });
}



function variantOverlaySaveClick(event) {
    console.log('varvar');
}



var tableBody = document.getElementById('tableBody');

// Assuming itemDetails is an array containing multiple product details
itemDetails.itemDetails.productDetails.forEach((product, index) => {
    const newRow = document.createElement('tr');

    // Set the data-variation-id attribute to the variation_id of the product
    newRow.setAttribute('data-variation-id', product.variation_id);

    newRow.innerHTML = `
     

          <td class="variant-image-container">
               <div> 
                     <img src="${product.var_img}" class="image"   >
                <i class="far fa-image"></i> 
                </div>
        </td>
  
        <td>
           <span> ${product.color}</span>
           <!-- <input type="text" value="${product.color}"> -->
        </td>
        <td>
        <!-- <input type="text" value="${product.size}">  -->
            <span> ${product.size}</span>  
        </td>
        <td>
        <!-- <input type="number" title="StockInput" value="${product.stock}"> -->
            <span> ${product.stock}</span>
        </td>
        <td>
        <!-- <input type="number" title="StockInput" value="${product.price}"> -->
            <span> ${product.price}</span>
        </td>

        <td>
        <button  onclick="EdeleteRow(this, '${product.variation_id}')"><i class="fas fa-trash"></i></button>
        <button onclick="editRow(this, '${product.variation_id}')"><i class="fas fa-pen-to-square"></i></button>
    </td>
 
    `;

    tableBody.appendChild(newRow);

    // Access the img tag for the current product
    // const productImage = document.getElementById(`productImage${index}`);

    // Set the src attribute of the img tag to the image URL
    // productImage.src = itemDetails.productImages[index].image_url;
});


function editRow(button, variationId) {
    // Access the parent row of the clicked button
    const row = button.parentNode.parentNode;

    // Access the variationId from itemDetails using the index of the row
    // const index = Array.prototype.indexOf.call(row.parentNode.children, row);
    // const variationId = itemDetails.itemDetails[index].variationId;

    // Now you can use the variationId as needed
    console.log('Variation ID:', variationId);
    sessionStorage.setItem('variationId', variationId);
    // Get the parent row of the clicked button
    // const row = button.closest('tr');

    // Get the data from the row
    const color = row.querySelector('td:nth-child(2) span').textContent;
    const size = row.querySelector('td:nth-child(3) span').textContent;
    const stock = row.querySelector('td:nth-child(4) span').textContent;
    const price = row.querySelector('td:nth-child(5) span').textContent;

    // Get the img element within the row
    const imgElement = row.querySelector('.variant-image-container img');

    // Get the src attribute value of the img element
    const varImg = imgElement.getAttribute('src');

    // Now you can use the imgSrc as needed
    console.log('Image Source:', varImg);


    // Construct an object with the data
    const variantData = { varImg, color, size, stock, price };

    // Convert the object to a JSON string
    const variantDataJSON = JSON.stringify(variantData);

    // Store the item data in session storage
    sessionStorage.setItem('editVariant', variantDataJSON);

    const variantOverlayElem = document.querySelector('.variant-overlay');

    const addVarStockInput = document.getElementById('addVarStockInput');
    const addVarPriceInput = document.getElementById('addVarPriceInput');
    const addVarColorInput = document.getElementById('addVarColorInput');
    const addVarSizeInput = document.getElementById('addVarSizeInput');

    const addVarImg = document.getElementById('addVarImg');
    const addVarImgInp = document.getElementById('addVarImgInp');


    addVarStockInput.valueAsNumber = parseInt(stock);
    addVarPriceInput.valueAsNumber = parseFloat(price);
    addVarColorInput.value = color;
    addVarSizeInput.value = size;

    addVarImg.src = varImg;
    addVarImgInp.value = varImg;


    variantOverlayElem.classList.remove('hide');

}


function addVarImgChange(event) {


    const addVarImg = document.getElementById('addVarImg');
    const addVarImgInp = document.getElementById('addVarImgInp');


    addVarImg.src = addVarImgInp.value;

    console.log('url: ', addVarImgInp.value);

}

function XaddVarImgChange(event) {


    const XaddVarImg = document.getElementById('XaddVarImg');
    const XaddVarImgInp = document.getElementById('XaddVarImgInp');


    XaddVarImg.src = XaddVarImgInp.value;

    console.log('url: ', XaddVarImgInp.value);

}



function variantXClick(event) {


    var variantOverlayElem = document.querySelector('.variant-overlay');
    variantOverlayElem.classList.add('hide');

}

function addVariantXClick(event) {


    var variantOverlayElem = document.querySelector('.add-variant-overlay');
    variantOverlayElem.classList.add('hide');

}



function variantOverlaySaveClick(event) {
    event.preventDefault();

    const addVarStockInput = document.getElementById('addVarStockInput').value;
    const addVarPriceInput = document.getElementById('addVarPriceInput').value;
    const addVarColorInput = document.getElementById('addVarColorInput').value;
    const addVarSizeInput = document.getElementById('addVarSizeInput').value;
    const addVarImgInp = document.getElementById('addVarImgInp').value;

    var variationId = sessionStorage.getItem('variationId');

    console.log(addVarStockInput);
    console.log(addVarPriceInput);
    console.log(addVarColorInput);
    console.log(addVarSizeInput);
    console.log(addVarImgInp);



    var requestData = {
        variation_id: variationId,
        size: addVarSizeInput,
        color: addVarColorInput,
        stock: addVarStockInput,
        price: addVarPriceInput,
        var_img: addVarImgInp



    };


    axios.post('./php/admin/edit-variant.php', requestData)
        .then(response => {
            console.log('Variant successfully edited:', response.data);
            // const productId = response.data.product_id;
            // sessionStorage.setItem('EditProduct-Id', productId);
            // popupOverlay.classList.remove('hide');
            // successPopup.classList.remove('hide');
            // updatedPopup.classList.remove('hide');

            const editedRow = document.querySelector(`tr[data-variation-id="${variationId}"]`);



            // Update the content of the row with the new variant data

            editedRow.querySelector('.variant-image-container img').src = addVarImgInp;
            editedRow.querySelector('td:nth-child(2) span').textContent = addVarColorInput;
            editedRow.querySelector('td:nth-child(3) span').textContent = addVarSizeInput;
            editedRow.querySelector('td:nth-child(4) span').textContent = addVarStockInput;
            editedRow.querySelector('td:nth-child(5) span').textContent
                = Number(document.getElementById('addVarPriceInput').value).toFixed(2);

            variantXClick();

        })
        .catch(error => {
            console.error('Error adding product:', error);
        });





}


function addVariantOverlaySaveClick(event) {
    event.preventDefault();


    const addVariantOverlayElem = document.querySelector('.add-variant-overlay');





    const XaddVarStock = document.getElementById('XaddVarStockInput');
    const XaddVarPrice = document.getElementById('XaddVarPriceInput');
    const XaddVarColor = document.getElementById('XaddVarColorInput');
    const XaddVarSize = document.getElementById('XaddVarSizeInput'); 
    const addVarImgInp = document.getElementById('addVarImgInp').value;

    const XaddVarColorWarning = document.getElementById('XaddVarColorWarning');
    const XaddVarPriceWarning = document.getElementById('XaddVarPriceWarning');
    const XaddVarStockWarning = document.getElementById('XaddVarStockWarning');
    const XaddVarSizeWarning = document.getElementById('XaddVarSizeWarning');


    let XaddVariant = true;
    if (XaddVarColor.value === null || XaddVarColor.value === '') {
        console.log("Color is required");
        XaddVariant = false;
        // XaddVarColor.parentElement.querySelector('.warning').classList.remove('hide');
        XaddVarColorWarning.classList.remove('hide');


        XaddVarColor.classList.add('error');


    }
    else {
        XaddVarColorWarning.classList.add('hide');
        XaddVarColor.classList.remove('error');
    }



    if (XaddVarSize.value === null || XaddVarSize.value === '') {
        console.log("Color is required");
        XaddVariant = false;
        // XaddVarColor.parentElement.querySelector('.warning').classList.remove('hide');
        XaddVarSizeWarning.classList.remove('hide');


        XaddVarSize.classList.add('error');


    }
    else {
        XaddVarSizeWarning.classList.add('hide');
        XaddVarSize.classList.remove('error');
    }





    if (parseInt(XaddVarPrice.value) <= 0 || isNaN(parseInt(XaddVarPrice.value))) {
        console.log('Price is required and must be a valid number');
        XaddVariant = false;
        // Remove the 'hide' class from the nearest warning span
        XaddVarPriceWarning.classList.remove('hide');
        XaddVarPrice.classList.add('error');

    } else {
        XaddVarPriceWarning.classList.add('hide');
        XaddVarPrice.classList.remove('error');
    }



    if (parseInt(XaddVarStock.value) <= 0 || isNaN(parseInt(XaddVarStock.value))) {
        console.log('Price is required and must be a valid number');
        XaddVariant = false;
        // Remove the 'hide' class from the nearest warning span
        XaddVarStockWarning.classList.remove('hide');
        XaddVarStock.classList.add('error');

    } else {
        XaddVarStockWarning.classList.add('hide');
        XaddVarStock.classList.remove('error');
    }


    if (XaddVariant) {

        console.log('variant can be added')


        var requestData = {
            size: XaddVarSize.value,
            color: XaddVarColor.value,
            stock: XaddVarStock.value,
            price: XaddVarPrice.value,
            var_img: addVarImgInp,
            product_id_fk: product_id


        };


        axios.post('./php/admin/add-variant.php', requestData)
            .then(response => {
                console.log('Variant successfully edited:', response.data);

                // Retrieve the newly added variant ID from the response
                const newVariantId = response.data.variant_id;

                // Create a new row element
                const newRow = document.createElement('tr');
                newRow.setAttribute('data-variation-id', newVariantId);

                // Fill in the content of the new row with the data of the added variant
                newRow.innerHTML = `

                   <td class="variant-image-container">
                         <div> 
                              <img src="${addVarImgInp}" class="image"   >
                           <i class="far fa-image"></i> 
                       </div>
                   </td>

                <td><span>${XaddVarColor.value}</span></td>
                <td><span>${XaddVarSize.value}</span></td>
                <td><span>${XaddVarStock.value}</span></td>
                <td><span>${XaddVarPrice.value}</span></td>
                <td>
                    <button onclick="deleteRow(this)"><i class="fas fa-trash"></i></button>
                    <button onclick="editRow(this, '${newVariantId}')"><i class="fas fa-pen-to-square"></i></button>
                </td>
            `;

                // Append the new row to the table body
                tableBody.appendChild(newRow);

                addVariantXClick();

            })
            .catch(error => {
                console.error('Error adding product:', error);
            });
    } else {
        console.log('variant cant be added')
    }









}





function EdeleteRow(button, variationId) {
    console.log(variationId);



    axios.post('./php/admin/delete-variation.php', { variation_id: variationId })
        .then(response => {
            console.log('Variant successfully deleted:', response.data);

            // Remove the deleted row from the HTML table
            const deletedRow = document.querySelector(`tr[data-variation-id="${variationId}"]`);
            deletedRow.parentNode.removeChild(deletedRow);

            // Proceed with any other actions after successful deletion
            variantXClick();
        })
        .catch(error => {
            console.error('Error editing variant:', error);
        });


}




function editPageAddNew(event) {

    const addVariantOverlayElem = document.querySelector('.add-variant-overlay');

    const XaddVarStockInput = document.getElementById('XaddVarStockInput');
    const XaddVarPriceInput = document.getElementById('XaddVarPriceInput');
    const XaddVarColorInput = document.getElementById('XaddVarColorInput');
    const XaddVarSizeInput = document.getElementById('XaddVarSizeInput');

    XaddVarStockInput.value = null;
    XaddVarPriceInput.value = null;
    XaddVarColorInput.value = null;
    XaddVarSizeInput.value = null;



    addVariantOverlayElem.classList.remove('hide');


}














