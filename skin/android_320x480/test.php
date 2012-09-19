<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 
	echo date('z',mktime(0,0,0,date("m"),date("d"),date("Y")));

?>