<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
$page_title = "Online Computer Based Examination::Student Results";
include('header.php');
include('side_bar.php');?>
		<div class="col-sm-12 main">
			<div class="container-fluid">
			<div class="row">
				<div class="col-xs-6"><h1>Student Result</h1></div>
				<div class="col-xs-6"><h1 class="pull-right"><span class="glyphicon glyphicon-book"></span></h1></div>
			</div>
			<hr/>
				<h3 class="text-center"><u>All student result</u></h3>
				<div class="row">
					<div class="col-xs-6">
					<form method="GET" class="form-inline">
						<div class="form-group">
							<label for="">Show only </label>
							<select name="status" class="form-control">
							<option></option>
							<option value="pass">Passed Student</option>
							<option value="fail">Failed Student</option>
							</select>
						</div>
						<button class="btn btn-default btn-sm">Show student</button>
					</form>
					</div>
					<div class="col-xs-6">
					<form method="GET" class="form-inline">
						<div class="form-group">
							<label for="">Search</label>
							<input type="text" name="search" class="form-control" required/>
							<select name="status" class="form-control">
							<option value="username">Usernname</option>
							<option value="course_code">Course</option>
							<option value="score">Score</option>
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
						<th>Username</th>
						<th>Course code</th>
						<th>Score</th>
						<th>Status</th>
						</tr>
			<?php 
			if(isset($_POST['search_result'])){
				$table_name =  "std_results";
 					$column_name = trim($_POST['status']);
					$search = trim($_POST['search']);
					$f = $admin->search_record($table_name,$column_name,$search);
				}
				else{
					$f = $admin->get_all_student_result();
				}
			for($i=0;$i<count($f);$i++){
				$res_id = $f[$i]['result_id'];
				$uname = $f[$i]['username'];
				$c_code = $f[$i]['course_code'];
				$score = $f[$i]['score'];
				?>
				<tr>
					<td><?php echo $i + 1;?></td>
					<td><?php echo $uname;?></td>
					<td><?php echo $c_code;?></td>
					<td><?php echo $score;?></td>
					<td>
					<?php if($score >= 40){
						echo "<button class='btn-success btn-sm'>Pass</button>";
					}
					else{
						echo "<button class='btn-danger btn-sm'>Fail</button>";
					}?></td>
				</tr>
				<?php
			}?>
					</tbody>
				</table>
			</div>
			<?php
			if(!empty($f)){
				echo "<button class='btn btn-default pull-right' onclick='window.print()'><span class='glyphicon glyphicon-print'></span> Print Results</button>";
			}?></div>
		</div>
<?php
include('footer.php');
?>