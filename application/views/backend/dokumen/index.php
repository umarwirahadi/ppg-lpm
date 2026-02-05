
<div class="container-fluid mt-4">
	<div class="card">
		<div class="card-header dokumen-card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
			<div class="header-left">
				<h4 class="mb-0">Daftar Dokumen SPMI</h4>
				<small class="text-muted d-none d-md-inline">Kelola dokumen SPMI.</small>
			</div>
			<div class="header-right d-flex align-items-center gap-2 w-md-auto">
				<!-- <input id="dokumenSearch" type="search" class="form-control form-control-sm me-2" placeholder="Cari judul atau deskripsi..." aria-label="Cari dokumen" style="min-width:180px;"> -->
				<div class="btn-group" role="group" aria-label="actions">
					<button id="btnCreate" type="button" class="btn btn-primary btn-md" title="Tambah dokumen">Create</button>
					<button id="btnRefresh" type="button" class="btn btn-info btn-md" title="Segarkan daftar">Refresh</button>
					<button id="btnExport" type="button" class="btn btn-secondary btn-md" title="Ekspor ke CSV">Export</button>
				</div>
			</div>
		</div>
		<div class="card-body p-2">
			<div class="table-responsive">
				<table class="table table-bordered table-striped mb-0 dataTable">
					<thead class="thead-light">
						<tr>
							<th>ID</th>
							<th>Judul</th>
							<th>Deskripsi</th>
							<th>File</th>
							<th>Status</th>
							<th>Dibuat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($dokumen_list)): ?>
							<?php foreach ($dokumen_list as $dokumen): ?>
								<tr>
									<td><?= htmlspecialchars($dokumen->id) ?></td>
									<td><?= htmlspecialchars($dokumen->title) ?></td>
									<td><?= htmlspecialchars($dokumen->description) ?></td>
									<td>
										<?php if (!empty($dokumen->file_url)): ?>
											<a href="<?= base_url($dokumen->file_url) ?>" target="_blank">Download</a>
										<?php else: ?>
											-
										<?php endif; ?>
									</td>
									<td><?= $dokumen->is_active ? 'Aktif' : 'Nonaktif' ?></td>
									<td><?= htmlspecialchars($dokumen->created_at) ?></td>
									<td>
										<a href="<?= site_url('admin/dokumen/edit/' . $dokumen->id) ?>" class="btn btn-sm btn-warning">Edit</a>
										<a href="<?= site_url('admin/dokumen/delete/' . $dokumen->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus dokumen ini?');">Hapus</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr><td colspan="7" class="text-center">Tidak ada dokumen ditemukan.</td></tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
// Keep Create and Refresh handlers here (site_url requires PHP)
document.getElementById('btnCreate').addEventListener('click', function () {
	window.location.href = '<?= site_url('admin/dokumen/create') ?>';
});
document.getElementById('btnRefresh').addEventListener('click', function () {
	location.reload();
});
</script>

<style>
/* Small tweaks to keep header tidy without touching global Bootstrap */
.dokumen-card-header .header-right { min-width: 250px; }
@media (max-width: 767.98px) {
	.dokumen-card-header .header-right { width: 100%; }
	.dokumen-card-header .header-right .form-control { width: 100%; }
}
</style>
