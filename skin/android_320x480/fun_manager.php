<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle2')</script>
<form class="add_form" name="add_form" action="main.php<?PHP echo "?page=fun_manager.php&add_type=".$_GET['add_type']."&Lid=".$_GET['Lid'];?>" method="post">

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
					$YesNo = ($Finance->addTypeData($recordtype,$login_user_id,$mantype,$is_display,0))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加支出主类-成功,主类名称: ".$mantype." 显示: ".$is_display : "添加支出主类-失败,主类名称: ".$mantype." 显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5016 : 1016;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getManType($login_user_id,$recordtype,1,$alter_id);
					$YesNo =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$mantype,$is_display))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改支出主类-成功,主类原名称: ".$alter_corde['0']['name']." 改为:".$mantype." 原显示: ".$is_display2."  改为:".$is_display : "修改支出主类-失败,主类原名称: ".$alter_corde['0']['name']." 改为:".$mantype." 原显示: ".$is_display2."改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5017 : 1017;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getManType($login_user_id,$recordtype,1,$Did);
				$str =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? "成功<br>":"失败<br>";
					
				/*  记录日志  */
				$is_display = $alter_corde['0']['is_diaplay'] == 1 ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除支出主类-成功,主类名称: ".$alter_corde['0']['name']." 显示: ".$is_display : "删除支出主类-失败,主类名称: ".$alter_corde['0']['name']." 显示: ".$is_display;
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5018 : 1018;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_user_id,0,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_user_id,0,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getManType($login_user_id,$recordtype,1,$Aid);

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

			$type_corde = $Finance->getManType($login_user_id,$recordtype,1,0);

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
				echo "<td><span class=\"click\" onClick=\"Alter('".$type_corde[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$type_corde[$i]['id']."')\">删除</span></td>";
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
					$YesNo = ($Finance->addTypeData($recordtype,$login_user_id,$subtype,$is_display,$Lid))==true ? true:false;
					
					/*  记录日志  */
					$man_name=$Finance->convertID($login_user_id,$man_id,"out_mantype");
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加支出子类-成功,所属主类名称: ".$man_name.",子类名称:".$subtype.",显示: ".$is_display : "添加支出子类-失败,所属主类名称: ".$man_name.",子类名称:".$subtype.",显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5019 : 1019;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getSubType($login_user_id,$recordtype,1,$man_id,$alter_id);

					$YesNo =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$subtype,$is_display,$man_id))==true ? true:false;

					/*  记录日志  */
					$man_name=$Finance->convertID($login_user_id,$man_id,"out_mantype");
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改支出子类-成功,所属主类名称: ".$man_name.",原子类名称:".$alter_corde['0']['name'].",改为:".$subtype.",原显示: ".$is_display2.",改为:".$is_display : "修改支出子类-失败,所属主类名称: ".$man_name.",原子类名称:".$alter_corde['0']['name'].",改为:".$subtype.",原显示: ".$is_display2.",改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5020 : 1020;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getSubType($login_user_id,$recordtype,1,$Lid,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? true:false;

				/*  记录日志  */
				$man_name=$Finance->convertID($login_user_id,$Lid,"out_mantype");
				$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除支出子类-成功,所属主类名称: ".$man_name.",子类名称:".$alter_corde['0']['name'].",显示: ".$is_display2 : "删除支出子类-失败,所属主类名称: ".$man_name.",子类名称:".$alter_corde['0']['name'].",显示: ".$is_display2;
					/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5021 : 1021;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_user_id,$Lid,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_user_id,$Lid,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getSubType($login_user_id,$recordtype,1,$Lid,$Aid);
				$man_name=$Finance->convertID($login_user_id,$Lid,"out_mantype");
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
				$man_name=$Finance->convertID($login_user_id,$Lid,"out_mantype");
				echo "添加-".$man_name."-的,子支出类别 名称:&nbsp;<br>";
				echo "<input  type=\"text\" name=\"subtype\" size=\"10\" value=\"\"></span>";
				echo "是否显示";
				echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				echo "<INPUT type=\"hidden\" name=\"man_id\" value=\"".$Lid."\">";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";
			}

			$type_corde = $Finance->getSubType($login_user_id,$recordtype,1,$Lid,0);

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
				echo "<td><span class=\"click\" onClick=\"Alter('".$type_corde[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$type_corde[$i]['id']."')\">删除</span></td>";
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

					$YesNo = ($Finance->addTypeData($recordtype,$login_user_id,$mantype,$is_display,0))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加收入主类-成功,主类名称: ".$mantype." 显示: ".$is_display : "添加收入主类-失败,主类名称: ".$mantype." 显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5022 : 1022;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getManType($login_user_id,$recordtype,1,$alter_id);
					$YesNo =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$mantype,$is_display))==true ? true:false;
					
					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改收入主类-成功,主类原名称: ".$alter_corde['0']['name']." 改为:".$mantype." 原显示: ".$is_display2."  改为:".$is_display : "修改收入主类-失败,主类原名称: ".$alter_corde['0']['name']." 改为:".$mantype." 原显示: ".$is_display2."改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5023 : 1023;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getManType($login_user_id,$recordtype,1,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? true:false;
				
				/*  记录日志  */
				$is_display = $alter_corde['0']['is_diaplay'] == 1 ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除收入主类-成功,主类名称: ".$alter_corde['0']['name']." 显示: ".$is_display : "删除收入主类-失败,主类名称: ".$alter_corde['0']['name']." 显示: ".$is_display;
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5024 : 1024;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_user_id,0,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_user_id,0,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getManType($login_user_id,$recordtype,1,$Aid);

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

			$type_corde = $Finance->getManType($login_user_id,$recordtype,1,0);

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
				echo "<td><span class=\"click\" onClick=\"Alter('".$type_corde[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$type_corde[$i]['id']."')\">删除</span></td>";
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
					$YesNo = ($Finance->addTypeData($recordtype,$login_user_id,$subtype,$is_display,$Lid))==true ?  true:false;

					/*  记录日志  */
					$man_name=$Finance->convertID($login_user_id,$man_id,"out_mantype");
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加收入子类-成功,所属主类名称: ".$man_name.",子类名称:".$subtype.",显示: ".$is_display : "添加收入子类-失败,所属主类名称: ".$man_name.",子类名称:".$subtype.",显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5025 : 1025;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getSubType($login_user_id,$recordtype,1,$man_id,$alter_id);

					$YesNo =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$subtype,$is_display,$man_id))==true ? true:false;
					
					/*  记录日志  */
					$man_name=$Finance->convertID($login_user_id,$man_id,"in_mantype");
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改收入子类-成功,所属主类名称: ".$man_name.",原子类名称:".$alter_corde['0']['name'].",改为:".$subtype.",原显示: ".$is_display2.",改为:".$is_display : "修改收入子类-失败,所属主类名称: ".$man_name.",原子类名称:".$alter_corde['0']['name'].",改为:".$subtype.",原显示: ".$is_display2.",改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5026 : 1026;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getSubType($login_user_id,$recordtype,1,$Lid,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? true:false;
				
				/*  记录日志  */
				$man_name=$Finance->convertID($login_user_id,$Lid,"in_mantype");
				$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除支出子类-成功,所属主类名称: ".$man_name.",子类名称:".$alter_corde['0']['name'].",显示: ".$is_display2 : "删除支出子类-失败,所属主类名称: ".$man_name.",子类名称:".$alter_corde['0']['name'].",显示: ".$is_display2;
					/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5027 : 1027;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_user_id,$Lid,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_user_id,$Lid,$Mid);
				}
			}

			$man_name=$Finance->convertID($login_user_id,$Lid,"in_mantype");
			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getSubType($login_user_id,$recordtype,1,$Lid,$Aid);
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

			$type_corde = $Finance->getSubType($login_user_id,$recordtype,1,$Lid,0);

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
				echo "<td><span class=\"click\" onClick=\"Alter('".$type_corde[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$type_corde[$i]['id']."')\">删除</span></td>";
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
					$YesNo = ($Finance->addTypeData($recordtype,$login_user_id,$address,1,0))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$text_log = $YesNo ? "添加地址-成功,地址名称: ".$address.",显示: ".$is_display : "添加地址-失败,地址名称: ".$address.",显示: ".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5028 : 1028;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$alter_corde=$Finance->getAddress($login_user_id,1,$alter_id);
					
					$YesNo =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$address,$is_display))==true ? true:false;

					/*  记录日志  */
					$is_display = $_POST['is_display'] == "on" ?  "显示" : "不显示";
					$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
					$text_log = $YesNo ? "修改地址-成功,原地址名称:".$alter_corde['0']['name'].",改为:".$address.",原显示: ".$is_display2.",改为:".$is_display : "修改地址-失败,原地址名称:".$alter_corde['0']['name'].",改为:".$address.",原显示: ".$is_display2.",改为:".$is_display;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5029 : 1029;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getAddress($login_user_id,1,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? true:false;
					
				/*  记录日志  */
				$is_display2 = $alter_corde['0']['is_display'] == "1" ?  "显示" : "不显示";
				$text_log = $YesNo ? "删除地址-成功,地址名称:".$alter_corde['0']['name'].",显示: ".$is_display2 : "删除地址-失败,地址名称:".$alter_corde['0']['name'].",显示: ".$is_display2;
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5029 : 1029;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_user_id,0,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_user_id,0,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getAddress($login_user_id,1,$Aid);

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
	
			$address_corde = $Finance->getAddress($login_user_id,1);

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
				echo "<td><span class=\"click\" onClick=\"Alter('".$address_corde[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$address_corde[$i]['id']."')\">删除</span></td>";
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
	case 'family':
			if ( $add_submit == 1 || $alter_submit == 1 ){
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "user_name值为：".$_POST['user_name']."<br>";
					echo "user_alias值为：".$_POST['user_alias']."<br>";
					echo "user_password值为：".$_POST['user_password']."<br>";
					echo "notes值为：".$_POST['notes']."<br>";
					echo "is_disable值为：".$_POST['is_disable']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				$_POST['is_disable'] == "on" ? $is_disable = "0" : $is_disable = "1" ;
				$user_name = $_POST['user_name'];
				$user_alias = $_POST['user_alias'];
				$user_password = $_POST['user_password'];
				$notes = $_POST['notes'];
				$alter_id = $_POST['alter_id'];

				if($add_submit == 1){
					$YesNo = ($Finance->AddUser($is_disable,$user_name,$user_alias,$user_password,$notes,$login_group_id))==true ? true:false;

					/*  记录日志  */
					$is_disable = $_POST['is_disable'] == "on" ?  "启用" : "禁用";
					$text_log = $YesNo ? "添加用户-成功,状态:".$is_disable."用户名: ".$user_name.",用户别名: ".$user_alias.",用户密码:".$user_password.",用户属组:".$login_groupname.",备注:".$notes : "添加用户-失败,用户名: ".$user_name.",用户别名: ".$user_alias.",用户密码:".$user_password.",用户属组:".$login_groupname.",备注:".$notes;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5030 : 1030;
				}

				if($alter_submit == 1){
					$alter_corde=$Finance->getUsers($login_user_id,1,$alter_id);

					$YesNo =($Finance->updateUser($is_disable,$user_name,$user_alias,$user_password,$notes,$alter_id))==true ? true:false;
					
					/*  记录日志  */
					$is_disable = $_POST['is_disable'] == "on" ?  "启用" : "禁用";
					$is_disable2 = $alter_corde['0']['is_disable'] == "0" ?  "启用" : "禁用";

					$text_log = $YesNo ? "修改用户-成功,原状态:".$is_disable2.",改为:".$is_disable.",原用户名: ".$alter_corde['0']['username'].",改为:".$user_name.",原用户别名:".$alter_corde['0']['user_alias'].",改为:".$user_alias.",原用户密码:".$alter_corde['0']['password'].",改为:".$user_password.",用户属组:".$login_groupname.",原备注:".$alter_corde['0']['notes']."改为:".$notes : "修改用户-失败,原状态:".$is_disable2.",改为:".$is_disable.",原用户名: ".$alter_corde['0']['username'].",改为:".$user_name.",原用户别名:".$alter_corde['0']['user_alias'].",改为:".$user_alias.",原用户密码:".$alter_corde['0']['password'].",改为:".$user_password.",用户属组:".$login_groupname.",原备注:".$alter_corde['0']['notes']."改为:".$notes;
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5031 : 1031;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getUsers($login_user_id,1,$Did);
				$YesNo =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? true:false;
					
				/*  记录日志  */
				$is_disable2 = $alter_corde['0']['is_disable'] == "0" ?  "启用" : "禁用";
				$text_log = $YesNo ? "删除用户-成功,状态:".$is_disable2."用户名: ".$alter_corde['0']['username'].",用户别名: ".$alter_corde['0']['user_alias'].",用户密码:".$alter_corde['0']['password'].",用户属组:".$login_groupname.",备注:".$alter_corde['0']['notes'] : "删除用户-失败,状态:".$is_disable2."用户名: ".$alter_corde['0']['username'].",用户别名: ".$alter_corde['0']['user_alias'].",用户密码:".$alter_corde['0']['password'].",用户属组:".$login_groupname.",备注:".$alter_corde['0']['notes'];
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5032 : 1032;
			}

			if (!(is_null($Mid)) && !(is_null($login_user_id))){
				if ($UP == 1){
					$Finance->down_up($recordtype,$login_user_id,0,$Mid,$UP);
				}else{
					$Finance->down_up($recordtype,$login_user_id,0,$Mid);
				}
			}

			if (!(is_null($Aid)) && !(is_null($login_user_id))){
				$alter_corde=$Finance->getUsers($login_user_id,1,$Aid);

				echo "状态:";
				if ($alter_corde['0']['is_disable']=="0"){
					echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_disable\" ></span>";
				}else{
					echo "<INPUT TYPE=\"checkbox\" name=\"is_disable\" ></span>";
				}
				echo "<br>";
				echo "修改用户名:&nbsp;";
				echo "<input type=\"text\" name=\"user_name\" size=\"12\" maxlength=\"20\" value=\"".$alter_corde['0']['username']."\"></span>";
				echo "<br>别名:";
				echo "<input type=\"text\" name=\"user_alias\" size=\"12\" maxlength=\"20\" value =\"".$alter_corde['0']['user_alias']."\">";
				echo "<br>密码:";
				echo "<input type=\"password\" name=\"user_password\" size=\"11\" maxlength=\"20\">";
				echo "<br>备注:";
				echo "<input type=\"text\" name=\"notes\" size=\"12\" maxlength=\"20\" value =\"".$alter_corde['0']['notes']."\">";
				echo "<br>";
				echo "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\">";
				echo "<INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ALTER."\">";
			}else{
				echo "启用:&nbsp;";
				echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_disable\" ></span>";
				echo "<BR>用户名:&nbsp;";
				echo "<input type=\"text\" name=\"user_name\" size=\"12\" maxlength=\"20\" value = \"\">";
				echo "<br>别名:";
				echo "<input type=\"text\" name=\"user_alias\" size=\"12\" maxlength=\"20\" value =\"\">";
				echo "<br>密码:";
				echo "<input type=\"password\" name=\"user_password\" size=\"11\" maxlength=\"20\">";
				echo "<br>备注:";
				echo "<input type=\"text\" name=\"notes\" size=\"12\" maxlength=\"20\" value =\"\">";
				echo "<br>";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";
			}

			$users_corde = $Finance->getUserData($login_group_id);
			
			$table_title = array("序号","状态","用户名","别名","家庭","备注","最后登录","操作");
			
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
				echo "<td>".$login_groupname."</td>";
				echo "<td>".$users_corde[$i]['notes']."</td>";
				echo "<td>".$users_corde[$i]['last_date']."</td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$users_corde[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$users_corde[$i]['id']."')\">删除</span></td>";
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
		echo "<a href=\"main.php?page=fun_manager.php&add_type=out_mantype\"><span>支出类别管理</span></a>";
		echo "<br><br>";
		echo "<a href=\"main.php?page=fun_manager.php&add_type=in_mantype\"><span>收入类别管理</span></a>";
		echo "<br><br>";
		echo "<a href=\"main.php?page=fun_manager.php&add_type=address\"><span>地址管理</span></a><br><br>";
		echo "<a href=\"main.php?page=fun_manager.php&add_type=family\"><span>家庭管理</span></a>";
	}
	if (! empty($text_log)) {
		$Finance->CrodeLog($text_log);
	}
?>
</form>
</div>

