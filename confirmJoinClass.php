<?php
session_start();
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Class</title>
  <link rel="stylesheet" href="style.css">
  <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="home-app">
  <header class="header-home">
    <ul class="header__list-left">
      <li class="header__list-left-item">
        <i class="fas fa-bars"></i>
      </li>
      <li class="header__list-left-item">
        <img src="https://www.gstatic.com/images/branding/googlelogo/svg/googlelogo_clr_74x24px.svg" alt="" class="header__left-item-img">
      </li>
    </ul>

    <ul class="header__list-right">
      <li class="header__list-right-item">
        <div class="header__plus">
          <i class="fas fa-plus header__right-item-plus"></i>

          <ul class="header__plus-list">
            <li class="header__plus-item header__plus-item-add">Add class</li>
            <li class="header__plus-item header__plus-item-join">Join class</li>
          </ul>
        </div>
      </li>
      <li class="header__list-right-item">
        <img src="https://img.icons8.com/material/24/000000/circled-menu.png" class="header__list-right-item-img">
      </li>
      <li class="header__list-right-item header__list-right-item-name"></li>
    </ul>
  </header>
  <div style="font-size: 30px;text-align: center;position: absolute;left: 25%;top: 25%">
    <?php
    if (isset($_GET['email']) && isset($_GET['token'])){
      if(confirmJoinClass($_GET['email'], $_GET['token'])){
        echo 'Tham gia vào lớp học thành công!!!';
      }
    }

    ?>
  </div>

</div>


</div>
</body>
</html>
