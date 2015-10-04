<?
class DataProvider extends Buffering
{
	protected $queries;
	protected $lqdata;
	protected $Message;
	
	# ����������� � ��
	function Connect()
	{
		if (defined('DB_HOST') && defined('DB_HOST') && defined('DB_USER') && defined('DB_PASS') && defined('DB_NAME'))
		{
			if (!@mysql_connect(DB_HOST,DB_USER,DB_PASS))
			{
				$this->setError("<b>Cannot connect to ".DB_USER."@".DB_HOST."</b>");
			}
			$this->Query('set names `cp1251`');
			if (!@mysql_select_db(DB_NAME))
			{
				$this->setError("Database <b>".DB_NAME."</b> Does not exists");		
			}
		}
		else
		{
			$this->setError("No data for connection to MySQL");
		}
	}
	
	function setMessage($str)
	{
		$_SESSION['Message'] = $str;
	}
	
	function readMessage()
	{
		$return = '';
		if(isset($_SESSION['Message']))
			$return = $_SESSION['Message'];
		$_SESSION['Message'] = '';
		if(!empty($return))
			$return = "<div class='alert'>".$return."</div>";
		return $return;
	}
	
	function setTemplate($template_name,$return = false)
	{
		$prefix = 'pub_';
		if(strpos(" ".$_SERVER['REQUEST_URI'],'/cms')) $prefix = 'adm_';
		
		$this->setBufferFromFile(_TEMPLATES.$prefix.$template_name.'.tpl');
		if($return)
		{
			return $this->ReadBuffer();
		}
	}
	
	function mask($string)
	{
         $string =(get_magic_quotes_gpc()) ? stripslashes($string) : $string;
		 return mysql_real_escape_string($string);
	}  
	
	# ������ ����� ����
	function BackUpDb($file)
	{
		$DUMP = '';
		$sql = "Show tables from `".DB_NAME."`";
		$res = $this->query($sql);
		
		while($table = mysql_fetch_row($res))
		{
			if(false !== strpos($table[0],DB_PREF))
			{
				$sql = 'describe `'.$table[0].'`';
				$_res = $this->query($sql);
				$_res = $this->query($sql);
				@$DUMP.= "create table if not exists `$table[0]`(\n";
				while($_data = mysql_fetch_assoc($_res))
				{
					$_data['Null'] = str_replace('NO','NOT NULL',$_data['Null']);
					$_data['Null'] = str_replace('YES','NULL',$_data['Null']);
					$_data['Key'] = str_replace('PRI','PRIMARY KEY',$_data['Key']);
					$_data['Key'] = str_replace('UNI','UNIQUE',$_data['Key']);
					$_data['Key'] = str_replace('MUL','',$_data['Key']);
					$default = $_data['Default'];
					if(!empty($_data['Default']))
					{	
						if($_data['Default'] != 'CURRENT_TIMESTAMP') $default = "'{$default}'";
						$_data['Default'] = ' DEFAULT '.$default.'';
					}
					$DUMP.=join(" ",$_data).",\n";
				}
				$DUMP = substr($DUMP,0,-3);
				$DUMP.= ");\n\n";
				
				$sql = "select * from $table[0]";
				$_res = $this->query($sql);
				while($_data = mysql_fetch_assoc($_res))
				{
					foreach($_data as $k => $v);
					{
					#	$_data[$k] = mysql_real_escape_string($_data[$k]);
						$_data[$k] = str_replace("'","''",$_data[$k]);
					}
					
					$iTable = str_replace(DB_PREF.'__','',$table[0]);
					
					$DUMP.= $this->insert($iTable,$_data).";\n";
				}
			}
		}	
		$name = date('d_m_Y_H:i:s').'_dump.sql';
		if(!isset($_GET['return']))
		{
			$backupFilesControl = glob(ENGINE_ROOT._BACKUPS.'*.sql');
			if(count($backupFilesControl)>=10)
			{
				asort($backupFilesControl);
				unlink($backupFilesControl[0]);
			}
			if(file_put_contents(ENGINE_ROOT._BACKUPS.$name,$DUMP))
			{
				$_SESSION['Message'] = '��������� ����� ���� ������ ��������� � '._BACKUPS.$name;
			}
			else $_SESSION['Message'] = '�� ������� ��������� ����� ���� ������: ���������� '._BACKUPS.' ����������';
		}
		else
		{
			header("Content-type: file/sql");
			header('Content-Disposition: attachment; filename="'.$name.'"');
			print $DUMP;
			exit;
		}
	}
	
