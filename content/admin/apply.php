<?php if (isset($_GET['error'])): ?><div class="alert alert-danger">商店暂不可用，可能是网络问题</div><?php endif ?>
<style>
.blurred-background {
    background: rgba(200, 200, 200, 0.4);
    backdrop-filter: blur(8px);
}
.loading {
    pointer-events: none;
    opacity: 0.7;
}
.loading:after {
    content: "加载中...";
    margin-left: 8px;
    font-size: 12px;
}
</style>
<div class="card">
	<div class="card-body p-3">
		<div class="row gx-4">
			<div class="col-auto">
				<div class="avatar avatar-xl position-relative">
					<img src="../content/admin/img/team-3.jpg" alt="profile_image"
						class="w-100 border-radius-lg shadow-sm">
				</div>
			</div>
			<div class="col-auto my-auto">
				<div class="h-100">
					<h5 class="mb-1">应用中心 - 测试</h5>
					<p class="mb-0 font-weight-bold text-sm">ID:小辰 515146</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
				<div class="nav-wrapper position-relative end-0">
					<ul class="nav nav-pills nav-fill p-1" role="tablist">
						<li class="nav-item">
							<a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="#app1" role="tab" aria-selected="true">
								<i class="ni ni-app"></i>
								<span class="ms-2">全部</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
								data-bs-toggle="tab" href="#app2" role="tab" aria-selected="false">
								<i class="ni ni-email-83"></i>
								<span class="ms-2">主题</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
								data-bs-toggle="tab" href="#app3" role="tab" aria-selected="false">
								<i class="ni ni-email-83"></i>
								<span class="ms-2">插件</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
								data-bs-toggle="tab" href="#app4" role="tab" aria-selected="false">
								<i class="ni ni-email-83"></i>
								<span class="ms-2">模块</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
								data-bs-toggle="tab" href="#app5" role="tab" aria-selected="false">
								<i class="ni ni-settings-gear-65"></i>
								<span class="ms-2">我的</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="py-3 tab-content tab-space">
	<div class="p-0 tab-pane active" id="app1">
		<div class="card">
			<div class="card-body pb-2">
				<div class="d-lg-flex">
					<div class="py-1">
						<a href="javascript:;" class="badge bg-gradient-primary p-2" data-type="all" data-tag="" data-sort="">全部</a>
						<a href="javascript:;" class="badge badge-light text-primary p-2" data-type="theme" data-tag="博客" data-sort="">博客</a>
						<a href="javascript:;" class="badge badge-light text-primary p-2" data-type="theme" data-tag="资源" data-sort="">资源</a>
						<a href="javascript:;" class="badge badge-light text-primary p-2" data-type="theme" data-tag="社区" data-sort="">社区</a>
						<a href="javascript:;" class="badge badge-light text-primary p-2" data-type="theme" data-tag="企业" data-sort="">企业</a>
						<a href="javascript:;" class="badge badge-light text-primary p-2" data-type="plugin" data-tag="SEO优化" data-sort="">SEO优化</a>
						<a href="javascript:;" class="badge badge-light text-primary p-2" data-type="plugin" data-tag="内容创作" data-sort="">内容创作</a>
						<a href="javascript:;" class="badge badge-light text-primary p-2" data-type="plugin" data-tag="装饰特效" data-sort="">装饰特效</a>
						<a href="javascript:;" class="badge badge-light text-primary p-2" data-type="plugin" data-tag="官方生态" data-sort="">官方生态</a>
					</div>
					<div class="ms-md-auto d-flex align-items-start">
						<form action="javascript:;" method="get" id="searchForm">
							<input type="hidden" name="act" value="apply">
							<div class="input-group">
								<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="keyword" placeholder="搜索应用..." 
									onfocus="focused(this)" onfocusout="defocused(this)">
								<button type="submit" class="btn bg-gradient-primary">搜索</button>
							</div>
						</form>
						<div class="dropdown d-inline">
							<a href="javascript:;" class="btn bg-gradient-primary ms-2 dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">排序</a>
							<ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-start">
								<li><a href="javascript:;" class="dropdown-item border-radius-md" data-type="all" data-tag="" data-sort="down">下载榜</a></li>
								<li><a href="javascript:;" class="dropdown-item border-radius-md" data-type="all" data-tag="" data-sort="hot">热搜榜</a></li>
								<li><a href="javascript:;" class="dropdown-item border-radius-md" data-type="all" data-tag="" data-sort="new">最新榜</a></li>
								<li><hr class="horizontal dark my-2"></li>
								<li><a href="javascript:;" class="dropdown-item border-radius-md" data-type="all" data-tag="" data-sort="free">免费</a></li>
								<li><a href="javascript:;" class="dropdown-item border-radius-md" data-type="all" data-tag="" data-sort="paid">付费</a></li>
								<li><a href="javascript:;" class="dropdown-item border-radius-md" data-type="all" data-tag="" data-sort="promo">特惠</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-lg-4 mt-2 app-list" id="appListContainer">
		<?php if (!empty($app['apps'])):  ?>
			<?php foreach ($app['apps'] as $k => $v):
				$icon = $v['icon'] ?: "./content/admin/img/theme-icon.png";
				$type = $v['app_type'];
				$v['update_time'] = smartDate(strtotime($v['update_time']));

				$order_url = 'https://www.emlog.net.cn/order/submit/' . $type . '/' . $v['id']
				?>
				<div class="col-lg-3 col-md-6 mb-4">
					<div class="card hover-shadow <?php /*(Plugin::isActive($v['alias']) || Template::isActive($v['alias'])) ? 'current-usage': '' */ ?>">
						<div class="card-body p-3">
							<div class="current-badge"><?= $v['ver'] ?></div>
							<img src="<?= $icon ?>" style="border-radius: var(--bs-card-border-radius);height: 170px;" class="w-100">
							<p class="text-sm mt-3" title="<?= $v['info'] ?>"><?= subString($v['info'], 0, 37) ?></p>
							<hr class="horizontal dark">
							<div class="row">
								<div class="col-6">
									<h6 class="text-sm mb-1"><?= subString($v['name'], 0, 10) ?></h6>
									<p class="text-secondary text-sm mb-1">开发者：<a href="javascript:<?= $v['author_id'] ?>;" title="查看作品"><?= $v['author'] ?></a></p>
									<p class="text-secondary text-sm mb-0"><?php if ($type === 'theme'): ?><span class="badge badge-success p-1">模板</span><?php elseif ($type === 'plugin'): ?><span class="badge badge-primary p-1">插件</span><?php else: ?><span class="badge badge-info p-1">模块</span><?php endif; ?><?php if ($v['svip']): ?><span class="badge badge-warning p-1">VIP</span><?php endif; ?> <?= $v['update_time'] ?></p>
								</div>
								<div class="col-6 text-end">
									<h6 class="text-sm mb-0">
									<?php if ($v['price'] > 0): ?>
										<?php if ($v['promo_price'] > 0): ?>
											<span style="text-decoration:line-through"><?= $v['price'] ?><small>元</small></span>
											<span class="text-danger"><?= $v['promo_price'] ?><small>元</small></span>
										<?php else: ?>
											<span class="text-danger"><?= $v['price'] ?><small>元</small></span>
										<?php endif; ?>
									<?php else: ?>
										免费
									<?php endif; ?>
									</h6>
									<h6 class="text-sm mb-0"><?= $v['downloads'] ?></h6>
							<?php if ($v['price'] > 0): ?>
								<?php if ($v['purchased'] === true): ?>
									<a href="store.php?action=mine" class="btn btn-light">已购买</a>
									<a href="#" class="btn btn-success mb-0 installBtn" data-url="<?= urlencode($v['download_url']) ?>" data-cdn-url="<?= urlencode($v['cdn_download_url']) ?>" data-type="<?= $type ?>">安装</a>
								<?php elseif ($v['svip'] && Register::getRegType() === 2): ?>
									<a href="#" class="btn btn-warning mb-0 installBtn" data-url="<?= urlencode($v['download_url']) ?>" data-cdn-url="<?= urlencode($v['cdn_download_url']) ?>" data-type="<?= $type ?>">安装</a>
								<?php else: ?>
									<a href="javascript: <?= $order_url ?>" class="btn btn-xs btn-danger mb-0">购买</a>
								<?php endif ?>
							<?php else: ?>
								<a href="javascript: <?= $order_url ?>" class="btn btn-xs btn-success mb-0 installBtn" data-url="<?= urlencode($v['download_url']) ?>" data-cdn-url="<?= urlencode($v['cdn_download_url']) ?>" data-type="<?= $type ?>">安装</a>
							<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		<?php else: ?>
        	<div class="col-md-12" id="emptyTip">暂未找到结果，应用中心进货中，敬请期待！</div>
		<?php endif ?>
		</div>

		<div class="col-md-12 text-center my-4" id="loadingTip" style="display: none;">
			<div class="spinner-border text-primary" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
	</div>
	<div class="p-0 tab-pane" id="app2">
		<div class="card">
			<div class="card-body pb-2">
				<div class="d-lg-flex">
					<div class="py-1">
						<?php
						// 主题tab标签按钮
						if (isset($theme_categories) && is_array($theme_categories)) {
							$first = true;
							foreach ($theme_categories as $name => $list) {
								$active = $first ? 'bg-gradient-primary' : 'badge-light text-primary';
								$data_tag = $name === '全部' ? '' : $name;
								echo '<a href="javascript:;" class="badge ' . $active . ' p-2" data-type="theme" data-tag="' . $data_tag . '" data-sort="">' . $name . '</a>';
								$first = false;
							}
						}
						?>
					</div>
					<div class="ms-md-auto d-flex align-items-start">
						<form action="<?= SELF ?>" method="get">
							<input type="hidden" name="act" value="apply">
							<input type="hidden" name="theme">
							<input type="hidden" name="hide" value="n">
							<div class="input-group">
								<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="keyword" placeholder="搜索主题..." onfocus="focused(this)" onfocusout="defocused(this)">
							</div>
						</form>
						<div class="dropdown d-inline">
							<a href="javascript:;" class="btn bg-gradient-primary ms-2 dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">排序</a>
							<ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-start">
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=down">下载榜</a></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=hot">热搜榜</a></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=new">最新榜</a></li>
								<li><hr class="horizontal dark my-2"></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=free">免费</a></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=paid">付费</a></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=promo">特惠</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-lg-4 mt-2 app-list">
		<?php if (!empty($app['theme'])):  ?>
			<?php foreach ($app['theme'] as $k => $v):
				$icon = $v['icon'] ?: "./content/admin/img/theme-icon.png";
				$type = $v['app_type'];
				$v['update_time'] = smartDate(strtotime($v['update_time']));

				$order_url = 'https://www.emlog.net.cn/order/submit/' . $type . '/' . $v['id']
				?>
				<div class="col-lg-3 col-md-6 mb-4">
					<div class="card hover-shadow <?php /*(Plugin::isActive($v['alias']) || Template::isActive($v['alias'])) ? 'current-usage': '' */ ?>">
						<div class="card-body p-3">
							<div class="current-badge"><?= $v['ver'] ?></div>
							<img src="<?= $icon ?>" style="border-radius: var(--bs-card-border-radius);height: 170px;" class="w-100">
							<p class="text-sm mt-3" title="<?= $v['info'] ?>"><?= subString($v['info'], 0, 37) ?></p>
							<hr class="horizontal dark">
							<div class="row">
								<div class="col-6">
									<h6 class="text-sm mb-1"><?= subString($v['name'], 0, 10) ?></h6>
									<p class="text-secondary text-sm mb-1">开发者：<a href="javascript:<?= $v['author_id'] ?>;" title="查看作品"><?= $v['author'] ?></a></p>
									<p class="text-secondary text-sm mb-0"><?php if ($type === 'theme'): ?><span class="badge badge-success p-1">模板</span><?php elseif ($type === 'plugin'): ?><span class="badge badge-primary p-1">插件</span><?php else: ?><span class="badge badge-info p-1">模块</span><?php endif; ?><?php if ($v['svip']): ?><span class="badge badge-warning p-1">VIP</span><?php endif; ?> <?= $v['update_time'] ?></p>
								</div>
								<div class="col-6 text-end">
									<h6 class="text-sm me-2">
									<?php if ($v['price'] > 0): ?>
										<?php if ($v['promo_price'] > 0): ?>
											<span style="text-decoration:line-through"><?= $v['price'] ?><small>元</small></span>
											<span class="text-danger"><?= $v['promo_price'] ?><small>元</small></span>
										<?php else: ?>
											<span class="text-danger"><?= $v['price'] ?><small>元</small></span>
										<?php endif; ?>
									<?php else: ?>
										免费
									<?php endif; ?>
									</h6>
									<h6 class="text-sm mb-0"><?= $v['downloads'] ?></h6>
							<?php if ($v['price'] > 0): ?>
								<?php if ($v['purchased'] === true): ?>
									<a href="store.php?action=mine" class="btn btn-light">已购买</a>
									<a href="#" class="btn btn-success mb-0 installBtn" data-url="<?= urlencode($v['download_url']) ?>" data-cdn-url="<?= urlencode($v['cdn_download_url']) ?>" data-type="<?= $type ?>">安装</a>
								<?php elseif ($v['svip'] && Register::getRegType() === 2): ?>
									<a href="#" class="btn btn-warning mb-0 installBtn" data-url="<?= urlencode($v['download_url']) ?>" data-cdn-url="<?= urlencode($v['cdn_download_url']) ?>" data-type="<?= $type ?>">安装</a>
								<?php else: ?>
									<a href="javascript: <?= $order_url ?>" class="btn btn-xs btn-danger mb-0">购买</a>
								<?php endif ?>
							<?php else: ?>
								<a href="javascript: <?= $order_url ?>" class="btn btn-xs btn-success mb-0 installBtn" data-url="<?= urlencode($v['download_url']) ?>" data-cdn-url="<?= urlencode($v['cdn_download_url']) ?>" data-type="<?= $type ?>">安装</a>
							<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		<?php else: ?>
			<div class="col-md-12">
				暂未找到结果，应用中心进货中，敬请期待！
			</div>
		<?php endif ?>
		</div>
		<div class="col-md-12 text-center mb-4" id="theme_loadMoreContainer" >
			<button type="button" class="btn btn-primary" id="theme_loadMoreBtn">
				点击加载更多
			</button>
		</div>

	</div>
	<div class="p-0 tab-pane" id="app3">
		<div class="card">
			<div class="card-body pb-2">
				<div class="d-lg-flex">
					<div class="py-1">
						<?php
						// 插件tab标签按钮
						if (isset($plugin_categories) && is_array($plugin_categories)) {
							$first = true;
							foreach ($plugin_categories as $name => $list) {
								$active = $first ? 'bg-gradient-primary' : 'badge-light text-primary';
								$data_tag = $name === '全部' ? '' : $name;
								echo '<a href="javascript:;" class="badge ' . $active . ' p-2" data-type="plugin" data-tag="' . $data_tag . '" data-sort="">' . $name . '</a>';
								$first = false;
							}
						}
						?>
					</div>
					<div class="ms-md-auto d-flex align-items-start">
						<form action="<?= SELF ?>" method="get">
							<input type="hidden" name="act" value="apply">
							<input type="hidden" name="plugin">
							<div class="input-group">
								<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="keyword" placeholder="搜索插件..." onfocus="focused(this)" onfocusout="defocused(this)">
							</div>
						</form>
						<div class="dropdown d-inline">
							<a href="javascript:;" class="btn bg-gradient-primary ms-2 dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">排序</a>
							<ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-start">
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=down">下载榜</a></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=hot">热搜榜</a></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=new">最新榜</a></li>
								<li><hr class="horizontal dark my-2"></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=free">免费</a></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=paid">付费</a></li>
								<li><a class="dropdown-item border-radius-md" href="<?= SELF ?>?act=apply&list=promo">特惠</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-lg-4 mt-2">
		<?php if (!empty($app['plugin'])):  ?>
			<?php foreach ($app['plugin'] as $k => $v):
				$icon = $v['icon'] ?: "./content/admin/img/plugin-icon.png";
				$type = $v['app_type'];

				$order_url = 'https://www.emlog.net.cn/order/submit/' . $type . '/' . $v['id']
				?>
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="d-flex">
								<div class="avatar avatar-xl blurred-background border-radius-md p-2">
									<img src="<?= $icon ?>" style="border-radius: 0.5rem;" >
								</div>
								<div class="ms-3">
									<h6><?= subString($v['name'], 0, 10) ?> v<?= $v['ver'] ?></h6>
									<p>安装数：<?= $v['downloads'] ?></p>
								</div>
							</div>
							<p class="text-sm mt-3" title="<?= $v['info'] ?>"><?= subString($v['info'], 0, 37) ?> </p>
							<hr class="horizontal dark">
							<div class="row">
								<div class="col-6">
									<h6 class="text-sm mb-0">作者：<a href="javascript:<?= $v['author_id'] ?>;" title="查看作品"><?= $v['author'] ?></a></h6>
									<p class="text-secondary text-sm mb-1">更新：<?= $v['update_time'] ?></p>
									
								</div>
								<div class="col-6 text-end">
									<h6 class="text-sm me-2">免费</h6>
							<?php if ($v['price'] > 0): ?>
								<?php if ($v['purchased'] === true): ?>
									<a href="store.php?action=mine" class="btn btn-light">已购买</a>
									<a href="#" class="btn btn-success mb-0 installBtn" data-url="<?= urlencode($v['download_url']) ?>" data-cdn-url="<?= urlencode($v['cdn_download_url']) ?>" data-type="<?= $type ?>">安装</a>
								<?php elseif ($v['svip'] && Register::getRegType() === 2): ?>
									<a href="#" class="btn btn-warning mb-0 installBtn " data-url="<?= urlencode($v['download_url']) ?>" data-cdn-url="<?= urlencode($v['cdn_download_url']) ?>" data-type="<?= $type ?>">安装</a>
								<?php else: ?>
									<a href="javascript: <?= $order_url ?>" class="btn btn-xs btn-danger mb-0">购买</a>
								<?php endif ?>
							<?php else: ?>
								<a href="javascript: <?= $order_url ?>" class="btn btn-xs btn-success mb-0 installBtn" data-url="<?= urlencode($v['download_url']) ?>" data-cdn-url="<?= urlencode($v['cdn_download_url']) ?>" data-type="<?= $type ?>">安装</a>
							<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php endforeach ?>
		<?php else: ?>
			<div class="col-md-12">
				暂未找到结果，应用中心进货中，敬请期待！
			</div>
		<?php endif ?>
		</div>
		
	</div>
	<div class="p-0 tab-pane" id="app4"> 
		模块模块模块模块模块模块模块
	</div>
	<div class="p-0 tab-pane" id="app5"> 
		我的
	</div>

