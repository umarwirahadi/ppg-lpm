<div class="container my-5 pt-5">
	<div class="row mb-3 align-items-center">
		<div class="col-md-8">
			<h2 class="mb-1">Data Laporan</h2>
			<p class="text-muted mb-0">Kumpulan laporan terkait penjaminan mutu pendidikan.</p>
		</div>
		<div class="col-md-4 mt-3 mt-md-0 text-md-end">
			<form action="<?= site_url('data-laporan') ?>" method="get" class="d-inline">
				<input
					id="frontendLaporanSearch"
					name="q"
					value="<?= htmlspecialchars($q ?? '') ?>"
					class="form-control form-control-sm d-inline-block"
					style="max-width:320px;"
					placeholder="Cari laporan..."
					aria-label="Cari laporan">
			</form>
		</div>
	</div>

	<div class="table-responsive">
		<table id="laporanTable" class="table table-hover table-sm align-middle">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th class="d-none d-sm-table-cell">Deskripsi</th>
					<th>Status</th>
					<th>Tanggal</th>
					<th class="text-end">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($laporan_list) && is_array($laporan_list)): ?>
					<?php $no = 1; foreach ($laporan_list as $laporan): ?>
						<?php
							$status = strtolower(trim((string) ($laporan->status ?? '')));
							$badge = 'bg-secondary';
							$label = $status ? ucfirst($status) : '-';
							switch ($status) {
								case 'published': $badge = 'bg-success'; $label = 'Published'; break;
								case 'draft': $badge = 'bg-secondary'; $label = 'Draft'; break;
								case 'pending': $badge = 'bg-warning'; $label = 'Pending'; break;
								case 'review': $badge = 'bg-info'; $label = 'Review'; break;
								case 'archived': $badge = 'bg-dark'; $label = 'Archived'; break;
							}
							$hasFile = !empty($laporan->file_path);
							$downloadUrl = $hasFile ? site_url('data-laporan/download/' . ($laporan->id ?? '')) : '';
							$createdAt = (string) ($laporan->created_at ?? '');
						?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= htmlspecialchars($laporan->title ?? '-') ?></td>
							<td class="d-none d-sm-table-cell text-muted small"><?= htmlspecialchars(mb_strimwidth(strip_tags((string) ($laporan->description ?? '')), 0, 120, '...')) ?></td>
							<td><span class="badge <?= $badge ?>"><?= htmlspecialchars($label) ?></span></td>
							<td class="text-muted small"><?= $createdAt ? htmlspecialchars(date('d M Y', strtotime($createdAt))) : '-' ?></td>
							<td class="text-end">
								<div class="btn-group" role="group">
									<?php if ($hasFile): ?>
										<a href="<?= htmlspecialchars($downloadUrl) ?>" class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener">Unduh</a>
									<?php else: ?>
										<button class="btn btn-sm btn-outline-secondary" disabled>Tidak ada file</button>
									<?php endif; ?>
									<a href="<?= site_url('data-laporan/' . ($laporan->id ?? '')) ?>" class="btn btn-sm btn-outline-dark">Lihat</a>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="6" class="text-center text-muted py-4">Tidak ada laporan ditemukan.</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
