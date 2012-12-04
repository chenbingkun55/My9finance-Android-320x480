<?PHP 	
	require("../../config/config.inc.php");
	require(INCLUDE_PATH.'finance.inc.php');	
	header("Content-Type:text/html;charset=UTF-8"); 	
	date_default_timezone_set('PRC');
?>

<html>
<head>
<title><?PHP echo $_TITLE?></title>
<script type="text/javascript" src="<?PHP echo JS_PATH."base_public.js"?>"></script>
<link href="<?PHP echo CSS_PATH."base_public.css"?>" rel="stylesheet" type="text/css" />
<style>
	.IndexICO{
		z-index: 100; 
		position: absolute;
		left: 30px;
		top: 120px;
	}

	.IndexTitle{
		z-index: 20; 
		position: absolute;
		color: #6600FF;
		font-weight: bold;
		font-size: 16px;
		left: 65px;
		top: 120px;
		background-color:transient
	}

</style>
</head>

<body>
	<div class="BackPlane" id="BodyDiv">

		<div class="IndexICO">
			<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
		</div>
		<div class="IndexTitle">
			<?PHP echo "<STRONG>". $_TITLE ."</STRONG>";?> 
		</div>
<?PHP
	echo "<div class=\"ContentPlane Content\" id=\"Content\" align=\"center\">";
	$_SESSION['__global_logid']=6001;
	$error_info	= $Finance->convertLogIdToContent($_SESSION['__global_logid']);
	echo "<br><br>&nbsp;".$error_info['0']['content'];

	$familyname = $_POST['familyname'];
	$password = $_POST['password'];

	/* 判断登录用户 */
	if ( $_GET['ml'] != '1' )
	{
		$_SESSION['__familydata'] = $Finance->login($familyname,$password);
	}
	
	if(DEBUG_YES){ 
		echo "<br>DEBUG START*********************************************<br>";
		echo "家庭名: ".$_POST['familyname']."<BR>";
		echo "密码: ".$_POST['password']."<BR>";
		print_r($_SESSION['__familydata']); 
		echo "<br>DEBUG END*********************************************<br>";	
	}

	if ( $_SESSION['__familydata'] == '1' ) {
		$_SESSION['__global_logid']=1 ;
		$text_log = "家庭: [".$familyname."] 未知用户.";
		echo "<script>window.location.replace('index.php?logid=1');</script>";
	} else if ( $_SESSION['__familydata'] == '2' ) {
		$_SESSION['__global_logid']=2 ;
		$text_log = "家庭: [".$familyname."] 登录失败,密码错误.";
		echo "<script>window.location.replace('index.php?logid=2');</script>";
	} else if ( $_SESSION['__familydata'] == '4' ) {
		$_SESSION['__global_logid']=4 ;
		$text_log = "家庭: [".$familyname."] 登录失败,账号被禁用.";
		echo "<script>window.location.replace('index.php?logid=4');</script>";
	} else if( $_SESSION['__familydata']['0']["Name"] == $familyname || $_GET['ml'] == '1' ){
		$temp = $Finance->refurbishFamilySession($_SESSION['__familydata']['0']["ID"]);
		$_SESSION['__familydata']['0']["Session"] = $temp['0']["Session"] ;
	
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			printf("登录成功。");
			echo "家庭数据包：";
			print_r($_SESSION['__familydata']);
			echo "<BR>";
			echo "<br>DEBUG END*********************************************<br>";
		}
		$_SESSION['__global_logid']=NULL;
		$text_log = "家庭: [".$_SESSION['__familydata']['0']["Name"]."] 登录成功";
			
		if( $_SESSION['__familydata']['0']["Alias"] ) { 
				$login_familyalias = $_SESSION['__familydata']['0']['Alias'] ;
		} else {
				$login_familyalias = $_SESSION['__familydata']['0']['Name'] ;
		}

		if ( $_SESSION['__familydata']['0']['Member'] == '0' ) 
		{
			echo "<div>";
			echo "<b>".$login_familyalias."&nbsp;-&nbsp;".$_FAMILY_MEMBER."</b><BR><BR>";
			echo "还没有家庭成员.&nbsp;<a href=\"main.php?page=fun_manager.php&add_type=member\"><span>添加</span></a>";
			echo "</div>";
		} else {
			$_SESSION['__memberdata'] = $Finance->getFamilyMember($_SESSION['__familydata']['0']["ID"]);

			echo "<div>";
			echo "<b>".$login_familyalias."&nbsp;-&nbsp;".$_FAMILY_MEMBER."</b>&nbsp;";
			echo "<a href=\"main.php?page=fun_manager.php&add_type=member\"><span>添加</span></a><BR><BR>";
			for ( $i=0; $i <= $_SESSION['__familydata']['0']['Member']; $i++)
			{
				echo "<a href=\"main.php?member=".$i."\"><span>".$_SESSION['__memberdata'][$i]['Name']."</span></a><BR>";
			}
			echo "</div>";

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo $_SESSION['__familydata']['0']["ID"]."家庭ID<br>";
				print_r($_SESSION['__memberdata']);
				echo "<br>DEBUG END*********************************************<br>";	
			}
		}
	} else {
		$_SESSION['__global_logid']=1 ;
		echo "<script>window.location.replace('index.php?logid=1');</script>";
	}
	
	echo "</div>";
	/*  记录Log  */
	if (! empty($text_log)) {
		$Finance->CrodeLog($text_log);
	}
	require("foot.php");
?>
	</div>
</body>
</html>