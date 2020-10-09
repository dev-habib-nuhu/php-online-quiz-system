$(document).ready(function(){
	$('#cancel_transact').click(function(event){
		var respond = confirm("Are you sure you want to cancel the transaction request ?");
		if(respond == true){
			$.post("cancel_t.php",function(data){
					$('#delete_response').html(data);
				});
			reload();
		}
		else{
			return false;
		}
		event.preventDefault();
	});
function reload(){
	setTimeout(function(){
		$('#view_transac_request').load('test.php');
		reload();
	}, 100);
	
}
});