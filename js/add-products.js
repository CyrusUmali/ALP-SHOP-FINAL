

sessionStorage.setItem('Buffer', "Buffer");

if (sessionStorage.getItem('Buffer') === 'Buffer') {

    sessionStorage.removeItem('Method');


    var ProductName = null;

    var NameInput = document.getElementById('productNameInput');
    var CategoryInp = document.getElementById('productCategory');
    var priceInp = document.getElementById('productPriceInput');
    var description = document.getElementById('descriptionInput');

    var UrlELem = document.getElementById('img-url-holder');
    var UrlArr = [];




    var imagesContainer = document.querySelector('.media-container .images-container');




  





    function addFileCLick(event) {

        var urlValue = UrlELem.value;


        if (sessionStorage.getItem('Method') == 'addvariantImgClick') {
            // Get the unique ID generated for the clicked image from sessionStorage
            var clickedImageUniqueId = sessionStorage.getItem('clickedImageUniqueId');
            var clickedImageSrc = sessionStorage.getItem('clickedImageSrc');

            // Set the src attribute of the clicked image if it's not empty
            if (clickedImageUniqueId && clickedImageSrc) {
                // Select the clicked image using the unique ID
                var clickedImage = document.querySelector('[data-unique-id="' + clickedImageUniqueId + '"]');
                if (clickedImage) {
                    clickedImage.src = urlValue;
                }
            }

            // Clear sessionStorage
            sessionStorage.removeItem('clickedImageUniqueId');
            sessionStorage.removeItem('clickedImageSrc');






            sessionStorage.removeItem('Method');
            console.log('URL', urlValue);
            addFileXClick();







        }

        else {


            // Create a new img element
            var imgElement = document.createElement('img');
            // Set the src attribute
            imgElement.src = urlValue;

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
            UrlArr.push(urlValue);


            // Get the index of the newly added image
            var index = UrlArr.length - 1;

            addFileXClick();
            console.log('UrlArr:', UrlArr);
            // Attach event listener to the image element
            imgElement.addEventListener('click', function (event) {

                console.log('Image source:', event.target.src);
                console.log('Index: ', index);


                sessionStorage.setItem('ViewImageSrc', event.target.src);
                sessionStorage.setItem('ViewImageIndex', index);

                const viewImageElem = document.querySelector('.view-img-overlay');
                viewImageElem.classList.remove('hide');

                const mainImgElem = document.querySelector('.main-img .mainImg');
                mainImgElem.src = event.target.src;

            });





        }







    }




    function addFileXClick(event) {

        document.querySelector('.add-file-url-overlay').classList.add('hide');
        sessionStorage.removeItem('Method');

    }









}
else {
    console.log('Stand PRoud , Youre Strong ');
}





function showFileAdd(event) {

    document.querySelector('.add-file-url-overlay').classList.remove('hide');

}


function deleteRow(button) {
    var row = button.closest('tr');
    row.parentNode.removeChild(row);
}





/**
 * Saves product data entered by the user.
 * Validates the input fields and sends a POST request to add the product.
 */
function SaveData() {
    // Retrieve data from table rows
    var data = [];
    var rows = document.getElementById('tableBody').getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var cells = row.getElementsByTagName('td');
        var rowData = [];

        // Check if the row contains any data
        if (cells.length > 0) {
            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                var input = cell.querySelector('input'); // Select input elements
                var img = cell.querySelector('img'); // Select img elements

                if (input) {
                    rowData.push(input.value);
                } 
 
               

                if (img) {
                    rowData.push(img.src !== 'http://localhost/alp%20shop/client/default.png' ? img.src : null);
                }

            }
            data.push(rowData);
        }
    }

    // Output data to console
    console.log(data);

    // Prepare variations data
    var variations = data.map(row => ({
        varImg:row[0],
        color: row[1],
        size: row[2],
        price: row[3],
         stock: row[4],
    }));

    // Prepare request data object
    var requestData = {
        name: NameInput.value,
        description: description.value,
        category_fk: CategoryInp.value,
        img: UrlArr,
        variations: variations
    };

    // Output individual product data to console
    console.log("Name :", NameInput.value);
    console.log('category: ', CategoryInp.value);
    console.log('Price', parseInt(priceInp.value));
    console.log('DESC', description.value);

    // Validate input fields
    let addProduct = true;

    if (NameInput.value === null || NameInput.value === '') {
        // Name validation
        console.log("Name is required");
        addProduct = false;
        NameInput.parentElement.querySelector('.warning').classList.remove('hide');
        NameInput.classList.add('error');
    }
    else {
        NameInput.parentElement.querySelector('.warning').classList.add('hide');
        NameInput.classList.remove('error');
    }

    // Validate category selection
    if (CategoryInp.value == 0) {
        console.log('Category is required');
        addProduct = false;
        CategoryInp.parentElement.querySelector('.warning').classList.remove('hide')
        CategoryInp.classList.add('error');
    }
    else {
        CategoryInp.parentElement.querySelector('.warning').classList.add('hide');
        CategoryInp.classList.remove('error');
    }

    // Validate price input
    if (parseInt(priceInp.value) <= 0 || isNaN(parseInt(priceInp.value))) {
        console.log('Price is required and must be a valid number');
        addProduct = false;
        priceInp.parentElement.querySelector('.warning').classList.remove('hide');
        priceInp.classList.add('error');
    } else {
        priceInp.parentElement.querySelector('.warning').classList.add('hide');
        priceInp.classList.remove('error');
    }

    // Validate image URL array
    if (UrlArr.length === 0) {
        console.log('Array is empty');
        document.querySelector('.add-image .warning').classList.remove('hide');
        addProduct = false;
    } else {
        console.log('Array is not empty');
        console.log('UrlArr:', UrlArr);
        document.querySelector('.add-image .warning').classList.add('hide');
    }

    // If all validations pass, add the product
    if (addProduct) {
        console.log('Product can be added');

        // Make a POST request using Axios
        axios.post('./php/admin/add-item.php', requestData)
            .then(response => {
                console.log('Product successfully added:', response.data);
                const productId = response.data.product_id;
                sessionStorage.setItem('EditProduct-Id', productId);
                popupOverlay.classList.remove('hide');
                successPopup.classList.remove('hide');
                addedPopup.classList.remove('hide');
            })
            .catch(error => {
                console.error('Error adding product:', error);
            });
    } else {
        console.log('Product cannot be added');
    }
}




function addProductClick(event) {

}




function addvariantImgCLick(clickedImage) {
    // Generate a unique identifier for the clicked image
    var uniqueId = 'image_' + Date.now(); // You can use a more sophisticated method for generating unique IDs
    console.log(uniqueId); // Check if the ID is generated correctly

    // Set the unique ID and method in sessionStorage
    sessionStorage.setItem('clickedImageUniqueId', uniqueId);
    sessionStorage.setItem('Method', 'addvariantImgClick');

    // Set the unique ID to the clicked image
    clickedImage.setAttribute('data-unique-id', uniqueId);

    // Set the clicked image src in sessionStorage for later retrieval
    sessionStorage.setItem('clickedImageSrc', clickedImage.src);

    // Show whatever function you have to show file add
    showFileAdd();
}



































function deleteImageClick(event) {
    // Retrieve image source and index from sessionStorage
    var deleteImgSrc = sessionStorage.getItem('ViewImageSrc');
    var deleteIndexSrc = parseInt(sessionStorage.getItem('ViewImageIndex')); // Parse to integer

    // Remove image URL from UrlArr
    UrlArr.splice(deleteIndexSrc, 1);

    // Remove image from productDetails
    // productDetails.splice(deleteIndexSrc, 1);

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