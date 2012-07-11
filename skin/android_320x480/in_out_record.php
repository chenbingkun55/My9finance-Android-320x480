<div class="Content" id="Content">
<script>   
		 <?PHP $result = $Finance->listInOutCorde("_out_corde");
				foreach( $result  as  $key => $value )
				{
						echo "function formSubmit1".$key."(){\n";    
						echo "document.actionForm1".$key.".action = \"form_process.php\";\n";    
						echo "document.actionForm1".$key.".submit();\n";    
						echo "}\n";

						echo "function formSubmit2".$key."(){\n";    
						echo "document.actionForm2".$key.".action = \"form_process.php\";\n";    
						echo "document.actionForm2".$key.".submit();\n";    
						echo "}\n";
				}

				$result = $Finance->listInOutCorde("_in_corde");
				foreach( $result  as  $key => $value )
				{
						echo "function formSubmit3".$key."(){\n";    
						echo "document.actionForm3".$key.".action = \"form_process.php\";\n";    
						echo "document.actionForm3".$key.".submit();\n";    
						echo "}\n";

						echo "function formSubmit4".$key."(){\n";    
						echo "document.actionForm4".$key.".action = \"form_process.php\";\n";    
						echo "document.actionForm4".$key.".submit();\n";    
						echo "}\n";
				}
		?>
        </script>	
