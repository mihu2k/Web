<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit news</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php

    session_start();
    require_once("db.php");
    if($_GET['id'] && isset($_GET['edit'])){
        
        if($_FILES["filename"]["size"] != 0){
            
            $target_dir = "uploads/";
            $target_file = $target_dir . uniqid('file_');
            $uploadOk = 1;

            $title = $_POST["titleNodify"];
            $content = $_POST["content"]; 
            $type = $_POST["cchooseState"]; 

            if (file_exists($target_file)) {
                echo $target_file;
                $uploadOk = 0;
            }
            if ($_FILES["filename"]["size"] > 2000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } 

            if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {

                $result1 = update_news($_GET['id'],$title,$_SESSION['data']['email'],$content,$target_file,$type);
                
                var_dump($result1);
                echo "The file ". htmlspecialchars( basename( $_FILES["filename"]["name"])). " has been uploaded.";
                $location = 'Location: detailClass.php?token='.$_GET['token'];
                header($location);
            } 
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }else{
            $title = $_POST["titleNodify"];
            $content = $_POST["content"]; 
            $type = $_POST["cchooseState"]; 

            $result1 = update_news($_GET['id'],$title,$_SESSION['data']['email'],$content,"",$type);
            echo "The file ". htmlspecialchars( basename( $_FILES["filename"]["name"])). " has been uploaded.";
            $location = 'Location: detailClass.php?token='.$_GET['token'];
            header($location);
        }
    }
    ?>
    

    <?php  if($_GET['id'] && !isset($_GET['edit'])){ $news = getNewsById($_GET['id']);?>
                        <div class="grid__right">
                            <div class="grid__right-item grid__right-form-notify">
                                <form action="edit_news.php?edit=true&id=<?php echo $_GET['id'] ?>&token=<?php echo $_GET['token'] ?>" method="POST" id="form-notify" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="titleNodify" class="form-label">Title</label>
                                        <input type="text" name="titleNodify" class="form-control" id="titleNodify" placeholder="Enter title" value="<?php echo $news['title'] ?>">
                                        <span class="form-message"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea name="content" id="content" cols="150" rows="5"><?php echo $news['content'] ?></textarea>
                                    </div>

                                    <div class="custom-file">
                                        <label class="form-label" for="customFile">Choose file</label>
                                        <input type="file" class="custom-file-input" id="customFile" name="filename">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="chooseState" class="form-label">State</label>
                                        <select name="cchooseState" id="chooseState" class="form-control" value="<?php echo $news['type'] ?>">
                                            <option value="0">News</option>
                                            <option value="1">Document</option>
                                            <option value="2">Image</option>
                                        </select>
                                    </div>

                                    <div class="form-button-post">
                                        <button class="btn-form-notify-class" type="submit" name="submit">Post</button>
                                    </div>
                                </form>
                            </div>
    <?php } ?>

</body>
</html>