</section>

<script>
$(function() {
	$("#menu_store").addClass('active');
	setTimeout(hideActived, 3600);

	// 全局状态
	const state = {
		type: "all",
		tag: "",
		sort: "",
		keyword: "",
		page: 1,
		hasMore: true,
		loading: false
	};

	// 显示/隐藏加载状态
	function toggleLoading(show) {
		state.loading = show;
		$("#loadingTip").toggle(show);
		$("#loadMoreBtn").toggleClass("loading", show);
		if (show) $("#emptyTip").hide();
	}

	// 更新标签高亮
	function updateActiveTag($target) {
		$target.parent().find("a").removeClass("bg-gradient-primary").addClass("badge-light text-primary");
		$target.removeClass("badge-light text-primary").addClass("bg-gradient-primary");
	}

	// 渲染应用卡片
	function renderApps(apps, append) {
		let html = "";
		apps.forEach(app => {
			const icon = app.icon || (app.app_type === "theme" ? "./content/admin/img/theme-icon.png" : "./content/admin/img/plugin-icon.png");
			const typeBadge = app.app_type === "theme" ? '<span class="badge badge-success p-1">模板</span>' : app.app_type === "plugin" ? '<span class="badge badge-primary p-1">插件</span>' : '<span class="badge badge-info p-1">模块</span>';
			const vipBadge = app.svip ? '<span class="badge badge-warning p-1">VIP</span>' : '';
			const priceHtml = app.price > 0 ? (app.promo_price > 0 ? `<span style="text-decoration:line-through">${app.price}<small>元</small></span><span class="text-danger">${app.promo_price}<small>元</small></span>` : `<span class="text-danger">${app.price}<small>元</small></span>`) : "免费";
			const orderUrl = `https://www.emlog.net.cn/order/submit/${app.app_type}/${app.id}`;
			let btn = "";
			if (app.price > 0) {
				if (app.purchased === true) {
					btn = `<a href="store.php?action=mine" class="btn btn-light">已购买</a><a href="#" class="btn btn-success mb-0 installBtn" data-url="${encodeURIComponent(app.download_url)}" data-cdn-url="${encodeURIComponent(app.cdn_download_url)}" data-type="${app.app_type}">安装</a>`;
				} else if (app.svip && app.user_is_svip) {
					btn = `<a href="#" class="btn btn-warning mb-0 installBtn" data-url="${encodeURIComponent(app.download_url)}" data-cdn-url="${encodeURIComponent(app.cdn_download_url)}" data-type="${app.app_type}">安装</a>`;
				} else {
					btn = `<a href="${orderUrl}" class="btn btn-xs btn-danger mb-0" target="_blank">购买</a>`;
				}
			} else {
				btn = `<a href="#" class="btn btn-xs btn-success mb-0 installBtn" data-url="${encodeURIComponent(app.download_url)}" data-cdn-url="${encodeURIComponent(app.cdn_download_url)}" data-type="${app.app_type}">安装</a>`;
			}
			html += `
				<div class="col-lg-3 col-md-6 mb-4">
					<div class="card${app.app_type === "plugin" ? '' : ' hover-shadow'}">
						<div class="card-body p-3">`;
			if (app.app_type === "plugin"){
				html += `	<div class="d-flex">
								<div class="avatar avatar-xl blurred-background border-radius-md p-2">
									<img src="${icon}" style="border-radius: 0.5rem;" >
								</div>
								<div class="ms-3">
									<h6>${app.name.substring(0, 10) + (app.name.length > 10 ? '...' : '')} v${app.ver}</h6>
									<p>安装数：${app.downloads}</p>
								</div>
							</div>
							<p class="text-sm mt-3" title="${app.info}">${app.info.substring(0, 37) + (app.info.length > 37 ? '...' : '')} </p>
							<hr class="horizontal dark">
							<div class="row">
								<div class="col-6">
									<h6 class="text-sm mb-0">作者：<a href="javascript:${app.author_id};" title="查看作品">${app.author}</a></h6>
									<p class="text-secondary text-sm mb-1">更新：${app.update_time}</p>
								</div>
								<div class="col-6 text-end">
									<h6 class="text-sm me-2">${priceHtml}</h6>
									${btn}
								</div>
							</div>`;
			}else{
				html += `	<div class="current-badge">${app.ver}</div>
							<img src="${icon}" style="border-radius: var(--bs-card-border-radius);height: 170px;" class="w-100">
							<p class="text-sm mt-3" title="${app.info}">${app.info.substring(0, 37) + (app.info.length > 37 ? '...' : '')}</p>
							<hr class="horizontal dark">
							<div class="row">
								<div class="col-6">
									<h6 class="text-sm mb-1">${app.name.substring(0, 10) + (app.name.length > 10 ? '...' : '')}</h6>
									<p class="text-secondary text-sm mb-1">开发者：<a href="javascript:${app.author_id};" title="查看作品">${app.author}</a></p>
									<p class="text-secondary text-sm mb-0">${typeBadge}${vipBadge} ${app.update_time}</p>
								</div>
								<div class="col-6 text-end">
									<h6 class="text-sm mb-0">${priceHtml}</h6>
									<h6 class="text-sm mb-0">${app.downloads}</h6>
									${btn}
								</div>
							</div>`;
			}
			html += `
						</div>
					</div>
				</div>
			`;
		});






		if (append) {
			$("#appListContainer").append(html);
		} else {
			$("#appListContainer").html(html);
		}
	}

	// 获取应用列表
	function fetchApps(loadMore = false) {
		if (state.loading || (!state.hasMore && loadMore)) return;
		toggleLoading(true);
		const params = {
			act: 'apply',
			ajax_load: 1,
			type: state.type,
			tag: state.tag,
			list: state.sort,
			keyword: state.keyword,
			page: loadMore ? state.page + 1 : 1
		};
		$.get('<?= SELF ?>', params, function(res) {
			if (res.code === 200 && Array.isArray(res.data.apps)) {
				if (loadMore) state.page++;
				else state.page = 1;
				state.hasMore = res.data.has_more !== false;
				renderApps(res.data.apps, loadMore);
				if (state.hasMore) {
					$("#loadMoreContainer").show();
					$("#loadMoreBtn").html("点击加载更多").prop('disabled', false);
				} else {
					$("#loadMoreContainer").hide();
					$("#appListContainer").append('<div class="col-md-12 text-center text-muted">已加载全部内容</div>');
				}
				if (res.data.apps.length === 0 && !loadMore) {
					$("#appListContainer").append('<div class="col-md-12" id="emptyTip">暂未找到结果，应用中心进货中，敬请期待！</div>');
				}
			} else {
				$("#appListContainer").empty().append('<div class="col-md-12 text-danger">数据加载失败，请重试</div>');
				state.hasMore = false;
			}
		}, 'json').fail(function(xhr, status) {
			$("#appListContainer").empty().append(`<div class="col-md-12 text-danger">网络错误（${status}），请检查网络</div>`);
			state.hasMore = false;
		}).always(function() {
			toggleLoading(false);
		});
	}

	// 标签点击
	$(document).on("click", ".py-1 a[data-type]", function() {
		const $this = $(this);
		state.type = $this.data("type");
		state.tag = $this.data("tag") || "";
		state.sort = $this.data("sort") || "";
		state.page = 1;
		state.hasMore = true;
		updateActiveTag($this);
		fetchApps(false);
	});
	// 排序点击
	$(document).on("click", ".dropdown-item[data-sort]", function() {
		const $this = $(this);
		state.sort = $this.data("sort");
		state.page = 1;
		state.hasMore = true;
		$("#navbarDropdownMenuLink2").text($this.text());
		fetchApps(false);
	});
	// 分类下拉
	$('.category').on('change', function() {
		var selectedCategory = $(this).val();
		if (selectedCategory) {
			window.location.href = './store.php?action=&sid=' + selectedCategory;
		}
	});
	// 加载更多按钮
	$('#loadMoreBtn').on('click', function() {
		fetchApps(true);
	});
	// 滚动自动加载
	$(window).scroll(function() {
		if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
			fetchApps(true);
		}
	});
	// 初始化
	if (state.hasMore) {
		$('#loadMoreContainer').show();
	}
});
</script>