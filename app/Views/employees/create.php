<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Tambah Pegawai - HRIS<?= $this->endSection() ?>
<?= $this->section('menuActive') ?>employees<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h4 class="fw-bold py-3 mb-4">Tambah Pegawai</h4>

<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<?php if ($errors): ?>
  <div class="alert alert-danger">
    <ul class="mb-0">
      <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('photo_error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('photo_error') ?></div>
<?php endif; ?>

<div class="card">
  <div class="card-body">
    <form action="<?= base_url('employees/store') ?>" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">NIP</label>
          <input type="text" name="employee_id" class="form-control <?= isset($errors['employee_id']) ? 'is-invalid' : '' ?>" value="<?= old('employee_id') ?>" required>
          <?php if (isset($errors['employee_id'])): ?>
            <div class="invalid-feedback"><?= $errors['employee_id'] ?></div>
          <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="full_name" class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>" value="<?= old('full_name') ?>" required>
          <?php if (isset($errors['full_name'])): ?>
            <div class="invalid-feedback"><?= $errors['full_name'] ?></div>
          <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Email <span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" required>
          <?php if (isset($errors['email'])): ?>
            <div class="invalid-feedback"><?= $errors['email'] ?></div>
          <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
          <input type="text" name="phone" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" value="<?= old('phone') ?>" required>
          <?php if (isset($errors['phone'])): ?>
            <div class="invalid-feedback"><?= $errors['phone'] ?></div>
          <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Jabatan <span class="text-danger">*</span></label>
          <input type="text" name="position" class="form-control <?= isset($errors['position']) ? 'is-invalid' : '' ?>" value="<?= old('position') ?>" required>
          <?php if (isset($errors['position'])): ?>
            <div class="invalid-feedback"><?= $errors['position'] ?></div>
          <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Departemen <span class="text-danger">*</span></label>
          <input type="text" name="department" class="form-control <?= isset($errors['department']) ? 'is-invalid' : '' ?>" value="<?= old('department') ?>" required>
          <?php if (isset($errors['department'])): ?>
            <div class="invalid-feedback"><?= $errors['department'] ?></div>
          <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
          <input type="date" name="hire_date" class="form-control <?= isset($errors['hire_date']) ? 'is-invalid' : '' ?>" value="<?= old('hire_date') ?>" required>
          <?php if (isset($errors['hire_date'])): ?>
            <div class="invalid-feedback"><?= $errors['hire_date'] ?></div>
          <?php endif; ?>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control <?= isset($errors['status']) ? 'is-invalid' : '' ?>" required>
            <option value="active" <?= old('status') === 'active' ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
            <option value="resigned" <?= old('status') === 'resigned' ? 'selected' : '' ?>>Resigned</option>
          </select>
          <?php if (isset($errors['status'])): ?>
            <div class="invalid-feedback"><?= $errors['status'] ?></div>
          <?php endif; ?>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Photo (JPG/JPEG, maks. 300KB) <span class="text-danger">*</span></label>
          <input type="file" name="photo" class="form-control <?= isset($errors['photo']) ? 'is-invalid' : '' ?>" accept=".jpg,.jpeg" required>
          <?php if (isset($errors['photo'])): ?>
            <div class="invalid-feedback"><?= $errors['photo'] ?></div>
          <?php endif; ?>
        </div>
      </div>
      <div class="mt-3 text-center">
        <button type="submit" class="btn btn-primary" id="btn-submit">
          <i class="ti ti-check me-1"></i>Simpan
        </button>
        <a href="<?= base_url('employees') ?>" class="btn btn-danger"><i class="ti ti-x me-1"></i>Batal</a>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
$(function() {
  var form = $('form');
  form.on('submit', function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Simpan Data?',
      text: 'Pastikan data pegawai sudah benar.',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, Simpan',
      cancelButtonText: 'Batal',
      confirmButtonColor: '#7367f0',
      cancelButtonColor: '#6c757d',
      customClass: { confirmButton: 'btn btn-primary', cancelButton: 'btn btn-secondary ms-2' },
      buttonsStyling: false,
    }).then(function(result) {
      if (result.isConfirmed) {
        form.off('submit').submit();
      }
    });
  });
});
</script>
<?= $this->endSection() ?>
