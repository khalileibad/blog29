//JS For news Actions
$(document).ready(function(){
	people_list();
})

//Get news List 
function people_list()
{
	if($('#people_list').length)
	{
		var postData = $('#people_search').serializeArray();
		$.post(URL+"people/people_list",postData,function(data,status,xhr){
			$("#people_list").html(data);
		})
	}
	if($('#req_people_list').length)
	{
		var postData = $('#people_search').serializeArray();
		$.post(URL+"people/req_people_list",postData,function(data,status,xhr){
			$("#req_people_list").html(data);
		})
	}
	if($('#people_details_info').length)
	{
		var id = $('#h_id').val()
		$.post(URL+"people/peo_info/"+id,{},function(data,status,xhr){
			$("#people_details_info").html(data);
		})
	}
	if($('#worker_details_info').length)
	{
		var id = $('#h_id').val()
		$.post(URL+"people/work_info/"+id,{},function(data,status,xhr){
			$("#worker_details_info").html(data);
		})
	}
	
}

//search button
$(document).on('click','#search_people', function (e) 
{
	people_list();
})

/////////////////////////////////Accept Request
$(document).on('click','.accept_req', function (e) 
{
	$id = $(this).parent().parent().find('.req_id').html();
	$.post(URL+"people/accept_req/"+$id,{},function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تمت اضافة مواطن جديد");
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
})
//////////////////////////////////End Accept Request

/////////////////////////////////Del Request
// Open Del window
$(document).on('click','.del_req', function (e) 
{
	var id = $(this).parent().parent().find('.req_id').html();
	$('#upd_id').val(id);
	$('#del_request').show();
})

//close del window
function del_req_close()
{
	$('#del_request').hide();
	close_form_dialog($('#del_request_form'));
}

$(document).on('click','.del_request_close', function (e) 
{
	del_req_close();
})

//Accept Del Request
$(document).on('click','#add_del_request', function (e) 
{
	var postData = $('#del_request_form').serializeArray();
	$.post(URL+"people/del_req/",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تم حذف الطلب");
				people_list();
				del_req_close();
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
//////////////////////////////////End del Request

//////////////////////////////////New Land
//New Land Open
$(document).on('click','#new_land_button', function (e) 
{
	$('#new_land').show();
})

//close New Land
function new_land_close()
{
	$('#new_land').hide()
	close_form_dialog($('#new_land_form'))
}

$(document).on('click','.new_land_close', function (e) 
{
	new_land_close();
})

//new_land submit
$(document).on('click','#add_new_land', function (e) 
{
	var postData = $('#new_land_form').serializeArray();
	$.post(URL+"people/new_land",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تمت اضافة أرض جديدة");
				//people_list();
				new_land_close();
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
//////////////////////////////////End New Land

//////////////////////////////////New House
//New house Open
$(document).on('click','#new_house_button', function (e) 
{
	$('#new_house').show();
})

//close New Land
function new_house_close()
{
	$('#new_house').hide()
	close_form_dialog($('#new_house_form'))
}

$(document).on('click','.new_house_close', function (e) 
{
	new_house_close();
})

//new_house submit
$(document).on('click','#add_new_house', function (e) 
{
	var postData = $('#new_house_form').serializeArray();
	$.post(URL+"people/new_house",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تمت اضافة وحدة سكنية جديدة");
				people_list();
				new_house_close();
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
//////////////////////////////////End New House

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
	$.post(URL+"people/new_people",postData,function(data,status,xhr)
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
	$.post(URL+"people/upd_people",postData,function(data,status,xhr)
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
		$.post(URL+"people/del_people/"+id,{},function(data,status,xhr)
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
	$.post(URL+"people/new_worker",postData,function(data,status,xhr)
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
	$.post(URL+"people/upd_worker",postData,function(data,status,xhr)
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
		$.post(URL+"people/del_worker/"+id,{},function(data,status,xhr)
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
