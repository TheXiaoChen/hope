<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
<link rel="stylesheet" href="<?= SITE_URL ?>content/admin/css/fancybox.css?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" type="text/css" />
<link rel="stylesheet" href="<?= SITE_URL ?>content/admin/css/plugins/dropzone.min.css?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" type="text/css" />
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header p-3">
				<div class="d-lg-flex">
					<div>
						<h5 class="mb-0">附件资源</h5>
						<div>
							<a href="<?= SELF ?>?act=upload" class="btn btn-xs btn-success sid_0">全部资源</a>
							
							<?php foreach ($sorts as $key => $val): ?>
							<div class="btn-group">
								<a href="<?= SELF ?>?act=upload&sid=<?= $val['id'] ?>" class="btn btn-xs btn-success sid_<?= $val['id']  ?>"><?= $val['sortname'] ?></a>
								<button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-toggle-split sid_<?= $val['id'] ?>"" data-bs-toggle="dropdown" aria-expanded="false">
								</button>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editsortModal" data-id="<?= $val['id'] ?>" data-sortname="<?= $val['sortname'] ?>">编辑</a></li>
									<li><a class="dropdown-item text-danger" href="javascript:deleteSort(<?= $val['id'] ?>)">删除</a></li>
								</ul>
							</div>
							<?php endforeach ?>
							<button type="button" class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addSortModal">
								<i class="fas fa-plus"></i> 分类
							</button>
						</div>
					</div>
					<div class="ms-auto my-auto mt-lg-0 mt-4">
						<div class="ms-auto my-auto d-flex align-items-center">
							<div>
								<div class="input-group" id="datepicker" data-wrap="true" >
									<input class="form-control" style="width:auto" placeholder="查看指定日期的资源" data-input> 
									<a class="input-group-text" data-clear><i class="ni ni-tv-2 text-primary text-sm opacity-10"></i></a>
								</div>
							</div>
							<div class="ms-2">
								<form action="<?= SELF ?>" method="get">
									<input type="hidden" name="act" value="upload">
									<div class="input-group">
										<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
										<input type="text" class="form-control" placeholder="搜索资源文件名..." name="keyword" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
									</div>
								</form>
							</div>
							<button type="button" class="btn btn-xs bg-gradient-primary text-sm ms-2" data-bs-toggle="modal" data-bs-target="#uploadModal">上传</button>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body p-3">
				<?php 
				if($page <= 1){
					$updata = [];
					$db = Database::getInstance();
					$row = $db->once_fetch_array("SELECT COUNT(DISTINCT 'author') AS 'user_count' FROM " . DB_PREFIX . "upload");
					$updata['user_count'] = $row['user_count'];
					$Month = Option::UPLOAD_FULL_PATH. gmdate('Ym') ;
					if (is_dir($Month)) {
						$updata['Month_size'] = changeFileSize(getDirSize($Month));
					} else {
						$updata['Month_size'] = '无';
					}
					$row = $db->once_fetch_array("SELECT COUNT(*) AS total_count FROM " . DB_PREFIX . "upload");
					$updata['total_count']  = $row['total_count'];
					$updata['Total_size'] = changeFileSize(getDirSize(Option::UPLOAD_FULL_PATH));
				?>
				<div class="row">
					<div class="col-lg-3 col-6 text-center">
						<div class="border-dashed border-1 border-secondary border-radius-md py-3">
							<h6 class="text-primary mb-0">上传用户</h6>
							<h4 class="font-weight-bolder"><?= $updata['user_count'] ?></h4>
						</div>
					</div>
					<div class="col-lg-3 col-6 text-center">
						<div class="border-dashed border-1 border-secondary border-radius-md py-3">
							<h6 class="text-primary mb-0">本月上传</h6>
							<h4 class="font-weight-bolder"><?= $updata['Month_size'] ?></h4>
						</div>
					</div>
					<div class="col-lg-3 col-6 text-center">
						<div class="border-dashed border-1 border-secondary border-radius-md py-3">
							<h6 class="text-primary mb-0">附件资源</h6>
							<h4 class="font-weight-bolder"><?= $updata['total_count'] ?></h4>
						</div>
					</div>
					<div class="col-lg-3 col-6 text-center">
						<div class="border-dashed border-1 border-secondary border-radius-md py-3">
							<h6 class="text-primary mb-0">资源占用</h6>
							<h4 class="font-weight-bolder"><?= $updata['Total_size'] ?></h4>
						</div>
					</div>
				</div><?php } ?>
				<form id="form_log" action="<?= SELF ?>?act=upload&operate" method="post" >
					<div class="row mt-2">

						<?php foreach ($medias as $key => $value):
							$media_url = htmlspecialchars(rmUrlParams(getFileUrl($value['filepath'])));
							$media_name = htmlspecialchars($value['filename']);
							$display_name = mb_substr($media_name, 0, 15) . (mb_strlen($media_name) > 15 ? '...' : '');
							$add_time = htmlspecialchars($value['addtime']);
							$mime_type = htmlspecialchars($value['mimetype']);
							$author_name = htmlspecialchars($user_cache[$value['author']]['name']);
							$file_size = htmlspecialchars($value['attsize']);
							$aid = (int)$value['aid'];
							$author_id = (int)$value['author'];

							$fancybox = '';
							// 获取缩略图或图标
							if (isImage($value['mimetype'])) {
								$media_icon = htmlspecialchars(getFileUrl($value['filepath_thum']));
								$fancybox = ' data-fancybox="gallery" data-src="'.$media_url.'" data-caption="'.$media_name.'"';

							} elseif (isZip($value['filename'])) {
								$media_icon = "./content/admin/img/loading/zip.jpg";
							} elseif (isVideo($value['filename'])) {
								$media_icon = "./content/admin/img/loading/video.png";
							} elseif (isAudio($value['filename'])) {
								$media_icon = "./content/admin/img/loading/audio.png";
							} else {
								$media_icon = "./content/admin/img/loading/fnone.png";
							}
						?>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="card mb-4 hover-shadow">
								<div class="border-radius-xl bg-upload" style="background-image: url('<?= $media_icon ?>')!important;"<?php echo $fancybox ;?>>



									<div class="card-header pb-0" style="background-color: hsl(0deg 0% 75% / 75%); padding: 0.5rem;">
										<div class="d-flex">
											<div class="form-check d-flex justify-content-center">
												<input class="form-check-input ids" type="checkbox" name="aids[]" value="<?= $key ?>">
											</div>
											<a href="#" title="<?= $media_name ?>" data-bs-toggle="modal" data-bs-target="#editModal" data-name="<?= $media_name ?>"  data-id="<?= $key ?>"><?= $display_name ?></a>
											<div class="ms-auto">
												<span class="badge badge-primary">
													<?= $mime_type ?>
												</span>
											</div>
										</div>
										<?= $add_time ?>
									</div>
									<div class="card-body mt-6">
										<div class="row">
											<div class="col-8">
												<div class="numbers">
													<p class="text-sm mb-0 text-uppercase font-weight-bold">
														作者：<a href="<?= SELF ?>?act=upload&uid=<?= $author_id ?>"><?= $author_name ?></a>
														<span class="badge badge-primary"><?= $file_size ?></span>
													</p>
													<p class="mb-0">
														<span class="badge badge-primary" onclick="window.open('<?= $media_url ?>','_blank'); return false;">访问</span>
														<span class="badge badge-primary" onclick="copyToClipboard('<?= $media_url ?>')">复制URL</span>
														<span class="badge badge-primary" onclick="hp_delete(<?= $aid ?>, 'upload', '<?= LoginAuth::genToken() ?>');">
															<i class="fas fa-trash text-secondary" aria-hidden="true"></i>
														</span>
													</p>
												</div>
											</div>
											<!--div class="col-4 text-end">
												<a class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle icon-move-right"
												target="_blank" href="<?= $media_url ?>">
													<i class="ni ni-send text-lg opacity-10"></i>
												</a>
											</div-->
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach ?>
					</div>
					<div class="d-flex justify-content-between px-4 py-3">
						<div class="dropdown d-inline">
							<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
								<i class="fas fa-cog me-2"></i>操作
							</button>
							<div class="form-check form-check-inline">
								<input type="checkbox" class="form-check-input" id="checkAllItem">
								<label class="form-check-label" for="checkAllItem">全选</label>
							</div>
							<ul class="dropdown-menu px-2 py-3">
								<li>
									<a class="dropdown-item border-radius-md" href="javascript:batch_move_category()">
										<i class="fas fa-folder me-2"></i>移动分类
									</a>
								</li>
								<li>
									<a class="dropdown-item border-radius-md text-danger" href="javascript:pageact('delete')">
										<i class="fas fa-trash me-2"></i>删除
									</a>
								</li>
							</ul>
						</div>
						<nav aria-label="Page navigation example">
							<ul class="pagination justify-content-end mb-0">
								<?= $page_url ?>
							</ul>
						</nav>
					</div>
					<input name="sort" id="sort" value="" type="hidden"/>
					<input name="operate" id="operate" value="" type="hidden"/>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="Modal-form" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="Modal-form">上传附件</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= SELF ?>?act=upload&uploade" class="dropzone" id="my-dropzone">
					<div class="fallback">
						<input name="file" type="file" multiple />
					</div>
					<div class="dz-message">
						<i class="fas fa-cloud-upload-alt"></i>
						<p>将文件拖到此处或<span>点击上传</span></p>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="Modal-form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="post" action="<?= SELF ?>?act=upload&update">
				<div class="modal-header">
					<h5 class="modal-title" id="Modal-form">编辑资源名称</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
                        <input name="name" id="name" class="form-control" value="">
                    </div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="id" value=""/>
					<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" title="取消">取消</button>
					<button type="submit" class="btn bg-gradient-primary" title="保存">保存</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="addSortModal" tabindex="-1" role="dialog" aria-labelledby="addSortModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="<?= SELF ?>?act=upload&add_sort">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSortModalLabel">添加新分类</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="sortname" class="form-label">分类名称</label>
                        <input type="text" class="form-control" id="sortname" name="sortname" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">添加</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editsortModal" tabindex="-1" role="dialog" aria-labelledby="editsortModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="<?= SELF ?>?act=upload&update_sort">
                <div class="modal-header">
                    <h5 class="modal-title" id="editsortModal">编辑分类</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_sortname" class="form-label">分类名称</label>
                        <input type="text" class="form-control" id="edit_sortname" name="sortname" required>
                        <input type="hidden" id="id" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= SITE_URL ?>content/admin/js/plugins/flatpickr.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="<?= SITE_URL ?>content/admin/js/media-lib.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="<?= SITE_URL ?>content/admin/js/plugins/dropzone.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="<?= SITE_URL ?>content/admin/js/fancybox.umd.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script type="text/javascript">
	$("#menu_system_manage").addClass('active');
	$("#menu_system").addClass('show');
	$("#menu_upload").addClass('active');
	$(".sid_<?= $sid ?>").removeClass('btn-success').addClass("btn-primary");
	Fancybox.bind('[data-fancybox]', {});
	flatpickr('#datepicker', {
		defaultDate: "<?= $date ?>",
		dateFormat: "Y/m/d",
		mode: "range",
		onChange: function(selectedDates, dateStr, instance) {
			if (selectedDates.length === 2) {
				var url = '<?= SELF ?>?act=upload&date=' + dateStr;
				window.location.href = url;
			}
		}
	});

	function copyToClipboard(url) {
		navigator.clipboard.writeText(url).then(function() {
			Toast.fire({ icon: 'success', title: '链接已成功复制到剪贴板'});
		}, function(err) {
			Toast.fire({ icon: 'error', title: '复制失败，请手动复制' });
		});
	}


	$('#editsortModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var sortname = button.data('sortname');
		var modal = $(this);
		modal.find('.modal-body #edit_sortname').val(sortname);
		modal.find('.modal-body #id').val(id);
	});

	function deleteSort(sortId) {
		if (confirm('确定要删除这个分类吗？')) {
			window.location.href = '<?= SELF ?>?act=upload&delete_sort=' + sortId;
		}
	}


	$('#uploadModal').on('show.bs.modal', function (event) {
		// 清空之前的文件
		Dropzone.forElement("#my-dropzone").removeAllFiles(true);
	})	
	$('#editModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var name = button.data('name')
		var modal = $(this)
		modal.find('.modal-body #name').val(name)
		modal.find('.modal-footer #id').val(id)
	})




