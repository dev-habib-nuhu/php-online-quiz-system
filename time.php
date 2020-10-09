<!DOCTYPE html>
<html lang="en-US">
<head>
<title></title>
</head>
<body>
	<?php
$session_end_time = "April,12 2018 19:20:50"; //date("M ,d Y H:i:s",strtotime('+30 minutes'));
echo $session_end_time . "<br/>";
?>
<script>
var endtime = new Date(<?php echo "\"" . $session_end_time . "\"";?>).getTime();
	var y = new Date()
	document.write("<br/>" + y + "<br/>");
var x = setInterval(function(){
	var now = new Date().getTime();
	var dist_between = endtime - now;
	var hours = Math.floor((dist_between % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	//minutes calculation
	var mins = Math.floor((dist_between % (1000 * 60 * 60))/(1000 * 60));
	//calculatings secs
	var secs = Math.floor((dist_between % (1000*60))/(1000));
	document.getElementById("time").innerHTML = hours + ":" + mins + " : " + secs;
	if(dist_between < 0){
		clearInterval(x);
		document.getElementById("time").innerHTML = "TIME UP";
		}
},1000)
</script>
<p id ="min"></p>
<p id="time"></p>
</body>
</html>