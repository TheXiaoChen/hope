const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 6000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});


function getChecked(node) {
    let re = false;
    $('input.' + node).each(function (i) {
        if (this.checked) {
            re = true;
        }
    });
    return re;
}

function timestamp() {
    return new Date().getTime();
}
function hp_delete(id, property, token) {
    let url, msg;
    let text = '删除后可能无法恢复'
    switch (property) {
        case 'article':
            url = '?act=article&del&id=' + id;
            msg = '确定要删除该篇文章吗？';
            break;
        case 'tw':
            url = '?act=twitter&del&id=' + id;
            msg = '确定要删除该笔记吗？';
            break;
        case 'comment':
            url = '?act=comment&del&id=' + id;
            msg = '确定要删除该评论吗？';
            break;
        case 'commentbyip':
            url = '?act=comment&delbyip&ip=' + id;
            msg = '确定要删除来自该IP的所有评论吗？';
            break;
        case 'link':
            url = '?act=link&del&linkid=' + id;
            msg = '确定要删除该链接吗？';
            break;
        case 'menu':
            url = '?act=menu&del&id=' + id;
            msg = '确定要删除该菜单吗？';
            break;
        case 'upload':
            url = '?act=upload&del&aid=' + id;
            msg = '确定要删除该附件吗？';
            break;
        case 'avatar':
            url = '?act=blogger&delicon';
            msg = '确定要删除头像吗？';
            break;
        case 'category':
            url = '?act=category&del&sid=' + id;
            msg = '确定要删除该分类吗？';
            break;
        case 'del_user':
            url = '?act=user&del&uid=' + id;
            msg = '确定要删除该用户吗？';
            break;
        case 'forbid_user':
            url = '?act=user&forbid&uid=' + id;
            msg = '确定要禁用该用户吗？';
            text = '';
            break;
        case 'tpl':
            url = '?act=theme&del&tpl=' + id;
            msg = '确定要删除该模板吗？';
            break;
        case 'reset_widget':
            url = '?act=widgets&reset';
            msg = '确定要恢复组件设置到初始状态吗？这样会丢失你自定义的组件。';
            text = '';
            break;
        case 'plu':
            url = '?act=plugin&del&plugin=' + id;
            msg = '确定要删除该插件吗？';
            break;
        case 'upload_sort':
            url = '?act=upload&del_upload_sort&id=' + id;
            msg = '确定要删除该资源分类吗？';
            text = '不会删除分类下资源文件';
            break;
    }
    if(property == 'article'){
        Swal.fire({
            title: msg,
            text: text,
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "彻底删除",
            cancelButtonText: '取消',
            denyButtonText: '存入草稿'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location = url + '&token=' + token;
            } else if (result.isDenied) {
                window.location = url + '&draft&token=' + token;
            }
          });

    }else{
        Swal.fire({
            title: msg,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: '取消',
            confirmButtonText: '确定'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = url + '&token=' + token;
            }
        });
    }
}

function changePerPage(select) {
    const params = new URLSearchParams(window.location.search);
    params.set('perpage_num', select.value);
    params.set('page', '1');
    window.location.search = params.toString();
}
function submitForm(formId, successMsg) {
    $.ajax({
        type: "POST", 
        url: $(formId).attr('action'),
        data: $(formId).serialize(),
        success: function() {
            Toast.fire({
                icon: 'success',
                title: successMsg || '保存成功'
            });
        },
        error: function(xhr) {
            const errorMsg = JSON.parse(xhr.responseText).msg;
            Toast.fire({
                icon: 'error', 
                title: errorMsg
            });
        }
    });
}

function focusEle(id) {
    try {
        document.getElementById(id).focus();
    } catch (e) {
    }
}

function hideActived() {
    $(".alert-success").slideUp(300);
    $(".alert-danger").slideUp(300);
}

// Click action of [More Options] 
let icon_mod = "down";

