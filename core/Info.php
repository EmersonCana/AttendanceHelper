<?php 

/**
* 
*/
class Information extends Database
{
	function __construct()
	{
		date_default_timezone_set("Asia/Manila");
	}

	public function listBlocks() {
		$get_block_list_stmt = $this->conn()->prepare("SELECT * FROM blocks");
		$get_block_list_stmt->execute();
		$get_block_list = $get_block_list_stmt->fetchAll(PDO::FETCH_OBJ);

		return $get_block_list;
	}

	public function addBlock($block_name, $grade) {
		$set_new_block_stmt = $this->conn()->prepare("INSERT INTO blocks (block_name, grade) VALUES (?,?)");
		$set_new_block_stmt->execute([$block_name, $grade]);
	}
}
?>