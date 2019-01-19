<?php 

class Student extends Database {

	function __construct()
	{
		date_default_timezone_set("Asia/Manila");
	}

	public function studentList($block_id) {
		$get_student_list_stmt = $this->conn()->prepare("SELECT * FROM students WHERE block_id = ?");
		$get_student_list_stmt->execute([$block_id]);
		$get_student_list = $get_student_list_stmt->fetchAll(PDO::FETCH_OBJ);
		$get_student_list_count = $get_student_list_stmt->rowCount();
		if($get_student_list_count < 1) {
			$message = "Nothing to show";
		}
		return $get_student_list;
	}

	public function addStudent($firstname, $middlename, $lastname, $block_id, $grade) {
		$set_new_student_info_stmt = $this->conn()->prepare("INSERT INTO students (first_name, middle_name, last_name, block_id, grade) VALUES (?,?,?,?,?)");
		$set_new_student_info_stmt->execute([$firstname, $middlename, $lastname, $block_id, $grade]);
	}

	public function markAsAbsent($id,$today, $block) {
		$set_absent_status_stmt = $this->conn()->prepare("INSERT INTO reports (student_id, teacher_id,block_id, offense, created_at) VALUES (?,?,?,?,?)");
		$set_absent_status_stmt->execute([$id, $_SESSION['id'],$block, 0, $today]);
	}

	public function deleteAllAbsent($today, $block) {
		$tid = $_SESSION['id'];
		$delete_absent_status_stmt = $this->conn()->prepare("DELETE FROM reports WHERE created_at = ?  AND teacher_id = ? AND block_id = ?");
		$delete_absent_status_stmt->execute([$today, $tid, $block]);
	}

	public function listReport($today, $block) {
		$tid = $_SESSION['id'];
		$get_report_data = $this->conn()->prepare("SELECT students.id, students.first_name, students.middle_name, students.last_name, blocks.block_name, students.grade FROM students, reports, blocks WHERE created_at = ? AND students.id = student_id AND blocks.id = students.block_id AND teacher_id = ? AND students.block_id = ?");
		$get_report_data->execute([$today, $tid, $block]);
		$get_report = $get_report_data->fetchAll(PDO::FETCH_OBJ);

		return $get_report;
	}

	public function getReasons($sid) {
		$get_student_reasons = $this->conn()->prepare("SELECT * FROM final_report WHERE student_id = ?");
		$get_student_reasons->execute([$sid]);
		$get_reasons = $get_student_reasons->fetchAll(PDO::FETCH_OBJ);
		return $get_reasons;
	}

	public function getBlock($block_id) {
		$get_student_block = $this->conn()->prepare("SELECT * FROM blocks WHERE id = ?");
		$get_student_block->execute([$block_id]);
		$get_block = $get_student_block->fetch(PDO::FETCH_OBJ);
		return $get_block;
	}
}
?>