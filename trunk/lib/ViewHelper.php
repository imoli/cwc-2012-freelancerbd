<?php

/**
 * ViewHelper
 *
 * Provides various helper method for working with views.
 *
 */
class ViewHelper {

    protected static $config;

    public static function setConfig($config) {
        self::$config = $config;
    }

    public static function config($key) {
        return self::$config->get($key);
    }

    public static function url($path = '', $return = false) {
        if ($return) {
            return self::$config->get('url.base') . $path;
        } else {
            echo self::$config->get('url.base') . $path;
        }
    }

    public static function alertMessage($content, $type = 'warning') {
        echo <<<MSG
<div class="alert-message $type">
    <a class="close" href="#">×</a>
    <p>$content</p>
</div>
MSG;
    }

    public static function flushMessage() {
        if (!empty($_SESSION['flash']['message'])) {
            $type = isset($_SESSION['flash']['type']) ? $_SESSION['flash']['type'] : 'warning';
            ViewHelper::alertMessage($_SESSION['flash']['message'], $type);
            unset($_SESSION['flash']);
        }
    }

    public static function formatDate($date) {
        return date("Y-m-d", strtotime($date));
    }
	
	/**
	 * added by imran rahman
	 * 
	 */
	public static function dateIsvalid($str)
	{
		$array = explode('/', $str);
		$month = $array[0];
		$day = $array[1];
		$year = $array[2];

		$isDateValid=checkdate($month, $day, $year);
		return $isDateValid;
	}
	
        public static function jsRedirect($path){
            
             echo '<script language="javascript">
            window.location.href="'.$path.'";
            </script>';
   
            
        }

        
	/*private function strleft($s1, $s2) {
		return substr($s1, 0, strpos($s1, $s2));
	}
	
	public static function fullurl(){		
		if(!isset($_SERVER['REQUEST_URI'])){ $serverrequri = $_SERVER['PHP_SELF']; }
		else{ $serverrequri = $_SERVER['REQUEST_URI']; }
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = self::strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri;
	}*/
        
        
	

}