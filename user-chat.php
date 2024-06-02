<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="user-chat-container hide ">


        <div class="header">

            <img  onclick="testClick(event)" src="./resources/alp-shop-logo.jpg" class="custumer-img" alt="">
            <span id='customerName'>ALP SHOP</span>

            <i class="fas fa-angle-down" id="chatExpand"  onclick="chatExpandClick(event)" ></i>



        </div>

        <div class="chatbox-body hide">

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
            </ul>

        </div>

        <div class="chatbox-body-noAuth  ">

          
        
 
            <button class="userChatSignIn" onclick="userChatSignInClick(event)">
                Login / Signup</button>

        </div>

        <div class="footer hide">

            <input type="text" name="" id="messageInput"
             maxlength="495" placeholder="Type Your Message Here" onkeypress="submitMessage(event)">

        </div>


    </div>


</body>

</html>