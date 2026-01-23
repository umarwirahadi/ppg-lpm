<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user me-2"></i>Detail Struktur Organisasi
        </h1>
        <div>
            <a href="<?= base_url('admin/struktur/edit/' . $struktur['id']) ?>" class="btn btn-warning me-2">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <a href="<?= base_url('admin/struktur') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Photo and Basic Info -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <!-- Photo -->
                    <div class="mb-4">
                        <?php if (!empty($struktur['foto'])): ?>
                            <img src="<?= base_url('assets/img/struktur/' . $struktur['foto']) ?>" 
                                 alt="<?= htmlspecialchars($struktur['nama']) ?>"
                                 class="img-fluid rounded" style="max-width: 250px; max-height: 300px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center text-muted rounded" 
                                 style="width: 200px; height: 250px; margin: 0 auto;">
                                <i class="fas fa-user fa-5x"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Basic Info -->
                    <h4 class="mb-1"><?= htmlspecialchars($struktur['nama']) ?></h4>
                    <h6 class="text-muted mb-3"><?= htmlspecialchars($struktur['jabatan']) ?></h6>
                    
                    <!-- Level Badge -->
                    <span class="badge bg-<?= 
                        $struktur['level_jabatan'] == 'direktur' ? 'danger' : 
                        ($struktur['level_jabatan'] == 'manajer' ? 'warning' : 
                        ($struktur['level_jabatan'] == 'staff' ? 'info' : 'secondary')) ?> fs-6 mb-3">
                        <?= ucfirst(str_replace('_', ' ', $struktur['level_jabatan'])) ?>
                    </span>

                    <!-- Status -->
                    <div class="mb-3">
                        <span class="badge bg-<?= $struktur['status'] == 'aktif' ? 'success' : 'danger' ?> fs-6">
                            <i class="fas fa-circle me-1"></i><?= ucfirst($struktur['status']) ?>
                        </span>
                    </div>

                    <!-- Contact Info -->
                    <?php if (!empty($struktur['email']) || !empty($struktur['telepon'])): ?>
                        <hr>
                        <div class="text-start">
                            <?php if (!empty($struktur['email'])): ?>
                                <div class="mb-2">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    <a href="mailto:<?= $struktur['email'] ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($struktur['email']) ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($struktur['telepon'])): ?>
                                <div class="mb-2">
                                    <i class="fas fa-phone text-success me-2"></i>
                                    <a href="tel:<?= $struktur['telepon'] ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($struktur['telepon']) ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-tools me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('admin/struktur/edit/' . $struktur['id']) ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Data
                        </a>
                        <button type="button" class="btn btn-danger" 
                                onclick="confirmDelete(<?= $struktur['id'] ?>, '<?= htmlspecialchars(addslashes($struktur['nama'])) ?>')">
                            <i class="fas fa-trash me-2"></i>Hapus Data
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Detailed Information -->
        <div class="col-md-8">
            <!-- General Information -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Umum
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Nama Lengkap</label>
                            <p class="mb-0"><?= htmlspecialchars($struktur['nama']) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Jabatan</label>
                            <p class="mb-0"><?= htmlspecialchars($struktur['jabatan']) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Level Jabatan</label>
                            <p class="mb-0"><?= ucfirst(str_replace('_', ' ', $struktur['level_jabatan'])) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Urutan Tampilan</label>
                            <p class="mb-0"><?= $struktur['urutan'] ?></p>
                        </div>
                        <?php if (!empty($struktur['pendidikan_terakhir'])): ?>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted">Pendidikan Terakhir</label>
                                <p class="mb-0"><?= htmlspecialchars($struktur['pendidikan_terakhir']) ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($struktur['tanggal_bergabung'])): ?>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted">Tanggal Bergabung</label>
                                <p class="mb-0"><?= date('d F Y', strtotime($struktur['tanggal_bergabung'])) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <?php if (!empty($struktur['deskripsi'])): ?>
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-clipboard-list me-2"></i>Deskripsi Tugas
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><?= nl2br(htmlspecialchars($struktur['deskripsi'])) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Experience -->
            <?php if (!empty($struktur['pengalaman'])): ?>
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-briefcase me-2"></i>Pengalaman Kerja
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><?= nl2br(htmlspecialchars($struktur['pengalaman'])) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- System Information -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cog me-2"></i>Informasi Sistem
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted">Dibuat Pada</label>
                            <p class="mb-0"><?= date('d F Y H:i:s', strtotime($struktur['created_at'])) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted">Terakhir Diupdate</label>
                            <p class="mb-0"><?= date('d F Y H:i:s', strtotime($struktur['updated_at'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-trash me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data struktur organisasi:</p>
                <p class="fw-bold text-danger" id="deleteItemName"></p>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="deleteConfirmBtn" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, nama) {
    document.getElementById('deleteItemName').textContent = nama;
    document.getElementById('deleteConfirmBtn').href = '<?= base_url("admin/struktur/delete/") ?>' + id;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
