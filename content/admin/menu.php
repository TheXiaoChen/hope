<?php defined('HOPE_ROOT') || exit('access denied!'); 

function renderMenuItems($id,$children, $level = 0) {
    if (!is_array($children) || empty($children)) {
        return;
    }
    
    foreach ($children as $child):
        $fields = unserialize($child['fields']);
        if (!is_array($fields))$fields = array(); ?>
        <li class="list-group-item d-flex justify-content-between align-items-center" draggable data-id="<?= $child['id'] ?>">
            <span>
                <?= $child['name'] ?><?= $child['hide'] == 'y' ? ' <span class="badge bg-gradient-secondary">隐藏</span>' : '' ?>
                <br>
                <a href="<?= $child['url'] ?>" title="<?= $child['url'] ?>" target="<?= $child['target'] == 'y' ? '_blank' : '_self' ?>">
                    <?= $child['url'] ?>
                </a>
            </span>
            <div class="dropdown">
                <span class="badge badge-primary badge-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">操作</span>
                <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item border-radius-md" href="javascript:;" data-bs-toggle="modal" data-id="<?= $id ?>" data-item-id="<?= $child['id'] ?>" data-name="<?= htmlspecialchars($child['name'], ENT_QUOTES) ?>" data-url="<?= htmlspecialchars($child['url'], ENT_QUOTES) ?>" data-target="<?= $child['target'] ?>" data-type="<?= isset($child['type']) ? $child['type'] : 0 ?>" data-typeid="<?= isset($child['typeId']) ? $child['typeId'] : 0 ?>" data-pid="<?= isset($child['pid']) ? $child['pid'] : 0 ?>" data-fields="<?= htmlspecialchars(json_encode($fields), ENT_QUOTES) ?>"  data-bs-target="#AddMenuItemModal">编辑</a></li>
                    <li><a class="dropdown-item border-radius-md" href="javascript:;" data-bs-toggle="modal" data-id="<?= $id ?>" data-pid="<?= $child['id'] ?>" data-bs-target="#AddMenuItemModal">新增子菜单项</a></li>
                    <?php if ($child['hide'] == 'n'): ?>
                    <li><a class="dropdown-item border-radius-md text-danger" href="<?= SELF ?>?act=menu&hide&id=<?= $child['id']; ?>">隐藏</a></li>
                    <?php else: ?>
                    <li><a class="dropdown-item border-radius-md text-danger" href="<?= SELF ?>?act=menu&show&id=<?= $child['id']; ?>">显示</a></li>
                    <?php endif; ?>
                    <li><a class="dropdown-item border-radius-md text-danger" href="javascript: hp_delete(<?= $child['id'] ?>, 'menu', '<?= LoginAuth::genToken() ?>');">删除</a></li>
                </ul>
            </div>
        </li>
        
            <?php if (isset($child['child']) && !empty($child['child'])): ?>
            <li class="list-group-item" draggable>
                <ul class="list-group">
                    <?php renderMenuItems($id,$child['child'], $level + 1); ?>
                </ul>
            </li>
        <?php endif; ?>
    <?php endforeach;
}
 
?>
<div class="row" id="option">
  <div class="col-lg-3" >
        <div class="card">
            <div class="card-body pb-3">
				<div class="d-lg-flex">
					<div>
						<h5 class="mb-0">菜单</h5>
					</div>
					<div class="ms-auto my-auto mt-lg-0 mt-4">
						<div class="ms-auto my-auto">
							<button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-id="" data-bs-target="#MenuModal">添加</button>
						</div>
					</div>
				</div>
			</div>

            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill flex-column p-1" role="tablist">
                    <?php
                        $menu_id = [];
                        foreach ($menus as $value):
                            if ($value['pid'] != 0 || $value['type'] == 5){
                                continue;
                            } 
                            $menu_id[] = $value['id'];
                    ?>
                    <li class="nav-item d-flex ">
                        <a href="#menu<?= $value['id']; ?>" class="nav-link mb-0 px-0 py-1 ps-2 active" style="text-align: initial;" data-bs-toggle="collapse" data-bs-target="#menu<?= $value['id']; ?>" aria-controls="menu<?= $value['id']; ?>" aria-selected="true">
                            <i class="ni ni-laptop text-sm me-2"></i><?= $value['name'] ?> <?= $value['home'] == 'n' ? '<span class="badge badge-sm bg-gradient-success">主菜单</span>' : '' ?>
                        </a>
                        <div class="dropdown pe-1">
                            <span class="badge badge-primary badge-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> </span>
                            <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=menu&home=<?= $value['id']; ?>">设置为主菜单</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;" data-bs-toggle="modal" data-id="<?= $value['id']; ?>" data-name="<?= $value['name'] ?>" data-bs-target="#MenuModal">编辑</a></li>

                                <li><a class="dropdown-item border-radius-md text-danger" href="javascript: hp_delete(<?= $value['id']; ?>, 'menu', 'f754bacddd6b81edcc508db40e643bcbed514bc3');">删除</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <li class="nav-item">
                        <a href="#side" class="nav-link mb-0 px-0 py-1 ps-2" style="text-align: initial;" data-bs-toggle="collapse" data-bs-target="#side" aria-controls="side" aria-selected="false">
                            <i class="ni ni-laptop text-sm me-2"></i> 侧边栏
                        </a>
                    </li>
                </ul>
            </div>
            
    </div>
  </div>
    <div class=" col-lg-9 mt-lg-0 mt-4">
