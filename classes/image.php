<?php 
class Image
{
    public function create_filename($length)
	{
		$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$text = "";
		for($x = 0; $x < $length; $x++)
		{
			$random = rand(0,61);
			$text .= $array[$random];
		}
		return $text;
	}

	public function crop_image($imgpath,$croppedpath,$width,$height)
	{

		if(file_exists($imgpath))
		{
 
			$original_image = imagecreatefromjpeg($imgpath);
			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);
			if($original_height > $original_width)
			{
                //make width equal to max width;
				$ratio = $width / $original_width;
				$new_width = $width;
				$new_height = $original_height * $ratio;

			}else
			{

				//make width equal to max width;
				$ratio = $height / $original_height;

				$new_height = $height;
				$new_width = $original_width * $ratio;
			}
		}

		//adjust incase max width and height are different
		if($width != $height)
		{

			if($height > $width)
			{

				if($height > $new_height)
				{
					$adjustment = ($height / $new_height);
				}else
				{
					$adjustment = ($new_height / $height);
				}

				$new_width = $new_width * $adjustment;
				$new_height = $new_height * $adjustment;
			}else
			{

				if($width > $new_width)
				{
					$adjustment = ($width / $new_width);
				}else
				{
					$adjustment = ($new_width / $width);
				}

				$new_width = $new_width * $adjustment;
				$new_height = $new_height * $adjustment;
			}
		}

		$new_image = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

		imagedestroy($original_image);

		if($width != $height)
		{

			if($width > $height)
			{

				$diff = ($new_height - $height);
				if($diff < 0){
					$diff = $diff * -1;
				}
				$y = round($diff / 2);
				$x = 0;
			}else
			{

				$diff = ($new_width - $height);
				if($diff < 0){
					$diff = $diff * -1;
				}
				$x = round($diff / 2);
				$y = 0;
			}
		}else
		{
			if($new_height > $new_width)
			{

				$diff = ($new_height - $new_width);
				$y = round($diff / 2);
				$x = 0;
			}else
			{

				$diff = ($new_width - $new_height);
				$x = round($diff / 2);
				$y = 0;
			}
		}

		$new_cropped_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $width, $height, $width, $height);
		
		imagedestroy($new_image);

		imagejpeg($new_cropped_image,$croppedpath,90);
		imagedestroy($new_cropped_image);
	}

	//resize the image
	public function resize_image($imgpath,$resizedpath,$width,$height)
	{
		if(file_exists($imgpath))
		{
			$original_image = imagecreatefromjpeg($imgpath);

			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);

			if($original_height > $original_width)
			{
				//make width equal to max width;
				$ratio = $width / $original_width;

				$new_width = $width;
				$new_height = $original_height * $ratio;

			}else
			{

				//make width equal to max width;
				$ratio = $height / $original_height;

				$new_height = $height;
				$new_width = $original_width * $ratio;
			}
		}

		//adjust incase max width and height are different
		if($width != $height)
		{

			if($height > $width)
			{

				if($height > $new_height)
				{
					$adjustment = ($height / $new_height);
				}else
				{
					$adjustment = ($new_height / $height);
				}

				$new_width = $new_width * $adjustment;
				$new_height = $new_height * $adjustment;
			}else
			{

				if($width > $new_width)
				{
					$adjustment = ($width / $new_width);
				}else
				{
					$adjustment = ($new_width / $width);
				}

				$new_width = $new_width * $adjustment;
				$new_height = $new_height * $adjustment;
			}
		}

		$new_image = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

		imagedestroy($original_image);

		imagejpeg($new_image,$resizedpath,100);
		imagedestroy($new_image);
	}

	//create thumbnail for cover image
	public function get_thumb_cover($filename)
	{

		$thumbnail = $filename . "_cover_thumb.jpg";
		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}

		$this->crop_image($filename,$thumbnail,1366,488);

		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}else
		{
			return $filename;
		}
	}
	public function jpeg_to_png($png_path, $jpeg_path)
	{
		$image = imagecreatefrompng($png_path);
		$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
		imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
		imagealphablending($bg, TRUE);
		imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
		imagedestroy($image);
		$filename = $jpeg_path;
		imagejpeg($bg, $filename, 90);
		imagedestroy($bg);
		unlink($png_path);
		return $filename;
	}
	//create thumbnail for profile image
	public function get_thumb_profile($filename)
	{

		$thumbnail = $filename . "_profile_thumb.jpg";
		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}

		$this->crop_image($filename,$thumbnail,600,600);

		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}else
		{
			return $filename;
		}
	}

	//create thumbnail for post image
	public function get_thumb_post($filename)
	{

		$thumbnail = $filename . "_post_thumb.jpg";
		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}

		$this->crop_image($filename,$thumbnail,600,600);

		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}else
		{
			return $filename;
		}
	}


}

?>