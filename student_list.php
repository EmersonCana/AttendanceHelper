<?php 
include 'core/db.php';
include 'core/Student.php';
include 'core/Absent.php';

$absent_details = new Absent;
$student_list = new Student;

	$block = $_GET['block'];
	$method = $_GET['method'];
	$_SESSION['block_select'] = $block;


	if($method == "Add") {
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$block_id = $_POST['block_id'];
		$grade = $_POST['grade'];
		$student_list->addStudent($firstname, $middlename, $lastname, $block_id, $grade);
	}
		
	if($method == "AbsenteeList") {

		foreach($student_list->studentList($block) as $list) {
			echo 
			'
			<tr id="student_'.$list->id.'">	
				<th scope="row">'.$list->first_name.' '.$list->middle_name.' '.$list->last_name.'</th>
				<td>'.$student_list->getBlock($list->block_id)->block_name.'</td>
			    <td>'.$list->grade.'</td>
			    <td><a href="#" id="submit_absent_'.$list->id.'" class="btn btn-danger btn-sm">Absent</a></td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#submit_absent_'.$list->id.'").click(function() {
					$.ajax("validation/submit_report.php?student_id='.$list->id.'&action=MarkAbsent", {
					    type: "POST",
					    data: {
					    	"date" : $("#time").val(),
					    	"block" : $("#block").val(), 
					    },
					    success: function (data) {
					        $("#absentee_list").html(data);
					    },
					    error : function(xhr, status,error) {
                        alert(xhr.responseText);
					    }
					});
				});
			});
				
			</script>
			'
			;
		}
	}else{
		foreach($student_list->studentList($block) as $list) {
			echo 
			'
			<tr>	
				<th scope="row"><a href="#" id="student-'.$list->id.'-profile" data-toggle="modal" data-target="#profile-'.$list->id.'-modal">'.$list->first_name.' '.$list->middle_name.' '.$list->last_name.'</a></th>
				<td>'.$student_list->getBlock($list->block_id)->block_name.'</td>
			    <td>'.$list->grade.'</td>
			    <td>

			    Edit | Delete </td>
			    <td style="display:none;">
					'.include("assets/fragments/modals/student_profile_modal.php");

					echo '
			    </td>
			</tr>'
			;

		}
	}




?>