<?php
// Status styling helper
$status = strtolower(trim($laporan->status ?? ''));
$statusStyles = [
    'published' => ['class' => 'status-published', 'label' => 'Published', 'icon' => '✓'],
    'draft' => ['class' => 'status-draft', 'label' => 'Draft', 'icon' => '✎'],
    'pending' => ['class' => 'status-pending', 'label' => 'Pending', 'icon' => '⏳'],
    'archived' => ['class' => 'status-archived', 'label' => 'Archived', 'icon' => '📁'],
    'review' => ['class' => 'status-review', 'label' => 'In Review', 'icon' => '👁'],
];
$statusStyle = $statusStyles[$status] ?? ['class' => 'status-default', 'label' => ucfirst($status ?: 'Unknown'), 'icon' => '•'];

// File info
$hasFile = !empty($laporan->file_path);
$fileExt = $hasFile ? strtolower(pathinfo($laporan->file_path, PATHINFO_EXTENSION)) : '';
$fileName = $hasFile ? basename($laporan->file_path) : '';
$filePath = $hasFile ? base_url($laporan->file_path) : '';

// File type info
$fileTypes = [
    'pdf' => ['label' => 'PDF Document', 'color' => 'pdf'],
    'doc' => ['label' => 'Word Document', 'color' => 'doc'],
    'docx' => ['label' => 'Word Document', 'color' => 'doc'],
    'xls' => ['label' => 'Excel Spreadsheet', 'color' => 'xls'],
    'xlsx' => ['label' => 'Excel Spreadsheet', 'color' => 'xls'],
    'ppt' => ['label' => 'PowerPoint', 'color' => 'ppt'],
    'pptx' => ['label' => 'PowerPoint', 'color' => 'ppt'],
];
$fileType = $fileTypes[$fileExt] ?? ['label' => strtoupper($fileExt) . ' File', 'color' => 'default'];
?>

