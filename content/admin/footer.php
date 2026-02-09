<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
<footer class="sidenav-footer mx-3 my-3">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="copyright text-center text-sm text-muted text-lg-start">
          ©
          <script>document.write(new Date().getFullYear())</script> made with <i class="fa fa-heart"></i> by <a
            href="http://www.hopecms.cn" class="font-weight-bold" target="_blank">小辰</a> Copyright for a better web.
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="#" class="nav-link text-muted" target="_blank">使用帮助</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-muted" target="_blank">应用开发</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-muted" target="_blank">联系交流</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link pe-0 text-muted" target="_blank">问题反馈</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
</div>
</main>
<div class="fixed-plugin">
  <a class="fixed-plugin-button text-dark position-fixed px-3 py-2"> <i class="fa fa-cog py-2"> </i> </a>
  <div class="card shadow-lg">

    <div class="card-header pb-0 pt-3 bg-transparent ">
      <div class="float-start">
        <h5 class="mt-3 mb-0">后台设置</h5>
        <p>特别的主题才是你喜欢的.</p>
      </div>
      <div class="float-end mt-4">
        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button"> <i class="fa fa-close"></i> </button>
      </div>
    </div>
    <hr class="horizontal dark my-1">
    <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <div>
          <h6 class="mb-0">侧边栏颜色</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start"> <span class="badge filter bg-gradient-primary active"
              data-color="primary" onclick="sidebarColor(this)"></span> <span class="badge filter bg-gradient-dark"
              data-color="dark" onclick="sidebarColor(this)"></span> <span class="badge filter bg-gradient-info"
              data-color="info" onclick="sidebarColor(this)"></span> <span class="badge filter bg-gradient-success"
              data-color="success" onclick="sidebarColor(this)"></span> <span class="badge filter bg-gradient-warning"
              data-color="warning" onclick="sidebarColor(this)"></span> <span class="badge filter bg-gradient-danger"
              data-color="danger" onclick="sidebarColor(this)"></span> </div>
        </a>
        <div class="mt-3">
          <h6 class="mb-0">侧导航类型 </h6>
          <p class="text-sm">两种不同的侧导航类型.</p>
        </div>
        <div class="d-flex">
          <button type="button" class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
            onclick="sidebarType(this)">白天</button>
          <button type="button" class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
            onclick="sidebarType(this)">黑夜</button>
        </div>
        <div class="d-flex my-3">
          <h6 class="mb-0">导航栏固定</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="d-flex my-4">
          <h6 class="mb-0">迷你侧导航</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarMinimize" onclick="navbarMinimize(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">亮/暗</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        
        <button type="button" id="adminThemeSaveBtn" class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white">保存</button>

    </div>
  </div>
</div>
<?php doAction('adm_footer') ?>
<script src="<?= SITE_URL ?>content/admin/js/core/popper.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="<?= SITE_URL ?>content/admin/js/core/bootstrap.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>

<script src="<?= SITE_URL ?>content/admin/js/plugins/perfect-scrollbar.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<!--script src="<?= SITE_URL ?>content/admin/js/plugins/smooth-scrollbar.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script-->
<script src="<?= SITE_URL ?>content/admin/js/argon-dashboard.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<?php
  // 后台界面默认主题设置（可在系统设置中存储这些键名）
  $admin_sidebar_color = Option::get('admin_sidebar_color') ? Option::get('admin_sidebar_color') : 'primary';
  $admin_sidebar_type = Option::get('admin_sidebar_type') ? Option::get('admin_sidebar_type') : 'bg-white';
  // 可选值：'pinned' | 'hidden' | 'none'
  $admin_navbar_minimize = Option::get('admin_navbar_minimize') ? Option::get('admin_navbar_minimize') : 'none';
  // 可选值：'y' 开启固定导航栏, 其他视为关闭
  $admin_navbar_fixed = Option::get('admin_navbar_fixed') ? Option::get('admin_navbar_fixed') : 'n';
  // 可选值：'y' 开启暗色, 其他视为关闭
  $admin_dark_mode = Option::get('admin_dark_mode') ? Option::get('admin_dark_mode') : 'n';
?>
<script>
  (function(){
    document.addEventListener('DOMContentLoaded', function(){
      try{
        var backend_theme = <?= unserialize(Option::get('backend_theme'))?:'{sidebar_color："primary", sidebar_type："bg-white", navbar_minimize："none", navbar_fixed："n", dark_mode："n"}' ?>;


        // 1) 侧栏颜色（调用已有函数 sidebarColor，传入对应的 badge 元素）
        var badge = document.querySelector('.fixed-plugin .badge[data-color="'+backend_theme.sidebar_color+'"]');
        if(badge && typeof sidebarColor === 'function'){
          // ensure only applied once
          if(!badge.classList.contains('active')) sidebarColor(badge);
        }

        // 2) 侧栏类型（bg-white / bg-default 等）
        var btn = document.querySelector('.fixed-plugin button[data-class="'+backend_theme.sidebar_type+'"]');
        if(btn && typeof sidebarType === 'function'){
          // ensure visual active state
          if(!btn.classList.contains('active')) sidebarType(btn);
          btn.classList.add('active');
        }

        // 3) 侧边栏最小化（直接调整类以保证一致性）
        var chk = document.getElementById('navbarMinimize');
        var wrapper = document.getElementsByClassName('g-sidenav-show')[0];
        if(wrapper && chk){
          if(backend_theme.navbar_minimize === 'pinned'){
            wrapper.classList.remove('g-sidenav-hidden');
            wrapper.classList.add('g-sidenav-pinned');
            chk.setAttribute('checked','true');
          } else if(backend_theme.navbar_minimize === 'hidden'){
            wrapper.classList.remove('g-sidenav-pinned');
            wrapper.classList.add('g-sidenav-hidden');
            chk.removeAttribute('checked');
          } else {
            // 保持默认不变
          }
        }
        // 3.5) 导航栏固定（navbarFixed）
        var navFixedChk = document.getElementById('navbarFixed');
        if(typeof navbarFixed === 'function' && navFixedChk){
          if(backend_theme.navbar_fixed === 'y'){
            if(!navFixedChk.getAttribute('checked')) navbarFixed(navFixedChk);
          } else {
            if(navFixedChk.getAttribute('checked')) navbarFixed(navFixedChk);
          }
        }

        // 4) 暗色模式（通过调用 darkMode 保证样式被完整切换）
        var darkChk = document.getElementById('dark-version');
        if(typeof darkMode === 'function' && darkChk){
          if(backend_theme.dark_mode === 'y'){
            // 如果当前未处于 checked 状态，则调用以开启
            if(!darkChk.getAttribute('checked')) darkMode(darkChk);
          } else {
            // 如果当前是 checked，则调用以关闭
            if(darkChk.getAttribute('checked')) darkMode(darkChk);
          }
        }
      }catch(e){
        console && console.error && console.error('apply admin UI defaults error', e);
      }
    });
  })();
</script>
<script>
  
  (function(){
    // Collect current UI settings from the fixed-plugin controls
    function collectSettings(){
      var root = document.querySelector('.fixed-plugin');
      var badge = root.querySelector('.badge.active[data-color]') || root.querySelector('.badge[data-color].active') || root.querySelector('.badge[data-color]');
      var color = badge ? badge.getAttribute('data-color') : '';

      var btn = root.querySelector('button.active[data-class]') || root.querySelector('button[data-class]');
      var sidebarType = btn ? btn.getAttribute('data-class') : '';

      var navFixedChk = document.getElementById('navbarFixed');
      var navbarFixed = (navFixedChk && navFixedChk.checked) ? 'y' : 'n';

      var navMinChk = document.getElementById('navbarMinimize');
      // 当选中时我们发送 'pinned'，否则发送 'none'（后端可按需解析）
      var navbarMinimize = (navMinChk && navMinChk.checked) ? 'pinned' : 'none';

      var darkChk = document.getElementById('dark-version');
      var darkMode = (darkChk && darkChk.checked) ? 'y' : 'n';

      return {
        sidebar_color: color,
        sidebar_type: sidebarType,
        navbar_fixed: navbarFixed,
        navbar_minimize: navbarMinimize,
        dark_mode: darkMode
      };
    }

    function showMessage(msg, type){
      // type: 'success' | 'danger' | 'info'
      var container = document.querySelector('.fixed-plugin .card-body');
      if(!container) return alert(msg);
      var existing = container.querySelector('.admin-theme-save-alert');
      if(existing) existing.remove();
      var div = document.createElement('div');
      div.className = 'admin-theme-save-alert alert alert-' + (type || 'info') + ' alert-dismissible fade show';
      div.setAttribute('role','alert');
      div.innerHTML = msg + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
      container.insertBefore(div, container.firstChild);
      // auto dismiss after 4s
      setTimeout(function(){ try{ div.classList.remove('show'); div.classList.add('hide'); div.remove(); }catch(e){} }, 4000);
    }

    async function saveSettings(){
      var btn = document.getElementById('adminThemeSaveBtn');
      if(!btn) return;
      var payload = collectSettings();
      // disable button
      btn.setAttribute('disabled','true');
      var originalText = btn.innerHTML;
      btn.innerHTML = '保存中...';

      try{
        var url = '<?= SELF ?>?act=save_admin_theme';
        var res = await fetch(url, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
          body: JSON.stringify(payload)
        });
        var data;
        try{ data = await res.json(); }catch(e){ data = { success: res.ok, message: (res.statusText || '保存完成') }; }

        if(data && data.success){
          showMessage(data.message || '保存成功', 'success');
        } else {
          showMessage(data && data.message ? data.message : '保存失败，请重试', 'danger');
        }
      }catch(e){
        console && console.error && console.error('save admin theme error', e);
        showMessage('请求失败：' + (e && e.message ? e.message : e), 'danger');
      }finally{
        btn.removeAttribute('disabled');
        btn.innerHTML = originalText;
      }
    }

    document.addEventListener('DOMContentLoaded', function(){
      var btn = document.getElementById('adminThemeSaveBtn');
      if(btn) btn.addEventListener('click', function(e){
        e.preventDefault();
        saveSettings();
      });
    });
  })();
</script>
</body>

</html>