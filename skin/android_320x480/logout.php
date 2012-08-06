<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');	
	header("Content-Type:text/html;charset=UTF-8"); 	
	date_default_timezone_set('PRC');
?>

<html>
<head>
<title><?PHP echo $_TITLE?></title>
<link href="<?PHP echo CSS_PATH."main.css"?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?PHP echo JS_PATH."main.js"?>"></script>
</head>
<body>
	<div class="BackPlane" id="BodyDiv">
<?PHP 
	/*
		清除所有PHP Session。
	*/
	$_SESSION['__global_logid']=6000;
	$error_info	= $Finance->convertLogIdToContent($_SESSION['__global_logid']);
	echo "<br><br>&nbsp;".$error_info['0']['content'];
	$text_log = "用户: [".$_SESSION['__userdata']['0']["username"]."] 注销成功";
	session_destroy();
	/*
		跳转到登录页面。
	*/	
	if(DEBUG_YES){ 
		echo "<br>DEBUG START*********************************************<br>";
		echo "提示内容为: ".$Finance->convertLogIdToContent($_SESSION['__global_logid']);
		echo "<br>DEBUG END*********************************************<br>";	
	}else {
		echo "<script>window.location.href='index.php';</script>";
	}

	/*  记录Log  */
	if (! empty($text_log)) {
		$Finance->CrodeLog($text_log);
	}
?>
	</div>
</body>
</html>