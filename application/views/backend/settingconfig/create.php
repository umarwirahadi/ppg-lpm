<!-- Modal: Create Setting -->
<div class="modal fade" id="modalCreateSetting" tabindex="-1" aria-labelledby="modalCreateSettingLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="<?= site_url('admin/settingconfig/store') ?>">
				<div class="modal-header">
					<h5 class="modal-title" id="modalCreateSettingLabel">Add Setting</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label for="create-setting-key" class="form-label">Key</label>
						<input type="text" class="form-control" id="create-setting-key" name="setting_key" required>
					</div>
					<div class="mb-3">
						<label for="create-setting-value" class="form-label">Value</label>
						<input type="text" class="form-control" id="create-setting-value" name="setting_value" required>
					</div>
					<div class="mb-3">
						<label for="create-setting-group" class="form-label">Group</label>
						<input type="text" class="form-control" id="create-setting-group" name="setting_group">
					</div>
					<div class="mb-3">
						<label for="create-setting-description" class="form-label">Description</label>
						<textarea class="form-control" id="create-setting-description" name="description" rows="2"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
