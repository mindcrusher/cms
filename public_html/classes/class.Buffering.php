<?
class Buffering
{
	protected $buffer;
	protected $errors;
	protected $config;
	
	
	function __construct()
	{	
		$this->errors = array();
		$this->config = array();
		$this->buffer = '';
	}
	# загружаем конфиг
	function loadConfig($config_file,$treeview = false)
	{
		if(file_exists($config_file))
		{
			$this->config = parse_ini_file($config_file,$treeview);
		}
		else
		{
			$this->setError("<b>$config_file</b> is not exists. exiting");
		}
	}
	
	# читаем конфиг
	function readConfig($key = '')
	{
		if(key_exists($key,$this->config))
			return $this->config[$key];
		else
			return $this->config;
	}
	
	# заполняем буфер
	function setBuffer($string)
	{
		$this->buffer = $string;
		return true;
	}
	
	# заполняем буфер из файла
	function setBufferFromFile($filedestination)
	{
		$filedestination = ENGINE_ROOT.$filedestination;
		if(file_exists($filedestination))
		{
			$source = file_get_contents($filedestination);
			$this->setBuffer($source);
			return true;
		}
		else
		{
			$this->errors[] = 'File <b>'.$filedestination.'</b> is not exists';
			return false;
		}
	}
	
	# очищаем буфер
	function resetBuffer()
	{
		$this->buffer = NULL;
		return true;
	}
	
	# читаем
	function readBuffer()
	{
		return $this->buffer;
	}
	
	function cleanBuffer()
	{
	#	$this->buffer = preg_replace("#\{[a-zA-z_\d]+\}#",'',$this->buffer);
		$this->buffer = preg_replace("#\{[a-zA-ZА-Яа-я0-9\s\.,_\-]+\}#i",'',$this->buffer);
	}
	
	function changeCharset($charset)
	{
		switch($charset)
		{
			case 'utf8':
				$this->setbuffer(mb_convert_encoding($this->buffer,'utf8','windows-1251'));
			break;
		}
	}
	
	# отдаём браузеру
	function showBuffer($encoding = 'windows-1251')
	{
		if(!count($this->errors))
		{
			$this->buffer = stripslashes($this->buffer);
			$this->changeCharset($encoding);
			print $this->readBuffer();
			$this->resetBuffer();
			return true;
		}
	}
	
	# парсим массив
	function parseBuffer($array)
	{
		if(!is_array($array))
		{	return false;	}
		else
		{
			foreach($array as $key => $value)
				$this->buffer = str_replace('{'.$key.'}',$value,$this->buffer);
		}
	}
	
	# создаём сводку ошибок
	function readErrors()
	{
		$errstr = '';
		if(count($this->errors)>0)
		{
			$errstr = 'Errors:<ol>';
			foreach( $this->errors as $err)
			{
				$errstr.= '<li>'.$err.'</li>';
			}	
			$errstr.= '<ol>';
		}
		
		return $errstr;
	}
	
	function setError($string)
	{
		$this->errors[] = $string;
	}
	
	function __destruct()
	{
		echo $this->readErrors();
	}
}
?>