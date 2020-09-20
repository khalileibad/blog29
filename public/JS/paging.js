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
