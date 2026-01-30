<!-- Modal: Edit Setting -->
<div class="modal fade" id="modalEditSetting" tabindex="-1" aria-labelledby="modalEditSettingLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="<?= site_url('backend/setting/edit') ?>">
				<div class="modal-header">
					<h5 class="modal-title" id="modalEditSettingLabel">Edit Setting</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label for="edit-setting-key" class="form-label">Key</label>
						<input type="text" class="form-control" id="edit-setting-key" name="setting_key" readonly required>
					</div>
					<div class="mb-3">
						<label for="edit-setting-value" class="form-label">Value</label>
						<input type="text" class="form-control" id="edit-setting-value" name="setting_value" required>
					</div>
					<div class="mb-3">
						<label for="edit-setting-group" class="form-label">Group</label>
						<input type="text" class="form-control" id="edit-setting-group" name="setting_group">
					</div>
					<div class="mb-3">
						<label for="edit-setting-description" class="form-label">Description</label>
						<textarea class="form-control" id="edit-setting-description" name="description" rows="2"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Save Changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
