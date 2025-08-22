$(document).ready(function () {
    loadCustomers();

    var currentConversationId =
        $("#messageContainer").data("conversation-id") ?? null;
    var messageRefreshInterval = 10000; // 10 seconds

    $(document).on("click", ".chat-list li", function () {
        var conversationId = $(this).data("conversation-id");
        var customerName = $(this).find(".customer-name").text();

        $(".chat-list li").removeClass("selected");
        $(this).addClass("selected");
        $(".input-container").removeClass("d-none");

        console.log(customerName);

        loadChatMessages(conversationId, customerName);
        currentConversationId = conversationId;
    });

    $("#searchCustomerName").on("keyup", function () {
        var searchTerm = $(this).val().toLowerCase();
        var chatListItems = $(".chat-list li");
        var found = false;

        chatListItems.each(function () {
            var customerName = $(this)
                .find(".customer-name")
                .text()
                .toLowerCase();
            var matches = customerName.includes(searchTerm);

            $(this).toggle(matches);

            if (matches) {
                found = true;
            }
        });

        if (!found) {
            $(".chat-list ul").append(
                '<li class="no-results text-center fw-semibold text-danger">No results found</li>'
            );
        } else {
            $(".chat-list .no-results").remove();
        }
    });

    replyToCustomer();

    setInterval(function () {
        if (currentConversationId) {
            loadChatMessages(currentConversationId, customerName);
        }
    }, messageRefreshInterval);
});

function loadCustomers() {
    $.ajax({
        url: "../actions/fetch-assigned-customers.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var chatList = $(".chat-list ul");
                chatList.empty();

                response.conversations.forEach(function (conversation) {
                    var formattedTime = formatTimeAgo(conversation.sent_at);
                    var listItem = `
                        <li data-conversation-id="${
                            conversation.conversation_id
                        }">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="customer-name">${
                                    conversation.user_name
                                }</h5>
                                <span class="time-ago">${formattedTime}</span>
                            </div>
                            <!-- <small class="customer-recent-message">${
                                conversation.message_body ||
                                "No recent messages"
                            }</small> -->
                        </li>
                    `;
                    chatList.append(listItem);
                });
            } else {
                console.log(response.message);
            }
        },
        error: function () {
            console.log("Failed to load customers.");
        },
    });
}

function loadChatMessages(conversationId, customerName) {
    $.ajax({
        url: "../actions/fetch-chat-messages.php",
        type: "GET",
        data: { conversation_id: conversationId },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var messageContainer = $("#messageContainer");
                messageContainer.empty();

                response.messages.forEach(function (message) {
                    $(".chat-header h3")
                        .text(customerName)
                        .addClass("animation-downwards");

                    $(".message-container").attr(
                        "data-conversation-id",
                        message.conversation_id
                    );

                    var messageClass =
                        message.user_type === "user" ? "left" : "right";
                    var iconClass =
                        message.user_type === "user"
                            ? "fa-solid fa-user me-2"
                            : "fa-solid fa-user-md ms-2";

                    var messageItem = `
                        <div class="chat ${messageClass}">
                            <i class="${iconClass} fw-semibold" style="color: var(--theme-color3);"></i>
                            <div class="message">
                                <p>${message.message_body}</p>
                                <p class="mt-3" style="font-size: 13px;">${new Date(
                                    message.sent_at
                                ).toLocaleString()}</p>
                            </div>
                        </div>
                    `;
                    messageContainer.prepend(messageItem);
                });

                messageContainer.scrollTop(messageContainer[0].scrollHeight);
            } else {
                console.log(response.message);
            }
        },
        error: function () {
            console.log("Failed to load chat messages.");
        },
    });
}

function replyToCustomer() {
    $(document).on("submit", ".input-container form", function (event) {
        event.preventDefault();
        var messageContent = $("#inputChat").val().trim();
        var conversationId = $(".chat-list li.selected").data(
            "conversation-id"
        );

        if (messageContent && conversationId) {
            $.ajax({
                url: "../actions/reply-to-customer.php",
                type: "POST",
                data: {
                    conversation_id: conversationId,
                    message: messageContent,
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        var messageItem = `
                            <div class="chat right animation-right">
                                <i class="fa-solid fa-user-md ms-2 fw-semibold" style="color: var(--theme-color3);"></i>
                                <div class="message">
                                    <p>${messageContent}</p>
                                    <p class="mt-3" style="font-size: 13px;">${new Date().toLocaleString()}</p>
                                </div>
                            </div>
                        `;
                        var messageContainer = $("#messageContainer");
                        messageContainer.prepend(messageItem);
                        $("#inputChat").val("");
                        messageContainer.scrollTop(
                            messageContainer[0].scrollHeight
                        );
                    } else {
                        console.log(response.message);
                    }
                },
                error: function () {
                    console.log("Failed to send message.");
                },
            });
        } else {
            console.log("Message content is missing.");
        }
    });
}

function formatTimeAgo(dateString) {
    var now = new Date();
    var time = new Date(dateString);
    var diffInSeconds = Math.floor((now - time) / 1000);

    var intervals = {
        year: 31536000, // 60 * 60 * 24 * 365
        month: 2592000, // 60 * 60 * 24 * 30
        day: 86400, // 60 * 60 * 24
        hour: 3600, // 60 * 60
        minute: 60,
        second: 1,
    };

    for (var [key, value] of Object.entries(intervals)) {
        var interval = Math.floor(diffInSeconds / value);
        if (interval >= 1) {
            return interval + " " + key + (interval > 1 ? "s" : "") + " ago";
        }
    }

    return "just now";
}
