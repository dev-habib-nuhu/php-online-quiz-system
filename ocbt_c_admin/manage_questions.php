<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
if (isset($_GET['c_cde'])){
	$course_code = urldecode(base64_decode($_GET['c_cde']));
}
else{
	$student->redirect('admin_dashboard.php');
}
$page_title = "Online Computer Based Examination::Manage Questions";
include('header.php');
if(isset($_POST['save_question'])){
	$quest = trim($_POST['quest']);
	$opt_a = trim($_POST['opt_a']);
	$opt_b = trim($_POST['opt_b']);
	$opt_c = trim($_POST['opt_c']);
	$opt_d = trim($_POST['opt_d']);
	$c = trim($_POST['answer']);
	if($c == "A"){
		$ans = $opt_a;
	}
	elseif($c == "B"){
		$ans = $opt_b;
	}
	elseif($c == "C"){
		$ans = $opt_c;
	}
	else{$ans = $opt_d;
	}
	$mark= trim($_POST['mark']);
	$c_cde = $course_code;
	if($admin->add_new_question($quest,$opt_a,$opt_b,$opt_c,$opt_d,$ans,$mark,$c_cde)){
		$msg = "<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert'>&times;</a>
		Question added Successfully</div>";
	}
	else{
		$msg = "<div class='alert alert-danger'>Error creating account.</div>";
	}
}?>
<?php include('side_bar.php');?>
	<div class="col-sm-12 main">
		<div class="container-fluid">
			<h1>Manage Questions [<?php echo $course_code;?>]</h1><hr/>
			<p></p>
			<h3 class="text-center"><u>Add new question</u></h3>
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2">
			<div><?php if(isset($msg)){ echo "<br/>" . $msg . '<br/>';}?></div>
					<form method="POST" action="">
						<div class="form-group text-center">
							<label for="question" class="text-center">Question</label>
							<textarea class="form-control" name="quest" required></textarea>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="opta">Option a</label>
									<input type="text" name="opt_a" class="form-control" placeholder="Option a" required/>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="optb">Option b</label>
									<input type="text" name="opt_b" class="form-control" placeholder="Option b" required/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="optc">Option c</label>
									<input type="text" name="opt_c" class="form-control" placeholder="Option c" required/>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="optd">Option d</label>
									<input type="text" name="opt_d" class="form-control" placeholder="Option d" required/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group text-center">
									<label for="answer">Answer for question</label>
									<select class="form-control" name="answer" required>
										<option>A</option>
										<option>B</option>
										<option>C</option>
										<option>D</option>
									</select>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="mark">Mark Assigned</label>
									<input type="number" name="mark" class="form-control" placeholder="Mark for question"/>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary btn-lg" name="save_question"><span class="glyphicon glyphicon-save"></span> Save Question</button>
					</form>
				</div>
			</div>
			<h3 class="text-center"><u>All questions</u></h3>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<tbody>
						<tr>
						<th>S/N</th>
						<th>Question</th>
						<th>Option a</th>
						<th>Option b</th>
						<th>Option c</th>
						<th>Option d</th>
						<th>Answer</th>
						<th>Mark</th>
						<th colspan="2">Action</th>
						</tr>
			<?php $f = $admin->get_all_questions($course_code);
			for($i=0;$i<count($f);$i++){
				$q_id = $f[$i]['q_id'];
				$question = $f[$i]['question'];
				$opt_a = $f[$i]['opt_a'];
				$opt_b = $f[$i]['opt_b'];
				$opt_c = $f[$i]['opt_c'];
				$opt_d = $f[$i]['opt_d'];
				$ans = $f[$i]['ans'];
				$mark = $f[$i]['mark'];
				?>
				<tr>
					<td><?php echo $i + 1;?></td>
					<td><?php echo $question;?></td>
					<td><?php echo htmlspecialchars($opt_a);?></td>
					<td><?php echo htmlspecialchars($opt_b);?></td>
					<td><?php echo htmlspecialchars($opt_c);?></td>
					<td><?php echo htmlspecialchars($opt_d);?></td>
					<td><?php echo htmlspecialchars($ans);?></td>
					<td><?php echo $mark;?></td>
					<td>
					<form method="POST">
						<button type="button" class="btn btn-default btn-lg" data-toggle="modal" 
							data-target="#edit_question-<?php echo $q_id;?>">
							<span class="glyphicon glyphicon-pencil"></span></button>
					</form>
						<div id="edit_question-<?php echo $q_id;?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
										<h2 class="text-center">Edit question</h2><hr/>
								<div class="modal-body">
					<form method="POST" action="">
						<div class="form-group text-center">
							<label for="question" class="text-center">Question</label>
							<textarea class="form-control" id="quest-<?php echo $q_id;?>" required><?php echo $question;?></textarea>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="opta">Option a</label>
									<input type="text" id="opt_a-<?php echo $q_id;?>" value="<?php echo $opt_a;?>" class="form-control" required/>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="optb">Option b</label>
									<input type="text" id="opt_b-<?php echo $q_id;?>" value="<?php echo $opt_b;?>" class="form-control" required/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="optc">Option c</label>
									<input type="text" id="opt_c-<?php echo $q_id;?>" value="<?php echo $opt_c;?>" class="form-control" required/>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="optd">Option d</label>
									<input type="text" id="opt_d-<?php echo $q_id;?>" value="<?php echo $opt_d;?>" class="form-control" required/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group text-center">
									<label for="answer">Answer for question</label>
									<select class="form-control" id="ans-<?php echo $q_id;?>" value="<?php echo $ans;?>" required>
										<option>A</option>
										<option>B</option>
										<option>C</option>
										<option>D</option>
									</select>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="mark">Mark Assigned</label>
									<input type="number" id="mark-<?php echo $q_id;?>" value="<?php echo $mark;?>" class="form-control"/>
								</div>
							</div>
						</div>
						<button type="button" class="btn btn-primary btn-lg" onclick="update_question(<?php echo $q_id;?>)">
						<span class="glyphicon glyphicon-save"></span> Save Question</button>
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
						<input type="text" id="q_id-<?php echo $q_id;?>" value="<?php echo $q_id;?>" style="display:none"/>
						<button type="button" class="btn btn-danger btn-lg" onclick="delete_question(<?php echo $q_id;?>)"><span class="glyphicon glyphicon-delete"></span>X</button>
					</form>
					</td>
				</tr>
				<?php
			}?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php include('footer.php');?>