<!-- Detail Laporan Modern UI -->
<section class="detail-laporan-section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="detail-breadcrumb">
            <a href="<?= site_url('data-laporan') ?>" class="breadcrumb-back">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                Kembali ke Daftar Laporan
            </a>
        </nav>

        <div class="detail-layout">
            <!-- Main Content -->
            <main class="detail-main">
                <!-- Header Card -->
                <article class="detail-card detail-card--header animate-fade">
                    <div class="detail-card__top">
                        <div class="detail-card__file-icon <?= $fileType['color'] ?>">
                            <?php if ($fileExt === 'pdf'): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/><path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029z"/></svg>
                            <?php elseif (in_array($fileExt, ['doc', 'docx'])): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/><path d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/></svg>
                            <?php elseif (in_array($fileExt, ['xls', 'xlsx'])): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/><path d="M3 9.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm2.5-4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 1 .5-.5zm3 0a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 1 .5-.5zm3 0a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 1 .5-.5z"/></svg>
                            <?php else: ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/></svg>
                            <?php endif; ?>
                        </div>
                        <span class="detail-card__status <?= $statusStyle['class'] ?>">
                            <?= $statusStyle['label'] ?>
                        </span>
                    </div>

                    <h1 class="detail-card__title"><?= htmlspecialchars($laporan->title ?? 'Untitled') ?></h1>

                    <div class="detail-card__meta">
                        <span class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                            Dibuat: <?= !empty($laporan->created_at) ? date('d F Y, H:i', strtotime($laporan->created_at)) : '-' ?>
                        </span>
                        <?php if (!empty($laporan->updated_at) && $laporan->updated_at !== $laporan->created_at): ?>
                        <span class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/><path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/></svg>
                            Diperbarui: <?= date('d F Y, H:i', strtotime($laporan->updated_at)) ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </article>

                <!-- Description Card -->
                <article class="detail-card animate-slide" style="--delay: 0.1s">
                    <div class="detail-card__header">
                        <div class="detail-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM11.5 3A1.5 1.5 0 0 0 10 4.5h4v-1l-2.5-2.5z"/></svg>
                        </div>
                        <h2 class="detail-card__heading">Deskripsi Laporan</h2>
                    </div>
                    <div class="detail-card__body">
                        <div class="detail-description">
                            <?php if (!empty($laporan->description)): ?>
                                <?= nl2br(htmlspecialchars($laporan->description)) ?>
                            <?php else: ?>
                                <p class="text-muted">Tidak ada deskripsi untuk laporan ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>

                <!-- File Preview Card (if PDF) -->
                <?php if ($hasFile && $fileExt === 'pdf'): ?>
                <article class="detail-card animate-slide" style="--delay: 0.2s">
                    <div class="detail-card__header">
                        <div class="detail-card__icon pdf">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg>
                        </div>
                        <h2 class="detail-card__heading">Pratinjau Dokumen</h2>
                        <a href="<?= $filePath ?>" target="_blank" class="preview-open-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg>
                            Buka di Tab Baru
                        </a>
                    </div>
                    <div class="detail-card__body p-0">
                        <div class="pdf-preview">
                            <iframe src="<?= $filePath ?>#toolbar=0" class="pdf-iframe" title="PDF Preview"></iframe>
                        </div>
                    </div>
                </article>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside class="detail-sidebar">
                <!-- Download Card -->
                <?php if ($hasFile): ?>
                <div class="sidebar-card animate-slide" style="--delay: 0.15s">
                    <div class="sidebar-card__header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/></svg>
                        <h3>Download File</h3>
                    </div>
                    <div class="sidebar-card__body">
                        <div class="file-info">
                            <div class="file-info__icon <?= $fileType['color'] ?>">
                                <?php if ($fileExt === 'pdf'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2z"/></svg>
                                <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5z"/></svg>
                                <?php endif; ?>
                            </div>
                            <div class="file-info__details">
                                <span class="file-info__name" title="<?= htmlspecialchars($fileName) ?>"><?= htmlspecialchars($fileName) ?></span>
                                <span class="file-info__type"><?= $fileType['label'] ?></span>
                            </div>
                        </div>
                        <a href="<?= $filePath ?>" class="btn-download-main" download>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/></svg>
                            Download Sekarang
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Info Card -->
                <div class="sidebar-card animate-slide" style="--delay: 0.25s">
                    <div class="sidebar-card__header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                        <h3>Informasi</h3>
                    </div>
                    <div class="sidebar-card__body">
                        <dl class="info-list">
                            <div class="info-list__row">
                                <dt>Status</dt>
                                <dd><span class="status-badge <?= $statusStyle['class'] ?>"><?= $statusStyle['label'] ?></span></dd>
                            </div>
                            <div class="info-list__row">
                                <dt>Tanggal Dibuat</dt>
                                <dd><?= !empty($laporan->created_at) ? date('d F Y', strtotime($laporan->created_at)) : '-' ?></dd>
                            </div>
                            <div class="info-list__row">
                                <dt>Terakhir Diperbarui</dt>
                                <dd><?= !empty($laporan->updated_at) ? date('d F Y', strtotime($laporan->updated_at)) : '-' ?></dd>
                            </div>
                            <?php if ($hasFile): ?>
                            <div class="info-list__row">
                                <dt>Tipe File</dt>
                                <dd><?= strtoupper($fileExt) ?></dd>
                            </div>
                            <?php endif; ?>
                        </dl>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="sidebar-card animate-slide" style="--delay: 0.35s">
                    <div class="sidebar-card__header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/></svg>
                        <h3>Tautan Cepat</h3>
                    </div>
                    <div class="sidebar-card__body">
                        <nav class="quick-links">
                            <a href="<?= site_url('data-laporan') ?>" class="quick-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5z"/></svg>
                                Semua Laporan
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-auto" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                            </a>
                            <a href="<?= site_url('dokumen-spmi') ?>" class="quick-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0z"/></svg>
                                Dokumen Lainnya
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-auto" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                            </a>
                            <a href="<?= site_url('data-program-studi') ?>" class="quick-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/></svg>
                                Program Studi
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-auto" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<style>
/* ===== Detail Laporan Modern UI ===== */
.detail-laporan-section {
    background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);
    min-height: calc(100vh - 200px);
    padding: 100px 0 5rem;
    flex: 1 0 auto;
}

/* Breadcrumb */
.detail-breadcrumb { margin-bottom: 1.5rem; }
.breadcrumb-back {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #64748b;
    text-decoration: none;
    font-size: .875rem;
    font-weight: 500;
    padding: .5rem 1rem;
    background: #fff;
    border-radius: .5rem;
    border: 1px solid #e2e8f0;
    transition: all .2s;
}
.breadcrumb-back:hover {
    color: #667eea;
    border-color: #667eea;
    background: #f8faff;
}

/* Layout */
.detail-layout {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 1.5rem;
    align-items: start;
}

/* Main Content */
.detail-main { display: flex; flex-direction: column; gap: 1.5rem; }

