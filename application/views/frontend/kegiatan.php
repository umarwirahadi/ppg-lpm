<!-- Page Header -->


<!-- Activities Content -->
<section class="content-section mt-5 pt-5">
    <div class="container">
        <!-- Header & Filters -->
        <div class="row mb-4 align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title mb-1">Agenda & Arsip Kegiatan</h2>
                <p class="text-muted small mb-0">Jelajahi daftar kegiatan LPM — cari, filter, lihat detail dan unduh dokumen terkait.</p>
            </div>
            <div class="col-lg-6 mt-3 mt-lg-0">
                <div class="d-flex gap-2 flex-wrap justify-content-lg-end">
                    <div class="input-group input-group-sm" style="max-width:320px;">
                        <span class="input-group-text bg-white border-end-0"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.442 1.398a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/></svg></span>
                        <input id="kegiatanSearch" class="form-control border-start-0" placeholder="Cari judul, lokasi, penyelenggara...">
                    </div>
                    <select id="kegiatanCategory" class="form-select form-select-sm" style="max-width:170px;">
                        <option value="">Semua Kategori</option>
                        <?php
                        $categories = [];
                        if (!empty($kegiatan_list) && is_array($kegiatan_list)) {
                            foreach ($kegiatan_list as $k) {
                                $cat = trim($k['category'] ?? '');
                                if ($cat && !in_array($cat, $categories)) $categories[] = $cat;
                            }
                            sort($categories);
                            foreach ($categories as $cat) {
                                echo '<option value="' . htmlspecialchars($cat) . '">' . htmlspecialchars($cat) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Cards Grid -->
        <div id="kegiatanGrid" class="row g-4">
            <?php if (!empty($kegiatan_list) && is_array($kegiatan_list)) : ?>
                <?php foreach ($kegiatan_list as $g) : ?>
                    <div class="col-sm-6 col-lg-4 kegiatan-card"
                         data-title="<?= htmlspecialchars(strtolower($g['title'] ?? '')) ?>"
                         data-location="<?= htmlspecialchars(strtolower($g['location'] ?? '')) ?>"
                         data-organizer="<?= htmlspecialchars(strtolower($g['organizer'] ?? '')) ?>"
                         data-category="<?= htmlspecialchars(strtolower($g['category'] ?? '')) ?>">
                        <article class="k-card h-100 d-flex flex-column">
                            <?php if (!empty($g['image_url'])) : ?>
                                <div class="k-cover" style="background-image:url('<?= base_url(htmlspecialchars($g['image_url'])) ?>')"></div>
                            <?php else : ?>
                                <div class="k-cover k-cover-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16"><path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/><path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/></svg>
                                </div>
                            <?php endif; ?>
                            <div class="k-card-body d-flex flex-column flex-grow-1">
                                <div class="k-card-header mb-2">
                                    <span class="k-category"><?= htmlspecialchars($g['category'] ?? 'Umum') ?></span>
                                    <?php
                                    $st = $g['status'] ?? '';
                                    $chipClass = $st === 'published' ? 'success' : ($st === 'completed' ? 'info' : ($st === 'cancelled' ? 'danger' : 'secondary'));
                                    $chipLabel = ucfirst($st ?: 'Draft');
                                    ?>
                                    <span class="k-chip <?= $chipClass ?>"><?= $chipLabel ?></span>
                                </div>
                                <h3 class="k-title"><?= htmlspecialchars($g['title'] ?? '-') ?></h3>
                                <p class="k-desc"><?= htmlspecialchars(mb_strimwidth($g['description'] ?? '', 0, 90, '...')) ?></p>
                                <div class="k-meta mt-auto">
                                    <div class="k-meta-row">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                                        <span><?= !empty($g['start_date']) ? date('d M Y', strtotime($g['start_date'])) : '-' ?></span>
                                    </div>
                                    <div class="k-meta-row">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                                        <span><?= htmlspecialchars($g['location'] ?? '-') ?></span>
                                    </div>
                                    <div class="k-meta-row">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/></svg>
                                        <span><?= htmlspecialchars($g['organizer'] ?? '-') ?></span>
                                    </div>
                                </div>
                                <div class="k-actions mt-3">
                                    <a href="<?= site_url('kegiatan/detail-kegiatan/' . ($g['id'] ?? '')) ?>" class="btn btn-sm btn-primary">Selengkapnya</a>
                                    <?php if (!empty($g['document_url'])) : ?>
                                        <a href="<?= base_url(htmlspecialchars($g['document_url'])) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/></svg>
                                            Unduh
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Empty State -->
        <div id="kegiatanEmpty" class="text-center py-5" style="<?= empty($kegiatan_list) ? '' : 'display:none;' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="text-muted mb-3" viewBox="0 0 16 16"><path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/><path d="M5 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5A.5.5 0 0 1 5 8zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 5 10z"/></svg>
            <h5 class="text-muted">Tidak ada kegiatan ditemukan.</h5>
            <p class="small text-muted">Silakan coba kata kunci lain atau periksa kembali nanti.</p>
        </div>

        <!-- Pagination -->
        <nav id="kegiatanPagination" class="mt-4" aria-label="Kegiatan pagination" style="<?= empty($kegiatan_list) ? 'display:none;' : '' ?>">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                <div class="pagination-info text-muted small">
                    Menampilkan <span id="paginationStart">1</span>–<span id="paginationEnd">6</span> dari <span id="paginationTotal">0</span> kegiatan
                </div>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item" id="pagePrev">
                        <a class="page-link" href="#" aria-label="Previous">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                        </a>
                    </li>
                    <li class="page-item" id="pageNumbers"></li>
                    <li class="page-item" id="pageNext">
                        <a class="page-link" href="#" aria-label="Next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</section>

<style>
/* Kegiatan modern card UI */
.section-title { font-size: 1.5rem; font-weight: 700; color: #212529; }

.k-card {
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    transition: transform .2s ease, box-shadow .2s ease;
}
.k-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,.10);
}

.k-cover {
    height: 180px;
    background-size: cover;
    background-position: center;
    background-color: #f8f9fa;
}
.k-cover-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #dee2e6;
}

