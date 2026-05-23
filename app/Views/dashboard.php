<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dashboard - HRIS<?= $this->endSection() ?>
<?= $this->section('menuActive') ?>dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h4 class="fw-bold py-3 mb-4">Dashboard</h4>

<div class="row">
  <div class="col-lg-3 col-md-6 col-12 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="card-info">
            <p class="card-text mb-2">Total Karyawan</p>
            <div class="d-flex align-items-end">
              <h4 class="text-primary mb-0"><?= $totalEmployees ?></h4>
            </div>
          </div>
          <div class="card-icon">
            <i class="ti ti-users text-primary" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-12 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="card-info">
            <p class="card-text mb-2">Hadir Hari Ini</p>
            <div class="d-flex align-items-end">
              <h4 class="text-success mb-0">0</h4>
            </div>
          </div>
          <div class="card-icon">
            <i class="ti ti-calendar-check text-success" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-12 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="card-info">
            <p class="card-text mb-2">Izin</p>
            <div class="d-flex align-items-end">
              <h4 class="text-warning mb-0">0</h4>
            </div>
          </div>
          <div class="card-icon">
            <i class="ti ti-file-info text-warning" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-12 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="card-info">
            <p class="card-text mb-2">Penggajian Bulan Ini</p>
            <div class="d-flex align-items-end">
              <h4 class="text-info mb-0">Rp 0</h4>
            </div>
          </div>
          <div class="card-icon">
            <i class="ti ti-report-money text-info" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <h5 class="card-header">Aktivitas Terbaru</h5>
  <div class="card-body">
    <p class="card-text">Belum ada aktivitas terbaru.</p>
  </div>
</div>
<?= $this->endSection() ?>
