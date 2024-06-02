



function chatClick(event) {

    console.log('chatclick');

    const chatContainerElem = document.querySelector('.user-chat-container');
    chatContainerElem.classList.toggle('hide');





    axios.post('./php/user/check-auth.php', {
        // Your data to be sent in the request body
    })
        .then(response => {
            // Check if the customer ID is not set
            if (response.data.noId) {
                console.log("Customer ID not set:", response.data.message);
                // Handle the case where customer ID is not set
            } else {
                // Handle other cases or success response
                console.log("Request successful:", response.data);

                const chatboxauthState = document.querySelector('.user-chat-container .chatbox-body');
                chatboxauthState.classList.remove('hide');

                const chatboxauthState2 = document.querySelector('.user-chat-container .footer');
                chatboxauthState2.classList.remove('hide');

                const chatboxFAuth = document.querySelector('.user-chat-container .chatbox-body-noAuth');
                chatboxFAuth.classList.add('hide');





                retrieveMessages();



            }
        })
        .catch(error => {
            // Handle error
            console.error("Error:", error);
        });

}





// message-notif




function retrievmessageNotif(event) {
    console.log('img click');




    axios.post('./php/user/count-unread.php')
        .then(function (response) {
            // Handle success
            console.log('response', response.data);

            console.log('unread: ' + response.data.unreadCount);


            const messageNotif = document.querySelector('.message-notif');

            messageNotif.innerHTML = response.data.unreadCount;

        })
        .catch(function (error) {
            // Handle error
            console.error(error);
        });




}

function userChatSignInClick(event) {
    console.log('userChatSignInClick');

    window.location.href = 'login.php';
}

function scrolltoBottom() {

    var chatbody = document.querySelector('.chatbox-body ');
    chatbody.scrollTop = chatbody.scrollHeight - chatbody.clientHeight;

}


function chatExpandClick() {

    const chatExpandElem = document.getElementById('chatExpand');
    chatExpandElem.classList.toggle('active');

    const chatCont = document.querySelector('.user-chat-container');
    chatCont.classList.toggle('min');

}



// Function to retrieve messages for a specific customer
function retrieveMessages() {






    axios.post('./php/user/user-retrieve-messages.php', {

    })
        .then(function (response) {
            // Handle success
            console.log(response.data);

            // Clear previous messages
            const chatboxBody = document.querySelector('.chatbox-body ul');
            chatboxBody.innerHTML = '';

            // Render retrieved messages
            const messages = response.data.messages;
            messages.forEach(message => {
                const messageClass = message.sentByAdmin === 1 ? 'message-row-user' : 'message-row-admin';
                const messageItem = `
                <li class="${messageClass}">
                    <span>${message.timestamp}</span>
                    <div class="message-text">
                        ${message.message}
                    </div>
                    <div></div>
                </li>`;
                chatboxBody.innerHTML += messageItem;
            });



            scrolltoBottom();
        })
        .catch(function (error) {
            // Handle error
            console.error(error);
        });


}




function submitMessage(event) {

    const messageInpElem = document.getElementById('messageInput');

    if (event.key === 'Enter') {

        event.preventDefault();

        if (messageInpElem.value !== null) {
            console.log(messageInpElem.value);



            axios.post('./php/user/user-send-message.php', {

                message: messageInpElem.value,
                sentByAdmin: 0

            })
                .then(res => {
                    console.log("respnse:", res.data)


                    // Get the chatbox body element
                    const chatboxBody = document.querySelector('.chatbox-body ul');

                    // Get the newly added message from the response
                    const newMessage = res.data.message;


                    // Create HTML for the new message
                    const messageItem = `
                    <li class="message-row-admin">
                        <span>${newMessage.timestamp}</span>
                        <div class="message-text">
                            ${newMessage.message}
                        </div>
                        <div></div>
                    </li>`;

                    // Append the new message to the chatbox body
                    chatboxBody.innerHTML += messageItem;

                    scrolltoBottom();






                    messageInpElem.value = '';
                })
                .catch(err => {
                    console.error(err);
                })



        }




    }


}