function displayToggle(id) {
    $("#" + id).toggle();
    if (icon_mod === "down") {
        icon_mod = "right";
        $(".icofont-simple-down").attr("class", "icofont-simple-right")
    } else {
        icon_mod = "down";
        $(".icofont-simple-right").attr("class", "icofont-simple-down")
    }

    Cookies.set('em_' + id, icon_mod, {expires: 365})
}

function doToggle(id) {
    $("#" + id).toggle();
}

function insertTag(tag, boxId) {
    var targetinput = $("#" + boxId).val();
    if (targetinput == '') {
        targetinput += tag;
    } else {
        var n = ',' + tag;
        targetinput += n;
    }
    $("#" + boxId).val(targetinput);
    if (boxId == "tag") $("#tag_label").hide();
}

function isalias(a) {
    var reg1 = /^[\u4e00-\u9fa5\w-]*$/;
    var reg2 = /^[\d]+$/;
    var reg3 = /^post(-\d+)?$/;
    if (!reg1.test(a)) {
        return 1;
    } else if (reg2.test(a)) {
        return 2;
    } else if (reg3.test(a)) {
        return 3;
    } else if (a == 't' || a == 'm' || a == 'admin') {
        return 4;
    } else {
        return 0;
    }
}

function checkform() {
    var a = $.trim($("#alias").val());
    var t = $.trim($("#title").val());

    if (typeof articleTextRecord !== "undefined") {  // 提交时，重置原文本记录值，防止出现离开提示
        articleTextRecord = $("textarea[name=logcontent]").text();
    } else {
        pageText = $("textarea").text();
    }
    if (0 == isalias(a)) {
        return true;
    } else {
        alert("链接别名错误");
        $("#alias").focus();
        return false;
    }
}

function checkalias() {
    var a = $.trim($("#alias").val());
    if (1 == isalias(a)) {
        $("#alias_msg_hook").html('<span id="input_error">别名错误，应由字母、数字、下划线、短横线组成</span>');
    } else if (2 == isalias(a)) {
        $("#alias_msg_hook").html('<span id="input_error">别名错误，不能为纯数字</span>');
    } else if (3 == isalias(a)) {
        $("#alias_msg_hook").html('<span id="input_error">别名错误，不能为\'post\'或\'post-数字\'</span>');
    } else if (4 == isalias(a)) {
        $("#alias_msg_hook").html('<span id="input_error">别名错误，与系统链接冲突</span>');
    } else {
        $("#alias_msg_hook").html('');
        $("#msg").html('');
    }
}

function insert_cover(imgsrc) {
    $('#cover_image').attr('src', imgsrc);
    $('#cover').val(imgsrc);
    $('#cover_rm').show();
}

// act 1：auto save 2：save
function autosave(act) {
    const nodeid = "as_logid";
    const timeout = 60000;
    const url = "article_save.php?action=autosave";
    const alias = $.trim($("#alias").val());
    const content = Editor.getMarkdown();
    let ishide = $.trim($("#ishide").val());
    if (ishide === "") {
        $("#ishide").val("y")
    }

    if (alias != '' && 0 != isalias(alias)) {
        $("#msg").show().html("链接别名错误，自动保存失败");
        if (act == 0) {
            setTimeout("autosave(1)", timeout);
        }
        return;
    }
    // 编辑发布状态的文章时不自动保存
    if (act == 1 && ishide == 'n') {
        return;
    }
    // 内容为空时不自动保存
    if (act == 1 && content == "") {
        setTimeout("autosave(1)", timeout);
        return;
    }
    // 距离上次保存成功时间小于一秒时不允许手动保存
    if ((new Date().getTime() - Cookies.get('em_saveLastTime')) < 1000 && act != 1) {
        alert("请勿频繁操作！");
        return;
    }
    const btname = $("#savedf").val();
    $("#savedf").val("正在保存中...");
    $('title').text('[保存中] ' + titleText);
    $("#savedf").attr("disabled", "disabled");
    $.post(url, $("#addlog").serialize(), function (data) {
        data = $.trim(data);
        var isresponse = /.*autosave\_gid\:\d+\_.*/;
        if (isresponse.test(data)) {
            const getvar = data.match(/_gid:([\d]+)_/);
            const logid = getvar[1];
            const d = new Date();
            const h = d.getHours();
            const m = d.getMinutes();
            const s = d.getSeconds();
            const tm = (h < 10 ? "0" + h : h) + ":" + (m < 10 ? "0" + m : m);
            $("#save_info").html("保存于：" + tm + " <a href=\"../../?post=" + logid + "\" target=\"_blank\">预览文章</a>");
            $('title').text('[保存成功] ' + titleText);
            articleTextRecord = $("#addlog textarea[name=logcontent]").val(); // 保存成功后，将原文本记录值替换为现在的文本
            Cookies.set('em_saveLastTime', new Date().getTime()); // 把保存成功时间戳记录（或更新）到 cookie 中
            $("#" + nodeid).val(logid);
            $("#savedf").attr("disabled", false).val(btname);
        } else {
            $("#savedf").attr("disabled", false).val(btname);
            $("#save_info").html("保存失败，可能文章不可编辑或达到每日发文限额").addClass("alert-danger");
            $('title').text('[保存失败] ' + titleText);
        }
    });
    if (act == 1) {
        setTimeout("autosave(1)", timeout);
    }
}

