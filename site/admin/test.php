<?php

function detectColors($image, $num, $level = 5) {
  $level = (int)$level;
  $palette = array();
  $size = getimagesize($image);
  if(!$size) {
    return FALSE;
  }
  switch($size['mime']) {
    case 'image/jpeg':
      $img = imagecreatefromjpeg($image);
      break;
    case 'image/png':
      $img = imagecreatefrompng($image);
      break;
    case 'image/gif':
      $img = imagecreatefromgif($image);
      break;
    default:
      return FALSE;
  }
  if(!$img) {
    return FALSE;
  }
  for($i = 0; $i < $size[0]; $i += $level) {
    for($j = 0; $j < $size[1]; $j += $level) {
      $thisColor = imagecolorat($img, $i, $j);
      $rgb = imagecolorsforindex($img, $thisColor); 
      $color = sprintf('%02X%02X%02X', (round(round(($rgb['red'] / 0x33)) * 0x33)), round(round(($rgb['green'] / 0x33)) * 0x33), round(round(($rgb['blue'] / 0x33)) * 0x33));
      $palette[$color] = isset($palette[$color]) ? ++$palette[$color] : 1;  
    }
  }
  arsort($palette);
  return array_slice(array_keys($palette), 0, $num);
}

if($_POST['submit'])
{
	$filename = $_FILES['file']['name'];
	$tmp = $_FILES['file']['tmp_name'];
	
	if(move_uploaded_file($tmp,"uploads/".$filename))
	{
		
		$img = "uploads/".$filename;
		$palette = detectColors($img, 6, 1);
		
		$exif = exif_read_data($img, 'IFD0');
		
		if($exif)
		{
			$exifArr = array();
			
			foreach($exif as $e => $section)
			{				
				switch($e)
				{
					case "Make":
						$make = $section;
						$exifArr[$e] = $section;
						break;
					case "Model":
						$model = $section;
						$exifArr[$e] = $section;
						break;
					case "Orientation":
						$orientation = $section;
						$exifArr[$e] = $section;
						break;
					case "DateTime":
						$datetime = $section;
						$exifArr[$e] = $section;
						break;
					case "ExposureTime":
						$exposuretime = $section;
						$exifArr[$e] = $section;
						break;
					case "FNumber":
						$fnumber = $section;
						$exifArr[$e] = $section;
						break;
					case "ISOSpeedRatings":
						$isospeedrating = $section;
						$exifArr[$e] = $section;
						break;
					case "MaxApertureValue":
						$maxaperturevalue = $section;
						$exifArr[$e] = $section;
						break;
					case "WhiteBalance":
						$whitebalance = $section;
						$exifArr[$e] = $section;
						break;
					case "Contrast":
						$contrast = $section;
						$exifArr[$e] = $section;
						break;
					case "Saturation":
						$saturation = $section;
						$exifArr[$e] = $section;
						break;
					case "Sharpness":
						$sharpness = $section;
						$exifArr[$e] = $section;
						break;
					case "GPSLatitudeRef":
						$gpslatituderef = $section;
						$exifArr[$e] = $section;
						break;
					case "GPSLatitude":
						$gpslatitude = $section;
						$str = "";
						
						foreach($gpslatitude as $g => $gpslat)
						{
							$str .= $gpslat."--";
						}
						
						$exifArr[$e] = $str;
						break;
					case "GPSLongitudeRef":
						$gpslongituderef = $section;
						$exifArr[$e] = $section;
						break;
					case "GPSLongitude":
						$gpslongitude = $section;
						$str = "";
						
						foreach($gpslatitude as $g => $gpslat)
						{
							$str .= $gpslat."--";
						}
						$exifArr[$e] = $str;
						break;
				}		
			}	
			
			
			
			echo "<img src='".$img."' style='max-width:200px;'>";
			echo "<br>";
			
			foreach($exifArr as $e => $ex)
			{
				echo $e." : ".$ex."<br>";
			}
			
			$colourstr = array();
			
			foreach($palette as $color) {
				$colourstr[] = $color;
			}
			
			foreach($colourstr as $c => $col)
			{
				echo "<div style='width:10px; height:10px; background-color:#".$col."; display:inline-block;'></div> : #".$col."<br>";
			}
		}
	}
}
?>

<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="file"/><br>
    <input type="submit" name="submit" value="Upload"/>
</form>