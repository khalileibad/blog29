//JS For news Actions
$(document).ready(function(){
	people_list();
})

//Get news List 
function people_list()
{
	if($('#people_details_info').length)
	{
		$.post(URL+"home/peo_info",{},function(data,status,xhr){
			$("#people_details_info").html(data);
		})
	}
	if($('#worker_details_info').length)
	{
		$.post(URL+"home/work_info",{},function(data,status,xhr){
			$("#worker_details_info").html(data);
		})
	}
	
}

//////////////////////////////////Updating land, house Data
//open / close tabs
$(document).on('click','.peo_menus', function (e) 
{
	var id = $(this).attr('data-id');
	$("#"+id).toggleClass("w3-hide");
})

//Forms submit
$('.upd_people_info').submit(function(e) {
	
	var reg_form = $(this);
	$(this).find(".err_notification").addClass(E_HIDE);
	
	var postData = $(this).serializeArray();
	e.preventDefault();
	
	//$('#loader-icon').show();
	$(this).ajaxSubmit({ 
	
		target:   '#targetLayer', 
		beforeSubmit: function() {
			form_progress(0);
		},
		uploadProgress: function (event, position, total, percentComplete){	
			form_progress(percentComplete);
		},
		success:function (){
			form_progress(100);
			var x = $('#targetLayer').html();
			try {
				var obj = JSON.parse(x);
				if ("Error" in obj)
				{
					error_handler(x);
				}else if("id" in obj && obj.id != 0)
				{
					alert("تم التعديل بنجاح");
				}else
				{
					alert(x);
				}
			}
			catch(err) {
				alert(err.message+"\n\n\n"+x);
			}
		},
		resetForm: false
	});
	return false; 
})

//////////////////////////////////End Updating land, house Data

//////////////////////////////////Add people Data
//New people Open
$(document).on('click','#new_people_button', function (e) 
{
	$('#new_people').show();
})

//close New people
function new_people_close()
{
	$('#new_people').hide()
	close_form_dialog($('#new_people_form'))
}

$(document).on('click','.new_people_close', function (e) 
{
	new_people_close();
})

//new_people submit
$(document).on('click','#add_new_people', function (e) 
{
	var postData = $('#new_people_form').serializeArray();
	$.post(URL+"home/new_people",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تمت اضافة شخص جديد");
				people_list();
				new_people_close();
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

//////////////////////////////////End add people Data

//////////////////////////////////update people Data
//update people Open
$(document).on('click','.peo_upd', function (e) 
{
	var row = $(this).parent().parent();
	
	$('#upd_id').val(row.find(".peo_id").html());
	$('#upd_name').val(row.find(".peo_name").attr('data-ar'));
	$('#upd_name_en').val(row.find(".peo_name").attr('data-en'));
	$('#upd_phone').val(row.find(".peo_phone").html());
	$('#upd_email').val(row.find(".peo_email").html());
	$('#upd_id_type').val(row.find(".peo_id_type").attr('data-id'));
	$('#upd_id_no').val(row.find(".peo_id_no").html());
	$('#upd_gender').val(row.find(".peo_gender").attr('data-id'));
	$('#upd_birth').val(row.find(".peo_birth").html());
	$('#upd_nat').val(row.find(".peo_nat").attr('data-id'));
	$('#upd_soc').val(row.find(".peo_soc").attr('data-id'));
	$('#upd_aca').val(row.find(".peo_aca").attr('data-id'));
	$('#upd_job').val(row.find(".peo_job").html());
	
	$('#upd_people').show();
})

//close Update people
function upd_people_close()
{
	$('#upd_people').hide()
	close_form_dialog($('#upd_people_form'))
}

$(document).on('click','.upd_people_close', function (e) 
{
	upd_people_close();
})

//upd_people submit
$(document).on('click','#add_upd_people', function (e) 
{
	var postData = $('#upd_people_form').serializeArray();
	$.post(URL+"home/upd_people",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تم تعديل بيانات الشخص");
				people_list();
				upd_people_close();
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

//delete people
$(document).on('click','.peo_del', function (e) 
{
	var id 		= $(this).parent().parent().find(".peo_id").html();
	var name 	= $(this).parent().parent().find(".peo_name").attr('data-ar');
	
	if(confirm("هل انت مثأكد من انك تريد مسح المواطن "+name))
	{
		$.post(URL+"home/del_people/"+id,{},function(data,status,xhr)
		{
			try {
				var obj = JSON.parse(data);
				if ("Error" in obj)
				{
					error_handler(data);
				}else if("id" in obj && obj.id != 0)
				{
					alert("تم مسح بيانات الشخص");
					people_list();
				}else
				{
					alert(data);
				}
			}
			catch(err) {
				alert(err.message+"\n"+data);
			}
		})
	}
	
	
})

//////////////////////////////////End update people Data


//////////////////////////////////New worker Data
//New people Open
$(document).on('click','#new_worker_button', function (e) 
{
	$('#new_worker').show();
})

//close New worker
function new_worker_close()
{
	$('#new_worker').hide()
	close_form_dialog($('#new_worker_form'))
}

$(document).on('click','.new_worker_close', function (e) 
{
	new_worker_close();
})

//new_worker submit
$(document).on('click','#add_new_worker', function (e) 
{
	var postData = $('#new_worker_form').serializeArray();
	$.post(URL+"home/new_worker",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تمت اضافة شخص جديد");
				people_list();
				new_worker_close();
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
//////////////////////////////////End new worker Data

//////////////////////////////////update worker Data
//update people Open
$(document).on('click','.work_upd', function (e) 
{
	var row = $(this).parent().parent();
	
	$('#work_id').val(row.find(".work_id").html());
	$('#upd_work_name').val(row.find(".work_name").attr('data-ar'));
	$('#upd_work_name_en').val(row.find(".work_name").attr('data-en'));
	$('#upd_work_phone').val(row.find(".work_phone").html());
	$('#upd_work_gender').val(row.find(".work_gender").attr('data-id'));
	$('#upd_work_nat').val(row.find(".work_nat").attr('data-id'));
	$('#upd_work_soc').val(row.find(".work_soc").attr('data-id'));
	$('#upd_work_job').val(row.find(".work_job").html());
	
	$('#upd_worker').show();
})

//close Update people
function upd_work_close()
{
	$('#upd_worker').hide()
	close_form_dialog($('#upd_worker_form'))
}

$(document).on('click','.upd_worker_close', function (e) 
{
	upd_work_close();
})

//upd_worker submit
$(document).on('click','#add_upd_worker', function (e) 
{
	var postData = $('#upd_worker_form').serializeArray();
	$.post(URL+"home/upd_worker",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تم تعديل بيانات الشخص");
				people_list();
				upd_work_close();
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

//delete worker
$(document).on('click','.work_del', function (e) 
{
	var id 		= $(this).parent().parent().find(".work_id").html();
	var name 	= $(this).parent().parent().find(".work_name").attr('data-ar');
	
	if(confirm("هل انت مثأكد من انك تريد مسح العامل "+name))
	{
		$.post(URL+"home/del_worker/"+id,{},function(data,status,xhr)
		{
			try {
				var obj = JSON.parse(data);
				if ("Error" in obj)
				{
					error_handler(data);
				}else if("id" in obj && obj.id != 0)
				{
					alert("تم مسح بيانات العامل");
					people_list();
				}else
				{
					alert(data);
				}
			}
			catch(err) {
				alert(err.message+"\n"+data);
			}
		})
	}
	
	
})

//////////////////////////////////End update work Data
