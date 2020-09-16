//Mailing list
$(document).on('submit','#mail_list', function (e) 
{
	e.preventDefault();
	var postData = $('#mail_list').serializeArray();
		
	$.post(URL+"dashboard/mail_list",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else
			{
				alert("لقد تم اشتراكك في رسائل البريد الإلكترونى ");
			}
			
		}
		catch(err) {
			//alert(err.message+"\n"+data);
		}
	})
	return false;
})
