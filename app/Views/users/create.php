<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Tambah User - HRIS<?= $this->endSection() ?>
<?= $this->section('menuActive') ?>users<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h4 class="fw-bold py-3 mb-4">Tambah User</h4>

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

<div class="card">
  <div class="card-body">
    <form action="<?= base_url('users/store') ?>" method="post">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Username <span class="text-danger">*</span></label>
          <input type="text" name="username" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>" value="<?= old('username') ?>" required>
          <?php if (isset($errors['username'])): ?>
            <div class="invalid-feedback"><?= $errors['username'] ?></div>
          <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Email <span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" required>
          <?php if (isset($errors['email'])): ?>
            <div class="invalid-feedback"><?= $errors['email'] ?></div>
          <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Password <span class="text-danger">*</span></label>
          <input type="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" required>
          <?php if (isset($errors['password'])): ?>
            <div class="invalid-feedback"><?= $errors['password'] ?></div>
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
        <div class="col-md-4 mb-3">
          <label class="form-label">No. Telepon</label>
          <input type="text" name="phone" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" value="<?= old('phone') ?>">
          <?php if (isset($errors['phone'])): ?>
            <div class="invalid-feedback"><?= $errors['phone'] ?></div>
          <?php endif; ?>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Role <span class="text-danger">*</span></label>
          <select name="role" class="form-control <?= isset($errors['role']) ? 'is-invalid' : '' ?>" required>
            <option value="staff" <?= old('role') === 'staff' ? 'selected' : '' ?>>Staff</option>
            <option value="manager" <?= old('role') === 'manager' ? 'selected' : '' ?>>Manager</option>
            <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
          </select>
          <?php if (isset($errors['role'])): ?>
            <div class="invalid-feedback"><?= $errors['role'] ?></div>
          <?php endif; ?>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control <?= isset($errors['status']) ? 'is-invalid' : '' ?>" required>
            <option value="active" <?= old('status') === 'active' ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
          </select>
          <?php if (isset($errors['status'])): ?>
            <div class="invalid-feedback"><?= $errors['status'] ?></div>
          <?php endif; ?>
        </div>
      </div>
      <div class="mt-3 text-center">
        <button type="submit" class="btn btn-primary">
          <i class="ti ti-check me-1"></i>Simpan
        </button>
        <a href="<?= base_url('users') ?>" class="btn btn-danger"><i class="ti ti-x me-1"></i>Batal</a>
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
      text: 'Pastikan data user sudah benar.',
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
