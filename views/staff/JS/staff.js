//JS For staff Actions
$(document).ready(function(){
	staff_list();
})

//Get staff List 
function staff_list()
{
	var postData = $('#Staff_search').serializeArray();
	$.post(URL+"staff/user_list",postData,function(data,status,xhr){
		$("#Staff_list").html(data);
	})
}

//Search
$(document).on('click','#search_Staff', function (e) 
{
	staff_list();
})

//clear new_Staff form
function new_Staff_close()
{
	$('#new_Staff').hide();
	close_form_dialog($('#new_Staff_form'));
}

//New staff Open
$(document).on('click','#new_Staff_button', function (e) 
{
	$('#new_Staff').show();
})

//new_Staff close
$(document).on('click','.new_Staff_close', function (e) 
{
	new_Staff_close();
})

//new_Staff submit
$(document).on('click','#add_new_Staff', function (e) 
{
	//alert("start Saving Please Wait");
	var postData = $('#new_Staff_form').serializeArray();
	$.post(URL+"staff/new_Staff",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تمت اضافة موظف جديد ");
				staff_list();
				new_Staff_close();
				$('#new_Staff').hide();
			}else
			{
				alert(data);
			}
		}
		catch(err) {
			alert(err.message+"\n"+data);
		}
	})
})

//clear upd_Staff form
function upd_Staff_close()
{
	$('#upd_Staff').hide();
	close_form_dialog($('#upd_Staff_form'))
}

//upd staff Open
$(document).on('click','.user_upd', function (e) 
{
	var row = $(this).parent().parent();
	
	$('#upd_id').val(row.find(".sta_id").html());
	$('#upd_name').val(row.find(".sta_name").html());
	$('#upd_type').val(row.find(".sta_type").attr('data-id'));
	$('#upd_email').val(row.find(".sta_email").html());
	
	$('#upd_Staff').show();
	
})

//upd_Staff submit
$(document).on('click','#add_upd_Staff', function (e) 
{
	//alert("start Updating Please Wait");
	var postData = $('#upd_Staff_form').serializeArray();
	$.post(URL+"staff/upd_Staff",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else
			{
				alert("تم تحديث بيانات الموظف ");
				staff_list();
				upd_Staff_close();
				$('#new_Staff').hide();
			}
		}
		catch(err) {
			alert(err.message+"\n"+data);
		}
	})
})

//del_Staff submit
$(document).on('click','#add_del_Staff', function (e) 
{
	if(confirm("هل انت متأكد من مسح الموظف؟"))
	{
		var postData = $('#upd_Staff_form').serializeArray();
		$.post(URL+"staff/del_Staff",postData,function(data,status,xhr)
		{
			try {
				var obj = JSON.parse(data);
				if ("Error" in obj)
				{
					error_handler(data);
				}else
				{
					alert("تم مسح الموظف ");
					staff_list();
					upd_Staff_close();
					$('#new_Staff').hide();
				}
			}
			catch(err) {
				alert(err.message+"\n"+data);
			}
		})
	}
	
})

//upd_Staff close
$(document).on('click','.upd_Staff_close', function (e) 
{
	upd_Staff_close();
})

//active - freeze group
$(document).on('click','.user_act', function (e) 
{
	
	var cl = $(this);
	var id = cl.parent().parent().find(".sta_id").html();
	var crt= $("#csrf").val();
	var active = cl.hasClass("w3-red"); // w3-red:w3-green
	
	$.post(URL+"staff/active",{csrf:crt,id:id,current:active},function(data,status,xhr){
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				$('#err_'+obj.Error).show();
			}else
			{
				alert("تم تجميد / فك تجميد الموظف")
				staff_list();
			}
		}
		catch(err) {
			alert(err.message+"\n\n\n"+data);
		}
	})
});

//////////////////////////////////////////////////////MSG Staff
$(document).on('change','#msgs', function (e) 
{
	var x = $(this).prop('checked');
	$('.msgs').prop('checked',x);
})

function msg_staff_close()
{
	$('#msg_staff').hide();
	close_form_dialog($('#msg_staff_form'));
}

//msg staff
$(document).on('click','#msg_staff_button', function (e) 
{
	var no = $('.msgs:checked').length;
	if(no == 0)
	{
		alert('الرجاء اختيار  شخص او اشخاص اولاً');
		return;
	}
	$('#msg_staff').show();
})

//msg staff close
$(document).on('click','.msg_staff_close', function (e) 
{
	msg_staff_close();
})

//upd_trans submit
$(document).on('click','#add_move_trns', function (e) 
{
	var no = 0;
	var postData;
	
	$('.msgs:checked').each(function(){
		
		var id = $(this).attr('data-id');
		$('#staff_id').val(id);
		postData = $('#msg_staff_form').serializeArray();
		
		$.post(URL+"staff/msg_staff",postData,function(data,status,xhr)
		{
			try {
				var obj = JSON.parse(data);
				if ("Error" in obj)
				{
					error_handler(data);
				}else if("id" in obj && obj.id != 0)
				{
					
				}else
				{
					alert(data);
				}
			}
			catch(err) {
				alert(err.message+"\n"+data);
			}
		})
		no++;
	})
	
	alert("تم ارسال الرسالة ل "+no+" موظف");
	msg_staff_close();
	
})
//////////////////////////////////////////////////////End MSG Staff





