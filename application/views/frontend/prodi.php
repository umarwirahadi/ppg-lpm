<style>
/* Modern card/grid UI for Program Studi */
:root{--card-bg:linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);--accent:#2563eb}
.prodi-grid{display:flex;flex-wrap:wrap;margin:-0.75rem}
.prodi-item{padding:0.75rem;box-sizing:border-box;opacity:0;transform:translateY(12px);animation:fadeInUp .45s ease forwards;}
.prodi-card{background:var(--card-bg);border-radius:12px;border:1px solid rgba(37,99,235,0.06);box-shadow:0 6px 18px rgba(16,24,40,0.04);transition:transform .22s ease,box-shadow .22s ease;border-left:4px solid transparent}
.prodi-card:hover{transform:translateY(-6px) scale(1.01);box-shadow:0 12px 30px rgba(16,24,40,0.08);border-left-color:var(--accent)}
.prodi-card .card-body{display:flex;flex-direction:column;min-height:150px}
.prodi-meta{color:#6b7280;font-size:.9rem}
.prodi-kode,.prodi-akreditasi{font-weight:600;color:#111827}
.prodi-search{max-width:520px}

@keyframes fadeInUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}

/* small screens */
@media (max-width:767px){.prodi-item{width:100%}}
@media (min-width:768px) and (max-width:991px){.prodi-item{width:50%}}
@media (min-width:992px){.prodi-item{width:33.3333%}}

</style>

<div class="container py-4">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3">Program Studi</h1>
            <p class="text-muted">Daftar program studi yang dikelola oleh LPM.</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <input id="prodi-search" type="search" class="form-control prodi-search" placeholder="Cari nama atau fakultas...">
        </div>
    </div>

    <div id="prodi-container" class="prodi-grid">
        <?php if (!empty($prodi_list) && is_array($prodi_list)): ?>
            <?php foreach ($prodi_list as $idx => $p): ?>
                <div class="prodi-item" style="--delay:<?php echo (intval($idx) * 80); ?>ms" data-nama="<?php echo htmlspecialchars(strtolower($p['nama_prodi'])); ?>" data-fakultas="<?php echo htmlspecialchars(strtolower($p['fakultas'] ?? '')); ?>">
                    <div class="prodi-card card h-100" style="animation-delay: calc(var(--delay));">
                        <div class="card-body">
                            <h5 class="card-title mb-1"><?php echo htmlspecialchars($p['nama_prodi']); ?></h5>
                            <small class="prodi-meta mb-2"><?php echo isset($p['fakultas']) ? htmlspecialchars($p['fakultas']) : ''; ?></small>
                            <p class="mb-2">Kode: <span class="prodi-kode"><?php echo htmlspecialchars($p['kode'] ?? '-'); ?></span></p>
                            <p class="mb-2">Akreditasi: <span class="prodi-akreditasi"><?php echo htmlspecialchars($p['akreditasi'] ?? '-'); ?></span></p>
                            <div class="mt-auto">
                                <a href="<?php echo site_url('data-program-studi/'.$p['id']); ?>" class="btn btn-primary btn-sm">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">Belum ada data Program Studi.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var search = document.getElementById('prodi-search');
    var items = Array.prototype.slice.call(document.querySelectorAll('.prodi-item'));

    search.addEventListener('input', function () {
        var q = (this.value || '').trim().toLowerCase();
        items.forEach(function (el) {
            var nama = el.getAttribute('data-nama') || '';
            var fakultas = el.getAttribute('data-fakultas') || '';
            if (!q || nama.indexOf(q) !== -1 || fakultas.indexOf(q) !== -1) {
                el.classList.remove('d-none');
            } else {
                el.classList.add('d-none');
            }
        });
    });
});
</script>
