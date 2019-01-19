<?php
include 'assets/fragments/header.php'; 
include 'core/Redirect.php';
include 'core/Admin.php';

$admin = new Admin;

$redirect = new Redirect;


$redirect->restrictAccess();
$redirect->registrarOnly();
?>
	<div class="container">
		<!--- Bootstrap Default Navbar ---->
		<?php include 'assets/fragments/navbar.php'; ?>
		<!--- Bootstrap Default Navbar ---->
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<span class="h5">Reports</span>
						<hr />
						<div class="list-group">
							<?php
							$i = 1;
							foreach($admin->listReports() as $list) {
						  		echo '<a href="#" class="list-group-item list-group-item-action" id="report_'.$i.'">'.$list->block_name.' : '.$list->first_name.' '.$list->last_name.'<br><span class="small">'.$list->time_out.'</span></a>';
						  		echo '
						  		<script>
									$("#report_'.$i++.'").click(function() {
										$.ajax("validation/show_report.php", {
										    type: "POST",
										    data: {
										    	"date" : "'.$list->time_out.'",
										    	"teacher_id" : '.$list->teacher_id.',
										    	"block" : '.$list->block_id.',
										    },
										    success: function (data) {
										        $("#report_player").html(data);
										        
										    },
										    error: function () {
										    	console.log("error");
										    }
										});
									});

								</script>
						  		';
						  	}
						  	?>
						</div>
					</div>
					<div class="col-8">
						<span class="h5">List of Absents</span>
						<hr />
						<table class="table table-hover" id="report_player">
						  
						    
						  
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include 'assets/fragments/footer.php'; ?>