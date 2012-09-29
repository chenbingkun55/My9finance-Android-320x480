<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 


	/* 初始化用户环境变量 */
	$login_username = $_SESSION['__userdata']['0']["username"];
	if( $_SESSION['__userdata']['0']["user_alias"] ) { 
			$login_user_alias = $_SESSION['__userdata']['0']["user_alias"] ;
	} else {
			$login_user_alias = $_SESSION['__userdata']['0']["username"] ;
	}
	$login_user_id = $_SESSION['__userdata']['0']["id"];
	$login_user_session = $_SESSION['__userdata']['0']["session"];
	$login_last_date = $_SESSION['__userdata']['0']["last_date"];
	$login_family_num = $_SESSION['__userdata']['0']['family_num'];
	$login_family_adm = $_SESSION['__userdata']['0']['family_adm'];
	$login_skin_id = $_SESSION['__userdata']['0']["skin"];
	if ( ! isset($_SESSION['date_num']))  $_SESSION['date_num'] = 0;

	/* 判断用户名为空时退出, 不是当前 Session 时退出 */
	$temp_session = $Finance->getUserSession($login_user_id) ;
	if ( empty($login_username) || $login_user_session != $temp_session['0']["session"])
	{
		$_SESSION['__global_logid'] = "3";
		echo "<script>window.location.replace('index.php?logid=3');</script>";
	}


	if ( ! is_null($_GET['skin'])){
		$Finance->UpdateSkin($login_user_id,$_GET['skin']);
		$_SESSION['__userdata']['0']['skin'] = $_GET['skin'];
		$login_skin_id = $_SESSION['__userdata']['0']["skin"];
	}
?>

<html>
<head>
<title><?PHP echo $_TITLE?></title>
<link href="<?PHP echo CSS_PATH."base_public.css"?>" rel="stylesheet" type="text/css" />
<link href="<?PHP echo CSS_PATH."user_skin.".$login_skin_id.".css"?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?PHP echo JS_PATH."base_public.js"?>"></script>
</head>

<body>
	<div class="Backplane" id="BodyDiv">
		<?PHP 
			$page = $_GET['page'];
			 require("head.php"); 
			 if (!$page){
				require("record.php");
			 }else{
				require("$page");
			 }
			 require("foot.php"); 
		?>
	</div>
</body>
</html>