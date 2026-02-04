<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Edit Laporan</h4>
            <a href="<?= site_url('admin/laporan') ?>" class="btn btn-default btn-md">Kembali</a>
        </div>
        <div class="card-body">
            <?php if (!empty($this->session->flashdata('error'))): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <form id="laporanForm" method="post" action="<?= site_url('admin/laporan/update/' . $laporan->id) ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Laporan <span class="text-danger">*</span></label>
                    <input id="title" name="title" type="text" class="form-control form-control-lg" required placeholder="Masukkan judul laporan" value="<?= htmlspecialchars($laporan->title) ?>">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Ringkasan atau keterangan singkat tentang laporan"><?= htmlspecialchars($laporan->description) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control form-control-lg" required>
                        <option value="">Pilih status</option>
                        <option value="draft" <?= $laporan->status == 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="published" <?= $laporan->status == 'published' ? 'selected' : '' ?>>Published</option>
                        <option value="archived" <?= $laporan->status == 'archived' ? 'selected' : '' ?>>Archived</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File Laporan (PDF/DOCX)</label>
                    <div class="input-group">
                        <input id="file" name="file" type="file" class="form-control" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                        <button id="clearFile" type="button" class="btn btn-outline-secondary">Clear</button>
                    </div>
                    <?php if (!empty($laporan->file_path)): ?>
                        <small id="fileHelp" class="form-text text-muted">
                            File saat ini: <a href="<?= base_url($laporan->file_path) ?>" target="_blank"><?= htmlspecialchars(basename($laporan->file_path)) ?></a>
                            <br>Unggah file baru jika ingin mengganti.
                        </small>
                    <?php else: ?>
                        <small id="fileHelp" class="form-text text-muted">Belum ada file. Format: PDF atau DOCX.</small>
                    <?php endif; ?>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                    <a href="<?= site_url('admin/laporan') ?>" class="btn btn-default btn-md">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// UX helpers: show selected filename and clear file
(function () {
    var fileInput = document.getElementById('file');
    var clearBtn = document.getElementById('clearFile');
    var form = document.getElementById('laporanForm');

    if (fileInput) {
        fileInput.addEventListener('change', function () {
            var name = this.files && this.files.length ? this.files[0].name : '';
            if (name) {
                document.getElementById('fileHelp').innerText = 'File terpilih: ' + name;
            }
        });
    }
    
    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            if (fileInput) {
                fileInput.value = '';
                var originalText = <?= !empty($laporan->file_path) ? "'File saat ini: " . addslashes(basename($laporan->file_path)) . "'" : "'Belum ada file.'" ?>;
                document.getElementById('fileHelp').innerText = originalText;
            }
        });
    }

    // Basic client-side validation
    if (form) {
        form.addEventListener('submit', function (e) {
            var title = document.getElementById('title').value.trim();
            var status = document.getElementById('status').value;
            
            if (!title) {
                e.preventDefault();
                alert('Judul laporan wajib diisi.');
                return false;
            }
            
            if (!status) {
                e.preventDefault();
                alert('Status laporan wajib dipilih.');
                return false;
            }
        });
    }
})();
</script>

<style>
/* Keep edit view visually consistent with index */
.card .form-control-lg { font-size: 1rem; padding: .6rem .75rem; }
.card .btn-md { padding: .45rem .85rem; }
@media (max-width: 575.98px) {
    .card .d-flex { flex-direction: column; }
}
</style>
