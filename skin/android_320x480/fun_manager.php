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
				if($add_submit == 1){
					$mantype = $_POST['mantype'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;
					$str = ($Finance->addTypeData($recordtype,$login_user_id,$mantype,$is_display,0))==true ? "成功<br>":"失败<br>";
						echo $str;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$mantype = $_POST['mantype'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;

					$str =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$mantype,$is_display))==true ? "成功<br>":"失败<br>";
					echo $str;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$str =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? "成功<br>":"失败<br>";
				echo $str;
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
				if($add_submit == 1){
					$subtype = $_POST['subtype'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;
					$str = ($Finance->addTypeData($recordtype,$login_user_id,$subtype,$is_display,$Lid))==true ? "成功<br>":"失败<br>";
						echo $str;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$man_id = $_POST['man_id'];
					$subtype = $_POST['subtype'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;

					$str =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$subtype,$is_display,$man_id))==true ? "成功<br>":"失败<br>";
					echo $str;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$str =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? "成功<br>":"失败<br>";
				echo $str;
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
				if($add_submit == 1){
					$mantype = $_POST['mantype'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;
					$str = ($Finance->addTypeData($recordtype,$login_user_id,$mantype,$is_display,0))==true ? "成功<br>":"失败<br>";
						echo $str;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$mantype = $_POST['mantype'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;

					$str =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$mantype,$is_display))==true ? "成功<br>":"失败<br>";
					echo $str;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$str =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? "成功<br>":"失败<br>";
				echo $str;
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
				if($add_submit == 1){
					$subtype = $_POST['subtype'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;
					$str = ($Finance->addTypeData($recordtype,$login_user_id,$subtype,$is_display,$Lid))==true ? "成功<br>":"失败<br>";
						echo $str;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$man_id = $_POST['man_id'];
					$subtype = $_POST['subtype'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;

					$str =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$subtype,$is_display,$man_id))==true ? "成功<br>":"失败<br>";
					echo $str;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$str =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? "成功<br>":"失败<br>";
				echo $str;
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
				if($add_submit == 1){
					$address = $_POST['address'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;
					$str = ($Finance->addTypeData($recordtype,$login_user_id,$address,1,0))==true ? "成功<br>":"失败<br>";
						echo $str;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$address = $_POST['address'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;

					$str =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$address,$is_display))==true ? "成功<br>":"失败<br>";
					echo $str;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$str =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? "成功<br>":"失败<br>";
				echo $str;
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
					echo "add_submit值为：".$_POST['add_submit']."<br>";
					echo "mantype值为：".$_POST['mantype']."<br>";
					echo "is_display值为：".$_POST['is_display']."<br>";
					echo "<br>DEBUG END*********************************************<br>";	
				}
				if($add_submit == 1){
					$user_name = $_POST['user_name'];
					$user_alias = $_POST['user_alias'];
					$user_password = $_POST['user_password'];
					$notes = $_POST['notes'];
					$str = ($Finance->AddUser($user_name,$user_alias,$user_password,$notes,$login_group_id))==true ? "成功<br>":"失败<br>";
						echo $str;
				}

				if($alter_submit == 1){
					$alter_id = $_POST['alter_id'];
					$mantype = $_POST['mantype'];
					$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;

					$str =($Finance->updateTypeData($recordtype,$login_user_id,$alter_id,$mantype,$is_display))==true ? "成功<br>":"失败<br>";
					echo $str;
				}
			}

			if (!(is_null($Did)) && !(is_null($login_user_id))){
				$str =($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? "成功<br>":"失败<br>";
				echo $str;
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
				if ($alter_corde['0']['is_display']=="1"){
					echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
				}else{
					echo "<INPUT TYPE=\"checkbox\" name=\"is_display\" ></span>";
				}
				echo "<br>";
				echo "修改用户名:&nbsp;";
				echo "<input type=\"text\" name=\"user_name\" size=\"12\" maxlength=\"20\" value=\"".$alter_corde['0']['username']."\"></span>";
				echo "<br>别名:";
				echo "<input type=\"text\" name=\"user_alias\" size=\"12\" maxlength=\"20\" value =\"".$alter_corde['0']['user_alias']."\">";
				echo "<br>密码:";
				echo "<input type=\"password\" name=\"user_password\" size=\"11\" maxlength=\"20\">";
				echo "<br>备注:";
				echo "<input type=\"text\" name=\"notes\" size=\"12\" maxlength=\"20\" value =\"\">";
				echo "<br>";
				echo "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\">";
				echo "<INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\">";
				echo "<INPUT  TYPE=\"submit\" value=\"".$_ALTER."\">";
			}else{
				echo "用户名:&nbsp;";
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
			for ($i=0;$i<count($users);$i++){
				echo "<tr class=\"".$c."\">";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$YesNo=$users_corde[$i]['is_display']? "启用":"禁用"."</td>";
				echo "<td>".$users_corde[$i]['username']."</td>";
				echo "<td>".$users_corde[$i]['user_alias']."</td>";
				echo "<td>".$login_groupname."</td>";
				echo "<td>".$users[$i]['notes']."</td>";
				echo "<td>".$users[$i]['last_date']."</td>";
				echo "<td><span class=\"click\" onClick=\"Alter('".$type_corde[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$type_corde[$i]['id']."')\">删除</span></td>";
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
	default:
		echo "<a href=\"main.php?page=fun_manager.php&add_type=out_mantype\"><span>支出类别管理</span></a>";
		echo "<br><br>";
		echo "<a href=\"main.php?page=fun_manager.php&add_type=in_mantype\"><span>收入类别管理</span></a>";
		echo "<br><br>";
		echo "<a href=\"main.php?page=fun_manager.php&add_type=address\"><span>地址管理</span></a><br><br>";
		echo "<a href=\"main.php?page=fun_manager.php&add_type=family\"><span>家庭管理</span></a>";
	}
?>
</form>
</div>

