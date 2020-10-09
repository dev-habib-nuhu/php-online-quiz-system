<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta description="Online Computer based test application">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootsvalid.min.css">
	<link href="css/main.css" rel="stylesheet">
	<title><?php echo $page_title;?></title>
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-inverse" role="navigation">
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
						<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
						<?php
						if(!$student->is_logged_in()){
							echo "<li class=\"\"><a href=\"sign_up.php\">Sign up</a></li>";
						}
						?>
			<li><a href="#abt_douphix" data-toggle="modal">
						<span class="glyphicon glyphicon-user"></span>  About developer</a></li>
						<?php if($student->is_logged_in()){echo "<li class=\"\"><a href=\"logout.php\">
						<span class='glyphicon glyphicon-off'></span> Log out</a></li>";
						}
						else{
							echo "
							<li class=\"\"><a href=\"index.php\">Login</a></li>";
						}?>

					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid">
			<div style="margin-bottom:100px;">