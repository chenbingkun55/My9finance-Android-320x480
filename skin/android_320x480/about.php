<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle5')</script>
<style>
.Rtd { text-align: right; }
.Ctd { text-align: center; }
</style>

<?PHP 
	$is_bug = $_GET['is_bug'];
	$add_submit = $_POST['add_submit'];
	$alter_submit = $_POST['alter_submit'];
	$Aid = $_GET['Aid'];
	$Did = $_GET['Did'];

	if(DEBUG_YES){ 
		echo "<br>DEBUG START*********************************************<br>";
		echo "is_bug值为：".$_GET['is_bug']."<br>";
		echo "add_submit值为：".$_POST['add_submit']."<br>";
		echo "alter_submit值为：".$_POST['alter_submit']."<br>";
		echo "Aid值为：".$_GET['Aid']."<br>";
		echo "Did值为：".$_GET['Did']."<br>";
		echo "<br>DEBUG END*********************************************<br>";	
	}

	if ( $is_bug == 1 || isset($Aid) ) {
		$Aid_data = $Finance->getCordeData($login_family_id,"bug_corde",0,0,$Aid);
?>
			<form action="main.php?page=about.php" onsubmit="return check()" id="bug-form" method="post">
			<table width="240">
				<tr><td colspan="2" class="Ctd">
					<?PHP echo "<b>".$_COM_BUG_PAGE."</b>"?>	
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_TYPE ?>&nbsp;-></span>
				</td><td>
					<select name="bug_type">
						<option value="bug" <?PHP if ( $Aid_data['0']['bug_type'] == "bug" ) echo "selected=\"selected\""; ?>>缺陷</option>
						<option value="suggestion" <?PHP if ( $Aid_data['0']['bug_type'] == "suggestion" ) echo "selected=\"selected\""; ?>>建议</option>
					</select>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_BUG_LEVEL ?>&nbsp;-></span>
				</td><td>
					<select name="bug_level">
						<option value="1" <?PHP if ( $Aid_data['0']['bug_level'] == "一般" ) echo "selected=\"selected\""; ?>>一般</option>
						<option value="2" <?PHP if ( $Aid_data['0']['bug_level'] == "重要" ) echo "selected=\"selected\""; ?>>重要</option>
						<option value="3" <?PHP if ( $Aid_data['0']['bug_level'] == "特重要" ) echo "selected=\"selected\""; ?>>特重要</option>
						<option value="4" <?PHP if ( $Aid_data['0']['bug_level'] == "无法使用" ) echo "selected=\"selected\""; ?>>无法使用</option>
					</select>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_BUG_TITLE ?>&nbsp;-></span>
				</td><td>
					<span><input type="text" name="bug_title" size="20" <?PHP echo  "value=\"".$Aid_data['0']['bug_title']."\"" ; ?>></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_BUG_CENTENT ?>&nbsp;-></span>
				</td><td>
					<textarea name = "bug_centent" rows="3" cols="20"><?PHP echo  $Aid_data['0']['bug_centent'] ; ?></textarea>
				</td></tr>
				<tr><td colspan="2" class="Rtd">
				<?PHP
					$str =  $Aid ? "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\"><INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\"><span align=\"right\"><INPUT class=\"LoginButton\" type=\"submit\" value=\"修改\"></span>":"<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\"><span align=\"right\"><INPUT class=\"LoginButton\" type=\"submit\" value=\"".$_COM_BUG."\"></span>";
					echo $str;
				?>
				</td></tr>
			</table>
        </form>
<?PHP
	} else {
?>
一个简单在线个人收支管理系统,<br>工作之余所出作品,<br>&nbsp;
	但愿能给大家生活上带来便利.<br><br>
	出品: @-ChenBK<br>制作时间: 2012-07-11<br>E-mail :
	<a href="mailto:chenbingkun55@163.com">ChenBingKun55@163.com</a><br><br>
	<a href="main.php?page=about.php&is_bug=1"><?PHP echo $_COM_BUG ;?></a>
<?PHP 
	if ( $add_submit == 1 || $alter_submit == 1){
		$bug_type = $_POST['bug_type'] ;
		$bug_level = $_POST['bug_level'] ;
		$bug_title = $_POST['bug_title'] ;
		$bug_centent = $str = trim( $_POST['bug_centent'] );
		$alter_id = $_POST['alter_id'] ;
		

		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			echo "add_submit值为：".$_POST['add_submit']."<br>";
			echo "bug_type值为：".$_POST['bug_type']."<br>";
			echo "bug_level值为：".$_POST['bug_level']."<br>";
			echo "bug_title值为：".$_POST['bug_title']."<br>";
			echo "bug_centent值为：".$_POST['bug_centent']."<br>";
			echo "<br>DEBUG END*********************************************<br>";	
		}

		if ($add_submit == 1){
			$YesNo = ($Finance->addBUG($login_family_id,$login_family_id,$bug_type,$bug_level,$bug_title,$bug_centent))==true ? true:false; 
				
			/*  记录日志   */
			$text_log = $YesNo ? "添加".$bug_type."-成功,BUG级别: ".$bug_level." 标题: ".$bug_title." 内容: ".$bug_centent :  "添加".$bug_type."-失败,BUG级别: ".$bug_level." 标题:".$bug_title." 内容: ".$bug_centent ;
			
			/*  消息提醒  */
			$_SESSION['__global_logid'] = $YesNo ?  5034 : 1034; 	
		}

		if($alter_submit == 1){
			$YesNo =($Finance->updateBUG($bug_type,$bug_level,$bug_title,$bug_centent,$status,$alter_id))==true ? true:false;
				
			/*  记录日志   */
			$text_log = $YesNo ? "修改".$bug_type."-成功,BUG级别: ".$bug_level." 标题: ".$bug_title." 内容: ".$bug_centent :  "修改".$bug_type."-失败,BUG级别: ".$bug_level." 标题:".$bug_title." 内容: ".$bug_centent ;
			/*  消息提醒  */
			$_SESSION['__global_logid']= $YesNo ?  5035:1035;  
		}
	}

		if (!(is_null($Did)) && !(is_null($login_family_id))){
			$Did_data = $Finance->getCordeData($login_family_id,"bug_corde",0,0,$Did);
			$YesNo = (@$Finance->delCorde("bug_corde",$login_family_id,$Did,$login_family_id))==true ? true:false;
			
			/*  记录日志   */
			/*  记录日志   */
			$text_log = $YesNo ? "删除BUG-成功,BUG级别:".$Did_data['0']['bug_level']." 标题: ".$Did_data['0']['bug_title']."内容: ".$Did_data['0']['bug_centent'] : "删除BUG-失败,BUG级别:".$Did_data['0']['bug_level']." 标题: ".$Did_data['0']['bug_title']."内容: ".$Did_data['0']['bug_centent'];
			/*  消息提醒  */
			$_SESSION['__global_logid'] = $YesNo ?  5036 : 1036; 
		}

		$list_bug = $Finance->getCordeData($login_family_id,"bug_corde",0,0,$Aid);
		
		$table_title = array("序号","用户","家庭号","类型","级别","标题","状态","时间","操作");	
		
		if ( $list_bug ) {
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($list_bug);$i++){
				echo "<tr class='".$c."'>";
				echo "<td>".($i+1)."</td>";
				echo "<td>".@$Finance->convertID($list_bug[$i]['user_id'],"users")."</td>";
				echo "<td>".$list_bug[$i]['family_id']."</td>";
				echo "<td>".$list_bug[$i]['bug_type']."</td>";
				echo "<td>".$list_bug[$i]['bug_level']."</td>";
				echo "<td>".$list_bug[$i]['bug_title']."</td>";
				echo "<td>".$list_bug[$i]['status']."</td>";
				echo "<td>".date('Y-m-d H:i:s',$list_bug[$i]['create_date'])."</td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$list_bug[$i]['id']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$list_bug[$i]['id']."')\">删除</span></td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}
			echo "</table>";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				var_dump($list_bug);
				echo "<br>DEBUG END*********************************************<br>";	
			}
		}
	} 

?>  
</div> 

