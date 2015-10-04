<?
$cleanSQL = array();
$del = array();
$availableFiles = array();
$regFiles = array();
$availableFiles[] = files_dir('files/storage/');
$availableFiles[] = files_dir(_FILES);
$availableFiles[] = files_dir(_IMAGES);
$availableFiles[] = files_dir(_MEDIA);

$availableFiles = array_merge($availableFiles[0],$availableFiles[1],$availableFiles[2],$availableFiles[3]);

$inDB = $PSE->SelectResult($PSE->select('files','id,path,icon,xsmall',''));

foreach($inDB as $cfile)
{
	foreach($cfile as $filepath)
	{
		if(is_file(ENGINE_ROOT.$filepath))
		{
			$regFiles[] = $filepath;
		}
		elseif($cfile['id'] != $filepath && !empty($filepath))
			$del[] = $cfile['id'];
	}
}

$regFiles = array_unique($regFiles);
$diff = array_diff($availableFiles,$regFiles);
foreach($diff as $file)
{
	if(file_exists(ENGINE_ROOT.$file))
		unlink(ENGINE_ROOT.$file);
}
if(count($del))
	$cleanSQL[] = 'delete from '.DB_PREF.'__files where id in ('.join(',',$del).')';
	
$checkSQL = 'SELECT id FROM `'.DB_PREF.'__comments` WHERE parent not in (select id from '.DB_PREF.'__items)';
$cleanSQL[] = deleteSQL($checkSQL,'comments');
$checkSQL = 'SELECT id FROM `'.DB_PREF.'__photos` WHERE parent not in (select id from '.DB_PREF.'__items)';
$cleanSQL[] = deleteSQL($checkSQL,'photos');
$checkSQL = 'SELECT id FROM `'.DB_PREF.'__items` WHERE parent not in (select id from '.DB_PREF.'__pages)';
$cleanSQL[] = deleteSQL($checkSQL,'items');
$checkSQL = 'SELECT * FROM `'.DB_PREF.'__pages` WHERE parent !=0 and parent not in (select id from '.DB_PREF.'__pages)';
$cleanSQL[] = deleteSQL($checkSQL,'pages');
	
if(count($cleanSQL))
{
	foreach($cleanSQL as $q)
	{
		if(!empty($q))
			$PSE->Query($q);
	}
}

function deleteSQL($sql,$table)
{
	global $PSE;
	$IDS = array();
	$rid = $PSE->Query($sql);
	while($data = mysql_fetch_assoc($rid))
		$IDS[] = $data['id'];
	if(count($IDS))
		return "delete from `".DB_PREF."__$table` where id in (".join(",",$IDS).")";
}
?>