// “页面”的 editor.md 编辑器 Ctrl + S 快捷键的自动保存动作
//const pagetitle = $('title').text();

function pagesave() {
    document.addEventListener('keydown', function (e) {  // 阻止自动保存产生的浏览器默认动作
        if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
            e.preventDefault();
        }
    });
    let url = "page.php?action=save";
    if ($("[name='pageid']").attr("value") < 0) return alert("请先保存页面！");
    if (!$("[name='pagecontent']").html()) return alert("页面内容不能为空！");
    $('title').text('[保存中...] ' + pagetitle);
    $.post(url, $("#addlog").serialize(), function (data) {
        $('title').text('[保存成功] ' + pagetitle);
        setTimeout(function () {
            $('title').text(pagetitle);
        }, 2000);
        pageText = $("textarea").text();
    }).fail(function () {
        $('title').text('[保存失败] ' + pagetitle);
        alert("保存失败！")
    });
}

// toggle plugin
$.fn.toggleClick = function () {
    var functions = arguments;
    return this.click(function () {
        var iteration = $(this).data('iteration') || 0;
        functions[iteration].apply(this, arguments);
        iteration = (iteration + 1) % functions.length;
        $(this).data('iteration', iteration);
    });
};

function removeHTMLTag(str) {
    str = str.replace(/<\/?[^>]*>/g, ''); //去除HTML tag
    str = str.replace(/[ | ]*\n/g, '\n'); //去除行尾空白
    str = str.replace(/ /ig, '');
    return str;
}

// 表格全选
$(function () {
    $('#checkAll').click(function (event) {
        let tr_checkbox = $('table tbody tr').find('input[type=checkbox]');
        tr_checkbox.prop('checked', $(this).prop('checked'));
        event.stopPropagation();
    });
    // 点击表格每一行的checkbox，表格所有选中的checkbox数 = 表格行数时，则将表头的‘checkAll’单选框置为选中，否则置为未选中
    $('table tbody tr').find('input[type=checkbox]').click(function (event) {
        let tbr = $('table tbody tr');
        $('#checkAll').prop('checked', tbr.find('input[type=checkbox]:checked').length == tbr.length ? true : false);
        event.stopPropagation();
    });
});

// 卡片全选
$(function () {
    $('#checkAllCard').click(function (event) {
        let card_checkbox = $('.card-body').find('input[type=checkbox]');
        card_checkbox.prop('checked', $(this).prop('checked'));
        event.stopPropagation();
    });
    $('.card-body').find('input[type=checkbox]').click(function (event) {
        let cards = $('.card-body');
        $('#checkAllCard').prop('checked', cards.find('input[type=checkbox]:checked').length == cards.length ? true : false);
        event.stopPropagation();
    });
});


