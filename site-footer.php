<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

<style>

.visit-page-container{
    background-color: black;
    /* width: 900px; */
    width: 60%;
    border-radius: 15px;
    color: white;
    padding: 15px 30px;
    position: relative;
    display: flex;
    align-items: center;
    flex-direction: row;
    justify-content: space-between; 
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 24px -1px, 
    rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    margin-top: 50px;
    
 
  
}
.visit-page-container span{
    font-size: 30px;
    width: 40%;
    font-weight: 600;
}

.visit-page-container button{
 all: unset;
    border-radius: 18px;
    background-color: white;
    border: 1px solid black;
    color: black;
    height: 40px;
    padding: 0px 12px;
    font-size: 12px;
 cursor: pointer;
 
}

.visit-page-container button:hover{
 
    background-color: whitesmoke

   }

.visit-page-container img{
 
    position: relative;
    height: 120px;
    width: 120px; 

    /* height: 100%;
    width: 100%;  */
    /* left: 10%; */
    object-fit: contain;
}

 
</style>

</head>

<body class="main-container">




    <div class="content-container">


    <div class="visit-page-container">

<span>
    STAY UPTO DATE ABOUT OUR LATEST OFFERS
</span>

<img src="./resources/alp-shop-logo.jpg" alt="">

<button onclick="visitFbclick(event)">
  <a href="https://www.facebook.com/profile.php?id=100063693235245"></a>  Visit Our Facebook Page
</button>

</div>

        <div class="site-footer">

            <div class="site-links">

                <div>
                    <span class="toggle-subnav" onclick="toggleSubNav(this)">
                        <b>Account</b> <i class="fas fa-angle-down"></i>
                    </span>



                    <ul class="sub-nav">
                        <li><a href="./login.php"> My Account </a> </li>
                        <li><a href="./user-page.php">Login / Sign up </a> </li>
                        <li><a href="./cart.php">Cart </a> </li>
                        <li><a href="./login.php">Wishlist </a> </li>
                        

                    </ul>
                </div>

                <div>
                    <span class="toggle-subnav" onclick="toggleSubNav(this)">
                        <b>Company</b> <i class="fas fa-angle-down"></i>
                    </span>


                    <ul class="sub-nav">
                        <li> <a href="./about-us .php">About Us</a></li>
                        <!-- <li><a href=""> Store List</a> </li> -->
                        <li> <a href="./Privacy-Policy.php">Privacy Policy</a></li>
                        <li><a href="./ToS.php"> Terms of Service</a> </li>
                        <li> <a href="./Faq.php">FAQs</a></li>
                    </ul>
                </div>


                <div>
                    <span class="toggle-subnav" onclick="toggleSubNav(this)">
                        <b>Connect </b> <i class="fas fa-angle-down"></i>
                    </span>


                    <ul class="sub-nav">
                        <li> <a href="./contact-Us.php">Contact Us</a></li>
                        <li> 038A Purok 1 Brgy San </li>
                        <li> Agustin alaminos Laguna,</li>
                        <li> Philippines </li>
                    </ul>
                </div>


                <!-- <div>
                    <span class="toggle-subnav" onclick="toggleSubNav(this)">
                        <b>Get Help</b><i class="fas fa-angle-down"></i>
                    </span> -->


                    <!-- <ul class="sub-nav"> -->
                        <!-- <li> <a href="./Faq.html">FAQs</a></li> -->
                        <!-- <li><a href=""> Size Guide</a> </li>
                        <li> <a href="">Returns & Exchanges </a></li> -->
                        <!-- <li><a href=""> Payment Modes </a> </li> -->
                    <!-- </ul> -->
                <!-- </div> -->

           


            </div>

            <!-- <div class="social-media-links">

                <ul>
                    <li> <i class="fab fa-facebook" id="fbIcon"><a href=""></a></i> </li>
                    <li> <i class="fab fa-instagram" id="igIcon"><a href=""></a></i> </li>
                    <li> <i class="fab fa-youtube" id="ytIcon"><a href=""></a></i> </li>
                    <li> <i class="fab fa-twitter" id="twittIcon"><a href=""></a></i> </li>
                    <li> <i class="fab fa-tiktok" id="tiktokIcon"><a href=""></a></i> </li>
                </ul>

            </div>   -->


        


    

        </div>

    </div>


</body>

</html>