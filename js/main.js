$( document ).ready(function() {
    $("form[data-submit='message']").submit(function(){
        var message = $("*[data-type='message']").val();
        $("*[data-type='message']").val('');
        $('#scroll').animate({scrollTop:$('#chat').height()}, 'slow');
        sendMessage(message);
        return false;
    });
    $("[data-event='users']").click(function(e) {
        $("#wrapper").toggleClass("toggled");
    });
});

    var ws = new WebSocket('ws://'+server);
    
    ws.onmessage = function(e){
        receiveMessage(e);
        if($("[data-content='nick']").html()){
            sendMessage($("[data-content='nick']").html());
            $("[data-content='nick']").html('');
        }
    };
    
    function sendMessage(message){
        if (message.length == 0){
            return;
        }
        ws.send(message);
    };
    function receiveMessage(e){
        var content = $("[data-content='chat']").html();
        data = jQuery.parseJSON(e.data);
        data = data[0];
        
        $("[data-content='users']").html('');
        if ( typeof data !== "undefined" && data) {
            for(user in data.all_users){
                $("[data-content='users']").html($("[data-content='users']").html()+'<li>'+data.all_users[user]+'</li>');
            }
        
            $("[data-content='chat']").html(content + '<div class="parent_message"><div class="message received-message"><span class="text-grey"> '+data.user+ ':</span> <span>' + data.msg + '</span></div></div>');
            $('#scroll').animate({scrollTop:$('#chat').height()}, 'slow');
        }
    };