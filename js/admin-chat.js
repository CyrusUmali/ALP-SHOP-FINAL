// Select the elements
// var searchIcon = document.querySelector("i.fas.fa-magnifying-glass:first-child"); 




document.addEventListener('click', function (event) {
    var searchInput = document.getElementById("searchInput");
    var backIcon = document.querySelector(".contacts-list-container .header .row  i");
    // Check if the clicked element is not the search bar
    if (event.target !== searchInput) {
        // Remove the "active" class from elements

        // const searchResElem = document.querySelector('.search-results');


        // searchResElem.classList.remove('active')

        backIcon.classList.add('hide');
        const contactListElem = document.querySelector('.contact-list-wrapper .home');
        contactListElem.classList.remove('hide');
    }
});

function doneTyping() {
    const input = document.getElementById('searchInput').value; // Trim whitespace from the input

    // Clear search results if input is empty
    if (input === '') {
        clearSearchResults();
        console.log('testtest');
        return;
    }



    axios.post('./php/admin/customer-search.php', {
        name_search: input,
    })
        .then(function (response) {
            // Handle success
            console.log(response.data);

            // Clear previous search results
            const searchResultsElement = document.querySelector('.contact-list-wrapper .search');
            searchResultsElement.innerHTML = '';

            // Render retrieved data
            const customers = response.data.AllCustomer;



            customers.forEach(customer => {
                const listItem = `
                <li class="contact" onClick="contactClick(${customer.customer_id}, 
                    '${customer.img}', '${customer.first_name}', '${customer.last_name}')">
        
               
                    <img src="${customer.img}" alt="" class="customer-profile">
                    <div class="contact-preview-container">
                        <b class="contact-name">${customer.first_name} ${customer.last_name}</b>
                        <span class="message-prev">
                        
                        Lorem ipsum dolor sit amet consectetur ad
                        </span>
                    </div>
                    <div class="other-details">
                        <span class="time">5mins Ago</span>
                        <i class="fas fa-check"></i>
                    </div>
                </li>`;
                searchResultsElement.innerHTML += listItem;
            });
        })
        .catch(function (error) {
            // Handle error
            console.error(error);
        });

}

function customerSearchClick(event) {
    var backIcon = document.querySelector(".contacts-list-container .header .row  i");
    backIcon.classList.remove('hide');

    const contactListElem = document.querySelector('.contact-list-wrapper .home');
    const searchContactListElem = document.querySelector('.contact-list-wrapper .search');

    contactListElem.classList.add('hide');
    searchContactListElem.classList.remove('hide');

    console.log('searchclick');



}


getCustomersWithChat();

function getCustomersWithChat(event) {



    // Make a POST request to your PHP script
    axios.post('./php/admin/customers-withChat.php')
        .then(response => {
            // Handle successful response
            console.log('Response:', response.data);





            // Clear previous search results
            const cotanctslistElement = document.querySelector('.contact-list-wrapper .home');
            cotanctslistElement.innerHTML = '';

            // Render retrieved data
            const customers = response.data.AllCustomer;



            retrieveMessages(
                customers[0].customer_id,
                customers[0].img,
                customers[0].first_name,
                customers[0].last_name

            );

            sessionStorage.setItem('customerToMessageID',  customers[0].customer_id);





            customers.forEach(customer => {
                const listItem = `
     <li class="contact" onClick="contactClick(${customer.customer_id}, 
         '${customer.img}', '${customer.first_name}', '${customer.last_name}')">

    
         <img src="${customer.img}" alt="" class="customer-profile">
         <div class="contact-preview-container">
             <b class="contact-name">${customer.first_name} ${customer.last_name}</b>
            
         </div>
         <div class="other-details"> 
             <i class="fas fa-check"></i>
         </div>
     </li>`;
                cotanctslistElement.innerHTML += listItem;
            });






        })
        .catch(error => {
            // Handle error
            console.error('Error:', error);
            // Handle the error, such as displaying an error message to the user
        });



}

function scrolltoBottom() {

    var chatbody = document.querySelector('.chatbox-body ');
    chatbody.scrollTop = chatbody.scrollHeight - chatbody.clientHeight;

}



function submitMessage(event) {

    const messageInpElem = document.getElementById('messageInput');

    if (event.key === 'Enter') {

        event.preventDefault();

        if (messageInpElem.value !== null) {
            console.log(messageInpElem.value);

            const customerId = sessionStorage.getItem('customerToMessageID');

            axios.post('./php/admin/admin-send-message.php', {

                customer_id_fk: customerId,
                message: messageInpElem.value,
                sentByAdmin: 1

            })
                .then(res => {
                    console.log("respnse:",res.data)


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




 


// Function to handle input event
function customerSearchBarInput(event) {
    let typingTimer;

    const doneTypingInterval = 500; // Adjust this value to set the delay

    const input = event.target;
    clearTimeout(typingTimer);
    if (input.value) {
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    } else {
        // If input is empty, clear search results immediately
        clearSearchResults();
    }
}

// Function to clear search results
function clearSearchResults() {
    const searchResultsElement = document.querySelector('.contact-list-wrapper .search');
    searchResultsElement.innerHTML = '';
}

 



// Function to be executed after typing has stopped




 
 

// Function to retrieve messages for a specific customer
function retrieveMessages(customerId, img, FN, LN) {


    const custImageEleme = document.querySelector('.custumer-img');
    custImageEleme.src = img;
    const custNameElem = document.getElementById('customerName');
    custNameElem.textContent = FN + ' ' + LN;



    axios.post('./php/admin/retrieve_messages.php', {
        customer_id: customerId,
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
                const messageClass = message.sentByAdmin === 1 ? 'message-row-admin' : 'message-row-user';
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

// Function to check for changes in the database and retrieve messages in real-time
function checkForChanges(customerId) {
    // Implement the logic to check for changes in the database and retrieve new messages
    // For example, you can use WebSockets or polling techniques
    // Here, I'm assuming you have a function named "checkForChangesInDatabase" that takes the customer ID as an argument and returns the new messages.
    setInterval(() => {
        const newMessages = checkForChangesInDatabase(customerId);
        if (newMessages.length > 0) {
            // Append new messages to the chatbox
            const chatboxBody = document.querySelector('.chatbox-body ul');
            newMessages.forEach(message => {
                const messageItem = `
                    <li class="message-row-${message.sender_type}">
                        <span>${message.timestamp}</span>
                        <div class="message-text">
                            ${message.content}
                        </div>
                        <div></div>
                    </li>`;
                chatboxBody.innerHTML += messageItem;
            });
        }
    }, 2000); // Check for changes every 5 seconds (adjust as needed)
}

// Function to handle clicking on a contact
function contactClick(id, img, FN, LN) {
    console.log("Customer ID:", id);


    sessionStorage.setItem('customerToMessageID', id);



    // Retrieve messages for the clicked customer
    retrieveMessages(id, img, FN, LN);
    // Start checking for changes in the database for real-time updates
    // checkForChanges(id);
}