.k-card-body { padding: 1.25rem; }

.k-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.k-category {
    font-size: .75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #6c757d;
}

.k-chip {
    display: inline-block;
    padding: .25rem .625rem;
    border-radius: 999px;
    font-size: .7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .3px;
}
.k-chip.success { background: #d1e7dd; color: #0f5132; }
.k-chip.secondary { background: #e2e3e5; color: #41464b; }
.k-chip.info { background: #cff4fc; color: #055160; }
.k-chip.danger { background: #f8d7da; color: #842029; }

.k-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin: .5rem 0;
    color: #212529;
    line-height: 1.35;
}

.k-desc {
    font-size: .875rem;
    color: #6c757d;
    margin-bottom: .75rem;
    line-height: 1.5;
}

.k-meta { font-size: .8125rem; color: #6c757d; }
.k-meta-row {
    display: flex;
    align-items: center;
    gap: .5rem;
    margin-bottom: .35rem;
}
.k-meta-row svg { flex-shrink: 0; opacity: .7; }

.k-actions {
    display: flex;
    gap: .5rem;
    flex-wrap: wrap;
}
.k-actions .btn { font-size: .8125rem; }

/* Filter bar */
.input-group-text { color: #6c757d; }
#kegiatanSearch:focus { box-shadow: none; border-color: #86b7fe; }

/* Pagination */
.pagination { gap: .25rem; }
.pagination .page-link {
    border-radius: .5rem;
    border: 1px solid #e2e8f0;
    color: #475569;
    padding: .5rem .75rem;
    font-size: .8125rem;
    transition: all .15s ease;
}
.pagination .page-link:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #1e293b;
}
.pagination .page-item.active .page-link {
    background: #3b82f6;
    border-color: #3b82f6;
    color: #fff;
}
.pagination .page-item.disabled .page-link {
    background: #f8fafc;
    border-color: #e2e8f0;
    color: #cbd5e1;
    cursor: not-allowed;
}
.pagination-info { font-size: .8125rem; }
#pageNumbers { display: contents; }
</style>

<script>
// Client-side instant search, category filter & pagination
(function () {
    var grid = document.getElementById('kegiatanGrid');
    var search = document.getElementById('kegiatanSearch');
    var catSel = document.getElementById('kegiatanCategory');
    var empty = document.getElementById('kegiatanEmpty');
    var pagination = document.getElementById('kegiatanPagination');
    var pageNumbers = document.getElementById('pageNumbers');
    var pagePrev = document.getElementById('pagePrev');
    var pageNext = document.getElementById('pageNext');
    var paginationStart = document.getElementById('paginationStart');
    var paginationEnd = document.getElementById('paginationEnd');
    var paginationTotal = document.getElementById('paginationTotal');
    
    var allCards = grid ? Array.from(grid.querySelectorAll('.kegiatan-card')) : [];
    var filteredCards = allCards.slice();
    var currentPage = 1;
    var perPage = 6;

    function getFilteredCards() {
        var q = (search && search.value || '').trim().toLowerCase();
        var cat = (catSel && catSel.value || '').toLowerCase();
        
        return allCards.filter(function (card) {
            var title = card.getAttribute('data-title') || '';
            var loc = card.getAttribute('data-location') || '';
            var org = card.getAttribute('data-organizer') || '';
            var catVal = card.getAttribute('data-category') || '';

            var matchText = !q || title.indexOf(q) !== -1 || loc.indexOf(q) !== -1 || org.indexOf(q) !== -1;
            var matchCat = !cat || catVal === cat;

            return matchText && matchCat;
        });
    }

    function getTotalPages() {
        return Math.ceil(filteredCards.length / perPage);
    }

    function renderPagination() {
        var totalPages = getTotalPages();
        var total = filteredCards.length;
        
        // Update info text
        var start = total === 0 ? 0 : (currentPage - 1) * perPage + 1;
        var end = Math.min(currentPage * perPage, total);
        paginationStart.textContent = start;
        paginationEnd.textContent = end;
        paginationTotal.textContent = total;

        // Show/hide pagination
        pagination.style.display = total <= perPage ? 'none' : '';

        // Prev button
        if (currentPage <= 1) {
            pagePrev.classList.add('disabled');
            pagePrev.querySelector('a').setAttribute('tabindex', '-1');
        } else {
            pagePrev.classList.remove('disabled');
            pagePrev.querySelector('a').removeAttribute('tabindex');
        }

        // Next button
        if (currentPage >= totalPages) {
            pageNext.classList.add('disabled');
            pageNext.querySelector('a').setAttribute('tabindex', '-1');
        } else {
            pageNext.classList.remove('disabled');
            pageNext.querySelector('a').removeAttribute('tabindex');
        }

        // Page numbers
        var html = '';
        var maxVisible = 5;
        var startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
        var endPage = Math.min(totalPages, startPage + maxVisible - 1);
        
        if (endPage - startPage < maxVisible - 1) {
            startPage = Math.max(1, endPage - maxVisible + 1);
        }

        if (startPage > 1) {
            html += '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
            if (startPage > 2) {
                html += '<li class="page-item disabled"><span class="page-link">…</span></li>';
            }
        }

        for (var i = startPage; i <= endPage; i++) {
            var activeClass = i === currentPage ? ' active' : '';
            html += '<li class="page-item' + activeClass + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                html += '<li class="page-item disabled"><span class="page-link">…</span></li>';
            }
            html += '<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">' + totalPages + '</a></li>';
        }

        pageNumbers.innerHTML = html;
    }

    function renderCards() {
        var startIdx = (currentPage - 1) * perPage;
        var endIdx = startIdx + perPage;

        allCards.forEach(function (card) {
            card.style.display = 'none';
        });

        filteredCards.slice(startIdx, endIdx).forEach(function (card) {
            card.style.display = '';
        });

        empty.style.display = filteredCards.length === 0 ? '' : 'none';
        renderPagination();
    }

    function applyFilters() {
        filteredCards = getFilteredCards();
        currentPage = 1;
        renderCards();
    }

    function goToPage(page) {
        var totalPages = getTotalPages();
        if (page < 1) page = 1;
        if (page > totalPages) page = totalPages;
        currentPage = page;
        renderCards();
        
        // Scroll to top of grid smoothly
        grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Event listeners
    if (search) search.addEventListener('input', applyFilters);
    if (catSel) catSel.addEventListener('change', applyFilters);

    pagePrev.querySelector('a').addEventListener('click', function (e) {
        e.preventDefault();
        if (currentPage > 1) goToPage(currentPage - 1);
    });

    pageNext.querySelector('a').addEventListener('click', function (e) {
        e.preventDefault();
        if (currentPage < getTotalPages()) goToPage(currentPage + 1);
    });

    pageNumbers.addEventListener('click', function (e) {
        if (e.target.tagName === 'A' && e.target.dataset.page) {
            e.preventDefault();
            goToPage(parseInt(e.target.dataset.page, 10));
        }
    });

    // Initial render
    applyFilters();
})();
</script>
