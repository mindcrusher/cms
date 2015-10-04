<?php
/** /
print_r($_GET);
print_r($_POST);
print_r($_FILES);
die();
#*/
require('../init.php');
$table = 'files';
if(isset($_GET['table'])) $table = preg_replace('#[^a-z\d\-_]#','',@$_GET['table']);
$act = preg_replace('#[^a-z]#','',@$_GET['act']);

if( isset($act)
	&& in_array($act,array('add','edit','del','view','group'))
	&& in_array($table,array('pages','gb_messages','items','photos','users','comments','blocks','files'))
	&& @$_SESSION['Client']['mode'] == 'root' && session_id() ==@ $_SESSION['Client']['SID']
  )
{
	$files = upload_files();
	$_POST = array_merge($_POST,$files['files']);
	
	if(isset($_POST['id']))
	{
		$cid = (int)$_POST['id'];
		unset($_POST['id']);
	}
	elseif(isset($_GET['id'])) $cid = (int)$_GET['id'];
	else $cid = 0;
	$query = true;
	switch($act)
	{		
		case'add':
			if($table == 'files')
			{
				if(!isset($_POST['path']) || $_POST['path'] == '')
					$query = false;
			}
			$sql = $PSE->Insert($table,$_POST);
		break;
		
		case'edit':
			if($table != 'users')
				$sql = $PSE->Update($table,$_POST,'where id = '.$cid);
			else
			{
				$opswds = $PSE->Select('users','pass','where id = 0');
				$opswdd = mysql_query($opswds);
				$opswdr = mysql_fetch_row($opswdd);
				
				if((md5($_POST['pass']) == $opswdr[0]) && $_POST['new'] == $_POST['confirm'])
				{
					$sql = $PSE->Update($table,array('pass' => md5($_POST['new'])),' where id = 0');
				}
			}
		break;
		
		case'del':
			$sql = $PSE->Delete($table,$cid);
			if($table == 'pages')
			{
				$_SESSION['HTTP_REFERER'] = '/cms/';
				$depends[] = "delete from `".DB_PREF."__items` where parent in ((SELECT id from `".DB_PREF."__pages` where parent = $cid))";
				$depends[] = "delete from `".DB_PREF."__items` where parent = $cid";
				foreach($depends as $q)
					$PSE->Query($q);
			}
		#	die($_SESSION['HTTP_REFERER']);
			if($table == 'files')
			{
				$unlink = mysql_fetch_row(mysql_query($PSE->Select('files','path','where id = '.$cid)));
				
				$lineFiles[] = $unlink[0];
				$lineFiles[] = str_replace('_full','_icon',$unlink[0]);
				$lineFiles[] = str_replace('_full','_xsmall',$unlink[0]);
				
				foreach($lineFiles as $cfile)
				{
					if(file_exists(ENGINE_ROOT.$cfile))
						unlink(ENGINE_ROOT.$cfile);
				}
			}
			
		break;
		case 'group':
			if(!key_exists('check',$_POST)) continue;
			
			$_POST['check'] = array_map('intval',$_POST['check']);

			switch($_POST['act'])
			{
				case 'none':
				break;
				case "delete":
					$sql = "delete from ".DB_PREF."__$table where id in (".join(',',$_POST['check']).");";
				break;
				
				default:
					$data = explode(":",$_POST['act']);
					$data = array($data[0]=>$data[1]);
					$sql = $PSE->Update($table,$data,' where id in ('.join(',',$_POST['check']).')');
				break;
			}
		break;
	}
	
#	header('Content-type: text/plain');
#	echo $sql;
#	print_r($_POST);
#	print_r($_GET);
#	die();
	if( $query == true && !empty($sql))
	{
		if($PSE->Query($sql))
			$PSE->setMessage('Выполнено');
		elseif( mysql_errno() != 1062)
			$PSE->setMessage('Возникла ошибка при выполнении запроса:<div class="error">'.$sql.'</div><div>'.mysql_error().'</div>');
	}
	else $PSE->setMessage('Действие не выбрано, или не разрешено');
}
elseif(@$_SESSION['Client']['mode'] == 'user' && @$_SESSION['Client']['auth'] == 1){ $PSE->setMessage('Редактирование данных запрещено в демо режиме');}

if(isset($_GET['sleep'])) { sleep((int)$_GET['sleep']);}
if(isset($_SESSION['HTTP_REFERER'])) header('Location: '.$_SESSION['HTTP_REFERER']);
?>