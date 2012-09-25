<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');	
	header("Content-Type:text/html;charset=UTF-8"); 	
	date_default_timezone_set('PRC');
?>

<html>
<head>
<title><?PHP echo $_TITLE?></title>
<link href="<?PHP echo CSS_PATH."base_public.css"?>" rel="stylesheet" type="text/css" />
<link href="<?PHP echo CSS_PATH."user_skin.".$login_skin_id.".css"?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?PHP echo JS_PATH."base_public.js"?>"></script>
</head>

<body>
	<div class="BackPlane" id="BodyDiv">

<?PHP
	$_SESSION['__global_logid']=6001;
	$error_info	= $Finance->convertLogIdToContent($_SESSION['__global_logid']);
	echo "<br><br>&nbsp;".$error_info['0']['content'];

	$username = $_POST['username'];
	$password = $_POST['password'];
	$logindata=explode(".",$username);

	/* 判断登录用户 */
	$_SESSION['__userdata'] = $Finance->login($username,  $password);

	if(DEBUG_YES){ 
		echo "<br>DEBUG START*********************************************<br>";
		echo "用户名: ".$_POST['username']."<BR>";
		echo "密码: ".$_POST['password']."<BR>";
		print_r($_SESSION['__userdata']); 
		echo "<br>DEBUG END*********************************************<br>";	
	}

	if ( $_SESSION['__userdata'] == '1' ) {
		$_SESSION['__global_logid']=1 ;
		$text_log = "用户: [".$username."] 未知用户.";
	} else if ( $_SESSION['__userdata'] == '2' ) {
		$_SESSION['__global_logid']=2 ;
		$text_log = "用户: [".$username."] 登录失败,密码错误.";
	} else if( $_SESSION['__userdata']['0']["username"] == $logindata[1] ){
		$Finance->refurbishUserSession($_SESSION['__userdata']['0']["id"]);

		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			printf("登录成功。");
			echo "用户数据包：";
			print_r($_SESSION['__userdata']);
			echo "<br>用户组数据包：";
			print_r($_SESSION['__groupdata']);
			echo "<br>DEBUG END*********************************************<br>";
		} else {
			$_SESSION['__global_logid']=NULL;
			$text_log = "用户: [".$_SESSION['__userdata']['0']["username"]."] 登录成功";
			echo "<script>window.location.replace('main.php');</script>";
		}
	} else {
		$_SESSION['__global_logid']=1 ;
	}
	if(DEBUG_YES){ 
		echo "<br>DEBUG START*********************************************<br>";
		echo "错误内容为: ".$Finance->convertLogIdToContent($_SESSION['__global_logid']);
		echo "<br>DEBUG END*********************************************<br>";	
		echo "<a href=\"main.php\"><span>跳转到Main页</span></a>";
	}else {
		echo "<script>window.location.replace('index.php');</script>";
	}
	
	/*  记录Log  */
	if (! empty($text_log)) {
		$Finance->CrodeLog($text_log);
	}
?>
	</div>
</body>
</html>