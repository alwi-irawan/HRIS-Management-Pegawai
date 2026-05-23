<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Management Pegawai - HRIS<?= $this->endSection() ?>
<?= $this->section('menuActive') ?>employees<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h4 class="fw-bold py-3 mb-4">Management Pegawai</h4>

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

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Pegawai</h5>
    <a href="<?= base_url('employees/create') ?>" class="btn btn-primary">
      <i class="ti ti-plus me-1"></i>Tambah Pegawai
    </a>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>NIP</th>
          <th>Nama Lengkap</th>
          <th>Jabatan</th>
          <th>Departemen</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($employees)): ?>
          <tr>
            <td colspan="8" class="text-center">Belum ada data pegawai.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($employees as $i => $emp): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td>
                <?php if ($emp['photo']): ?>
                  <img src="<?= base_url('uploads/employees/' . $emp['photo']) ?>"
                       alt="photo" class="rounded-circle" width="40" height="40"
                       style="object-fit: cover;">
                <?php else: ?>
                  <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                       style="width: 40px; height: 40px;">
                    <i class="ti ti-user text-white ti-sm"></i>
                  </div>
                <?php endif; ?>
              </td>
              <td><?= esc($emp['employee_id']) ?></td>
              <td><?= esc($emp['full_name']) ?></td>
              <td><?= esc($emp['position']) ?></td>
              <td><?= esc($emp['department']) ?></td>
              <td>
                <span class="badge bg-label-<?= $emp['status'] === 'active' ? 'success' : ($emp['status'] === 'resigned' ? 'secondary' : 'warning') ?>">
                  <?= ucfirst($emp['status']) ?>
                </span>
              </td>
              <td>
                <button type="button" class="btn btn-sm btn-icon btn-info" title="Detail"
                        data-bs-toggle="modal" data-bs-target="#detailModal"
                        data-photo="<?= $emp['photo'] ? base_url('uploads/employees/' . $emp['photo']) : '' ?>"
                        data-employee_id="<?= esc($emp['employee_id']) ?>"
                        data-full_name="<?= esc($emp['full_name']) ?>"
                        data-email="<?= esc($emp['email']) ?>"
                        data-phone="<?= esc($emp['phone']) ?>"
                        data-position="<?= esc($emp['position']) ?>"
                        data-department="<?= esc($emp['department']) ?>"
                        data-hire_date="<?= $emp['hire_date'] ?? '-' ?>"
                        data-status="<?= ucfirst($emp['status']) ?>"
                        data-status_class="<?= $emp['status'] === 'active' ? 'success' : ($emp['status'] === 'resigned' ? 'secondary' : 'warning') ?>"
                        data-created_at="<?= date('d/m/Y H:i', strtotime($emp['created_at'])) ?>">
                  <i class="ti ti-eye"></i>
                </button>
                <a href="<?= base_url('employees/edit/' . $emp['id']) ?>" class="btn btn-sm btn-icon btn-primary" title="Edit">
                  <i class="ti ti-edit"></i>
                </a>
                <form action="<?= base_url('employees/delete/' . $emp['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus pegawai ini?')">
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

