<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header laporan-card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
            <div class="header-left">
                <h4 class="mb-0">Daftar Laporan</h4>
                <small class="text-muted d-none d-md-inline">Kelola laporan LPM.</small>
            </div>
            <div class="header-right d-flex align-items-center gap-2 w-md-auto">
                <div class="btn-group" role="group" aria-label="actions">
                    <button id="btnCreate" type="button" class="btn btn-primary btn-md" title="Tambah laporan">Create</button>
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
                            <th>Diperbarui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporans) && (is_array($laporans) || is_object($laporans))): ?>
                            <?php foreach ($laporans as $laporan): ?>
                                <tr>
                                    <td><?= htmlspecialchars($laporan->id) ?></td>
                                    <td><?= htmlspecialchars($laporan->title) ?></td>
                                    <td><?= htmlspecialchars($laporan->description) ?></td>
                                    <td>
                                        <?php if (!empty($laporan->file_path)): ?>
                                            <a href="<?= base_url($laporan->file_path) ?>" target="_blank" class="btn btn-sm btn-link">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($laporan->status == 'published' || $laporan->status == 'aktif'): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php elseif ($laporan->status == 'draft'): ?>
                                            <span class="badge bg-warning">Draft</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= htmlspecialchars($laporan->status) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($laporan->created_at ?? '-') ?></td>
                                    <td><?= htmlspecialchars($laporan->updated_at ?? '-') ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?= site_url('admin/laporan/edit/' . $laporan->id) ?>" class="btn btn-sm btn-warning" title="Edit laporan">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= site_url('admin/laporan/delete/' . $laporan->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus laporan ini?');" title="Hapus laporan">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada laporan ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Create button handler (site_url requires PHP)
document.getElementById('btnCreate').addEventListener('click', function () {
    window.location.href = '<?= site_url('admin/laporan/create') ?>';
});

// Refresh button handler
document.getElementById('btnRefresh').addEventListener('click', function () {
    location.reload();
});

// CSV export functionality for visible rows
document.getElementById('btnExport').addEventListener('click', function () {
    var table = document.getElementById('laporanTable');
    
    // Get headers
    var headers = Array.from(table.querySelectorAll('thead th')).map(function (th) { 
        return '"' + th.innerText.trim().replace(/"/g,'""') + '"'; 
    });
    var csv = [headers.join(',')];
    
    // Get data rows
    table.querySelectorAll('tbody tr').forEach(function (tr) {
        if (tr.style.display === 'none') return; // Skip hidden rows
        var cols = Array.from(tr.querySelectorAll('td')).map(function (td) { 
            return '"' + td.innerText.trim().replace(/"/g,'""') + '"'; 
        });
        csv.push(cols.join(','));
    });
    
    // Create and download CSV file
    var blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
    var link = document.createElement('a');
    var url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', 'laporan_export_' + new Date().toISOString().slice(0,10) + '.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
</script>

<style>
/* Header styling to keep layout tidy */
.laporan-card-header .header-right { 
    min-width: 250px; 
}

@media (max-width: 767.98px) {
    .laporan-card-header .header-right { 
        width: 100%; 
    }
    .laporan-card-header .header-right .form-control { 
        width: 100%; 
    }
}

/* Table action buttons */
#laporanTable .btn-group {
    white-space: nowrap;
}

/* Status badges */
.badge {
    padding: 0.35em 0.65em;
    font-size: 0.85em;
}
</style>
