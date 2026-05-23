<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed"
      dir="ltr" data-theme="theme-default"
      data-assets-path="/assets/"
      data-template="vertical-menu-template-starter">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

<title><?= $this->renderSection('title') ?? 'HRIS - Dashboard' ?></title>

<meta name="description" content="" />

<link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css" />
<link rel="stylesheet" href="/assets/vendor/fonts/tabler-icons.css" />
<link rel="stylesheet" href="/assets/vendor/fonts/flag-icons.css" />

<link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="/assets/css/demo.css" />

<link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="/assets/vendor/libs/node-waves/node-waves.css" />

<?= $this->renderSection('pageStyles') ?>

<script src="/assets/vendor/js/helpers.js"></script>
<script src="/assets/vendor/js/template-customizer.js"></script>
<script src="/assets/js/config.js"></script>
</head>
<body>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="<?= base_url() ?>" class="app-brand-link">
          <span class="app-brand-logo demo">
            <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
              <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
              <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
              <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
            </svg>
          </span>
          <span class="app-brand-text demo menu-text fw-bold">HRIS</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
          <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
          <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
      </div>

      <div class="menu-inner-shadow"></div>

      <ul class="menu-inner py-1">
        <li class="menu-item <?= ($this->renderSection('menuActive') === 'dashboard') ? 'active' : '' ?>">
          <a href="<?= base_url() ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Dashboard">Dashboard</div>
          </a>
        </li>
        <li class="menu-item <?= ($this->renderSection('menuActive') === 'employees') ? 'active' : '' ?>">
          <a href="<?= base_url('employees') ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-briefcase"></i>
            <div data-i18n="Employees">Management Pegawai</div>
          </a>
        </li>
        <li class="menu-item <?= ($this->renderSection('menuActive') === 'users') ? 'active' : '' ?>">
          <a href="<?= base_url('users') ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-users"></i>
            <div data-i18n="Users">Manajemen User</div>
          </a>
        </li>
      </ul>
    </aside>

    <div class="layout-page">

      <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
          </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <div class="navbar-nav align-items-center">
            <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
              <i class="ti ti-sm"></i>
            </a>
          </div>

          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  <img src="/assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img src="/assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block"><?= session()->get('full_name') ?></span>
                        <small class="text-muted"><?= ucfirst(session()->get('role')) ?></small>
                      </div>
                    </div>
                  </a>
                </li>
                <li><div class="dropdown-divider"></div></li>
                <li>
                  <a class="dropdown-item" href="#">
                    <i class="ti ti-user-check me-2 ti-sm"></i>
                    <span class="align-middle">My Profile</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <i class="ti ti-settings me-2 ti-sm"></i>
                    <span class="align-middle">Settings</span>
                  </a>
                </li>
                <li><div class="dropdown-divider"></div></li>
                <li>
                  <a class="dropdown-item" href="<?= base_url('logout') ?>">
                    <i class="ti ti-logout me-2 ti-sm"></i>
                    <span class="align-middle">Log Out</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>

      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <?= $this->renderSection('content') ?>
        </div>

        <footer class="content-footer footer bg-footer-theme">
          <div class="container-xxl">
            <div class="footer-container d-flex align-items-center justify-content-center py-2 flex-md-row flex-column">
              <div>
                &copy; <?= date('Y') ?>, HRIS System
              </div>
            </div>
          </div>
        </footer>

        <div class="content-backdrop fade"></div>
      </div>
    </div>
  </div>

  <div class="layout-overlay layout-menu-toggle"></div>
  <div class="drag-target"></div>
</div>

<script src="/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/assets/vendor/libs/popper/popper.js"></script>
<script src="/assets/vendor/js/bootstrap.js"></script>
<script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="/assets/vendor/libs/hammer/hammer.js"></script>
<script src="/assets/vendor/js/menu.js"></script>

<?= $this->renderSection('vendorScripts') ?>

<script src="/assets/js/main.js"></script>

<?= $this->renderSection('pageScripts') ?>
</body>
</html>
