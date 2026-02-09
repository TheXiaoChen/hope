<?php defined('HOPE_ROOT') || exit('access denied!'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= SITE_URL ?>content/admin/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= SITE_URL ?>content/admin/img/favicon.png">
  <title>管理中心 - <?= Option::get('sitename') ?></title>
  <!link href="<?= SITE_URL ?>content/admin/css/font-awesome.min.css?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" rel="stylesheet" />
  <link href="<?= SITE_URL ?>content/admin/css/fontawesome7.css?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" rel="stylesheet" />

  <link href="<?= SITE_URL ?>content/admin/css/nucleo-icons.css?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" rel="stylesheet" />
  <link href="<?= SITE_URL ?>content/admin/css/argon-dashboard.min.css?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" id="pagestyle"
    rel="stylesheet" />
  <link href="<?= SITE_URL ?>content/admin/css/style.css?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>" rel="stylesheet" />
  <script src="<?= SITE_URL ?>content/admin/js/js.cookie-2.2.1.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
  <script src="<?= SITE_URL ?>content/admin/js/jquery-3.7.1.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
  <script src="<?= SITE_URL ?>content/admin/js/jquery-ui.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
  <script src="<?= SITE_URL ?>content/admin/js/plugins/sweetalert.min.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
  <script src="<?= SITE_URL ?>content/admin/js/common.js?v=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
  <?php doAction('adm_head') ?>
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?= SITE_URL ?>" target="_blank">
        <img src="<?= SITE_URL ?>content/admin/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">
            <?= Option::get('sitename') ?>
        </span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" id="menu_home" href="<?= SELF ?>">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">后台首页</span>
          </a>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" class="nav-link" id="menu_content_manage" role="button" href="#menu_content" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">内容</span>
          </a>
          <div class="collapse " id="menu_content">
            <ul class="nav ms-4">
              <li class="nav-item" id="menu_log">
                <a class="nav-link" href="<?= SELF ?>?act=article">
                  <span class="sidenav-mini-icon text-xs"> 文章 </span>
                  <span class="sidenav-normal">文章</span>
                </a>
              </li>
              <li class="nav-item" id="menu_page">
                <a class="nav-link" href="<?= SELF ?>?act=page">
                  <span class="sidenav-mini-icon text-xs"> 页面 </span>
                  <span class="sidenav-normal">页面</span>
                </a>
              </li>
              <li class="nav-item" id="menu_comment">
                <a class="nav-link" href="<?= SELF ?>?act=comment">
                  <span class="sidenav-mini-icon text-xs"> 评论 </span>
                  <span class="sidenav-normal">评论</span>
                </a>
              </li>
              <li class="nav-item" id="menu_link">
                <a class="nav-link" href="<?= SELF ?>?act=link">
                  <span class="sidenav-mini-icon text-xs"> 链接 </span>
                  <span class="sidenav-normal">链接</span>
                </a>
              </li>
              <!--li class="nav-item" id="menu_twitter">
                <a class="nav-link" href="<?= SELF ?>?act=twitter">
                  <span class="sidenav-mini-icon text-xs"> 微语 </span>
                  <span class="sidenav-normal">微语</span>
                </a>
              </li-->
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a data-bs-toggle="collapse" class="nav-link" id="menu_surface_manage" role="button" href="#menu_surface"
            aria-controls="menu_view" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-atom text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">外观</span>
          </a>
          <div class="collapse " id="menu_surface">
            <ul class="nav ms-4">
              <li class="nav-item" id="menu_theme">
                <a class="nav-link" href="<?= SELF ?>?act=theme">
                  <span class="sidenav-mini-icon text-xs"> 主题 </span>
                  <span class="sidenav-normal">主题</span>
                </a>
              </li>
              <li class="nav-item" id="menu_menu">
                <a class="nav-link" href="<?= SELF ?>?act=menu">
                  <span class="sidenav-mini-icon text-xs"> 菜单 </span>
                  <span class="sidenav-normal">菜单</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a data-bs-toggle="collapse" class="nav-link" id="menu_system_manage" role="button" href="#menu_system"
            aria-controls="menu_view" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-settings-gear-65 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">系统</span>
          </a>
          <div class="collapse " id="menu_system">
            <ul class="nav ms-4">
              <li class="nav-item" id="menu_setting">
                <a class="nav-link" href="<?= SELF ?>?act=setting">
                  <span class="sidenav-mini-icon text-xs"> 设置 </span>
                  <span class="sidenav-normal">设置</span>
                </a>
              </li>
              <li class="nav-item" id="menu_pay">
                <a class="nav-link" href="<?= SELF ?>?act=pay">
                  <span class="sidenav-mini-icon text-xs"> 支付 </span>
                  <span class="sidenav-normal">支付</span>
                </a>
              </li>
              <li class="nav-item" id="menu_upload">
                <a class="nav-link" href="<?= SELF ?>?act=upload">
                  <span class="sidenav-mini-icon text-xs"> 附件 </span>
                  <span class="sidenav-normal">附件</span>
                </a>
              </li>
              <li class="nav-item" id="menu_user">
                <a class="nav-link" href="<?= SELF ?>?act=user">
                  <span class="sidenav-mini-icon text-xs"> 用户 </span>
                  <span class="sidenav-normal">用户</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <hr class="horizontal dark">
          <a class="nav-link" id="menu_apply" href="<?= SELF ?>?act=apply">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">应用中心</span>
          </a>
        </li>



        <li class="nav-item">
          <a data-bs-toggle="collapse" class="nav-link" id="menu_plugin_category" role="button" href="#menu_plugin"
            aria-controls="menu_plugin" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-box-2 text-muted text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">插件</span>
          </a>
          <div class="collapse " id="menu_plugin">
            <ul class="nav ms-4">
              <li class="nav-item" id="menu_plugins">
                <a class="nav-link" href="<?= SELF ?>?act=plugin">
                  <span class="sidenav-mini-icon text-xs"> 管理 </span>
                  <span class="sidenav-normal">管理</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
      id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none">
          <a href="javascript:;" class="nav-link p-0">
            <div class="sidenav-toggler-inner"> <i class="sidenav-toggler-line bg-white"></i> <i
                class="sidenav-toggler-line bg-white"></i> <i class="sidenav-toggler-line bg-white"></i> </div>
          </a>
        </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="<?= SELF ?>?act=user" class="nav-link text-white font-weight-bold px-0"
                target="_blank"> <i class="fa fa-user me-sm-1"></i> <span class="d-sm-inline d-none">
                  <?= $user_cache[UID]['name'] ?>
                </span> </a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="<?= SELF ?>?act=logout" class="nav-link text-white p-0"> <i class="fa fa-solid fa-right-from-bracket"></i> </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner"> <i class="sidenav-toggler-line bg-white"></i> <i
                    class="sidenav-toggler-line bg-white"></i> <i class="sidenav-toggler-line bg-white"></i></div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid">