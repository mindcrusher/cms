<?
#if($_SERVER['REMOTE_ADDR'] != '93.157.169.169') die('Сайт находится в стадии разработке');
/* страница */
if($_GET['pid'] != 0)
	$PSE_VARS['CONTENT'] = getAbsPath($web_resource_id);
if(!empty($_SESSION['Message'])) 
	{	$PSE_VARS['CONTENT'].= "<div class='alert'>{$_SESSION['Message']}</div>"; $_SESSION['Message'] = ''; }
$metasql = $PSE->Select('items','`name`,`short_text`','where id = 1');
switch($_GET['type'])
{
    case 'calc':
        header("Location: /calc/");
    break;
	case'item':
		$_SESSION['HTTP_REFERER'] = $_SERVER['REQUEST_URI'];
		/* титульный текст        */
		$metasql = $PSE->Select('items','`name`,`short_text`','where id = '.$web_resource_id);
		/* данные */
		$sql = $PSE->select('items',' * ','where id = '.$web_resource_id);
		$PSE_VARS['CONTENT'].= $PSE->simpleFetch($sql,'item');
		
		$sql = $PSE->select('photos',' * ','where parent = '.$web_resource_id);
		$subc = $PSE->simpleFetch($sql,'prev_photo');
		
		$sql = $PSE->select('items',
			' `id`,`parent`,`name`,`date`,`short_text`,`xsmall` ','where `display` = "Да"  and id > '.$web_resource_id.' order by date  limit 3');
		
		if(!$res = $PSE->simpleFetch($sql,'prev_item'))
		{
			$sql = $PSE->select('items',
			' `id`,`parent`,`name`,`date`,`short_text`,`xsmall` ','where `display` = "Да"  and id > 0 and id != '.$web_resource_id.' order by date  limit 3');
			$res = $PSE->simpleFetch($sql,'prev_item');
		}
		$subc.= $res;
		if(!empty($res)) $subc = "<h3>Другие посты:</h3>$subc";
		$PSE_VARS['CONTENT'].= $subc;
	break;
	
	case'error':
		$PSE_VARS['CONTENT'] = '<h1>УПС... Ошибочка '.@$_GET['err'].' вышла </h1>';
	break;
	
	case 'sitemap':
		$PSE_VARS['CONTENT'] = '<h1>Карта сайта</h1>';
		$PSE_VARS['CONTENT'].= "<div id='rsitemap'>".genCategoryTree(0,1,'',1)."</div>";
	break;
	
	default:
		$_SESSION['HTTP_REFERER'] = $_SERVER['REQUEST_URI'];
		/* титульный текст        */
		$metasql = $PSE->Select('pages','`title`,`keywords`,`description`','where id = '.$web_resource_id);
		/* данные */
		
		$sql = $PSE->select('pages',' * ','where id = '.$web_resource_id);
		
		$PSE_VARS['CONTENT'].= $PSE->simpleFetch($sql,'page');
		
		if($web_resource_id > 1)
		{
			$sql = $PSE->select('pages',' `id`,`name`,`page`,`parent`','where `display` = "Да" and parent = '.$web_resource_id);
			$subc = $PSE->simpleFetch($sql,'link');
			if(!empty($subc)) $PSE_VARS['CONTENT'].=  "<ul>".$subc."</ul>";
			$sql = $PSE->select('items',
			' `id`,`parent`,`name`,`date`,`short_text`,`xsmall` ','where `display` = "Да"  and parent = '.$web_resource_id.' order by date desc');
			$PSE_VARS['CONTENT'].= $PSE->simpleFetch($sql,'prev_item');
		}
		else
		{
			#	непонятно что всё-таки тут будет
			#	$PSE_VARS['CONTENT'].= getTags();
		}
		
		switch($web_resource_id)
		{
			case 11:
				$_SESSION['HTTP_REFERER'] = $_SERVER['REQUEST_URI'];
		
				$PSE->SetTemplate('feedback_mailme');
				$PSE->parseBuffer($_SESSION['POST']);
				$PSE_VARS['CONTENT'].= $PSE->ReadBuffer();
			break;
			case 19:
				$_SESSION['HTTP_REFERER'] = $_SERVER['REQUEST_URI'];
		
				$PSE->SetTemplate('feedback_services');
				$PSE->parseBuffer($_SESSION['POST']);
				$PSE_VARS['CONTENT'].= $PSE->ReadBuffer();
			break;
		}
		
	break;
}

$PSE_VARS['CONTENT'] = str_replace('taggerd.palmengine.ru','taggerd.su',$PSE_VARS['CONTENT']);

$PSE_VARS['META'] = $PSE->simpleFetch($metasql,'meta');
$PSE_VARS['DESCRIPTION'] = $PSE->SelectResult($PSE->Select('pages','autotext','where id = 1'));
$PSE_VARS['DESCRIPTION'] = $PSE_VARS['DESCRIPTION'][0]['autotext'];

/* основное меню          */
$PSE_VARS['LEFT_MENU'] = genCategoryTree(0);

/* собираем блоки на страницах */
$s = $PSE->Select('blocks');
$r = $PSE->Query($s);
while ($block_data = @mysql_fetch_assoc($r))
	$PSE_VARS[$block_data['constant']] = $block_data['text'];
?>
