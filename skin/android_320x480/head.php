<?PHP
	/* 初始化用户环境变量 */
	$login_username = $_SESSION['__userdata']['0']["username"];
	$login_user_alias = $_SESSION['__userdata']['0']["user_alias"];
	$login_user_id = $_SESSION['__userdata']['0']["id"];
	$login_user_session = $_SESSION['__userdata']['0']["session"];
	$login_last_date = $_SESSION['__userdata']['0']["last_date"];
	$login_family_num = $_SESSION['__userdata']['0']['family_num'];
	$login_family_adm = $_SESSION['__userdata']['0']['family_adm'];
	$login_skin_id = $_SESSION['__userdata']['0']["skin"];
	if ( ! isset($_SESSION['date_num']))  $_SESSION['date_num'] = 0;

	if(DEBUG_YES){ 
		$str = "DEBUG START*********************************************";
		$str .= "用户名: ".$login_username;
		$str .= "用户别名: ".$login_user_alias;
		$str .= "用户ID: ".$login_user_id;
		$str .= "用户Session: ".$login_user_session;
		$str .= "用户最后登录: ".$login_last_date;
		$str .= "用户组号: ".$login_family_num;
		$str .= "用户组管理员: ".$login_family_adm;
		$str .= "DEBUG END*********************************************";
		echo "<script>alert('".$str."')</script>";
	}
?>

<div class="UserInfo">
	<?PHP
			echo "<div>[ ".$login_family_num." ]->";

		if ( $login_user_alias ) {
			echo "<a href=\"main.php?page=fun_manager.php&add_type=family&Aid=".$login_user_id."\">".$login_user_alias."</a>&nbsp;&nbsp;".$_HELLO."</div>";
		} else {
			echo "<a href=\"main.php?page=fun_manager.php&add_type=family&Aid=".$login_user_id."\">".$login_user_name."&</a>nbsp;&nbsp;".$_HELLO."</div>";
		}
	?>
</div>
<div class="ChangeSkinPlane" id="ChangeSkinPlane">
	<span class="Skin1" id="Skin1" title="绿色主题" onClick="ChangeSkinColor('Skin1')">1</span>
	<span class="Skin2" id="Skin2" title="蓝色主题" onClick="ChangeSkinColor('Skin2')">2</span>
	<span class="Skin3" id="Skin3" title="红色主题" onClick="ChangeSkinColor('Skin3')">3</span>
	<span class="Skin4" id="Skin4" title="黄色主题" onClick="ChangeSkinColor('Skin4')">4</span>
	<span class="Skin5" id="Skin5" title="黑色主题" onClick="ChangeSkinColor('Skin5')">5</span>
</div>

<div class="DateTimePlane DateTimePlaneFont" align="right" id="DateTimePlane">
	<script>PrintDate();setInterval("PrintDate()",60000)</script>
</div>

<div class="MainICO">
	<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
</div>

<div class="MainMessage MainMessageFont" id="MainMessage" onLoad=PostMessage()>
</div>

<a href="main.php?page=record.php">  
<div class="FunTitle1 FunTitleFont" id="FunTitle1"  onMouseOver="OverFunTitleColor('FunTitle1')" onMouseOut="OutFunTitleColor('FunTitle1')" onclick="ChangFunTitle('FunTitle1')"> 
		<span>主页</span>   
</div></a>

<a href="main.php?page=fun_manager.php">
<div class="FunTitle2 FunTitleFont" id="FunTitle2" onMouseOver="OverFunTitleColor('FunTitle2')" onMouseOut="OutFunTitleColor('FunTitle2')" onclick="ChangFunTitle('FunTitle2')"> 
	<span>功能管理</span>   
</div></a>

<a href="main.php?page=report.php">
<div class="FunTitle3 FunTitleFont" id="FunTitle3" onMouseOver="OverFunTitleColor('FunTitle3')" onMouseOut="OutFunTitleColor('FunTitle3')" onclick="ChangFunTitle('FunTitle3')"> 
	<span>报表</span>   
</div></a>

<a href="main.php?page=search.php">
<div class="FunTitle4 FunTitleFont" id="FunTitle4" onMouseOver="OverFunTitleColor('FunTitle4')" onMouseOut="OutFunTitleColor('FunTitle4')" onclick="ChangFunTitle('FunTitle4')"> 
	<span>搜索</span>   
</div></a>

<a href="main.php?page=about.php">		
<div class="FunTitle5 FunTitleFont" id="FunTitle5" onMouseOver="OverFunTitleColor('FunTitle5')" onMouseOut="OutFunTitleColor('FunTitle5')" onclick="ChangFunTitle('FunTitle5')"> 
	<span>关于</span>   
</div></a>
