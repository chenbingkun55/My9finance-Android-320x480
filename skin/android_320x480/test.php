<?PHP 	
	require("../../config/config.inc.php");
	require(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 

	//echo $Finance->bankCardType("1");

	$Finance->Tab_Date("out_corde");
	echo "<BR>".strtotime(now);


?>


