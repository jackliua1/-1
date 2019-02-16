/**视频统计脚本
*@author wangyushuai@fang.com
*/

/**视频播放统计
*@param {bool} isNorth 是否为北方
*/
function videoPlayHits(isNorth) {
    if ($('video').length > 0) {
        var region = 'n';
        if (! isNorth) {
            region = 's';
        }
        //初始化视频播放地址
        var videoURL = $('video').find('source').eq(0).attr('src');

        //绑定事件
        $('video').bind('play', function () {
            videoPlayHits.prototype.addVideoPlayHits(region, videoURL);
        });

        //请求成功后,视频统计返回OK
        window.ok = function () {
            console.log("视频统计成功");
        }
    }
}

/*发送统计需求
*@param region: 南方或北方 n or s
*@param videoURL: 视频地址
*/
videoPlayHits.prototype.addVideoPlayHits = function (region, videoURL) {
    var requestURL = 'http://jk' + region + '.v.fang.com/interface/updatevInfohits.aspx';

    var util = new Util();
    $.ajax({
        url: requestURL,
        type: 'get',
        dataType: 'jsonp',
        data: {
            uid: util.getUID(),//uid 参数为 用户guid
            inputstr: videoURL,
            playType: 'pc',
            referUrl: document.referrer,
            location: location.href
        }
    })
};


/*工具类*/
var Util = function () { };

/*
 * 获取global_cookie
 * @return uid
 */
Util.prototype.getUID = function () {
    var uid = Util.prototype.getCookie('global_cookie');
    if (uid) {
        return uid;
    }
    uid = Util.prototype.getGUID();
    Util.prototype.setCookie('global_cookie', uid, 3, 'fang.com');
    return uid;
}

/*
 * 生成global_cookie
 * @return global_cookie
 */
Util.prototype.getGUID = function () {
    var i = 0;
    var result = '';
    var pattern = '0123456789abcdefghijklmnopqrstuvwxyz';
    for (i = 0; i < 25; i++) {
        result += pattern.charAt(Math.round(Math.random() * 36));
    }
    var time = new Date().getTime();
    var str = '00000000' + time.toString(16).toLocaleLowerCase();
    var len = str.length;
    result += str.substring(len - 10);
    return result;
}


/**
 * 获取cookie
 * @param key
 * @returns {*}
 */
Util.prototype.getCookie = function (key) {
    let arr, reg = new RegExp('(^| )' + key + '=([^;]*)(;|$)');
    if (arr = document.cookie.match(reg)) {
        let str;
        try {
            str = decodeURIComponent(arr[2]);
        } catch (e) {
            str = unescape(arr[2]);
        }
        return str;
    }
    return '';
}


/**
* 设置cookie
* @param key
* @param value
* @param iDay
* @param domain
*/
Util.prototype.setCookie = function(key, value, iDay, domain) {
    let domainStr = '';
    if (domain) {
        domainStr = `domain=${domain};`
    }
    if (iDay) {
        let oDate = new Date();
        oDate.setDate(oDate.getDate() + Number(iDay));
        document.cookie = `${key}=${encodeURIComponent(value)};path=/;${domain ? domainStr : ''}expires=${oDate.toGMTString()}`;
    } else {
        document.cookie = `${key}=${encodeURIComponent(value)};${domain ? domainStr : ''}path=/`;
    }
}