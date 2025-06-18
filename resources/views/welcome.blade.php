<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laravel Pusher + Toastr + Sound Demo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- Pusher JS -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-4">Laravel Pusher + Toastr + Notification Sound Demo</h1>

        <form id="messageForm" class="mb-3">
            <div class="input-group">
                <input type="text" name="message" id="messageInput" class="form-control"
                    placeholder="Type your message" required />
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>

        <h4>Messages:</h4>
        <ul id="messages" class="list-group"></ul>
    </div>

    <!-- jQuery (required by Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Setup CSRF token for AJAX
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Enable Pusher logging - remove in production
        Pusher.logToConsole = true;

        // Initialize Pusher
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true
        });

        // Subscribe to channel
        const channel = pusher.subscribe('chat');

        // Toastr options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "4000"
        };

        // Load notification sound
        const notificationSound = new Audio('/sounds/notify.wav');

        // Listen for message.sent event
        channel.bind('message.sent', function(data) {
            toastr.success(data.message, 'New Message');

            // Play notification sound
            notificationSound.play().catch(e => {
                // Handle any errors silently (e.g. user hasn't interacted with page)
                console.warn('Notification sound play prevented:', e);
            });

            // Append to message list
            const messagesList = $('#messages');
            if (messagesList) {
                const newMessage = $('<li>');
                newMessage.addClass('list-group-item');
                newMessage.text(data.message);
                messagesList.append(newMessage);
            }
        });

        // Handle form submission
        $('#messageForm').on('submit', function(e) {
            e.preventDefault();

            const message = $('#messageInput').val();

            $.ajax({
                url: '/send-message',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    message: message
                }),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    $('#messageInput').val('');
                },
                error: function() {
                    toastr.error('Failed to send message.');
                }
            });
        });
    </script>
</body>

</html>
