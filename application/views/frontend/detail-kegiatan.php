<!-- Hero Section -->
<section class="hero-detail-section mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('kegiatan') ?>">Kegiatan</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($kegiatan['title'] ?? 'Detail') ?></li>
                    </ol>
                </nav>
                
                <div class="mb-3">
                    <?php if (!empty($kegiatan['category'])): ?>
                        <span class="badge bg-primary me-2"><?= htmlspecialchars($kegiatan['category']) ?></span>
                    <?php endif; ?>
                    
                    <?php
                    $status = $kegiatan['status'] ?? 'draft';
                    $statusBadges = [
                        'published' => '<span class="badge bg-info">Terjadwal</span>',
                        'completed' => '<span class="badge bg-success">Selesai</span>',
                        'cancelled' => '<span class="badge bg-danger">Dibatalkan</span>',
                        'draft' => '<span class="badge bg-secondary">Draft</span>'
                    ];
                    echo $statusBadges[$status] ?? '';
                    ?>
                </div>
                
                <h1 class="display-5 fw-bold mb-3"><?= htmlspecialchars($kegiatan['title']) ?></h1>
                
                <?php if (!empty($kegiatan['organizer'])): ?>
                    <p class="lead text-muted">
                        <i class="fas fa-building me-2"></i><?= htmlspecialchars($kegiatan['organizer']) ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content-section py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Column -->
            <div class="col-lg-8">
                
                <!-- Featured Image -->
                <?php if (!empty($kegiatan['image_url'])): ?>
                <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                    <img src="<?= base_url($kegiatan['image_url']) ?>" 
                         class="img-fluid w-100" 
                         alt="<?= htmlspecialchars($kegiatan['title']) ?>"
                         style="max-height: 480px; object-fit: cover;">
                </div>
                <?php endif; ?>

                <!-- Event Info Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="h5 text-primary mb-4">
                            <i class="fas fa-info-circle me-2"></i>Informasi Kegiatan
                        </h3>
                        
                        <div class="row g-4">
                            <?php if (!empty($kegiatan['start_date'])): ?>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="info-content">
                                        <small class="text-muted d-block">Tanggal Mulai</small>
                                        <strong><?= date('d F Y, H:i', strtotime($kegiatan['start_date'])) ?> <?= htmlspecialchars($kegiatan['timezone'] ?? 'WIB') ?></strong>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($kegiatan['end_date'])): ?>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <div class="info-content">
                                        <small class="text-muted d-block">Tanggal Selesai</small>
                                        <strong><?= date('d F Y, H:i', strtotime($kegiatan['end_date'])) ?> <?= htmlspecialchars($kegiatan['timezone'] ?? 'WIB') ?></strong>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($kegiatan['location'])): ?>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <small class="text-muted d-block">Lokasi</small>
                                        <strong><?= htmlspecialchars($kegiatan['location']) ?></strong>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($kegiatan['participants']) && $kegiatan['participants'] > 0): ?>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="info-content">
                                        <small class="text-muted d-block">Jumlah Peserta</small>
                                        <strong><?= number_format($kegiatan['participants']) ?> orang</strong>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="h5 text-primary mb-4">
                            <i class="fas fa-align-left me-2"></i>Deskripsi Kegiatan
                        </h3>
                        
                        <div class="activity-description">
                            <?php if (!empty($kegiatan['description'])): ?>
                                <?= nl2br(htmlspecialchars($kegiatan['description'])) ?>
                            <?php else: ?>
                                <p class="text-muted">Tidak ada deskripsi tersedia untuk kegiatan ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Document Download -->
                <?php if (!empty($kegiatan['document_url'])): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="h5 text-primary mb-3">
                            <i class="fas fa-file-download me-2"></i>Dokumen Kegiatan
                        </h3>
                        
                        <div class="d-grid gap-2">
                            <a href="<?= base_url($kegiatan['document_url']) ?>" 
                               target="_blank" 
                               class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-download me-2"></i>
                                Download Dokumen
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                
                <!-- Contact Person Card -->
                <?php if (!empty($kegiatan['contact_person']) || !empty($kegiatan['contact_phone'])): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="h6 text-primary mb-3">
                            <i class="fas fa-user-tie me-2"></i>Kontak Person
                        </h5>
                        
                        <?php if (!empty($kegiatan['contact_person'])): ?>
                            <p class="mb-2 fw-bold"><?= htmlspecialchars($kegiatan['contact_person']) ?></p>
                        <?php endif; ?>
                        
                        <?php if (!empty($kegiatan['organizer'])): ?>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-building me-2"></i><?= htmlspecialchars($kegiatan['organizer']) ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if (!empty($kegiatan['contact_phone'])): ?>
                            <p class="mb-0">
                                <a href="tel:<?= htmlspecialchars($kegiatan['contact_phone']) ?>" 
                                   class="text-decoration-none">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <?= htmlspecialchars($kegiatan['contact_phone']) ?>
                                </a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Quick Info Card -->
                <div class="card border-0 shadow-sm mb-4 bg-light">
                    <div class="card-body p-4">
                        <h5 class="h6 text-primary mb-3">
                            <i class="fas fa-info-circle me-2"></i>Ringkasan
                        </h5>
                        
                        <ul class="list-unstyled mb-0 quick-info-list">
                            <?php if (!empty($kegiatan['category'])): ?>
                            <li>
                                <i class="fas fa-tag text-primary"></i>
                                <div>
                                    <small class="text-muted d-block">Kategori</small>
                                    <strong><?= htmlspecialchars($kegiatan['category']) ?></strong>
                                </div>
                            </li>
                            <?php endif; ?>
                            
                            <li>
                                <i class="fas fa-flag text-primary"></i>
                                <div>
                                    <small class="text-muted d-block">Status</small>
                                    <strong>
                                        <?php
                                        $statusLabels = [
                                            'published' => 'Terjadwal',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Dibatalkan',
                                            'draft' => 'Draft'
                                        ];
                                        echo $statusLabels[$status] ?? ucfirst($status);
                                        ?>
                                    </strong>
                                </div>
                            </li>
                            
                            <?php if (!empty($kegiatan['created_at'])): ?>
                            <li>
                                <i class="fas fa-clock text-primary"></i>
                                <div>
                                    <small class="text-muted d-block">Dipublikasikan</small>
                                    <strong><?= date('d M Y', strtotime($kegiatan['created_at'])) ?></strong>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="h6 text-primary mb-3">
                            <i class="fas fa-bolt me-2"></i>Aksi Cepat
                        </h5>
                        
                        <div class="d-grid gap-2">
                            <?php if (!empty($kegiatan['document_url'])): ?>
                            <a href="<?= base_url($kegiatan['document_url']) ?>" 
                               target="_blank" 
                               class="btn btn-primary">
                                <i class="fas fa-download me-2"></i>Download Dokumen
                            </a>
                            <?php endif; ?>
                            
                            <button type="button" 
                                    class="btn btn-outline-secondary" 
                                    onclick="window.print()">
                                <i class="fas fa-print me-2"></i>Cetak
                            </button>
                            
                            <button type="button" 
                                    class="btn btn-outline-secondary" 
                                    onclick="shareActivity()">
                                <i class="fas fa-share-alt me-2"></i>Bagikan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Back to List -->
                <div class="d-grid">
                    <a href="<?= base_url('kegiatan') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Kegiatan
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
// Share functionality
function shareActivity() {
    const title = '<?= addslashes($kegiatan['title'] ?? '') ?>';
    const url = window.location.href;
    
    if (navigator.share) {
        navigator.share({
            title: title,
            text: 'Lihat kegiatan: ' + title,
            url: url
        }).catch((error) => {
            console.log('Error sharing:', error);
            fallbackCopy(url);
        });
    } else {
        fallbackCopy(url);
    }
}

