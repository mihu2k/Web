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
    <title>Assignment</title>
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
                <li class="header__list-left-item header__list-left-item-inf">
                    <h4 class="header__list-left-class">HK1_2020_503040_Phân tích và thiết kế giải thuật_N02_1</h4>
                    <h5 class="header__list-left-teacher-name">Trịnh Hùng Cường</h5>
                </li>
            </ul>

            <ul class="header__list-center">
                <li class="header__list-center-item">
                    <a href="detailClass.html" class="header__list-center-item-link">Stream</a>
                </li>
                <li class="header__list-center-item">
                    <a href="" class="header__list-center-item-link">Classwork</a>
                </li>
                <li class="header__list-center-item">
                    <a href="people.html" class="header__list-center-item-link">People</a>
                </li>
            </ul>

            <ul class="header__list-right">
                <li class="header__list-right-item">
                    <img src="https://img.icons8.com/material/24/000000/circled-menu.png" class="header__list-right-item-img">
                </li>
                <li class="header__list-right-item header__list-right-item-name">Trương Minh Hưng
                    <div class="header__list-right-item-logout">
                        <a href="logout.php" class="header__list-right-item-name-logout">Log out</a>
                    </div>
                </li>
            </ul>
        </header>

        <!-- Body -->
        <div class="app-container-detail">
            <div class="grid grid__row-assignment">
                <div class="grid__row-assignment-body">
                    <div class="grid__row-assignment-left">
                        <div class="grid__row-assignment-left-header">
                            <h1 class="grid__row-assignment-left-heading">Final Project</h1>
                            <div class="grid__row-assignment-left-icon">
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                        </div>

                        <div class="grid__row-assignment-left-name">Huỳnh Ngọc Tú - 
                            <span class="grid__row-assignment-left-timepost">Nov 19</span>
                        </div>

                        <div class="grid__row-assignment-left-pointDue">
                            <div class="grid__row-assignment-left-due">Due 2/12/2020, 11:59 PM</div>
                        </div>

                        <div class="grid__row-assignment-left-content">Các bạn nộp project cuối kỳ vào đây.</div>
                    </div>

                    <div class="grid__row-assignment-right">
                        <div class="form-submit-file-assignment">
                            <div class="form-submit-file-assignment-container">
                                <div class="form-submit-file-assignment-header">
                                    <h3 class="form-submit-file-assignment-heading">Your work</h3>
                                    <h5 class="form-submit-file-assignment-state">Assigned</h5>
                                </div>

                                <div class="form-submit-file-assignment-addFolder">
                                    <div class="form-submit-file-assignment-addFolder-icon">
                                        <i class="fas fa-file"></i>
                                    </div>
                                    <div class="form-submit-file-assignment-addFolder-text">Add or create</div>
                                </div>

                                <button class="form-submit-file-assignment-btnSubmit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                <li class="modal-list-class-body-item">
                    <h4 class="modal-list-class-body-item-class">HK1_2020_503040_Phân tích và thiết kế giải thuật_N02_1</h4>
                    <h5 class="modal-list-class-body-item-name">Trịnh Hùng Cường</h5>
                </li>
                <li class="modal-list-class-body-item">
                    <h4 class="modal-list-class-body-item-class">HK1_2020_503040_Phân tích và thiết kế giải thuật_N02_1</h4>
                    <h5 class="modal-list-class-body-item-name">Trịnh Hùng Cường</h5>
                </li>
            </ul>
            
        </div>
    </div>
    
    <div class="modal__list"> </div>

    <script src="main.js"></script>
</body>
</html>