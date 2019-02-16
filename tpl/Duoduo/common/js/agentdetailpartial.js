/** 个人详情页右侧模块加载
*date:20180129
*/
(function () {
    var pageSize = 3;//获取房源数
    var project_height = 0;    //同小区房高度
    var around_height = 0;   //周边房源高度
    var agent_height = 0;     //经纪人推荐房源板块高度

    //根据房源板块个数返回高度
    function getElemHeight(el) {
        switch (el) {
            case 1:
                return 308;
            case 2:
                return 512;
            case 3:
                return 716;
        }
        return 0;
    }

    //生成经纪人房源
    function BuildAgentHouse(json) {
        if ( json && json.length > 0) {
            var code = "\
                <div class=\"content-item same-xq-fy \">\
                    <div class=\"title font16 bd_none\"><a id=\"" + clickStr + "_C08_05\" href=\"/house-xm" + houseInfo.projcode + "/\" target=\"blank\">经纪人热推房源</a></div>\
                    <div class=\"cont clearfix\" id=\"" + clickStr + "_C08_06\">\
                    ";
            for (var i = 0; i < json.length; i++) {
                var model = json[i];
                ChangePriceUnit(model);
                code += "\
                        <div class=\"img-out2-fy\">\
                            <a href=\"" + model.Url + "\" target=\"_blank\">\
                                <img src=\"" + model.TitleImg + "\">\
                            </a>\
                            <div class=\"img-out2-text\">\
                                <div class=\"io-text2\">\
                                    <span>" + model.RentWay + "</span>\
                                    <span>" + model.Room + "室" + model.Hall + "厅</span>\
                                    <div class=\"br-text\"><i>" + model.Price + "</i>" + model.PriceType + "</div>\
                                </div>\
                            </div>\
                        </div>\
                    ";
            }

            code += "\
                    </div>\
                </div>\
                    ";
            jQuery(".zf_new_right").append(code);
        }
    }

    //生成同小区房源
    function BuildProjectHouse(json) {
        if (json && json.length > 0) {
            var code = "\
                <div class=\"content-item same-xq-fy _ajaxhouse\" style='display:none;'>\
                    <div class=\"title font16 bd_none\"><a id=\"" + clickStr + "_C08_05\" href=\"/house-xm" + houseInfo.projcode + "/\" target=\"blank\">同小区在租房源</a></div>\
                    <div class=\"cont clearfix\" id=\"" + clickStr + "_C08_06\">\
                    ";
            for (var i = 0; i < json.length; i++) {
                var model = json[i];
                ChangePriceUnit(model);
                code += "\
                        <div class=\"img-out2-fy\">\
                            <a href=\"" + model.Url + "\" target=\"_blank\">\
                                <img src=\"" + model.TitleImg + "\">\
                            </a>\
                            <div class=\"img-out2-text\">\
                                <div class=\"io-text2\">\
                                    <span>" + model.RentWay + "</span>\
                                    <span>" + model.Room + "室" + model.Hall + "厅</span>\
                                    <div class=\"br-text\"><i>" + model.Price + "</i>" + model.PriceType + "</div>\
                                </div>\
                            </div>\
                        </div>\
                    ";
            }

            code += "\
                    </div>\
                </div>\
                    ";

            jQuery(".zf_new_right").append(code);
        }
    }



    //周边同价位房源
    function BuildAroundHouse(json) {
        if (json && json.length > 0) {

            var priceMax = houseInfo.price * (1 + 0.1);
            var priceMin = houseInfo.price * (1 - 0.1);

            var code = "\
                <div class=\"content-item same-jg-fy _ajaxhouse\" style='display:none;'>\
                    <div class=\"title font16 bd_none\"><a id=\"" + clickStr + "_C08_07\" href=\"/house/c2" + priceMin + "-d2" + priceMax + "-l310/\" target=\"blank\">周边同价位房源</a></div>\
                    <div class=\"cont clearfix\" id=\"" + clickStr + "_C08_08\">\
                    ";
            for (var i = 0; i < json.length; i++) {
                var model = json[i];
                ChangePriceUnit(model);
                code += "\
                        <div class=\"img-out2-fy\">\
                            <a href=\"" + model.Url + "\" target=\"_blank\">\
                                <img src=\"" + model.TitleImg + "\">\
                                <div class=\"io-text1\">" + model.District + "&emsp;" + model.ProjName + "</div>\
                            </a>\
                            <div class=\"img-out2-text\">\
                                <div class=\"io-text2\">\
                                    <span>" + model.RentWay + "</span>\
                                    <span>" + model.Room + "室" + model.Hall + "厅</span>\
                                    <div class=\"br-text\"><i>" + model.Price + "</i>" + model.PriceType + "</div>\
                                </div>\
                            </div>\
                        </div>\
                    ";
            }

            code += "\
                    </div>\
                </div>\
                    ";

            jQuery(".zf_new_right").append(code);
        }
    }

    //获取同小区房源
    function GetProjectHouse() {
        if (houseInfo.projcode > 0) {
            jQuery.ajax({
                url: "/RentDetails/Ajax/DetailProjectHouse.aspx",
                type: "post",
                dataType: "json",
                async: false,
                data: {
                    projcode: houseInfo.projcode,
                    houseid: houseInfo.houseid,
                    detailType: houseInfo.sourepage == 'zfpageagent' ? 'jjr' : "jx",
                    rentType: houseInfo.leaseStyle == '整租' ? 'zz' : 'hz',
                    purpose: escape(houseInfo.purpose),
                    room: houseInfo.room,
                    num: pageSize,
                    //cityname: houseInfo.cityName
                },
                success: function (json) {
                    BuildProjectHouse(json);
                    project_height = json==null?  0: getElemHeight(json.length);//计算该板块高度
                }
            });
        }
    }


    //获取周边房源
    function GetAroundHouse() {
        if (houseInfo.projcode > 0) {
            jQuery.ajax({
                url: "/RentDetails/Ajax/DetailAroundHouse.aspx",
                type: "post",
                dataType: "json",
                async: false,
                data: {
                    projcode: houseInfo.projcode,
                    codex: houseInfo.codex,
                    codey: houseInfo.codey,
                    distance: 3,
                    price: houseInfo.price,
                    detailType: houseInfo.sourepage == 'zfpageagent' ? 'jjr' : "jx",
                    rentType: houseInfo.leaseStyle == '整租' ? 'zz' : 'hz',
                    purpose: escape(houseInfo.purpose),
                    room: houseInfo.room,
                    num: pageSize,
                    //cityname: houseInfo.cityName
                },
                success: function (json) {
                    BuildAroundHouse(json);
                    around_height = json==null? 0: getElemHeight(json.length);//计算该板块高度
                }
            });
        }
    }



    //获取经纪人推荐
    function GetAgentHouse() {
        var timeStamp = new Date().getTime();
        if (houseInfo.projcode > 0 && houseInfo.agentIds != '') {
            jQuery.ajax({
                url: "/RentDetails/Ajax/DetailAgentHouse.aspx",
                type: "post",
                dataType: "json",
                async: false,
                data: {
                    projectId: houseInfo.projcode,
                    manageId: houseInfo.agentIds,
                    //projectId: '1010083800',
                    //manageId: '100937232',
                    dateBegin: dateFormat("yyyy-MM-dd",new Date(timeStamp - 7 * 24 * 3600 * 1000)),//定义为一周时间
                    num: pageSize,
                    //cityname: houseInfo.cityName
                },
                success: function (json) {
                    BuildAgentHouse(json.Data);
                    agent_height = json.Data == null ? 0 : getElemHeight(json.Data.length);//计算该板块高度
                }
            });
        }
    }

    //请求房源
    if (jQuery) {
        GetAgentHouse();
        GetProjectHouse();
        GetAroundHouse();

        var leftHeight = jQuery(".zf_new_left").height();//左侧房源描述和图片高度
        var rightHeight = agent_height + project_height + around_height;//右侧三个模块高度
        
        if (leftHeight >= rightHeight) {
            $('._ajaxhouse').show();
        }
    }

    /** JS 时间格式化
    *@param fmt 格式
    *@param date 时间戳
    */
    function dateFormat(fmt,date)   
    { 
        var o = {   
        "M+" : date.getMonth()+1,                 //月份   
        "d+" : date.getDate(),                    //日   
        "h+" : date.getHours(),                   //小时   
        "m+" : date.getMinutes(),                 //分   
        "s+" : date.getSeconds(),                 //秒   
        "q+" : Math.floor((date.getMonth()+3)/3), //季度   
        "S"  : date.getMilliseconds()             //毫秒   
        };   
        if(/(y+)/.test(fmt))   
        fmt=fmt.replace(RegExp.$1, (date.getFullYear()+"").substr(4 - RegExp.$1.length));   
        for(var k in o)   
        if(new RegExp("("+ k +")").test(fmt))   
        fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));   
        return fmt;   
    }


    //香港，澳门单位转换
    function ChangePriceUnit(house) {
        if (houseInfo.cityName == "香港" || houseInfo.cityName == "澳门") {
        //if (true) {
            house.Price = "$" + house.Price;
            house.PriceType = "/月";
        }
    }

}());