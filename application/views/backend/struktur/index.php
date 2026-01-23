<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-sitemap me-2"></i>Kelola Struktur Organisasi
        </h1>
        <a href="<?= base_url('admin/struktur/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Struktur
        </a>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= $this->session->flashdata('success') ?>
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

    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <form method="GET" action="<?= base_url('admin/struktur') ?>">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari nama, jabatan, atau email..."
                                   name="search" value="<?= htmlspecialchars($search_keyword) ?>">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <?php if ($search_keyword): ?>
                                <a href="<?= base_url('admin/struktur') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="<?= base_url('admin/struktur/export_csv') ?>" class="btn btn-success">
                        <i class="fas fa-file-excel me-2"></i>Export CSV
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>Daftar Struktur Organisasi
                <span class="badge bg-primary ms-2"><?= count($struktur_list) ?> Data</span>
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($struktur_list)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 60px">No</th>
                                <th style="width: 80px">Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Level</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th style="width: 100px">Urutan</th>
                                <th style="width: 100px">Status</th>
                                <th style="width: 200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($struktur_list as $index => $struktur): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <?php if (!empty($struktur['foto'])): ?>
                                            <img src="<?= base_url('assets/img/struktur/' . $struktur['foto']) ?>" 
                                                 alt="<?= htmlspecialchars($struktur['nama']) ?>"
                                                 class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-secondary d-flex align-items-center justify-content-center text-white" 
                                                 style="width: 50px; height: 50px; border-radius: 5px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($struktur['nama']) ?></strong>
                                        <?php if (!empty($struktur['pendidikan_terakhir'])): ?>
                                            <br><small class="text-muted"><?= htmlspecialchars($struktur['pendidikan_terakhir']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($struktur['jabatan']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= 
                                            $struktur['level_jabatan'] == 'direktur' ? 'danger' : 
                                            ($struktur['level_jabatan'] == 'manajer' ? 'warning' : 
                                            ($struktur['level_jabatan'] == 'staff' ? 'info' : 'secondary')) ?>">
                                            <?= ucfirst(str_replace('_', ' ', $struktur['level_jabatan'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($struktur['email'])): ?>
                                            <a href="mailto:<?= $struktur['email'] ?>" class="text-decoration-none">
                                                <?= htmlspecialchars($struktur['email']) ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($struktur['telepon'])): ?>
                                            <a href="tel:<?= $struktur['telepon'] ?>" class="text-decoration-none">
                                                <?= htmlspecialchars($struktur['telepon']) ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark"><?= $struktur['urutan'] ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= $struktur['status'] == 'aktif' ? 'success' : 'danger' ?>">
                                            <?= ucfirst($struktur['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="<?= base_url('admin/struktur/detail/' . $struktur['id']) ?>" 
                                               class="btn btn-outline-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('admin/struktur/edit/' . $struktur['id']) ?>" 
                                               class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" 
                                                    onclick="confirmDelete(<?= $struktur['id'] ?>, '<?= htmlspecialchars(addslashes($struktur['nama'])) ?>')" 
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada data struktur organisasi</h5>
                    <p class="text-muted">
                        <?php if ($search_keyword): ?>
                            Tidak ditemukan data dengan kata kunci "<?= htmlspecialchars($search_keyword) ?>"
                        <?php else: ?>
                            Belum ada data struktur organisasi yang ditambahkan
                        <?php endif; ?>
                    </p>
                    <?php if (!$search_keyword): ?>
                        <a href="<?= base_url('admin/struktur/create') ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Struktur Pertama
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Statistics -->
    <?php if (!empty($struktur_list)): ?>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h5><?= $total_records ?></h5>
                        <small>Total Struktur</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-user-check fa-2x mb-2"></i>
                        <h5><?= count(array_filter($struktur_list, function($s) { return $s['status'] == 'aktif'; })) ?></h5>
                        <small>Aktif</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-crown fa-2x mb-2"></i>
                        <h5><?= count(array_filter($struktur_list, function($s) { return $s['level_jabatan'] == 'direktur'; })) ?></h5>
                        <small>Direktur</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-user-tie fa-2x mb-2"></i>
                        <h5><?= count(array_filter($struktur_list, function($s) { return $s['level_jabatan'] == 'manajer'; })) ?></h5>
                        <small>Manajer</small>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
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

// Auto hide alerts
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});
</script>
