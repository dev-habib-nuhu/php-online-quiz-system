<?php
include('settings/dbconfig.php');
$page_title="Student Registeration Form";
include('includes/header.php');

if(isset($_POST['create_acct'])){
	$first_name = trim($_POST['fname']);
	$last_name = trim($_POST['lname']);
	$username = trim($_POST['user_name']);
	$password = trim($_POST['pass']);
	$dept = trim($_POST['dept']);
	$level = trim($_POST['level']);
	//Add the user to the database, and show success message 
	if($student->std_register($first_name,$last_name,$username,$password,$dept,$level)){
		$msg = "<p class='alert alert-success'>Account Created Successfully,Please Log into your account</p>";
	}
	// If user  is not added, show the error message.
	else{
		$msg = "<p class='alert alert-danger'>Error Creating your account, please try again</p>";
	}
}
?>
	<div class="container">
	<?php if(isset($msg)){ echo $msg;}?>
	<h1 class="text-center"><u>Student Registration Form</u></h1><hr/>
		<div class="col-md-6 col-md-offset-3">
			<form method="POST" class="form-horizontal" id="std_reg_form">
				<div class="form-group form-group-lg">
					<label>Firstname:</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="fname" class="form-control" placeholder="First name"/>
				</div>
				</div>
				<div class="form-group form-group-lg">
					<label>Lastname:</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="lname" class="form-control" placeholder="Last name"/>
				</div>
				</div>
				<div class="form-group form-group-lg">
					<label>Username:</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="user_name" class="form-control" placeholder="Specify a username"/>
					</div>
				</div>
				<div class="form-group form-group-lg">
					<label>Password:</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" name="pass" class="form-control" placeholder="****************"/>
				</div>
				</div>
				<div class="form-group form-group-lg">
					<label>Confirm Password:</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" name="cpass" class="form-control" placeholder="****************"/>
					</div>
				</div>
				<div class="form-group form-group-lg">
					<label>Department:</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="dept" class="form-control" placeholder="e.g Agricultural Engineering"/>
					</div>
				</div>
				<div class="form-group form-group-lg">
					<label>Current Level:</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="level" class="form-control" placeholder="e.g 500"/>
					</div>
				</div><br/>
				<button type="submit" name = "create_acct" class="btn btn-success btn-lg">
				<span class="glyphicon glyphicon-log-in"> </span> Create My account
				</button>
			</form>
		</div>
	</div>
<?php
include('includes/footer.php');
?>