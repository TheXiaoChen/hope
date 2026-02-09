<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
<link href="<?= SITE_URL ?>content/admin/editor.md/css/editormd.css?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" rel="stylesheet" />
<style>
.fa { width:auto }
#preset_box .form-group { margin-bottom: auto; }
</style>
<div id="editor-md-dialog"></div>
<form action="<?= SELF ?>?act=article_edit" method="post" enctype="multipart/form-data" id="editlog" name="editlog">
    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="card card-body">
                <div class="d-lg-flex">
                    <h5 class="mb-0"><?= $pagetitle ?></h5>
                    <div class="ms-auto">
				        <input name="token" id="token" value="<?= LoginAuth::genToken() ?>" type="hidden" />
                        <input type="hidden" name="gid" id="gid" value="<?= $logid ?>"/>
                        <button type="button" id="save" class="btn bg-gradient-success" onclick="checkArticle(1);">保存</button>
                        <button type="submit" class="btn bg-gradient-primary ms-2" onclick="return checkArticle();">提交</button>
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
                <div class="form-group">
                    <label>标签</label>
                    <input class="form-control" name="tag" type="text" value="<?= $tagStr ?>" >
                </div>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#excerpt" role="button" aria-expanded="<?= empty($excerpt) ? 'false' : 'true' ?>" aria-controls="excerpt">文章摘要</a>
                <div class="collapse<?= empty($excerpt) ? '' : ' show' ?>" id="excerpt">
                    <textarea class="form-control" rows="5" name="logexcerpt"><?= $excerpt ?></textarea>
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
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="collapse" data-bs-target="#Other" aria-controls="Other" aria-selected="false">
                                <i class="ni ni-laptop text-sm me-2"></i> 其他选项
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
                        <select class="form-control" name="sort">
                        <option value="-1">选择分类...</option>
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
                    <div class="form-group">
                        <label>访问密码</label>
                        <input type="text" name="password" id="password" class="form-control" value="<?= $password ?>">
                    </div>
                    <div class="form-group">
                        <label>文章作者</label>
                        <select class="form-control" name="author">
                        <?php foreach ($user_cache as $key => $val):
                            $flg = $key == $author ? 'selected' : '';
                            ?>
                            <option value="<?= $key ?>" <?= $flg ?>><?= $val['name'] ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>发布时间</label>
                        <input class="form-control" name="date" type="datetime-local" value="<?= $date ?>">
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="hide" value="n" <?= $is_hide ?>>
                                </div>
                                <span class="text-dark font-weight-bold text-sm">公开状态</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="remark" value="y" <?= $is_remark ?>>
                                </div>
                                <span class="text-dark font-weight-bold text-sm">允许评论</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="top" value="y" <?= $is_top ?>>
                                </div>
                                <span class="text-dark font-weight-bold text-sm">首页置顶</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="sortop" value="y" <?= $is_sortop ?>>
                                </div>
                                <span class="text-dark font-weight-bold text-sm">分类置顶</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Other" class="accordion-collapse collapse" data-bs-parent="#option">
                    <button type="button" class="btn btn-sm btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#presetModal">管理字段</button>
                    <div id="preset_box"></div>
                    <div id="field_box" class="mt-3"></div>
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

