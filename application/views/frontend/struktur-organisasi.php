<!-- Hero Section -->
<section class="hero-section bg-gradient-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">Struktur Organisasi</h1>
                <p class="lead mb-4">
                    Tim profesional Lembaga Penjaminan Mutu Politeknik Piksi Ganesha yang berkomitmen 
                    untuk memastikan kualitas pendidikan tinggi yang berkelanjutan.
                </p>
                <div class="d-flex gap-3">
                    <span class="badge bg-light text-dark px-3 py-2">
                        <i class="fas fa-users me-2"></i>Tim Profesional
                    </span>
                    <span class="badge bg-light text-dark px-3 py-2">
                        <i class="fas fa-award me-2"></i>Berpengalaman
                    </span>
                    <span class="badge bg-light text-dark px-3 py-2">
                        <i class="fas fa-graduation-cap me-2"></i>Berkualitas Tinggi
                    </span>
                </div>
            </div>
            <div class="col-lg-4 text-end">
                <div class="hero-icon">
                    <i class="fas fa-sitemap fa-8x opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Organizational Structure -->
<section class="py-5">
    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-5">
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100 text-center bg-gradient-primary text-white">
                    <div class="card-body">
                        <i class="fas fa-crown fa-3x mb-3 opacity-75"></i>
                        <h3 class="mb-1">
                            <?= isset($struktur_data['direktur']) ? count($struktur_data['direktur']) : 0 ?>
                        </h3>
                        <p class="mb-0">Direktur</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100 text-center bg-gradient-success text-white">
                    <div class="card-body">
                        <i class="fas fa-user-tie fa-3x mb-3 opacity-75"></i>
                        <h3 class="mb-1">
                            <?= isset($struktur_data['manajer']) ? count($struktur_data['manajer']) : 0 ?>
                        </h3>
                        <p class="mb-0">Manajer</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100 text-center bg-gradient-info text-white">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-3 opacity-75"></i>
                        <h3 class="mb-1">
                            <?= isset($struktur_data['staff']) ? count($struktur_data['staff']) : 0 ?>
                        </h3>
                        <p class="mb-0">Staff</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100 text-center bg-gradient-warning text-white">
                    <div class="card-body">
                        <i class="fas fa-user-cog fa-3x mb-3 opacity-75"></i>
                        <h3 class="mb-1">
                            <?= isset($struktur_data['admin']) ? count($struktur_data['admin']) : 0 ?>
                        </h3>
                        <p class="mb-0">Admin</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Direktur Section -->
        <?php if (isset($struktur_data['direktur']) && !empty($struktur_data['direktur'])): ?>
        <div class="mb-5">
            <div class="text-center mb-4">
                <h2 class="section-title fw-bold text-primary">
                    <i class="fas fa-crown me-2"></i>Pimpinan
                </h2>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="row justify-content-center">
                <?php foreach ($struktur_data['direktur'] as $direktur): ?>
                <div class="col-lg-6 col-md-8 mb-4">
                    <div class="card border-0 shadow-lg h-100 overflow-hidden position-relative">
                        <!-- Background Pattern -->
                        <div class="position-absolute top-0 end-0 opacity-10">
                            <i class="fas fa-crown fa-5x text-primary"></i>
                        </div>
                        
                        <div class="card-body text-center position-relative">
                            <!-- Photo -->
                            <div class="position-relative mb-3">
                                <div class="photo-wrapper mx-auto">
                                    <?php if (!empty($direktur['foto'])): ?>
                                        <img src="<?= base_url('assets/img/struktur/' . $direktur['foto']) ?>" 
                                             alt="<?= htmlspecialchars($direktur['nama']) ?>"
                                             class="profile-photo">
                                    <?php else: ?>
                                        <div class="profile-photo-placeholder">
                                            <i class="fas fa-user fa-4x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="position-absolute top-0 end-0">
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="fas fa-crown me-1"></i>Pimpinan
                                    </span>
                                </div>
                            </div>

                            <!-- Info -->
                            <h4 class="fw-bold text-primary mb-2"><?= htmlspecialchars($direktur['nama']) ?></h4>
                            <h5 class="text-secondary mb-3"><?= htmlspecialchars($direktur['jabatan']) ?></h5>
                            
                            <!-- Education -->
                            <?php if (!empty($direktur['pendidikan_terakhir'])): ?>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-graduation-cap me-1"></i><?= htmlspecialchars($direktur['pendidikan_terakhir']) ?>
                                </span>
                            </div>
                            <?php endif; ?>

                            <!-- Description -->
                            <?php if (!empty($direktur['deskripsi'])): ?>
                            <p class="text-muted small mb-3"><?= htmlspecialchars($direktur['deskripsi']) ?></p>
                            <?php endif; ?>

                            <!-- Contact -->
                            <div class="contact-info">
                                <?php if (!empty($direktur['email'])): ?>
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    <a href="mailto:<?= $direktur['email'] ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($direktur['email']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($direktur['telepon'])): ?>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <a href="tel:<?= $direktur['telepon'] ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($direktur['telepon']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Manajer Section -->
        <?php if (isset($struktur_data['manajer']) && !empty($struktur_data['manajer'])): ?>
        <div class="mb-5">
            <div class="text-center mb-4">
                <h2 class="section-title fw-bold text-success">
                    <i class="fas fa-user-tie me-2"></i>Manajer
                </h2>
                <div class="section-divider mx-auto bg-success"></div>
            </div>
            <div class="row">
                <?php foreach ($struktur_data['manajer'] as $manajer): ?>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow h-100 overflow-hidden position-relative">
                        <!-- Background Pattern -->
                        <div class="position-absolute top-0 end-0 opacity-10">
                            <i class="fas fa-user-tie fa-4x text-success"></i>
                        </div>
                        
                        <div class="card-body text-center position-relative">
                            <!-- Photo -->
                            <div class="position-relative mb-3">
                                <div class="photo-wrapper-sm mx-auto">
                                    <?php if (!empty($manajer['foto'])): ?>
                                        <img src="<?= base_url('assets/img/struktur/' . $manajer['foto']) ?>" 
                                             alt="<?= htmlspecialchars($manajer['nama']) ?>"
                                             class="profile-photo-sm">
                                    <?php else: ?>
                                        <div class="profile-photo-placeholder-sm">
                                            <i class="fas fa-user fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="position-absolute top-0 end-0">
                                    <span class="badge bg-success rounded-pill px-2 py-1">
                                        <small><i class="fas fa-user-tie me-1"></i>Manajer</small>
                                    </span>
                                </div>
                            </div>

                            <!-- Info -->
                            <h5 class="fw-bold text-success mb-2"><?= htmlspecialchars($manajer['nama']) ?></h5>
                            <h6 class="text-secondary mb-3"><?= htmlspecialchars($manajer['jabatan']) ?></h6>
                            
                            <!-- Education -->
                            <?php if (!empty($manajer['pendidikan_terakhir'])): ?>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark small">
                                    <i class="fas fa-graduation-cap me-1"></i><?= htmlspecialchars($manajer['pendidikan_terakhir']) ?>
                                </span>
                            </div>
                            <?php endif; ?>

                            <!-- Description -->
                            <?php if (!empty($manajer['deskripsi'])): ?>
                            <p class="text-muted small mb-3"><?= substr(htmlspecialchars($manajer['deskripsi']), 0, 120) ?>...</p>
                            <?php endif; ?>

                            <!-- Contact -->
                            <div class="contact-info small">
                                <?php if (!empty($manajer['email'])): ?>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <i class="fas fa-envelope text-success me-2"></i>
                                    <a href="mailto:<?= $manajer['email'] ?>" class="text-decoration-none small">
                                        <?= htmlspecialchars($manajer['email']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($manajer['telepon'])): ?>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-phone text-success me-2"></i>
                                    <a href="tel:<?= $manajer['telepon'] ?>" class="text-decoration-none small">
                                        <?= htmlspecialchars($manajer['telepon']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Staff Section -->
        <?php if (isset($struktur_data['staff']) && !empty($struktur_data['staff'])): ?>
        <div class="mb-5">
            <div class="text-center mb-4">
                <h2 class="section-title fw-bold text-info">
                    <i class="fas fa-users me-2"></i>Staff
                </h2>
                <div class="section-divider mx-auto bg-info"></div>
            </div>
            <div class="row">
                <?php foreach ($struktur_data['staff'] as $staff): ?>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow h-100 overflow-hidden position-relative">
                        <!-- Background Pattern -->
                        <div class="position-absolute top-0 end-0 opacity-10">
                            <i class="fas fa-users fa-4x text-info"></i>
                        </div>
                        
                        <div class="card-body text-center position-relative">
                            <!-- Photo -->
                            <div class="position-relative mb-3">
                                <div class="photo-wrapper-sm mx-auto">
                                    <?php if (!empty($staff['foto'])): ?>
                                        <img src="<?= base_url('assets/img/struktur/' . $staff['foto']) ?>" 
                                             alt="<?= htmlspecialchars($staff['nama']) ?>"
                                             class="profile-photo-sm">
                                    <?php else: ?>
                                        <div class="profile-photo-placeholder-sm">
                                            <i class="fas fa-user fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="position-absolute top-0 end-0">
                                    <span class="badge bg-info rounded-pill px-2 py-1">
                                        <small><i class="fas fa-users me-1"></i>Staff</small>
                                    </span>
                                </div>
                            </div>

                            <!-- Info -->
                            <h5 class="fw-bold text-info mb-2"><?= htmlspecialchars($staff['nama']) ?></h5>
                            <h6 class="text-secondary mb-3"><?= htmlspecialchars($staff['jabatan']) ?></h6>
                            
                            <!-- Education -->
                            <?php if (!empty($staff['pendidikan_terakhir'])): ?>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark small">
                                    <i class="fas fa-graduation-cap me-1"></i><?= htmlspecialchars($staff['pendidikan_terakhir']) ?>
                                </span>
                            </div>
                            <?php endif; ?>

                            <!-- Description -->
                            <?php if (!empty($staff['deskripsi'])): ?>
                            <p class="text-muted small mb-3"><?= substr(htmlspecialchars($staff['deskripsi']), 0, 120) ?>...</p>
                            <?php endif; ?>

                            <!-- Contact -->
                            <div class="contact-info small">
                                <?php if (!empty($staff['email'])): ?>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <i class="fas fa-envelope text-info me-2"></i>
                                    <a href="mailto:<?= $staff['email'] ?>" class="text-decoration-none small">
                                        <?= htmlspecialchars($staff['email']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($staff['telepon'])): ?>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-phone text-info me-2"></i>
                                    <a href="tel:<?= $staff['telepon'] ?>" class="text-decoration-none small">
                                        <?= htmlspecialchars($staff['telepon']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Admin Section -->
        <?php if (isset($struktur_data['admin']) && !empty($struktur_data['admin'])): ?>
        <div class="mb-5">
            <div class="text-center mb-4">
                <h2 class="section-title fw-bold text-warning">
                    <i class="fas fa-user-cog me-2"></i>Administrasi
                </h2>
                <div class="section-divider mx-auto bg-warning"></div>
            </div>
            <div class="row">
                <?php foreach ($struktur_data['admin'] as $admin): ?>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow h-100 overflow-hidden position-relative">
                        <!-- Background Pattern -->
                        <div class="position-absolute top-0 end-0 opacity-10">
                            <i class="fas fa-user-cog fa-4x text-warning"></i>
                        </div>
                        
                        <div class="card-body text-center position-relative">
                            <!-- Photo -->
                            <div class="position-relative mb-3">
                                <div class="photo-wrapper-sm mx-auto">
                                    <?php if (!empty($admin['foto'])): ?>
                                        <img src="<?= base_url('assets/img/struktur/' . $admin['foto']) ?>" 
                                             alt="<?= htmlspecialchars($admin['nama']) ?>"
                                             class="profile-photo-sm">
                                    <?php else: ?>
                                        <div class="profile-photo-placeholder-sm">
                                            <i class="fas fa-user fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="position-absolute top-0 end-0">
                                    <span class="badge bg-warning text-dark rounded-pill px-2 py-1">
                                        <small><i class="fas fa-user-cog me-1"></i>Admin</small>
                                    </span>
                                </div>
                            </div>

                            <!-- Info -->
                            <h5 class="fw-bold text-warning mb-2"><?= htmlspecialchars($admin['nama']) ?></h5>
                            <h6 class="text-secondary mb-3"><?= htmlspecialchars($admin['jabatan']) ?></h6>
                            
                            <!-- Education -->
                            <?php if (!empty($admin['pendidikan_terakhir'])): ?>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark small">
                                    <i class="fas fa-graduation-cap me-1"></i><?= htmlspecialchars($admin['pendidikan_terakhir']) ?>
                                </span>
                            </div>
                            <?php endif; ?>

                            <!-- Description -->
                            <?php if (!empty($admin['deskripsi'])): ?>
                            <p class="text-muted small mb-3"><?= substr(htmlspecialchars($admin['deskripsi']), 0, 120) ?>...</p>
                            <?php endif; ?>

                            <!-- Contact -->
                            <div class="contact-info small">
                                <?php if (!empty($admin['email'])): ?>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <i class="fas fa-envelope text-warning me-2"></i>
                                    <a href="mailto:<?= $admin['email'] ?>" class="text-decoration-none small">
                                        <?= htmlspecialchars($admin['email']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($admin['telepon'])): ?>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-phone text-warning me-2"></i>
                                    <a href="tel:<?= $admin['telepon'] ?>" class="text-decoration-none small">
                                        <?= htmlspecialchars($admin['telepon']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Empty State -->
        <?php if (empty($struktur_data) || (empty($struktur_data['direktur']) && empty($struktur_data['manajer']) && empty($struktur_data['staff']) && empty($struktur_data['admin']))): ?>
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-users fa-5x text-muted opacity-50"></i>
            </div>
            <h3 class="text-muted">Data Struktur Organisasi Belum Tersedia</h3>
            <p class="text-muted">Saat ini data struktur organisasi belum diinputkan atau sedang dalam proses pembaruan.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-light py-5">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Hubungi Tim LPM</h3>
                <p class="text-muted mb-4">
                    Jika Anda memiliki pertanyaan tentang Lembaga Penjaminan Mutu atau ingin mengetahui 
                    lebih lanjut tentang program-program kami, jangan ragu untuk menghubungi tim kami.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="<?= base_url('contact') ?>" class="btn btn-primary px-4">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami
                    </a>
                    <a href="<?= base_url('kegiatan') ?>" class="btn btn-outline-primary px-4">
                        <i class="fas fa-calendar me-2"></i>Lihat Kegiatan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Styles -->
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }
    
    .section-title {
        position: relative;
        display: inline-block;
        font-size: 2.5rem;
    }
    
    .section-divider {
        width: 100px;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin: 1rem auto;
        border-radius: 2px;
    }
    
    .photo-wrapper {
        width: 180px;
        height: 180px;
        position: relative;
        margin: 0 auto;
    }
    
    .photo-wrapper-sm {
        width: 120px;
        height: 120px;
        position: relative;
        margin: 0 auto;
    }
    
    .profile-photo,
    .profile-photo-placeholder {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .profile-photo-sm,
    .profile-photo-placeholder-sm {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .profile-photo-placeholder,
    .profile-photo-placeholder-sm {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    
    .contact-info a {
        color: #666;
        transition: color 0.3s ease;
    }
    
    .contact-info a:hover {
        color: var(--bs-primary);
    }
    
    .hero-section .hero-icon {
        opacity: 0.1;
    }
    
    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }
        
        .photo-wrapper {
            width: 150px;
            height: 150px;
        }
        
        .photo-wrapper-sm {
            width: 100px;
            height: 100px;
        }
    }
    
    .badge {
        font-size: 0.85rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .contact-info i {
        width: 16px;
        text-align: center;
    }
</style>

<!-- Animation Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    // Apply animation to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
});
</script>
