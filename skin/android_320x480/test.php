<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle1')</script>
<form class="add_form" name="add_form" action="main.php<?PHP echo "?page=record.php&add_type=".$_GET['add_type'];?>" method="post">

<?PHP 	
	$recordtype = $_GET['add_type'];
	$add_submit = $_POST['add_submit'];
	$alter_submit = $_POST['alter_submit'];
	$Aid = $_GET['Aid'];
	$Did = $_GET['Did'];


	/*
		��ӱ�:
	*/
	if  ( $recordtype == 'out_record' )
	{
		if ( $add_submit == 1 || $alter_submit == 1){
			$mantype_id = $_POST['mantype_id'];
			$subtype_id = $_POST['subtype_id'];
			$address = $_POST['address'];
			$money = $_POST['money'];
			$notes = $_POST['notes'];
			$alter_id = $_POST['alter_id'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submitֵΪ��".$_POST['add_submit']."<br>";
				echo "mantype_idֵΪ��".$_POST['mantype_id']."<br>";
				echo "subtype_idֵΪ��".$_POST['subtype_id']."<br>";
				echo "addressֵΪ��".$_POST['address']."<br>";
				echo "moneyֵΪ��".$_POST['money']."<br>";
				echo "notesֵΪ��".$_POST['notes']."<br>";
				echo "alter_idֵΪ��".$alter_id."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($add_submit == 1){
				$YesNo = ($Finance->addCordeData($recordtype,$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? true:false;
				
				/*  ��¼��־   */
				$text_log = $YesNo ? "���֧��-�ɹ�,���:".$money." ֧������: ".$Finance->convertID($mantype_id,"out_mantype")." ֧������: ".$Finance->convertID($subtype_id,"out_subtype")." ��ַ:".$Finance->convertID($address,"address")." ��ע:".$notes : "���֧��-ʧ��,���:".$money." ֧������: ".$Finance->convertID($mantype_id,"out_mantype")." ֧������: ".$Finance->convertID($subtype_id,"out_subtype")." ��ַ:".$Finance->convertID($address,"address")." ��ע:".$notes;
				/*  ��Ϣ����  */
				$_SESSION['__global_logid'] = $YesNo ?  5010 : 1010;  
			}
			if($alter_submit == 1){
				$YesNo =($Finance->updateCordeData($recordtype,$alter_id,$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? true:false;
				
				/*  ��¼��־   */
				$text_log = $YesNo ?  "�޸�֧��-�ɹ�,���:".$money." ֧������: ".$Finance->convertID($mantype_id,"out_mantype")." ֧������: ".$Finance->convertID($subtype_id,"out_subtype")." ��ַ:".$Finance->convertID($address,"address")." ��ע:".$notes : "���֧��-ʧ��,���:".$money." ֧������: ".$Finance->convertID($mantype_id,"out_mantype")." ֧������: ".$Finance->convertID($subtype_id,"out_subtype")." ��ַ:".$Finance->convertID($address,"address")." ��ע:".$notes;
				/*  ��Ϣ����  */
				$_SESSION['__global_logid']= $YesNo ?  5012:1012;  
			}
		}

		if (!(is_null($Did)) && !(is_null($login_user_id))){
			$Did_data = $Finance->getCordeData($login_group_id,"out_record","",0,$Did);
			$YesNo = ($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? true:false;
				
			/*  ��¼��־   */
			$text_log = $YesNo ? "ɾ��֧��-�ɹ�,���:".$Did_data['0']['money']." ֧������: ".$Finance->convertID($Did_data['0']['mantype_id'],"out_mantype")." ֧������: ".$Finance->convertID($Did_data['0']['subtype_id'],"out_subtype")." ��ַ:".$Finance->convertID($Did_data['0']['addr_id'],"address")." ��ע:".$Did_data['0']['notes'] : "ɾ��֧��-ʧ��,���:".$Did_data['0']['money']." ֧������: ".$Finance->convertID($Did_data['0']['mantype_id'],"out_mantype")." ֧������: ".$Finance->convertID($Did_data['0']['subtype_id'],"out_subtype")." ��ַ:".$Finance->convertID($Did_data['0']['addr_id'],"address")." ��ע:".$Did_data['0']['notes'];
			/*  ��Ϣ����  */
			$_SESSION['__global_logid'] = $YesNo ?  5014 : 1014; 
		}

		echo "֧��:&nbsp;";
		if (!(is_null($Aid)) && !(is_null($login_user_id))){
			$Finance->select_type($login_user_id,$recordtype,$Aid);
		}else{
			$Finance->select_type($login_user_id,$recordtype);
		}
		
		$today_corde = $Finance->getCordeData($login_group_id,$recordtype,date("Y-m-d"));
		$table_title = array("���","ʱ��","�û�","��ͥ","����","����","���","��ַ","��ע","����");
		
		echo "<table>";		
		echo "<tr class='ContentTdColor'>";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="ContentTdColor1";
		$today_money = 0;
		for ($i=0;$i<count($today_corde);$i++){
			$today_money = ($today_money + $today_corde[$i]['money']);
			echo "<tr class='".$c."'>";
			echo "<td>".($i+1)."</td>";
			echo "<td><script>PrintCreateDateShort('".$today_corde[$i]['create_date']."')</script></td>";

			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],"users")."</td>";
			echo "<td>".$login_group_alias."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['mantype_id'],"out_mantype")."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['subtype_id'],"out_subtype")."</td>";
			echo "<td>".$today_corde[$i]['money']."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['addr_id'],"address")."</td>";
			echo "<td>".$today_corde[$i]['notes']."</td>";
			echo "<td><span class=\"click\" onClick=\"Alter('".$today_corde[$i]['id']."')\">�޸�</span>|<span class=\"click\" onClick=\"Del('".$today_corde[$i]['id']."')\">ɾ��</span></td>";
			echo "</tr>";
			$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
		}
		echo "<tr class='ContentTdColor'><td colspan=\"6\" align=\"right\">�����ܼƣ�</td><td colspan=\"4\">".$today_money."Ԫ</td></tr>";
		echo "</table>";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($today_corde);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}

	} else if ( $recordtype == 'in_record' ){
		if ( $add_submit == 1 || $alter_submit == 1){
			$mantype_id = $_POST['mantype_id'];
			$subtype_id = $_POST['subtype_id'];
			$address = $_POST['address'];
			$money = $_POST['money'];
			$notes = $_POST['notes'];
			$alter_id = $_POST['alter_id'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submitֵΪ��".$_POST['add_submit']."<br>";
				echo "mantype_idֵΪ��".$_POST['mantype_id']."<br>";
				echo "subtype_idֵΪ��".$_POST['subtype_id']."<br>";
				echo "addressֵΪ��".$_POST['address']."<br>";
				echo "moneyֵΪ��".$_POST['money']."<br>";
				echo "notesֵΪ��".$_POST['notes']."<br>";
				echo "alter_idֵΪ��".$alter_id."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($add_submit == 1){
				$YesNo = ($Finance->addCordeData($recordtype,$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? true:false;
				
				/*  ��¼��־   */
				$text_log = $YesNo ?  "�������-�ɹ�,���:".$money." ��������: ".$Finance->convertID($mantype_id,"in_mantype")." ��������: ".$Finance->convertID($subtype_id,"in_subtype")." ��ַ:".$Finance->convertID($address,"address")." ��ע:".$notes : "�������-ʧ��,���:".$money." ��������: ".$Finance->convertID($mantype_id,"in_mantype")." ��������: ".$Finance->convertID($subtype_id,"in_subtype")." ��ַ:".$Finance->convertID($address,"address")." ��ע:".$notes;
				/*  ��Ϣ����  */
				$_SESSION['__global_logid'] = $YesNo ? 5011 : 1011;  
			}
			if($alter_submit == 1){
				$YesNo =($Finance->updateCordeData($recordtype,$alter_id,$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? true:false;

				/*  ��¼��־   */
				$text_log = $YesNo ?  "�޸�����-�ɹ�,���:".$money." ��������: ".$Finance->convertID($mantype_id,"in_mantype")." ��������: ".$Finance->convertID($subtype_id,"in_subtype")." ��ַ:".$Finance->convertID($address,"address")." ��ע:".$notes : "�������-ʧ��,���:".$money." ��������: ".$Finance->convertID($mantype_id,"in_mantype")." ��������: ".$Finance->convertID($subtype_id,"in_subtype")." ��ַ:".$Finance->convertID($address,"address")." ��ע:".$notes;
				/*  ��Ϣ����  */
				$_SESSION['__global_logid']= $YesNo ?  5013:1013;  

			}
		}

		if (!(is_null($Did)) && !(is_null($login_user_id))){
			$Did_data = $Finance->getCordeData($login_group_id,"in_record","",0,$Did);
			$YesNo = ($Finance->delCorde($recordtype,$login_user_id,$Did))==true ? true:false;

			/*  ��¼��־   */
			$text_log = $YesNo ? "ɾ������-�ɹ�,���:".$Did_data['0']['money']." ��������: ".$Finance->convertID($Did_data['0']['mantype_id'],"in_mantype")." ��������: ".$Finance->convertID($Did_data['0']['subtype_id'],"in_subtype")." ��ַ:".$Finance->convertID($Did_data['0']['addr_id'],"address")." ��ע:".$Did_data['0']['notes'] : "ɾ������-ʧ��,���:".$Did_data['0']['money']." ��������: ".$Finance->convertID($Did_data['0']['mantype_id'],"in_mantype")." ��������: ".$Finance->convertID($Did_data['0']['subtype_id'],"in_subtype")." ��ַ:".$Finance->convertID($Did_data['0']['addr_id'],"address")." ��ע:".$Did_data['0']['notes'];
			/*  ��Ϣ����  */
			$_SESSION['__global_logid'] = $YesNo ?  5015 : 1015;
		}

		echo "����:&nbsp;";
		if (!(is_null($Aid)) && !(is_null($login_user_id))){
			$Finance->select_type($login_user_id,$recordtype,$Aid);
		}else{
			$Finance->select_type($login_user_id,$recordtype);
		}
		
		$today_corde = $Finance->getCordeData($login_group_id,$recordtype,date("Y-m-d"));
		$table_title = array("���","ʱ��","�û�","��ͥ","����","����","���","��ַ","��ע","����");
		
		echo "<table>";		
		echo "<tr class='ContentTdColor'>";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="ContentTdColor1";
		$today_money = 0;
		for ($i=0;$i<count($today_corde);$i++){
			$today_money = ($today_money + $today_corde[$i]['money']);
			echo "<tr class='".$c."'>";
			echo "<td>".($i+1)."</td>";
			echo "<td><script>PrintCreateDateShort('".$today_corde[$i]['create_date']."')</script></td>";

			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],"users")."</td>";
			echo "<td>".$login_group_alias."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['mantype_id'],"in_mantype")."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['subtype_id'],"in_subtype")."</td>";
			echo "<td>".$today_corde[$i]['money']."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['addr_id'],"address")."</td>";
			echo "<td>".$today_corde[$i]['notes']."</td>";
			echo "<td><span class=\"click\" onClick=\"Alter('".$today_corde[$i]['id']."')\">�޸�</span>|<span class=\"click\" onClick=\"Del('".$today_corde[$i]['id']."')\">ɾ��</span></td>";
			echo "</tr>";
			$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
		}
		echo "<tr class='ContentTdColor'><td colspan=\"6\" align=\"right\">�����ܼƣ�</td><td colspan=\"4\">".$today_money."Ԫ</td></tr>";
		echo "</table>";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($today_corde);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}
	}else{
		echo "<a href=\"main.php?page=record.php&add_type=out_record\">֧����¼</a><br><br>";
		echo "<a href=\"main.php?page=record.php&add_type=in_record\">�����¼</a><br><br>";
		echo "<a href=\"main.php?page=fun_manager.php\"><span>���ܹ���</span></a><br><br>";
		echo "<a href=\"main.php?page=report.php\">����</a><br><br>";
		echo "<a href=\"main.php?page=search.php\">����</a><br><br>";
		echo "<a href=\"main.php?page=about.php\">����</a>";
	}

	/*  ��¼Log  */
	if (! empty($text_log)) {
		$Finance->CrodeLog($text_log);
	}
?>
</form>
</div>

