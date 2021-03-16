$(document).ready(()=>{
    var script_tag = document.getElementById('functions')
    var user_id = script_tag.getAttribute("user-id");
    var user_name = script_tag.getAttribute("user-name");
    let usersInfo=[];

    Echo.private('channel.commentLike')
        .listenForWhisper('likedComment', (e) => {
            if(e.type =="like"){
                if(e.liked){
                    $("input.like#"+e.id).parent().children('span').text(parseInt($("input.like#"+e.id).parent().children('span').text())+1)
                }else{
                    $("input.like#"+e.id).parent().children('span').text(parseInt($("input.like#"+e.id).parent().children('span').text())-1)
                }
            }else{
                console.log(e);
                console.log($("input#"+e.id+".comment").parent().children(".comentArea").append("<p><strong>"+e.name+": </strong>"+e.comment+"</p>"))
                valor = parseInt($("input#"+e.id+".comment").parent().children(".comment").val().split(" ")[1])+1
                $("input#"+e.id+".comment").parent().children(".comment").val("Show "+valor+" comment/s")
                $("input#"+e.id+".comment").parent().children(".comment").css("background-color", "yellow");
                console.log()
            }
        })

    refresButtons()
    function msgPrivate(){
        Echo.private('channel.public')
        .listenForWhisper('typing', (e) => {
            $('.typing').text(e.name+' is typing');
            e.typing ? $('.typing').show() : $('.typing').hide()
            setTimeout( () => {
                $('.typing').hide()
            }, 5000)
        })
        //console.log("Cambiando a privado...")
        Echo.private('user.'+user_id)
            .listen('NewMessageNotification', (e) => {
                let name = "";
                    $("#toTalk option").each(function(){
                    if ($(this).val() == e.message.from){        
                            name = $(this).text();
                    }
                    });
                $("#posts").prepend("<div class=\"msg\"><strong>"+name+": </strong>"+e.message.message+"</div>");
            });
    }
    function msgPublic(){
        Echo.private('channel.public')
        .listenForWhisper('typing', (e) => {
            $('.typing').text(e.name+' is typing');
            e.typing ? $('.typing').show() : $('.typing').hide()
            setTimeout( () => {
                $('.typing').hide()
            }, 5000)
        })
        .listen('PublicPost', (e) => {
            console.log(e)
            let name = "";
            $("#toTalk option").each(function(){
               if ($(this).val() == e.message.from){            
                    name = $(this).text();
                    console.log(e.message.imagePath);
                    if($("#toTalk").val() != "public"){
                        $("#posts").prepend("<div class=\"msg\"><strong>"+name+": </strong>"+e.message.message+"</div>");
                    }else{
                        if(e.message.imagePath == undefined){
                            console.log("No imahen");
                            $("#posts").prepend("<div class=\"msg\"><div class=\"container\"><div style=\"width: 75%;\"> <div style=\"margin-top: auto;\"><strong>"+name+":</strong>"+e.message.message+"</div></div></div><span class=\"countLikes\">0</span><input type=\"button\" id=\""+e.message.id+"\" class=\"like \" value=\"LIKE\"> <input type=\"button\" id=\""+e.message.id+"\" class=\"comment\" value=\"Show 0 comments\"> <div class=\"comentArea\" hidden> <textarea name=\"comment\"  cols=\"150\" rows=\"10\"></textarea><br> <input type=\"button\" value=\"Comment\" id=\""+e.message.id+"\"> <h3>Comentarios:</h3> </div></div>");
                        }else{
                            $("#posts").prepend("<div class=\"msg\"><div><img src=\"https://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/img/"+e.message.imagePath+"\" alt=\"\" width=\"250px\" height=\"150px\"/></br><strong>"+name+":</strong>"+e.message.message+"</div><span class=\"countLikes\">0</span><input type=\"button\" id=\""+e.message.id+"\" class=\"like \" value=\"LIKE\"> <input type=\"button\" id=\""+e.message.id+"\" class=\"comment\" value=\"Show 0 comments\"> <div class=\"comentArea\" hidden> <textarea name=\"comment\"  cols=\"150\" rows=\"10\"></textarea><br> <input type=\"button\" value=\"Comment\" id=\""+e.message.id+"\"> <h3>Comentarios:</h3> </div></div>");
                        }
                    }
                    refresButtons();
                    //$("#posts").prepend("<div class=\"msg\"><strong>"+name+": </strong>"+e.message.message+"</div>");
               }
            }); 
        });
    }
    Echo.join(`presence.home`)
        .here((users) => {
            users.forEach(element => {
                $(".usersOnLine").children("marquee").append("<span id='"+element.id+"'> ·"+element.name+"</span>")
            });
        })
        .joining((user) => {
            console.log(user.name);
            $(".usersOnLine").children("marquee").append("</br><span id='"+user.id+"'> ·"+user.name+"</span>")
        })
        .leaving((user) => {
            $(".usersOnLine").children("marquee").children("#"+user.id).remove()
        });
    function isUserMatching (allUsers, userId) {
        let matched = false
        if(userId == user_id){
            matched={name:"You"}
        }else{
            allUsers.map(user => {
                if (user.id == userId) {
                    matched = user
                }
            })
        }
        
        return matched
    }
    msgPublic();
    $("#toTalk").change(()=>{
        if($("#toTalk").val()!="public"){
            Echo.leave('channel.public')
            msgPrivate();
            postWall=$("#posts");
            postWall.empty();
            $.getJSON("https://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/getMsg/"+$("#toTalk").val(), (response)=>{
                $.each( response, function() {
                    usersInfo = response.userName
                    console.log(usersInfo)
                    response.old_messages.map((data)=>{
                        let user = isUserMatching(usersInfo, data.from)
                        if(user){
                            postWall.prepend("<div class=\"msg\" user-id=\""+data.from+"\" ><strong>"+user.name+":</strong>"+data.message+"</div>");
                        }
                    })
                  });
                  if(postWall.children().length == 0){
                    postWall.prepend("<h1 style=\"color:red;\">No tienes ningun mensaje con esta persona</h1>")
                }
            })
        }else{
            location.reload();
            // codigo para recargar public 
        }
    });

    
    $('#message').on('keydown', ()=>{
        let channel = Echo.private('channel.public')

        setTimeout( () => {
            channel.whisper('typing', {
            name: user_name,
            typing: true
            })
        }, 1500)
    })

    $("#send").click((e)=>{
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var message = $("#message").val();
        var to = $("#toTalk").val();
        var from = $("#user_id").val();
        let data = new FormData();
        data.append("_token",_token)
        data.append("message",message)
        data.append("form",from)
        data.append("to",to)
        data.append("imagen",$("#fileUpload").prop('files')[0])
        $.ajax({
            url: "https://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/facebook",
            type:'POST',
            contentType: false,
            processData: false,
            data: data,
            success: function(data) {
                if($("#toTalk").val() != "public"){
                    $("#posts").prepend("<div class=\"msg\" user-from=\""+data.message_id+"\" ><strong>You:</strong>"+message+"</div>");
                }else{
                    console.log("Done!");
                    if(data.img != undefined){
                        $("#posts").prepend("<div class=\"msg\"><div ><img src=\"https://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/img/"+data.img+"\" alt=\"\" width=\"250px\" height=\"150px\"/> <br> <strong>You:</strong>"+message+"</div><span class=\"countLikes\">0</span><input type=\"button\" id=\""+data.message_id+"\" class=\"like \" value=\"LIKE\"> <input type=\"button\" id=\""+data.message_id+"\" class=\"comment\" value=\"Show 0 comments\"> <div class=\"comentArea\" hidden> <textarea name=\"comment\"  cols=\"150\" rows=\"10\"></textarea><br> <input type=\"button\" value=\"Comment\" id=\""+data.message_id+"\"> <h3>Comentarios:</h3> </div></div>");
                    }else{
                        $("#posts").prepend("<div class=\"msg\"><div><strong>You:</strong>"+message+"</div><span class=\"countLikes\">0</span><input type=\"button\" id=\""+data.message_id+"\" class=\"like \" value=\"LIKE\"> <input type=\"button\" id=\""+data.message_id+"\" class=\"comment\" value=\"Show 0 comments\"> <div class=\"comentArea\" hidden> <textarea name=\"comment\"  cols=\"150\" rows=\"10\"></textarea><br> <input type=\"button\" value=\"Comment\" id=\""+data.message_id+"\"> <h3>Comentarios:</h3> </div></div>");
                    }
                }
                refresButtons()
                $("#message").val("");
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Escriba el mensaje o el formato la imagen no es el correcot.");
            }
        })
        return false;
    })  

    function refresButtons(){
        let channel = Echo.private('channel.commentLike')
        likebutton=$("input.like")
        commentbutton=$(".comment")
        areatextbutton=$(".comentArea")
        function gestorLike(idPostToLike){
            if($("input.like#"+idPostToLike).hasClass("liked")){
                $("input.like#"+idPostToLike).removeClass("liked")
                $("input.like#"+idPostToLike).parent().children('span').text(parseInt($("input.like#"+idPostToLike).parent().children('span').text())-1)
                channel.whisper('likedComment', {
                    id: idPostToLike,
                    liked: false,
                    type: "like"
                })
            }else{
                $("input.like#"+idPostToLike).addClass("liked")
                $("input.like#"+idPostToLike).parent().children('span').text(parseInt($("input.like#"+idPostToLike).parent().children('span').text())+1)
                channel.whisper('likedComment', {
                    id: idPostToLike,
                    liked: true,
                    type: "like"
                })
            }
        }
        likebutton.click((e)=>{
            let idPostToLike=e.target.id;
            console.log()
            var _token = $("input[name='_token']").val();
            $.post("https://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/like", {
                '_token': _token,
                idPost : idPostToLike
            })
            .done(
                gestorLike(idPostToLike)
            );
             
        })
        commentbutton.click(function(e){
            console.log("asd")
            $(this).parent().children(".comentArea").toggle()
            $(this).css("background-color", "");
            
            
        })
        areatextbutton.children(":button").click(function(){
            
            let idPostToLike = $(this).attr("id")
            var _token = $("input[name='_token']").val();
            $.post("https://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/comment", {
                '_token': _token,
                idPost : idPostToLike,
                comment : $(this).parent().children("textarea").val()
            })
            .done(
                sendCommentToUser(idPostToLike, $(this)),
                $(this).parent().append("<p> You: "+$(this).parent().children("textarea").val()+"</p>"),
                $(this).parent().children("textarea").val(""),
                val = parseInt($(this).parent().parent().children(".comment").val().split(" ")[1])+1,
                $(this).parent().parent().children(".comment").val("Show "+val+" comment/s")
                
                
            );
        })
    }

    function sendCommentToUser(idPostToLike, thiss){
        let channel = Echo.private('channel.commentLike')
        channel.whisper('likedComment', {
            id: idPostToLike,
            name: $("#nameOfUser").val(),
            type: "comment",
            comment: thiss.parent().children("textarea").val()
        })
        console.log($("input#"+idPostToLike+".comment"))
    }
});

