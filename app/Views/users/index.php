<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Manajemen User - HRIS<?= $this->endSection() ?>
<?= $this->section('menuActive') ?>users<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h4 class="fw-bold py-3 mb-4">Manajemen User</h4>

<?php if (session()->getFlashdata('message')): ?>
  <div class="alert alert-success alert-dismissible" role="alert">
    <?= session()->getFlashdata('message') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php elseif (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger alert-dismissible" role="alert">
    <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
  <div class="alert alert-danger">
    <ul class="mb-0">
      <?php foreach (session()->getFlashdata('errors') as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar User</h5>
    <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
      <i class="ti ti-plus me-1"></i>Tambah User
    </a>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Email</th>
          <th>Nama Lengkap</th>
          <th>Role</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($users)): ?>
          <tr>
            <td colspan="7" class="text-center">Belum ada data user.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($users as $i => $user): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= esc($user['username']) ?></td>
              <td><?= esc($user['email']) ?></td>
              <td><?= esc($user['full_name']) ?></td>
              <td>
                <span class="badge bg-label-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'manager' ? 'warning' : 'info') ?>">
                  <?= ucfirst($user['role']) ?>
                </span>
              </td>
              <td>
                <span class="badge bg-label-<?= $user['status'] === 'active' ? 'success' : 'secondary' ?>">
                  <?= ucfirst($user['status']) ?>
                </span>
              </td>
              <td>
                <button type="button" class="btn btn-sm btn-icon btn-info" title="Detail"
                        data-bs-toggle="modal" data-bs-target="#detailUserModal"
                        data-username="<?= esc($user['username']) ?>"
                        data-email="<?= esc($user['email']) ?>"
                        data-full_name="<?= esc($user['full_name']) ?>"
                        data-phone="<?= esc($user['phone']) ?>"
                        data-role="<?= ucfirst($user['role']) ?>"
                        data-role_class="<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'manager' ? 'warning' : 'info') ?>"
                        data-status="<?= ucfirst($user['status']) ?>"
                        data-status_class="<?= $user['status'] === 'active' ? 'success' : 'secondary' ?>"
                        data-created_at="<?= date('d/m/Y H:i', strtotime($user['created_at'])) ?>">
                  <i class="ti ti-eye"></i>
                </button>
                <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-sm btn-icon btn-primary" title="Edit">
                  <i class="ti ti-edit"></i>
                </a>
                <form action="<?= base_url('users/delete/' . $user['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                  <button type="submit" class="btn btn-sm btn-icon btn-danger" title="Hapus">
                    <i class="ti ti-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="detailUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
      <div class="modal-header border-0 py-3 px-4" style="background: #f8f9ff;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
            <i class="ti ti-users text-primary"></i>
          </div>
          <div>
            <h6 class="mb-0 fw-semibold" style="color: #00174b; font-size: 0.9rem;">Detail User</h6>
            <small class="text-muted" id="detail-user-subtitle"></small>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-0">
        <div class="row g-0">
          <div class="col-md-4 p-5 d-flex flex-column align-items-center justify-content-center text-center" style="background: #eef0ff;">
            <div class="position-relative mb-4">
              <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 74, 198, 0.08); border-radius: 50%; transform: scale(1.15);"></div>
              <div class="d-flex align-items-center justify-content-center rounded-circle border border-3 border-white shadow"
                   style="width: 120px; height: 120px; background: #dbe1ff;">
                <i class="ti ti-user text-primary" style="font-size: 3rem;"></i>
              </div>
              <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-white shadow-sm"
                   style="width: 36px; height: 36px;">
                <i class="ti ti-circle-check-filled ti-sm"></i>
              </div>
            </div>
            <h5 class="fw-bold mb-1" id="detail-user-name" style="color: #00174b;"></h5>
            <p class="text-muted mb-3" id="detail-user-username" style="font-size: 0.9rem;"></p>
            <div class="d-flex gap-2 justify-content-center flex-wrap">
              <span class="badge rounded-pill fw-semibold px-3 py-2" id="detail-user-role-badge" style="font-size: 0.7rem;"></span>
              <span class="badge rounded-pill fw-semibold px-3 py-2 d-flex align-items-center gap-1" id="detail-user-status-badge" style="font-size: 0.7rem;">
                <span class="rounded-circle" style="width: 6px; height: 6px; background: currentColor; animation: pulse 2s infinite;" id="detail-user-status-dot"></span>
                <span id="detail-user-status-text"></span>
              </span>
            </div>
          </div>

          <div class="col-md-8 p-5" style="background: #ffffff;">
            <h6 class="text-uppercase fw-semibold mb-4 pb-2 border-bottom" style="color: #004ac6; font-size: 0.7rem; letter-spacing: 0.05em;">
              <i class="ti ti-info-circle me-1"></i>Informasi Akun
            </h6>
            <div class="row g-3">
              <div class="col-md-6">
                <div class="p-4 rounded-3 border" style="background: #f8f9ff; border-color: #eef0ff !important;">
                  <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
                      <i class="ti ti-mail text-primary ti-sm"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem;">Email</small>
                  </div>
                  <p class="mb-0 fw-bold" id="detail-user-email" style="color: #00174b; font-size: 0.95rem;"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-4 rounded-3 border" style="background: #f8f9ff; border-color: #eef0ff !important;">
                  <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
                      <i class="ti ti-phone text-primary ti-sm"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem;">Telepon</small>
                  </div>
                  <p class="mb-0 fw-bold" id="detail-user-phone" style="color: #00174b; font-size: 0.95rem;"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-4 rounded-3 border" style="background: #f8f9ff; border-color: #eef0ff !important;">
                  <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
                      <i class="ti ti-calendar text-primary ti-sm"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem;">Terdaftar Sejak</small>
                  </div>
                  <p class="mb-0 fw-bold" id="detail-user-created" style="color: #00174b; font-size: 0.95rem;"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-4 rounded-3 border" style="background: #f8f9ff; border-color: #eef0ff !important;">
                  <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
                      <i class="ti ti-shield text-primary ti-sm"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem;">Hak Akses</small>
                  </div>
                  <p class="mb-0 fw-bold" id="detail-user-access" style="color: #00174b; font-size: 0.95rem;"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer border-0 px-5 py-3 d-flex justify-content-end" style="background: #f8f9ff;">
        <button type="button" class="btn px-4 py-2 fw-semibold btn-danger" style="font-size: 0.8rem;" data-bs-dismiss="modal">
          <i class="ti ti-x me-1"></i>Tutup
        </button>
      </div>
    </div>
  </div>
