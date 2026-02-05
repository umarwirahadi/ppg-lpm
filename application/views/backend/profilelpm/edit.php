<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                    <h4 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </h4>
                    <a href="<?= site_url('admin/profile-lpm') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= validation_errors() ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('admin/profile-lpm/update/' . $profile['id']) ?>">
                        <input type="hidden" name="id" value="<?= (int)$profile['id'] ?>">
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Profile Key</label>
                            <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($profile['profile_key']) ?>" readonly disabled>
                            <small class="text-muted">Profile key tidak dapat diubah</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required
                                   value="<?= set_value('title', htmlspecialchars($profile['title'])) ?>"
                                   placeholder="Masukkan judul profile">
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Icon (Emoji)</label>
                                <input type="text" name="icon" class="form-control" 
                                       value="<?= set_value('icon', htmlspecialchars($profile['icon'] ?? '')) ?>"
                                       placeholder="Contoh: 🎓 atau 📋">
                                <small class="text-muted">Gunakan emoji untuk icon, contoh: 🎓 👁️ 🎯 📋</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Urutan Tampil</label>
                                <input type="number" name="display_order" class="form-control" min="0"
                                       value="<?= set_value('display_order', $profile['display_order']) ?>">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konten <span class="text-danger">*</span></label>
                            <textarea name="content" id="contentEditor" rows="12" class="form-control" required
                                      placeholder="Masukkan konten profile (mendukung HTML)"><?= set_value('content', $profile['content']) ?></textarea>
                            <small class="text-muted">Mendukung format HTML. Untuk tugas gunakan format JSON array.</small>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1"
                                       <?= $profile['is_active'] == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label fw-semibold" for="isActive">Aktif</label>
                            </div>
                            <small class="text-muted">Centang untuk menampilkan profile di frontend</small>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= site_url('admin/profile-lpm') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview Panel -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-secondary">
                        <i class="fas fa-eye me-2"></i>Preview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="preview-icon mx-auto mb-3" style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <span id="previewIcon" style="font-size: 48px;"><?= $profile['icon'] ?? '📄' ?></span>
                        </div>
                        <h5 id="previewTitle" class="fw-bold"><?= htmlspecialchars($profile['title']) ?></h5>
                        <span class="badge bg-light text-dark"><?= $profile['profile_key'] ?></span>
                    </div>
                    <hr>
                    <div id="previewContent" class="preview-content" style="max-height: 300px; overflow-y: auto;">
                        <?= $profile['content'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Live preview
document.querySelector('input[name="title"]').addEventListener('input', function() {
    document.getElementById('previewTitle').textContent = this.value || 'Judul Profile';
});

document.querySelector('input[name="icon"]').addEventListener('input', function() {
    document.getElementById('previewIcon').textContent = this.value || '📄';
});

document.querySelector('textarea[name="content"]').addEventListener('input', function() {
    document.getElementById('previewContent').innerHTML = this.value || '<em class="text-muted">Konten akan tampil di sini...</em>';
});
</script>

<style>
.card {
    border-radius: 12px;
}
.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
}
.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}
.preview-content {
    font-size: 0.9rem;
    line-height: 1.6;
}
.preview-content ul {
    padding-left: 20px;
}
.preview-content li {
    margin-bottom: 8px;
}
</style>
