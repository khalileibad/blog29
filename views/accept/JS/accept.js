//JS For news Actions
$(document).ready(function(){
	blog_list();
	comm_list();
	var editor = new Simditor({textarea: $('#blog_content')});
	var editor = new Simditor({textarea: $('#blog_desc')});
	
})

//for paging
function paging_changes()
{
	blog_list();
}

//Get blog List 
function blog_list()
{
	var page_no = 1;
	
	if($("#paging_curr_no").length)
	{
		page_no = $("#paging_curr_no").val();
	}
	
	$.post(URL+"accept/blog_list/"+page_no,{},function(data,status,xhr){
		$("#blog_data").html(data);
	})	
}

//Get comm List 
function comm_list()
{
	$.post(URL+"accept/comm_list/",{},function(data,status,xhr){
		$("#comm_data").html(data);
	})	
}

//profile submit
$('#profile_form').submit(function(e) {
	
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
					location.reload(); 
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

//new_blog_form submit
$('#new_blog_form').submit(function(e) {
	
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
					alert("تم اضافة المدونة بنجاح");
					blog_list();
					close_form_dialog(reg_form);
					$("#blog_image").attr('src',URL+"public/IMG/blog/blog.jpg");
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

//upd_blog_form submit
$('#upd_blog_form').submit(function(e) {
	
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
					alert("تم تعديل واعتماد المدونة بنجاح");
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

//del_blog_form submit
$('#del_blog').click(function(e) {
	alert("ss");
	var postData = $('#upd_blog_form').serializeArray();
	$.post(URL+"accept/del_blog",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تم حذف المدونة بنجاح");
				window.history.back();
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

//Get surgery type list
$(document).on('change','#comm_accept_radio', function (e) 
{
	$(".comm_accept_radio").attr('checked',this.checked);
})

$(document).on('click','#save_comm', function (e) //new_product submit
{
	$('#upd_comments').find(".err_notification").addClass(E_HIDE);
	
	var postData = $('#upd_comments').serializeArray();
	$.post(URL+"accept/upd_comments",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else if("id" in obj && obj.id != 0)
			{
				alert("تم فبول / رفض التعليقات");
				comm_list();
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