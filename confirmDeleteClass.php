<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: signIn.php');
    exit();
}
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <<?php 
        $token = $_GET['token'];
     ?>
    <div class="auth-form-dialog">
        <div class="auth-form__container auth-form__container-remove">

            <form action="" method="POST" id="form-remove">
                <div class="auth-form-text">
                    <i class="far fa-question-circle"></i>
                    <h4 class="auth-form__text-question">Are you sure you want to delete this class?</h4>
                </div>

                <div class="auth-form__controls">
                    <button class="btn-form-remove-class" name="btn_remove_yes">
                        <a href="remove.php?token=<?=$token?>">Yes</a>
                    </button>
                    <button type="button" class="btn-form-remove-class btn-back">
                        <a href="home.php">No</a>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>