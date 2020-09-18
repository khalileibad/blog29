//update password
$(document).on('click','#reset', function (e) 
{
	$(".err_notification").addClass("d-none");
	var postData = $('#res_pass').serializeArray();
		
	$.post(URL+"profile/update_password",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else
			{
				$('#pass_ok').modal('show')
			}
		}
		catch(err) {
			alert(err.message+"\n"+data);
		}
	})
})

$('#pass_ok').on('hide.bs.modal', function () {
	location.replace(URL+"login/");
})


$('#active_ok').on('hide.bs.modal', function () {
	location.reload();
})