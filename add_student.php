<?php
include 'assets/fragments/header.php'; 
include 'core/Redirect.php';
include 'core/Student.php';
include 'core/Info.php';
$redirect = new Redirect;
$student_list = new Student;
$get_info = new Information;

$redirect->restrictAccess();

if(isset($_POST['add_student'])) {

}

?>
	<div class="container">
		<!--- Bootstrap Default Navbar ---->
		<?php include 'assets/fragments/navbar.php'; ?>
		<!--- Bootstrap Default Navbar ---->
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-6">
						<div class="text-center">
							<span class="h5">Block List</span>
							<hr />	
							<select name="block" id="block" class="form-control">
								<option>---Please Select Block---</option>
								<?php foreach($get_info->listBlocks() as $block) {
									echo '<option value="'.$block->id.'">'.$block->block_name.'</option>';
								} ?>
								
							</select>	
						</div>
						<table class="table table-sm small">
						  <thead>
						    <tr>
						      <th scope="col">Student Name</th>
						      <th scope="col">Block</th>
						      <th scope="col">Grade</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody id="students_by_block">
						    
						  </tbody>
						</table>
						
					</div>
					<div class="col-6">
						<div class="text-center">
							<span class="h5">Add Block</span>
							<hr />
							
						</div>
						<div class="row">
							<div class="col-10">
								<label for="new_block_name" class="small">Block Name:</label>
								<input type="text" id="new_block_name" name="new_block_name" class="form-control form-control-sm">
							</div>
							<div class="col-2">
								<label for="grade" class="small">Grade:</label>
								<select id="grade" name="grade" class="form-control form-control-sm">
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
							</div>
						</div>
						<div class="mt-2 text-right">
							<a href="#" id="add_block" class="d-block btn btn-primary btn-sm">Submit</a>
						</div>
						<br /><hr />
						<div class="text-center">
							<span class="h5">Add Student Form</span>
							<hr />
							
						</div>
						
							<div class="row text-center mb-1">
								<div class="col-3">
									<label for="first_name" class="small">First Name:</label>
								</div>
								<div class="col-6">
									<input type="text" id="first_name" name="first_name" class="form-control form-control-sm">
								</div>
							</div>
							<div class="row text-center mb-1">
								<div class="col-3">
									<label for="middle_name" class="small">Middle Name:</label>
								</div>
								<div class="col-6">
									<input type="text" id="middle_name" name="middle_name" class="form-control form-control-sm">
								</div>
							</div>
							<div class="row text-center mb-1">
								<div class="col-3">
									<label for="last_name" class="small">Last Name:</label>
								</div>
								<div class="col-6">
									<input type="text" id="last_name" name="last_name" class="form-control form-control-sm">
								</div>
							</div>	
							<div class="row text-center mb-1">
								<div class="col-3 mt-1">
									<label for="block" class="small">Block:</label>
								</div>
								<div class="col-6 small">
									<input type="text" readonly id="block_static" name="block" class="form-control-plaintext">
								</div>
							</div>	
							<div class="row text-center">
								<div class="col-12">
									<button name="add_student" id="add_student" class="btn btn-outline-primary">Submit</button>
								</div>
								
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#block').change(function() {
				$('#block_static').val($('#block').val());
				$.ajax('student_list.php?block='+$('#block').val()+'&method=List', {
				    type: 'GET',
				    success: function (data) {
				        $('#students_by_block').html(data);
				    },
				    error: function () {
				    	console.log('error');
				    }
				});
			});

			$('#add_block').click(function() {
				$.ajax('validation/add_block.php', {
				    type: 'POST',
				    data: {
				    	'block' : $('#new_block_name').val(),
				    	'grade' : $('#grade').val(),
				    },
				    success: function (data) {
				        $('#block').html(data);
				        $('#new_block_name').val('');
				    },
				    error: function () {
				    	console.log('error');
				    }
				});
			});

			$('#add_student').click(function() {
				$.ajax('student_list.php?block='+$('#block').val()+'&method=Add', {
				    type: 'POST',
				    data: {
				    	'firstname' : $('#first_name').val(),
				    	'middlename' : $('#middle_name').val(),
				    	'lastname' : $('#last_name').val(),
				    	'block_id' : $('#block').val(),
				    	'grade' : 11,
				    },
				    success: function (data) {
				        $('#students_by_block').html(data);
				        $('#first_name').val('');
				        $('#middle_name').val('');
				        $('#last_name').val('');
				        $('#first_name').focus();
				    },
				    error: function () {
				    	console.log('error');
				    }
				});
			});
		});
	</script>
<?php include 'assets/fragments/footer.php'; ?>