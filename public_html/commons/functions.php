<?
function main_handling($text)
{
	$text = preg_replace_callback('#(\d{4})-(\d{2})-(\d{2})#','ruDate',$text);
	
	$text = str_replace('style="background:url()"','',$text);
	$text = str_replace('../files','/files',$text);
	$text = str_replace('/page/0/1/','/',$text);
	
	$censor = array(
	'���',
	'���',
	'��',
	'����',
	'���',
	'���'
	);
	
	foreach($censor as $badword)
	{
		$bip = str_repeat("*",strlen($badword));
		$text = str_replace($badword,$bip,$text);
	}
	
	$text = str_replace('00:00:00','',$text);
	
	return $text;
}
function ruDate($array)
{
	$calendar = array(
		'01' => '������',
		'02' => '�������',
		'03' => '�����',
		'04' => '�������',
		'05' => '���',
		'06' => '����',
		'07' => '����',
		'08' => '�������',
		'09' => '��������',
		'10' => '�������',
		'11' => '������',
		'12' => '�������',
	);
	 $return = (int)$array[3]." ".$calendar[$array[2]]." ".$array[1]." �.";
	 $return = $array[3].".".$array[2].".".$array[1];
	 
	 return $return;
}

function getTags($lim = 4){
	
	global $PSE;
	$sep = '|=|';
#	$data = $PSE->SelectResult($PSE->Select('pages','group_concat(keywords SEPARATOR "'.$sep.'") as tags, group_concat(id) as id,group_concat(parent) as parent',' WHERE keywords != ""'));
	
	$data = $PSE->SelectResult($PSE->Select('pages','id,parent,keywords',' WHERE keywords != "" and tag_enable = "��" order by keywords'));
	
	$kw_struct['id'] = array();
	$kw_struct['parent'] = array();
	$kw_struct['tag'] = array();
	$tag_string = '';
	
	asort($data);
	
	foreach($data as $row => $line)
	{
		$tags = explode(',',$line['keywords']);
		foreach($tags as $ii => $tag)
		{
			if($ii > 3) continue;
			
			$tag = trim($tag);
			if(!empty($tag))
				$tag_string.= $tag;
			
			if(!in_array($tag,$kw_struct['tag']) && !empty($tag))
			{
				$kw_struct['tag'][] = $tag;
				$kw_struct['id'][] = $line['id'];
				$kw_struct['parent'][] = $line['parent'];
			}
		}
	}
	
	asort($kw_struct['tag']);
	
	foreach($kw_struct['tag'] as $i => $kw)
	{
		$tag_struct[$i]['word'] = $kw;
		$tag_struct[$i]['link'] = "/page/{$kw_struct['parent'][$i]}/{$kw_struct['id'][$i]}/";
		$tag_struct[$i]['count'] = substr_count($tag_string,$kw);
		$tag_struct[$i]['color'] = '#334455';
		if($tag_struct[$i]['count'] > 3 )
		{
			$tag_struct[$i]['color'] = '#EE4444';
			$tag_struct[$i]['count'] = 3;
		}
		if($tag_struct[$i]['count'] < 2)
			$tag_struct[$i]['count'] = 2;
	#	$tag_struct[$i]['count'] = substr_count($tag_string,$kw);
	#	if($tag_struct[$i]['count'] == 1)
	#		$tag_struct[$i]['count']+= 2;
	}
	
	foreach($tag_struct as $i => $item)
	{
		$html[] = "<strong><font size='$item[count]'><a style='color:$item[color];margin:5px 10px;text-decoration:none;' href='$item[link]'>$item[word],</a></font></strong>";
	#	if($i > 100) break;
	}
	return join('',$html);
}
function SpyView()
{
	if(!isset($_SESSION['Client']) && !empty($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['HTTP_USER_AGENT']))
	{
		$client['SID']	= session_id();
		$client['ip']	= $_SERVER['REMOTE_ADDR'];
		$client['mode']	= 'user';
		$client['session_start']= date('Y-m-d H:i:s');
		$client['browser']	= $_SERVER['HTTP_USER_AGENT'];
		$client['auth'] = false;
		
		$ins = 'insert into `'.DB_PREF.'__request_statistic` set ';
		foreach ($client as $f => $v)
		{
			$v = mysql_escape_string($v);
			$ins.= "`$f` = '$v',";
		}
		$ins = substr($ins,0,-1);
		
		mysql_query($ins);
		
		$_SESSION['Client'] = $client;
	}
	
	$_SESSION['Client']['uri'][]	=	array('url'=>$_SERVER['REQUEST_URI'],'time'=>date('Y-m-d H:i:s'));

	$uri = mysql_escape_string(serialize($_SESSION['Client']['uri']));
	
	$upd = 'update `'.DB_PREF.'__request_statistic` set `uri` = "'.$uri.'" where `SID` = "'.session_id().'"';
	mysql_query($upd);
}

