<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
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
        #users{
            color: green;
            border-style: solid;
        }
        #notibox{
            color: orange;
            border-style: solid;
        }
        ul{
            list-style-type: circle;
        }
        .liked{
            background-color:cyan;
        }
        .imgmsg {
            margin-left: 0;
        }
        .container{
            display: flex;
        }
    </style>

</head>
<body>
    <div style="float:left;" class="notificacion">
        <h3  style="color:orange;">Notificaciones:</h3>
        <marquee id="notibox" direction="down" height="250" width="125" bgcolor="lightgrey" Scrollamount=1 >

        </marquee>
        <br>
        <input type="button" value="Borrar notificaciones." id="deleteNoti">
    </div>
    <div style="float:right;" class="usersOnLine">
        <h3 style="color:green;">Users online:</h3>
        <marquee id="users" direction="down" height="250" width="125" bgcolor="lightgrey" Scrollamount=1 >

        </marquee>
    </div>
    <center>
        <h1 style="color: red">Si no va es porque estoy trabajando en ello</h1>
        <h1>THIS IS FAKE BOOK WE DON'T LIKE REAL THINGS</h1>
        <input type="text" value="{{ $nameOfUser[0]->name }}" id="nameOfUser" hidden>
        <h3 style="color:yellow;" id="nameOfAuthUser"> Welcome {{ $nameOfUser[0]->name }}!!</h3>
        <a style="color:red;display:none;" class="typing" > Esta escribiendo</a>
        <div id="posts" style="width:80%;">
            @foreach ($old_messages as $message)
                <div class="msg">
                    <div>
                        @if($message->imagePath != null)
                            <img src="{{ asset('img/'.$message->imagePath) }}" alt="" width="250px" height="150px"/>
                            </br>
                        @endif
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
                    <?php $likeStatus = false; ?>
                    @foreach ( $message->likes as $like)
                        @if( $like->user_id == $user_id )
                            <?php $likeStatus = true; ?>
                            <input type="button" id="{{ $message->id }}" class="like liked" value="LIKED"> 
                        @endif
                    @endforeach
                    @if( !$likeStatus )
                        <input type="button" id="{{ $message->id }}" class="like " value="LIKE"> 
                    @endif
                    <input type="button" id="{{ $message->id }}" class="comment" value="Show {{ $message->comments_count }} comments">
                    <div class="comentArea" hidden>
                        <textarea name="comment"  cols="150" rows="10"></textarea><br>
                        <input type="button" value="Comment" id="{{ $message->id }}">
                        <h3>Comentarios:</h3>
                        @foreach ( $message->comments as $comment)
                            @if ($comment->user_id == $user_id)
                                <p> <strong>You: </strong>  {{ $comment->comment }}</p>
                            @else
                                @foreach ($users as $user)
                                    @if ($comment->user_id == $user->id)
                                    <p> <strong>{{ $user->name}}:</strong> {{ $comment->comment }}</p>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <form action="{{ route('newPost') }}" method="post" enctype="multipart/form-data" id="myform" class="mt-1">
            @csrf
            <input type="number" name="user_id" id="user_id" value="{{ $user_id }}" hidden>
            <label for="message">Write here you message: </label>
            <input type="text" name="message" id="message" placeholder="Write here you message..."> 
            <label for="type">Select to talk:</label>
            <select name="to" id="toTalk">
                <option value="public">Public channel.</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id  }}" id-User="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <input type="button" value="Send" id="send">
            <div>
                <label for="file">Imagen para subir: </label>
                <input type="file" id="fileUpload" name="fileUpload" />
            </div>
        </form>
        @error('message')
            <span class="alert-d mt-2">{{ $message }}</span>
        @enderror
    </center>
</body>
</html>