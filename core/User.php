<?php 

include '../core/db.php';

class Auth extends Database
{
	function __construct()
	{
		date_default_timezone_set("Asia/Manila");
	}

	public function loginValidate($email, $password) {
		$check_email_stmt = $this->conn()->prepare('SELECT * FROM users WHERE email = ?');
		$check_email_stmt->execute([$email]);
		$check_email = $check_email_stmt->rowCount();
		if($check_email > 0) {
			$check_password_stmt = $this->conn()->prepare("SELECT * FROM users WHERE password = ?");
			$check_password_stmt->execute([md5($password)]);
			$check_password = $check_password_stmt->rowCount();
			if($check_password > 0) {
				$session_starter_stmt = $this->conn()->prepare('SELECT * FROM users WHERE email = ?');
				$session_starter_stmt->execute([$email]);
				$session_starter = $session_starter_stmt->fetch(PDO::FETCH_OBJ);

				$_SESSION['id'] = $session_starter->id;
				$_SESSION['role'] = $session_starter->role_id;
				$_SESSION['firstname'] = $session_starter->first_name;
				$_SESSION['middlename'] = $session_starter->middle_name;
				$_SESSION['lastname'] = $session_starter->last_name;
				$_SESSION['email'] = $session_starter->email;
				header('Location: ../home.php');
			}else{ 
				header('Location: index.php');
			}
		}else{
			echo "email not found";
		}
	}

	public function userRegistration($firstname, $middlename, $lastname, $email, $password, $repeatpassword) {
		if($password == $repeatpassword) {
			$hashpass = md5($password);
			$today = date("Y-m-d h:i:sa");
			$set_user_registration_stmt = $this->conn()->prepare("INSERT INTO users (role_id, first_name, middle_name, last_name, email, password, created_at) VALUES (2, ?,?,?,?,?,?)");
			$set_user_registration_stmt->execute([$firstname, $middlename, $lastname, $email, $hashpass, $today]);
			$session_starter_stmt = $this->conn()->prepare('SELECT * FROM users WHERE email = ?');

			$session_starter_stmt->execute([$email]);
			$session_starter = $session_starter_stmt->fetch(PDO::FETCH_OBJ);
			$_SESSION['id'] = $session_starter->id;
			$_SESSION['firstname'] = $session_starter->first_name;
			$_SESSION['middlename'] = $session_starter->middle_name;
			$_SESSION['lastname'] = $session_starter->last_name;
			$_SESSION['email'] = $session_starter->email;
			header('Location: ../home.php');
		}
		

	}

	public function logoutValidate() {
		session_destroy();
		header('Location: ../index.php');
	}
}
?>