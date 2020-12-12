<?php
session_start();
require_once("db.php");
    $permission = $_SESSION['data']['permision'] ?: null;
    $comment_id = $_REQUEST['id'];
    if($permission == 0 || $permission ==1){
        $success = deleteComment($comment_id);
        if($success){
            echo json_encode(['success' => true]);
        }
        else{
            echo 'fail';
        }

    }
    
?>