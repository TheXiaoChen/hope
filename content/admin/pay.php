<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
<form action="<?= SELF ?>?act=pay&save" method="post" name="form_log" id="form_log">
	<div class="row">
		<div class="col-lg-4 col-sm-8">
			<div class="nav-wrapper position-relative end-0">
				<ul class="nav nav-pills nav-fill p-1" role="tablist">
					<li class="nav-item">
						<a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#set1" aria-controls="set1"
							role="tab" aria-selected="true">
							支付配置
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="#set2" aria-controls="set2"
							role="tab" aria-selected="false">
							订单列表
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-lg-1 ms-auto">
			<input name="token" id="token" value="<?= LoginAuth::genToken() ?>" type="hidden" />
			<button class="btn btn-white mb-0 " type="submit" title="保存">保存</button>
		</div>
	</div>
	<div class="row">
		<div class="mt-lg-0 mt-4">
			<div class="tab-content tab-space">
				<div class="card mt-4 tab-pane active" id="set1">
					<div class="card-body">
						<h5>支付收款</h5>
						<div class="row">
							<div class="col-6">
								<label class="form-label">微信收款接口</label>
								<select class="form-control" name="weixinapi">
									<option value="0" <?= $wx0 ?>>微信官方</option>
									<option value="1" <?= $wx1 ?>>虎皮椒</option>
									<option value="2" <?= $wx2 ?>>易支付</option>
									<option value="3" <?= $wx3 ?>>码支付</option>
								</select>
							</div>
							<div class="col-6">
								<label class="form-label">支付宝收款接口</label>
								<select class="form-control" name="alipayapi">
									<option value="0" <?= $zfb0 ?>>支付宝官方</option>
									<option value="1" <?= $zfb1 ?>>虎皮椒</option>
									<option value="2" <?= $zfb2 ?>>易支付</option>
									<option value="3" <?= $zfb3 ?>>码支付</option>
								</select>
							</div>
						</div>
						<hr class="horizontal dark mt-4 my-3">

						<div id="option">
							<div class="nav-wrapper position-relative end-0">
								<ul class="nav nav-pills nav-fill p-1" role="tablist">
									<li class="nav-item">
										<a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="collapse"
											data-bs-target="#wxpay" aria-controls="wxpay" aria-selected="true">微信官方(禁用)
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link mb-0 px-0 py-1" data-bs-toggle="collapse"
											data-bs-target="#alipay" aria-controls="alipay" aria-selected="false">支付宝官方
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link mb-0 px-0 py-1" data-bs-toggle="collapse"
											data-bs-target="#hpjpay" aria-controls="hpjpay" aria-selected="false">虎皮椒
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link mb-0 px-0 py-1" data-bs-toggle="collapse"
											data-bs-target="#ypay" aria-controls="ypay" aria-selected="false">易支付
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link mb-0 px-0 py-1" data-bs-toggle="collapse"
											data-bs-target="#mpay" aria-controls="mpay" aria-selected="false">码支付
										</a>
									</li>
								</ul>
							</div>
							<hr class="horizontal dark mt-4 my-3">
							<div id="wxpay" class="accordion-collapse collapse show" data-bs-parent="#option"
								aria-expanded="true">
								<div class="row">
									<div class="col-6">
										<label class="form-label">微信APPID</label>
										<div class="input-group">
											<input name="wx_appid" class="form-control" type="text"
												value="<?= $payment['wx_appid'] ?>">
										</div>
									</div>
									<div class="col-6">
										<label class="form-label">微信商户号</label>
										<div class="input-group">
											<input name="wx_mchid" class="form-control" type="text"
												value="<?= $payment['wx_mchid'] ?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>微信KEY值</label>
									<input name="wx_key" class="form-control" value="<?= $payment['wx_key'] ?>">
								</div>
							</div>
							<div id="alipay" class="accordion-collapse collapse" data-bs-parent="#option">
								<div class="alert alert-light mb-3">
									<h6>配置流程：</h6>
									<ol class="mb-0">
										<li>注册并登录 <a href="https://open.alipay.com/develop/manage" target="_blank">支付宝开放平台</a>，完成个人或者企业认证</li>
										<li>申请开通支付宝 <a href="https://open.alipay.com/api/detail?code=I1080300001000041016&amp;index=0" target="_blank">当面付</a>：按照提示完成当面付产品的签约</li>
										<li>创建一个网页移动应用，得到 <code>应用ID（APPID）</code></li>
										<li>进入应用开发设置：应用的加密方式为：密钥方式，最终会得到：<code>应用私钥</code>、<code>支付宝公钥</code></li>
										<li>进入应用开发设置：填写应用网关和授权回调地址，具体地址由使用该SDK的应用提供</li>
									</ol>
								</div>
								<div class="form-group">
									<label>支付宝公钥</label>
									<textarea class="form-control" name="alipay_public_key"
										rows="3"><?= $payment['alipay_public_key'] ?></textarea>
								</div>
								<div class="row">
									<div class="col-6">
										<label class="form-label">当面付:APPID</label>
										<input type="text" name="alipay_f2f_appid" class="form-control"
											value="<?= $payment['alipay_f2f_appid'] ?>">
									</div>
									<div class="col-6">
										<label class="form-label">当面付:应用私钥</label>
										<input type="text" name="alipay_f2f_private_key" class="form-control"
											value="<?= $payment['alipay_f2f_private_key'] ?>">
									</div>
								</div>

								<div class="row">
									<div class="col-6">
										<label class="form-label">网站应用:APPID</label>
										<input type="text" class="form-control" name="alipay_web_appid"
											value="<?= $payment['alipay_web_appid'] ?>">
									</div>
									<div class="col-6">
										<label class="form-label">网站应用:应用私钥</label>
										<input type="text" name="alipay_web_private_key" class="form-control"
											value="<?= $payment['alipay_web_private_key'] ?>">
									</div>
								</div>
							</div>
							<div id="hpjpay" class="accordion-collapse collapse" data-bs-parent="#option">
								<div class="alert alert-light mb-3">
									<h6>配置流程：</h6>
									<ol class="mb-0">
										<li>1、注册并登录 <a href="https://www.xunhupay.com/" target="_blank">虎皮椒支付平台</a></li>
										<li>2、完成实名认证和商户认证</li>
										<li>3、创建应用，获得 <code>APPID</code> 和 <code>APPSECRET</code></li>
										<li>4、配置支付网关地址（默认为官方网关）</li>
										<li>5、设置异步通知地址和同步跳转地址</li>
									</ol>
								</div>
								<div class="form-group">
									<label>虎皮椒Api</label>
									<input name="hpj_api" class="form-control" value="<?= $payment['hpj_api'] ?>">
								</div>
								<div class="row">
									<div class="col-6">
										<label class="form-label">微信ID</label>
										<div class="input-group">
											<input name="hpj_wx_id" class="form-control" type="text"
												value="<?= $payment['hpj_wx_id'] ?>">
										</div>
									</div>
									<div class="col-6">
										<label class="form-label">微信KEY</label>
										<div class="input-group">
											<input name="hpj_wx_key" class="form-control" type="text"
												value="<?= $payment['hpj_wx_key'] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<label class="form-label">支付宝ID</label>
										<div class="input-group">
											<input name="hpj_alipay_id" class="form-control" type="text"
												value="<?= $payment['hpj_alipay_id'] ?>">
										</div>
									</div>
									<div class="col-6">
										<label class="form-label">支付宝KEY</label>
										<div class="input-group">
											<input name="hpj_alipay_key" class="form-control" type="text"
												value="<?= $payment['hpj_alipay_key'] ?>">
										</div>
									</div>
								</div>
							</div>
							<div id="ypay" class="accordion-collapse collapse" data-bs-parent="#option">
								<div class="alert alert-light mb-3">
									<h6>配置流程：</h6>
									<ol class="mb-0">
										<li>1、注册并登录兼容易支付接口的平台，如： <a href="https://pay.yuankainet.cn/" target="_blank">源开易支付</a>（只做示例，不代表推荐该平台，易支付平台比较杂乱，请谨慎选择，避免资金损失）</li>
										<li>2、获得商户ID (PID) 、和商户密钥 (KEY)、支付网关地址，配置在下面的表单中</li>
									</ol>
								</div>
								<div class="form-group">
									<label>易支付Api</label>
									<input name="epay_api" class="form-control" value="<?= $payment['epay_api'] ?>">
								</div>
								<div class="row">
									<div class="col-6">
										<label class="form-label">ID</label>
										<div class="input-group">
											<input name="epay_id" class="form-control" type="text"
												value="<?= $payment['epay_id'] ?>">
										</div>
									</div>
									<div class="col-6">
										<label class="form-label">KEY</label>
										<div class="input-group">
											<input name="epay_key" class="form-control" type="text"
												value="<?= $payment['epay_key'] ?>">
										</div>
									</div>
								</div>
							</div>
							<div id="mpay" class="accordion-collapse collapse" data-bs-parent="#option">
								<div class="form-group">
									<label>码支付Api</label>
									<input name="codepay_api" class="form-control"
										value="<?= $payment['codepay_api'] ?>">
								</div>
								<div class="row">
									<div class="col-6">
										<label class="form-label">ID</label>
										<div class="input-group">
											<input name="codepay_id" class="form-control" type="text"
												value="<?= $payment['codepay_id'] ?>">
										</div>
									</div>
									<div class="col-6">
										<label class="form-label">KEY</label>
										<div class="input-group">
											<input name="codepay_key" class="form-control" type="text"
												value="<?= $payment['codepay_key'] ?>">
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
	$("#menu_pay").addClass('active');
	// 提交表单
	$("#form_log").submit(function(event) {
		event.preventDefault();
		submitForm("#form_log");
	});

	if (document.getElementsByName('weixinapi')[0]) {
		const example = new Choices(document.getElementsByName('weixinapi')[0], { shouldSort: false, searchEnabled: false });
	}
	if (document.getElementsByName('alipayapi')[0]) {
		const example = new Choices(document.getElementsByName('alipayapi')[0], { shouldSort: false, searchEnabled: false });
	}
	if (document.getElementById('choices3')) {
		var gender = document.getElementById('choices3');
		const example = new Choices(gender);
	}
</script>