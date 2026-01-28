<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
            <div class="header-left">
                <h4 class="mb-0">Daftar Kegiatan</h4>
                <small class="text-muted d-none d-md-inline">Kelola kegiatan LPM.</small>
            </div>
            <div class="header-right d-flex align-items-center gap-2 w-md-auto">
                <div class="btn-group" role="group" aria-label="actions">
                    <button id="btnCreate" type="button" class="btn btn-primary btn-md" title="Tambah kegiatan">Create</button>
                    <button id="btnRefresh" type="button" class="btn btn-info btn-md" title="Segarkan daftar">Refresh</button>
                    <button id="btnExport" type="button" class="btn btn-secondary btn-md" title="Ekspor ke CSV">Export</button>
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                <table id="kegiatanTable" class="table table-bordered table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penyelenggara</th>
                            <th>Lokasi</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
                            <th>Peserta</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kegiatan_list) && is_array($kegiatan_list)): ?>
                            <?php foreach ($kegiatan_list as $k): ?>
                                <tr>
                                    <td><?= htmlspecialchars($k['id']) ?></td>
                                    <td><?= htmlspecialchars($k['title']) ?></td>
                                    <td><?= htmlspecialchars($k['category']) ?></td>
                                    <td><?= htmlspecialchars($k['organizer']) ?></td>
                                    <td><?= htmlspecialchars($k['location']) ?></td>
                                    <td><?= htmlspecialchars($k['start_date']) ?></td>
                                    <td><?= htmlspecialchars($k['end_date']) ?></td>
                                    <td><?= htmlspecialchars($k['participants']) ?></td>
                                    <td><?= htmlspecialchars($k['status']) ?></td>
                                    <td><?= htmlspecialchars($k['created_at']) ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/kegiatan/edit/' . $k['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= site_url('admin/kegiatan/delete/' . $k['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kegiatan ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="11" class="text-center">Tidak ada kegiatan ditemukan.</td></tr>
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
    window.location.href = '<?= site_url('admin/kegiatan/create') ?>';
});
document.getElementById('btnRefresh').addEventListener('click', function () {
    location.reload();
});

// Simple CSV export for visible rows
document.getElementById('btnExport').addEventListener('click', function () {
    var table = document.getElementById('kegiatanTable');
    var rows = Array.from(table.querySelectorAll('thead th')).map(function (th) { return '"' + th.innerText.trim().replace(/"/g,'""') + '"'; });
    var csv = [rows.join(',')];
    table.querySelectorAll('tbody tr').forEach(function (tr) {
        if (tr.style.display === 'none') return;
        var cols = Array.from(tr.querySelectorAll('td')).map(function (td) { return '"' + td.innerText.trim().replace(/"/g,'""') + '"'; });
        csv.push(cols.join(','));
    });
    var blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
    var link = document.createElement('a');
    var url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', 'kegiatan_export.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
</script>

<style>
/* Small tweaks to keep header tidy */
.card-header .header-right { min-width: 250px; }
@media (max-width: 767.98px) {
    .card-header .header-right { width: 100%; }
}
</style>
