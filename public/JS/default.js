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
				alert("asdad");
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

//For Form Error 
function error_handler(data)
{
	try {
		var obj = JSON.parse(data);
		if ("Error" in obj)
		{
			var res = obj.Error;
			if(res == "No Certificate")
			{
				alert("Error Certificate");
			}else
			{
				var m;
				res = res.split("\n");
				res.forEach(function(item, index)
				{
					if(item.search("Data not saved") != -1)
					{
						$('#save_err').modal();
					}else if(item != "")
					{
						item = item+"";
						m = item.split(":");
						if(m.length != 2)
						{
							alert(item);
						}else if(m[0]=="modal")
						{
							$('#'+m[0]).modal('show');
						}else
						{
							m[0] = m[0].replace("In Field ", "");
							m[0] = m[0].replace(" ", "");
							if(m[1].search("Duplicate") != -1)
							{
								if($("#duplicate_"+m[0]).length)
								{
									$("#duplicate_"+m[0]).removeClass(E_HIDE);
								}else
								{
									alert("Duplicate in :"+m[0]);
								}
								
							}else{
								if($("#valid_"+m[0]).length)
								{
									$("#valid_"+m[0]).removeClass(E_HIDE);
								}else
								{
									alert("Error in :"+m[0]);
								}
							}
						}
					}
				})
			}
		}
	}
	catch(err) {
		alert(err.message+"\n\n\n"+data);
	}
} 

//for Form Progress
function form_progress(percentage)
{
	/*<div id="targetProgress" class="w3-modal">
			<div class="w3-modal-content w3-card-4 w3-animate-opacity" style="max-width:200px">
				<div class="w3-border">
					<progress id="progress_area" value="0" max="100" style="width:100%;height:100%"></progress>
				</div>
			</div>
		</div>*/
	$('#progress_area').val(percentage);
	if(percentage == 0)
	{
		$('#targetProgress').show();
	}else if(percentage == 100)
	{
		setTimeout(function() { $("#targetProgress").hide(); }, 1500);
	}
}

//clear form
function close_form_dialog(di)
{
	di.find('input:not(.hid_info):not(:checkbox):not(:radio)').val('');
	di.find('select').val('');
	di.find('textarea').html('');
	di.find('textarea').val('');
	di.find('input:checkbox').prop('checked', false);
	di.find('input:radio').prop('checked', false);
	di.find('.err_notification').addClass(E_HIDE);
	di.find('.clear_form_area').html('');
	di.find('.form_images').attr('src','');
}

$(document).ready(function() 
{
	//For Error Class style
	$('.err_notification').addClass(E_HIDE);
})

//Date Picker
$('.datepicker').datepicker({
	dateFormat: 'yy-mm-dd',
	changeMonth: true,
	changeYear: true
});

