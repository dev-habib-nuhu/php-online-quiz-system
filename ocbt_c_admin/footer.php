	</div>
		<div style="margin-top:100px;">
			<footer class="nav navbar-inverse navbar-fixed-bottom">
				<p class="navbar-text">Developed by d0uph1x</p>
			</footer>
		</div>
	</div>
	<div id="select_course" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<p>Select a Course</p>
				</div>
				<div class="modal-body">
					<p>Please select a course to manage questions for and click proceed to manage questions</p>
					<?php $admin->get_active_courses();?>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="../Js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../Js/bootstrap.min.js"></script>
<script type="text/javascript" src="../Js/side_nav.js"></script>
<script type="text/javascript" src="Js/control_process.js"></script>
</body>
</html>