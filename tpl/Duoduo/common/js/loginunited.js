var backurl = encodeURIComponent(location.href);
function getCookie(name) {
//	document.domain = 'fang.com';
	var start = document.cookie.indexOf(name + "=");
	var len = start + name.length + 1;
	if ((!start) && (name != document.cookie.substring(0, name.length)))
		return null;
	if (start == -1)
		return null;
	var end = document.cookie.indexOf(";", len);
	if (end == -1)
		end = document.cookie.length;
	return document.cookie.substring(len, end);
}
var cookie_passport = getCookie('passport');
var cookie_new_sfut = getCookie('sfut');
var isLogin = false;
var showLoginName = "";
var showLoginId = "";
var myXmlHttpRequest;
if (cookie_new_sfut!=null && cookie_new_sfut!='') {
	function getXmlHttpObject(){	
		var xmlHttpRequest;
		if(window.ActiveXObject){		
			xmlHttpRequest=new ActiveXObject("Microsoft.XMLHTTP");		
		}else{
			xmlHttpRequest=new XMLHttpRequest();
		}
			return xmlHttpRequest;
	}

	myXmlHttpRequest=getXmlHttpObject();
	if(myXmlHttpRequest){
		var url="//www.fang.com/ajax2.do?unitedLogin=true&rand="+Math.random();
		myXmlHttpRequest.open("get",url,true);
		myXmlHttpRequest.withCredentials = true; //kua yu fang wen .cookies
//		myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=GBK");
		myXmlHttpRequest.onreadystatechange=function chuli(){
			if(myXmlHttpRequest.readyState==4){
				if(myXmlHttpRequest.status==200){
					var responseResult= myXmlHttpRequest.responseText;
					var msgRes = JSON.parse(responseResult);

					var result = msgRes.feed.index;
					if (result == 100) {
						isLogin = true;
						if (isLogin) {
							showNickName = msgRes.feed.nickname; 
							showLoginName = msgRes.feed.username; 
							showLoginId = msgRes.feed.userid; 
							document.getElementById('sfHeadRegister').href = "https://passport.fang.com/logout.aspx?backurl=" + backurl;//设置logout
							document.getElementById('sfHeadRegister').target="_self";
							var nameStrTemp = decodeURI(showLoginName);
							var nicknameStr = decodeURI(showNickName)
							var tui = document.getElementsByClassName('tuic');
							
							if(tui != undefined && tui != null){
								tui[0].style.display=""
							}
							
							if(null!=nicknameStr && ''!= nicknameStr){
								document.getElementById('sfHeadUsername').innerHTML = nicknameStr;
							}else{
								document.getElementById('sfHeadUsername').innerHTML = nameStrTemp;
							}
//							document.getElementById('sfHeadUsername').href="http://my.fang.com/";
							deleteCookieLogin('new_loginid','/',null);// for zi xun
							deleteCookieLogin('login_username','/',null);// for wen da
							setCookieLogin('new_loginid',showLoginId,null,'/',null,false);//for zi xun
							setCookieLogin('login_username',showLoginName,null,'/',null,false);//for wen da 
						}
					}else {
						document.getElementById('sfHeadUsername').innerHTML = "登录";
						deleteCookieLogin('new_loginid','/',null);// for zi xun
						deleteCookieLogin('login_username','/',null);// for wen da
					}
				
				}	
			 }
		}
		myXmlHttpRequest.send();
	}
}else{
	deleteCookieLogin('new_loginid','/',null);// for zi xun
	deleteCookieLogin('login_username','/',null);// for wen da
}


function urlencode(str) {
	str = (str + '').toString();
	return encodeURIComponent(str);
}

function changeLoginUrl(){
	if (cookie_new_sfut!=null && cookie_new_sfut!='') {
		document.getElementById('sfHeadUsername').href=document.getElementById('userCenterUrl').value;
	}else{
		document.getElementById('sfHeadUsername').href='https://passport.fang.com/?backurl='+backurl;
	}
}
function setCookieLogin(sName, sValue, oExpires, sPath, sDomain, bSecure) {   
    var sCookie = sName + "=" + encodeURIComponent(sValue);   
    //除sName, sValue外，其他参考可选，所以使用前要判断是否传入   
    if (oExpires) {   
        //时间要是GMT格式   
        sCookie += "; expires=" + oExpires.toGMTString();   
    }   
    if (sPath) {   
        sCookie += "; path=" + sPath;   
    }   
    if (sDomain) {   
        sCookie += "; domain=" + sDomain;   
    }   
    if (bSecure) {   
        sCookie += "; secure";   
    }   
    document.cookie = sCookie;   
}

function deleteCookieLogin(sName, sPath, sDomain) {   
    //删除cookie必须给出与创建它时一样的路径和域信息。   
    var sCookie = sName + "=; expires=" + (new Date(0)).toGMTString();   
    if (sPath) {   
        sCookie += "; path=" + sPath;   
    }   
    if (sDomain) {   
        sCookie += "; domain=" + sDomain;   
    }   
    document.cookie = sCookie;   
} 