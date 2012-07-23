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

<div class="20_UserInfo">
	<?PHP
		if ( $login_user_alias ) {
			echo "<div>".$login_user_alias."&nbsp;&nbsp;".$_HELLO;
		} else {
			echo "<div>".$login_user_name."&nbsp;&nbsp;".$_HELLO;
		}

		if ( $login_group_alias ) {
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_RESIDE_GROUP.":&nbsp;".$login_group_alias."</div>";
		} else {
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_RESIDE_GROUP.":&nbsp;".$login_groupname."</div>";
		}
	?>
</div>
<div class="20_ChangeSkinPlane">
	<span class="20_Skin-1" id="Skin-1" title="蓝色主题" onClick="ChangeSkinColor('Skin-1')">1</span>
	<span class="20_Skin-2" id="Skin-2" title="灰色主题" onClick="ChangeSkinColor('Skin-2')">2</span>
	<span class="20_Skin-3" id="Skin-3" title="绿色主题" onClick="ChangeSkinColor('Skin-3')">3</span>
	<span class="20_Skin-4" id="Skin-4" title="粉色主题" onClick="ChangeSkinColor('Skin-4')">4</span>
	<span class="20_Skin-5" id="Skin-5" title="黄色主题" onClick="ChangeSkinColor('Skin-5')">5</span>
</div>

<div class="20_DateTimePlane DateTimePlaneFont" align="right" id="DateTimePlane">
	<script>PrintDate();setInterval("PrintDate()",60000)</script>
</div>

<div class="100_MainICO">
	<IMG id="TitleIMG" SRC="<?PHP echo IMG_PATH."logo_color.gif"?>" BORDER="0" ALT="" onMouseOver="OverTitleIMG()" onMouseOut="OutTitleIMG()">
</div>

<div class="30_MainMessage MainMessage" id="MainMessage">
	<BLINK>彩贝壳之家 -- 欢迎您!!!</BLINK> 
</div>
  
<div class="20_FunTitle FunTitleFont" > 
<span style="width:50px; background-color: #C7EDCC; display:inline-block;" id="FunTitle1"  onMouseOver="OverFunTitleColor('FunTitle1')" onMouseOut="OutFunTitleColor('FunTitle1')" onclick="ChangFunTitle('FunTitle1')">主页</span>
<span style="width:50px; display:inline-block;" id="FunTitle2"  onMouseOver="OverFunTitleColor('FunTitle2')" onMouseOut="OutFunTitleColor('FunTitle2')" onclick="ChangFunTitle('FunTitle1')">功能管理</span> 
<span style="width:50px; display:inline-block;" id="FunTitle3"  onMouseOver="OverFunTitleColor('FunTitle3')" onMouseOut="OutFunTitleColor('FunTitle3')" onclick="ChangFunTitle('FunTitle1')">报表</span> 
<span style="width:50px; display:inline-block;" id="FunTitle4"  onMouseOver="OverFunTitleColor('FunTitle4')" onMouseOut="OutFunTitleColor('FunTitle4')" onclick="ChangFunTitle('FunTitle1')">搜索</span> 
<span style="width:50px; display:inline-block;" id="FunTitle5"  onMouseOver="OverFunTitleColor('FunTitle5')" onMouseOut="OutFunTitleColor('FunTitle5')" onclick="ChangFunTitle('FunTitle5')">关于</span> 
</div>