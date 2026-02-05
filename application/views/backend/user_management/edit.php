<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                    <h4 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-user-edit me-2"></i>Edit User
                    </h4>
                    <a href="<?= site_url('admin/user-management') ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body p-4">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= validation_errors() ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('upload_error')): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-image me-2"></i>Upload Error: <?= $this->session->flashdata('upload_error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('admin/user-management/update/' . $user['id']) ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        
                        <!-- Avatar Upload -->
                        <div class="text-center mb-4">
                            <div class="avatar-upload mx-auto" style="width: 120px;">
                                <div class="avatar-preview rounded-circle mx-auto mb-3 position-relative" 
                                     style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    <?php if (!empty($user['avatar'])): ?>
                                        <img id="avatarPreview" src="<?= base_url($user['avatar']) ?>" alt="Avatar" 
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                        <i class="fas fa-user fa-3x text-white" id="avatarIcon" style="display: none;"></i>
                                    <?php else: ?>
                                        <img id="avatarPreview" src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                                        <i class="fas fa-user fa-3x text-white" id="avatarIcon"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex justify-content-center gap-2">
                                    <label for="avatar" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-camera me-1"></i> Ganti
                                    </label>
                                    <?php if (!empty($user['avatar'])): ?>
                                        <a href="<?= site_url('admin/user-management/remove-avatar/' . $user['id']) ?>" 
                                           class="btn btn-outline-danger btn-sm"
                                           onclick="return confirm('Hapus foto profil?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="avatar" id="avatar" class="d-none" accept="image/*">
                                <small class="d-block text-muted mt-1">Max 2MB (JPG, PNG, GIF)</small>
                            </div>
                        </div>

                        <div class="row g-3">
                            <!-- Username -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    <input type="text" name="username" class="form-control" required
                                           value="<?= set_value('username', $user['username']) ?>"
                                           placeholder="username" pattern="[a-zA-Z0-9_-]+">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" required
                                           value="<?= set_value('email', $user['email']) ?>">
                                </div>
                            </div>

                            <!-- Full Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="full_name" class="form-control" required
                                           value="<?= set_value('full_name', $user['full_name']) ?>">
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="phone" class="form-control"
                                           value="<?= set_value('phone', $user['phone']) ?>">
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                                <select name="role" class="form-select" required>
                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                                    <option value="viewer" <?= $user['role'] === 'viewer' ? 'selected' : '' ?>>Viewer</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" 
                                           <?= $user['is_active'] == 1 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_active">
                                        <span class="badge <?= $user['is_active'] == 1 ? 'bg-success' : 'bg-danger' ?>" id="statusBadge">
                                            <?= $user['is_active'] == 1 ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Change Password Section -->
                        <div class="card bg-light border-0 mt-4">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">
                                    <i class="fas fa-key me-2"></i>Ubah Password
                                    <small class="text-muted fw-normal">(Kosongkan jika tidak ingin mengubah)</small>
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Password Baru</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" name="password" id="password" class="form-control"
                                                   placeholder="Minimal 6 karakter" minlength="6">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                                <i class="fas fa-eye" id="password-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" name="password_confirm" id="password_confirm" class="form-control"
                                                   placeholder="Ulangi password">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirm')">
                                                <i class="fas fa-eye" id="password_confirm-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-plus me-1"></i>
                                    Dibuat: <?= date('d M Y H:i', strtotime($user['created_at'])) ?>
                                </small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    Login Terakhir: <?= $user['last_login'] ? date('d M Y H:i', strtotime($user['last_login'])) : 'Belum pernah' ?>
                                </small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('admin/user-management/delete/' . $user['id']) ?>" 
                               class="btn btn-outline-danger"
                               onclick="return confirm('PERINGATAN: User akan dihapus permanen. Lanjutkan?');">
                                <i class="fas fa-trash me-1"></i> Hapus User
                            </a>
                            <div class="d-flex gap-2">
                                <a href="<?= site_url('admin/user-management') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Avatar preview
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
            document.getElementById('avatarPreview').style.display = 'block';
            document.getElementById('avatarIcon').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
});

// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Status badge toggle
document.getElementById('is_active').addEventListener('change', function() {
    const badge = document.getElementById('statusBadge');
    if (this.checked) {
        badge.textContent = 'Active';
        badge.classList.remove('bg-danger');
        badge.classList.add('bg-success');
    } else {
        badge.textContent = 'Inactive';
        badge.classList.remove('bg-success');
        badge.classList.add('bg-danger');
    }
});
</script>

<style>
.card {
    border-radius: 12px;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.input-group .form-control {
    border-left: none;
}

.avatar-preview {
    border: 3px solid #e9ecef;
    transition: all 0.3s ease;
}

.avatar-preview:hover {
    border-color: #667eea;
}
</style>
