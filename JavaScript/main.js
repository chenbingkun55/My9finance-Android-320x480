var CurrentFunTitleColor = "#c7edcc";
var SubType=new Array();

/*
  JavaScript 更改鼠标经过标题栏时,动态变化.
	OverFunTitleColor()  鼠标进入标题栏.
	OutFunTitleColor()	 鼠标移出标题栏.
	ChangFunTitle()		 鼠标点击标题栏.
*/

function OverFunTitleColor(obj) { 
	var FunTitleColor = document.getElementById(obj);
	/* 字体动态 */
	FunTitleColor.style.Color="#6699FF";
	FunTitleColor.style.fontSize="12pt";
	
	/* 背景动态
	if (FunTitleColor.style.backgroundColor != "#c7edcc")
	{
		FunTitleColor.style.backgroundColor = "#c7edcd";
	}*/
}

function OutFunTitleColor(obj) { 
	var FunTitleColor = document.getElementById(obj);

	/* 字体动态 */
	FunTitleColor.style.fontSize="";
	FunTitleColor.style.Color="";


	/* 背景动态
	if (FunTitleColor.style.backgroundColor == "#c7edcd")
	{
		FunTitleColor.style.backgroundColor = "";
	}*/
}

/*
	定义各功能内容数组.
*/
var bodyHTML = new Array(5);
bodyHTML['FunTitle1'] = "<a href=\"main.php?page=add_record.php&add_type=out_record\">支出记录</a>&nbsp;&nbsp;&nbsp;\|&nbsp;&nbsp;\
	<a href=\"main.php?page=add_record.php&add_type=in_record\">收入记录</a><br><br>\
	<a href=\"main.php?page=fun_manager.php\"><span>功能管理</span></a><br><br>\
	<span class=\"BodyLink1\" onclick=\"ChangFunTitle('FunTitle3')\">报表</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"ChangFunTitle('FunTitle4')\">搜索</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"ChangFunTitle('FunTitle5')\">关于</span>";
bodyHTML['FunTitle2'] = "<br><a href=\"main.php?page=fun_manager.php&add_type=in_mantype\"><span>收入类别管理</span></a><br><br>\
	<a href=\"main.php?page=fun_manager.php&add_type=out_mantype\"><span>支出类别管理</span></a><br><br>\
	<a href=\"main.php?page=fun_manager.php&add_type=address\"><span>地址管理</span></a><br><br>\
	<a href=\"main.php?page=fun_manager.php&add_type=family\"><span>家庭管理</span></a>";
bodyHTML['FunTitle3'] = "<br><span class=\"BodyLink1\" onclick=\"record('in')\">每月支出报表</span><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">每年支出报表</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">每月收入报表</span><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\"> 每年收入报表</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">收支平衡报表</span><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">支出分类报表</span><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">支出地点报表</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">每年支出分类报表</span><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">每年支出地址报表</span><br><br>";
bodyHTML['FunTitle4'] = "搜索整个家庭：";
bodyHTML['FunTitle5'] = "一个简单在线个人收支管理系统,<br>工作之余所出作品,<br>&nbsp;\
	但愿能给大家生活上带来便利.<br><br>\
	出品: @-ChenBK<br>制作时间: 2012-07-11<br>E-mail :\
	<a href=\"mailto:chenbingkun55@163.com\">ChenBingKun55@163.com</a>";

function ChangFunTitle(obj){
	var FunTitleColor = document.getElementById(obj);
	var Content = document.getElementById('Content');
	
	document.getElementById('FunTitle1').style.backgroundColor = "";
	document.getElementById('FunTitle2').style.backgroundColor = "";
	document.getElementById('FunTitle3').style.backgroundColor = "";
	document.getElementById('FunTitle4').style.backgroundColor = "";
	document.getElementById('FunTitle5').style.backgroundColor = "";

	FunTitleColor.style.backgroundColor = CurrentFunTitleColor;
	
	Content.innerHTML = bodyHTML[obj];
}

/*
  鼠标经过标题图片时启用,放大缩小功能.
	OverTitleIMG()	鼠标进入显示大图.
	OutTitleIMG()	鼠标移出显示小图.
*/

function OverTitleIMG(){
	var TitleIMG=document.getElementById("TitleIMG");
	TitleIMG.src="../../images/logo_max_color.gif";
}


function OutTitleIMG(){
	var TitleIMG=document.getElementById("TitleIMG");
	TitleIMG.src="../../images/logo_color.gif";
}


