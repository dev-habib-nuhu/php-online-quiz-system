<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
if(isset($_POST)){
	$c_cde = $_POST['c_code'];
	if($admin->delete_course($c_cde)){
	echo "Course has been deleted successfully!!!";
}
}

?>