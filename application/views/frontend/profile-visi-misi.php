<!-- Page Header -->
<section class="page-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 160px 0 100px;">
    <div class="container">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bold mb-3">Visi & Misi</h1>
            <p class="lead mb-0">Lembaga Penjaminan Mutu Politeknik Piksi Ganesha</p>            
        </div>
    </div>
    <!-- Wave decoration -->
    <div class="wave-bottom">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="width: 100%; height: 40px;">
            <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,58.7C960,64,1056,64,1152,58.7C1248,53,1344,43,1392,37.3L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="#f8f9fa"></path>
        </svg>
    </div>
</section>

<!-- Visi Misi Section -->
<section class="visi-misi-section py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row g-4 justify-content-center">
            
            <!-- Visi Card -->
            <?php if ($visi): ?>
            <div class="col-lg-6">
                <div class="visi-card h-100">
                    <div class="card-icon-wrapper">
                        <div class="card-icon visi-icon">
                            <span><?= $visi['icon'] ?? '👁️' ?></span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="card-title"><?= htmlspecialchars($visi['title']) ?></h2>
                        <div class="divider"></div>
                        <div class="card-text">
                            <?= $visi['content'] ?>
                        </div>
                    </div>
                    <div class="card-decoration">
                        <div class="decoration-circle circle-1"></div>
                        <div class="decoration-circle circle-2"></div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-lg-6">
                <div class="visi-card h-100">
                    <div class="card-icon-wrapper">
                        <div class="card-icon visi-icon">
                            <span>👁️</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="card-title">Visi</h2>
                        <div class="divider"></div>
                        <p class="text-muted fst-italic">Data visi belum tersedia.</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Misi Card -->
            <?php if ($misi): ?>
            <div class="col-lg-6">
                <div class="misi-card h-100">
                    <div class="card-icon-wrapper">
                        <div class="card-icon misi-icon">
                            <span><?= $misi['icon'] ?? '🎯' ?></span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="card-title"><?= htmlspecialchars($misi['title']) ?></h2>
                        <div class="divider divider-misi"></div>
                        <div class="card-text misi-content">
                            <?= $misi['content'] ?>
                        </div>
                    </div>
                    <div class="card-decoration">
                        <div class="decoration-circle circle-1 misi-circle"></div>
                        <div class="decoration-circle circle-2 misi-circle"></div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-lg-6">
                <div class="misi-card h-100">
                    <div class="card-icon-wrapper">
                        <div class="card-icon misi-icon">
                            <span>🎯</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="card-title">Misi</h2>
                        <div class="divider divider-misi"></div>
                        <p class="text-muted fst-italic">Data misi belum tersedia.</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
    </div>
</section>

<!-- Quote Section -->
<section class="quote-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="quote-card text-center">
                    <div class="quote-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/>
                        </svg>
                    </div>
                    <p class="quote-text">
                        Komitmen kami adalah mewujudkan budaya mutu yang berkelanjutan untuk menghasilkan lulusan yang kompeten dan berdaya saing.
                    </p>
                    <div class="quote-author">
                        <span>— Lembaga Penjaminan Mutu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="mb-4">Ingin Mengetahui Lebih Lanjut?</h3>
                <p class="text-muted mb-4">Pelajari lebih dalam tentang struktur organisasi dan kegiatan LPM Politeknik Piksi Ganesha</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="<?= base_url('profile/struktur-organisasi') ?>" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-sitemap me-2"></i>Struktur Organisasi
                    </a>
                    <a href="<?= base_url('kegiatan') ?>" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-calendar-alt me-2"></i>Kegiatan LPM
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Page Header */
.page-header {
    position: relative;
    overflow: hidden;
}

.wave-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    line-height: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
}

/* Visi Misi Cards */
.visi-card, .misi-card {
    background: white;
    border-radius: 24px;
    padding: 40px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
}

.visi-card:hover, .misi-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

.card-icon-wrapper {
    margin-bottom: 25px;
}

.card-icon {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.visi-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.misi-icon {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.card-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 15px;
}

.divider {
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
    margin-bottom: 20px;
}

.divider-misi {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.card-text {
    color: #555;
    line-height: 1.8;
    font-size: 16px;
}

.card-text p {
    margin-bottom: 0;
    font-style: italic;
}

.misi-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.misi-content ul li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 15px;
    line-height: 1.7;
}

.misi-content ul li::before {
    content: '✓';
    position: absolute;
    left: 0;
    top: 0;
    width: 22px;
    height: 22px;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}

.misi-content ul li:last-child {
    margin-bottom: 0;
}

/* Card Decorations */
.card-decoration {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
}

.decoration-circle {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
}

.circle-1 {
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    top: -100px;
    right: -100px;
}

.circle-2 {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    bottom: -50px;
    right: 30%;
}

.misi-circle {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
}

/* Quote Section */
.quote-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.quote-card {
    padding: 50px 40px;
}

.quote-icon {
    color: rgba(255,255,255,0.3);
    margin-bottom: 20px;
}

.quote-text {
    font-size: 24px;
    font-weight: 500;
    color: white;
    line-height: 1.6;
    margin-bottom: 20px;
}

.quote-author {
    color: rgba(255,255,255,0.8);
    font-size: 16px;
}

/* CTA Section */
.cta-section h3 {
    font-weight: 700;
    color: #1a1a2e;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 12px;
    padding: 14px 28px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.btn-outline-primary {
    border: 2px solid #667eea;
    color: #667eea;
    border-radius: 12px;
    padding: 12px 26px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: transparent;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 991.98px) {
    .visi-card, .misi-card {
        padding: 30px;
    }
    
    .card-icon {
        width: 70px;
        height: 70px;
        font-size: 32px;
    }
    
    .card-title {
        font-size: 24px;
    }
    
    .quote-text {
        font-size: 20px;
    }
}

@media (max-width: 575.98px) {
    .page-header {
        padding: 100px 0 50px;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .visi-card, .misi-card {
        padding: 25px;
    }
    
    .quote-card {
        padding: 30px 20px;
    }
    
    .quote-text {
        font-size: 18px;
    }
}
</style>
