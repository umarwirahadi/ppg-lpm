<!-- Modal: Edit Setting -->
<div class="modal-dialog">
	<div class="modal-content">
		<form method="post" action="<?= site_url('admin/settingconfig/update/' . $setting['id']) ?>">
			<div class="modal-header">
				<h5 class="modal-title" id="modalEditSettingLabel">Edit Setting</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<label for="edit-setting-key" class="form-label">Key</label>
					<input type="text" class="form-control" id="edit-setting-key" name="setting_key" readonly required value="<?=$setting['setting_key'] ?>">
				</div>
				<div class="mb-3">
					<label for="edit-setting-value" class="form-label">Value</label>
					<input type="text" class="form-control" id="edit-setting-value" name="setting_value" required value="<?=$setting['setting_value'] ?>">
				</div>
				<div class="mb-3">
					<label for="edit-setting-group" class="form-label">Group</label>
					<input type="text" class="form-control" id="edit-setting-group" name="setting_group" value="<?=$setting['setting_group'] ?>">
				</div>
				<div class="mb-3">
					<label for="edit-setting-description" class="form-label">Description</label>
					<textarea class="form-control" id="edit-setting-description" name="description" rows="2"><?=$setting['description'] ?></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Save Changes</button>
			</div>
		</form>
	</div>
</div>