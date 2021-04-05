<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Success icon animation - CSS only</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'><link rel="stylesheet" href="./assets/css/stylesucess.css">

</head>

<div class="container">
  	 <h5 style="color: rgb(165,255,150); left: 45%; top: 30%; position: absolute;">Conta Criada Com Sucesso! </h5>
  </div>
<body>

<!-- partial:index.partial.html -->
<div class="dummy-positioning d-flex">

  <div class="success-icon">
    <div class="success-icon__tip"></div>
    <div class="success-icon__long"></div>
   

  </div>
  <br/>
   
</div>

<!-- partial -->
  <script  src="./assets/js/scriptsucess.js"></script>
<?php 
header("refresh:2;url=login.php");
?>
</body>
</html>