function files_dir($bdir)
{
	$dir = ENGINE_ROOT."$bdir/";
	$files = array();
	$handle = opendir($dir);
	while (false != ($item = @readdir($handle)))
	{
		if (is_file($dir.$item))
		{
			$files[] = "/".$bdir.$item;
		}
	}
	return $files;
}

function genCategoryTree($Nparent = 0,$Recursion = true,$sql = '',$sitemap = false)
{
	$href= PAGE_LINK;
	$aparam = '';
	if(false === strpos($_SERVER['REQUEST_URI'],"/cms"))
		$aparam = ' where `display` = "��"';
	
	$menu = '';
	$DATA = new DataProvider();
	if(empty($sql))
		$sql = $DATA->select('pages',' `parent`,`id`,`page`,`name`,`display` ',$aparam.' order by position');
	$d = $DATA->Query($sql);
	
	$tree_struct = array();

	while($line = mysql_fetch_assoc($d))
	{
		$tree_struct[$line['parent']][$line['id']] = array('name' => $line['name'],'page' => $line['page'], 'display' => $line['display'], 'icon' => $line['xsmall']);
	}
	if(false === strpos($_SERVER['REQUEST_URI'],"/cms"))
	return ShowTreeUl($tree_struct,$Nparent,$href,$Recursion,$sitemap);
	else return "<table>".PagesTree($tree_struct)."</table>";
}
function cutstring($string,$len = 20,$fill = '...')
{
	if(strlen($string) > ($len - strlen($fill)))
		$string = substr($string,0,$len).$fill;
	return $string;
}
function PagesTree($tree,$pid = 0 ,$level = 0)
{
	$menu = '';
	$display = '';
	$indent = $level*7;
	$level++;
	foreach( $tree as $id=>$root)
	{
		if($pid!=$id)continue;
		if(count($root))
		{
			foreach($root as $key => $data)
			{
				$opage = $data['page'];
				$data['page'] = cutstring($data['page'],16);
				$display = $data['display'];
				
				$menu.= "<tr><td class='d{$display}' width='150'>";
				
				if($id == 0 && $key == 1)
				{
					$menu.= "<a class='ajaxLoad' title='$opage: $data[name]' href='/cms/form.php?type=page&id=$key&pid=$id&act=edit'>$data[page]</a>\r\n";
					$menu.= "</td><td>&nbsp;</td></tr>";
				}
				else
				{
					$menu.= "<a style='padding-left:{$indent}px;'class='block'";
					$menu.= "title='$opage: $data[name]' href='/cms/index.php?type=page&id=$key&pid=$id&act=edit'>$data[page]</a>\r\n";
					$menu.= "</td><td>";
					$menu.= "<a class='ajaxLoad' href='/cms/form.php?type=page&id=$key&pid=$id&act=edit'>[edit]</a>";
					$menu.= "</td></tr>";
				}
				
				$menu.= "</td></tr>";
				
				
				
				
				if(key_exists($key,$tree) && count($tree[$key])) $menu.= PagesTree($tree,$key,$level);
			}
		}
	}
	
	return $menu;
}

function ShowTreeUl($tree, $pid=0, $href= '/page/{parent}/{key}/',$Recursion = true,$sitemap = false)
{
	$style = '';
	if($pid == 0) $style = ' id="nav" ';
	$menu = "<ul$style>";
	foreach( $tree as $id=>$root)
	{
		if($pid!=$id)continue;
		if(count($root))
		{
            foreach($root as $key => $data)
			{
                $final_href = $href;
                if($key == '150') {
                    $final_href = '/calc/';
                }
                
            	if($sitemap)
					$menu.= "<li class='icon' url='$data[icon]'><a class='menu-link' title='$data[name]' href='$final_href'>$data[page]</a>\r\n";
				else 
					$menu.= "<li><a class='menu-link' title='$data[name]' href='$final_href'>$data[page]</a>\r\n";
				$menu = str_replace('{key}',$key,$menu);
				$menu = str_replace('{parent}',$id,$menu);
				
				if(key_exists($key,$tree) && count($tree[$key]) && $Recursion == 1) $menu.= ShowTreeUl($tree,$key,$href);
				$menu.= "</li>";
			}
		}
	}
	$menu.= "</ul>";
	
	return $menu;
}

