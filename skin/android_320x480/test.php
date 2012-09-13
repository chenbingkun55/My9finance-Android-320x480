<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 
	
						$date_min =  mktime( 0,0, 0, date('m',time()) ,date('d',time()) - date('N',time()) + 1 ,date( 'Y',time()));
						$date_max =  mktime( 0,0, 0, date('m',time()) ,date('d',time()) - date('N',time()) + 7 , date('Y',time()));
 var_dump(date('Y-m-d',$date_min),date('Y-m-d',$date_max));
?>