function fallbackCopy(url) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            alert('Link berhasil disalin ke clipboard!');
        }).catch(() => {
            prompt('Salin link berikut:', url);
        });
    } else {
        prompt('Salin link berikut:', url);
    }
}
</script>

<style>
/* Hero Detail Section */
.hero-detail-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 0 2rem;
}

.hero-detail-section .breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.hero-detail-section .breadcrumb-item,
.hero-detail-section .breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
}

.hero-detail-section .breadcrumb-item.active {
    color: white;
}

.hero-detail-section .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.5);
}

.hero-detail-section h1 {
    color: white;
}

.hero-detail-section .badge {
    font-size: 0.85rem;
    padding: 0.4rem 0.8rem;
}

/* Info Items */
.info-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.info-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.info-icon i {
    font-size: 1.1rem;
}

.info-content {
    flex: 1;
}

.info-content small {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-content strong {
    color: #212529;
    font-size: 0.95rem;
}

/* Activity Description */
.activity-description {
    line-height: 1.8;
    color: #495057;
    font-size: 1rem;
}

.activity-description p:last-child {
    margin-bottom: 0;
}

/* Quick Info List */
.quick-info-list li {
    display: flex;
    gap: 1rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(0,0,0,.05);
}

.quick-info-list li:last-child {
    border-bottom: none;
}

.quick-info-list li i {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 0.25rem;
}

.quick-info-list li > div {
    flex: 1;
}

.quick-info-list small {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.quick-info-list strong {
    color: #212529;
    font-size: 0.9rem;
}

/* Cards */
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

/* Print Styles */
@media print {
    .breadcrumb,
    .btn,
    .card:has(.btn),
    nav,
    footer {
        display: none !important;
    }
    
    .hero-detail-section {
        background: white !important;
        color: black !important;
    }
    
    .hero-detail-section h1,
    .hero-detail-section p {
        color: black !important;
    }
    
    .col-lg-8,
    .col-lg-4 {
        width: 100% !important;
        max-width: 100% !important;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .hero-detail-section {
        padding: 2rem 0 1.5rem;
    }
    
    .hero-detail-section h1 {
        font-size: 1.75rem;
    }
    
    .info-item {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .info-icon {
        width: 36px;
        height: 36px;
    }
}
</style>