<!-- 预设字段管理 Modal -->
<div class="modal fade" id="presetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">管理预设字段</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="preset_list"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="preset_add" class="btn btn-outline-primary">添加字段</button>
                <button type="button" id="preset_save" class="btn btn-primary">保存</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">关闭</button>
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
    $("#menu_log").addClass('active');
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
        ['sort', 'author', 'tag'].forEach(name => {
            const element = document.getElementsByName(name)[0];
            if (element) {
                new Choices(element, name === 'tag' ? {
                    delimiter: ',',
                    editItems: true,
                    removeItemButton: true,
                    duplicateItemsAllowed: false,
                    addItems: true
                } : { shouldSort: false });
            }
        });

        // 预设字段管理 modal 相关
        var presetFields = [];
        var blogFields = <?php echo isset($fields) ? json_encode(@unserialize( $fields), JSON_UNESCAPED_UNICODE) : json_encode([], JSON_UNESCAPED_UNICODE); ?>;

        // 在页面上渲染预设字段按钮（全局函数，供多个地方调用）
        function renderPresets() {
            var $box = $('#preset_box');
            if (!$box.length) return;
            $box.empty();
            (presetFields || []).forEach(function(p) {
                var k = p.key || p.name || '';
                var label = p.label || k;
                var group = $('<div class="form-group"><label>' + label + '</label><input type="hidden" name="field_key[]" value="' + k + '"><input type="text" name="field_value[]" class="form-control" value="' + (blogFields[k] || '') + '" ></div>');
                $box.append(group);
            });
            
        }

        function htmlEscape(s) {
            return String(s||'').replace(/[&<>"'`]/g, function (c) { return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','`':'&#96;'})[c]; });
        }

        function loadPresetFields(cb) {
            $.get('<?= SELF ?>?act=article_edit&get_blog_fields', function(resp) {
                var arr = [];
                if (resp) {
                    if (resp.code && resp.code === 1 && resp.data) arr = resp.data;
                    else if (Array.isArray(resp)) arr = resp;
                }
                presetFields = arr || [];
                try { renderPresets(); } catch (e) {}
                if (cb) cb();
            });
        }

        function populateModalList() {
            var $list = $('#preset_list');
            $list.empty();
            (presetFields || []).forEach(function(p){
                var row = $('<div class="row g-2 mb-2 preset-row"></div>');
                var col1 = $('<div class="col-5"><input class="form-control preset-key" value="'+ htmlEscape(p.key || '') +'" placeholder="字段 key"></div>');
                var col2 = $('<div class="col-6"><input class="form-control preset-label" value="'+ htmlEscape(p.label || '') +'" placeholder="显示标签"></div>');
                var col3 = $('<div class="col-1 d-flex align-items-center"><button class="btn btn-sm btn-outline-danger preset-row-del"><i class="fa fa-trash"></i></button></div>');
                row.append(col1).append(col2).append(col3);
                $list.append(row);
            });
        }

        // 打开 modal 时加载数据
        $('#presetModal').on('show.bs.modal', function() {
            loadPresetFields(function(){ populateModalList(); });
        });

        // 新增预设行
        $('#preset_add').on('click', function(){
            presetFields.push({key: '', label: ''});
            populateModalList();
        });

        // 删除预设行（事件委托）
        $(document).on('click', '.preset-row-del', function(){
            var idx = $(this).closest('.preset-row').index();
            if (idx >= 0) presetFields.splice(idx, 1);
            populateModalList();
        });

        // 保存预设字段到后端
        $('#preset_save').on('click', function(){
            var arr = [];
            $('#preset_list .preset-row').each(function(){
                var k = $(this).find('.preset-key').val().trim();
                var l = $(this).find('.preset-label').val().trim();
                if (k) arr.push({key: k, label: l});
            });
            $.post('<?= SELF ?>?act=article_edit&save_blog_fields', {data: JSON.stringify(arr)}, function(resp){
                if (resp && resp.code === 1) {
                    presetFields = arr;
                    try { renderPresets(); } catch (e) {}
                    var modalEl = document.getElementById('presetModal');
                    if (modalEl) {
                        var m = bootstrap.Modal.getInstance(modalEl);
                        if (m) m.hide();
                    }
                    if (typeof Toast !== 'undefined') Toast.fire({icon:'success', title:'保存成功'});
                } else {
                    if (typeof Toast !== 'undefined') Toast.fire({icon:'error', title:'保存失败'});
                    else alert('保存失败');
                }
            });
        });

        // 首次加载预设到页面
        loadPresetFields();

    });

    
    function checkArticle(act) {
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
            $.post('<?= SELF ?>?act=article_edit&save', $("#editlog").serialize(), function (data) {
                if (data.code === 1) {
                    var logid = data.data;
                    Cookies.set('saveTime', new Date().getTime()); // 把保存成功时间戳记录（或更新）到 cookie 中
                    $("#gid").val(logid);
                    $("#save").attr("disabled", false);
                    Toast.fire({ icon: 'success', title: '保存成功：<a href="../?post=' + logid + '" target="_blank">预览文章</a>' });
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