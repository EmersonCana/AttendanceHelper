<?php 
	include 'assets/fragments/header.php'; 
	include 'core/Redirect.php';
	$redirect = new Redirect;

	$redirect->sessionRedirect();
?>
	<div class="container">
		<div class="jumbotron">
			<div class="text-center">
				<span class="h1">Attendance Helper 1.0</span>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-8">
						<span class="h4">User Registration</span>
						<div class="card mt-3">
							<div class="card-body">
								<form method="POST" action="validation/logs_validate.php">
									<label class="lead">First Name:</label>
									<input type="text"  class="form-control" name="firstname" maxlength="50" placeholder="John">
									<label class="lead">Middle Name:</label>
									<input type="text"  class="form-control" name="middlename" maxlength="50" placeholder="Van">
									<label class="lead">Last Name:</label>
									<input type="text"  class="form-control" name="lastname" maxlength="50" placeholder="Doe">
									<label class="lead">E-mail:</label>
									<input type="email"  class="form-control" name="email" maxlength="50" placeholder="johndoe@email.com">
									<label class="lead">Password:</label>
									<input type="password" class="form-control" name="password" maxlength="50" placeholder="Password">
									<label class="lead">Repeat Password:</label>
									<input type="password" class="form-control" name="repeat-password" maxlength="50" placeholder="Repeat Password">
									<div class="text-right mt-3">
										<button type="submit" name="register" class="btn btn-outline-success btn-lg">Register</button>	
									</div>
								</form>
							</div>
						</div>
						
					</div>
					<div class="col-4">
						<div class="card">
							<div class="card-body">
								<form method="POST" action="validation/logs_validate.php">
									<label class="lead">E-mail:</label>
									<input type="email"  class="form-control" name="email" maxlength="50" placeholder="johndoe@email.com">
									<label class="lead">Password:</label>
									<input type="password" class="form-control" name="password" maxlength="50" placeholder="Password">
									<div class="text-left mt-3">
										<button type="submit" name="login" class="btn btn-outline-primary btn-lg">Login</button>	
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include 'assets/fragments/footer.php'; ?>