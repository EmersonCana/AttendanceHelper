<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php 
      if($_SESSION['role'] == 1) {
        echo '
        <li class="nav-item">
          <a class="nav-link" href="submit_absents.php">Absentee List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="my_reports.php">Reports</a>
        </li>
        ';
      }
      ?>
      <?php 
      if($_SESSION['role'] == 2) {
        echo '<li class="nav-item">
        <a class="nav-link" href="add_student.php">Student List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reports.php">Reports</a>
        </li>';
      }
      ?>
      
      <li class="nav-item">
      	<form action="validation/logs_validate.php" method="POST">
        	<button type="submit" name="logout" class="btn btn-link nav-link">Logout</button>
        </form>
      </li>
    </ul>
    	<div class="navbar-text form-inline">
			<span class="nav-link"><?php echo $_SESSION['firstname']; ?></span>
		</div>
  </div>
</nav>