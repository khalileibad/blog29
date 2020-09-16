//contact Form
$(document).on('submit','#contact_form', function (e) 
{
	e.preventDefault();
	$(".err_notification").addClass("d-none");
	var postData = $('#contact_form').serializeArray();
		
	$.post(URL+"dashboard/new_cont",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else
			{
				$('#cont_ok').modal('show');
			}
		}
		catch(err) {
			alert(err.message+"\n"+data);
		}
	})
	return false;
})

$('#cont_ok').on('hide.bs.modal', function () {
	location.replace(URL);
})