function getAbsPath($id = '',$pid= '',$subtype = '',$position = 0)
{
	global $PSE;
	$struct = array();
	$nposition = $position;
	
	$id = 1;
	$pid = 0;

	if(empty($subtype))	$subtype = $_GET['type'];
	if(isset($_GET['id'])) $id  = (int)@$_GET['id'];
	if(isset($_GET['pid'])) $pid  = (int)@$_GET['pid'];	
	
	$key = $id;
	if($_GET['type'] == 'item') $key = $pid;
	
	$sql = $PSE->Select('pages','id,parent,page','');
	
	$rid =  $PSE->Query($sql);
	
	while($line = mysql_fetch_assoc($rid))
	{
		$struct[$line['parent']][$line['id']] = $line['page'];
	}
	$tree = makeAbsPath($struct,$key);
	$separator = '&rarr;';
	$tree = substr($tree,0,-3);
	$tree = explode(':|:',$tree);
	
	$tree = array_chunk($tree,3);
	$tree = array_reverse($tree);

	
	if($_GET['type'] == 'item'){
		$data = $PSE->SelectResult($PSE->Select('items','id,parent,name as page',' where id = '.$id));
		$lastChild = array($data[0]['page'],$data[0]['id'],$data[0]['parent']);
		$tree[] = $lastChild;
	}	
	
	$str = array();
	foreach($tree as $c => $link)
	{
		if(!key_exists(1,$link) && !key_exists(2,$link))
		{
			$link[1] = 0;
			$link[2] = 0;
		}
		$type = 'page';
		if($_GET['type'] != 'page' && $tree[$c] == end($tree))
			$type = 'item';
		$URL = "/cms/index.php?type=$type&id=".$link[1]."&pid=".$link[2]."&act=edit";
		if(!strpos(' '.$_SERVER['REQUEST_URI'],'cms'))
			$URL = "/$type/".(@$link[2])."/".(@$link[1])."/";
		
		if(!empty($link[0]))
			$str[] = " <a href='$URL'>$link[0]</a> ";
	}
	
	if(count($str))
	return "<div id='navbar'>".join($separator,$str)."</div>";
}

function makeAbsPath($tree,$pid)
{
	$item = '';
	foreach( $tree as $id=>$root)
	{
		if(key_exists($pid,$root))
		{
			$item.= $root[$pid].':|:'.$pid.':|:'.$id.':|:';
			if($id != $pid)
			$item.= makeAbsPath($tree,$id);
		}
	}
	return $item;
}

function ShowTreeSelect($tree, $pid=0,$level = 0,$select = 0,$disable = 1)
{
	if(!isset($_GET['id'])) $_GET['id'] = 0;
	if(!isset($_GET['pid'])) $_GET['pid'] = 0;
	
	$selected = '';
	$menu = "";
	foreach( $tree as $id=>$root)
	{
		if($pid!=$id)continue;
		if(count($root))
		{
			foreach($root as $key => $data)
			{
				if($select == $key)
				{	$selected = 'selected';	} else $selected = '';
				
				if(($disable == $key) || ($_GET['id'] == 1 && $_GET['type'] == 'page'))
				{	$selected = 'disabled'; }

				$menu.= "<option $selected value='$key'>";
				$menu.= str_repeat("-",$level)."$data[name]";
				$menu.= "</option>\r\n";
				
				if(key_exists($key,$tree) && count($tree[$key])) $menu.= ShowTreeSelect($tree,$key,$level+1,$select,$disable);
			}
		}
	}	
	return $menu;
}

