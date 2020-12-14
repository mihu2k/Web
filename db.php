<?php 
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';

	define('HOST', '127.0.0.1');
	define('USER', 'root');
	define('PASS', '');
	define('DB', 'web');

	function open_db(){
		$conn = new mysqli(HOST, USER, PASS, DB);
		if($conn->connect_error){
			die('Connect errorccccccccccc: '.$conn->connect_error);
		}
		return $conn;
	}

	function login($username, $password){
		$sql = "select * from user where username = ?";
		$conn = open_db();

		$stm = $conn->prepare($sql);
		$stm->bind_param('s', $username);

		if(!$stm->execute()){
			return null;
		}

		$result =  $stm->get_result();
		if ($result->num_rows == 0) {
			return null;
		}
		$data = $result->fetch_assoc();

		$hashed_password = $data['password'];
		if(!password_verify("$password", "$hashed_password")){
			return null;
		}
		else return $data;
	}

	function is_email_exists($email){
		$sql = 'select username from user where email = ?';
		$conn = open_db();

		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$email);

		if(!$stm->execute()){
			die ('Error: '.$stm->error);
		}

		$result = $stm->get_result();
		if($result->num_rows > 0){
			return true;
		}
		else return false;
	}

	function is_username_exists($username){
		$sql = 'select username from user where username = ?';
		$conn = open_db();

		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$username);

		if(!$stm->execute()){
			die ('Error: '.$stm->error);
		}

		$result = $stm->get_result();
		if($result->num_rows > 0){
			return true;
		}
		else return false;
	}

	function signUp($username, $password, $fullname, $dateofbirth, $email, $phone){
		if(is_email_exists($email)){
			return array('code' => 1, 'error' => 'Email exists');
		}

		if(is_username_exists($username)){
			return array('code' => 3, 'error' => 'Username exists');
		}

		$permission = 2;
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$rand = random_int(0, 1000);
		$token = md5($username.'+'.$rand);
		$sql = 'INSERT INTO user(username, password, hoten, ngaysinh, email, sdt, token, permission) VALUES (?,?,?,?,?,?,?,?)';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('sssssssi',$username, $hash, $fullname, $dateofbirth, $email, $phone, $token, $permission);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant Execute');
		}

		return array('code' => 0, 'error' => 'Succesful');
	}

	function send_reset_email($email, $token){
		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		    $mail->isSMTP();                                            // Send using SMTP
		    $mail->CharSet = 'UTF-8';
		    $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
		    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
		    $mail->Username = 'nhh3103@gmail.com';                     // SMTP username
		    $mail->Password = 'gekduagjlanoemwv';                             // SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom('nhh3103@gmail.com', 'Admin');
		    $mail->addAddress($email, 'Người nhận');     // Add a recipient
		    /*$mail->addAddress('ellen@example.com');               // Name is optional
		    $mail->addReplyTo('info@example.com', 'Information');
		    $mail->addCC('cc@example.com');
		    $mail->addBCC('bcc@example.com');*/

		    // Attachments
		   /* $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');*/    // Optional name

		    // Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Recovery your password';
		    $mail->Body    = "Click <a href ='reset_password.php?email=$email&token=$token'>here</a> to recover your password'";
		    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    return true;
		} catch (Exception $e) {
		    return false;
		}
	}

	
	function reset_password($email){
		if(!is_email_exists($email)){
			return array('code' => 1, 'error' => 'Email doesnt exists in database');
		}

		$exp = time() + 3600 *24; //hết hạn sau 24h
		$token = md5($email.'+'.random_int(1000,2000));
		$sql = 'update reset_token set token = ?, expire_on = ? where email = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('sis',$token, $exp ,$email);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant execute statement 1');
		}

		if($stm->affected_rows == 0){
			
			$sql = 'insert into reset_token values (?,?,?)';
			$stm = $conn->prepare($sql);
			$stm->bind_param('ssi', $email, $token ,$exp);

			if(!$stm->execute()){
				return array('code' => 2, 'error' => 'Cant execute statement 2');
			}
		}
		
		$success = send_reset_email($email, $token);
		return array('code' => 0, 'success' => $success);
	}

	function update_new_password($email, $password){
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = 'update user set password = ? where email = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ss',$hash,$email);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant Execute');
		}

		return array('code' => 0, 'error' => 'Password is changed successfully');
	}

	function add_class($classname, $subject, $classroom, $email, $chooseImage){

		$date_create = (date("d-m-Y",time())); //Ngày tạo class
		$token = md5($classname.'+'.$email.'+'.random_int(1000,3000)); //Tạo mã code class

		$sql = 'INSERT INTO classroom(classname, subject, room, email, img, date_create, token) VALUES (?, ?, ?, ?, ?, ?, ?)';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('sssssss',$classname, $subject, $classroom, $email, $chooseImage, $date_create, $token);

		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Cant Execute');
		}

		$join_class = join_class($email, $token); // Thêm người tạo vào table user_classroom

		return array('code' => 0, 'error' => 'Add class successfully');
	}

	function join_class($email, $token){
		$sql = 'select * from classroom where token = ?'; //Kiem tra classcode|token
		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('s', $token);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant execute statement');
		}

		if($stm->affected_rows != 0){
			$sql = 'INSERT INTO user_classroom(email, token) VALUES (?,?)';
			$conn = open_db();
			$stm = $conn->prepare($sql);
			$stm->bind_param('ss', $email, $token);

			if(!$stm->execute()){
				return array('code' => 3, 'error' => 'Cant execute statement insert');
			}
			return array('code' => 0, 'msg' => 'Join class successfully');
		}
		else{
			return array('code' => 1, 'error' => 'Dont find any classes');
		}
		
	}
	//Lay permission user theo email
	function get_permission($email){
		$sql = 'SELECT * FROM user WHERE email =?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$email);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant execute statement');
		}

		$result =  $stm->get_result();
		if ($result->num_rows == 0) {
			return null;
		}
		$data = $result->fetch_assoc();
		return $data['permission'];
	}

	//Lay fullname user theo email
	function get_fullname($email){
		$sql = 'SELECT * FROM user WHERE email =?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$email);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant execute statement');
		}

		$result =  $stm->get_result();
		if ($result->num_rows == 0) {
			return null;
		}
		$data = $result->fetch_assoc();
		return $data['hoten'];
	}

	function load_data_home($email, $permission){
		/* 
			if permmission == 0 => load all data table classroom
			if permision == 1 -> load data table classroom where emmail = email.user
			if permission = 2 => load data table classroom where token in (select token from user_classroom where email = emmail.user)
		*/
		$conn = open_db();

		if($permission == 0){
			$sql = 'select * from classroom';
			$result = $conn->query($sql);
			return $result;
		}
		else if($permission == 1){
			//Lấy lớp học của giáo viên tạo
			$sql = 'select * from classroom where email = ? or token in (select token from user_classroom where email = ?)';
			$stm = $conn->prepare($sql);
			$stm->bind_param('ss',$email,$email);

			if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant execute statement');
			}

			$result =  $stm->get_result();
			return $result;
			}

		else if($permission == 2){
			$sql = 'select * from classroom where token in (select token from user_classroom where email = ?)';
			$stm = $conn->prepare($sql);
			$stm->bind_param('s',$email);

			if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant execute statement');
			}

			$result =  $stm->get_result();
			return $result;
		}
		
	}

	function load_data_user_people($token){
		$sql = 'select * from user where email in (select email from user_classroom where token = ?)';
		
		$conn = open_db();
		$stm = $conn->prepare($sql);
		if($stm == false){
			return array('code' => 1, 'error' => 'fail');
		}
		$stm->bind_param('s',$token);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant execute statement');
		}
		$result =  $stm->get_result();
			return $result;

	}

	//Lay thong tin lop hoc theo token
	function get_detail_class($token){
		$sql = 'select * from classroom where token = ?';
		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$token);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant execute statement');
		}

		$result =  $stm->get_result();
		$data = $result->fetch_assoc();
		return $data;
	}

	function delete_class($token){
		/* 
			if permmission == 0 => delete all data table classroom and user_classroom
			if permision == 1 -> delete all data table classroom and user_classroom emmail = email.teacher
			if permission = 2 => delete all data table user_classroom where token = token.classroom
		*/
		//Xóa luôn trong table user_classroom
	    $sql = 'delete from classroom where token = ?';
	    $conn = open_db();
	    $stm = $conn -> prepare($sql);
	    $stm -> bind_param('s',$token);
	    if($stm -> execute()){
	    	$sql1 = 'delete from user_classroom where token = ?';
	    	$conn = open_db();
	    	$stm1 = $conn -> prepare($sql1);
	    	$stm1 -> bind_param('s',$token);
	    	if($stm1 -> execute()){
	    		return true;
	    	}
	       	else{
	       		return false;
	       	}
        }
	    else{
	        return false;
        }
    }
    
    function modify_class($classname, $subject, $classroom, $token, $chooseImage){
	    $sql = "update classroom set classname = ?,subject= ?,room=?,img=? where token = ?";
	    $conn = open_db();
	    $stm = $conn->prepare($sql);
	    $stm -> bind_param('sssss',$classname,  $subject,  $classroom, $chooseImage, $token);
	    if($stm -> execute()){
	        return true;
	    }
	    else{
	        return false;
	    }
	}

