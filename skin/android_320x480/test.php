<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 
	$date_year = mktime( 0,0, 0, 12 ,1 ,date( 'Y',time()) -1 ); ;
	echo date('Y',$date_year); 
?>