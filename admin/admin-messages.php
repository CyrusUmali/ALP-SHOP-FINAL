<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            text-align: center;
            margin-left: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <div class="section">

        <h2>Messages</h2>

        <div class="body">

            <div class="messages-control-container">

                <div class="search">
                    <input type="text" title="manageSearchBar" placeholder="Search">
                </div>

            </div>

            <div class="messages-body">

                <!-- Messages will be dynamically added here -->

            </div>

        </div>

    </div>

    <script>
        axios.get('./php/admin/messages.php')
            .then(response => {
                if (response.data.success) {
                    const AllMessages = response.data.AllMessages;

                    // Select the container where you want to insert the messages
                    const container = document.querySelector('.messages-body');

                    // Clear the container before adding new messages
                    container.innerHTML = '';

                    // Sort the messages in descending order based on the date
                    AllMessages.sort((a, b) => new Date(b.date) - new Date(a.date));

                    // Map over each message and create HTML for it
                    AllMessages.forEach(message => {
                        // Create HTML for each message
                        const messagesHTML = `
                            <div class="item">
                                <div class="img-container">
                                    <img src="https://th.bing.com/th/id/OIP.kBMlU7_tH57yegecCAcmkAHaHI?w=161&h=180&c=7&r=0&o=5&dpr=1.9&pid=1.7" alt="">
                                </div>
                                <div class="main-content">
                                    <b>${message.name}</b>
                                    <div class="message-content">
                                        ${message.message}
                                    </div>
                                </div>
                                <div class="message-date-container">
                                    <span class="date">${message.date}</span>
                                    <button class="delete-btn" data-message-id="${message.message_id}">Delete</button>
                                </div>
                            </div>
                        `;

                        // Append the message HTML to the container
                        container.innerHTML += messagesHTML;
                    });

                    // Add event listener for delete buttons
                    const deleteBtns = document.querySelectorAll('.delete-btn');
                    deleteBtns.forEach(btn => {
                        btn.addEventListener('click', deleteMessage);
                    });
                } else {
                    console.error("Error retrieving data from the server:", response.data);
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });

        function deleteMessage(event) {
            const messageId = event.target.dataset.messageId;
            const confirmDelete = confirm(`Are you sure you want to delete this message?`);

            if (confirmDelete) {
                axios.post('./php/admin/delete_message.php', { message_id: messageId })
                    .then(response => {
                        if (response.data.success) {
                            alert('Message deleted successfully!');
                            // Optionally, you can remove the deleted message from the UI
                            event.target.closest('.item').remove();
                        } else {
                            alert('Error deleting message. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert('Error deleting message. Please try again.');
                    });
            }
        }
    </script>

</body>

</html>