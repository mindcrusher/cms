<?
 class ImageMagic
 {
 	var $errors;
 	var $output_extension;
 	var $image_resource;
 	var $image_source;
 	var $dimentions;
 	 	
 	function __construct($source = '')
 	{
 		if (file_exists($source))
 		{ 			
 			$this->image_source = $source;
 			$dim				= getimagesize($source);
 			$this->dimentions	= array('width' => $dim[0],'height' => $dim[1]);
 		}
 	}
 	
 	function __destruct()
 	{
 		if (!empty($this->image_resource))
 		{
 			imagedestroy($this->image_resource);
 		}
 		unset($this->errors);
 		unset($this->output_extension);
 		unset($this->image_resource);
 		unset($this->image_source);
 	}
 	
 	function showErrors()
 	{
 		echo $this->errors;
 	}
 	
 	function readResource()
 	{
 		return $this->image_resource;
 	}
 	
 	// создание изображения из уже существующего
 	function createFrom()
 	{
 		$source = $this->image_source;
 		
 			$image_info = pathinfo($source);

 			switch ($image_info['extension'])
 			{
 				case "jpg":
 					$this->image_resource = imagecreateFromjpeg($source);
 				break;
 				
 				case "jpeg":
 					$this->image_resource = imagecreateFromjpeg($source);
 					$image_info['extension'] = 'jpg';
 				break;
 				
 				case "gif":
 					$this->image_resource = imagecreateFromgif($source);
 				break;
 				
 				case "png":
 					$this->image_resource = imagecreateFrompng($source);
 				break;
 			}
 			$this->output_extension = $image_info['extension'];
 			
 			return ;
 	}
 	
 	// создание пустого изображения с фоном
 	function createNew($width = 0,$height = 0)
 	{
 		$image = imagecreatetruecolor($width,$height);
 		$this->dimentions	= array('width' => $width,'height' => $height);
 		return $image;
 		unset($image);
 	}
 	
 	// вывод или сохранения изображения
 	function makeImage($parameters = array())
 	{
 		if (!empty($this->image_resource))
 		{
 			if (isset($parameters['new_file']))
 			{
 				$info = pathinfo($parameters['new_file']);
 				$this->output_extension = $info['extension'];
 			}
 			
 			if (isset($parameters['extension']) && !empty($parameters['extension']))
 			{
 			#	print_r($parameters);
 				$this->output_extension = $parameters['extension'];
 			}
 		
 			if (empty($this->output_extension))
 			{
 				$this->output_extension = 'jpg';
 			}
 		
 			if (!isset($parameters['new_file']) || empty($parameters['new_file']))
 			{
 				header('Content-type: image/'.str_replace('jpg','jpeg',$this->output_extension));
 			}
 			
 		
 			switch ($this->output_extension)
 			{
 				case 'jpg':
 					$res = imagejpeg($this->image_resource,@$parameters['new_file'],@$parameters['quality']);
 				break;
 			
 				case 'png':
 					$res = imagepng($this->image_resource,$parameters['new_file']);
 				break;
 			
 				case 'gif':
 					
 					if (isset($parameters['new_file']))
 					{
 						imagegif($this->image_resource,$parameters['new_file']); // в GIF почему-то вызывает ошибку пустой параметр для сохранения. ставим заглушку
 					}
 					else imagegif($this->image_resource);
 					
 				break;
 			}
 		}
 		else $this->errors.= '{RESOURCE_IS_NULL}'."\r\n";

 		if (!$this->errors)
 		{
 			return true;
 		}
 		
 	}
 	
 	// ресайз
 	function Resize($parameters = array())
 	{
 		
 		$output_width	= $parameters['width'];
 		$output_height	= $parameters['height'];
 		$output_aspect	= $parameters['aspect'];
 		
		$original_width = $this->dimentions['width'];
		$original_height = $this->dimentions['height'];
	
 		
 		// вычисляем соотношение ширины и высоты
 		if ($original_height >= $output_height && $original_width >= $output_width && $output_height>0 && $output_width>0)
 		{
 			if ($output_aspect == false)
 			{
 				$original_height = $output_height;
 				$original_width  = $output_width;
 			}
 			else
 			{
 				$ratio = $original_width/$original_height;
 	
 				// сравниваем значения соотношений
 				if ($output_width/$output_height > $ratio) // если значение больше текущего соотношения - меням ширину
 				{
 					$output_width = $output_height * $ratio;
 				#	$output_height = $output_width / $ratio;
 				}
 				else
 				{
 					$output_height = $output_width / $ratio; // если меньше - высоту
 				}
 			}
 		
 			$ss = new ImageMagic();
 			$image_p = $ss->createNew($output_width, $output_height);
	#	echo "imagecopyresampled($image_p,$this->image_resource,0,0,0,0,$output_width,$output_height,$original_width,$original_height);";
	#	die();
			imagecopyresampled($image_p,$this->image_resource,0,0,0,0,$output_width,$output_height,$original_width,$original_height);			
			$this->image_resource = $image_p;
			
 			$ss->__destruct();
 		}
 	}
 	
 	// водный знак
 	function waterMark($pattern = '',$x = 0,$y = 0,$posx = 0,$posy = 0, $alpha = 50)
 	{
 		$img = new image($pattern);
		$img->createFrom();
		$image = $img->readResource();
		
		imagecopymerge
		(
			$this->image_resource,
			$image,
			$x,
			$y,
			$posx,
			$posy,
			$img->dimentions['width'],
			$img->dimentions['height'],
			$alpha
		);
	}	
 }
 ?>