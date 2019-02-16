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
		}
		
	});

	// 公司名称
	var companyname=$("#companyname");
	companyname.focus(function(){
		if(companyname.val()=="请输入您的公司名称"){
			companyname.val("");
		}
	});
	companyname.blur(function(){
		if(companyname.val()==""){
			companyname.val("请输入您的公司名称");
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
	// 	}
		
	// });
	// 邀请码
	// var yqm=$("#yqm");
	// yqm.focus(function(){
	// 	if(yqm.val()=="请输入的邀请码"){
	// 		yqm.val("");
	// 	}
	// });
	// yqm.blur(function(){
	// 	if(yqm.val()==""){
	// 		yqm.val("请输入的邀请码");
	// 		return;
	// 	}
	// });	
	
})


    function abc(){ 
		var x=0;
		var name=document.getElementById("name");
		var tel=document.getElementById("tel");
		var password=document.getElementById("password");
		var leibie=document.getElementById("leibie");
		var companyname=document.getElementById("companyname");
		var yqm=document.getElementById("yqm");

		document.getElementById("error_a").onclick=function(){ document.getElementById("error_box").style.display="none"}
		//验证姓名
		// if(name.value==""||name.value=="请输入您的姓名"){
			// $("#errorinfo").html("请输入您的姓名");
			// showboxa('error_box');
			// return false;
		// }
		//验证手机
		var telreg= /^[1][3|5|6|7|8]\d{9}$/;
		if(tel.value==""||tel.value=="请输入您的电话"||!telreg.test(tel.value)){
			$("#errorinfo").html("请输入正确的电话");
			showboxa('error_box');
			return false;
		}
		//验证密码
		if(password.value==""||password.value=="请输入您的密码"){
			$("#errorinfo").html("请输入您的密码");
			showboxa('error_box');
			return false;
		}
		//验证身份
		if(leibie.value=="请输入您的密码"){
			$("#errorinfo").html("请输入您的身份类别");
			showboxa('error_box');
			return false;
		}
		//验证公司
		//if(companyname.type=="text"&&companyname.value=="请输入您的公司名称"){
		//	$("#errorinfo").html("请输入您的公司名称");
		//	showboxa('error_box');
		//	return false;
		//}
		//验证邀请码
		// var yqmreg= /^\d{0,6}$/;
		// if(yqm.value==""||yqm.value=="请输入您的邀请码"||!yqmreg.test(yqm.value)){
		// 	$("#errorinfo").html("请输入正确的邀请码0-6个数字");
		// 	showboxa('error_box');
		// 	return false;
		// }
        // sfz.value=="请输入您所属项目名称"?x++:x=x;
        // document.getElementById("yqm").value=="请输入的邀请码"?x++:x=x;  
        

      //    if(x>=1){
      //    	document.getElementById("errorinfo").innerText="亲，信息没有完全正确哦";
      //    	document.getElementById("error_box").style.display="";
      //    	return false; 
     	// } 
}
