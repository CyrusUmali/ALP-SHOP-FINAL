var prodImgElem = document.getElementById('MR-Img');
var prodSizeElem = document.getElementById('MR-size');
var prodColorElem = document.getElementById('MR-color');
var prodNameElem = document.getElementById('MR-name');


var itemDetailsJSON = sessionStorage.getItem('itemToReview');

if (itemDetailsJSON !== null) {
    var itemDetails = JSON.parse(itemDetailsJSON);
    var prodImg = itemDetails.img;

    prodImgElem.src = prodImg;
    prodSizeElem.textContent =  itemDetails.size;
    prodColorElem.textContent =  itemDetails.color;
    prodNameElem.textContent =  itemDetails.name;

    console.log(prodImg);
} else {
    console.log('No item to review found in sessionStorage.');
}
