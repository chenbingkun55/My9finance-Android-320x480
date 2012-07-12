<?PHP
/*
	添加支出表单:
*/

	if  ( $recordtype = $_GET['recordtype'] == 'out' )
	{
		echo "支出:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "支出金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"支出金额\"><br>";
		echo "支出说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"支出说明\"><br>";
	} else if ( $recordtype = $_GET['recordtype'] == 'in' ){
		echo "收入:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "收入金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"收入金额\"><br>";
		echo "收入说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"收入说明\"><br>";

	}
?>

<HL>


