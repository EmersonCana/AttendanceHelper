<?php 

class Absent extends Database {
	function __construct()
	{
		date_default_timezone_set("Asia/Manila");
	}

	public function transactionStart() {
		$set_new_transaction = $this->conn()->prepare("INSERT INTO report_tracker (teacher_id) VALUES (?)");
		$set_new_transaction->execute([0]);
		$get_transaction_id = $this->conn()->prepare("SELECT * FROM report_tracker ORDER BY id DESC");
		$get_transaction_id->execute();
		$get_id = $get_transaction_id->fetch(PDO::FETCH_OBJ);
		return $get_id;
	}
	public function submitToAdmin($teacher, $date, $block, $rid) {
		$select_student_details = $this->conn()->prepare("SELECT * FROM reports WHERE teacher_id = ? AND created_at = ? AND block_id = ?");
		$select_student_details->execute([$teacher, $date, $block]);
		$select_student = $select_student_details->fetchAll(PDO::FETCH_OBJ);
		foreach($select_student as $student) {
			$send_report_stmt = $this->conn()->prepare("INSERT INTO final_report (report_id, student_id, teacher_id, block_id, offense, is_read, remark, time_out) VALUES (?,?,?,?,?,?,?,?)");
			$send_report_stmt->execute([$rid, $student->student_id, $student->teacher_id, $block, $student->offense, 0, "", $student->created_at]);
		}
		$delete_fragments = $this->conn()->prepare("DELETE FROM reports WHERE teacher_id = ? AND created_at = ?");
		$delete_fragments->execute([$teacher, $date]);
	}

	public function updateRemark($remark, $student_id, $rid) { 
		$update_student_remark = $this->conn()->prepare("UPDATE final_report SET remark = ? WHERE student_id = ? AND report_id = ?");
		$update_student_remark->execute([$remark, $student_id, $rid]);
	}

	public function countAbsentsOfOne($sid) {
		$get_absent_count = $this->conn()->prepare("SELECT * FROM final_report WHERE student_id = ?");
		$get_absent_count->execute([$sid]);
		$get_count = $get_absent_count->rowCount();
		return $get_count;
	}
}
?>