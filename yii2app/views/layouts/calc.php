<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?= Html::encode($this->title) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<? $this->head(); ?>
<link href="/files/styles/public/style.css" rel="stylesheet" type="text/css" />
<script src="/files/js/jquery.watermark.js" ></script>
<script src="/files/js/bookmark.js" ></script>
<script src="/files/js/swfobject.js" ></script>

<link href="/files/js/li-scroller.css" rel="stylesheet" type="text/css" />
<script src="/files/js/jquery.li-scroller.1.0.js" ></script>
<script>
$(function(){
	$('#bookmark').click(function(){
		bookmark(location.href,$('title').text());
	});
	
	swfobject.embedSWF("/files/flash/logo.swf", "flash", "100%", "100%", "9.0.0");
	//$("ul#ticker01").liScroll(); 
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
ul#ticker01 
</style>  
<![endif]>
-->
</head>
<body>
<?php $this->beginBody() ?>
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
		<ul id="nav" ><li><a class='menu-link' title='Частное охранное предприятие, ЧОП Москва' href='/'>Главная</a>
</li><li><a class='menu-link' title='Охрана ЧОП в Москве ' href='/page/0/2/'>О компании</a>
</li><li><a class='menu-link' title='Услуги охраны ЧОП в Москве' href='/page/0/3/'>Охранные услуги</a>
</li><li><a class='menu-link' title='Охрана объектов в Москве' href='/page/0/27/'>Категории объектов</a>
</li><li><a class='menu-link' title='Технические системы безопасности в Москве' href='/page/0/4/'>Оборудование</a>
</li><li><a class='menu-link' title='Виды и типы охраны' href='/page/0/47/'>Виды и типы охраны</a>
</li><li><a class='menu-link' title='Частные охранники Москва' href='/page/0/133/'>Статус охранника</a>
</li><li><a class='menu-link' title='Экипировка частного охранника' href='/page/0/145/'>Экипировка</a>
</li><li><a class='menu-link' title='Инструкция по охране объекта' href='/page/0/28/'>Инструкции</a>
</li><li><a class='menu-link' title='Договор на охрану' href='/page/0/18/'>Договоры</a>
</li><li><a class='menu-link' title='Стоимость охранных услуг в Москве' href='/page/0/6/'>Стоимость услуг</a>
</li><li><a class='menu-link' title='Информация об охранной деятельности' href='/page/0/5/'>Новости и статьи</a>
</li><li><a class='menu-link' title='Законодательство ЧОП и ЧОО' href='/page/0/109/'>Законодательство</a>
</li><li><a class='menu-link' title='Работа в охране Москва' href='/page/0/7/'>Вакансии</a>
</li><li><a class='menu-link' title='ЧОП (Москва) ищет партнеров!!!' href='/page/0/84/'>Партнёрство</a>
</li><li><a class='menu-link' title='Карта сайта' href='/page/0/48/'>Карта сайта</a>
</li><li><a class='menu-link' title='Контакты ЧОП в Москве' href='/page/0/8/'>Контакты</a>
</li></ul>
		<div id="copyright">
			<div class='padd10' style="color:#FFF;">&copy;  &quot;TAGGERD-GROUP&quot;<br />Все права защищены <img src="/files/images/ru_flag.png" /></div>
		</div>
	</td>
    <td class='padd10'>
	<div id="content">
		<?=$content?>
	</div>
	</td>
  </tr>
  <tr>
    <td colspan="2" id="footer" scope="row">&nbsp;
	<div id="counter">1</div>
	</td>
  </tr>
</table>
<div id="bottom"></div>
<div style="width:900px; margin:10px auto;" class='padd10'><table cellspacing="1" cellpadding="3" width="100%" border="0" align="center">
    <tbody>
        <tr>
            <td bgcolor="#3366cc" style="text-align: center" colspan="7"><span style="color: rgb(0,255,255)"><span style="font-size: larger"><span style="font-family: Arial"><span><u><strong>ЗАКАЗЫВАЙТЕ ОХРАНУ ОБЪЕКТОВ У ПРОФЕССИОНАЛОВ !!!</strong></u></span></span></span></span></td>
        </tr>
        <tr>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://www.taggerd.su/page/27/31/"><strong><span style="color: rgb(255,255,0)"><span style="font-size: smaller">ОФИСНЫЙ ЦЕНТР</span></span></strong><span style="color: rgb(255,255,255)"><span style="font-size: smaller"><br />
            </span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/41/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">МУЗЕЙ, ВЫСТАВКА</span></span><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/43/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">КЛИНИКА, БОЛЬНИЦА</span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/44/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">РЫНОК, БАЗАР</span></span><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/20/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">МНОГОКВАРТИРНЫЙ ДОМ</span></span><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/32/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">МАГАЗИН, БУТИК</span></span><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/36/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">РЕСТОРАН, БАР</span></span><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></a></td>
        </tr>
        <tr>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/37/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">ЗАВОД, ФАБРИКА</span></span><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://www.taggerd.su/page/27/40/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">СКЛАД, ТЕРМИНАЛ</span></span><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/33/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">ГАРАЖ, ПАРКИНГ</span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/30/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">ШКОЛА, ВУЗ</span></span><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/42/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">МАССОВОЕ МЕРОПРИЯТИЕ</span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/41/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">ТЕАТР, КИНОТЕАТР</span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/36/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">НОЧНОЙ КЛУБ</span></span></a></td>
        </tr>
        <tr>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://www.taggerd.su/page/27/39/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">БАНК, ОБМЕННИК</span></span><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/34/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">СТРОЙПЛОЩАДКА</span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/33/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">АВТОСАЛОН</span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><span style="color: rgb(255,255,255)"><span style="font-size: smaller"><a href="http://taggerd.su/page/5/93/"><span style="color: rgb(255,255,255)">АПТЕКА</span></a><br />
            </span></span></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/35/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">КОТТЕДЖНЫЙ ПОСЕЛОК</span></span></a></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/99/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">САНАТОРИЙ, ПАНСИОНАТ</span></span></a><span style="color: rgb(0,0,0)"><span style="font-size: smaller"><br />
            </span></span></td>
            <td bgcolor="#3366cc" style="text-align: center"><a href="http://taggerd.su/page/27/98/"><span style="color: rgb(255,255,255)"><span style="font-size: smaller">ФИТНЕС - КЛУБ</span></span></a></td>
        </tr>
    </tbody>
</table>
<div style="text-align: center">&nbsp;<strong><span style="color: rgb(0,0,255)"> НА СТРАЖЕ</span></strong><span style="color: rgb(0,0,255)"><strong> С 1993 ГОДА !!!</strong></span></div>
<div style="text-align: center"><span style="color: rgb(0,0,128)">Наш адрес:&nbsp; г. Москва, Петровско-Разумовская аллея, д. 10 </span><span style="color: rgb(0,0,128)"><br />
</span></div>
<div style="text-align: center"><span style="color: rgb(0,0,128)">Телефоны офиса:&nbsp;<strong> (495)&nbsp; 612-46-71, 78-262-87, 612-46-72 </strong>(тел/факс)<strong><br />
</strong></span></div>
<div style="text-align: center"><span style="color: #0000ff"><strong><a href="http://taggerd.su/page/0/11/"><span style="color: #0000ff">Задайте вопросы, напишите нам!</span></a></strong></span></div></div>
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
<?php $this->endBody();?>
</body>

</html>
<?php $this->endPage();?>