<?php

    require $_SERVER['DOCUMENT_ROOT'] . '/application/core/Db.class.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/application/models/MainModel.class.php';

    $color=MainModel::getColor();
?>


<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet"  href="css/bootstrap.min.css">
   <link rel="stylesheet"  href="css/nice-select.css">
  <link rel="stylesheet"  href="css/style.css">
  <link rel="stylesheet"  href="css/jquery-ui.css">
  <link rel="stylesheet"  href="css/checkbox.css">
  <link rel="stylesheet"  href="css/adaptive.css">
  <link rel="shortcut icon" type="iamge/png" href="/img/favicon.png">
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
  
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&amp;subset=cyrillic" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Юкон - сеть компаний(Тестовое сохранение)</title>
  
 </head>
 <body>
 	<?php
 		include 'application/views/header.php';
 		include 'application/views/menu.php';
 		include 'application/views/main/index.php';
		include 'application/views/footer.php';
 	?>
  <script  src="js/jquery-3.3.1.min.js"></script>
  <script  src="js/bootstrap.min.js"></script>
  <script  src="js/jquery.nice-select.js"></script>
  <script  src="js/jquery-ui.min.js"></script>
  <script  src="js/datepickerrus.js"></script>
  <script  src="js/jquery.mask.js"></script>
  <script  src="js/scripts.js"></script>
  <script  src="js/jquery.validate.min.js"></script>
 </body>
</html>
