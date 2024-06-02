<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./resources/css/admin-chat.css">

</head>

<body>


    <div class="chat-container">


        <div class="chatbox">

            <div class="header">

                <img src="" class="custumer-img" alt="">
                <span id='customerName'>Cyrus U Carbungco</span>

            </div>

            <div class="chatbox-body">


                <ul>

                    <li class="message-row-admin">

                        <span>12:30Pm Monday</span>

                        <div class="message-text">
                            Lorem ipsum d t. Vero, quasi! Dolor placeat modi sequi vel perferendis. Dicta illo qui consec rnatur.

                        </div>

                        <div></div>

                    </li>

                    <li class="message-row-user">

                        <span>12:30Pm Monday</span>

                        <div class="message-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, quasi! Dolor placeat modi sequi vel perferendis. Dicta illo qui consectetur aut dolor commodi. Molestiae cumque rem facere distinctio numquam aspernatur.

                        </div>

                        <div></div>

                    </li>

                    <li class="message-row-admin">

                        <span>12:30Pm Monday</span>

                        <div class="message-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, quasi! Dolor placeat modi sequi vel perferendis. Dicta illo qui consectetur aut dolor commodi. Molestiae cumque rem facere distinctio numquam aspernatur.

                        </div>

                        <div></div>

                    </li>

                    <li class="message-row-user">

                        <span>12:30Pm Monday</span>

                        <div class="message-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, quasi! Dolor placeat modi sequi vel perferendis. Dicta illo qui consectetur aut dolor commodi. Molestiae cumque rem facere distinctio numquam aspernatur.

                        </div>

                        <div></div>

                    </li>

                    <li class="message-row-admin">

                        <span>12:30Pm Monday</span>

                        <div class="message-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, quasi! Dolor placeat modi sequi vel perferendis. Dicta illo qui consectetur aut dolor commodi. Molestiae cumque rem facere distinctio numquam aspernatur.

                        </div>

                        <div></div>

                    </li>

                    <li class="message-row-user">

                        <span>12:30Pm Monday</span>

                        <div class="message-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, quasi! Dolor placeat modi sequi vel perferendis. Dicta illo qui consectetur aut dolor commodi. Molestiae cumque rem facere distinctio numquam aspernatur.

                        </div>

                        <div></div>

                    </li>

                </ul>


            </div>

            <div class="footer">

                <input type="text" name="" id="messageInput"
                 maxlength="495" placeholder="Type Your Message Here"
                 onkeypress="submitMessage(event)"
                 >



            </div>


        </div>


        <div class="contacts-list-container">

            <div class="header">

                <div class="row">
                    <h3>Chat</h3> <i id="backSearch" class="fas fa-arrow-left hide"></i>
                </div>


                <div class="search-input-wrapper">

                    <i class="fas fa-magnifying-glass"></i>
                    <input type="text" name="" id="searchInput" oninput=(customerSearchBarInput(event)) onclick="customerSearchClick(event)" placeholder="Search Customer">

                </div>


            </div>

            <div class="contact-list-wrapper">

                <ul class="home">


                    <!-- <li class="contact">

                        <img src="" alt="" class="customer-profile">
                        <div class="contact-preview-container">
                            <b class="contact-name">CYRUS U UMALI</b>
                            <span class="message-prev">ahaha kaa pla</span>

                        </div>

                        <div class="other-details">

                            <span class="time">5mins Ago</span>
                            <i class="fas fa-check"></i>

                        </div>

                    </li>

                    <li class="contact">

                        <img src="" alt="" class="customer-profile">
                        <div class="contact-preview-container">
                            <b class="contact-name">CYRUS U UMALI</b>
                            <span class="message-prev">ahaha kaa pla</span>

                        </div>

                        <div class="other-details">

                            <span class="time">5mins Ago</span>
                            <i class="fas fa-check"></i>

                        </div>

                    </li> -->

                 
 

                </ul>

                <ul class="search hide">


                    <!-- <li class="contact">

                        <img src="" alt="" class="customer-profile">
                        <div class="contact-preview-container">
                            <b class="contact-name">CYRUS U UMALI</b>
                            <span class="message-prev">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt architecto accusamus animi excepturi vitae quae at, minima quos. Quo quasi modi autem quod nemo dolor doloribus necessitatibus ullam cum?</span>

                        </div>

                        <div class="other-details">

                            <span class="time">5mins Ago</span>
                            <i class="fas fa-check"></i>

                        </div>

                    </li> -->

                


                </ul>

            </div>

        </div>




    </div>






    <script src="./js/admin-chat.js">

    </script>


</body>

</html>