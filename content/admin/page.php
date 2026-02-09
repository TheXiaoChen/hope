<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header pb-0">
							<div class="d-lg-flex">
								<div>
									<h5 class="mb-0">页面</h5>
									<div class="text-sm mb-0 d-flex align-items-center">
										<span class="me-2">页面共有<?= $pageNum ?>篇</span>
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
								<div class="ms-auto my-auto mt-lg-0 mt-4">
									<div class="ms-auto my-auto">
										<button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pageModal">创建页面</button>
									</div>
								</div>
							</div>
						</div>
						<form act="<?= SELF ?>?act=page" method="post" name="form_log" id="form_log">
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
											<th>别名</th>
											<th>评论</th>
											<th>浏览</th>
											<th>模板</th>
											<th>时间</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($pages as $key => $value):
                                        $isHide = '';
                                        if ($value['hide'] == 'y') {
                                            $isHide = ' <span class="badge bg-gradient-success">草稿</span>';
                                        }
										?>
										<tr>
											<td class="align-middle" style="width: 10px;">
												<div class="form-check d-flex justify-content-center">
													<input class="ids form-check-input" type="checkbox" name="id[]" value="<?= $value['gid'] ?>">
												</div>
											</td>
											<td class="align-middle font-weight-bold">
												<span class="my-2 text-xs"><a href="<?= Url::log($value['gid']) ?>" target="_blank">🔗</a> <a href="<?= SELF ?>?act=page_edit&sid=<?= $value['gid'] ?>"><?= $value['title'] ?></a></span><?= $isHide ?>
											</td>
											<td class="align-middle font-weight-bold">
												<span class="my-2 text-xs"><?= $value['alias'] ?></span>
											</td>
											<td class="align-middle font-weight-bold">
												<span class="my-2 text-xs"><a href="<?= SELF ?>?act=comment&gid=<?= $value['gid'] ?>"><?= $value['comnum'] ?></a></span>
											</td>
											<td class="align-middle font-weight-bold">
												<span class="my-2 text-xs"><a href="<?= Url::log($value['gid']) ?>" target="_blank"><?= $value['views'] ?></a></span>
											</td>
											<td class="align-middle font-weight-bold">
												<span class="my-2 text-xs"><?= $value['template'] ?></span>
											</td>
											<td class="align-middle font-weight-bold">
												<span class="my-2 text-xs"><?= $value['date'] ?></span>
											</td>
										</tr>
									<?php endforeach ?>
									</tbody>
								</table>
							</div>
							<input name="token" id="token" value="<?= LoginAuth::genToken() ?>" type="hidden" />
                			<input name="operate" id="operate" value="" type="hidden" />
						</form>
						<div class="d-flex justify-content-between px-4">
							<div class="btn-group dropup">
								<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
									<i class="fas fa-cog me-2"></i>操作
								</button>
								<ul class="dropdown-menu px-2 py-3">
									<li><a class="dropdown-item border-radius-md text-success" href="javascript:pageact('hide')">
											<i class="fas fa-file me-2"></i>存稿
										</a></li>
									<li><a class="dropdown-item border-radius-md text-info" href="javascript:pageact('pub')">
											<i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>  发布
										</a></li>
									<li><a class="dropdown-item border-radius-md text-danger" href="javascript:pageact('delete')">
											<i class="fas fa-trash me-2"></i>删除
										</a></li>
								</ul>
							</div>
							<nav aria-label="Page navigation example">
								<ul class="pagination justify-content-end">
									<?= $pageurl ?>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="Modal-form" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<form method="post" action="<?= SELF ?>?act=page&save">
							<div class="modal-header">
								<h5 class="modal-title" id="Modal-form">创建页面</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="input-group mb-3">
									<input type="text" name="title" id="title" class="form-control" placeholder="页面标题">
									<input type="text" name="alias" id="alias" class="form-control" placeholder="链接别名">
								</div>
								<div class="input-group mb-3">
								<?php if ($pageThemes):
									$sortListHtml = '<option value="">默认</option>';
									foreach ($pageThemes as $v) {
										$select = $v['filename'] == '' ? 'selected="selected"' : '';
										$sortListHtml .= '<option value="' . str_replace('.php', '', $v['filename']) . '" ' . $select . '>' . ($v['comment']) . '</option>';
									}
									?>
									<select id="template" name="template" class="form-control" placeholder="页面模板"><?= $sortListHtml; ?></select>
								<?php else: ?>
									<input class="form-control" id="template" name="template" value="page" placeholder="页面模板">
								<?php endif; ?>
								</div>
								<div class="input-group mb-3">
									<textarea class="form-control" name="content" id="content" placeholder="页面内容..."></textarea>
								</div>
								<div class="input-group mb-3">
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" name="home_page" value="n">
											</div>
											<span class="text-dark font-weight-bold text-sm">设为首页</span>
										</div>
									</div>
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" name="allow_remark" value="y" checked="">
											</div>
											<span class="text-dark font-weight-bold text-sm">允许评论</span>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input name="token" id="token" value="<?= LoginAuth::genToken() ?>" type="hidden" />
								<input type="hidden" name="ishide" id="ishide" value="n"/>
								<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" title="取消">取消</button>
								<button type="submit" class="btn bg-gradient-primary" title="保存">保存</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<script>
				$("#menu_content_manage").addClass('active');
				$("#menu_content").addClass('show');
				$("#menu_page").addClass('active');
				$("#alias").keyup(function () {
					var alias = $.trim($("#alias").val());
					if (1 == isalias(alias)) {
						$("#alias_msg").html('别名错误，应由字母、数字、下划线、短横线组成');
						$("#save").attr("disabled", "disabled");
					} else if (2 == isalias(alias)) {
						$("#alias_msg").html('别名错误，不能为纯数字');
						$("#save").attr("disabled", "disabled");
					} else if (3 == isalias(alias)) {
						$("#alias_msg").html('别名错误，不能为\'post\'或\'post-数字\'');
						$("#save").attr("disabled", "disabled");
					} else if (4 == isalias(alias)) {
						$("#alias_msg").html('别名错误，与系统链接冲突');
						$("#save").attr("disabled", "disabled");
					} else {
						$("#alias_msg").html('√');
						$("#save").attr("disabled", false);
					}
				});
				
    function pageact(action) {
		if (getChecked('ids') === false) {
			Toast.fire({
				icon: 'warning',
				title: '请选择要操作的文章'
			});
			return;
		}
        if (action === 'delete') {
			Swal.fire({
				title: '删除所选页面？',
				text: '删除将无法恢复',
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
					$("#operate").val("hide");
					$("#form_log").submit();
				}
			});
			return;
        }
        $("#operate").val(action);
        $("#form_log").submit();
    }

				<?php if (Input::getStrVar('code') === 'pub'): ?>Toast.fire({ icon: 'success', title: '保存成功' });
<?php endif ?><?php if (Input::getStrVar('code') === 'del'): ?>Toast.fire({ icon: 'success', title: '删除成功' });
<?php endif ?><?php if (Input::getStrVar('code') === 'hide_n'): ?>Toast.fire({ icon: 'success', title: '发布成功' });
<?php endif ?><?php if (Input::getStrVar('code') === 'hide_y'): ?>Toast.fire({ icon: 'success', title: '存稿成功' });
<?php endif ?>
			</script>


