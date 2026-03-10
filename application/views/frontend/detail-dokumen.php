<div class="container my-5 pt-5">
	<div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
		<div>
			<h2 class="mb-1"><?= htmlspecialchars($dokumen['title'] ?? 'Detail Dokumen') ?></h2>
			<p class="text-muted mb-0">Detail dokumen SPMI</p>
		</div>
		<div class="d-flex gap-2">
			<a href="<?= site_url('dokumen-spmi') ?>" class="btn btn-outline-secondary btn-sm">Kembali</a>
			<?php if (!empty($dokumen['file_url'])): ?>
				<?php if (!empty($is_logged_in)): ?>
					<a href="<?= site_url('dokumen-spmi/preview/' . ($dokumen['id'] ?? 0)) ?>" class="btn btn-outline-secondary btn-sm" target="_blank" rel="noopener">Preview</a>
					<a href="<?= site_url('dokumen-spmi/download/' . ($dokumen['id'] ?? 0)) ?>" class="btn btn-primary btn-sm" target="_blank" rel="noopener">Unduh</a>
				<?php else: ?>
					<a href="<?= site_url('dokumen-spmi/preview/' . ($dokumen['id'] ?? 0)) ?>" class="btn btn-outline-secondary btn-sm">Preview</a>
					<a href="<?= site_url('dokumen-spmi/download/' . ($dokumen['id'] ?? 0)) ?>" class="btn btn-primary btn-sm">Unduh</a>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<div class="row g-3">
				<div class="col-12">
					<h6 class="text-muted mb-1">Deskripsi</h6>
					<div><?= nl2br(htmlspecialchars($dokumen['description'] ?? '-')) ?></div>
				</div>

				<div class="col-6 col-md-3">
					<h6 class="text-muted mb-1">Status</h6>
					<?php if (!empty($dokumen['is_active'])): ?>
						<span class="badge bg-success">Aktif</span>
					<?php else: ?>
						<span class="badge bg-secondary">Nonaktif</span>
					<?php endif; ?>
				</div>

				<div class="col-6 col-md-3">
					<h6 class="text-muted mb-1">Tanggal</h6>
					<div class="text-muted small">
						<?php
						$createdAt = $dokumen['created_at'] ?? '';
						echo $createdAt ? htmlspecialchars(date('d M Y', strtotime($createdAt))) : '-';
						?>
					</div>
				</div>

				<div class="col-12 col-md-6">
					<h6 class="text-muted mb-1">File</h6>
					<div class="text-muted small">
						<?php if (!empty($dokumen['file_url'])): ?>
							<?= htmlspecialchars(basename($dokumen['file_url'])) ?>
						<?php else: ?>
							-
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
