<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
if(isset($_POST)){
	$q_id = $_POST['q_id'];
	if($admin->delete_question($q_id)){
	echo "Question has been deleted successfully!!!";
}
}
?>