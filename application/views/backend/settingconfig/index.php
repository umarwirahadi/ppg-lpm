<!-- Settings Management Page -->
<div class="container-fluid py-4">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h2 class="h4 mb-0">Site Settings</h2>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateSetting">Add Setting</button>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover align-middle bg-white">
			<thead class="table-light">
				<tr>
					<th>Key</th>
					<th>Value</th>
					<th>Group</th>
					<th>Description</th>
					<th>Updated At</th>
					<th style="width:110px;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($settings)): ?>
					<?php foreach ($settings as $row): ?>
						<tr>
							<td><?= htmlspecialchars($row['setting_key']) ?></td>
							<td><?= htmlspecialchars($row['setting_value']) ?></td>
							<td><?= htmlspecialchars($row['setting_group']) ?></td>
							<td><?= htmlspecialchars($row['description']) ?></td>
							<td><?= htmlspecialchars($row['updated_at']) ?></td>
							<td>
								<button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#modalEditSetting" 
									data-key="<?= htmlspecialchars($row['setting_key']) ?>"
									data-value="<?= htmlspecialchars($row['setting_value']) ?>"
									data-group="<?= htmlspecialchars($row['setting_group']) ?>"
									data-description="<?= htmlspecialchars($row['description']) ?>"
								>Edit</button>
								<a href="<?= site_url('backend/setting/delete/'.$row['setting_key']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this setting?')">Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr><td colspan="6" class="text-center text-muted">No settings found.</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<?php include __DIR__.'/create.php'; ?>
<?php include __DIR__.'/edit.php'; ?>

<script>
// Fill edit modal with row data
document.addEventListener('DOMContentLoaded', function() {
	var editModal = document.getElementById('modalEditSetting');
	if (editModal) {
		editModal.addEventListener('show.bs.modal', function (event) {
			var button = event.relatedTarget;
			editModal.querySelector('[name=setting_key]').value = button.getAttribute('data-key');
			editModal.querySelector('[name=setting_value]').value = button.getAttribute('data-value');
			editModal.querySelector('[name=setting_group]').value = button.getAttribute('data-group');
			editModal.querySelector('[name=description]').value = button.getAttribute('data-description');
		});
	}
});
</script>