<?php
    foreach ($menu_id as $key => $id):
        $value = $menus[$id];
        ?>
      <div class="collapse <?= $key == 0 ?'show':'' ?>" id="menu<?= $id ?>" data-bs-parent="#option" aria-expanded="true">
        <div class="card">
			<div class="card-body pb-3">
				<div class="d-lg-flex">
					<div>
						<h5 class="mb-0"><?= $value['name'].$key ?></h5>
					</div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-id="<?= $id ?>" data-bs-target="#AddMenuItemModal">添加</button>
                            <button type="button" class="btn btn-xs btn-primary save-order-btn" data-id="<?= $id ?>">保存排序</button>
                        </div>
                    </div>
				</div>
			</div>
            <ul class="list-group">
                <?php renderMenuItems($id,$value['child'] ?? []);?>
            </ul>
		</div>
      </div>
    <?php endforeach; ?>
    
      <div class="collapse" id="side" data-bs-parent="#option" aria-expanded="true">
        <div class="card">
			<div class="card-body pb-3">
				<div class="d-lg-flex">
					<div>
						<h5 class="mb-0">侧边栏</h5>
					</div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#SideModal">添加</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm mb-0 ms-2 save-side-order-btn" data-id="side">保存排序</button>
                        </div>
                    </div>
				</div>
			</div>
            <ul class="list-group">
                <?php 
            foreach ($menus as $key => $value):
                if ($value['type'] != 5){
                    continue;
                }
                $fields = unserialize($value['fields']);
                if (!is_array($fields))$fields = array();
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center" draggable data-id="<?= $value['id'] ?>">
                    <span>[<?= $value['url'] ?>]<?= $value['name'] ?> <?= count($fields) ?><?= $value['hide'] == 'y' ? ' <span class="badge bg-gradient-secondary">隐藏</span>' : '' ?>
                    </span>
                    <div class="dropdown">
                        <span class="badge badge-primary badge-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">操作</span>
                        <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item border-radius-md" href="javascript:;" data-bs-toggle="modal" data-id="<?= $value['id']; ?>" data-name="<?= htmlspecialchars($value['name'], ENT_QUOTES) ?>" data-fields="<?= htmlspecialchars(json_encode($fields), ENT_QUOTES) ?>" data-typeid="<?= isset($value['typeid'])?htmlspecialchars($value['typeid'],ENT_QUOTES):(isset($value['type_id'])?htmlspecialchars($value['type_id'],ENT_QUOTES):(isset($value['typeId'])?htmlspecialchars($value['typeId'],ENT_QUOTES):'') ) ?>" data-bs-target="#SideModal">编辑</a></li>
                            <?php if ($value['hide'] == 'n'): ?>
                            <li><a class="dropdown-item border-radius-md text-danger" href="<?= SELF ?>?act=menu&hide&id=<?= $value['id']; ?>">隐藏</a></li>
                            <?php else: ?>
                            <li><a class="dropdown-item border-radius-md text-danger" href="<?= SELF ?>?act=menu&show&id=<?= $value['id']; ?>">显示</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item border-radius-md text-danger" href="javascript: hp_delete(<?= $value['id'] ?>, 'menu', 'f754bacddd6b81edcc508db40e643bcbed514bc3');">删除</a></li>
                        </ul>
                    </div>
                </li>
            <?php endforeach; ?>
            </ul>
		</div>
      </div>
    </div>
</div>

