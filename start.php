<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Zaloguj się</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet"> 
    <link rel="stylesheet" href="/css/style.css" />
</head>
<body class="d-flex align-items-center">
    <div class="container d-flex justify-content-center col-12">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-3 card card-container login p-0">
            <div class="col-12 bg-info text-center text-white p-3">
                Logowanie
            </div>
            <form class="col-12 mt-2 form-signin" action="/" method="POST">
                <input type="text" name="nick" class="form-control" placeholder="Wpisz swój nick" required autofocus>
                
                <button class="btn btn-lg btn-info btn-block btn-signin" type="submit">Zaloguj się</button>
            </form>
        </div>
    </div>
</body>
</html>
