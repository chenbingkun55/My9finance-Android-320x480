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

function ChangFunTitle(obj){
	var FunTitleColor = document.getElementById(obj);
	
	document.getElementById('FunTitle1').style.backgroundColor = "";
	document.getElementById('FunTitle2').style.backgroundColor = "";
	document.getElementById('FunTitle3').style.backgroundColor = "";
	document.getElementById('FunTitle4').style.backgroundColor = "";
	document.getElementById('FunTitle5').style.backgroundColor = "";

	FunTitleColor.style.backgroundColor = "#c7edcc";
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