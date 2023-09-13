<?php

namespace app\helpers\helper;

use Yii;

class Helper
{
	public function init() {}

	public function getMonthName($month)
	{
		switch ($month) {
			case '1':
				return 'Январь';
				break;
			case '2':
				return 'Февраль';
				break;
			case '3':
				return 'Март';
				break;
			case '4':
				return 'Апрель';
				break;
			case '5':
				return 'Май';
				break;
			case '6':
				return 'Июнь';
				break;
			case '7':
				return 'Июль';
				break;
			case '8':
				return 'Август';
				break;
			case '9':
				return 'Сентябрь';
				break;
			case '10':
				return 'Октябрь';
				break;
			case '11':
				return 'Ноябрь';
				break;
			case '12':
				return 'Декабрь';
				break;
		}

		return 'Январь';
	}

	public function getOldtime($time)
	{
		$delta = mktime() - $time;

		if ($delta < 60) {
			return 'сейчас';
		} else if($delta < 120) {
			return 'минуту назад';
		} else if($delta < (60*60)) {
			return (int)($delta / 60).' минут назад';
		} else if($delta < (120*60)) {
			return 'час назад';
		} else if($delta < (24*60*60)) {
			return 'сегодня';
		} else if($delta < (48*60*60)) {
			return 'вчера';
		} else if($delta < (30*24*60*60)) {
			return ((int)($delta / 86400)).' дней назад';
		} else if ($delta < (60*24*60*60)){
			return 'месяц назад';
		} else
			return date('d.m.Y',$time);
	}

