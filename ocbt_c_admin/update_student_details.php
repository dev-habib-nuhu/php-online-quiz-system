<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
if(isset($_POST)){
	$std_id = strip_tags(trim($_POST['std_id']));
	$fname = strip_tags(trim($_POST['fname']));
	$lname = strip_tags(trim($_POST['lname']));
	$uname = strip_tags(trim($_POST['uname']));
	$dept = strip_tags(trim($_POST['dept']));
	$level = strip_tags(trim($_POST['level']));
	if($admin->update_student_details($fname,$lname,$uname,$dept,$level,$std_id)){
		echo "Student Record has been Updated!!!";
	}
	else{
		echo "No record was updated!!!";
	}
}
?>