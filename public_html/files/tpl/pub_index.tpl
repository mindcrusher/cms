<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{META}
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="/files/styles/public/style.css" rel="stylesheet" type="text/css" />
<script src="/files/js/jquery.js"></script>
<script src="/files/js/jquery.watermark.js" ></script>
<script src="/files/js/bookmark.js" ></script>
<script src="/files/js/swfobject.js" ></script>

<link href="/files/js/li-scroller.css" rel="stylesheet" type="text/css" />
<script src="/files/js/jquery.li-scroller.1.0.js" ></script>
<script>
$(function(){
	$('label').each(function(){
		$(this).next('input[type=text]').watermark($(this).text());
	});
	$('#bookmark').click(function(){
		bookmark(location.href,$('title').text());
	});
	
	swfobject.embedSWF("/files/flash/logo.swf", "flash", "100%", "100%", "9.0.0");
	$("ul#ticker01").liScroll(); 
});
</script>
<style type="text/css">
.watermark {
   color: #999 !important;
}
</style>
<!--
<![if lte IE 7]>
<style type="text/css">
ul#ticker01 {

}
</style>  
<![endif]>
-->
</head>
<body>
<table id="body" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" style="height:325px;" scope="row">
	<div id="head">
	<div class="linkSet">
		<a style="margin-left:35px;" href="/page/0/2/">О компании</a>
		<a style="margin-left:60px;" href="/page/0/3/">Услуги</a>
		<a style="margin-left:55px;" href="/page/0/4/">Оборудование</a>
		<a style="margin-left:20px;" href="/page/0/5/">Информация</a>
		<a style="margin-left:40px;" href="/page/0/6/">Стоимость</a>
		<a style="margin-left:50px;" href="/page/0/7/">Вакансии</a>
		<a style="margin-left:50px;" href="/page/0/8/">Контакты</a>
	</div>
	<div id="flash"></div>
	</div>
	</td>
  </tr>
  <tr>
    <td  id="leftmenu" style="width:200px;">
		{LEFT_MENU}
		<div id="copyright">
			<div class='padd10' style="color:#FFF;">&copy; {CYEAR} &quot;TAGGERD-GROUP&quot;<br />Все права защищены <img src="/files/images/ru_flag.png" /></div>
		</div>
	</td>
    <td class='padd10'>
	<ul id="ticker01">
		<li>
			<span>
			<a>{DESCRIPTION}</a>
			</span>
		</li>
	</ul> 
	<div id="content">
		{CONTENT}<script type="text/javascript">(function(w,doc) {if (!w.__utlWdgt ) {    w.__utlWdgt = true;    var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;    s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';    var h=d[g]('body')[0];    h.appendChild(s);}})(window,document);</script><div data-share-size="20" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1306863" data-mode="share" data-background-color="#ffffff" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-text-color="#000000" data-buttons-color="#FFFFFF" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="fb.vk.tw.ok.gp." data-selection-enable="true" data-exclude-show-more="false" data-share-style="1" data-counter-background-alpha="1.0" data-top-button="false" class="uptolike-buttons" ></div>
	</div>
	</td>
  </tr>
  <tr>
    <td colspan="2" id="footer" scope="row">&nbsp;{FOOTER}
	<div id="counter">1</div>
	</td>
  </tr>
</table>
<div id="bottom"></div>
<div style="width:900px; margin:10px auto;" class='padd10'>{BOTTOM_TEXT}</div>
<div style="display:none;">
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
</div>
</body>

</html>
