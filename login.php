<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/application/core/Account.class.php';
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet"  href="css/bootstrap.min.css">
  <link rel="stylesheet"  href="css/style.css">
  <link rel="stylesheet"  href="css/jquery-ui.css">
  <link rel="stylesheet"  href="css/checkbox.css">
  <link rel="stylesheet"  href="css/adaptive.css">
  <link rel="shortcut icon" type="iamge/png" href="/img/favicon.png">
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">

  
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&amp;subset=cyrillic" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Юкон - сеть компаний</title>
 </head>
 <body>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="login">
          <form name="autorization" method="POST">
            <span class="header_block">Авторизация</span>
            <br>
            <span>Для входа введите логин и пароль</span>
            <br><br>
            <span class="top_login">Логин:</span>
            <br>
            <input class="input_add" type="text" name="login_auth">
            <br>
            <span class="top_login">Пароль:</span>
            <br>
            <input class="input_add" type="password" name="pass_auth">
            <br>
              <input class="input_add" type="hidden" name="hidden_action" value="login">
            <button data-ection="login" class="login_button" type="submit">Войти</button>
          </form>
        </div>
      </div>
      
    </div>
    
  </div>
 
  <script  src="js/jquery-3.3.1.min.js"></script>
  <script  src="js/bootstrap.min.js"></script>
  <script  src="js/jquery-ui.min.js"></script>
  <script  src="js/jquery.mask.js"></script>
  <script  src="js/scripts_admin.js"></script>
  <script  src="js/jquery.validate.min.js"></script>


 </body>
</html>