	public static function getCityPhone()
	{
		$cookies = Yii::$app->request->cookies;

		$city = $cookies->getValue('city');

		if (empty($city))
		{
			$_SERVER['REMOTE_ADDR'] = '109.226.234.141';

			if ($geoip = @file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']))
			{
				$geoip = unserialize($geoip);

			 	if (!empty($geoip['geoplugin_city']))
			 	{
			 		$cookies = Yii::$app->response->cookies;

			 		$cookies->add(new \yii\web\Cookie([
					    'name' => 'city',
					    'expire' => time()+365*24*60*60,
					    'path'=>'/',
					    'value' => $geoip['geoplugin_city'],
					]));

					$city = $geoip['geoplugin_city'];
			 	}
			}
			else
				$cookies->add(new \yii\web\Cookie([
				    'name' => 'city',
				    'value' => 'Other',
				]));
		}



		if ($city=='Krasnoyarsk')
			return \app\models\Vars::getVar('krasnoyarsk_phone');
		else
			return \app\models\Vars::getVar('phone');
	}

	public function Sec2Time($time)
	{
	  if (is_numeric($time))
		{
			$value = array(
			  "years" => 0, "days" => 0, "hours" => 0,
			  "minutes" => 0, "seconds" => 0,
			);

			$str = "";

			if($time < 60)
			{
				$str="0:";
			}
			if($time >= 3600)
			{
			  $value["hours"] = floor($time/3600);
			  $time = ($time%3600);
			  $str.=sprintf("%1$02d",$value["hours"])." : ";
			}
			if($time >= 60)
			{
			  $value["minutes"] = floor($time/60);
			  $time = ($time%60);
			  $str.=sprintf("%1$02d",$value["minutes"]).":";
			}
			$value["seconds"] = floor($time);
			  $str.=sprintf("%1$02d",$value["seconds"]);

			return $str;
		}
		else
			return false;
	}

	/**
	 * Перевод для имени файла
	 *
	 */
	public static function transFileName($name)
	{

		$name = strtr($name, array("а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "yo", "ж" => "g", "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h", "ц" => "ts", "ч" => "ch",
			"ш" => "sh", "щ" => "shch", "ъ" => "", "ы" => "i", "ь" => "", "э" => "e",  "ю" => "yu", "я" => "ya", "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D", "Е" => "E", "Ё" => "Yo", "Ж" => "G", "З" => "Z", "И" => "I",  "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N", "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
			"У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "Ts", "Ч" => "Ch", "Ш" => "Sh", "Щ" => "Shch", "Ъ" =>"", "Ы" => "I", "Ь" => "",
			"Э" => "E", "Ю" => "Yu", "Я" => "Ya", "ж"=>"zh", '/'=>'_', '\\'=>'_', '"'=>'_', '#'=>'_', '№'=>'_',
			"'"=>"", "-"=>"_", " "=>"_", "ч"=>"ch", "ш"=>"sh", "щ"=>"shch","ь"=>"", "ъ"=>"", "ю"=>"yu", "я"=>"ya", "Ж"=>"Zh", "Ч"=>"Ch", "Ш"=>"Sh", "Щ"=>"Shch","Ь"=>"", "ъ"=>"Ъ", "Ю"=>"Yu",
			"Я"=>"Ya", "ї"=>"i", "Ї"=>"Yi", "є"=>"ie", "Є"=>"Ye", ")"=>"", "("=>""));
		return $name;
	}

	/**
	 * Сделать превью
	 *
	 * @param unknown_type $source
	 * @param unknown_type $size
	 * @return unknown
	 */
	public function makeThumb($source, $options)
	{
		if (empty($options))
			return $source;

		$root = Yii::getPathOfAlias('webroot');

		$newfile = $this->getThumb($source,$options);
		$dest_file = $root.$newfile;

		if (is_file($dest_file))
			return $newfile;

		$source = $root.$source;
		Yii::app()->thumber->makethumb($source, $dest_file, $options);

		return $newfile;
	}

	/**
	 * Получить название файла из исходного и размера
	 *
	 * @param unknown_type $source
	 * @param unknown_type $size
	 */
	public function getThumb($source,$options)
	{

		$root = Yii::getPathOfAlias('webroot');
		$dir = $root.'/assets/preview/';

		$ext = substr($source,strrpos($source,'.'));

		$source_md5 = md5($source.$options);

		// первые 3 символа
		$level1 = substr($source_md5,0,2);
		if (!is_dir($dir.$level1))
			mkdir($dir.$level1);

		// вторые три символа
		$level2 = substr($source_md5,2,2);
		if (!is_dir($dir.$level1.'/'.$level2))
			mkdir($dir.$level1.'/'.$level2);

		$dest_file = '/assets/preview/'.$level1.'/'.$level2.'/'.$source_md5.$ext;

		return  $dest_file;
	}

	/**
	 * Сделать превью
	 *
	 * @param unknown_type $source
	 * @param unknown_type $size
	 * @return unknown
	 */
	public function makeThumbOption($source, $options)
	{
		if (!is_file(Yii::app()->params['root'].$source))
			return false;

		$newfile = $this->getThumb($source, $options);
		$dest_file = Yii::app()->params['root'].$newfile;

		if (is_file($dest_file))
			return $newfile;

		$source = Yii::app()->params['root'].$source;
		Yii::app()->thumber->makethumb($source, $dest_file, $options);

		return $newfile;
	}

	/**
	 * Сгенерировать путь для файла
	 *
	 * @param unknown_type $path
	 * @param unknown_type $ext
	 * @return unknown
	 */
	public function makeImageFolder($path,$ext)
	{
		$dir = Yii::app()->params['goodsImage'];
		$source_md5 = md5($path.$ext);

		$level1 = substr($source_md5,0,2);
		if (!is_dir($dir.$level1))
			mkdir($dir.$level1);

		$level2 = substr($source_md5,2,2);
		if (!is_dir($dir.$level1.'/'.$level2))
			mkdir($dir.$level1.'/'.$level2);

		$dest_file = '/assets/goods/images/'.$level1.'/'.$level2.'/'.substr($source_md5,4).$ext;
		return  $dest_file;
	}

	/**
	 * Вернуть расширение файла по типу
	 *
	 * @param unknown_type $mime
	 * @return unknown
	 */
	public static function getImageExtention($mime)
	{
		switch ($mime) {
			case "image/gif":
			    return "gif";
			case "image/jpeg":
			    return "jpg";
			case "image/png":
			    return "png";
			case "image/bmp":
			    return "bmp";
			case "image/x-ms-bmp":
			    return "bmp";
		}
		return false;
	}

	/**
	 * Добавляет http в url
	 *
	 * @param unknown_type $url
	 * @return unknown
	 */
	public function addHttp($url)
	{
		if (strpos($url,'http:')===false)
			$url = 'http://'.$url;

		return $url;
	}

	/**
	 * Возвращает строку уложенную в лимит с ...
	 *
	 * @param unknown_type $string
	 * @param unknown_type $length
	 * @return unknown
	 */
	public function makeShortString($string,$length)
	{
		if (mb_strlen($string,'utf-8')>$length-1)
			return  mb_substr($string,0,$length-1,'utf-8').'&#133;';

		return $string;
	}

	public static function makeVideoByUrl($url)
	{
		$url = parse_url($url);

		if (empty($url['query']))
			return '';

		$url = $url['query'];
		$url = explode('&', $url);

		$get = array();
		foreach ($url as $key=>$value)
		{
			$temp = explode('=',$value);
			$get[$temp[0]] = $temp[1];
		}

		if (isset($get['v']))
		{
			return '<div class="youtube"><iframe src="//www.youtube.com/embed/'.$get['v'].'" frameborder="0" allowfullscreen></iframe></div>';
		}

		return '';
	}

	public function urlFromPath($path)
	{
		$url = str_replace(Yii::getPathOfAlias('webroot'),'',$path);
		return $url;
	}

	public function ucfirst_utf8($stri)
	{
		if($stri[0]>="\xc3") return (($stri[1]>="\xa0")?($stri[0].chr(ord($stri[1])-32)):($stri[0].$stri[1])).substr($stri,2);
	 	else return ucfirst($stri);
	}

	public function getSelectByArray(&$array,$id,$level,&$output,$selected)
	{
		if (isset($array[$id]))
		foreach ($array[$id] as $key=>$value) {
			$output .= '<option value="'.$key.'" '.(($key==$selected)?'selected':'').'>'.str_repeat('- - ', $level).$value.'</option>';
			if (isset($array[$key]))
				$this->getSelectByArray($array,$key,$level+1,$output,$selected);
		}
	}

	public function getCover($url)
	{
		// youtube
		if (strpos($url,'youtube.com')!==false)
		{
			$get = array();

			$url = substr($url,strpos($url,'?')+1);
			$url = explode('&', $url);
			foreach ($url as $key=>$value)
			{
				$temp = explode('=',$value);
				$get[$temp[0]] = $temp[1];
			}

			if (isset($get['v']))
			{
				$file = file_get_contents("//img.youtube.com/vi/{$get['v']}/0.jpg");
				$img = Yii::app()->params['upload'].$get['v'].'.jpg';
				file_put_contents($img,$file);

				return $img;
			}
		}
		else if (strpos($url,'vimeo.com')!==false)
		{
			$c = curl_init($url);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			$page = curl_exec($c);
			curl_close($c);

			$page = file_get_contents($url);
			preg_match('/<meta property="og:image" content="(.*?)" \/>/', $page, $matches);
			$img = $matches[1];
			$url = str_replace(array('/','.',':'),'_',$url);

			$file = file_get_contents($img);
			$img = Yii::app()->params['upload'].$url.'.jpg';
			file_put_contents($img,$file);

			return $img;
		}

		return '';
	}

	/**
	* Метод для обработки множественных целых чисел
	*
	* @param int число
	* @param array массив вида ("единственое_число", "два_экземпляра", "множественное число"). Пример: array("собака", "собаки", "собак")
	*
	* @return строка вида "3 собаки"
	*/
	public function plural($num, $forms)
	{
		$tail = $num % 100;

		if($tail>20 || $tail<5)
			switch($tail % 10)
			{
				case 1: $forms[2] = $forms[0]; break;
				case 2:
				case 3:
				case 4: $forms[2] = $forms[1];
		}
		return $num." ".$forms[2];
	}

	public function formatName($name)
	{
		$pos = mb_strpos($name, ' ',0,'utf-8');
		return  mb_substr($name,0,$pos,'utf-8');
	}


	public static function isMobile()
	{
		$res = \Yii::$app->devicedetect->isMobile();

		if(isset($_COOKIE['sw']) && $_COOKIE['sw']<700)
			$res = true;

		return $res;
	}
}
?>