	# ��������������� ��������� ����� �� �� �����
	function StoreDB($file)
	{
		$this->setBufferFromFile($file);
		$dump = $this->readBuffer();

		$dump = preg_replace("#--.*(\n|\n\n)#Uis",'',$dump);
		$dump = preg_replace("#\t|\r#",'',$dump);
		
		$dump = explode(";\n",$dump);
		$dump = array_map('trim',$dump);
		
		foreach($dump as $sql)
		{
			if(!empty($sql))
				$sql = str_replace("prefix__",DB_PREF.'__',$sql);
				$this->Query($sql);
		}
	}
	
	function Query($query_string)
	{
		if(!empty($query_string))
		{
			$q_id = mt_rand(1000,9999);
			$st = microtime(true);
			$query_resource = @mysql_query($query_string);
			if ($query_resource == false && mysql_errno() != 1062)
			{
				$this->errors[] = "<b>$query_string</b> Text: ".mysql_error()." code: ".mysql_errno();
				if(mysql_errno() == 1146)
				{
					$this->errors = array();
					die("<div> ������ <b>$query_string</b> ����������: ��������� �� �� ����������� ��� ��������</div>");
				}
			}
			
			$en = microtime(true);
			$this->queries[$q_id]['query'] 	= $query_string;
			$this->queries[$q_id]['ex_time'] = $en - $st;
		}
		else
		{
			$query_resource = false;
			$this->errors[] = "Text: Query was empty";
		}
		
		$this->lqdata = $query_resource;
		
		return $query_resource;
	}

	function SelectResult($sql)
	{
		$res = array();
		$data = $this->Query($sql);
		
		while($line = mysql_fetch_assoc($data))
			$res[] = $line;
		
		return $res;
	}
	
	function printQueries()
	{	
		echo "<pre>";
		print_r($this->queries);
		echo "</pre>";
	}
	
	static function Select($table,$fields = '*',$where = 'where 1 limit 50')
	{
		$table = DB_PREF."__$table";
		if (empty($fields))
		{
			$fields = '*';
		}
		
		$sql = "SELECT $fields from `$table` $where";
		return $sql;
	}
	
	function Insert($table,$sql_data)
	{
		$table = DB_PREF."__$table";
		if(!is_array($sql_data)) return false;
		else
		{
			$sql = "insert into `$table` set ";
			foreach($sql_data as $Field => $Value)
			{
				$Value = $this->mask($Value);
				$sql.= "`$Field` = '$Value',";
			}
			$sql = substr($sql,0,-1);
			
			return $sql;
		}
	}
	
	function Update($table,$sql_data,$condition)
	{
		if(!is_array($sql_data)) return false;
		elseif(!empty($condition))
		{
			$table = DB_PREF."__$table";
			$sql = "update `$table` set ";
			foreach($sql_data as $Field => $Value)
			{
				$Value = $this->mask($Value);
				if($Field != "id")
					$sql.= "`$Field` = '$Value',";
			}
			$sql = substr($sql,0,-1).$condition;
			
			return $sql;
		}
		else $_SESSION['MESSAGE'] = '�� ������ ������� ��� �������� ���������';
	}
	
	
	function Delete($table,$id)
	{
		$table = DB_PREF."__$table";
		$sql = "delete from `$table` where id = $id";		 
		return $sql;
	}
	
