<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
<link href="<?= SITE_URL ?>content/admin/editor.md/css/editormd.css?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" rel="stylesheet" />
<style>
.fa { width:auto }
#preset_box .form-group { margin-bottom: auto; }
</style>
<div id="editor-md-dialog"></div>
<form action="<?= SELF ?>?act=page_edit" method="post" enctype="multipart/form-data" id="editlog" name="editlog">
    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="card card-body">
                <div class="d-lg-flex">
                    <h5 class="mb-0"><?= $pagetitle ?></h5>
                    <div class="ms-auto">
                        <input type="hidden" name="gid" id="gid" value="<?= $pageId ?>"/>
                        <button type="button" id="save" class="btn bg-gradient-success btn-light m-0" onclick="checkPage(1);">保存</button>
                        <button type="submit" class="btn bg-gradient-primary m-0 ms-2" onclick="return checkPage();">提交</button>
                    </div>
                </div>
                <hr class="horizontal dark my-2">
                <input type="text" class="form-control" placeholder="文章标题" id="title" name="title" value="<?= $title ?>" required>
                <div class="d-flex align-items-center mt-2 mb-2">
                    <button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-bs-target="#mediaModal">
                        <i class="fa fa-folder-open"></i> 资源库
                    </button>
                </div>
                <div id="logcontent" style="border-radius: .5rem;">
                    <textarea style="display:none;"><?= $content ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 mt-4 mt-lg-0">
            <div class="card card-body" id="option">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="collapse" data-bs-target="#Basic" aria-controls="Basic" aria-selected="true">
                                <i class="ni ni-badge text-sm me-2"></i> 基本选项
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="Basic" class="accordion-collapse collapse show" data-bs-parent="#option"
                    aria-expanded="true">
                    <div class="form-group">
                        <label>文章封面</label>
                        <div class="input-group input-group-alternative mb-4">
                            <input name="cover" id="cover" class="form-control" placeholder="封面图URL" value="<?= $cover ?>">
                            <span class="input-group-text">
                                <label for="upload_cover" style="margin-bottom:0; cursor:pointer;">
                                    <i class="ni ni-cloud-upload-96"></i>
                                    <input type="file" id="upload_cover" accept="image/*" style="display:none" />
                                </label>
                            </span>
                        </div>
                        <select class="form-control" name="sort" id="sort" placeholder="页面模板">
                        <option value="-1">选择模板...</option>
                            <?php
                            foreach ($sorts as $key => $value):
                                if ($value['pid'] != 0) {
                                    continue;
                                }
                                $flg = $value['sid'] == $sortid ? 'selected' : '';
                                ?>
                                <option value="<?= $value['sid'] ?>" <?= $flg ?>><?= $value['sortname'] ?></option>
                                <?php
                                $children = $value['children'];
                                foreach ($children as $key):
                                    $value = $sorts[$key];
                                    $flg = $value['sid'] == $sortid ? 'selected' : '';
                                    ?>
                                    <option value="<?= $value['sid'] ?>" <?= $flg ?>>&nbsp; &nbsp; &nbsp; <?= $value['sortname'] ?></option>
                                <?php
                                endforeach;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>链接别名</label>
                        <input name="alias" id="alias" class="form-control" value="<?= $alias ?>">
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="home" value="n" <?= $is_home ?>>
                                </div>
                                <span class="text-dark font-weight-bold text-sm">设为首页</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="remark" value="y" <?= $is_comment ?>>
                                </div>
                                <span class="text-dark font-weight-bold text-sm">允许评论</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Other" class="accordion-collapse collapse" data-bs-parent="#option">
                    <div class="form-group">
                        <label>下载地址</label>
                        <input type="text" name="down" id="down" class="form-control" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">资源库</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div><a href="#" id="mediaAdd" class="btn btn-xs btn-success shadow-sm mb-3"><i class="fa fa-folder-open"></i> 上传附件</a></div>
                    <div>
                    <?php
                    if (User::haveEditPermission() && $mediaSorts): ?>
                        <select class="form-control" id="media-sort-select">
                            <option value="">全部资源</option>
                            <?php foreach ($mediaSorts as $v): ?>
                                <option value="<?= $v['id'] ?>"><?= $v['sortname'] ?></option>
                            <?php endforeach ?>
                        </select>
                    <?php endif ?>
                    </div>
                </div>
                <div class="row" id="image-list"></div>
                <div class="text-center">
                    <button type="button" class="btn btn-success btn-sm mt-2" id="load-more">加载更多…</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dropzone-previews" style="display: none;"></div>
