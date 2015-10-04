$(document).ready(function(){
	
	// Dialog
	baseDialogOptions = {
		autoOpen: true,
		width: 300,
		modal:true,
		buttons: {
			"Закрыть": function() { 
					$(this).dialog("close");
				}
			}
		}
	formDialogOptions = {
		autoOpen: false,
		width: 900,
		modal:true,
		buttons: {
			"Закрыть": function() { 
					$(this).dialog("close");
				},
			"Сохранить":function(){
				$(this).find('form').submit();
			}
			}
		};
	$('div.Dialog').dialog(baseDialogOptions);
	// Dialog
	$('div.alert').dialog(baseDialogOptions);
	
	// Dialog Link
	$('a.openDialog').click(function(){
		$($(this).attr('href')).dialog('open');
		return false;
	});
	
	$('a.del').click(function(){
		var href = $(this).attr('href');
		var title = $(this).attr('title');
		$('<div></div>').html('Вы действительно хотите удалить <b>' + title + '</b>?').dialog({
			buttons:{
				"Нет":function(){$(this).dialog("close");},
				"Да":function(){location.href = href}
			}
		});
		return false;
	});	
	
	$.fck.config = {path:'/files/js/fckeditor/',height:300}; 
	$('.fck').fck(function()
	{
		CKFinder.SetupCKEditor( this );
	});
	
	$('table.datagrid tbody tr').css('background','#DDD');
	$('table.datagrid tbody tr:odd').css('background','#EEE');
	
	$('a.ajaxLoad').click(function(){
		target = $(this).attr('href');
		obj = $('<div></div>').dialog(baseDialogOptions);
		obj.dialog('open').html('<div class="ajaxloadprogress">Секундочку...</div>');
		$.get(target,function(data){
			obj.html(data);
		//	obj.find('textarea.fck').fck();
			obj.dialog('close');
			obj.removeClass('ajaxloadprogress');
			obj.dialog(formDialogOptions).dialog('open');
			ShareMethods();			
		});
		return false;
	});
	
	$('#checkAll').change(function(){
		$('input[type=checkbox][name*=check]').attr('checked',$(this).attr('checked'));
	});
	
	ShareMethods();
});

function checkAll(obj)
{
	alert($(obj).val());
}

function ShareMethods()
{
	$("a[href*=.jpg],a[href*=.gif],a[href*=.png],").fancybox();
	$('input[name=date]').datepicker();
	$('.fck').fck(function(){
		CKFinder.SetupCKEditor( this, '/files/js/ckfinder/' );
	});
	$("input[type=file]").filestyle({
		image: "http://www.appelsiini.net/projects/filestyle/choose-file.gif",
		imageheight : 22,
		imagewidth : 82,
		width : 250
	});
}