<div class="modal fade" id="SideModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="<?= SELF ?>?act=menu&upmenu">
                <div class="modal-header">
                    <h5 class="modal-title">添加组件</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">类型</label>
                        <select class="form-control" id="side_type" name="type_id" >
                            <option value="0" selected data-title="自定义组件">自定义组件</option>
                            <?php
                            require_once TEMPLATE_PATH . 'module.php';
                            foreach ($side as $key => $value):$value['default'] = !empty($value['default']) ? $value['default'] : [];
                            ?>
                                <option value="<?= $key ?>" data-title="<?= htmlspecialchars($value['title'], ENT_QUOTES) ?>"  data-fields="<?= htmlspecialchars(json_encode($value['default']), ENT_QUOTES) ?>"><?= $value['title'] ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">组件名称</label>
                        <!-- 使用唯一 id 避免与其它模态冲突 -->
                        <input type="text" class="form-control" id="side_name" name="name" required>
                    </div>
                    <div class="mb-3" id="side_custom_content">
                        <label class="form-label">内容</label>
                        <textarea name="fields[content]" class="form-control" rows="6"></textarea>
                    </div>
                    <div id="side_fields_container" class="d-none"></div>
                </div>
                <div class="modal-footer">
                    <!-- 避免与其它模态框重复 id，仅保留 name="id" 用于表单提交 -->
                    <input type="hidden" name="id"/>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="MenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="<?= SELF ?>?act=menu&upmenu">
                <div class="modal-header">
                    <h5 class="modal-title">添加菜单</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                            <label class="form-label">菜单名称</label>
                            <!-- 唯一 id，避免与 side 的 name 冲突 -->
                            <input type="text" class="form-control" id="menu_name" name="name" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <!-- 保留 name="id" 提交，避免与其它模态框重复 id -->
                    <input type="hidden" name="id" id="menu_modal_id"/>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="AddMenuItemModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="<?= SELF ?>?act=menu&addmenuitem">
                <div class="modal-header">
                    <h5 class="modal-title" >添加菜单项</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">上级菜单项</label>
                        <select class="form-control" name="pid">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">类型</label>
                        <select class="form-control" id="menu_type" name="type" onchange="monitorType()">
                            <option value="0" selected>自定义链接</option>
                            <option value="1">文章</option>
                            <option value="2">页面</option>
                            <option value="3">分类</option>
                            <option value="4">标签</option>
                        </select>
                    </div>
                    <div class="menu-option" id="option_0">
                        <div class="mb-3">
                            <label class="form-label">名称</label>
                            <input type="text" class="form-control" name="name" placeholder="菜单项显示名称">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">链接地址</label>
                            <input type="text" class="form-control" name="url" placeholder="http://">
                        </div>
                    </div>
                    <div class="menu-option d-none" id="option_1">
                        <div class="mb-3">
                            <label class="form-label type-label">选择文章</label>
                            <select class="form-control type-id-select" data-type="1" disabled>
                                <option value="">请选择</option>
                            </select>
                        </div>
                    </div>
                    <div class="menu-option d-none" id="option_2">
                        <div class="mb-3">
                            <label class="form-label type-label">选择页面</label>
                            <select class="form-control type-id-select" data-type="2" disabled>
                                <option value="">请选择</option>
                            </select>
                        </div>
                    </div>
                    <div class="menu-option d-none" id="option_3">
                        <div class="mb-3">
                            <label class="form-label type-label">选择分类</label>
                            <select class="form-control type-id-select" data-type="3" disabled>
                                <option value="">请选择</option>
                            </select>
                        </div>
                    </div>
                    <div class="menu-option d-none" id="option_4">
                        <div class="mb-3">
                            <label class="form-label type-label">选择标签</label>
                            <select class="form-control type-id-select" data-type="4" disabled>
                                <option value="">请选择</option>
                            </select>
                        </div>
                    </div>

                    <div id="field_box"></div>
                </div>
                <div class="modal-footer">
                    <!-- 保留 name 属性用于后端接收，避免多个模态框有相同 id 导致冲突 -->
                    <input type="hidden" name="id" id="addmenu_modal_id"/>
                    <input type="hidden" name="item_id" id="addmenu_item_id"/>
                    <button type="button" class="btn btn-outline-primary" id="preset_add">添加字段</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">添加</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
	$("#menu_surface_manage").addClass('active');
	$("#menu_surface").addClass('show');
	$("#menu_menu").addClass('active');
    var menu_data = <?= json_encode($menus) ?>;

    // 根据 URL hash 激活对应菜单面板（支持 #menu5）
    function activateMenuByHash() {
        var hash = window.location.hash;
        if (!hash) return;
        var targetId = hash.charAt(0) === '#' ? hash.slice(1) : hash;

        // 目标不存在则返回
        var $target = $('#' + targetId);
        if (!$target.length) return;

        // 隐藏所有面板并移除左侧 nav 的 active / 恢复为 collapsed
        $('#option .collapse').removeClass('show').attr('aria-expanded', 'false');
        $('#option .nav-link').each(function() {
            $(this).removeClass('active').addClass('active collapsed').attr({ 'aria-selected': 'false', 'aria-expanded': 'false' });
        });

        // 展开目标面板并设置 aria
        $target.addClass('show').attr('aria-expanded', 'true');

        // 找到左侧对应的 nav-link（匹配 data-bs-target 或 aria-controls）并激活
        var selector = '#option .nav-link[data-bs-target="#' + targetId + '"], #option .nav-link[aria-controls="' + targetId + '"]';
        var $navLink = $(selector).first();
        $navLink.removeClass('collapsed').addClass('active').attr({ 'aria-selected': 'true', 'aria-expanded': 'true' });

        // 如果模板中存在 .moving-tab（Argon/模板样式），调整其位置与宽度以匹配当前激活项
        var $moving = $('#option .moving-tab');
        if (!$moving.length) {
            $moving = $('.moving-tab');
        }
        if ($moving.length && $navLink.length) {
            // 计算相对于移动容器的 top 偏移（使用 position() 以相对于最近定位父元素）
            var top = $navLink.position().top - 3;
            var width = $navLink.outerWidth();
            // 平滑移动并设置宽度
            $moving.css({ 'transition': 'all 0.3s ease', 'transform': 'translate3d(0px,' + top + 'px, 0px)', 'width': width + 'px' });
            // 将移动标签内部文本与当前项保持一致
            var text = $navLink.clone().children().remove().end().text().trim();
            $moving.find('a').text(text);
        }
    }

    // 在页面就绪时执行一次，并监听 hashchange
    $(function() {
        activateMenuByHash();
        window.addEventListener('hashchange', activateMenuByHash);
    });

    // 添加这个函数到页面底部的 <script> 标签中
    function monitorType() {
        // 隐藏所有选项
        $('.menu-option').addClass('d-none');
        
        // 获取当前选择的类型
        var type = $('#menu_type').val();

        // 显示对应选项
        $('#option_' + type).removeClass('d-none');

        // 清理所有 select 的 name 并禁用它们，防止重复提交
        resetTypeSelects();

        // 如果是自定义链接（type == 0），不需要 AJAX 请求
        if (type == '0' || type == 0) {
            return;
        }

    // 通过 POST 向后端请求 type 列表并填充到统一的 select
    // 使用 SELF 参数追加 get_type_list 动作
    var postUrl = '<?= SELF ?>?act=menu&get_type_list';
    // 在请求期间显示加载提示
    var loadingSelect = $('#option_' + type).find('.type-id-select');
    loadingSelect.empty().append('<option value="">加载中...</option>').prop('disabled', true);

    $.post(postUrl, { type: type }, function (res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
            } catch (e) {
                console.error('返回数据解析失败', res);
                return;
            }
            var select = $('#option_' + type).find('.type-id-select');
            var label = $('#option_' + type).find('.type-label');
            select.empty();
            select.append('<option value="">请选择</option>');

            if (!data || Object.keys(data).length === 0) {
                select.append('<option value="">暂无可选项</option>');
                select.prop('disabled', true).removeAttr('name');
                return;
            }

            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    select.append('<option value="' + key + '">' + data[key] + '</option>');
                }
            }
            select.prop('disabled', false).attr('name', 'typeId');
        }).fail(function (xhr) {
            console.error('请求类型列表失败', xhr.responseText);
        });
    }

    // 清理 type-id-select 的公共函数，避免重复代码
    function resetTypeSelects() {
        $('.type-id-select').each(function() {
            $(this).removeAttr('name').prop('disabled', true).empty().append('<option value="">请选择</option>');
        });
    }
    // 预设字段管理 modal 相关
    var presetFields = [];
    // 新增预设行
    $('#preset_add').on('click', function(){
        var newField = `
            <div class="row g-2 mb-2 preset-row">
                <div class="col-4">
                    <input class="form-control" name="field_key[]" placeholder="字段 key">
                </div>
                <div class="col-7">
                    <input class="form-control" name="field_value[]" placeholder="内容 value">
                </div>
                <div class="col-1 d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-outline-danger preset-row-del"><i class="fa fa-trash"></i></button>
                </div>
            </div>
                `;
        $('#field_box').append(newField);
    });
    // 删除预设行（事件委托）
    $(document).on('click', '.preset-row-del', function() {
        $(this).closest('.preset-row').remove();
    });

    $('#MenuModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)

        // 使用 name 选择器或 modal 内部 id，避免跨模态冲突
        modal.find('input[name="id"]').val(id)
        modal.find('#menu_name').val(name)
        modal.find('.modal-title').text(name ? '编辑菜单' : '添加菜单');

        var pidSelect = modal.find('select[name="pid"]');
        pidSelect.empty();
        pidSelect.append('<option value="0">顶级菜单</option>');
        
        if (menu_data[id] && menu_data[id].child && menu_data[id].child.length > 0) {
            $.each(menu_data[id].child, function(childIndex, child) {
                pidSelect.append('<option value="' + child.id + '">' + child.name + '</option>');
            });
        }

    })
    
    // 分类编辑
    $('#AddMenuItemModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var pid = button.data('pid')
        var itemId = button.data('item-id')
        var name = button.data('name')
        var url = button.data('url')
        var target = button.data('target')
        var type = button.data('type')
        var typeId = button.data('typeid')
        var fields = button.data('fields')

        var modal = $(this)
        // 通过 name 字段设置 id，避免依赖全局 id
        modal.find('input[name="id"]').val(id)
        // 清除 item_id 隐藏域（默认新增模式）
        modal.find('input[name="item_id"]').val('')
        var pidSelect = modal.find('select[name="pid"]');
        pidSelect.empty();
        pidSelect.append('<option value="0">顶级菜单</option>');

        // 递归函数：获取所有子菜单项
        function getAllChildren(menuItem, prefix) {
            var children = [];
            if (menuItem.child && menuItem.child.length > 0) {
                $.each(menuItem.child, function(index, child) {
                    children.push({
                        id: child.id,
                        name: prefix + child.name
                    });
                    
                    // 递归获取更深层的子菜单
                    var grandChildren = getAllChildren(child, prefix + '&nbsp;&nbsp;&nbsp;&nbsp;');
                    children = children.concat(grandChildren);
                });
            }
            return children;
        }
        
        // 获取并添加所有层级的子菜单项
        if (menu_data[id]) {
            var allChildren = getAllChildren(menu_data[id], '');
            $.each(allChildren, function(index, child) {
                pidSelect.append('<option value="' + child.id + '">' + child.name + '</option>');
            });
        }


        // 设置默认选中项：如果有 pid 且不为空，则选中对应项；否则默认选中“顶级菜单”
        if (typeof pid !== 'undefined' && pid !== '') {
            pidSelect.val(pid);
        } else {
            pidSelect.val('0'); // 默认选中顶级菜单
        }

        // 如果触发者包含 item-id，则进入编辑模式
        var form = modal.find('form');
        if (typeof itemId !== 'undefined' && itemId) {
            // 填充表单字段
            modal.find('.modal-title').text('编辑菜单项');
            modal.find('.modal-body input[name="name"]').val(name || '');
            modal.find('.modal-body input[name="url"]').val(url || '');
            modal.find('.modal-body select[name="target"]').val(target || 'n');
            // 设置类型并触发监测以显示对应选择器
            if (typeof type !== 'undefined') {
                $('#menu_type').val(type);
                monitorType();
                // 填充 typeId 到选择器（如果存在），在 AJAX 填充完成后设置选中
                if (type && typeId) {
                    setTimeout(function() {
                        $('.type-id-select[data-type="' + type + '"]').val(typeId).prop('disabled', false).attr('name', 'typeId');
                    }, 200);
                }
            }
            // 设置隐藏的 item_id
            modal.find('input[name="item_id"]').val(itemId);
            // 修改 form action 为更新
            form.attr('action', '<?= SELF ?>?act=menu&upmenuitem');
            // 改变提交按钮文本
            form.find('button[type="submit"]').text('保存');
            var container = $('#field_box');
            Object.keys(fields).forEach(function (key) {
                var val = fields[key];
                var newField = `
                    <div class="row g-2 mb-2 preset-row">
                        <div class="col-4">
                            <input class="form-control" name="field_key[]" value="${escapeHtml(key)}" placeholder="字段 key">
                        </div>
                        <div class="col-7">
                            <input class="form-control" name="field_value[]" value="${escapeHtml(val)}" placeholder="内容 value">
                        </div>
                        <div class="col-1 d-flex align-items-center">
                            <button type="button" class="btn btn-sm btn-outline-danger preset-row-del"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                `;
                container.append(newField);
            });
        } else {
            // 新增模式：重置标题与按钮，并清空字段
            modal.find('.modal-title').text('添加菜单项');
            modal.find('.modal-body input[name="name"]').val('');
            modal.find('.modal-body input[name="url"]').val('');
            modal.find('.modal-body select[name="target"]' ).val('n');
            $('#menu_type').val('0');
            monitorType();
            modal.find('input[name="item_id"]').val('');
            form.attr('action', '<?= SELF ?>?act=menu&addmenuitem');
            form.find('button[type="submit"]').text('添加');
        }

    })

    // 在模态关闭时清理所有 typeId 名称，避免表单提交时重复字段
    $('#AddMenuItemModal').on('hidden.bs.modal', function () {
        resetTypeSelects();
        // 清除 field_box 内所有行
        $('#field_box').html('');
        // 恢复到默认类型（自定义链接）
        $('#menu_type').val('0');
        $('.menu-option').addClass('d-none');
        $('#option_0').removeClass('d-none');
    });

    // ---------- 拖拽排序功能 (Drag & Drop) ----------
    (function() {
        // helper: 找到 y 坐标下最近的非拖动元素
        function getDragAfterElement(container, y) {
            var draggableElements = Array.from(container.querySelectorAll('.list-group-item[data-id]:not(.dragging)'));
            var closest = { offset: Number.NEGATIVE_INFINITY, element: null };
            draggableElements.forEach(function(child) {
                var box = child.getBoundingClientRect();
                var offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    closest = { offset: offset, element: child };
                }
            });
            return closest.element;
        }

        // 绑定拖拽事件到所有可拖项（动态添加项需要重新绑定，页面加载时先绑定一次）
        function bindDragHandlers() {
            $('.list-group-item[data-id]').each(function() {
                var el = this;
                el.draggable = true;
                el.addEventListener('dragstart', function(e) {
                    el.classList.add('dragging');
                    try { e.dataTransfer.effectAllowed = 'move'; } catch (err) {}
                    try { e.dataTransfer.setData('text/plain', el.getAttribute('data-id')); } catch (err) {}
                });
                el.addEventListener('dragend', function() {
                    el.classList.remove('dragging');
                });
            });
        }

        // 绑定每个 list 容器的 dragover/drop 行为
        function bindListContainers() {
            document.querySelectorAll('ul.list-group').forEach(function(list) {
                list.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    var afterElement = getDragAfterElement(list, e.clientY);
                    var dragging = document.querySelector('.dragging');
                    if (!dragging) return;
                    if (afterElement == null) {
                        list.appendChild(dragging);
                    } else {
                        list.insertBefore(dragging, afterElement);
                    }
                });
            });
        }

        // 触发保存排序：收集每个 ul 中的顺序，并推断父 id（若嵌套则为上层菜单项 id，否则为 0）
        function collectOrderForPanel(panelId) {
            var items = [];
            var $panel = $('#menu' + panelId);
            if (!$panel.length) return items;

            $panel.find('ul.list-group').each(function() {
                var $ul = $(this);
                // 推断该 ul 的父 id：如果 ul 被一个 li 包裹（wrapper），则 wrapper 的前一个有 data-id 的 li 为父项
                var pid = 0;
                var $parentWrapper = $ul.parent('li');
                if ($parentWrapper.length) {
                    var $prev = $parentWrapper.prev('li[data-id]');
                    if ($prev.length) {
                        pid = parseInt($prev.attr('data-id')) || 0;
                    }
                }
                if (!pid) pid = panelId;

                var order = 0;
                $ul.children('li[data-id]').each(function() {
                    var id = parseInt($(this).attr('data-id')) || 0;
                    items.push({ id: id, pid: pid, taxis: order });
                    order++;
                });
            });

            return items;
        }

        // 保存排序按钮处理
        $(document).on('click', '.save-order-btn', function() {
            var menuId = $(this).data('id');
            var items = collectOrderForPanel(menuId);
            if (!items || items.length === 0) {
                alert('没有可保存的排序');
                return;
            }

            var postUrl = '<?= SELF ?>?act=menu&menu_taxis';
            var $btn = $(this);
            $btn.prop('disabled', true).text('保存中...');

            $.post(postUrl, { items: JSON.stringify(items) }, function(res) {
                try {
                    var data = typeof res === 'string' ? JSON.parse(res) : res;
                } catch (e) {
                    alert('返回数据解析失败');
                    $btn.prop('disabled', false).text('保存排序');
                    return;
                }
                if (data && data.code && data.code == 1) {
                    // 成功后刷新页面以读取最新顺序缓存
                    location.reload();
                } else {
                    alert(data.msg || '保存失败');
                    $btn.prop('disabled', false).text('保存排序');
                }
            }).fail(function(xhr) {
                alert('保存失败：' + xhr.responseText);
                $btn.prop('disabled', false).text('保存排序');
            });
        });

        // 保存侧边栏排序处理
        $(document).on('click', '.save-side-order-btn', function() {
            var $btn = $(this);
            var items = [];

            // 收集侧边栏列表中顶层带 data-id 的 li 顺序
            $('#side ul.list-group > li[data-id]').each(function(idx) {
                var id = parseInt($(this).attr('data-id')) || 0;
                items.push({ id: id, pid: 0, taxis: idx });
            });

            if (!items || items.length === 0) {
                alert('没有可保存的排序');
                return;
            }

            var postUrl = '<?= SELF ?>?act=menu&menu_taxis';
            $btn.prop('disabled', true).text('保存中...');

            $.post(postUrl, { items: JSON.stringify(items) }, function(res) {
                try {
                    var data = typeof res === 'string' ? JSON.parse(res) : res;
                } catch (e) {
                    alert('返回数据解析失败');
                    $btn.prop('disabled', false).text('保存排序');
                    return;
                }
                if (data && data.code && data.code == 1) {
                    location.reload();
                } else {
                    alert(data.msg || '保存失败');
                    $btn.prop('disabled', false).text('保存排序');
                }
            }).fail(function(xhr) {
                alert('保存失败：' + xhr.responseText);
                $btn.prop('disabled', false).text('保存排序');
            });
        });

        // 初始绑定
        bindDragHandlers();
        bindListContainers();
    })();

    // 点击左侧 nav-link 时更新 URL hash（使 activateMenuByHash 能正确响应）
    // 使用 pushState 避免页面滚动跳动；回退/前进仍然生效
    $(document).on('click', '#option .nav-link', function (e) {
        try {
            var href = $(this).attr('href') || '';
            var target = '';
            // 优先使用 href（通常是 #menuX），否则尝试 data-bs-target 或 aria-controls
            if (href && href.indexOf('#') === 0) {
                target = href;
            } else if ($(this).attr('data-bs-target')) {
                target = $(this).attr('data-bs-target');
            } else if ($(this).attr('aria-controls')) {
                target = '#' + $(this).attr('aria-controls');
            }

            if (!target) return;

            // 将 hash 推入历史记录（不会引起滚动跳动），兼容性降级为直接设置 location.hash
            if (history && history.pushState) {
                history.pushState(null, null, target);
            } else {
                window.location.hash = target;
            }
        } catch (err) {
            // 保守降级
            console.error('更新 hash 失败', err);
        }
    });

    // ---------- Side 模态：根据 side_type 切换自定义或模板字段 ----------
    function escapeHtml(unsafe) {
        if (unsafe === null || typeof unsafe === 'undefined') return '';
        return String(unsafe).replace(/[&<>"'`]/g, function (s) {
            return ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '`': '&#96;'
            })[s];
        });
    }

    function renderSideFields(fields) {
        var container = $('#side_fields_container');
        container.empty();
        // fields 可能是对象或数组
        if (!fields || (typeof fields !== 'object')) {
            container.append('<div class="mb-3"><div class="text-muted">无可用字段</div></div>');
            return;
        }

        // 如果是数组，尝试按项渲染；如果是 object，按 key 渲染
        if (Array.isArray(fields)) {
            fields.forEach(function (f, idx) {
                var label = f.label || f.name || ('字段 ' + (idx+1));
                var key = f.name || ('field_' + idx);
                var def = (typeof f.default !== 'undefined') ? f.default : '';
                container.append('<div class="mb-3"><label class="form-label">' + escapeHtml(label) + '</label><input class="form-control side-field-input" name="fields['+escapeHtml(key)+']" value="' + escapeHtml(def) + '"></div>');
            });
        } else {
            Object.keys(fields).forEach(function (key) {
                var val = fields[key];
                // 如果 val 是对象且有 default 或 label 字段
                if (typeof val === 'object') {
                    var label = val.label || key;
                    var def = typeof val.default !== 'undefined' ? val.default : JSON.stringify(val);
                    container.append('<div class="mb-3"><label class="form-label">' + escapeHtml(label) + '</label><input class="form-control side-field-input" name="fields['+escapeHtml(key)+']" value="' + escapeHtml(def) + '"></div>');
                } else {
                    container.append('<div class="mb-3"><label class="form-label">' + escapeHtml(key) + '</label><input class="form-control side-field-input" name="fields['+escapeHtml(key)+']" value="' + escapeHtml(val) + '"></div>');
                }
            });
        }
    }

    function monitorSideType() {
        var sel = $('#side_type option:selected');
        var type = $('#side_type').val();

        // 默认：显示自定义内容
        if (type === '0' || type === 0) {
            $('#side_fields_container').addClass('d-none');
            $('#side_custom_content').removeClass('d-none');
            // 将名称填入当前模态内的 name 字段（side 专用）
            $('#side_name').val(sel.data('title'));
            // 清除动态字段的 name 避免重复提交
            $('.side-field-input').remove();
            return;
        }

        // 非自定义：尝试从 data-fields 解析 JSON 并渲染
        var fieldsAttr = sel.attr('data-fields') || sel.data('fields');
        var fields = null;
        try {
            if (typeof fieldsAttr === 'string' && fieldsAttr.trim().length) {
                fields = JSON.parse(fieldsAttr);
            } else if (typeof fieldsAttr === 'object') {
                fields = fieldsAttr;
            }
        } catch (e) {
            console.error('解析 side data-fields 失败', e, fieldsAttr);
            fields = null;
        }
        // 显示字段容器并隐藏自定义 content
        if (fields) {
            $('#side_custom_content').addClass('d-none');
            $('#side_fields_container').removeClass('d-none');
            renderSideFields(fields);
        } else {
            // 没有字段定义，回退到自定义编辑（但我们仍可预填名称）
            $('#side_fields_container').addClass('d-none');
            $('#side_custom_content').removeClass('d-none');
        }
        // 如果 option 有 data-title 且名称为空，则填入名称
        var title = sel.attr('data-title') || sel.data('title');
        $('#side_name').val(title);
    }

    // 绑定 change 与模态 show 事件
    $(document).on('change', '#side_type', function () {
        monitorSideType();
    });

    $('#SideModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var fieldsAttr = button.attr('data-fields') || button.data('fields');
        var typeId = button.attr('data-typeid') || button.data('typeid') || button.attr('data-type') || button.data('type');

        // 设置 id 与 name
        var modal = $(this);

        // 根据是否有 id 判断是编辑还是添加
        var isEdit = typeof id !== 'undefined' && id !== null && id !== '';
        
        // 设置模态框标题
        if (isEdit) {
            modal.find('.modal-title').text('编辑组件');
        } else {
            modal.find('.modal-title').text('添加组件');
        }

        // 通过 name 设置 id，避免与其它模态 id 冲突
        modal.find('input[name="id"]').val(id || '');
        if (typeof name !== 'undefined' && name !== null) {
            modal.find('#side_name').val(name);
        }

        // 清空原有动态字段
        $('#side_fields_container').empty().addClass('d-none');
        // 恢复自定义内容默认显示（会根据后续逻辑切换）
        $('#side_custom_content').removeClass('d-none');

        // 如果有字段数据，尝试解析并填充
        if (fieldsAttr) {
            var parsed = null;
            try {
                // 有时属性中可能包含实体编码，attr() 一般会返回解析后的字符串
                parsed = (typeof fieldsAttr === 'string') ? JSON.parse(fieldsAttr) : fieldsAttr;
            } catch (e) {
                // 解析失败时尝试替换常见实体再解析
                try {
                    var decoded = fieldsAttr.replace(/&quot;/g, '"').replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>');
                    parsed = JSON.parse(decoded);
                } catch (e2) {
                    console.error('SideModal: 无法解析 data-fields', fieldsAttr, e2);
                }
            }

            if (parsed && typeof parsed === 'object') {
                // 如果传入了 typeId 并且下拉含有该值，先选中它
                if (typeId && $('#side_type option[value="' + typeId + '"]').length) {
                    $('#side_type').val(typeId);
                }

                // 如果 parsed 包含 content 字段且当前是自定义或未映射到模板，则显示到 textarea
                if ((!typeId || $('#side_type').val() === '0') && parsed.hasOwnProperty('content')) {
                    $('#side_custom_content').removeClass('d-none');
                    $('#side_fields_container').empty().addClass('d-none');
                    $('#side_custom_content textarea[name="fields[content]"]').val(parsed.content);
                } else {
                    // 否则按模板字段渲染
                    $('#side_custom_content').addClass('d-none');
                    $('#side_fields_container').removeClass('d-none');
                    renderSideFields(parsed);
                }
            }
        } else {
            // 新建模式：确保类型回到自定义，清空内容
            $('#side_type').val('0');
            $('#side_custom_content').removeClass('d-none');
            $('#side_custom_content textarea[name="fields[content]"]').val('');
        }

        // 最后再执行一次监测，保证 UI 状态正确（例如 name 填充或 required 行为）
        monitorSideType();
    });

    $('#SideModal').on('hidden.bs.modal', function () {
        // 关闭时恢复到默认状态：移除动态字段并显示自定义内容
        $('#side_fields_container').empty().addClass('d-none');
        $('#side_custom_content').removeClass('d-none');
    });
</script>