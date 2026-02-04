<?php
// Determine grade level and styling
$akr = strtolower(trim($prodi['akreditasi'] ?? ''));
$akrDisplay = $prodi['akreditasi'] ?? '-';
$gradeClass = 'grade-default';
$gradeLevel = 0;
$gradeName = 'Dalam Proses';

if (in_array($akr, ['unggul', 'a'])) {
    $gradeClass = 'grade-gold';
    $gradeLevel = 5;
    $gradeName = 'Sangat Baik';
} elseif (in_array($akr, ['baik sekali'])) {
    $gradeClass = 'grade-emerald';
    $gradeLevel = 4;
    $gradeName = 'Baik Sekali';
} elseif (in_array($akr, ['baik', 'b'])) {
    $gradeClass = 'grade-blue';
    $gradeLevel = 3;
    $gradeName = 'Baik';
} elseif (in_array($akr, ['c'])) {
    $gradeClass = 'grade-sky';
    $gradeLevel = 2;
    $gradeName = 'Cukup';
} elseif (in_array($akr, ['terakreditasi sementara'])) {
    $gradeClass = 'grade-amber';
    $gradeLevel = 1;
    $gradeName = 'Sementara';
}

// Calculate accreditation status
$today = date('Y-m-d');
$endDate = $prodi['tgl_berakhir_akreditasi'] ?? null;
$isExpired = $endDate && $endDate < $today;
$isExpiringSoon = $endDate && !$isExpired && strtotime($endDate) < strtotime('+6 months');
?>

