<?php
include('../settings/dbconfig.php');
if($admin->is_admin_logged_in()){
	$student->redirect('admin_dashboard.php');
}
$page_title="Administrator Panel Login";
include('header.php');
if(isset($_POST['btn_login'])){
	$user = trim($_POST['user_name']);
	$pass = trim($_POST['pass']);
	if($admin->admin_login($user,$pass)){
		$admin->update_last_login($user);
		$student->redirect('admin_dashboard.php');
	}
	else{
		$err_msg = "<p class=\"alert alert-danger\">Invalid login details,please check your login details</p>";
	}
}
?>
<hr/>
<div class="container">
	<h2 class="text-center"><u>Administrator Login</u></h2>
	<div class="col-md-6 col-md-offset-3">
		<form method="POST" class="form-horizontal">
			<div class="form-group-lg">
				<label>User ID:</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input type="text" name="user_name" class="form-control" placeholder="Username" autocomplete="on"
					value="<?php if(isset($_POST['user_name'])){echo htmlspecialchars($_POST['user_name']);}?>" required/>
				</div>
			</div>
			<div class="form-group-lg">
				<label>Password:</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					<input type="password" name="pass" class="form-control" placeholder="****************" required/>
				</div>
			</div><br/>
			<button type="submit" name="btn_login" class="btn btn-primary btn-lg">
			<span class="glyphicon glyphicon-log-in"></span> Login
			</button>
		</form>
		<?php if(isset($err_msg)){echo "<hr/>" . $err_msg;}?>
	</div>
</div>

<?php
include('footer.php');
?>