<?php 
session_start();
include '../core/User.php';

$validate = new Auth;

if(isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$validate->loginValidate($email, $password);
}

if(isset($_POST['register'])) {
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repeatpassword = $_POST['repeat-password'];
	$validate->userRegistration($firstname, $middlename, $lastname, $email, $password, $repeatpassword);
}

if(isset($_POST['logout'])) {
	$validate->logoutValidate();
}

?>