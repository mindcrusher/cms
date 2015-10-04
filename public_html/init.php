<?
session_start();
#set_error_handler('PSE_error_handler');
error_reporting(0);
ini_set('php_flag session.use_only_cookies', true);
ini_set('php_flag session.use_trans_sid', false);
define('ENGINE_ROOT',dirname(__FILE__)."/");
if(file_exists(ENGINE_ROOT."config.ini"))
{
	$cfg = parse_ini_file(ENGINE_ROOT."config.ini");
	foreach ($cfg as $constant => $constant_value)
	{
		define($constant,$constant_value);
	}
	
}
else
{
	die("File <b>".ENGINE_ROOT."config.ini</b> is not exists.");
}
define('PAGE_LINK',"/page/{parent}/{key}/");
require(ENGINE_ROOT."/classes/class.Buffering.php");
require(ENGINE_ROOT."/classes/class.DataProvider.php");
require(ENGINE_ROOT."/classes/class.ImageMagic.php");
require(ENGINE_ROOT."/classes/class.XMailer.php");
require(ENGINE_ROOT."/commons/functions.php");
require(ENGINE_ROOT."/commons/language.php");

/* инициализация */
$PSE_VARS['SERVER'] = str_replace('www.','',$_SERVER['HTTP_HOST']);

$PSE_VARS['CONTENT'] = '';

$PSE = new DataProvider();
$PSE->Connect();
#$PSE->StoreDB('palm_engine_dump.sql');

/* принимаем только числа */
$web_resource_id = 0;
if(isset($_GET['id']))
	$web_resource_id = (int)$_GET['id'];
if(!isset($_GET['pid']))
	$_GET['pid'] = 0;
if(!isset($_GET['type']))
	$_GET['type'] = 'error';
	
$PSE_VARS['_GETid'] = $web_resource_id;
$PSE_VARS['_GETpid'] = (int)$_GET['pid'];
/*
function PSE_error_handler($code, $msg, $file, $line)
{
	$date = date('d.m.Y H:i:s');
	$logfile = ENGINE_ROOT.'commons/error.log';
	$text = "$date Произошла ошибка ``$msg`` , код $code, ";
	$text.= "$file строка ($line)\n";
	if(false !== ($f = fopen($logfile,'a+')))
	{
		flock($f,LOCK_EX);
		fwrite($f,$text);
		flock($f,LOCK_UN);
		fclose($f);
	}
	else echo nl2br($text."\n Невозможно записать информацию в лог-файл $logfile");
	
	echo $text;
}*/
?>