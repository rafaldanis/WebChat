<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Zaloguj się</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css" />
</head>
<body class="d-flex align-items-center">
    <div class="container d-flex justify-content-center">
        <div class="card card-container login">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <form class="form-signin" action="/" method="POST">
                <input type="text" name="nick" class="form-control" placeholder="Wpisz swój nick" required autofocus>
                
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Zaloguj się</button>
            </form>
        </div>
    </div>
</body>
</html>
