<?php
class ElaborationImage {
	
	const CATEGORY_USERS = 1;
	const CATEGORY_LOTTERIES = 2;
	
	var $image;
	var $image_type;

	function load($filename) {
		$tmpfname = tempnam(sys_get_temp_dir(), 'ElabImg');
		$streamh = Yii::app()->storage->read($filename);
		$contents = stream_get_contents($streamh);
		file_put_contents($tmpfname, $contents);
		$image_info = getimagesize($tmpfname);
		$this->image_type = $image_info[2];
		if( $this->image_type == IMAGETYPE_JPEG ) $this->image = imagecreatefromjpeg($tmpfname);
		elseif( $this->image_type == IMAGETYPE_GIF ) $this->image = imagecreatefromgif($tmpfname);
		elseif( $this->image_type == IMAGETYPE_PNG ) $this->image = imagecreatefrompng($tmpfname);
	}
	 
	function save($filename, $image_type=IMAGETYPE_JPEG, $compression=100, $permissions=null) {
		$tmpfname = tempnam(sys_get_temp_dir(), 'ElabImg');
		if( $image_type == IMAGETYPE_JPEG ) imagejpeg($this->image,$tmpfname,$compression);
		elseif( $image_type == IMAGETYPE_GIF ) imagegif($this->image,$tmpfname);
		elseif( $image_type == IMAGETYPE_PNG ) {
			imagepng($this->image,$tmpfname,0);
		}
		if($permissions != null) chmod($tmpfname,$permissions);
		imagedestroy($this->image);
		$fh = fopen($tmpfname, 'r');
		Yii::app()->storage->save($filename, $fh);
		fclose($fh);
	}
	 
	function output($image_type=IMAGETYPE_JPEG) {
		if( $image_type == IMAGETYPE_JPEG ) imagejpeg($this->image);
		elseif( $image_type == IMAGETYPE_GIF ) imagegif($this->image);
		elseif( $image_type == IMAGETYPE_PNG ) {
			imagealphablending($this->image, false);
			imagesavealpha($this->image, true);
			imagepng($this->image);
		}
	}

	function getWidth() {
		return imagesx($this->image);
	}

	function getHeight() {
		return imagesy($this->image);
	}

	function resizeToHeight($height) {
		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resize($width,$height);
	}

	function resizeToWidth($width) {
		$ratio = $width / $this->getWidth();
		$height = $this->getheight() * $ratio;
		$this->resize($width,$height);
	}

	function scale($scale) {
		$width = $this->getWidth() * $scale/100;
		$height = $this->getheight() * $scale/100;
		$this->resize($width,$height);
	}

	function resize($width,$height) {
		$new_image = imagecreatetruecolor($width, $height);
		imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127));
		imagealphablending($new_image, false);
		imagesavealpha($new_image, true);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}


	function resizecrop($width,$height,$sharpen=true) {

		//Ritaglia immagine (centrando orizzontalmente o parte alta se foto verticale
		$w = $this->getWidth();
		$h = $this->getHeight();
		$ratio = max($width/$w, $height/$h);
		$h = $height / $ratio;
		$x = ($w - $width / $ratio) / 2;
		$w = $width / $ratio;

		if ($sharpen) {
			//Messa a fuoco con matrice di convoluzione
			$new_image = imagecreatetruecolor($width, $height);
			imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127));
			imagealphablending($new_image, false);
			imagesavealpha($new_image, true);
			imagecopyresampled($new_image, $this->image, 0, 0, $x, 0, $width, $height, $w, $h);
			$convolution = array(
				array(-1.2, -1, -1.2),
				array(-1, 20, -1),
				array(-1.2, -1, -1.2),
			);
			if (function_exists('imageconvolution')) imageconvolution($new_image, $convolution, array_sum(array_map('array_sum', $convolution)), 0);
		}

		$this->image = $new_image;
	}

	public function getFileImage($model, $field, $oldValue)
	{
		$fileImg = CUploadedFile::getInstance($model, $field);
		if (is_object($fileImg) && get_class($fileImg)==='CUploadedFile')
		{
			$model[$field] = '*';
			return $fileImg;
		} else {
			$model[$field] = $oldValue;
			return null;
		}
	}

	public function getFileImageByName($name) {
		$fileImg = CUploadedFile::getInstanceByName($name);
		if (is_object($fileImg) && get_class($fileImg)==='CUploadedFile') {
			return $fileImg;
		}
		return null;
	}

	public function saveImage($category, $id, $myfile)
	{
		if($category===self::CATEGORY_USERS) {
			$pathImg='images/users/';
		}elseif($category===self::CATEGORY_LOTTERIES) {
			$pathImg='images/lotteries';
		}

		$ext = pathinfo($myfile->name);
		$oext = $ext['extension'];
		$ext = '.' . $ext['extension'];
		$tmpfname = tempnam(sys_get_temp_dir(), 'ElabImgOrig');
		$myfile->saveAs($tmpfname);
		$filename = $pathImg .$id.$ext;
		move_uploaded_file($myfile->name, $filename);
		
		//trovo il tipo di file
		if (in_array(strtolower($oext),array('gif','jpg','jpeg','png')))
			switch (strtolower($oext)) {
				case 'jpg':
					$filetype = IMAGETYPE_JPEG;
					break;
				case 'jpeg':
					$filetype = IMAGETYPE_JPEG;
					break;
				case 'png':
					$filetype = IMAGETYPE_PNG;
					break;
				case 'gif':
					$filetype = IMAGETYPE_GIF;
					break;
				default:
					$filetype = IMAGETYPE_JPEG;
					break;
		}

		if ($category===self::CATEGORY_USERS) {

			//Immagini deals:
			//43x43 -> thumbnail
			//338x338 -> preview
			//1000x100 -> zoomed
			//189x189 -> side

			$image = new ElaborationImage();
			$image->load($filename);
			$image->resizecrop(43,43);
			$imgfile = $pathImg .$id .'-t'. $ext;
			$image->save($imgfile,$filetype);

			$image = new ElaborationImage();
			$image->load($filename);
			$image->resizecrop(338,338);
			$imgfile = $pathImg .$id .'-p'. $ext;
			$image->save($imgfile,$filetype);

			$image = new ElaborationImage();
			$image->load($filename);
			$image->resizecrop(1000,1000);
			$imgfile = $pathImg .$id .'-z'. $ext;
			$image->save($imgfile,$filetype);

			$image = new ElaborationImage();
			$image->load($filename);
			$image->resizecrop(149,189);
			$imgfile = $pathImg .$id .'-s'. $ext;
			$image->save($imgfile,$filetype);
		} else if ($category===2) {

			//Immagini Sommeliers
			//75x57 -> thumbnail
			//230x280 -> preview

			$image = new ElaborationImage();
			$image->load($filename);
			$image->resizecrop(75,57);
			$imgfile = $pathImg .$id .'-t'. $ext;
			$image->save($imgfile,$filetype);

			$image = new ElaborationImage();
			$image->load($filename);
			$image->resizecrop(230,280);
			$imgfile = $pathImg .$id .'-p'. $ext;
			$image->save($imgfile,$filetype);
		}

		return ($id . $ext);
	}
}
?>