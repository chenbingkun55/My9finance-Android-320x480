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
	FunTitleColor.style.Color="#FFFF99";
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

function GetCurrentStyle (obj, prop) {      
    if (obj.currentStyle) {         
        return obj.currentStyle[prop];      
    }       
    else if (window.getComputedStyle) {         
        propprop = prop.replace (/([A-Z])/g, "-$1");            
        propprop = prop.toLowerCase ();         
        return document.defaultView.getComputedStyle (obj,null)[prop];      
    }       
    return null;    
}    


function ChangFunTitle(obj){
	var FunTitle = document.getElementById(obj);
	var Content = document.getElementById('Content');

	document.getElementById('FunTitle1').style.backgroundColor = "";
	document.getElementById('FunTitle2').style.backgroundColor = "";
	document.getElementById('FunTitle3').style.backgroundColor = "";
	document.getElementById('FunTitle4').style.backgroundColor = "";
	document.getElementById('FunTitle5').style.backgroundColor = "";

	FunTitle.style.backgroundColor=GetCurrentStyle(Content,"backgroundColor");
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
	case "Skin1":
		document.getElementById("BodyDiv").style.backgroundColor = "#66CC00";
		document.getElementById("Content").style.backgroundColor = "#C7EDCC";
		CurrentFunTitleColor = "#C7EDCC";
		break;

	case "Skin2":
		document.getElementById("BodyDiv").style.backgroundColor = "#9900FF";
		document.getElementById("Content").style.backgroundColor = "#CC66FF";
		CurrentFunTitleColor = "#CC66FF";
		break;

	case "Skin3":
		document.getElementById("BodyDiv").style.backgroundColor = "#FF6600";
		document.getElementById("Content").style.backgroundColor = "#FF6666";
		CurrentFunTitleColor = "#FF6666";
		break;

	case "Skin4":
		document.getElementById("BodyDiv").style.backgroundColor = "#CCFF33";
		document.getElementById("Content").style.backgroundColor = "#CCFF99";
		CurrentFunTitleColor = "#CCFF99";
		break;

	case "Skin5":
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


function sSubType(sid){
	with(document.add_form.mantype_id) { var sub = options[selectedIndex].value; }
	var sobj=document.getElementById("subtype_id");
	sobj.innerHTML="";

	if ( sub >=0 ){
		var option=document.createElement("option");
		var text="--选择子类--";
		option.value=text;
		option.innerHTML=text;
		sobj.appendChild(option);
		for (var i=0; i<SubType.length ; i++ ){
			if (SubType[i][1] == sub )
			{
				
				if (SubType[i][0] == sid){
					document.getElementById("subtype_id").options.add(new Option(SubType[i][2],SubType[i][0],true));
				}else{
					document.getElementById("subtype_id").options.add(new Option(SubType[i][2],SubType[i][0]));
				}
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

/* 获取路径变量,来自网络第三方: http://www.cnblogs.com/sohighthesky/archive/2010/01/21/script-querystring.html */
var queryStrings=function() {//get url querystring
    var params=document.location.search,reg=/(?:^\?|&)(.*?)=(.*?)(?=&|$)/g,temp,args={};
    while((temp=reg.exec(params))!=null) args[temp[1]]=decodeURIComponent(temp[2]);
    return args;
}

function Alter(ID){
	var args=queryStrings();
	window.location.replace('main.php?page='+args.page+'&add_type='+args.add_type+'&Aid='+ID);
}

function Del(ID){
	var args=queryStrings();
	window.location.replace('main.php?page='+args.page+'&add_type='+args.add_type+'&Did='+ID);
}
