<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-<?= $action == 'create' ? 'plus' : 'edit' ?> me-2"></i>
            <?= $action == 'create' ? 'Tambah' : 'Edit' ?> Struktur Organisasi
        </h1>
        <a href="<?= base_url('admin/struktur') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Alert Messages -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?= $errors ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0">
                <i class="fas fa-form me-2"></i>Form <?= $action == 'create' ? 'Tambah' : 'Edit' ?> Struktur Organisasi
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('admin/struktur/' . ($action == 'create' ? 'store' : 'update/' . (isset($struktur_id) ? $struktur_id : ''))) ?>" 
                  enctype="multipart/form-data" novalidate>
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                   value="<?= htmlspecialchars($struktur['nama']) ?>" required>
                            <div class="form-text">Masukkan nama lengkap dengan gelar</div>
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">
                                Jabatan <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" 
                                   value="<?= htmlspecialchars($struktur['jabatan']) ?>" required>
                            <div class="form-text">Contoh: Direktur LPM, Manajer Bidang Akreditasi</div>
                        </div>

                        <!-- Level Jabatan -->
                        <div class="mb-3">
                            <label for="level_jabatan" class="form-label">
                                Level Jabatan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="level_jabatan" name="level_jabatan" required>
                                <option value="">-- Pilih Level Jabatan --</option>
                                <option value="direktur" <?= $struktur['level_jabatan'] == 'direktur' ? 'selected' : '' ?>>Direktur</option>
                                <option value="manajer" <?= $struktur['level_jabatan'] == 'manajer' ? 'selected' : '' ?>>Manajer</option>
                                <option value="staff" <?= $struktur['level_jabatan'] == 'staff' ? 'selected' : '' ?>>Staff</option>
                                <option value="admin" <?= $struktur['level_jabatan'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($struktur['email']) ?>">
                            <div class="form-text">Email resmi yang dapat dihubungi</div>
                        </div>

                        <!-- Telepon -->
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="tel" class="form-control" id="telepon" name="telepon" 
                                   value="<?= htmlspecialchars($struktur['telepon']) ?>">
                            <div class="form-text">Nomor telepon yang dapat dihubungi</div>
                        </div>

                        <!-- Pendidikan Terakhir -->
                        <div class="mb-3">
                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" 
                                   value="<?= htmlspecialchars($struktur['pendidikan_terakhir']) ?>">
                            <div class="form-text">Contoh: S3 Teknik Industri, S2 Manajemen</div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Foto -->
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            <div class="form-text">Upload foto dengan format JPG, JPEG, PNG, GIF. Maksimal 2MB.</div>
                            
                            <?php if (!empty($struktur['foto']) && $action == 'edit'): ?>
                                <div class="mt-2">
                                    <small class="text-muted">Foto saat ini:</small><br>
                                    <img src="<?= base_url('assets/img/struktur/' . $struktur['foto']) ?>" 
                                         alt="<?= htmlspecialchars($struktur['nama']) ?>"
                                         class="img-thumbnail mt-1" style="max-width: 150px; max-height: 200px;">
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Tugas</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= htmlspecialchars($struktur['deskripsi']) ?></textarea>
                            <div class="form-text">Jelaskan tugas dan tanggung jawab utama</div>
                        </div>

                        <!-- Pengalaman -->
                        <div class="mb-3">
                            <label for="pengalaman" class="form-label">Pengalaman Kerja</label>
                            <textarea class="form-control" id="pengalaman" name="pengalaman" rows="3"><?= htmlspecialchars($struktur['pengalaman']) ?></textarea>
                            <div class="form-text">Uraikan pengalaman kerja dan keahlian khusus</div>
                        </div>

                        <!-- Urutan -->
                        <div class="mb-3">
                            <label for="urutan" class="form-label">Urutan Tampilan</label>
                            <input type="number" class="form-control" id="urutan" name="urutan" 
                                   value="<?= $struktur['urutan'] ?>" min="0">
                            <div class="form-text">Urutan tampilan dalam struktur organisasi (0 untuk otomatis)</div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="aktif" <?= $struktur['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                <option value="tidak_aktif" <?= $struktur['status'] == 'tidak_aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- Tanggal Bergabung -->
                        <div class="mb-3">
                            <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung</label>
                            <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" 
                                   value="<?= $struktur['tanggal_bergabung'] ?>">
                            <div class="form-text">Tanggal bergabung dengan LPM</div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="row">
                    <div class="col-12">
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/struktur') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                <?= $action == 'create' ? 'Simpan' : 'Update' ?>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const requiredFields = ['nama', 'jabatan', 'level_jabatan'];
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        requiredFields.forEach(function(fieldName) {
            const field = document.getElementById(fieldName);
            const value = field.value.trim();
            
            if (value === '') {
                field.classList.add('is-invalid');
                isValid = false;
                
                // Create or update error message
                let errorDiv = field.parentNode.querySelector('.invalid-feedback');
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    field.parentNode.appendChild(errorDiv);
                }
                errorDiv.textContent = 'Field ini wajib diisi';
            } else {
                field.classList.remove('is-invalid');
                const errorDiv = field.parentNode.querySelector('.invalid-feedback');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi');
        }
    });
    
    // Remove validation classes on input
    requiredFields.forEach(function(fieldName) {
        const field = document.getElementById(fieldName);
        field.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('is-invalid');
                const errorDiv = this.parentNode.querySelector('.invalid-feedback');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
        });
    });
    
    // Photo preview
    const fotoInput = document.getElementById('foto');
    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                this.value = '';
                return;
            }
            
            // Check file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                this.value = '';
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('fotoPreview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'fotoPreview';
                    preview.className = 'img-thumbnail mt-2';
                    preview.style.maxWidth = '150px';
                    preview.style.maxHeight = '200px';
                    fotoInput.parentNode.appendChild(preview);
                }
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
