<?php
include 'assets/fragments/header.php'; 
include 'core/Redirect.php';
$redirect = new Redirect;

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
							<span class="h5">Students with most Lates</span>	
						</div>
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Student Name</th>
						      <th scope="col">Block</th>
						      <th scope="col">Late Count</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">1</th>
						      <td>Mark</td>
						      <td>Otto</td>
						      <td>@mdo</td>
						    </tr>
						    <tr>
						      <th scope="row">2</th>
						      <td>Jacob</td>
						      <td>Thornton</td>
						      <td>@fat</td>
						    </tr>
						    <tr>
						      <th scope="row">3</th>
						      <td>Larry</td>
						      <td>the Bird</td>
						      <td>@twitter</td>
						    </tr>
						  </tbody>
						</table>
					</div>
					<div class="col-6">
						<div class="text-center">
							<span class="h5">Students with most Absences</span>	
						</div>
						
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Student Name</th>
						      <th scope="col">Block</th>
						      <th scope="col">Absent Count</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">1</th>
						      <td>Mark</td>
						      <td>Otto</td>
						      <td>@mdo</td>
						    </tr>
						    <tr>
						      <th scope="row">2</th>
						      <td>Jacob</td>
						      <td>Thornton</td>
						      <td>@fat</td>
						    </tr>
						    <tr>
						      <th scope="row">3</th>
						      <td>Larry</td>
						      <td>the Bird</td>
						      <td>@twitter</td>
						    </tr>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include 'assets/fragments/footer.php'; ?>