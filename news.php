
<?php 
    session_start();
    require_once("db.php");

$target_dir = "uploads/";
$target_file = $target_dir . uniqid('file_').basename($_FILES["filename"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    $uploadOk = 0;
  }

if ($_FILES["filename"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
$title = $_POST["titleNodify"];
$content = $_POST["content"]; 
$type = $_POST["cchooseState"]; 


    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } 
    else {

        if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
            $result1 = create_news($title,$_SESSION['data']['email'],$content,$target_file,$type,$_GET['token']);
            echo "The file ". htmlspecialchars( basename( $_FILES["filename"]["name"])). " has been uploaded.";
            $location = 'Location: detailClass.php?token='.$_GET['token'];
            header($location);
        } 
        else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>