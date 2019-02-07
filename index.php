<?php
    if(!isset($_POST['nick'])){
        header("Location: start.php");
    }
    
    define("USER_NICK",$_POST['nick']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet"> 
    <link rel="stylesheet" href="/css/style.css" />
    <script>
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

            var ws = new WebSocket('ws://91.239.66.112:8080');
            
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
            
    </script>
</head>
<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" data-content="users"></ul>
        </div>
    
        <div id="page-content-wrapper" class="d-flex">
            <div id="scroll" class="container d-flex justify-content-center" style="height: calc(100% - 116px); overflow-y: auto;">
                <div id="content" class="col-12">
                    <div class="" data-content="chat" id="chat"></div>
                    <?php
                        echo '<div id="form" class="fixed-bottom">';
                            echo '<div class="d-none" data-content="nick">' . USER_NICK . '</div>';
                            echo '<form id="message" class="form-signin p-3" data-submit="message" data-ret="false" type="POST">';
                                echo '<p>Hej <span>' . USER_NICK . '</span> poniżej wpisz wiadomość</p>';
                                echo '<input class="form-control" data-type="message" placeholder="Wpisz wiadomość..." />';
                               // echo '<button type="submit" class="btn btn-lg btn-primary btn-block btn-signin">Wyślij</button';
                            echo '</form>';
                        echo '</div>';
                    ?>
                </div>
            </div>
        </div>
        <!--<div class="d-flex align-items-center">
            <div class="container d-flex justify-content-center">
                <a href="#users" class="btn btn-secondary" data-event="users">Zobacz wszystkich użytkowników czatu</a>
            </div>
        </div>-->
    </div>    
</body>
</html>
