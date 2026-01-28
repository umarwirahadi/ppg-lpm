<!-- Page Header -->
<section class="hero-section" style="background-image: linear-gradient(rgba(44, 62, 80, 0.8), rgba(52, 152, 219, 0.8)), url('<?= base_url('assets/img/Kegiatanlpm.png') ?>'); background-repeat: no-repeat; height: 300px; background-size: cover; background-position: center;">
	<div class="container">
		<div class="hero-slide">
			<h1 class="hero-title">Kegiatan LPM</h1>
			<p class="hero-subtitle">Program dan Kegiatan Lembaga Penjaminan Mutu</p>
			<p class="lead mb-4">Berbagai kegiatan dalam rangka peningkatan mutu pendidikan di Politeknik Piksi Ganesha</p>
		</div>
	</div>
</section>

<!-- Activities Content -->
<section class="content-section">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="section-title mb-0">Agenda & Arsip Kegiatan</h2>
                <p class="text-muted small mb-0">Daftar kegiatan LPM — cari, lihat detail, dan unduh dokumen terkait.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <input id="kegiatanSearch" class="form-control form-control-sm d-inline-block" placeholder="Cari judul, lokasi, penyelenggara..." style="max-width:360px;">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="kegiatanTable" class="table table-hover table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Judul</th>
                                <th class="d-none d-sm-table-cell">Lokasi</th>
                                <th class="d-none d-md-table-cell">Penyelenggara</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- rows populated by JS -->
                        </tbody>
                    </table>
                </div>
                <div id="kegiatanEmpty" class="text-center py-4" style="display:none;">
                    <h5 class="text-muted">Tidak ada kegiatan ditemukan.</h5>
                    <p class="small text-muted">Silakan coba kata kunci lain atau periksa kembali nanti.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Kegiatan frontend responsive tweaks */
.section-title { font-size: 1.25rem; }
.dokumen-desc { max-width: 40ch; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
@media (max-width: 575.98px) {
    .d-none.d-sm-table-cell { display: none !important; }
}
</style>

<script>
// Fetch kegiatan JSON and populate table; add client-side search filtering
(function () {
    var table = document.getElementById('kegiatanTable');
    if (!table) return;
    var tbody = table.querySelector('tbody');
    var search = document.getElementById('kegiatanSearch');
    var empty = document.getElementById('kegiatanEmpty');

    function fmtDate(d) {
        if (!d) return '';
        try { return new Date(d).toLocaleString(); } catch (e) { return d; }
    }

    function renderRows(items) {
        tbody.innerHTML = '';
        if (!Array.isArray(items) || items.length === 0) {
            empty.style.display = '';
            return;
        }
        empty.style.display = 'none';
        var frag = document.createDocumentFragment();
        items.forEach(function (it) {
            var tr = document.createElement('tr');
            var sd = document.createElement('td'); sd.textContent = fmtDate(it.start_date);
            var ed = document.createElement('td'); ed.textContent = fmtDate(it.end_date);
            var title = document.createElement('td'); title.textContent = it.title || '';
            var loc = document.createElement('td'); loc.className = 'd-none d-sm-table-cell text-muted small'; loc.textContent = it.location || '';
            var org = document.createElement('td'); org.className = 'd-none d-md-table-cell text-muted small'; org.textContent = it.organizer || '';
            var status = document.createElement('td'); status.innerHTML = (it.status === 'published' ? '<span class="badge bg-success">Published</span>' : (it.status === 'draft' ? '<span class="badge bg-secondary">Draft</span>' : '<span class="badge bg-info">' + (it.status||'') + '</span>'));
            var actions = document.createElement('td'); actions.className = 'text-end';
            var btn = document.createElement('a'); btn.className = 'btn btn-sm btn-primary me-1'; btn.href = '<?= site_url('kegiatan/detail/') ?>' + (it.id || ''); btn.textContent = 'Selengkapnya';
            actions.appendChild(btn);
            if (it.document_url) {
                var dl = document.createElement('a'); dl.className = 'btn btn-sm btn-outline-secondary'; dl.href = it.document_url; dl.target = '_blank'; dl.rel = 'noopener'; dl.textContent = 'Unduh';
                actions.appendChild(dl);
            }

            tr.appendChild(sd);
            tr.appendChild(ed);
            tr.appendChild(title);
            tr.appendChild(loc);
            tr.appendChild(org);
            tr.appendChild(status);
            tr.appendChild(actions);
            frag.appendChild(tr);
        });
        tbody.appendChild(frag);
    }

    function fetchAndRender() {
        var url = '<?= site_url("kegiatan/json") ?>';
        fetch(url, { credentials: 'same-origin' }).then(function (res) {
            if (!res.ok) throw new Error('Network');
            return res.json();
        }).then(function (data) {
            window._kegiatanData = Array.isArray(data) ? data : [];
            renderRows(window._kegiatanData);
        }).catch(function () {
            // show empty
            renderRows([]);
        });
    }

    function filter(q) {
        var arr = (window._kegiatanData || []).filter(function (it) {
            q = q.trim().toLowerCase();
            if (!q) return true;
            return (it.title||'').toLowerCase().indexOf(q) !== -1 || (it.location||'').toLowerCase().indexOf(q) !== -1 || (it.organizer||'').toLowerCase().indexOf(q) !== -1;
        });
        renderRows(arr);
    }

    if (search) {
        search.addEventListener('input', function () { filter(this.value || ''); });
    }

    fetchAndRender();
})();
</script>
