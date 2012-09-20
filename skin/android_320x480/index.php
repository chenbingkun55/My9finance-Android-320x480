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
<link href="<?PHP echo CSS_PATH."main.css"?>" rel="stylesheet" type="text/css" />
<style>
	.Rtd { text-align:right; }
	.Ctd { background-color: #336600; }
</style>
<script>
	function check(){
		var loginform = document.getElementById('login-form');
		var info="";
		var stats=true;

		/* match  以非空字符开始,中间不允许有空格,至少有个字符. */
		if(!loginform.username.value.match(/^\S+$/)){
			info+="用户名不能使用空格或为空!\n";
			stats = false;
		} else if ( loginform.username.value.length >= 15){
			info+="用户名不能超过15个字符!\n";
			stats = false;
		}

		if (loginform.password.value == ""){
			info+="用户密码不能为空!\n";
			stats = false;
		}
		if(!stats){
			alert(info);
		}
		return stats;
	}
</script>
</head>

<body onload="document.getElementById('login-form').username.focus()">
	<table  class="BackTable">
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
			<table width="100%">
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<a href="<?PHP echo IMG_PATH."logo_max_color.gif"?>" ><IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="">
					</td>
					<td>
						<?PHP echo "<span class=\"styleFont1\"><STRONG>". $_TITLE ."</STRONG></span>";?> 
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td></tr>
		<tr><td>
		<table width="100%">
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
					<fieldset>
						<legend>&nbsp;<?PHP echo "<span class=\"styleFont1\">".$_LOGIN."</span>" ?>&nbsp;</legend>
						<FORM action="login.php" onsubmit="return check()" id="login-form" method="post">
						<TABLE width="100%">
						<TR>
							<td>&nbsp;</td>
							<TD><?PHP echo $_USERNAME ?></TD>
							<TD> <input type="text" name="username" size="20"></TD>
							<td>&nbsp;</td>
						</TR>
						<TR>
							<td>&nbsp;</td>
							<TD><?PHP echo $_PASSWORD ?></TD>
							<TD><input  type="password" name="password" size="20"></TD>
							<td>&nbsp;</td>
						</TR>
						<TR>
							<td>&nbsp;</td>
							<TD>&nbsp;</TD>
							<TD class="Rtd">
								<INPUT type="hidden" name="login" value="LOGIN">
								<a href="registr.php"><?PHP echo $_REGISTR?></a>&nbsp;
								<INPUT class="LoginButton" type="submit" value="<?PHP echo $_LOGIN?>">
								&nbsp;&nbsp;
							</TD>
							<td>&nbsp;</td>
						</TR>
						</TABLE> 
						</FORM>
						</fieldset>
					</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
			</table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
		<table width="100%">
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				
			<?PHP 
				if ( !is_null($_SESSION['__global_logid']) ) {
					echo "<td class=\"Ctd\">";
					$error_info	= $Finance->convertLogIdToContent($_SESSION['__global_logid']);
					if(DEBUG_YES){ 
						echo "<br>DEBUG START*********************************************<br>";
						print_r($error_info); 
						echo "<br>DEBUG END*********************************************<br>";	
					} else {
						echo "INFO: ".$error_info['0']['content'];
					}
			  } else {
				echo "<td>";
			  }
		  ?>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
	</table>
</body>
</html>