var _ub={};_ub.$version="201608261800",_ub.$domain="https:"==window.location.protocol?"jsub.fang.com":"js.ub.fang.com",_ub.$actions=[2,0,2,2,4,2,5,6,5,1,4,2,3,4,4,3,4,5,5,4,5,4,3,0,4,1,0,5,0,0,0,4,0,5,5,5,5,5,5,5,6,5,4,4,6,6,6,6,6,6,4,5,4,5,4,2,2,3,4,6,6,6,5,5,4,5,5,4,4,4,4,5,5,5,3,6,4,3,5,0,0],_ub.$cookieEnabled="boolean"==typeof navigator.cookieEnabled&&navigator.cookieEnabled,_ub.$lsEnabled=null!=window.localStorage,_ub.$flashEnabled=function(){var e=!1,t=0;if(null!=navigator.plugins&&navigator.plugins.length>0)(navigator.plugins["Shockwave Flash 2.0"]||navigator.plugins["Shockwave Flash"])&&(e=!0,t=parseFloat(navigator.plugins["Shockwave Flash"+(navigator.plugins["Shockwave Flash 2.0"]?" 2.0":"")].description.split(" ")[2]));else if(window.ActiveXObject)try{e=!0,t=(t=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7").GetVariable("$version")).split(",")[0].split(" ")[1]}catch(e){}return e&&t>=9}(),_ub.$flash=null,_ub.$frame=null,_ub.$img=null,_ub.$processing=0,_ub.$ticker={DETECTLS:0,APPENDLS:0,DETECTFLASH:0,APPENDFLASH:0,DETECTIMG:0,APPENDIMG:0,GETGUID:0,REQUEST:0,COLLECT:0},_ub.$guid="0",_ub.$user={uid:"0",cid:"0",phone:"0",staff:"0",realtor:"0",getGuid:function(){_ub.$ticker.GETGUID++;var e=document.cookie,t=/global_cookie=(.+?);/;t.test(e)?_ub.$guid=t.exec(e)[1]:_ub.$ticker.GETGUID<=1e3&&window.setTimeout(function(){_ub.$user.getGuid()},50)},parseCookie:function(){var e=document.cookie;if(""!=e){e=e.split("; ");for(var t=0;t<e.length;t++){var n,i,a=e[t].indexOf("="),o=[];if(a)switch(o.push(e[t].substring(0,a),e[t].substring(a+1)),n=o[0],i=o[1],n){case"sfut":_ub.$user.uid=i;break;case"userinfo":/userid%253D(\d+)%2526/i.test(i)&&(_ub.$user.uid=/userid%253D(\d+)%2526/i.exec(i)[1]),/username%253D(.*?)%2526/i.test(i)&&(_ub.$user.uname=decodeURIComponent(/username%253D(.*?)%2526/i.exec(i)[1])),/phone%253D(\d+)%2526/i.test(i)&&(_ub.$user.phone=/phone%253D(\d+)%2526/i.exec(i)[1]),/isphonevalid%253D(\d+)%2526/i.test(i)&&(_ub.$user.isphonevalid=/isphonevalid%253D(\d+)%2526/i.exec(i)[1]),/mail%253D(\S+%2540\S+\.\w+)%2526/i.test(i)&&(_ub.$user.mail=decodeURIComponent(/mail%253D(\S+%2540\S+\.\w+)%2526/i.exec(i)[1])),/ismailvalid%253D(\d+)%2526/i.test(i)&&(_ub.$user.ismailvalid=/ismailvalid%253D(\d+)%2526/i.exec(i)[1]),/cid%253D(\d+)%2526/i.test(i)&&(_ub.$user.cid=/cid%253D(\d+)%2526/i.exec(i)[1]);break;case"global_cookie":_ub.$guid=i;break;case"isso_login":i.indexOf("%")>0?_ub.$user.staff=i.substr(0,i.indexOf("%")):i.indexOf("@")>0&&(_ub.$user.staff=i.substr(0,i.indexOf("@")));break;case"agent_validation":/^a=\d/i.test(i)&&!/^a=0/i.test(i)&&(_ub.$user.realtor=/^a=(\d)/i.exec(i)[1]);break;case"new_soufuncard":(i=i.split("%2C"))[0].length>11?(i=i[0].split(","),_ub.$user.phone=i[0]):_ub.$user.phone=i[0],i.length>3&&(i=i[3],/(\d+)$/.test(i)&&(_ub.$user.cid=/(\d+)$/.exec(i)[1]))}}}},getP2:function(){var e="0";return"0"!=this.staff?e="4":"0"!=this.realtor?e="3":"0"!=this.cid?e="2":this.uid>0&&(e="1"),e}},_ub.city="0",_ub.location="0",_ub.biz="",_ub.values={},_ub.client=function(){var e={ie:0,gecko:0,webkit:0,khtml:0,opera:0,ver:null},t={ie:0,firefox:0,safari:0,konq:0,opera:0,chrome:0,ver:null},n={win:!1,mac:!1,xll:!1,iphone:!1,ipod:!1,ipad:!1,ios:!1,android:!1,nokiaN:!1,winMobile:!1,wii:!1,ps:!1},i=window.navigator.userAgent,a=window.navigator.platform;if(n.win=0==a.indexOf("Win"),n.mac=0==a.indexOf("Mac"),n.xll=0==a.indexOf("Linux")||0==a.indexOf("Xll"),n.iphone=i.indexOf("iPhone")>-1,n.ipod=i.indexOf("iPod")>-1,n.ipad=i.indexOf("iPad")>-1,n.mac&&i.indexOf("Mobile")>-1&&(/CPU (?:iPhone )?OS (\d+_\d+)/.test(i)?n.ios=parseFloat(RegExp.$1.replace("_",".")):n.ios=2),/Android (\d+\.\d+)/.test(i)&&(n.android=parseFloat(RegExp.$1)),n.nokiaN=i.indexOf("NokiaN")>-1,"CE"==n.win?n.winMobile=n.win:"Ph"==n.win&&/Windows Phone OS (\d+.\d+)/.test(i)&&(n.win="Phone",n.winMobile=parseFloat(RegExp.$1)),n.wii=i.indexOf("Wii")>-1,n.ps=/playstation/i.test(i),window.opera)e.ver=t.ver=window.opera.version(),e.opera=t.opera=parseFloat(e.ver);else if(/AppleWebKit\/(\S+)/i.test(i))if(e.ver=t.ver=RegExp.$1,e.webkit=parseFloat(e.ver),/Chrome\/(\S+)/i.test(i))t.chrome=parseFloat(e.ver);else if(/Version\/(\S+)/i.test(i))t.safari=parseFloat(e.ver);else{var o=1;o=e.webkit<100?1:e.webkit<312?1.2:e.webkit<412?1.3:2,t.safari=t.ver=o}else/KHTML\/(\S+)/i.test(i)||/Konqueror\/([^;]+)/i.test(i)?(e.ver=t.ver=RegExp.$1,e.khtml=t.konq=parseFloat(e.ver)):/rv:([^\)]+)\) Gecko\/\d{8}/i.test(i)?(e.ver=RegExp.$1,e.gecko=parseFloat(e.ver),/Firefox\/(\S+)/i.test(i)&&(t.ver=RegExp.$1,t.firefox=parseFloat(t.ver))):(/MSIE ([^;]+)/i.test(i)&&(e.ver=t.ver=RegExp.$1,e.ie=t.ie=parseFloat(e.ver)),/Trident\/([^;]+)/i.test(i)&&(e.ver=t.ver=parseFloat(RegExp.$1)+4,e.ie=t.ie=e.ver));if(n.win&&/Win(?:dows )?([^do]{2})\s?(\d+\.\d+)?/.test(i))if("NT"==RegExp.$1)switch(RegExp.$2){case"5.0":n.win="2000";break;case"5.1":n.win="XP";break;case"6.0":n.win="Vista";break;case"6.1":n.win="7";break;case"6.2":n.win="8";break;case"6.3":n.win="9";break;case"10.0":n.win="10";break;default:n.win="NT"}else"9x"==RegExp.$1?n.win="ME":n.win=RegExp.$1;return{engine:e,browser:t,system:n}}(),_ub._tick=function(c,f,t){_ub.$ticker[t]++,_ub.$ticker[t]<=600&&(eval(c)?f():window.setTimeout(function(){_ub._tick(c,f,t)},100))},_ub._encrypt=function(e,t){if("function"==typeof JSEncrypt&&t)t();else{var n=document.createElement("script"),i=0;n.onload=n.onreadystatechange=function(){if(!i){var e=n.readyState;if(void 0===e||"loaded"==e||"complete"==e){i=1;try{t&&t()}finally{n.onload=n.onreadystatechange=null,n.parentNode.removeChild(n)}}}},n.asyn=1,n.src=location.protocol+"//"+_ub.$domain+"/"+e;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(n,a)}},_ub._rsa=function(e){var t=new JSEncrypt;t.setPublicKey("MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDnJUXorWKGZEpLjgP9Aado78y8LwNiAqJNXkxLC0I5/rtnLmz8DuMgjxRVL+5iBeZ5a/Qm0zOOWd5/IJNLwZ6iAqX3NTxMuioAzaxXQWuhrgVJ+cxhWKuJGe1bsaPIUS+Py79a20FolQN+xT8Lf9aCTk9HdhjOd27LbX5DqwmO/wIDAQAB");for(var n in e)n.indexOf("phone")>=4&&/^1[3|4|5|7|8]\d{9}$/.test(e[n])&&(e[n]=encodeURIComponent(t.encrypt(e[n].toString())))},_ub._handling=function(e){if("object"==typeof e){e["vwg.userAgent"]=navigator.userAgent;for(var t in _ub.client.browser)"ver"!=t&&_ub.client.browser[t]&&(e["vwg.browser"]=t+"^"+_ub.client.browser[t]);for(var t in _ub.client.system)_ub.client.system[t]&&(e["vwg.system"]="win"==t?t+_ub.client.system[t]:t);var n=[],i=[];for(var a in e)n.push(a+"="+e[a]),-1==a.indexOf(".")&&i.push(a);return e=n.join("&"),i.length&&(e+="&vwg.errorpage="+encodeURIComponent(window.location.href)+"^"+i.join("^")),e}},_ub._upload=function(e,t,n,i){var a=window.location.protocol+"//countub"+("0"==_ub.location?"n":"s")+".3g.fang.com/w?g="+e+"&c="+encodeURIComponent(t)+"&b="+n+"&"+_ub._handling(i);null!=_ub.$img?_ub.$img.src=a:(_ub._tick("document.body != null && document.body.firstChild != null",function(){var e=document.createElement("IMG");e.id="USERBEHAVIOR_IMG",e.src=a,e.width=0,e.height=0,e.style.display="none",document.body.insertBefore(e,document.body.firstChild)},"APPENDIMG"),_ub._tick('document.getElementById("USERBEHAVIOR_IMG") != null',function(){_ub.$img=document.getElementById("USERBEHAVIOR_IMG")},"DETECTIMG"))},_ub._record=function(e,t,n,i){var a=i,o=!1;for(var r in a)r.indexOf("phone")>=4&&/^1[3|4|5|7|8]\d{9}$/.test(a[r])&&(o=!0);o?_ub._encrypt("_jsencrypt.js",function(){_ub._rsa(e,t,n,i),_ub._upload(e,t,n,i)}):_ub._upload(e,t,n,i)},_ub._requestCallback=function(e){for(var t in e)for(var n=0;n<e[t].length;n++)e[t][n].w=_ub._weigh(e[t][n]);_ub.values=e,_ub.load(0),null!=_ub.onload&&_ub.onload()},_ub._onmessage=function(e){if(e.origin.indexOf(_ub.$domain)>-1){var t=e.data;if(/^collect/i.test(t));else if(/^request:/i.test(t)){var n={};if(""!=(t=t.replace(/^request:/i,"")))for(var i,a=t.split(";"),o=0;o<a.length;o++)2==(i=a[o].split(":")).length&&(n[i[0]]=function(){for(var e,t,n=[],a=i[1].split(","),o=0;o<a.length;o++)""!=(t=a[o].split("_"))[0]&&7==t.length&&((e={}).v=t[0],e.b=parseInt(t[1]),isNaN(e.b)&&(e.b=0),e.d=t[2],e.t=parseInt(t[3]),e.c=t[4],e.p=parseInt(t[5]),e.m=t[6],n.push(e));return n}());_ub._requestCallback(n)}else/^view:/i.test(t)?(t=t.replace(/^view:/i,""),null!=_ub._viewCallback&&_ub._viewCallback(t)):/^clear/i.test(t)&&null!=_ub._clearCallback&&_ub._clearCallback();_ub._removeFrame()}},_ub._initialize=void(_ub.$cookieEnabled&&(_ub.$user.parseCookie(),"0"==_ub.$guid&&_ub.$user.getGuid(),null!=window.addEventListener?window.addEventListener("message",_ub._onmessage,!1):null!=window.attachEvent&&window.attachEvent("onmessage",_ub._onmessage),!_ub.$lsEnabled&&_ub.$flashEnabled&&(_ub._tick("document.body != null && document.body.firstChild != null",function(){var e=document.createElement("DIV");e.id="USERBEHAVIOR_DIV",e.style.position="absolute",document.body.insertBefore(e,document.body.firstChild);var t="http://flv"+_ub.$domain.substring(_ub.$domain.indexOf("."))+"/_ub.swf?v="+(new Date).valueOf().toString(),n='<object id="USERBEHAVIOR_FLASH"';"Microsoft Internet Explorer"==navigator.appName?n+='classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ':(n+='type="application/x-shockwave-flash" ',n+='data="'+t+'" '),n+=' width="0" height="0">',n+='<param name="movie" value="'+t+'"></param>',n+='<param name="allowScriptAccess" value="always"></param>',n+="</object>",e.innerHTML=n},"APPENDFLASH"),_ub._tick('document.getElementById("USERBEHAVIOR_FLASH") != null',function(){_ub.$flash=document.getElementById("USERBEHAVIOR_FLASH")},"DETECTFLASH")))),_ub._filter=function(e,t){if(null==t)return e;for(var n,i,a=t.split("&"),o=[],r=0;r<a.length;r++)null!=(i=/[=!><\^\$#~]{2}/.exec(t)[0])&&(n=a[r].split(i),o.push({a:n[0],o:i,b:n[1]}));var u=[];for(r=0;r<e.length;r++){for(var l=!0,s=0;s<o.length;s++)if(!_ub._matches(e[r],o[s])){l=!1;break}l&&u.push(e[r])}return u},_ub._matches=function(e,t){var n,i=!1;if(null!=e[t.a])switch(/[bdtwpm]/i.test(t.a)&&(t.b=parseInt(t.b)),t.o){case"==":i=e[t.a]==t.b;break;case"!=":i=e[t.a]!=t.b;break;case"=>":"v"==t.a&&(t.b=parseInt(t.b)),i=void 0!=e[t.a]&&e[t.a]>t.b;break;case"=<":"v"==t.a&&(t.b=parseInt(t.b)),i=void 0!=e[t.a]&&e[t.a]<t.b;break;case"<=":"v"==t.a&&(t.b=parseInt(t.b)),i=void 0!=e[t.a]&&e[t.a]<=t.b;break;case">=":"v"==t.a&&(t.b=parseInt(t.b)),i=void 0!=e[t.a]&&e[t.a]>=t.b;break;case"^=":(n=new RegExp("^"+t.b)).ignoreCase=!0,i=n.test(e[t.a]);break;case"$=":(n=new RegExp(t.b+"$")).ignoreCase=!0,i=n.test(e[t.a]);break;case"#=":(n=new RegExp(t.b)).ignoreCase=!0,i=n.test(e[t.a]);break;case"~=":if("d"==t.a){var a=new Date,o=(a=new Date(a.valueOf()-24*t.b*60*60*1e3)).getFullYear();o=(o+="_"+(a.getMonth()+1)).replace("_",7==o.length?"":"0"),o=(o+="_"+a.getDate()).replace("_",9==o.length?"":"0"),o=parseInt(o),i=e[t.a]>=o}}return i},_ub._weigh=function(e){if(null!=e.b&&null!=e.d&&null!=e.t&&null!=e.p&&null!=e.m){var t,n,i,a,o,r,u=[5,25,40,55,70,85,100];return t=e.b>_ub.$actions.length?u[0]:u[_ub.$actions[e.b]],n=Math.floor(((new Date).valueOf()-new Date(2012,1,1).valueOf())/1e3/3600/24),n-=e.d,o=(new Date).getHours()-Math.floor(e.m/3600),r=24*n+o,n<=5?n=100-3*n:n>=6&&n<=19?n=85-2.5*(n-5):n>=20&&n<=29?n=50-2*(n-19):n>=30&&n<=59?n=30-1*(n-29):n>=60&&(n=0),r>100&&(r=100),r=100-r,i=e.t>5?100:[10,30,60,90,100][e.t-1],e.p<=2?a=10:e.p>=3&&e.p<=5?a=30:e.p>=6&&e.p<=9?a=60:e.p>=10&&e.p<=15?a=80:e.p>=16&&(a=100),.45*t+.25*n+.2*i+.05*a+.05*r}return 0},_ub._addFrame=function(e,t,n,i){_ub.$lsEnabled&&(_ub.$ticker[e]=0,_ub._tick('document.body != null && document.body.firstChild != null && _ub.$guid !="0" && _ub.$processing == 0',function(){_ub.$processing=1;var a=document.createElement("IFRAME");switch(a.id="USERBEHAVIOR_FRAME",a.name="USERBEHAVIOR_FRAME",a.style.display="none",_ub.$frame=a,"function"==typeof i&&(_ub.onload=i),e){case"COLLECT":a.src=window.location.protocol+"//"+_ub.$domain+"/lsc.htm?r="+(new Date).valueOf()+"&g="+_ub.$guid+"&c="+encodeURIComponent(_ub.city)+"&b="+t+"&p="+n;break;case"REQUEST":a.src=window.location.protocol+"//"+_ub.$domain+"/lsr.htm?r="+(new Date).valueOf()+"&c="+encodeURIComponent(_ub.city)+"&p="+n;break;case"VIEW":a.src=window.location.protocol+"//"+_ub.$domain+"/lsv.htm?r="+(new Date).valueOf();break;case"CLEAR":a.src=window.location.protocol+"//"+_ub.$domain+"/lsn.htm?r="+(new Date).valueOf()}document.body.insertBefore(a,document.body.firstChild)},e))},_ub._removeFrame=function(){_ub.$frame&&(document.body.removeChild(_ub.$frame),_ub.$processing=0,_ub.$frame=null)},_ub.collect=function(e,t){if(_ub.$cookieEnabled&&null!=t){var n=isNaN(e)?-1:e;if("string"==typeof t){var i=t.split(";");t={};for(var a,o=0;o<i.length;o++)t[(a=i[o].split(":"))[0]]=a[1]}t["vwg.city"]=encodeURIComponent(_ub.city),0!=_ub.$user.uid&&null==t["vwg.passportid"]&&(t["vwg.passportid"]=_ub.$user.uid),null==t["vwg.usertype"]&&(t["vwg.usertype"]=_ub.$user.getP2()),null==t["vwg.business"]&&""!=_ub.biz&&(t["vwg.business"]=_ub.biz.toUpperCase(),"W"==t["vwg.business"]&&document.referrer&&(t["vwg.refurl"]=encodeURIComponent(document.referrer))),null==t["vwg.agenttype"]&&null!=_ub.$user.realtor&&"0"!=_ub.$user.realtor&&(t["vwg.agenttype"]=_ub.$user.realtor),"0"!=_ub.$user.cid&&null==t["vwg.sfcardid"]&&(t["vwg.sfcardid"]=_ub.$user.cid),"0"!=_ub.$user.phone&&null==t["vwg.phone"]&&(t["vwg.phone"]=_ub.$user.phone),null==t["vwg.valid"]&&(null==t["vwg.phone"]&&null==t["vwg.mail"]||(t["vwg.valid"]="1")),"0"!=_ub.$user.staff&&null==t["vwg.staffmail"]&&(t["vwg.staffmail"]=_ub.$user.staff),t["vwg.clientstorage"]=(_ub.$flashEnabled?1:0)+(_ub.$lsEnabled?2:0);var r="";try{(r=_ub._getCookie("g_sourcepage"))||(void 0!==win.ub_sourcepage?r=win.ub_sourcepage:document.getElementById("__vb")&&(r=document.getElementById("__vb").getAttribute("src").split("c=")[1])),_ub._setCookie("g_sourcepage",t.page)}catch(e){console.log("\u9875\u9762\u7f16\u53f7\u51fa\u9519")}t["vwg.sourcepage"]=r;var u=[];if("object"==typeof t){for(var l in t)u.push(l+":"+t[l]);u=u.join(";")}_ub._record(_ub.$guid,_ub.city,n,t),_ub.$flash?(_ub.$ticker.COLLECT=0,_ub._tick("_ub.$guid != 0 && _ub.$flash.collect != null",function(){try{_ub.$flash.collect(_ub.$guid,encodeURIComponent(_ub.city),n,u)}catch(e){}},"COLLECT")):_ub._addFrame("COLLECT",n,u)}},_ub.request=function(e,t){_ub.$cookieEnabled&&null!=e&&(_ub.$flash?(_ub.$ticker.REQUEST=0,_ub._tick("_ub.$guid != 0 && _ub.$flash.request != null",function(){try{_ub.$flash.request(encodeURIComponent(_ub.city),e)}catch(e){}},"REQUEST")):_ub._addFrame("REQUEST",null,e,t))},_ub.getValue=function(e,t,n){if(void 0===_ub.values[e])return"";var i,a=_ub._filter(_ub.values[e],n);if(1==a.length)return 3==t?a[0]:a[0].v;if(a.length>1){null==t&&(t=0);var o="";if(0==t){var r=0;for(b=[],i=0;i<a.length;i++)r+=a[i].w,b.push({v:a[i].v,r:r});var u=Math.random()*r;for(i=0;i<b.length;i++)if(b[i].r>=u){o=b[i].v;break}}else if(1==t){var l=0;for(i=0;i<a.length;i++)a[i].w>l?((b=[]).push(a[i].v),l=a[i].w):a[i].w==l&&b.push(a[i].v);o=b[Math.floor(Math.random()*b.length)]}else if(2==t){(b=[]).push(a[0]);var s=a[0].d;for(i=1;i<a.length;i++){(d=a[i].d)>s?((b=[]).push(a[i]),s=d):d==s&&b.push(a[i])}if(1==b.length)o=b[0].v;else{t=0;for(j=0;j<b.length;j++){void 0!=(_=b[j].m)&&_>t&&(t=_,o=b[j].v)}}}else if(3==t){var c=[];for(i=0;i<a.length;i++)1==a[i].b&&c.push(a[i]);if(c.length){var b;(b=[]).push(c[0]);s=c[0].d;for(i=1;i<c.length;i++){var d;(d=c[i].d)>s?((b=[]).push(c[i]),s=d):d==s&&b.push(c[i])}if(1==b.length)o=b[0];else{t=0;for(j=0;j<b.length;j++){var _;void 0!=(_=b[j].m)&&_>t&&(t=_,o=b[j])}}}}return o}return""},_ub.load=function(e){for(var t in _ub.values)_ub[t]=_ub.getValue(t,e)},_ub.onload=null,_ub._getCookie=function(e){var t,n=new RegExp("(^| )"+e+"=([^;]*)(;|$)"),i="";if(t=document.cookie.match(n))try{i=decodeURIComponent(t[2])}catch(e){i=t[2]}return i},_ub._setCookie=function(e,t){document.cookie=e+"="+encodeURIComponent(t)+"; path=/;"};