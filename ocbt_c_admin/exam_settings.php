<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
$page_title = "Online Computer Based Examination::Exam Settings";
include('header.php');
if(isset($_POST['add_course'])){
	$c_cde = trim($_POST['course_code']);
	$c_title = trim($_POST['course_title']);
	$c_unit = trim($_POST['course_unit']);
	if($admin->add_new_course($c_cde,$c_title,$c_unit)){
		$msg = "<div class='alert alert-success'>Course successfully added!!</div>";
	}
}
include('side_bar.php');?>
	<div class="col-sm-12 main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-6"><h1>Exam Settings</h1></div>
				<div class="col-xs-6"><h1 class="pull-right"><span class="glyphicon glyphicon-cog"></span></h1></div>
			</div><hr/>
			<h3 class="text-center"><u>All Registered Courses</u></h3>
			<!--search form -->
				<div class="row">
					<div class="col-xs-6">
					</div>
					<div class="col-xs-6">
					<form method="GET" class="form-inline pull-right">
						<div class="form-group">
							<label for="">Search</label>
							<input type="text" name="search" class="form-control" required/>
							<select name="status" class="form-control">
							<option value="course_code">Course code</option>
							<option value="course_title">Course Title</option>
							<option value="unit">Unit</option>
							</select>
						</div>
						<button class="btn btn-default btn-sm" name="search_result"><span class="glyphicon glyphicon-search"></span> Search</button>
					</form>
					</div>
				</div><br/>
				<!--End of search form-->
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<tbody>
						<tr>
						<th>S/N</th>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Unit</th>
						<th>Time</th>
						<th>No of Questions to ans</th>
						<th>Status</th>
						<th>Edit Settings</th>
						</tr>
			<?php
			if(isset($_GET['search_result'])){
				$table_name =  "std_courses";
 					$column_name = trim($_GET['status']);
					$search = trim($_GET['search']);
					$f = $admin->search_record($table_name,$column_name,$search);
				}
				else{
					$f = $admin->get_all_courses();
				}
			for($i=0;$i<count($f);$i++){
				$course_code = $f[$i]['course_code'];
				$course_title = $f[$i]['course_title'];
				$unit = $f[$i]['unit'];
				$time = $f[$i]['time'];
				$no_quest_ans = $f[$i]['no_quest_ans'];
				$status = $f[$i]['status'];
				?>
				<tr>
					<td><?php echo $i + 1;?></td>
					<td><?php echo $course_code;?></td>
					<td><?php echo $course_title;?></td>
					<td><?php echo $unit;?></td>
					<td><?php echo $time;?></td>
					<td><?php echo $no_quest_ans;?></td>
					<td><?php if($status == 0){echo "<p class='btn btn-danger btn-sm'>Inactive</p>";}else{echo "<p class='btn btn-success btn-sm'>active</p>";}?></td>
					<td>
					<form method="POST">
						<button type="button" class="btn btn-default btn-md" name="del-$i" data-toggle="modal" data-target="#change_settings-<?php echo $f[$i]['course_id'];?>">
						<span class="glyphicon glyphicon-pencil"></span></button>
					</form>
					<!--Beginning of modal-->
						<div id="change_settings-<?php echo $f[$i]['course_id'];?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
										<h2 class="text-center">Change Settings For <?php echo $f[$i]['course_code']?></h2><hr/>
										<div id="error-<?php echo $f[$i]['course_id'];?>"></div>
								<div class="modal-body">
										<div class="msg"></div>
										<form class="form-horizontal" method="post">
										<div class="row">
											<div class="col-md-12">
													<div class="form-group">
														<label for="c_cde" class="control-label col-sm-4">Course code: </label>
														<div class="col-sm-8">
															<input type="text" id="c_code-<?php echo $f[$i]['course_id'];?>" 
															class="form-control" value="<?php echo $f[$i]['course_code'];?>" disabled>
														</div>
													</div>
													<div class="form-group">
														<label for="c_title" class="control-label col-sm-4">Course title: </label>
														<div class="col-sm-8">
															<input type="text" id="c_title-<?php echo $f[$i]['course_id'];?>" 
															class="form-control" value="<?php echo $f[$i]['course_title'];?>" disabled>
														</div>
													</div>
												<div class="form-group">
													<label for="time" class="control-label col-sm-4">Time(Minutes): </label>
													<div class="col-sm-8">
														<input type="text" id="time-<?php echo $f[$i]['course_id'];?>" 
														class="form-control" value="<?php echo $f[$i]['time'];?>">
													</div>
												</div>
												<div class="form-group">
													<label for="no_quest_to_ans" class="control-label col-sm-4">No of Questions to Answer: </label>
													<div class="col-sm-8">
															<input type="text" id="no_quest_to_ans-<?php echo $f[$i]['course_id'];?>" 
															class="form-control" value="<?php echo $f[$i]['no_quest_ans'];?>">
													</div>
												</div>
												<div class="form-group">
													<label for="acct_type" class="control-label col-sm-4">Status: </label>
													<div class="col-sm-8">
													<select class="form-control" id="status-<?php echo $f[$i]['course_id'];?>">
														<option style="font-weight:bold;"
														<?php if($f[$i]['status'] == 0){echo " selected='selected'";} ?> value="Inactive">Inactive</option>
														<option style="font-weight:bold;"
														<?php if($f[$i]['status'] == 1){echo " selected='selected'";} ?> value="Active">Active</option>
													</select>
												</div>
												</div>
											</div>

									</div>
										<div class="row">
											<div class="col-md-4 col-md-offset-4">
												<button type="button" onclick="update_exam_settings(<?php echo $f[$i]['course_id'];?>)" 
													class="btn btn-primary btn-block btn-lg"><span class="glyphicon glyphicon-save"></span> Save Settings</button>
											</div>
										</div>
									</form>
									<div id="total_no_quest-<?php echo $f[$i]['course_id'];?>">
									Total number of question: <?php echo $admin->total_no_questions($f[$i]['course_code']);?></div>
								</div>
								</div>
							</div>
							</div>
						</div>
						<!--End of modal-->
					</td>
				</tr>
				<?php
			}?>
					</tbody>
				</table>
				<?php if(empty($f)){
					echo "<h3>No result found</h3><br/>";
				}?>
			</div>
		</div>
	</div>
<?php include('footer.php');?>