<?PHP 
	if ( $getrecordtype  == 1 || $_SESSION['__gettype'] == "ADDOUTCORDE")
	{
?>
		<FORM  name="outcord" action="form_process.php" method="POST" >
			<?PHP 
			echo $_OUT.": ";
					//******************提取主类信息******************
					$forum_data = $Finance->getManTypeList("_out_mantype"); 
					//print_r ($forum_data);

					//**************获取子类信息**************       
					$forum_data2 = $Finance->getSubTypeList("_out_subtype"); 
					//print_r ($forum_data2);

					?>

					<!--************ JavaScript处理province--onChange *************-->
					<script language = "JavaScript"> 
					var onecount2; 
					subcat2 = new Array(); 
					<?php 
					$num2 = count($forum_data2);
					?>
					onecount2=<?PHP echo $num2;?>;
					<?PHP
					for($j=0;$j<$num2;$j++)
					{
					?>
					subcat2[<?PHP echo $j;?>] = new Array("<?PHP echo $forum_data2[$j]['id'];?>","<?PHP echo $forum_data2[$j]['man_id'];?>","<?PHP echo $forum_data2[$j]['name'];?>");
					<?PHP }?> 
					function changelocation(id) 
					{ 
					document.outcord.out_subtype_id.length = 0; 
					var id=id; 
					var j; 
					document.outcord.out_subtype_id.options[0] = new Option('选择子类',''); 
					for (j=0;j < onecount2; j++) 
					{ 
					if (subcat2[j][1] == id) 
					   { 
					   document.outcord.out_subtype_id.options[document.outcord.out_subtype_id.length] = new Option(subcat2[j][2], subcat2[j][0]); 
					   } 
					} 
					}
					</script> 

					<!--********************页面表单*************************-->
					<select name="out_mantype_id" onChange="changelocation(document.outcord.out_mantype_id.options[document.outcord.out_mantype_id.selectedIndex].value)" size="1"> 
					<option selected>选择主类</option> 
					   
					<?php 
					$num = count($forum_data);

					for($i=0;$i<$num;$i++)
					{
					?>
					<option value="<?PHP echo $forum_data[$i]['id'];?>"><?PHP echo $forum_data[$i]['name'];?></option> 
					<?PHP 
					}
					?>
					</select>
					<select name="out_subtype_id" size="1"> 
					<option selected value="">选择子类</option> 
					</select>
			<BR>地点：
				<SELECT NAME="address_id" size="1" >
				<?PHP
					$address = $Finance->getAddressDisplay();
					foreach( $address as $key => $value )
					{
						echo "<option value=".$value['id'].">".$value['name']."</option>\n";		
					}
				?>
				</SELECT>				
				<BR>
				<?PHP $Finance->NumList(); echo $_YUAN?>
				<BR><?PHP echo $_NOTES?><BR>
				<input type="text" name="notes" size="10" maxlength="50">
				<input type="hidden" name="addoutcorde" value="ADDOUTCORDE">
				<INPUT type="submit" value="<?PHP echo $_ADD_OUT?>">
		</FORM>
		<BR>
			<TABLE border="1">
			  <tr>
				<th>序号</th>				
				<th>时间</th>
				<th>主类</th>
				<th>子类</th>
				<th>地点</th>
				<th>钱</th>
				<th>备注</th>	
				<th>操作</th>	

			  </tr>					
		<?PHP 	

				$total_money = 0;
	
				$result = $Finance->listInOutCorde("_out_corde");
				foreach( $result  as  $key => $value )
				{
						$key1 = $key;
						$time = explode(" ",$value[8]);
						$total_money = $total_money + $value[1];

						echo "<tr>";
						echo "<td>".++$key1."</td>";
						echo "<td>".$time[1]."</td>";
						echo "<td>".$Finance->convertIdToNmae("_out_mantype",$value[4])."</td>";
						echo "<td>".$Finance->convertIdToNmae("_out_subtype",$value[5])."</td>";
						echo "<td>".$Finance->convertIdToNmae("_address",$value[6])."</td>";
						echo "<td>".$value[1]."</td>";
						echo "<td>".$value[7]."</td>";
						echo "<td><FORM name=\"actionForm1".$key."\" method=\"POST\"  style=\"display: inline;\">";
						echo "<a href=\"javascript:formSubmit1".$key."()\">".$_ALTER."</a>";
						echo "<INPUT type=\"hidden\" name=\"out_corde_id\" value=".$value[0].">";
						echo "<INPUT type=\"hidden\" name=\"out_mantype_id\" value=".$value[4].">";
						echo "<INPUT type=\"hidden\" name=\"out_subtype_id\" value=".$value[5].">";
						echo "<INPUT type=\"hidden\" name=\"address_id\" value=".$value[6].">";
						echo "<INPUT type=\"hidden\" name=\"money\" value=".$value[1].">";
						echo "<INPUT type=\"hidden\" name=\"notes\" value=".$value[7].">";
						echo "<INPUT type=\"hidden\" name=\"alteroutcorde\" value=\"ALTEROUTCORDE\">";
						echo "</FORM>";
						echo "<FONT COLOR=\"#0000CC\">/</FONT>";
						echo "<FORM name=\"actionForm2".$key."\" method=\"POST\" style=\"display: inline;\">";
						echo "<a href=\"javascript:formSubmit2".$key."()\">".$_DELETE."</a>";
						echo "<INPUT type=\"hidden\" name=\"outcorde_id\" value=".$value[0].">";
						echo "<INPUT type=\"hidden\" name=\"deleteoutcorde\" value=\"DELETEOUTCORDE\">";
						echo "</FORM></td>";
						echo "</tr>";
				}
				echo "<tr><td colspan=\"5\" align='right'>当天总计：</td>";
				echo "<td colspan=\"3\">".$total_money."</td></tr>";
		?>
		</TABLE>

<?PHP
		} elseif ($getrecordtype  == 2 || $_SESSION['__gettype'] == "ADDINCORDE") {
?>
		<FORM  name="incord" action="form_process.php" method="POST" >
			<?PHP 
			echo $_IN.": ";
					//******************提取主类信息******************
					$forum_data = $Finance->getManTypeList("_in_mantype"); 
					//print_r ($forum_data);

					//**************获取子类信息**************       
					$forum_data2 = $Finance->getSubTypeList("_in_subtype"); 
					//print_r ($forum_data2);

					?>

					<!--************ JavaScript处理province--onChange *************-->
					<script language = "JavaScript"> 
					var onecount2; 
					subcat2 = new Array(); 
					<?php 
					$num2 = count($forum_data2);
					?>
					onecount2=<?PHP echo $num2;?>;
					<?PHP
					for($j=0;$j<$num2;$j++)
					{
					?>
					subcat2[<?PHP echo $j;?>] = new Array("<?PHP echo $forum_data2[$j]['id'];?>","<?PHP echo $forum_data2[$j]['man_id'];?>","<?PHP echo $forum_data2[$j]['name'];?>");
					<?PHP }?> 
					function changelocation(id) 
					{ 
					document.incord.in_subtype_id.length = 0; 
					var id=id; 
					var j; 
					document.incord.in_subtype_id.options[0] = new Option('选择子类',''); 
					for (j=0;j < onecount2; j++) 
					{ 
					if (subcat2[j][1] == id) 
					   { 
					   document.incord.in_subtype_id.options[document.incord.in_subtype_id.length] = new Option(subcat2[j][2], subcat2[j][0]); 
					   } 
					} 
					}
					</script> 

					<!--********************页面表单*************************-->
					<select name="in_mantype_id" onChange="changelocation(document.incord.in_mantype_id.options[document.incord.in_mantype_id.selectedIndex].value)" size="1"> 
					<option selected>选择主类</option> 
					   
					<?php 
					$num = count($forum_data);

					for($i=0;$i<$num;$i++)
					{
					?>
					<option value="<?PHP echo $forum_data[$i]['id'];?>"><?PHP echo $forum_data[$i]['name'];?></option> 
					<?PHP 
					}
					?>
					</select>
					<select name="in_subtype_id" size="1"> 
					<option selected value="">选择子类</option> 
					</select>
				<BR>地点：
				<SELECT NAME="address_id" size="1" >
				<?PHP
					$address = $Finance->getAddressDisplay();
					foreach( $address as $key => $value )
					{
						echo "<option value=".$value['id'].">".$value['name']."</option>\n";		
					}
				?>
				</SELECT>				
				<BR>
				<?PHP $Finance->NumList(); echo $_YUAN?>
				<BR><?PHP echo $_NOTES?><BR>
				<input type="text" name="notes" size="10" maxlength="50">
				<input type="hidden" name="addincorde" value="ADDINCORDE">
				<INPUT type="submit" value="<?PHP echo $_ADD_IN?>">
		</FORM>
		<BR>
			<TABLE border="1">
			  <tr>
				<th>序号</th>				
				<th>时间</th>
				<th>主类</th>
				<th>子类</th>
				<th>地点</th>
				<th>钱</th>
				<th>备注</th>	
				<th>操作</th>	

			  </tr>					
		<?PHP 	

				$total_money = 0;
	
				$result = $Finance->listInOutCorde("_in_corde");
				foreach( $result  as  $key => $value )
				{
						$key1 = $key;
						$time = explode(" ",$value[8]);
						$total_money = $total_money + $value[1];

						echo "<tr>";
						echo "<td>".++$key1."</td>";
						echo "<td>".$time[1]."</td>";
						echo "<td>".$Finance->convertIdToNmae("_in_mantype",$value[4])."</td>";
						echo "<td>".$Finance->convertIdToNmae("_in_subtype",$value[5])."</td>";
						echo "<td>".$Finance->convertIdToNmae("_address",$value[6])."</td>";
						echo "<td>".$value[1]."</td>";
						echo "<td>".$value[7]."</td>";
						echo "<td><FORM name=\"actionForm3".$key."\" method=\"POST\"  style=\"display: inline;\">";
						echo "<a href=\"javascript:formSubmit3".$key."()\">".$_ALTER."</a>";
						echo "<INPUT type=\"hidden\" name=\"in_corde_id\" value=".$value[0].">";
						echo "<INPUT type=\"hidden\" name=\"in_mantype_id\" value=".$value[4].">";
						echo "<INPUT type=\"hidden\" name=\"in_subtype_id\" value=".$value[5].">";
						echo "<INPUT type=\"hidden\" name=\"address_id\" value=".$value[6].">";
						echo "<INPUT type=\"hidden\" name=\"money\" value=".$value[1].">";
						echo "<INPUT type=\"hidden\" name=\"notes\" value=".$value[7].">";
						echo "<INPUT type=\"hidden\" name=\"alterincorde\" value=\"ALTERINCORDE\">";
						echo "</FORM>";
						echo "<FONT COLOR=\"#0000CC\">/</FONT>";
						echo "<FORM name=\"actionForm4".$key."\" method=\"POST\" style=\"display: inline;\">";
						echo "<a href=\"javascript:formSubmit4".$key."()\">".$_DELETE."</a>";
						echo "<INPUT type=\"hidden\" name=\"incorde_id\" value=".$value[0].">";
						echo "<INPUT type=\"hidden\" name=\"deleteincorde\" value=\"DELETEINCORDE\">";
						echo "</FORM></td>";
						echo "</tr>";
				}
				echo "<tr><td colspan=\"5\" align='right'>当天总计：</td>";
				echo "<td colspan=\"3\">".$total_money."</td></tr>";
		?>
		</TABLE>


<?PHP } ?>	
</div>