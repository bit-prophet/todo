<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <!-- Add CSRF token meta tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Get the CSRF token from the meta tag
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            authEndpoint: '/api/pusher/auth',
        });

        // Add CSRF token to Pusher authentication request
        pusher.config.auth = {
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };

        var channel = pusher.subscribe('private-user.4');
        channel.bind('TodoCompleted', function(data) {
            alert(JSON.stringify(data));
        });

    </script>
</head>
<body>
<h1>Pusher Test</h1>
</body>
