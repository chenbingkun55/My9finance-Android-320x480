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
<link href="<?PHP echo CSS_PATH."base_pablic.css"?>" rel="stylesheet" type="text/css" />
<style>
	.IndexICO{
		z-index: 100; 
		position: absolute;
		width:auto;
		height:auto;
		overflow:left;
		left: 20px;
		top: 100px;
		background-color:transient
	}

	.IndexTitle{
		z-index: 20; 
		position: absolute;
		width:auto;
		height:auto;
		overflow:left;
		left: 60px;
		top: 100px;
		background-color:transient
	}

	.IndexLoginInfo{
		background-color: #333300;
		color: #FF6666;
		font-family: "微软雅黑";
		font-size: 14px;
	}

	.LoginInput{
		margin-left:   20px;
		color:   #0033FF;
		width:   160px;
		font-size:   12px;
		font-family:   Arial;
		margin-top:   0px;
		border:   0px   none;
		height:   18px;
	} 

	.IndexLoginInfo {
		z-index:20;
		position: absolute;
		height: 20px;
		width: 280;
		left: 20px;
		top: 300px;
	} 

	.IndexTitle{
		z-index: 20; 
		position: absolute;
		width:auto;
		height:auto;
		overflow:left;
		left: 60px;
		top: 100px;
		background-color:transient
	}

	.IndexLogin{
		z-index: 20; 
		position: absolute;
		width:auto;
		height:auto;
		overflow:left;
		left: 20px;
		top: 140px;
		padding-top: 10;
		padding-left: 0;
		padding-right: 0;
		padding-bottom: 10;
		background-color:transient
	}
</style>
<script type="text/javascript" src="<?PHP echo JS_PATH."check.js"?>"></script>
</head>
<body onload="document.getElementById('login-form').username.focus()">

<div class="Backplane">
	<div class="IndexICO">
		<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
	</div>
  <div class="IndexTitle">
		<?PHP echo "<STRONG>". $_TITLE ."</STRONG>";?> 
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
	<fieldset>
        <legend>&nbsp;<?PHP echo $_LOGIN?>&nbsp;</legend>
        <FORM action="login.php" onsubmit="return check()" id="login-form" method="post">
        <TABLE border="0">
        <TR>
            <TD><?PHP echo $_USERNAME ?></TD>
            <TD> <input class="LoginInput" type="text" name="username"></TD>
        </TR>
        <TR>
            <TD><?PHP echo $_PASSWORD ?></TD>
            <TD><input class="LoginInput" type="password" name="password"></TD>
        </TR>
		<TR>
			<TD>&nbsp;
			</TD>
			<TD align="right">
            <INPUT type="hidden" name="login" value="LOGIN">
			<a href="registr.php"><?PHP echo $_REGISTR?></a>&nbsp;
            <INPUT class="LoginButton" type="submit" value="<?PHP echo $_LOGIN?>">
			
			</TD>
        </TR>
        </TABLE> 
        </FORM>
        </fieldset>
  </div>
</div>
</body>
</html>