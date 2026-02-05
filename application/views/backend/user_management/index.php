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

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stat-icon bg-primary bg-gradient rounded-circle p-3">
                                <i class="fas fa-users text-white fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-0 fw-bold"><?= $stats['total'] ?? 0 ?></h3>
                            <small class="text-muted">Total Users</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stat-icon bg-success bg-gradient rounded-circle p-3">
                                <i class="fas fa-user-check text-white fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-0 fw-bold"><?= $stats['active'] ?? 0 ?></h3>
                            <small class="text-muted">Active Users</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stat-icon bg-danger bg-gradient rounded-circle p-3">
                                <i class="fas fa-user-shield text-white fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-0 fw-bold"><?= $stats['admin'] ?? 0 ?></h3>
                            <small class="text-muted">Administrators</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stat-icon bg-info bg-gradient rounded-circle p-3">
                                <i class="fas fa-user-edit text-white fa-lg"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-0 fw-bold"><?= $stats['editor'] ?? 0 ?></h3>
                            <small class="text-muted">Editors</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex flex-column flex-md-row align-items-center justify-content-between gap-2 py-3">
            <div class="header-left">
                <h4 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-users-cog me-2"></i>User Management
                </h4>
                <small class="text-muted">Kelola akun pengguna sistem LPM</small>
            </div>
            <div class="header-right d-flex align-items-center gap-2">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari user...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <a href="<?= site_url('admin/user-management/export') ?>" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-file-csv me-1"></i> Export
                </a>
                <a href="<?= site_url('admin/user-management/create') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah User
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="usersTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th style="width: 60px;">Avatar</th>
                            <th>User Info</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th class="text-center">Status</th>
                            <th>Last Login</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users) && is_array($users)): ?>
                            <?php $no = 1; foreach ($users as $user): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td>
                                        <?php if (!empty($user['avatar'])): ?>
                                            <img src="<?= base_url($user['avatar']) ?>" alt="Avatar" 
                                                 class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                <span class="text-white fw-bold"><?= strtoupper(substr($user['full_name'], 0, 1)) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="user-info">
                                            <strong class="d-block"><?= htmlspecialchars($user['full_name']) ?></strong>
                                            <small class="text-muted">@<?= htmlspecialchars($user['username']) ?></small>
                                            <br>
                                            <small class="text-primary"><?= htmlspecialchars($user['email']) ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        $role_badges = [
                                            'admin' => 'bg-danger',
                                            'editor' => 'bg-warning text-dark',
                                            'viewer' => 'bg-secondary'
                                        ];
                                        $badge_class = $role_badges[$user['role']] ?? 'bg-secondary';
                                        ?>
                                        <span class="badge <?= $badge_class ?>">
                                            <i class="fas fa-<?= $user['role'] === 'admin' ? 'shield-alt' : ($user['role'] === 'editor' ? 'edit' : 'eye') ?> me-1"></i>
                                            <?= ucfirst($user['role']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($user['phone'])): ?>
                                            <small><?= htmlspecialchars($user['phone']) ?></small>
                                        <?php else: ?>
                                            <small class="text-muted">-</small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($user['is_active'] == 1): ?>
                                            <span class="badge bg-success-subtle text-success">
                                                <i class="fas fa-check-circle me-1"></i>Active
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger">
                                                <i class="fas fa-times-circle me-1"></i>Inactive
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($user['last_login'])): ?>
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i>
                                                <?= date('d M Y H:i', strtotime($user['last_login'])) ?>
                                            </small>
                                        <?php else: ?>
                                            <small class="text-muted">Never</small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="<?= site_url('admin/user-management/detail/' . $user['id']) ?>" 
                                               class="btn btn-outline-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= site_url('admin/user-management/edit/' . $user['id']) ?>" 
                                               class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= site_url('admin/user-management/toggle/' . $user['id']) ?>" 
                                               class="btn btn-outline-<?= $user['is_active'] ? 'secondary' : 'success' ?>" 
                                               title="<?= $user['is_active'] ? 'Nonaktifkan' : 'Aktifkan' ?>"
                                               onclick="return confirm('Yakin ingin <?= $user['is_active'] ? 'menonaktifkan' : 'mengaktifkan' ?> user ini?');">
                                                <i class="fas fa-toggle-<?= $user['is_active'] ? 'on' : 'off' ?>"></i>
                                            </a>
                                            <a href="<?= site_url('admin/user-management/delete/' . $user['id']) ?>" 
                                               class="btn btn-outline-danger" 
                                               title="Hapus"
                                               onclick="return confirm('PERINGATAN: User akan dihapus permanen. Lanjutkan?');">
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
                                        <i class="fas fa-users-slash fa-3x mb-3"></i>
                                        <p class="mb-0">Tidak ada user ditemukan.</p>
                                        <a href="<?= site_url('admin/user-management/create') ?>" class="btn btn-primary btn-sm mt-3">
                                            <i class="fas fa-plus me-1"></i> Tambah User Baru
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
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#usersTable tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});
</script>

<style>
.stat-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    border-radius: 12px;
}

.table th {
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #dee2e6;
    white-space: nowrap;
}

.btn-group-sm .btn {
    padding: 0.35rem 0.5rem;
}

.avatar-placeholder {
    font-size: 14px;
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1) !important;
}

.bg-danger-subtle {
    background-color: rgba(220, 53, 69, 0.1) !important;
}

.user-info {
    line-height: 1.4;
}
</style>
