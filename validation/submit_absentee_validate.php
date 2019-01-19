<?php
session_start();
include '../core/db.php';
include '../core/Student.php';
include '../core/Absent.php';

$submit_absent = new Absent;
$student_list = new Student;
$block = $_POST['block'];
if($_GET['action'] == "ClearAbsenteeList") {
	$today = $_POST['date'];
	$student_list->deleteAllAbsent($today, $block);
	foreach($student_list->listReport($today,$block) as $list) {
		echo '
				<tr>	
					<th scope="row">'.$list->first_name.' '.$list->middle_name.' '.$list->last_name.'</th>
					<td>'.$list->block_name.'</td>
				    <td>'.$list->grade.'</td>
				    <td>'.$submit_absent->countAbsentsOfOne($list->id).'</td>
				    <td><a href="#" id="remove_'.$list->id.'">&times;</a></td>
				</tr>
		';
	}
}

if($_GET['action'] == "SubmitAbsenteeList") {
	$rid = $_POST['rid'];
	$teacher = $_POST['teacher_id'];
	$date = $_POST['date'];
	$submit_absent->submitToAdmin($teacher, $date, $block, $rid);
}

if($_GET['action'] == "UpdateRemark") {
	$remark = $_POST['remark'];
	$student_id = $_POST['student_id'];
	$rid = $_POST['rid'];
	$submit_absent->updateRemark($remark, $student_id, $rid);
}
?>