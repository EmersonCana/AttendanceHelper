<?php 
session_start();
include '../core/db.php';
include '../core/Admin.php';

$admin = new Admin;

$block = $_POST['block'];
$teacher_id = $_POST['teacher_id'];
$date = $_POST['date'];
echo
'
<thead>
<tr>
  <th scope="col">Full Name</th>
  <th scope="col">Block</th>
  <th scope="col">Grade</th>
  <th scope="col">Remarks</th>

</tr>
</thead>
<tbody>
';
foreach($admin->showReport($date, $teacher_id, $block) as $list) {
    echo '
    <tr>
      <td>'.$list->first_name.' '.$list->last_name.'</td>
      <td>'.$list->block_name.'</td>
      <td>'.$list->grade.'</td>
      <td>';
      if(!$list->remark == "") {
      	echo '
      			<span id="remark-'.$list->report_id.'-'.$list->student_id.'">'.$list->remark.'</span>
      		';
     	if($_SESSION['role'] == 2) {

     		echo '
      			<input type="text" id="remark-editor-'.$list->report_id.'-'.$list->student_id.'" class="form-control-sm">
				<script>
					$(document).ready(function() {
						$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").hide();
						$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").val($("#remark-'.$list->report_id.'-'.$list->student_id.'").text());
						$("#remark-'.$list->report_id.'-'.$list->student_id.'").click(function() {
							$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").show();
							$("#remark-'.$list->report_id.'-'.$list->student_id.'").hide();
							$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").focus();
			      		});
			      		$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").blur(function() {
						$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").hide();
						$("#remark-'.$list->report_id.'-'.$list->student_id.'").show();
						});
						$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").keyup(function() {
							if(event.keyCode == 13) {
								if($("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").val() == 00) {
									$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").addClass("is-invalid");
								}else{
									$.ajax("validation/submit_absentee_validate.php?action=UpdateRemark", {
									    type: "POST",
									    data: {
									    	"remark" : $("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").val(),
									    	"student_id" : '.$list->student_id.',
									    	"rid" : '.$list->report_id.',
									    },
									    success: function (data) {
									        $("#remark-'.$list->report_id.'-'.$list->student_id.'").text($("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").val());
									        $("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").hide()
									    },
									    error: function () {
									    	$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").addClass("is-invalid");
									    }
									});
								}
							}
						});
					});
				</script>
      	';
      	}
      }else{
      	if($_SESSION['role'] == 2) {
      	echo '
      		<div id="remark-'.$list->report_id.'-'.$list->student_id.'">
      			<input type="text" id="remark-editor-'.$list->report_id.'-'.$list->student_id.'" class="form-control-sm">
      			<a href="#" id="edit-remark-'.$list->report_id.'-'.$list->student_id.'" class="btn btn-danger btn-sm">Add Remark</a>
			</div>
			<script>
		      	$(document).ready(function() {
		      		$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").hide();
		      		$("#edit-remark-'.$list->report_id.'-'.$list->student_id.'").click(function() {
						$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").show();
						$("#edit-remark-'.$list->report_id.'-'.$list->student_id.'").hide();
						$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").focus();
		      		});
		      		$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").blur(function() {
						$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").hide();
						$("#edit-remark-'.$list->report_id.'-'.$list->student_id.'").show();
					});
					$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").keyup(function() {
						if(event.keyCode == 13) {
							if($("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").val() == 00) {
								$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").addClass("is-invalid");
							}else{
								$.ajax("validation/submit_absentee_validate.php?action=UpdateRemark", {
								    type: "POST",
								    data: {
								    	"remark" : $("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").val(),
								    	"student_id" : '.$list->student_id.',
								    	"rid" : '.$list->report_id.',
								    },
								    success: function (data) {
								        $("#remark-'.$list->report_id.'-'.$list->student_id.'").text($("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").val());
								        $("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").hide()
								    },
								    error: function () {
								    	$("#remark-editor-'.$list->report_id.'-'.$list->student_id.'").addClass("is-invalid");
								    }
								});
							}
						}
					});
		      	});
	      	</script>
      		';
      	}
      }
      echo '
      	
      </td>
    </tr>
    ';
}
echo
'
</tbody>
';
?>