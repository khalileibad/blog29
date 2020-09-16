//////////////////////////////////Uploading File
//data:
var card, name, name_en,id_no,id_type phone, email, gender, birth, nat, soc, aca, job;

//Check Header
$(document).on('click','#upload_Student_button', function (e) 
{
	if(!$('#upl_list').length)
	{
		alert('قم بإختبار ملف الاكسل اولاً');
		return;
	}
	var header = [];
	
	$("#upl_list thead td").each(function(){
		header.push($(this).text());
	});
	
	card 	= header.indexOf("رقم البطاقة الخدمية");
	name 	= header.indexOf("الإسم");
	name_en = header.indexOf("Name");
	id_no 	= header.indexOf("رقم الهوية");
	id_type = header.indexOf("نوع الهوية");
	phone 	= header.indexOf("رقم الهاتف");
	email 	= header.indexOf("البريد الالكتروني");
	gender 	= header.indexOf("الجنس");
	birth 	= header.indexOf("تاريخ الميلاد");
	nat 	= header.indexOf("الجنسية");
	soc 	= header.indexOf("الحالة الإجتماعية");
	aca 	= header.indexOf("المستوى الأكاديمي");
	job 	= header.indexOf("الوظيفة");
	
	var err = false;
	var msg = "";
	if(card == -1)
	{
		msg .= "حقل البطاقة الخدمية غير موجود\n";
		err = true;
	}
	if(name == -1)
	{
		msg .= "حقل  الإسم غير موجود \n";
		err = true;
	}
	if(name_en == -1)
	{
		msg .= "حقل الإسم الانجليزي غير موجود\n";
		err = true;
	}
	if(phone == -1)
	{
		msg .= "حقل الهاتف غير موجود\n";
		err = true;
	}
	if(email == -1)
	{
		msg .= "حقل البريد الالكتروني غير موجود \n";
		err = true;
	}
	if(gender == -1)
	{
		msg .= "حقل الجنس غير موجود\n";
		err = true;
	}
	if(birth == -1)
	{
		msg .= "حقل تاريخ الميلاد غير موجود\n";
		err = true;
	}
	if(nat == -1)
	{
		msg .= "حقل الجنسية غير موجود \n";
		err = true;
	}
	if(soc == -1)
	{
		msg .= "حقل الحالة الإجتماعية غير موجود \n";
		err = true;
	}
	if(aca == -1)
	{
		msg .= "حقل المستوى الأكاديمي غير موجود\n";
		err = true;
	}
	if(job == -1)
	{
		msg .= "حقل الوظيفة غير موجود \n";
		err = true;
	}
	
	if(err)
	{
		alert(msg);
		return;
	}
	
	$( "#upl_list thead tr" ).append( "<td>Status</td>" );
	
	var row;
	var row_data;
	
	$("#upl_list tbody tr").each(function(){
		row = $(this);
		row_data = [];
		$(this).find('td').each(function(){
			row_data.push($(this).text());
		});
		
		if(row_data[card] != "" && row_data[name]!= "")
		{
			send_data(row_data,$(this));
		}
	});
})

//send Data
function send_data(row_data,row)
{
	var postData = {
					csrf	: $('#csrf').val(),
					card	: row_data[card],
					name	: row_data[name],
					name_en	: row_data[name_en],
					id_no	: row_data[id_no],
					id_type	: row_data[id_type],
					phone	: row_data[phone],
					email	: row_data[email],
					gender	: row_data[gender],
					birth	: row_data[birth],
					nat		: row_data[nat],
					social	: row_data[soc],
					acadimic: row_data[aca],
					job		: row_data[job]
					};
	
	$.post(URL+"people/new_people",postData,function(data,status,xhr)
	{
		try {
			var obj = JSON.parse(data);
			if('id' in obj && obj.id != 0)
			{
				row.append( "<td class='w3-green'>تم إضافة المواطن بنجاح!</td>" );
			}else if ("Error" in obj)
			{
				row.append( "<td class='w3-red'>"+obj.Error+"</td>" );
			}else
			{
				row.append( "<td class='w3-red'>"+data+"</td>" );
			}
		}
		catch(err) {
			alert(err.message+"\n"+data);
		}
	});
}
//////////////////////////////////End Uploading File
