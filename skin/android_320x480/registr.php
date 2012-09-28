<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');	
	header("Content-Type:text/html;charset=UTF-8"); 	
	date_default_timezone_set('PRC');
	session_destroy();
	session_start();
?>

<html>
<head>
<title><?PHP echo $_TITLE?></title>
<script type="text/javascript" src="<?PHP echo JS_PATH."base_public.js"?>"></script>
<script type="text/javascript" src="<?PHP echo JS_PATH."check.js"?>"></script>
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
		position: relative;
		color: #6600FF;
		font-weight: bold;
		font-size: 16px;
		left: 65px;
		top: 120px;
		background-color:transient
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
		position: relative;
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
		height: 200px;
	}
</style>
</head>

<body onload="document.getElementById('registr').username.focus()">
<div class="Backplane">
	<div class="IndexICO">
		<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
	</div>
  <div class="IndexTitle">
		<?PHP echo "<STRONG>". $_TITLE ."</STRONG>";?> 
  </div>
  <div class="IndexLogin">
	<?PHP
		$registr = $_POST['registr'];
		$username = $_POST['username'];
		$useralias = $_POST['useralias'];
		$family_num = $_POST['family_num'];
		$email = $_POST['email'];
		$qq = $_POST['qq'];
		$password = $_POST['password'];

		if ( $registr == 1 ){
			if ($Finance->RegistrUser($username,$useralias,$password,$family_num,$email,$qq)!=false){
				/* 判断注册用户 */
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					printf("注册成功。");
					echo "用户名：".$username."<BR>";
					echo "用别名：".$useralias."<BR>";
					echo "用户家庭：".$family."<BR>";
					echo "<br>DEBUG END*********************************************<br>";
				} else {
					$_SESSION['__global_logid']=5801 ;
					$text_log = "用户: [".$username."] 注册成功";
					echo "<script>window.location.replace('index.php');</script>";
				}
			} else {
				$text_log = "用户: [".$username."] 注册失败";
				$_SESSION['__global_logid']=1 ;
				echo "<script>window.location.replace('registr.php');</script>";
			}
				
			/*  记录Log  */
			if (! empty($text_log)) {
				$Finance->CrodeLog($text_log);
			}
		}
	?>
	     <FORM action="registr.php" onsubmit="return check(this)" id="registr" method="post">
			<table width="240">
				<tr><td colspan="2" class="Ctd">
					<?PHP echo "<b>".$_REGISTR."</b>"?>	
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_USERNAME ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="username"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_USERALIAS ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="useralias"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_FAMILY_NUM."[3-10]位" ?><BR>[结合用户名登录]&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="family_num"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_MAIL ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="email"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_QQ ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="qq"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_PASSWORD ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="password" name="password"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_YES_PASSWORD ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="password" name="yes_password"></span>
				</td></tr>
				<tr><td colspan="2" class="Rtd">
					<span><INPUT type="hidden" name="registr" value="1"></span>
					<a href="index.php"><?PHP echo "返回登录"?></a>
					<INPUT class="LoginButton" type="submit" value="<?PHP echo $_REGISTR?>">
				</td></tr>
			</table>
        </FORM>
  </div>
</div>
</body>
</html>