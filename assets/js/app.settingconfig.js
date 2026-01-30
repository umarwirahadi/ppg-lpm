// AJAX CRUD for Settingconfig.php
// Assumes endpoints: /backend/settingconfig/list, /create, /edit, /delete
// Requires jQuery and Bootstrap modals

(function($){
    // Fetch and render settings table
    function fetchSettings() {
        $.getJSON('/backend/settingconfig/list', function(data) {
            var tbody = $('#settingsTable tbody');
            tbody.empty();
            if (Array.isArray(data) && data.length) {
                data.forEach(function(row) {
                    var tr = $('<tr>');
                    tr.append($('<td>').text(row.setting_key));
                    tr.append($('<td>').text(row.setting_value));
                    tr.append($('<td>').text(row.setting_group));
                    tr.append($('<td>').text(row.description));
                    tr.append($('<td>').text(row.updated_at));
                    tr.append($('<td>').html(
                        '<button class="btn btn-sm btn-warning me-1 btn-edit-setting" data-key="'+row.setting_key+'">Edit</button>' +
                        '<button class="btn btn-sm btn-danger btn-delete-setting" data-key="'+row.setting_key+'">Delete</button>'
                    ));
                    tbody.append(tr);
                });
            } else {
                tbody.append('<tr><td colspan="6" class="text-center text-muted">No settings found.</td></tr>');
            }
        });
    }

    // Create setting
    $('#modalCreateSetting form').on('submit', function(e){
        e.preventDefault();
        var $form = $(this);
        $.post('/backend/settingconfig/create', $form.serialize(), function(resp){
            $('#modalCreateSetting').modal('hide');
            fetchSettings();
        });
    });

    // Edit button click: fetch data and fill modal
    $(document).on('click', '.btn-edit-setting', function(){
        var key = $(this).data('key');
        $.getJSON('/backend/settingconfig/get/'+encodeURIComponent(key), function(row){
            var modal = $('#modalEditSetting');
            modal.find('[name=setting_key]').val(row.setting_key);
            modal.find('[name=setting_value]').val(row.setting_value);
            modal.find('[name=setting_group]').val(row.setting_group);
            modal.find('[name=description]').val(row.description);
            modal.modal('show');
        });
    });

    // Edit submit
    $('#modalEditSetting form').on('submit', function(e){
        e.preventDefault();
        var $form = $(this);
        $.post('/backend/settingconfig/edit', $form.serialize(), function(resp){
            $('#modalEditSetting').modal('hide');
            fetchSettings();
        });
    });

    // Delete
    $(document).on('click', '.btn-delete-setting', function(){
        if (!confirm('Delete this setting?')) return;
        var key = $(this).data('key');
        $.post('/backend/settingconfig/delete/'+encodeURIComponent(key), function(resp){
            fetchSettings();
        });
    });

    // Initial fetch
    $(function(){
        if ($('#settingsTable').length) fetchSettings();
    });
})(jQuery);
