<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Tambah Dokumen SPMI</h4>
            <a href="<?= site_url('dokumen') ?>" class="btn btn-default btn-md">Kembali</a>
        </div>
        <div class="card-body">
            <?php if (!empty($this->session->flashdata('error'))): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <form id="dokumenForm" method="post" action="<?= site_url('admin/dokumen/store') ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input id="title" name="title" type="text" class="form-control form-control-lg" required placeholder="Masukkan judul dokumen">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori Dokumen <span class="text-danger">*</span></label>
					<select name="category" id="category" class="form-control form-control-lg" required>
                        <option value="">Pilih kategori</option>
                        <option value="SPMI">Dokumen SPMI</option>
                        <option value="Standard">Dokumen Standard</option>
                        <option value="Audit">Audit</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Ringkasan atau keterangan singkat"></textarea>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File (PDF/DOCX)</label>
                    <div class="input-group">
                        <input id="file" name="file" type="file" class="form-control" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                        <button id="clearFile" type="button" class="btn btn-outline-secondary">Clear</button>
                    </div>
                    <small id="fileHelp" class="form-text text-muted">Ukuran maksimal disesuaikan oleh server.</small>
                </div>

                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                    <a href="<?= site_url('dokumen') ?>" class="btn btn-default btn-md">Batal</a>
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
    var form = document.getElementById('dokumenForm');

    if (fileInput) {
        fileInput.addEventListener('change', function () {
            var name = this.files && this.files.length ? this.files[0].name : '';
            if (name) {
                document.getElementById('fileHelp').innerText = 'File terpilih: ' + name;
            } else {
                document.getElementById('fileHelp').innerText = 'Tidak ada file dipilih.';
            }
        });
    }
    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            if (fileInput) {
                fileInput.value = '';
                document.getElementById('fileHelp').innerText = 'Tidak ada file dipilih.';
            }
        });
    }

    // Basic client-side validation (title required already enforced by `required`)
    if (form) {
        form.addEventListener('submit', function (e) {
            var title = document.getElementById('title').value.trim();
            if (!title) {
                e.preventDefault();
                alert('Judul dokumen wajib diisi.');
            }
        });
    }
})();
</script>

<style>
/* Keep create view visually consistent with index */
.card .form-control-lg { font-size: 1rem; padding: .6rem .75rem; }
.card .btn-md { padding: .45rem .85rem; }
@media (max-width: 575.98px) {
    .card .d-flex { flex-direction: column; }
}
</style>
