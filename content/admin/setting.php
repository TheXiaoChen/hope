
		<form action="<?= SELF ?>?act=setting&save" method="post" name="form_log" id="form_log">
			<div class="row">
				<div class="col-lg-4 col-sm-8">
					<div class="nav-wrapper position-relative end-0">
						<ul class="nav nav-pills nav-fill p-1" role="tablist">
							<li class="nav-item">
								<a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#set1" aria-controls="set1" role="tab" aria-selected="true">
									基础设置
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="#set2"
									aria-controls="set2" role="tab" aria-selected="false">
									用户设置
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="#set3"
									aria-controls="set3" role="tab" aria-selected="false">
									功能设置
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="#set4"
									aria-controls="set4" role="tab" aria-selected="false">
									API设置
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="#set5"
									aria-controls="set5" role="tab" aria-selected="false">
									站点数据
								</a>
							</li>
							
						</ul>
					</div>
				</div>
				<div class="col-lg-1 ms-auto">
					<input name="token" id="token" value="<?= LoginAuth::genToken() ?>" type="hidden"/>
					<button class="btn bg-gradient-success mb-0 " type="submit" title="保存">保存</button>
				</div>
			</div>
			<div class="row">
				<div class="mt-lg-0 mt-4">
					<div class="tab-content tab-space">
						<div class="card mt-4 tab-pane active" id="set1">
							<div class="card-header">
								<h5>站点信息</h5>
							</div>
							<div class="card-body pt-0">
								<div class="row">
									<div class="col-6">
										<label class="form-label">站点标题</label>
										<div class="input-group">
											<input name="sitename" class="form-control" type="text" value="<?= $sitename ?>">
										</div>
									</div>
									<div class="col-6">
									<label class="form-label">站点地址</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" name="siteurl" value="<?= $siteurl ?>">
											<button class="btn btn-outline-primary form-switch mb-0">
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input class="form-check-input" type="checkbox" name="detect_url" value="y" <?= $conf_detect_url ?>>
												<span class="ms-2">自动检测</span>
											</button>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<label class="form-label">站点副标题</label>
										<div class="input-group">
											<textarea class="form-control" name="siteinfo" rows="3"><?= $siteinfo ?></textarea>
										</div>
									</div>
									<div class="col-6">
										<label class="form-label">版权说明</label>
										<div class="input-group">
											<textarea class="form-control" name="footer_info" placeholder="可以填入网站统计、备案号等内容。" rows="3"><?= $footer_info ?></textarea>
										</div>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-6">
										<label class="form-label">网站时区</label>
										<select name="timezone" class="form-control">
										<?php foreach ($tzlist as $key => $value):
											$ex = $key == $timezone ? "selected=\"selected\"" : '' ?>
											<option value="<?= $key ?>" <?= $ex ?>><?= $value ?></option>
										<?php endforeach ?>
										</select>
									</div>
									<div class="col-6">
										<label class="form-label">网站语言</label>
										<select class="form-control" name="language">
											<option value="zh-cn"<?= $language == 'zh-cn' ? ' selected="selected"' : '' ?>>zh-cn 简体中文 (zh-cn)</option>
											<option value="zh-tw"<?= $language == 'zh-tw' ? ' selected="selected"' : '' ?>>zh-tw 傳統中文 (zh-tw)</option>
											<option value="en"<?= $language == 'en' ? ' selected="selected"' : '' ?>>en English (en)</option>
										</select>
									</div>
								</div>
								<div class="row mt-4 my-3">
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" name="debug" value="y" <?= $conf_is_debug ?>>
											</div>
											<span class="text-dark font-weight-bold text-sm">调试模式</span>
										</div>
									</div>
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" name="close" value="y" <?= $conf_is_close ?>>
											</div>
											<span class="text-dark font-weight-bold text-sm">关闭网站</span>
										</div>
									</div>
								</div>
								<hr class="horizontal dark mt-4 my-3">
								<h5>页头信息</h5>
								<div class="row mt-4 my-3">
									<div class="col-sm-4 col-6">
										<label class="form-label">站点浏览器标题</label>
										<div class="input-group">
											<input type="text" class="form-control" name="site_title" value="<?= $site_title ?>" placeholder="title">
										</div>
									</div>
									<div class="col-sm-4 col-6">
										<label class="form-label">站点关键字</label>
										<div class="input-group">
											<input type="text" class="form-control" name="site_key" value="<?= $site_key ?>" placeholder="keywords">
										</div>
									</div>
									<div class="col-sm-4 col-6">
										<label class="form-label">文章浏览器标题</label>
										<select class="form-control" name="log_title_style">
											<option value="0" <?= $opt0 ?>>文章标题</option>
											<option value="1" <?= $opt1 ?>>文章标题 - 站点标题</option>
											<option value="2" <?= $opt2 ?>>文章标题 - 站点浏览器标题</option>
										</select>
									</div>
								</div>
								<div class="row">
									<label class="form-label">站点浏览器描述</label>
									<div class="input-group">
										<textarea class="form-control" name="site_description" rows="3"><?= $site_description ?></textarea>
									</div>
								</div>
								<hr class="horizontal dark mt-4 my-3">
								<h5>展示数量</h5>
								<div class="row mt-4">
									<div class="col-6">
										<div class="input-group input-group-lg">
											<span class="input-group-text">文章显示数量</span>
											<input type="number" class="form-control" name="index_lognum" value="<?= $index_lognum ?>" >
										</div>
									</div>
									<div class="col-6">
										<div class="input-group input-group-lg">
											<span class="input-group-text">限搜索间隔（秒）</span>
											<input type="number" class="form-control" name="search_date" value="<?= $search_date ?>" >
										</div>
									</div>
								</div>

							</div>
						</div>







						<div class="card mt-4 tab-pane" id="set2">
							<div class="card-header">
								<h5>注册权限</h5>
							</div>
							<div class="card-body pt-0">
								<div class="row">
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="is_signup" <?= $conf_is_signup ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">用户注册</span>
										</div>
									</div>
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="ischkarticle" <?= $conf_ischkarticle ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">需要审核</span>
										</div>
									</div>
								</div>
								<div class="row mt-4 my-3">
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="login_code" <?= $conf_login_code ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">图形验证码</span>
										</div>
									</div>
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="email_code" <?= $conf_email_code ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">邮件验证码</span>
										</div>
									</div>
								</div>
								<div class="input-group ">
									<span class="input-group-text">限制注册用户发布文章 0 为无限</span>
									<input type="text" class="form-control" name="posts_per_day" value="<?= $conf_posts_per_day ?>" >
								</div>
								<hr class="horizontal dark mt-4 my-3">
								<h5>评论设置</h5>

								<div class="row mt-4 my-3">
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="iscomment" <?= $conf_iscomment ?>>
											</div>
											<span class="text-dark font-weight-bold text-sm">评论功能</span>
										</div>
									</div>
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="ischkcomment" <?= $conf_ischkcomment ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">评论审核</span>
										</div>
									</div>
								</div>
								<div class="row mt-4 my-3">
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="comment_code" <?= $conf_comment_code ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">验证码</span>
										</div>
									</div>
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="login_comment" <?= $conf_login_comment ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">登录评论</span>
										</div>
									</div>
								</div>
								<div class="row mt-4">
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="comment_needchinese" <?= $conf_comment_needchinese ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">内容需含中文</span>
										</div>
									</div>
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="comment_order" <?= $conf_comment_order ?>>
											</div>
											<span class="text-dark font-weight-bold text-sm">评论排序倒序</span>
										</div>
									</div>
								</div>
								<div class="row mt-4">
									<div class="col-6">
										<div class="input-group">
											<span class="input-group-text">发表评论间隔（秒）</span>
											<input type="number" class="form-control" name="comment_interval" value="<?= $comment_interval ?>" >
										</div>
									</div>
									<div class="col-6">
										<div class="input-group">
											<span class="input-group-text">显示数量/评论分页</span>
											<input type="text" class="form-control" name="comment_pnum" value="<?= $comment_pnum ?>" >
											<button class="btn btn-outline-primary form-switch mb-0">
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input class="form-check-input" type="checkbox"name="comment_paging" value="y" <?= $conf_comment_paging ?>>
											</button>
										</div>
									</div>
								</div>
								<hr class="horizontal dark mt-4 my-3">
								<h5>上传附件</h5>
								<div class="row mt-4 my-3">
									<div class="col-6">
										<div class="input-group">
											<span class="input-group-text">允许上传的文件类型</span>
											<input type="text" class="form-control" name="att_type" value="<?= $att_type ?>" >
										</div>
									</div>
									<div class="col-6">
										<div class="input-group">
											<span class="input-group-text">允许上传文件的大小(MB)</span>
											<input type="number" class="form-control" name="att_maxsize" value="<?= $att_maxsize ?>" >
										</div>
									</div>
								</div>
							</div>
						</div>



						<div class="card mt-4 tab-pane" id="set3">
							<div class="card-header">
								<h5>邮件服务</h5>
							</div>
							<div class="card-body pt-0">
								<div class="row">
									<div class="col-sm-4 col-6">
										<div class="input-group">
											<span class="input-group-text">发送人邮箱</span>
											<input type="email" class="form-control" name="smtp_mail" value="<?= $smtp_mail ?>" >
										</div>
									</div>
									<div class="col-sm-4 col-6">
										<div class="input-group">
											<span class="input-group-text">SMTP密码</span>
											<input type="password" class="form-control" name="smtp_pw" value="<?= $smtp_pw ?>" >
										</div>
									</div>
									<div class="col-sm-4 col-6">
										<div class="input-group">
											<span class="input-group-text">发送人名称</span>
											<input type="text" class="form-control" name="smtp_from_name" value="<?= $smtp_from_name ?>" >
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-6">
										<div class="input-group">
											<span class="input-group-text">SMTP服务器</span>
											<input type="text" class="form-control" name="smtp_server" value="<?= $smtp_server ?>" >
										</div>
									</div>
									<div class="col-6">
										<div class="input-group">
											<span class="input-group-text">端口</span>
											<input type="text" class="form-control" name="smtp_port" value="<?= $smtp_port ?>" >
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="mail_notice_comment" <?= $conf_mail_notice_comment ?>>
											</div>
											<span class="text-dark font-weight-bold text-sm">评论邮件通知</span>
										</div>
									</div>
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="mail_notice_post" <?= $conf_mail_notice_post ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">投稿邮件通知</span>
										</div>
									</div>
								</div>
								<div class="alert alert-light mt-4 my-3">
									<b>以QQ邮箱配置为例</b><br>
									发送人邮箱：你的QQ邮箱<br>
									SMTP密码：见QQ邮箱顶部设置-&gt; 账户 -&gt; 开启IMAP/SMTP服务 -&gt; 生成授权码（即为SMTP密码）<br>
									发送人名称：你的姓名或者站点名称<br>
									SMTP服务器：smtp.qq.com<br>
									端口：465<br>
								</div>
								<div class="col-md-4">
									<button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalMessage">发送测试</button>
									<!-- Modal -->
									<div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">发送邮件</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
											</button>
										</div>
										<div class="modal-body">
											<form>
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">邮件:</label>
												<input type="text" class="form-control" value="271106735@qq.com" id="recipient-name">
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">内容:</label>
												<textarea class="form-control" id="message-text"></textarea>
											</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">关闭</button>
											<button type="button" class="btn bg-gradient-primary">发送</button>
										</div>
										</div>
									</div>
									</div>
								</div>
								<hr class="horizontal dark mt-4 my-3">
								<h5>伪静态管理</h5>
								<div class="row my-3">
									<div class="input-group">
										<div class="form-check">
											<input type="radio" class="form-check-input" name="linkmode" value="0" <?= $conf_linkmode_0 ?>><label class="form-label">动态&emsp;&emsp;</label>
										</div>
										<div class="form-check">
											<input type="radio" class="form-check-input" name="linkmode" value="1" <?= $conf_linkmode_1 ?>><label class="form-label">伪静态&emsp;</label>
										</div>
										<div class="form-check">
											<input type="radio" class="form-check-input" name="linkmode" value="2" <?= $conf_linkmode_2 ?>><label class="form-label">index.php式仿伪静态&emsp;</label>
										</div>
									</div>
								</div>

								<div class="alert alert-light text-white"><strong>使用伪静态</strong> 必须确认主机是否支持！</div>
								<div class="row">
									<div class="input-group">
										<span class="input-group-text">首页的URL配置</span>
										<input type="text" class="form-control" name="rule_index" value="<?= $rule_index ?>" >
										<select class="form-select" >
											<option>首页URL配置 变量</option>
											<option>{%host%}网站首页地址，含/结尾</option>
											<option>{%page%}分页</option>
										</select>
									</div>
								</div>
								<div class="row mt-2">
									<label class="form-control-label">动态:<?= $siteurl ?>?article=文章ID</label>
									<div class="input-group">
										<span class="input-group-text">文章的URL配置</span>
										<input type="text" class="form-control" name="rule_article" value="<?= $rule_article ?>" >
										<select class="form-select">
											<option>文章URL配置 变量</option>
											<option>{%host%}网站首页地址，含/结尾</option>
											<option>{%id%}文章ID，与文章别名必须二选一</option>
											<option>{%alias%}文章别名，与文章ID必须二选—</option>
											<option>{%category%}文章所属分类别名，与文章ID必须二选—</option>
											<option>{%author%}文章作者别名，若无别名则取其名称</option>
											<option>{%year%}文章发布年份</option>
											<option>{%month%}文章发布月份</option>
											<option>{%day%}文章发布日期</option>
										</select>
									</div>
								</div>
								<div class="row mt-2">
									<label class="form-control-label">动态:<?= $siteurl ?>?page=页面ID</label>
									<div class="input-group">
										<span class="input-group-text">页面的URL配置</span>
										<input type="text" class="form-control" name="rule_page" value="<?= $rule_page ?>" >
										<select class="form-select" >
											<option>页面URL配置 变量</option>
											<option>{%host%}网站首页地址，含/结尾</option>
											<option>{%id%}文章ID，与文章别名必须二选一</option>
											<option>{%alias%}文章别名，与文章ID必须二选—</option>
											<option>{%category%}文章所属分类别名，若无别名则取其名称</option>
											<option>{%author%}文章作者别名，若无别名则取其名称</option>
											<option>{%year%}文章发布年份</option>
											<option>{%month%}文章发布月份</option>
											<option>{%day%}文章发布日期</option>
										</select>
									</div>
								</div>
								<div class="row mt-2">
									<label class="form-control-label">动态:<?= $siteurl ?>?category=分类ID</label>
									<div class="input-group">
										<span class="input-group-text">分类页的URL配置</span>
										<input type="text" class="form-control" name="rule_category" value="<?= $rule_category ?>" >
										<select class="form-select">
											<option>分类页URL配置 变量</option>
											<option>{%host%}网站首页地址，含/结尾</option>
											<option>{%id%}分类ID，与分类别名必须二选一</option>
											<option>{%alias%}分类别名，与分类ID必须二选—</option>
											<option>{%page%}分页</option>
										</select>
									</div>
								</div>
								<div class="row mt-2">
									<label class="form-control-label">动态:<?= $siteurl ?>?record=时间</label>
									<div class="input-group">
										<span class="input-group-text">日期页的URL配置</span>
										<input type="text" class="form-control" name="rule_record" value="<?= $rule_record ?>" >
										<select class="form-select">
											<option>日期页URL配置 变量</option>
											<option>{%host%}网站首页地址，含/结尾</option>
											<option>{%record%}时间</option>
											<option>{%page%}分页</option>
										</select>
									</div>
								</div>
							</div>
						</div>



						<div class="card mt-4 tab-pane" id="set4">
							<div class="card-header">
								<h5>API设置</h5>
							</div>
							<div class="card-body pt-0">
								<div class="row">
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="is_openapi" <?= $conf_is_openapi ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">启用API协议</span>
										</div>
									</div>
									<div class="col-6">
										<div class="d-flex align-items-center">
											<div class="form-switch mb-0">
												<input class="form-check-input" type="checkbox" value="y" name="is_limitapi" <?= $conf_is_limitapi ?> >
											</div>
											<span class="text-dark font-weight-bold text-sm">启用API限流</span>
										</div>
									</div>
								</div>
								<div class="row mt-4 my-3">
									<div class="col-6">
										<div class="input-group input-group-lg">
											<span class="input-group-text">API秘钥</span>
											<input type="text" class="form-control" name="apikey" value="<?= $apikey ?>" >
											<button class="btn btn-outline-primary mb-0" type="button" onclick="window.location.href='<?= SELF ?>?act=setting&api_reset&token=<?= LoginAuth::genToken() ?>'">重置</button>
										</div>
									</div>
									<div class="col-6">
										<div class="input-group input-group-lg">
											<span class="input-group-text">每分钟限制请求数</span>
											<input type="text" class="form-control" name="limit_num" value="<?= $limit_num ?>" >
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="card mt-4 tab-pane" id="set5">
							<div class="card-header pb-0">
								<h5>站点数据</h5>
							</div>
							<div class="card-body">
								<div class="row g-3 flex-wrap">
									<div class="col-12 col-md-4">
										<div class="card h-100">
											<div class="card-header pb-0 p-3">
												<h6 class="mb-0">数据库备份</h6>
											</div>
											<div class="card-body p-3">
												<p class="text-sm">将本站内容数据库备份到自己电脑手机上.</p>
												<div class="row mt-3 mb-3">
													<div class="input-group">
														<div class="form-check me-3">
															<input type="radio" class="form-check-input" name="zipbak" value="0" checked ><label class="form-label ms-1">SQL格式</label>
														</div>
														<div class="form-check">
															<input type="radio" class="form-check-input" name="zipbak" value="1" <?= $conf_linkmode_1 ?>><label class="form-label ms-1">ZIP格式</label>
														</div>
													</div>
												</div>
												<hr class="horizontal dark">
												<div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
													<button type="button" class="btn btn-sm btn-primary mb-2 mb-md-0" id="download_backup">下载备份</button>
													<div class="avatar-group">
														<a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom">
															<img alt="Image placeholder" src="https://q4.qlogo.cn/headimg_dl?dst_uin=271106735&spec=640">
														</a>
														<a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom">
															<img alt="Image placeholder" src="https://q4.qlogo.cn/headimg_dl?dst_uin=2245314490&spec=640">
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="card h-100">
											<div class="card-header pb-0 p-3">
												<h6 class="mb-0">导入备份</h6>
											</div>
											<div class="card-body p-3">
												<p class="text-sm">仅可导入相同版本的数据库备份文件，且数据库表前缀需保持一致.</p>
												<p class="text-sm">当前数据库表前缀：<?= DB_PREFIX ?></p>
												<hr class="horizontal dark">
												<div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
													<button type="button" class="btn btn-sm btn-primary mb-2 mb-md-0" id="import_backup">导入备份</button>
													<!-- 导入备份弹窗 -->
													<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="importModalLabel">导入数据库备份</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<form method="post" action="<?= SELF ?>?act=setting&import" enctype="multipart/form-data">
																	<div class="modal-body">
																		<input name="token" id="token" value="<?= LoginAuth::genToken() ?>" type="hidden">
																		<input type="file" name="sqlfile" required accept=".sql,.zip" class="form-control mb-3">
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
																		<input type="submit" value="导入" class="btn btn-success">
																	</div>
																</form>
															</div>
														</div>
													</div>
													<div class="avatar-group">
														<a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom">
															<img alt="Image placeholder" src="https://q4.qlogo.cn/headimg_dl?dst_uin=271106735&spec=640">
														</a>
														<a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom">
															<img alt="Image placeholder" src="https://q4.qlogo.cn/headimg_dl?dst_uin=271106735&spec=640">
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="card h-100">
											<div class="card-header pb-0 p-3">
												<h6 class="mb-0">更新缓存</h6>
											</div>
											<div class="card-body p-3">
												<p class="text-sm">缓存可以加快站点的加载速度，通常系统会自动更新缓存。特殊情况需要手动更新，如：缓存文件被修改、手动修改过数据库、页面出现异常等.</p>
												<hr class="horizontal dark">
												<div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
													<button type="button" class="btn btn-sm btn-primary mb-2 mb-md-0" onclick="window.location='<?= SELF ?>?act=setting&Cache';">更新缓存</button>
													<div class="avatar-group">
														<a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom">
															<img alt="Image placeholder" src="https://q4.qlogo.cn/headimg_dl?dst_uin=271106735&spec=640">
														</a>
														<a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom">
															<img alt="Image placeholder" src="https://q4.qlogo.cn/headimg_dl?dst_uin=271106735&spec=640">
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>




					</div>
				
				</div>
			</div>
		</form>
			<script src="<?= SITE_URL ?>content/admin/js/plugins/choices.min.js"></script>
			<script>
				$("#menu_system_manage").addClass('active');
				$("#menu_system").addClass('show');
				$("#menu_setting").addClass('active');
				// 页面加载时初始化状态
				document.addEventListener('DOMContentLoaded', function() {
					const detectUrlCheckbox = document.querySelector('input[name="detect_url"]');
					const blogUrlInput = document.querySelector('input[name="siteurl"]');
					
					// 设置初始状态
					blogUrlInput.disabled = detectUrlCheckbox.checked;
					
					// 监听checkbox变化
					detectUrlCheckbox.addEventListener('change', function() {
						blogUrlInput.disabled = this.checked;
					});
				});
				if (document.getElementsByName('timezone')[0]) {
					const example = new Choices(document.getElementsByName('timezone')[0], {shouldSort: false});
				}
				if (document.getElementsByName('language')[0]) {
					const example = new Choices(document.getElementsByName('language')[0], {shouldSort: false,searchEnabled: false});
				}
				if (document.getElementsByName('log_title_style')[0]) {
					const example = new Choices(document.getElementsByName('log_title_style')[0], {shouldSort: false,searchEnabled: false});
				}
				// 提交表单
				$("#form_log").submit(function(event) {
					event.preventDefault();
					submitForm("#form_log");
				});

				document.getElementById('download_backup').onclick = function() {
					fetch('<?= SELF ?>?act=setting&backup', {
						method: 'POST',
						body: new URLSearchParams({
							zipbak: document.querySelector('input[name="zipbak"]:checked').value,
							token: '<?= LoginAuth::genToken() ?>'
						})
					}).then(r => {
						if (!r.ok) throw r;
						let d = r.headers.get('Content-Disposition')||'';
						let f = (d.match(/filename=([^;]+)/)||[,"backup.sql"])[1].replace(/['"]/g,'');
						return r.blob().then(b => [b, f]);
					}).then(([b, f]) => {
						let u = URL.createObjectURL(b), a = document.createElement('a');
						a.href = u; a.download = f; document.body.appendChild(a); a.click();
						setTimeout(() => { document.body.removeChild(a); URL.revokeObjectURL(u); }, 100);
					}).catch(async e => {
						let m = '请求失败，请重试';
						if (e && e.text) try { m = (JSON.parse(await e.text()).message) || m; } catch {}
						alert(m);
					});
				};

				document.getElementById('import_backup').onclick = function() {
					var modal = new bootstrap.Modal(document.getElementById('importModal'));
					modal.show();
				};
	<?php if (Input::getStrVar('code') === 'import'): ?>Toast.fire({
		icon: 'success',
		title: '备份导入成功'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'mc'): ?>Toast.fire({
		icon: 'success',
		title: '缓存更新成功'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'ok_reset'): ?>Toast.fire({
		icon: 'success',
		title: '接口秘钥重置成功'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'error_a'): ?>Toast.fire({
		icon: 'error',
		title: '服务器空间不支持zip，无法导入zip备份'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'error_b'): ?>Toast.fire({
		icon: 'error',
		title: '上传备份失败'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'error_c'): ?>Toast.fire({
		icon: 'error',
		title: '错误的备份文件'
	});
	<?php endif ?><?php if (Input::getStrVar('code') === 'error_d'): ?>Toast.fire({
		icon: 'error',
		title: '服务器空间不支持zip，无法导出zip备份'
	});
	<?php endif ?>
			</script>