function ChangeSkinColor(obj){
	switch (obj)
	{
	case "Skin-1":
		document.getElementById("BodyDiv").style.backgroundColor = "#66CC00";
		document.getElementById("Content").style.backgroundColor = "#C7EDCC";
		CurrentFunTitleColor = "#C7EDCC";
		break;

	case "Skin-2":
		document.getElementById("BodyDiv").style.backgroundColor = "#9900FF";
		document.getElementById("Content").style.backgroundColor = "#CC66FF";
		CurrentFunTitleColor = "#CC66FF";
		break;

	case "Skin-3":
		document.getElementById("BodyDiv").style.backgroundColor = "#FF6600";
		document.getElementById("Content").style.backgroundColor = "#FF6666";
		CurrentFunTitleColor = "#FF6666";
		break;

	case "Skin-4":
		document.getElementById("BodyDiv").style.backgroundColor = "#CCFF33";
		document.getElementById("Content").style.backgroundColor = "#CCFF99";
		CurrentFunTitleColor = "#CCFF99";
		break;

	case "Skin-5":
		document.getElementById("BodyDiv").style.backgroundColor = "#336633";
		document.getElementById("Content").style.backgroundColor = "#339900";
		CurrentFunTitleColor = "#339900";
		break;
	}
}

/*
	创建 XMLHTTPRequest 
*/
function createHttPRequext(){
	if(window.ActiveXObject){
		xmlBody = new ActiveXObject('Microsoft.XMLHTTP');	
	}
	else if (window.XMLHTTPRequest)
	{
		xmlBody = new XMLHTTPRequest();
	}

}

function post(xmlBodyURL){
	createHttPRequext();
	xmlBody.Open( "post",xmlBodyURL,false );
	xmlBody.onreadystatechange = HandleStateChange;
	xmlBody.Send(xmlBodyURL);
}

function HandleStateChange(){
	var Content = document.getElementById('Content');
	if (xmlBody.readyState == 4 )
	{
		var GetbodyHTML = xmlBody.responseText;
		Content.innerHTML = GetbodyHTML;
	}
}

function PostErrorInfo(GlobalError,type){
	var ErrorInfo = document.getElementById('ErrorInfo');
	if (GlobalError)
	{
		if (type == '1')
		{
			ErrorInfo.innerHTML = "<b>"+GlobalError+"</b>";
			ErrorInfo.style.Color = "#FF0000";
		}
		ErrorInfo.innerHTML = GlobalError;
	} else {
		ErrorInfo.innerHTML = "彩贝壳之家 -- 欢迎您!!!";
	}
}


function logout(){
	top.location='logout.php';
}

function check(){
	var loginform = document.getElementById('login-form');
	var info="";
	var stats=true;

	/* match  以非空字符开始,中间不允许有空格,至少有个字符. */
	if(!loginform.username.value.match(/^\S+$/)){
		info+="用户名不能使用空格或为空!\n";
		stats = false;
	} else if ( loginform.username.value.length >= 15){
		info+="用户名不能超过15个字符!\n";
		stats = false;
	}

	if (loginform.password.value == ""){
		info+="用户密码不能为空!\n";
		stats = false;
	}
	if(!stats){
		alert(info);
	}
	return stats;
}


function sSubType(id){
	var sobj=document.getElementById("subtype_id");
	sobj.innerHTML="";
	if ( id >=0 ){
		var option=document.createElement("option");
		var text="--选择子类--";
		option.value=text;
		option.innerHTML=text;
		sobj.appendChild(option);
		for (var i=0; i<SubType.length ; i++ ){
			if (SubType[i][1] == id )
			{
				var option=document.createElement("option");
				option.value=SubType[i][0];
				option.innerHTML=SubType[i][2];
				sobj.appendChild(option);
			}
		}
	}
}

function PrintDate(){
	var date=new Date();
	var DateTimePlane=document.getElementById("DateTimePlane");
	var week = date.getDay();
	var text="";
	switch (week)
	{
		case 0:
			week="星期天";
			break;
		case 1:
			week="星期一";
			break;
		case 2:
			week="星期二";
			break;
		case 3:
			week="星期三";
			break;
		case 4:
			week="星期四";
			break;
		case 5:
			week="星期五";
			break;
		case 6:
			week="星期六";
			break;
	}

	if (date.getHours()<10){
		var Hours = "0"+date.getHours();
	} else {
		Hours = date.getHours()
	}
	if (date.getMinutes()<10){
		var Minutes = "0"+date.getMinutes();
	}else{
		Minutes = date.getMinutes()
	}

	text = date.getFullYear()+'.'+(date.getMonth() + 1)+'.'+date.getDate();
	text += '<br>'+week;
	text += '<br>'+Hours+':'+Minutes;

	DateTimePlane.innerHTML=text;
}


function PrintCreateDateShort(str){
	ss = str.split(" ");
	document.write(ss[1]);
}
