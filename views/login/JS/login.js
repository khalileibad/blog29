
//JS For dep Actions
$(document).ready(function(){
	if($("#error_msg").length)
	{
		var m = $('#error_msg').html();
		if(m != "")
		{
			$('#err_'+m).modal('show');
		}
	}else if($("#error_reg_msg").length)
	{
		var m = $('#error_reg_msg').html();
		if(m != "")
		{
			try {
				var obj = JSON.parse(m);
				
				if ("Error" in obj)
				{
					error_handler(m);
				}else
				{
					$('#reset_req_modal').modal('show');
				}
			}
			catch(err) {
				alert(m);
			}
		}
	}
	
})

//register submit
$(document).on('submit','#reg_form', function (e) 
{
	e.preventDefault();
	var postData = $('#reg_form').serializeArray();
	$.post(URL+"login/reg",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			
			if ("Error" in obj)
			{
				error_handler(data);
			}else if ("url" in obj)
			{
				location.replace(URL+obj.url);
			}
		}
		catch(err) {
			alert(data);
		}
	})
	return false;
})



//forget submit
$(document).on('click','#forget_send', function (e) 
{
	var postData = $('#forget_form').serializeArray();
	$.post(URL+"login/forget_request",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			
			if ("Error" in obj)
			{
				alert(data);
				error_handler(data);
			}else
			{
				$('#forget_req').modal('show');
			}
		}
		catch(err) {
			alert(err.message+"\n"+data);
		}
			
	})
	
})

//reset pass submit
$(document).on('click','#reset_send', function (e) 
{
	var postData = $('#reset_form').serializeArray();
	$.post(URL+"login/update_res_password",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			
			if ("Error" in obj)
			{
				error_handler(data);
			}else
			{
				$('#reset_req_modal').modal('show');
			}
		}
		catch(err) {
			alert(err.message+"\n"+data);
		}
	})
})

$('#reset_req_modal').on('hide.bs.modal', function () {
	location.replace(URL+'login');
})
