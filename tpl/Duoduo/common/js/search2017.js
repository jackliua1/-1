/// <reference path="mapinfo.js" />
(function (window, jQuery, undefined) {
    /*
    * 搜索框相关id
    */
    var config = {
        s: "suggestion", // 下拉框table
        k: "input_key",  // 搜索框
        p: "hppurpose",  // 隐藏房源类型
        f: "form_rent",  // 搜索表单
        d: "listbox"      // 下拉框div
    };

    var suggestion = document.getElementById(config.s),
            keyword = document.getElementById(config.k),
            hdpurpose = document.getElementById(config.p),
            form_rent = document.getElementById(config.f),
            searchlist = document.getElementById(config.d),
            tag2 = 0,
            index2 = 0,
    istejia = document.URL.indexOf("/tejia") > -1 ? true : false;
    isintegrate = document.URL.indexOf("/integrate") > -1 ? true : false;//是否聚合优选房源
    ishouse1 = document.URL.indexOf("/house1") > -1 ? true : false;//是否地铁
    isbus = document.URL.indexOf("/bus") > -1 ? true : false;//是否地铁
    ispinpaigongyu = document.URL.indexOf("a210") > -1 ? true : false;//是否品牌公寓

    // 搜索框相关事件
    var resizeTimer = null;
    jQuery(keyword).on({
        "keypress": function (e) {
            suggestion.style.display = '';
            e = e || window.event;
            if (e.keyCode == 13) {
                return false;
            }
        },
        "keyup": function (f) {
            if (resizeTimer) {
                clearTimeout(resizeTimer);
            }
            var self = this;
            resizeTimer = setTimeout(function () {
                f = f || window.event;
                if (__IsInput(f)) {
                    if (suggestion.style.display == "") {
                        if (f.keyCode == 13) {
                            if (index2 == 1) {
                                if (tag2 == 0) {
                                    if (suggestion.rows.length <= 1) {
                                        index2 = 0;
                                    } else {
                                        var e = suggestion.rows[index2].cells[0].innerHTML;
                                        self.value = e.substring(0, e.indexOf("<"));
                                        deal();
                                    }
                                } else {
                                    self.value = keyword.value;
                                    deal();
                                }
                            } else {
                                if (index2 > 1) {
                                    var e = suggestion.rows[index2].cells[0].innerHTML;
                                    self.value = e.substring(0, e.indexOf("<"));
                                    deal();
                                }
                            }
                            suggestion.style.display = 'none';
                            return false;
                        } else {
                            if (f.keyCode == 40) {
                                if (suggestion.rows.length > 1) {
                                    if (tag2 == 1) {
                                        tag2 = 0;
                                        suggestion.rows[1].className = "select";
                                    } else {
                                        suggestion.rows[index2].className = "item";
                                        index2++;
                                        if (index2 == suggestion.rows.length) {
                                            index2 = 1;
                                        }
                                        suggestion.rows[index2].className = "select";
                                    }
                                    var e = suggestion.rows[index2].cells[0].innerHTML;
                                    self.value = e.substring(0, e.indexOf("<"));
                                    hdpurpose.value = "";
                                }
                            } else {
                                if (f.keyCode == 38) {
                                    if (suggestion.rows.length > 1) {
                                        suggestion.rows[index2].className = "item";
                                        index2--;
                                        if (index2 < 1) {
                                            index2 = suggestion.rows.length - 1;
                                        }
                                        suggestion.rows[index2].className = "select";
                                        var e = suggestion.rows[index2].cells[0].innerHTML;
                                        self.value = e.substring(0, e.indexOf("<"));
                                        hdpurpose.value = "";
                                    }
                                } else {
                                    if (f.keyCode == 27) {
                                        suggestion.style.display = 'none';
                                    }
                                }
                            }
                        }
                    } else {
                        if (f.keyCode == 40) {
                            suggestion.style.display = '';
                        }
                    }
                } else {
                    autoList(self.value);
                }
            }, 200);
        },
        "focus": function () {
            if (this.value === '输入关键字(楼盘名或地段名)') { this.value = ''; }
            try {
                if (this.value === '') {
                    suggestion.style.display = '';
                    searchlist.style.display = '';
                    if (suggestion.rows.length <= 2) {
                        var l = throttle(autoList, 500, 1000);
                        l(this.value);
                    }
                }
            }
            catch (ex) { }
            this.className = 'inputstyle_out';
        }
    });
    // 表单提交等相关操作
    deal = function () {
        var target = document.getElementById("hp" + index2);
        if (target) {
            hdpurpose.value = target;
        }
        form_action2();
        form_rent.submit();
    };
    // 自动联想
    autoList = function (key) {
        var zuurl = "/RentSearch/PostService/Suggestion2017.aspx?omitzero=true&q=" + escape(key) + "&purpose=" + escape(hdpurpose.value);
        //if (istejia) {
        //    zuurl = "/RentSearch/PostService/Suggestion.aspx?jsoncallback=?&omitzero=true&istejia=true&q=" + escape(key) + "&purpose=" + escape(hdpurpose.value);
        //}
        //if (isintegrate) {
        //    zuurl = "/RentSearch/PostService/Suggestion.aspx?jsoncallback=?&omitzero=true&isintegrate=true&q=" + escape(key) + "&purpose=" + escape(hdpurpose.value);
        //}
        $.ajaxSettings.async = false;
        jQuery.getJSON(zuurl, function (data) {
            if (data) {
                if (data.length > 0) {
                    showHit(data);
                }
                else {
                    showHit({});
                }
            }
            else {
                showHit({});
            }
        });
        $.ajaxSettings.async = true;
    };
    document.onclick = function (e) {
        if (e && e.target.id !== "input_key") {
            if (keyword.value == '') { keyword.value = '输入关键字(楼盘名或地段名)'; }
            suggestion.style.display = 'none';
        }
    }
    // 联想框单击事件
    suggestion.onclick = function (e) {
        e = e || window.event;
        var f = e.target || e.srcElement;
        if (f.tagName == "SPAN") {
            f = f.parentNode
        }
        index2 = parseInt(f.parentNode.getAttribute("index2"));
        if (index2 > 0) {
            var d = f.parentNode.cells[0].innerHTML;
            if (d.indexOf("租房<") != -1) {
                keyword.value = d.substring(0, d.indexOf("租房<"));
            } else {
                keyword.value = d.substring(0, d.indexOf("<"));
            }

            if (!!document.getElementById("category" + index2)) {
                var category = document.getElementById("category" + index2).value;
                if (category == 6) {
                    document.getElementById("strDistrict2").value = keyword.value;
                    if (document.getElementById("currentKey")) {
                        document.getElementById("currentKey").value = keyword.value;
                    }
                    keyword.value = "";
                } else if (category == 7) {

                    document.getElementById("strcomarea").value = keyword.value;
                    if (!!document.getElementById("distract" + index2)) {
                        var district = document.getElementById("distract" + index2).innerHTML;
                        if (district.split(' ').length > 1) {
                            district = district.split(' ')[1];
                        }
                        document.getElementById("strDistrict2").value = district;
                    }
                    if (document.getElementById("currentKey")) {
                        document.getElementById("currentKey").value = keyword.value;
                    }
                    keyword.value = "";
                } else { document.getElementById("strDistrict2").value = ''; }
            }
            hdpurpose.value = document.getElementById("hp" + index2).value;
            if (document.getElementById("ju" + index2) != null) {
                document.getElementById("strRoom2").value = document.getElementById("ju" + index2).value;
                if (document.getElementById("strRoomnew_v") != null) {
                    document.getElementById("strRoomnew_v").value = document.getElementById("ju" + index2).value;
                }
            }
            if (document.getElementById("currentUrl")) {
                document.getElementById("currentUrl").value = location.href;
            }

            if (jQuery("#hp" + index2).val() == "社区")
            {
                jQuery("#CommunityID").val(jQuery("#community" + index2).val());
            }

            form_action2();
            form_rent.submit();

        }
        suggestion.style.display = "none";
    };
    // 加载数据
    showHit = function (json) {
        for (var i = suggestion.rows.length - 1; i > 0; i--) {
            suggestion.tBodies[0].removeChild(suggestion.rows[i]);
        }
        for (var i = 0, k = 0; i < json.length && k < 10; i++) {
            if ((document.getElementById('isnewhouse')) && (document.getElementById('isnewhouse').value == "2")) { }
            else {
                var projname = json[i].projname;
                if (json[i].category == 6 || json[i].category == 7) {
                    projname += '租房';
                }
                if (json[i].category == 1 && projname == keyword.value) {
                    for (var i = suggestion.rows.length - 1; i > 0; i--) {
                        suggestion.tBodies[0].removeChild(suggestion.rows[i]);
                    }
                }
                addRowSearch(json[i]);
                k++;
                if (!istejia) {   //不是特价房时候 才展示居室的数据
                    if ((json[i].category == 1 && json.length == 1) || (json[i].category == 1 && projname == keyword.value)) {
                        for (var j = 1; j < 5 && k < 10; j++) {
                            if (json[i]['rentcount' + j] != null && json[i]['rentcount' + j] != 0) {
                                var fenju = numToChinese(j) + '居  ' + json[i].district + ' ' + json[i].comerce;
                                addJuRowSearch(json[i].projname, fenju, j, istejia ? json[i]["salerentcount" + j] : json[i]['rentcount' + j], json[i].purpose, json[i].category);
                                k++;
                            }
                        }
                        break;
                    }
                }

            }
        }
        if (suggestion.rows.length > 1) {
            suggestion.style.display = '';
            searchlist.style.display = '';
            index2 = 1;
            tag2 = 1;
        }
        else {
            suggestion.style.display = 'none';
        }
    };
    addJuRowSearch = function (m, j, l, k, p, c) {
        var h = document.createElement("TR");
        h.setAttribute("index2", suggestion.rows.length);
        h.onmouseover = function () {
            var a = parseInt(this.getAttribute("index2"));
            if (a != index2 || index2 == 1) {
                if (index2 != -1) {
                    suggestion.rows[index2].className = "item"
                }
                this.className = "select";
                index2 = a;
            }
        };
        var g = document.createElement("th");
        g.innerHTML = m + "<span class='gray9' id='distract" + suggestion.rows.length + "'> " + j + "</span><input id=" + "hp" + suggestion.rows.length + " type='hidden'  value='" + p + "' /><input id=" + "ju" + suggestion.rows.length + " value='" + l + "' type='hidden'/><input id=" + "category" + suggestion.rows.length + " type='hidden' value='" + c + "' />";
        h.appendChild(g);
        td = document.createElement("TD");
        td.innerHTML = (istejia ? "<span style=\"color:red\">特价房</span>" : "") + "约" + k + "条房源";
        h.appendChild(td);
        suggestion.tBodies[0].appendChild(h);
    };
    //addRowSearch = function (m, j, l, k, p, c,id) {
    //    var h = document.createElement("TR");
    //    h.setAttribute("index2", suggestion.rows.length);
    //    h.onmouseover = function () {
    //        var a = parseInt(this.getAttribute("index2"));
    //        if (a != index2 || index2 == 1) {
    //            if (index2 != -1) {
    //                suggestion.rows[index2].className = "item";
    //            }
    //            this.className = "select";
    //            index2 = a;
    //        }
    //    };
    //    var g = document.createElement("th");
    //    var keyword = jQuery("#input_key").val();

    //    if (p == "社区") {
    //        jQuery(g).html(m + "\
    //                        <span class='gray9' id='distract" + suggestion.rows.length + "' > " + p + "</span>\
    //                        <input id=hp" + suggestion.rows.length + " type='hidden' value='" + p + "' />\
    //                        <input id=category" + suggestion.rows.length + " type='hidden' value='" + c + "' />\
    //                        <input id=community" + suggestion.rows.length + " type='hidden' value='" + id + "' />");
    //                        //<input id=content" + suggestion.rows.length + " type='hidden' value='" + m + "' />");
    //        //jQuery(g).append("<input id=community" + suggestion.rows.length + " type='hidden' value='" + id + "' />");
    //    }
    //    else {
    //        jQuery(g).html(m + "<span class='gray9' id='distract" + suggestion.rows.length + "' > " + j + " " + l + "</span>\
    //                        <input id=hp" + suggestion.rows.length + " type='hidden' value='" + p + "' />\
    //                        <input id=category" + suggestion.rows.length + " type='hidden' value='" + c + "' />");
    //    }

    //    h.appendChild(g);
    //    td = document.createElement("TD");
    //    td.innerHTML = (istejia ? "<span style=\"color:red\">特价房</span>" : "") + "约" + k + "条房源";
    //    h.appendChild(td);
    //    suggestion.tBodies[0].appendChild(h);
    //};
    addRowSearch = function (json) {
        var h = document.createElement("TR");
        h.setAttribute("index2", suggestion.rows.length);
        h.onmouseover = function () {
            var a = parseInt(this.getAttribute("index2"));
            if (a != index2 || index2 == 1) {
                if (index2 != -1) {
                    suggestion.rows[index2].className = "item";
                }
                this.className = "select";
                index2 = a;
            }
        };
        var g = document.createElement("th");
        var keyword = jQuery("#input_key").val();

        if (json.purpose == "社区") {
            jQuery(g).html(json.projname + " <span class='gray9' id='distract" + suggestion.rows.length + "' >" + json.purpose + "</span>\
                            <input id=hp" + suggestion.rows.length + " type='hidden' value='" + json.purpose + "' />\
                            <input id=category" + suggestion.rows.length + " type='hidden' value='" + json.category + "' />\
                            <input id=community" + suggestion.rows.length + " type='hidden' value='" + json.id + "' />");
        } else if (ispinpaigongyu && json.flatcount > 0)
        {//当前品牌公寓列表,且有公寓房源
            jQuery(g).html(json.projname + " <span class='gray9' id='distract" + suggestion.rows.length + "' >品牌公寓</span>\
                            <input id=hp" + suggestion.rows.length + " type='hidden' value='" + json.purpose + "' />\
                            <input id=category" + suggestion.rows.length + " type='hidden' value='" + json.category + "' />");
        }
        else {
            //当楼盘有别名时
            if (json.projmainname && json.projmainname != '' && json.projaliasnames && json.projaliasnames.length > 0) {
                var mainName = json.projmainname;
                var aliasName = '';
                
                for (var i = 0; i < json.projaliasnames.length; i++) {
                    if (json.projaliasnames[i].indexOf(keyword) > -1) {
                        aliasName = json.projaliasnames[i];
                        break;
                    }
                }

                if (aliasName == '') {
                    aliasName = json.projaliasnames[0];
                }

                jQuery(g).html(mainName + "<span class='gray9'>(" + aliasName + ")</span><span class='gray9' id='distract" + suggestion.rows.length + "' > " + json.district + " " + json.comerce + "</span>\
                            <input id=hp" + suggestion.rows.length + " type='hidden' value='" + json.purpose + "' />\
                            <input id=category" + suggestion.rows.length + " type='hidden' value='" + json.category + "' />");
            }
            else
            {
                jQuery(g).html(json.projname + "<span class='gray9' id='distract" + suggestion.rows.length + "' > " + json.district + " " + json.comerce + "</span>\
                            <input id=hp" + suggestion.rows.length + " type='hidden' value='" + json.purpose + "' />\
                            <input id=category" + suggestion.rows.length + " type='hidden' value='" + json.category + "' />");
            }
        }

        h.appendChild(g);

        td = document.createElement("TD");
        if (ispinpaigongyu && json.flatcount > 0)
        {
            td.innerHTML = "约" + json.flatcount + "条房源";
        }
        else if (istejia) {
            td.innerHTML = "<span style=\"color:red\">特价房</span>约" + json.salerentcount + "条房源";
        }
        else if (isintegrate) {
            td.innerHTML = "约" + json.excellentrentcount + "条房源";
        }
        else {
            td.innerHTML = "约" + json.rentcount + "条房源";
        }
        h.appendChild(td);
        suggestion.tBodies[0].appendChild(h);
    };
    numToChinese = function (i) {
        var chinese = ['一', '二', '三', '四'];
        if (i > 0 && i < 5) {
            return chinese[i - 1];
        }
        return '一';

    };
    //更新提交表单
    form_action2 = function () {
        var IsMapSearch = "";
        if (arguments.length == 1) {
            IsMapSearch = arguments[0];
        }
        if (keyword.value === '输入关键字(楼盘名或地段名)') {
            keyword.value = '';
        }
        jQuery('#strPurpose2').val(hdpurpose.value);
        if (document.getElementById("strRoomnew_v") != null) {
            jQuery('#strRoom2').val(jQuery("#strRoomnew_v").val());
        }
        jQuery('#strPriceMin2').val('');
        jQuery('#strPriceMax2').val('');

        if (keyword.value === '') {
            jQuery('#strKeyword2').val('');
            jQuery('#strNameKeyword22').val('');
        }
        else {
            jQuery('#strKeyword2').val(htmlencode(keyword.value));
            jQuery('#strNameKeyword22').val(htmlencode(keyword.value));
        }
        
        var typeid = jQuery("#ul_navTitle").find("li[class='on']").attr("typeid");
        jQuery('#houseType222').val(typeid);
        
        if (istejia) {
            //jQuery('#istejia').val("yes");
            jQuery('#searchtype').val("1");
        }
        else if (isintegrate) {
            jQuery('#searchtype').val("2");
        }
        else if (ishouse1) {
            jQuery('#searchtype').val("3");
        }
        else if (isbus) {
            jQuery('#searchtype').val("4");
        }
    };

    function htmlencode(str) {

        str = str.replace(/<\/?[^>]*>/g, ''); //去除HTML tag
        //str = str.replace(/[ | ]*\n/g,'\n'); //去除行尾空白
        //str = str.replace(/\n[\s| | ]*\r/g,'\n'); //去除多余空行
        str = str.replace(/ /ig, '');//去掉 
        return str;

    }

    __IsInput = function (b) {
        return __IsSelect(b) || __IsMove(b) || b.keyCode == 9 || b.keyCode == 13
    };
    __IsSelect = function (b) {
        if (b.shiftKey || (b.ctrlKey && b.shiftKey)) {
            return (b.keyCode >= 35 && b.keyCode <= 40)
        } else {
            if (b.ctrlKey && !b.shiftKey) {
                return b.keyCode == 65
            } else {
                return false
            }
        }
    };
    __IsMove = function (b) {
        return (b.keyCode >= 35 && b.keyCode <= 40)
    };

    var bodies = [document, document.body];
    for (var i = 0; i < bodies.length; i++) {
        jQuery(bodies[i]).on('click', function (ev) {
            ev = ev || window.event;
            var target = ev.target || ev.srcElement;
            if (suggestion.style.display == '' && target != keyword) {
                suggestion.style.display = 'none';
            }
        });
        break;
    }
    function throttle(method, delay, duration) {
        var timer = null, begin = new Date();
        return function () {
            var context = this, args = arguments, current = new Date();;
            clearTimeout(timer);
            if (current - begin >= duration) {
                method.apply(context, args);
                begin = current;
            } else {
                timer = setTimeout(function () {
                    method.apply(context, args);
                }, delay);
            }
        }
    }
    //根据滚动条位置弹出搜索浮层
    $(window).scroll(function () {
        if (floatingConfig.enable) {
            setTimeout(function () {

                var top = $(this).scrollTop();
                var flowSearch = $(".searchbg-floating");
                if (top - 120 < 0) {
                    //浮动搜索框隐藏，淡入效果 
                    flowSearch.css("display", "none");
                    var form = $("#form_rent");
                    var div1 = $("#list_D01_01");
                    div1.append(form);
                } else {
                    flowSearch.css("display", "block");
                    var form = $("#form_rent");
                    var div2 = $("#list_D01_03");
                    div2.append(form);
                }
            }, 300)
           
        }

    });
    var floatingConfig = {
        enable: true//是否启用搜索浮层
    };
    //删除浮层
    deleteFloating = function () {
        var flowSearch = $(".searchbg-floating");
        flowSearch.css("display", "none");
        var form = $("#form_rent");
        var div1 = $("#list_D01_01");
        div1.append(form);
        disableSearchFloating();
    };
    //禁用浮层
    disableSearchFloating = function () {
        floatingConfig.enable = false;
    };
}(window, jQuery))