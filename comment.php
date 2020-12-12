<?php
session_start();
require_once("db.php");
    $email = $_SESSION['data']['email'] ?: null;
    if($email == null){
        echo 'access denied';
    }
    else{
        $content =  $_REQUEST['content'];
        $post_id = $_REQUEST['id'];
        $data = postComment($post_id, $content, $email);
        $data['name'] = getNameUserByEmail($email);
        echo json_encode($data);

    }
    
?>