function create_news($title,$user_email,$conent,$file,$type,$token){

	$permission = get_permission($user_email);

    if($permission != 0 && $permission != 1){
        return ['error' => 1];
    }
    else if($permission == 0 || $permission == 1){
        $sql = 'INSERT INTO news (title,user_email,content,file,type, token) VALUES (?, ?, ?, ?, ?, ?)';
        $conn = open_db();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssssis',$title,$user_email,$conent,$file,$type,$token);
        if(!$stm->execute()){
            return array('code' => 1, 'error' => 'Cant Execute');
        }
        return array('code' => 0, 'error' => 'Add class successfully');
    }
    return false;
}

function removed_news($id){
    $sql = 'delete from news where id = ?';
    $conn = open_db();
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('s',$id);
    if($stm -> execute()){
        return true;
    }
    else{
        return false;
    }
}

function update_news($id,$title,$email,$content,$file,$type){

    $news = getNewsById($id);

    if($news['user_email'] != $email){
        return array('code' => 1, 'error' => 'Cant updated.Access denied.');
    }else{

        $conn = open_db();

        if($news['file'] != $file && $file != "" ){
            $sql = 'update news set title=?,content=?,file=?,type=?  where id = ?';
            $stm = $conn->prepare($sql);
            $stm->bind_param('sssii',$title,$content,$file,$type,$id);
            if(!$stm->execute()){
                return array('code' => 1, 'error' =>  "Cant updated.1");
            }
        }else{
            $sql = 'update news set title=?,content=?,type=?  where id = ?';
            $stm = $conn->prepare($sql);
            $stm->bind_param('ssii',$title,$content,$type,$id);
            if(!$stm->execute()){
                return array('code' => 1, 'error' =>  $title );
            }
        }

    }
    return array('code' => 0, 'error' => 'Update successfully');
}
function getNewsByToken($token){
    if($token){
        $conn = open_db();
        $sql = "select * from news where token = '$token' order by date_created DESC";
		$result = $conn->query($sql);
		$rows = [];
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}

        return $rows;
    }else{
        return [];
    }
}

