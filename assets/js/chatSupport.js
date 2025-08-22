$(document).ready(function () {
    var chatBox = $("#chatBox");
    var chatSupportButton = $("#chatSupport");
    var closeChatBox = $("#closeChatBox");
    var inputChat = $("#inputChat");

    chatSupportButton.on("click", function () {
        chatSupportButton.hide();
        chatBox.fadeIn(300).addClass("slide-in");
    });

    closeChatBox.on("click", function () {
        chatBox
            .fadeOut(300, function () {
                chatSupportButton.show();
            })
            .removeClass("slide-in");
    });

    inputChat.on("keypress", function (e) {
        if (e.which === 13) {
            // Enter key pressed
            var messageContent = inputChat.val();
            if (messageContent.trim() !== "") {
                sendMessage(messageContent);
                inputChat.val("");
            }
        }
    });

    fetchFAQs();
    displayConversation();
});

function fetchFAQs() {
    var faqSelect = $("#faqSelect");
    var chatContainer = $("#chatContainer");

    $.ajax({
        url: "../actions/fetch-faqs.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.status === "success") {
                data.faqs.forEach(function (faq, index) {
                    var option = `
                        <option value="${index}">${faq.question}</option>
                    `;
                    faqSelect.append(option);
                });
            } else {
                console.error("Error:", data.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching FAQs:", error);
        },
    });

    faqSelect.on("change", function () {
        var index = $(this).val();
        if (index !== "") {
            $.ajax({
                url: "../actions/fetch-faqs.php",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.status === "success") {
                        var answer = data.faqs[index].answer;
                        chatContainer.prepend(`
                            <div class="chat left animation-left">
                                <i class="fa-solid fa-user-tie fw-semibold me-2" style="color: var(--theme-color3);"></i>
                                <div class="message">
                                    <p>${answer}</p>
                                </div>
                            </div>
                        `);
                        chatContainer.scrollTop(
                            chatContainer.prop("scrollHeight")
                        );
                    } else {
                        console.error("Error:", data.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching FAQs:", error);
                },
            });
        }
    });
}

function sendMessage(messageContent) {
    var chatContainer = $("#chatContainer");

    $.ajax({
        url: "../actions/send-message.php",
        type: "POST",
        dataType: "json",
        data: {
            message: messageContent,
        },
        success: function (response) {
            if (response.status === "success") {
                var messageClass =
                    response.user_type === "user"
                        ? "right animation-right"
                        : "left animation-left";
                var iconClass =
                    response.user_type === "admin"
                        ? "fa-solid fa-user-tie"
                        : response.user_type === "staff"
                        ? "fa-solid fa-user-md me-2"
                        : "fa-solid fa-user ms-2";

                // Display the user's sent message
                chatContainer.prepend(`
                    <div class="chat ${messageClass}">
                        <i class="${iconClass}" style="color: var(--theme-color3);"></i>
                        <div class="message">
                            <p>${response.message_body}</p>
                        </div>
                        <small class="me-2">${new Date().toLocaleString()}</small>
                    </div>
                `);

                // Check if the response message is already displayed
                if ($("#responseMessage").length === 0) {
                    var responseMessage = response.assignedStaff
                        ? "Your message has been received and is being handled. Please wait for a moment."
                        : "Your message has been received. Please wait while we assign a staff member.";

                    // Display the server's response message
                    chatContainer.prepend(`
                        <div id="responseMessage" class="chat left animation-left">
                            <i class="fa-solid fa-user-tie me-2" style="color: var(--theme-color3);"></i>
                            <div class="message">
                                <p>${responseMessage}</p>
                            </div>
                        </div>
                    `);
                }

                // Scroll to the bottom of the chat container
                chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
            } else {
                console.error("Error:", response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error sending message:", error);
        },
    });
}

function displayConversation() {
    var chatContainer = $("#chatContainer");

    $.ajax({
        url: "../actions/fetch-conversation.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.status === "success") {
                var conversations = data.conversations;

                conversations.forEach(function (item) {
                    var messageClass =
                        item.user_type === "user"
                            ? "right animation-right"
                            : "left animation-left";
                    var iconClass =
                        item.user_type === "admin"
                            ? "fa-solid fa-user-tie"
                            : item.user_type === "staff"
                            ? "fa-solid fa-user-md me-2"
                            : "fa-solid fa-user ms-2";

                    var sentAt = "";

                    if (item.user_type == "user") {
                        sentAt = `<small class="me-2">
                            ${new Date(item.sent_at).toLocaleString()}
                        </small>`;
                    }

                    chatContainer.prepend(`
                        <div class="chat ${messageClass}">
                            <i class="${iconClass} fw-semibold" style="color: var(--theme-color3);"></i>
                            <div class="message">
                                <p>${item.message_body}</p>
                            </div>
                            ${sentAt}
                        </div>
                    `);
                });

                chatContainer.scrollTop(chatContainer.prop("scrollHeight")); // Scroll to bottom
            } else {
                console.error("Error:", data.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching conversation:", error);
        },
    });
}
