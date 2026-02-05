<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                    <h4 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Profile Baru
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

                    <form method="post" action="<?= site_url('admin/profile-lpm/store') ?>">
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Profile Key <span class="text-danger">*</span></label>
                            <input type="text" name="profile_key" class="form-control" required
                                   value="<?= set_value('profile_key') ?>"
                                   placeholder="Contoh: tentang, visi, misi, tugas"
                                   pattern="[a-z0-9_-]+" title="Hanya huruf kecil, angka, underscore dan dash">
                            <small class="text-muted">Gunakan huruf kecil tanpa spasi (contoh: tentang, visi, misi, tugas)</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required
                                   value="<?= set_value('title') ?>"
                                   placeholder="Masukkan judul profile">
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Icon (Emoji)</label>
                                <input type="text" name="icon" class="form-control" 
                                       value="<?= set_value('icon') ?>"
                                       placeholder="Contoh: 🎓 atau 📋">
                                <small class="text-muted">Gunakan emoji untuk icon</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Urutan Tampil</label>
                                <input type="number" name="display_order" class="form-control" min="0"
                                       value="<?= set_value('display_order', 0) ?>">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konten <span class="text-danger">*</span></label>
                            <textarea name="content" id="contentEditor" rows="12" class="form-control" required
                                      placeholder="Masukkan konten profile (mendukung HTML)"><?= set_value('content') ?></textarea>
                            <small class="text-muted">Mendukung format HTML. Untuk tugas gunakan format JSON array.</small>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" checked>
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
                                <i class="fas fa-save me-1"></i> Simpan Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Help Panel -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-secondary">
                        <i class="fas fa-info-circle me-2"></i>Panduan
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold mb-2">Profile Key yang Umum:</h6>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><code>tentang</code> - Tentang LPM</li>
                        <li class="mb-2"><code>visi</code> - Visi LPM</li>
                        <li class="mb-2"><code>misi</code> - Misi LPM</li>
                        <li class="mb-2"><code>tugas</code> - Tugas & Tanggung Jawab</li>
                    </ul>

                    <h6 class="fw-bold mb-2">Icon Emoji yang Tersedia:</h6>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="emoji-btn" style="font-size: 24px; cursor: pointer;" onclick="setIcon('🎓')">🎓</span>
                        <span class="emoji-btn" style="font-size: 24px; cursor: pointer;" onclick="setIcon('👁️')">👁️</span>
                        <span class="emoji-btn" style="font-size: 24px; cursor: pointer;" onclick="setIcon('🎯')">🎯</span>
                        <span class="emoji-btn" style="font-size: 24px; cursor: pointer;" onclick="setIcon('📋')">📋</span>
                        <span class="emoji-btn" style="font-size: 24px; cursor: pointer;" onclick="setIcon('📊')">📊</span>
                        <span class="emoji-btn" style="font-size: 24px; cursor: pointer;" onclick="setIcon('🏆')">🏆</span>
                        <span class="emoji-btn" style="font-size: 24px; cursor: pointer;" onclick="setIcon('💡')">💡</span>
                        <span class="emoji-btn" style="font-size: 24px; cursor: pointer;" onclick="setIcon('🔍')">🔍</span>
                    </div>

                    <h6 class="fw-bold mb-2">Format Konten untuk Tugas:</h6>
                    <pre class="bg-light p-2 rounded" style="font-size: 11px; overflow-x: auto;">[
  {
    "number": "01",
    "title": "Judul Tugas",
    "description": "Deskripsi tugas"
  }
]</pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function setIcon(emoji) {
    document.querySelector('input[name="icon"]').value = emoji;
}
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
.emoji-btn:hover {
    transform: scale(1.2);
    transition: transform 0.2s;
}
</style>
