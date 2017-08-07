<?
	date_default_timezone_set('America/New_York');
	setlocale(LC_ALL, 'en_CA.UTF8'); // for date methods

	define("DEBUG", true);

	if(DEBUG){
		//error_reporting(E_ERROR);
		error_reporting(E_ALL & ~E_NOTICE);
	}else{
		error_reporting(0);
	}

	define("WWW_PREFIX", "");
	define("SERVER_URL", "http://oxfam.bealmighty.com/".WWW_PREFIX);

	$action = $_REQUEST["action"];
	$ajax = $_REQUEST["a"];

	if($ajax == 1){
		$ajax = true;
	}else{
		$ajax = false;
	}

	if($_REQUEST["clear"] == "true"){
		if(function_exists('opcache_reset')){
			opcache_reset();
		}
	}
?>
