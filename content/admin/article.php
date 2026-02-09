<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header pb-0">
				<div class="d-lg-flex">
					<div>
						<h5 class="mb-0"><a href="<?= SELF ?>?act=article"><?= $hide_state === 'y' ? '文章草稿' : '文章' ?></a></h5>
						<div class="text-sm mb-0 d-flex align-items-center">
							<span class="me-2">文章共有<?= $logNum ?>篇</span>
							<span class="me-2">每页显示</span>
							<select class="form-select form-select-sm" style="width: auto;" name="perpage_num" onchange="changePerPage(this);">
								<?php if ($perPage != 10 && $perPage != 15 && $perPage != 20 && $perPage != 50 && $perPage != 100 && $perPage != 500): ?><option value="<?= $perPage ?>" selected><?= $perPage ?></option><?php endif ?>
								<option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
								<option value="15" <?= ($perPage == 15) ? 'selected' : '' ?>>15</option>
								<option value="20" <?= ($perPage == 20) ? 'selected' : '' ?>>20</option>
								<option value="50" <?= ($perPage == 50) ? 'selected' : '' ?>>50</option>
								<option value="100" <?= ($perPage == 100) ? 'selected' : '' ?>>100</option>
								<option value="500" <?= ($perPage == 500) ? 'selected' : '' ?>>500</option>
							</select>
						</div>
					</div>

					<div class="ms-auto my-auto mt-lg-0 mt-4 d-flex align-items-center">
						<form action="<?= SELF ?>" method="get">
							<input type="hidden" name="act" value="article">
							<?php if (isset($hide_state)): ?>
								<input type="hidden" name="hide" value="<?= $hide_state ?>">
							<?php endif; ?>
							<div class="input-group">
								<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="keyword" value="<?= htmlspecialchars(isset($keyword) ? $keyword : '') ?>" placeholder="搜索文章..." onfocus="focused(this)" onfocusout="defocused(this)">
							</div>
						</form>
						<a href="<?= SELF ?>?act=article_edit" class="btn btn-outline-primary btn-xs ms-2 mb-0" target="_blank" title="写文章"><i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i></a>
						<?php if ($hide_state === 'n') { ?>
							<div class="dropdown d-inline ms-2">
								<a href="javascript:;" class="btn btn-outline-primary btn-xs mb-0 dropdown-toggle text-sm" data-bs-toggle="dropdown" id="navbarDropdownMenuLinkSort">分类</a>
								<ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLinkSort" data-popper-placement="left-start" id="categoryDropdownMenu">
									<li><a class="dropdown-item border-radius-md <?php if (empty($sid)) echo 'text-danger' ?>" href="<?= SELF ?>?act=article">全部</a></li>
									<?php
									foreach ($sorts as $key => $value):
										if ($value['pid'] != 0) {
											continue;
										}
										$flg = $value['sid'] == $sid ? 'text-danger' : '';
									?>
										<li><a class="dropdown-item border-radius-md <?= $flg ?>" href="<?= SELF ?>?act=article&sid=<?= $value['sid'] ?>"><?= $value['sortname'] ?></a></li>
										<?php
										$children = $value['children'];
										foreach ($children as $key):
											$value = $sorts[$key];
											$flg = $value['sid'] == $sid ? 'text-danger' : '';
										?>
											<li><a class="dropdown-item border-radius-md <?= $flg ?>" href="<?= SELF ?>?act=article&sid=<?= $value['sid'] ?>" <?= $flg ?>>&nbsp;-&nbsp;<?= $value['sortname'] ?></a></li>
									<?php
										endforeach;
									endforeach;
									?>
									<li>
										<hr class="horizontal dark my-2">
									</li>
									<li><a class="dropdown-item border-radius-md <?php if ($sid == -1) echo 'text-danger' ?>" href="<?= SELF ?>?act=article&sid=-1">未分类</a></li>
								</ul>
							</div>
						<?php } ?>
						<div class="dropdown d-inline ms-2">
							<a href="javascript:;" class="btn bg-gradient-primary btn-xs text-sm mb-0 dropdown-toggle" data-bs-toggle="dropdown">管理</a>
							<ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3">
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=article">文章</a></li>
								<li><hr class="horizontal dark my-2"></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=article&hide=y">草稿</a></li>
								<li><hr class="horizontal dark my-2"></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=category">分类</a></li>
								<li><hr class="horizontal dark my-2"></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=tag">标签</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<form id="form_log" act="<?= SELF ?>?act=article" method="post" name="form_log">
				<div class="table-responsive">
					<table class="table table-flush">
						<thead class="thead-light">
							<tr>
								<th class="align-middle">
									<div class="form-check d-flex justify-content-center">
										<input class="form-check-input" type="checkbox" id="checkAll">
									</div>
								</th>
								<th>标题</th>
								<th><a href="<?= SELF ?>?act=article&hide=<?= $hide_state === 'y' ? 'n' : 'y' ?>">状态</a></th>
								<th><a href="<?= SELF ?>?act=article&sortView=<?= $sortView ?>">浏览</a> / <a href="<?= SELF ?>?act=article&sortComm=<?= $sortComm ?>">评论</a></th>
								<th>作者</th>
								<th><a href="<?= SELF ?>?act=article&sortDate=<?= $sortDate ?>">时间</a></th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($logs as $key => $value):
								$sortName = isset($sorts[$value['sortid']]['sortname']) ? $sorts[$value['sortid']]['sortname'] : '未知分类';
								$sortName = $value['sortid'] == -1 ? '未分类' : $sortName;
								$author = isset($user_cache[$value['author']]['name']) ? $user_cache[$value['author']]['name'] : '未知作者';
							?>
								<tr>
									<td class="align-middle" style="width: 10px;">
										<div class="form-check d-flex justify-content-center">
											<input class="ids form-check-input" type="checkbox" name="id[]" value="<?= $value['gid'] ?>">
										</div>
									</td>
									<td>
										<div class="d-flex px-2 py-1">
											<div>
												<img src="<?= $value['cover'] ?: SITE_URL . 'content/admin/img/cover.png' ?>" class="avatar avatar-sm me-3">
											</div>
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-xs"><a href="<?= Url::log($value['gid']) ?>" target="_blank">🔗</a> <a href="./<?= SELF ?>?act=article_edit&gid=<?= $value['gid'] ?>"><?= $value['title'] ?></a><?php if ($value['password']): ?><span class="small">🔒</span><?php endif ?></h6>
												<p class="text-xs text-secondary mb-0">ID:<?= $value['gid'] ?> <a href="<?= SELF ?>?act=article&sid=<?= $value['sortid'] ?>"><?= $sortName ?></a></p>
											</div>
										</div>
									</td>
									<td class="align-middle">
										<div class="d-flex align-items-center">
											<button class="btn btn-icon-only mb-0 me-2 btn-sm" type="button">
												<?php if ($value['hide'] == 'n'): ?><i class="fas fa-check" title="公开"></i><?php endif ?>
												<?php if ($value['hide'] == 'y'): ?><i class="fas fa-rotate-right" title="草稿"></i><?php endif ?>
											</button>
											<?php if ($value['top'] == 'y'): ?><span class="badge badge-success"><i class="fas fa-landmark"></i> 置顶</span><?php endif ?>
											<?php if ($value['sortop'] == 'y'): ?>&nbsp;<span class="badge badge-info"><i class="fas fa-list"></i> 置顶</span><?php endif ?>
										</div>
									</td>
									<td class="align-middle font-weight-bold">
										<span class="my-2 text-xs"><?= $value['views'] ?> / <?= $value['comnum'] ?></span>
									</td>
									<td class="align-middle font-weight-bold">
										<span class="my-2 text-xs"><a href="<?= SELF ?>?act=article&uid=<?= $value['author'] ?>"><?= $author ?></a></span>
									</td>
									<td class="align-middle font-weight-bold">
										<span class="my-2 text-xs"><?= $value['date'] ?></span>
									</td>
									<td class="align-middle">
										<a href="javascript: hp_delete(<?= $value['gid'] ?>, 'article', '<?= LoginAuth::genToken() ?>');" data-bs-toggle="tooltip" data-bs-original-title="Delete product"><i class="fas fa-trash text-secondary" aria-hidden="true"></i></a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<input name="token" id="token" value="<?= LoginAuth::genToken() ?>" type="hidden" />
				<input name="operate" id="operate" value="" type="hidden" />
				<input name="category" id="category" value="" type="hidden" />
				<input name="author" id="author" value="" type="hidden" />
			</form>
			<div class="d-flex justify-content-between px-4">
				<div class="btn-group dropup">
					<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" >
						<i class="fas fa-cog me-2"></i>操作
					</button>
					<ul class="dropdown-menu px-2 py-3">
						<?php if ($hide_state === 'y') { ?>
							<li><a class="dropdown-item border-radius-md" href="javascript:batch_action('publish')">
									<i class="fas fa-globe me-2"></i>发布文章
								</a></li>
							<li>
								<hr class="horizontal dark my-2">
							</li>
							<li><a class="dropdown-item border-radius-md text-danger" href="javascript:batch_action('delete')">
									<i class="fas fa-trash me-2"></i>彻底删除
								</a></li>
						<?php } else { ?>
							<li><a class="dropdown-item border-radius-md" href="javascript:batch_action('top')">
									<i class="fas fa-arrow-up me-2"></i>文章置顶
								</a></li>
							<li><a class="dropdown-item border-radius-md" href="javascript:batch_action('untop')">
									<i class="fas fa-arrow-down me-2"></i>取消置顶
								</a></li>
							<li>
								<hr class="horizontal dark my-2">
							</li>
							<li>
								<a class="dropdown-item border-radius-md" href="javascript:batch_move_category()">
									<i class="fas fa-folder me-2"></i>移动分类
								</a>
							</li>
							<li>
								<hr class="horizontal dark my-2">
							</li>
							<li><a class="dropdown-item border-radius-md" href="javascript:batch_action('draft')">
									<i class="fas fa-file me-2"></i>转为草稿
								</a></li>
							<li><a class="dropdown-item border-radius-md text-danger" href="javascript:batch_action('delete')">
									<i class="fas fa-trash me-2"></i>彻底删除
								</a></li>
						<?php } ?>
					</ul>
				</div>
				<!-- 右侧分页 -->
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-end mb-0">
						<?= $pageurl ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
