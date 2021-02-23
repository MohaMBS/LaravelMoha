<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>facebook</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script id="functions" user-id="{{ $user_id }}" src="{{ asset('js/functions.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <center>
        <h1>THIS IS FAKE BOOK WE DON'T LIKE REAL THINGS</h1>
        <div id="posts">
        @foreach ($old_messages as $message)
            <p>{{ $message->message }}</p>
        @endforeach
        </div>
    </center>
</body>
</html>