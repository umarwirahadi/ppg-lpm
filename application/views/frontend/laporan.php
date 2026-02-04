<?php
// Status styling helper
function get_status_style($status) {
    $status = strtolower(trim($status ?? ''));
    $styles = [
        'published' => ['class' => 'status-published', 'icon' => '✓', 'label' => 'Published'],
        'draft' => ['class' => 'status-draft', 'icon' => '✎', 'label' => 'Draft'],
        'pending' => ['class' => 'status-pending', 'icon' => '⏳', 'label' => 'Pending'],
        'archived' => ['class' => 'status-archived', 'icon' => '📁', 'label' => 'Archived'],
        'review' => ['class' => 'status-review', 'icon' => '👁', 'label' => 'In Review'],
    ];
    return $styles[$status] ?? ['class' => 'status-default', 'icon' => '•', 'label' => ucfirst($status ?: 'Unknown')];
}
?>

<!-- Laporan Modern UI -->
<section class="laporan-section">
    <div class="container">
        <!-- Header -->
        <div class="laporan-header">
            <div class="laporan-header__content">
                <h1 class="laporan-header__title">Laporan & Dokumen</h1>
                <p class="laporan-header__subtitle">Kumpulan laporan dan dokumen resmi Lembaga Penjaminan Mutu</p>
            </div>
            <div class="laporan-header__decoration">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/><path d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208zM6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/></svg>
            </div>
        </div>

        <!-- Filters -->
        <div class="laporan-filters">
            <div class="filter-group">
                <div class="search-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.442 1.398a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/></svg>
                    <input type="search" id="laporanSearch" placeholder="Cari laporan..." class="search-input">
                </div>
                <select id="laporanStatus" class="filter-select">
                    <option value="">Semua Status</option>
                    <option value="published">Published</option>
                    <option value="pending">Pending</option>
                    <option value="draft">Draft</option>
                    <option value="review">In Review</option>
                    <option value="archived">Archived</option>
                </select>
                <select id="laporanSort" class="filter-select">
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="title">Judul A-Z</option>
                </select>
            </div>
            <div class="view-toggle">
                <button type="button" class="view-btn active" data-view="grid" title="Grid View">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/></svg>
                </button>
                <button type="button" class="view-btn" data-view="list" title="List View">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/></svg>
                </button>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="laporan-stats">
            <?php
            $statusCounts = ['published' => 0, 'pending' => 0, 'draft' => 0, 'review' => 0, 'archived' => 0];
            if (!empty($laporan_list)) {
                foreach ($laporan_list as $l) {
                    $s = strtolower(trim($l->status ?? ''));
                    if (isset($statusCounts[$s])) $statusCounts[$s]++;
                }
            }
            ?>
            <div class="stat-item stat-item--total">
                <span class="stat-item__count"><?= count($laporan_list ?? []) ?></span>
                <span class="stat-item__label">Total Laporan</span>
            </div>
            <?php foreach ($statusCounts as $status => $count): if ($count > 0): $style = get_status_style($status); ?>
            <div class="stat-item stat-item--<?= $status ?>">
                <span class="stat-item__count"><?= $count ?></span>
                <span class="stat-item__label"><?= $style['label'] ?></span>
            </div>
            <?php endif; endforeach; ?>
        </div>

        <!-- Laporan Grid/List -->
        <div id="laporanContainer" class="laporan-grid">
            <?php if (!empty($laporan_list) && is_array($laporan_list)): ?>
                <?php foreach ($laporan_list as $idx => $laporan): 
                    $statusStyle = get_status_style($laporan->status);
                    $hasFile = !empty($laporan->file_path);
                    $fileExt = $hasFile ? strtolower(pathinfo($laporan->file_path, PATHINFO_EXTENSION)) : '';
                ?>
                <article class="laporan-card animate-card"
                         data-delay="<?= $idx ?>"
                         data-title="<?= htmlspecialchars(strtolower($laporan->title ?? '')) ?>"
                         data-status="<?= htmlspecialchars(strtolower($laporan->status ?? '')) ?>"
                         data-date="<?= strtotime($laporan->created_at ?? 'now') ?>">
                    
                    <!-- Card Header with File Type Icon -->
                    <div class="laporan-card__header">
                        <div class="laporan-card__file-icon <?= $fileExt ?>">
                            <?php if (in_array($fileExt, ['pdf'])): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/><path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029z"/></svg>
                            <?php elseif (in_array($fileExt, ['doc', 'docx'])): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/><path d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/></svg>
                            <?php elseif (in_array($fileExt, ['xls', 'xlsx'])): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/><path d="M3 9.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm2.5-4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 1 .5-.5zm3 0a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 1 .5-.5zm3 0a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 1 .5-.5z"/></svg>
                            <?php else: ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/></svg>
                            <?php endif; ?>
                        </div>
                        <span class="laporan-card__status <?= $statusStyle['class'] ?>">
                            <?= $statusStyle['label'] ?>
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="laporan-card__body">
                        <h3 class="laporan-card__title"><?= htmlspecialchars($laporan->title ?? 'Untitled') ?></h3>
                        <p class="laporan-card__desc"><?= htmlspecialchars(mb_strimwidth($laporan->description ?? '', 0, 120, '...')) ?></p>
                        
                        <div class="laporan-card__meta">
                            <span class="meta-date">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                                <?= !empty($laporan->created_at) ? date('d M Y', strtotime($laporan->created_at)) : '-' ?>
                            </span>
                            <?php if ($hasFile): ?>
                            <span class="meta-file">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/></svg>
                                <?= strtoupper($fileExt) ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="laporan-card__actions">
                        <a href="<?= site_url('frontend/detail_laporan/' . $laporan->id) ?>" class="btn-view">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg>
                            Detail
                        </a>
                        <?php if ($hasFile): ?>
                        <a href="<?= base_url('assets/documents/' . $laporan->file_path) ?>" class="btn-download" target="_blank" download>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/></svg>
                            Download
                        </a>
                        <?php endif; ?>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Empty State -->
        <div id="laporanEmpty" class="empty-state" style="<?= empty($laporan_list) ? '' : 'display:none;' ?>">
            <div class="empty-state__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/><path d="M5 6h6v1H5V6zm0 2h6v1H5V8zm0 2h3v1H5v-1z"/></svg>
            </div>
            <h3 class="empty-state__title">Tidak ada laporan ditemukan</h3>
            <p class="empty-state__text">Coba ubah filter pencarian atau periksa kembali nanti.</p>
        </div>

        <!-- Pagination -->
        <div id="laporanPagination" class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan <span id="showingStart">1</span>-<span id="showingEnd">6</span> dari <span id="totalItems"><?= count($laporan_list ?? []) ?></span> laporan
            </div>
            <div class="pagination-controls">
                <button type="button" id="prevPage" class="pagination-btn" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                </button>
                <div id="pageNumbers" class="page-numbers"></div>
                <button type="button" id="nextPage" class="pagination-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<style>