# ��������� �����
function upload_files()
{
	global $PSE;
	$_SESSION['Message'] = '';
	$allow = explode(',',_ALLOWFILES);
	
	$files_root = ENGINE_ROOT;
	
	$names = array();
	
	$curtime = time()-1;
	foreach ($_FILES as $key => $filedata)
	{
		if ($filedata['error'] != 4)
		{
			$onames = array();
			$ext = pathinfo($filedata['name']);
			$ext = strtolower($ext['extension']);
			$name = pse_namespace($filedata['name'].$filedata['size'])."_full.".$ext;
			switch($ext)
			{
				default:
					$files_root.= _FILES;
				break;
				case 'jpg':case 'jpeg':case 'gif':case 'png':
					$files_root.= _IMAGES;
				break;
				case 'flv':
					$files_root.= _VIDEOS;
				break;
				case 'mp3':
					$files_root.= _MUSIC;
				break;
			}
		
			if (in_array($ext,$allow))
			{
				if (is_uploaded_file($filedata['tmp_name']))
				{
					$dest = $files_root.$name;
					if(@move_uploaded_file($filedata['tmp_name'],$dest))
					{
						if(in_array($ext,array('jpg','jpeg','gif','png')))
						{
							$icon = str_replace('_full','_icon',$dest);
							$xsmall = str_replace('_full','_xsmall',$dest);
							copy($dest,$icon);
							copy($dest,$xsmall);
							$dest = resizeImage($dest,800,600);
							$icon = resizeImage($icon,100,100,false);
							$xsmall = resizeImage($xsmall,48,48,false);
							$names['icon']   = str_replace(ENGINE_ROOT,'/',$icon);
							$names['xsmall'] = str_replace(ENGINE_ROOT,'/',$xsmall);
						}
						$onames[$key] = $filedata['name'];
						$names[$key] = str_replace(ENGINE_ROOT,'/',$dest);
						chmod($dest,0755);
						$_SESSION['Message'] = '���� ������� ��������';
						
						$insertFiles = $names;
						if(!isset($_POST['name']) || empty ($_POST['name']))
							$insertFiles['name'] = $filedata['name'];
						else $insertFiles['name'] = $_POST['name'];
						$insertFiles['path'] = str_replace(ENGINE_ROOT,'/',$dest);
						$insertFiles['size'] = $filedata['size'];
						unset($insertFiles['pic']);
						
						
						$PSE->Query($PSE->insert('files',$insertFiles));
					}
					else $_SESSION['Message'] = '���������� ����������� ���������� ���� ';
				}
			}
			else $_SESSION['Message'] = 'Wrong extension';
		}
		else $_SESSION['Message'] = 'Error uploading';
	}
	return array('files'=>$names);
}

function pse_namespace($name)
{
	$name = substr(md5($name),0,10);
	$name = strtolower($name);
	return $name; 
}


