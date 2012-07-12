<?PHP
/*
	添加表单:
*/

	if  ( $recordtype = $_GET['add_type'] == 'out_record' )
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
	} else if ( $recordtype = $_GET['add_type'] == 'in_record' ){
		echo "收入:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "收入金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"收入金额\"><br>";
		echo "收入说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"收入说明\"><br>";

	} else if ( $recordtype = $_GET['add_type'] == 'out_record_type' ){

		echo "添加支出主类:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加支出主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加支出主类金额\"><br>";
		echo "添加支出主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加支出主类说明\"><br>";
	} else if ( $recordtype = $_GET['add_type'] == 'in_record_type' ){
		echo "添加收入主类:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加收入主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类金额\"><br>";
		echo "添加收入主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类说明\"><br>";

	} else if ( $recordtype = $_GET['add_type'] == 'address' ){
		echo "添加地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加收入主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类金额\"><br>";
		echo "添加收入主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类说明\"><br>";
	} else if ( $recordtype = $_GET['add_type'] == 'user' ){
		echo "添加地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加收入主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类金额\"><br>";
		echo "添加收入主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类说明\"><br>";
	} else if ( $recordtype = $_GET['add_type'] == 'family' ){
		echo "添加地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加收入主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类金额\"><br>";
		echo "添加收入主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类说明\"><br>";

	}

?>

<HL>


