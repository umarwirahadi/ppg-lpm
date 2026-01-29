
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Edit Program Studi</h4>
            <a href="<?= site_url('prodi') ?>" class="btn btn-default btn-md">Kembali</a>
        </div>
        <div class="card-body">
            <?php if (!empty($this->session->flashdata('error'))): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <?php if (empty($prodi)): ?>
                <div class="alert alert-warning">Data program studi tidak ditemukan.</div>
            <?php else: ?>

            <form id="prodiEditForm" method="post" action="<?= site_url('prodi/update/' . (isset($prodi['id']) ? $prodi['id'] : '')) ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars(isset($prodi['id']) ? $prodi['id'] : '') ?>">

                <div class="mb-3">
                    <label for="kode" class="form-label">Kode <span class="text-danger">*</span></label>
                    <input id="kode" name="kode" type="text" class="form-control form-control-lg" required value="<?= htmlspecialchars(isset($prodi['kode']) ? $prodi['kode'] : '') ?>">
                </div>

                <div class="mb-3">
                    <label for="nama_prodi" class="form-label">Nama Program Studi <span class="text-danger">*</span></label>
                    <input id="nama_prodi" name="nama_prodi" type="text" class="form-control form-control-lg" required value="<?= htmlspecialchars(isset($prodi['nama_prodi']) ? $prodi['nama_prodi'] : '') ?>">
                </div>

                <div class="mb-3">
                    <label for="fakultas" class="form-label">Fakultas</label>
                    <input id="fakultas" name="fakultas" type="text" class="form-control" value="<?= htmlspecialchars(isset($prodi['fakultas']) ? $prodi['fakultas'] : '') ?>">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ketua_prodi" class="form-label">Ketua Prodi</label>
                        <input id="ketua_prodi" name="ketua_prodi" type="text" class="form-control" value="<?= htmlspecialchars(isset($prodi['ketua_prodi']) ? $prodi['ketua_prodi'] : '') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sekretaris_prodi" class="form-label">Sekretaris Prodi</label>
                        <input id="sekretaris_prodi" name="sekretaris_prodi" type="text" class="form-control" value="<?= htmlspecialchars(isset($prodi['sekretaris_prodi']) ? $prodi['sekretaris_prodi'] : '') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="akreditasi" class="form-label">Akreditasi</label>
                        <select id="akreditasi" name="akreditasi" class="form-control">
                            <option value="" <?= (empty($prodi['akreditasi']) ? 'selected' : '') ?>>Pilih</option>
                            <option value="A" <?= (isset($prodi['akreditasi']) && $prodi['akreditasi'] === 'A' ? 'selected' : '') ?>>A</option>
                            <option value="B" <?= (isset($prodi['akreditasi']) && $prodi['akreditasi'] === 'B' ? 'selected' : '') ?>>B</option>
                            <option value="C" <?= (isset($prodi['akreditasi']) && $prodi['akreditasi'] === 'C' ? 'selected' : '') ?>>C</option>
                            <option value="-" <?= (isset($prodi['akreditasi']) && $prodi['akreditasi'] === '-' ? 'selected' : '') ?>>-</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tgl_berlaku_akreditasi" class="form-label">Tgl Berlaku Akreditasi</label>
                        <input id="tgl_berlaku_akreditasi" name="tgl_berlaku_akreditasi" type="date" class="form-control" value="<?= htmlspecialchars(isset($prodi['tgl_berlaku_akreditasi']) ? $prodi['tgl_berlaku_akreditasi'] : '') ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tgl_berakhir_akreditasi" class="form-label">Tgl Berakhir Akreditasi</label>
                        <input id="tgl_berakhir_akreditasi" name="tgl_berakhir_akreditasi" type="date" class="form-control" value="<?= htmlspecialchars(isset($prodi['tgl_berakhir_akreditasi']) ? $prodi['tgl_berakhir_akreditasi'] : '') ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="no_sk" class="form-label">No SK</label>
                    <input id="no_sk" name="no_sk" type="text" class="form-control" value="<?= htmlspecialchars(isset($prodi['no_sk']) ? $prodi['no_sk'] : '') ?>">
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" class="form-control" rows="4"><?= htmlspecialchars(isset($prodi['keterangan']) ? $prodi['keterangan'] : '') ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-md">Simpan Perubahan</button>
                    <a href="<?= site_url('prodi') ?>" class="btn btn-default btn-md">Batal</a>
                    <a href="<?= site_url('prodi/delete/' . (isset($prodi['id']) ? $prodi['id'] : '')) ?>" class="btn btn-sm btn-danger ms-auto" onclick="return confirm('Yakin ingin menghapus data prodi ini?');">Hapus</a>
                </div>
            </form>

            <?php endif; ?>
        </div>
    </div>
</div>

<script>
(function () {
    var form = document.getElementById('prodiEditForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            var kode = document.getElementById('kode').value.trim();
            var nama = document.getElementById('nama_prodi').value.trim();
            if (!kode || !nama) {
                e.preventDefault();
                alert('Kode dan Nama Program Studi wajib diisi.');
            }
        });
    }
})();
</script>

<style>
/* Reuse styles consistent with create view */
.card .form-control-lg { font-size: 1rem; padding: .6rem .75rem; }
.card .btn-md { padding: .45rem .85rem; }
@media (max-width: 575.98px) {
    .card .d-flex { flex-direction: column; }
}
</style>
