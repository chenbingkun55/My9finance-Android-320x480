<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle2')</script>
<style>
	.Rtd { text-align: right; }
	.Ctd { text-align: center; }
</style>
<form onsubmit="return check(this)"   action="main.php<?PHP echo "?page=fun_manager.php&add_type=".$_GET['add_type']."&Lid=".$_GET['Lid'];?>" method="post">

<?PHP 	
	$recordtype = $_GET['add_type'];
	$UP = $_GET['UP'];
	$Lid = $_GET['Lid'];
	$Aid = $_GET['Aid'];
	$Did = $_GET['Did'];
	$Mid = $_GET['Mid'];
	$add_submit = $_POST['add_submit'];
	$alter_submit = $_POST['alter_submit'];

	if(DEBUG_YES){ 
		echo "<br>DEBUG START*********************************************<br>";
		echo "recordtype值为：".$recordtype."<br>";
		echo "UP值为：".$UP."<br>";
		echo "ViewS值为：".$ViewS."<br>";
		echo "Aid值为：".$Aid."<br>";
		echo "Did值为：".$Did."<br>";
		echo "Mid值为：".$Mid."<br>";
		echo "add_submit值为：".$add_submit."<br>";
		echo "alter_submit值为：".$alter_submit."<br>";
		echo "<br>DEBUG END*********************************************<br>";	
	}



	/*
		添加表单:
	*/
	switch($recordtype){
		case 'out_mantype':
			if ( $add_submit == 1 || $alter_submit == 1 ){
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "add_submit值为：".$_POST['add_submit']."<br>";
					echo "mantype值为：".$_POST['mantype']."<br>";
					echo "is_display值为：".$_POST['is_display']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				$mantype = $_POST['mantype'];
				$is_display = $_POST['is_display'] == "on" ?  1 : 0;
				if($add_submit == 1){
					$YesNo = ($Finance->addTypeData($recordtype,$login_family_num,$mantype,$is_display,0))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加支出主类-成功,主类名称: ".$mantype." 显示: ".$is_display : "添加支出主类-失败,主类名称: ".$mantype." 显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5016 : 1016;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getManType($login_family_num,$recordtype,1,$alter_id);
					$YesNo =($Finance->updateTypeData($recordtype,$login_family_num,$alter_id,$mantype,$is_display))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改支出主类-成功,主类原名称: ".$alter_corde['0']['name']." 改为:".$mantype." 原显示: ".$is_display2."  改为:".$is_display : "修改支出主类-失败,主类原名称: ".$alter_corde['0']['name']." 改为:".$mantype." 原显示: ".$is_display2."改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5017 : 1017;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getManType($login_family_num,$recordtype,1,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_family_num,$Did,$login_user_id))==true ? true:false;
					
				/*  记录日志  */
				$is_display = $alter_corde['0']['is_diaplay'] == 1 ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除支出主类-成功,主类名称: ".$alter_corde['0']['name']." 显示: ".$is_display : "删除支出主类-失败,主类名称: ".$alter_corde['0']['name']." 显示: ".$is_display;
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5018 : 1018;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_family_num,0,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_family_num,0,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getManType($login_family_num,$recordtype,1,$Aid);

				echo "修改主支出类别 名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"mantype\" size=\"10\" value=\"".$alter_corde['0']['name']."\"></span>";
				echo "是否显示";
				if ($alter_corde['0']['is_display']=="1"){
					echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				}else{
					echo "<INPUT TYPE=\"checkbox\" name=\"is_display\" ></span>";
				}
				echo "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\">";
				echo "<INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ALTER."\">";
			}else{
				echo "添加主支出类别 名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"mantype\" size=\"10\" value=\"\"></span>";
				echo "是否显示";
				echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";
			}

			$type_corde = $Finance->getManType($login_family_num,$recordtype,1,0);

			$table_title = array("序号","状态","名称","排序","主类操作","子类操作");
			
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($type_corde);$i++){
				echo "<tr class=\"".$c."\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$YesNo=$type_corde[$i]['is_display']? "启用":"禁用"."</td>";
				echo "<td>".$type_corde[$i]['name']."</td>";
				echo "<td><span class=\"click\" onClick=\"MoveUp('".$type_corde[$i]['id']."')\">上移</span>|<span class=\"click\" onClick=\"MoveDown('".$type_corde[$i]['id']."')\">下移</span></td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$type_corde[$i]['id']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$type_corde[$i]['id']."')\">删除</span></td>";
				echo "<td><span class=\"click\" onClick=\"ListSubtype('".$type_corde[$i]['id']."')\">查看子类</span></td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}

			echo "</table>";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($type_corde);
				echo "<Br>".date("Y-m-d");
				echo "<br>DEBUG END*********************************************<br>";	
			}
			break;
		case 'out_subtype':
			$Lid = $_GET['Lid'];
			if ( $add_submit == 1 || $alter_submit == 1 ){
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "add_submit值为：".$_POST['add_submit']."<br>";
					echo "subtype值为：".$_POST['subtype']."<br>";
					echo "man_id值为：".$_POST['man_id']."<br>";
					echo "is_display值为：".$_POST['is_display']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				$subtype = $_POST['subtype'];
				$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;
				$man_id = $_POST['man_id'];
				if($add_submit == 1){
					$YesNo = ($Finance->addTypeData($recordtype,$login_family_num,$subtype,$is_display,$Lid))==true ? true:false;
					
					/*  记录日志  */
					$man_name=@@$Finance->convertID($man_id,"out_mantype");
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加支出子类-成功,所属主类名称: ".$man_name.",子类名称:".$subtype.",显示: ".$is_display : "添加支出子类-失败,所属主类名称: ".$man_name.",子类名称:".$subtype.",显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5019 : 1019;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getSubType($login_family_num,$recordtype,1,$man_id,$alter_id);

					$YesNo =($Finance->updateTypeData($recordtype,$login_family_num,$alter_id,$subtype,$is_display,$man_id))==true ? true:false;

					/*  记录日志  */
					$man_name=@$Finance->convertID($login_family_num,$man_id,"out_mantype");
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改支出子类-成功,所属主类名称: ".$man_name.",原子类名称:".$alter_corde['0']['name'].",改为:".$subtype.",原显示: ".$is_display2.",改为:".$is_display : "修改支出子类-失败,所属主类名称: ".$man_name.",原子类名称:".$alter_corde['0']['name'].",改为:".$subtype.",原显示: ".$is_display2.",改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5020 : 1020;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getSubType($login_family_num,$recordtype,1,$Lid,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_family_num,$Did,$login_user_id))==true ? true:false;

				/*  记录日志  */
				$man_name=@$Finance->convertID($Lid,"out_mantype");
				$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除支出子类-成功,所属主类名称: ".$man_name.",子类名称:".$alter_corde['0']['name'].",显示: ".$is_display2 : "删除支出子类-失败,所属主类名称: ".$man_name.",子类名称:".$alter_corde['0']['name'].",显示: ".$is_display2;
					/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5021 : 1021;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_family_num,$Lid,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_family_num,$Lid,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getSubType($login_family_num,$recordtype,1,$Lid,$Aid);
				$man_name=@$Finance->convertID($Lid,"out_mantype");
				echo "修改-".$man_name."-的,子支出类别 名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"subtype\" size=\"10\" value=\"".$alter_corde['0']['name']."\"></span>";
				echo "是否显示";
				if ($alter_corde['0']['is_display']=="1"){
					echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				}else{
					echo "<INPUT TYPE=\"checkbox\" name=\"is_display\" ></span>";
				}
				echo "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\">";
				echo "<INPUT type=\"hidden\" name=\"man_id\" value=\"".$Lid."\">";
				echo "<INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ALTER."\">";
			}else{
				$man_name=@$Finance->convertID($Lid,"out_mantype");
				echo "添加-".$man_name."-的,子支出类别 名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"subtype\" size=\"10\" value=\"\"></span>";
				echo "是否显示";
				echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				echo "<INPUT type=\"hidden\" name=\"man_id\" value=\"".$Lid."\">";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";
			}

			$type_corde = $Finance->getSubType($login_family_num,$recordtype,1,$Lid,0);

			$table_title = array("序号","状态","名称","排序","子类操作","返回主类");
			
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($type_corde);$i++){
				echo "<tr class=\"".$c."\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$YesNo=$type_corde[$i]['is_display']? "启用":"禁用"."</td>";
				echo "<td>".$type_corde[$i]['name']."</td>";
				echo "<td><span class=\"click\" onClick=\"MoveUp('".$type_corde[$i]['id']."')\">上移</span>|<span class=\"click\" onClick=\"MoveDown('".$type_corde[$i]['id']."')\">下移</span></td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$type_corde[$i]['id']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$type_corde[$i]['id']."')\">删除</span></td>";
				echo "<td><span class=\"click\" onClick=\"ReturnMantype('".$type_corde[$i]['id']."')\">返回主类</span></td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}

			echo "</table>";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($type_corde);
				echo "<Br>".date("Y-m-d");
				echo "<br>DEBUG END*********************************************<br>";	
			}
			break;
		case 'in_mantype':
			if ( $add_submit == 1 || $alter_submit == 1 ){
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "add_submit值为：".$_POST['add_submit']."<br>";
					echo "mantype值为：".$_POST['mantype']."<br>";
					echo "is_display值为：".$_POST['is_display']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				$mantype = $_POST['mantype'];
				$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;
				if($add_submit == 1){

					$YesNo = ($Finance->addTypeData($recordtype,$login_family_num,$mantype,$is_display,0))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加收入主类-成功,主类名称: ".$mantype." 显示: ".$is_display : "添加收入主类-失败,主类名称: ".$mantype." 显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5022 : 1022;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getManType($login_family_num,$recordtype,1,$alter_id);
					$YesNo =($Finance->updateTypeData($recordtype,$login_family_num,$alter_id,$mantype,$is_display))==true ? true:false;
					
					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改收入主类-成功,主类原名称: ".$alter_corde['0']['name']." 改为:".$mantype." 原显示: ".$is_display2."  改为:".$is_display : "修改收入主类-失败,主类原名称: ".$alter_corde['0']['name']." 改为:".$mantype." 原显示: ".$is_display2."改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5023 : 1023;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getManType($login_family_num,$recordtype,1,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_family_num,$Did,$login_user_id))==true ? true:false;
				
				/*  记录日志  */
				$is_display = $alter_corde['0']['is_diaplay'] == 1 ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除收入主类-成功,主类名称: ".$alter_corde['0']['name']." 显示: ".$is_display : "删除收入主类-失败,主类名称: ".$alter_corde['0']['name']." 显示: ".$is_display;
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5024 : 1024;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_family_num,0,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_family_num,0,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getManType($login_family_num,$recordtype,1,$Aid);

				echo "修改主收入类别 名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"mantype\" size=\"10\" value=\"".$alter_corde['0']['name']."\"></span>";
				echo "是否显示";
				if ($alter_corde['0']['is_display']=="1"){
					echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				}else{
					echo "<INPUT TYPE=\"checkbox\" name=\"is_display\" ></span>";
				}
				echo "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\">";
				echo "<INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ALTER."\">";
			}else{
				echo "添加主收入类别 名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"mantype\" size=\"10\" value=\"\"></span>";
				echo "是否显示";
				echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";
			}

			$type_corde = $Finance->getManType($login_family_num,$recordtype,1,0);

			$table_title = array("序号","状态","名称","排序","主类操作","子类操作");
			
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($type_corde);$i++){
				echo "<tr class=\"".$c."\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$YesNo=$type_corde[$i]['is_display']? "启用":"禁用"."</td>";
				echo "<td>".$type_corde[$i]['name']."</td>";
				echo "<td><span class=\"click\" onClick=\"MoveUp('".$type_corde[$i]['id']."')\">上移</span>|<span class=\"click\" onClick=\"MoveDown('".$type_corde[$i]['id']."')\">下移</span></td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$type_corde[$i]['id']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$type_corde[$i]['id']."')\">删除</span></td>";
				echo "<td><span class=\"click\" onClick=\"ListSubtype('".$type_corde[$i]['id']."')\">查看子类</span></td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}

			echo "</table>";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($type_corde);
				echo "<Br>".date("Y-m-d");
				echo "<br>DEBUG END*********************************************<br>";	
			}
			break;
		case 'in_subtype':
			$Lid = $_GET['Lid'];
			if ( $add_submit == 1 || $alter_submit == 1 ){
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "add_submit值为：".$_POST['add_submit']."<br>";
					echo "subtype值为：".$_POST['subtype']."<br>";
					echo "man_id值为：".$_POST['man_id']."<br>";
					echo "is_display值为：".$_POST['is_display']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				$man_id = $_POST['man_id'];
				$subtype = $_POST['subtype'];
				$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;
				if($add_submit == 1){
					$YesNo = ($Finance->addTypeData($recordtype,$login_family_num,$subtype,$is_display,$Lid))==true ?  true:false;

					/*  记录日志  */
					$man_name=@$Finance->convertID($man_id,"out_mantype");
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加收入子类-成功,所属主类名称: ".$man_name.",子类名称:".$subtype.",显示: ".$is_display : "添加收入子类-失败,所属主类名称: ".$man_name.",子类名称:".$subtype.",显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5025 : 1025;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getSubType($login_family_num,$recordtype,1,$man_id,$alter_id);

					$YesNo =($Finance->updateTypeData($recordtype,$login_family_num,$alter_id,$subtype,$is_display,$man_id))==true ? true:false;
					
					/*  记录日志  */
					$man_name=@$Finance->convertID($man_id,"in_mantype");
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改收入子类-成功,所属主类名称: ".$man_name.",原子类名称:".$alter_corde['0']['name'].",改为:".$subtype.",原显示: ".$is_display2.",改为:".$is_display : "修改收入子类-失败,所属主类名称: ".$man_name.",原子类名称:".$alter_corde['0']['name'].",改为:".$subtype.",原显示: ".$is_display2.",改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5026 : 1026;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getSubType($login_family_num,$recordtype,1,$Lid,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_family_num,$Did,$login_user_id))==true ? true:false;
				
				/*  记录日志  */
				$man_name=@$Finance->convertID($Lid,"in_mantype");
				$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除支出子类-成功,所属主类名称: ".$man_name.",子类名称:".$alter_corde['0']['name'].",显示: ".$is_display2 : "删除支出子类-失败,所属主类名称: ".$man_name.",子类名称:".$alter_corde['0']['name'].",显示: ".$is_display2;
					/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5027 : 1027;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_family_num,$Lid,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_family_num,$Lid,$Mid);
				}
			}

			$man_name=@$Finance->convertID($Lid,"in_mantype");
			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getSubType($login_family_num,$recordtype,1,$Lid,$Aid);
				echo "修改-".$man_name."-的,子支出类别 名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"subtype\" size=\"10\" value=\"".$alter_corde['0']['name']."\"></span>";
				echo "是否显示";
				if ($alter_corde['0']['is_display']=="1"){
					echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				}else{
					echo "<INPUT TYPE=\"checkbox\" name=\"is_display\" ></span>";
				}
				echo "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\">";
				echo "<INPUT type=\"hidden\" name=\"man_id\" value=\"".$Lid."\">";
				echo "<INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ALTER."\">";
			}else{
				echo "添加-".$man_name."-的,子支出类别 名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"subtype\" size=\"10\" value=\"\"></span>";
				echo "是否显示";
				echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";
			}

			$type_corde = $Finance->getSubType($login_family_num,$recordtype,1,$Lid,0);

			$table_title = array("序号","状态","名称","排序","子类操作","返回主类");
			
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($type_corde);$i++){
				echo "<tr class=\"".$c."\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$YesNo=$type_corde[$i]['is_display']? "启用":"禁用"."</td>";
				echo "<td>".$type_corde[$i]['name']."</td>";
				echo "<td><span class=\"click\" onClick=\"MoveUp('".$type_corde[$i]['id']."')\">上移</span>|<span class=\"click\" onClick=\"MoveDown('".$type_corde[$i]['id']."')\">下移</span></td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$type_corde[$i]['id']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$type_corde[$i]['id']."')\">删除</span></td>";
				echo "<td><span class=\"click\" onClick=\"ReturnMantype('".$type_corde[$i]['id']."')\">返回主类</span></td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}

			echo "</table>";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($type_corde);
				echo "<Br>".date("Y-m-d");
				echo "<br>DEBUG END*********************************************<br>";	
			}
			break;
		case 'address':
			if ( $add_submit == 1 || $alter_submit == 1 ){
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "add_submit值为：".$_POST['add_submit']."<br>";
					echo "address值为：".$_POST['address']."<br>";
					echo "is_display值为：".$_POST['is_display']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				$address = $_POST['address'];
				$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;
				if($add_submit == 1){
					$YesNo = ($Finance->addTypeData($recordtype,$login_family_num,$address,1,0))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加地址-成功,地址名称: ".$address.",显示: ".$is_display : "添加地址-失败,地址名称: ".$address.",显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5028 : 1028;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getAddress($login_family_num,1,$alter_id);
					
					$YesNo =($Finance->updateTypeData($recordtype,$login_family_num,$alter_id,$address,$is_display))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改地址-成功,原地址名称:".$alter_corde['0']['name'].",改为:".$address.",原显示: ".$is_display2.",改为:".$is_display : "修改地址-失败,原地址名称:".$alter_corde['0']['name'].",改为:".$address.",原显示: ".$is_display2.",改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5029 : 1029;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getAddress($login_family_num,1,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_family_num,$Did,$login_user_id))==true ? true:false;
					
				/*  记录日志  */
				$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除地址-成功,地址名称:".$alter_corde['0']['name'].",显示: ".$is_display2 : "删除地址-失败,地址名称:".$alter_corde['0']['name'].",显示: ".$is_display2;
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5033 : 1033;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_family_num,0,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_family_num,0,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getAddress($login_family_num,1,$Aid);

				echo "修改地址名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"address\" size=\"10\" value=\"".$alter_corde['0']['name']."\"></span>";
				echo "是否显示";
				if ($alter_corde['0']['is_display']=="1"){
					echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				}else{
					echo "<INPUT TYPE=\"checkbox\" name=\"is_display\" ></span>";
				}
				echo "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\">";
				echo "<INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ALTER."\">";
			}else{
				echo "添加地址名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"address\" size=\"10\" value=\"\"></span>";
				echo "是否显示";
				echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";
			}
	
			$address_corde = $Finance->getAddress($login_family_num,1);

			$table_title = array("序号","状态","名称","排序","操作");
			
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($address_corde);$i++){
				echo "<tr class=\"".$c."\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$YesNo=$address_corde[$i]['is_display']? "启用":"禁用"."</td>";
				echo "<td>".$address_corde[$i]['name']."</td>";
				echo "<td><span class=\"click\" onClick=\"MoveUp('".$address_corde[$i]['id']."')\">上移</span>|<span class=\"click\" onClick=\"MoveDown('".$address_corde[$i]['id']."')\">下移</span></td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$address_corde[$i]['id']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$address_corde[$i]['id']."')\">删除</span></td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}

			echo "</table>";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($address);
				echo "<Br>".date("Y-m-d");
				echo "<br>DEBUG END*********************************************<br>";	
			}
			break;
		case 'bank_card':
			if ( $add_submit == 1 || $alter_submit == 1 ){
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "cardname值为：".$_POST['cardname']."<br>";
					echo "cardnum值为：".$_POST['cardnum']."<br>";
					echo "cardtype值为：".$_POST['cardtype']."<br>";
					echo "cardaddr值为：".$_POST['cardaddr']."<br>";
					echo "cardmoney值为：".$_POST['cardmoney']."<br>";
					echo "cardyearout值为：".$_POST['cardyearout']."<br>";
					echo "cardyearin值为：".$_POST['cardyearin']."<br>";
					echo "notes值为：".$_POST['notes']."<br>";
					echo "is_disable值为：".$_POST['is_disable']."<br>";
					echo "alter_id值为：".$_POST['alter_id']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				$_POST['is_disable'] == "on" ? $is_disable = "0" : $is_disable = "1" ;
				$cardname = $_POST['cardname'];
				$cardnum = $_POST['cardnum'];
				$cardtype = $_POST['cardtype'];
				$cardaddr = $_POST['cardaddr'];
				$cardmoney = $_POST['cardmoney'];
				$cardyearout = $_POST['cardyearout'];
				$cardyearin = $_POST['cardyearin'];
				$notes = $_POST['notes'];
				$alter_id = $_POST['alter_id'];

				if($add_submit == 1){
					$YesNo = ($Finance->insertBankCard($login_user_id,$login_family_num,$cardname,$cardnum,$cardtype,$cardaddr,$cardmoney,$cardyearout,$cardyearin,$notes,$alter_id,$is_disable))==true ? true:false;

					/*  记录日志  */
					$is_disable = $_POST['is_disable'] == "on" ?  "启用" : "禁用";
					$text_log = $YesNo ? "添加银行卡-成功,状态:".$is_disable.",开户行: ".$cardname.",卡号: ".$cardnum.",卡类型:".$cardtype.",归属地:".$cardaddr.",金钱:".$cardmoney.",年费:".$cardyearout.",利息:".$cardyearin.",备注:".$notes : "添加银行卡-失败,状态:".$is_disable.",开户行: ".$cardname.",卡号: ".$cardnum.",卡类型:".$cardtype.",归属地:".$cardaddr.",金钱:".$cardmoney.",年费:".$cardyearout.",利息:".$cardyearin.",备注:".$notes;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5037 : 1037;
				}

				if($alter_submit == 1){
					$alter_corde = $Finance->getCordeData($login_family_num,$recordtype,"",0,$alter_id);

					$YesNo =($Finance->updateBankCard($cardname,$cardnum,$cardtype,$cardaddr,$cardmoney,$cardyearout,$cardyearin,$notes,$alter_id,$is_disable))==true ? true:false;
					
					/*  记录日志  */
					$is_disable = $_POST['is_disable'] == "on" ?  "启用" : "禁用";
					$is_disable2 = $alter_corde['0']['is_disable'] == "0" ?  "启用" : "禁用";

					$text_log = $YesNo ? "修改银行卡-成功,原状态:".$is_disable2."改为:".$is_disable.",原开户行: ".$alter_corde['0']['card_name']."改为: ".$cardname.",原卡号: ".$alter_corde['0']['card_num'].",改为".$cardnum.",原卡类型:".$alter_corde['0']['card_type']."改为".$cardtype.",原归属地:".$alter_corde['0']['card_addr']."改为".$cardaddr.",原金钱:".$alter_corde['0']['money']."改为".$cardmoney.",原年费:".$alter_corde['0']['year_out']."改为".$cardyearout.",原利息:".$alter_corde['0']['year_in']."改为".$cardyearin.",原备注:".$alter_corde['0']['notes']."改为".$notes : "修改银行卡-失败,原状态:".$is_disable2."改为:".$is_disable.",原开户行: ".$alter_corde['0']['card_name']."改为: ".$cardname.",原卡号: ".$alter_corde['0']['card_num'].",改为".$cardnum.",原卡类型:".$alter_corde['0']['card_type']."改为".$cardtype.",原归属地:".$alter_corde['0']['card_addr']."改为".$cardaddr.",原金钱:".$alter_corde['0']['money']."改为".$cardmoney.",原年费:".$alter_corde['0']['year_out']."改为".$cardyearout.",原利息:".$alter_corde['0']['year_in']."改为".$cardyearin.",原备注:".$alter_corde['0']['notes']."改为".$notes;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5038 : 1038;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde = $Finance->getCordeData($login_family_num,$recordtype,"",0,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_family_num,$Did,$login_user_id))==true ? true:false;
					
				/*  记录日志  */
				$is_disable2 = $alter_corde['0']['is_disable'] == "0" ?  "启用" : "禁用";
				$text_log = $YesNo ? "删除银行卡-成功,状态:".$is_disable2.",开户行: ".$alter_corde['0']['card_name'].",卡号: ".$alter_corde['0']['card_num'].",卡类型:".$alter_corde['0']['card_type'].",归属地:".$alter_corde['0']['card_addr'].",金钱:".$alter_corde['0']['money'].",年费:".$alter_corde['0']['year_out'].",利息:".$alter_corde['0']['year_in'].",备注:".$alter_corde['0']['notes'] : "删除银行卡-失败,状态:".$is_disable2.",开户行: ".$alter_corde['0']['card_name'].",卡号: ".$alter_corde['0']['card_num'].",卡类型:".$alter_corde['0']['card_type'].",归属地:".$alter_corde['0']['card_addr'].",金钱:".$alter_corde['0']['money'].",年费:".$alter_corde['0']['year_out'].",利息:".$alter_corde['0']['year_in'].",备注:".$alter_corde['0']['notes'];
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5039 : 1039;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_family_num,0,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_family_num,0,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde = $Finance->getCordeData($login_family_num,$recordtype,"",0,$Aid);
?>
			<table width="240">
				<tr><td colspan="2" class="Ctd">
					<?PHP echo "<b>".$_ALTER_BANKCARD."</b>"?>	
				</td></tr>
				<tr><td class="Rtd">
					<?PHP echo $_ENABLE." :"; ?>
				</td><td>
					<INPUT TYPE="checkbox" <?PHP if ($alter_corde['0']['is_disable']=="0") echo "checked=\"checked\"" ?> name="is_disable" >
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_NAME ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="cardname" value="<?PHP echo $alter_corde['0']['card_name'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_NUM ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="cardnum" value="<?PHP echo $alter_corde['0']['card_num'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_TYPE."" ?>&nbsp;-></span>
				</td><td>
					<span> 
						<select  name="cardtype">
							<option value="储蓄卡" <?PHP if ( $alter_corde['0']['card_type'] == "储蓄卡" ) echo "selected=\"selected\""; ?> >储蓄卡</option>
							<option value="支付宝卡" <?PHP if ( $alter_corde['0']['card_type'] == "支付宝卡" ) echo "selected=\"selected\""; ?> >支付宝卡</option>
							<option value="信用卡" <?PHP if ( $alter_corde['0']['card_type'] == "信用卡" ) echo "selected=\"selected\""; ?> >信用卡</option>
						</select>
					</span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_ADDR ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="cardaddr" value="<?PHP echo $alter_corde['0']['card_addr'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_MONEY ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="cardmoney" value="<?PHP echo $alter_corde['0']['money'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_YEAR_OUT ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="text" name="cardyearout" value="<?PHP echo $alter_corde['0']['year_out'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_YEAR_IN ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="text" name="cardyearin" value="<?PHP echo $alter_corde['0']['year_in'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_NOTES ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="text" name="notes" value="<?PHP echo $alter_corde['0']['notes'] ?>"></span>
				</td></tr>
				<tr><td colspan="2" class="Rtd">
					<INPUT type="hidden" name="alter_id" value="<?PHP echo $Aid ?>">
					<INPUT type="hidden" name="alter_submit" value="1">
				<INPUT  TYPE="submit" value="<?PHP echo $_ALTER; ?>">
			</td></tr>
		</table>
<?PHP
			}else{
?>
			<table width="240">
				<tr><td colspan="2" class="Ctd">
					<?PHP echo "<b>".$_ADD_BANKCARD."</b>"?>	
				</td></tr>
				<tr><td class="Rtd">
					<?PHP echo $_ENABLE." :"; ?>
				</td><td>
					<INPUT TYPE="checkbox" checked="checked" name="is_disable" >
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_NAME ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="cardname"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_NUM ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="cardnum"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_TYPE."" ?>&nbsp;-></span>
				</td><td>
					<span> 
						<select  name="cardtype">
							<option value="储蓄卡">储蓄卡</option>
							<option value="支付宝卡">支付宝卡</option>
							<option value="信用卡">信用卡</option>
						</select>
					</span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_ADDR ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="cardaddr"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_MONEY ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="cardmoney"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_YEAR_OUT ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="text" name="cardyearout"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_CARD_YEAR_IN ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="text" name="cardyearin"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_NOTES ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="text" name="notes"></span>
				</td></tr>
				<tr><td colspan="2" class="Rtd">
					<INPUT type="hidden" name="add_submit" value="1">
				<INPUT  TYPE="submit" value="<?PHP echo $_ADD; ?>">
			</td></tr>
		</table>
<?PHP
			}

			$card_data = $Finance->getCordeData($login_family_num,$recordtype,"",0,0);
			 
			$table_title = array("序号","用户","状态","开户行","卡类型","备注","创建时间","操作");
			
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($card_data);$i++){
				echo "<tr class=\"".$c."\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".@$Finance->convertID($card_data[$i]['user_id'],"users")."</td>";
				echo "<td>".$YesNo=$card_data[$i]['is_disable']? "禁用":"启用"."</td>";
				echo "<td>".$card_data[$i]['card_name']."</td>";
				echo "<td>".$card_data[$i]['card_type']."</td>";
				echo "<td>".$card_data[$i]['notes']."</td>";
				echo "<td>".date('Y-m-d H:i:s',$card_data[$i]['create_date'])."</td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$card_data[$i]['id']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$card_data[$i]['id']."')\">删除</span></td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}
			echo "</table>";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($card_data);
				echo "<Br>".date("Y-m-d");
				echo "<br>DEBUG END*********************************************<br>";	
			}
			break;
		case 'current_money':
			if ( $add_submit == 1 || $alter_submit == 1 ){
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "cmoney值为：".$_POST['cmoney']."<br>";
					echo "alter_id值为：".$_POST['alter_id']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				$cmoney = $_POST['cmoney'];
				$alter_id = $_POST['alter_id'];

				if($add_submit == 1){
					$YesNo = ($Finance->insertCurrentMoney($login_user_id,$login_family_num,$cmoney))==true ? true:false;

					/*  记录日志  */
					$text_log = $YesNo ? "添加现金-成功,用户:".$login_user_id.", 现金:".$cmoney  : "添加现金-失败,用户:".$login_user_id.", 现金:".$cmoney;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5040 : 1040;
				}

				if($alter_submit == 1){
					$alter_corde = $Finance->getCordeData($login_family_num,$recordtype,"",0,$alter_id);

					$YesNo = ($Finance->updateCurrentMoney($login_user_id,$login_family_num,$cmoney,$alter_id))==true ? true:false;
					
					/*  记录日志  */
					$text_log = $YesNo ? "修改现金-成功,用户:".$login_user_id.", 现金:".$cmoney  : "修改现金-失败,用户:".$login_user_id.", 现金:".$cmoney;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5041 : 1041;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde = $Finance->getCordeData($login_family_num,$recordtype,"",0,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_family_num,$Did,$login_user_id))==true ? true:false;
					
				/*  记录日志  */
				$text_log = $YesNo ? "删除现金-成功,用户:".$login_user_id.", 现金:".$cmoney  : "删除现金-失败,用户:".$login_user_id.", 现金:".$cmoney;
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5042 : 1042;
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde = $Finance->getCordeData($login_family_num,$recordtype,"",0,$Aid);
?>
			<table width="240">
				<tr><td colspan="2" class="Ctd">
					<?PHP echo "<b>".$_ALTER_MONEY."</b>"?>	
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_C_MONEY ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="cmoney" value="<?PHP echo $alter_corde['0']['money'] ?>"></span>
				</td></tr>
				<tr><td colspan="2" class="Rtd">
					<INPUT type="hidden" name="alter_id" value="<?PHP echo $Aid ?>">
					<INPUT type="hidden" name="alter_submit" value="1">
				<INPUT  TYPE="submit" value="<?PHP echo $_ALTER; ?>">
			</td></tr>
		</table>
<?PHP
			}else{
				if ( $Finance->yesCurrentMoney( $login_user_id )) {
					echo "<BR><BR>";
				} else {
?>
					<table width="240">
						<tr><td colspan="2" class="Ctd">
							<?PHP echo "<b>".$_ADD_MONEY."</b>"?>	
						</td></tr>
						<tr><td class="Rtd">
							<span><?PHP echo $_C_MONEY ?>&nbsp;-></span>
						</td><td>
							<span> <input class="LoginInput" type="text" name="cmoney"></span>
						</td></tr>
						<tr><td colspan="2" class="Rtd">
							<INPUT type="hidden" name="add_submit" value="1">
						<INPUT  TYPE="submit" value="<?PHP echo $_ADD; ?>">
					</td></tr>
				</table>
<?PHP
				}
			}

			$money_data = $Finance->getCordeData($login_family_num,$recordtype,"",0,0);
			 
			$table_title = array("序号","用户","家庭号","最后修改时间","现金","操作");
			
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$c="ContentTdColor1";
			$today_money = 0;
			for ($i=0;$i<count($money_data);$i++){
				$today_money = ($today_money + $money_data[$i]['money']);
				echo "<tr class=\"".$c."\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".@$Finance->convertID($money_data[$i]['user_id'],"users")."</td>";
				echo "<td>".$money_data[$i]['family_num']."</td>";
				echo "<td>".date('Y-m-d H:i:s',$money_data[$i]['last_date'])."</td>";
				echo "<td>".$money_data[$i]['money']."</td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$money_data[$i]['id']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$money_data[$i]['id']."')\">删除</span></td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}
			echo "<tr class='ContentTdColor'><td colspan=\"4\" align=\"right\">现金总计：</td><td colspan=\"2\">".$today_money."元</td></tr>";
			echo "</table>";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($money_data);
				echo "<Br>".date("Y-m-d");
				echo "<br>DEBUG END*********************************************<br>";	
			}
			break;
	case 'family':
			echo "<script type=\"text/javascript\" src=\"".JS_PATH."check.js\"></script>";
			if ( $add_submit == 1 || $alter_submit == 1 ){
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "username值为：".$_POST['username']."<br>";
					echo "useralias值为：".$_POST['useralias']."<br>";
					echo "password值为：".$_POST['password']."<br>";
					echo "notes值为：".$_POST['notes']."<br>";
					echo "is_disable值为：".$_POST['is_disable']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				$_POST['is_disable'] == "on" ? $is_disable = "0" : $is_disable = "1" ;
				$username = $_POST['username'];
				$useralias = $_POST['useralias'];
				$password = $_POST['password'];
				$email = $_POST['email'];
				$qq = $_POST['qq'];
				$notes = $_POST['notes'];
				$alter_id = $_POST['alter_id'];

				if($add_submit == 1){
					$YesNo = ($Finance->AddUser($is_disable,$username,$useralias,$password,$email,$qq,$notes,$login_family_num))==true ? true:false;

					/*  记录日志  */
					$is_disable = $_POST['is_disable'] == "on" ?  "启用" : "禁用";
					$text_log = $YesNo ? "添加用户-成功,状态:".$is_disable."用户名: ".$username.",用户别名: ".$useralias.",用户密码:".$password.",用户属组:".$login_family_num.",备注:".$notes : "添加用户-失败,用户名: ".$username.",用户别名: ".$useralias.",用户密码:".$password.",用户属组:".$login_family_num.",备注:".$notes;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5030 : 1030;
				}

				if($alter_submit == 1){
					$alter_corde=$Finance->getUsers($login_family_num,1,$alter_id);

					$YesNo =($Finance->updateUser($is_disable,$username,$useralias,$password,$email,$qq,$notes,$alter_id))==true ? true:false;
					
					/*  记录日志  */
					$is_disable = $_POST['is_disable'] == "on" ?  "启用" : "禁用";
					$is_disable2 = $alter_corde['0']['is_disable'] == "0" ?  "启用" : "禁用";

					$text_log = $YesNo ? "修改用户-成功,原状态:".$is_disable2.",改为:".$is_disable.",原用户名: ".$alter_corde['0']['username'].",改为:".$username.",原用户别名:".$alter_corde['0']['user_alias'].",改为:".$useralias.",原用户密码:".$alter_corde['0']['password'].",改为:".$password.",用户属组:".$login_family_num.",原备注:".$alter_corde['0']['notes']."改为:".$notes : "修改用户-失败,原状态:".$is_disable2.",改为:".$is_disable.",原用户名: ".$alter_corde['0']['username'].",改为:".$username.",原用户别名:".$alter_corde['0']['user_alias'].",改为:".$useralias.",原用户密码:".$alter_corde['0']['password'].",改为:".$password.",用户属组:".$login_family_num.",原备注:".$alter_corde['0']['notes']."改为:".$notes;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5031 : 1031;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getUsers($login_family_num,1,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_family_num,$Did,$login_user_id))==true ? true:false;
					
				/*  记录日志  */
				$is_disable2 = $alter_corde['0']['is_disable'] == "0" ?  "启用" : "禁用";
				$text_log = $YesNo ? "删除用户-成功,状态:".$is_disable2."用户名: ".$alter_corde['0']['username'].",用户别名: ".$alter_corde['0']['user_alias'].",用户密码:".$alter_corde['0']['password'].",用户属组:".$login_family_num.",备注:".$alter_corde['0']['notes'] : "删除用户-失败,状态:".$is_disable2."用户名: ".$alter_corde['0']['username'].",用户别名: ".$alter_corde['0']['user_alias'].",用户密码:".$alter_corde['0']['password'].",用户属组:".$login_family_num.",备注:".$alter_corde['0']['notes'];
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5032 : 1032;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_family_num,0,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_family_num,0,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getUsers($login_family_num,1,$Aid);
?>
			<table width="240">
				<tr><td colspan="2" class="Ctd">
					<?PHP echo "<b>".$_ALTER_USER."</b>"?>	
				</td></tr>
				<tr><td class="Rtd">
					<?PHP echo $_ENABLE." :"; ?>
				</td><td>
					<INPUT TYPE="checkbox" <?PHP if ($alter_corde['0']['is_disable']=="0") echo "checked=\"checked\"" ?> name="is_disable" >
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_USERNAME ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="username" value="<?PHP echo $alter_corde['0']['username'] ?>" ></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_USERALIAS ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="useralias" value="<?PHP echo $alter_corde['0']['user_alias'] ?>" ></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_FAMILY_NUM."" ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text"  readonly="readonly" name="family_num" value="<?PHP echo $login_family_num ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_MAIL ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="email" value="<?PHP echo $alter_corde['0']['email'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_QQ ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="qq" value="<?PHP echo $alter_corde['0']['qq'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_PASSWORD ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="password" name="password" value="<?PHP echo $alter_corde['0']['clean_pass'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_YES_PASSWORD ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="password" name="yes_password" value="<?PHP echo $alter_corde['0']['clean_pass'] ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_NOTES ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="text" name="notes" value="<?PHP echo $alter_corde['0']['notes'] ?>"></span>
				</td></tr>
				<tr><td colspan="2" class="Rtd">
					<INPUT type="hidden" name="alter_id" value="<?PHP echo $Aid ?>">
					<INPUT type="hidden" name="alter_submit" value="1">
				<INPUT  TYPE="submit" value="<?PHP echo $_ALTER; ?>">
			</td></tr>
		</table>
<?PHP
			}else{
?>
			<table width="240">
				<tr><td colspan="2" class="Ctd">
					<?PHP echo "<b>".$_ADD_USER."</b>"?>	
				</td></tr>
				<tr><td class="Rtd">
					<?PHP echo $_ENABLE." :"; ?>
				</td><td>
					<INPUT TYPE="checkbox" checked="checked" name="is_disable" >
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_USERNAME ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="username"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_USERALIAS ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="useralias"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_FAMILY_NUM."" ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text"  readonly="readonly" name="family_num" value="<?PHP echo $login_family_num ?>"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_MAIL ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="email"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_QQ ?>&nbsp;-></span>
				</td><td>
					<span> <input class="LoginInput" type="text" name="qq"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_PASSWORD ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="password" name="password"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_YES_PASSWORD ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="password" name="yes_password"></span>
				</td></tr>
				<tr><td class="Rtd">
					<span><?PHP echo $_NOTES ?>&nbsp;-></span>
				</td><td>
					<span><input class="LoginInput" type="text" name="notes"></span>
				</td></tr>
				<tr><td colspan="2" class="Rtd">
					<INPUT type="hidden" name="add_submit" value="1">
				<INPUT  TYPE="submit" value="<?PHP echo $_ADD; ?>">
			</td></tr>
		</table>
<?PHP
			}

			$users_corde = $Finance->getUserData($login_family_num);
			
			$table_title = array("序号","状态","用户名","别名","家庭号","备注","登录次数","最后登录","操作");
			
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($users_corde);$i++){
				echo "<tr class=\"".$c."\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$YesNo=$users_corde[$i]['is_disable']? "禁用":"启用"."</td>";
				echo "<td>".$users_corde[$i]['username']."</td>";
				echo "<td>".$users_corde[$i]['user_alias']."</td>";
				echo "<td>".$login_family_num."</td>";
				echo "<td>".$users_corde[$i]['notes']."</td>";
				echo "<td>".$users_corde[$i]['login_sum']."</td>";
				echo "<td>".@date('Y-m-d H:i:s',$users_corde[$i]['last_date'])."</td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$users_corde[$i]['id']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$users_corde[$i]['id']."')\">删除</span></td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}

			echo "</table>";
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($users_corde);
				echo "<Br>".date("Y-m-d");
				echo "<br>DEBUG END*********************************************<br>";	
			}
			break;
	default:
		echo "<a class=\"content\" href=\"main.php?page=fun_manager.php&add_type=out_mantype\"><span>支出类别管理</span></a>";
		echo "<br><br>";
		echo "<a class=\"content\" href=\"main.php?page=fun_manager.php&add_type=in_mantype\"><span>收入类别管理</span></a>";
		echo "<br><br>";
		echo "<a class=\"content\" href=\"main.php?page=fun_manager.php&add_type=address\"><span>地址管理</span></a><br><br>";
		echo "<a class=\"content\" href=\"main.php?page=fun_manager.php&add_type=bank_card\"><span>银行卡管理</span></a>";
		echo "<br><br>";
		echo "<a class=\"content\" href=\"main.php?page=fun_manager.php&add_type=current_money\"><span>现金管理</span></a>";
		echo "<br><br>";
		echo "<a class=\"content\" href=\"main.php?page=fun_manager.php&add_type=family\"><span>家庭管理</span></a>";
	}
	if (! empty($text_log)) {
		$Finance->CrodeLog($text_log);
	}
?>
</form>
</div>

