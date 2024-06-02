

var categoryLabel = localStorage.getItem('categoryLabel');
var categoryElement = document.getElementById('Category-Holder');
if (categoryElement) {

    categoryElement.textContent = categoryLabel; // Replace 'New Category' with whatever text you want

    // Once you're done with it, you can clear it from sessionStorage if needed
    // localStorage.removeItem('categoryLabel');
} else {
    // console.log("WALA NA FINISH NA ");
}


if (categoryLabel) {
    // Do something with the categoryLabel
    console.log(categoryLabel);
    // Once you're done with it, you can clear it from sessionStorage if needed
    sessionStorage.removeItem('categoryLabel');

}
//  <h1 class="all-products-header" id="Category-Holder">Category</h1>


function visitFbclick() {
    window.location.href = 'https://www.facebook.com/profile.php?id=100063693235245';
}

// Function to handle clicks on product elements
function handleProductClick(event) {
    // Check if the clicked element or its parent has the class "product"

    const categoryElement = event.target.closest('.item-div');
    if (categoryElement) {
        const categoryLabel = categoryElement.querySelector('label').textContent;
        const categoryId = categoryElement.querySelector('label').getAttribute('category-id');

        localStorage.setItem('categoryLabel', categoryLabel);
        localStorage.setItem('categoryId', categoryId);
        window.location.href = 'category.php';
    }


}



function categLabelClick(categId) {

    var categoryLabel;

    console.log(categId);
    switch (categId) {
        case 0: categoryLabel = "New Arrivals";
            break;
        case 1: categoryLabel = "Shirts";
            break;
        case 3: categoryLabel = "Dresses";
            break;
        case 2: categoryLabel = "Pants & Trousers";
            break;
        case 4: categoryLabel = "Accesories";
            break;
        case 5: categoryLabel = "Others";
            break;
    }


    localStorage.setItem('categoryLabel', categoryLabel);
    localStorage.setItem('categoryId', categId);
    window.location.href = 'category.php';

}




// Add click event listener to the entire document
document.addEventListener("click", handleProductClick);


function categHover() {


    // Selecting the element by class name
    var dropDown = document.querySelector('.drop-down-categories');
    var overlay = document.querySelector('.categ-footer');


    if (dropDown) {
        // Toggling the "show" class
        dropDown.classList.toggle('show');
        overlay.classList.toggle('show');
    } else {
        console.error("Element with class 'drop-down-categories' not found.");
    }




}


function hideDropDown() {
    // Selecting the element by class name
    var dropDown = document.querySelector('.drop-down-categories');
    var overlay = document.querySelector('.categ-footer');
    if (dropDown) {
        // Removing the "show" class
        dropDown.classList.remove('show');
        overlay.classList.remove('show');
    } else {
        console.error("Element with class 'drop-down-categories' not found.");
    }
}
 
 



