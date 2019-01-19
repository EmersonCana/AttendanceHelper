<?php 

class Admin extends Database {
	function __construct()
	{
		date_default_timezone_set("Asia/Manila");
	}

	public function listReports() {
		$get_teacher_reports = $this->conn()->prepare("SELECT DISTINCT users.first_name, users.middle_name, users.last_name, final_report.time_out, final_report.teacher_id, final_report.block_id, blocks.block_name, final_report.report_id FROM users, final_report, blocks WHERE users.id = final_report.teacher_id AND blocks.id = final_report.block_id ORDER BY final_report.id DESC");
		$get_teacher_reports->execute();
		$get_reports = $get_teacher_reports->fetchAll(PDO::FETCH_OBJ);
		return $get_reports;
	}

	public function listMyReports() {
		$get_teacher_reports = $this->conn()->prepare("SELECT DISTINCT users.first_name, users.middle_name, users.last_name, final_report.time_out, final_report.teacher_id, final_report.block_id, blocks.block_name, final_report.report_id FROM users, final_report, blocks WHERE users.id = final_report.teacher_id AND blocks.id = final_report.block_id AND final_report.teacher_id = ? ORDER BY final_report.id DESC");
		$get_teacher_reports->execute([$_SESSION['id']]);
		$get_reports = $get_teacher_reports->fetchAll(PDO::FETCH_OBJ);
		return $get_reports;
	}

	public function showReport($date, $teacher_id, $block) {
		$get_report_details = $this->conn()->prepare("SELECT students.first_name, students.middle_name, students.last_name, students.grade, blocks.block_name, final_report.remark, final_report.student_id, final_report.report_id FROM students, final_report, blocks WHERE final_report.block_id = blocks.id AND students.id = final_report.student_id AND final_report.teacher_id = ? AND final_report.time_out = ? AND final_report.block_id = ?");
		$get_report_details->execute([$teacher_id, $date, $block]);
		$get_details = $get_report_details->fetchAll(PDO::FETCH_OBJ);
		return $get_details;
	}
}
?> 