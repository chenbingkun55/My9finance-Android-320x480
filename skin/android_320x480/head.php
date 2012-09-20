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
	$login_group_id = $_SESSION['__groupdata']['0']['id'];
	$login_skin_id = $_SESSION['__userdata']['0']["skin"];
	if ( ! isset($_SESSION['date_num']))  $_SESSION['date_num'] = 0;

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
		$str .= "用户组ID: ".$login_group_id;
		$str .= "DEBUG END*********************************************";
		echo "<br>".$str."<br>";
	}
?>
		<tr ><td class="ALLpadding">
		<table class="HeadTable">
			<tr><td class="Ltd">
				<?PHP
					if ( $login_user_alias ) {
						echo "<a href=\"main.php?page=fun_manager.php&add_type=family&Aid=".$login_user_id."\">".$login_user_alias."</a>&nbsp;&nbsp;".$_HELLO;
					} else {
						echo "<a href=\"main.php?page=fun_manager.php&add_type=family&Aid=".$login_user_id."\">".$login_user_name."&</a>nbsp;&nbsp;".$_HELLO;
					}

					if ( $login_group_alias ) {
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_RESIDE_GROUP.":&nbsp;".$login_group_alias."";
					} else {
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_RESIDE_GROUP.":&nbsp;".$login_groupname."";
					}
				?>
			</td><td>
				<span class="Skin1" id="Skin1" title="蓝色主题" onClick="ChangeSkinColor('Skin1')">1</span>
				<span class="Skin2" id="Skin2" title="灰色主题" onClick="ChangeSkinColor('Skin2')">2</span>
				<span class="Skin3" id="Skin3" title="绿色主题" onClick="ChangeSkinColor('Skin3')">3</span>
				<span class="Skin4" id="Skin4" title="粉色主题" onClick="ChangeSkinColor('Skin4')">4</span>
				<span class="Skin5" id="Skin5" title="黄色主题" onClick="ChangeSkinColor('Skin5')">5</span>
			</td></tr>
		</table>
	</td></tr>
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
	<tr class="RLpadding"><td class="RLpadding">
		<li><a class="Funa" href="main.php?page=record.php">主页</a></li>
		<li><a class="Funa" href="main.php?page=fun_manager.php">功能管理</a></li>
		<li><a class="Funa" href="main.php?page=report.php">报表</a></li>
		<li><a class="Funa" href="main.php?page=search.php">搜索</a></li>
		<li><a class="Funa" href="main.php?page=about.php">关于</a></li>
	</td></tr>

