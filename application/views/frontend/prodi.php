<!-- Program Studi Modern UI -->
<section class="prodi-section py-5 mt-5">
    <div class="container">
        <!-- Header -->
        <div class="prodi-header text-center mb-5">
            <h1 class="prodi-title">Program Studi</h1>
            <p class="prodi-subtitle">Daftar program studi terakreditasi yang dikelola oleh Lembaga Penjaminan Mutu</p>
            <div class="prodi-divider"></div>
        </div>

        <!-- Filters -->
        <div class="prodi-filters mb-4">
            <div class="row g-3 justify-content-center">
                <div class="col-md-5 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.442 1.398a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/></svg>
                        </span>
                        <input id="prodiSearch" type="search" class="form-control border-start-0" placeholder="Cari program studi...">
                    </div>
                </div>
                <div class="col-md-3 col-lg-2">
                    <select id="prodiAkreditasi" class="form-select">
                        <option value="">Semua Akreditasi</option>
                        <option value="unggul">Unggul</option>
                        <option value="baik sekali">Baik Sekali</option>
                        <option value="baik">Baik</option>                        
                    </select>
                </div>
                <div class="col-md-3 col-lg-2">
                    <select id="prodiFakultas" class="form-select">
                        <option value="">Semua Fakultas</option>
                        <?php
                        $fakultasList = [];
                        if (!empty($prodi_list) && is_array($prodi_list)) {
                            foreach ($prodi_list as $p) {
                                $fak = trim($p['fakultas'] ?? '');
                                if ($fak && !in_array($fak, $fakultasList)) $fakultasList[] = $fak;
                            }
                            sort($fakultasList);
                            foreach ($fakultasList as $fak) {
                                echo '<option value="' . htmlspecialchars(strtolower($fak)) . '">' . htmlspecialchars($fak) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Stats Summary -->
        <div class="prodi-stats mb-4">
            <div class="row g-3 justify-content-center">
                <?php
                $stats = ['Unggul' => 0, 'Baik Sekali' => 0, 'Baik' => 0, 'A' => 0, 'B' => 0, 'C' => 0, 'Lainnya' => 0];
                if (!empty($prodi_list)) {
                    foreach ($prodi_list as $p) {
                        $akr = trim($p['akreditasi'] ?? '');
                        if (array_key_exists($akr, $stats)) {
                            $stats[$akr]++;
                        } else {
                            $stats['Lainnya']++;
                        }
                    }
                }
                $statColors = ['Unggul' => 'gold', 'Baik Sekali' => 'emerald', 'Baik' => 'blue', 'A' => 'gold', 'B' => 'emerald', 'C' => 'sky', 'Lainnya' => 'slate'];
                foreach ($stats as $label => $count):
                    if ($count > 0):
                ?>
                <div class="col-auto">
                    <div class="stat-chip stat-chip--<?= $statColors[$label] ?>">
                        <span class="stat-chip__count"><?= $count ?></span>
                        <span class="stat-chip__label"><?= $label ?></span>
                    </div>
                </div>
                <?php endif; endforeach; ?>
            </div>
        </div>

        <!-- Cards Grid -->
        <div id="prodiGrid" class="row g-4">
            <?php if (!empty($prodi_list) && is_array($prodi_list)): ?>
                <?php foreach ($prodi_list as $idx => $p): 
                    $akr = strtolower(trim($p['akreditasi'] ?? ''));
                    $akrDisplay = $p['akreditasi'] ?? '-';
                    
                    // Determine grade level and color
                    $gradeClass = 'grade-default';
                    $gradeIcon = '';
                    $gradeLevel = 0;
                    
                    if (in_array($akr, ['unggul', 'a'])) {
                        $gradeClass = 'grade-gold';
                        $gradeLevel = 5;
                    } elseif (in_array($akr, ['baik sekali'])) {
                        $gradeClass = 'grade-emerald';
                        $gradeLevel = 4;
                    } elseif (in_array($akr, ['baik', 'b'])) {
                        $gradeClass = 'grade-blue';
                        $gradeLevel = 3;
                    } elseif (in_array($akr, ['c'])) {
                        $gradeClass = 'grade-sky';
                        $gradeLevel = 2;
                    } elseif (in_array($akr, ['terakreditasi sementara'])) {
                        $gradeClass = 'grade-amber';
                        $gradeLevel = 1;
                    }
                ?>
                <div class="col-md-6 col-lg-4 prodi-card-wrap animate-card"
                     data-delay="<?= $idx ?>"
                     data-nama="<?= htmlspecialchars(strtolower($p['nama_prodi'] ?? '')) ?>"
                     data-fakultas="<?= htmlspecialchars(strtolower($p['fakultas'] ?? '')) ?>"
                     data-akreditasi="<?= htmlspecialchars($akr) ?>">
                    <article class="prodi-card <?= $gradeClass ?>">
                        <!-- Accreditation Badge -->
                        <div class="prodi-card__badge">
                            <div class="grade-badge <?= $gradeClass ?>">
                                <div class="grade-badge__icon">
                                    <?php if ($gradeLevel >= 4): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/></svg>
                                    <?php elseif ($gradeLevel >= 2): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/><path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>
                                    <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/></svg>
                                    <?php endif; ?>
                                </div>
                                <div class="grade-badge__text">
                                    <span class="grade-badge__label">Akreditasi</span>
                                    <span class="grade-badge__value"><?= htmlspecialchars($akrDisplay) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="prodi-card__body">
                            <div class="prodi-card__fakultas"><?= htmlspecialchars($p['fakultas'] ?? 'Fakultas') ?></div>
                            <h3 class="prodi-card__title"><?= htmlspecialchars($p['nama_prodi'] ?? '-') ?></h3>
                            
                            <div class="prodi-card__info">
                                <div class="prodi-card__info-row">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/><path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/></svg>
                                    <span>Kode: <strong><?= htmlspecialchars($p['kode'] ?? '-') ?></strong></span>
                                </div>
                                <?php if (!empty($p['ketua_prodi'])): ?>
                                <div class="prodi-card__info-row">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/></svg>
                                    <span><?= htmlspecialchars($p['ketua_prodi']) ?></span>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Grade Level Indicator -->
                            <div class="prodi-card__level">
                                <div class="level-bar">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <div class="level-bar__dot <?= $i <= $gradeLevel ? 'active' : '' ?>"></div>
                                    <?php endfor; ?>
                                </div>
                                <span class="level-bar__text"><?= $gradeLevel > 0 ? 'Level ' . $gradeLevel . '/5' : 'Dalam Proses' ?></span>
                            </div>

                            <!-- Action -->
                            <div class="prodi-card__action">
                                <a href="<?= site_url('frontend/detail_prodi/' . ($p['id'] ?? '')) ?>" class="btn-prodi-detail">
                                    Lihat Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Empty State -->
        <div id="prodiEmpty" class="text-center py-5" style="<?= empty($prodi_list) ? '' : 'display:none;' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="text-muted mb-3" viewBox="0 0 16 16"><path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/><path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/></svg>
            <h5 class="text-muted">Tidak ada program studi ditemukan.</h5>
            <p class="small text-muted">Silakan coba filter lain atau periksa kembali nanti.</p>
        </div>
    </div>
</section>

<style>
/* ===== Program Studi Modern UI ===== */
.prodi-section { background: linear-gradient(180deg, #f8fafc 0%, #fff 100%); }

/* Header */
.prodi-header { padding-top: 1rem; }
.prodi-title { font-size: 2rem; font-weight: 700; color: #1e293b; margin-bottom: .5rem; }
.prodi-subtitle { color: #64748b; font-size: 1rem; max-width: 600px; margin: 0 auto 1rem; }
.prodi-divider { width: 60px; height: 4px; background: linear-gradient(90deg, #3b82f6, #8b5cf6); border-radius: 2px; margin: 0 auto; }

/* Stats Chips */
.prodi-stats { text-align: center; }
.stat-chip { display: inline-flex; align-items: center; gap: .5rem; padding: .5rem 1rem; border-radius: 999px; font-size: .875rem; }
.stat-chip__count { font-weight: 700; }
.stat-chip__label { font-weight: 500; }
.stat-chip--gold { background: #fef3c7; color: #92400e; }
.stat-chip--emerald { background: #d1fae5; color: #065f46; }
.stat-chip--blue { background: #dbeafe; color: #1e40af; }
.stat-chip--sky { background: #e0f2fe; color: #0369a1; }
.stat-chip--slate { background: #f1f5f9; color: #475569; }

/* Card */
.prodi-card {
    background: #fff;
    border-radius: 1rem;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: transform .25s ease, box-shadow .25s ease;
    position: relative;
}
.prodi-card:hover { transform: translateY(-6px); box-shadow: 0 12px 28px rgba(0,0,0,.1); }

/* Grade Colors */
.prodi-card.grade-gold { border-top: 4px solid #f59e0b; }
.prodi-card.grade-emerald { border-top: 4px solid #10b981; }
.prodi-card.grade-blue { border-top: 4px solid #3b82f6; }
.prodi-card.grade-sky { border-top: 4px solid #0ea5e9; }
.prodi-card.grade-amber { border-top: 4px solid #f59e0b; }
.prodi-card.grade-default { border-top: 4px solid #94a3b8; }

/* Badge */
.prodi-card__badge { padding: 1rem 1rem 0; }
.grade-badge { display: flex; align-items: center; gap: .75rem; padding: .75rem 1rem; border-radius: .75rem; }
.grade-badge.grade-gold { background: linear-gradient(135deg, #fef3c7, #fde68a); }
.grade-badge.grade-emerald { background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
.grade-badge.grade-blue { background: linear-gradient(135deg, #dbeafe, #bfdbfe); }
.grade-badge.grade-sky { background: linear-gradient(135deg, #e0f2fe, #bae6fd); }
.grade-badge.grade-amber { background: linear-gradient(135deg, #fef3c7, #fde68a); }
.grade-badge.grade-default { background: linear-gradient(135deg, #f1f5f9, #e2e8f0); }

.grade-badge__icon { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,.7); }
.grade-gold .grade-badge__icon { color: #b45309; }
.grade-emerald .grade-badge__icon { color: #047857; }
.grade-blue .grade-badge__icon { color: #1d4ed8; }
.grade-sky .grade-badge__icon { color: #0369a1; }
.grade-default .grade-badge__icon { color: #64748b; }

.grade-badge__text { display: flex; flex-direction: column; }
.grade-badge__label { font-size: .7rem; text-transform: uppercase; letter-spacing: .5px; opacity: .7; }
.grade-badge__value { font-size: 1rem; font-weight: 700; }
.grade-gold .grade-badge__value { color: #92400e; }
.grade-emerald .grade-badge__value { color: #065f46; }
.grade-blue .grade-badge__value { color: #1e40af; }
.grade-sky .grade-badge__value { color: #0c4a6e; }
.grade-default .grade-badge__value { color: #475569; }

/* Card Body */
.prodi-card__body { padding: 1rem 1rem 1.25rem; flex: 1; display: flex; flex-direction: column; }
.prodi-card__fakultas { font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: #64748b; font-weight: 600; margin-bottom: .25rem; }
.prodi-card__title { font-size: 1.1rem; font-weight: 600; color: #1e293b; margin: 0 0 .75rem; line-height: 1.35; }

.prodi-card__info { margin-bottom: .75rem; }
.prodi-card__info-row { display: flex; align-items: center; gap: .5rem; font-size: .8125rem; color: #64748b; margin-bottom: .35rem; }
.prodi-card__info-row svg { flex-shrink: 0; opacity: .7; }
.prodi-card__info-row strong { color: #334155; }

/* Level Bar */
.prodi-card__level { display: flex; align-items: center; gap: .75rem; margin-bottom: 1rem; margin-top: auto; }
.level-bar { display: flex; gap: 4px; }
.level-bar__dot { width: 8px; height: 8px; border-radius: 50%; background: #e2e8f0; transition: background .2s; }
.level-bar__dot.active { background: #3b82f6; }
.grade-gold .level-bar__dot.active { background: #f59e0b; }
.grade-emerald .level-bar__dot.active { background: #10b981; }
.grade-blue .level-bar__dot.active { background: #3b82f6; }
.grade-sky .level-bar__dot.active { background: #0ea5e9; }
.level-bar__text { font-size: .75rem; color: #94a3b8; }

/* Action Button */
.prodi-card__action { margin-top: auto; }
.btn-prodi-detail {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .5rem 1rem;
    font-size: .8125rem;
    font-weight: 600;
    color: #3b82f6;
    background: #eff6ff;
    border-radius: .5rem;
    text-decoration: none;
    transition: all .2s;
}
.btn-prodi-detail:hover { background: #3b82f6; color: #fff; }

/* Filters */
.prodi-filters .input-group-text { border-color: #e2e8f0; color: #94a3b8; }
.prodi-filters .form-control, .prodi-filters .form-select { border-color: #e2e8f0; }
.prodi-filters .form-control:focus, .prodi-filters .form-select:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.1); }

/* Animation */
@keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.animate-card { opacity: 0; transform: translateY(20px); }
.animate-card.is-visible { animation: fadeInUp .4s ease-out forwards; }

/* Responsive */
@media (max-width: 768px) {
    .prodi-title { font-size: 1.5rem; }
    .prodi-card__title { font-size: 1rem; }
}
</style>

<script>
(function () {
    var grid = document.getElementById('prodiGrid');
    var search = document.getElementById('prodiSearch');
    var akreditasiSel = document.getElementById('prodiAkreditasi');
    var fakultasSel = document.getElementById('prodiFakultas');
    var empty = document.getElementById('prodiEmpty');
    var cards = grid ? Array.from(grid.querySelectorAll('.prodi-card-wrap')) : [];

    // Intersection Observer for animations
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var delay = parseInt(entry.target.getAttribute('data-delay') || 0, 10);
                setTimeout(function() {
                    entry.target.classList.add('is-visible');
                }, delay * 60);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(function(card) { observer.observe(card); });

    function applyFilters() {
        var q = (search && search.value || '').trim().toLowerCase();
        var akr = (akreditasiSel && akreditasiSel.value || '').toLowerCase();
        var fak = (fakultasSel && fakultasSel.value || '').toLowerCase();
        var visibleCount = 0;

        cards.forEach(function (card) {
            var nama = card.getAttribute('data-nama') || '';
            var fakultas = card.getAttribute('data-fakultas') || '';
            var akreditasi = card.getAttribute('data-akreditasi') || '';

            var matchText = !q || nama.indexOf(q) !== -1 || fakultas.indexOf(q) !== -1;
            var matchAkr = !akr || akreditasi === akr;
            var matchFak = !fak || fakultas === fak;

            if (matchText && matchAkr && matchFak) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        empty.style.display = visibleCount === 0 ? '' : 'none';
    }

    if (search) search.addEventListener('input', applyFilters);
    if (akreditasiSel) akreditasiSel.addEventListener('change', applyFilters);
    if (fakultasSel) fakultasSel.addEventListener('change', applyFilters);

    // Initial
    if (cards.length === 0) empty.style.display = '';
})();
</script>


