<?php

/**
 * App Engine
 *
 * Initialize the environment, load the configuration, create
 * database connection, prepare utility classes and provide
 * factory to entity repositories.
 *
 */
class App {

    /**
     * @var Config
     */
    public static $config;
    /**
     * @var Sparrow
     */
    public static $db;

    public static function init($configFile) {
        self::setTimeZone();
        self::setErrorReporting();
        self::initSession();
        self::initAutoload();
        self::loadConfiguration($configFile);
        self::loadDatabaseConnection();
        self::loadUtility();
    }

    private static function setTimeZone() {
        date_default_timezone_set('Asia/Dacca');
    }

    private static function setErrorReporting() {
        ini_set("display_errors", "on");
        error_reporting(E_ALL ^ E_NOTICE);
    }

    private static function initSession() {
        session_start();
    }

    private static function initAutoload() {
        spl_autoload_register(function($className) {

                    $paths = explode(PATH_SEPARATOR, get_include_path());

                    foreach ($paths as $path) {
                        $file = $path . DIRECTORY_SEPARATOR . $className . '.php';
                        if (file_exists($file)) {
                            include_once $file;
                            return;
                        }
                    }
                });
    }

    private static function loadConfiguration($configFile) {
        self::$config = new Config($configFile);
    }

    private static function loadDatabaseConnection() {
        $dsn = "mysqli://" . self::$config->get('db.user')
                . ":" . self::$config->get('db.pass')
                . "@" . self::$config->get('db.host')
                . ":" . self::$config->get('db.port')
                . "/" . self::$config->get('db.name');

        self::$db = new Sparrow($dsn);
    }

    private function loadUtility() {
        ViewHelper::setConfig(self::$config);
    }

    public static function run() {
		$urlparam = self::urlParameter(1);
        $page = !empty($urlparam) ? $urlparam : 'home';

        if (!file_exists(APPPATH . '/pages/' . $page . '.php')) {
            die("404 Not Found.");
        }
		if ($page == 'add-event'){
			if (empty($_SESSION['user']['user_id'])){
				die('Access Denied.');
			}
		}

        include_once APPPATH . '/pages/' . $page . '.php';
    }

    public static function getRepository($entity) {
        $repository = ucfirst($entity) . 'Repository';
        return new $repository(self::$db);
    }
	
	public static function getLeftString($s1, $s2) {
		return substr($s1, 0, strpos($s1, $s2));
	}

	public static function getFullUrl(){
		if(!isset($_SERVER['REQUEST_URI'])){ $serverrequri = $_SERVER['PHP_SELF']; }
		else{ $serverrequri = $_SERVER['REQUEST_URI']; }
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = self::getLeftString(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri;
	}
	
	public static function fetchHostName($url){
		preg_match('@^(?:http://)?([^/]+)@i',$url,$matches);
		return $host=$matches[1];
	}
	
	public static function urlParameter($num){
		$url_data=parse_url(self::getFullUrl());
		$path=explode("/",$url_data['path']);
		if(self::fetchHostName(self::getFullUrl())=='localhost') $pathplus=$path[trim($num)+1]; else $pathplus=$path[trim($num)];
		return $pathplus;
	}

}