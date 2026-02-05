<!-- Page Header -->
<section class="page-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 120px 0 60px;">
    <div class="container">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bold mb-3">Profile LPM</h1>
            <p class="lead mb-0">Lembaga Penjaminan Mutu Politeknik Piksi Ganesha</p>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb justify-content-center bg-transparent">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white-50">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Tentang LPM Section -->
<?php if ($tentang): ?>
<section id="tentang" class="content-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">
            <span class="section-icon"><?= $tentang['icon'] ?? '🎓' ?></span>
            <?= $tentang['title'] ?>
        </h2>
        
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="about-image text-center">
                    <div class="about-icon-box mx-auto" style="width: 200px; height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);">
                        <span style="font-size: 80px;"><?= $tentang['icon'] ?? '🎓' ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content">
                    <h3 class="h4 mb-4 text-primary">Lembaga Penjaminan Mutu Politeknik Piksi Ganesha</h3>
                    <?= $tentang['content'] ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Visi Misi Section -->
<section id="visi-misi" class="visi-misi-section py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="section-title text-center mb-5">Visi & Misi</h2>
        
        <div class="row g-4">
            <!-- Visi -->
            <?php if ($visi): ?>
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-body p-5">
                        <div class="card-icon mb-4" style="width: 70px; height: 70px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 35px;"><?= $visi['icon'] ?? '👁️' ?></span>
                        </div>
                        <h3 class="card-title h4 mb-4"><?= $visi['title'] ?></h3>
                        <div class="vision-text" style="font-style: italic; color: #555; line-height: 1.8;">
                            <?= $visi['content'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Misi -->
            <?php if ($misi): ?>
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-body p-5">
                        <div class="card-icon mb-4" style="width: 70px; height: 70px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 35px;"><?= $misi['icon'] ?? '🎯' ?></span>
                        </div>
                        <h3 class="card-title h4 mb-4"><?= $misi['title'] ?></h3>
                        <div class="mission-content" style="color: #555; line-height: 1.8;">
                            <?= $misi['content'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Tugas dan Tanggung Jawab Section -->
<?php if ($tugas && !empty($tugas['items'])): ?>
<section id="tugas" class="tugas-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">
            <span class="section-icon"><?= $tugas['icon'] ?? '📋' ?></span>
            <?= $tugas['title'] ?>
        </h2>
        
        <div class="row g-4">
            <?php foreach ($tugas['items'] as $item): ?>
            <div class="col-lg-4 col-md-6">
                <div class="tugas-card h-100 p-4" style="background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.3s ease; position: relative; overflow: hidden;">
                    <div class="tugas-number" style="position: absolute; top: -10px; right: 15px; font-size: 80px; font-weight: 800; color: rgba(102, 126, 234, 0.1);"><?= $item['number'] ?></div>
                    <h4 class="tugas-title h5 mb-3" style="color: #333; position: relative; z-index: 1;"><?= $item['title'] ?></h4>
                    <p class="mb-0" style="color: #666; line-height: 1.7; position: relative; z-index: 1;"><?= $item['description'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<style>
.section-title {
    font-weight: 700;
    color: #333;
    position: relative;
    padding-bottom: 15px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

.section-icon {
    display: inline-block;
    margin-right: 10px;
}

.about-content p {
    color: #555;
    line-height: 1.8;
    margin-bottom: 1rem;
}

.mission-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mission-content ul li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 15px;
}

.mission-content ul li::before {
    content: '✓';
    position: absolute;
    left: 0;
    top: 0;
    color: #667eea;
    font-weight: bold;
}

.tugas-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
}
</style>
