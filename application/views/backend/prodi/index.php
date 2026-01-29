<div class="container-fluid mt-4">
	<div class="card">
		<div class="card-header prodi-card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
			<div class="header-left">
				<h4 class="mb-0">Daftar Program Studi</h4>
				<small class="text-muted d-none d-md-inline">Kelola data program studi.</small>
			</div>
			<div class="header-right d-flex align-items-center gap-2 w-md-auto">
				<div class="btn-group" role="group" aria-label="actions">
					<button id="btnCreate" type="button" class="btn btn-primary btn-md" title="Tambah prodi">Create</button>
					<button id="btnRefresh" type="button" class="btn btn-info btn-md" title="Segarkan daftar">Refresh</button>
					<button id="btnExport" type="button" class="btn btn-secondary btn-md" title="Ekspor ke CSV">Export</button>
				</div>
			</div>
		</div>
		<div class="card-body p-2">
			<div class="table-responsive">
				<table id="prodiTable" class="table table-bordered table-striped mb-0">
					<thead class="thead-light">
						<tr>
							<th>ID</th>
							<th>Kode</th>
							<th>Nama Prodi</th>
							<th>Fakultas</th>
							<th>Ketua Prodi</th>
							<th>Sekretaris</th>
							<th>Akreditasi</th>
							<th>Tgl Berlaku</th>
							<th>Tgl Berakhir</th>
							<th>No SK</th>
							<th>Keterangan</th>
							<th>Dibuat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($prodi_list)): ?>
							<?php foreach ($prodi_list as $prodi): ?>
								<tr>
									<td><?= htmlspecialchars(isset($prodi['id']) ? $prodi['id'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['kode']) ? $prodi['kode'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['nama_prodi']) ? $prodi['nama_prodi'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['fakultas']) ? $prodi['fakultas'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['ketua_prodi']) ? $prodi['ketua_prodi'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['sekretaris_prodi']) ? $prodi['sekretaris_prodi'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['akreditasi']) ? $prodi['akreditasi'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['tgl_berlaku_akreditasi']) ? $prodi['tgl_berlaku_akreditasi'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['tgl_berakhir_akreditasi']) ? $prodi['tgl_berakhir_akreditasi'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['no_sk']) ? $prodi['no_sk'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['keterangan']) ? $prodi['keterangan'] : '') ?></td>
									<td><?= htmlspecialchars(isset($prodi['created_at']) ? $prodi['created_at'] : '') ?></td>
									<td>
										<a href="<?= site_url('prodi/edit/' . (isset($prodi['id']) ? $prodi['id'] : '')) ?>" class="btn btn-sm btn-warning">Edit</a>
										<a href="<?= site_url('prodi/delete/' . (isset($prodi['id']) ? $prodi['id'] : '')) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data prodi ini?');">Hapus</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr><td colspan="13" class="text-center">Tidak ada program studi ditemukan.</td></tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
document.getElementById('btnCreate').addEventListener('click', function () {
	window.location.href = '<?= site_url('prodi/create') ?>';
});
document.getElementById('btnRefresh').addEventListener('click', function () {
	location.reload();
});
</script>

<style>
.prodi-card-header .header-right { min-width: 250px; }
@media (max-width: 767.98px) {
	.prodi-card-header .header-right { width: 100%; }
	.prodi-card-header .header-right .form-control { width: 100%; }
}
</style>
