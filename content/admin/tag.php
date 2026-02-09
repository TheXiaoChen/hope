<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="d-lg-flex">
						<div>
							<h5 class="mb-0">标签</h5>
							<p class="text-sm mb-0">总标签数 (<?= $tags_count ?>)</p>
						</div>
						<div class="ms-auto my-auto mt-lg-0 mt-4">
							<div class="ms-auto my-auto d-flex align-items-center">
								<form action="<?= SELF ?>" method="get">
									<input type="hidden" name="act" value="tag">
										<div class="input-group">
										<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
										<input type="text" class="form-control" name="keyword" value="" placeholder="搜索标签..." onfocus="focused(this)" onfocusout="defocused(this)">
									</div>
								</form>
								<button type="button" class="btn btn-xs btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#tagModal" ><i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i></button>
								<div class="dropdown d-inline ms-2">
									<a href="javascript:;" class="btn bg-gradient-primary btn-xs text-sm mb-0 dropdown-toggle " data-bs-toggle="dropdown" >管理</a>
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
				</div>
				<div class="card-body">
					<div>
					<?php if ($tags): ?>
						<?php foreach ($tags as $key => $v):
							$count = empty($v['gid']) ? 0 : count(explode(',', $v['gid']));
							$count_style = $count > 0 ? 'text-muted' : 'text-danger';
							?>
							<div class="d-inline-block me-2 mb-2 align-middle">
								<label class="mb-0">
									<input type="checkbox" class="tag-checkbox me-1" value="<?= $v['tid'] ?>">
									<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tagModal" data-tid="<?= $v['tid'] ?>" data-tagname="<?= $v['tagname'] ?>" data-title="<?= $v['title'] ?>" data-keywords="<?= $v['keywords'] ?>" data-description="<?= $v['description'] ?>">
										<span><?= $v['tagname'] ?></span>
										<span class="badge bg-primary ms-1" onclick="window.open('<?= SELF ?>?act=article&tagid=<?= $v['tid'] ?>', '_blank')" style="cursor:pointer;"><?= $count ?></span>
									</button>
									
								</label>
							</div>
						<?php endforeach ?>
					<?php else: ?>
						<p class="m-3">还没有标签，写文章的时候可以给文章打标签</p>
					<?php endif ?>
					</div>
					<button type="button" id="select_all_tags" class="btn btn-sm btn-outline-secondary">全选</button>
					<button type="button" id="bulk_delete_tags" class="btn btn-sm btn-danger ms-2">批量删除</button>
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-end">
							<?= $pageurl ?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="tagModal" tabindex="-1" role="dialog" aria-labelledby="Modal-form" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form method="post" action="<?= SELF ?>?act=tag&update">
					<div class="modal-header">
						<h5 class="modal-title" id="Modal-form">修改标签</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<label>名称 / SEO标题 支持变量: {{site_title}}、 {{site_name}}、 {{tag_name}}</label>
						<div class="input-group mb-3">
							<input class="form-control" type="text" name="tagname" id="tagname" required>
							<input class="form-control" type="text" name="title" id="title">
						</div>
						<label>关键字</label>
						<div class="input-group mb-3">
							<input class="form-control" type="text" name="keywords" id="keywords">
						</div>
						<label>描述</label>
						<div class="input-group mb-3">
							<textarea class="form-control" name="description" id="description"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="" id="tid" name="tid"/>
						<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" title="取消">取消</button>
						<button type="submit" class="btn bg-gradient-primary" title="保存">保存</button>
						<button type="button" class="btn bg-gradient-danger" onclick="deltags();" title="删除">删除</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		$("#menu_content_manage").addClass('active');
		$("#menu_content").addClass('show');
		$("#menu_log").addClass('active');
		$('#tagModal').on('show.bs.modal', function (event) {
			var button      = $(event.relatedTarget)
			var tagname     = button.data('tagname')
			var title       = button.data('title')
			var keywords    = button.data('keywords')
			var description = button.data('description')
			var tid = button.data('tid')
			var modal = $(this)
			if(tid > 0) {
				modal.find('.modal-header #Modal-form').text('修改标签')
			}else{
				modal.find('.modal-header #Modal-form').text('创建标签')
			}
			modal.find('.modal-body #tagname').val(tagname)
			modal.find('.modal-body #title').val(title)
			modal.find('.modal-body #keywords').val(keywords)
			modal.find('.modal-body #description').val(description)
			modal.find('.modal-footer #tid').val(tid)
		});

		// 全选 / 批量删除逻辑
		$('#select_all_tags').on('click', function(){
			var $cb = $('.tag-checkbox');
			var all = $cb.length > 0 && $cb.filter(':checked').length === $cb.length;
			$cb.prop('checked', !all);
			$(this).text(!all ? '取消全选' : '全选');
		});

		$('#bulk_delete_tags').on('click', function(){
			var ids = [];
			$('.tag-checkbox:checked').each(function(){ ids.push($(this).val()); });
			if (ids.length === 0) {
				Toast.fire({ icon: 'error', title: '请先选择要删除的标签' });
				return;
			}
			Swal.fire({
				title: '确认删除所选标签吗？',
				text: '删除后将影响相关文章的标签关联，请谨慎操作',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: '删除',
				cancelButtonText: '取消'
			}).then((result) => {
				if (result.isConfirmed) {
					window.open("<?= SELF ?>?act=tag&del&tid=" + ids.join(',') + '&token=<?= LoginAuth::genToken() ?>', "_self");
				}
			});
		});
		function deltags() {
			var tid = $('#tid').val();
			Swal.fire({
				title: '确定要删除所选标签吗',
				text: '删除后可能无法恢复',
				icon: 'warning',
				showCancelButton: true,
				cancelButtonText: '取消',
				confirmButtonText: '确定'
			}).then((result) => {
				if (result.isConfirmed) {
					window.open("<?= SELF ?>?act=tag&del&tid=" + tid + '&token=<?= LoginAuth::genToken() ?>', "_self");
				}
			});
		}

		<?php if (Input::getStrVar('code') === 'del'): ?>Toast.fire({ icon: 'success', title: '删除标签成功' });<?php endif ?>
		<?php if (Input::getStrVar('code') === 'edit'): ?>Toast.fire({ icon: 'success', title: '修改标签成功' });<?php endif ?>
		<?php if (Input::getStrVar('code') === 'empty'): ?>Toast.fire({ icon: 'error', title: '请选择标签' });<?php endif ?>
		<?php if (Input::getStrVar('code') === 'exist'): ?>Toast.fire({ icon: 'error', title: '标签已存在' });<?php endif ?>
	</script>