<?php if (Input::getStrVar('code') === 'del'): ?>Toast.fire({ icon: 'success', title: '删除成功' });<?php endif ?>
<?php if (Input::getStrVar('code') === 'mov'): ?>Toast.fire({ icon: 'success', title: '移动成功' });<?php endif ?>
<?php if (Input::getStrVar('code') === 'edit'): ?>Toast.fire({ icon: 'success', title: '修改成功' });<?php endif ?>
<?php if (Input::getStrVar('code') === 'add'): ?>Toast.fire({ icon: 'success', title: '添加成功' });<?php endif ?>
<?php if (Input::getStrVar('code') === 'a'): ?>Toast.fire({ icon: 'error', title: '名称不能为空' });<?php endif ?>

// 全选/反选功能
$('#checkAllItem').on('change', function() {
    var checked = $(this).is(':checked');
    $('input[name="aids[]"]').prop('checked', checked);
});

// 若有单个checkbox取消勾选，则全选按钮也取消
$('input[name="aids[]"]').on('change', function() {
    var all = $('input[name="aids[]"]').length;
    var checked = $('input[name="aids[]"]:checked').length;
    $('#checkAllItem').prop('checked', all === checked);
});


// 批量移动分类功能
function batch_move_category() {
	if (getChecked('ids') === false) {
		Toast.fire({
			icon: 'warning',
			title: '请至少选择一个资源'
		});
		return;
	}

    // 显示移动分类的模态框或下拉选择
    var moveModal = `
        <div class="modal fade" id="moveCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">移动到分类</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-select" id="targetSort">
                            <option value="0">未分类</option>
                            <?php foreach ($sorts as $key => $val): ?>
                            <option value="<?= $val['id'] ?>"><?= $val['sortname'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="confirmMove">确定</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // 如果模态框不存在，则添加到页面中
    if ($('#moveCategoryModal').length === 0) {
        $('body').append(moveModal);
    }
    
    // 显示模态框
    $('#moveCategoryModal').modal('show');
    
    // 确认移动
    $('#confirmMove').off('click').on('click', function() {
		var targetSort = $('#targetSort').val();
		$("#operate").val("move");
		$("#sort").val(targetSort);
		$("#form_log").submit();

		Toast.fire({
			icon: 'success',
			title: '移动成功'
		});
    });
}

// 批量删除功能
function pageact(action = 'delete') {
	if (getChecked('ids') === false) {
		Toast.fire({
			icon: 'warning',
			title: '请至少选择一个资源'
		});
		return;
	}

	
	// 确认删除
	if (!confirm('确定要删除选中的资源吗？')) {
		return;
	}
	$("#operate").val("del");
	$("#form_log").submit();

	Toast.fire({ icon: 'success', title: '删除成功' });
	setTimeout(function() {
		window.location.reload();
	}, 1000);        
}
</script>
