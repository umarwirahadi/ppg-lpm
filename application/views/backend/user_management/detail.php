<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- User Profile Card -->
            <div class="card border-0 shadow-sm overflow-hidden">
                <!-- Header Banner -->
                <div class="card-header p-0">
                    <div class="profile-banner" style="height: 120px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                </div>
                
                <div class="card-body position-relative pt-0">
                    <!-- Avatar -->
                    <div class="text-center" style="margin-top: -60px;">
                        <?php if (!empty($user['avatar'])): ?>
                            <img src="<?= base_url($user['avatar']) ?>" alt="Avatar" 
                                 class="rounded-circle border border-4 border-white shadow" 
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        <?php else: ?>
                            <div class="rounded-circle border border-4 border-white shadow d-inline-flex align-items-center justify-content-center"
                                 style="width: 120px; height: 120px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <span class="text-white fw-bold" style="font-size: 48px;"><?= strtoupper(substr($user['full_name'], 0, 1)) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- User Name & Role -->
                    <div class="text-center mt-3">
                        <h3 class="fw-bold mb-1"><?= htmlspecialchars($user['full_name']) ?></h3>
                        <p class="text-muted mb-2">@<?= htmlspecialchars($user['username']) ?></p>
                        
                        <?php
                        $role_badges = [
                            'admin' => ['class' => 'bg-danger', 'icon' => 'shield-alt'],
                            'editor' => ['class' => 'bg-warning text-dark', 'icon' => 'edit'],
                            'viewer' => ['class' => 'bg-secondary', 'icon' => 'eye']
                        ];
                        $badge = $role_badges[$user['role']] ?? ['class' => 'bg-secondary', 'icon' => 'user'];
                        ?>
                        <span class="badge <?= $badge['class'] ?> px-3 py-2">
                            <i class="fas fa-<?= $badge['icon'] ?> me-1"></i>
                            <?= ucfirst($user['role']) ?>
                        </span>
                        
                        <?php if ($user['is_active'] == 1): ?>
                            <span class="badge bg-success-subtle text-success px-3 py-2 ms-2">
                                <i class="fas fa-check-circle me-1"></i>Active
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger-subtle text-danger px-3 py-2 ms-2">
                                <i class="fas fa-times-circle me-1"></i>Inactive
                            </span>
                        <?php endif; ?>
                    </div>

                    <hr class="my-4">

                    <!-- User Details -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Email</small>
                                        <span class="fw-semibold"><?= htmlspecialchars($user['email']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-phone text-success"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">No. Telepon</small>
                                        <span class="fw-semibold"><?= !empty($user['phone']) ? htmlspecialchars($user['phone']) : '-' ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-calendar-plus text-info"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Tanggal Dibuat</small>
                                        <span class="fw-semibold"><?= date('d F Y, H:i', strtotime($user['created_at'])) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-clock text-warning"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Login Terakhir</small>
                                        <span class="fw-semibold">
                                            <?= $user['last_login'] ? date('d F Y, H:i', strtotime($user['last_login'])) : 'Belum pernah login' ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon bg-secondary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-sync text-secondary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Terakhir Diupdate</small>
                                        <span class="fw-semibold"><?= date('d F Y, H:i', strtotime($user['updated_at'])) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon bg-purple bg-opacity-10 rounded-circle p-2 me-3" style="background-color: rgba(102, 126, 234, 0.1);">
                                        <i class="fas fa-id-badge" style="color: #667eea;"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">User ID</small>
                                        <span class="fw-semibold">#<?= $user['id'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Action Buttons -->
                    <div class="d-flex flex-wrap justify-content-between gap-2">
                        <a href="<?= site_url('admin/user-management') ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        
                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?= site_url('admin/user-management/toggle/' . $user['id']) ?>" 
                               class="btn btn-outline-<?= $user['is_active'] ? 'warning' : 'success' ?>"
                               onclick="return confirm('<?= $user['is_active'] ? 'Nonaktifkan' : 'Aktifkan' ?> user ini?');">
                                <i class="fas fa-toggle-<?= $user['is_active'] ? 'off' : 'on' ?> me-1"></i>
                                <?= $user['is_active'] ? 'Nonaktifkan' : 'Aktifkan' ?>
                            </a>
                            
                            <a href="<?= site_url('admin/user-management/edit/' . $user['id']) ?>" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Edit User
                            </a>
                            
                            <a href="<?= site_url('admin/user-management/delete/' . $user['id']) ?>" 
                               class="btn btn-outline-danger"
                               onclick="return confirm('PERINGATAN: User akan dihapus permanen. Lanjutkan?');">
                                <i class="fas fa-trash me-1"></i> Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 16px;
}

.detail-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1) !important;
}

.bg-danger-subtle {
    background-color: rgba(220, 53, 69, 0.1) !important;
}

.detail-item {
    padding: 12px;
    border-radius: 10px;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.detail-item:hover {
    background-color: #f1f3f5;
}
</style>
