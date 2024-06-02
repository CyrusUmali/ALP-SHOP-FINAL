 

 
axios.get('./php/featuredProd.php') 

  .then(response => {
    // Check if the request was successful
    if (response.data.success) {
      // Get the featured products array from the response
      const featuredProducts = response.data.featuredProducts;

      // Check if there are any featured products returned
      if (featuredProducts.length === 0) {
        // If there are no featured products, display a message or adjust the layout accordingly
        console.log("No featured products available.");
        return;
      }

      // Select the container where you want to insert the products
      const container = document.querySelector('.product-wrapper');

      // Map over each product and create HTML for it
      featuredProducts.forEach(product => {
        // Create HTML for each product
        const productHTML = `
          <div class="product" product-id="${product.product_id}">
            <img src="${product.img}" alt="${product.name}">
            <span class='black'>Quick View </span>
            <div>
               
              <p>${product.name}</p>
              <span> <i class="fas fa-peseta-sign"></i>  ${product.variation_price}</span>
            </div>
          </div>
        `;

        // Append the product HTML to the container
        container.innerHTML += productHTML;
      });



      // Add event listeners for hover effect on products
      const products = document.querySelectorAll('.featured-products-container .product');
      products.forEach(product => {
        product.addEventListener('mouseenter', () => {
          const quickView = product.querySelector('.black');
          quickView.classList.add('show');
        });

        product.addEventListener('mouseleave', () => {
          const quickView = product.querySelector('.black');
          quickView.classList.remove('show');
        });
      });





    const rightFeatButton = document.querySelector('.navigation .right'); 
    const leftFeatButton = document.querySelector('.navigation .left');


      let featureProdCurrentIndex = 0;

 

      const featuredProds = document.querySelectorAll('.product-wrapper .product');
      function rightClickFeat(event) {
       
        featureProdCurrentIndex = (featureProdCurrentIndex + 1) % featuredProds.length;
          const translateValue = -featureProdCurrentIndex * (featuredProds[0].offsetWidth + 30); // 10 is the margin-right
          document.querySelector('.product-wrapper').style.transform = `translateX(${translateValue}px)`;
          console.log("INdex: ",featureProdCurrentIndex);

          if (featureProdCurrentIndex >= 8) {
            rightFeatButton.classList.add('hide');
        }

        if (featureProdCurrentIndex >= 1) {
          leftFeatButton.classList.remove('hide');
      } 
      }

      function leftClickFeat(event) {
      
        featureProdCurrentIndex = (featureProdCurrentIndex - 1 + featuredProds.length) % featuredProds.length;
          const translateValue = -featureProdCurrentIndex * (featuredProds[0].offsetWidth + 30); // 10 is the margin-right
          document.querySelector('.product-wrapper').style.transform = `translateX(${translateValue}px)`;
          console.log("INdex: ",featureProdCurrentIndex);

          if (featureProdCurrentIndex == 0) {
            leftFeatButton.classList.add('hide');
        }

        if (featureProdCurrentIndex <= 8) {
          rightFeatButton.classList.remove('hide');
      }
      }


      
      // Attach click event listeners to handle navigation
      document.querySelector('.navigation .right').addEventListener('click', rightClickFeat);
      document.querySelector('.navigation .left').addEventListener('click', leftClickFeat);


    } else {
      // Handle error if the request was not successful aha
      console.error("Error retrieving data from the server:", response.data);
    }
  })
  .catch(error => {
    // Handle any errors that occurred during the request
    console.error("Error:", error);
  }); 


 