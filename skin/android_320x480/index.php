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
<script>
	window.resizeTo(355,545);
</script>
</head>

<body onload="document.getElementById('login-form').username.focus()">

<div class="Backplane">
	<div class="IndexICO">
		<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
	</div>
  <div class="IndexTitle IndexTitle">
		<?PHP echo "<STRONG>". $_TITLE ."</STRONG>";?> 
  </div>
  <?PHP 
		if ( !is_null($_SESSION['__global_logid'])) {
			$error_info	= $Finance->convertLogIdToContent($_SESSION['__global_logid']);
			echo "<div class=\"IndexLoginInfo IndexLoginInfo\" align=\"center\">";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($error_info); 
				echo "<br>DEBUG END*********************************************<br>";	
			} else {
				echo "ERROR: ".$error_info['0']['content'];
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
			<a href="regedit_user.php?registr=1"><?PHP echo $_REGISTR?></a>&nbsp;
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