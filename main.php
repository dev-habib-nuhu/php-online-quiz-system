<?php
include('settings/dbconfig.php');
if(!$student->is_logged_in()){
	$student->redirect('index.php');
}
$page_title="Student Main Page";
include('includes/header.php');
//if question number is set, unset it
if(isset($_SESSION['ocbt_quest_no'])){
	unset($_SESSION['ocbt_quest_no']);
}
//if total mark is set, unset it
if(isset($_SESSION['ocbt_question_total_mark'])){
	unset($_SESSION['ocbt_question_total_mark']);
}
//
if(isset($_SESSION['ocbt_question_numbers'])){
	unset($_SESSION['ocbt_question_numbers']);
}
//session that stores users choices should be unset if set
if(isset($_SESSION['ocbt_choices'])){
	unset($_SESSION['ocbt_choices']);
	unset($_SESSION['ocbt_score']);
	unset($_SESSION['ocbt_test_start_time']);
	unset($_SESSION['ocbt_test_end_time']);
}
if(isset($_POST['upload_pass'])){
	$name = 'prof_img';
	$dir = 'prof_pix/';
	$img_link = $student->image_upload_url($name,$dir);
	if(!isset($student->error)){
		if($student->upload_std_pix($_SESSION['ocbt_uid'],$img_link)){
			$upload_msg  = "<div class='alert alert-success'>Image Has been Uploaded</div>";
		}
	}
}
$image = $student->get_profile_pix($_SESSION['ocbt_uid']);
if(isset($_POST['course'])){
	$course_code = $_POST['course'];
	$_SESSION['ocbt_course_code'] = $course_code;
	$student->redirect('instruction.php');
}
date_default_timezone_set("Africa/Lagos");
echo "Date: " . date("d M, Y");
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<p>Welcome <?php echo $_SESSION['ocbt_username'];?></p>
			</div>
			<div class="col-md-6">
				<h1 class="text-center"><u>User Main Menu</u></h1>
			</div>
			<div class="col-md-3">
				<p><a href="logout.php">
				<button class="btn btn-danger btn-sm pull-right"><span class="glyphicon glyphicon-off"></span> Logout</button></a></p>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<?php if(isset($upload_msg)){echo $upload_msg;}?>
			<?php if(isset($student->error)){echo $student->error;} 
			if(isset($_GET['r'])){
				$r = urldecode(base64_decode($_GET['r']));
				echo $r . "<br/>";
				}?>
				<p class="text-center">
				<?php echo "<img src=\"prof_pix/" . $image . "\" ";?>class="img-thumbnail" width="200px" height="150px">
				</p>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<form method="POST" enctype="multipart/form-data" class="form-inline">
							<div class="form-group">
								<input type="file" name="prof_img" required/>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-warning btn-sm" name="upload_pass" >Upload Image</button>
							</div>
						</form>
					</div>
				</div>
				<br/>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
						</thead>
						<tbody class="text-center">
							<tr>
								<td>Name</td>
								<td><?php echo $_SESSION['ocbt_first_name'] . " " . $_SESSION['ocbt_last_name'];?></td>
							</tr>
							<tr>
								<td>Username</td>
								<td><?php echo $_SESSION['ocbt_username'];?></td>
							</tr>
							<tr>
								<td>Department</td>
								<td><?php echo $_SESSION['ocbt_dept'];?></td>
							</tr>
							<tr>
								<td>Level</td>
								<td><?php echo $_SESSION['ocbt_level'];?></td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div class="col-md-4">
					<p><a href="#select_course" data-toggle="modal" style="text-decoration:none;font-size:20px;">
					<span class="glyphicon glyphicon-pencil">  
					</span>  Take a Quiz</a></p>
				</div>
				<div class="col-md-4">
					<p><a href="quiz_result.php" style="text-decoration:none;font-size:20px;" target="_blank">
					<span class="glyphicon glyphicon-book"> 
					</span>  Check Result</a></p>
				</div>
				<div class="col-md-4">
					<p><a href="#change_pass" data-toggle="modal" style="text-decoration:none;font-size:20px;">
					<span class="glyphicon glyphicon-lock">  
					</span>  Change Password</a></p>
				</div>
			</div>
		</div>
		<div id="select_course" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 style="color:blue">Please Select a Course</h3>
					</div>
					<div class="modal-body">
						<?php echo $student->get_active_courses();?>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<div id="change_pass" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 style="color:blue"><u>Change Password</u></h3>
					</div>
					<div class="modal-body">
						<div>
							<form method="POST">
								<div class="form-group">
									<label for="current_pass">Current Password:</label>
									<input type="password" class="form-control" placeholder="Present Password" name="c_pass"/>
								</div>
								<div class="form-group">
									<label for="new_pass">New Password:</label>
									<input type="password" class="form-control" placeholder="The New Password" name="n_pass"/>
								</div>
								<div class="form-group">
									<label for="new_pass">Confirm New Password:</label>
									<input type="password" class="form-control" placeholder="The New Password" name="c_n_pass"/>
								</div>
								<button class="btn btn-primary" >Change My Password</button>
							</form>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
include('includes/footer.php');
?>