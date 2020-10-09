<?php
include('settings/dbconfig.php');
if(!$student->is_logged_in()){
	$student->redirect('index.php');
}
$page_title="Quiz Results";
include('includes/header.php');
?>
<div class="container">
	<h2 class="text-center"><u>Quiz Results</u></h2><hr/>
	<?php
		$result = $student->check_result($_SESSION['ocbt_username']);
		$image = $student->get_profile_pix($_SESSION['ocbt_uid']);
	?>
	<div class="row">
		<div class="row">
			<div class="col-md-3">
				
			</div>
			<div class="col-md-2">
				<img class="img-thumbnail" src="prof_pix/<?php echo $image . "\""?> width="150px" height="150px"/>
			</div>
			<div class="col-md-4">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<tbody>
							<tr>
								<th width="30%">Name </th>
								<td width="40%"><?php echo $_SESSION['ocbt_first_name'] . " " . $_SESSION['ocbt_last_name'];?></td>
							</tr>
							<tr>
								<th>Username</th>
								<td><?php echo $_SESSION['ocbt_username'];?></td>
							</tr>
							<tr>
								<th>Department</th>
								<td><?php echo $_SESSION['ocbt_dept'];?></td>
							</tr>
							<tr>
								<th>Level</th>
								<td><?php echo $_SESSION['ocbt_level'];?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-3">
				
			</div>
		</div>
		<div class="col-md-6 col-md-offset-3">
			<hr/>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Course Code</th>
							<th>Score(%)</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
				<?php
					if(empty($result)){
						echo "<p style='font-weight:bold;'>Yo haven't taken any Quiz yet,To Take a Quiz,go back to the main page and click take quiz.</p>";
					}
					else{
					for($q=0;$q < count($result);$q++){
					?>
						<tr>
							<td><?php echo $q + 1;?></td>
							<td><?php echo $result[$q]['course_code'];?></td>
							<td><?php echo $result[$q]['score'];?></td>
							<td><?php 
							if($result[$q]['score'] < 39){
								$grade = "F";
							}
							elseif($result[$q]['score'] > 39 && $result[$q]['score'] < 45){
								$grade = "E";
							}
							elseif($result[$q]['score'] > 44 && $result[$q]['score'] < 50){
								$grade = "D";
							}
							elseif($result[$q]['score'] > 49 && $result[$q]['score'] < 60){
								$grade = "C";
							}
							elseif($result[$q]['score'] > 59 && $result[$q]['score'] < 70){
								$grade = "B";
							}
							elseif($result[$q]['score'] > 70){
								$grade = "A";
							}
	echo $grade;?></td>
						</tr>
					<?php }
					}
					?>
					</tbody>
				</table>
				<?php
				if(!empty($result)){
					?>
					<button class="btn btn-default pull-right" onclick="print_result()"><span class="glyphicon glyphicon-print"></span> Print Result</button>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php
include('includes/footer.php');
?>