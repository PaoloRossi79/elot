<?php
class GlobalFun 
{
	public function getNameImage($mode, $name)
	{
		/*if (!empty($mode)) {
			$mode = '-' . $mode;
		}
		$nameOut=$name;
		$b=-1;
		$p1 = 0;
		while($b=strpos($name,".",$p1)) $p1 = $b +1;
		if(($p1-$b)>0) {
			$nameOut = substr($name, 0, $p1-$b-1);
			$ext = substr($name, $p1-$b-1, StrLen($name));
//			$ext = pathinfo($name); $ext = '.' . $ext['extension'];
			if($nameOut!=="") $nameOut = $nameOut . $mode . $ext;
		}
                if ( $cat == 'deals' ) $cat = 'deales';
		return Yii::app()->storage->url($cat.'/'.$prefix.$nameOut);*/
                return $name;
	}
}