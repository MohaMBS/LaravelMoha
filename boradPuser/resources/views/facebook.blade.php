<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>facebook</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script id="functions" user-id="{{ $user_id }}" src="{{ asset('js/functions.js') }}" user-name="{{ $nameOfUser[0]->name }}" defer></script>
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
        .mt-2{
            margin-top:2em!important;
        }
        .alert-d{
            color:red;
            background-color:yellow;
        }
        marquee{
            color: green;
            border-style: solid;
        }
        ul{
            list-style-type: circle;
        }
    </style>

</head>
<body>
    <div style="float:left;" class="usersOnLine">
        <h3 style="color:green;">Users online:</h3>
        <marquee direction="down" height="100" width="150" bgcolor="lightgrey" Scrollamount=1 >

        </marquee>
    </div>
    <center>
        <h1>THIS IS FAKE BOOK WE DON'T LIKE REAL THINGS</h1>
        <h3 style="color:yellow;" id="nameOfAuthUser"> Welcome {{ $nameOfUser[0]->name }}!!</h3>
        <a style="color:red;display:none;" class="typing" > Esta escribiendo</a>
        <div id="posts" style="width:80%;">
            @foreach ($old_messages as $message)
                <div class="msg">
                    <div>
                        <strong> 
                        @if ($message->from == $user_id)
                            You: 
                        @else
                            @foreach ($users as $user)
                                @if ($message->from == $user->id)
                                    {{ $user->name }}:
                                @endif
                            @endforeach
                        @endif
                        </strong> {{ $message->message }}
                    </div>
                    <span class="countLikes">{{ $message->likes_count }}</span>
                    <input type="button" id="{{ $message->id }}" class="like" value="LIKE"> 
                    <input type="button" id="{{ $message->id }}" class="comment" value="COMMENT">
                    <div class="comentArea" hidden>
                        <textarea name="comment"  cols="150" rows="10"></textarea><br>
                        <input type="button" value="Comment" id="{{ $message->id }}">
                        <h3>Comentarios:</h3>
                    </div>
                </div>
            @endforeach
        </div>
        <form action="{{ route('newPost') }}" method="post" class="mt-1">
            @csrf
            <input type="number" name="user_id" id="user_id" value="{{ $user_id }}" hidden>
            <label for="message">Write here you message: </label>
            <input type="text" name="message" id="message" placeholder="Write here you message..."> 
            <label for="type">Select to talk:</label>
            <select name="to" id="toTalk">
                <option value="public">Public channel.</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <input type="button" value="Send" id="send">
        </form>
        @error('message')
            <span class="alert-d mt-2">{{ $message }}</span>
        @enderror
    </center>
</body>
</html>