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
    <title>People</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$data = $_SESSION['data'];
$fullname_user = $data['hoten'];
$permission = get_permission($data['email']);
$token = '';
$fullname= '';
$classname = '';

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $result = get_detail_class($token);
    $classname = $result['classname'];
    $fullname = get_fullname($result['email']);
}

if(isset($_POST['email'])){
    $email = $_SESSION['data']['email'] ?: null;
    $permission = $_SESSION['data']['permission'];
    if($permission <= 1){
        $isExist =  isExistUserClassroom($_POST['email'], $token );

        if(!$isExist){
            addMemberClassroom($_POST['email'],$token);
            sendMailConfirmJoinClass($_POST['email'],$token);
            echo '<div class="alert-message">Email xác nhận đã được gửi đến' . $_POST['email'].'</div>';
        }
        else{
            echo '<div class="alert-message">User đã tồn tại trong lớp học</div>';
        }
    }
    else{
        echo '<div class="alert-message">Bạn không có quyền thêm sinh viên vào lớp</div>';
    }

}

?>
    <div class="home-app home-app-people">
        <header class="header-home">
            <ul class="header__list-left">
                <li class="header__list-left-item">
                    <i class="fas fa-bars"></i>
                </li>
                <li class="header__list-left-item header__list-left-item-inf">
                    <h4 class="header__list-left-class"><?= $classname ?></h4>
                    <h5 class="header__list-left-teacher-name"><?= $fullname ?></h5>
                </li>
            </ul>

            <ul class="header__list-center">
                <li class="header__list-center-item">
                    <a href="detailClass.php?token=<?=$token?>" class="header__list-center-item-link">Stream</a>
                </li>
                <li class="header__list-center-item">
                    <a href="" class="header__list-center-item-link">Classwork</a>
                </li>
                <li class="header__list-center-item">
                    <a href="people.php?token=<?=$token?>" class="header__list-center-item-link">People</a>
                </li>
            </ul>

            <ul class="header__list-right">
                <li class="header__list-right-item">
                    <img src="https://img.icons8.com/material/24/000000/circled-menu.png" class="header__list-right-item-img">
                </li>
                <li class="header__list-right-item header__list-right-item-name"><?= $fullname_user ?>
                    <div class="header__list-right-item-logout">
                        <a href="logout.php" class="header__list-right-item-name-logout">Log out</a>
                    </div>
                </li>
            </ul>
        </header>
        <?php
        $result = load_data_user_people($token);
        if(!empty($result)){
        ?>
        <div class="app-container-detail">
            <div class="grid">
                <div class="grid__row-detail-member">
                    <div class="app-container-body-detail">
                        <div class="body-detail-students-heading">
                            <h2 class="body-detail-member-title">Teachers</h2>
                            <div class="body-detail-student-quantity">
                                <?php 
                                    if($permission == 0 || $permission == 1){
                                ?>
                                <i class="fas fa-user-plus body-detail-student-icon-add"></i>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="body-detail-separator-classmate">
                        <ul class="body-detail-teachers-list">
                            <?php
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                # code...
                                $permisson = $row['permission'];
                                $people_fullname = $row['hoten'];
                                $count = $count + 1;
                                if ($permisson == 1 || $permisson == 0) {
                                    $count = $count - 1;
                                ?>
                                <li class="body-detail-teachers-item">
                                    <div class="body-detail-teachers-item-name"><?=$people_fullname?></div>
                                    <?php 
                                        if($permission == 0 || $permission == 1){
                                    ?>
                                    <div class="body-detail-teachers-item-icon"><i class="fas fa-user-minus"></i></div>
                                    <?php } ?>
                                </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>

                        <div class="body-detail-students-heading">
                            <h2 class="body-detail-member-title">Classmates</h2>
                            <div class="body-detail-student-quantity">
                                <span class="body-detail-student-quantity-title"><?= $count ?> students</span>
                                <?php 
                                    if($permission == 0 || $permission == 1){
                                ?>
                                <i class="fas fa-user-plus body-detail-student-icon-add"></i>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="body-detail-separator-classmate">
                        <ul class="body-detail-students-list">
                            <?php
                            $result1 = load_data_user_people($token);
                            while ($row = $result1->fetch_assoc()) {
                                $permisson = $row['permission'];
                                $people_fullname = $row['hoten'];
                                if ($permisson == 2) {
                                    # code...
                            ?>
                                        <li class="body-detail-students-item">
                                            <div class="body-detail-students-item-name"><?=$people_fullname?></div>
                                            <?php 
                                                if($permission == 0 || $permission == 1){
                                            ?>
                                            <div class="body-detail-students-item-icon"><i class="fas fa-user-minus"></i></div>
                                            <?php } ?>
                                        </li>
                            <?php
                                }
                            }
        }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $count ?>

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
    <div class="modal__plus modal__add-student">
        <div class="modal__overlay"></div>

        <div class="modal__body">
            <div class="auth-form">
                <div class="auth-form__container">

                    <form action="" method="POST" id="form-add-member">
                        <h3 class="auth-form__heading">ADD MEMBER</h3>

                        <div class="auth-form__form">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter email here">
                                <span class="form-message"></span>
                            </div>
                        </div>

                        <div class="auth-form__controls">
                            <button type="button" class="btn-form-add-class btn-back">Back</button>
                            <button class="btn-form-add-class">Add</button>
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