/*codigo para recargar public 
            Echo.leave('user.'+user_id)
            msgPublic();
            postWall=$("#posts");
            postWall.empty();
            $.getJSON("http://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/getMsg/"+$("#toTalk").val(), (response)=>{
                $.each( response, function( key, val ) {
                    response.old_messages.map((data)=>{
                        //console.log(data.message)
                        console.log(data);
                        let user = isUserMatching(usersInfo, data.from)
                        if(user){
                            if(data.img != undefined){
                                $("#posts").prepend("<div class=\"msg\"><div class=\"container\"><div class=\"imgmsg\" style=\"width: 25%;\"> <img src=\"http://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/img/"+data.img+"\" alt=\"\" width=\"250px\" height=\"150px\"/> </div><div style=\"width: 75%;\"> <div style=\"margin-top: auto;\"><strong>You:</strong>"+message+"</div></div></div><span class=\"countLikes\">0</span><input type=\"button\" id=\""+data.message_id+"\" class=\"like \" value=\"LIKE\"> <input type=\"button\" id=\""+data.message_id+"\" class=\"comment\" value=\"Show 0 comments\"> <div class=\"comentArea\" hidden> <textarea name=\"comment\"  cols=\"150\" rows=\"10\"></textarea><br> <input type=\"button\" value=\"Comment\" id=\""+data.message_id+"\"> <h3>Comentarios:</h3> </div></div>");
                            }else{
                                $("#posts").prepend("<div class=\"msg\"><div><strong>You:</strong>"+message+"</div><span class=\"countLikes\">0</span><input type=\"button\" id=\""+data.message_id+"\" class=\"like \" value=\"LIKE\"> <input type=\"button\" id=\""+data.message_id+"\" class=\"comment\" value=\"Show 0 comments\"> <div class=\"comentArea\" hidden> <textarea name=\"comment\"  cols=\"150\" rows=\"10\"></textarea><br> <input type=\"button\" value=\"Comment\" id=\""+data.message_id+"\"> <h3>Comentarios:</h3> </div></div>");
                            }
                            //postWall.prepend("<div class=\"msg\" user-id=\""+data.from+"\" ><strong>"+user.name+":</strong>"+data.message+"</div>");
                        }
                        //postWall.append("<div class=\"msg\" user-from=\""+data.from+"\" ><strong>:</strong>"+data.message+"</div>");
                    })
                });
                if(postWall.children().length == 0){
                    postWall.append("<h1 style=\"color:red;\">No tienes ningun mensaje con esta persona</h1>")
                }
            })*/