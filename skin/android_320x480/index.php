<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');	
	header("Content-Type:text/html;charset=UTF-8"); 
	date_default_timezone_set('PRC') or die('设置时区错误,请联系管理员.');
	$skin = 0;
?>

<html>
<head>
<title><?PHP echo $_TITLE?></title>
<link href="<?PHP echo CSS_PATH."base_public.css"?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?PHP echo JS_PATH."base_public.js"?>"></script>
<script type="text/javascript" src="<?PHP echo JS_PATH."check.js"?>"></script>
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

	.IndexLoginInfo{
		background-color: #333300;
		color: #FF6666;
		font-family: "微软雅黑";
		font-size: 14px;
		z-index:20;
		position: absolute;
		width: 280px;
		left: 20px;
		top: 300px;
	}

	.LoginInput{
		margin-left:   20px;
		color:   #0033FF;
		width:   120px;
		font-size:   12px;
		font-family:   Arial;
		margin-top:   0px;
		border:   0px   none;
		height:   18px;
	} 

	.IndexLogin{
		z-index: 20; 
		position: absolute;
		left: 20px;
		top: 140px;
		padding-top: 10;
		padding-left: 0;
		padding-right: 0;
		padding-bottom: 10;
		background-color:transient
	}

.Rtd { text-align: right; }
.Ctd { text-align: center; }
table {
	border-style: groove;
	color: #6600FF;
	font-size: 12px;
	width: 280px;
	height: 100px;
}
</style>
</head>
<body onload="document.getElementById('login-form').username.focus()">
<div class="Backplane">
	<div class="IndexICO">
		<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
	</div>
	<div class="IndexTitle">
		<?PHP echo $_TITLE ;?> 
	</div>
	  <?PHP 
			if ( !is_null($_SESSION['__global_logid'])) {
				$error_info	= $Finance->convertLogIdToContent($_SESSION['__global_logid']);
				echo "<div class=\"IndexLoginInfo\" align=\"center\">";
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					print_r($error_info); 
					echo "<br>DEBUG END*********************************************<br>";	
				} else {
					echo "INFO: ".$error_info['0']['content'];
				}
				echo "</div>";
		  }
	  ?>
  <div class="IndexLogin">
			<form action="login.php" onsubmit="return check()" id="login-form" method="post">
			<table width="240">
				<tr><td colspan="2" class="Ctd">
					<?PHP echo "<b>".$_LOGIN."</b>"?>	
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_FAMILY_NUM.".".$_USERNAME ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="username"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_PASSWORD ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="password" name="password"></span>
				</td></tr>
				<tr><td colspan="2" class="Rtd">
					<span><INPUT type="hidden" name="login" value="LOGIN"></span>
					<a href="registr.php"><?PHP echo $_REGISTR?></a>
					<INPUT class="LoginButton" type="submit" value="<?PHP echo $_LOGIN?>">
				</td></tr>
			</table>
        </form>
  </div>
</div>
</body>
</html>