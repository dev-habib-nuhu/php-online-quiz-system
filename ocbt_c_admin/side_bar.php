				<?php
				if(isset($_POST['sel_course'])){
					$course_code = $_POST['course'];
					$enc_c = urlencode(base64_encode($course_code));
					echo $course_code;
					$student->redirect('manage_questions.php?c_cde=' . $enc_c);
				}?>
				<div class="sidebar">
					<p style="color:white;">Welcome Admin</p>
					<img class="img-circle img-responsive" style="margin-bottom:10px;" src="images/profile.jpg"/>
					<ul class="nav nav-sidebar">
						<li class="active"><a href="admin_dashboard.php"><span class="glyphicon glyphicon-home"> </span> HOME</a></li>
						<li><a href="manage_students.php"><span class="glyphicon glyphicon-user"> </span> MANAGE STUDENTS</a></li>
						<li><a href="manage_courses.php"><span class="glyphicon glyphicon-pencil"> </span> MANAGE COURSES</a></li>
						<li><a href="#select_course" data-toggle="modal"> <span class="glyphicon glyphicon-book">
						</span> MANAGE QUESTIONS</a></li>
						<li><a href="exam_settings.php"><span class="glyphicon glyphicon-cog"> </span> EXAM SETTINGS</a></li>
						<li><a href="view_results.php">VIEW RESULTS</a></li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> LOG OUT</a></li>
					</ul>
				</div>