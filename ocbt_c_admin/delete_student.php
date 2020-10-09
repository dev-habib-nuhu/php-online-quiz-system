<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
if(isset($_POST)){
	$std_id = $_POST['std_id'];
	if($admin->delete_student($std_id)){
	echo "User account has been deleted successfully!!!";
}
}
?>