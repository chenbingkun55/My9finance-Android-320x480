var CurrentFunTitleColor = "#c7edcc";

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
bodyHTML['FunTitle1'] = "<br><span class=\"BodyLink1\" onclick=\"post('in_out_record.php')\">支出记录</span>&nbsp;&nbsp;&nbsp;\|&nbsp;&nbsp;\
	<span class=\"BodyLink1\" onclick=\"record('in')\">收入记录</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"ChangFunTitle('FunTitle2')\">功能管理</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"ChangFunTitle('FunTitle3')\">报表</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"ChangFunTitle('FunTitle4')\">搜索</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"ChangFunTitle('FunTitle5')\">关于</span>";
bodyHTML['FunTitle2'] = "<br><span class=\"BodyLink1\" onclick=\"record('in')\">收入主类别</span>&nbsp;&nbsp;&nbsp;\|&nbsp;&nbsp;\
	<span class=\"BodyLink1\" onclick=\"record('in')\">支出主类别</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">列出地址</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">修改用户</span><br><br>\
	<span class=\"BodyLink1\" onclick=\"record('in')\">列出家庭成员</span>";
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
	case "theme-1":
		document.getElementById("BodyDiv").style.backgroundColor = "#66CC00";
		document.getElementById("Content").style.backgroundColor = "#C7EDCC";
		CurrentFunTitleColor = "#C7EDCC";
		break;

	case "theme-2":
		document.getElementById("BodyDiv").style.backgroundColor = "#9900FF";
		document.getElementById("Content").style.backgroundColor = "#CC66FF";
		CurrentFunTitleColor = "#CC66FF";
		break;

	case "theme-3":
		document.getElementById("BodyDiv").style.backgroundColor = "#FF6600";
		document.getElementById("Content").style.backgroundColor = "#FF6666";
		CurrentFunTitleColor = "#FF6666";
		break;

	case "theme-4":
		document.getElementById("BodyDiv").style.backgroundColor = "#CCFF33";
		document.getElementById("Content").style.backgroundColor = "#CCFF99";
		CurrentFunTitleColor = "#CCFF99";
		break;

	case "theme-5":
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

function writeObj(obj){
	for(i=0;i< 20 ; i++){    
		alert(boj[i]+"<br>");
	}  
}

function HandleStateChange(){
	var Content = document.getElementById('Content');
	if (xmlBody.readyState == 4 )
	{
		var GetbodyHTML = xmlBody.responseText;
		Content.innerHTML = GetbodyHTML;
	}
}

