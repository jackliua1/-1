(function (window) {

    // IE6-IE8扩展
    //if (typeof Array.prototype.some != "function") {
    //    Array.prototype.some = function (fn, context) {
    //        var passed = false;
    //        if (typeof fn === "function") {
    //            for (var k = 0, length = this.length; k < length; k++) {
    //                if (passed === true) break;
    //                passed = !!fn.call(context, this[k], k, this);
    //            }
    //        }
    //        return passed;
    //    };
    //}

    function anyExist(list) {
        var passed = false;
        for (var i = 0; i < list.length; i++) {
            var item = list[i];
            if (window.location.href.indexOf(item) > 0) {
                passed = true;
                break;
            }
        }
        return passed;
    }

    // 禁止显示的页面
    var href = [
                     '/shop',
                     '/office',
                     '.com/house3/',
                     '.com/school',
                     '.com/chuzu/',                    
                     '.com/qiuzu/1_',
                     '.com/hezu/3_',
                     '.com/house/ltk',
                     '.com/bus',
                     '/houses'
                     ];

   
    var mapinfo = document.getElementById("mapUseInfo");
    if (mapinfo != null) {
        /*
        * 控制mapUseInfo是否显示
        */
        if (!(openmap || openvilla)) {
            mapinfo.style.display = "none";
        } else if (!openvilla) {
            mapinfo.style.display = window.location.href.indexOf('/villa') > 0 ? "none" : "";
        } else if (!openmap) {
            mapinfo.style.display = window.location.href.indexOf('/villa') > 0 ? "" : "none";
        } else {
            mapinfo.style.display = anyExist(href) ? "none" : "";
        }
    }

    /*
    * 地图、列表跳转
    */
    var gotolist1210 = "/house";
    var gotomap1210 = "/map";
    var gotomaphezu1210 = "/map/hezu";
    var gotolisthezu1210 = "/hezu";
    var gotomapvilla1210 = "/map/villa";
    var gotolistvilla1210 = "/villa";
    var gototrack1210 = "/house1";
    var gotomaptrackhezu1222 = "/map/house1/zhu";
    var gototrackhezu1222 = "/house1/zhu";
    function toMap() {
        if (window.location.href.indexOf(gototrackhezu1222) > -1) {
            window.location.href = window.location.href.replace(gototrackhezu1222, gotomaptrackhezu1222);
        }
        else
            if (window.location.href.indexOf(gotolist1210) > -1 && window.location.href.indexOf(gototrack1210) == -1) {
                if (window.location.href.indexOf("n34") > -1 || window.location.href.indexOf("n35") > -1) {
                    window.location.href = window.location.href.replace(gotolist1210, gotomaphezu1210);
                } else {
                    window.location.href = window.location.href.replace(gotolist1210, gotomap1210);
                }
            }
            else if (window.location.href.indexOf(gotolisthezu1210) > -1) {
                window.location.href = window.location.href.replace(gotolisthezu1210, gotomaphezu1210);
            }
            else if (window.location.href.indexOf(gotolistvilla1210) > -1) {
                window.location.href = window.location.href.replace(gotolistvilla1210, gotomapvilla1210);
            }
            else if (window.location.href.indexOf("/house1") > -1) {
                // 租住类型 选择了合租单间或合租床位
                if (window.location.href.indexOf("n34") > -1 || window.location.href.indexOf("n35") > -1) {
                    window.location.href = window.location.href.replace("/house1", "/map/hezu");
                } else {
                    window.location.href = window.location.href.replace("/house1", "/map");
                }
            }
            else {
                window.location.href = "http://" + window.location.host + "/map/";
            }
    }
    window.toMap = toMap;
} (window))   