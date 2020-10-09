$(document).ready(function(){
	$("#tid").keyup(function(){
		var tran_id = $('#tid').val();
		if(tran_id.length > 0){
		$.post(
			"check_tid.php",{ transac_id : tran_id},function(data){
				$('#tid_status').html(data);
		});
		return false;
		}
		else{
			$('#tid_status').html("");
		}
	});
});