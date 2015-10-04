<?
require("../init.php");
$wrid = $web_resource_id;
$wrpd = (int)$_GET['pid'];
$PSE_VARS['ALERT'] = $PSE->readMessage();
//$_SESSION['HTTP_REFERER'] = str_replace('form.php','index.php',$_SERVER['REQUEST_URI']);
if(isset($_SESSION['Client']) && $_SESSION['Client']['auth'] === true)
{
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
	$PSE_VARS['CONTENT'].= $PSE_VARS['ALERT'];
	
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
				$keys = 'id,name,parent';
				$row   = 'preview_uitem';
				$table = 'table_preview_item';
				if($type == 'files')
				{ 
					$keys = '*'; 
					$row = 'files_row';
					$table = 'files_table';
				}
				
				$SUBDATA.= $PSE->simpleFetch($PSE->Select($type,$keys,''),$row,$table);
			break;
			case'edit':
				$edit_sql = $PSE->Select($type,'*','where id = '.$wrid);
				$SUBDATA.= $PSE->GenFormFromData($edit_sql,'actions.php?act='.$act);
			break;
		}
		unset($_SESSION['Client']['uri']);
		$PSE_VARS['CONTENT'].= $SUBDATA;
	}
	else $PSE_VARS['CONTENT'].= $PSE->setTemplate('main_menu',true);
	
	$PSE->SetBuffer($PSE_VARS['CONTENT']);
	$PSE->parseBuffer($PSE_VARS);
	$PSE->parseBuffer($PSE_LANG);
	$PSE->ShowBuffer('utf8');
}
else echo "Access Denied";
?>