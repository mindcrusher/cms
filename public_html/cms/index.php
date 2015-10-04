<?
#die('ss');
require("../classes/class.ProfileCode.php");
$pp = new profileCode();
$pp->setStartTime();
require("../init.php");
$_SESSION['HTTP_REFERER'] = $_SERVER['REQUEST_URI'];
$wrid = $web_resource_id;
$wrpd = (int)$_GET['pid'];
$design = 'auth_page';
$PSE_VARS['ALERT'] = $PSE->readMessage();
if(isset($_SESSION['Client']) && $_SESSION['Client']['auth'] === true)
{
	$design = 'index';
	
	$type = 'error';
	$act = 'bad';
	
	if(isset($_GET['type']) && isset($_GET['act']))
	{
		$type = preg_replace('#[^\w\d]#','',$_GET['type']);
		$act  = preg_replace('#[^\w\d]#','',$_GET['act']);
	}
	
	$subtype = array();
	$SUBDATA = '';
	if(in_array($type,array('page','item','photo')))
	$PSE_VARS['CONTENT'] = getAbsPath($web_resource_id);
	$PSE_VARS['CONTENT'].= $PSE_VARS['ALERT'];
	$PSE_VARS['MAIN_MENU'] = GenCategoryTree();
	
	if( isset($act)
		&& isset($type)
		&& in_array($act,array('add','edit','view','change_passwd'))
		&& in_array($type,array('page','gb_message','item','photo','user','comment','block','file'))
	  )
	{
		$type.= "s";
		$show = '';
		switch($type)
		{
			case'pages':
				$subtype[] = 'items';
			break;
			case'items':
				$subtype[] = 'photos';
				$subtype[] = 'comments';
			break;
			case'photos':
			#	$subtype[] = 'items';
				$show = "&form-show";
			break;
		}
		
		switch($act)
		{
			case'add':
				$SUBDATA.= $PSE->GenFormFromData($PSE->Select($type,'*','where id = 0'),'actions.php?act=add');
				
			break;
			case'change_passwd':
				$PSE->setTemplate('change_passwd');
				$SUBDATA.= $PSE->readBuffer();
				
			break;
			
			case'view':
				$cond = '';
				$keys = 'id,name,parent';
				$row   = 'preview_uitem';
				$table = 'table_preview_item';
				if($type == 'files')
				{ 
					$keys = '*'; 
					$row = 'files_row';
					$table = 'files_table';
				}
				if($type == 'pages')
				{
					$cond = ' where parent < 2';
					$PSE_SYS_LANG['pages'] = 'Страницы первого уровня';
				}
				$cond.=' order by position';
				if($type == 'gb_messages')
				{
					$keys = '*';
					$cond =' order by date desc';
					$row  = 'gb_row';
					$table= 'gb_table';
				}
				
				$SUBDATA = $SUBDATA.= "<a class='ajaxLoad ui-state-highlight ui-corner-all btn' href='form.php?type=".substr($type,0,-1)."&act=add'>Добавить</a>";
				$SUBDATA.= $PSE->simpleFetch($PSE->Select($type,$keys,$cond),$row,$table);

			break;
			case'edit':
				if($wrid == 23) $PSE_SYS_LANG['items'] = 'работы';
				if($wrid == 25) $PSE_SYS_LANG['items'] = 'статьи';
				if($wrid == 38) $PSE_SYS_LANG['items'] = 'новости';
				
				$formUrl = str_replace('index.php','form.php',$_SERVER['REQUEST_URI']);
						
				$SUBDATA.= "<a class='ajaxLoad ui-state-highlight ui-corner-all btn' href='$formUrl'>Редактировать текст</a>";
				
				if($wrpd == 0 && $wrid == 1 && $type == 'pages')
					$SUBDATA.= '';
				elseif(isset($subtype[0]))
				{	$SUBDATA.= "<a class='ajaxLoad ui-state-highlight ui-corner-all btn' href='/cms/form.php?type=".substr($subtype[0],0,-1)."&act=add&pid=$wrid'>Добавить [$subtype[0]]</a>";
				
					$SUBDATA.= "<a class='ui-state-error ui-corner-all deletePage del btn' href='actions.php?table={$type}&act=del&id=$wrid'>Удалить страницу</a>";
				}
				
				if($wrid != 25)
				{
					foreach($subtype as $st)
					$SUBDATA.= $PSE->simpleFetch($PSE->Select($st,'id,parent,name,xsmall,pic,display','where parent = '.$wrid).' order by position','preview_uitem','table_preview_item');
				}
				else
				{
					$SUBDATA.= $PSE->simpleFetch($PSE->Select('items','id,parent,name,xsmall,pic,display,short_text','where parent = '.$wrid).' order by date','preview_article','table_article');
				}
				
					
				if($type == 'items')
				{
					$SUBDATA = preg_replace('#<a href=".+">\[&darr;&darr;&darr;\]</a>#Ui','',$SUBDATA);
					$SUBDATA = str_replace('	<a href="index.php?type=photo','	<a class="ajaxLoad" href="form.php?type=photo',$SUBDATA);
				}
				if($type == 'pages')
				{
					$SUBDATA.= $PSE->simpleFetch($PSE->Select('pages','*','where parent = '.$wrid.' order by position'),'preview_uitem','table_preview_item');
				}
				
			break;
		}
		unset($_SESSION['Client']['uri']);
	#	$PSE_VARS['CONTENT'].= $PSE->ReadBuffer();
		$PSE_VARS['CONTENT'].= $SUBDATA;
	}
	else $PSE_VARS['CONTENT'].= $PSE->setTemplate('main_menu',true);
#	else{ echo "$type - $act - $wrid $wrpd ";}
}

$PSE_VARS['LIST_BLOCKS'] = "<table>".$PSE->simpleFetch($PSE->Select('blocks','*',''),'block_link')."</table>";
$PSE_VARS['COMPARE_TIME'] = $pp->ShowDifferent();

foreach($PSE_SYS_LANG as $search => $replace)
	$PSE_VARS['CONTENT'] = str_replace("[".$search."]",$replace,$PSE_VARS['CONTENT']);

/* собираем всё что есть и отдаём браузеру */
$PSE->setTemplate($design);
$PSE->parseBuffer($PSE_VARS);
$PSE->parseBuffer($PSE_LANG);
$PSE->cleanBuffer();
$PSE->showBuffer();
$pp->setEndTime();
?>