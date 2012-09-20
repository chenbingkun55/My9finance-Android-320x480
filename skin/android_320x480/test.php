<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 
	echo date('z',mktime(0,0,0,date("m"),date("d"),date("Y")));


				<span>
				<script>PrintDate();setInterval("PrintDate()",60000)</script>
			</span>
		</td><td>

		<span onLoad=PostMessage()></span>
?>