<style>
	.dropdown-menu {
		max-height: calc(100vh - 165px);
		overflow-y: auto;
	}
</style>
<script src="<?= SITE_URL ?>content/admin/js/plugins/choices.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script>
	$("#menu_content_manage").addClass('active');
	$("#menu_content").addClass('show');
	$("#menu_log").addClass('active');
	function batch_action(action) {
		if (getChecked('ids') === false) {
			Toast.fire({
				icon: 'warning',
				title: '请选择要操作的文章'
			});
			return;
		}


		if (action === 'delete') {
			Swal.fire({
				title: '确定要删除所选文章吗',
				text: '彻底删除将无法恢复',
				icon: 'warning',
				showDenyButton: true,
				showCancelButton: true,
				confirmButtonText: "彻底删除",
				cancelButtonText: '取消',
				denyButtonText: '存入草稿'
			}).then((result) => {
				if (result.isConfirmed) {
					$("#operate").val(action);
					$("#form_log").submit();
				} else if (result.isDenied) {
					$("#operate").val("draft");
					$("#form_log").submit();
				}
			});
			return;
		}

		if (action === 'del_draft') {
			Swal.fire({
				title: '删除所选草稿？',
				text: text,
				icon: 'warning',
				showCancelButton: true,
				cancelButtonText: '取消',
				confirmButtonText: '确定'
			}).then((result) => {
				if (result.isConfirmed) {
					$("#operate").val("del");
					$("#form_log").submit();
				}
			});
			return;
		}
		$("#operate").val(action);
		$("#form_log").submit();
	}

	// 批量移动分类函数
	function batch_move_category() {
		if (getChecked('ids') === false) {
			Toast.fire({
				icon: 'warning',
				title: '请选择要操作的文章'
			});
			return;
		}

		// 生成分类下拉框
		var categoryOptions = '';
		$('#categoryDropdownMenu a.dropdown-item').each(function() {
			var text = $(this).text().replace(/^\s*-+\s*/, ''); // 去掉前缀
			var href = $(this).attr('href');
			var match = href && href.match(/sid=([-\d]+)/);
			if (match) {
				categoryOptions += '<option value="' + match[1] + '">' + text + '</option>';
			}
		});
		Swal.fire({
			title: '移动到分类',
			html: '<select id="move-category" class="form-select">' + categoryOptions + '</select>',
			showCancelButton: true,
			confirmButtonText: '确定',
			cancelButtonText: '取消'
		}).then((result) => {
			if (result.isConfirmed) {
				const categoryId = document.getElementById('move-category').value;
				$("#operate").val("move");
				$("#category").val(categoryId);
				$("#form_log").submit();
			}
		});
	}
	<?php if (Input::getStrVar('code') === 'move'): ?>Toast.fire({
		icon: 'success',
		title: '移动成功'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'del'): ?>Toast.fire({
		icon: 'success',
		title: '删除成功'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'post'): ?>Toast.fire({
		icon: 'success',
		title: '发布成功'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'savelog'): ?>Toast.fire({
		icon: 'success',
		title: '保存成功'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'operate'): ?>Toast.fire({
		icon: 'error',
		title: '请选择要执行的操作'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'error_post_per_day'): ?>Toast.fire({
		icon: 'error',
		title: '超出每日发文数量'
	});
	<?php endif ?>
</script>