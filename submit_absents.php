<?php
include 'assets/fragments/header.php'; 
include 'core/Redirect.php';
include 'core/Info.php';
include 'core/Absent.php';
$redirect = new Redirect;
$get_info = new Information;
$get_transaction_id = new Absent;

$redirect->restrictAccess();
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
							<span class="h5">Absentee List</span>
							<hr />	
						</div>
						<table class="table table-sm small">
						  <thead>
						    <tr>
						      <th scope="col">Student Name</th>
						      <th scope="col">Block</th>
						      <th scope="col">Grade</th>
						      <th scope="col">Absents</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody id="absentee_list">
						  </tbody>
						</table>
						<div class="text-right">
							<a href="#" id="submit-absentee-list" class="btn btn-outline-primary">Submit</a>
							<a href="#" id="clear-absentee-list" class="btn btn-outline-danger">Clear</a>
							<?php include 'assets/fragments/modals/submit_success_modal.php'; ?>
						</div>
						
					</div>
					<div class="col-6">
						<div class="text-center">
							<span class="h5">Student List</span>
							<hr />
							<label for="time" class="small">Time:</label>
							<select name="time" id="time" class="form-control">
								<option>---Please Select Time---</option>
								<option value="<?php echo date("Y-m-d 8:00:00"); ?>">8:00</option>
								<option value="<?php echo date("Y-m-d 8:55:00"); ?>">8:55</option>
								<option value="<?php echo date("Y-m-d 9:50:00"); ?>">9:50</option>
								<option value="<?php echo date("Y-m-d 10:45:00"); ?>">10:45</option>
								<option value="<?php echo date("Y-m-d 11:40:00"); ?>">11:40</option>
								<option value="<?php echo date("Y-m-d 12:35:00"); ?>">12:35</option>
								<option value="<?php echo date("Y-m-d 13:30:00"); ?>">1:30</option>
								<option value="<?php echo date("Y-m-d 14:25:00"); ?>">2:25</option>
								<option value="<?php echo date("Y-m-d 15:20:00"); ?>">3:20</option>
								<option value="<?php echo date("Y-m-d 16:15:00"); ?>">4:15</option>
							</select>
							<br />
							<select name="block" id="block" class="form-control">
								<?php if(!isset($_SESSION['block_select'])) {
									echo '<option>---Please Select Block---</option>';
								} ?>
								<?php foreach($get_info->listBlocks() as $block) {
									echo '<option value="'.$block->id.'">'.$block->block_name.'</option>';
								} ?>
								
							</select>	
							<span class="small">Report ID: <span id="rid"></span></span>
							<input type="hidden" id="report_id" value="<?php echo $get_transaction_id->transactionStart()->id; ?>">						
							
						</div>
						
						<table class="table table-striped small">
						  <thead>
						    <tr>
						      <th scope="col">Student Name</th>
						      <th scope="col">Block</th>
						      <th scope="col">Grade</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody id="students_by_block"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var date = "<?php echo date("Y-m-d"); ?>"
		$(document).ready(function() {
			$('#rid').text($('#report_id').val());
			$('#block').hide();
			$('#time').change(function() {
				$('#block').show();
			});
			if($('#block').show()) {
				$('#time').change(function() {
					$.ajax('validation/submit_report.php?action=ShowAbsenteeList', {
					    type: 'POST',
					    data: {
					    	'date' : $('#time').val(),
					    	'block' : $('#block').val(),
					    },
					    success: function (data) {
					        $('#absentee_list').html(data);
					    },
					    error: function () {
					    	console.log('error');
					    }
					});
				});
			}
			$('#block').change(function() {
				$('#block_static').val($('#block').val());
				$.ajax('student_list.php?block='+$('#block').val()+'&method=AbsenteeList', {
				    type: 'POST',
				    data: {
				    	'date' : $('#time').val(),
				    	'block' : $('#block').val(),
				    },
				    success: function (data) {
				        $('#students_by_block').html(data);
				        $.ajax('validation/submit_report.php?action=ShowAbsenteeList', {
						    type: 'POST',
						    data: {
						    	'date' : $('#time').val(),
						    	'block' : $('#block').val(),
						    },
						    success: function (data) {
						        $('#absentee_list').html(data);
						    },
						    error: function () {
						    	console.log('error');
						    }
						});
				    },
				    error: function () {
				    	console.log('error');
				    }
				});
			});
			$('#submit-absentee-list').click(function() {
				$.ajax('validation/submit_absentee_validate.php?action=SubmitAbsenteeList', {
				    type: 'POST',
				    data: {
				    	'date' : $('#time').val(),
				    	'teacher_id' : <?php echo $_SESSION['id']; ?>,
				    	'block' : $('#block').val(),
				    	'rid' : $('#rid').text(),
				    },
				    success: function (data) {
				        $('#submitSuccessModal').modal('show');
				        $('#close_success_message').click(function() {
					        $(location).attr('href', './submit_absents.php');
				        });
				    },
				    error: function () {
				    	console.log('error');
				    }
				});
			});

			$('#clear-absentee-list').click(function() {
				$.ajax('validation/submit_absentee_validate.php?action=ClearAbsenteeList', {
				    type: 'POST',
				    data: {
				    	'date' : $('#time').val(),
				    	'block' : $('#block').val(),
				    },
				    success: function (data) {
				        $('#absentee_list').html(data);
				    },
				    error: function () {
				    	console.log('error');
				    }
				});
			});
		});
	</script>
<?php include 'assets/fragments/footer.php'; ?>