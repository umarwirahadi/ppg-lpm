<div class="container my-5 pt-5">
    <div class="row mb-3 align-items-center">
        <div class="col-md-8">
            <h2 class="mb-1">Dokumen SPMI</h2>
            <p class="text-muted mb-0">Akses dan unduh dokumen penting terkait Sistem Penjaminan Mutu Internal.</p>
        </div>
        <div class="col-md-4 mt-3 mt-md-0 text-md-end">
            <input id="frontendDokumenSearch" class="form-control form-control-sm d-inline-block" style="max-width:320px;" placeholder="Cari dokumen..." aria-label="Cari dokumen">
        </div>
    </div>

    <div class="table-responsive">
        <table id="dokumenTable" class="table table-hover table-sm align-middle">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th class="d-none d-sm-table-cell">Deskripsi</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dokumen_list) && is_array($dokumen_list)): ?>
                    <?php foreach ($dokumen_list as $dokumen): ?>
                        <tr>
                            <td><?= htmlspecialchars($dokumen->title) ?></td>
                            <td class="d-none d-sm-table-cell text-muted small"><?= htmlspecialchars(mb_strimwidth(strip_tags($dokumen->description), 0, 120, '...')) ?></td>
                            <td>
                                <?php if (!empty($dokumen->is_active) && $dokumen->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-muted small"><?= date('d M Y', strtotime($dokumen->created_at ?? '')) ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <?php if (!empty($dokumen->file_url)): ?>
                                        <button type="button" class="btn btn-sm btn-outline-secondary btn-preview" data-file="<?= base_url($dokumen->file_url) ?>">Preview</button>
                                        <a href="<?= base_url($dokumen->file_url) ?>" class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener">Unduh</a>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-outline-secondary" disabled>Tidak ada file</button>
                                    <?php endif; ?>
                                    <a href="<?= site_url('dokumen') ?>" class="btn btn-sm btn-outline-dark">Lihat</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Empty tbody: JS will attempt to fetch data from the server endpoint -->
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div id="dokumenEmptyState" class="text-center py-4" style="display:none;">
        <h5 class="text-muted">Belum ada dokumen tersedia.</h5>
        <p class="small text-muted">Silakan cek kembali nanti atau hubungi admin untuk informasi lebih lanjut.</p>
    </div>
</div>

<style>
/* Simple table tweaks for dokumen view */
.table-responsive { margin-top: .5rem; }
.table td, .table th { vertical-align: middle; }
.dokumen-desc { max-width: 50ch; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
@media (max-width: 575.98px) {
    .dokumen-desc { display: none; }
}
</style>

<!-- Preview Modal -->
<div class="modal fade" id="dokumenPreviewModal" tabindex="-1" aria-labelledby="dokumenPreviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dokumenPreviewLabel">Pratinjau Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div id="dokumenPreviewContainer" style="min-height:300px;">
                    <!-- iframe for PDF preview inserted here -->
                </div>
            </div>
            <div class="modal-footer">
                <a id="dokumenPreviewDownload" href="#" target="_blank" class="btn btn-primary">Unduh</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
window.LPM = window.LPM || {};
window.LPM.urls = {
    dokumenJson: '<?= site_url("dokumen/json") ?>',
    dokumenIndex: '<?= site_url("dokumen") ?>',
    bootstrapLocal: '<?= base_url("js/bootstrap.bundle.min.js") ?>'
};
</script>
<!-- `assets/js/app.js` is included in the footer to ensure jQuery is loaded first -->

