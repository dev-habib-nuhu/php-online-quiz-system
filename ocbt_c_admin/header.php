<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta description="Online Computer based test application">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet"/>
	<link href="../css/a_sidebar.css" rel="stylesheet"/>
	<title><?php echo $page_title;?></title>

</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navgatn_menu">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-right" id="navgatn_menu">
				<ul class="nav navbar-nav">
							<?php if(isset($_SESSION['ocbt_admin_username'])){
								echo "<li><a href=\"logout.php\"><span class='glyphicon glyphicon-off'></span> Log out</a></li>
								<li><a href=\"edit_profile.php\"><span class='glyphicon glyphicon-user'></span> Profile Settings</a></li>";
							}
							?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
			<div class="row">