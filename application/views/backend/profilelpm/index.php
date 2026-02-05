<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid mt-4">
    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex flex-column flex-md-row align-items-center justify-content-between gap-2 py-3">
            <div class="header-left">
                <h4 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-building me-2"></i>Profile LPM
                </h4>
                <small class="text-muted">Kelola informasi profile LPM - Tentang, Visi, Misi, Tugas</small>
            </div>
            <div class="header-right d-flex align-items-center gap-2">
                <a href="<?= site_url('admin/profile-lpm/create') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Profile
                </a>
                <button id="btnRefresh" type="button" class="btn btn-outline-secondary" title="Segarkan daftar">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th style="width: 80px;">Icon</th>
                            <th>Profile Key</th>
                            <th>Judul</th>
                            <th class="text-center" style="width: 80px;">Urutan</th>
                            <th class="text-center" style="width: 100px;">Status</th>
                            <th class="text-center" style="width: 100px;">Diperbarui</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($profiles) && is_array($profiles)): ?>
                            <?php $no = 1; foreach ($profiles as $profile): ?>
                                <tr>
                                    <td class="text-center align-middle"><?= $no++ ?></td>
                                    <td class="align-middle">
                                        <span style="font-size: 28px;"><?= htmlspecialchars($profile['icon'] ?? '📄') ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <code class="bg-light px-2 py-1 rounded"><?= htmlspecialchars($profile['profile_key']) ?></code>
                                    </td>
                                    <td class="align-middle">
                                        <strong><?= htmlspecialchars($profile['title']) ?></strong>
                                        <br>
                                        <small class="text-muted"><?= substr(strip_tags($profile['content']), 0, 80) ?>...</small>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge bg-secondary"><?= $profile['display_order'] ?></span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <?php if ($profile['is_active'] == 1): ?>
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Aktif
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times me-1"></i>Nonaktif
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <small class="text-muted">
                                            <?= date('d M Y', strtotime($profile['updated_at'])) ?>
                                        </small>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="<?= site_url('admin/profile-lpm/edit/' . $profile['id']) ?>" 
                                               class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= site_url('admin/profile-lpm/toggle/' . $profile['id']) ?>" 
                                               class="btn btn-outline-info" title="Toggle Status">
                                                <i class="fas fa-toggle-<?= $profile['is_active'] ? 'on' : 'off' ?>"></i>
                                            </a>
                                            <a href="<?= site_url('admin/profile-lpm/delete/' . $profile['id']) ?>" 
                                               class="btn btn-outline-danger" 
                                               onclick="return confirm('Yakin ingin menghapus profile ini?');"
                                               title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p class="mb-0">Tidak ada data profile ditemukan.</p>
                                        <a href="<?= site_url('admin/profile-lpm/create') ?>" class="btn btn-primary btn-sm mt-3">
                                            <i class="fas fa-plus me-1"></i> Tambah Profile Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Preview Cards -->
    <?php if (!empty($profiles)): ?>
    <div class="row mt-4">
        <div class="col-12">
            <h5 class="text-muted mb-3"><i class="fas fa-eye me-2"></i>Preview Profile</h5>
        </div>
        <?php foreach ($profiles as $profile): ?>
            <?php if ($profile['is_active']): ?>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="profile-icon mb-3" style="font-size: 48px;">
                            <?= $profile['icon'] ?? '📄' ?>
                        </div>
                        <h6 class="card-title fw-bold"><?= htmlspecialchars($profile['title']) ?></h6>
                        <span class="badge bg-light text-dark"><?= $profile['profile_key'] ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
document.getElementById('btnRefresh').addEventListener('click', function () {
    location.reload();
});
</script>

<style>
.card {
    border-radius: 12px;
}
.card-header {
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.table th {
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #dee2e6;
}
.table td {
    vertical-align: middle;
}
.btn-group-sm .btn {
    padding: 0.35rem 0.5rem;
}
.profile-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 50%;
}
</style>