/* ===== Laporan Modern UI ===== */
.laporan-section {
    background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);
    min-height: calc(100vh - 200px);
    padding: 100px 0 5rem;
    flex: 1 0 auto;
}

/* Header */
.laporan-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem 2.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 1.25rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}
.laporan-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(255,255,255,.1) 0%, transparent 70%);
    border-radius: 50%;
}
.laporan-header__title {
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 .5rem;
}
.laporan-header__subtitle {
    color: rgba(255,255,255,.85);
    font-size: 1rem;
    margin: 0;
    max-width: 500px;
}
.laporan-header__decoration {
    color: rgba(255,255,255,.2);
    position: relative;
    z-index: 1;
}

/* Filters */
.laporan-filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding: 1rem 1.5rem;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
    border: 1px solid #e2e8f0;
}
.filter-group {
    display: flex;
    flex-wrap: wrap;
    gap: .75rem;
    flex: 1;
}
.search-box {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .5rem 1rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: .5rem;
    min-width: 250px;
    transition: border-color .2s, box-shadow .2s;
}
.search-box:focus-within {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102,126,234,.1);
}
.search-box svg { color: #94a3b8; flex-shrink: 0; }
.search-input {
    border: none;
    background: transparent;
    outline: none;
    font-size: .875rem;
    width: 100%;
    color: #334155;
}
.filter-select {
    padding: .5rem 2rem .5rem 1rem;
    background: #f8fafc url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E") no-repeat right .75rem center;
    border: 1px solid #e2e8f0;
    border-radius: .5rem;
    font-size: .875rem;
    color: #334155;
    cursor: pointer;
    appearance: none;
    transition: border-color .2s;
}
.filter-select:focus {
    outline: none;
    border-color: #667eea;
}
.view-toggle {
    display: flex;
    gap: .25rem;
    padding: .25rem;
    background: #f1f5f9;
    border-radius: .5rem;
}
.view-btn {
    padding: .5rem;
    background: transparent;
    border: none;
    border-radius: .375rem;
    color: #64748b;
    cursor: pointer;
    transition: all .2s;
}
.view-btn:hover { color: #334155; }
.view-btn.active {
    background: #fff;
    color: #667eea;
    box-shadow: 0 1px 3px rgba(0,0,0,.1);
}

/* Stats */
.laporan-stats {
    display: flex;
    flex-wrap: wrap;
    gap: .75rem;
    margin-bottom: 1.5rem;
}
.stat-item {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .5rem 1rem;
    background: #fff;
    border-radius: .5rem;
    border: 1px solid #e2e8f0;
    font-size: .875rem;
}
.stat-item__count { font-weight: 700; }
.stat-item__label { color: #64748b; }
.stat-item--total { background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; border: none; }
.stat-item--total .stat-item__label { color: rgba(255,255,255,.8); }
.stat-item--published { border-color: #10b981; }
.stat-item--published .stat-item__count { color: #059669; }
.stat-item--pending { border-color: #f59e0b; }
.stat-item--pending .stat-item__count { color: #d97706; }
.stat-item--draft { border-color: #64748b; }
.stat-item--draft .stat-item__count { color: #475569; }
.stat-item--review { border-color: #3b82f6; }
.stat-item--review .stat-item__count { color: #2563eb; }

/* Grid Layout */
.laporan-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
}
.laporan-grid.list-view {
    grid-template-columns: 1fr;
}
.laporan-grid.list-view .laporan-card {
    flex-direction: row;
    align-items: center;
}
.laporan-grid.list-view .laporan-card__header {
    flex-direction: column;
    padding: 1rem;
    border-bottom: none;
    border-right: 1px solid #f1f5f9;
    min-width: 100px;
}
.laporan-grid.list-view .laporan-card__body { flex: 1; }
.laporan-grid.list-view .laporan-card__actions {
    flex-direction: column;
    border-top: none;
    padding: 1rem;
}

/* Card */
.laporan-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
    overflow: hidden;
    transition: transform .25s ease, box-shadow .25s ease;
}
.laporan-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,.08);
}

.laporan-card__header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 1.25rem 1.25rem 1rem;
    border-bottom: 1px solid #f1f5f9;
}
.laporan-card__file-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    border-radius: .75rem;
    color: #64748b;
}
.laporan-card__file-icon.pdf { background: #fee2e2; color: #dc2626; }
.laporan-card__file-icon.doc, .laporan-card__file-icon.docx { background: #dbeafe; color: #2563eb; }
.laporan-card__file-icon.xls, .laporan-card__file-icon.xlsx { background: #d1fae5; color: #059669; }

.laporan-card__status {
    padding: .25rem .625rem;
    font-size: .7rem;
    font-weight: 600;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: .3px;
}
.status-published { background: #d1fae5; color: #065f46; }
.status-pending { background: #fef3c7; color: #92400e; }
.status-draft { background: #f1f5f9; color: #475569; }
.status-review { background: #dbeafe; color: #1e40af; }
.status-archived { background: #e2e8f0; color: #64748b; }
.status-default { background: #f1f5f9; color: #64748b; }

.laporan-card__body {
    padding: 1rem 1.25rem 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.laporan-card__title {
    font-size: 1.0625rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 .5rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.laporan-card__desc {
    font-size: .875rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0 0 1rem;
    flex: 1;
}
.laporan-card__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: .8125rem;
    color: #94a3b8;
}
.meta-date, .meta-file {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
}
.meta-file {
    padding: .2rem .5rem;
    background: #f1f5f9;
    border-radius: .25rem;
    font-weight: 600;
    font-size: .7rem;
}

.laporan-card__actions {
    display: flex;
    gap: .5rem;
    padding: 1rem 1.25rem;
    border-top: 1px solid #f1f5f9;
    background: #fafbfc;
}
.btn-view, .btn-download {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .4rem;
    padding: .5rem 1rem;
    font-size: .8125rem;
    font-weight: 600;
    border-radius: .5rem;
    text-decoration: none;
    transition: all .2s;
    flex: 1;
}
.btn-view {
    background: #667eea;
    color: #fff;
}
.btn-view:hover {
    background: #5a67d8;
    color: #fff;
}
.btn-download {
    background: #fff;
    color: #334155;
    border: 1px solid #e2e8f0;
}
.btn-download:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: #fff;
    border-radius: 1rem;
    border: 2px dashed #e2e8f0;
}
.empty-state__icon { color: #cbd5e1; margin-bottom: 1rem; }
.empty-state__title { font-size: 1.25rem; color: #475569; margin: 0 0 .5rem; }
.empty-state__text { color: #94a3b8; margin: 0; }

/* Pagination */
.pagination-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-top: 2rem;
    padding: 1rem 1.5rem;
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
}
.pagination-info {
    font-size: .875rem;
    color: #64748b;
}
.pagination-controls {
    display: flex;
    align-items: center;
    gap: .5rem;
}
.pagination-btn {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: .5rem;
    color: #475569;
    cursor: pointer;
    transition: all .2s;
}
.pagination-btn:hover:not(:disabled) {
    background: #667eea;
    border-color: #667eea;
    color: #fff;
}
.pagination-btn:disabled {
    opacity: .5;
    cursor: not-allowed;
}
.page-numbers {
    display: flex;
    gap: .25rem;
}
.page-num {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    border: none;
    border-radius: .5rem;
    font-size: .875rem;
    font-weight: 500;
    color: #475569;
    cursor: pointer;
    transition: all .2s;
}
.page-num:hover { background: #f1f5f9; }
.page-num.active {
    background: #667eea;
    color: #fff;
}

/* Animation */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-card {
    opacity: 0;
    transform: translateY(20px);
}
.animate-card.is-visible {
    animation: fadeInUp .4s ease-out forwards;
}

/* Responsive */
@media (max-width: 768px) {
    .laporan-header { flex-direction: column; text-align: center; padding: 1.5rem; }
    .laporan-header__decoration { display: none; }
    .laporan-header__title { font-size: 1.5rem; }
    .filter-group { width: 100%; }
    .search-box { min-width: 100%; }
    .laporan-grid { grid-template-columns: 1fr; }
    .pagination-wrapper { flex-direction: column; text-align: center; }
}
</style>

<script>
(function() {
    var container = document.getElementById('laporanContainer');
    var searchInput = document.getElementById('laporanSearch');
    var statusSelect = document.getElementById('laporanStatus');
    var sortSelect = document.getElementById('laporanSort');
    var emptyState = document.getElementById('laporanEmpty');
    var viewBtns = document.querySelectorAll('.view-btn');
    var cards = container ? Array.from(container.querySelectorAll('.laporan-card')) : [];
    
    // Pagination
    var itemsPerPage = 6;
    var currentPage = 1;
    var filteredCards = cards.slice();

    // Intersection Observer for animations
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var delay = parseInt(entry.target.getAttribute('data-delay') || 0, 10);
                setTimeout(function() {
                    entry.target.classList.add('is-visible');
                }, Math.min(delay * 50, 300));
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(function(card) { observer.observe(card); });

    // View Toggle
    viewBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            viewBtns.forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
            var view = btn.getAttribute('data-view');
            container.classList.toggle('list-view', view === 'list');
        });
    });

    // Filter & Sort
    function applyFilters() {
        var query = (searchInput.value || '').trim().toLowerCase();
        var status = (statusSelect.value || '').toLowerCase();
        var sort = sortSelect.value || 'newest';

        filteredCards = cards.filter(function(card) {
            var title = card.getAttribute('data-title') || '';
            var cardStatus = card.getAttribute('data-status') || '';
            var matchQuery = !query || title.indexOf(query) !== -1;
            var matchStatus = !status || cardStatus === status;
            return matchQuery && matchStatus;
        });

        // Sort
        filteredCards.sort(function(a, b) {
            if (sort === 'newest') {
                return parseInt(b.getAttribute('data-date')) - parseInt(a.getAttribute('data-date'));
            } else if (sort === 'oldest') {
                return parseInt(a.getAttribute('data-date')) - parseInt(b.getAttribute('data-date'));
            } else if (sort === 'title') {
                return (a.getAttribute('data-title') || '').localeCompare(b.getAttribute('data-title') || '');
            }
            return 0;
        });

        currentPage = 1;
        renderPage();
    }

    function renderPage() {
        var start = (currentPage - 1) * itemsPerPage;
        var end = start + itemsPerPage;
        var totalPages = Math.ceil(filteredCards.length / itemsPerPage);

        // Hide all cards first
        cards.forEach(function(card) { card.style.display = 'none'; });

        // Show filtered cards for current page
        filteredCards.slice(start, end).forEach(function(card, idx) {
            card.style.display = '';
            card.setAttribute('data-delay', idx);
            card.classList.remove('is-visible');
            observer.observe(card);
        });

        // Update pagination info
        document.getElementById('showingStart').textContent = filteredCards.length > 0 ? start + 1 : 0;
        document.getElementById('showingEnd').textContent = Math.min(end, filteredCards.length);
        document.getElementById('totalItems').textContent = filteredCards.length;

        // Update pagination buttons
        document.getElementById('prevPage').disabled = currentPage === 1;
        document.getElementById('nextPage').disabled = currentPage >= totalPages;

        // Render page numbers
        var pageNumbers = document.getElementById('pageNumbers');
        pageNumbers.innerHTML = '';
        for (var i = 1; i <= totalPages; i++) {
            var btn = document.createElement('button');
            btn.className = 'page-num' + (i === currentPage ? ' active' : '');
            btn.textContent = i;
            btn.setAttribute('data-page', i);
            btn.addEventListener('click', function() {
                currentPage = parseInt(this.getAttribute('data-page'));
                renderPage();
            });
            pageNumbers.appendChild(btn);
        }

        // Show/hide empty state
        emptyState.style.display = filteredCards.length === 0 ? '' : 'none';
        document.getElementById('laporanPagination').style.display = filteredCards.length === 0 ? 'none' : '';
    }

    // Event listeners
    searchInput.addEventListener('input', applyFilters);
    statusSelect.addEventListener('change', applyFilters);
    sortSelect.addEventListener('change', applyFilters);
    document.getElementById('prevPage').addEventListener('click', function() {
        if (currentPage > 1) { currentPage--; renderPage(); }
    });
    document.getElementById('nextPage').addEventListener('click', function() {
        var totalPages = Math.ceil(filteredCards.length / itemsPerPage);
        if (currentPage < totalPages) { currentPage++; renderPage(); }
    });

    // Initial render
    applyFilters();
})();
</script>
