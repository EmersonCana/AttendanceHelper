<?php
class Database {
	public function conn() {
		$servername = "localhost";
		$username = "root";
		$password = "";

		try {
		    $db = new PDO("mysql:host=$servername;dbname=school_db", $username, $password);
		    // set the PDO error mode to exception
		    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    return $db;
		    }
		catch(PDOException $e)
		    {
		    echo "Connection failed: " . $e->getMessage();
		    }
	}
	
}

?>