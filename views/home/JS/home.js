//JS For news Actions
$(document).ready(function(){
	blog_list();
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
	
	$.post(URL+"home/blog_list/"+page_no,{},function(data,status,xhr){
		$("#blog_data").html(data);
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
					alert("تم اضافة المدونة بنجاح");
					
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