	# ������ ������ � �����������������
	function simpleFetch($sql,$while_tpl,$roundwhile_tpl = '',$pagination = 0)
	{
		$lim = $pagination;
		$start = 0;
		if(isset($_GET['p'])) $start = ((int)$_GET['p']-1)*$lim;
		if($start < 0) $start = 0;
		preg_match('#__([a-zA-Z\d]+)s#Ui',$sql,$matches);
		$result = '';
		$this->setTemplate($while_tpl);
		$while_tpl = $this->readBuffer();
		
		if((!preg_match('#limit.{,6}$#Uis',$sql) || isset($_GET['p'])) && $pagination > 0)
		{
			$type = $_GET['type'];
		#	$type = preg_replace('#^[a-z0-9]+#','',$type);
			$pid  = (int)$_GET['pid'];
			$id  = (int)$_GET['id'];
				
			preg_match('#where.+$#Ui',$sql,$condition);
			$condition = $condition[0];
			$_sql = "select count(*) as num  from ".DB_PREF."__{$matches[1]}s $condition";
			$data = $this->Query($_sql);
			$num_rows = mysql_fetch_row($data);
			$num_rows = $num_rows[0];
			
			if($num_rows>$lim)
			{
				$sql .= " limit $start, $lim";
				
				/*���������� ���������*/
				for($pn = 1; $pn <= ceil($num_rows/$lim); $pn++)
				{
					$href = "/$type/$pid/$id"."/-$pn";
					if(preg_match('#cms/#',$_SERVER['REQUEST_URI']))
					{
						$href = preg_replace('#&p=\d+$#','',$_SERVER['REQUEST_URI']).'&p='.$pn;
					}
					$href = ereg_replace('/+','/',$href);
					if($_SERVER['REQUEST_URI'] != $href)
						$pages[] = "<a href='$href'>$pn</a>";
					else 
						$pages[] = "<b>$pn</b>";
				}
				/**********************/
			}
		}
		
		$data = $this->Query($sql);
		
		$r_count = mysql_num_rows($data);
		
		while ($line = @mysql_fetch_assoc($data))
		{
			$line['_type'] = $matches[1];
			$line = array_map('addslashes',$line);
			$this->setBuffer($while_tpl);
			$this->parseBuffer($line);
			$result.= $this->readBuffer();
		}
		
		if (!empty($roundwhile_tpl) && !empty($result))
		{
			$this->setTemplate($roundwhile_tpl);
			$this->parseBuffer(array('cicle_result' => $result,'_type'=>$matches[1]."s"));
			$result = $this->readBuffer();
		}
		$this->resetBuffer();
		
		if(count($pages))
		{
			$result.= "��������: ".join(' ',$pages);
		}
		
		return $result;
	}
	
	
	function GenFormFromData($sql,$action = '',$message = '������������� �����')
	{
		$formFields = '';
		$hiddenFields = '';
		
		$tmp_sql = preg_replace("#\t|\n#Ui",' ',$sql);
		$tmp_sql = preg_replace("#(select).+(from)#Ui",'$1 * $2',$sql);
		
		$esql = preg_replace('#[^a-z\sA-Z_]#','',$sql);
		preg_match('#__([a-zA-Z\d]+)\s#Ui',$esql,$matches);
		$table = DB_PREF.'__'.$matches[1];
		
		$ssql = "DESCRIBE `$table`";
		$sdata = $this->Query($ssql);		
		$data = $this->Query($tmp_sql);
		$dataRow = mysql_fetch_assoc($data);
		while($structRow = mysql_fetch_assoc($sdata))
		{
			
			preg_match("#(.+)\((.+)\)#Ui",$structRow['Type'],$res);
			$field['Name'] = $structRow['Field'];
			$field['Type'] = '';
			$field['Param'] = '';
			if(isset($res[1]))
				$field['Type']  = $res[1];
			if(isset($res[2]))
				$field['Param'] = $res[2];
			$field['Value'] = $dataRow[$structRow['Field']];
			$field['Default'] = $structRow['Default'];
			if(empty($field['Param']))
				$field['Type'] = $structRow['Type'];
			
			if(empty($field['Value']))
				$field['Value'] = $field['Default'];
			
			$rowField = data_field($field['Name'],$field['Param'],$field['Type'],$field['Value'],$matches[1])."<br>\n\n";
			$den = array('id','icon','xsmall','type','size','date');
			
			if($dataRow['id'] != 1)
				$den[] = 'autotext';
			if(!in_array($field['Name'],$den))
			$formFields .= "<tr><td style='width:150px;'>{descr_$field[Name]}</td><td>$rowField</td></tr>";
			else $hiddenFields .= $rowField;
		}
		$hide = true;
		if(isset($_GET['form']) && $_GET['form'] == 'show' &&  $matches[1] == $_GET['type'].'s')
			$hide = false;
		
		if (!empty($formFields))
		{
			$etable = preg_replace('#^.*__([a-z\dA-Z\-_]+)$#Ui','$1',$table);
			$form = '';
						
			$form.= "<form method='POST' action='$action&table=$etable' id='form4$etable' border='1' enctype=\"multipart/form-data\" >";
			$form.= "<table class='autogenform' width='98%'>";
			$form.= $formFields;
		#	$form.= "<tr><td width='150'><div class='status'>&nbsp;</div></td><td><input type='submit' style='width:150px;' value='{SAVE}!!'>";
		#	$form.= "</td></tr>";
			$form.= "</table>";
			$form.= "<div style='display:none'>$hiddenFields</div>";
			$form.= "</form>";
		}
		return $form;
	}
}
?>