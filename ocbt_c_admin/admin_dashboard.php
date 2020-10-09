<?php
include('../settings/dbconfig.php');
if(!$admin->is_admin_logged_in()){
	$student->redirect('index.php');
}
$page_title = "Online Computer Based Examination Administrator Dashboard";
include('header.php');
include('side_bar.php');?>
		<div class="container-fluid">
			<div class="col-sm-12 main">
				<h1>Administrator Dashboard</h1><hr/>
				<p>Please Navigate with the Sidebar</p>
			</div>
		</div>
<?php
//echo password_hash('ocbt_administrator',PASSWORD_DEFAULT);
include('footer.php');
?>