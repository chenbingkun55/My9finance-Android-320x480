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
<script type="text/javascript" src="<?PHP echo JS_PATH."in_out_record.js"?>"></script>
</head>

<body class="mainfont">
	<div class="BodyDiv" id="BodyDiv">
		<?PHP 
			 require_once("head.php"); 
			 require_once("body.php");
			 require_once("tail.php"); 
		?>
	</div>
</body>
</html>