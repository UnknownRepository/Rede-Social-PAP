<?php
include('./classes/DB.php');
include_once('./classes/cookie_login.php');
include('./classes/Post.php');
include('./classes/Comment.php');
include_once('./classes/notifyClass.php');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search-1.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search-2.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Search-Field-With-Icon.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body style="width: 100%;height: 100%;background-color: rgb(241,247,252);">
    <div class="login-clean" style="width: 100%;height: 100%;">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><img src="assets/img/índice.png" style="width: 40%;"></div>
            <div class="form-group"><input class="form-control" type="email" id="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password"  id="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" id="login" type="button" data-bs-hover-animate="shake" style="background-color: rgb(165,255,150);">Log In</button></div><a class="forgot" href="registar.php">Ainda Não Tem Uma Conta? Clique Aqui</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
     <script type="text/javascript">
        $('#login').click(function() {

                $.ajax({

                        type: "POST",
                        url: "restapi/auth",
                        processData: false,
                        contentType: "application/json",
                        data: '{ "email": "'+ $("#email").val() +'", "password": "'+ $("#password").val() +'" }',
                        success: function(r) {
                                console.log(r)
                                window.location = 'homepage.php'
                        },
                        error: function(r) {
                                setTimeout(function() {
                                $('[data-bs-hover-animate]').removeClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'));
                                }, 2000)
                                $('[data-bs-hover-animate]').addClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'))
                                console.log(r)
                        }

                });

        });

    </script>

</body>

</html>