// editor.md 的 js 钩子
var queue = new Array();
var hooks = {
    addAction: function (hook, func) {
        if (typeof (queue[hook]) == "undefined" || queue[hook] == null) {
            queue[hook] = new Array();
        }
        if (typeof func == 'function') {
            queue[hook].push(func);
        }
    }, doAction: function (hook, obj) {
        try {
            for (var i = 0; i < queue[hook].length; i++) {
                queue[hook][i](obj);
            }
        } catch (e) {
        }
    }
}

// 粘贴上传图片函数
function imgPasteExpand(thisEditor) {
    var listenObj = document.querySelector("textarea").parentNode  // 要监听的对象
    var postUrl = './media.php?action=upload';  // emlog 的图片上传地址
    var emMediaPhpUrl = "./media.php?action=lib";  // emlog 的资源库地址,用于异步获取上传后的图片数据

    // 通过动态配置只读模式,阻止编辑器原有的粘贴动作发生,并恢复光标位置
    function preventEditorPaste() {
        let l = thisEditor.getCursor().line;
        let c = thisEditor.getCursor().ch - 3;

        thisEditor.config({readOnly: true,});
        thisEditor.config({readOnly: false,});
        thisEditor.setCursor({line: l, ch: c});
    }

    // 编辑器通过光标处位置前几位来替换文字
    function replaceByNum(text, num) {
        let l = thisEditor.getCursor().line;
        let c = thisEditor.getCursor().ch;

        thisEditor.setSelection({line: l, ch: (c - num)}, {line: l, ch: c});
        thisEditor.replaceSelection(text);
    }

    // 粘贴事件触发
    listenObj.addEventListener("paste", function (e) {
        if ($('.editormd-dialog').css('display') == 'block') return;  // 如果编辑器有对话框则退出
        if (!(e.clipboardData && e.clipboardData.items)) return;

        var pasteData = e.clipboardData || window.clipboardData; // 获取剪切板里的全部内容
        pasteAnalyseResult = new Array;  // 用于储存遍历分析后的结果

        for (var i = 0; i < pasteData.items.length; i++) {  // 遍历分析剪切板里的数据
            var item = pasteData.items[i];

            if ((item.kind == "file") && (item.type.match('^image/'))) {
                var imgData = item.getAsFile();
                if (imgData.size === 0) return;
                pasteAnalyseResult['type'] = 'img';
                pasteAnalyseResult['data'] = imgData;
                break;  // 当粘贴板中有图片存在时,跳出循环
            }
            ;
        }

        if (pasteAnalyseResult['type'] == 'img') {  // 如果剪切板中有图片,上传图片
            preventEditorPaste();
            uploadImg(pasteAnalyseResult['data']);
            return;
        }
    }, false);

    // 上传图片
    function uploadImg(img) {
        var formData = new FormData();
        var imgName = "粘贴上传" + new Date().getTime() + "." + img.name.split(".").pop();

        formData.append('file', img, imgName);
        thisEditor.insertValue("上传中...");
        $.ajax({
            url: postUrl, type: 'post', data: formData, processData: false, contentType: false, xhr: function () {
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    thisEditor.insertValue("....");
                    xhr.upload.addEventListener('progress', function (e) {  // 用以显示上传进度
                        console.log('进度(byte)：' + e.loaded + ' / ' + e.total);
                        let percent = Math.floor(e.loaded / e.total * 100);
                        if (percent < 10) {
                            replaceByNum('..' + percent + '%', 4);
                        } else if (percent < 100) {
                            replaceByNum('.' + percent + '%', 4);
                        } else {
                            replaceByNum(percent + '%', 4);
                        }
                    }, false);
                }
                return xhr;
            }, success: function (result) {
                console.log('上传成功！正在获取结果...');
                $.get(emMediaPhpUrl, function (resp) {
                    var image = resp.data.images[0];
                    if (image) {
                        console.log('获取结果成功！')
                        replaceByNum(`[![](${image.media_icon})](${image.media_url})`, 10);  // 这里的数字 10 对应着’上传中...100%‘是10个字符
                    } else {
                        console.log('获取结果失败！')
                        alert('获取结果失败！');
                    }
                })
            }, error: function (result) {
                alert('上传失败,图片类型错误或网络错误');
                replaceByNum('上传失败,图片类型错误或网络错误', 6);
            }
        })
    }
}

