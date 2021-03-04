$(document).ready(()=>{
    var script_tag = document.getElementById('functions')
    var user_id = script_tag.getAttribute("user-id");
    var user_name = script_tag.getAttribute("user-name");
    let usersInfo=[];

    function msgPrivate(){
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
        //console.log("Cambiando a publico...")
    
        Echo.private('channel.public')
        .listenForWhisper('typing', (e) => {
            /*console.log("recibio wish")
            console.log(e.name);*/
            $('.typing').text(e.name+' is typing');
            e.typing ? $('.typing').show() : $('.typing').hide()
            setTimeout( () => {
                $('.typing').hide()
              }, 5000)
        })
        
        .listen('PublicPost', (e) => {
            let name = "";
            $("#toTalk option").each(function(){
               if ($(this).val() == e.message.from){        
                    name = $(this).text();
                    $("#posts").prepend("<div class=\"msg\"><strong>"+name+": </strong>"+e.message.message+"</div>");
               }
            }); 
        });
    }
    
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
            Echo.leaveChannel('channel.public')
            msgPrivate();
            postWall=$("#posts");
            postWall.empty();
            $.getJSON("http://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/getMsg/"+$("#toTalk").val(), (response)=>{
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
            Echo.leave('user.'+user_id)
            msgPublic();
            postWall=$("#posts");
            postWall.empty();
            $.getJSON("http://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/getMsg/"+$("#toTalk").val(), (response)=>{
                $.each( response, function( key, val ) {
                    response.old_messages.map((data)=>{
                        //console.log(data.message)
                        postWall.append("<div class=\"msg\" user-from=\""+data.from+"\" ><strong>:</strong>"+data.message+"</div>");
                    })
                });
                if(postWall.children().length == 0){
                    postWall.append("<h1 style=\"color:red;\">No tienes ningun mensaje con esta persona</h1>")
                }
            })
        }
    });

    
    $('#message').on('keydown', ()=>{
        //console.log("enviando...")
        let channel = Echo.private('channel.public')

        setTimeout( () => {
            channel.whisper('typing', {
            name: user_name,
            typing: true
            })
        }, 1500)
        /*
        Echo.private('channel.public')
        .whisper('typing', {
            name: "Oky oky"
        });*/
    })

    $("#send").click((e)=>{
        //console.log("Click");
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var message = $("#message").val();
        var to = $("#toTalk").val();
        var from = $("#user_id").val();

        $.ajax({
            url: "http://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/facebook",
            type:'POST',
            data: {_token:_token, message:message, to:to,from:from},
            success: function(data) {
                console.log("Done!");
                $("#posts").prepend("<div class=\"msg\"><strong>You:</strong>"+message+"</div>");
                $("#message").val("");
            }
        })
        return false;
    })







  /*
            $.get("http://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/getMsg/to="+$("#toTalk").val(), (response)=>{
                console.log($(response).find(".msg"))
                $("#posts").children().remove();
                $("#posts").html($(response).find(".msg"))
            })*/  
});


