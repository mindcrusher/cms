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
	$('.fck').fck();
	
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
	
	$('.checkAll').change(function(){
		var target = $(this).val();
			target = '.'+target;
		$(target).attr('checked',$(this).attr('checked'));
	});

	$('.showHint').hover(
		function(){
			$(this).next('div.hint').stop().fadeIn(152);
		},
		function(){
			$(this).next('div.hint').stop().fadeOut(152);
		}
	);
	
	$('table.datagrid tbody').each(function(i,item){
		$(item).sortable({
         items: "tr",
		 handle: '.handle',
		 axis: 'y',
		 stop: function(i){
			var cparam = location.search.substr(1);
			
			var data = $('table.datagrid tbody').sortable("serialize");
				data += '&' +cparam;
				data += '&table='+$(item).parent().attr('rel');
			$.post('/cms/jsorter.php',data,function(data){});
		 }
      });	
	});
	
	ShareMethods();
});

function checkAll(obj)
{
	alert($(obj).val());
}

function ShareMethods()
{
	$("a[href*=.jpg],a[href*=.gif],a[href*=.png],a[href*=.JPG],a[href*=.GIF],a[href*=.PNG],").fancybox();
	$('input[name=date]').datepicker();
	$('.fck').fck();
	$("input[type=file]").filestyle({
		image: "/files/images/choose-file.gif",
		imageheight : 22,
		imagewidth : 82,
		width : 250
	});
}