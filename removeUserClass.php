<?php
session_start();
require_once("db.php");

  $email = $_SESSION ?: ['data'] ?: ['email'] ?: null;
  $permission = $_SESSION ?: ['data'] ?: ['permission'] ?: 999;

  if($permission <= 1){
    if(isExistUserClassroom($email, $_GET['token'])){
      $success = removeUserClassroom($_GET['email'], $_GET['token']);
      if($success){
        header("Location: people.php");
      }
      else{
        echo 'Đã xảy ra lỗi trong quá trình xóa học viên này';
      }
    }
  }
  else{
    echo 'Bạn không có quyền để xóa học viên này';
  }
