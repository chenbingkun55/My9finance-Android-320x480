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
<link href="<?PHP echo CSS_PATH."main.css"?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?PHP echo JS_PATH."main.js"?>"></script>
<script>
	window.resizeTo(355,545);
</script>
</head>

<body onload="document.getElementById('registr').username.focus()">

<div class="Backplane">
	<div class="IndexICO">
		<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
	</div>
  <div class="IndexTitle IndexTitle">
		<?PHP echo "<STRONG>". $_TITLE ."</STRONG>";?> 
  </div>
  <div class="IndexLogin">
	<?PHP
		$registr = $_POST['registr'];
		$username = $_POST['username'];
		$useralias = $_POST['useralias'];
		$family = $_POST['family'];
		$password = $_POST['password'];

		if ( $registr == 1 ){
			if ($Finance->RegistrUser($username,$useralias,$password,$family)!=false){
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
	<fieldset>
        <legend>&nbsp;<?PHP echo $_REGISTR?>&nbsp;</legend>
        <FORM action="registr.php" onsubmit="return check()" id="registr" method="post">
        <TABLE border="0">
        <TR>
            <TD><?PHP echo $_USERNAME ?></TD>
            <TD> <input class="LoginInput" type="text" name="username"></TD>
        </TR>
        <TR>
            <TD><?PHP echo $_USERALIAS ?></TD>
            <TD> <input class="LoginInput" type="text" name="useralias"></TD>
        </TR>
		<TR>
            <TD><?PHP echo $_FAMILY ?></TD>
            <TD> <input class="LoginInput" type="text" name="family"></TD>
        </TR>
        <TR>
            <TD><?PHP echo $_PASSWORD ?></TD>
            <TD><input class="LoginInput" type="password" name="password"></TD>
        </TR>
        <TR>
            <TD><?PHP echo $_YES_PASSWORD ?></TD>
            <TD><input class="LoginInput" type="password" name="yes_password"></TD>
        </TR>
		<TR>
			<TD>&nbsp;
			</TD>
			<TD align="right">
            <INPUT type="hidden" name="registr" value="1">
			<a href="index.php"><?PHP echo "返回登录"?></a>
            <INPUT class="LoginButton" type="submit" value="<?PHP echo $_REGISTR?>">
			</TD>
        </TR>
        </TABLE> 
        </FORM>
        </fieldset>
  </div>
</div>
</body>
</html>