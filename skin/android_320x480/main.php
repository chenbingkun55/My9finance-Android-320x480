<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 


	/* 初始化用户环境变量 */
	$login_username = $_SESSION['__userdata']['0']["username"];
	$login_user_alias = $_SESSION['__userdata']['0']["user_alias"];
	$login_user_id = $_SESSION['__userdata']['0']["id"];
	$login_user_session = $_SESSION['__userdata']['0']["session"];
	$login_last_date = $_SESSION['__userdata']['0']["last_date"];
	$login_groupname = $_SESSION['__groupdata']['0']['groupname'];
	$login_group_alias = $_SESSION['__groupdata']['0']['group_alias'];
	$login_groupadmin_id = $_SESSION['__groupdata']['0']['groupadmin_id'];
	$login_group_id = $_SESSION['__groupdata']['0']['id'];
	$login_skin_id = $_SESSION['__userdata']['0']['skin'];

	if ( ! is_null($_GET['skin'])){
		$Finance->UpdateSkin($login_user_id,$_GET['skin']);
		$_SESSION['__userdata']['0']['skin'] = $_GET['skin'];
		$login_skin_id = $_SESSION['__userdata']['0']["skin"];
	}
	
?>

<html>
<head>
<title><?PHP echo $_TITLE?></title>
<link href="<?PHP echo CSS_PATH."main.".$login_skin_id.".css"?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?PHP echo JS_PATH."main.js"?>"></script>
</head>

<body>
	<div class="Backplane" id="BodyDiv">
		<?PHP 
			$page = $_GET['page'];
			 require_once("head.php"); 
			 if (!$page){
				require_once("record.php");
			 }else{
				require_once("$page");
			 }
			 require_once("foot.php"); 
		?>
	</div>
</body>
</html>