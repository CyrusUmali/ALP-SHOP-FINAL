<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.css"> -->


    <link rel="stylesheet" href="./alp.css">

    <style>
 

    </style>

</head>

<body>

    <div class="nav-container">

        <div class="menu-btn-container">
            <i onclick="menuClick()" class="fas fa-bars"></i>


        </div>

        <div class="shop-name-container">

            <a href="./index.php">
                <span>
                    <!-- <img src="./resources/alp-shop-logo.jpg" alt=""> -->
                    ALP SHOP</span></a>

        </div>

        <div class="nav-search">


            <div class="search-bar">

                <input type="text" id="prod-search-bar" title="search-bar" onclick="searchBarClick(event)"
                    oninput="prodSearchBarInput(event)" autocomplete="off">
                <i class="fas fa-search"></i>

            </div>

            <div class="search-results">

                <ul>

                </ul>

            </div>



        </div>


        <div class="actions-container">
            <i class="fas fa-search" id="mobile-search"></i>
            <a href="./user-page.php" class="user"> <i class="far fa-user-circle"></i></a>
            <a href="./cart.php" class="cart"> <i class="fas fa-cart-shopping"> </i></a>
            
            <a class="admin" onclick="chatClick(event)">
                 <i  class="fas fa-bell">
                <span class="message-notif"></span>
                    
                </i></a>

        </div>

    </div>

    <div class="sub-nav-container">

        <ul>
            <li  id="categoryNav" onmouseenter="categHover()" class="underline-hover-animation">

                Category
            </li>


            <li class="underline-hover-animation" onclick="categLabelClick(0)">
                New Arrivals
            </li>



            <li class="underline-hover-animation" onclick="categLabelClick(1)">
                Shirts
            </li>

            <li class="underline-hover-animation" onclick="categLabelClick(3)">
                Dresses
            </li>

            <li class="underline-hover-animation" onclick="categLabelClick(2)">
                Pants & Trousers
            </li>

            <li class="underline-hover-animation" onclick="categLabelClick(4)">
                Accesories
            </li>

            <li class="underline-hover-animation" onclick="categLabelClick(5)">
                Others
            </li>




        </ul>

        <div class="drop-down-categories" onmouseleave="hideDropDown()">

            <div class="categories-wrapper">



                <div class="item-div">

                    <img src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fHNoaXJ0fGVufDB8fDB8fHww"
                        alt="">
                    <label category-id=1>Shirts</label>

                </div>

                <div class="item-div">


                    <img src="https://images.unsplash.com/flagged/photo-1585052201332-b8c0ce30972f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8ZHJlc3N8ZW58MHx8MHx8fDA%3D"
                        alt="">
                    <label category-id=3> Dresses</label>
                </div>





                <div class="item-div">


                    <img src="https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dHJvdXNlcnxlbnwwfHwwfHx8MA%3D%3D"
                        alt="">
                    <label category-id=2> Pants and Trousers</label>
                </div>













                <div class="item-div">


                    <img src="https://images.unsplash.com/photo-1584184804426-5e2aa23c2937?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YWNjZXNvcmllc3xlbnwwfDF8MHx8fDA%3D"
                        alt="">
                    <label category-id="4"> Accessories</label>
                </div>

                <div class="item-div">


                    <img src="https://images.unsplash.com/photo-1537832816519-689ad163238b?q=80&w=2059&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                    <label category-id="5"> Others</label>
                </div>







            </div>

        </div>

        <div class="categ-footer">

        </div>

    </div>






</body>

</html>