// 把粘贴上传图片函数，挂载到位于文章编辑器、页面编辑器处的 js 钩子处
hooks.addAction("loaded", imgPasteExpand);
hooks.addAction("page_loaded", imgPasteExpand);

function checkupdate() {
    $("#upmsg").html("").addClass("spinner-border text-primary");
    $.get("./upgrade.php?action=check_update", function (result) {
        if (result.code == 1001) {
            $("#upmsg").html("您的emlog pro尚未注册，<a href=\"auth.php\">去注册</a>").removeClass();
        } else if (result.code == 1002) {
            $("#upmsg").html("已经是最新版本").removeClass();
        } else if (result.code == 200) {
            $("#upmsg").html("有可用的新版本 " + result.data.version + "，<a href=\"https://www.emlog.net/docs/#/changelog\" target=\"_blank\">查看更新内容</a>，<a id=\"doup\" href=\"javascript:doup('" + result.data.file + "','" + result.data.sql + "');\">现在更新</a>").removeClass();
        } else {
            $("#upmsg").html("检查失败，可能是网络问题").removeClass();
        }
    });
}

function doup(source, upsql) {
    $("#upmsg").html("正在更新中，请耐心等待").addClass("ajaxload");
    $.get('./upgrade.php?action=update&source=' + source + "&upsql=" + upsql, function (data) {
        $("#upmsg").removeClass();
        if (data.match("succ")) {
            $("#upmsg").html('恭喜您！更新成功了，请<a href="./">刷新页面</a>开始体验新版emlog');
        } else if (data.match("error_down")) {
            $("#upmsg").html('下载更新失败，可能是服务器网络问题');
        } else if (data.match("error_zip")) {
            $("#upmsg").html('解压更新失败，可能是你的服务器空间不支持zip模块');
        } else if (data.match("error_dir")) {
            $("#upmsg").html('更新失败，目录不可写');
        } else {
            $("#upmsg").html('更新失败');
        }
    });
}

function loadTopAddons() {
    $.ajax({
        type: 'GET', url: './store.php?action=top', success: function (resp) {
            $.each(resp.data, function (i, app) {
                let insertBtnHtml;
                let typeName = '模板：';
                let storeUlr = './store.php?';
                if (app.type === 'plu') {
                    typeName = '插件：';
                    storeUlr = './store.php?action=plu';
                }
                if (app.price > 0) {
                    insertBtnHtml = '应用售价：' + app.price + '元<a href="' + app.buy_url + '" target="_blank">购买</a>';
                } else {
                    insertBtnHtml = '应用售价：免费<a href="' + storeUlr + '&keyword=' + app.name + '">去商店安装</a>';
                }
                const cardHtml = '<div class="col-md-4">' + '<div class="card">' + '<a href="' + app.buy_url + '" target="_blank"><img class="card-img-top" style="max-height: 90px;" src="' + app.icon + '" alt="icon"/></a>' + '<div class="card-body">' + '<div class="card-text text-muted small">' + typeName + app.name + '</div>' + '<p class="card-text d-flex justify-content-between small">' + insertBtnHtml + '</p>' + '</div></div></div>';
                $('#app-list').append(cardHtml);
            });
        },
    });
}

