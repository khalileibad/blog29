//JS For agent Actions
$(document).ready(function(){
	blog_list();
})
function paging_changes()
{
	blog_list();
}
//Get agent List 
function blog_list()
{
	var page_no = 1;
	var category =  $("#category").val();
	
	if($("#paging_curr_no").length)
	{
		page_no = $("#paging_curr_no").val();
	}
	
	$.post(URL+"blog/blog_list/"+category+"/"+page_no,{},function(data,status,xhr){
		$("#blog_data").html(data);
	})
}


//For Paging
//Previous page
$(document).on('click','#paging_prev', function (e) 
{
	if(!$(this).parent().hasClass("disabled"))
	{
		$curr = $('#paging .active');
		$next = $('#paging .active').prev();
		
		if($next.html() != $(this).parent().html())
		{
			$curr.removeClass('active');
			$next.addClass('active');
			$("#paging_curr_no").val($next.find('a').attr('data-id'));
			paging_changes();
		}
	}
})

//Next page
$(document).on('click','#paging_next', function (e) 
{
	if(!$(this).parent().hasClass("disabled"))
	{
		$curr = $('#paging .active');
		$next = $('#paging .active').next();
		if($next.html() != $(this).parent().html())
		{
			$curr.removeClass('active');
			$next.addClass('active');
			$("#paging_curr_no").val($next.find('a').attr('data-id'));
			paging_changes();
		}
	}
})

//select page
$(document).on('click','.paging_no', function (e) 
{
	$('#paging .active').removeClass('active');
	$(this).addClass('active');
	$("#paging_curr_no").val($(this).html());
	paging_changes();
		
})

//blog like and comment:

// like
$(document).on('click','#add_like', function (e) 
{
	var blog_id = $('#blog_id').val();
	$.post(URL+"blog/blog_like/"+blog_id,{},function(data,status,xhr){
		var obj = JSON.parse(data);
		if ("like" in obj)
		{
			$('#like_count').html(obj.like);
		}
	})	
})

//contact Form
$(document).on('submit','#blog_comment', function (e) 
{
	e.preventDefault();
	$(".err_notification").addClass("d-none");
	var postData = $('#blog_comment').serializeArray();
		
	$.post(URL+"blog/comment",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if ("Error" in obj)
			{
				error_handler(data);
			}else
			{
				$('#comm_ok').modal('show');
			}
		}
		catch(err) {
			alert(err.message+"\n"+data);
		}
	})
	return false;
})