<?
require("../init.php");
$return = 'index.php';
if(isset($_GET['act']))
{
	switch($_GET['act'])
	{
		case'login':
			if (isset($_POST['login']) && isset($_POST['pass']))
			{
				$safe_pass = md5($_POST['pass']);
				$safe_name = mysql_real_escape_string($_POST['login']);
			
				$sql = $PSE->Select('users','*'," where name = '$safe_name' and `pass` = '$safe_pass';");
				$res = $PSE->Query($sql);
				if($line = mysql_fetch_assoc($res))
				{
					$_SESSION['Client']['SID']	= session_id();
					$_SESSION['Client']['ip']	= $_SERVER['REMOTE_ADDR'];
					$_SESSION['Client']['mode']	= $line['rights'];
					$_SESSION['Client']['start']= date('Y-m-d H:i:s');
					$_SESSION['Client']['click']= 0;
					$_SESSION['Client']['uri']	= array();
					$_SESSION['Client']['auth']	= true;
					$_SESSION['Message']		= 'Вы вошли на сайт';
				}
				else $_SESSION['Message']		= 'Авторизация не удалась';
				
				$upd = 'update `'.DB_PREF.'__request_statistic` set `mode` = "'.$line['rights'].'" where `SID` = "'.session_id().'"';
				mysql_query($upd);
			}
		break;
		
		case'logout':
		//	require ENGINE_ROOT."commons/autoclean.php";
			require ENGINE_ROOT."commons/backup.php";
			session_unset();
			session_destroy();
		break;
	}
}
header('Location: '.$return);
?>