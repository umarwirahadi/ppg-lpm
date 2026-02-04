<!-- Settings Management Page -->
<div class="container-fluid py-4">
	<?php if ($this->session->flashdata('success')): ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?= $this->session->flashdata('success') ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>
	
	<?php if ($this->session->flashdata('error')): ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<?= $this->session->flashdata('error') ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>

	<div class="d-flex justify-content-between align-items-center mb-3">
		<h2 class="h4 mb-0">Site Settings</h2>
		<button type="button" class="btn btn-primary" id="btnAddSetting" data-url="<?= site_url('admin/settingconfig/create') ?>">
			<i class="fas fa-plus me-1"></i>Add Setting
		</button>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover align-middle bg-white" id="table-setting">
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
								<button class="btn btn-sm btn-warning me-1 btn-edit-setting" data-url="<?= site_url('admin/settingconfig/edit/' . $row['id']) ?>" title="Edit setting">
									<i class="fas fa-edit"></i> Edit
								</button>
								<button class="btn btn-sm btn-danger me-1 btn-delete-setting" data-url="<?= site_url('admin/settingconfig/delete/' . $row['id']) ?>" title="Delete setting">
									<i class="fas fa-trash"></i> Delete
								</button>
								
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


<div class="modal fade" id="modalSetting" tabindex="-1" aria-labelledby="modalCreateSettingLabel" aria-hidden="true">
</div>

