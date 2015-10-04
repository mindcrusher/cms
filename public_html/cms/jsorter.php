<?
require "../init.php";
if($_SESSION['Client']['mode'] == 'root' && session_id() ==@ $_SESSION['Client']['SID'])
{
	$table = preg_replace('#[^a-z\d\-_]#','',$_POST['table']);
	if(!empty($table) && count($_POST['position']) && in_array($table,array('pages','items','photos','news','articles','users','comments','blocks','files')))
	{
		foreach($_POST['position'] as $pos => $id)
		{
			$id = (int)$id;
			$pos = (int)$pos;
			
			if($id == 1 && $table == 'pages') $pos = -1;
			$sql = $PSE->update($table,array('position'=>$pos),' where id = '.$id);
			$PSE->Query($sql);
		}
	}
}
?>