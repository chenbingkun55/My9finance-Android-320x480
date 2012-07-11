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
</head>

<body class="mainfont">

<div class="BodyDiv">
  <div class="TitleIMG">
	<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
  </div>

  <div class="Title">
		<?PHP echo "<STRONG>". $_TITLE ."</STRONG>";?> 
  </div>
  <div class="Login">
	<fieldset>
        <legend>&nbsp;<font size="4">登录</font>&nbsp;</legend>
        <FORM action="form_process.php" method="post" >
        <TABLE class="AllFont" border="0">
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
            <INPUT class="LoginButton" type="submit" value="<?PHP echo $_LOGIN?>">
			</TD>
        </TR>
        </TABLE>
        </FORM>
        </fieldset>
  </div>

  <div class="Foot" align="center">
    Copyright © 2010-2012 ChenBK All Rights Reserved<br> 
    一个简单在线个人收支管理系统<br>
    E-mail : <a href="mailto:chenbingkun55@163.com">ChenBingKun55@163.com</a> 
  </div>
</div>
</body>
</html>
