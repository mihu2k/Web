<?php
    session_start();
    require_once("db.php");
    
    if($_GET['id']){
        $result = removed_news($_GET['id']);
        if($result){
            echo "Deleted";
            $location = 'Location: detailClass.php?token='.$_GET['token'];
            header($location);
        }else{
            echo "Can't not deleted!";
        }
    }else{
        echo "Can't not deleted!";
    }

?>