function getNameUserByEmail($email){

    $sql = "select hoten from user where email = ?";
    $conn = open_db();

    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $email);

    if(!$stm->execute()){
        return null;
    }

    $result =  $stm->get_result();
    if ($result->num_rows == 0) {
        return null;
    }
    $data = $result->fetch_assoc();
    return $data['hoten'];
}
function getNewsById($id){
    $sql = "select * from news where id = ?";
    $conn = open_db();

    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $id);
    if(!$stm->execute()){
        return null;
    }

    $result =  $stm->get_result();
    if ($result->num_rows == 0) {
        return null;
    }
    $data = $result->fetch_assoc();
    return $data;
}



function postComment($post_id, $content, $email){
    $sql = 'INSERT INTO comment (post_id,content,email) VALUES (?, ?, ?)';
    $conn = open_db();
    $stm = $conn->prepare($sql);
    $stm->bind_param('iss',$post_id, $content, $email);
    if(!$stm->execute()){
        return array('code' => 1, 'error' => 'Cant Execute');
    }
    $result = $conn->query('SELECT * FROM `comment` ORDER BY date_created DESC LIMIT 1');
    return $result->fetch_assoc();
}

function deleteComment($comment_id){
    $conn = open_db();
    $sql = "DELETE FROM comment WHERE id=$comment_id";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function getCommentsByPostId($id){
    $conn = open_db();
	$sql = "select * from comment where post_id = '$id'";
	$result = $conn->query($sql);
	$rows = [];
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}

	return $rows;
}


//
function isExistUserClassroom($email, $token){
    $sql = "select * from user_classroom where email = '$email' AND token = '$token'";
    $conn = open_db();
    $result = $conn->query($sql);
    if(empty($result->fetch_assoc())){
        return false;
    }
    else{
        return true;
    }
}

function addMemberClassroom($email, $token){
    $sql = "insert into user_classroom (email, token, status) values ('$email', '$token', 'confirm') ";
    $conn = open_db();
    $result = $conn->query($sql);
    if($result == true){
        return true;
    }
    else{
        return false;
    }
}

function confirmJoinClass($email, $token){
    $sql = "update user_classroom set status = 'active' where email = '$email' and token ='$token'";
    $conn = open_db();
    $result = $conn->query($sql);
    if($result == true){
        return true;
    }
    else{
        return false;
    }
}
function sendMailConfirmJoinClass($email, $token){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'nhh3103@gmail.com';                     // SMTP username
        $mail->Password = 'gekduagjlanoemwv';                             // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('nhh3103@gmail.com', 'Admin');
        $mail->addAddress($email, 'Người nhận');     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Confirm join class';
        $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        $mail->Body    = "Click <a href ='$root/Project_web/confirmJoinClass.php?email=$email&token=$token'>here</a> to confirm";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function removeUserClassroom($email, $token){
    $sql = "delete from user_classroom where email = '$email' and token ='$token'";
    $conn = open_db();
    $result = $conn->query($sql);
    if($result == true){
        return true;
    }
    else{
        return false;
    }
}




 ?>