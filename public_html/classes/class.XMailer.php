<?
class xMailer
{
	private $sender;
	private $recipient;
	private $subject;
	private $headers;
	private $message;
	private $host;
	
	function __construct()
	{
		$this->host = str_replace('www.','',$_SERVER['HTTP_HOST']);
			
		$this->subject	= date('d.m.Y H:i:s').' Mail from '.$this->host;
		$this->message	= 'This is test mail from '.$this->host;
		$this->recipient= _ADMIN_ADDR.','._SUPPORT_ADDR;
		
		$this->headers['From']						= 'xmailer@'.$this->host;
		$this->headers['MIME-Version']				= '1.0';
		$this->headers['Content-Type']				= 'text/html; charset="koi8-r"';
		$this->headers['Content-Encoding']			= 'koi8-r';
		$this->headers['Content-Disposition']		= 'inline';
		$this->headers['Content-Transfer-Encoding'] = 'quoted-printable';
		$this->headers['User-Agent']				= 'PHP X-MAILER 1.5';
	}
	
	function Sender($email)
	{
		if (!empty($email))
		{
			$this->headers['From'] = $email;
		}	
	}
	
	function clearBuffer()
	{
		$this->sender	= '';
		$this->recipient	= '';
		$this->subject		= '';
		$this->headers		= '';
		$this->message		= '';
	}
	
	function Message($text)
	{
		$this->message = $text;
	}
	
	function Suject($string)
	{
		$this->subject = $string;
	}
	
	function Recipient($email)
	{
		$this->recipient = $email;
	}
		
	function setHeader($string)
	{
		$array = explode(":",$string);
		$this->headers[$array[0]] = trim($array[1]);
	}
	
	function readHeaders()
	{
		return $this->headers;
	}
	
	function sendPostData()
	{
		if (count($_POST) > 0)
		{
			unset($_POST['x']);
			unset($_POST['y']);
			$text.='<table cellpadding=5 border=1 width="100%"><tr><th width="100">Поле</th><th>Значение</th></tr>';
			foreach ($_POST as $field => $value)
				$text.= '<tr><td valign=top>'.$field.'</td><td valign=top>'.$value.'</td></tr>';
		}
		
		$this->Message($text);
		$this->sendmail();
		return ;
	}
	
	function joinHeaders()
	{
		$headers = '';
		if (is_array($this->headers))
		{
			foreach ($this->headers as $header => $value)
			{
				if (!empty($value) && !empty($header))
					$headers.= $header.": ".$value."\r\n";
			}
		}
		return $headers;
	}
	
	function sendmail()
	{
		
		if (!empty($this->recipient))
		{
			$this->message = addslashes($this->message);
			$this->subject = convert_cyr_string($this->subject,'w','k');
			$this->message = convert_cyr_string($this->message,'w','k');
			
			if (mail($this->recipient,$this->subject,$this->message,$this->joinHeaders()))
			{				
				return true;
			}
			else return false;
		}
	}
}
?>