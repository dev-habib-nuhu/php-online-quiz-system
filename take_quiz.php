<?php
include('settings/dbconfig.php');
if(!$student->is_logged_in()){
	$student->redirect('index.php');
}
if(!isset($_SESSION['ocbt_course_code']) && !isset($_SESSION['ocbt_question_numbers'])){
	$student->redirect('main.php');
}
$course_code = $_SESSION['ocbt_course_code'];
$course_title = $student->get_course_title($course_code);;
$course_time = $student->get_course_time($course_code);
$no_quest = $student->get_no_quest_to_ans($course_code);
$selected_question_numbers = $_SESSION['ocbt_question_numbers'];
$total_mark = $_SESSION['ocbt_question_total_mark'] . "<br/>";
$image = $student->get_profile_pix($_SESSION['ocbt_uid']);
$fname = $_SESSION['ocbt_first_name'];
$lname = $_SESSION['ocbt_last_name'];
$user_name = $_SESSION['ocbt_username'];
$level = $_SESSION['ocbt_level'];
$start_time = $_SESSION['ocbt_test_start_time'];
$end_time = $_SESSION['ocbt_test_end_time'];
$page_title="Online Computer Based Test";
include('includes/header.php');
?>

<div class="container-fluid">
	<div class="timer_div">
		<p id = "time" class="timer">_______</p>
	</div>
	<h1 class="text-center"><u><?php echo $course_code;?></u></h1>
	<div class="row">
	<div class='col-md-10'>
		<div style="font-weight:bold;font-family:Tahoma;font-size:120%;">
