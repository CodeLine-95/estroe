// JavaScript Document
function createXmlHttpRequest()
{
	var xmlHttp;
	try
	{
		xmlHttp=new XMLHttpRequest();


		}
		catch(e)
		{
			try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHttp");
				}
				catch(e){}
			}
	if(!xmlHttp) alert("创建XMLHttpRequest失败！");
	else
	return xmlHttp;
	}

//等待图片的函数
function showLoad(parentid){
	var pel=getId(parentid);
	pel.style.position="relative";

	var loaddiv=document.createElement("div");
	loaddiv.appendChild(createIMG("images/loading.gif"));
	loaddiv.setAttribute('id','load');
	pel.appendChild(loaddiv);
}
//去除等待图片的函数
function removeLoad(parentid){
	var pel=getId(parentid);
	pel.removeChild(getId('load'));
}

//获取图片路径
function createIMG(url){
	var img=document.createElement("img");
	img.setAttribute("src",url);
	return img;
}
//获取id函数
function getId(eid){
	return document.getElementById(eid);
}

var xmlHttp;
function addToCart(gid)
{
	var count=getId(gid);
	if(count==null){
		buycount=1;
	}else{
		buycount=count.value;
	}
	url="cart.php?act=add&gid="+gid+"&buycount="+buycount;

	xmlHttp=createXmlHttpRequest();
	xmlHttp.open("get",url,true);
	xmlHttp.onreadystatechange=handleCart;
	xmlHttp.send(null);
}
function handleCart()
{
	if(xmlHttp.readyState==4)
	{
		if(xmlHttp.status==200)
		{

			response=xmlHttp.responseText;

			if(response=="fault")
			{
				alert("超出库存量");
			}
			else
			{
				alert("已加入购物车");
			}
		}
	}
}

//goodsDetail
function changeTab(elementId1,elementId2,no)
{
	if(no==1)
	{
		document.getElementById(elementId1).style.display="block";
		document.getElementById(elementId2).style.display="none";

	}
	else
	{
		 document.getElementById(elementId1).style.display="none";
		document.getElementById(elementId2).style.display="block";

	}
}