<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
      <div class="modal-header border-0 py-3 px-4" style="background: #f8f9ff;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
            <i class="ti ti-briefcase text-primary"></i>
          </div>
          <div>
            <h6 class="mb-0 fw-semibold" style="color: #00174b; font-size: 0.9rem;">Detail Pegawai</h6>
            <small class="text-muted" id="detail-subtitle"></small>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-0">
        <div class="row g-0">
          <div class="col-md-4 p-5 d-flex flex-column align-items-center text-center" style="background: #eef0ff;">
            <div class="position-relative mb-4">
              <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 74, 198, 0.08); border-radius: 50%; transform: scale(1.15);"></div>
              <div id="detail-photo-container" class="d-flex align-items-center justify-content-center rounded-circle border border-3 border-white shadow"
                   style="width: 120px; height: 120px; background: #dbe1ff;">
                <i class="ti ti-user text-primary" style="font-size: 3rem;"></i>
              </div>
              <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-white shadow-sm"
                   style="width: 36px; height: 36px;">
                <i class="ti ti-circle-check-filled ti-sm"></i>
              </div>
            </div>
            <h5 class="fw-bold mb-1" id="detail-full_name" style="color: #00174b;"></h5>
            <div class="d-flex align-items-center gap-1 text-muted mb-3">
              <i class="ti ti-id-badge ti-sm"></i>
              <span id="detail-employee_id" style="font-size: 0.9rem;"></span>
            </div>
            <div class="d-flex gap-2 justify-content-center flex-wrap">
              <span class="badge rounded-pill fw-semibold px-3 py-2" id="detail-status-badge" style="font-size: 0.7rem;">
                <span class="rounded-circle me-1" style="width: 6px; height: 6px; background: currentColor; animation: pulse 2s infinite;" id="detail-status-dot"></span>
                <span id="detail-status-text"></span>
              </span>
            </div>
          </div>

          <div class="col-md-8 p-5" style="background: #ffffff;">
            <h6 class="text-uppercase fw-semibold mb-4 pb-2 border-bottom" style="color: #004ac6; font-size: 0.7rem; letter-spacing: 0.05em;">
              <i class="ti ti-info-circle me-1"></i>Informasi Pegawai
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
                  <p class="mb-0 fw-bold" id="detail-email" style="color: #00174b; font-size: 0.95rem;"></p>
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
                  <p class="mb-0 fw-bold" id="detail-phone" style="color: #00174b; font-size: 0.95rem;"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-4 rounded-3 border" style="background: #f8f9ff; border-color: #eef0ff !important;">
                  <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
                      <i class="ti ti-briefcase text-primary ti-sm"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem;">Jabatan</small>
                  </div>
                  <p class="mb-0 fw-bold" id="detail-position" style="color: #00174b; font-size: 0.95rem;"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-4 rounded-3 border" style="background: #f8f9ff; border-color: #eef0ff !important;">
                  <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
                      <i class="ti ti-building-community text-primary ti-sm"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem;">Departemen</small>
                  </div>
                  <p class="mb-0 fw-bold" id="detail-department" style="color: #00174b; font-size: 0.95rem;"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-4 rounded-3 border" style="background: #f8f9ff; border-color: #eef0ff !important;">
                  <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
                      <i class="ti ti-calendar text-primary ti-sm"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem;">Tanggal Masuk</small>
                  </div>
                  <p class="mb-0 fw-bold" id="detail-hire_date" style="color: #00174b; font-size: 0.95rem;"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-4 rounded-3 border" style="background: #f8f9ff; border-color: #eef0ff !important;">
                  <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-2" style="width: 36px; height: 36px; background: #dbe1ff;">
                      <i class="ti ti-clock text-primary ti-sm"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem;">Terdaftar Sejak</small>
                  </div>
                  <p class="mb-0 fw-bold" id="detail-created_at" style="color: #00174b; font-size: 0.95rem;"></p>
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
  $('#detailModal').on('show.bs.modal', function(e) {
    var btn = $(e.relatedTarget);

    var photo = btn.data('photo');
    var container = $('#detail-photo-container');
    if (photo) {
      container.html('<img src="' + photo + '" alt="photo" class="rounded-circle border border-3 border-white shadow" style="width: 120px; height: 120px; object-fit: cover;">');
    } else {
      container.html('<i class="ti ti-user text-primary" style="font-size: 3rem;"></i>');
    }

    var name = btn.data('full_name');
    $('#detail-full_name').text(name);
    $('#detail-employee_id').text(btn.data('employee_id'));
    $('#detail-subtitle').text('ID: ' + btn.data('employee_id'));
    $('#detail-email').text(btn.data('email') || '-');
    $('#detail-phone').text(btn.data('phone') || '-');
    $('#detail-position').text(btn.data('position') || '-');
    $('#detail-department').text(btn.data('department') || '-');
    $('#detail-hire_date').text(btn.data('hire_date'));
    $('#detail-created_at').text(btn.data('created_at'));

    var statusClass = btn.data('status_class');
    var badge = $('#detail-status-badge');
    var dot = $('#detail-status-dot');
    var text = $('#detail-status-text');

    badge.css('background', statusClass === 'success' ? '#d6f5e0' : statusClass === 'secondary' ? '#f0f0f0' : '#fff3d6');
    badge.css('color', statusClass === 'success' ? '#2e7d32' : statusClass === 'secondary' ? '#666' : '#e6a700');
    dot.css('background', statusClass === 'success' ? '#2e7d32' : statusClass === 'secondary' ? '#666' : '#e6a700');
    text.text(btn.data('status'));
  });
});
</script>
<?= $this->endSection() ?>
