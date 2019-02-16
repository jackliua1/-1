(function (win) {
    String.prototype.Trim = function () {
        return this.replace(/^\s+/g, "").replace(/\s+$/g, "");
    }

    var getfirstCookie = function (key) {
        var cookie = document.cookie;
        var cookieArray = cookie.split(';');
        var getvalue = "";
        for (var i = 0; i < cookieArray.length; i++) {
            if (cookieArray[i].Trim().substr(0, key.length) == key) {
                getvalue = cookieArray[i].Trim().substr(key.length + 1);
                break;
            }
        }
        return getvalue;
    },
    getsecondnameCookie = function (sMainName, sSubName) {
        var child = getfirstCookie(sMainName);
        var childs = child.split('&');
        var getvalue = "";
        for (var i = 0; i < childs.length; i++) {
            if (childs[i].Trim().substr(0, sSubName.length) == sSubName) {
                getvalue = childs[i].Trim().substr(sSubName.length + 1);
                break;
            }
        }
        return getvalue;
    },
    GetLength = function (str) {
        if (str == null) return 0;
        var realLength = 0, len = str.length, charCode = -1;
        for (var i = 0; i < len; i++) {
            charCode = str.charCodeAt(i);
            if (charCode >= 0 && charCode <= 128) realLength += 1;
            else realLength += 2;
        }
        return realLength;
    },
    GetStringLength = function (str) {
        var l = 0;
        for (var i = 0; i < str.length; i++) {
            var c = str.charCodeAt(i);
            l += (c < 256 || (c >= 0xff61 && c <= 0xff9f)) ? 1 : 2;
        }
        return l;
    },

    setLoginTopBar = function (values) {
        //var str = values.username;
        //if (GetLength(str) > 12) {
        //    var l = 0, i = 0;
        //    for (; i < str.length && l <= 12; i++) {
        //        var c = str.charCodeAt(i);
        //        l += (c < 256 || (c >= 0xff61 && c <= 0xff9f)) ? 1 : 2;
        //    }
        //    if (l > 12) {
        //        i -= 1;
        //    }
        //    values.username = str.substr(0, i) + "...";
        //}

        //switch (values.result) {
        //    case '100':
        //        changeHtml('login', values);
        //        jQuery("#rentid_D01_19").on('click', function () {
        //            jQuery.ajax({
        //                type: 'get',
        //                url: '/RentDetails/PostService/DefaultUserLogin.aspx?method=logout',
        //                contentType: 'application/json',
        //                dataType: 'json',
        //                cache: false,
        //                async: true
        //            }).complete(function () {
        //                changeHtml();
        //                window.location.reload();
        //            })
        //        })
        //        break;
        //    default:
        //        changeHtml();
        //        break;
        //}
    },

    changeHtml = function (action, values) {
        //var divLogin = document.getElementById("loginBarNew").getElementsByTagName("div");
        //jQuery("#loginBarNew").attr("class", "");
        //if (action === 'login') {
        //    jQuery("#loginBarNew").html("\
        //        <div class=\"s4a\" onmouseover=\"this.className='s4a on2014'\" onmouseout=\"this.className='s4a'\" style=\"background-image:none\">\
        //            <div class=\"s4Box\"><a href=\"http://ebs.home.fang.com/\" target=\"_blank\">家居云</a></div>\
        //        </div>\
        //        <div class=\"s4a\" onmouseover=\"this.className='s4a on2014'\" onmouseout=\"this.className='s4a'\" style=\"background-image:none\">\
        //            <div class=\"s4Box\"><a href=\"http://open.fang.com/\" target=\"_blank\">开发云</a></div>\
        //        </div>\
        //        <div class=\"s4a\" onmouseover=\"this.className='s4a on2014'\" onmouseout=\"this.className='s4a'\" style=\"background-image:none\">\
        //            <div class=\"s4Box\"><a href=\"http://agent.fang.com/\" target=\"_blank\">经纪云</a></div>\
        //        </div>\
        //        <div class=\"sline21041104\"></div>\
        //        <div class=\"s4a\" onmouseover=\"this.className='s4a on2014'\" onmouseout=\"this.className='s4a'\" style=\"background-image:none\">\
        //            <div class=\"s4Box\"><a href=\"" + values.url1 + "\">" + values.username + "</a></div>\
        //            <div class=\"listBox\">\
        //                <ul>\
        //                    <li><a href=\"http://my.fang.com/\" target=\"_blank\">我的房天下</a></li>\
        //                </ul>\
        //                <div class=\"tuic\" style=\"height:26px;line-height:26px;text-align:center;border-top:1px solid #cccccc;font-size:12px;\">\
        //                    <a id=\"rentid_D01_19\" href=\"javascript:;\" style=\"display: block;\" target=\"_self\">退出</a>\
        //                </div>\
        //            </div>\
        //        </div>\
        //        ");
        //} else {
        //    jQuery("#loginBarNew").html("\
        //        <div class=\"s4a\" onmouseover=\"this.className='s4a on2014'\" onmouseout=\"this.className='s4a'\" style=\"background-image:none\">\
        //            <div class=\"s4Box\"><a href=\"http://ebs.home.fang.com/\" target=\"_blank\">家居云</a></div>\
        //        </div>\
        //        <div class=\"s4a\" onmouseover=\"this.className='s4a on2014'\" onmouseout=\"this.className='s4a'\" style=\"background-image:none\">\
        //            <div class=\"s4Box\"><a href=\"http://open.fang.com/\" target=\"_blank\">开发云</a></div>\
        //        </div>\
        //        <div class=\"s4a\" onmouseover=\"this.className='s4a on2014'\" onmouseout=\"this.className='s4a'\" style=\"background-image:none\">\
        //            <div class=\"s4Box\"><a href=\"http://agent.fang.com/\" target=\"_blank\">经纪云</a></div>\
        //        </div>\
        //        <div class=\"sline21041104\"></div>\
        //        <div class=\"s4a\" onmouseover=\"this.className='s4a on2014'\" onmouseout=\"this.className='s4a'\" style=\"background-image:none\">\
        //            <div class=\"s4Box\">\
        //                <a id=\"rentid_D01_16\" href=\"https://passport.fang.com/?backurl=" + escape(location.href) + "\" target=\"_blank\">登录</a>\
        //            </div>\
        //            <div class=\"listBox\">\
        //                <ul>\
        //                    <li><a href=\"http://my.fang.com/\" target=\"_blank\">我的房天下</a></li>\
        //                </ul>\
        //            </div>\
        //        </div>\
        //        ");
        //}
    };

    //if ((getfirstCookie('sfut') != "")) {
    //    jQuery.ajax({
    //        type: 'get',
    //        url: '/RentDetails/PostService/DefaultUserLogin.aspx',
    //        contentType: 'application/json',
    //        dataType: 'json',
    //        cache: false,
    //        async: true
    //    }).done(function (data) {
    //        setLoginTopBar(data);
    //    })
    //}
    //else {
    //    var data = { "result": "004", "errormsg": "", "isagtuser": "", "username": "", "url1": "", "url2": "", "userid": "" };
    //    setLoginTopBar(data);
    //}
    win.getfirstCookie = getfirstCookie;
    win.getsecondnameCookie = getsecondnameCookie;
    win.changeHtml = changeHtml;
    win.setLoginTopBar = setLoginTopBar;
}(window));