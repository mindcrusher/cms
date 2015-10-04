<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Palm Site Engine Admin | Система управления сайтом Palm'</title>
<link rel="shortcut icon" href="../files/images/favicon.png">
<link href="/files/styles/admin/admin.css" rel="stylesheet" type="text/css" />
<link href="/files/js/css/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
<link href="/files/js/fancybox/jquery.fancybox-1.2.6.css" rel="stylesheet" type="text/css" />
<link href="/files/js/css/jquery.inestedsortablewidget.css" rel="stylesheet" type="text/css" />

<script src="/files/js/jquery.js"								type="text/javascript" ></script>
<script src="/files/js/jquery-ui.js"							type="text/javascript" ></script>
<script src='/files/js/jquery.MetaData.js'						type="text/javascript" language="javascript"></script>
<script src='/files/js/jquery.form.js'							type="text/javascript" language="javascript"></script>
<script src='/files/js/jquery.FCKEditor.pack.js'				type="text/javascript" language="javascript"></script>
<script src='/files/js/ckfinder/ckfinder.js'					type="text/javascript" language="javascript"></script>
<script src='/files/js/fancybox/jquery.fancybox-1.2.6.pack.js'	type="text/javascript"></script>
<script src='/files/js/jquery.filestyle.js'						type="text/javascript"></script>


<script src="/files/js/jcode.js" 						type="text/javascript"></script>
</head>
<body>
<table border="0" id="body" cellspacing="0" cellpadding="0">
  <tr>
    <td style="height:32px;"colspan="2">
	<table id='top_admin_panel' width="100%" height="29" border="0" cellpadding="5" cellspacing="0" background="/files/images/admin/menu-bg.jpg">
  <tr>
    <td>
		<a id="home_link" class="topplink" href="/" target="new"></a>
		<a class="topplink" href="/" target="blank">Вернуться на сайт</a>
	</td>
    <td align=right>
		<a id='exit_link' class="topplink" href="login.php?act=logout"></a>
		<a class="topplink" href="login.php?act=logout">Выйти</a>
	</td>
  </tr>
</table>
	</td>
  </tr>
  <tr>
    <td valign="top">
	<div id='menu' style="width:200px;">
	<ul><li><a href="/cms/">Главная</a></li></ul>
	<ul><li><a href="/cms/index.php?type=gb_message&act=view">Гостевая книга</a></li></ul>
	<span class="add">Список страниц</span>
	<div>
		<ul>
			<li class="add"><a class='ajaxLoad' href="form.php?type=page&act=add">Добавить</a></li>
			<li class="add"><a href="/cms/index.php?type=page&act=view">Иерархия страниц</a></li>
		</ul>
		{MAIN_MENU}
	</div>
	<span class="add" >Блоки</span>
	<div>
		<ul><li class="add"><a class='ajaxLoad' href="form.php?type=block&act=add" >Добавить</a></li></ul>
		{LIST_BLOCKS}
	</div>
	<span class="add" >Системные функции</span>
	<div>
		<ul>
			<li><a href="/cms/index.php?type=file&act=view">Управление файлами</a></li>
			<li><a class='ajaxLoad' href="/cms/form.php?type=user&act=change_passwd">Опции авторизации</a></li>
			<li><a href="/backup">Создать Резервную копию БД</a></li>
		</ul>
	</div>
	
	</div>
	</td>
    <td width=90% valign="top">{CONTENT}</td>
  </tr>
  <tr>
	<td style="height:40px;text-align:center;padding:5px" colspan="2"> Palm Site Engine 2009-2010

<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='http://counter.yadro.ru/hit?t42.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,80))+";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'></a>")
//--></script><!--/LiveInternet-->

</td>
  </tr>
</table>
</body>
</html>
