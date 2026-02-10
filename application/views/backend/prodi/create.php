<div class="container-fluid mt-4">
	<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h4 class="mb-0">Tambah Program Studi</h4>
			<a href="<?= site_url('prodi') ?>" class="btn btn-default btn-md">Kembali</a>
		</div>
		<div class="card-body">
			<?php if (!empty($this->session->flashdata('error'))): ?>
				<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
			<?php endif; ?>

			<form id="prodiForm" method="post" action="<?= site_url('prodi/store') ?>" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="kode" class="form-label">Kode <span class="text-danger">*</span></label>
					<input id="kode" name="kode" type="text" class="form-control form-control-lg" required placeholder="Masukkan kode program studi">
				</div>

				<div class="mb-3">
					<label for="nama_prodi" class="form-label">Nama Program Studi <span class="text-danger">*</span></label>
					<input id="nama_prodi" name="nama_prodi" type="text" class="form-control form-control-lg" required placeholder="Masukkan nama program studi">
				</div>

				<div class="mb-3">
					<label for="fakultas" class="form-label">Fakultas</label>
					<select id="fakultas" name="fakultas" class="form-control">
							<option value="">Pilih</option>
							<option value="Ekonomi Bisnis">Ekonomi Bisnis</option>
							<option value="Informatika">Informatika</option>
							<option value="Kesehatan">Kesehatan</option>
						</select>

				</div>

				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="ketua_prodi" class="form-label">Ketua Prodi</label>
						<input id="ketua_prodi" name="ketua_prodi" type="text" class="form-control" placeholder="Nama ketua prodi">
					</div>
					<div class="col-md-6 mb-3">
						<label for="sekretaris_prodi" class="form-label">Sekretaris Prodi</label>
						<input id="sekretaris_prodi" name="sekretaris_prodi" type="text" class="form-control" placeholder="Nama sekretaris prodi">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4 mb-3">
						<label for="akreditasi" class="form-label">Akreditasi</label>
						<select id="akreditasi" name="akreditasi" class="form-control">
							<option value="">Pilih</option>
							<option value="Unggul">Unggul</option>
							<option value="Baik Sekali">Baik Sekali</option>
							<option value="Baik">Baik</option>
							<option value="Cukup">Cukup</option>
							<option value="Kurang">Kurang</option>
							<option value="Tidak Terakreditasi">Tidak Terakreditasi</option>
						</select>
					</div>
					<div class="col-md-4 mb-3">
						<label for="tgl_berlaku_akreditasi" class="form-label">Tgl Berlaku Akreditasi</label>
						<input id="tgl_berlaku_akreditasi" name="tgl_berlaku_akreditasi" type="date" class="form-control">
					</div>
					<div class="col-md-4 mb-3">
						<label for="tgl_berakhir_akreditasi" class="form-label">Tgl Berakhir Akreditasi</label>
						<input id="tgl_berakhir_akreditasi" name="tgl_berakhir_akreditasi" type="date" class="form-control">
					</div>
				</div>

				<div class="mb-3">
					<label for="no_sk" class="form-label">No SK</label>
					<input id="no_sk" name="no_sk" type="text" class="form-control" placeholder="Nomor SK akreditasi">
				</div>

				<div class="mb-3">
					<label for="keterangan" class="form-label">Keterangan</label>
					<textarea id="keterangan" name="keterangan" class="form-control" rows="4" placeholder="Keterangan tambahan"></textarea>
				</div>

				<div class="d-flex gap-2">
					<button type="submit" class="btn btn-primary btn-md">Simpan</button>
					<a href="<?= site_url('prodi') ?>" class="btn btn-default btn-md">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
(function () {
	var form = document.getElementById('prodiForm');
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
/* Small visual adjustments consistent with other backend forms */
.card .form-control-lg { font-size: 1rem; padding: .6rem .75rem; }
.card .btn-md { padding: .45rem .85rem; }
@media (max-width: 575.98px) {
	.card .d-flex { flex-direction: column; }
}
</style>
