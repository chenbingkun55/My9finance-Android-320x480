<?PHP
	/* 初始化用户环境变量 */
	$login_username = $_SESSION['__userdata']['0']["username"];
	$login_user_alias = $_SESSION['__userdata']['0']["user_alias"];
	$login_user_id = $_SESSION['__userdata']['0']["id"];
	$login_user_session = $_SESSION['__userdata']['0']["session"];
	$login_last_date = $_SESSION['__userdata']['0']["last_date"];
	$login_groupname = $_SESSION['__groupdata']['0']['groupname'];
	$login_group_alias = $_SESSION['__groupdata']['0']['group_alias'];
	$login_groupadmin_id = $_SESSION['__groupdata']['0']['groupadmin_id'];
	$login_id = $_SESSION['__groupdata']['0']['id'];

	if(DEBUG_YES){ 
		$str = "DEBUG START*********************************************";
		$str .= "用户名: ".$login_username;
		$str .= "用户别名: ".$login_user_alias;
		$str .= "用户ID: ".$login_user_id;
		$str .= "用户Session: ".$login_user_session;
		$str .= "用户最后登录: ".$login_last_date;
		$str .= "用户组名: ".$login_groupname;
		$str .= "用户组别名: ".$login_group_alias;
		$str .= "用户组管理员ID: ".$login_groupadmin_id;
		$str .= "用户组ID: ".$login_id;
		$str .= "DEBUG END*********************************************";
		echo "<script>alert('".$str."')</script>";
	}
?>

<div class="UserInfo">
	<?PHP
		if ( $login_user_alias ) {
			echo "<div><a href=\"main.php?page=fun_manager.php&add_type=family&Aid=".$login_user_id."\">".$login_user_alias."</a>&nbsp;&nbsp;".$_HELLO;
		} else {
			echo "<div><a href=\"main.php?page=fun_manager.php&add_type=family&Aid=".$login_user_id."\">".$login_user_name."&</a>nbsp;&nbsp;".$_HELLO;
		}

		if ( $login_group_alias ) {
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_RESIDE_GROUP.":&nbsp;".$login_group_alias."</div>";
		} else {
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_RESIDE_GROUP.":&nbsp;".$login_groupname."</div>";
		}
	?>
</div>
<div class="ChangeSkinPlane">
	<span class="Skin1" id="Skin1" title="蓝色主题" onClick="ChangeSkinColor('Skin1')">1</span>
	<span class="Skin2" id="Skin2" title="灰色主题" onClick="ChangeSkinColor('Skin2')">2</span>
	<span class="Skin3" id="Skin3" title="绿色主题" onClick="ChangeSkinColor('Skin3')">3</span>
	<span class="Skin4" id="Skin4" title="粉色主题" onClick="ChangeSkinColor('Skin4')">4</span>
	<span class="Skin5" id="Skin5" title="黄色主题" onClick="ChangeSkinColor('Skin5')">5</span>
</div>

<div class="DateTimePlane DateTimePlaneFont" align="right" id="DateTimePlane">
	<script>PrintDate();setInterval("PrintDate()",60000)</script>
</div>

<div class="MainICO">
	<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
</div>

<div class="MainMessage MainMessageFont" id="MainMessage" onLoad=PostMessage()>
</div>
  
<div class="FunTitle1 FunTitleFont" id="FunTitle1"  onMouseOver="OverFunTitleColor('FunTitle1')" onMouseOut="OutFunTitleColor('FunTitle1')" onclick="ChangFunTitle('FunTitle1')"> 
		<a href="main.php?page=record.php"><span>主页</span></a>   
</div>

<div class="FunTitle2 FunTitleFont" id="FunTitle2" onMouseOver="OverFunTitleColor('FunTitle2')" onMouseOut="OutFunTitleColor('FunTitle2')" onclick="ChangFunTitle('FunTitle2')"> 
	<a href="main.php?page=fun_manager.php"><span>功能管理</span></a>   
</div>

<div class="FunTitle3 FunTitleFont" id="FunTitle3" onMouseOver="OverFunTitleColor('FunTitle3')" onMouseOut="OutFunTitleColor('FunTitle3')" onclick="ChangFunTitle('FunTitle3')"> 
	<a href="main.php?page=report.php"><span>报表</span></a>   
</div>

<div class="FunTitle4 FunTitleFont" id="FunTitle4" onMouseOver="OverFunTitleColor('FunTitle4')" onMouseOut="OutFunTitleColor('FunTitle4')" onclick="ChangFunTitle('FunTitle4')"> 
	<a href="main.php?page=search.php"><span>搜索</span></a>   
</div>
		
<div class="FunTitle5 FunTitleFont" id="FunTitle5" onMouseOver="OverFunTitleColor('FunTitle5')" onMouseOut="OutFunTitleColor('FunTitle5')" onclick="ChangFunTitle('FunTitle5')"> 
	<a href="main.php?page=about.php"><span>关于</span></a>   
</div>
