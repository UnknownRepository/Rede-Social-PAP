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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search-1.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search-2.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Search-Field-With-Icon.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body style="width: 100%;height: 100%;background-color: rgb(241,247,252);">
    <div class="login-clean" style="width: 100%;height: 100%;">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration">
                <img src="assets/img/índice.png" style="width: 40%;"></div>
            <div class="form-group">
                <input class="form-control" id="PrimeiroNome" type="text" name="PrimeiroNome" placeholder="Primeiro Nome"></div>
            <div class="form-group">
                <input class="form-control" id="UltimoNome"  type="text" name="UltimoNome" placeholder="Ultimo Nome">
            </div>
            <div class="form-group">
                <input class="form-control" id="Username"  type="text" name="Username" placeholder="Username"></div>
            <div class="form-group">
                <input class="form-control" id="Email"  type="email" name="Email" placeholder="Email"></div>
            <div class="form-group">
                <input class="form-control" id="EmailRepeat"  type="email" name="EmailRepeat" placeholder="Email (Repeat)"></div>
            <div class="form-group">
                <input class="form-control" id="password"  type="password" name="password" placeholder="Password"></div>
            <div class="form-group">
                <input class="form-control" id="PasswordRepeat"  type="password" name="PasswordRepeat " placeholder="Password (Repeat)"></div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" id="ca"  type="button" style="background-color: rgb(165,255,150);">Registar</button></div><a class="forgot" href="login.php">Já tem conta? Clique&nbsp; aqui&nbsp;</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script type="text/javascript">
        $('#ca').click(function() {

                $.ajax({

                        type: "POST",
                        url: "restapi/users",
                        processData: false,
                        contentType: "application/json",
                        data: '{ "PrimeiroNome": "'+ $("#PrimeiroNome").val() +'", "UltimoNome": "'+ $("#UltimoNome").val() +'", "Username": "'+ $("#Username").val() +'", "Email": "'+ $("#Email").val() +'", "EmailRepeat": "'+ $("#EmailRepeat").val() +'", "password": "'+ $("#password").val() +'", "PasswordRepeat": "'+ $("#PasswordRepeat").val() +'" }',
                        success: function(r) {
                            window.location = 'Sucesspage.php'
                                console.log(r)
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