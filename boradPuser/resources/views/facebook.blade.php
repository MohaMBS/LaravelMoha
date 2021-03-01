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
    <style>
        body{
            background-color:grey;
        }
        #posts{
            width: 75%;
            height: 700px;
            overflow: scroll;
        }
        .msg{
            width: 100%;
            margin-top:1em;
            background-color: lightgrey;
            border:1px solid black;
        }
        .mt-1{
            margin-top:1em;
        }
    </style>

</head>
<body>
    <center>
        <h1>THIS IS FAKE BOOK WE DON'T LIKE REAL THINGS</h1>
        <div id="posts">
        @foreach ($old_messages as $message)
            <div class="msg">{{ $message->message }}</div>
        @endforeach
        </div>
        <form action="{{ route('newPost') }}" method="POST" class="mt-1">
        <label for="message">Write here you message: </label>
            @csrf
            <input type="text" name="message" id="message" placeholder="Write here you message..."> 
            <label for="type">Select to talk:</label>
            <select name="to">
                <option value="public">Public channel.</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <input type="submit" value="Send">
        </form>
    </center>
</body>
</html>