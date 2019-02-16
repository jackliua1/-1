$(document).ready(function(){
	// 销售经理注册
	// 姓名
	var name=$("#name");
	name.focus(function(){
		if(name.val()=="请输入您的姓名"){
			name.val("");
		}
	});
	name.blur(function(){
		if(name.val()==""){
			name.val("请输入您的姓名");
			return;
		}
	});
	// 电话
	var tel=$("#tel");
	tel.focus(function(){
		if(tel.val()=="请输入您的电话"){
			tel.val("");
		}
	});
	tel.blur(function(){
		if(tel.val()==""){
			tel.val("请输入您的电话");
		}else{
			var reg = /^[1][3568]\d{9}$/;
			if(!reg.test(tel.val())){
				return;
			}
		}
		
	});
	// 身份类型
	// var sfz=$("#sfz");
	// sfz.focus(function(){
	// 	if(sfz.val()=="请输入您的身份证号码"){
	// 		sfz.val("");
	// 	}
	// });
	// sfz.blur(function(){
	// 	if(sfz.val()==""){
	// 		sfz.val("请输入您的身份证号码");
	// 		return;
	// 	}else{
	// 		var reg= /^[1-9]\d{16}[\d|x|X]$/;
	// 		if(!reg.test(sfz.val())){
	// 			return;
	// 		}
	// 	}
		
	// });
	// 所属项目
	var lp=$("#lp");
	lp.focus(function(){
		if(lp.val()=="请输入您所属项目名称"){
			lp.val("");
		}
		var token=$("#token").val();
		// $.ajax({
		// 	type:'post',
		// 	url:LPURL,
		// 	dataType:"json",
  //           data:{"token":token},
  //           success: function(datas){
		// 	            var data=eval(datas);
		// 	            var length=data.length;
		// 	            var str='';
		// 	            if(datas!=0){
		// 	            	str+="<select id='' size='5'>";
		// 	              for (var i = 0; i < length; i++) {
		// 	                str+="<option value='"+data[i]['id']+"'>"+data[i]['LouPanTitle']+"</option>";
		// 	              };
		// 	              str+="</select>";
		// 	              $('#lp').append(str);
		// 	            }
		// 	          }
		// });
	});
	lp.blur(function(){
		if(lp.val()==""){
			lp.val("请输入您所属项目名称");
			return;
		}
	});
	// 邀请码
	var yqm=$("#yqm");
	yqm.focus(function(){
		if(yqm.val()=="请输入您的邀请码"){
			yqm.val("");
		}
	});
	yqm.blur(function(){
		if(yqm.val()==""){
			yqm.val("请输入您的邀请码");
			return;
		}
	});	
	
})





    function abc(){ 

    	var name=document.getElementById("name");
		var tel=document.getElementById("tel");
		// var sfz=document.getElementById("sfz");
		var lp=document.getElementById("lp");
		var yqm=document.getElementById("yqm");

		document.getElementById("error_a").onclick=function(){ document.getElementById("error_box").style.display="none"}
		//验证姓名
		if(name.value==""||name.value=="请输入您的姓名"){
			$("#errorinfo").html("请输入您的姓名");
			showboxa('error_box');
			return false;
		}
		//验证手机
		var telreg= /^[1][3|5|6|7|8]\d{9}$/;
		if(tel.value==""||tel.value=="请输入您的电话"||!telreg.test(tel.value)){
			$("#errorinfo").html("请输入正确的电话");
			showboxa('error_box');
			return false;
		}
		//验证身份
		// if(sfz.value==""||sfz.value=="请输入您的身份证号码"){
		// 	$("#errorinfo").html("请输入您的身份证号码");
		// 	showboxa('error_box');
		// 	return false;
		// }
		//验证公司
		if(lp.value==""&&lp.value=="请输入您所属项目名称"){
			$("#errorinfo").html("请输入您所属项目名称");
			showboxa('error_box');
			return false;
		}
		//验证邀请码
		var yqmreg=/^\w{6}$/;
		if(yqm.value==""||yqm.value=="请输入您的邀请码"||!yqmreg.test(yqm.value)){
			$("#errorinfo").html("请输入您的邀请码");
			showboxa('error_box');
			return false;
		}




    			// var x=0;

       //          document.getElementById("name").value=="请输入您的姓名"?x++:x=x;
       //          document.getElementById("tel").value=="请输入您的电话"?x++:x=x;
       //          document.getElementById("sfz").value=="请输入您的身份证号码"?x++:x=x;
       //          document.getElementById("lp").value=="请输入您所属项目名称"?x++:x=x;
       //          document.getElementById("yqm").value=="请输入的邀请码"?x++:x=x;  
       //          document.getElementById("error_a").onclick=function(){ document.getElementById("error_box").style.display="none"}

       //           if(x>=1){
       //           	document.getElementById("errorinfo").innerText="亲，信息没有完全正确哦";
       //           	document.getElementById("error_box").style.display="";
       //           	return false; 
       //       } 


    }
