/*
  JavaScript ������꾭��������ʱ,��̬�仯.
	OverFunTitleColor()  �����������.
	OutFunTitleColor()	 ����Ƴ�������.
	ChangFunTitle()		 �����������.
*/

function OverFunTitleColor(obj) { 
	var FunTitleColor = document.getElementById(obj);
	/* ���嶯̬ */
	FunTitleColor.style.Color="#6699FF";
	FunTitleColor.style.fontSize="12pt";
	
	/* ������̬
	if (FunTitleColor.style.backgroundColor != "#c7edcc")
	{
		FunTitleColor.style.backgroundColor = "#c7edcd";
	}*/
}

function OutFunTitleColor(obj) { 
	var FunTitleColor = document.getElementById(obj);

	/* ���嶯̬ */
	FunTitleColor.style.fontSize="";
	FunTitleColor.style.Color="";


	/* ������̬
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
  ��꾭������ͼƬʱ����,�Ŵ���С����.
	OverTitleIMG()	��������ʾ��ͼ.
	OutTitleIMG()	����Ƴ���ʾСͼ.
*/

function OverTitleIMG(){
	var TitleIMG=document.getElementById("TitleIMG");
	TitleIMG.src="../../images/logo_max_color.gif";
}


function OutTitleIMG(){
	var TitleIMG=document.getElementById("TitleIMG");
	TitleIMG.src="../../images/logo_color.gif";
}