<!-- Detail Prodi Modern UI -->
<section class="detail-prodi-section py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="detail-breadcrumb mb-4">
            <a href="<?= site_url('data-program-studi') ?>" class="breadcrumb-back">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                Kembali ke Daftar Program Studi
            </a>
        </nav>

        <!-- Hero Header -->
        <div class="detail-hero <?= $gradeClass ?> animate-fade">
            <div class="detail-hero__content">
                <div class="detail-hero__badge">
                    <span class="badge-fakultas"><?= htmlspecialchars($prodi['fakultas'] ?? 'Fakultas') ?></span>
                </div>
                <h1 class="detail-hero__title"><?= htmlspecialchars($prodi['nama_prodi']) ?></h1>
                <div class="detail-hero__meta">
                    <span class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/><path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/></svg>
                        Kode: <?= htmlspecialchars($prodi['kode'] ?? '-') ?>
                    </span>
                </div>
            </div>
            <div class="detail-hero__grade">
                <div class="grade-circle <?= $gradeClass ?>">
                    <div class="grade-circle__icon">
                        <?php if ($gradeLevel >= 4): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/></svg>
                        <?php elseif ($gradeLevel >= 2): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/><path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>
                        <?php else: ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/></svg>
                        <?php endif; ?>
                    </div>
                    <div class="grade-circle__label">Akreditasi</div>
                    <div class="grade-circle__value"><?= htmlspecialchars($akrDisplay) ?></div>
                    <div class="grade-circle__level">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="level-dot <?= $i <= $gradeLevel ? 'active' : '' ?>"></span>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- General Info Card -->
                <div class="detail-card animate-slide" style="--delay: 0.1s">
                    <div class="detail-card__header">
                        <div class="detail-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                        </div>
                        <h2 class="detail-card__title">Informasi Umum</h2>
                    </div>
                    <div class="detail-card__body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/></svg>
                                </div>
                                <div class="info-item__content">
                                    <span class="info-item__label">Kode Program Studi</span>
                                    <span class="info-item__value"><?= htmlspecialchars($prodi['kode'] ?? '-') ?></span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg>
                                </div>
                                <div class="info-item__content">
                                    <span class="info-item__label">Ketua Program Studi</span>
                                    <span class="info-item__value"><?= htmlspecialchars($prodi['ketua_prodi'] ?? '-') ?></span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/></svg>
                                </div>
                                <div class="info-item__content">
                                    <span class="info-item__label">Sekretaris Program Studi</span>
                                    <span class="info-item__value"><?= htmlspecialchars($prodi['sekretaris_prodi'] ?? '-') ?></span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/></svg>
                                </div>
                                <div class="info-item__content">
                                    <span class="info-item__label">Fakultas</span>
                                    <span class="info-item__value"><?= htmlspecialchars($prodi['fakultas'] ?? '-') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accreditation Details Card -->
                <div class="detail-card animate-slide" style="--delay: 0.2s">
                    <div class="detail-card__header">
                        <div class="detail-card__icon <?= $gradeClass ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864z"/></svg>
                        </div>
                        <h2 class="detail-card__title">Detail Akreditasi</h2>
                        <?php if ($isExpired): ?>
                        <span class="status-badge status-badge--danger">Kedaluwarsa</span>
                        <?php elseif ($isExpiringSoon): ?>
                        <span class="status-badge status-badge--warning">Segera Berakhir</span>
                        <?php elseif ($gradeLevel > 0): ?>
                        <span class="status-badge status-badge--success">Aktif</span>
                        <?php endif; ?>
                    </div>
                    <div class="detail-card__body">
                        <div class="accreditation-detail">
                            <div class="accreditation-detail__main">
                                <div class="accr-badge <?= $gradeClass ?>">
                                    <span class="accr-badge__grade"><?= htmlspecialchars($akrDisplay) ?></span>
                                    <span class="accr-badge__label"><?= $gradeName ?></span>
                                </div>
                                <div class="accr-info">
                                    <div class="accr-info__row">
                                        <span class="accr-info__label">No. SK Akreditasi</span>
                                        <span class="accr-info__value"><?= htmlspecialchars($prodi['no_sk'] ?? '-') ?></span>
                                    </div>
                                    <div class="accr-info__row">
                                        <span class="accr-info__label">Tanggal Berlaku</span>
                                        <span class="accr-info__value"><?= !empty($prodi['tgl_berlaku_akreditasi']) ? date('d F Y', strtotime($prodi['tgl_berlaku_akreditasi'])) : '-' ?></span>
                                    </div>
                                    <div class="accr-info__row">
                                        <span class="accr-info__label">Tanggal Berakhir</span>
                                        <span class="accr-info__value <?= $isExpired ? 'text-danger' : ($isExpiringSoon ? 'text-warning' : '') ?>"><?= !empty($prodi['tgl_berakhir_akreditasi']) ? date('d F Y', strtotime($prodi['tgl_berakhir_akreditasi'])) : '-' ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($prodi['tgl_berlaku_akreditasi']) && !empty($prodi['tgl_berakhir_akreditasi'])): 
                                $start = strtotime($prodi['tgl_berlaku_akreditasi']);
                                $end = strtotime($prodi['tgl_berakhir_akreditasi']);
                                $now = time();
                                $total = $end - $start;
                                $elapsed = $now - $start;
                                $percent = $total > 0 ? min(100, max(0, ($elapsed / $total) * 100)) : 0;
                            ?>
                            <div class="accreditation-detail__timeline">
                                <div class="timeline-bar">
                                    <div class="timeline-bar__progress <?= $isExpired ? 'expired' : '' ?>" style="width: <?= $percent ?>%"></div>
                                </div>
                                <div class="timeline-labels">
                                    <span><?= date('M Y', $start) ?></span>
                                    <span><?= date('M Y', $end) ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="detail-card animate-slide" style="--delay: 0.3s">
                    <div class="detail-card__header">
                        <div class="detail-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM11.5 3A1.5 1.5 0 0 0 10 4.5h4v-1l-2.5-2.5z"/></svg>
                        </div>
                        <h2 class="detail-card__title">Keterangan</h2>
                    </div>
                    <div class="detail-card__body">
                        <div class="detail-description">
                            <?= !empty($prodi['keterangan']) ? $prodi['keterangan'] : '<p class="text-muted">Tidak ada keterangan tambahan untuk program studi ini.</p>' ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Stats -->
                <div class="detail-card detail-card--sidebar animate-slide" style="--delay: 0.15s">
                    <div class="detail-card__header">
                        <div class="detail-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5h-2v12h2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/></svg>
                        </div>
                        <h2 class="detail-card__title">Ringkasan</h2>
                    </div>
                    <div class="detail-card__body">
                        <div class="quick-stats">
                            <div class="quick-stat">
                                <div class="quick-stat__icon <?= $gradeClass ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73z"/></svg>
                                </div>
                                <div class="quick-stat__content">
                                    <span class="quick-stat__value"><?= htmlspecialchars($akrDisplay) ?></span>
                                    <span class="quick-stat__label">Akreditasi</span>
                                </div>
                            </div>
                            <div class="quick-stat">
                                <div class="quick-stat__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                                </div>
                                <div class="quick-stat__content">
                                    <span class="quick-stat__value"><?= $gradeLevel ?>/5</span>
                                    <span class="quick-stat__label">Level Mutu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Card -->
                <div class="detail-card detail-card--sidebar animate-slide" style="--delay: 0.25s">
                    <div class="detail-card__header">
                        <div class="detail-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/></svg>
                        </div>
                        <h2 class="detail-card__title">Kontak</h2>
                    </div>
                    <div class="detail-card__body">
                        <p class="text-muted small mb-3">Untuk informasi lebih lanjut terkait program studi, silakan hubungi pihak fakultas atau LPM.</p>
                        <a href="<?= site_url('contact') ?>" class="btn-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/></svg>
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                <!-- Related Actions -->
                <div class="detail-card detail-card--sidebar animate-slide" style="--delay: 0.35s">
                    <div class="detail-card__header">
                        <div class="detail-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5ZM3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.58 26.58 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.933.933 0 0 1-.765.935c-.845.147-2.34.346-4.235.346-1.895 0-3.39-.2-4.235-.346A.933.933 0 0 1 3 9.219V8.062Zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a24.767 24.767 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25.286 25.286 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135Z"/><path d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2V1.866ZM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5Z"/></svg>
                        </div>
                        <h2 class="detail-card__title">Dokumen Terkait</h2>
                    </div>
                    <div class="detail-card__body">
                        <a href="<?= site_url('data-dokumen') ?>" class="action-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/></svg>
                            Lihat Semua Dokumen
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-auto" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                        <a href="<?= site_url('data-program-studi') ?>" class="action-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/></svg>
                            Lihat Semua Program Studi
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-auto" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* ===== Detail Prodi Modern UI ===== */
.detail-prodi-section { 
    background: linear-gradient(180deg, #f8fafc 0%, #fff 100%); 
    min-height: calc(100vh - 200px); 
    padding-bottom: 5rem; 
    padding-top: 80px;
    flex: 1 0 auto;
    position: relative;
    z-index: 1;
}

/* Breadcrumb */
.detail-breadcrumb { padding-top: 1rem; }
.breadcrumb-back { display: inline-flex; align-items: center; gap: .5rem; color: #64748b; text-decoration: none; font-size: .875rem; font-weight: 500; transition: color .2s; }
.breadcrumb-back:hover { color: #3b82f6; }

/* Hero Section */
.detail-hero { display: flex; justify-content: space-between; align-items: center; gap: 2rem; background: #fff; border-radius: 1rem; padding: 2rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,.04); position: relative; overflow: hidden; }
.detail-hero::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; }
.detail-hero.grade-gold::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
.detail-hero.grade-emerald::before { background: linear-gradient(90deg, #10b981, #34d399); }
.detail-hero.grade-blue::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
.detail-hero.grade-sky::before { background: linear-gradient(90deg, #0ea5e9, #38bdf8); }
.detail-hero.grade-amber::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
.detail-hero.grade-default::before { background: linear-gradient(90deg, #94a3b8, #cbd5e1); }

.detail-hero__content { flex: 1; }
.badge-fakultas { display: inline-block; padding: .35rem .75rem; background: #f1f5f9; color: #475569; font-size: .75rem; font-weight: 600; border-radius: .375rem; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .5rem; }
.detail-hero__title { font-size: 1.75rem; font-weight: 700; color: #1e293b; margin: 0 0 .75rem; line-height: 1.3; }
.detail-hero__meta { display: flex; flex-wrap: wrap; gap: 1rem; }
.meta-item { display: inline-flex; align-items: center; gap: .4rem; color: #64748b; font-size: .875rem; }

/* Grade Circle */
.detail-hero__grade { flex-shrink: 0; }
.grade-circle { width: 140px; text-align: center; padding: 1.25rem; border-radius: 1rem; }
.grade-circle.grade-gold { background: linear-gradient(135deg, #fef3c7, #fde68a); }
.grade-circle.grade-emerald { background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
.grade-circle.grade-blue { background: linear-gradient(135deg, #dbeafe, #bfdbfe); }
.grade-circle.grade-sky { background: linear-gradient(135deg, #e0f2fe, #bae6fd); }
.grade-circle.grade-amber { background: linear-gradient(135deg, #fef3c7, #fde68a); }
.grade-circle.grade-default { background: linear-gradient(135deg, #f1f5f9, #e2e8f0); }

.grade-circle__icon { width: 56px; height: 56px; margin: 0 auto .5rem; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,.6); border-radius: 50%; }
.grade-gold .grade-circle__icon { color: #b45309; }
.grade-emerald .grade-circle__icon { color: #047857; }
.grade-blue .grade-circle__icon { color: #1d4ed8; }
.grade-sky .grade-circle__icon { color: #0369a1; }
.grade-default .grade-circle__icon { color: #64748b; }

.grade-circle__label { font-size: .7rem; text-transform: uppercase; letter-spacing: .5px; opacity: .7; display: block; }
.grade-circle__value { font-size: 1.25rem; font-weight: 700; display: block; margin-bottom: .5rem; }
.grade-gold .grade-circle__value { color: #92400e; }
.grade-emerald .grade-circle__value { color: #065f46; }
.grade-blue .grade-circle__value { color: #1e40af; }
.grade-sky .grade-circle__value { color: #0c4a6e; }
.grade-default .grade-circle__value { color: #475569; }

.grade-circle__level { display: flex; justify-content: center; gap: 4px; }
.level-dot { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,.5); }
.level-dot.active { background: currentColor; }
.grade-gold .level-dot.active { background: #f59e0b; }
.grade-emerald .level-dot.active { background: #10b981; }
.grade-blue .level-dot.active { background: #3b82f6; }
.grade-sky .level-dot.active { background: #0ea5e9; }

/* Cards */
.detail-card { background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,.04); margin-bottom: 1.5rem; overflow: hidden; }
.detail-card--sidebar { margin-bottom: 1rem; }
.detail-card__header { display: flex; align-items: center; gap: .75rem; padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; }
.detail-card__icon { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; background: #f1f5f9; border-radius: .5rem; color: #64748b; }
.detail-card__icon.grade-gold { background: #fef3c7; color: #b45309; }
.detail-card__icon.grade-emerald { background: #d1fae5; color: #047857; }
.detail-card__icon.grade-blue { background: #dbeafe; color: #1d4ed8; }
.detail-card__icon.grade-sky { background: #e0f2fe; color: #0369a1; }
.detail-card__title { font-size: 1rem; font-weight: 600; color: #1e293b; margin: 0; flex: 1; }
.detail-card__body { padding: 1.25rem; }

/* Status Badge */
.status-badge { padding: .25rem .625rem; font-size: .7rem; font-weight: 600; border-radius: 999px; text-transform: uppercase; letter-spacing: .3px; }
.status-badge--success { background: #d1fae5; color: #065f46; }
.status-badge--warning { background: #fef3c7; color: #92400e; }
.status-badge--danger { background: #fee2e2; color: #991b1b; }

/* Info Grid */
.info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
.info-item { display: flex; gap: .75rem; padding: 1rem; background: #f8fafc; border-radius: .75rem; }
.info-item__icon { width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #fff; border-radius: .5rem; color: #64748b; flex-shrink: 0; }
.info-item__content { display: flex; flex-direction: column; min-width: 0; }
.info-item__label { font-size: .7rem; color: #94a3b8; text-transform: uppercase; letter-spacing: .3px; }
.info-item__value { font-size: .875rem; font-weight: 600; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

/* Accreditation Detail */
.accreditation-detail__main { display: flex; gap: 1.5rem; align-items: flex-start; }
.accr-badge { padding: 1rem 1.5rem; border-radius: .75rem; text-align: center; min-width: 100px; }
.accr-badge.grade-gold { background: linear-gradient(135deg, #fef3c7, #fde68a); }
.accr-badge.grade-emerald { background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
.accr-badge.grade-blue { background: linear-gradient(135deg, #dbeafe, #bfdbfe); }
.accr-badge.grade-sky { background: linear-gradient(135deg, #e0f2fe, #bae6fd); }
.accr-badge.grade-default { background: linear-gradient(135deg, #f1f5f9, #e2e8f0); }
.accr-badge__grade { display: block; font-size: 1.5rem; font-weight: 700; }
.accr-badge__label { display: block; font-size: .7rem; text-transform: uppercase; letter-spacing: .3px; opacity: .8; }
.grade-gold .accr-badge__grade { color: #92400e; }
.grade-emerald .accr-badge__grade { color: #065f46; }
.grade-blue .accr-badge__grade { color: #1e40af; }
.grade-sky .accr-badge__grade { color: #0c4a6e; }
.grade-default .accr-badge__grade { color: #475569; }

.accr-info { flex: 1; }
.accr-info__row { display: flex; justify-content: space-between; padding: .5rem 0; border-bottom: 1px solid #f1f5f9; }
.accr-info__row:last-child { border-bottom: none; }
.accr-info__label { color: #64748b; font-size: .8125rem; }
.accr-info__value { font-weight: 600; color: #1e293b; font-size: .8125rem; }

/* Timeline */
.accreditation-detail__timeline { margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #f1f5f9; }
.timeline-bar { height: 8px; background: #e2e8f0; border-radius: 4px; overflow: hidden; }
.timeline-bar__progress { height: 100%; background: linear-gradient(90deg, #3b82f6, #60a5fa); border-radius: 4px; transition: width .5s ease; }
.timeline-bar__progress.expired { background: linear-gradient(90deg, #ef4444, #f87171); }
.timeline-labels { display: flex; justify-content: space-between; margin-top: .5rem; font-size: .75rem; color: #94a3b8; }

/* Description */
.detail-description { color: #475569; line-height: 1.7; font-size: .9375rem; }
.detail-description p { margin-bottom: 1rem; }
.detail-description p:last-child { margin-bottom: 0; }

/* Quick Stats */
.quick-stats { display: flex; flex-direction: column; gap: .75rem; }
.quick-stat { display: flex; align-items: center; gap: .75rem; padding: .75rem; background: #f8fafc; border-radius: .5rem; }
.quick-stat__icon { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; background: #fff; border-radius: .5rem; color: #64748b; }
.quick-stat__icon.grade-gold { color: #f59e0b; }
.quick-stat__icon.grade-emerald { color: #10b981; }
.quick-stat__icon.grade-blue { color: #3b82f6; }
.quick-stat__content { display: flex; flex-direction: column; }
.quick-stat__value { font-size: 1rem; font-weight: 700; color: #1e293b; }
.quick-stat__label { font-size: .7rem; color: #94a3b8; text-transform: uppercase; letter-spacing: .3px; }

/* Buttons */
.btn-contact { display: inline-flex; align-items: center; gap: .5rem; padding: .625rem 1rem; background: #3b82f6; color: #fff; border-radius: .5rem; font-size: .8125rem; font-weight: 600; text-decoration: none; transition: background .2s; }
.btn-contact:hover { background: #2563eb; color: #fff; }

/* Action Links */
.action-link { display: flex; align-items: center; gap: .625rem; padding: .75rem; background: #f8fafc; border-radius: .5rem; color: #475569; font-size: .8125rem; font-weight: 500; text-decoration: none; margin-bottom: .5rem; transition: all .2s; }
.action-link:last-child { margin-bottom: 0; }
.action-link:hover { background: #eff6ff; color: #3b82f6; }

/* Animations */
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.animate-fade { animation: fadeIn .5s ease forwards; }
.animate-slide { opacity: 0; animation: slideUp .5s ease forwards; animation-delay: var(--delay, 0s); }

/* Responsive */
@media (max-width: 991px) {
    .detail-hero { flex-direction: column; text-align: center; }
    .detail-hero__meta { justify-content: center; }
    .info-grid { grid-template-columns: 1fr; }
    .accreditation-detail__main { flex-direction: column; align-items: center; text-align: center; }
    .accr-info__row { flex-direction: column; gap: .25rem; text-align: left; }
}
@media (max-width: 768px) {
    .detail-hero__title { font-size: 1.375rem; }
    .grade-circle { width: 120px; padding: 1rem; }
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