/* Cards */
.detail-card {
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
    overflow: hidden;
}
.detail-card--header {
    padding: 2rem;
    background: linear-gradient(135deg, #fff 0%, #f8faff 100%);
    border-top: 4px solid #667eea;
}
.detail-card__top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.25rem;
}
.detail-card__file-icon {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    border-radius: 1rem;
    color: #64748b;
}
.detail-card__file-icon.pdf { background: #fee2e2; color: #dc2626; }
.detail-card__file-icon.doc { background: #dbeafe; color: #2563eb; }
.detail-card__file-icon.xls { background: #d1fae5; color: #059669; }
.detail-card__file-icon.ppt { background: #ffedd5; color: #ea580c; }

.detail-card__status {
    padding: .35rem .875rem;
    font-size: .75rem;
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

.detail-card__title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 1rem;
    line-height: 1.3;
}
.detail-card__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.25rem;
}
.meta-item {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    color: #64748b;
    font-size: .875rem;
}
.meta-item svg { opacity: .7; }

.detail-card__header {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
}
.detail-card__icon {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    border-radius: .5rem;
    color: #64748b;
}
.detail-card__icon.pdf { background: #fee2e2; color: #dc2626; }
.detail-card__heading {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    flex: 1;
}
.preview-open-btn {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .4rem .75rem;
    font-size: .75rem;
    font-weight: 600;
    color: #667eea;
    background: #eff6ff;
    border-radius: .375rem;
    text-decoration: none;
    transition: all .2s;
}
.preview-open-btn:hover {
    background: #667eea;
    color: #fff;
}

.detail-card__body {
    padding: 1.5rem;
}
.detail-card__body.p-0 { padding: 0; }

.detail-description {
    color: #475569;
    line-height: 1.8;
    font-size: .9375rem;
}
.detail-description p { margin-bottom: 1rem; }
.detail-description p:last-child { margin-bottom: 0; }

/* PDF Preview */
.pdf-preview {
    background: #1e293b;
    min-height: 500px;
}
.pdf-iframe {
    width: 100%;
    height: 500px;
    border: none;
    display: block;
}

/* Sidebar */
.detail-sidebar { display: flex; flex-direction: column; gap: 1rem; }

.sidebar-card {
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
    overflow: hidden;
}
.sidebar-card__header {
    display: flex;
    align-items: center;
    gap: .625rem;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #f1f5f9;
    color: #64748b;
}
.sidebar-card__header h3 {
    font-size: .9375rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}
.sidebar-card__body {
    padding: 1.25rem;
}

/* File Info */
.file-info {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: 1rem;
    background: #f8fafc;
    border-radius: .75rem;
    margin-bottom: 1rem;
}
.file-info__icon {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: .5rem;
    color: #64748b;
}
.file-info__icon.pdf { color: #dc2626; }
.file-info__icon.doc { color: #2563eb; }
.file-info__icon.xls { color: #059669; }
.file-info__details {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
}
.file-info__name {
    font-size: .8125rem;
    font-weight: 600;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.file-info__type {
    font-size: .75rem;
    color: #64748b;
}

.btn-download-main {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    width: 100%;
    padding: .75rem 1rem;
    font-size: .875rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: .5rem;
    text-decoration: none;
    transition: all .2s;
}
.btn-download-main:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102,126,234,.4);
    color: #fff;
}

/* Info List */
.info-list { margin: 0; }
.info-list__row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: .625rem 0;
    border-bottom: 1px solid #f1f5f9;
}
.info-list__row:last-child { border-bottom: none; }
.info-list__row dt {
    font-size: .8125rem;
    color: #64748b;
    font-weight: 400;
}
.info-list__row dd {
    font-size: .8125rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}
.status-badge {
    padding: .2rem .5rem;
    font-size: .7rem;
    font-weight: 600;
    border-radius: 999px;
}

/* Quick Links */
.quick-links { display: flex; flex-direction: column; gap: .5rem; }
.quick-link {
    display: flex;
    align-items: center;
    gap: .625rem;
    padding: .75rem 1rem;
    background: #f8fafc;
    border-radius: .5rem;
    color: #475569;
    font-size: .8125rem;
    font-weight: 500;
    text-decoration: none;
    transition: all .2s;
}
.quick-link:hover {
    background: #eff6ff;
    color: #667eea;
}
.quick-link .ms-auto { margin-left: auto; }

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade { animation: fadeIn .5s ease forwards; }
.animate-slide {
    opacity: 0;
    animation: slideUp .5s ease forwards;
    animation-delay: var(--delay, 0s);
}

/* Responsive */
@media (max-width: 992px) {
    .detail-layout {
        grid-template-columns: 1fr;
    }
    .detail-sidebar {
        order: -1;
    }
}
@media (max-width: 768px) {
    .detail-card--header { padding: 1.5rem; }
    .detail-card__title { font-size: 1.375rem; }
    .detail-card__meta { gap: .75rem; }
    .pdf-iframe { height: 350px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Trigger animations on scroll
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-slide').forEach(function(el) {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
});
</script>