$(function () {
    // 网页加载完先检查一遍
    // 设置界面，如果设置“自动检测地址”，则设置 input 为只读，以表示该项是无效的
    if ($("#detect_url").prop("checked")) {
        $("[name=siteurl]").attr("readonly", "readonly")
    }

    $("#detect_url").click(function () {
        if ($(this).prop("checked")) {
            $("[name=siteurl]").attr("readonly", "readonly")
        } else {
            $("[name=siteurl]").removeAttr("readonly")
        }
    })

    // store app install
    $('.installBtn').click(function (e) {
        e.preventDefault();
        let link = $(this);
        let down_url = link.data('url');
        let type = link.data('type');
        link.text('安装中…');
        link.prev(".installMsg").html("").addClass("spinner-border text-primary");

        let url = './store.php?action=install&type=' + type + '&source=' + down_url;
        $.get(url, function (data) {
            link.text('免费安装');
            link.prev(".installMsg").html('<span class="text-danger">' + data + '</span>').removeClass("spinner-border text-primary");
        });
    });
     
    $('#cover').on('mouseenter', function(e){
        var src = $.trim($(this).val());
        if (!src) return; // 无 URL 则不显示预览
        // 移除已有预览，避免重复
        $('#cover-tip').remove();
        var $tip = $('<div id="cover-tip" class="tip" style="position:absolute; z-index:9999; display:none; border:1px solid rgba(0,0,0,0.08); background:#fff; padding:4px; box-shadow:0 6px 18px rgba(0,0,0,0.12);"><img src="' + src + '" style="max-width:260px; max-height:180px; display:block;"/></div>');
        $('body').append($tip);
        $tip.show();
    }).on('mousemove', function(e){
        var $tip = $('#cover-tip');
        if ($tip.length) {
            var left = e.pageX + 12;
            var top = e.pageY + 12;
            var w = $tip.outerWidth();
            var h = $tip.outerHeight();
            var docW = $(window).width();
            var docH = $(window).height();
            // 超出右边界则显示在光标左侧
            if (left + w > docW) left = e.pageX - w - 12;
            // 超出下边界则显示在光标上方
            if (top + h > docH) top = e.pageY - h - 12;
            $tip.css({ left: left, top: top });
        }
    }).on('mouseleave', function(){
        $('#cover-tip').remove();
    });
    // 输入变化时，如果预览存在则更新图片
    $('#cover').on('input propertychange change', function(){
        var $tip = $('#cover-tip');
        if ($tip.length) {
            var src = $.trim($(this).val());
            $tip.find('img').attr('src', src);
        }
    });
    $('#upload_cover').on('change', function(event) {
        var files = event.target.files;
        if (!files || files.length === 0) return;
        
        var file = files[0];
        var inputElement = event.target; // 保存 input 元素引用
        
        // 创建 FormData 并添加文件
        var formData = new FormData();
        formData.append('image', file);
        
        // 显示上传中状态
        var $icon = $(inputElement).closest('label').find('i');
        var origHtml = $icon.prop('outerHTML');
        $icon.replaceWith('<i class="fa fa-spinner fa-spin"></i>');
        
        $.ajax({
            url: '?act=upload&upload_cover',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                // 处理上传成功的响应
                var path = '';
                if (resp) {
                    if (typeof resp === 'string') {
                        path = resp;
                    } else if (resp.code && resp.code === 1 && resp.data) {
                        path = resp.data;
                    } else if (resp.data) {
                        path = resp.data;
                    }
                }
                
                if (path) {
                    $('#cover').val(path).trigger('change');
                    if ($('#cover_image').length) {
                        $('#cover_image').attr('src', path);
                    }
                    if ($('#cover_rm').length) {
                        $('#cover_rm').show();
                    }
                    if (typeof Toast !== 'undefined') {
                        Toast.fire({ icon: 'success', title: '上传成功' });
                    }
                } else {
                    if (typeof Toast !== 'undefined') {
                        Toast.fire({ icon: 'error', title: '上传失败' });
                    } else {
                        alert('上传失败');
                    }
                }
            },
            error: function() {
                if (typeof Toast !== 'undefined') {
                    Toast.fire({ icon: 'error', title: '上传失败' });
                } else {
                    alert('上传失败');
                }
            },
            complete: function() {
                // 恢复图标
                $(inputElement).closest('label').find('i.fa-spinner').replaceWith(origHtml);
                // 清空选择，方便再次上传相同文件
                $(inputElement).val('');
            }
        });
    });

})