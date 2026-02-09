<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
<div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">文章</p>
                    <h5 class="font-weight-bolder"><?= $sta_cache['lognum'] ?>+</h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">评论</p>
                    <h5 class="font-weight-bolder"><?= $sta_cache['comnum_all'] ?>+</h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-chat-round text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">附件</p>
                    <h5 class="font-weight-bolder"><?= $sta_cache['attnum'] ?>+</h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-folder-17 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">用户</p>
                    <h5 class="font-weight-bolder"><?= $sta_cache['usernum'] ?>+</h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
			<div class="card">
				<div class="card-header pb-0 pt-3 bg-transparent">
				  <h5 class="text-capitalize">网站信息</h5>
				</div>
				<div class="table-responsive">
				  <table class="table align-items-center mb-0">
					<tbody>
					  <tr>
						<td><div class="d-flex px-2"><h6 class="mb-0 text-sm">当前用户</h6></div></td>
						<td><p class="text-sm font-weight-bold mb-0"><?= $user_cache[UID]['name'] ?></p></td>
						<td><h6 class="mb-0 text-sm">当前版本</h6></td>
						<td><p class="text-sm font-weight-bold mb-0"><?= Option::EMLOG_VERSION ?></p></td>
					  </tr>
					  <tr>
						<td><div class="d-flex px-2"><h6 class="mb-0 text-sm">当前主题</h6></div></td>
						<td><p class="text-sm font-weight-bold mb-0"><?= Option::get('nonce_templet') ?></p></td>
						<td><h6 class="mb-0 text-sm">使用插件</h6></td>
						<td><p class="text-sm font-weight-bold mb-0"><?= count(Option::get('active_plugins')) ?></p></td>
					  </tr>
					  <tr>
						<td><div class="d-flex px-2"><h6 class="mb-0 text-sm">PHP</h6></div></td>
						<td><p class="text-sm font-weight-bold mb-0"><?= $php_ver ?></p></td>
						<td><h6 class="mb-0 text-sm">数据库</h6></td>
						<td><p class="text-sm font-weight-bold mb-0">MySQL <?= $mysql_ver ?></p></td>
					  </tr>
					  <tr>
						<td><div class="d-flex px-2"><h6 class="mb-0 text-sm">web服务</h6></div></td>
						<td><p class="text-sm font-weight-bold mb-0"><?= $_SERVER['SERVER_SOFTWARE'] ?></p></td>
						<td><h6 class="mb-0 text-sm">占用大小</h6></td>
						<td><p class="text-sm font-weight-bold mb-0"><?= changeFileSize(getDirSize(HOPE_ROOT)) ?></p></td>
					  </tr>
					  <tr>
						<td><div class="d-flex px-2"><h6 class="mb-0 text-sm">操作系统</h6></div></td>
						<td><p class="text-sm font-weight-bold mb-0"><?= php_uname('s') . ' ' . php_uname('m') ?></p></td>
						<td><h6 class="mb-0 text-sm">当前时间</h6></td>
						<td><p class="text-sm font-weight-bold mb-0"><?= date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);?></p></td>
					  </tr>
					</tbody>
				  </table>
				</div>
			</div>
        </div>
        <div class="col-lg-5">
          <div class="card card-carousel overflow-hidden h-100 p-0">
            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
              <div class="carousel-inner border-radius-lg h-100">
                <div class="carousel-item h-100 active" style="background-image: url('<?= SITE_URL ?>content/admin/img/carousel-1.jpg');background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-camera-compact text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">点赞打赏分享插件</h5>
                    <p>集打赏、点赞、分享三合一.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('<?= SITE_URL ?>content/admin/img/carousel-2.jpg');background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">自动生成配图</h5>
                    <p>无图原生自动生成配图.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('<?= SITE_URL ?>content/admin/img/carousel-3.jpg');background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-trophy text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">内容管理扩展(付费模块)</h5>
                    <p>默认的文章管理太辣鸡了，自定义了一些常用功能.</p>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
			<div class="card">
			  <div class="card-header">
				<h5 class="mb-0 text-capitalize">最近登录</h5> </div>
			  <div class="card-body pt-0">
				<ul class="list-group list-group-flush">
				<?php foreach ($users as $user):
					$avatar = empty($user_cache[$user['uid']]['avatar']) ? './content/admin/img/avatar.png' : '../' . $user_cache[$user['uid']]['avatar'];?>
				  <li class="list-group-item px-0">
					<div class="row align-items-center">
					  <div class="col-auto d-flex align-items-center">
						<a href="javascript:;" class="avatar"> <img class="border-radius-lg" alt="Image placeholder" src="<?= $avatar ?>"> </a>
					  </div>
					  <div class="col ms-1">
						<h6 class="mb-0"><a href="javascript:;"><?= empty($user['name']) ? $user['login'] : htmlspecialchars($user['name']) ?></a> <span class="badge badge-success badge-sm"><?= htmlspecialchars($user['role']) ?></span></h6>
						<span><?= $user['update_time'] ?></span>
					  </div>
					  <div class="col-auto">
						<button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
					  </div>
					</div>
				  </li>

				<?php endforeach; ?>

				</ul>
			  </div>
			</div>
        </div>
        <div class="col-lg-5">
			<div class="card h-100">
			  <div class="card-header pb-0">
				<h6>最新动态</h6>
			  </div>
			  <div class="card-body p-3">
				<div class="timeline timeline-one-side overflow-auto" style="height: 222px;">
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
					<div class="timeline-content">
					  <h6 class="text-dark text-sm font-weight-bold mb-0">系统公告</h6>
					  <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">避免网站被扫描，请大家及时更新！！！</p>
					</div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">版本更新</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">支持PHP 8.2的程序 正式发布了</p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">系统公告</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">祝大家兔年大吉，ZB服务器升级完成！​ </p>
            </div>
				  </div>
				  <div class="timeline-block mb-3">
				    <span class="timeline-step"><i class="ni ni-bell-55 text-success"></i></span>
            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">故障处理</h6>
              <p class="font-weight-bold text-xs mt-1 mb-0 text-success opacity-8">   ZBlogPHP密码找回工具      固定域名出错      不能发Emoji表情</p>
            </div>
				  </div>
				  
				</div>
			  </div>
			</div>
        </div>
      </div>
	  <script>
		$("#menu_home").addClass('active');
	  </script>

	  