<script src="<?= SITE_URL ?>content/admin/js/plugins/choices.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="<?= SITE_URL ?>content/admin/js/plugins/dropzone.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="<?= SITE_URL ?>content/admin/js/media-lib.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="<?= SITE_URL ?>content/admin/editor.md/editormd.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script>
    $("#menu_content_manage").addClass('active');
    $("#menu_content").addClass('show');
    $("#menu_page").addClass('active');
    // 编辑器
    var Editor;
    $(function() {
        Editor = editormd("logcontent", {
        width  : "100%",
        height : 490,
        path   : "<?= SITE_URL ?>content/admin/editor.md/lib/",
        toolbarIcons : function() {
        return ["bold", "del", "italic", "quote", "|", "h1", "h2", "h3", "|", "list-ul", "list-ol", "hr", "|",
            "link", "image", "audio", "video", "preformatted-text", "code-block", "table", "clear", "|", "search", "watch", "preview", "fullscreen", "help"]
        },
        watch : false,
        htmlDecode : true,
        imageUpload : true,
        imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
        imageUploadURL : "<?= SELF ?>?act=Upload&editor=1",

        videoUpload: false, //开启视频上传
        syncScrolling: "single",
        onfullscreen: function () {
        this.watch();
        },
        onfullscreenExit: function () {
        this.unwatch();
        },
        onload: function () {
        hooks.doAction("loaded", this);
        }

        });
        Editor.setToolbarAutoFixed(false);
    });
    if (document.getElementById('sort')) {
      const example = new Choices(document.getElementById('sort'), {shouldSort: false});
    }
    if (document.getElementById('author')) {
      const example = new Choices(document.getElementById('author'), {shouldSort: false});
    }
    if (document.getElementById('tag')) {
        const example = new Choices(document.getElementById('tag'), {
            delimiter: ',',
            editItems: true,
            removeItemButton: true,
            duplicateItemsAllowed: false,
            addItems: true
        });
    }
    function checkPage(act) {
        var timeout = 60000;
        var alias = $.trim($("#alias").val());
        var title = $.trim($("#title").val());

        if(act == 1){
            if (alias != '' && 0 != isalias(alias)) {
                Toast.fire({ icon: 'error', title: '保存失败：链接别名错误！' });
                return;
            }
            // 距离上次保存成功时间小于三秒时不允许保存
            if ((new Date().getTime() - Cookies.get('saveTime')) < 3000) {
                Toast.fire({ icon: 'error', title: '保存失败：请勿频繁操作！' });
                return;
            }
            $("#save").attr("disabled", "disabled");
            $.post('<?= SELF ?>?act=page_edit&save', $("#editlog").serialize(), function (data) {
                if (data.code === 1) {
                    var pageId = data.data;
                    Cookies.set('saveTime', new Date().getTime()); // 把保存成功时间戳记录（或更新）到 cookie 中
                    $("#gid").val(pageId);
                    $("#save").attr("disabled", false);
                    Toast.fire({ icon: 'success', title: '保存成功：<a href="../?post=' + pageId + '" target="_blank">预览文章</a>' });
                }else{
                    $("#save").attr("disabled", false);
                    Toast.fire({ icon: 'error', title: '保存失败：可能文章不可编辑或达到每日发文限额' });
                }
            });
        }else{
            if (isalias(alias) == 0) {
                return true;
            } else {
                Toast.fire({ icon: 'error', title: '保存失败：链接别名错误！' });
                $("#alias").focus();
                return false;
            }
        }
    }

</script>