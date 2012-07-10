<?PHP
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
    require_once("../../config/config.inc.php");
    require_once(INCLUDE_PATH.'finance.inc.php');
        if (empty($_SESSION['__global_logid']) ) 
        {
        } else {
            echo $Finance->convertLogIdToContent($_SESSION['__global_logid'] )."<BR><BR>";
        }
    unset($_SESSION['']);
    session_unset();
    $_SESSION['__month'] = 0;

	if ($_GET['logout'] == 1 )  {
		/* 注销成功日志记录 */
		$text_log = "用户: [".$_GET['username']."] 注销成功";
		$Finance->CrodeLog($text_log);
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=index.php\">";
	}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?PHP echo $_TITLE?></title>
<link href="CSS/main.css" rel="stylesheet" type="text/css" />
</head>

<body class="mainfont">
<div id="Body">
  <div id="TitleIMG">
	<a href="./images/logo_max_color.gif"><IMG SRC="./images/logo_color.gif" WIDTH="26" HEIGHT="22" BORDER="0" ALT=""></a>
  </div>
  <div id="Title">
	        <?PHP echo "<STRONG>". $_TITLE .ROOT_PATH."</STRONG>";?> 
  </div>
	<div id="Login">
	<fieldset>
        <legend>&nbsp;<font size="4">登录</font>&nbsp;</legend>
        <FORM action="form_process.php" method="post" >
        <TABLE id="AllFont" border="0">
        <TR>
            <TD><?PHP echo $_USERNAME ?></TD>
            <TD> <input id= "LoginInput" type="text" name="username"></TD>
        </TR>
        <TR>
            <TD><?PHP echo $_PASSWORD ?></TD>
            <TD><input id= "LoginInput" type="password" name="password"></TD>
        </TR>
		<TR>
			<TD>&nbsp;
			</TD>
			<TD align="right">
            <INPUT type="hidden" name="login" value="LOGIN">
            <INPUT id="LoginButton" type="submit" value="<?PHP echo $_LOGIN?>">
			</TD>
        </TR>
        </TABLE>
        </FORM>
        </fieldset>
	</div>
    <div id="Foot" align="center">
    Copyright © 2010-2012 ChenBK All Rights Reserved<br> 
        一个简单在线个人收支管理系统<br>
        E-mail : <a href="mailto:chenbingkun55@163.com">ChenBingKun55@163.com</a> 
  </div>
</div>
</body>
</html>
