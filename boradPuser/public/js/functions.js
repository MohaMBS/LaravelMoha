$(document).ready(()=>{

    function msgPrivate(){
        console.log("Cambiando a privado...")
        var script_tag = document.getElementById('functions')
        var user_id = script_tag.getAttribute("user-id");
    
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
        console.log("Cambiando a publico...")
        var script_tag = document.getElementById('functions')
        var user_id = script_tag.getAttribute("user-id");
    
        Echo.private('channel.public')
        .listenForWhisper('typing', (e) => {
            /*console.log("recibio wish")
            console.log(e.name);*/
            e.typing ? $('.typing').show() : $('.typing').hide()
            setTimeout( () => {
                $('.typing').hide()
              }, 1000)
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
    
    msgPublic();
    $("#toTalk").change(()=>{
        if($("#toTalk").val()!="public"){
            Echo.leaveChannel('channel.public')
            msgPrivate();
            
        }else{
            Echo.leave('user.'+user_id)
            msgPublic();
        }
    });

    
    $('#message').on('keydown', ()=>{
        console.log("enviando...")
        let channel = Echo.private('channel.public')

        setTimeout( () => {
            channel.whisper('typing', {
            name: "Oky oky",
            typing: true
            })
        }, 500)
        /*
        Echo.private('channel.public')
        .whisper('typing', {
            name: "Oky oky"
        });*/
    })

    $("#send").click((e)=>{
        console.log("Click");
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
            $.get("http://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/facebook/to="+$("#toTalk").val(), (response)=>{
                console.log($(response).find(".msg"))
                $("#posts").children().remove();
                $("#posts").html($(response).find(".msg"))
            })*/  
});