<?php
			echo "<br/><br/>";
			$q_real_no = $selected_question_numbers[0];
			//When the next button is being clicked
				if(isset($_POST['btn_Next'])){
					//save the users choice
					if(isset($_POST['choice'])){
						$choice = htmlentities($_POST['choice']);
					}
					else{
						$choice = "";
					}
					//assigns users choice to d array
					$_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no'] - 1] = $choice;
					//End of saving users choice
					//q is the particular question
					$q = $student->get_questions($course_code,$selected_question_numbers[$_SESSION['ocbt_quest_no']-1]);
					for($j=0;$j<count($q);$j++){
						$mark_for_question = $q[$j]['mark'];
					//Mark the question
					if($_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no']-1] == htmlentities($q[$j]['ans'])){
						$mark = ($mark_for_question/$total_mark) * 100;
						//update the score session array
						$_SESSION['ocbt_score'][$_SESSION['ocbt_quest_no']-1] = round($mark,2);
					}
					else{
						$_SESSION['ocbt_score'][$_SESSION['ocbt_quest_no']-1] = 0;
					}
					}
					
					if($_SESSION['ocbt_quest_no'] == count($selected_question_numbers)){
						$_SESSION['ocbt_quest_no'] = count($selected_question_numbers);
					}
					else{
						$_SESSION['ocbt_quest_no'] = $_SESSION['ocbt_quest_no'] + 1;
					}
					$q_real_no = $selected_question_numbers[$_SESSION['ocbt_quest_no']-1];
				}
			//When Previous button is clicked
				if(isset($_POST['btn_Prev'])){
					//save the users choice
					if(isset($_POST['choice'])){
						$choice = htmlentities($_POST['choice']);
					}
					else{
						$choice = "";
					}
					//assigns users choice to d array
					$_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no'] - 1] = $choice;
					$q = $student->get_questions($course_code,$selected_question_numbers[$_SESSION['ocbt_quest_no']-1]);
					for($j=0;$j<count($q);$j++){
						$mark_for_question = $q[$j]['mark'];
					//Mark the question
					if($_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no']-1] == htmlentities($q[$j]['ans'])){
						$mark = ($mark_for_question/$total_mark) * 100;
						//update the score session array
						$_SESSION['ocbt_score'][$_SESSION['ocbt_quest_no']-1] = round($mark,2);
					}
					else{
						$_SESSION['ocbt_score'][$_SESSION['ocbt_quest_no']-1] = 0;
					}
					}
					//end of marker
					if($_SESSION['ocbt_quest_no'] == "1"){
						$_SESSION['ocbt_quest_no'] = "1";
					}
					else{
						$_SESSION['ocbt_quest_no'] = $_SESSION['ocbt_quest_no'] - 1;
					}
					$q_real_no = $selected_question_numbers[$_SESSION['ocbt_quest_no']-1];
				}
				
				// show question number
				echo $_SESSION['ocbt_quest_no'] . ". ";
				$question = $student->get_questions($course_code,$q_real_no);
				//get questions and options
				for($s=0;$s<count($question);$s++){
					echo $question[$s]['question'] . "<br/>";
					$mark_for_question = $question[$s]['mark'];
?>
				<form method="post" id="quest_frm">
						<input type="radio" name="choice" value="<?php echo $question[$s]['opt_a'];?>"
						<?php if($_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no']-1] == htmlentities($question[$s]['opt_a'])){ echo "checked=\"true\"";}?>/>
						<?php echo htmlentities($question[$s]['opt_a']);?><br/>
						<input type="radio" name="choice" value="<?php echo $question[$s]['opt_b'];?>"
						<?php if($_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no']-1] == htmlentities($question[$s]['opt_b'])){ echo "checked=\"true\"";}?>/>
						<?php echo htmlentities($question[$s]['opt_b']);?><br/>
						<input type="radio" name="choice" value="<?php echo $question[$s]['opt_c'];?>"
						<?php if($_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no']-1] == htmlentities($question[$s]['opt_c'])){ echo "checked=\"true\"";}?>/>
						<?php echo htmlentities($question[$s]['opt_c']);?><br/>
						<input type="radio" name="choice" value="<?php echo $question[$s]['opt_d'];?>"
						<?php if($_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no']-1] == htmlentities($question[$s]['opt_d'])){ echo "checked=\"true\"";}?>/>
						<?php echo htmlentities($question[$s]['opt_d']);?>
						<hr/><br/>
						<button class="btn btn-success btn-lg pull-left" type="submit" name="btn_Prev">
						<span class="glyphicon glyphicon-backward"> </span> Previous</button>
			
						<button class="btn btn-success btn-lg pull-right" type="submit" name="btn_Next">
						Next <span class="glyphicon glyphicon-forward"> </span></button>
						<input type="submit" id ="submit_quiz" name="submit_quiz" style="display:none;"/>
						<input type="submit" id ="submit_quiz_end_time" name="submit_quiz" style="display:none;"/>
					</form>
					<?php
				}
				
			?>
<?php
		//message user sees when done with test
		$r = urlencode(base64_encode("<p class='alert alert-success text-center'>Quiz was submitted successfully.
			Click on check result to view your result</p>"));
		if(isset($_POST['submit_quiz'])){
					//save the users choice for the last question before submission
					if(isset($_POST['choice'])){
						$choice = htmlentities($_POST['choice']);
					}
					else{
						$choice = "";
					}
					//assigns users choice to d array
					$_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no'] - 1] = $choice;
					//gets the last question user sees before submission;
					$last_quest = $student->get_questions($course_code,$selected_question_numbers[$_SESSION['ocbt_quest_no']-1]);
					if($_SESSION['ocbt_choices'][$_SESSION['ocbt_quest_no']-1] == htmlentities($last_quest[$s-1]['ans'])){
						$mark_for_question = $last_quest[$s-1]['mark'];
						$mark = ($mark_for_question/$total_mark) * 100;
						//update the score session array
						$_SESSION['ocbt_score'][$_SESSION['ocbt_quest_no']-1] = round($mark,2);
					}
					$student_total_score = round(array_sum($_SESSION['ocbt_score']),1);
			if($student->record_student_score($course_code,$user_name,$student_total_score)){
				$student->redirect("main.php?r=" . $r);
			}
		}?>		
			<div style="padding-top:40px;">
				<ul class="pagination text-center">
<?php				for($n=1;$n<=count($selected_question_numbers);$n++){
					if($_SESSION['ocbt_quest_no'] == $n){
						$class = "\"active\"";
					}
					else{
						$class="\"\"";
					}
					echo "<li class=" . $class . ">
					<a href=\"take_quiz.php?q=" . urlencode(base64_encode($n)) . "\">" . $n . "</a>
					</li>";}?>
					</ul>
			</div>
		</div>
	</div>
	<div class="col-md-2" style="margin-top:50px;">
		<div class="panel panel-default">
		<div class="panel-heading">Student details</div>
		<div class="panel-body text-center">
			<p class="text-center">
				<?php echo "<img src=\"prof_pix/" . $image . "\" ";?>class="img-responsive img-thumbnail" width="150px" height="200px">
			</p>
			<p>Name:<?php echo $fname . "  " . $lname;?></p>
			<p>Username:<?php echo $user_name;?></p>
			<p>Level: <?php echo $level;?></p>
			<label for="submit_quiz" role="button" id="submt" class="btn btn-success" tabindex="0">Submit Quiz</label>
		</div>
		</div>
	</div>
			<!--Time calculations-->
			<script>
			var endtime = new Date(<?php echo "\"" . $end_time . "\"";?>).getTime();
				var y = new Date()
			var x = setInterval(function(){
				var now = new Date().getTime();
				var dist_between = endtime - now;
				var hours = Math.floor((dist_between % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				//minutes calculation
				var mins = Math.floor((dist_between % (1000 * 60 * 60))/(1000 * 60));
				//calculatings secs
				var secs = Math.floor((dist_between % (1000*60))/(1000));
	
				//change the time color if danger zone
				if(secs < 10){
					secs = "0" + secs;
				}
				if(mins < 10){
					mins = "0" + mins;
				}
				document.getElementById("time").innerHTML = mins + " : " + secs;
				if(dist_between < 0){
					clearInterval(x);
					document.getElementById("time").innerHTML = "TIME UP";
					document.getElementById("submit_quiz").click();
					//window.location.href="main.php?r=<?php echo $r;?>";
					}
			},1000);
			</script>
	</div>
</div>
<?php
include('includes/footer.php');
?>