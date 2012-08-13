<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 
	
	$Finance->insertMainTypeDefault(90);
	$Finance->insertAddressDefault(90);
	$Finance->insertSubTypeDefault(90);
	echo "³É¹¦£¡"

?>