	</div>
</div>
<div>
	<footer class="nav navbar-inverse">
		<p class="navbar-text">Developed by d0uph1x</p>
	</footer>
</div>
		<div id="abt_douphix" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3>About Developer</h3>
					</div>
					<div class="modal-body" style="font-weight:bold;">
						<div class="text-center">
							<p class="text-center">
							<img src="images/d0uph1x.jpg" class="img-responsive img-circle" width="150px" height="200px"/>
							</p>
							<p>Name: Habib Nuhu</p>
							<p>Country: Nigeria</p>
							<p>State of Origin: Kogi</p>
							<p>Email: habibnuhu101@gmail.com</p>
							<p>Phone:+2348165820418</p>
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
</div>
<script type="text/javascript" src="Js/jquery-3.1.1.min.js"></script>
<?php
if($page_title == "Student Registeration Form"){
 echo "<script type=\"text/javascript\" src=\"Js/bootsvalid.min.js\"></script>
 <script type=\"text/javascript\" src=\"Js/validate_reg.js\"></script>";
}
?>
<script type="text/javascript" src="Js/bootstrap.min.js"></script>
		<script>
		$(document).ready(function(){
			$("#submt").click(function(){
				var response = confirm("Are you sure you want to submit?");
				if(response == true){
					return true;
				}
				else{
					return false;
				}
				event.preventDefault();
			});
		});
		function print_result(){
			window.print();
		}
		</script>
</body>
</html>