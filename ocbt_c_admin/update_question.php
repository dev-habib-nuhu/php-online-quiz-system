<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
if(isset($_POST)){
	$q_id = strip_tags(trim($_POST['q_id']));
	$question = trim($_POST['quest']);
	$opt_a = trim($_POST['opt_a']);
	$opt_b= trim($_POST['opt_b']);
	$opt_c = trim($_POST['opt_c']);
	$opt_d = trim($_POST['opt_d']);
	$ans = trim($_POST['ans']);
	$mark = trim($_POST['mark']);
	if($admin->update_question($q_id,$question,$opt_a,$opt_b,$opt_c,$opt_d,$ans,$mark)){
		echo "Question has been Updated!!!";
	}
	else{
		echo "No record was updated!!!";
	}
}
?>