function resizeImage($path,$width = 150, $height = 150, $proportinal = true)
{
	if (file_exists($path))
	{
		$resize_param		= array('width'=> $width,'height'=>$height,'aspect' => 1);
		$ext = pathinfo($path);
		$ext = $ext['extension'];
		$output_param		= array('new_file'	=>$path,'quality'	=> 95,'extension'	=> 'jpg');
	
		if(in_array($ext,array('png','gif')))
		{
			$output_param = array('new_file'	=>$path,'extension'	=> $ext);
		}
		
		$IM = new ImageMagic($path);
		$IM->createFrom();

		if ($proportinal == false) # ���� ��������� �� �����������, ����� �������
		{
			$dat = getimagesize($path);
			$_width = $dat[0];
			$_height = $dat[1];
			
			$max = $_height;
			if ($_width < $_height) # ������ ������� �������� �� ������
				$max = $_width;

			$resize_sub_param	= array('new_file'	=>$path,'width'=> $max,'quality'=>100,'height'=>$max,'aspect' => (int)$proportinal);
			
			$IM->resize($resize_sub_param);
			$res = $IM->makeImage($output_param);
			$IM = new ImageMagic($path);
			$IM->createFrom();
		}
		$IM->resize($resize_param);
		$res = $IM->makeImage($output_param);
	}
	else die('FAIL!: '.$path);
	
	return $path;
}
function data_field($name,$param,$type,$value = '',$table='')
{
	$str = '';
	$highlight = " onfocus='this.className=\"highliteInput\"' onblur='this.className=\"normalInput\"'";
	$highlight = "";
	
	$disabled = '';
	$maxlen = '255';
	
	$DOM_id = $type."_".rand(1000,9999);
	
	if((int)$param > 0)
	{
		$maxlen = $param;
	}
	elseif(!empty($param))
	{
		$maxlen = 0;
		$disabled = 'disabled';
	}
	$str = "<input id='$table"."_"."$name' maxlength='$maxlen' $disabled name='$name' type='text' value='$value'>";
	
	if($name == 'position')
	{
		$value = (int)$value;
		$str = "<input name='$name' type='text' value='$value' maxlength=3 style='width:25px;'>";
	}
	if($name == "type")
		$str = "<input name='$name' type='hidden' value='$value'>";
	
#	echo "$name $type $param<br>";
	switch($type)
	{
		default:
			if(preg_match('#video|music|audio|pic|file|path#U',$name,$matches))
			{
				$str = '<div class="inputFile"><input type="file" name="'.$name.'"/></div>'."\n";
				
				if(!empty($value) && false === strpos($value,'noimage.gif'))
				{
					$str.= "<div><a href='$value'>�������/����������</a>";
					$str.= " <input name='$name' style='width:25px;' type='checkbox' id='deleteimage' value=''> �������</div>";
				}
			}elseif(preg_match('#xsmall|icon#U',$name)) $str = '<input type="hidden" name="'.$name.'" value="'.$value.'" id="'.$table.'_'.$name.'"/>';
				
			if($name == 'date' || $name == 'datetime')
			{
				if($value = 'CURRENT_TIMESTAMP') $value = 0;
				$wrongdate = strpos($value,'00-00-00');
				if(empty($value) || false !== $wrongdate)
				{
					$value = date('Y-m-d H:i:s');
				}
				
				$str = "<input name='$name' id='$table"."_".$name."'style='width:125px' maxlength='20' type='text' value='$value'>";
			}
			if($name == 'short_text' || $name == 'description' || $name == 'autotext')
			{
				$str = "<textarea name='$name' style='height:50px'>$value</textarea>";
			}
			
		break;
		case'set':
			$str = '';
			$cv = explode(',',$value);
			if ($_GET['type'] != 'user')
			{
				if(count($cv))
				{
					preg_match_all("#'(.+)'#Ui",$param,$matches);
					$matches = $matches[1];
					foreach($matches as $match)
					{
						foreach($cv as $v)
						{
							if($match == $v)
								$check = 'checked=on';
						}
						$str.= "<input style='width:20px;' ".$check." type=checkbox name='".$name."[]' id='$name' value='$match' />$match ";
						$check = '';
					}
				}
			}
		break;
		case'enum':
			preg_match_all("#'(.+)'#Ui",$param,$matches);
			$matches = $matches[1];
			$str = '';
			foreach($matches as $match)
			{
				$check = '';
				if($match == $value)
					$check = 'checked';
				
				$str.= "<input style='width:20px;' ".$check." type=radio name='$name' id='$name' value='$match' />$match ";
			}
		break;
		case'text':;case 'mediumtext':
			$str = '';
			$str.= "<textarea class='fck' id='$DOM_id' name='$name'>$value</textarea>";	
		break;
		
		case'int':
			if($name == "id")
				$str = "<input name='$name' type='hidden' value='$value'>";
			if($name == "parent")
			{
				$selected = '';
				$disabled = '';
				
					$tree_struct = array();
					$pid = 'parent';
					
					$DATA = new DataProvider();
					$sql = $DATA->select('items',' `parent`,`id`,`name` as page,`display` ',' where 1');
					if(in_array($table,array('pages','items')))
					{
						$sql = $DATA->select('pages',' `parent`,`id`,`page`,`display` ','');
						$pid = 'parent';
						if(isset($_GET['pid']))
							$selected = $_GET['pid'];
						if(isset($_GET['id']))
							$disabled = $_GET['id'];
						if($table == 'items')
						{
							$selected = '';
							if(isset($_GET['id']))
								$selected = $_GET['id'];
							if($_GET['type'] == 'item') $selected = $_GET['pid'];
							$disabled = 0;
							if($selected == 0) $selected = 1;
						}
					}
					elseif(in_array($table,array('photos','comments')))
					{
						$pid = 0;
						if(isset($_GET['pid']))
							$selected = $_GET['pid'];
						
					}
					else
					{
						$pid = 0;
						if(isset($_GET['id']))
							$selected = $_GET['id'];
					}
					
					$d = $DATA->Query($sql);
					
					$select = '';
					$tree_struct = array();
					while($line = mysql_fetch_assoc($d))
					{
						
						if($pid === 0) $line[$pid] = 0;
						$tree_struct[$line[$pid]][$line['id']] = array('name' => $line['page'], 'display' => $line['display'],'select' => $select);
					}
					
				#	echo $selected ;
					$str = "<select name='$name'><option value='0'>--------</option>".ShowTreeSelect($tree_struct,$pid,0,$selected,$disabled)."</select>";
			}
			if($name == "work_type")
			{
				$selected = 0;
				$tree_struct = array();
				$DATA = new DataProvider();
				$sql = $DATA->select('work_type','id, 0 as parent, name as page ',' where 1');
				$d = $DATA->Query($sql);
				while($line = mysql_fetch_assoc($d))
				{
					if($pid === 0) $line[$pid] = 0;
					$tree_struct[$line[$pid]][$line['id']] = array('name' => $line['page'], 'display' => $line['display'],'select' => $select);
				}
				$str = "<select name='$name'><option value='0'>�� ����������</option>".ShowTreeSelect($tree_struct,$pid,0,$value,$disabled)."</select>";
			}
			
		break;
	}
	return $str;
}
?>