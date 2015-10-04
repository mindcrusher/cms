<?php
session_start();
$HOST = str_replace('www.','',$_SERVER['HTTP_HOST']);
$lang = array(
'name' => 'ФИО',
'comments' => 'Сообщение',
'Email' => 'Эл. адрес',
'phone' => 'Телефон',
'subject' => 'Тема'
);
// проверка полей
$_SESSION['Message'] = "Допущены ошибки при вводе данных. Все поля обязательны";
$checkedData = true;
foreach($_POST as $key => $v)
{
	$key = str_replace('_',' ',$key);
	$_SESSION['POST'][$key] = $v;
}

foreach($_POST as $key => $v)
{
	if(strlen($v) < 2 && $key != 'Дополнительно')
	{
		$checkedData = false;
		break;
	}
}
if($checkedData)
{
foreach($_POST as $key => $value)
{
	$field = str_replace('_',' ',$key);
	if(key_exists($key,$lang))
		$field = $lang[$key];
	if(empty($value)) $value = '&nbsp;';
	
	$msg.= "<tr>\n";
	$msg.= "<td width=150>$field</td>";
	$msg.= "<td>$value</td>";
	$msg.= "</tr>";
}

if(!empty($msg))
	$msg = "<table width=\"100%\" border='1'>".$msg."</table>";

$sbj = 'Заявка с сайта '.$HOST;


$header['From']						= 'robot@'.$HOST;
$header['MIME-Version']				= '1.0';
$header['Content-Type']				= 'text/html; charset="koi8-r"';
$header['Return-path']				= 'i.mazikin@gmail.com';
$header['Content-Encoding']			= 'koi8-r';
$header['Content-Disposition']		= 'inline';
$header['Content-Transfer-Encoding']= 'quoted-printable';
$header['User-Agent']				= 'PHP X-MAILER 1.0';
$headers = null;
foreach($header as $headkey => $headvalue)
	$headers.="$headkey: $headvalue\n";

$sbj = convert_cyr_string($sbj,'w','k');
$msg = convert_cyr_string($msg,'w','k');
$headers = convert_cyr_string($headers,'w','k');

$msg = 'Проверка';
$sbj = 'sdfsdf sdf sfsd sdf';
$coninue = false;
$adresat = 'ogni-s@mail.ru';
$adresat.= ",ogni7826287@yandex.ru,i.mazikin@gmail.com";
if(!preg_match('#http:#i',$msg))
	$coninue = true;

	
	if($coninue == true)
	{
		echo "$adresat<br/>";
		echo "$sbj<br/>";
		echo $msg;
		if($r = mail($adresat,$sbj,$msg,$headers));
			$_SESSION['Message'] = "Письмо отправлено";
		var_dump($r);
	}

}