</div>

<style>
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.4; }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
$(function() {
  $('#detailUserModal').on('show.bs.modal', function(e) {
    var btn = $(e.relatedTarget);
    var name = btn.data('full_name');

    $('#detail-user-subtitle').text('@' + btn.data('username'));
    $('#detail-user-name').text(name);
    $('#detail-user-username').text('@' + btn.data('username'));
    $('#detail-user-email').text(btn.data('email') || '-');
    $('#detail-user-phone').text(btn.data('phone') || '-');
    $('#detail-user-created').text(btn.data('created_at'));
    $('#detail-user-access').text(btn.data('role') === 'Admin' ? 'Full System Access' : 'Limited Access');

    var roleClass = btn.data('role_class');
    var roleBadge = $('#detail-user-role-badge');
    roleBadge.text(btn.data('role'));
    roleBadge.css('background', roleClass === 'danger' ? '#ffe0e0' : roleClass === 'warning' ? '#fff3d6' : '#d6f5e0');
    roleBadge.css('color', roleClass === 'danger' ? '#d32f2f' : roleClass === 'warning' ? '#e6a700' : '#2e7d32');

    var statusClass = btn.data('status_class');
    var statusBadge = $('#detail-user-status-badge');
    statusBadge.css('background', statusClass === 'success' ? '#d6f5e0' : '#f0f0f0');
    statusBadge.css('color', statusClass === 'success' ? '#2e7d32' : '#666');
    $('#detail-user-status-text').text(btn.data('status'));
    $('#detail-user-status-dot').css('background', statusClass === 'success' ? '#2e7d32' : '#666');
  });
});
</script>
<?= $this->endSection() ?>
