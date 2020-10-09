<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
$page_title = "Online Computer Based Examination::Manage Questions";
include('header.php');
if(isset($_POST['create_acct'])){
	$first_name = strip_tags(trim($_POST['fname']));
	$last_name = strip_tags(trim($_POST['lname']));
	$username = trim($_POST['user_name']);
	$password = trim($_POST['pass']);
	$dept = trim($_POST['dept']);
	$level = trim($_POST['level']);
	if($student->std_register($first_name,$last_name,$username,$password,$dept,$level)){
		$msg = "<div class='alert alert-success'>Student account created successfully!!!</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Error creating account.</div>";
	}
}?>
<?php include('side_bar.php');?>
	<div class="col-sm-12 main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-6"><h1>Manage Students</h1></div>
				<div class="col-xs-6"><h1 class="pull-right"><span class="glyphicon glyphicon-user"></span></h1></div>
			</div>
			<hr/>
			<h3 class="text-center"><u>Add New Student</u></h3><br/>
			<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<!--Beginning of registration form-->
				<form method="POST" class="form-horizontal">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group-sm">
								<label>Firstname:</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" name="fname" class="form-control" placeholder="First name"/>
							</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group-sm">
								<label>Lastname:</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" name="lname" class="form-control" placeholder="Last name"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group-sm">
								<label>Department:</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" name="dept" class="form-control" placeholder="e.g Agricultural Engineering"/>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group-sm">
								<label>Username:</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" name="user_name" class="form-control" placeholder="Specify a username"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group-sm">
								<label>Password:</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
									<input type="password" name="pass" class="form-control" placeholder="****************"/>
							</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group-sm">
								<label>Confirm Password:</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
									<input type="password" name="cpass" class="form-control" placeholder="****************"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group-sm">
								<label>Current Level:</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" name="level" class="form-control" placeholder="e.g 500"/>
								</div>
							</div>
						</div>
						<div class="col-sm-6"></div>
					</div><br/>
					<button type="submit" name = "create_acct" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-save"></span> Save new student
					</button>
				</form>
			<!--End of registration form-->
			<div><?php if(isset($msg)){ echo "<br/>" . $msg;}?></div>
			</div>
		</div>
		</div>
		<h3 class="text-center"><u>All Students Record</u></h3>
				<div class="row">
					<div class="col-xs-6">
					</div>
					<div class="col-xs-6">
					<form method="POST" class="form-inline pull-right">
						<div class="form-group">
							<label for="">Search</label>
							<input type="text" name="search" class="form-control" required/>
							<select name="status" class="form-control">
							<option value="username">Usernname</option>
							<option value="department">department</option>
							<option value="level">Level</option>
							</select>
						</div>
						<button class="btn btn-default btn-sm" name="search_result"><span class="glyphicon glyphicon-search"></span> Search</button>
					</form>
					</div>
				</div><br/>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<tbody>
						<tr>
						<th>S/N</th>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Username</th>
						<th>Department</th>
						<th>Level</th>
						<th colspan="2">Action</th>
						
						</tr>
			<?php 
			if(isset($_GET['search_result'])){
				$table_name =  "std_details";
 					$column_name = trim($_GET['status']);
					$search = trim($_GET['search']);
					$f = $admin->search_record($table_name,$column_name,$search);
				}
				else{
					$f = $admin->get_all_students();
				}
			for($i=0;$i<count($f);$i++){
				$std_id = $f[$i]['std_id'];
				$firstname = $f[$i]['fname'];
				$lastname = $f[$i]['lname'];
				$username = $f[$i]['username'];
				$department = $f[$i]['department'];
				$level = $f[$i]['level'];
				?>
				<tr>
					<td><?php echo $i + 1;?></td>
					<td><?php echo $firstname;?></td>
					<td><?php echo $lastname;?></td>
					<td><?php echo $username;?></td>
					<td><?php echo $department;?></td>
					<td><?php echo $level;?></td>
					<td>
					<form method="POST">
						<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#update_user_details-<?php echo $std_id;?>">
						<span class="glyphicon glyphicon-pencil"></span></button>
					</form>
						<div id="update_user_details-<?php echo $std_id;?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
										<h2 class="text-center">Update Student Record</h2><hr/>
										<div id="error-<?php echo $std_id;?>"></div>
								<div class="modal-body">
										<div class="msg"></div>
										<form class="form-horizontal" method="post">
										<div class="row">
											<div class="col-md-12">
													<div class="form-group form-group-md">
														<label for="c_cde" class="control-label col-sm-4">Firstname: </label>
														<div class="col-sm-8">
															<input type="text" id="fname-<?php echo $std_id;?>" 
															class="form-control" value="<?php echo $firstname;?>" required>
														</div>
													</div>
													<div class="form-group form-group-md">
														<label for="c_title" class="control-label col-sm-4">Lastname: </label>
														<div class="col-sm-8">
															<input type="text" id="lname-<?php echo $std_id;?>" 
															class="form-control" value="<?php echo $lastname;?>" required>
														</div>
													</div>
												<div class="form-group form-group-md">
													<label for="time" class="control-label col-sm-4">Username: </label>
													<div class="col-sm-8">
														<input type="text" id="uname-<?php echo $std_id;?>" 
														class="form-control" value="<?php echo $username;?>">
													</div>
												</div>
												<div class="form-group form-group-md">
													<label for="dept" class="control-label col-sm-4">Department: </label>
													<div class="col-sm-8">
														<input type="text" id="dept-<?php echo $std_id;?>" 
														class="form-control" value="<?php echo $department;?>">
													</div>
												</div>
												<div class="form-group form-group-md">
													<label for="level" class="control-label col-sm-4">Level: </label>
													<div class="col-sm-8">
														<input type="text" id="level-<?php echo $std_id;?>" 
														class="form-control" value="<?php echo $level;?>">
													</div>
												</div>
											</div>

										</div>
										<div class="row">
											<div class="col-md-4 col-md-offset-4">
												<button type="button" onclick="update_student_details(<?php echo $std_id;?>)" 
													class="btn btn-primary btn-block btn-lg"><span class="glyphicon glyphicon-save"></span> Update details</button>
											</div>
										</div>
										<input type="text" id="std_id-<?php echo $std_id;?>" value="<?php echo $std_id;?>" style="display:none"/>
									</form>
								</div>
								</div>
							</div>
							</div>
						</div>
						<!--Modal end-->
					</td>
					<td>
					<form method="POST">
						<button type="button" class="btn btn-danger btn-md" onclick = "delete_student(<?php echo $std_id;?>)">
						<span class="glyphicon glyphicon-delete"></span>X</button>
					</form>
					</td>
				</tr>
				<?php
			}?>
					</tbody>
				</table>
				<?php if(empty($f)){
					echo "<h3>No result found</h3>";
				}?>
			</div>
	</div>

<?php include('footer.php');?>