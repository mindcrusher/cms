<?
if(isset($_GET['return']))
	require("../init.php");
if(isset($_SESSION['Client']) && $_SESSION['Client']['auth'] === true && $_SESSION['Client']['mode'] == 'root')
{
	$PSE->BackUpDb(@$_GET['return']);
}
elseif($_SERVER['REQUEST_URI'] == '/backup')
{
	$name = date('d_m_Y_H:i:s').'_dump.sql';
	header("Content-type: file/sql");
	header('Content-Disposition: attachment; filename="'.$name.'"');
	echo "К сожалению, вы находитесь в демо режиме, и в целях безопасности, дамп базы данных вам не позволяется видеть =)";
}
?>