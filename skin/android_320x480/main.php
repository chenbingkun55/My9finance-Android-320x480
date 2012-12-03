<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');
	header("Content-Type:text/html;charset=UTF-8"); 


	/* 初始化家庭环境变量 */
	$login_familyname = $_SESSION['__familydata']['0']['F_name'];
	if( $_SESSION['__familydata']['0']["F_alias"] ) { 
			$login_familyalias = $_SESSION['__familydata']['0']['F_alias'] ;
	} else {
			$login_familyalias = $_SESSION['__familydata']['0']['F_name'] ;
	}
	$login_family_id = $_SESSION['__familydata']['0']['ID'];
	$login_family_session = $_SESSION['__familydata']['0']['Session'];
	
	/* 初始化家庭成员环境变量 */

	if ( isset($_GET["member"]) )
	{
		$_SESSION['current_member'] =  $_GET["member"] ;
		$current_member = $_SESSION['current_member'] ;
		$Finance->refurbishMemberSession($_SESSION['__memberdata'][$current_member]['ID']);
	} else {
		$current_member = $_SESSION['current_member'] ;
	}

	$login_member_id = $_SESSION['__memberdata'][$current_member]['ID'];
	$login_member_disable = $_SESSION['__memberdata'][$current_member]['Is_d'];
	if( $_SESSION['__memberdata'][$current_member]['U_alias'] ) { 
			$login_member_alias = $_SESSION['__memberdata'][$current_member]['U_alias'] ;
	} else {
			$login_member_alias = $_SESSION['__familydata'][$current_member]['U_name'] ;
	}
	$login_member_name = $_SESSION['__memberdata'][$current_member]['U_name'];
	$login_member_sum = $_SESSION['__memberdata'][$current_member]['Sum'];
	$login_member_skin = $_SESSION['__memberdata'][$current_member]['Skin'];
	$login_member_money = $_SESSION['__memberdata'][$current_member]['Money'];
	


	if ( ! isset($_SESSION['date_num']))  $_SESSION['date_num'] = 0;

	/* 判断用户名为空时退出, 不是当前 Session 时退出 */
	$temp_session = $Finance->getFamilySession($login_family_id) ;
	if ( empty($login_familyname) || $login_family_session != $temp_session['0']['Session'])
	{
		$_SESSION['__global_logid'] = "3";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			echo "login_family_id = " .$login_family_id."<BR>";
			echo "login_family_session = " .$login_family_session."<BR>";
			echo "temp_session = " .$temp_session['0']["Session"]."<BR>";
			echo "login_last_date = " .$login_last_date."<BR>";
			echo "login_member_skin = " .$login_member_skin."<BR>";
			echo "<br>DEBUG END*********************************************<br>";	
		} else {
			echo "<script>window.location.replace('index.php?logid=3');</script>";
		}
	}


	if ( ! is_null($_GET['skin'])){
		$Finance->UpdateSkin($login_member_id,$_GET['skin']);
		$_SESSION['__memberdata'][$current_member]['Skin'] = $_GET['skin'];
		$login_member_skin = $_SESSION['__memberdata'][$current_member]["Skin"];
	}
?>

<html>
<head>
<title><?PHP echo $_TITLE?></title>
<link href="<?PHP echo CSS_PATH."base_public.css"?>" rel="stylesheet" type="text/css" />
<link href="<?PHP echo CSS_PATH."user_skin.".$login_member_skin.".css"?>" rel="stylesheet" type="text/css" />
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