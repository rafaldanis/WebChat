<?php
    if (!isset($_POST['nick'])) {
        header("Location: start.php");
    }
    
    require_once('env.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="js/env.js"></script>
    <script src="js/main.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet"> 
    <link rel="stylesheet" href="/css/style.css" />
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
