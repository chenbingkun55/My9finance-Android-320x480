var SubType=new Array();
/*
  鼠标经过标题图片时启用,放大缩小功能.
	OverTitleIMG()	鼠标进入显示大图.
	OutTitleIMG()	鼠标移出显示小图.
*/

function OverTitleIMG(){
	document.getElementById('TitleIMG').src ="../../images/logo_max_color.gif"
}


function OutTitleIMG(){
	document.getElementById('TitleIMG').src ="../../images/logo_color.gif"
}

/*
  JavaScript 更改鼠标经过标题栏时,动态变化.
	OverFunTitleColor()  鼠标进入标题栏.
	OutFunTitleColor()	 鼠标移出标题栏.
	ChangFunTitle()		 鼠标点击标题栏.
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


function OverFunTitleColor(obj) { 
	var FunTitleColor = document.getElementById(obj);
	/* 字体动态 */
	FunTitleColor.style.Color=GetCurrentStyle(Content,"backgroundColor");
	FunTitleColor.style.fontSize="8pt";
	
	/* 背景动态
	if (FunTitleColor.style.backgroundColor != "#c7edcc")
	{
		FunTitleColor.style.backgroundColor = "#c7edcd";
	}*/
}

/*
	定义各功能内容数组.
*/




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


function ChangeSkinColor(obj){
	var skin;
	switch (obj)
	{
	case "Skin1":
		document.getElementById("BodyDiv").style.backgroundColor = "#66CC00";
		document.getElementById("Content").style.backgroundColor = "#C7EDCC";
		skin = 1;
		break;

	case "Skin2":
		document.getElementById("BodyDiv").style.backgroundColor = "#6633CC";
		document.getElementById("Content").style.backgroundColor = "#00CCCC";
		skin = 2;
		break;

	case "Skin3":
		document.getElementById("BodyDiv").style.backgroundColor = "#FF9900";
		document.getElementById("Content").style.backgroundColor = "#FFCCCC";
		skin = 3;
		break;

	case "Skin4":
		document.getElementById("BodyDiv").style.backgroundColor = "#FFFF66";
		document.getElementById("Content").style.backgroundColor = "#33FFFF";
		skin = 4;
		break;

	case "Skin5":
		document.getElementById("BodyDiv").style.backgroundColor = "#000000";
		document.getElementById("Content").style.backgroundColor = "#C0C0C0";
		skin = 5;
		break;
	}

	var ChangeSkinPlane=document.getElementById("ChangeSkinPlane");
	var NewDiv = document.createElement("div");
	NewDiv.id = "ChangeSkinPlaneYes";
	NewDiv.className = "ChangeSkinPlaneYes";
	NewDiv.style.fontSize="11px";
	NewDiv.style.textAlign = "center";
	NewDiv.innerHTML="需要更新皮肤吗?<BR><span style=\"cursor: pointer;\" OnClick=\"SkinSelect("+skin+")\">确定</span>&nbsp;&nbsp;&nbsp;<span style=\"cursor: pointer;\" OnClick=\"SkinSelect()\">取消</span>";
	ChangeSkinPlane.parentNode.appendChild(NewDiv);  
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

function PostMessage(TXT){
	var MainMessage = document.getElementById('MainMessage');
	if (TXT){
		MainMessage.innerHTML="<BLINK>"+TXT+"</BLINK>";
		setInterval("PostMessage()",15000);
	} else {
		MainMessage.innerHTML="<BLINK style=\"font-size: 16px;\">彩贝壳之家 -- 欢迎您!!!</BLINK>";
	}
	
}


function logout(){
	top.location='logout.php';
}

function SelectType(sid){
	var in_out=document.getElementById("scorde").options[window.document.getElementById("scorde").selectedIndex].value;
	window.location.replace('main.php?page=search.php&scorde='+in_out+'');
}

function DisableStype(sid){
	var in_out=document.getElementById("scorde").options[window.document.getElementById("scorde").selectedIndex].value;
	if ( in_out == "in_out" )
	{
		document.getElementById("stype").disabled=true;
	} else {
		document.getElementById("stype").disabled=false;
	}
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

function PrintMessage(str){
	var MainMessage=document.getElementById("MainMessage");
	MainMessage.innerHTML="TESTETSE";
	setInterval(MainMessage.text.innerHTML="<BLINK>彩贝壳之家 -- 欢迎您!!!</BLINK>",60000);
}


/* 获取路径变量,来自网络第三方: http://www.cnblogs.com/sohighthesky/archive/2010/01/21/script-querystring.html */
var queryStrings=function() {//get url querystring
    var params=document.location.search,reg=/(?:^\?|&)(.*?)=(.*?)(?=&|$)/g,temp,args={};
    while((temp=reg.exec(params))!=null) args[temp[1]]=decodeURIComponent(temp[2]);
    return args;
}

function Alter(ID){
	var args=queryStrings();
	window.location.replace('main.php?page='+args.page+'&add_type='+args.add_type+'&Aid='+ID+'&Lid='+args.Lid);
}

function Del(ID){
	var args=queryStrings();
	window.location.replace('main.php?page='+args.page+'&add_type='+args.add_type+'&Did='+ID+'&Lid='+args.Lid);
}


function ListSubtype(ID){
	var args=queryStrings();
	if (args.add_type=="out_mantype"){
		window.location.replace('main.php?page='+args.page+'&add_type=out_subtype&Lid='+ID);
	}else if (args.add_type=="in_mantype"){
		window.location.replace('main.php?page='+args.page+'&add_type=in_subtype&Lid='+ID);
	}
}

function ReturnMantype(){
	var args=queryStrings();
	if (args.add_type=="out_subtype"){
		window.location.replace('main.php?page='+args.page+'&add_type=out_mantype');
	}else if (args.add_type=="in_subtype"){
		window.location.replace('main.php?page='+args.page+'&add_type=in_mantype');
	}
	

}

function MoveUp(ID){
	var args=queryStrings();
	window.location.replace('main.php?page='+args.page+'&add_type='+args.add_type+'&Mid='+ID+'&UP=1&Lid='+args.Lid);
}

function MoveDown(ID){
	var args=queryStrings();
	window.location.replace('main.php?page='+args.page+'&add_type='+args.add_type+'&Mid='+ID+'&Lid='+args.Lid);
}

function SkinSelect(skin){
	if (skin == undefined )
	{
		window.location.replace('main.php');
	} else {
		window.location.replace('main.php?skin='+skin);
	}
}