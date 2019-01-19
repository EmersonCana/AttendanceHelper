<?php 
session_start();
include 'core/db.php'; 

class Redirect {
	public function sessionRedirect() {
		if(isset($_SESSION['email'])) {
			header('Location: home.php');
		}
	}

	public function restrictAccess() {
		if(!isset($_SESSION['email'])) {
			header('Location: index.php');
		}
	}

	public function registrarOnly() {
		if(!$_SESSION['role'] == 2) {
			header('Location: home.php');
		}
	}
}

?>