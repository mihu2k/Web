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
<?php
$data = $_SESSION['data'];
$fullname = $data['hoten'];
$permission = get_permission($data['email']);

if(isset($_POST['classname']) && isset($_POST['subject']) && isset($_POST['classroom']) && isset($_POST['chooseImage'])){

    $classname = $_POST['classname'];
    $subject = $_POST['subject'];
    $classroom = $_POST['classroom'];
    $chooseImage = $_POST['chooseImage'];
    $email = $data['email'];

    $result = add_class($classname, $subject, $classroom, $email, $chooseImage);

    if($result['code'] == 0){
        $msg = $result['error'];
    }
    else{
        $msg = $result['error'];
    }
    header("Location: home.php");
    exit();
}
?>

<!-- xu li join_class -->
<?php
if(isset($_POST['classcode'])){

    $token = $_POST['classcode'];
    $email = $data['email'];
    $result = join_class($email, $token);

    if($result['code'] == 0){
        $msg = $result['msg'];
    }
    else{
        $msg = $result['error'];
    }
}
?>
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
                        <?php
                        if($permission == 0 || $permission == 1){
                            echo '<li class="header__plus-item header__plus-item-add">Add class</li>';
                        }
                        ?>
                        <li class="header__plus-item header__plus-item-join">Join class</li>
                    </ul>
                </div>
            </li>
            <li class="header__list-right-item">
                <img src="https://img.icons8.com/material/24/000000/circled-menu.png" class="header__list-right-item-img">
            </li>
            <li class="header__list-right-item header__list-right-item-name"><?= $fullname ?>
                <div class="header__list-right-item-logout">
                    <a href="logout.php" class="header__list-right-item-name-logout">Log out</a>
                </div>
            </li>
        </ul>
    </header>
    <div class="app-container">
        <div class="grid">
            <div class="grid__row">
                <!-- Đổ dữ liệu vào từng khung -->
                <?php
                $email = $data['email'];
                $result = load_data_home($email,get_permission($email));
                if(!empty($result)){
                    while ($row = $result->fetch_assoc()) {
                        $classname = $row['classname'];
                        $email = $row['email'];
                        $token = $row['token'];
                        $img = $row['img'];
                        $fullname = get_fullname($email);
                        echo <<<EOT
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <div class="card-item">
                                            <div class="card-item-img" style="background-image: url('$img')"></div>
                                            <div class="card-body">
                                                <a href="" class="card-body-icon">
                                                    <i class="far fa-address-book"></i>
                                                </a>
                                                <a href="" class="card-body-icon">
                                                    <i class="far fa-folder-open"></i>
                                                </a>
                                            </div>

                                            <div class="card-item-label">
                                                <a href="detailClass.php?token=$token" class="card-item-label-link">
                                                    <h4 class="card-item-label-course">$classname</h4>
                                                </a>
                                                <span class="card-item-label-name">$fullname</span>
                                            </div>

                                            <div class="card-item-options">
                                                <i class="fas fa-ellipsis-v"></i>

                                                <ul class="card-item-dropdown">
                                                    <li class="card-item-dropdown-item card-item-dropdown-item-modify"><a href="modify.php?token=$token" class="card-item-dropdown-item-link">Modify</a></li>
                                                    <li class="card-item-dropdown-item card-item-dropdown-item-remove"><a href="remove.php?token=$token" class="card-item-dropdown-item-link">Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                    EOT;
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal list class -->
    <div class="modal-list-class">
        <div class="modal-list-class-body">
            <a href="home.php" class="modal-list-class-title">
                <i class="fas fa-home" class="modal-list-class-title-icon"></i>
                <h5 class="modal-list-class-title-heading">Classes</h5>
            </a>

            <hr class="body-detail-separator-list">

            <div class="form-group form-group-search">
                <label for="searchClass" class="form-label">Search</label>
                <input type="text" name="searchClass" class="form-control" id="searchClass" placeholder="Search...">
                <span class="form-message"></span>
            </div>

            <h4 class="modal-list-class-name">Enrolled</h4>
            <ul class="modal-list-class-body-list">
                <?php
                $email = $data['email'];
                $result = load_data_home($email,get_permission($email));
                if(!empty($result)){
                    while ($row = $result->fetch_assoc()) {
                        # code...
                        $classname = $row['classname'];
                        $email = $row['email'];
                        $token = $row['token'];
                        $fullname = get_fullname($email);
                        echo <<<EOT
                    <li class="modal-list-class-body-item">
                        <h4 class="modal-list-class-body-item-class">$classname</h4>
                        <h5 class="modal-list-class-body-item-name">$fullname</h5>
                    </li>
                    
                
    EOT;
                    }
                }
                ?>

            </ul>

        </div>
    </div>
</div>

<!-- Modal layout-->
<div class="modal__plus">
    <div class="modal__overlay"></div>

    <div class="modal__body">
        <div class="auth-form">
            <div class="auth-form__container">

                <form action="" method="POST" id="form-add">
                    <h3 class="auth-form__heading">ADD CLASS</h3>

                    <div class="auth-form__form">
                        <div class="form-group">
                            <label for="classname" class="form-label">Classname</label>
                            <input type="text" name="classname" class="form-control" id="classname" placeholder="Enter your classname">
                            <span class="form-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject title">
                            <span class="form-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="classroom" class="form-label">Classroom</label>
                            <input type="text" name="classroom" class="form-control" id="classroom" placeholder="Classroom">
                            <span class="form-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="chooseImage" class="form-label">Images</label>
                            <select name="chooseImage" id="chooseImage" class="form-control">
                                <option value="images/img_violin2.jpg">Image violin</option>
                                <option value="images/img_learnlanguage.jpg">Image learn language</option>
                                <option value="images/img_breakfast.jpg">Image breakfast</option>
                                <option value="images/Honors.jpg">Image honors</option>
                                <option value="images/img_bookclub.jpg">Image bookclub</option>
                                <option value="images/img_code.jpg">Image code</option>
                                <option value="images/img_concert.jpg">Image concert</option>
                                <option value="images/img_read.jpg">Image read</option>
                                <option value="images/LanguageArts.jpg">Image language arts</option>
                            </select>
                        </div>
                    </div>

                    <div class="auth-form__controls">
                        <button type="button" class="btn-form-add-class btn-back">Back</button>
                        <button class="btn-form-add-class">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="auth-form">
            <div class="auth-form__container">

                <form action="" method="POST" id="form-join">
                    <h3 class="auth-form__heading">JOIN CLASS</h3>

                    <div class="auth-form__form">
                        <div class="form-group">
                            <label for="classcode" class="form-label">Classname</label>
                            <input type="text" name="classcode" class="form-control" id="classcode" placeholder="Class code">
                            <span class="form-message"></span>
                        </div>
                    </div>

                    <div class="auth-form__controls">
                        <button type="button" class="btn-form-add-class btn-back">Back</button>
                        <button class="btn-form-add-class">Join</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="auth-form-dialog">
            <div class="auth-form__container auth-form__container-remove">

                <form action="" method="POST" id="form-remove">
                    <div class="auth-form-text">
                        <i class="far fa-question-circle"></i>
                        <h4 class="auth-form__text-question">Are you sure you want to delete this class?</h4>
                    </div>

                    <div class="auth-form__controls">
                        <button class="btn-form-remove-class" name="btn_remove_yes">Yes</button>
                        <button type="button" class="btn-form-remove-class btn-back">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Layer modal list class -->
<div class="modal__list"> </div>

<script src="main.js"></script>
</body>
</html>