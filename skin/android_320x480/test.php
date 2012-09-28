<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 

	$str="    abc    ";

	echo "A".$str."A<BR>";
	$str = trim( $str );
	echo "A".$str."A<BR>";
?>


