$(document).ready(function(){
   $('#export').click(function(){
	   exportexcel();
	});
	//点击显示div和遮罩
	$("#import").live("click",function(){
	 ShowMask();
	 ShowDv();
	});
	//点击隐藏遮罩和div
	$("#close").live("click",function(){
	hide();
	window.location="index.php";
	});
    //点击取消
	$("#btn_cancels").live("click",function(){
	hide();
	});	
});

function  exportexcel()
{
   $.ajax(
	{
	url:"export/export.php",
	type:"POST",
	dataType:"TEXT",
	success:function(data)
	{	
	 data=data.substring(data.indexOf("<!>"),data.length-3);
	 window.location ="export/"+data.replace("<!>","");
	}
	});  
} 

//显示遮罩
function ShowMask ()
{
//$('body').css("overflow", 'hidden');	
$msk=$('<div id=dvMsk><div>');
$msk.css({"top":"0","left":"0","position":"absolute","display":"block","width":"100%","height":"100%","background":"#000","zIndex":"500","opacity":"0.3","filter":"Alpha(opacity=30)"});
$('body').append($msk);	
}
//显示div
function ShowDv()
{
$('#showDiv').css({'display':'block','position':'absolute','top':'30%','left':'40%'});
}
//隐藏遮罩和div
function hide()
{
$("#showDiv").css("display","none");
$("#dvMsk").remove();
}