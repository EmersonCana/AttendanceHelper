<?php 
session_start();
include '../core/db.php';
include '../core/Student.php';
include '../core/Absent.php';

$absent_details = new Absent;
$student_list = new Student;

if($_GET['action'] == "MarkAbsent") {
	$block = $_POST['block'];
	$sid = $_GET['student_id'];
	$today = $_POST['date'];
	$student_list->markAsAbsent($sid, $today, $block);
	foreach($student_list->listReport($today, $block) as $list) {
		echo '
				<tr>	
					<th scope="row">'.$list->first_name.' '.$list->middle_name.' '.$list->last_name.'</th>
					<td>'.$list->block_name.'</td>
				    <td>'.$list->grade.'</td>
				    <td>'.$absent_details->countAbsentsOfOne($list->id).'</td>
				    <td><a href="#" id="remove_'.$list->id.'">&times;</a></td>
				</tr>
		';
	}
}

if($_GET['action'] == "ShowAbsenteeList") {
	$block = $_POST['block'];
	$today = $_POST['date'];
	foreach($student_list->listReport($today, $block) as $list) {
		echo '
				<tr>	
					<th scope="row">'.$list->first_name.' '.$list->middle_name.' '.$list->last_name.'</th>
					<td>'.$list->block_name.'</td>
				    <td>'.$list->grade.'</td>
				    <td><a href="#" id="remove_'.$list->id.'">&times;</a></td>
				</tr>
		';
	}
}
?>