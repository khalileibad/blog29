//JS For news Actions
$(document).ready(function(){
	news_list();
})

//Get news List 
function news_list()
{
	var postData = $('#news_search').serializeArray();
	
	$.post(URL+"news/news_list",postData,function(data,status,xhr){
		$("#news_list").html(data);
	})
}

//searchn
$(document).on('click','#search_news', function (e) 
{
	news_list();
})

///////////////////////////////////////New News
//clear new_news form
function new_news_close()
{
	$('#new_news').hide()
	close_form_dialog($('#new_news_form'))
}

//New news Open
$(document).on('click','#new_news_button', function (e) 
{
	$('#new_news').show();
})

//new_news close
$(document).on('click','.new_news_close', function (e) 
{
	new_news_close();
})

//new_news submit
$(document).on('click','#add_new_news', function (e) 
{
	try {
		$('#new_news_form').ajaxSubmit({ 
			target:   '#targetLayer', 
			beforeSubmit: function() {
				form_progress(0);
			},
			uploadProgress: function (event, position, total, percentComplete){	
				form_progress(percentComplete);
			},
			success:function (){
				form_progress(100);
				var data = $('#targetLayer').html();
				var obj = JSON.parse(data);
				if ("Error" in obj)
				{
					error_handler(data);
				}else if("id" in obj && obj.id != 0)
				{
					alert("تمت اضافة خبر جديد");
					news_list();
					new_news_close();
				}else
				{
					alert(data);
				}
			},
			resetForm: false
		});
	}
	catch(err) {
		alert(err.message);
	}
})

///////////////////////////////////////End New News

///////////////////////////////////////Update News

//clear upd_news form
function upd_news_close()
{
	$('#upd_news').hide()
	close_form_dialog($('#upd_news_form'))
}

//upd news Open
$(document).on('click','.upd_news', function (e) 
{
	var id = $(this).parent().parent().find(".news_id").html();
	$.post(URL+"news/news_data/"+id,{},function(data,status,xhr){
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				alert(obj.Error);
			}else
			{
				$('#upd_id').val(obj.id);
				$('#upd_name').val(obj.name);
				$('#upd_name_en').val(obj.name_en);
				$('#upd_title').val(obj.title);
				$('#upd_title_en').val(obj.title_en);
				$('#upd_details').val(obj.details);
				$('#upd_details_en').val(obj.details_en);
				$('#old_img').val(obj.img);
				if(obj.img != "")
				{
					var img = URL+"public/IMG/news/"+obj.id+"/"+obj.img;
					$('#upd_profile_img').attr('src',img);
					
				}
				$('#upd_news').show();
			}
		}
		catch(err) {
			alert(err.message+"\n"+data);
		}
	})
	
})

//upd_news submit
$(document).on('click','#add_upd_news', function (e) 
{
	try {
		$('#upd_news_form').ajaxSubmit({ 
			target:   '#targetLayer', 
			beforeSubmit: function() {
				form_progress(0);
			},
			uploadProgress: function (event, position, total, percentComplete){	
				form_progress(percentComplete);
			},
			success:function (){
				form_progress(100);
				var data = $('#targetLayer').html();
				alert(data);
				var obj = JSON.parse(data);
				if ("Error" in obj)
				{
					alert(data);
					error_handler(data);
				}else if("id" in obj && obj.id != 0)
				{
					alert("تم تعديل الخبر");
					news_list();
					upd_news_close();
				}else
				{
					alert(data);
				}
			},
			resetForm: false
		});
	}
	catch(err) {
		alert(err.message);
	}
})

//upd_news close
$(document).on('click','.upd_class_close', function (e) 
{
	upd_news_close();
})


//active - freeze group
$(document).on('click','.news_act', function (e) 
{
	var cl = $(this);
	var id = cl.parent().parent().find(".news_id").html();
	var crt= $("#csrf").val();
	var active = cl.hasClass("w3-red"); // w3-red:w3-green
	
	$.post(URL+"news/active",{csrf:crt,id:id,current:active},function(data,status,xhr){
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				alert(obj.Error);
			}else
			{
				alert("تم تجميد / فك تجميد الخبر")
				news_list();
			}
		}
		catch(err) {
			alert(err.message+"\n\n\n"+data);
		}
	})
});


//del news Open
$(document).on('click','.news_del', function (e) 
{
	var row = $(this).parent().parent();
	
	var no = row.find(".ty_tras").html();
	if(no != 0)
	{
		alert("توجد معاملات بهذا النوع");
		return;
	}
	if(confirm("هل انت متأكد من انك تريد حذف هذا النوع؟"))
	{
		var id = row.find(".ty_id").html();
		var csrf = $('#csrf').val();
		$.post(URL+"news/del_news",{"id":id,"csrf":csrf},function(data,status,xhr)
		{
			try {
				var obj = JSON.parse(data);
				if ("Error" in obj)
				{
					alert(obj.Error);
				}else
				{
					alert("تم حذف النوع");
					news_list();
					
				}
			}
			catch(err) {
				alert(err.message+"\n"+data);
			}
		})
	}
	
	$('#upd_class').show();
})
