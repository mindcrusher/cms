<?
class profileCode
{
	var $start_time;
	var $end_time;
	
	function mkrtime() 
	{ 
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}
	
	function setStartTime()
	{
		$this->start_time = $this->mkrtime();
	}
	
	function setEndTime()
	{
		$this->end_time = $this->mkrtime();
	}
	
	function ShowDifferent()
	{
		return $this->end_time - $this->start_time;
	}
}
?>