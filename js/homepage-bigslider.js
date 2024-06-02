


const bigSlider = document.querySelector('.big-slider');
let sliderCurrentIndex = 0;

const images = [    
    "./resources/Front-Page-1.jpg",
    "./resources/Front-Page-2.jpg",
    "./resources/Front-Page-3.jpg"

    // Add more image URLs as needed
];


 

function changeBackgroundImage() { 
    setTimeout(() => {
        bigSlider.style.backgroundImage = `url('${images[sliderCurrentIndex]}')`;
        bigSlider.style.opacity = '1'; // Fade in
    }, 500); // Wait for 500ms before changing the image (adjust as needed)
}




function nextImage() {
    sliderCurrentIndex = (sliderCurrentIndex + 1) % images.length;
    changeBackgroundImage();
    // console.log("Next button clicked");
}

function prevImage() {
    sliderCurrentIndex = (sliderCurrentIndex - 1 + images.length) % images.length;
    changeBackgroundImage();
    // console.log("Previous button clicked");
}



 
setInterval(function () {
    nextImage();
    // console.log("Interval changed background image");
}, 5000); // Change every 5 seconds
