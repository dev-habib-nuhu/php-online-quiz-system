<?php
include('settings/dbconfig.php');
if(!$student->is_logged_in()){
	$student->redirect('index.php');
}
if(!isset($_SESSION['ocbt_course_code'])){
	$student->redirect('main.php');
}
$_SESSION['ocbt_quest_no'] = 1;
$course_code = $_SESSION['ocbt_course_code'];
$course_title = $student->get_course_title($course_code);;
$course_time = $student->get_course_time($course_code);
$no_quest = $student->get_no_quest_to_ans($course_code);
$question_numbers = $student->get_my_question_number($course_code,$no_quest);
$all_quest = $question_numbers;
$numbers = array();
$total_mark = 0;
//echo $curent_t;
//echo "In 10 min time" . date("M ,d Y H:i:s",strtotime("+" . $course_time . "minutes"));
//Add all the question numbers into an array;
for ($i=0;$i<count($all_quest);$i++){
	$s = $all_quest[$i]['q_id'];
	array_push($numbers,$s);
}
//get total mark for course
for ($i=0;$i<count($all_quest);$i++){
	$s = $all_quest[$i]['mark'];
	$total_mark = $total_mark + $s;
}
$_SESSION['ocbt_question_total_mark'] = $total_mark;
//saves numbers to array 
$_SESSION['ocbt_question_numbers'] = $numbers;
//creates an empty array for users choice
if(!isset($_SESSION['choices'])){
	//set $choices as array
	$choices = array();
	//set score array
	$score = array();
	//loop through the $choices array and set all values to null
	for($q=0;$q<count($numbers);$q++){
		array_push($choices,'');
		array_push($score,0);
	}
	$_SESSION['ocbt_choices'] = $choices;
	$_SESSION['ocbt_score'] = $score;
}

$page_title="Test Instructions";
include('includes/header.php');
if(isset($_POST['btn_start_test'])){
	$student->redirect('take_quiz.php');
	date_default_timezone_set("Africa/Lagos");
	//save end time in session
	$_SESSION['ocbt_test_start_time'] = date("d M Y H:i:s");
	$_SESSION['ocbt_test_end_time'] = date("d M Y H:i:s",strtotime("+" . $course_time . "minutes"));
	//$_SESSION['ocbt_end_time'] = $curent_time + $course_time;
}
?>
<div class="container-fluid">
	<h2><u>Test Instructions</u></h2>
	<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div style="font-weight:bold;font-size:20px;font-family:verdana;">
			<p>Course Code: <?php echo $course_code; ?>
			<p>Course Title: <?php echo $course_title;?></p>
			<p>Number Of Questions to be Answered: <?php echo $no_quest;?></p>
			<p>Exam duration: <?php echo $course_time . " Minutes";?></p>
			<form method="POST">
				<button class="btn btn-success btn-lg" name="btn_start_test"> <span class="glyphicon glyphicon-play"></span> Start Test</button>
			</form>
		</div>
	</div>
	</div>
</div>
<?php
include('includes/footer.php');
?>